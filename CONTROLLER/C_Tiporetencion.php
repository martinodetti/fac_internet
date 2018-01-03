<?php 



// Capa de Seguridadinclude 'Seguridad.php'; 

// Capa de Acceso a BD.

include '../DAC/Database.class.php';

include '../MODEL/Tiporetencion.php'; 

include '../VIEW/W_Tiporetencion.php'; 

$out; 

$opc=$_POST['opc']; 

switch ($opc) { 

case '1': //add 

// Todos los POST que interviene. 

$id_tiporeten=0; 

$cod_codRetAir=$_POST['save_cod_codRetAir']; 
$nom_codRetAir=$_POST['save_nom_codRetAir']; 
$porcentaje_codRetAir=$_POST['save_porcentaje_codRetAir']; 
$tiporetencion=new tiporetencion();
$tiporetencion->set_cod_codRetAir($cod_codRetAir);
$tiporetencion->set_nom_codRetAir($nom_codRetAir);
$tiporetencion->set_porcentaje_codRetAir($porcentaje_codRetAir);
$ret=$tiporetencion->addTiporetencion($tiporetencion);
$out=$ret['0'][0]; 
 break; 
case '2' : //update 

// Todos los POST que interviene en Update. 

$id_tiporeten=$_POST['update_id_tiporeten']; 

$cod_codRetAir=$_POST['update_cod_codRetAir']; 

$nom_codRetAir=$_POST['update_nom_codRetAir']; 

$porcentaje_codRetAir=$_POST['update_porcentaje_codRetAir']; 



$tiporetencion=new tiporetencion();

$tiporetencion->set_id_tiporeten($id_tiporeten);

$tiporetencion->set_cod_codRetAir($cod_codRetAir);

$tiporetencion->set_nom_codRetAir($nom_codRetAir);

$tiporetencion->set_porcentaje_codRetAir($porcentaje_codRetAir);

$ret=$tiporetencion->updateTiporetencion($tiporetencion); 

$out=$ret['rows_affected'][0]; 

 break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 

    $id_tiporeten = $_POST['delete_id_tiporeten'];
    $tiporetencion = new tiporetencion();
    $val = $tiporetencion->puedeEliminar($id_tiporeten);
    if ($val == 0) {
        $ret = $tiporetencion->deleteTiporetencion($id_tiporeten);
        $out = $tiporetencion->json("1", "Registro eliminado sactisfactoriamente.");
    } else {
        $out = $tiporetencion->json("0", "No se ha podido eliminar.");
    }

 break; 

case '4' : //show 

// Todos los POST que interviene Show. 

$id_tiporeten=$_POST['show_id_tiporeten']; 

$W_tiporetencion=new W_tiporetencion();

$out=$W_tiporetencion->printTiporetencion($id_tiporeten);

 break; 

case '5' : //print mesas 
$W_tiporetencion=new W_tiporetencion();
$descrip=$_POST['show_retencion'];
$out=$W_tiporetencion->printTiporetencions($descrip);
 break; 

case '6' : //print mesas 
$W_tiporetencion=new W_tiporetencion();
$descrip=$_POST['show_retencion_delete'];
$out=$W_tiporetencion->printTiporetencionsDelete($descrip);
 break; 

}

 

die($out); 



?>
