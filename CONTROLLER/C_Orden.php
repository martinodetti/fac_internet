<?php 

// Capa de Acceso a BD.

include 'C_Debug.php';
include '../DAC/Database.class.php';
include '../MODEL/Orden.php'; 
include '../MODEL/Detalle_orden.php'; 
include '../MODEL/Producto.php'; 
include '../MODEL/Vozcliente_1.php';

//include '../VIEW/W_Detalle_orden.php';
//include '../VIEW/W_Orden.php';

$out=""; 
if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc'];  

switch ($opc) { 
case '1': //add 

// Todos los POST que interviene. 
	$id_orden			= $_GET['save_num_orden'];
//	if(!isset($_GET['save_id_orden'])
//		$id_orden  $_GET['save_num_orden'];  
	$id_vehiculo		= $_GET['save_id_vehiculo'];
	$id_cliente			= $_GET['save_id_cliente'];
	$num_orden			= $_GET['save_num_orden'];
	$total_orden		= $_GET['save_total_orden']; 
	$obs_orden			= $_GET['save_obs_orden']; 
	$fecemi_orden		= $_GET['save_fecemi_orden']; 
	$fecingreso_orden	= $_GET['save_fecingreso_orden']; 
	$fecegreso_orden	= $_GET['save_fecegreso_orden']; 
	$importe_MO			= $_GET['txt_importe_manoobra'];
	$descrip_MO			= $_GET['txt_descripcion_manoobra'];
	$importe_MO2		= $_GET['txt_importe_manoobra2'];
	$descrip_MO2		= $_GET['txt_descripcion_manoobra2'];
	$importe_TO			= $_GET['txt_importe_torneria'];
	$descrip_TO			= $_GET['txt_descripcion_torneria'];
	$descrip_vc			= $_GET['txt_detalle_vozcliente'];
	$contacto_vc		= $_GET['txt_contacto_vozcliente'];
	$kms_orden			= $_GET['save_kms_orden'];
	$id_vozcliente		= 0;
//	$id_vozcliente		= $_GET['save_id_vozcliente'];
	$id_responsable		= $_GET['save_id_responsable'];
	
	if($_GET['tipo_guardar'] == 'abierto') {
		$estado_orden		= "1"; 
	} else {
		$estado_orden		= "2";
	} 
	

	$orden=new orden();

// Aca antes habia 2 validaciones que no me hicieron falta
// Las saqué de esta manera para no tener que acomodar el codigo mas abajo
	if(true){
		if(true){
		
			//Vamos a dar vuelta los campos fechas
			if($fecemi_orden != ''){
				$arr = explode('-',$fecemi_orden);
				$fecemi_orden = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
			}
			if($fecingreso_orden != ''){
				$arr = explode('-',$fecingreso_orden);
				$fecingreso_orden = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
			}
			if($fecegreso_orden != ''){
				$arr = explode('-',$fecegreso_orden);
				$fecegreso_orden = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
			}
		
			$orden->set_id_orden(			$id_orden);
			$orden->set_id_vehiculo(		$id_vehiculo);
			$orden->set_id_cliente(			$id_cliente);
			$orden->set_num_orden(			$num_orden);
			$orden->set_total_orden(		$total_orden);
			$orden->set_obs_orden(			$obs_orden);
			$orden->set_fecemi_orden(		$fecemi_orden);
			$orden->set_fecingreso_orden(	$fecingreso_orden);
			$orden->set_fecegreso_orden(	$fecegreso_orden);
			$orden->set_estado_orden(		$estado_orden);
			$orden->set_descrip_vc(			$descrip_vc);
			$orden->set_contacto_vc(		$contacto_vc);
			$orden->set_id_vozcliente(		$id_vozcliente);
			$orden->set_id_responsable(		$id_responsable);
			$orden->set_kms_orden(			$kms_orden);
			$ret=$orden->addorden(			$orden);
		
			$id_orden=$ret['0'][0]; //last_id de orden de reparacion
		
		
			//mano de obra
			$orden->resetManoObra($id_orden);
			$orden->setManoObra($importe_MO, $descrip_MO, $id_orden);
			$orden->setManoObra($importe_MO2, $descrip_MO2, $id_orden);
			
			//torneria
			$orden->setTorneria($importe_TO, $descrip_TO, $id_orden);
			
			//voz de cliente
			$vozcliente = new vozcliente_1();
			$vozcliente->usarVozcliente($orden->_id_vozcliente);
		
			//creo una instancia de la clase detalle
			$clsDetOrden=new detalle_orden();

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
					$clsDetOrden = new detalle_orden();
				
					$clsDetOrden->set_id_orden($id_orden);
					$clsDetOrden->set_id_producto($accion['id']);
					$clsDetOrden->set_canti_detorden($accion['cantidad']);
					$clsDetOrden->set_precio_detorden($accion['precio']);
					$clsDetOrden->set_estado_detorden("1");
					$arr_id_producto=$arr_id_producto.$accion['id'].'-';

					//insertamos detalle factura
					$out=$clsDetOrden->addDetalle_orden($clsDetOrden);
				}
			}
		 	$out=$orden->json("1", "Los datos se han guardado correctamente.");
	   }else{
	   	$out=$orden->json("1", "Primer else");
		}
	}else{
		$out=$orden->json("1", "Segundo else");
	}
	break; 

