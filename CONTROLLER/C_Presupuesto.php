<?php

// Capa de Acceso a BD.

include 'C_Debug.php';
include '../DAC/Database.class.php';
include '../MODEL/Presupuesto.php';
include '../MODEL/Detalle_presupuesto.php';
include '../MODEL/Producto.php';
include '../MODEL/Vozcliente_1.php';

//include '../VIEW/W_Detalle_presupuesto.php';
include '../VIEW/W_Remito.php';

$out="";
if(isset ($_POST['opc']))
$opc=$_POST['opc'];
else
$opc=$_GET['opc'];

switch ($opc) {
case '1': //add

// Todos los POST que interviene.
	$id_presupuesto			= $_GET['save_num_presupuesto'];
//	if(!isset($_GET['save_id_presupuesto'])
//		$id_presupuesto  $_GET['save_num_presupuesto'];
	$id_vehiculo		= $_GET['save_id_vehiculo'];
	$id_cliente			= $_GET['save_id_cliente'];
	$num_presupuesto	= $_GET['save_num_presupuesto'];
	$total_presupuesto	= $_GET['save_total_presupuesto'];
	$obs_presupuesto	= $_GET['save_obs_presupuesto'];
	$fecemi_presupuesto	= $_GET['save_fecemi_presupuesto'];
	$descto_presupuesto	= $_GET['save_descto_fact'];
	$importe_MO			= $_GET['txt_importe_manoobra'];
	$descrip_MO			= $_GET['txt_descripcion_manoobra'];
	$importe_MO2		= $_GET['txt_importe_manoobra2'];
	$descrip_MO2		= $_GET['txt_descripcion_manoobra2'];
	$importe_TO			= $_GET['txt_importe_torneria'];
	$descrip_TO			= $_GET['txt_descripcion_torneria'];
	$descrip_vc			= $_GET['txt_detalle_vozcliente'];
	$contacto_vc		= $_GET['txt_contacto_vozcliente'];
	$kms_presupuesto	= $_GET['save_kms_presupuesto'];
	$id_vozcliente		= 0;
//	$id_vozcliente		= $_GET['save_id_vozcliente'];


	switch ($_GET['tipo_guardar']){
		case 'abierto':
			$estado_presupuesto = 1;
			break;
		case 'vencido':
			$estado_presupuesto = 2;
			break;
		case 'generar':
			$estado_presupuesto = 3;
			break;
		case 'rechazado':
			$estado_presupuesto = 4;
			break;
		case 'generar_2':
			$estado_presupuesto = 5;
			break;
		case 'aceptado':
			$estado_presupuesto = 3;
			break;
	}

	$presupuesto=new presupuesto();

// Aca antes habia 2 validaciones que no me hicieron falta
// Las saqué de esta manera para no tener que acomodar el codigo mas abajo
	if(true){
		if(true){

			//Vamos a dar vuelta los campos fechas
			if($fecemi_presupuesto != ''){
				$arr = explode('-',$fecemi_presupuesto);
				$fecemi_presupuesto = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
			}
			if($fecingreso_presupuesto != ''){
				$arr = explode('-',$fecingreso_presupuesto);
				$fecingreso_presupuesto = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
			}
			if($fecegreso_presupuesto != ''){
				$arr = explode('-',$fecegreso_presupuesto);
				$fecegreso_presupuesto = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
			}

			$presupuesto->set_id_presupuesto(			$id_presupuesto);
			$presupuesto->set_id_vehiculo(				$id_vehiculo);
			$presupuesto->set_id_cliente(				$id_cliente);
			$presupuesto->set_num_presupuesto(			$num_presupuesto);
			$presupuesto->set_total_presupuesto(		$total_presupuesto);
			$presupuesto->set_obs_presupuesto(			$obs_presupuesto);
			$presupuesto->set_fecemi_presupuesto(		$fecemi_presupuesto);
			$presupuesto->set_estado_presupuesto(		$estado_presupuesto);
			$presupuesto->set_descrip_vc(				$descrip_vc);
			$presupuesto->set_contacto_vc(				$contacto_vc);
			$presupuesto->set_id_vozcliente(			$id_vozcliente);
			$presupuesto->set_kms_presupuesto(			$kms_presupuesto);
			$presupuesto->set_descto_presupuesto(		$descto_presupuesto);

			$ret=$presupuesto->addpresupuesto(			$presupuesto);

			$id_presupuesto=$ret['0'][0]; //last_id de presupuesto de reparacion


			//mano de obra
			$presupuesto->resetManoObra($id_presupuesto);
			$presupuesto->setManoObra($importe_MO, $descrip_MO, $id_presupuesto);
			$presupuesto->setManoObra($importe_MO2, $descrip_MO2, $id_presupuesto);

			//torneria
			$presupuesto->setTorneria($importe_TO, $descrip_TO, $id_presupuesto);

			//voz de cliente
			$vozcliente = new vozcliente_1();
			$vozcliente->usarVozcliente($presupuesto->_id_vozcliente);

			//creo una instancia de la clase detalle
			$clsDetPresupuesto=new detalle_presupuesto();

			//ahora declaro variable general para el array de productos
			$arr_id_producto="";//tipo cadena

			$detalle=$_POST['Detalle'];
			$dt_aux=array();
			$dt_data=array();
		 	foreach($detalle as $dt_aux){
		   	$dt_data[]=$dt_aux;
		 	}
			 //ahora esta listo para guardar detalle de factura
			 //ahora modelo kardex
			foreach($dt_data as $accion){
				if($accion['id'] != '0' && $accion['id'] != '-1' && $accion['id'] != '-2') {
					$clsDetPresupuesto = new detalle_presupuesto();

					$clsDetPresupuesto->set_id_presupuesto($id_presupuesto);
					$clsDetPresupuesto->set_id_producto($accion['id']);
					$clsDetPresupuesto->set_canti_detpresupuesto($accion['cantidad']);
					$clsDetPresupuesto->set_precio_detpresupuesto($accion['precio']);
					$clsDetPresupuesto->set_estado_detpresupuesto("1");
					$arr_id_producto=$arr_id_producto.$accion['id'].'-';

					//insertamos detalle presupuesto
					$out=$clsDetPresupuesto->addDetalle_presupuesto($clsDetPresupuesto);

					if($estado_presupuesto == 4)
					{
						$clsDetPresupuesto->descontarStock($clsDetPresupuesto);
					}
				}
			}
		 	$out=$presupuesto->json("1", "Los datos se han guardado correctamente.");
	   }else{
	   	$out=$presupuesto->json("1", "Primer else");
		}
	}else{
		$out=$presupuesto->json("1", "Segundo else");
	}
	break;

case '2' : //update
// Todos los POST que interviene en Update.
	$id_presupuesto			= $_GET['save_num_presupuesto'];
	$id_vehiculo			= $_GET['save_id_vehiculo'];
	$id_cliente				= $_GET['save_id_cliente'];
	$num_presupuesto		= $_GET['save_num_presupuesto'];
	$total_presupuesto		= $_GET['save_total_presupuesto'];
	$obs_presupuesto		= $_GET['save_obs_presupuesto'];
	$fecemi_presupuesto		= $_GET['save_fecemi_presupuesto'];
	$importe_MO				= $_GET['txt_importe_manoobra'];
	$descrip_MO				= $_GET['txt_descripcion_manoobra'];
	$importe_MO2			= $_GET['txt_importe_manoobra2'];
	$descrip_MO2			= $_GET['txt_descripcion_manoobra2'];
	$importe_TO				= $_GET['txt_importe_torneria'];
	$descrip_TO				= $_GET['txt_descripcion_torneria'];
	$descrip_vc				= $_GET['txt_detalle_vozcliente'];
	$contacto_vc			= $_GET['txt_contacto_vozcliente'];
	$kms_presupuesto		= $_GET['save_kms_presupuesto'];
	$descto_presupuesto		= $_GET['save_descto_fact'];

	$id_vozcliente			= 0;
//	$id_vozcliente			= $_GET['save_id_vozcliente'];


	switch ($_GET['tipo_guardar']){
		case 'abierto':
			$estado_presupuesto = 1;
			break;
		case 'vencido':
			$estado_presupuesto = 2;
			break;
		case 'generar':
			$estado_presupuesto = 3;
			break;
		case 'rechazado':
			$estado_presupuesto = 4;
			break;
		case 'generar_2':
			$estado_presupuesto = 5;
			break;
		case 'aceptado':
			$estado_presupuesto = 3;
			break;

	}
	$presupuesto=new presupuesto();

	//Vamos a dar vuelta los campos fechas
	if($fecemi_presupuesto != ''){
		$arr = explode('-',$fecemi_presupuesto);
		$fecemi_presupuesto = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
	}

	$presupuesto->set_id_presupuesto(		$id_presupuesto);
	$presupuesto->set_id_vehiculo(			$id_vehiculo);
	$presupuesto->set_id_cliente(			$id_cliente);
	$presupuesto->set_num_presupuesto(		$num_presupuesto);
	$presupuesto->set_total_presupuesto(	$total_presupuesto);
	$presupuesto->set_obs_presupuesto(		$obs_presupuesto);
	$presupuesto->set_fecemi_presupuesto(	$fecemi_presupuesto);
	//esto lo hago para no cagar el estado del presupuesto. 5 es generar remito y 3 es generar OR pero 3 también es Aceptado para el presu
	if($estado_presupuesto == 5)
		$presupuesto->set_estado_presupuesto(3);
	else
		$presupuesto->set_estado_presupuesto(	$estado_presupuesto);
	$presupuesto->set_descrip_vc(			$descrip_vc);
	$presupuesto->set_id_vozcliente(		$id_vozcliente);
	$presupuesto->set_contacto_vc(			$contacto_vc);
	$presupuesto->set_kms_presupuesto(		$kms_presupuesto);
	$presupuesto->set_descto_presupuesto(	$descto_presupuesto);

	$ret=$presupuesto->updatePresupuesto($presupuesto);
	$out=$ret['rows_affected'][0];

	//mano de obra
	$presupuesto->resetManoObra($id_presupuesto);
	$presupuesto->setManoObra($importe_MO, $descrip_MO, $id_presupuesto);
	//mano de obra 2
	$presupuesto->setManoObra($importe_MO2, $descrip_MO2, $id_presupuesto);

	//torneria
	$presupuesto->setTorneria($importe_TO, $descrip_TO, $id_presupuesto);

	//voz de cliente
	$vozcliente = new vozcliente_1();
	$vozcliente->usarVozcliente($presupuesto->_id_vozcliente);

	//creo una instancia de la clase detalle
	$clsDetPresupuesto=new detalle_presupuesto();
	$clsDetPresupuesto->deleteDetalle_presupuesto($id_presupuesto);

	//ahora declaro variable general para el array de productos
	$arr_id_producto="";//tipo cadena

	$detalle=$_POST['Detalle'];
	$dt_aux=array();
	$dt_data=array();
 	foreach($detalle as $dt_aux){
   		$dt_data[]=$dt_aux;
 	}
	 //ahora esta listo para guardar detalle de la presupuesto de reparacion
	 //ahora modelo kardex
	foreach($dt_data as $accion){
		if($accion['id'] != '0' && $accion['id'] != '-1' && $accion['id'] != '-2') {
			$clsDetPresupuesto = new detalle_presupuesto();

			$clsDetPresupuesto->set_id_presupuesto(			$id_presupuesto		);
			$clsDetPresupuesto->set_id_producto(			$accion['id']		);
			$clsDetPresupuesto->set_canti_detpresupuesto(	$accion['cantidad']	);
			$clsDetPresupuesto->set_precio_detpresupuesto(	$accion['precio']	);
			$clsDetPresupuesto->set_estado_detpresupuesto(	"1"					);

			$arr_id_producto=$arr_id_producto.$accion['id'].'-';

			//insertamos detalle de la presupuesto de reparacion
			$out=$clsDetPresupuesto->addDetalle_presupuesto($clsDetPresupuesto);

			if($estado_presupuesto == 4)
			{
				$clsDetPresupuesto->descontarStock($clsDetPresupuesto);
			}
		}
	}

	//tengo que generar la orden de reparacion
	if($estado_presupuesto == 3)
	{
		$presupuesto->generarOrdenReparacion($id_presupuesto);
	}
	//tengo que generar el remito
	if($estado_presupuesto == 5)
	{
		$presupuesto->generarRemito($id_presupuesto);
	}

	$out=$presupuesto->json("1", "Los datos se han actualizado correctamente.");
	break;

case '3' : //delete
	// Todos los POST que interviene Delete.
	$id_remi=$_POST['delete_id_remi'];
	$remito=new remito();
	$ret=$remito->deleteRemito($id_remi);
	$out=$ret['rows_affected'][0];
	break;

case '4' : //show
// Todos los POST que interviene Show.
	$id_remi=$_POST['show_id_remi'];
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

//reporte de remitos
case '8'://cabecera mediante fechas
 	$clsRemito=new remito();
   $fecIni=$_POST['fec_ini'];
   $fecFinal=$_POST['fec_final'];
 	$out=$clsRemito->listJsonRemito($fecIni, $fecFinal);
	break;

case '9'://detalle de remito
	$clsRemito=new remito();
 	$id_remi=$_POST['id_remi'];
 	$out=$clsRemito->listJsonRemitoDetalle($id_remi);
	break;

case '10': //remitos para facturas
	$wRemito = new W_remito();
	$id_cli = $_POST['id_cli'];
	$out = $wRemito->printremitosCliente($id_cli);
	break;

case '11'://detalle de remito
	$clsPresupuesto=new presupuesto();
 	$id_presupuesto=$_POST['id_presupuesto'];
 	$out=$clsPresupuesto->listJsonPresupuestoDetalleFactura($id_presupuesto);
	break;
case '12'://proximo numero de presupuesto de reparacion
	$clsPresupuesto=new presupuesto();
 	$out=$clsPresupuesto->getProximoPresupuesto();
	break;
case '13': //presupuesto para modificar
	$id_presupuesto = $_POST['id_presupuesto'];
	$clsPresupuesto = new presupuesto();
	$clsDetallePresupuesto = new detalle_presupuesto();
//	$clsPresupuesto = $clsPresupuesto->showPresupuesto($id_presupuesto);
	$clsPresupuesto = $clsPresupuesto->showPresupuestoEdit($id_presupuesto);
	if($clsPresupuesto['estado'] == "Pendiente")
	{
		$clsPresupuesto['detalle'] = $clsDetallePresupuesto->showDetalle_presupuesto_vista_edit($id_presupuesto);
	}
	else
	{
		$clsPresupuesto['detalle'] = $clsDetallePresupuesto->showDetalle_presupuesto_vista($id_presupuesto);
	}
	$out=json_encode($clsPresupuesto);
	break;

case '14':
	$wRemito = new W_remito();
	$out = $wRemito->printPresupuestos();
	break;
}

die($out);

?>
