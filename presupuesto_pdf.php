<?php

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Vehiculo.php';
include 'MODEL/Ciudad.php';
include 'fpdf17/fpdf.php';

//inicializo todas las variables
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
$kms		= $_GET['kms'];
$descto		= $_GET['descto'];

if($kms != "")
	$kms = " (".$kms." kms)";

$arr_fecemi = explode('-',$fecemi);

$Data		= $_GET['detalle'];
$arr = array();
if($Data != "")
	$arr		= explode("~", $Data);

$mostrar_precios = $_GET['mostrar_precios'];

$bd = 0; //border debug
//empiezo a crear el archivo PDF

$pdf = new fpdf('p','mm');

$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false);

//en este caso va a ser una sola hoja
//$arr_hojas = array('ORIGINAL','DUPLICADO','TRIPLICADO');
//for($i=0; $i<=2; $i++)
//{
	$hoja = $arr_hojas[$i];

	$pdf->Addpage();
	//$pdf->cMargin = 0;
	$pdf->SetFont('Times','',10);

	//marco exterior
	$pdf->SetLineWidth(0.6);
	$pdf->setXY(5,5);
	$pdf->Cell(200, 287,"",1);
	$pdf->Ln();
	$pdf->setXY(10,15);
	$pdf->SetLineWidth(0.5);

	/*
	* CABECERA
	*/

	//X (tipo de documento)
	$pdf->setFont('Courier','B',27);
	$pdf->setXY(102,7);
	$pdf->Cell(7,11,"X",1,0,"C");

	//logo
	$pdf->image('IMGBKEND/LOGO.jpg',12,8,0,12);

	//titulo
	$pdf->setFont('Times','B',16);
	$pdf->setXY(135,8);
	$pdf->Cell(43,6,"PRESUPUESTO",$bd);

	//info empresa
	$pdf->SetFont('Times','',8);
	$pdf->SetXY(24,22);
	$pdf->Cell(65,2,"Acceso Sur - Km. 8.5 - Luján de Cuyo - Mendoza",$bd, 0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','B',8);
	$pdf->setXY(24,26);
	$pdf->Cell(65,2,"Líneas Rotativas 4360959 - 4360079", $bd,0,'C');

	$pdf->SetXY(76,32);
	$pdf->Cell(61,3,"DOCUMENTO NO VALIDO COMO FACTURA",$bd,0,'C');


	//fecha
	$pdf->SetFont('Times','',13);
	$pdf->SetXY(157,16);
	$pdf->Cell(13,6,"Fecha",$bd);
	$pdf->Cell(10,6,$arr_fecemi[0],1,0,'C');
	$pdf->Cell(10,6,$arr_fecemi[1],1,0,'C');
	$pdf->Cell(10,6,$arr_fecemi[2],1,0,'C');
	$pdf->Ln();
	//numero
	$pdf->SetXY(157,23);
	$pdf->Cell(13,6,"Nº",$bd);
	$pdf->Cell(10,6,$numero,$bd,0,'C');

	//linea divisora
	$pdf->Line(5,37,205,37);

	/*
	* DATOS DEL CLIENTE Y VEHICULO
	*/

	$pdf->SetXY(6,40);
	$pdf->Cell(12,6,"Entró: ", $bd);
	$pdf->Cell(30,6,"",$bd);
	$pdf->Cell(18,6,"Vehículo: ", $bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(87,6,$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo() . $kms, $bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(15,6,"Patente: ",$bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(33,6,$clsVehiculo->get_dominio() , $bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(6);
	$pdf->Cell(13,6,"Señor: ",$bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(124,6,$clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(19,6,"Teléfono: ",$bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(42,6,$clsCliente->get_telf_persona(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(6);
	$pdf->Cell(20,6,"Dirección: ", $bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(173,6,$clsCliente->get_direc_persona() . " - " . $clsCiudad->get_nom_ciudad() . " - " . $clsCiudad->get_nom_provincia(), $bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(6);
	$pdf->MultiCell(198,6,"Observaciones: " . $obs, $bd);
	$pdf->Ln();
	$pdf->SetXY(6,$pdf->gety() - 6);
	$pdf->MultiCell(198,6,"" . $voz, $bd);
	$pdf->SetXY(160,85);
	$pdf->Cell(44,6,"Firma.........................",$bd);
	$pdf->Line(5,92,205,92);

	/*
	* DETALLE DEL PRESUPUESTO
	*/

	$pdf->setXY(5,92);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(200,8,"DETALLE DEL PRESUPUESTO", 1,0,'C');
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(16,6,"Cant",1,0,'C');
	$pdf->Cell(29,6,"Codigo",1,0,'C');
	if($mostrar_precios == 1)
	{
		$pdf->Cell(115,6,"Detalle",1,0,'C');
		$pdf->Cell(20,6,"Unit",1,0,'C');
		$pdf->Cell(20,6,"Precio",1,0,'C');
	}
	else
	{
		$pdf->Cell(155,6,"Detalle",1,0,'C');
	}

	$pdf->SetFont('Times','',13);
	$pdf->SetLineWidth(0.2);
	$arr_mo_to = array('MO1','TO','MO2');
	foreach($arr as $id)
	{
        $tmp=  explode("|", $id);
        $detalle = "";

        $pdf->Ln();
        $pdf->SetX(5);
        $pdf->Cell(16,5,$tmp[3],1,0,'C');
        $pdf->Cell(29,5,$tmp[5],1,0,'C');
        switch($tmp[0])
        {
        	case 0:
        	case -1:
        	case -2:
        		if($mostrar_precios == 1){
        			$pdf->SetX(165);
        			$pdf->Cell(20,5,$tmp[2],1,0,'R');
        			$pdf->Cell(20,5,$tmp[4],1,0,'R');
        			$pdf->SetX(50);
        			$pdf->MultiCell(115,5,$tmp[1],1);
        		}else{
        			$pdf->MultiCell(145,5,$tmp[1],1);
        		}
        		$pdf->setY($pdf->getY()-5);
        		break;
        	default:
        		if($mostrar_precios == 1){
        			$pdf->Cell(115,5,$tmp[1],1);
        			$pdf->Cell(20,5,$tmp[2],1,0,'R');
        			$pdf->Cell(20,5,$tmp[4],1,0,'R');
        		}else{
        			$pdf->Cell(145,5,$tmp[1],1);
        		}
        		break;
        }
	}

	$i = $pdf->getY();
	while($i <= 275){
		$pdf->Ln();
        $pdf->SetX(5);
        $pdf->Cell(16,5,"",1,0,'C');
        $pdf->Cell(29,5,"",1,0,'C');
        if($mostrar_precios == 1){
			$pdf->Cell(115,5,"",1);
			$pdf->Cell(20,5,"",1,0,'C');
			$pdf->Cell(20,5,"",1,0,'C');
		}else{
			$pdf->Cell(145,5,"",1);
		}
		$i = $pdf->GetY();
	}

	/*
	* TOTAL
	*/
	if($mostrar_precios == 1){
		//descuento
		//total
		$pdf->Ln();
		$pdf->SetFont('Times','',13);
		$pdf->SetX(110);
		$pdf->Cell(20,5,"Descuento: $".$descto,0,0,'R');
		$pdf->SetFont('Times','B',13);
		$pdf->SetX(145);
		$pdf->Cell(20,5,"TOTAL",1,0,'R');
		$pdf->SetX(185);
		$pdf->Cell(20,5,"$".$total,0,0,'R');
	}
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->SetFont('Times','',11);
	$pdf->Cell(200,6,"Los precios expresados no incluyen IVA y pueden variar sin previo aviso",1,0,'C');

/*
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
*/
//}

$pdf->Output("impresiones/presupuestos/".$numero.".pdf","F");
$pdf->Output();

?>
