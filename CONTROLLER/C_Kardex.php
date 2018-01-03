<?php 

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.

include '../DAC/Database.class.php';
include '../MODEL/Kardex.php'; 
include '../MODEL/Detalle_kardex.php'; 
include '../MODEL/Producto.php'; 
include '../VIEW/W_Kardex.php'; 

$out=""; 

$opc=$_POST['opc']; 
switch ($opc) { 
case '1': //add 

// Todos los POST que interviene. 

$id_kardex=$_POST['save_id_kardex']; 

$id_factcmp_kardex=$_POST['save_id_factcmp_kardex']; 

$tipo_entrdsald_kardex=$_POST['save_tipo_entrdsald_kardex']; 

$tipo_cmpbt_kardex=$_POST['save_tipo_cmpbt_kardex']; 

$cod_factcmp_kardex=$_POST['save_cod_factcmp_kardex']; 

$fecha_kardex=$_POST['save_fecha_kardex']; 

$estado_kardex=$_POST['save_estado_kardex']; 



$kardex=new kardex();

$kardex->set_id_factcmp_kardex($id_factcmp_kardex);

$kardex->set_tipo_entrdsald_kardex($tipo_entrdsald_kardex);

$kardex->set_tipo_cmpbt_kardex($tipo_cmpbt_kardex);

$kardex->set_cod_factcmp_kardex($cod_factcmp_kardex);

$kardex->set_fecha_kardex($fecha_kardex);

$kardex->set_estado_kardex($estado_kardex);

$ret=$kardex->addKardex($kardex);$out=$ret['0'][0]; 

 break; 

case '2' : //update 

// Todos los POST que interviene en Update. 

$id_kardex=$_POST['update_id_kardex']; 

$id_factcmp_kardex=$_POST['update_id_factcmp_kardex']; 

$tipo_entrdsald_kardex=$_POST['update_tipo_entrdsald_kardex']; 

$tipo_cmpbt_kardex=$_POST['update_tipo_cmpbt_kardex']; 

$cod_factcmp_kardex=$_POST['update_cod_factcmp_kardex']; 

$fecha_kardex=$_POST['update_fecha_kardex']; 

$estado_kardex=$_POST['update_estado_kardex']; 



$kardex=new kardex();

$kardex->set_id_kardex($id_kardex);

$kardex->set_id_factcmp_kardex($id_factcmp_kardex);

$kardex->set_tipo_entrdsald_kardex($tipo_entrdsald_kardex);

$kardex->set_tipo_cmpbt_kardex($tipo_cmpbt_kardex);

$kardex->set_cod_factcmp_kardex($cod_factcmp_kardex);

$kardex->set_fecha_kardex($fecha_kardex);

$kardex->set_estado_kardex($estado_kardex);

$ret=$kardex->updateKardex($kardex); 

$out=$ret['rows_affected'][0]; 

 break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 
$id_kardex=$_POST['delete_id_kardex']; 
$kardex=new kardex();
$ret=$kardex->deleteKardex($id_kardex); 
$out=$ret['rows_affected'][0]; 
 break; 

case '4' : //imprimo kardex
// Todos los POST que interviene Show. 
$idprod=$_POST['id_prod'];
$fec_ini=$_POST['fec_ini'];
$fec_fin=$_POST['fec_fin'];
$clsProducto=new producto();
$stock=$clsProducto->getStock($idprod);
$W_clsKardex=new W_kardex();
$out=$W_clsKardex->printKardexs($idprod, $fec_ini, $fec_fin,$stock);
 break; 



}

 

die($out); 



?>
