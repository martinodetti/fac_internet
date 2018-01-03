<?php

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.
include_once 'C_Debug.php';
include_once '../DAC/Database.class.php';
include_once '../MODEL/Vozcliente_1.php';
include_once '../VIEW/W_Vozcliente.php';

$out = "";
$opc = $_POST['opc'];
switch ($opc) {

    case '1': //add 
// Todos los POST que interviene. 
        $id_vozcliente = 0;
        $detalle = $_POST['save_detalle'];
        $contacto = $_POST['save_contacto'];
        $patente = $_POST['save_patente'];

        $vozcliente = new vozcliente_1();
        $vozcliente->set_contacto($contacto);
        $vozcliente->set_detalle($detalle);
        $vozcliente->set_patente($patente);

        $ret = $vozcliente->addvozcliente($vozcliente);
        $out = $ret['0'][0];

        break;

    case '2' : //update 
// Todos los POST que interviene en Update. 
        $id_vozcliente 	= $_POST['update_id_vozcliente'];
        $detalle 		= $_POST['update_detalle_vozcliente'];
        $contacto 		= $_POST['update_contacto_vozcliente'];
        $patente 		= $_POST['update_patente_vozcliente'];

        $vozcliente = new vozcliente_1();
        $vozcliente->set_id_vozcliente($id_vozcliente);
        $vozcliente->set_detalle($detalle);
        $vozcliente->set_contacto($contacto);
        $vozcliente->set_patente($patente);
        
        $ret = $vozcliente->updatevozcliente($vozcliente);
        $out = $ret['rows_affected'][0];
        break;
/*
    case '3' : //delete 
// Todos los POST que interviene Delete. 
        $id_provincia = $_POST['delete_id_provincia'];
        $provincia = new provincia();
        $val=$provincia->puedeEliminar($id_provincia);
        if($val==0){
        $ret = $provincia->deleteprovincia($id_provincia);
          $out = $provincia->json("1", "Registro eliminado sactisfactoriamente.");
        }else{
          $out=$provincia->json("0", "No se ha podido eliminar.");
        }
      
        break;
*/
    case '4' : //show 
// Todos los POST que interviene Show. 
        $id_vozcliente = $_POST['show_id_vozcliente'];
        $vozcliente = new vozcliente_1();
        $vozcliente = $vozcliente->showvozcliente($id_vozcliente);
        $out=json_encode($vozcliente);
        break;
/*
    case '5' : //print mesas show
        $W_provincia = new W_provincia();
        $provincia = $_POST['show_provincia'];
        $out = $W_provincia->printprovinciasPorNombre($provincia);
        break;
    case '6' : //print mesas delete
        $W_provincia = new W_provincia();
        $provincia = $_POST['show_provincia_delete'];
        $out = $W_provincia->printprovinciasPorNombreDelete($provincia);
        break;
	case '7': //remitos para facturas
		$wProvincia = new W_Provincia();
		$id_prov = $_POST['id_provincia'];
		$out = $wProvincia->printLocalidadesProvincia($id_prov);
		break;
	case '8': //remitos para facturas
		$ciudad = new ciudad();
		$id_prov 	= $_POST['id_provincia'];
		$nom_ciudad = $_POST['ciudad'];
		$ciudad->set_nom_ciudad($nom_ciudad);
		$ciudad->set_id_provincia($id_prov);

		$out = $ciudad->addCiudad($ciudad);
		break;
		
*/
	case '10': //remitos para facturas
		$idvc = $_POST['id_vozcliente'];
		$patente = $_POST['patente'];
		$wVozcliente = new W_vozcliente();
		$out = $wVozcliente->printVozCliente($idvc, $patente);
		break;	
}

die($out);
?>
