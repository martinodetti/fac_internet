<?php 
// Capa de Acceso a BD.
include '../DAC/Database.class.php';
include '../MODEL/Cliente_pago.php'; 
include '../MODEL/V_cliente_pago.php'; 
include '../VIEW/W_V_cliente_pago.php'; 

$out=""; 

if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc'];     

switch ($opc) { 

case '1': //CONSULTAR PAGOS PENDIENTES

// Todos los POST que interviene. 
$fecIni=$_POST['fecha'];
$w_cls_cliente=new W_v_cliente_pago();
$out=$w_cls_cliente->printV_cliente_pagos($fecIni);

 break; 

case '2' : //HISTORIAL DE PAGOS 


break;

}

 

die($out); 



?>
