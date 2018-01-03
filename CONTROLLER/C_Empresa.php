<?php 



// Capa de Seguridadinclude 'Seguridad.php'; 

// Capa de Acceso a BD.

include '../DAC/Database.class.php';
include '../MODEL/Empresa.php'; 

$out=""; 
$opc=$_POST['opc']; 
switch ($opc) { 

case '1': //add 

// Todos los POST que interviene. 

$id_empresa=$_POST['save_id_empresa']; 

$id_contador=$_POST['save_id_contador']; 

$id_representante=$_POST['save_id_representante']; 

$id_ciudad=$_POST['save_id_ciudad']; 

$razsocial_empresa=$_POST['save_razsocial_empresa']; 

$ruc_empresa=$_POST['save_ruc_empresa']; 

$direc_empresa=$_POST['save_direc_empresa']; 

$telf_empresa=$_POST['save_telf_empresa']; 

$cel_empresa=$_POST['save_cel_empresa']; 

$web_empresa=$_POST['save_web_empresa']; 

$correo_empresa=$_POST['save_correo_empresa']; 

$fecha_empresa=$_POST['save_fecha_empresa']; 



$empresa=new empresa();

$empresa->set_id_contador($id_contador);

$empresa->set_id_representante($id_representante);

$empresa->set_id_ciudad($id_ciudad);

$empresa->set_razsocial_empresa($razsocial_empresa);

$empresa->set_ruc_empresa($ruc_empresa);

$empresa->set_direc_empresa($direc_empresa);

$empresa->set_telf_empresa($telf_empresa);

$empresa->set_cel_empresa($cel_empresa);

$empresa->set_web_empresa($web_empresa);

$empresa->set_correo_empresa($correo_empresa);

$empresa->set_fecha_empresa($fecha_empresa);

$ret=$empresa->addEmpresa($empresa);$out=$ret['0'][0]; 

 break; 

case '2' : //update 

// Todos los POST que interviene en Update. 

$id_empresa=$_POST['update_id_empresa']; 
$id_contador=$_POST['update_id_contador']; 
$id_representante=$_POST['update_id_representante']; 
$id_ciudad=$_POST['update_id_ciudad']; 
$razsocial_empresa=$_POST['update_razsocial_empresa']; 
$ruc_empresa=$_POST['update_ruc_empresa']; 
$direc_empresa=$_POST['update_direc_empresa']; 
$telf_empresa=$_POST['update_telf_empresa']; 
$cel_empresa=$_POST['update_cel_empresa']; 
$web_empresa=$_POST['update_web_empresa']; 
$correo_empresa=$_POST['update_correo_empresa']; 
$fecha_empresa=""; 

$empresa=new empresa();
$empresa->set_id_empresa($id_empresa);
$empresa->set_id_contador($id_contador);
$empresa->set_id_representante($id_representante);
$empresa->set_id_ciudad($id_ciudad);
$empresa->set_razsocial_empresa($razsocial_empresa);
$empresa->set_ruc_empresa($ruc_empresa);
$empresa->set_direc_empresa($direc_empresa);
$empresa->set_telf_empresa($telf_empresa);
$empresa->set_cel_empresa($cel_empresa);
$empresa->set_web_empresa($web_empresa);
$empresa->set_correo_empresa($correo_empresa);
$empresa->set_fecha_empresa($fecha_empresa);
$ret=$empresa->updateEmpresa($empresa); 
$out=$ret['rows_affected'][0]; 

 break; 

}

 

die($out); 



?>
