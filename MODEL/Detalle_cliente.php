<?php

class detalle_cliente {

    public $_DB;
    public $_id_detcliente;
    public $_id_cliente;
    public $_id_trabajador;
    public $_id_tipoconex;
    public $_ip_detcliente;
    public $_hora_detcliente;
    public $_fecha_detcliente;
    public $_estado_conex;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_cliente($id_detcliente, $id_cliente, $id_trabajador, $id_tipoconex, $ip_detcliente, $hora_detcliente, $fecha_detcliente, $estado_conex) {

        $this->_id_detcliente = $id_detcliente;

        $this->_id_cliente = $id_cliente;

        $this->_id_trabajador = $id_trabajador;

        $this->_id_tipoconex = $id_tipoconex;

        $this->_ip_detcliente = $ip_detcliente;

        $this->_hora_detcliente = $hora_detcliente;

        $this->_fecha_detcliente = $fecha_detcliente;

        $this->_estado_conex = $estado_conex;
    }

    public function get_id_detcliente() {
        return $this->_id_detcliente;
    }

    public function set_id_detcliente($id_detcliente) {

        $this->_id_detcliente = $id_detcliente;
    }

    public function get_id_cliente() {

        return $this->_id_cliente;
    }

    public function set_id_cliente($id_cliente) {

        $this->_id_cliente = $id_cliente;
    }

    public function get_id_trabajador() {

        return $this->_id_trabajador;
    }

    public function set_id_trabajador($id_trabajador) {

        $this->_id_trabajador = $id_trabajador;
    }

    public function get_id_tipoconex() {

        return $this->_id_tipoconex;
    }

    public function set_id_tipoconex($id_tipoconex) {

        $this->_id_tipoconex = $id_tipoconex;
    }

    public function get_ip_detcliente() {

        return $this->_ip_detcliente;
    }

    public function set_ip_detcliente($ip_detcliente) {

        $this->_ip_detcliente = $ip_detcliente;
    }

    public function get_hora_detcliente() {

        return $this->_hora_detcliente;
    }

    public function set_hora_detcliente($hora_detcliente) {

        $this->_hora_detcliente = $hora_detcliente;
    }

    public function get_fecha_detcliente() {

        return $this->_fecha_detcliente;
    }

    public function set_fecha_detcliente($fecha_detcliente) {

        $this->_fecha_detcliente = $fecha_detcliente;
    }

    public function get_estado_conex() {

        return $this->_estado_conex;
    }

    public function set_estado_conex($estado_conex) {

        $this->_estado_conex = $estado_conex;
    }

    public function addDetalle_cliente($detalle_cliente) {

        $sql="";

        $sql = $sql . "'" . $detalle_cliente->get_id_cliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_id_trabajador() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_id_tipoconex() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_ip_detcliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_hora_detcliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_fecha_detcliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_estado_conex() . "'";
        $result = $this->_DB->select_query("call sp_detalle_clienteinsert (" . $sql . ")");

        return $result;
    }

    public function updateDetalle_cliente($detalle_cliente) {

        $sql="";
        $sql = $sql . "'" . $detalle_cliente->get_id_detcliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_id_cliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_id_trabajador() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_id_tipoconex() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_ip_detcliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_hora_detcliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_fecha_detcliente() . "',";
        $sql = $sql . "'" . $detalle_cliente->get_estado_conex() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_clienteupdate (" . $sql . ")");
        return $result;
    }

    public function deleteDetalle_cliente($id_detcliente) {

        $sql = "DELETE FROM detalle_cliente WHERE id_detcliente='" . $id_detcliente . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_cliente($id_cliente) {

        $detalle_cliente = new detalle_cliente();

        $sql = "SELECT * FROM detalle_cliente WHERE id_cliente=" . $id_cliente;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_cliente->set_id_detcliente($row['id_detcliente']);

            $detalle_cliente->set_id_cliente($row['id_cliente']);

            $detalle_cliente->set_id_trabajador($row['id_trabajador']);

            $detalle_cliente->set_id_tipoconex($row['id_tipoconex']);

            $detalle_cliente->set_ip_detcliente($row['ip_detcliente']);

            $detalle_cliente->set_hora_detcliente($row['hora_detcliente']);

            $detalle_cliente->set_fecha_detcliente($row['fecha_detcliente']);

            $detalle_cliente->set_estado_conex($row['estado_conex']);
        }

        return $detalle_cliente;
    }

  

}

?>
