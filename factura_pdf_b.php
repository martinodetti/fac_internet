<?php

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Ciudad.php';
include 'MODEL/Vehiculo.php';
include 'fpdf17/fpdf.php';

//inicializo todas las variables
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
$obs		= $_GET['obs'];
$arr		= explode("^", $Data);
$id_fact 	= $_GET['tipo_fact'] . $_GET['numero'];

$re_y_or = "";
if($remis !="" )
	$re_y_or = $remis . ",";
if($ordens != "")
	$re_y_or = $re_y_or . $ordens;

switch($clsCliente->_id_condiva){
	case 2:
		$condCliente = "Monotributista";
		break;
	case 3:
                $condCliente = "Cons. Final";
                break;
	case 4:
                $condCliente = "Excento";
                break;
}
/*
if($clsCliente->_id_condiva == 2){
	$condCliente = "MONOTRIBUTISTA";
}else{
	$condCliente = "Cons. Final";
}
*/

$bd = 0; //border debug
//empiezo a crear el archivo PDF	

$pdf = new fpdf('p','mm');

$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false);

$arr_hojas = array('ORIGINAL','DUPLICADO','TRIPLICADO');
for($i=0; $i<=1; $i++)
{
	$hoja = $arr_hojas[$i];

	$pdf->Addpage();
	//$pdf->cMargin = 0;
	$pdf->SetFont('Arial','',10);

	//FECHA
	$pdf->Cell(210,29,"",$bd);
	$pdf->Ln();
	$pdf->Cell(135,4,"",$bd);
	$pdf->Cell(75,4,$fecha,$bd);
	$pdf->Ln();
	//DATOS DEL CLIENTE
	$pdf->Cell(210,19,"",$bd);
	$pdf->Ln();
	//nombre y direccion
	$pdf->Cell(49,5,"",$bd);
	$pdf->Cell(82,5,$clsCliente->get_nom_persona(). " " . $clsCliente->get_ape_persona(),$bd);
	$pdf->Cell(80,5,$clsCliente->get_direc_persona() . ". " .$clsCiudad->get_nom_ciudad()  , $bd);
	$pdf->Ln();
	//vehiculo y ciudad
	$pdf->Cell(210,3,"",$bd);
	$pdf->Ln(); //separador
	$pdf->Cell(49,5,"",$bd);
	$pdf->Cell(82,5,$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(). " - " . $clsVehiculo->get_dominio() . ". " . $obs,$bd);
	$pdf->Cell(80,5,$clsCliente->get_telf_persona() . " - " . $clsCliente->get_cel_persona(), $bd);
	$pdf->Ln();
	//cuit y tipo de cliente
	$pdf->Cell(210,3,"",$bd);
	$pdf->Ln(); //separador
	$pdf->Cell(49,5,"",$bd);
	$pdf->Cell(82,5,$condCliente,$bd);
	$pdf->Cell(80,5,$clsCliente->get_ruc_persona(),$bd);
	$pdf->Ln();

	//DETALLE
	$pdf->Cell(210,12,"",$bd);
	$pdf->Ln();
	foreach($arr as $id){
		$tmp=  explode("|", $id);
		$pdf->Cell(12,6,"",$bd);
		$pdf->Cell(13,6,$tmp[4],$bd);
		$pdf->Cell(25,6,$tmp[1],$bd);
		$pdf->Cell(114,6,$tmp[2],$bd);
		$pdf->Cell(22,6,$tmp[3],$bd,0,"C");
		$pdf->Cell(24,6,$tmp[5],$bd,0,"C");
		$pdf->Ln();
	}

	//TOTALES
	$pdf->SetY(279);
	$pdf->Cell(180,6,"",$bd);
	$pdf->Cell(30,6,$total,$bd,0,"C");
}

$pdf->Output("impresiones/facturas/".$id_fact.".pdf","F");
$pdf->Output();

sleep(1);
exec("lp -d HP_LaserJet_Professional_P_1102w impresiones/facturas/".$id_fact.".pdf");

?>
