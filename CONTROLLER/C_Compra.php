<?php

// Capa de Seguridadinclude 'Seguridad.php';
// Capa de Acceso a BD.

include '../DAC/Database.class.php';
include '../MODEL/Compra.php';
include '../MODEL/Detalle_compra.php';
include '../MODEL/Producto.php';
include '../MODEL/Persona.php';
include '../MODEL/Kardex.php';
include '../MODEL/Detalle_kardex.php';
include '../VIEW/W_Compra.php';
include 'C_Debug.php';

$out="";
if(isset ($_POST['opc']))
$opc=$_POST['opc'];
else
$opc=$_GET['opc'];

switch ($opc) {

case '1': //add

	// Todos los POST que interviene.

	$id_compra			=0;
	$id_provd			=$_GET['save_id_provd'];  //1
	$estado_compra		=$_GET['save_forma_pago'];
	$guiacod_compra		=$_GET['save_guiacod_compra']; //1
	$total_compra		=$_GET['save_total_compra']; //1
	$obs_compra			=$_GET['save_obs_compra']; //1
	$iva21_compra		=$_GET['save_iva21_compra'];
	$iva10_compra		=$_GET['save_iva10_compra'];
	$subtotal_compra	=$_GET['save_subtotal_compra'];
	$fec_compra			=$_GET['save_fec_compra']; //1
	$percepcion 		=$_GET['txt_percepcion'];
	$iibb_ret			=$_GET['save_iibb_ret'];
	$iva_ret			=$_GET['save_iva_ret'];
	$ganancia_ret		=$_GET['save_ganancia_ret'];
	$descuento			=$_GET['save_descuento'];
	$fec_ingreso		=$_GET['save_fec_compra_ingreso'];
	$concepto_nograv	=$_GET['save_concepto_nograv'];

	$nota_credito = 0;
	$nota_debito = 0;
	if($_GET['cmb_tipo_fact'] == 2){
		$nota_credito	= 	1;
	}else if ($_GET['cmb_tipo_fact'] == 3){
		$nota_debito = 1;
	}

	//damos vuelta la fecha
	$arr_fec_tmp = explode('-', $fec_compra);
	$fec_compra = $arr_fec_tmp[2] . '-' . $arr_fec_tmp[1] . '-' . $arr_fec_tmp[0];

    $arr_fec_tmp1 = explode('-', $fec_ingreso);
    $fec_ingreso = $arr_fec_tmp1[2] . '-' . $arr_fec_tmp1[1] . '-' . $arr_fec_tmp1[0];


	$compra=new compra();
	$compra->set_id_provd($id_provd);
	$compra->set_guiacod_compra($guiacod_compra);
	$compra->set_total_compra($total_compra);
	$compra->set_obs_compra($obs_compra);
	$compra->set_fec_compra($fec_compra);
	$compra->set_baseGrava_compra($baseGrava_compra);
	$compra->set_estado_compra($estado_compra);
	$compra->set_iva21_compra($iva21_compra);
	$compra->set_iva10_compra($iva10_compra);
	$compra->set_subtotal_compra($subtotal_compra);
	$compra->set_percepcion_compra($percepcion);
	$compra->set_iibb_ret_compra($iibb_ret);
	$compra->set_iva_ret_compra($iva_ret);
	$compra->set_ganancia_ret_compra($ganancia_ret);
	$compra->set_descuento_compra($descuento);
	$compra->set_fec_ingreso_compra($fec_ingreso);
	$compra->set_concepto_nograv($concepto_nograv);

	$ret=$compra->addCompra($compra);
	$id_cmp=$ret['0'][0];

	if($nota_credito == 1)
		$compra->set_nota_credito($id_cmp);
	if($nota_debito == 1)
		$compra->set_nota_debito($id_cmp);


	//ahora declaro variable general para el array de productos
	$arr_id_producto="";//tipo cadena
	//fin de kardex

	//RECIBE ARRAY DE POST  de idproducto con sus respectivas cantidad y costos
	$detalle=$_POST['Detalle'];
	//instancio mi clase de detalle de compra
	$clsDetalle=new detalle_compra();
	$dt_aux=array();
	$dt_data=array();
	//inserto esa asociación de arrays en otro entendible
	foreach($detalle as $dt_aux){
	 $dt_data[]=$dt_aux;
	 //$dt_data[]=$dt_aux[0];
	}
	//ahora estan listos para ser leidos y se guarda los valores
	foreach($dt_data as $accion){
		$clsDetalle->set_id_compra($id_cmp);
		$clsDetalle->set_id_producto($accion['id']);
		$clsDetalle->set_canti_detcompra($accion['cantidad']);
		$clsDetalle->set_costouni_detcompra($accion['precio']);
		$clsDetalle->set_precio_vta_detcompra($accion['preciovta']);
		$clsDetalle->set_estado_detcompra('1');
		$clsDetalle->set_id_proveedor_detcompra($id_provd);

		$arr_id_producto=$arr_id_producto.$accion['id'].'-';

		//insertamos detalle factura o en la nota de crédito en su defecto
		//fact y nota de credito es lo mismo. Lo unico que cambia es que resta o suma el stock del producto
		if($nota_credito == 1)
			$out=$clsDetalle->addDetalle_notacredito($clsDetalle);
		else
			$out=$clsDetalle->addDetalle_compra($clsDetalle);


	}

break;

case '2' : //update  - es igual a 1 pero con la diferencia que elimino primero el detallle de la factura y despues la grabo

$id_compra			=$_GET['update_id_compra'];
$id_provd			=$_GET['save_id_provd'];  //1
$estado_compra		=$_GET['save_forma_pago'];
$guiacod_compra		=$_GET['save_guiacod_compra']; //1
$total_compra		=$_GET['save_total_compra']; //1
$obs_compra			=$_GET['save_obs_compra']; //1
$iva21_compra		=$_GET['save_iva21_compra'];
$iva10_compra		=$_GET['save_iva10_compra'];
$subtotal_compra	=$_GET['save_subtotal_compra'];
$fec_compra			=$_GET['save_fec_compra']; //1
$percepcion 		=$_GET['txt_percepcion'];
$iibb_ret			=$_GET['save_iibb_ret'];
$iva_ret			=$_GET['save_iva_ret'];
$ganancia_ret		=$_GET['save_ganancia_ret'];
$descuento			=$_GET['save_descuento'];
$concepto_nograv	=$_GET['save_concepto_nograv'];
$fec_ingreso		= date('Y-m-d');

//damos vuelta la fecha
$arr_fec_tmp = explode('-', $fec_compra);
$fec_compra = $arr_fec_tmp[2] . '-' . $arr_fec_tmp[1] . '-' . $arr_fec_tmp[0];


$compra=new compra();
$compra->set_id_compra($id_compra);
$compra->set_id_provd($id_provd);
$compra->set_guiacod_compra($guiacod_compra);
$compra->set_total_compra($total_compra);
$compra->set_obs_compra($obs_compra);
$compra->set_fec_compra($fec_compra);
$compra->set_baseGrava_compra($baseGrava_compra);
$compra->set_estado_compra($estado_compra);
$compra->set_iva21_compra($iva21_compra);
$compra->set_iva10_compra($iva10_compra);
$compra->set_subtotal_compra($subtotal_compra);
$compra->set_percepcion_compra($percepcion);
$compra->set_iibb_ret_compra($iibb_ret);
$compra->set_iva_ret_compra($iva_ret);
$compra->set_ganancia_ret_compra($ganancia_ret);
$compra->set_descuento_compra($descuento);
$compra->set_fec_ingreso_compra($fec_ingreso);
$compra->set_concepto_nograv($concepto_nograv);

$ret=$compra->updateCompra($compra);
$id_cmp=$id_compra;

//ahora declaro variable general para el array de productos
$arr_id_producto="";//tipo cadena

//RECIBE ARRAY DE POST  de idproducto con sus respectivas cantidad y costos
$detalle=$_POST['Detalle'];
//instancio mi clase de detalle de compra
$clsDetalle=new detalle_compra();
$dt_aux=array();
$dt_data=array();

//borramos el detalle cargado anteriormente
$clsDetalle->deletedetalle_compra_restar_stock($id_compra);

//inserto esa asociación de arrays en otro entendible
foreach($detalle as $dt_aux){
 $dt_data[]=$dt_aux;
 //$dt_data[]=$dt_aux[0];
}
//ahora estan listos para ser leidos y se guarda los valores
foreach($dt_data as $accion){
    $clsDetalle->set_id_compra($id_cmp);
    $clsDetalle->set_id_producto($accion['id']);
    $clsDetalle->set_canti_detcompra($accion['cantidad']);
    $clsDetalle->set_costouni_detcompra($accion['precio']);
    $clsDetalle->set_precio_vta_detcompra($accion['preciovta']);
    $clsDetalle->set_estado_detcompra('1');
    $clsDetalle->set_id_proveedor_detcompra($id_provd);

    $arr_id_producto=$arr_id_producto.$accion['id'].'-';

	$out=$clsDetalle->addDetalle_compra($clsDetalle);

}

break;

case '3' : //delete

// Todos los POST que interviene Delete.

$id_compra=$_POST['delete_id_compra'];



$compra=new compra();

$ret=$compra->deleteCompra($id_compra);

$out=$ret['rows_affected'][0];

 break;

case '4' : //show

// Todos los POST que interviene Show.

$id_compra=$_POST['show_id_compra'];

$W_compra=new W_compra();

$out=$W_compra->printCompra($id_compra);

 break;

case '5' : //print mesas
$W_compra=new W_compra();
$out=$W_compra->printCompras($fecIni,$fecFinal);
 break;


case '8'://cabecera mediante fechas
 	$clsCompra=new compra();
    $fecIni=$_POST['fec_ini'];
    $fecFinal=$_POST['fec_final'];
 	$out=$clsCompra->listJsonCompras($fecIni, $fecFinal);
 	break;

case '9'://detalle de factura
	$clsCompra=new compra();
	$id_compra=$_POST['id_compra'];
	$out = '';
	if($id_compra > 0) {
		$out=$clsCompra->lisJsonCompraDetalle_prod($id_compra);
	}
    break;


case '10': //consulto json de datos de prductos por get
	$strNomproducto = isset($_POST['q']) ? strval($_POST['q']) : '';
	$Productocmp =new producto();
	if(strlen($strNomproducto) >= 3) {
		$out=$Productocmp->listProductosPorNombreCompra($strNomproducto);
	}
	else{
		$d = array();
		$out = json_encode($d);
	}
	break;
case '11':
	$id_provd = $_POST['id_provd'];
	$provd = new persona();
	$margen = $provd->get_margen_ganancia($id_provd);

	$out = json_encode($margen);
	break;

case '12':
	$num_fact = $_POST['num_fact'];
	$id_prov = $_POST['id_prov'];

	$clsFact = new compra();
	$out = json_encode($clsFact->VerificarExistenciaNumero($num_fact, $id_prov));

	break;

case '13':
	$id_compra = $_POST['id_compra'];
	$clsCompra = new compra();

	$out = json_encode($clsCompra->showCompraEdit($id_compra));

	break;

case '14':
	$id_provd = $_POST['id_provd'];
	$clsCompra = new w_compra();
	$out = $clsCompra->printComprasProveedor($id_provd);
	break;
//igual que el anterior pero recibe el id del cliente y busca el id del proveedor asociado
case '15':
	$id_cliente = $_POST['id_cli'];
	$clsPersona = new persona();
	$id_provd = $clsPersona->get_proveedor_cliente($id_cliente);
	$clsCompra = new w_compra();
    if($id_provd > 0)
    	$out = $clsCompra->printComprasProveedor($id_provd);
    else
        $out = "";
	break;
}


die($out);



?>
