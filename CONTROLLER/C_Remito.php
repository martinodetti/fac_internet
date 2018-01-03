<?php

// Capa de Acceso a BD.

include 'C_Debug.php';
include '../DAC/Database.class.php';
include_once '../MODEL/Remito.php';
include '../MODEL/Detalle_remito.php';
include '../MODEL/Producto.php';
include '../VIEW/W_Detalle_remito.php';
include '../VIEW/W_Remito.php';

$out="";
if(isset ($_POST['opc']))
$opc=$_POST['opc'];
else
$opc=$_GET['opc'];

switch ($opc) {
case '1': //add

// Todos los POST que interviene.
	$id_remi		= 0;
	$id_orden		= 0; //$_GET['save_id_orden'];  esto es temporal hasta que traiga el combo de ordenes
	$id_vehiculo	= $_GET['save_id_vehiculo'];
	$id_vendedor	= $_GET['save_id_vendedor'];
	$id_cliente		= $_GET['save_id_cliente'];
	$num_remi		= $_GET['save_num_remi'];
	$total_remi		= $_GET['save_total_remi'];
//	$total_remi		= 0; ¿¿¿¿ por qué carajo había hecho esto?????
	$obs_remi		= $_GET['save_obs_remi'];
	$fecemi_remi	= $_GET['save_fecemi_remi'];
	$importe_MO		= $_GET['txt_importe_manoobra'];
	$descrip_MO		= $_GET['txt_descripcion_manoobra'];
	$estado_remi	= "1";


	$remito=new remito();

// Aca antes habia 2 validaciones que no me hicieron falta
// Las saqué de esta manera para no tener que acomodar el codigo mas abajo
	if(true){
		if(true){
			$remito->set_id_orden(		$id_orden);
			$remito->set_id_vehiculo(	$id_vehiculo);
			$remito->set_id_vendedor(	$id_vendedor);
			$remito->set_id_cliente(	$id_cliente);
			$remito->set_num_remi(		$num_remi);
			$remito->set_total_remi(	$total_remi);
			$remito->set_obs_remi(		$obs_remi);
			$remito->set_fecemi_remi(	$fecemi_remi);
			$remito->set_estado_remi(	$estado_remi);
			$ret=$remito->addremito(	$remito);
			$id_remi=$ret['0'][0]; //last_id de remito

			//mano de obra
			$remito->setManoObra($importe_MO, $descrip_MO, $id_remi);

			//creo una instancia de la clase detalle
			$clsDetRemito=new detalle_remito();

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
				if($accion['id'] != '0') {
					$clsDetRemito = new detalle_remito();

					$clsDetRemito->set_id_remi($id_remi);
					$clsDetRemito->set_id_producto($accion['id']);
					$clsDetRemito->set_canti_detremi($accion['cantidad']);
//					$clsDetRemito->set_precio_detremi(0); //para guardar remitos sin importe de productos
					$clsDetRemito->set_precio_detremi($accion['precio']);
					$clsDetRemito->set_estado_detremi("1");
					$arr_id_producto=$arr_id_producto.$accion['id'].'-';

					//insertamos detalle factura
					$out=$clsDetRemito->addDetalle_remito($clsDetRemito);
				}
			}
		 	$out=$remito->json("1", "Los datos se han guardado correctamente.");
	   }else{
	   	$out=$factura->json("1", "Primer else");
		}
	}else{
		$out=$factura->json("1", "Segundo else");
	}
	break;

case '2' : //update
// Todos los POST que interviene en Update.

	$id_remi		= $_GET['save_num_remi'];
	$id_orden		= 0; //$_GET['save_id_orden'];  esto es temporal hasta que traiga el combo de ordenes
	$id_vehiculo	= $_GET['save_id_vehiculo'];
	$id_vendedor	= $_GET['save_id_vendedor'];
	$id_cliente		= $_GET['save_id_cliente'];
	$num_remi		= $_GET['save_num_remi'];
	$total_remi		= $_GET['save_total_remi'];
