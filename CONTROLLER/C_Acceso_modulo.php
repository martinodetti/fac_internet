<?php 
include '../DAC/Database.class.php';
include '../MODEL/Acceso_modulo.php'; 
include '../MODEL/Persona.php'; 
include '../MODEL/V_acceso_modulo.php'; 
include '../VIEW/W_acceso_modulo.php'; 


$out=""; 
if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc']; 

switch ($opc) { 

case '1': //add 
// Todos los POST que interviene. 
//actualizo clave del trabajador
 $id_per=$_GET['txt_idpersona_new'];   
 $clave=$_GET['txt_clave_new'];   
 $usuario=$_GET['txt_usuario'];
 $clsPersona=new persona();
 if($clave !="")
	 $out=$clsPersona->updateTrabajadorClave($id_per, $clave);
	 
 $out = $clsPersona->updateTrabajadorUsuario($id_per, $usuario);
 
 // no se para que mierda hace esto de la cabeecera
 //ahora recibo el cab en un post , y creo una instancia de acceso modulo
 /*
 $clsAccesoMod=new acceso_modulo();
 $Cabecera=$_POST['Cabecera'];
 $dt_aux=array();
 $dt_data=array();   
 foreach($Cabecera as $dt_aux){
   $dt_data[]=$dt_aux;  
 }
 //ahora esta listo para guardar
 foreach($dt_data as $acc){
   $clsAccesoMod->set_id_persona($id_per);
   $clsAccesoMod->set_id_modulo($acc['idpadre']);
   $out=$clsAccesoMod->addAcceso_modulo($clsAccesoMod);
 }
 */
 
 //primero tengo que borrar todos los accesos para insertarlos de nuevo
 $clsAccesoMod=new acceso_modulo();

 $clsAccesoMod->deleteAcceso_modulo($id_per);
 
 $Detalle=$_POST['Cuerpo'];
 $dt=array();
 $deta=array();
 foreach($Detalle as $dt){
     $deta[]=$dt;
 }
 $padre = "";
 foreach($deta as $val){
   $clsAccesoMod->set_id_persona($id_per);
   $clsAccesoMod->set_id_modulo($val['id']);
   $out=$clsAccesoMod->addAcceso_modulo($clsAccesoMod);
   if($padre != $val['padre'])
   {
   		//guardo el padre
   		$clsAccesoMod->addPadre($id_per, $val['padre']);
   		$padre = $val['padre'];
   }
 }
//con esto se termino la inserccion de accesos
 break; 

case '2' : //update 

// Todos los POST que interviene en Update. 


 break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 
//Eliminamos todos los permisos
//1: borramos clave del usuario
$id_persona=$_POST['txt_update_idpersona']; 
$clsPersona=new persona();
$out=$clsPersona->updateTrabajadorClave($id_persona, '');
//ahora elimino lso registros del acceeso a modulo
$clsAccesoMod=new acceso_modulo();
$out=$clsAccesoMod->deleteAcceso_modulo($id_persona);
 break; 

case '4' : //show 

// Todos los POST que interviene Show. 

$id_acsmod=$_POST['show_id_acsmod']; 
$W_acceso_modulo=new W_acceso_modulo();
$out=$W_acceso_modulo->printAcceso_modulo($id_acsmod);
 break; 

case '5' : //print mesas 
$W_acceso_modulo=new W_acceso_modulo();
$out=$W_acceso_modulo->printAcceso_modulos($fecIni,$fecFinal);
 break; 

case '6':
 $clsVmodulo=new v_acceso_modulo();
 $idpadre=$_POST['id_mod'];
 $arr_mod= $clsVmodulo->ModuloporIdPadreAndNom($idpadre);
 $cade="";
 foreach($arr_mod as $clsVmodulo){
  $cade=$cade."<option value='".$clsVmodulo->get_id_modulo()."'>".$clsVmodulo->get_nom_modulo()."</option>";
 }
 $out=$cade;
    break;

case '7':
	$idt = $_POST['id_trabajador'];
	$clsAccMod = new acceso_modulo();
	$out = json_encode($clsAccMod->listModulosPorEmpleado($idt),JSON_FORCE_OBJECT);
	break;

}

 

die($out); 



?>
