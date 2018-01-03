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


$id_cli		= $_GET['idcliente'];
$id_vehiculo= $_GET['idvehiculo'];
$clsCliente	= new persona();
$clsCliente	= $clsCliente->showPersona($id_cli);
$clsVehiculo= new vehiculo();
$clsVehiculo= $clsVehiculo->showVehiculo($id_vehiculo);
$clsCiudad  = new ciudad();
$clsCiudad  = $clsCiudad->showCiudad('',$clsCliente->_id_ciudad);

$vehiculo	= $_GET['vehiculo'];
$numero		= $_GET['numero'];
$fecha		= $_GET['fecha'];
$concepto	= $_GET['concepto'];
$total		= $_GET['total'];
$Data		= $_GET['detalle'];
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
    #remi { 
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
		height: 120px;
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
		<div id="remi">
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
									<td align="center" colspan=3 style="font-size: 20px"><b>REMITO</b></td>
								</tr>
								<tr>
									<td width="70%"></td>
									<td>Fecha</td>
									<?php
					 					$arr_tmp = explode('-',$fecha);
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
		 					<td colspan=3>Cliente: <b><?=$clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona();?></b></td>
		 				</tr>
		 				<tr>
			 				<td colspan=2>Dirección: <b><?=$clsCliente->get_direc_persona() . " - " . $clsCiudad->get_nom_ciudad() . " - " . $clsCiudad->get_nom_provincia()?></b></td>
			 				<td>Teléfono: <b><?=$clsCliente->get_telf_persona(); ?></b></td>
		 				</tr>
		 				<tr>
		 					<td colspan=2>Vehículo: <b><?=$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo()?></b></td>
		 					<td style="width:35%">Patente: <b><?=$clsVehiculo->get_dominio()?></b></td>
		 				</tr>
		 				<tr>
		 					<td height="60px" style="vertical-align:top" colspan=3>Concepto: <b><?=$concepto; ?></b></td>
		 				</tr>
		 			</tbody>
		 		</table>
			</div>
			
			<div id="detalle">
				<table style="border-collapse:collapse;border:1px solid black;">
		 			<thead>
		 				<tr>
		 					<th colspan=3 align="center" height="30px"><b>DETALLE DEL REMITO</b></th>
		 				</tr>
		                <tr>
		                    <th style="border:1px solid black;width: 70px;"><b>CANT</b></th>
		                    <th style="border:1px solid black;width: 100px;"><b>CODIGO</b></th>
		                    <th style="border:1px solid black;width: 760px"><b>DETALLE</b></th>
		                    <?php if($mostrar_precios == 1)
		                    	echo '<th style="border:1px solid black;width: 110px; align: center"><b>PRECIO</b></th>';
		                    ?>
			                    
		                </tr>
		            </thead>
		 			<tbody style="font-size:14px">
		 				<?php
		 				$manodeobra = '';
		 				foreach($arr as $id){
		                    $tmp=  explode("|", $id);
		                    if($tmp[0] != 0){
		                ?>
		                <tr>
		                    <td style="border:1px solid black;text-align:center"><?php echo $tmp[3] ?></td>
		                    <td style="border:1px solid black;text-align:center"><?php echo $tmp[5] ?></td>
		                    <td style="border:1px solid black;"><?php echo $tmp[1] ?></td>
		                    <?php if($mostrar_precios == 1)
		                    	echo '<td style="border:1px solid black;text-align:center">&nbsp;&nbsp;' . $tmp[4] .'</td>';
		                    ?>
		                </tr>
		                <?php }else{
		                	$tmp[1] = str_replace('Mano de obra','',$tmp[1]);
/*
		                	$manodeobra = ' <td style="border:1px solid black;text-align:center"></td>
		                					<td style="border:1px solid black;"><b>MANO DE OBRA: </b>'. $tmp[1] .'</td>
		                					<td style="border:1px solid black;text-align:center">&nbsp;&nbsp;' . $tmp[4] . '</td>';
*/
								if($mostrar_precios == 1){
									$manodeobra = ' <td style="border:1px solid black;text-align:center"></td>
													<td style="border:1px solid black;text-align:center"></td>
						        					<td style="border:1px solid black;"><b>MANO DE OBRA: </b>'. $tmp[1] .'</td>
						        					<td style="border:1px solid black;text-align:center">'. $tmp[4] .'</td>';
						        }else{
						        	$manodeobra = ' <td style="border:1px solid black;text-align:center"></td>
													<td style="border:1px solid black;text-align:center"></td>
						        					<td style="border:1px solid black;"><b>MANO DE OBRA: </b>'. $tmp[1] .'</td>';
						        }		                					
		                	}
		                }
		                
		                $i = count($arr);
		                $total_filas = 33;
		                
		                for($i; $i <= $total_filas ; $i++){
				            if($i == 31 && $manodeobra != ""){
				            	echo $manodeobra;
			            	}else{
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
			         	}?>
			         	<tr>
			                <td style="border:1px solid black;text-align:center">&nbsp;</td>
			                <td style="border:1px solid black;text-align:center">&nbsp;</td>
			                <td style="border:1px solid black; text-align:right"><b></b></td>
			                <?php if($mostrar_precios == 1)
		                    	echo '<td style="border:1px solid black;text-align:center">' . $total . '</td>';
		                    ?>
			            </tr>
		 		</table>

			</div>
		</div>
    </body>
</html>
