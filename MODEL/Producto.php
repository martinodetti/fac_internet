<?php
include 'Conexion.php';

class producto {

    public $_DB;
    public $_id_producto;
    public $_id_tiporeten;
    public $_id_tipoiva;
    public $_id_marca;
    public $_id_unimedida;
    public $_id_ganancia;
    public $_codbarra_producto;
    public $_nom_producto;
    public $_descrip_producto;
    public $_costo_producto;
    public $_pvp1_producto;
    public $_stock_producto;
    public $_stkmin_producto;
    public $_stkmax_producto;
    public $_img_producto;
    public $_fecing_producto;
    public $_fecupdate_producto;
	public $_posicion_producto;
    public $_estado_producto;
	public $_tipo;

    public function __construct() {

//        $this->_DB = new Database();
		$con = conexion::getConexion();
    }

    public function producto($id_producto,$id_tipoiva, $id_tiporeten, $id_marca, $id_unimedida, $id_ganancia, $codbarra_producto, $nom_producto, $descrip_producto, $costo_producto, $pvp1_producto, $stock_producto, $stkmin_producto, $stkmax_producto, $img_producto, $fecing_producto, $fecupdate_producto, $posicion_producto, $estado_producto) {

        $this->_id_producto = $id_producto;

        $this->_id_tiporeten = $id_tiporeten;

        $this->_id_tipoiva	= $id_tipoiva;

        $this->_id_marca = $id_marca;

        $this->_id_unimedida = $id_unimedida;

        $this->_id_ganancia = $id_ganancia;

        $this->_codbarra_producto = $codbarra_producto;

        $this->_nom_producto = $nom_producto;

        $this->_descrip_producto = $descrip_producto;

        $this->_costo_producto = $costo_producto;

        $this->_pvp1_producto = $pvp1_producto;

        $this->_stock_producto = $stock_producto;

        $this->_stkmin_producto = $stkmin_producto;

        $this->_stkmax_producto = $stkmax_producto;

        $this->_img_producto = $img_producto;

        $this->_fecing_producto = $fecing_producto;

        $this->_fecupdate_producto = $fecupdate_producto;

		$this->_posicion_producto = $posicion_producto;

        $this->_estado_producto = $estado_producto;

    }

    public function get_id_producto() {

        return $this->_id_producto;
    }

    public function set_id_producto($id_producto) {

        $this->_id_producto = $id_producto;
    }

    public function get_id_tiporeten() {

        return $this->_id_tiporeten;
    }

    public function set_id_tiporeten($id_tiporeten) {

        $this->_id_tiporeten = $id_tiporeten;
    }

    public function get_id_tipoiva() {

        return $this->_id_tipoiva;
    }

    public function set_id_tipoiva($id_tipoiva) {

        $this->_id_tipoiva = $id_tipoiva;
    }

    public function get_id_marca() {

        return $this->_id_marca;
    }

    public function set_id_marca($id_marca) {

        $this->_id_marca = $id_marca;
    }

    public function get_id_unimedida() {

        return $this->_id_unimedida;
    }

    public function set_id_unimedida($id_unimedida) {

        $this->_id_unimedida = $id_unimedida;
    }

    public function get_id_ganancia() {

        return $this->_id_ganancia;
    }

    public function set_id_ganancia($id_ganancia) {

        $this->_id_ganancia = $id_ganancia;
    }

    public function get_codbarra_producto() {

        return $this->_codbarra_producto;
    }

    public function set_codbarra_producto($codbarra_producto) {

        $this->_codbarra_producto = $codbarra_producto;
    }

    public function get_nom_producto() {

        return $this->_nom_producto;
    }

    public function set_nom_producto($nom_producto) {

        $this->_nom_producto = $nom_producto;
    }

    public function get_descrip_producto() {

        return $this->_descrip_producto;
    }

    public function set_descrip_producto($descrip_producto) {

        $this->_descrip_producto = $descrip_producto;
    }

    public function get_costo_producto() {

        return $this->_costo_producto;
    }

    public function set_costo_producto($costo_producto) {

        $this->_costo_producto = $costo_producto;
    }

    public function get_pvp1_producto() {

        return $this->_pvp1_producto;
    }

