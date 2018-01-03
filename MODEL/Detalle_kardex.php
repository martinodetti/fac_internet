<?php

class detalle_kardex {

    public $_DB;
    public $_id_detkardex;
    public $_id_kardex;
    public $_id_producto;
    public $_costo_detkardex;
    public $_canti_detkardex;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_kardex($id_detkardex, $id_kardex, $id_producto, $costo_detkardex, $canti_detkardex) {

        $this->_id_detkardex = $id_detkardex;

        $this->_id_kardex = $id_kardex;

        $this->_id_producto = $id_producto;

        $this->_costo_detkardex = $costo_detkardex;

        $this->_canti_detkardex = $canti_detkardex;
    }

    public function get_id_detkardex() {

        return $this->_id_detkardex;
    }

    public function set_id_detkardex($id_detkardex) {

        $this->_id_detkardex = $id_detkardex;
    }

    public function get_id_kardex() {

        return $this->_id_kardex;
    }

    public function set_id_kardex($id_kardex) {

        $this->_id_kardex = $id_kardex;
    }

    public function get_id_producto() {

        return $this->_id_producto;
    }

    public function set_id_producto($id_producto) {

        $this->_id_producto = $id_producto;
    }

    public function get_costo_detkardex() {

        return $this->_costo_detkardex;
    }

    public function set_costo_detkardex($costo_detkardex) {

        $this->_costo_detkardex = $costo_detkardex;
    }

    public function get_canti_detkardex() {

        return $this->_canti_detkardex;
    }

    public function set_canti_detkardex($canti_detkardex) {

        $this->_canti_detkardex = $canti_detkardex;
    }

    public function addDetalle_kardex($detalle_kardex) {
        $sql="";
        $sql = $sql . "'" . $detalle_kardex->get_id_kardex() . "',";
        $sql = $sql . "'" . $detalle_kardex->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_kardex->get_costo_detkardex() . "',";
        $sql = $sql . "'" . $detalle_kardex->get_canti_detkardex() . "'";
        $result = $this->_DB->select_query("call sp_detalle_kardexinsert (" . $sql . ")");
        return $result;
    }

    public function updateDetalle_kardex($detalle_kardex) {
        //no habilitado
        $sql="";
        $sql = $sql . "'" . $detalle_kardex->get_id_detkardex() . "',";
        $sql = $sql . "'" . $detalle_kardex->get_id_kardex() . "',";
        $sql = $sql . "'" . $detalle_kardex->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_kardex->get_costo_detkardex() . "',";
        $sql = $sql . "'" . $detalle_kardex->get_canti_detkardex() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_kardexupdate (" . $sql . ")");
        return $result;
    }

    public function deleteDetalle_kardex($id_detkardex) {

        $sql = "DELETE FROM detalle_kardex WHERE id_detkardex='" . $id_detkardex . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_kardex($id_kardex) {
        $detalle_kardex = new detalle_kardex();
        $sql = "SELECT * FROM detalle_kardex WHERE id_kardex=" .$id_kardex;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $detalle_kardex->set_id_detkardex($row['id_detkardex']);
            $detalle_kardex->set_id_kardex($row['id_kardex']);
            $detalle_kardex->set_id_producto($row['id_producto']);
            $detalle_kardex->set_costo_detkardex($row['costo_detkardex']);
            $detalle_kardex->set_canti_detkardex($row['canti_detkardex']);
        }
        return $detalle_kardex;
    }

    public function listDetalle_kardexs($fecIni, $fecFinal) {
//no habilitado
        $data = array();

        $sql = "SELECT * FROM detalle_kardex WHERE fecha_detalle_kardex>='" . $fecIni . "' AND fecha_detalle_kardex <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_kardex = new detalle_kardex();

            $detalle_kardex->set_id_detkardex($row['id_detkardex']);

            $detalle_kardex->set_id_kardex($row['id_kardex']);

            $detalle_kardex->set_id_producto($row['id_producto']);

            $detalle_kardex->set_costo_detkardex($row['costo_detkardex']);

            $detalle_kardex->set_canti_detkardex($row['canti_detkardex']);

            $data[] = $detalle_kardex;
        }

        return $data;
    }

}

?>