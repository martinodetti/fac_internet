<?php 

class W_producto_proveedor { 

 public $Producto_proveedor; 

 public function  __construct() { 

 $this->Producto_proveedor=new producto_proveedor();

 }

 

public function printProducto_proveedor($idProducto_proveedor){ 

$ret="";

$this->Producto_proveedor= $this->Producto_proveedor->showProducto_proveedor($idProducto_proveedor);

$ret=$ret."<br>".$this->Producto_proveedor->get_id_prod_provd();

$ret=$ret."<br>".$this->Producto_proveedor->get_id_producto();

$ret=$ret."<br>".$this->Producto_proveedor->get_id_proveedor();

 return $ret;

} 



public function printProducto_proveedors ($fecIni,$fecFinal){ 

$ret="";

$data=array();

$data= $this->Producto_proveedor->listProducto_proveedors ($fecIni,$fecFinal);

$ret=$ret."<table border='1'>";

$ret=$ret."<thead>";

$ret=$ret."<tr>";

$ret=$ret."<th>id_prod_provd</th>";

$ret=$ret."<th>id_producto</th>";

$ret=$ret."<th>id_proveedor</th>";

$ret=$ret." </tr>"; 

$ret=$ret."</thead>"; 

$ret=$ret."<tbody>"; 

foreach($data as $Producto_proveedor){

$ret=$ret."<tr>"; 

$ret=$ret."<td>".$this->Producto_proveedor->get_id_prod_provd()."</td>"; 

$ret=$ret."</tr>"; 

$ret=$ret."<tr>"; 

$ret=$ret."<td>".$this->Producto_proveedor->get_id_producto()."</td>"; 

$ret=$ret."</tr>"; 

$ret=$ret."<tr>"; 

$ret=$ret."<td>".$this->Producto_proveedor->get_id_proveedor()."</td>"; 

$ret=$ret."</tr>"; 

}

 

$ret=$ret."</tbody>"; 

$ret=$ret."</table>"; 

}



 } 



?>
