<?php

class cliente_pago {

    public $_DB;
    public $_id_pago;
    public $_id_persona;
    public $_id_factura;
    public $_canti_pago;
    public $_fecha_pago;
    public $_estado_pago;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function cliente_pago($id_pago, $id_persona, $id_factura, $canti_pago, $fecha_pago, $estado_pago) {

        $this->_id_pago = $id_pago;

        $this->_id_persona = $id_persona;

        $this->_id_factura = $id_factura;

        $this->_canti_pago = $canti_pago;

        $this->_fecha_pago = $fecha_pago;

        $this->_estado_pago = $estado_pago;
    }

    public function get_id_pago() {
        return $this->_id_pago;
    }

    public function set_id_pago($id_pago) {

        $this->_id_pago = $id_pago;
    }

    public function get_id_persona() {

        return $this->_id_persona;
    }

    public function set_id_persona($id_persona) {

        $this->_id_persona = $id_persona;
    }

    public function get_id_factura() {

        return $this->_id_factura;
    }

    public function set_id_factura($id_factura) {

        $this->_id_factura = $id_factura;
    }

    public function get_canti_pago() {

        return $this->_canti_pago;
    }

    public function set_canti_pago($canti_pago) {

        $this->_canti_pago = $canti_pago;
    }

    public function get_fecha_pago() {

        return $this->_fecha_pago;
    }

    public function set_fecha_pago($fecha_pago) {

        $this->_fecha_pago = $fecha_pago;
    }

    public function get_estado_pago() {

        return $this->_estado_pago;
    }

    public function set_estado_pago($estado_pago) {

        $this->_estado_pago = $estado_pago;
    }

    public function addCliente_pago($cliente_pago) {

        $sql="";
        $sql = $sql . "'" . $cliente_pago->get_id_persona() . "',";
        $sql = $sql . "'" . $cliente_pago->get_id_factura() . "',";
        $sql = $sql . "'" . $cliente_pago->get_canti_pago() . "',";
        $sql = $sql . "'" . $cliente_pago->get_fecha_pago() . "',";
        $sql = $sql . "'" . $cliente_pago->get_estado_pago() . "'";
        $result = $this->_DB->select_query("call sp_cliente_pagoinsert (" . $sql . ")");

        return $result;
    }

    public function updateCliente_pago($cliente_pago) {

        $sql="";
        $sql = $sql . "'" . $cliente_pago->get_id_pago() . "',";
        $sql = $sql . "'" . $cliente_pago->get_id_persona() . "',";
        $sql = $sql . "'" . $cliente_pago->get_id_factura() . "',";
        $sql = $sql . "'" . $cliente_pago->get_canti_pago() . "',";
        $sql = $sql . "'" . $cliente_pago->get_fecha_pago() . "',";
        $sql = $sql . "'" . $cliente_pago->get_estado_pago() . "'";

        $result = $this->_DB->alteration_query("call sp_cliente_pagoupdate (" . $sql . ")");

        return $result;
    }

    public function deleteCliente_pago($id_pago) {

        $sql = "DELETE FROM cliente_pago WHERE id_pago='" . $id_pago . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showCliente_pago($id_persona) {

        $cliente_pago = new cliente_pago();

        $sql = "SELECT * FROM cliente_pago WHERE id_persona=" . $id_persona;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $cliente_pago->set_id_pago($row['id_pago']);

            $cliente_pago->set_id_persona($row['id_persona']);

            $cliente_pago->set_id_factura($row['id_factura']);

            $cliente_pago->set_canti_pago($row['canti_pago']);

            $cliente_pago->set_fecha_pago($row['fecha_pago']);

            $cliente_pago->set_estado_pago($row['estado_pago']);
        }

        return $cliente_pago;
    }

    public function listCliente_pagos($fecIni, $fecFinal) {

        $data = array();

        $sql = "SELECT * FROM cliente_pago WHERE fecha_cliente_pago>='" . $fecIni . "' AND fecha_cliente_pago <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $cliente_pago = new cliente_pago();

            $cliente_pago->set_id_pago($row['id_pago']);

            $cliente_pago->set_id_persona($row['id_persona']);

            $cliente_pago->set_id_factura($row['id_factura']);

            $cliente_pago->set_canti_pago($row['canti_pago']);

            $cliente_pago->set_fecha_pago($row['fecha_pago']);

            $cliente_pago->set_estado_pago($row['estado_pago']);

            $data[] = $cliente_pago;
        }

        return $data;
    }
    
    public function eliminar_cliente_pago($id_persona,$fecha){
        $sql="DELETE FROM cliente_pago WHERE (id_persona=$id_persona AND id_factura=0)
AND (MONTH(fecha_pago)=MONTH('$fecha') AND  estado_pago='0' AND
YEAR(fecha_pago)=YEAR('$fecha'))";
         $result = $this->_DB->alteration_query($sql);

        return $result;
    }

}

?>

