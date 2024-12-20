<?php
/*
require_once 'html2pdf4/html2pdf.class.php';

$param = $_SERVER['QUERY_STRING'];
$url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . str_replace("factura_pdf.php",$_GET['url_old'], $_SERVER["SCRIPT_NAME"]);
$id_fact = $_GET['tipo_fact'] . $_GET['numero'];

$html = file_get_contents($url . "?" . $param);
$html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(5, 0, 5, 0));
//$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($html);
$html2pdf->Output($id_fact .".pdf",1);
//$html2pdf->Output("impresiones/facturas/" . $id_fact . ".pdf",'F');

HSTA ACA LA PRUEBA CON LA LIBRERÍA HTML2PDF QUE NO ME FUNCIONÓ MUY BIEN
*/
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

//codicion de iva
if($clsCliente->_id_condiva == 1){
	$RI = "X";
	$RNI = "";
}else{
	$RI = "";
	$RNI = "X";
}

//forma de pago
if($forpago == 3){
	$ctaCte = "X";
	$contado = "";
}else{
	$ctaCte = "";
	$contado = "X";
}

$bd = 0; //border debug
//empiezo a crear el archivo PDF	

$pdf = new fpdf('p','mm');

$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false);

$arr_hojas = array('ORIGINAL','DUPLICADO','TRIPLICADO');
for($i=0; $i<=2; $i++)
{
	$hoja = $arr_hojas[$i];

	$pdf->Addpage();
	//$pdf->cMargin = 0;
	$pdf->SetFont('Arial','',10);

	//FECHA
	$pdf->Cell(210,26,"",$bd);
	$pdf->Ln();
	$pdf->Cell(126,4,"",$bd);
	$pdf->Cell(84,4,$fecha,$bd);
	$pdf->Ln();
	//ORIGINA / DUPLICADO / TRIPLICADO
	$pdf->Cell(210,15,"",$bd);
	$pdf->Ln();
	$pdf->Cell(173,4,"",$bd);
	$pdf->Setfont('Arial','B',11);
	$pdf->Cell(37,4,$hoja,$bd);
	$pdf->Setfont('Arial','',10);
	$pdf->Ln();
	//DATOS DEL CLIENTE
	$pdf->Cell(210,3,"",$bd);
	$pdf->Ln();
	//nombre y direccion
	$pdf->Cell(21,6,"",$bd);
	$pdf->Cell(109,6,$clsCliente->get_nom_persona(). " " . $clsCliente->get_ape_persona(),$bd);
	$pdf->Cell(80,6,$clsCliente->get_direc_persona(), $bd);
	$pdf->Ln();
	//vehiculo y ciudad
	$pdf->Cell(21,6,"",$bd);
	$pdf->Cell(109,6,$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(). " - " . $clsVehiculo->get_dominio() . '. ' . $obs,$bd);
	$pdf->Cell(80,6,$clsCiudad->get_nom_ciudad() . " (" . $clsCiudad->get_nom_provincia() . ")", $bd);
	$pdf->Ln();
	//cuit y tipo de cliente
	
	$pdf->Cell(210,4,"",$bd); //separador
	$pdf->Ln();
	$pdf->Cell(60,5,"",$bd);
	$pdf->Cell(4,5,$RI,$bd);
	$pdf->Cell(41,5,"",$bd);
	$pdf->Cell(4,5,$RNI,$bd);
	$pdf->Cell(25,5,"",$bd);
	$pdf->Cell(76,5,$clsCliente->get_ruc_persona(),$bd);
	$pdf->Ln();
	//forma de pago y numeros de OR y Remitos
	$pdf->Cell(210,4,"",$bd); //separador
	$pdf->Ln();
	$pdf->Cell(66,5,"",$bd);
	$pdf->Cell(4,5,$contado,$bd);
	$pdf->Cell(35,5,"",$bd);
	$pdf->Cell(4,5,$ctaCte,$bd);
	$pdf->Cell(30,5,"",$bd);
	$pdf->Cell(71,5,$re_y_or,$bd);
	$pdf->Ln();

	//DETALLE
	$pdf->Cell(210,12,"",$bd);
	$pdf->Ln();
	foreach($arr as $id){
		$tmp=  explode("|", $id);
		if($tmp[0] > 0){
			$pdf->Cell(4,6,"",$bd);
			$pdf->Cell(12,6,$tmp[4],$bd,0,"R");
			$pdf->Cell(30,6,$tmp[1],$bd,0,"C");
			$pdf->Cell(112,6,$tmp[2],$bd);
			$pdf->Cell(25,6,$tmp[3],$bd);
			$pdf->Cell(29,6,$tmp[5],$bd);
		}
		else
		{
			$pdf->Cell(4,6,"",$bd);
			$pdf->Cell(13,6,$tmp[4],$bd,0,"R");
			$pdf->Cell(30,6,$tmp[1],$bd,0,"C");
			$pdf->SetX(158);
			$pdf->Cell(25,6,$tmp[3],$bd);
			$pdf->Cell(29,6,$tmp[5],$bd);
			$pdf->SetX(45);
			$pdf->MultiCell(112,6,$tmp[2],$bd);
			
		}
		
		$pdf->Ln();
		
	}

	//TOTALES
	$pdf->SetY(284);
	$pdf->Cell(6,6,"",$bd);
	$pdf->Cell(17,6,$subtotal,$bd);
	$pdf->Cell(38,6,"",$bd);
	$pdf->Cell(20,6,$descu,$bd);
	$pdf->Cell(47,6,"",$bd);
	$pdf->Cell(22,6,$iva21+$iva10,$bd);
	$pdf->Cell(34,6,"",$bd);
	$pdf->Cell(26,6,$total,$bd);
}


$pdf->Output("impresiones/facturas/".$id_fact.".pdf","F");
$pdf->Output();

sleep(1);
exec("lp -d HP_LaserJet_Professional_P_1102w impresiones/facturas/".$id_fact.".pdf");

?>