    public function set_pvp1_producto($pvp1_producto) {

        $this->_pvp1_producto = $pvp1_producto;
    }

    public function get_stock_producto() {

        return $this->_stock_producto;
    }

    public function set_stock_producto($stock_producto) {

        $this->_stock_producto = $stock_producto;
    }

    public function get_stkmin_producto() {

        return $this->_stkmin_producto;
    }

    public function set_stkmin_producto($stkmin_producto) {

        $this->_stkmin_producto = $stkmin_producto;
    }

    public function get_stkmax_producto() {

        return $this->_stkmax_producto;
    }

    public function set_stkmax_producto($stkmax_producto) {

        $this->_stkmax_producto = $stkmax_producto;
    }

    public function get_img_producto() {

        return $this->_img_producto;
    }

    public function set_img_producto($img_producto) {

        $this->_img_producto = $img_producto;
    }


	public function get_posicion_producto() {

        return $this->_posicion_producto;
    }

    public function set_posicion_producto($posicion_producto) {

        $this->_posicion_producto = $posicion_producto;
    }

    public function get_fecing_producto() {

        return $this->_fecing_producto;
    }

    public function set_fecing_producto($fecing_producto) {
		if($fecing_producto != ''){
			$arr = explode('-', $fecing_producto);
			$fecing_producto = $arr[2]. '-' . $arr[1] . '-' . $arr[0];
		}
        $this->_fecing_producto = $fecing_producto;
    }

    public function get_fecupdate_producto() {

        return $this->_fecupdate_producto;
    }

    public function set_fecupdate_producto($fecupdate_producto) {
		if($fecupdate_producto != ''){
			$arr = explode('-', $fecupdate_producto);
			$fecupdate_producto = $arr[2]. '-' . $arr[1] . '-' . $arr[0];
		}
        $this->_fecupdate_producto = $fecupdate_producto;
    }

    public function get_estado_producto() {

        return $this->_estado_producto;
    }

    public function set_estado_producto($estado_producto) {

        $this->_estado_producto = $estado_producto;
    }

	public function get_tipo() {

        return $this->_tipo;
    }

    public function set_tipo($tipo) {

        $this->_tipo = $tipo;
    }


    public function addProducto($producto) {

        $sql="";

        $sql = $sql . "'" . $producto->get_id_tiporeten() . "',";

        $sql = $sql . "'" . $producto->get_id_tipoiva() . "',";

        $sql = $sql . "'" . $producto->get_id_marca() . "',";

        $sql = $sql . "'" . $producto->get_id_unimedida() . "',";

        $sql = $sql . "'" . $producto->get_id_ganancia() . "',";

        $sql = $sql . "'" . $producto->get_codbarra_producto() . "',";

        $sql = $sql . "'" . $producto->get_nom_producto() . "',";

        $sql = $sql . "'" . $producto->get_descrip_producto() . "',";

        $sql = $sql . "'" . $producto->get_costo_producto() . "',";

        $sql = $sql . "'" . $producto->get_pvp1_producto() . "',";

        $sql = $sql . "'" . $producto->get_stock_producto() . "',";

        $sql = $sql . "'" . $producto->get_stkmin_producto() . "',";

        $sql = $sql . "'" . $producto->get_stkmax_producto() . "',";

        $sql = $sql . "'" . $producto->get_img_producto() . "',";

        $sql = $sql . "'" . $producto->get_fecing_producto() . "',";

        $sql = $sql . "'" . $producto->get_fecupdate_producto() . "',";

		$sql = $sql . "'" . $producto->get_posicion_producto() . "',";

        $sql = $sql . "'" . $producto->get_estado_producto() . "',";

		$sql = $sql . "'" . $producto->get_tipo() . "'";

//        $result = $this->_DB->select_query("call sp_productoinsert (" . $sql . ")");
		$result = conexion::insert("call sp_productoinsert (" . $sql . ")");

        return $result;
    }

