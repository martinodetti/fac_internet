<?php

// Capa de Acceso a BD.

include '../DAC/Database.class.php';
include_once '../MODEL/Recibo.php';
include_once '../MODEL/Factura.php';
include_once '../MODEL/Cheque.php';
include_once '../MODEL/Persona.php';

$out="";
if(isset ($_POST['opc']))
$opc=$_POST['opc'];
else
$opc=$_GET['opc'];

switch ($opc) {
case '1': //add

// Todos los POST que interviene.
	$id_recibo		= 0;
	$id_cliente		= $_GET['save_id_cliente'];
	$num_recibo		= $_GET['save_num_recibo'];
	$total_recibo	= $_GET['save_total_recibo'];
	$obs_recibo		= $_GET['save_obs_recibo'];
	$fecemi_recibo	= $_GET['save_fecemi_recibo'];
	$efectivo_recibo= $_GET['save_efectivo_recibo'];
    $saldo_p_prov   = $_GET['save_saldo_para_proveedor'];
	$estado_recibo	= "1";
    $id_responsable = $_GET['save_id_responsable'];

	$tipo_recibo 	= "1";
	if(isset($_GET['save_recibo_local']) && $_GET['save_recibo_local'] == 'on')
		$tipo_recibo = "2";

	$facturas		= $_POST['facturas'];
	$cheques		= $_POST['cheques'];
	$retenciones	= $_POST['retenciones'];
	$transferencias	= $_POST['transferencias'];
	$fact_prov		= $_POST['fact_prov'];

	if(!isset($facturas))
		$facturas = array();
	if(!isset($cheques))
		$cheques = array();
	if(!isset($retenciones))
		$retenciones = array();
	if(!isset($transferencias))
		$transferencias = array();
	if(!isset($fact_prov))
		$fact_prov= array();


	$recibo=new recibo();

	$recibo->set_id_cliente(	$id_cliente);
	$recibo->set_num_recibo(	$num_recibo);
	$recibo->set_total_recibo(	$total_recibo);
	$recibo->set_obs_recibo(	$obs_recibo);
	$recibo->set_fecemi_recibo(	$fecemi_recibo);
	$recibo->set_estado_recibo(	$estado_recibo);
	$recibo->set_efectivo_recibo($efectivo_recibo);
	$recibo->set_tipo_recibo(	$tipo_recibo);
    $recibo->set_id_responsable($id_responsable);
	$ret=$recibo->addrecibo(	$recibo);
	$id_recibo=$ret['0'][0]; //last_id de recibo

	//guardar los cheques del detalle
	foreach($cheques as $cheque)
	{
		$arr = explode("-",$cheque['fecha']);
		$fecha_cheque = $arr[2] . "-" . $arr[1] . "-" . $arr[0];

		$clsCheque = new cheque();
		$clsCheque->set_id_cliente(			$id_cliente			);
		$clsCheque->set_id_recibo(			$id_recibo			);
		$clsCheque->set_num_cheque(			$cheque['numero']	);
		$clsCheque->set_monto_cheque(		$cheque['monto']	);
		$clsCheque->set_fecrec_cheque(		date('Y-m-d')		);
		$clsCheque->set_fecpago_cheque(		$fecha_cheque		);
		$clsCheque->set_banco_cheque(		$cheque['banco']	);
		$clsCheque->set_propietario(		$cheque['propie']	);
		$clsCheque->set_cuit_propietario(	$cheque['cuit_propie']);
		$clsCheque->set_estado_cheque(		$cheque['estado']	);
		$clsCheque->set_obs_cheque(			$cheque['obs']		);

		$result = $clsCheque->addCheque($clsCheque);
	}

	//Guardo las retenciones del detalle
	foreach($retenciones as $retencion)
	{
		$ret = array();
		$ret['id_recibo'] 	= $id_recibo;
		$ret['idtipo'] 		= $retencion['idtipo'];
		$ret['numero'] 		= $retencion['numero'];
		$ret['monto'] 		= $retencion['monto'];

		$result = $recibo->addRetencion($ret);
	}

	//guardo las transferencias del detalle
	foreach($transferencias as $trans)
	{
		$tra = array();
		$tra['id_recibo'] 	= $id_recibo;
		$tra['numero'] 		= $trans['numero'];
		$tra['monto'] 		= $trans['monto'];
		$tra['fecha']		= date('Y-m-d');

		$result = $recibo->addTransferencia($tra);
	}

	$saldo = $total_recibo;

	//facturas del proveedor
	foreach($fact_prov as $fact_p)
	{
		$dat = array();
		$dat['id_compra'] 	= $fact_p['id'];
		$dat['id_recibo'] 	= $id_recibo;
		$dat['saldo'] 		= 0;
		$dat['monto']		= $fact_p['total'];

		$saldo = $saldo - $fact_p['total'];

		$recibo->addCompraRecibo($dat);
	}

	//actualizo el saldo del cliente
    $persona = new persona();
	$persona->set_saldo_favor($id_cliente, $saldo_p_prov);

	//actualizar las facturas del detalle
	foreach($facturas as $fact)
	{
		$dat = array();
		$dat['id_fact'] 	= $fact['id'];
		$dat['id_recibo'] 	= $id_recibo;
		$dat['saldo'] 		= $fact['pendiente'];
		$dat['monto']		= $fact['total'] - $fact['pendiente'];

		$recibo->addFacturaRecibo($dat);
	}

 	$out=$recibo->json("1", "Los datos se han guardado correctamente.");

	break;

case '2' : //insert pago a proveedores
// Todos los POST que interviene.

// Todos los POST que interviene.
	$id_proveedor	= $_GET['save_id_provd'];
	$num_recibo		= $_GET['save_num_recibo'];
	$total_recibo	= $_GET['save_total_recibo'];
	$obs_recibo		= $_GET['save_obs_recibo'];
	$fecemi_recibo	= $_GET['save_fecemi_recibo'];
	$efectivo_recibo= $_GET['save_efectivo_recibo'];
	$debito_recibo	= $_GET['save_debito_recibo'];
	$old_saldo_favor= $_GET['save_saldo_recibo'];

	$saldo_a_favor	= $_GET['save_nuevo_saldo_recibo'];

	if($saldo_a_favor == ""){
		$saldo_a_favor = 0;
	}

	$estado_recibo	= "1";

	$tipo_recibo 	= "3";

	$facturas		= $_POST['facturas'];
	$cheques		= $_POST['cheques'];
	$retenciones	= $_POST['retenciones'];
	$transferencias	= $_POST['transferencias'];
//	$fact_prov		= $_POST['fact_prov'];

	if(!isset($facturas))
		$facturas = array();
	if(!isset($cheques))
		$cheques = array();
	if(!isset($retenciones))
		$retenciones = array();
	if(!isset($transferencias))
		$transferencias = array();
	if(!isset($fact_prov))
		$fact_prov= array();

	$recibo=new recibo();

	if($debito_recibo == ''){
		$debito_recibo = 0;
	}
	if($efectivo_recibo == ''){
		$efectivo_recibo = 0;
	}

	//primero vamos a borrar todo y despues lo volvemos a guardar
	$recibo->set_id_provd(		$id_proveedor);
	$recibo->set_num_recibo(	$num_recibo);
	$recibo->set_total_recibo(	$total_recibo);
	$recibo->set_obs_recibo(	$obs_recibo);
	$recibo->set_fecemi_recibo(	$fecemi_recibo);
	$recibo->set_estado_recibo(	$estado_recibo);
	$recibo->set_efectivo_recibo($efectivo_recibo);
	$recibo->set_debito_recibo(	$debito_recibo);
	$recibo->set_tipo_recibo(	$tipo_recibo);
    $recibo->set_id_responsable($id_responsable);
	$recibo->set_saldo_a_favor(	$old_saldo_favor);

	$ret=$recibo->addReciboProvd(	$recibo);

	$id_recibo = $ret[0][0];
	if(!$id_recibo > 0){
		die("error");
	}

	//guardar los cheques del detalle
	foreach($cheques as $cheque)
	{
		if($cheque['id'] > 0)
		{
			$clsCheque = new cheque();
			$clsCheque->setChequePago($cheque['id'], $id_recibo);
			$clsCheque->cambiarEstado($cheque['id'], 3);
		}
		else
		{
			$arr = explode("-",$cheque['fecha']);
			$fecha_cheque = $arr[2] . "-" . $arr[1] . "-" . $arr[0];

			$clsCheque = new cheque();
			$clsCheque->set_id_recibo_provd(	$id_recibo			);
			$clsCheque->set_num_cheque(			$cheque['numero']	);
			$clsCheque->set_monto_cheque(		$cheque['monto']	);
			$clsCheque->set_fecrec_cheque(		date('Y-m-d')		);
			$clsCheque->set_fecpago_cheque(		$fecha_cheque		);
			$clsCheque->set_banco_cheque(		$cheque['banco']	);
			$clsCheque->set_propietario(		$cheque['propie']	);
			$clsCheque->set_cuit_propietario(	$cheque['cuit_propie']);
			$clsCheque->set_estado_cheque(		$cheque['estado']	);
			$clsCheque->set_obs_cheque(			$cheque['obs']		);

			$result = $clsCheque->addChequePropio($clsCheque);
		}
	}


	//Guardo las retenciones del detalle
	foreach($retenciones as $retencion)
	{
		$ret = array();
		$ret['id_recibo'] 	= $id_recibo;
		$ret['idtipo'] 		= $retencion['idtipo'];
		$ret['numero'] 		= $retencion['numero'];
		$ret['monto'] 		= $retencion['monto'];

		$result = $recibo->addRetencion($ret);
	}

	//guardo las transferencias del detalle
	foreach($transferencias as $trans)
	{
		$tra = array();
		$tra['id_recibo'] 	= $id_recibo;
		$tra['numero'] 		= $trans['numero'];
		$tra['monto'] 		= $trans['monto'];
		$tra['fecha']		= date('Y-m-d');

		$result = $recibo->addTransferencia($tra);
	}
/*
	//facturas del proveedor
	foreach($fact_prov as $fact_p)
	{
		$dat = array();
		$dat['id_compra'] 	= $fact_p['id'];
		$dat['id_recibo'] 	= $id_recibo;
		$dat['saldo'] 		= 0;
		$dat['monto']		= $fact_p['total'];

		$recibo->addCompraRecibo($dat);
	}
*/
	//actualizar las facturas del detalle
	foreach($facturas as $fact)
	{
		$dat = array();
		$dat['id_compra'] 	= $fact['id'];
		$dat['id_recibo'] 	= $id_recibo;
		$dat['saldo'] 		= $fact['pendiente'];
		$dat['monto']		= $fact['total'] - $fact['pendiente'];

		$recibo->addCompraRecibo($dat);
	}

	if($saldo_a_favor > 0 || true){
		$clsPersona = new persona();
		$clsPersona->set_saldo_favor( $id_proveedor, $saldo_a_favor * -1);
	}

 	$out=$recibo->json("1", "Los datos se han guardado correctamente.");

	break;

case '3' : //delete
	// Todos los POST que interviene Delete.
	$id_recibo=$_POST['delete_id_recibo'];
	$recibo=new recibo();
	$ret=$recibo->deleteRecibo($id_recibo);
	$out=$ret['rows_affected'][0];
	break;

case '4' : //show
// Todos los POST que interviene Show.
	$id_recibo=$_POST['show_id_recibo'];
	$W_factura=new W_factura();
	$out=$W_factura->printFactura($id_fact);
 	break;

case '5' : //print mesas por fecha pero para reporte de venta seguro en json
	$W_factura=new W_factura();
	$out=$W_factura->printFacturas($fecIni,$fecFinal);
	break;

case '6':
	$strNomproducto = isset($_POST['q']) ? strval($_POST['q']) : '';
 	$Producto =new producto();
 	$out=$Producto->listProductosPorNombreFactura($strNomproducto);
	break;

//reporte de recibos
case '8'://cabecera mediante fechas
 	$clsRecibo=new recibo();
   $fecIni=$_POST['fec_ini'];
   $fecFinal=$_POST['fec_final'];
 	$out=$clsRecibo->listJsonRecibo($fecIni, $fecFinal);
	break;

case '9'://detalle de recibo
	$clsRecibo=new recibo();
 	$id_recibo=$_POST['id_recibo'];
 	$out=$clsRecibo->listJsonReciboDetalle($id_recibo);
	break;

case '10': //recibos para facturas
	$wRecibo = new W_recibo();
	$id_cli = $_POST['id_cli'];
	$out = $wRecibo->printrecibosCliente($id_cli);
	break;

case '11'://detalle de recibo
	$clsRecibo=new recibo();
 	$id_recibo=$_POST['id_recibo'];
 	$out=$clsRecibo->listJsonReciboDetalleFactura($id_recibo);
	break;
case '12'://proximo numero de recibo
	$clsRecibo=new recibo();
 	$out=$clsRecibo->getProximoRecibo();
	break;
case '13': //recibo para ver
	$id_recibo = $_POST['id_recibo'];
	$clsRecibo = new recibo();
//	$clsDetalleRecibo = new detalle_recibo();
//	$clsOrden = $clsOrden->showOrden($id_orden);
	$clsRecibo = $clsRecibo->showReciboEdit($id_recibo);
//	$clsRecibo['detalle'] = $clsDetalleRecibo->showDetalle_recibo_vista($id_recibo);
	$out=json_encode($clsRecibo);
	break;

case '14':
	$id_recibo = $_GET['id_recibo'];
	$clsRecibo = new recibo();
	$out = json_encode($clsRecibo->generarPresupuesto($id_recibo));
	break;

case '15':
	$id_recibo = $_GET['id_recibo'];
	$clsRecibo = new recibo();
	$out = json_encode($clsRecibo->existePresupuestoCreado($id_recibo));
	break;

case '16': //recibo para ver
	$id_recibo = $_POST['id_recibo'];
	$clsRecibo = new recibo();
//	$clsDetalleRecibo = new detalle_recibo();
//	$clsOrden = $clsOrden->showOrden($id_orden);
	$clsRecibo = $clsRecibo->showReciboProvd($id_recibo);
//	$clsRecibo['detalle'] = $clsDetalleRecibo->showDetalle_recibo_vista($id_recibo);
	$out=json_encode($clsRecibo);
	break;
case '17'://proximo numero de recibo local
	$clsRecibo=new recibo();
 	$out=$clsRecibo->getProximoNumeroReciboLocal();
	break;
case '18': //proximo nuevo de recibo a proveedor
	$clsRecibo=new recibo();
 	$out=$clsRecibo->getProximoNumeroReciboProveedor();
	break;
case '19':
	$clsRecibo = new recibo();
	$num = $_POST['num'];
	$out=$clsRecibo->checkNumeroReciboManual($num);
	break;

case '20':
	$id_recibo		= $_GET['save_id_recibo'];
	$id_cliente		= $_GET['save_id_cliente'];
	$num_recibo		= $_GET['save_num_recibo'];
	$total_recibo	= $_GET['save_total_recibo'];
	$obs_recibo		= $_GET['save_obs_recibo'];
	$fecemi_recibo	= $_GET['save_fecemi_recibo'];
	$efectivo_recibo= $_GET['save_efectivo_recibo'];
    $saldo_p_prov   = $_GET['save_saldo_para_proveedor'];
	$estado_recibo	= "1";
	$id_responsable = $_GET['save_id_responsable'];
	
	$tipo_recibo 	= "1";
	if(isset($_GET['save_recibo_local']) && $_GET['save_recibo_local'] == 'on')
		$tipo_recibo = "2";

	$facturas		= isset($_POST['facturas'])?$_POST['facturas']:array();
	$cheques		= isset($_POST['cheques'])?$_POST['cheques']:array();
	$retenciones	= isset($_POST['retenciones'])?$_POST['retenciones']:array();
	$transferencias	= isset($_POST['transferencias'])?$_POST['transferencias']:array();
	$fact_prov		= isset($_POST['fact_prov'])?$_POST['fact_prov']:array();

	$recibo=new recibo();

	$recibo->set_id_recibo(		$id_recibo);
	$recibo->set_id_cliente(	$id_cliente);
	$recibo->set_num_recibo(	$num_recibo);
	$recibo->set_total_recibo(	$total_recibo);
	$recibo->set_obs_recibo(	$obs_recibo);
	$recibo->set_fecemi_recibo(	$fecemi_recibo);
	$recibo->set_estado_recibo(	$estado_recibo);
	$recibo->set_efectivo_recibo($efectivo_recibo);
	$recibo->set_tipo_recibo(	$tipo_recibo);
	$recibo->set_id_responsable($id_responsable);
	
	$ret=$recibo->updateRecibo(	$recibo);

	$recibo->deleteContenido($id_recibo);

	//guardar los cheques del detalle
	foreach($cheques as $cheque)
	{
		$arr = explode("-",$cheque['fecha']);
		$fecha_cheque = $arr[2] . "-" . $arr[1] . "-" . $arr[0];

		$clsCheque = new cheque();
		$clsCheque->set_id_cliente(			$id_cliente			);
		$clsCheque->set_id_recibo(			$id_recibo			);
		$clsCheque->set_num_cheque(			$cheque['numero']	);
		$clsCheque->set_monto_cheque(		$cheque['monto']	);
		$clsCheque->set_fecrec_cheque(		date('Y-m-d')		);
		$clsCheque->set_fecpago_cheque(		$fecha_cheque		);
		$clsCheque->set_banco_cheque(		$cheque['banco']	);
		$clsCheque->set_propietario(		$cheque['propie']	);
		$clsCheque->set_cuit_propietario(	$cheque['cuit_propie']);
		$clsCheque->set_estado_cheque(		$cheque['estado']	);
		$clsCheque->set_obs_cheque(			$cheque['obs']		);

		$result = $clsCheque->addCheque($clsCheque);
	}

	//Guardo las retenciones del detalle
	foreach($retenciones as $retencion)
	{
		$ret = array();
		$ret['id_recibo'] 	= $id_recibo;
		$ret['idtipo'] 		= $retencion['idtipo'];
		$ret['numero'] 		= $retencion['numero'];
		$ret['monto'] 		= $retencion['monto'];

		$result = $recibo->addRetencion($ret);
	}

	//guardo las transferencias del detalle
	foreach($transferencias as $trans)
	{
		$tra = array();
		$tra['id_recibo'] 	= $id_recibo;
		$tra['numero'] 		= $trans['numero'];
		$tra['monto'] 		= $trans['monto'];
		$tra['fecha']		= date('Y-m-d');

		$result = $recibo->addTransferencia($tra);
	}

	$saldo = $total_recibo;

	//facturas del proveedor
	foreach($fact_prov as $fact_p)
	{
		$dat = array();
		$dat['id_compra'] 	= $fact_p['id'];
		$dat['id_recibo'] 	= $id_recibo;
		$dat['saldo'] 		= 0;
		$dat['monto']		= $fact_p['total'];

		$saldo = $saldo - $fact_p['total'];

		$recibo->addCompraRecibo($dat);
	}

	//actualizo el saldo del cliente
    $persona = new persona();
	$persona->set_saldo_favor($id_cliente, $saldo_p_prov);

	//actualizar las facturas del detalle
	foreach($facturas as $fact)
	{
		$dat = array();
		$dat['id_fact'] 	= $fact['id'];
		$dat['id_recibo'] 	= $id_recibo;
		$dat['saldo'] 		= $fact['pendiente'];
		$dat['monto']		= $fact['total'] - $fact['pendiente'];

		$recibo->addFacturaRecibo($dat);
	}

 	$out=$recibo->json("1", "Los datos se han guardado correctamente.");

	break;
}

die($out);

?>
