<?php 

// Capa de Acceso a BD.
include '../DAC/Database.class.php';
include '../MODEL/Devolucion.php'; 
include '../MODEL/Detalle_devolucion.php'; 
include '../MODEL/Factura.php'; 
include '../MODEL/Compra.php'; 
include '../MODEL/Kardex.php'; 
include '../MODEL/Detalle_kardex.php'; 
include '../MODEL/Persona.php'; 

$out=""; 

if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc'];     

switch ($opc) { 

case '1': //add 

// Todos los POST que interviene. 
$id_devo=0; 
$id_factcmp_devo=$_GET['save_id_factcmp_devo']; 
$tipo_cmpbt_devo=$_GET['save_tipo_cmpbt_devo']; 
$descto_devo=$_GET['save_descto_devo']; 
$iva12_devo=$_GET['save_iva12_devo']; 
$total_devo=$_GET['save_total_devo']; 
$obs_devo=$_GET['save_obs_devo']; 
$fecha_devo=""; 
$estado_devo="1"; 

$devolucion=new devolucion();
$devolucion->set_id_factcmp_devo($id_factcmp_devo);
$devolucion->set_tipo_cmpbt_devo($tipo_cmpbt_devo);
$devolucion->set_descto_devo($descto_devo);
$devolucion->set_iva12_devo($iva12_devo);
$devolucion->set_total_devo($total_devo);
$devolucion->set_obs_devo($obs_devo);
$devolucion->set_fecha_devo($fecha_devo);
$devolucion->set_estado_devo($estado_devo);
$ret=$devolucion->addDevolucion($devolucion);
$id_devo=$ret['0'][0]; //ID DEVOLUCION

$clsDetDevo=new detalle_devolucion();
$clsKardex=new kardex(); //instancio el kardex cabecera
$clsDetKardex=new detalle_kardex();

$clsKardex->set_id_factcmp_kardex($id_factcmp_devo);
$clsKardex->set_tipo_entrdsald_kardex("2");//2 xq es DEVOLUCIÓN DE MI CLIENTE
$clsKardex->set_tipo_cmpbt_kardex("3");//3 xq es factura
$clsKardex->set_cod_factcmp_kardex("");//array de números de id de productos
$clsKardex->set_estado_kardex("1");
$clsKardex->set_fecha_kardex("");
$a_ret=$clsKardex->addKardex($clsKardex);
$id_kardex=$a_ret['0'][0];//return id del kardex
//ahora declaro variable general para el array de productos
$arr_id_producto="";//tipo cadena


$detalle=$_POST['Detalle'];//ARRAY de datos
$dt_aux=array();
$dt_data=array();   
 foreach($detalle as $dt_aux){
   $dt_data[]=$dt_aux;  
 }
 //ahora esta listo para guardar detalle de devolución
 //ahora modelo kardex
 foreach($dt_data as $accion){
    
     $clsDetDevo->set_id_devo($id_devo);//id padre
     $clsDetDevo->set_id_producto($accion['id']);
     $clsDetDevo->set_canti_detdevo($accion['cantidad']);
     $clsDetDevo->set_precio_detdevo($accion['precio']);
     $clsDetDevo->set_estado_detdevo("1");
     $out= $clsDetDevo->addDetalle_devolucion($clsDetDevo);
     
     $clsDetKardex->set_id_kardex($id_kardex);
    $clsDetKardex->set_id_producto($accion['id']);
    $clsDetKardex->set_costo_detkardex($accion['precio']);
    $clsDetKardex->set_canti_detkardex($accion['cantidad']);
    
    $arr_id_producto=$arr_id_producto.$accion['id'].'-';

    $tk=$clsDetKardex->addDetalle_kardex($clsDetKardex);
 }
 
  $clsKardex->set_id_kardex($id_kardex);
$clsKardex->set_cod_factcmp_kardex($arr_id_producto);
$clsKardex->set_id_factcmp_kardex("");
$clsKardex->set_tipo_entrdsald_kardex("");
$clsKardex->set_tipo_cmpbt_kardex("");
$clsKardex->set_estado_kardex("");
$clsKardex->set_fecha_kardex("");
$out=$clsKardex->updateKardex($clsKardex);

 
 break; 

case '2' : //segundo insert para devolución de mercadería 
//// Todos los POST que interviene en Update. 
$id_devo=0; 
$id_factcmp_devo=$_GET['save_id_factcmp_devo']; 
$tipo_cmpbt_devo=$_GET['save_tipo_cmpbt_devo']; 
$descto_devo=0.0; 
$iva12_devo=$_GET['save_iva12_devo']; 
$total_devo=$_GET['save_total_devo']; 
$obs_devo=$_GET['save_obs_devo']; 
$fecha_devo=""; 
$estado_devo="1"; 

$devolucion=new devolucion();
$devolucion->set_id_factcmp_devo($id_factcmp_devo);
$devolucion->set_tipo_cmpbt_devo($tipo_cmpbt_devo);
$devolucion->set_descto_devo($descto_devo);
$devolucion->set_iva12_devo($iva12_devo);
$devolucion->set_total_devo($total_devo);
$devolucion->set_obs_devo($obs_devo);
$devolucion->set_fecha_devo($fecha_devo);
$devolucion->set_estado_devo($estado_devo);
$ret=$devolucion->addDevolucion($devolucion);
$id_devo=$ret['0'][0]; //ID DEVOLUCION

$clsDetDevo=new detalle_devolucion();
$clsKardex=new kardex(); //instancio el kardex cabecera
$clsDetKardex=new detalle_kardex();

$clsKardex->set_id_factcmp_kardex($id_factcmp_devo);
$clsKardex->set_tipo_entrdsald_kardex("4");//4 xq es DEVOLUCIÓN DE Mercadería
$clsKardex->set_tipo_cmpbt_kardex("1");//3 xq es compra y la estoy devolviendo
$clsKardex->set_cod_factcmp_kardex("");//array de números de id de productos para minimizar las búsqueda
$clsKardex->set_estado_kardex("1");
$clsKardex->set_fecha_kardex("");
$a_ret=$clsKardex->addKardex($clsKardex);
$id_kardex=$a_ret['0'][0];//return id del kardex
//ahora declaro variable general para el array de productos
$arr_id_producto="";//tipo cadena


$detalle=$_POST['Detalle'];//ARRAY de datos
$dt_aux=array();
$dt_data=array();   
 foreach($detalle as $dt_aux){
   $dt_data[]=$dt_aux;  
 }
 //ahora esta listo para guardar detalle de devolución
 //ahora modelo kardex
 foreach($dt_data as $accion){
    
     $clsDetDevo->set_id_devo($id_devo);//id padre
     $clsDetDevo->set_id_producto($accion['id']);
     $clsDetDevo->set_canti_detdevo($accion['cantidad']);
     $clsDetDevo->set_precio_detdevo($accion['precio']);
     $clsDetDevo->set_estado_detdevo("1");
     $out= $clsDetDevo->addDetalle_devolucion2($clsDetDevo);
     
     $clsDetKardex->set_id_kardex($id_kardex);
    $clsDetKardex->set_id_producto($accion['id']);
    $clsDetKardex->set_costo_detkardex($accion['precio']);
    $clsDetKardex->set_canti_detkardex($accion['cantidad']);
    
    $arr_id_producto=$arr_id_producto.$accion['id'].'-';

    $tk=$clsDetKardex->addDetalle_kardex($clsDetKardex);
 }
 
  $clsKardex->set_id_kardex($id_kardex);
$clsKardex->set_cod_factcmp_kardex($arr_id_producto);
$clsKardex->set_id_factcmp_kardex("");
$clsKardex->set_tipo_entrdsald_kardex("");
$clsKardex->set_tipo_cmpbt_kardex("");
$clsKardex->set_estado_kardex("");
$clsKardex->set_fecha_kardex("");
$out=$clsKardex->updateKardex($clsKardex);   
    

 break; 

case '3' : //delete 
// Todos los POST que interviene Delete. 
$id_devo=$_POST['delete_id_devo']; 
$devolucion=new devolucion();
$ret=$devolucion->deleteDevolucion($id_devo); 
$out=$ret['rows_affected'][0]; 

 break; 

case '4' : //show 

// Todos los POST que interviene Show. 
$id_devo=$_POST['show_id_devo']; 
$W_devolucion=new W_devolucion();
$out=$W_devolucion->printDevolucion($id_devo);

 break; 

case '5' : //print mesas 

$W_devolucion=new W_devolucion();
$out=$W_devolucion->printDevolucions($fecIni,$fecFinal);
 break; 

case '6'://json factura por id
    $id_fact = isset($_POST['q']) ? strval($_POST['q']) : '';
    $clsFactura=new factura();
    $clsPer=new persona();
    $dat=array();
    $clsFactura=$clsFactura->showFactura($id_fact);
    $clsPer=$clsPer->showPersona($clsFactura->get_id_cliente());
    $ape=$clsPer->get_nom_persona().' '.$clsPer->get_ape_persona();
    $dat[]=array("id_fact"=>$clsFactura->get_id_fact(),"cliente"=>$ape,"ruc"=>$clsPer->get_ruc_persona(),
    "descto_fact"=>$clsFactura->get_descto_fact(),"iva12_fact"=>$clsFactura->get_iva12_fact(),
        "total_fact"=>$clsFactura->get_total_fact());
    $out=json_encode($dat);

    break;
case '7':
    $id_factura=$_POST['id_fact'];
    $clsFactura=new factura();
    $arr=$clsFactura->ListaJsonFactDetalleProducto($id_factura);
    $out=$arr;
    break;
case '8': //json para devo de compra de mercadería
   $guia_cod = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $clsCompra=new compra();
    $clsPerso=new persona();
    $clsCompra=$clsCompra->showCompra($guia_cod);
    $clsPerso=$clsPerso->showPersona($clsCompra->get_id_provd());
    $data=array();
    $data[]=array("id_compra"=>$clsCompra->get_id_compra(),"guiacod_compra"=>$clsCompra->get_guiacod_compra(),
    "proveedor"=>$clsPerso->get_nom_persona(),"baseGrava_compra"=>$clsCompra->get_baseGrava_compra(),
        "total_compra"=>$clsCompra->get_total_compra(),"fecha"=>$clsCompra->get_fec_compra());
    $out=json_encode($data);
    break;
case '9'://retorno json para cargar tabla de compra y detalle de ocmpra
    
    $id_compra=$_POST['id_compra'];
    $clsCompra=new compra();
    $ar_json=$clsCompra->lisJsonCompraDetalle($id_compra);
    $out=$ar_json;
    break;
}

 

die($out); 



?>