    public function updateProducto($producto) {

        $sql="";

        $sql = $sql . "'" . $producto->get_id_producto() . "',";

        $sql = $sql . "'" . $producto->get_id_tiporeten() . "',";

        $sql = $sql . "'" . $producto->get_id_tipoiva() . "',";

        $sql = $sql . "'" . $producto->get_id_marca() . "',";

        $sql = $sql . "'" . $producto->get_id_unimedida() . "',";

        $sql = $sql . "'" . $producto->get_id_ganancia() . "',";

        $sql = $sql . "'" . $producto->get_codbarra_producto() . "',";

        $sql = $sql . "'" . mysql_escape_string($producto->get_nom_producto()) . "',";

        $sql = $sql . "'" . mysql_escape_string($producto->get_descrip_producto()) . "',";

        $sql = $sql . "'" . $producto->get_costo_producto() . "',";

        $sql = $sql . "'" . $producto->get_pvp1_producto() . "',";

        $sql = $sql . "'" . $producto->get_stock_producto() . "',";

        $sql = $sql . "'" . $producto->get_stkmin_producto() . "',";

        $sql = $sql . "'" . $producto->get_stkmax_producto() . "',";

        $sql = $sql . "'" . $producto->get_img_producto() . "',";

        $sql = $sql . "'" . $producto->get_fecing_producto() . "',";

        $sql = $sql . "'" . $producto->get_fecupdate_producto() . "',";

		$sql = $sql . "'" . $producto->get_posicion_producto() . "',";

        $sql = $sql . "'" . $producto->get_estado_producto() . "',";

		$sql = $sql . "'" . $producto->get_tipo() . "'";

//        $result = $this->_DB->alteration_query("call sp_productoupdate (" . $sql . ")");
		$result = conexion::insert("call sp_productoupdate (" . $sql . ")");

        return $result;
    }

