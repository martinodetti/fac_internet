<?php

class empresa {

    public $_DB;
    public $_id_empresa;
    public $_id_contador;
    public $_id_representante;
    public $_id_ciudad;
    public $_razsocial_empresa;
    public $_ruc_empresa;
    public $_direc_empresa;
    public $_telf_empresa;
    public $_cel_empresa;
    public $_web_empresa;
    public $_correo_empresa;
    public $_fecha_empresa;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function empresa($id_empresa, $id_contador, $id_representante, $id_ciudad, $razsocial_empresa, $ruc_empresa, $direc_empresa, $telf_empresa, $cel_empresa, $web_empresa, $correo_empresa, $fecha_empresa) {

        $this->_id_empresa = $id_empresa;

        $this->_id_contador = $id_contador;

        $this->_id_representante = $id_representante;

        $this->_id_ciudad = $id_ciudad;

        $this->_razsocial_empresa = $razsocial_empresa;

        $this->_ruc_empresa = $ruc_empresa;

        $this->_direc_empresa = $direc_empresa;

        $this->_telf_empresa = $telf_empresa;

        $this->_cel_empresa = $cel_empresa;

        $this->_web_empresa = $web_empresa;

        $this->_correo_empresa = $correo_empresa;

        $this->_fecha_empresa = $fecha_empresa;
    }

    public function get_id_empresa() {
        return $this->_id_empresa;
    }

    public function set_id_empresa($id_empresa) {

        $this->_id_empresa = $id_empresa;
    }

    public function get_id_contador() {

        return $this->_id_contador;
    }

    public function set_id_contador($id_contador) {

        $this->_id_contador = $id_contador;
    }

    public function get_id_representante() {

        return $this->_id_representante;
    }

    public function set_id_representante($id_representante) {

        $this->_id_representante = $id_representante;
    }

    public function get_id_ciudad() {

        return $this->_id_ciudad;
    }

    public function set_id_ciudad($id_ciudad) {

        $this->_id_ciudad = $id_ciudad;
    }

    public function get_razsocial_empresa() {

        return $this->_razsocial_empresa;
    }

    public function set_razsocial_empresa($razsocial_empresa) {

        $this->_razsocial_empresa = $razsocial_empresa;
    }

    public function get_ruc_empresa() {

        return $this->_ruc_empresa;
    }

    public function set_ruc_empresa($ruc_empresa) {

        $this->_ruc_empresa = $ruc_empresa;
    }

    public function get_direc_empresa() {

        return $this->_direc_empresa;
    }

    public function set_direc_empresa($direc_empresa) {

        $this->_direc_empresa = $direc_empresa;
    }

    public function get_telf_empresa() {

        return $this->_telf_empresa;
    }

    public function set_telf_empresa($telf_empresa) {

        $this->_telf_empresa = $telf_empresa;
    }

    public function get_cel_empresa() {

        return $this->_cel_empresa;
    }

    public function set_cel_empresa($cel_empresa) {

        $this->_cel_empresa = $cel_empresa;
    }

    public function get_web_empresa() {

        return $this->_web_empresa;
    }

    public function set_web_empresa($web_empresa) {

        $this->_web_empresa = $web_empresa;
    }

    public function get_correo_empresa() {

        return $this->_correo_empresa;
    }

    public function set_correo_empresa($correo_empresa) {

        $this->_correo_empresa = $correo_empresa;
    }

    public function get_fecha_empresa() {

        return $this->_fecha_empresa;
    }

    public function set_fecha_empresa($fecha_empresa) {

        $this->_fecha_empresa = $fecha_empresa;
    }

    public function addEmpresa($empresa) {

        $sql;

        $sql = $sql . "'" . $empresa->get_id_contador() . "',";

        $sql = $sql . "'" . $empresa->get_id_representante() . "',";

        $sql = $sql . "'" . $empresa->get_id_ciudad() . "',";

        $sql = $sql . "'" . $empresa->get_razsocial_empresa() . "',";

        $sql = $sql . "'" . $empresa->get_ruc_empresa() . "',";

        $sql = $sql . "'" . $empresa->get_direc_empresa() . "',";

        $sql = $sql . "'" . $empresa->get_telf_empresa() . "',";

        $sql = $sql . "'" . $empresa->get_cel_empresa() . "',";

        $sql = $sql . "'" . $empresa->get_web_empresa() . "',";

        $sql = $sql . "'" . $empresa->get_correo_empresa() . "',";

        $sql = $sql . "'" . $empresa->get_fecha_empresa() . "'";

        $result = $this->_DB->select_query("call sp_empresa_insert (" . $sql . ")");

        return $result;
    }

    /**
     *Update empresa
     * @param type $empresa
     * @return type 
     */
    public function updateEmpresa($empresa) {
        $sql="";
        $sql = $sql . "'" . $empresa->get_id_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_id_contador() . "',";
        $sql = $sql . "'" . $empresa->get_id_representante() . "',";
        $sql = $sql . "'" . $empresa->get_id_ciudad() . "',";
        $sql = $sql . "'" . $empresa->get_razsocial_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_ruc_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_direc_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_telf_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_cel_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_web_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_correo_empresa() . "',";
        $sql = $sql . "'" . $empresa->get_fecha_empresa() . "'";
        $result = $this->_DB->alteration_query("call sp_empresaupdate (" . $sql . ")");

        return $result;
    }

    public function deleteEmpresa($id_empresa) {

        $sql = "DELETE FROM empresa WHERE id_empresa='" . $id_empresa . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

 
    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }
/*
 * Habilitado
 */
    public function showEmpresa($id_empresa) {

        $empresa = new empresa();

        $sql = "SELECT * FROM empresa WHERE id_empresa=" . $id_empresa;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $empresa->set_id_empresa($row['id_empresa']);
            $empresa->set_id_contador($row['id_contador']);
            $empresa->set_id_representante($row['id_representante']);
            $empresa->set_id_ciudad($row['id_ciudad']);
            $empresa->set_razsocial_empresa($row['razsocial_empresa']);
            $empresa->set_ruc_empresa($row['ruc_empresa']);
            $empresa->set_direc_empresa($row['direc_empresa']);
            $empresa->set_telf_empresa($row['telf_empresa']);
            $empresa->set_cel_empresa($row['cel_empresa']);
            $empresa->set_web_empresa($row['web_empresa']);
            $empresa->set_correo_empresa($row['correo_empresa']);
            $empresa->set_fecha_empresa($row['fecha_empresa']);
        }

        return $empresa;
    }

  

}

?>
