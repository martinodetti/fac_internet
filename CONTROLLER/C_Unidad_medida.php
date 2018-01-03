<?php 


// Capa de Seguridadinclude 'Seguridad.php'; 

// Capa de Acceso a BD.

include '../DAC/Database.class.php';

include '../MODEL/Unidad_medida.php'; 

include '../VIEW/W_Unidad_medida.php'; 

$out; 

$opc=$_POST['opc']; 

switch ($opc) { 

case '1': //add 

// Todos los POST que interviene. 

$id_unimedida=0; 
$nom_unimedida=$_POST['save_nom_unimedida']; 
$unidad_medida=new unidad_medida();
$unidad_medida->set_nom_unimedida($nom_unimedida);
$ret=$unidad_medida->addUnidad_medida($unidad_medida);
$out=$ret['0'][0]; 

 break; 

case '2' : //update 
// Todos los POST que interviene en Update. 
$id_unimedida=$_POST['update_id_unimedida']; 
$nom_unimedida=$_POST['update_nom_unimedida']; 

$unidad_medida=new unidad_medida();
$unidad_medida->set_id_unimedida($id_unimedida);
$unidad_medida->set_nom_unimedida($nom_unimedida);
$ret=$unidad_medida->updateUnidad_medida($unidad_medida); 
$out=$ret['rows_affected'][0]; 
 break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 

$id_unimedida=$_POST['delete_id_unimedida']; 
$unidad_medida=new unidad_medida();
$val=$unidad_medida->puedeEliminar($id_unimedida);
 if($val==0){
   $ret=$unidad_medida->deleteUnidad_medida($id_unimedida); 
   $out=$unidad_medida->json("1", "Registro eliminado sactisfactoriamente.");
 }else{
    $out=$unidad_medida->json("0", "No se ha podido eliminar.");  
 }
 break; 

case '4' : //show 

// Todos los POST que interviene Show. 

$id_unimedida=$_POST['show_id_unimedida']; 

$W_unidad_medida=new W_unidad_medida();

$out=$W_unidad_medida->printUnidad_medida($id_unimedida);

 break; 

case '5' : //print mesas 

$W_unidad_medida=new W_unidad_medida();
$medida=$_POST['show_unidad_medida'];
$out=$W_unidad_medida->printUnidad_medidasPorNombre($medida);

 break; 
case '6' : //print mesas 

$W_unidad_medida=new W_unidad_medida();
$medida=$_POST['show_medida_delete'];
$out=$W_unidad_medida->printUnidad_medidasPorNombreDelete($medida);

 break; 

}

 

die($out); 



?>
