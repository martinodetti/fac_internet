<?php
session_start();
include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Ciudad.php';
include 'MODEL/Vehiculo.php';

//include 'MODEL/Producto.php';

//include 'MODEL/Empresa.php';
/*
if(!isset($_SESSION['id_persona'])){
	header('Location: index.php');
	exit();
}
*/

//$persona		=	$persona->showPersona($id_persona);
//$clsEmpresa		=	new empresa();
//$clsEmpresa		=	$clsEmpresa->showEmpresa(1);
//$clsProducto	=	new producto();
//$id_cli			=	$_GET['id_cliente'];

$id_cli		= $_GET['id_cliente'];
$clsCliente	= new persona();
$clsCliente	= $clsCliente->showPersona($id_cli);
$clsCiudad 	= new ciudad();
$clsCiudad  = $clsCiudad->showCiudad('',$clsCliente->_id_ciudad);

$dominio = $_GET['dominio'];
$clsVehiculo= new vehiculo();
if($dominio != "")
	$clsVehiculo = $clsVehiculo->getVehiculosPorDominio($dominio);


$numero		= $_GET['numero'];
$fecha		= $_GET['fecha'];
$total		= $_GET['total'];
$subtotal	= $_GET['sub'];
$descu		= $_GET['descu'];
$iva10		= $_GET['iva10'];
$iva21		= $_GET['iva21'];
$forpago	= $_GET['forpago'];
$Data		= $_GET['detalle'];
$remis		= $_GET['remis'];
$ordens		= $_GET['ordens'];
$arr		= explode("^", $Data);

$re_y_or = "";
if($remis !="" )
	$re_y_or = $remis . ",";
if($ordens != "")
	$re_y_or = $re_y_or . $ordens;

