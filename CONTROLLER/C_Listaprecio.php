<?php

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.
include '../DAC/Database.class.php';
include '../MODEL/Listaprecio.php';
include '../VIEW/W_Listaprecio.php';

$out = '';

$opc = $_POST['opc'];

switch ($opc) {

    case '1': //add 
// Todos los POST que interviene. 
        $id_listaprecio = 0;
        $porcentaje_listaprecio = $_POST['save_porcentaje_listaprecio'];
        $nombre_listaprecio = $_POST['save_nombre_listaprecio'];
        $listaprecio = new listaprecio();
        $listaprecio->set_porcentaje_listaprecio($porcentaje_listaprecio);
        $listaprecio->set_nombre_listaprecio($nombre_listaprecio);
        $ret = $listaprecio->addListaprecio($listaprecio);
        $out = $ret['0'][0];

        break;

    case '2' : //update 
// Todos los POST que interviene en Update. 
        $id_listaprecio = $_POST['update_id_listaprecio'];
        $porcentaje_listaprecio = $_POST['update_porcentaje_listaprecio'];
        $nombre_listaprecio = $_POST['update_nombre_listaprecio'];
        $listaprecio = new listaprecio();
        $listaprecio->set_id_listaprecio($id_listaprecio);
        $listaprecio->set_porcentaje_listaprecio($porcentaje_listaprecio);
        $listaprecio->set_nombre_listaprecio($nombre_listaprecio);
        $ret = $listaprecio->updateListaprecio($listaprecio);
        $out = $ret['rows_affected'][0];

        break;

    case '3' : //delete 
// Todos los POST que interviene Delete. 

        $id_listaprecio = $_POST['delete_id_listaprecio'];
        $listaprecio = new listaprecio();
        $val=$listaprecio->puedeEliminar($id_listaprecio);

        if($val==0){
        $ret = $listaprecio->deleteListaprecio($id_listaprecio);
        $out=$listaprecio->json("1", "Registro eliminado sactisfactoriamente.");
        }else{
           $out=$listaprecio->json("0", "No se ha podido eliminar.");
        }

        break;

    case '4' : //show 
// Todos los POST que interviene Show. 

        $id_listaprecio = $_POST['show_id_listaprecio'];
        $W_listaprecio = new W_listaprecio();
        $out = $W_listaprecio->printListaprecio($id_listaprecio);
        break;

    case '5' : //print mesas 
        $porcentaje=$_POST['show_porcentaje_listaprecio'];
        $W_listaprecio = new W_listaprecio();
        $out = $W_listaprecio->printListapreciosPorPorcentaje($porcentaje);
        break;
    case '6' : //print mesas_delete 
        $porcentaje=$_POST['show_porcentaje_listaprecio_delete'];
        $W_listaprecio = new W_listaprecio();
        $out = $W_listaprecio->printListapreciosPorPorcentajeDelete($porcentaje);
        break;
}



die($out);
?>
