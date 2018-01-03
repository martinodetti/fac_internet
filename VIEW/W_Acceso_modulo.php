<?php 


class W_acceso_modulo { 

 public $Acceso_modulo; 

 public function  __construct() { 

 $this->Acceso_modulo=new acceso_modulo();

 }

 

public function printAcceso_modulo($idAcceso_modulo){ 

$ret="";

$this->Acceso_modulo= $this->Acceso_modulo->showAcceso_modulo($idAcceso_modulo);

$ret=$ret."<br>".$this->Acceso_modulo->get_id_acsmod();

$ret=$ret."<br>".$this->Acceso_modulo->get_id_persona();

$ret=$ret."<br>".$this->Acceso_modulo->get_id_modulo();

 return $ret;

} 



public function printAcceso_modulos ($fecIni,$fecFinal){ 

$ret="";

$data=array();

$data= $this->Acceso_modulo->listAcceso_modulos ($fecIni,$fecFinal);

$ret=$ret."<table border='1'>";
$ret=$ret."<thead>";
$ret=$ret."<tr>";

$ret=$ret."<th>id_acsmod</th>";

$ret=$ret."<th>id_persona</th>";

$ret=$ret."<th>id_modulo</th>";

$ret=$ret." </tr>"; 

$ret=$ret."</thead>"; 

$ret=$ret."<tbody>"; 

foreach($data as $Acceso_modulo){

$ret=$ret."<tr>"; 

$ret=$ret."<td>".$this->Acceso_modulo->get_id_acsmod()."</td>"; 

$ret=$ret."</tr>"; 

$ret=$ret."<tr>"; 

$ret=$ret."<td>".$this->Acceso_modulo->get_id_persona()."</td>"; 

$ret=$ret."</tr>"; 

$ret=$ret."<tr>"; 

$ret=$ret."<td>".$this->Acceso_modulo->get_id_modulo()."</td>"; 

$ret=$ret."</tr>"; 

}

 

$ret=$ret."</tbody>"; 

$ret=$ret."</table>"; 

}



 } 



?>
