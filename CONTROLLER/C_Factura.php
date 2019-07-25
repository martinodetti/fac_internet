<?php 

// Capa de Acceso a BD.
include '../DAC/Database.class.php';
include '../MODEL/Factura.php'; 
include '../MODEL/Detalle_factura.php'; 
include '../MODEL/Producto.php'; 
include '../MODEL/Cliente_pago.php'; 
include '../MODEL/Kardex.php'; 
include '../MODEL/Detalle_kardex.php'; 
include '../MODEL/Remito.php';
include '../MODEL/Orden.php';
include '../VIEW/W_Factura.php';

include '../afip/awsfe.php';

//include '../VIEW/W_factura.php'; 

$out=""; 
if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc'];  

switch ($opc) { 
case '1': //add 

	$IMPRESORA = "HP_LaserJet_Professional_P_1102w";

	$punto_de_venta = 2;

	// Todos los POST que interviene. 
	$id_fact		=	0; 
	$id_empresa		=	$_GET['save_id_empresa']; 
	$id_cliente		=	$_GET['save_id_cliente']; 
	$id_vendedor	=	$_GET['save_id_vendedor']; 
	$descto_fact	=	$_GET['save_descto_fact']; 
	$iva21_fact		=	$_GET['save_iva21_fact'];
	$iva105_fact	=	$_GET['save_iva105_fact']; 
	$num_fact		=	$_GET['save_num_fact'];
	$tipo_fact		=	$_GET['save_tipo_fact'];
	$forma_pago		=	$_GET['save_forma_pago'];
	$total_fact		=	$_GET['save_total_fact']; 
	$obs_fact		=	trim($_GET['save_obs_fact']); 
	$fecemi_fact	=	$_GET['save_fecemi_fact']; 
	$id_remitos		= 	$_GET['txt_idremitos'];
	$id_ordenes		= 	$_GET['txt_idordenes'];
	$importe_MO		=	$_GET['txt_importe_manoobra'];
	$descrip_MO		= 	$_GET['txt_descripcion_manoobra'];
	$importe_MO2	=	$_GET['txt_importe_manoobra2'];
	$descrip_MO2	= 	$_GET['txt_descripcion_manoobra2'];
	$importe_TO		=	$_GET['txt_importe_torneria'];
	$descrip_TO		= 	$_GET['txt_descripcion_torneria'];
	$percepcion		= 	$_GET['save_percepcion'];
	$or_y_remito	=	$_GET['save_orden_y_remito'];
	$tipo_documento	=	$_GET['cmb_tipo_fact'];
	$detalle		= 	$_POST['Detalle'];
	$nro_documento 	= 	$_GET['txt_ruc_fact'];
	$id_fact_nc		= 	$_GET['txt_id_fact_nc'];

	$estado_fact	=	2; 
	if($forma_pago == 3)
		$estado_fact	=	1; 


	//primero vamos al webservices de la afip
/*
	$wsfe = new awsfe();

	//tengo que armar el objeto que va a recibir la factura 
	$param = array();
	$param1= array();
	//cabecera
	//Defino el tipo de documento que voy a enviar al ws de la afip
	$CbteTipo = 1; //por defecto vamos a poner factura A
	if($tipo_fact == 'A' && $tipo_documento == 3) $CbteTipo = 2;
	if($tipo_fact == 'A' && $tipo_documento == 2) $CbteTipo = 3;
	if($tipo_fact == 'B' && $tipo_documento == 1) $CbteTipo = 6;
	if($tipo_fact == 'B' && $tipo_documento == 3) $CbteTipo = 7;
	if($tipo_fact == 'B' && $tipo_documento == 2) $CbteTipo = 8;

	$param['FeCAEReq']['FeCabReq'] = array(	'CantReg' 	=> 1,
											'PtoVta' 	=> $punto_de_venta,
											'CbteTipo' 	=> $CbteTipo);


	///vamos a obtener el proximo numero
	$param1 = array('PtoVta' => $punto_de_venta , 'CbteTipo' => $CbteTipo);
	$ret1 = $wsfe->ejecutar_metodo('FECompUltimoAutorizado',$param1);
	if(isset($ret1->faultcode))
	{
		die(json_encode(array (	'error'			=> $ret1->faultcode, 
								'descripcion'	=> $ret1->faultstring)));
	}

	$CbteHasta = $CbteDesde = $ret1->FECompUltimoAutorizadoResult->CbteNro + 1;
	$num_fact = $CbteHasta;

	//informacion de la factura
	$DocTipo = 80; //CUIT
	if($tipo_fact == 'B' && $total_fact >= 1000)	$DocTipo = 86; //si no es factura A entonces probamos con Otro documento a ver si pasa
	if($tipo_fact == 'B' && $total_fact < 1000)		$DocTipo = 99;
	$nro_documento_afip = str_replace("-","",$nro_documento);
	if($DocTipo == 99) $nro_documento_afip = 0;
	$arr = explode("-", $fecemi_fact);
	$fecha_afip = $arr[2].$arr[1].$arr[0];
	$ImpIVA = $iva105_fact + $iva21_fact;
	$ImpNeto = $total_fact - $ImpIVA;
	$IVA = array();
	if($iva21_fact > 0) $IVA[] = array('Id' => 5, 'BaseImp' => number_format(($iva21_fact / 0.21),2,".",""), 'Importe' => $iva21_fact);
	if($iva105_fact > 0)$IVA[] = array('Id' => 4, 'BaseImp' => number_format(($iva105_fact/ 0.105),2,".",""),'Importe' => $iva105_fact);

	$param['FeCAEReq']['FeDetReq']['FECAEDetRequest'] = array(	'Concepto' 	=> 1, //1 Producto, 2 Servicio, 3 Productos y servicios
																'DocTipo'	=> $DocTipo,
																'DocNro'	=> $nro_documento_afip,
																'CbteDesde'	=> $CbteDesde,
																'CbteHasta' => $CbteHasta,
																'CbteFch'	=> $fecha_afip,
																'ImpTotal'	=> $total_fact,
																'ImpTotConc'=> 0,
																'ImpNeto'	=> $ImpNeto,
																'ImpOpEx'	=> 0,
																'ImpIVA'	=> $ImpIVA,
																'ImpTrib'	=> 0,
																'MonId'		=> 'PES',
																'MonCotiz'	=> 1,
																'Iva'		=> $IVA
																);

	$ret = $wsfe->ejecutar_metodo('FECAESolicitar',$param);


	$cae = "";
	$cae_vto = "";
	$continuar = FALSE;
	if($ret->FECAESolicitarResult->FeCabResp->Resultado == 'A')
	{
		$cae = $ret->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAE;
		$cae_vto = $ret->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAEFchVto;
		$continuar = TRUE;
	}

	if($continuar == FALSE)
	{
		$error = 0;
		$descrip = "";
		if(isset($ret->FECAESolicitarResult->Errors))
		{
			$error		= $ret->FECAESolicitarResult->Errors->Err->Code;
			$descrip	= $ret->FECAESolicitarResult->Errors->Err->Msg;
		}
		else if(isset($ret->FECAESolicitarResult->FeDetResp->FECAEDetResponse))
		{
			$error		= $ret->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones->Obs->Code;
			$descrip	= $ret->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones->Obs->Msg;
		}
	
		die(json_encode(array(	'error' 		=> $error, 
								'descripcion' 	=> utf8_decode($descrip))));
	}
*/
	$factura=new factura();

	$factura->set_id_empresa($id_empresa);
	$factura->set_id_cliente($id_cliente);
	$factura->set_id_vendedor($id_vendedor);
	$factura->set_descto_fact($descto_fact);
	$factura->set_iva21_fact($iva21_fact);
	$factura->set_iva105_fact($iva105_fact);
	$factura->set_num_fact($num_fact);
	$factura->set_tipo_fact($tipo_fact);	
	$factura->set_forma_pago($forma_pago);
	$factura->set_total_fact($total_fact);
	$factura->set_obs_fact($obs_fact);
	$factura->set_fecemi_fact($fecemi_fact);
	$factura->set_estado_fact($estado_fact);
	$factura->set_percepcion_fact($percepcion);
	$factura->set_remitos_fact($id_remitos);
	$factura->set_or_y_remito_fact($or_y_remito);
	$factura->set_punto_de_venta($punto_de_venta);
	$factura->set_nro_cae($cae);
	$factura->set_cae_vto($cae_vto);

	$ret=$factura->addFactura($factura);

	$id_fact=$ret['0'][0]; //last_id de factura
	
	if($tipo_documento == 2)
	{
		$factura->set_nota_credito($id_fact);
		$factura->nc_contra_factura($factura->get_total_fact(), $id_fact_nc, $id_fact);
	}
	if($tipo_documento == 3)
	{
		$factura->set_nota_debito($id_fact);
	}	
	
	//mano de obra
	$factura->resetManoObra($id_fact);
	$factura->setManoObra($importe_MO, $descrip_MO, $id_fact);
	$factura->setManoObra($importe_MO2, $descrip_MO2, $id_fact);
	
	//torneria
	$factura->setTorneria($importe_TO, $descrip_TO, $id_fact);
	
	//creo una instancia de la clase detalle
	$clsDetFactura=new detalle_factura();

	//ahora declaro variable general para el array de productos
	$arr_id_producto="";//tipo cadena
	
	
	$detalle=$_POST['Detalle'];
	$dt_aux=array();
	$dt_data=array();   
	foreach($detalle as $dt_aux)
	{
		$dt_data[]=$dt_aux;  
	}
	//ahora esta listo para guardar detalle de factura
	//ahora modelo kardex

	foreach($dt_data as $accion)
	{
		if($accion['id'] != '0' && $accion['id'] != '-1' && $accion['id'] != '-2') 
		{

			$clsDetFactura->set_id_fact($id_fact);
			$clsDetFactura->set_id_producto($accion['id']);
			$clsDetFactura->set_canti_detfact($accion['cantidad']);
			$clsDetFactura->set_precio_detfact($accion['precio']);
			$clsDetFactura->set_estado_detfact("1");
		
			$arr_id_producto=$arr_id_producto.$accion['id'].'-';
		
			//insertamos detalle factura o en la nota de crédito en su defecto
			//fact y nota de credito es lo mismo. Lo unico que cambia es que resta o suma el stock del producto
			//TODO si viene de un remito entonces no descontar el stock
			$afecta_stock = true;
			if($accion['id_remi'] > 0){
				$afecta_stock = false;
			}
			if($nota_credito == 1)
			{
				$out=$clsDetFactura->addDetalle_notacredito($clsDetFactura, $afecta_stock);
			}
			else
			{
				$out=$clsDetFactura->addDetalle_factura($clsDetFactura, $afecta_stock);
			}

		}
	}
	
	//cliente_pago.php listo
	$clsCli_pago=new cliente_pago();
	$clsCli_pago->set_id_persona($id_cliente);
	$clsCli_pago->set_id_factura($id_fact);
	$clsCli_pago->set_canti_pago($total_fact);
	$clsCli_pago->set_fecha_pago($fecemi_fact);
	$clsCli_pago->set_estado_pago('1');
	$aux_val=$clsCli_pago->eliminar_cliente_pago($id_cliente, $fecemi_fact);
	//inserte el pago.La lógica es interna
//					$out=$clsCli_pago->addCliente_pago($clsCli_pago);
	
	$remi_status = new remito();
	$remi_status->setRemitosPagados($id_remitos, $id_fact);
	
	$orden_status = new orden();
	$orden_status->setordenesPagados($id_ordenes, $id_fact);

 	$out=json_encode(array(	'error'		=> 0, 
							'numero'	=> $CbteDesde,
							'cae'		=> $cae,
							'cae_vto'	=> $cae_vto,
							'txt'		=> "Factura aprobada por la AFIP.",
							'p_de_v'	=> $punto_de_venta
						)
					);

	break; 

case '2' : //update 

// Todos los POST que interviene en Update. 

$id_fact=$_POST['update_id_fact']; 

$id_empresa=$_POST['update_id_empresa']; 

$id_cliente=$_POST['update_id_cliente']; 

$id_vendedor=$_POST['update_id_vendedor']; 

$descto_fact=$_POST['update_descto_fact']; 

$obs_fact=trim($_POST['update_obs_fact']); 

$fecemi_fact=$_POST['update_fecemi_fact']; 

$estado_fact=$_POST['update_estado_fact']; 

$factura=new factura();

$factura->set_id_fact($id_fact);

$factura->set_id_empresa($id_empresa);

$factura->set_id_cliente($id_cliente);

$factura->set_id_vendedor($id_vendedor);

$factura->set_descto_fact($descto_fact);

$factura->set_obs_fact($obs_fact);

$factura->set_fecemi_fact($fecemi_fact);

$factura->set_estado_fact($estado_fact);

$ret=$factura->updateFactura($factura); 

$out=$ret['rows_affected'][0]; 

 break; 

case '3' : //delete 
// Todos los POST que interviene Delete. 
$id_fact=$_POST['delete_id_fact']; 
$factura=new factura();
$ret=$factura->deleteFactura($id_fact); 
$out=$ret['rows_affected'][0]; 

 break; 

case '4' : //show 

// Todos los POST que interviene Show. 
$id_fact=$_POST['show_id_fact']; 
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
 $out = '';

 if(strlen($strNomproducto) >= 3)
 {
	$out=$Producto->listProductosPorNombreFactura($strNomproducto);
 }
break;
//reporte de factura
case '8'://cabecera mediante fechas
	$clsFactura=new factura();
    $fecIni=$_POST['fec_ini'];
    $fecFinal=$_POST['fec_final'];
	$out=$clsFactura->listJsonFacturas($fecIni, $fecFinal);

break;
case '9'://detalle de factura
	$clsFactura=new factura();
	$id_fact=$_POST['id_fact'];
	$out = '';
	if($id_fact > 0) {
		$out=$clsFactura->listJsonFacuraDetalle_dos($id_fact);
	}
    break;
	
case '10'://proximo numero de remito
	$clsFactura=new factura();
	if($_POST['id_tipo'] == 'A')
		$id_tipo = 1;
	else
		$id_tipo = 2;
 	$out=$clsFactura->getProximoFactura($id_tipo);
	break;
case '13': //Factura para ver completa
	$id_fact = $_POST['id_fact'];
	$clsfact = new factura();
	$clsfact = $clsfact->showFactura_vista($id_fact);
	$out=json_encode($clsfact);
	break;
	
case '14':
	$id_fact = $_POST['id_fact'];
	$forma_pago = $_POST['forma_pago'];
	$clsfact = new factura();
	$out = json_encode($clsfact->cobrar($id_fact, $forma_pago));
	break;
	
case '15':
	$num_fact = $_POST['num_fact'];
	$tipo_fact = $_POST['tipo_fact'];
	
	if($tipo_fact == "A")
		$tipo_fact = 1;
	else
		$tipo_fact = 2;
	
	$clsFact = new factura();
	$out = json_encode($clsFact->VerificarExistenciaNumero($num_fact, $tipo_fact));
	
	break;

case '16':
	$id_fact = $_POST['id_fact'];
	$clsfact = new factura();
	$out = json_encode($clsfact->anular($id_fact));
	break;
	
case '17':
	$id_cli = $_POST['id_cli'];
	$clsFact = new w_factura();
	$out = $clsFact->printfacturasCliente($id_cli);
	break;
	
case '18':
	$id_cli = $_POST['id_cli'];
	$clsFact = new w_factura();
	$out = $clsFact->printUltimasfacturasCliente($id_cli);
	break;

case '19'://cabecera mediante fechas
	$clsFactura=new factura();
    $idc=$_POST['idc'];
	$out=$clsFactura->listJsonFacturasCtaCte($idc);

break;

}
 

die($out); 

?>
