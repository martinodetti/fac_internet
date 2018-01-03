<?php

include '../DAC/Database.class.php';
include '../MODEL/Gastos.php';
include '../MODEL/Detalle_gastos.php';



$out = "";

if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc'];  

switch ($opc) {

    case '1': //add 
// Todos los POST que interviene. 

        $id_gasto = 0;
        $descrip_gast = $_GET['save_descrip_gast'];
        $cant_gast = $_GET['save_cant_gast'];
        $fecha_gast = $_GET['save_fecha_gast'];
        $id_factura = $_GET['save_id_factura'];
        $nom_empresa_gast = $_GET['save_nom_empresa_gast'];
        $nom_comp_gast = $_GET['save_nom_comp_gast'];
        $iva_gast=$_GET['save_iva_gast']; 

        $gastos = new gastos();

        $gastos->set_descrip_gast($descrip_gast);
        $gastos->set_cant_gast($cant_gast);
        $gastos->set_fecha_gast($fecha_gast);
        $gastos->set_id_factura($id_factura);
        $gastos->set_nom_empresa_gast($nom_empresa_gast);
        $gastos->set_nom_comp_gast($nom_comp_gast);
        $gastos->set_iva_gast($iva_gast);
        
        $ret = $gastos->addGastos($gastos);
        
        $id_gasto = $ret['0'][0];
        
        $detalle_gastos= new detalle_gastos();
        
        $det=$_POST["Detalle"];
        $dat_aux=array();
        $dat_produc=array();
        
        foreach($det as $dat_aux)
        {
            $dat_produc[]=$dat_aux;
        }
        
        foreach($dat_produc as $dat_produc )
        {
            $detalle_gastos->set_id_detgasto(0);
            $detalle_gastos->set_id_gasto($id_gasto);
            $detalle_gastos->set_nombre_produc($dat_produc['producto']);
            $detalle_gastos->set_canti_detgasto($dat_produc['cantidad']);
            $detalle_gastos->set_costouni_detgasto($dat_produc['precio']);
            $detalle_gastos->set_estado_detgasto(1);
        }
        $ret=$detalle_gastos->addDetalle_gastos($detalle_gastos);
        $out=$detalle_gastos->json($ret['0'][0], "Los datos se han guardado correctamente");
        
        break;

    case '2' : //update 
// Todos los POST que interviene en Update. 

        $id_gasto = $_POST['update_id_gasto'];

        $descrip_gast = $_POST['update_descrip_gast'];

        $cant_gast = $_POST['update_cant_gast'];

        $fecha_gast = $_POST['update_fecha_gast'];

        $id_factura = $_POST['update_id_factura'];

        $nom_empresa_gast = $_POST['update_nom_empresa_gast'];

        $nom_comp_gast = $_POST['update_nom_comp_gast'];

        $iva_gast=$_POST['update_iva_gast']; 

        $gastos = new gastos();

        $gastos->set_id_gasto($id_gasto);

        $gastos->set_descrip_gast($descrip_gast);

        $gastos->set_cant_gast($cant_gast);

        $gastos->set_fecha_gast($fecha_gast);

        $gastos->set_id_factura($id_factura);

        $gastos->set_nom_empresa_gast($nom_empresa_gast);

        $gastos->set_nom_comp_gast($nom_comp_gast);

        $gastos->set_iva_gast($iva_gast);
        
        $ret = $gastos->updateGastos($gastos);

        $out = $ret['rows_affected'][0];

        break;

    case '3' : //delete 
// Todos los POST que interviene Delete. 

        $id_gasto = $_POST['delete_id_gasto'];



        $gastos = new gastos();

        $ret = $gastos->deleteGastos($id_gasto);

        $out = $ret['rows_affected'][0];

        break;

    case '4' : //show 
// Todos los POST que interviene Show. 

        $id_gasto = $_POST['show_id_gasto'];

        $W_gastos = new W_gastos();

        $out = $W_gastos->printGastos($id_gasto);

        break;

    case '5' : //print mesas 

        $W_gastos = new W_gastos();

        $out = $W_gastos->printGastoss($fecIni, $fecFinal);

        break;
    
    
    case '8'://cabecera mediante fechas
     $clsGastos=new gastos();
        $fecIni=$_POST['fec_ini'];
        $fecFinal=$_POST['fec_final'];
     $out=$clsGastos->listJsonGastos($fecIni, $fecFinal);
     break;
}



die($out);
?>