//foreach($arr as $id){
//    echo $id.'<br/>';
//}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/print.css"/> 
            <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <title></title>
    </head>
    <body>
    <div id="fondo" style="width:850px; Height:1150px">
     	<div id="fecha" style="width:850px">
     		<!-- FECHA -->
     		<table class="tabledata" border="0">
     			<thead>
                    <tr>
                        <th style="width: 510px; height:65px"></th>
                        <th style="width: 140px"></th>
                    </tr>
                </thead>
     			<tbody>
     				<tr>
     					<td></td>
     					<td><?php echo $fecha; ?></td>
				</tr>
     			</tbody>
     		</table>
     		<!-- CLIENTE -->
     		<table class="tabledata" border="0">
     			<thead>
                    <tr>
                    	<th style="width: 70px; height:85px" ></th>
                        <th style="width: 450px"></th>
                        <th style="width: 300px; textAlign:right"><br><br><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ORIGINAL"; ?></th>
                    </tr>
                </thead>
     			<tbody>
     				<tr>
     					<td></td>
     					<td><?php echo $clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona(); ?></td>
     					<td><?php echo $clsCliente->get_direc_persona()?></td>
     				</tr>
     				<tr>
	     				<td></td>
     					<td><?php echo $clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(). " - " . $clsVehiculo->get_dominio(); ?></td>
     					<td><?php echo $clsCiudad->get_nom_ciudad() . " (" . $clsCiudad->get_nom_provincia() . ")"; ?></td>
     				</tr>
     				<tr>
     					<td>
     					<!-- condicion de iva -->
     					<?php
     					if($clsCliente->_id_condiva == 1 && false){
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
     					}else{
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
						}
     					?>
     					</td>
     					<td style="height:60px"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $clsCliente->get_ruc_persona(); ?></td>
     				</tr>
     				<tr>
     					<td>
     					<!-- forma de pago -->
     					<?php
     					if($forpago == 3 || true){
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
     					}else{
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
						}
     					?>
     					</td>
     					<td style="height:10px"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $re_y_or; ?></td>
     				</tr>
     			</tbody>
     		</table>
     		
     		<!-- DETALLE -->
     		<div id="fecha" style="width:850px; height:850px">
		 		<table class="tabledata" border="0">
		 			<thead>
		                <tr>
		                    <th style="width: 55px; height:40px"></th>
		                    <th style="width: 105px"></th>
		                    <th style="width: 390px"></th>
		                    <th style="width: 50px"></th>
		                    <th style="width: 105px"></th>
		                    <th style="width: 105px"></th>
		                </tr>
		            </thead>
		 			<tbody>
		 				<?php foreach($arr as $id){
		                    $tmp=  explode("|", $id);
		                    ?>
		                <tr>
		                    <td style="width: 55px; vertical-align:top" ><?php echo $tmp[4] ?></td>
		                    <td style="width: 125px; vertical-align:top"><?php echo $tmp[1] ?></td>
		                    <td style="width: 440px"><?php echo $tmp[2] ?></td>
		                    <td style="width: 50px"></td>
		                    <td style="width: 105px; vertical-align:top"><?php echo $tmp[3] ?></td>
		                    <td style="width: 105px; vertical-align:top"><?php echo $tmp[5] ?></td>
		                </tr>
		                <?php } ?>
		 			</tbody>
		 		</table>
		 	</div>
		 	
		 	<!-- TOTALES -->
		 	<table class="tabledata" border="0">
	 			<thead>
	                <tr>
	                    <th style="width: 110px; height:10px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 150px"></th>
	                    <th style="width: 70px"></th>
	                </tr>
	            </thead>
	 			<tbody>
	 				<tr>
	                    <td style="width: 110px"><?php echo $subtotal ?></td>
	                    <td style="width: 110px"></td>
	                    <td style="width: 110px"><?php echo $descu ?></td>
	                    <td style="width: 110px"></td>
	                    <td style="width: 110px" align="right"><?php echo $iva21+$iva10 ?></td>
	                    <td style="width: 150px"></td>
	                    <td style="width: 70px" align="right"><?php echo $total ?></td>
	                </tr>
	 			</tbody>
	 		</table>
     	</div>
    </div> 
	<div id="regulador" style="width:850px; height:65px"></div>
    <div id="fondo" style="width:850px; Height:1150px">
     	<div id="fecha" style="width:850px">
     		<!-- FECHA -->
     		<table class="tabledata" border="0">
     			<thead>
                    <tr>
                        <th style="width: 510px; height:75px"></th>
                        <th style="width: 140px"></th>
                    </tr>
                </thead>
     			<tbody>
     				<tr>
     					<td></td>
     					<td><?php echo $fecha; ?></td>
				</tr>
     			</tbody>
     		</table>
     		<!-- CLIENTE -->
     		<table class="tabledata" border="0">
     			<thead>
                    <tr>
                    	<th style="width: 70px; height:87px" ></th>
                        <th style="width: 450px"></th>
                        <th style="width: 300px; textAlign:right"><br><br><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DUPLICADO"; ?></th>
                    </tr>
                </thead>
     			<tbody>
     				<tr>
     					<td></td>
     					<td><?php echo $clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona(); ?></td>
     					<td><?php echo $clsCliente->get_direc_persona()?></td>
     				</tr>
     				<tr>
	     				<td></td>
     					<td><?php echo $clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(). " - " . $clsVehiculo->get_dominio(); ?></td>
     					<td><?php echo $clsCiudad->get_nom_ciudad() . " (" . $clsCiudad->get_nom_provincia() . ")"; ?></td>
     				</tr>
     				<tr>
     					<td>
     					<!-- condicion de iva -->
     					<?php
     					if($clsCliente->_id_condiva == 1){
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
     					}else{
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
						}
     					?>
     					</td>
     					<td style="height:60px"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $clsCliente->get_ruc_persona(); ?></td>
     				</tr>
     				<tr>
     					<td>
     					<!-- forma de pago -->
     					<?php
     					if($forpago == 3){
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
     					}else{
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
						}
     					?>
     					</td>
     					<td style="height:10px"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $re_y_or; ?></td>
     				</tr>
     			</tbody>
     		</table>
     		
     		<!-- DETALLE -->
     		<div id="fecha" style="width:850px; height:850px">
		 		<table class="tabledata" border="0">
		 			<thead>
		                <tr>
		                    <th style="width: 55px; height:40px"></th>
		                    <th style="width: 105px"></th>
		                    <th style="width: 390px"></th>
		                    <th style="width: 50px"></th>
		                    <th style="width: 105px"></th>
		                    <th style="width: 105px"></th>
		                </tr>
		            </thead>
		 			<tbody>
		 				<?php foreach($arr as $id){
		                    $tmp=  explode("|", $id);
		                    ?>
		                <tr>
		                    <td style="width: 55px; vertical-align:top" ><?php echo $tmp[4] ?></td>
		                    <td style="width: 125px; vertical-align:top"><?php echo $tmp[1] ?></td>
		                    <td style="width: 440px"><?php echo $tmp[2] ?></td>
		                    <td style="width: 50px"></td>
		                    <td style="width: 105px; vertical-align:top"><?php echo $tmp[3] ?></td>
		                    <td style="width: 105px; vertical-align:top"><?php echo $tmp[5] ?></td>
		                </tr>
		                <?php } ?>
		 			</tbody>
		 		</table>
		 	</div>
		 	
		 	<!-- TOTALES -->
		 	<table class="tabledata" border="0">
	 			<thead>
	                <tr>
	                    <th style="width: 110px; height:10px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 150px"></th>
	                    <th style="width: 70px"></th>
	                </tr>
	            </thead>
	 			<tbody>
	 				<tr>
	                    <td style="width: 110px"><?php echo $subtotal ?></td>
	                    <td style="width: 110px"></td>
	                    <td style="width: 110px"><?php echo $descu ?></td>
	                    <td style="width: 110px"></td>
	                    <td style="width: 110px" align="right"><?php echo $iva21+$iva10 ?></td>
	                    <td style="width: 150px"></td>
	                    <td style="width: 70px" align="right"><?php echo $total ?></td>
	                </tr>
	 			</tbody>
	 		</table>
     	</div>
    </div>   
	<div id="regulador" style="width:850px; height:65px"></div>
    <div id="fondo" style="width:850px; height:1150px">
     	<div id="fecha" style="width:850px">
     		<!-- FECHA -->
     		<table class="tabledata" border="0">
     			<thead>
                    <tr>
                        <th style="width: 510px; height:80px"></th>
                        <th style="width: 140px"></th>
                    </tr>
                </thead>
     			<tbody>
     				<tr>
     					<td></td>
     					<td><?php echo $fecha; ?></td>
				</tr>
     			</tbody>
     		</table>
     		<!-- CLIENTE -->
     		<table class="tabledata" border="0">
     			<thead>
                    <tr>
                    	<th style="width: 70px; height:91px" ></th>
                        <th style="width: 450px"></th>
                        <th style="width: 300px; textAlign:right"><br><br><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRIPLICADO"; ?></th>
                    </tr>
                </thead>
     			<tbody>
     				<tr>
     					<td></td>
     					<td><?php echo $clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona(); ?></td>
     					<td><?php echo $clsCliente->get_direc_persona()?></td>
     				</tr>
     				<tr>
	     				<td></td>
     					<td><?php echo $clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(). " - " . $clsVehiculo->get_dominio(); ?></td>
     					<td><?php echo $clsCiudad->get_nom_ciudad() . " (" . $clsCiudad->get_nom_provincia() . ")"; ?></td>
     				</tr>
     				<tr>
     					<td>
     					<!-- condicion de iva -->
     					<?php
     					if($clsCliente->_id_condiva == 1 ){
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
     					}else{
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
						}
     					?>
     					</td>
     					<td style="height:60px"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $clsCliente->get_ruc_persona(); ?></td>
     				</tr>
     				<tr>
     					<td>
     					<!-- forma de pago -->
     					<?php
     					if($forpago == 3){
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
     					}else{
     						echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>';
						}
     					?>
     					</td>
     					<td style="height:10px"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $re_y_or; ?></td>
     				</tr>
     			</tbody>
     		</table>
     		
     		<!-- DETALLE -->
     		<div id="fecha" style="width:850px; height:850px">
		 		<table class="tabledata" border="0">
		 			<thead>
		                <tr>
		                    <th style="width: 55px; height:40px"></th>
		                    <th style="width: 105px"></th>
		                    <th style="width: 390px"></th>
		                    <th style="width: 50px"></th>
		                    <th style="width: 105px"></th>
		                    <th style="width: 105px"></th>
		                </tr>
		            </thead>
		 			<tbody>
		 				<?php foreach($arr as $id){
		                    $tmp=  explode("|", $id);
		                    ?>
		                <tr>
		                    <td style="width: 55px; vertical-align:top" ><?php echo $tmp[4] ?></td>
		                    <td style="width: 125px; vertical-align:top"><?php echo $tmp[1] ?></td>
		                    <td style="width: 440px"><?php echo $tmp[2] ?></td>
		                    <td style="width: 50px"></td>
		                    <td style="width: 105px; vertical-align:top"><?php echo $tmp[3] ?></td>
		                    <td style="width: 105px; vertical-align:top"><?php echo $tmp[5] ?></td>
		                </tr>
		                <?php } ?>
		 			</tbody>
		 		</table>
		 	</div>
		 	
		 	<!-- TOTALES -->
		 	<table class="tabledata" border="0">
	 			<thead>
	                <tr>
	                    <th style="width: 110px; height:10px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 110px"></th>
	                    <th style="width: 150px"></th>
	                    <th style="width: 70px"></th>
	                </tr>
	            </thead>
	 			<tbody>
	 				<tr>
	                    <td style="width: 110px"><?php echo $subtotal ?></td>
	                    <td style="width: 110px"></td>
	                    <td style="width: 110px"><?php echo $descu ?></td>
	                    <td style="width: 110px"></td>
	                    <td style="width: 110px" align="right"><?php echo $iva21+$iva10 ?></td>
	                    <td style="width: 150px"></td>
	                    <td style="width: 70px" align="right"><?php echo $total ?></td>
	                </tr>
	 			</tbody>
	 		</table>
     	</div>
    </div>    
    </body>
</html>
