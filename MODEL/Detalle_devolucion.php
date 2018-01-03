<?php

class detalle_devolucion {

    public $_DB;
    public $_id_detdevo;
    public $_id_devo;
    public $_id_producto;
    public $_canti_detdevo;
    public $_precio_detdevo;
    public $_estado_detdevo;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_devolucion($id_detdevo, $id_devo, $id_producto, $canti_detdevo, $precio_detdevo, $estado_detdevo) {

        $this->_id_detdevo = $id_detdevo;

        $this->_id_devo = $id_devo;

        $this->_id_producto = $id_producto;

        $this->_canti_detdevo = $canti_detdevo;

        $this->_precio_detdevo = $precio_detdevo;

        $this->_estado_detdevo = $estado_detdevo;
    }

    public function get_id_detdevo() {
        return $this->_id_detdevo;
    }

    public function set_id_detdevo($id_detdevo) {

        $this->_id_detdevo = $id_detdevo;
    }

    public function get_id_devo() {

        return $this->_id_devo;
    }

    public function set_id_devo($id_devo) {

        $this->_id_devo = $id_devo;
    }

    public function get_id_producto() {

        return $this->_id_producto;
    }

    public function set_id_producto($id_producto) {

        $this->_id_producto = $id_producto;
    }

    public function get_canti_detdevo() {

        return $this->_canti_detdevo;
    }

    public function set_canti_detdevo($canti_detdevo) {

        $this->_canti_detdevo = $canti_detdevo;
    }

    public function get_precio_detdevo() {

        return $this->_precio_detdevo;
    }

    public function set_precio_detdevo($precio_detdevo) {

        $this->_precio_detdevo = $precio_detdevo;
    }

    public function get_estado_detdevo() {

        return $this->_estado_detdevo;
    }

    public function set_estado_detdevo($estado_detdevo) {

        $this->_estado_detdevo = $estado_detdevo;
    }
/**
 *Aumenta nuestro stock prque altera mercaderia
 * @param type $detalle_devolucion
 * @return type 
 */
    public function addDetalle_devolucion($detalle_devolucion) {

        $sql="";
        $sql = $sql . "'" . $detalle_devolucion->get_id_devo() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_canti_detdevo() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_precio_detdevo() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_estado_detdevo() . "'";
        $result = $this->_DB->select_query("call sp_detalle_devolucioninsert (" . $sql . ")");

        return $result;
    }
    /**
     *Disminuye nuestro stock porque devuelve mercadería
     * @param type $detalle_devolucion
     * @return type 
     */
    public function addDetalle_devolucion2($detalle_devolucion) {

        $sql="";
        $sql = $sql . "'" . $detalle_devolucion->get_id_devo() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_canti_detdevo() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_precio_detdevo() . "',";
        $sql = $sql . "'" . $detalle_devolucion->get_estado_detdevo() . "'";
        $result = $this->_DB->select_query("call sp_detalle_devolucioninsert2 (" . $sql . ")");

        return $result;
    }

  

    public function deleteDetalle_devolucion($id_detdevo) {

        $sql = "DELETE FROM detalle_devolucion WHERE id_detdevo='" . $id_detdevo . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_devolucion($id_devo) {

        $detalle_devolucion = new detalle_devolucion();

        $sql = "SELECT * FROM detalle_devolucion WHERE id_detdevo=" . $id_detdevo;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_devolucion->set_id_detdevo($row['id_detdevo']);

            $detalle_devolucion->set_id_devo($row['id_devo']);

            $detalle_devolucion->set_id_producto($row['id_producto']);

            $detalle_devolucion->set_canti_detdevo($row['canti_detdevo']);

            $detalle_devolucion->set_precio_detdevo($row['precio_detdevo']);

            $detalle_devolucion->set_estado_detdevo($row['estado_detdevo']);
        }

        return $detalle_devolucion;
    }

   

}

?>