case '2' : //update 
// Todos los POST que interviene en Update. 
	$id_orden			= $_GET['save_num_orden'];  
	$id_vehiculo		= $_GET['save_id_vehiculo'];
	$id_cliente			= $_GET['save_id_cliente'];
	$num_orden			= $_GET['save_num_orden'];
	$total_orden		= $_GET['save_total_orden']; 
	$obs_orden			= $_GET['save_obs_orden']; 
	$fecemi_orden		= $_GET['save_fecemi_orden']; 
	$fecingreso_orden	= $_GET['save_fecingreso_orden']; 
	$fecegreso_orden	= $_GET['save_fecegreso_orden']; 
	$importe_MO			= $_GET['txt_importe_manoobra'];
	$descrip_MO			= $_GET['txt_descripcion_manoobra'];
	$importe_MO2		= $_GET['txt_importe_manoobra2'];
	$descrip_MO2		= $_GET['txt_descripcion_manoobra2'];
	$importe_TO			= $_GET['txt_importe_torneria'];
	$descrip_TO			= $_GET['txt_descripcion_torneria'];
	$descrip_vc			= $_GET['txt_detalle_vozcliente'];
	$contacto_vc		= $_GET['txt_contacto_vozcliente'];
	$id_vozcliente		= 0;
	$id_responsable		= $_GET['save_id_responsable'];
