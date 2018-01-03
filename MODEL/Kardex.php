<?php

class kardex {

    public $_DB;
    public $_id_kardex;
    public $_id_factcmp_kardex;
    public $_tipo_entrdsald_kardex;
    public $_tipo_cmpbt_kardex;
    public $_cod_factcmp_kardex;
    public $_fecha_kardex;
    public $_estado_kardex;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function kardex($id_kardex, $id_factcmp_kardex, $tipo_entrdsald_kardex, $tipo_cmpbt_kardex, $cod_factcmp_kardex, $fecha_kardex, $estado_kardex) {

        $this->_id_kardex = $id_kardex;

        $this->_id_factcmp_kardex = $id_factcmp_kardex;

        $this->_tipo_entrdsald_kardex = $tipo_entrdsald_kardex;

        $this->_tipo_cmpbt_kardex = $tipo_cmpbt_kardex;

        $this->_cod_factcmp_kardex = $cod_factcmp_kardex;

        $this->_fecha_kardex = $fecha_kardex;

        $this->_estado_kardex = $estado_kardex;
    }

    public function get_id_kardex() {
        return $this->_id_kardex;
    }

    public function set_id_kardex($id_kardex) {

        $this->_id_kardex = $id_kardex;
    }

    public function get_id_factcmp_kardex() {

        return $this->_id_factcmp_kardex;
    }

    public function set_id_factcmp_kardex($id_factcmp_kardex) {

        $this->_id_factcmp_kardex = $id_factcmp_kardex;
    }

    public function get_tipo_entrdsald_kardex() {

        return $this->_tipo_entrdsald_kardex;
    }

    public function set_tipo_entrdsald_kardex($tipo_entrdsald_kardex) {

        $this->_tipo_entrdsald_kardex = $tipo_entrdsald_kardex;
    }

    public function get_tipo_cmpbt_kardex() {

        return $this->_tipo_cmpbt_kardex;
    }

    public function set_tipo_cmpbt_kardex($tipo_cmpbt_kardex) {

        $this->_tipo_cmpbt_kardex = $tipo_cmpbt_kardex;
    }

    public function get_cod_factcmp_kardex() {

        return $this->_cod_factcmp_kardex;
    }

    public function set_cod_factcmp_kardex($cod_factcmp_kardex) {

        $this->_cod_factcmp_kardex = $cod_factcmp_kardex;
    }

    public function get_fecha_kardex() {

        return $this->_fecha_kardex;
    }

    public function set_fecha_kardex($fecha_kardex) {

        $this->_fecha_kardex = $fecha_kardex;
    }

    public function get_estado_kardex() {

        return $this->_estado_kardex;
    }

    public function set_estado_kardex($estado_kardex) {

        $this->_estado_kardex = $estado_kardex;
    }

    public function addKardex($kardex) {

        $sql="";
        $sql = $sql . "'" . $kardex->get_id_factcmp_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_tipo_entrdsald_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_tipo_cmpbt_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_cod_factcmp_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_fecha_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_estado_kardex() . "'";
        $result = $this->_DB->select_query("call sp_kardexinsert (" . $sql . ")");
        return $result;
    }

    public function updateKardex($kardex) {
        $sql="";
        $sql = $sql . "'" . $kardex->get_id_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_id_factcmp_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_tipo_entrdsald_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_tipo_cmpbt_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_cod_factcmp_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_fecha_kardex() . "',";
        $sql = $sql . "'" . $kardex->get_estado_kardex() . "'";
        $result = $this->_DB->alteration_query("call sp_kardexupdate (" . $sql . ")");
        return $result;
    }

    public function deleteKardex($id_kardex) {
        $sql = "DELETE FROM kardex WHERE id_kardex='" . $id_kardex . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showKardex($id_factcmp_kardex) {
        $kardex = new kardex();
        $sql = "SELECT * FROM kardex WHERE id_kardex=" . $id_kardex;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $kardex->set_id_kardex($row['id_kardex']);
            $kardex->set_id_factcmp_kardex($row['id_factcmp_kardex']);
            $kardex->set_tipo_entrdsald_kardex($row['tipo_entrdsald_kardex']);
            $kardex->set_tipo_cmpbt_kardex($row['tipo_cmpbt_kardex']);
            $kardex->set_cod_factcmp_kardex($row['cod_factcmp_kardex']);
            $kardex->set_fecha_kardex($row['fecha_kardex']);
            $kardex->set_estado_kardex($row['estado_kardex']);
        }

        return $kardex;
    }

    public function listKardexs($idproducto,$fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM kardex WHERE INSTR(cod_factcmp_kardex,'".$idproducto."-') AND fecha_kardex>='".$fecIni."' AND fecha_kardex<='".$fecFinal."'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $kardex = new kardex();
            $kardex->set_id_kardex($row['id_kardex']);
            $kardex->set_id_factcmp_kardex($row['id_factcmp_kardex']);
            $kardex->set_tipo_entrdsald_kardex($row['tipo_entrdsald_kardex']);
            $kardex->set_tipo_cmpbt_kardex($row['tipo_cmpbt_kardex']);
            $kardex->set_cod_factcmp_kardex($row['cod_factcmp_kardex']);
            $kardex->set_fecha_kardex($row['fecha_kardex']);
            $kardex->set_estado_kardex($row['estado_kardex']);
            $data[] = $kardex;
        }
        return $data;
    }
    
   

}

?>