<?php
include_once 'CONTROLLER/C_Debug.php';
include 'fpdf17/fpdf.php';

//inicializo todas las variables
$proveedor	= $_GET['proveedor'];
$cuit 		= $_GET['cuit'];
$numero		= $_GET['numero'];
$fecha		= $_GET['fecha'];
$obs		= $_GET['obs'];
$total		= $_GET['total'];
$efectivo	= $_GET['efectivo'];
$debito		= $_GET['debito'];
$saldo      = $_GET['saldo'];

$arr		= explode("~", $_GET['detalle']);

$facturas	= array();
$cheques 	= array();
$retenciones= array();
$trans 		= array();

if($arr[0] != "")
	$facturas	= explode("^", $arr[0]);
if($arr[1] != "")
	$cheques 	= explode("^", $arr[1]);
if($arr[2] != "")
	$retenciones= explode("^", $arr[2]);
if($arr[3] != "")
	$trans 		= explode("^", $arr[3]);

$arr_fecemi = explode('-',$fecha);

$Data		= $_GET['detalle'];
$arr = array();
if($Data != "")
	$arr		= explode("^", $Data);

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
	$pdf->Cell(35,6,"ORDEN DE PAGO",$bd);

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
	$pdf->Cell(10,6," 002-".$numero,$bd,0,'C');

	//linea divisora
	$pdf->Line(5,37,205,37);

	/*
	* DATOS DEL PROVEEDOR
	*/

	$pdf->SetXY(6,38);
	//cliente
	$pdf->Cell(22,6,"Proveedor: " , $bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(131,6,$proveedor,$bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(15,6,"CUIT: " , $bd);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(35,6,$cuit,$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();

	//detalles
	$pdf->setXY(5,44);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(200,8,"DETALLE DE LA ORDEN DE PAGO", 1,0,'C');
	$pdf->Ln();

	//facturas
	$pdf->SetFont('Times','B',13);
	$pdf->setXY(5,52);
	$pdf->Cell(120,5,'Facturas',1,0,'C');
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(30,5,'Numero',1,0,'C');
	$pdf->Cell(30,5,'Fecha',1,0,'C');
	$pdf->Cell(30,5,'Importe',1,0,'C');
	$pdf->Cell(30,5,'Pendiente',1,0,'C');
	$pdf->SetFont('Times','',12);
	$total_fact = 0;
	foreach($facturas as $fact)
	{
		$pdf->Ln();
		$arr = explode('|', $fact);
		$pdf->SetX(5);
		$pdf->Cell(30,5,$arr[1],1,0,'C');
		$pdf->Cell(30,5,$arr[2],1,0,'C');
		$pdf->Cell(30,5,"$".$arr[3],1,0,'C');
		$pdf->Cell(30,5,"$".$arr[4],1,0,'C');
		$total_fact = $total_fact + $arr[3] - $arr[4];
	}
	for($i = 1 ; $i <= 15 - count($facturas) ; $i++)
	{
		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->Cell(30,5,"",1,0,'C');
		$pdf->Cell(30,5,"",1,0,'C');
		$pdf->Cell(30,5,"",1,0,'C');
		$pdf->Cell(30,5,"",1,0,'C');
	}
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(90,5,"TOTAL",1,0,'R');
	$pdf->Cell(30,5, "$" . $total_fact, 1,0,'C');


	//Cheques
	$pdf->SetFont('Times','B',13);
	$pdf->setXY(5,150);
	$pdf->Cell(120,5,'Cheques',1,0,'C');
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(30,5,'Numero',1,0,'C');
	$pdf->Cell(30,5,'Banco',1,0,'C');
	$pdf->Cell(30,5,'Fecha',1,0,'C');
	$pdf->Cell(30,5,'Importe',1,0,'C');
	$pdf->SetFont('Times','',12);
	$total_cheque;
	foreach($cheques as $cheq)
	{
		$pdf->Ln();
		$arr = explode('|', $cheq);
		$pdf->SetX(5);
		$pdf->Cell(30,5,$arr[0],1,0,'C');
		$pdf->Cell(30,5,$arr[1],1,0,'C');
		$pdf->Cell(30,5,$arr[2],1,0,'C');
		$pdf->Cell(30,5,"$".$arr[3],1,0,'C');
		$total_cheque = $total_cheque + $arr[3];
	}
	for($i = 1 ; $i <= 10 - count($cheques) ; $i++)
	{
		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->Cell(30,5,"",1,0,'C');
		$pdf->Cell(30,5,"",1,0,'C');
		$pdf->Cell(30,5,"",1,0,'C');
		$pdf->Cell(30,5,"",1,0,'C');
	}
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(90,5,"TOTAL",1,0,'R');
	$pdf->Cell(30,5, "$" . $total_cheque, 1,0,'C');


	//retenciones
	$pdf->SetFont('Times','B',13);
	$pdf->setXY(130,52);
	$pdf->Cell(75,5,'Retenciones',1,0,'C');
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->Cell(25,5,'Numero',1,0,'C');
	$pdf->Cell(25,5,'Tipo',1,0,'C');
	$pdf->Cell(25,5,'Importe',1,0,'C');
	$pdf->SetFont('Times','',12);
	$total_retencion = 0;
	foreach($retenciones as $reten)
	{
		$pdf->Ln();
		$arr = explode('|', $reten);
		$pdf->SetX(130);
		$pdf->Cell(25,5,$arr[0],1,0,'C');
		$pdf->Cell(25,5,$arr[1],1,0,'C');
		$pdf->Cell(25,5,"$".$arr[2],1,0,'C');
		$total_retencion = $total_retencion + $arr[2];
	}
	for($i = 1 ; $i <= 5 - count($retenciones) ; $i++)
	{
		$pdf->Ln();
		$pdf->SetX(130);
		$pdf->Cell(25,5,"",1,0,'C');
		$pdf->Cell(25,5,"",1,0,'C');
		$pdf->Cell(25,5,"",1,0,'C');
	}
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(50,5,"TOTAL",1,0,'R');
	$pdf->Cell(25,5, "$" . $total_retencion, 1,0,'C');


	//transferencias
	$pdf->SetFont('Times','B',13);
	$pdf->setXY(130,100);
	$pdf->Cell(75,5,'Transferencias',1,0,'C');
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->Cell(50,5,'Numero',1,0,'C');
	$pdf->Cell(25,5,'Importe',1,0,'C');
	$pdf->SetFont('Times','',12);
	$total_trans = 0;
	foreach($trans as $tra)
	{
		$pdf->Ln();
		$arr = explode('|', $tra);
		$pdf->SetX(130);
		$pdf->Cell(50,5,$arr[0],1,0,'C');
		$pdf->Cell(25,5,"$".$arr[1],1,0,'C');
		$total_trans = $total_trans + $arr[1];
	}
	for($i = 1 ; $i <= 5 - count($trans) ; $i++)
	{
		$pdf->Ln();
		$pdf->SetX(130);
		$pdf->Cell(50,5,"",1,0,'C');
		$pdf->Cell(25,5,"",1,0,'C');
	}
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(50,5,"TOTAL",1,0,'R');
	$pdf->Cell(25,5, "$" . $total_trans, 1,0,'C');

	//efectivo
	$pdf->Ln();
	$pdf->SetXY(130, 150);
	$pdf->Cell(50,5,"Efectivo",1,0,'C');
	$pdf->Cell(25,5, "$" . $efectivo, 1,0,'C');
	//debito
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->Cell(50,5,"Débito",1,0,'C');
	$pdf->Cell(25,5, "$" . $debito, 1,0,'C');



	//totales
	$pdf->SetFont('Times','B',13);
	$pdf->setXY(130,175);
	$pdf->Cell(75,5,'TOTALES',1,0,'C');
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(35,5,'Cheques',1,0,'R');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,5,"$".$total_cheque,1,0,'C');
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(35,5,'Retenciones',1,0,'R');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,5,"$".$total_retencion,1,0,'C');
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(35,5,'Transferencias',1,0,'R');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,5,"$".$total_trans,1,0,'C');
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(35,5,'Efectivo',1,0,'R');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,5,"$".$efectivo,1,0,'C');
    $pdf->Ln();
    $pdf->SetX(130);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(35,5,'Saldo anterior',1,0,'R');
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(40,5,"$".$saldo,1,0,'C');
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(35,5,'Débito',1,0,'R');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(40,5,"$".$debito,1,0,'C');
	$total = $total_cheque + $total_retencion + $total_trans + $efectivo;
	$pdf->Ln();
	$pdf->SetX(130);
	$pdf->SetFont('Times','B',13);
	$pdf->Cell(35,5,'TOTAL',1,0,'R');
	$pdf->Cell(40,5,"$".$total,1,0,'C');

	//Observaciones
	$pdf->SetFont('Times','',12);
	$pdf->Ln();
	$pdf->SetXY(5, 220);
	$pdf->MultiCell(190,6,"Observaciones: " . $obs, $bd);

	$pdf->Ln();
	$pdf->SetXY(160,276);
	$pdf->Cell(40,3,"....................................",$bd,0);
	$pdf->Ln();
	$pdf->SetX(160);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(40,3,"Firma proveedor",$bd,0, 'C');

	$pdf->Ln();
	$pdf->SetXY(5,-11);
	$pdf->SetFont('Times','',11);
	$pdf->Cell(200,6,"Los precios expresados no incluyen IVA y pueden variar sin previo aviso",1,0,'C');


//}

$pdf->Output("impresiones/orden_de_pago/".$numero.".pdf","F");
$pdf->Output();

?>