    public function deleteProducto($id_producto) {
        $sql = "UPDATE producto SET estado_producto = 2 WHERE id_producto='" . $id_producto . "'";
//        $result = $this->_DB->alteration_query($sql);
		$result = conexion::insert($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showProducto($id_producto) {

        $producto = new producto();

        $sql = "SELECT * FROM producto WHERE id_producto=" . $id_producto;

//        $result = $this->_DB->select_query($sql);
		$result = conexion::selectArr($sql);

        foreach ($result as $row) {

            $producto->set_id_producto($row['id_producto']);

            $producto->set_id_tiporeten($row['id_tiporeten']);

            $producto->set_id_tipoiva($row['id_tipoiva']);

            $producto->set_id_marca($row['id_marca']);

            $producto->set_id_unimedida($row['id_unimedida']);

            $producto->set_id_ganancia($row['id_ganancia']);

            $producto->set_codbarra_producto($row['codbarra_producto']);

            $producto->set_nom_producto($row['nom_producto']);

            $producto->set_descrip_producto($row['descrip_producto']);

            $producto->set_costo_producto($row['costo_producto']);

            $producto->set_pvp1_producto($row['pvp1_producto']);

            $producto->set_stock_producto($row['stock_producto']);

            $producto->set_stkmin_producto($row['stkmin_producto']);

            $producto->set_stkmax_producto($row['stkmax_producto']);

            $producto->set_img_producto($row['img_producto']);

            $producto->set_fecing_producto($row['fecing_producto']);

            $producto->set_fecupdate_producto($row['fecupdate_producto']);

			$producto->set_posicion_producto($row['posicion_producto']);

            $producto->set_estado_producto($row['estado_producto']);

			$producto->set_tipo($row['tipo']);
        }

        return $producto;
    }

    public function listProductosPorNombre($nombre) {
        $data = array();
        $sql = "SELECT * FROM producto WHERE (nom_producto like '%".$nombre."%' OR descrip_producto like '%".$nombre."%') AND estado_producto = 1";
//        $result = $this->_DB->select_query($sql);
		$result = conexion::selectArr($sql);
        foreach ($result as $row) {
            $producto = new producto();
            $producto->set_id_producto($row['id_producto']);
            $producto->set_id_tiporeten($row['id_tiporeten']);
            $producto->set_id_tipoiva($row['id_tipoiva']);
            $producto->set_id_marca($row['id_marca']);
            $producto->set_id_unimedida($row['id_unimedida']);
            $producto->set_id_ganancia($row['id_ganancia']);
            $producto->set_codbarra_producto($row['codbarra_producto']);
            $producto->set_nom_producto($row['nom_producto']);
            $producto->set_descrip_producto($row['descrip_producto']);
            $producto->set_costo_producto($row['costo_producto']);
            $producto->set_pvp1_producto($row['pvp1_producto']);
            $producto->set_stock_producto($row['stock_producto']);
            $producto->set_stkmin_producto($row['stkmin_producto']);
            $producto->set_stkmax_producto($row['stkmax_producto']);
            $producto->set_img_producto($row['img_producto']);
            $producto->set_fecing_producto($row['fecing_producto']);
            $producto->set_fecupdate_producto($row['fecupdate_producto']);
			$producto->set_posicion_producto($row['posicion_producto']);
            $producto->set_estado_producto($row['estado_producto']);
			$producto->set_tipo($row['tipo']);
            $data[] = $producto;
        }

        return $data;
    }

    /**
     *
     * @param type $nombre
     * @return type json array producto
     */
    public function listProductosPorNombreCompra($nombre) {
        $data = array();
        $sql = "SELECT * FROM producto LEFT JOIN tipoiva using(id_tipoiva)  WHERE (nom_producto like '%$nombre%' OR descrip_producto like '%$nombre%') AND estado_producto = 1";
//        $result = $this->_DB->select_query($sql);
		$result = conexion::selectArr($sql);
        foreach ($result as $row) {
        	if($row['id_tipoiva'] == 1) $tipoiva = '21%';
        	if($row['id_tipoiva'] == 2) $tipoiva = '10,5%';
            if($row['id_tipoiva'] == 3) $tipoiva = '0%';
            if($row['id_tipoiva'] == 4) $tipoiva = '27%';
            if($row['id_tipoiva'] == 5) $tipoiva = '2,5%';
            if($row['id_tipoiva'] == 6) $tipoiva = '5%';

            $data[]= array( "id_producto" 		=>$row["id_producto"]		, "nom_producto"	=>$row["nom_producto"],
							"descrip_producto"	=>$row["descrip_producto"]	, "costo_producto"	=>$row["costo_producto"],
							"stock_producto"	=>$row["stock_producto"] 	, "precio_producto"	=>$row["pvp1_producto"],
							"tipo_iva"			=>$tipoiva                  , "porcentaje_iva"  =>$row['porcentaje_iva']);
        }
        return json_encode($data);
    }
    /**
     *Devuelve array en json de los productos ,precio y stock
     * @param type $producto
     * @return type
     */
    public function listProductosPorNombreFactura($producto) {
        $data = array();
        $sql = "SELECT * FROM producto WHERE (nom_producto like '%$producto%' OR descrip_producto like '%$producto%') AND estado_producto = 1 and tipo = 'comerciable'";
//        $result = $this->_DB->select_query($sql);
		$result = conexion::selectArr($sql);
        foreach ($result as $row) {
            $data[]= array(	"id_producto" 		=> $row["id_producto"]		, "nom_producto"	=> $row["nom_producto"],
				            "descrip_producto"	=> $row["descrip_producto"]	, "pvp1_producto"	=> $row["pvp1_producto"],
             				"stock_producto"	=> $row["stock_producto"]	, "id_tipoiva" 		=> $row["id_tipoiva"]   );
        }
        return json_encode($data);
    }



    public function getStock($idprod){
        $sql = "SELECT stock_producto FROM producto WHERE id_producto=".$idprod;
//        $result = $this->_DB->select_query($sql);
		$result = conexion::selectArr($sql);
        $stock=0;
         foreach ($result as $row) {
             $stock=$row['stock_producto'];
         }
         return $stock;
   }

   	public function updatePrecioDesdeRepCompra($idp, $precio)
   	{
   		$sql = "UPDATE producto set pvp1_producto = ". $precio . ", fecing_producto = '" . date('Y-m-d') . "' WHERE id_producto = " . $idp;
   		$result = conexion::insert($sql);
   		return $result;
   	}

   	public function consultarExistencia($id_prov, $cod_prod)
   	{

   		if($id_prov == '')
   			$id_prov = "''";

   		$sql = " SELECT id_producto FROM v_producto_proveedor " .
   				"WHERE id_proveedor IN(" . $id_prov . ") " .
   				"AND 	id_producto = (SELECT id_producto FROM producto WHERE nom_producto = '" . $cod_prod . "')";

   		$result = conexion::selectArr($sql);
   		$id = 0;
   		foreach ($result as $row)
   		{
   			$id = $row['id_producto'];
   		}
   		return $id;
   	}

   	public function consultarExistenciaPorCodigo($cod_prod)
   	{

   		$sql = " SELECT id_producto FROM producto " .
   				"WHERE nom_producto = '" . $cod_prod . "'";

   		$result = conexion::selectArr($sql);
   		$id = 0;
   		foreach ($result as $row)
   		{
   			$id = $row['id_producto'];
   		}
   		return $id;
   	}


   	public function aumentoGeneralPorProveedor($id_prov, $porcentaje)
   	{
   		$sql = "INSERT INTO historico_precio
   				SELECT 	0, id_producto, date_format(now(),'%Y-%m-%d'),pvp1_producto, pvp1_producto + (pvp1_producto * ".$porcentaje." / 100),
   						costo_producto, costo_producto + (costo_producto * ".$porcentaje." / 100), ".$porcentaje.", 'Aumento general por proveedor'
   				FROM 	producto
   				WHERE 	id_producto in (SELECT id_producto FROM v_producto_proveedor WHERE id_proveedor = " . $id_prov . ")";
		$result = conexion::insert($sql);

		$sqli= "UPDATE 	producto SET pvp1_producto = pvp1_producto + (pvp1_producto * ".$porcentaje." / 100),
						costo_producto = costo_producto + (costo_producto * ".$porcentaje." / 100),
						fecupdate_producto = date_format(now(),'%Y-%m-%d')
				WHERE id_producto IN (SELECT id_producto FROM v_producto_proveedor WHERE id_proveedor = " . $id_prov . ")";
		$result = conexion::insert($sqli);


		return $result;
   	}

   	public function aumentoGeneralPorMarca($id_marca, $porcentaje)
   	{
   		$sql = "INSERT INTO historico_precio
   				SELECT 	0, id_producto, date_format(now(),'%Y-%m-%d'),pvp1_producto, pvp1_producto + (pvp1_producto * ".$porcentaje." / 100),
   						costo_producto, costo_producto + (costo_producto * ".$porcentaje." / 100), ".$porcentaje.", 'Aumento general por proveedor'
   				FROM 	producto
   				WHERE 	id_marca = " . $id_marca;
		$result = conexion::insert($sql);

		$sqli= "UPDATE 	producto SET pvp1_producto = pvp1_producto + (pvp1_producto * ".$porcentaje." / 100),
						costo_producto = costo_producto + (costo_producto * ".$porcentaje." / 100),
						fecupdate_producto = date_format(now(),'%Y-%m-%d')
				WHERE id_marca = " . $id_marca;
		$result = conexion::insert($sqli);


		return $result;
   	}

   	public function productosAfectadosPorAumento($tipo_aumento, $prov_id,$marca_id)
   	{
   		if($tipo_aumento == "marca")
   			$where = " WHERE id_marca = " . $marca_id;
   		else
   			$where = " WHERE id_producto IN (SELECT id_producto FROM v_producto_proveedor WHERE id_proveedor = " . $prov_id . ")";

   		$sql = "SELECT COUNT(id_producto) as cantidad FROM producto " . $where;

   		$result = conexion::selectObj($sql);

   		return $result['cantidad'];
   	}

   	public function getPreductoPrecioVtaIgualCero()
   	{
   		$sql = "SELECT COUNT(id_producto) cantidad FROM producto WHERE pvp1_producto = 0 AND estado_producto = 1 and tipo = 'comerciable'";
		$result = conexion::selectObj($sql);

   		return $result['cantidad'];
   	}

    public function getProductoPrecioVtaIgualCosto()
    {
        $sql = "SELECT COUNT(id_producto) cantidad FROM producto WHERE pvp1_producto <= (costo_producto*1.35) AND estado_producto = 1 and pvp1_producto > 0 and chequeado = false and tipo = 'comerciable'";
        $result = conexion::selectObj($sql);

        return $result['cantidad'];
    }

	public function chequeado($id_prod)
	{
		$sqli= "UPDATE 	producto SET chequeado  = true 	WHERE id_producto = " . $id_prod;
		$result = conexion::insert($sqli);

		return result;
	}

}
?>
