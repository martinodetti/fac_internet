<?php
session_start();
include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Vehiculo.php';
include 'MODEL/Ciudad.php';
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

$id_cli		= $_GET['id_cliente'];
$id_vehiculo= $_GET['idvehiculo'];
$clsCliente	= new persona();
$clsCliente	= $clsCliente->showPersona($id_cli);
$clsVehiculo= new vehiculo();
$clsVehiculo= $clsVehiculo->showVehiculo($id_vehiculo);
$clsCiudad  = new ciudad();
$clsCiudad  = $clsCiudad->showCiudad('',$clsCliente->_id_ciudad);


$numero		= $_GET['numero'];
$fecemi		= $_GET['fecemi'];
$fecegr		= $_GET['fecegr'];
$fecing		= $_GET['fecing'];
$total		= $_GET['total'];
$obs		= $_GET['obs'];
$voz		= $_GET['voz'];
$resp		= $_GET['resp'];

$Data		= $_GET['detalle'];
$arr = array();
if($Data != "")
	$arr		= explode("^", $Data);

$mostrar_precios = $_GET['mostrar_precios'];

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
    <style>
    
    #BODY 
	{ 
		color: #000000 /*The color of all the other text within the body of the page*/
		height: 842px;
		width: 595px;
		/* to centre page on screen*/
		margin-left: auto;
		margin-right: auto;
	}
    #oorr { 
		border-radius:10px; 
		-moz-border-radius:10px; /* Firefox */ 
		-webkit-border-radius:10px; /* Safari y Chrome */ 

		/* Otros estilos */ 
		border:2px solid #000000;
		width:100%;
		height:100%
		padding:5px;
	}
	
	#informacion{
		/* Otros estilos */ 
		border:1px solid #000000;
		width:100%;
		height: 200px;
	}
	#X{
		border:2px solid #333; 
		font-size:30px;
		border-radius:5px; 
		-moz-border-radius:5px; /* Firefox */ 
		-webkit-border-radius:5px; /* Safari y Chrome */ 
	}
    </style>
    
    
    <body>
		<div id="oorr">
			<div id="cabecera">
				<table width="100%">
					<tr>
						<td width="49%"> <!--izquierda -->
							<table align="center">
								<tr>
									<td><img src="IMGBKEND/LOGO.png" width="300px" /></td>
								</tr>
								<tr>
									<td align="center" style="font-size:11px">
									Acceso Sur - Km. 8,5 - Luján de Cuyo - Mendoza
									</br>
									<b>Líneas Rotativas 4360959 - 4360079</b>
									</td>
								</tr>
							</table>
						</td> 
						<td width="2%" style="vertical-align:top"> <!-- centro -->
							<div id="X"><b>X</b></div>
						</td>
						
						<td width="49%"><!--derecha -->
							<table aligh="center">
								<tr>
									<td align="center" colspan=3 style="font-size: 20px"><b>ORDEN DE REPARACION</b></td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td>Fecha</td>
									<?php
					 					$arr_tmp = explode('-',$fecemi);
				 					?>
									<td>
										<table align="center" cellpadding=0 cellspacing=0><tr><td><div style="border:2px solid #333; width:35px;"><?=$arr_tmp[0];?></div></td><td><div style="border:2px solid #333; width:35px"><?=$arr_tmp[1];?></div></td><td><div style="border:2px solid #333; width:35px"><?=$arr_tmp[2];?></div></td></tr></table>
									</td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td>Nº</td>
									
									<td><?=$numero;?></td>
								</tr>

							</table>
						</td> 
					</tr>
					<tr>
						<td colspan=3 style="text-align:center; font-size:10px"><b>DOCUMENTO NO VALIDO COMO FACTURA</b></td>
					</tr>
				</table>
			</div>
			<div id="informacion">
				<table width="100%">
		 			<tbody>
		 				<tr>
		 					<td style="width:25%">Entró: <b><?=$fecing ?></b></td>
		 					<td style="width:50%">Vehículo: <b><?=$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo()?></b></td>
		 					<td style="width:25%">Patente: <b><?=$clsVehiculo->get_dominio()?></b></td>
		 				</tr>
		 				<tr>
			 				<td colspan=2>Señor: <b><?=$clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona();?></b></td>
			 				<td>Teléfono: <b><?=$clsCliente->get_telf_persona(); ?></b></td>
		 				</tr>
		 				<tr>
		 					<td colspan=2>Dirección: <b><?=$clsCliente->get_direc_persona() . " - " . $clsCiudad->get_nom_ciudad() . " - " . $clsCiudad->get_nom_provincia()?></b></td>
		 					<td>Resp: <b><?= $resp; ?></b> </td>
		 				</tr>
		 				
		 				<tr>
		 					<td height="100px" style="vertical-align:top" colspan=3>Observaciones: <b><?=$obs . "</b>" . $voz; ?></b></td>
		 				</tr>
		 				<tr>
		 					<td colspan=2></td>
		 					<td>Firma.............................</td>
		 				</tr>
		 			</tbody>
		 		</table>
			</div>
			
			<div id="detalle">
				<table style="border-collapse:collapse;border:1px solid black;">
		 			<thead>
		 				<tr>
		 					<td colspan=4 align="center" height="30px"><b>DETALLE DE LA ORDEN DE REPARACION</b></td>
		 				</tr>
		                <tr>
		                    <th style="border:1px solid black;width: 70px;"><b>CANT</b></th>
		                    <th style="border:1px solid black;width: 100px;"><b>CODIGO</b></th>
		                    <th style="border:1px solid black;width: 650px"><b>DETALLE</b></th>
		                    <?php if($mostrar_precios == 1)
		                    	echo '<th style="border:1px solid black;width: 110px; align: center"><b>PRECIO</b></th>';
		                    ?>
		                </tr>
		            </thead>
		 			<tbody style="font-size:14px">
		 				<?php
		 				$mostar_mo_y_to = 0;
		 				$manodeobra2 = '';
		 				$torneria = '';
		 				$manodeobra1 = '';
		 				
		 				$to_y_mo = '<div style="position:absolute; bottom: 51px; left: 12px; right: 7px;z-index:2;background-color: #FFFFFF;">';
		 				
		 				foreach($arr as $id){
		                    $tmp=  explode("|", $id);
		                    
		                    $detalle = "";

		                    switch($tmp[0])
		                    {
		                    	case 0: //mano de obra 1
		                    		$manodeobra1 = "<b>MO1</b>: " . $tmp[1];
		                    		$detalle = "MANO DE OBRA 1";
		                    		break;
		                    	case -1: //torneria
		                    		$torneria = "<b>TO</b>: " . $tmp[1];
		                    		$detalle = "TORNERIA";
		                    		break;
		                    	case -2: //mano de obra 2
			                    	$manodeobra2 = "<b>MO2</b>: " . $tmp[1];
		                    		$detalle = "MANO DE OBRA 2";
		                    		break;
		                    	default:
		                    		$detalle = $tmp[1];
		                    		break;
		                    }?>
		                    
		                    <tr>
							    <td style="border:1px solid black;text-align:center"><?php echo $tmp[3] ?></td>
							    <td style="border:1px solid black;text-align:center"><?php echo $tmp[5] ?></td>
							    <td style="border:1px solid black;"><?php echo $detalle ?></td>
								<?php
				                if($mostrar_precios == 1)
									echo '<td style="border:1px solid black;text-align:center">&nbsp;&nbsp;'. $tmp[4]. '</td>';
								?>
						    </tr>
						    <?php
					   	}
					    if($torneria != "")
					    	$to_y_mo = $to_y_mo . $torneria . '<br>';
					    if($manodeobra1 != "")
					    	$to_y_mo = $to_y_mo . $manodeobra1 . '<br>';
					    if($manodeobra2 != "")
					    	$to_y_mo = $to_y_mo . $manodeobra2;
					    	
					    $to_y_mo = $to_y_mo . '</div>';
 
		                $i = count($arr);
		                $total_filas = 28;
                
		                for($i; $i <= $total_filas ; $i++){ //para completar las filas
			            ?>
			            	<tr>
				                <td style="border:1px solid black;text-align:center"></td>
				                <td style="border:1px solid black;text-align:center"></td>
				                <td style="border:1px solid black;">&nbsp;</td>
				                <?php if($mostrar_precios == 1)
		                    		echo '<td style="border:1px solid black;text-align:center">&nbsp;</td>';
		                    	?>
				            </tr>
				      	<?php 
			         	}
			         	?>
			         	<tr>
			                <?php if($mostrar_precios == 1){
			                	echo '<td colspan=3 style="border:1px solid black; text-align:right"><b>TOTAL</b></td>';
		                    	echo '<td style="border:1px solid black;text-align:center">' . $total . '</td>';
		                    }else{
		                    	echo '	<td style="border:1px solid black;text-align:center"></td>
				                		<td style="border:1px solid black;text-align:center"></td>
				                		<td style="border:1px solid black;">&nbsp;</td>';
		                    }?>
			            </tr>
			            <tr>
			            	<td colspan=4  style="border:1px solid black;text-align:center; font-size:13px">
			            		<label>Los precios expresasdos no incluyen IVA y pueden variar sin previo aviso. <?php echo $fr . $filas_a_restar; ?></label>
			            	</td>
			            </tr>
		 		</table>
			</div>
			<?php echo $to_y_mo ?>
		</div>
    </body>
</html>
