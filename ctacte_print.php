<?php
session_start();
include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';

if(!isset($_SESSION['id_persona'])){
   header('Location: index.php');
		exit();
}

$id_cli		= $_GET['cliente'];
$clsCliente	= new persona();
$clsCliente	= $clsCliente->showPersona($id_cli);
$Data		= $_GET['grilla'];
$fecha 		= fecha();

$data = str_replace('class="display"','class="tablaDetalle"',$Data);
$data = str_replace('style=""','style="width:600px"',$data);

function fecha()
{
	switch(date('n')){
	case 1:
		$mes = 'Enero';
		break;
	case 2:
		$mes = 'Febrero';
		break;
	case 3:
		$mes = 'Marzo';
		break;
	case 4:
		$mes = 'Abril';
		break;
	case 5:
		$mes = 'Mayo';
		break;
	case 6:
		$mes = 'Junio';
		break;
	case 7:
		$mes = 'Julio';
		break;
	case 8:
		$mes = 'Agosto';
		break;
	case 9:
		$mes = 'Septiembre';
		break;
	case 10:
		$mes = 'Octubre';
		break;
	case 11:
		$mes = 'Noviembre';
		break;
	case 12:
		$mes = 'Diciembre';
		break;
	}
	
	return date('d') . " de " . $mes . " de " . date('Y');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/print.css"/>
			
        <title></title>
    </head>
    <body>
		<div id="fondo" style="width:600px; Height:1000px">
		 	<table style="width:500px" align="center">
		 		<tr style="height:200px">
		 			<td align="center">
		 				<img src="IMGBKEND/LOGO.png" width="300"/>
		 			</td>
		 		</tr>
		 		<tr>
		 			<td style="height:50px" align="right">
		 				<label>Mendoza <?=$fecha?></label>
		 			</td>
		 		</tr>
		 		<tr>
		 			<td style="font-size:25; border:2px solid black;" align="center">
		 				<label><b>RESUMEN DE CUENTA</b></label>
		 			</td>
		 		</tr>
		 		<tr>
		 			<td style="height:100px; font-size:20" align="left">
		 				<label><b>CLIENTE: </b> <?php echo $clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona(); ?></label>
		 			</td>
		 		</tr>
		 		<tr>
		 			<td>
		 				<?php echo $data ?>
		 			</td>
		 		</tr>
		 		
		 		<tr>
		 			<td style="height:200px">
		 				<label>Solicito tenga a bien informar disponibilidad de pago a info@frenosoeste.com.ar o al celular 0261-153371777 nextel 686*436 </label>
		 				<br>
		 				<label><b>En caso de haber efectuado el pago a travez de transferencia bancaria, por favor de enviar comprobante para poder efectuar la baja de la deuda. Sepan disculpar, saludos cordiales.</b></label>
		 			</td>
		 		</tr>
		 	</table>
     	</div>
    </body>
</html>
