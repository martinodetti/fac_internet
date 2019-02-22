<?php

class detalle_compra {

    public $_DB;
    public $_id_detcompra;
    public $_id_compra;
    public $_id_producto;
    public $_costouni_detcompra;
    public $_canti_detcompra;
    public $_estado_detcompra;
    public $_precio_vta_detcompra;
    public $_id_proveedor;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_compra($id_detcompra, $id_compra, $id_producto, $costouni_detcompra, $canti_detcompra, $estado_detcompra) {

        $this->_id_detcompra = $id_detcompra;

        $this->_id_compra = $id_compra;

        $this->_id_producto = $id_producto;

        $this->_costouni_detcompra = $costouni_detcompra;

        $this->_canti_detcompra = $canti_detcompra;

        $this->_estado_detcompra = $estado_detcompra;
    }

    public function get_id_detcompra() {
        return $this->_id_detcompra;
    }

    public function set_id_detcompra($id_detcompra) {

        $this->_id_detcompra = $id_detcompra;
    }

    public function get_id_compra() {

        return $this->_id_compra;
    }

    public function set_id_compra($id_compra) {

        $this->_id_compra = $id_compra;
    }

    public function get_id_producto() {

        return $this->_id_producto;
    }

    public function set_id_producto($id_producto) {

        $this->_id_producto = $id_producto;
    }

    public function get_costouni_detcompra() {

        return $this->_costouni_detcompra;
    }

    public function set_costouni_detcompra($costouni_detcompra) {

        $this->_costouni_detcompra = $costouni_detcompra;
    }

    public function get_canti_detcompra() {

        return $this->_canti_detcompra;
    }

    public function set_canti_detcompra($canti_detcompra) {

        $this->_canti_detcompra = $canti_detcompra;
    }

    public function get_estado_detcompra() {

        return $this->_estado_detcompra;
    }

    public function set_estado_detcompra($estado_detcompra) {

        $this->_estado_detcompra = $estado_detcompra;
    }
    
    public function get_precio_vta_detcompra() {

        return $this->_precio_vta_detcompra;
    }

    public function set_precio_vta_detcompra($precio_vta_detcompra) {

        $this->_precio_vta_detcompra = $precio_vta_detcompra;
    }
    
    public function get_id_proveedor_detcompra() {

        return $this->_id_proveedor;
    }

    public function set_id_proveedor_detcompra($id_proveedor_detcompra) {

        $this->_id_proveedor = $id_proveedor_detcompra;
    }

    public function addDetalle_compra($detalle_compra) {
        $sql="";
        $sql = $sql . "'" . $detalle_compra->get_id_compra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_compra->get_costouni_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_canti_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_estado_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_precio_vta_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_id_proveedor_detcompra() . "'";


        $result = $this->_DB->select_query("call sp_detalle_comprainsert1 (" . $sql . ")");
        return $result;
    }
    
    public function addDetalle_notacredito($detalle_compra){
        $sql="";
        $sql = $sql . "'" . $detalle_compra->get_id_compra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_compra->get_canti_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_costouni_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_estado_detcompra() . "'";
       
        $result = $this->_DB->select_query("call sp_detalle_notacreditocomprainsert (" . $sql . ")");
        return $result;    
    }

    public function updateDetalle_compra($detalle_compra) {
        $sql="";
        $sql = $sql . "'" . $detalle_compra->get_id_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_id_compra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_compra->get_costouni_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_canti_detcompra() . "',";
        $sql = $sql . "'" . $detalle_compra->get_estado_detcompra() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_compraupdate (" . $sql . ")");
        return $result;
    }

    public function deleteDetalle_compra($id_detcompra) {

        $sql = "DELETE FROM detalle_compra WHERE id_detcompra='" . $id_detcompra . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }
    
    
    //borra el detalle de una factura de compra y tambien resta el stock que se haya sumado en su momento
    public function deletedetalle_compra_restar_stock($id_compra){
    	$sql = "CALL sp_restar_stock_udpate_compra(".$id_compra.")";
    	$result = $this->_DB->alteration_query($sql);
    	$sql1 = "DELETE FROM detalle_compra WHERE id_compra = ". $id_compra;
    	$result = $this->_DB->alteration_query($sql1);
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_compra($id_compra) {

        $detalle_compra = new detalle_compra();

        $sql = "SELECT * FROM detalle_compra WHERE id_detcompra=" . $id_detcompra;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_compra->set_id_detcompra($row['id_detcompra']);

            $detalle_compra->set_id_compra($row['id_compra']);

            $detalle_compra->set_id_producto($row['id_producto']);

            $detalle_compra->set_costouni_detcompra($row['costouni_detcompra']);

            $detalle_compra->set_canti_detcompra($row['canti_detcompra']);

            $detalle_compra->set_estado_detcompra($row['estado_detcompra']);
        }

        return $detalle_compra;
    }
    
    public function showDetalle_compraEdit($id_compra) {

        $detalle_compra = new detalle_compra();

        $sql = "SELECT * FROM v_compra_detalle WHERE id_compra=" . $id_compra;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {
            $arr = array();
            $arr['id_producto'] 		= $row['id_producto'];
            $arr['nom_producto'] 		= $row['nom_producto'];
            $arr['costouni_detcompra'] 	= $row['costouni_detcompra'];
            $arr['canti_detcompra'] 	= $row['canti_detcompra'];
            $arr['id_tipoiva'] 			= $row['id_tipoiva'];
            $arr['descrip_producto']	= $row['descrip_producto'];
            $arr['pvp1_producto']       = $row['pvp1_producto'];
            
            $array[] = $arr;
           
        }

        return $array;
    }
    
    

    public function listDetalle_compras($fecIni, $fecFinal) {

        $data = array();

        $sql = "SELECT * FROM detalle_compra WHERE fecha_detalle_compra>='" . $fecIni . "' AND fecha_detalle_compra <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_compra = new detalle_compra();

            $detalle_compra->set_id_detcompra($row['id_detcompra']);

            $detalle_compra->set_id_compra($row['id_compra']);

            $detalle_compra->set_id_producto($row['id_producto']);

            $detalle_compra->set_costouni_detcompra($row['costouni_detcompra']);

            $detalle_compra->set_canti_detcompra($row['canti_detcompra']);

            $detalle_compra->set_estado_detcompra($row['estado_detcompra']);

            $data[] = $detalle_compra;
        }

        return $data;
    }

}

?>

