<?php 

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.

include '../DAC/Database.class.php';
include '../MODEL/Vehiculo.php'; 
include '../VIEW/W_Vehiculo.php'; 
include '../MODEL/Vehiculo_cliente.php';
include '../MODEL/Persona.php';
include 'C_Debug.php';

$out=""; 

if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc'];     

switch ($opc) { 

case '1': //add 

	// Todos los POST que interviene. 
	
	$id_vehiculo=0; 
	
	$marca			= $_GET['save_marca_vehiculo'];
	$modelo			= $_GET['save_modelo_vehiculo'];
	$anio			= $_GET['save_anio_vehiculo'];
	$dominio		= $_GET['save_dominio_vehiculo'];
	$observacion	= $_GET['save_observacion_vehiculo'];
	$id_tipovehiculo= $_GET['save_id_tipovehiculo'];
	
	$vehiculo	=new vehiculo();
	
	$vehiculo->set_marca(			$marca);
	$vehiculo->set_modelo(			$modelo);
	$vehiculo->set_anio(			$anio);
	$vehiculo->set_dominio(			$dominio);
	$vehiculo->set_observacion(		$observacion);
	$vehiculo->set_id_tipovehiculo(	$id_tipovehiculo);
	
	$ret=$vehiculo->addVehiculo($vehiculo);
	$id_vehi = $ret['0'][0]; //id del vehiculo
	$vehi_cli = new vehiculo_cliente();

	//array de post del cliente inserción
	if(is_array($_POST['Cliente'])){
		$cli_arr = $_POST['Cliente'];
	}else {
		$cli_arr = array();
	}
	$id_var = array();
	
	$out = $id_vehi;
	foreach($cli_arr as $id_var){
		$vehi_cli = new vehiculo_cliente();
	   	$vehi_cli->set_id_vehiculo($id_vehi);
	   	$vehi_cli->set_id_cliente($id_var);
		$out = $vehi_cli->addVehiculo_cliente($vehi_cli);
		$out=$out['0'][0];
	}

	//fin del array del cliente
	
	break; 

case '2' : //update 
// Todos los POST que interviene en Update. 
$id_vehiculo	=$_GET['update_id_vehiculo']; 
$id_cliente		=$_GET['update_id_cliente'];
$marca			=$_GET['update_marca_vehiculo'];
$modelo			=$_GET['update_modelo_vehiculo'];
$dominio		=$_GET['update_dominio_vehiculo'];
$anio			=$_GET['update_anio_vehiculo'];
$observacion	=$_GET['update_observacion_vehiculo'];
$id_tipovehiculo=$_GET['update_id_tipovehiculo'];

$vehiculo=new vehiculo();


$vehiculo->set_id_vehiculo($id_vehiculo);
$vehiculo->set_marca($marca);
$vehiculo->set_modelo($modelo);
$vehiculo->set_dominio($dominio);
$vehiculo->set_anio($anio);
$vehiculo->set_observacion($observacion);
$vehiculo->set_id_tipovehiculo($id_tipovehiculo);

$ret=$vehiculo->updateVehiculo($vehiculo); 

$out=$ret['rows_affected'][0]; 

//ahora recibo array de clientes
//borro e inserto los nuevos es mejor asi.
$vehi_cli=new vehiculo_cliente();
$ret=$vehi_cli->deleteVehiculo_clientePorVehiculo($id_vehiculo);
$out=$ret['rows_affected'][0];
//array de post del cliente inserción
if(is_array($_POST['Cliente'])){
	$cli_arr = $_POST['Cliente'];
}else {
	$cli_arr = array();
}

$id_var=array();
foreach($cli_arr as $id_var){
	$vehi_cli = new vehiculo_cliente();
   $vehi_cli->set_id_vehiculo($id_vehiculo);
   $vehi_cli->set_id_cliente($id_var);
   $out=$vehi_cli->addVehiculo_cliente($vehi_cli);
}
break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 
$id_vehiculo=$_POST['delete_id_vehiculo']; 
$vehiculo=new vehiculo();
$ret=$vehiculo->deleteVehiculo($id_vehiculo); 
$out=$ret['rows_affected'][0]; 
 break; 
 
case '4' : //show 
// Todos los POST que interviene Show. 
$id_vehiculo=$_POST['show_id_vehiculo']; 
$W_vehiculo=new W_vehiculo();
$out=$W_vehiculo->printVehiculo($id_vehiculo);
 break; 

case '5' : //print mesas 
$W_vehiculo=new W_vehiculo();
$dominio=$_POST['show_vehiculo'];
$out=$W_producto->printVehiculosPorDominio($dominio);
 break; 
 
case '7' : //print mesas 
$W_vehiculo=new W_vehiculo();
$dominio=$_POST['show_vehiculo_delete'];
$out=$W_vehiculo->printVehiculosPorDominioDelete($dominio);
 break; 
 
case '8':
    $idprod=$_GET['show_idvehi'];
    $vehiCli=new vehiculo_cliente();
    $data=$vehiCli->CargarJsonVehi_cli_Idvehi($idprod);
    $out=$_GET["callback"]. "(" . $data . ")";
    break;

case '9'://verifico imagen
    //si cumple con los requisitos subo la imagen
//     sleep(1);
    $uploaddir = '../IMG_PROD/';
    $file = $uploaddir . basename($_FILES['uploadfile']['name']);
        $size = $_FILES['uploadfile']['size'];
        if ($size < (20 * 1024)) {
            if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
                $out="success";
            } else {
                $out="error";
            }
        } else {
            $out="excess";
        }
 break;
 
 case '10':
  $razonSocial = $_GET["term"];   
  $Persona=new persona();
  $data=$Persona->CargarJsonClienteNombre($razonSocial);
  $out=$_GET["callback"] . "(" . $data . ")";
  
 break;
case '11':
    $prok=$_POST['Proveedor'];
    $x=array();
    $aux="";
    foreach($prok as $x){
       $aux=$aux.$x[0];
    }
    $out="Muy bien wilfo".$_GET['save_fecvenci_producto'].' '.$aux;
    break;
    
 case '12'://muestra en json los vehiculos
     $clsVehiculo=new vehiculo();
     $id_vehiculo=$_POST['show_id_vehiculo'];
     $clsVehiculo=$clsVehiculo->showVehiculo($id_vehiculo);
     $out=json_encode($clsVehiculo);
     break;
 case '13'://json array
    $strDominio = isset($_POST['q']) ? strval($_POST['q']) : '';
	$out = '';
    $clsVehiculo=new vehiculo();
	if(strlen($strDominio) >= 2)
	{
		$out=$clsVehiculo->listVehiculosPorDominioJson($strDominio);
	}
    break;
 case '14':
	$dominio = $_POST['dominio'];
	
	$clsVehi = new vehiculo();
	$out = json_encode($clsVehi->VerificarExistenciaDominio($dominio));
	
	break;
	 
	 
}
die($out); 

?>
