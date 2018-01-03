<?php

class descuento_venta {

    public $_DB;
    public $_id_descto;
    public $_porctj_descto;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function descuento_venta($id_descto, $porctj_descto) {

        $this->_id_descto = $id_descto;

        $this->_porctj_descto = $porctj_descto;
    }

    public function get_id_descto() {
        return $this->_id_descto;
    }

    public function set_id_descto($id_descto) {

        $this->_id_descto = $id_descto;
    }

    public function get_porctj_descto() {

        return $this->_porctj_descto;
    }

    public function set_porctj_descto($porctj_descto) {

        $this->_porctj_descto = $porctj_descto;
    }

    public function addDescuento_venta($descuento_venta) {
        $sql="";
        $sql = $sql . "'" . $descuento_venta->get_porctj_descto() . "'";
        $result = $this->_DB->select_query("call sp_descuento_ventainsert (" . $sql . ")");
        return $result;
    }
/**
 *No habilitado
 * @param type $descuento_venta
 * @return type 
 */
    public function updateDescuento_venta($descuento_venta) {
        $sql="";
        $sql = $sql . "'" . $descuento_venta->get_id_descto() . "',";
        $sql = $sql . "'" . $descuento_venta->get_porctj_descto() . "'";
        $result = $this->_DB->alteration_query("call sp_descuento_venta_update (" . $sql . ")");
        return $result;
    }

    public function deleteDescuento_venta($id_descto) {
        $sql = "DELETE FROM descuento_venta WHERE id_descto='" . $id_descto . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDescuento_venta($porctj_descto) {
        $descuento_venta = new descuento_venta();
        $sql = "SELECT * FROM descuento_venta WHERE id_descto=" . $id_descto;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $descuento_venta->set_id_descto($row['id_descto']);
            $descuento_venta->set_porctj_descto($row['porctj_descto']);
        }
        return $descuento_venta;
    }

    public function ComboDescuento_ventas() {
        $data = array();
        $sql = "SELECT * FROM descuento_venta";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $descuento_venta = new descuento_venta();
            $descuento_venta->set_id_descto($row['id_descto']);
            $descuento_venta->set_porctj_descto($row['porctj_descto']);
            $data[] = $descuento_venta;
        }
        return $data;
    }

}

?>


