<?php

class v_cliente_pago {

    public $_DB;
    public $_id_persona;
    public $_nom_persona;
    public $_ape_persona;
    public $_ruc_persona;
    public $_direc_persona;
    public $_telf_persona;
    public $_cel_persona;
    public $_email_persona;
    public $_canti_pago;
    public $_fecha_pago;
    public $_estado_pago;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function v_cliente_pago($id_persona, $nom_persona, $ape_persona, $ruc_persona, $direc_persona, $telf_persona, $cel_persona, $email_persona, $canti_pago, $fecha_pago, $estado_pago) {

        $this->_id_persona = $id_persona;

        $this->_nom_persona = $nom_persona;

        $this->_ape_persona = $ape_persona;

        $this->_ruc_persona = $ruc_persona;

        $this->_direc_persona = $direc_persona;

        $this->_telf_persona = $telf_persona;

        $this->_cel_persona = $cel_persona;

        $this->_email_persona = $email_persona;

        $this->_canti_pago = $canti_pago;

        $this->_fecha_pago = $fecha_pago;

        $this->_estado_pago = $estado_pago;
    }

    public function get_id_persona() {
        return $this->_id_persona;
    }

    public function set_id_persona($id_persona) {

        $this->_id_persona = $id_persona;
    }

    public function get_nom_persona() {

        return $this->_nom_persona;
    }

    public function set_nom_persona($nom_persona) {

        $this->_nom_persona = $nom_persona;
    }

    public function get_ape_persona() {

        return $this->_ape_persona;
    }

    public function set_ape_persona($ape_persona) {

        $this->_ape_persona = $ape_persona;
    }

    public function get_ruc_persona() {

        return $this->_ruc_persona;
    }

    public function set_ruc_persona($ruc_persona) {

        $this->_ruc_persona = $ruc_persona;
    }

    public function get_direc_persona() {

        return $this->_direc_persona;
    }

    public function set_direc_persona($direc_persona) {

        $this->_direc_persona = $direc_persona;
    }

    public function get_telf_persona() {

        return $this->_telf_persona;
    }

    public function set_telf_persona($telf_persona) {

        $this->_telf_persona = $telf_persona;
    }

    public function get_cel_persona() {

        return $this->_cel_persona;
    }

    public function set_cel_persona($cel_persona) {

        $this->_cel_persona = $cel_persona;
    }

    public function get_email_persona() {

        return $this->_email_persona;
    }

    public function set_email_persona($email_persona) {

        $this->_email_persona = $email_persona;
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

  

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    

    public function listV_cliente_pagos($fecIni) {

        $data = array();

        $sql = "SELECT * FROM v_cliente_pago WHERE estado_pago='0' AND (YEAR(fecha_pago)=YEAR('$fecIni') AND MONTH(fecha_pago)=MONTH('$fecIni'));";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $v_cliente_pago = new v_cliente_pago();

            $v_cliente_pago->set_id_persona($row['id_persona']);

            $v_cliente_pago->set_nom_persona($row['nom_persona']);

            $v_cliente_pago->set_ape_persona($row['ape_persona']);

            $v_cliente_pago->set_ruc_persona($row['ruc_persona']);

            $v_cliente_pago->set_direc_persona($row['direc_persona']);

            $v_cliente_pago->set_telf_persona($row['telf_persona']);

            $v_cliente_pago->set_cel_persona($row['cel_persona']);

            $v_cliente_pago->set_email_persona($row['email_persona']);

            $v_cliente_pago->set_canti_pago($row['canti_pago']);

            $v_cliente_pago->set_fecha_pago($row['fecha_pago']);

            $v_cliente_pago->set_estado_pago($row['estado_pago']);

            $data[] = $v_cliente_pago;
        }

        return $data;
    }
   
    public function listV_cliente_pago_IniFin($fecIni,$fecFinal) {

        $data = array();
        $sql = "SELECT * FROM v_cliente_pago WHERE estado_pago='0' AND (fecha_pago>=$fecIni AND fecha_pago<=$fecFinal )";
        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $v_cliente_pago = new v_cliente_pago();

            $v_cliente_pago->set_id_persona($row['id_persona']);

            $v_cliente_pago->set_nom_persona($row['nom_persona']);

            $v_cliente_pago->set_ape_persona($row['ape_persona']);

            $v_cliente_pago->set_ruc_persona($row['ruc_persona']);

            $v_cliente_pago->set_direc_persona($row['direc_persona']);

            $v_cliente_pago->set_telf_persona($row['telf_persona']);

            $v_cliente_pago->set_cel_persona($row['cel_persona']);

            $v_cliente_pago->set_email_persona($row['email_persona']);

            $v_cliente_pago->set_canti_pago($row['canti_pago']);

            $v_cliente_pago->set_fecha_pago($row['fecha_pago']);

            $v_cliente_pago->set_estado_pago($row['estado_pago']);

            $data[] = $v_cliente_pago;
        }

        return $data;
    }

}

?>

