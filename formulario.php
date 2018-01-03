<?php
session_start();
include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Producto.php';
include 'MODEL/Empresa.php';

if(!isset($_SESSION['id_persona'])){
   header('Location: index.php');
		exit();
}
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php

if(isset($_SESSION['id_persona'])){
	

	$id_persona=$_SESSION['id_persona'];   
	$persona=new persona();

$persona		=	$persona->showPersona($id_persona);
$clsEmpresa		=	new empresa();
$clsEmpresa		=	$clsEmpresa->showEmpresa(1);
$clsProducto	=	new producto();
$id_cli			=	$_GET['id_cliente'];
$clsCliente		=	new persona();
$clsCliente		=	$clsCliente->showPersona($id_cli);

$descu			=	$_GET['descu'];
$subtotal		=	$_GET['subtotal'];
$iva_10			=	$_GET['iva_10'];
$iva_21			=	$_GET['iva_21'];
$total			=	$_GET['total'];
$Data			=	$_GET['detalle'];
$arr			=	explode("-", $Data);

//foreach($arr as $id){
//    echo $id.'<br/>';
//}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
            <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <title></title>
    </head>
    <body>
     
        <fieldset style="width: 600px">
            <legend>Datos de la Empresa</legend>
            <table class="tabledata" border="0">
                <thead>
                    <tr>
                        <th style="width: 100px"></th>
                        <th style="width: 100px"></th>
                        <th style="width: 100px"></th>
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td>Empresa:</td>
                        <td><?php echo $clsEmpresa->get_razsocial_empresa(); ?></td>
                        <td>CUIT:</td>
                        <td><?php echo $clsEmpresa->get_ruc_empresa();?></td>
                    </tr>
                    <tr >
                        <td>Dirección:</td>
                        <td><?php echo $clsEmpresa->get_direc_empresa();?></td>
                        <td>Teléfono:</td>
                        <td><?php echo $clsEmpresa->get_telf_empresa().' | '.$clsEmpresa->get_cel_empresa()?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        
        <fieldset style="width: 600px">
            <legend>Datos del Cliente</legend>
            <table class="display" border="0">
                <thead>
                    <tr>
                        <th style="width: 100px"></th>
                        <th style="width: 100px"></th>
                        <th style="width: 100px"></th>
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cliente:</td>
                        <td><?php echo $clsCliente->get_nom_persona().' '.$clsCliente->get_ape_persona()?></td>
                        <td>Ruc:</td>
                        <td><?php echo $clsCliente->get_ruc_persona() ?></td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td><?php echo $clsCliente->get_direc_persona()?></td>
                        <td>Lugar:</td>
                        <td>Machala</td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    <hr/>
        <fieldset style="width: 700px">
            <legend></legend>
            <table id="dt_example" class='display' border="0">
                <thead>
                    <tr>
                        <th colspan="4">Detalle de la Factura</th>
                    </tr>
                    <tr>
                        <th class='tc' style="width: 100px">CANTIDAD</th>
                        <th class='tc' style="width: 400px">DESCRIPCIÓN</th>
                        <th  class='tc' style="width: 100px">P.UNITARIO</th>
                        <th class='tc' style="width: 100px">IMPORTE</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class='even'>
                        <th colspan="2"></th>
                        <th>SubTotal</th>
                        <th><?php echo $subtotal;?></th>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                        <th>Total Gravado Iva 10,5%</th>
                        <th><?php echo $iva_10;?></th>
                    </tr>
					<tr>
                        <th colspan="2"></th>
                        <th>Total Gravado Iva 21%</th>
                        <th><?php echo $iva_21;?></th>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                        <th>Descuento</th>
                        <th><?php echo $descu; ?></th>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                        <th>Total </th>
                        <th><?php echo $total;?></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($arr as $id){
                        $tmp=  explode("|", $id);
                        $clsProducto=$clsProducto->showProducto($tmp[0]);
                        ?>
                    <tr>
                        <td style="width: 100px"><?php echo $tmp[1]?></td>
                        <td style="width: 400px"><?php echo $clsProducto->get_nom_producto() ?></td>
                        <td style="width: 100px"><?php echo $clsProducto->get_pvp1_producto()?></td>
                        <td style="width: 100px"><?php echo $tmp[1]*$clsProducto->get_pvp1_producto()?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
        
        
    </body>
</html>
<?php 
}
?>