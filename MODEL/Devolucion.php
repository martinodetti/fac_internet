<?php

class devolucion {

    public $_DB;
    public $_id_devo;
    public $_id_factcmp_devo;
    public $_tipo_cmpbt_devo;
    public $_descto_devo;
    public $_iva12_devo;
    public $_total_devo;
    public $_obs_devo;
    public $_fecha_devo;
    public $_estado_devo;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function devolucion($id_devo, $id_factcmp_devo, $tipo_cmpbt_devo, $descto_devo, $iva12_devo, $total_devo, $obs_devo, $fecha_devo, $estado_devo) {

        $this->_id_devo = $id_devo;

        $this->_id_factcmp_devo = $id_factcmp_devo;

        $this->_tipo_cmpbt_devo = $tipo_cmpbt_devo;

        $this->_descto_devo = $descto_devo;

        $this->_iva12_devo = $iva12_devo;

        $this->_total_devo = $total_devo;

        $this->_obs_devo = $obs_devo;

        $this->_fecha_devo = $fecha_devo;

        $this->_estado_devo = $estado_devo;
    }

    public function get_id_devo() {
        return $this->_id_devo;
    }

    public function set_id_devo($id_devo) {

        $this->_id_devo = $id_devo;
    }

    public function get_id_factcmp_devo() {

        return $this->_id_factcmp_devo;
    }

    public function set_id_factcmp_devo($id_factcmp_devo) {

        $this->_id_factcmp_devo = $id_factcmp_devo;
    }

    public function get_tipo_cmpbt_devo() {

        return $this->_tipo_cmpbt_devo;
    }

    public function set_tipo_cmpbt_devo($tipo_cmpbt_devo) {

        $this->_tipo_cmpbt_devo = $tipo_cmpbt_devo;
    }

    public function get_descto_devo() {

        return $this->_descto_devo;
    }

    public function set_descto_devo($descto_devo) {

        $this->_descto_devo = $descto_devo;
    }

    public function get_iva12_devo() {

        return $this->_iva12_devo;
    }

    public function set_iva12_devo($iva12_devo) {

        $this->_iva12_devo = $iva12_devo;
    }

    public function get_total_devo() {

        return $this->_total_devo;
    }

    public function set_total_devo($total_devo) {

        $this->_total_devo = $total_devo;
    }

    public function get_obs_devo() {

        return $this->_obs_devo;
    }

    public function set_obs_devo($obs_devo) {

        $this->_obs_devo = $obs_devo;
    }

    public function get_fecha_devo() {

        return $this->_fecha_devo;
    }

    public function set_fecha_devo($fecha_devo) {

        $this->_fecha_devo = $fecha_devo;
    }

    public function get_estado_devo() {

        return $this->_estado_devo;
    }

    public function set_estado_devo($estado_devo) {

        $this->_estado_devo = $estado_devo;
    }

    public function addDevolucion($devolucion) {

        $sql="";
        $sql = $sql . "'" . $devolucion->get_id_factcmp_devo() . "',";
        $sql = $sql . "'" . $devolucion->get_tipo_cmpbt_devo() . "',";
        $sql = $sql . "'" . $devolucion->get_descto_devo() . "',";
        $sql = $sql . "'" . $devolucion->get_iva12_devo() . "',";
        $sql = $sql . "'" . $devolucion->get_total_devo() . "',";
        $sql = $sql . "'" . $devolucion->get_obs_devo() . "',";
        $sql = $sql . "'" . $devolucion->get_fecha_devo() . "',";
        $sql = $sql . "'" . $devolucion->get_estado_devo() . "'";
        $result = $this->_DB->select_query("call sp_devolucioninsert (" . $sql . ")");
        return $result;
    }

   

    public function deleteDevolucion($id_devo) {
        $sql = "DELETE FROM devolucion WHERE id_devo='" . $id_devo . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDevolucion($id_factcmp_devo) {

        $devolucion = new devolucion();

        $sql = "SELECT * FROM devolucion WHERE id_devo=" . $id_devo;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $devolucion->set_id_devo($row['id_devo']);

            $devolucion->set_id_factcmp_devo($row['id_factcmp_devo']);

            $devolucion->set_tipo_cmpbt_devo($row['tipo_cmpbt_devo']);

            $devolucion->set_descto_devo($row['descto_devo']);

            $devolucion->set_iva12_devo($row['iva12_devo']);

            $devolucion->set_total_devo($row['total_devo']);

            $devolucion->set_obs_devo($row['obs_devo']);

            $devolucion->set_fecha_devo($row['fecha_devo']);

            $devolucion->set_estado_devo($row['estado_devo']);
        }

        return $devolucion;
    }

    public function listDevolucions($fecIni, $fecFinal) {

        $data = array();

        $sql = "SELECT * FROM devolucion WHERE fecha_devolucion>='" . $fecIni . "' AND fecha_devolucion <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $devolucion = new devolucion();

            $devolucion->set_id_devo($row['id_devo']);

            $devolucion->set_id_factcmp_devo($row['id_factcmp_devo']);

            $devolucion->set_tipo_cmpbt_devo($row['tipo_cmpbt_devo']);

            $devolucion->set_descto_devo($row['descto_devo']);

            $devolucion->set_iva12_devo($row['iva12_devo']);

            $devolucion->set_total_devo($row['total_devo']);

            $devolucion->set_obs_devo($row['obs_devo']);

            $devolucion->set_fecha_devo($row['fecha_devo']);

            $devolucion->set_estado_devo($row['estado_devo']);

            $data[] = $devolucion;
        }

        return $data;
    }

}

?>

