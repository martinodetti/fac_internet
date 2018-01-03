<?php 

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.
include '../DAC/Database.class.php';
include '../MODEL/Detalle_compra.php'; 
include '../VIEW/W_Detalle_compra.php'; 

$out=""; 
$opc=$_POST['opc']; 
switch ($opc) { 
case '1': //add 

// Todos los POST que interviene. 

$id_detcompra=$_POST['save_id_detcompra']; 

$id_compra=$_POST['save_id_compra']; 

$id_producto=$_POST['save_id_producto']; 

$costouni_detcompra=$_POST['save_costouni_detcompra']; 

$canti_detcompra=$_POST['save_canti_detcompra']; 

$estado_detcompra=$_POST['save_estado_detcompra']; 



$detalle_compra=new detalle_compra();

$detalle_compra->set_id_compra($id_compra);

$detalle_compra->set_id_producto($id_producto);

$detalle_compra->set_costouni_detcompra($costouni_detcompra);

$detalle_compra->set_canti_detcompra($canti_detcompra);

$detalle_compra->set_estado_detcompra($estado_detcompra);

$ret=$detalle_compra->addDetalle_compra($detalle_compra);$out=$ret['0'][0]; 

 break; 

case '2' : //update 

// Todos los POST que interviene en Update. 

$id_detcompra=$_POST['update_id_detcompra']; 

$id_compra=$_POST['update_id_compra']; 

$id_producto=$_POST['update_id_producto']; 

$costouni_detcompra=$_POST['update_costouni_detcompra']; 

$canti_detcompra=$_POST['update_canti_detcompra']; 

$estado_detcompra=$_POST['update_estado_detcompra']; 



$detalle_compra=new detalle_compra();

$detalle_compra->set_id_detcompra($id_detcompra);

$detalle_compra->set_id_compra($id_compra);

$detalle_compra->set_id_producto($id_producto);

$detalle_compra->set_costouni_detcompra($costouni_detcompra);

$detalle_compra->set_canti_detcompra($canti_detcompra);

$detalle_compra->set_estado_detcompra($estado_detcompra);

$ret=$detalle_compra->updateDetalle_compra($detalle_compra); 

$out=$ret['rows_affected'][0]; 

 break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 

$id_detcompra=$_POST['delete_id_detcompra']; 



$detalle_compra=new detalle_compra();

$ret=$detalle_compra->deleteDetalle_compra($id_detcompra); 

$out=$ret['rows_affected'][0]; 

 break; 

case '4' : //show 

// Todos los POST que interviene Show. 

$id_detcompra=$_POST['show_id_detcompra']; 

$W_detalle_compra=new W_detalle_compra();

$out=$W_detalle_compra->printDetalle_compra($id_detcompra);

 break; 

case '5' : //print mesas 

$W_detalle_compra=new W_detalle_compra();

$out=$W_detalle_compra->printDetalle_compras($fecIni,$fecFinal);

 break; 

}

 

die($out); 



?>
