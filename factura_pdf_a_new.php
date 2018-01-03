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

//logger($_GET['numero']. "|" .$_GET['fecha']);

$numero		= $_GET['numero'];
//$fecha		= $_GET['fecha'];
$fecha		= date('d-m-Y');
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


$condCliente = "";
//Condicion de iva
if($clsCliente->_id_condiva == 1){
	$condCliente = "Resp. Inscrip.";
}else{
	$condCliente = "Resp. No Inscripto";
}

$formPago = "";
if($forpago == 3){
	$formPago = "Cta. Cte.";
}else{
	$formPago = "Contado";
}


$bd = 0; //border debug
//empiezo a crear el archivo PDF	

//$pdf = new fpdf('p','mm');
$pdf = new fpdf('p','mm', 'A4');

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
	$pdf->Cell(210,31,"",$bd);
	$pdf->Ln();
	$pdf->Cell(140,4,"",$bd);
	$pdf->Cell(22,4,$fecha,$bd);
	$pdf->Cell(18,4,"",$bd);
	$pdf->Cell(30,4,$hoja,$bd);
	$pdf->Ln();
	
	//DATOS DEL CLIENTE
	$pdf->Cell(210,19,"",$bd);
	$pdf->Ln();
	//nombre y direccion
	$pdf->Cell(32,5,"",$bd);
	$pdf->Cell(63,5,$clsCliente->get_nom_persona(). " " . $clsCliente->get_ape_persona(),$bd);
	$pdf->Cell(22,5,"",$bd);
	$pdf->Cell(93,5,$clsCliente->get_direc_persona() . ". " .$clsCiudad->get_nom_ciudad()  , $bd);
	$pdf->Ln();
	//vehiculo, telefono y cuit
	$pdf->Cell(210,3,"",$bd);
	$pdf->Ln(); //separador
	$pdf->Cell(30,5,"",$bd);
	$pdf->Cell(45,5,$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(). " - " . $clsVehiculo->get_dominio() . ". " . $obs,$bd);
	$pdf->Cell(10,5,"",$bd);
//	$pdf->Cell(40,5,$clsCliente->get_telf_persona() . " - " . $clsCliente->get_cel_persona(), $bd);
	$pdf->Cell(40,5,$clsCliente->get_telf_persona(), $bd);
	$pdf->Cell(15,5,"",$bd);
	if(strlen($re_y_or) < 15)
	{
		$pdf->Cell(25,5,$re_y_or,$bd);
	}
	else
	{
		$pdf->Cell(25,5,substr($re_y_or,0,14),$bd);
	}
	$pdf->Cell(12,5,"",$bd);
	$pdf->Cell(31,5,$clsCliente->get_ruc_persona(),$bd);
	$pdf->Ln();
	//condicion de iva, remitos y obs
	$pdf->Cell(210,3,"",$bd);
	$pdf->Ln(); //separador
	$pdf->Cell(30,5,"",$bd);
	$pdf->Cell(40,5,$condCliente,$bd);
	$pdf->Cell(25,5,"",$bd);
	$pdf->Cell(35,5,$formPago,$bd);
	$pdf->Cell(12,5,"",$bd);
	if(strlen($re_y_or) >= 15)
	{
		$pdf->Cell(70,5,substr($re_y_or,15),$bd);
	}
	else
	{
		$pdf->Cell(70,5,$obs,$bd);
	}
	$pdf->Ln();

	//DETALLE
	$pdf->Cell(210,10,"",$bd);
	$pdf->Ln();
	foreach($arr as $id){
		$tmp=  explode("|", $id);
		if($tmp[0] > 0){
			$pdf->Cell(8,5,"",$bd);
			$pdf->Cell(12,5,$tmp[4],$bd,0,"R");
			$pdf->Cell(27,5,$tmp[1],$bd,0,"C");
			$pdf->Cell(118,5,$tmp[2],$bd);
			$pdf->Cell(21,5,$tmp[3],$bd,0,'C');
			$pdf->Cell(21,5,$tmp[5],$bd,0,'C');
		}
		else
		{
			$pdf->Cell(8,5,"",$bd);
			$pdf->Cell(12,5,$tmp[4],$bd,0,"R");
			$pdf->Cell(27,5,$tmp[1],$bd,0,"C");
			$pdf->SetX(165);
			$pdf->Cell(21,5,$tmp[3],$bd,0,'C');
			$pdf->Cell(21,5,$tmp[5],$bd,0,'C');
			$pdf->SetX(47);
			$pdf->MultiCell(118,5,$tmp[2],$bd);
			
		}
		
		$pdf->Ln();
		
	}

	//TOTALES
	$pdf->SetY(284);
//	$pdf->SetY(325);
	$pdf->Cell(5,6,"",$bd);
	$pdf->Cell(52,6,$subtotal,$bd,0,'C');
	$pdf->Cell(55,6,"",$bd);
	$pdf->Cell(52,6,$descu,$bd, 0,'C');
	$pdf->Cell(22,6,$iva21+$iva10,$bd,0,'C');
	$pdf->Cell(22,6,$total,$bd, 0,'C');
	$pdf->Cell(2,6,"",$bd);
}

$pdf->Output("impresiones/facturas/".$id_fact.".pdf","F");
$pdf->Output();

sleep(1);
//exec("lp -d HP_LaserJet_Professional_P1102w impresiones/facturas/".$id_fact.".pdf");
sleep(1);
//exec("mv impresiones/facturas/".$id_fact.".pdf impresiones/facturas/".$id_fact."_.pdf");
die();

?>
