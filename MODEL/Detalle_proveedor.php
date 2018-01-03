<?php

class detalle_proveedor {

    public $_DB;
    public $_id_detprovdr;
    public $_id_proveedor;
    public $_ip1_detprovdr;
    public $_ip2_detprovdr;
    public $_ip3_detprovdr;
    public $_mas1_detprovdr;
    public $_mas2_detprovdr;
    public $_mas3_detprovdr;
    public $_obs_detprovdr;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_proveedor($id_detprovdr, $id_proveedor, $ip1_detprovdr, $ip2_detprovdr, $ip3_detprovdr, $mas1_detprovdr, $mas2_detprovdr, $mas3_detprovdr, $obs_detprovdr) {

        $this->_id_detprovdr = $id_detprovdr;

        $this->_id_proveedor = $id_proveedor;

        $this->_ip1_detprovdr = $ip1_detprovdr;

        $this->_ip2_detprovdr = $ip2_detprovdr;

        $this->_ip3_detprovdr = $ip3_detprovdr;

        $this->_mas1_detprovdr = $mas1_detprovdr;

        $this->_mas2_detprovdr = $mas2_detprovdr;

        $this->_mas3_detprovdr = $mas3_detprovdr;

        $this->_obs_detprovdr = $obs_detprovdr;
    }

    public function get_id_detprovdr() {
        return $this->_id_detprovdr;
    }

    public function set_id_detprovdr($id_detprovdr) {

        $this->_id_detprovdr = $id_detprovdr;
    }

    public function get_id_proveedor() {

        return $this->_id_proveedor;
    }

    public function set_id_proveedor($id_proveedor) {

        $this->_id_proveedor = $id_proveedor;
    }

    public function get_ip1_detprovdr() {

        return $this->_ip1_detprovdr;
    }

    public function set_ip1_detprovdr($ip1_detprovdr) {

        $this->_ip1_detprovdr = $ip1_detprovdr;
    }

    public function get_ip2_detprovdr() {

        return $this->_ip2_detprovdr;
    }

    public function set_ip2_detprovdr($ip2_detprovdr) {

        $this->_ip2_detprovdr = $ip2_detprovdr;
    }

    public function get_ip3_detprovdr() {

        return $this->_ip3_detprovdr;
    }

    public function set_ip3_detprovdr($ip3_detprovdr) {

        $this->_ip3_detprovdr = $ip3_detprovdr;
    }

    public function get_mas1_detprovdr() {

        return $this->_mas1_detprovdr;
    }

    public function set_mas1_detprovdr($mas1_detprovdr) {

        $this->_mas1_detprovdr = $mas1_detprovdr;
    }

    public function get_mas2_detprovdr() {

        return $this->_mas2_detprovdr;
    }

    public function set_mas2_detprovdr($mas2_detprovdr) {

        $this->_mas2_detprovdr = $mas2_detprovdr;
    }

    public function get_mas3_detprovdr() {

        return $this->_mas3_detprovdr;
    }

    public function set_mas3_detprovdr($mas3_detprovdr) {

        $this->_mas3_detprovdr = $mas3_detprovdr;
    }

    public function get_obs_detprovdr() {

        return $this->_obs_detprovdr;
    }

    public function set_obs_detprovdr($obs_detprovdr) {

        $this->_obs_detprovdr = $obs_detprovdr;
    }

    public function addDetalle_proveedor($detalle_proveedor) {

        $sql="";
        $sql = $sql . "'" . $detalle_proveedor->get_id_proveedor() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_ip1_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_ip2_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_ip3_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_mas1_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_mas2_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_mas3_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_obs_detprovdr() . "'";
        $result = $this->_DB->select_query("call sp_detalle_proveedorinsert (" . $sql . ")");
        return $result;
    }

    public function updateDetalle_proveedor($detalle_proveedor) {

        $sql="";
        $sql = $sql . "'" . $detalle_proveedor->get_id_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_id_proveedor() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_ip1_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_ip2_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_ip3_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_mas1_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_mas2_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_mas3_detprovdr() . "',";
        $sql = $sql . "'" . $detalle_proveedor->get_obs_detprovdr() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_proveedorupdate (" . $sql . ")");
        return $result;
    }

    public function deleteDetalle_proveedor($id_detprovdr) {

        $sql = "DELETE FROM detalle_proveedor WHERE id_detprovdr='" . $id_detprovdr . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_proveedor($id_proveedor) {
        $detalle_proveedor = new detalle_proveedor();
        $sql = "SELECT * FROM detalle_proveedor WHERE id_detprovdr=" . $id_detprovdr;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $detalle_proveedor->set_id_detprovdr($row['id_detprovdr']);
            $detalle_proveedor->set_id_proveedor($row['id_proveedor']);
            $detalle_proveedor->set_ip1_detprovdr($row['ip1_detprovdr']);
            $detalle_proveedor->set_ip2_detprovdr($row['ip2_detprovdr']);
            $detalle_proveedor->set_ip3_detprovdr($row['ip3_detprovdr']);
            $detalle_proveedor->set_mas1_detprovdr($row['mas1_detprovdr']);
            $detalle_proveedor->set_mas2_detprovdr($row['mas2_detprovdr']);
            $detalle_proveedor->set_mas3_detprovdr($row['mas3_detprovdr']);
            $detalle_proveedor->set_obs_detprovdr($row['obs_detprovdr']);
        }
        return $detalle_proveedor;
    }

    public function listDetalle_proveedors($fecIni, $fecFinal) {

        $data = array();

        $sql = "SELECT * FROM detalle_proveedor WHERE fecha_detalle_proveedor>='" . $fecIni . "' AND fecha_detalle_proveedor <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_proveedor = new detalle_proveedor();

            $detalle_proveedor->set_id_detprovdr($row['id_detprovdr']);

            $detalle_proveedor->set_id_proveedor($row['id_proveedor']);

            $detalle_proveedor->set_ip1_detprovdr($row['ip1_detprovdr']);

            $detalle_proveedor->set_ip2_detprovdr($row['ip2_detprovdr']);

            $detalle_proveedor->set_ip3_detprovdr($row['ip3_detprovdr']);

            $detalle_proveedor->set_mas1_detprovdr($row['mas1_detprovdr']);

            $detalle_proveedor->set_mas2_detprovdr($row['mas2_detprovdr']);

            $detalle_proveedor->set_mas3_detprovdr($row['mas3_detprovdr']);

            $detalle_proveedor->set_obs_detprovdr($row['obs_detprovdr']);

            $data[] = $detalle_proveedor;
        }

        return $data;
    }

}

?>


