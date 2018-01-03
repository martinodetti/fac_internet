<?php

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Ciudad.php';
include 'MODEL/Vehiculo.php';
include 'fpdf17/fpdf_i25.php';

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
$cae		= $_GET['cae'];
$cae_vto	= $_GET['cae_vto'];
$tipo_doc   = $_GET['tipo_doc'];
$arr		= explode("^", $Data);
$id_fact 	= $_GET['tipo_fact'] . $_GET['numero'];

$arr_num = explode('-',$numero);
$tmp_vto = str_replace('-','',$cae_vto);
$barcode = '307097160060' . $tipo_doc . $arr_num[0] . $cae . $tmp_vto . '6';

$arr_fecemi = explode("-",$fecha);

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
$forma_pago = "";
switch($forpago){
	case 1:
		$forma_pago = 'Contado';
		break;
	case 2:
		$forma_pago = 'Contado Documento';
		break;
	case 3:
		$forma_pago = 'Cuenta Corriente';
		break;
}

$tipo_doc_desc = 'FACTURA';
if($tipo_doc == 2){
    $tipo_doc_desc = 'NOTA DE CREDITO';
}elseif($tipo_doc == 3){
    $tipo_doc_desc = 'NOTA DE DEBITO';
}


$cae_vto = str_replace("-","",$cae_vto);
$cae_vto = substr($cae_vto,6,2)."-".substr($cae_vto,4,2)."-".substr($cae_vto,0,4);


$bd = 0; //border debug
//empiezo a crear el archivo PDF

$pdf = new pdf_i25('p','mm', 'A4');

$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false);

