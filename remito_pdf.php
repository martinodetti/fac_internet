<?php

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Vehiculo.php';
include 'MODEL/Ciudad.php';
include 'fpdf17/fpdf.php';

//inicializo todas las variables
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

$arr_fecemi = explode('-',$fecha);

$Data		= $_GET['detalle'];
$arr = array();
if($Data != "")
	$arr		= explode("^", $Data);

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
	$pdf->setXY(145,8);
	$pdf->Cell(35,6,"REMITO",$bd);
	
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
	
	
	$pdf->SetXY(6,38);
	//cliente
	$pdf->Cell(17,6,"Cliente: " , $bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(181,6,$clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(6);
	//direccion
	$pdf->Cell(21,6,"Dirección: ", $bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(122,6,$clsCliente->get_direc_persona() . " - " . $clsCiudad->get_nom_ciudad() . " - " . $clsCiudad->get_nom_provincia(), $bd);
	$pdf->setFont('Times','',13);
	//telefono
	$pdf->Cell(19,6,"Teléfono: ",$bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(38,6,$clsCliente->get_telf_persona(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(6);
	//vehiculo
	$pdf->Cell(21,6,"Vehículo: ", $bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(122,6,$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(), $bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(19,6,"Patente: ",$bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(38,6,$clsVehiculo->get_dominio(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(6);
	$pdf->MultiCell(198,6,"Concepto: " . $concepto, $bd);
	$pdf->Line(5,72,205,72);

	/*
	* DETALLE DEL PRESUPUESTO
	*/
	
	$pdf->setXY(5,72);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(200,8,"DETALLE DEL REMITO", 1,0,'C');
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(16,6,"CANT",1,0,'C');
	$pdf->Cell(29,6,"CODIGO",1,0,'C');
	if($mostrar_precios == 1)
	{
		$pdf->Cell(129,6,"DETALLE",1,0,'C');
		$pdf->Cell(26,6,"PRECIO",1,0,'C');
	}
	else
	{
		$pdf->Cell(155,6,"DETALLE",1,0,'C');
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
        			$pdf->SetX(179);
        			$pdf->Cell(26,5,$tmp[4],1,0,'C');
        			$pdf->SetX(50);
        			$pdf->MultiCell(129,5,$tmp[1],1);
        		}else{
        			$pdf->MultiCell(155,5,$tmp[1],1);
        		}
        		$pdf->setY($pdf->getY()-5);
        		break;
        	default:
        		if($mostrar_precios == 1){
        			$pdf->Cell(129,5,$tmp[1],1);
        			$pdf->Cell(26,5,$tmp[4],1,0,'C');
        		}else{
        			$pdf->Cell(155,5,$tmp[1],1);
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
			$pdf->Cell(129,5,"",1);
			$pdf->Cell(26,5,"",1,0,'C');
		}else{
			$pdf->Cell(155,5,"",1);
		}
		$i = $pdf->getY();
	}
	
	/*
	* TOTAL
	*/
	if($mostrar_precios == 1){
		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->SetFont('Times','B',13);
		$pdf->Cell(174,5,"TOTAL",1,0,'R');
		$pdf->Cell(26,5,$total,1,0,'C');
	}
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->SetFont('Times','',11);
	$pdf->Cell(200,6,"Los precios expresados no incluyen IVA y pueden variar sin previo aviso",1,0,'C');
	

//}

$pdf->Output("impresiones/remitos/".$numero.".pdf","F");
$pdf->Output();

?>
