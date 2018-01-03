<?php

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.
include '../DAC/Database.class.php';
include '../MODEL/Ganancia.php';
include '../VIEW/W_Ganancia.php';

$out = '';

$opc = $_POST['opc'];

switch ($opc) {

    case '1': //add 
// Todos los POST que interviene. 
        $id_ganancia = 0;
        $porctj_ganancia = $_POST['save_porctj_ganancia'];
        $descrip_ganancia = $_POST['save_descrip_ganancia'];
        $ganancia = new ganancia();
        $ganancia->set_porctj_ganancia($porctj_ganancia);
        $ganancia->set_descrip_ganancia($descrip_ganancia);
        $ret = $ganancia->addGanancia($ganancia);
        $out = $ret['0'][0];

        break;

    case '2' : //update 
// Todos los POST que interviene en Update. 
        $id_ganancia = $_POST['update_id_ganancia'];
        $porctj_ganancia = $_POST['update_porctj_ganancia'];
        $descrip_ganancia = $_POST['update_descrip_ganancia'];
        $ganancia = new ganancia();
        $ganancia->set_id_ganancia($id_ganancia);
        $ganancia->set_porctj_ganancia($porctj_ganancia);
        $ganancia->set_descrip_ganancia($descrip_ganancia);
        $ret = $ganancia->updateGanancia($ganancia);
        $out = $ret['rows_affected'][0];

        break;

    case '3' : //delete 
// Todos los POST que interviene Delete. 

        $id_ganancia = $_POST['delete_id_ganancia'];
        $ganancia = new ganancia();
        $val=$ganancia->puedeEliminar($id_ganancia);
        if($val==0){
        $ret = $ganancia->deleteGanancia($id_ganancia);
        $out=$ganancia->json("1", "Registro eliminado sactisfactoriamente.");
        }else{
           $out=$ganancia->json("0", "No se ha podido eliminar.");
        }

        break;

    case '4' : //show 
// Todos los POST que interviene Show. 

        $id_ganancia = $_POST['show_id_ganancia'];
        $W_ganancia = new W_ganancia();
        $out = $W_ganancia->printGanancia($id_ganancia);
        break;

    case '5' : //print mesas 
        $porcentaje=$_POST['show_porctj_ganancia'];
        $W_ganancia = new W_ganancia();
        $out = $W_ganancia->printGananciasPorPorcentaje($porcentaje);
        break;
    case '6' : //print mesas_delete 
        $porcentaje=$_POST['show_porctj_ganancia_delete'];
        $W_ganancia = new W_ganancia();
        $out = $W_ganancia->printGananciasPorPorcentajeDelete($porcentaje);
        break;
}



die($out);
?>
