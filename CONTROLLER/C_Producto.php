<?php 

// Capa de Seguridadinclude 'Seguridad.php'; 
// Capa de Acceso a BD.

include '../DAC/Database.class.php';
include '../MODEL/Producto.php'; 
include '../VIEW/W_Producto.php'; 
include '../MODEL/Producto_proveedor.php';
include '../MODEL/Persona.php';

$out=""; 

if(isset ($_POST['opc']))
$opc=$_POST['opc']; 
else
$opc=$_GET['opc'];     

switch ($opc) { 

case '1': //add 

// Todos los POST que interviene. 

$id_producto=0; 

$id_tipoiva			=$_GET['save_id_tipoiva'];
$id_tiporeten		= 1; //$_GET['save_id_tiporeten']; 
$id_marca			=$_GET['save_id_marca']; 
$id_unimedida		=$_GET['save_id_unimedida']; 
$id_ganancia		= 1; //$_GET['save_id_ganancia']; 
$codbarra_producto	=$_GET['save_codbarra_producto']; 
$nom_producto		=$_GET['save_nom_producto']; 
$descrip_producto	=$_GET['save_descrip_producto']; 
$costo_producto		=$_GET['save_costo_producto']; 
$pvp1_producto		=$_GET['save_pvp1_producto']; 
$stock_producto		=$_GET['save_stkactual_producto'];
$stkmin_producto	=$_GET['save_stkmin_producto']; 
$stkmax_producto	=$_GET['save_stkmax_producto']; 
$img_producto		=$_GET['save_img_producto']; 
$fecing_producto	=$_GET['save_fecing_producto']; 
$posicion_producto	=$_GET['save_posicion_producto'];
$tipo				=$_GET['save_tipo'];
//Si en algun momento cambió la fecha entonces tomo esa, sino tomo el día de hoy
if($_GET['save_cambio_fecha'] == 1)
	$fecupdate_producto	=$_GET['save_fecupdate_producto']; 
else
	$fecupdate_producto	=date('d-m-Y'); 
	
$estado_producto		='1'; 

$producto=new producto();
$producto->set_id_tiporeten($id_tiporeten);
$producto->set_id_tipoiva($id_tipoiva);
$producto->set_id_marca($id_marca);
$producto->set_id_unimedida($id_unimedida);
$producto->set_id_ganancia($id_ganancia);
$producto->set_codbarra_producto($codbarra_producto);
$producto->set_nom_producto($nom_producto);
$producto->set_descrip_producto($descrip_producto);
$producto->set_costo_producto($costo_producto);
$producto->set_pvp1_producto($pvp1_producto);
$producto->set_stock_producto($stock_producto);
$producto->set_stkmin_producto($stkmin_producto);
$producto->set_stkmax_producto($stkmax_producto);
$producto->set_img_producto($img_producto);
$producto->set_fecing_producto($fecing_producto);
$producto->set_fecupdate_producto($fecupdate_producto);
$producto->set_posicion_producto($posicion_producto);
$producto->set_estado_producto($estado_producto);
$producto->set_tipo($tipo);
$ret=mysql_fetch_array($producto->addProducto($producto));
$id_prod=$ret[0]; //id del producto
$Prod_provd=new producto_proveedor();
//array de post del proveedor inserción
if(isset($_POST['Proveedor']))
{
	$pro_arr=$_POST['Proveedor'];
	$id_var=array();
	foreach($pro_arr as $id_var){
		$Prod_provd->set_id_producto($id_prod);
		$Prod_provd->set_id_proveedor($id_var[0]);
		$out=mysql_fetch_array($Prod_provd->addProducto_proveedor($Prod_provd));
	}
	$out=$out[0];
	//fin del array del proveedor
}
break; 

case '2' : //update 

// Todos los POST que interviene en Update. 

$id_producto		=$_GET['update_id_producto']; 
$id_tipoiva			=$_GET['update_id_tipoiva'];
$id_tiporeten		=1;// $_GET['update_id_tiporeten'];  
$id_marca			=$_GET['update_id_marca']; 
$id_unimedida		=$_GET['update_id_unimedida']; 
$id_ganancia		=1;//$_GET['update_id_ganancia']; 
$codbarra_producto	=$_GET['update_codbarra_producto']; 
$nom_producto		=$_GET['update_nom_producto']; 
$descrip_producto	=$_GET['update_descrip_producto']; 
$costo_producto		=$_GET['update_costo_producto']; 
$pvp1_producto		=$_GET['update_pvp1_producto']; 
$stock_producto		=$_GET['update_stkactual_producto']; 
$stkmin_producto	=$_GET['update_stkmin_producto']; 
$stkmax_producto	=$_GET['update_stkmax_producto']; 
$img_producto		=$_GET['update_img_producto']; 
$fecing_producto	=$_GET['update_fecing_producto']; 
$tipo				=$_GET['update_tipo'];
//si cambio la fecha en algun momento tomo esa sino la fecha de hoy
if($_GET['update_cambio_fecha'] == 1)
	$fecupdate_producto	=$_GET['update_fecupdate_producto'];
else
	$fecupdate_producto	= date('d-m-Y');  
	
$posicion_producto	=$_GET['update_posicion_producto'];
$estado_producto		=0; 

$producto=new producto();

$producto->set_id_producto($id_producto);

$producto->set_id_tiporeten($id_tiporeten);

$producto->set_id_tipoiva($id_tipoiva);

$producto->set_id_marca($id_marca);

$producto->set_id_unimedida($id_unimedida);

$producto->set_id_ganancia($id_ganancia);

$producto->set_codbarra_producto($codbarra_producto);

$producto->set_nom_producto($nom_producto);

$producto->set_descrip_producto($descrip_producto);

$producto->set_costo_producto($costo_producto);

$producto->set_pvp1_producto($pvp1_producto);

$producto->set_stock_producto($stock_producto);

$producto->set_stkmin_producto($stkmin_producto);

$producto->set_stkmax_producto($stkmax_producto);

$producto->set_img_producto($img_producto);

$producto->set_fecing_producto($fecing_producto);

$producto->set_fecupdate_producto($fecupdate_producto);

$producto->set_posicion_producto($posicion_producto);

$producto->set_estado_producto($estado_producto);

$producto->set_tipo($tipo);

$ret=$producto->updateProducto($producto); 
$out=$ret['rows_affected'][0]; 

//si fue chequeado el precio mal puesto
if(isset($_GET['update_chequeado_producto']) && $_GET['update_chequeado_producto'])
	$producto->chequeado($id_producto);


//ahora recibo array de proveedores
//borro e inserto los nuevos es mejor asi.
$Prod_Provd=new producto_proveedor();
$ret=$Prod_Provd->deleteProducto_proveedorIDProducto($id_producto);
$out=$ret['rows_affected'][0];
//ahora inserto los nuevos actualizados
if(isset($_POST['Proveedor']))
{
	$pro_arr=$_POST['Proveedor'];
	$id_var=array();
	foreach($pro_arr as $id_var){
		$Prod_Provd->set_id_producto($id_producto);
		$Prod_Provd->set_id_proveedor($id_var[0]);
		$out=$Prod_Provd->addProducto_proveedor($Prod_Provd);
	}
}
break; 

case '3' : //delete 

// Todos los POST que interviene Delete. 
$id_producto=$_POST['delete_id_producto']; 
$producto=new producto();
$ret=$producto->deleteProducto($id_producto); 
$out=$ret['rows_affected'][0]; 
 break; 
case '4' : //show 
// Todos los POST que interviene Show. 
$id_producto=$_POST['show_id_producto']; 
$W_producto=new W_producto();
$out=$W_producto->printProducto($id_producto);
 break; 

case '5' : //print mesas 
$W_producto=new W_producto();
$nom_prod=$_POST['show_producto'];
$out=$W_producto->printProductosPorNombre($nom_prod);
 break; 
case '7' : //print mesas 
$W_producto=new W_producto();
$nom_prod=$_POST['show_producto_delete'];
$out=$W_producto->printProductosPorNombreDelete($nom_prod);
 break; 
case '8':
    $idprod=$_GET['show_idprod'];
    $ProdProv=new producto_proveedor();
    $data=$ProdProv->CargarJsonProd_Provd_IdpProd($idprod);
    $out=$_GET["callback"]. "(" . $data . ")";
    break;
case '9'://verifico imagen
    //si cumple con los requisitos subo la imagen
//     sleep(1);
    $uploaddir = '../IMG_PROD/';
    $file = $uploaddir . basename($_FILES['uploadfile']['name']);
        $size = $_FILES['uploadfile']['size'];
        if ($size < (20 * 1024)) {
            if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
                $out="success";
            } else {
                $out="error";
            }
        } else {
            $out="excess";
        }
 break;
 case '10':
  $razonSocial = $_GET["term"];   
  $Persona=new persona();
  $data=$Persona->CargarJsonProveedorNombre($razonSocial);
  $out=$_GET["callback"] . "(" . $data . ")";
  
 break;