$arr_hojas = array('ORIGINAL','DUPLICADO');
for($i=0; $i<2; $i++)
{
	$hoja = $arr_hojas[$i];

	$pdf->Addpage();
	//$pdf->cMargin = 0;
	$pdf->SetFont('Arial','',10);

	//marco exterior
	$pdf->SetLineWidth(0.6);
	$pdf->setXY(5,5);
	$pdf->Cell(200, 285,"",1);
	$pdf->Ln();
	$pdf->setXY(10,15);
	$pdf->SetLineWidth(0.5);

	/*
	* CABECERA
	*/

    //X (tipo de documento)
    $pdf->setFont('Courier','B',27);
    $pdf->setXY(99,7);
    $pdf->Cell(11,14,"B",1,0,"C");
    $pdf->SetFont('Times','',8);
    $pdf->setXY(101,18);
    $pdf->Cell(7,2,"Cod. 0".$tipo_doc,0,0,"C");

    //original o duplicado
    $pdf->setFont('Courier','B',16);
    $pdf->setXY(92,23);
    $pdf->Cell(25,5,$hoja,0,0,"C");

	//logo
	$pdf->image('IMGBKEND/LOGO.jpg',12,8,0,12);

    //titulo
    $pdf->setFont('Times','B',20);
    $pdf->setXY(140,6);
    $pdf->Cell(35,6,$tipo_doc_desc,$bd,0,"C");

	//info empresa
	$pdf->SetFont('Times','',8);
	$pdf->SetXY(24,22);
	$pdf->Cell(65,2,"Acceso Sur - Km. 8.5 - Luján de Cuyo - Mendoza",$bd, 0,'C');
	$pdf->SetFont('Times','B',8);
	$pdf->setXY(24,26);
	$pdf->Cell(65,2,"TELEFONOS: 0261-4360959 / 079", $bd,0,'C');
	$pdf->setXY(24,29);
	$pdf->Cell(65,2,"CELULARES: 0261-153371777 - 1555130709",$bd,0,'C');
	$pdf->setXY(24,32);
	$pdf->Cell(65,2,"E-MAIL: info@frenosoeste.com.ar",$bd,0,'C');

	$pdf->SetFont('Times','',8);
	$pdf->SetXY(105,27);
	$pdf->Cell(100,3,"CUIT: 30-70971600-6    ING. BRUTOS: 0555301",$bd,0,'C');
	$pdf->SetXY(105,30);
	$pdf->Cell(100,3,"ESTABLECIMIENTO: 06-0555301-00    S.TIM.: 01",$bd,0,'C');
	$pdf->SetXY(105,33);
	$pdf->Cell(100,3,"D.N.R.P.: 728060   INICIO ACTIVIDADES: 01/03/2007",$bd,0,'C');
	$pdf->SetXY(105,36);
	$pdf->Cell(100,3,"IVA RESPONSABLE INSCRIPTO", $bd, 0,'C');


	//fecha
	$pdf->SetFont('Times','',13);
	$pdf->SetXY(115,16);
	$pdf->Cell(38,5,"Fecha: " . $fecha,$bd,0);
	//numero
	$pdf->SetXY(165,16);
	$pdf->Cell(40,5,"Nº: ".$numero,$bd);

	//linea divisora
	$pdf->Line(5,40,205,40);

	/*
	* DATOS DEL CLIENTE Y VEHICULO
	*/

	$pdf->SetXY(5,41);
	//cliente
	$pdf->Cell(17,5,"Cliente: " , $bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(126,5,$clsCliente->get_nom_persona() . " " . $clsCliente->get_ape_persona(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(13,5,"CUIT: ",$bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(44,5,$clsCliente->get_ruc_persona(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(5);

	//direccion
	$pdf->Cell(21,5,"Dirección: ", $bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(122,5,$clsCliente->get_direc_persona() . " - " . $clsCiudad->get_nom_ciudad() . " - " . $clsCiudad->get_nom_provincia(), $bd);
	$pdf->setFont('Times','',13);
	//telefono
	$pdf->Cell(19,5,"Teléfono: ",$bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(38,5,$clsCliente->get_telf_persona(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(5);

	//condicion de iva, remitos y obs
//	$pdf->Cell(200,3,"",$bd);
//	$pdf->Ln(); //separador
//	$pdf->SetX(5);
	$pdf->setFont('Times','',13);
	$pdf->Cell(25,5,"Cond. IVA:",$bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(37,5,$condCliente,$bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(32,5,"Forma de pago:",$bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(40,5,$forma_pago,$bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(25,5,"Rem. y OR.:",$bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(41,5,$re_y_or,$bd);
	$pdf->Ln();

	//linea divisora
	$pdf->Line(5,58,205,58);

	//vehiculo
	$pdf->SetX(5);
	$pdf->Cell(200,3,"",$bd);
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->setFont('Times','',13);
	$pdf->Cell(21,5,"Vehículo: ", $bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(122,5,$clsVehiculo->get_marca() . " " . $clsVehiculo->get_modelo(), $bd);
	$pdf->setFont('Times','',13);
	$pdf->Cell(19,5,"Patente: ",$bd);
	$pdf->setFont('Arial','',13);
	$pdf->Cell(38,5,$clsVehiculo->get_dominio(),$bd);
	$pdf->setFont('Times','',13);
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->MultiCell(200,5,"Observaciones: " . $obs, $bd);

	//DETALLE
	$pdf->setXY(5,74);
	$pdf->SetX(5);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(15,5,"CANT",1,0,'C');
	$pdf->Cell(29,5,"CODIGO",1,0,'C');
	$pdf->Cell(100,5,"DETALLE",1,0,'C');
	$pdf->Cell(28,5,"UNITARIO",1,0,'C');
	$pdf->Cell(28,5,"PRECIO",1,0,'C');
	$pdf->setFont('Times','',12);

	$pdf->Line(20,79,20,275);
	$pdf->Line(49,79,49,275);
	$pdf->Line(149,79,149,275);
	$pdf->Line(177,79,177,275);

	$pdf->Ln();
	foreach($arr as $id){
		$tmp=  explode("|", $id);
		if($tmp[0] > 0){
			$pdf->SetX(5);
			$pdf->Cell(15,5,$tmp[4],$bd,0,"R");
			$pdf->Cell(29,5,$tmp[1],$bd,0,"C");
			$pdf->Cell(100,5,$tmp[2],$bd);
			$pdf->Cell(28,5,number_format($tmp[3],2,'.',''),$bd,0,'R');
			$pdf->Cell(28,5,number_format($tmp[5],2,'.',''),$bd,0,'R');
		}
		else
		{
			$pdf->SetX(5);
			$pdf->Cell(15,5,$tmp[4],$bd,0,"R");
			$pdf->Cell(29,5,$tmp[1],$bd,0,"C");
			$pdf->SetX(149);
			$pdf->Cell(28,5,number_format($tmp[3],2,'.',''),$bd,0,'R');
			$pdf->Cell(28,5,number_format($tmp[5],2,'.',''),$bd,0,'R');
			$pdf->SetX(49);
			$pdf->MultiCell(100,5,$tmp[2],$bd);

		}
		$pdf->Ln();
	}

	//TOTALES
	//$pdf->SetY(325);
	$pdf->Line(5,275,200,275);
	$pdf->i25(33,277,$barcode,0.5,8);
	$pdf->SetY(275);
	$pdf->setFont('Times','B',13);
	$pdf->Cell(125,6,"",$bd);
	$pdf->Cell(40,6,"DESCUENTO",1,0,"C");
	$pdf->Cell(40,6,"TOTAL",1,0,"C");
	$pdf->Ln();
	$pdf->Cell(125,9,"",$bd);
	$pdf->setFont('Arial','',14);
	$pdf->Cell(40,9,$descu,1,0,"C");
	$pdf->Cell(40,9,$total,1,0,"C");

	$pdf->setFont('Times','',10);
	$pdf->setXY(5,291);
	$pdf->Cell(80,5,"FACTURA ELECTRONICA",0,0,'L');
	$pdf->setXY(120,291);
	$pdf->Cell(85,5,"CAE: ".$cae."          VTO. CAE: " .$cae_vto,0,0,'R');

}

$pre = "FC_";
if($tipo_doc == 2)
    $pre = "NC_";
else if($tipo_doc == 3)
    $pre = "ND_";


$pdf->Output("impresiones/facturas/".$pre.$id_fact.".pdf","F");
$pdf->Output();

//sleep(1);
//exec("lp -d HP_LaserJet_Professional_P1102w impresiones/facturas/".$id_fact.".pdf");

?>
