<?php

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.

include '../DAC/Database.class.php';
include '../MODEL/Marca_producto.php';
include '../VIEW/W_Marca_producto.php';

$out = "";
$opc = $_POST['opc'];
switch ($opc) {

    case '1': //add 
// Todos los POST que interviene. 
        $id_marca = 0;
        $nom_marca = $_POST['save_nom_marca'];
        $marca_producto = new marca_producto();
        $marca_producto->set_nom_marca($nom_marca);
        $ret = $marca_producto->addMarca_producto($marca_producto);
        $out = $ret['0'][0];
        break;

    case '2' : //update 
// Todos los POST que interviene en Update. 
        $id_marca = $_POST['update_id_marca'];
        $nom_marca = $_POST['update_nom_marca'];
        $marca_producto = new marca_producto();
        $marca_producto->set_id_marca($id_marca);
        $marca_producto->set_nom_marca($nom_marca);
        $ret = $marca_producto->updateMarca_producto($marca_producto);
        $out = $ret['rows_affected'][0];
        break;

    case '3' : //delete 
// Todos los POST que interviene Delete. 
        $id_marca = $_POST['delete_id_marca'];
        $marca_producto = new marca_producto();
        $val=$marca_producto->puedeEliminar($id_marca);
        if($val==0){
        $ret = $marca_producto->deleteMarca_producto($id_marca);
          $out = $marca_producto->json("1", "Registro eliminado sactisfactoriamente.");
        }else{
          $out=$marca_producto->json("0", "No se ha podido eliminar.");
        }
      
        break;

    case '4' : //show 
// Todos los POST que interviene Show. 
        $id_marca = $_POST['show_id_marca'];
        $W_marca_producto = new W_marca_producto();
        $out = $W_marca_producto->printMarca_producto($id_marca);
        break;

    case '5' : //print mesas show
        $W_marca_producto = new W_marca_producto();
        $marca = $_POST['show_marca'];
        $out = $W_marca_producto->printMarca_productosPorNombre($marca);
        break;
    case '6' : //print mesas delete
        $W_marca_producto = new W_marca_producto();
        $marca = $_POST['show_marca_delete'];
        $out = $W_marca_producto->printMarca_productosPorNombreDelete($marca);
        break;
}

die($out);
?>
