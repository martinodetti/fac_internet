<?php
session_start();
include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Vehiculo.php';
//include 'MODEL/Producto.php';

//include 'MODEL/Empresa.php';

if(!isset($_SESSION['id_persona'])){
   header('Location: index.php');
		exit();
}


//$persona		=	$persona->showPersona($id_persona);
//$clsEmpresa		=	new empresa();
//$clsEmpresa		=	$clsEmpresa->showEmpresa(1);
//$clsProducto	=	new producto();
//$id_cli			=	$_GET['id_cliente'];

$patente		= $_GET['patente'];
$detalle		= $_GET['detalle'];
$contacto		= $_GET['contacto'];


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/print.css" media="screen"/>
            <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <title></title>
    </head>
    <body>
    	<div id="vozcliente" style="wdith:800px">
    		<table class="tabledata" border="0">
    			<thead>
    				<tr>
    					<th style="width: 250px; height:300px"></th>
    					<th style="width: 400px"></th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td></td>
    					<td>
    					<?php echo "Patente: " .  $patente; ?>
    					</td>
    				</tr>
    				<tr>
    					<td></td>
    					<td>
    					<?php echo "Detalle: " .  $detalle; ?>
    					</td>
    				</tr>
    				<tr>
    					<td></td>
    					<td>
    					<?php echo "Contacto: " .  $contacto; ?>
    					</td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </body>
</html>
