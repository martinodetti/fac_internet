<?php

include '../DAC/Database.class.php';

include '../MODEL/Detalle_gastos.php';



$out = "";

$opc = $_POST['opc'];

switch ($opc) {

    case '1': //add 
// Todos los POST que interviene. 

        $id_detgasto = $_POST['save_id_detgasto'];

        $id_gasto = $_POST['save_id_gasto'];

        $nombre_produc = $_POST['save_nombre_produc'];

        $costouni_detgasto = $_POST['save_costouni_detgasto'];

        $canti_detgasto = $_POST['save_canti_detgasto'];

        $estado_detgasto = $_POST['save_estado_detgasto'];



        $detalle_gastos = new detalle_gastos();

        $detalle_gastos->set_id_gasto($id_gasto);

        $detalle_gastos->set_nombre_produc($nombre_produc);

        $detalle_gastos->set_costouni_detgasto($costouni_detgasto);

        $detalle_gastos->set_canti_detgasto($canti_detgasto);

        $detalle_gastos->set_estado_detgasto($estado_detgasto);

        $ret = $detalle_gastos->addDetalle_gastos($detalle_gastos);
        $out = $ret['0'][0];

        break;

    case '2' : //update 
// Todos los POST que interviene en Update. 

        $id_detgasto = $_POST['update_id_detgasto'];

        $id_gasto = $_POST['update_id_gasto'];

        $nombre_produc = $_POST['update_nombre_produc'];

        $costouni_detgasto = $_POST['update_costouni_detgasto'];

        $canti_detgasto = $_POST['update_canti_detgasto'];

        $estado_detgasto = $_POST['update_estado_detgasto'];



        $detalle_gastos = new detalle_gastos();

        $detalle_gastos->set_id_detgasto($id_detgasto);

        $detalle_gastos->set_id_gasto($id_gasto);

        $detalle_gastos->set_nombre_produc($nombre_produc);

        $detalle_gastos->set_costouni_detgasto($costouni_detgasto);

        $detalle_gastos->set_canti_detgasto($canti_detgasto);

        $detalle_gastos->set_estado_detgasto($estado_detgasto);

        $ret = $detalle_gastos->updateDetalle_gastos($detalle_gastos);

        $out = $ret['rows_affected'][0];

        break;

    case '3' : //delete 
// Todos los POST que interviene Delete. 

        $id_detgasto = $_POST['delete_id_detgasto'];



        $detalle_gastos = new detalle_gastos();

        $ret = $detalle_gastos->deleteDetalle_gastos($id_detgasto);

        $out = $ret['rows_affected'][0];

        break;

    case '4' : //show 
// Todos los POST que interviene Show. 

        $id_detgasto = $_POST['show_id_detgasto'];

        $W_detalle_gastos = new W_detalle_gastos();

        $out = $W_detalle_gastos->printDetalle_gastos($id_detgasto);

        break;

    case '5' : //print mesas 

        $W_detalle_gastos = new W_detalle_gastos();

        $out = $W_detalle_gastos->printDetalle_gastoss($fecIni, $fecFinal);

        break;
}



die($out);
?>
