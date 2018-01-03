<?php 

// Capa de Acceso a BD.

include 'C_Debug.php';
include '../DAC/Database.class.php';
include '../MODEL/Cheque.php'; 

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
	$id_vozcliente		= 0;
//	$id_vozcliente		= $_GET['save_id_vozcliente'];
	
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
//	$id_vozcliente		= $_GET['save_id_vozcliente'];
	
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

case '4':
	$cheque = new cheque();
	$ret = $cheque->getChequesDisponibles();
	
	$out = json_encode($ret);
	break;

case '13': //Cheque para ver el detalle
	$id_cheque = $_POST['id_cheque'];
	$clsCheque = new cheque();
	$clsCheque = $clsCheque->showCheque($id_cheque);
	$out=json_encode($clsCheque);
	break;
	
case '14':
	$id_cheque = $_POST['idcheque'];
	$clsCheque = new cheque();
	$ret = $clsCheque->depositar($id_cheque);
	$out = json_encode("ok");
	break;
}

die($out); 

?>
