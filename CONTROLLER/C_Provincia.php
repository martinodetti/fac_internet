<?php

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.
include 'C_Debug.php';
include '../DAC/Database.class.php';
include '../MODEL/Provincia.php';
include '../VIEW/W_Provincia.php';

$out = "";
$opc = $_POST['opc'];
switch ($opc) {

    case '1': //add 
// Todos los POST que interviene. 
        $id_provincia = 0;
        $nom_provincia = $_POST['save_nom_provincia'];
        $provincia = new provincia();
        $provincia->set_nom_provincia($nom_provincia);
        $ret = $provincia->addprovincia($provincia);
        $out = $ret['0'][0];
        break;

    case '2' : //update 
// Todos los POST que interviene en Update. 
        $id_provincia = $_POST['update_id_provincia'];
        $nom_provincia = $_POST['update_nom_provincia'];
        $provincia = new provincia();
        $provincia->set_id_provincia($id_provincia);
        $provincia->set_nom_provincia($nom_provincia);
        $ret = $provincia->updateprovincia($provincia);
        $out = $ret['rows_affected'][0];
        break;

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

    case '4' : //show 
// Todos los POST que interviene Show. 
        $id_provincia = $_POST['show_id_provincia'];
        $W_provincia = new W_provincia();
        $out = $W_provincia->printprovincia($id_provincia);
        break;

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
		
	case '9': //remitos para facturas
		$ciudad = new ciudad();
		$id_ciudad 	= $_POST['update_id_ciudad_edit'];
		$nom_ciudad = $_POST['update_nom_ciudad_edit'];
		$ciudad->set_nom_ciudad($nom_ciudad);
		$ciudad->set_id_ciudad($id_ciudad);

		$out = $ciudad->updateCiudad($ciudad);
		break;
}

die($out);
?>
