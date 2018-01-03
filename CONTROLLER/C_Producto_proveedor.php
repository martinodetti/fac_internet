<?php 



/** 

* Este código fue generado por el programa ORPOPA. 

* Licencia:Ver licence.txt 

* Autor:Wilfredo Martel S.  

* blog:http://neurocodigo.wordpress.com  

*/ 

 

 

// Capa de Seguridadinclude 'Seguridad.php'; 

// Capa de Acceso a BD.

include '../DAC/Database.class.php';

include '../MODEL/Producto_proveedor.php'; 

include '../VIEW/W_+producto_proveedor.php'; 

$out; 

$opc=$_POST['opc']; 

switch ($opc) { 

case '1': //add 

// Todos los POST que interviene. 

$id_prod_provd=$_POST['save_id_prod_provd']; 

$id_producto=$_POST['save_id_producto']; 

$id_proveedor=$_POST['save_id_proveedor']; 



$producto_proveedor=new producto_proveedor();

$producto_proveedor->set_id_producto($id_producto);

$producto_proveedor->set_id_proveedor($id_proveedor);

$ret=$producto_proveedor->addProducto_proveedor($producto_proveedor);$out=$ret['0'][0]; 

 break; 

case '2' : //update 

// Todos los POST que interviene en Update. 

$id_prod_provd=$_POST['update_id_prod_provd']; 

$id_producto=$_POST['update_id_producto']; 

$id_proveedor=$_POST['update_id_proveedor']; 



$producto_proveedor=new producto_proveedor();

$producto_proveedor->set_id_prod_provd($id_prod_provd);

$producto_proveedor->set_id_producto($id_producto);

$producto_proveedor->set_id_proveedor($id_proveedor);

$ret=$producto_proveedor->updateProducto_proveedor($producto_proveedor); 

$out=$ret['rows_affected'][0]; 

 break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 

$id_prod_provd=$_POST['delete_id_prod_provd']; 



$producto_proveedor=new producto_proveedor();

$ret=$producto_proveedor->deleteProducto_proveedor($id_prod_provd); 

$out=$ret['rows_affected'][0]; 

 break; 

case '4' : //show 

// Todos los POST que interviene Show. 

$id_prod_provd=$_POST['show_id_prod_provd']; 

$W_producto_proveedor=new W_producto_proveedor();

$out=$W_producto_proveedor->printProducto_proveedor($id_prod_provd);

 break; 

case '5' : //print mesas 

$W_producto_proveedor=new W_producto_proveedor();

$out=$W_producto_proveedor->printProducto_proveedors($fecIni,$fecFinal);

 break; 

}

 

die($out); 



?>