case '11':
    $prok=$_POST['Proveedor'];
    $x=array();
    $aux="";
    foreach($prok as $x){
       $aux=$aux.$x[0];
    }
    $out="Muy bien wilfo".$_GET['save_fecupdate_producto'].' '.$aux;
    break;
 case '12'://muestra en json los productos
    $clsProducto=new producto();
    $id_producto=$_POST['show_id_producto'];
    $clsProducto=$clsProducto->showProducto($id_producto);
    $out=json_encode($clsProducto);
    break;
 case '13': //actualizar predio desde reporte de compra
 	$id_prod = $_GET['update_id_producto'];
 	$precio	 = $_GET['update_pvp1_producto'];
 	$clsProducto = new producto();
 	$ret = $clsProducto->updatePrecioDesdeRepCompra($id_prod,$precio);
 	$out = json_encode($ret);
 	break;
 case '14':
 	$id_prov = $_GET['id_prov'];
 	$cod_prod = $_GET['cod_prod'];
 	$clsProducto = new producto();
	$ret = 	$clsProducto->consultarExistencia($id_prov, $cod_prod);
	$out = json_encode($ret);
	break;
 case '15':
 
 	$tipo_aumento 	= $_POST['tipo_aumento'];
 	$prov_id 		= $_POST['cmb_aumento_provd'];
 	$marca_id		= $_POST['cmb_aumento_marca'];
 	$porcentaje		= $_POST['txt_porcentaje_aumento'];
 	
 	$clsProducto = new producto();
 	if($tipo_aumento == 'proveedor')
 		$ret = $clsProducto->aumentoGeneralPorProveedor($prov_id, $porcentaje);
 	elseif($tipo_aumento == 'marca')
 		$ret = $clsProducto->aumentoGeneralPorMarca($marca_id, $porcentaje);
 	
 	$out = json_encode($ret);
 	break;
 	
 case '16':
 
 	$tipo_aumento 	= $_POST['tipo_aumento'];
 	$prov_id 		= $_POST['cmb_aumento_provd'];
 	$marca_id		= $_POST['cmb_aumento_marca'];
 	
 	$clsProducto = new producto();
 		$ret = $clsProducto->productosAfectadosPorAumento($tipo_aumento, $prov_id,$marca_id);
	
 	$out = json_encode($ret);
 	break;
 	
 case '17':
 	$cod_prod = $_GET['cod_prod'];
 	$clsProducto = new producto();
 	$ret = $clsProducto->consultarExistenciaPorCodigo($cod_prod);
 	
 	$out = json_encode($ret);
 	break;
}

die($out); 

?>