//	$total_remi		= 0; ¿¿¿¿ por qué carajo había hecho esto?????
	$obs_remi		= $_GET['save_obs_remi'];
	$fecemi_remi	= $_GET['save_fecemi_remi'];
	$importe_MO		= $_GET['txt_importe_manoobra'];
	$descrip_MO		= $_GET['txt_descripcion_manoobra'];
	$estado_remi	= "1";

	$remito=new remito();
	$remito->set_id_remi(		$id_remi);
	$remito->set_id_vehiculo(	$id_vehiculo);
	$remito->set_id_vendedor(	$id_vendedor);
	$remito->set_id_cliente(	$id_cliente);
	$remito->set_num_remi(		$num_remi);
	$remito->set_total_remi(	$total_remi);
	$remito->set_obs_remi(		$obs_remi);
	$remito->set_fecemi_remi(	$fecemi_remi);
	$remito->set_estado_remi(	$estado_remi);

	$ret=$remito->updateRemito($remito);
	$out=$ret['rows_affected'][0];


	//mano de obra
	$remito->setManoObra($importe_MO, $descrip_MO, $id_remi);

	//creo una instancia de la clase detalle
	$clsDetRemito=new detalle_remito();

	//ahora declaro variable general para el array de productos
	$arr_id_producto="";//tipo cadena

	$detalle=$_POST['Detalle'];
	$dt_aux=array();
	$dt_data=array();
 	foreach($detalle as $dt_aux){
   		$dt_data[]=$dt_aux;
 	}
	 //ahora esta listo para guardar detalle del remito
	 //primero borramos lo viejo para meter lo nuevo
	 $clsDetRemito->deleteDetalle_remito($id_remi);

	foreach($dt_data as $accion){
		if($accion['id'] != '0') {
			$clsDetRemito = new detalle_remito();

			$clsDetRemito->set_id_remi($id_remi);
			$clsDetRemito->set_id_producto($accion['id']);
			$clsDetRemito->set_canti_detremi($accion['cantidad']);
//					$clsDetRemito->set_precio_detremi(0); //para guardar remitos sin importe de productos
			$clsDetRemito->set_precio_detremi($accion['precio']);
			$clsDetRemito->set_estado_detremi("1");
			$arr_id_producto=$arr_id_producto.$accion['id'].'-';

			//insertamos detalle factura
			$out=$clsDetRemito->addDetalle_remito($clsDetRemito);
		}
	}

	$out=$remito->json("1", "Los datos se han guardado correctamente.");

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
	$clsRemito=new remito();
 	$id_remi=$_POST['id_remi'];
 	$out=$clsRemito->listJsonRemitoDetalleFactura($id_remi);
	break;
case '12'://proximo numero de remito
	$clsRemito=new remito();
 	$out=$clsRemito->getProximoRemito();
	break;
case '13': //remito para ver
	$id_remito = $_POST['id_remito'];
	$clsRemito = new remito();
//	$clsDetalleRemito = new detalle_remito();
//	$clsOrden = $clsOrden->showOrden($id_orden);
	$clsRemito = $clsRemito->showRemitoEdit($id_remito);
//	$clsRemito['detalle'] = $clsDetalleRemito->showDetalle_remito_vista($id_remito);
	$out=json_encode($clsRemito);
	break;

case '14':
	$id_remito = $_GET['id_remito'];
	$clsRemito = new remito();
	$out = json_encode($clsRemito->generarPresupuesto($id_remito));
	break;

case '15':
	$id_remito = $_GET['id_remito'];
	$clsRemito = new remito();
	$out = json_encode($clsRemito->existePresupuestoCreado($id_remito));
	break;

case '16':
	$id_remi = $_POST['id_remi'];
	$clsremi = new remito();
	$out = json_encode($clsremi->anular($id_remi));
	break;
case '17':
	$id_remi = $_POST['id_remi'];
	$clsremi = new remito();
	$out = json_encode($clsremi->reAbrir($id_remi));
	break;
}
 die($out);
?>