//	$id_vozcliente		= $_GET['save_id_vozcliente'];
	$kms_orden			= $_GET['save_kms_orden'];

	if($_GET['tipo_guardar'] == 'abierto') {
		$estado_orden		= "1"; 
	} else {
		$estado_orden		= "2";
	}
	$orden=new orden();
	
	//Vamos a dar vuelta los campos fechas
	if($fecemi_orden != ''){
		$arr = explode('-',$fecemi_orden);
		$fecemi_orden = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
	}
	if($fecingreso_orden != ''){
		$arr = explode('-',$fecingreso_orden);
		$fecingreso_orden = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
	}
	if($fecegreso_orden != ''){
		$arr = explode('-',$fecegreso_orden);
		$fecegreso_orden = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
	}

	$orden->set_id_orden(			$id_orden);
	$orden->set_id_vehiculo(		$id_vehiculo);
	$orden->set_id_cliente(			$id_cliente);
	$orden->set_num_orden(			$num_orden);
	$orden->set_total_orden(		$total_orden);
	$orden->set_obs_orden(			$obs_orden);
	$orden->set_fecemi_orden(		$fecemi_orden);
	$orden->set_fecingreso_orden(	$fecingreso_orden);
	$orden->set_fecegreso_orden(	$fecegreso_orden);
	$orden->set_estado_orden(		$estado_orden);
	$orden->set_descrip_vc(			$descrip_vc);
	$orden->set_id_vozcliente(		$id_vozcliente);
	$orden->set_contacto_vc(		$contacto_vc);
	$orden->set_id_responsable(		$id_responsable);
	$orden->set_kms_orden(			$kms_orden);

	$ret=$orden->updateOrden($orden); 
	$out=$ret['rows_affected'][0]; 
	
	$orden->resetManoObra($id_orden);
	$orden->setManoObra($importe_MO, $descrip_MO, $id_orden);
	$orden->setManoObra($importe_MO2, $descrip_MO2, $id_orden);
	
	//torneria
	$orden->setTorneria($importe_TO, $descrip_TO, $id_orden);
	
	//voz de cliente
	$vozcliente = new vozcliente_1();
	$vozcliente->usarVozcliente($orden->_id_vozcliente);
	
	//creo una instancia de la clase detalle
	$clsDetOrden=new detalle_orden();
	$clsDetOrden->deleteDetalle_orden($id_orden); 

	//ahora declaro variable general para el array de productos
	$arr_id_producto="";//tipo cadena
		
	$detalle=$_POST['Detalle'];
	$dt_aux=array();
	$dt_data=array();   
 	foreach($detalle as $dt_aux){
   		$dt_data[]=$dt_aux;  
 	}
	 //ahora esta listo para guardar detalle de la orden de reparacion
	 //ahora modelo kardex
	foreach($dt_data as $accion){
		if($accion['id'] != '0' && $accion['id'] != '-1' && $accion['id'] != '-2') {
			$clsDetOrden = new detalle_orden();
		
			$clsDetOrden->set_id_orden(			$id_orden			);
			$clsDetOrden->set_id_producto(		$accion['id']		);
			$clsDetOrden->set_canti_detorden(	$accion['cantidad']	);
			$clsDetOrden->set_precio_detorden(	$accion['precio']	);
			$clsDetOrden->set_estado_detorden(	"1"					);

			$arr_id_producto=$arr_id_producto.$accion['id'].'-';

			//insertamos detalle de la orden de reparacion
			$out=$clsDetOrden->addDetalle_orden($clsDetOrden);
		}
	}

	$out=$orden->json("1", "Los datos se han actualizado correctamente.");
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
	$clsOrden=new orden();
 	$id_orden=$_POST['id_orden'];   
 	$out=$clsOrden->listJsonOrdenDetalleFactura($id_orden);
	break;

case '12'://proximo numero de orden de reparacion
	$clsOrden=new orden();
 	$out=$clsOrden->getProximoOrden();
	break;
case '13': //orden de reparacion para modificar
	$id_orden = $_POST['id_orden'];
	$clsOrden = new orden();
	$clsDetalleOrden = new detalle_orden();
//	$clsOrden = $clsOrden->showOrden($id_orden);
	$clsOrden = $clsOrden->showOrdenEdit($id_orden);
	if($clsOrden['estado'] != "Cobrado" && $clsOrden['estado'] != "Facturado") //Las abiertas y las cerradas se muestran con el precio actual del produccto
	{
		$clsOrden['detalle'] = $clsDetalleOrden->showDetalle_orden_vista_edit($id_orden);
	}
	else //Las cobradas se muestran con el precio facturado en ese momento
	{
		$clsOrden['detalle'] = $clsDetalleOrden->showDetalle_orden_vista($id_orden);
	}
	$out=json_encode($clsOrden);
	break;
	
case '14':
	$id_orden = $_GET['id_orden'];
	$clsOrden = new orden();
	$out = json_encode($clsOrden->generarPresupuesto($id_orden));
	break;
	
case '15':
	$id_orden = $_GET['id_orden'];
	$clsOrden = new orden();
	$out = json_encode($clsOrden->existePresupuestoCreado($id_orden));
	break;	
	
case '16':
	$id_orden = $_GET['id_orden'];
	$obs = $_GET['obs'];
	$clsOrden = new orden();
	$out = json_encode($clsOrden->anularOrden($id_orden, $obs));
	break;
	
}

die($out); 

?>
