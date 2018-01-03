<?php

class v_cliente_pendiente {

    public $_DB;
    public $_id_cliente;
    public $_nom_persona;
    public $_ape_persona;
    public $_ruc_persona;
    public $_telf_persona;
    public $_cel_persona;
    public $_direc_persona;
    public $_id_trabajador;
    public $_id_tipoconex;
    public $_ip_detcliente;
    public $_hora_detcliente;
    public $_fecha_detcliente;
    public $_estado_conex;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function v_cliente_pendiente($id_cliente, $nom_persona, $ape_persona, $ruc_persona,$telf_persona,$cel_persona,$direc_persona, $id_trabajador, $id_tipoconex, $ip_detcliente, $hora_detcliente, $fecha_detcliente, $estado_conex) {

        $this->_id_cliente = $id_cliente;
        $this->_nom_persona = $nom_persona;
        $this->_ape_persona = $ape_persona;
        $this->_ruc_persona = $ruc_persona;
        $this->_telf_persona=$telf_persona;
        $this->_cel_persona=$cel_persona;
        $this->_direc_persona=$direc_persona;
        
        $this->_id_trabajador = $id_trabajador;
        $this->_id_tipoconex = $id_tipoconex;
        $this->_ip_detcliente = $ip_detcliente;
        $this->_hora_detcliente = $hora_detcliente;
        $this->_fecha_detcliente = $fecha_detcliente;
        $this->_estado_conex = $estado_conex;
    }

    public function get_id_cliente() {
        return $this->_id_cliente;
    }

    public function set_id_cliente($id_cliente) {

        $this->_id_cliente = $id_cliente;
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

    public function get_telf_persona() {
         return $this->_telf_persona;
    }
    
    public function set_telf_persona($telf_persona) {
        $this->_telf_persona = $telf_persona;
    }
    
    public function get_cel_persona(){
      return  $this->_cel_persona;
    }
    
    public function set_cel_persona($cel_persona){
        $this->_cel_persona=$cel_persona;
    }
    public function get_direc_persona(){
      return  $this->_direc_persona;
    }
     public function set_direc_persona($direc_persona){
         $this->_direc_persona=$direc_persona;
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

    public function showV_cliente_pendiente($id_cliente) {
        $v_cliente_pendiente = new v_cliente_pendiente();
        $sql = "SELECT * FROM v_cliente_pendiente WHERE id_cliente=" . $id_cliente;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $v_cliente_pendiente->set_id_cliente($row['id_cliente']);
            $v_cliente_pendiente->set_nom_persona($row['nom_persona']);
            $v_cliente_pendiente->set_ape_persona($row['ape_persona']);
            $v_cliente_pendiente->set_ruc_persona($row['ruc_persona']);
            $v_cliente_pendiente->set_telf_persona($row['telf_persona']);
            $v_cliente_pendiente->set_cel_persona($row['cel_persona']);
            $v_cliente_pendiente->set_direc_persona($row['direc_persona']);
            
            $v_cliente_pendiente->set_id_trabajador($row['id_trabajador']);
            $v_cliente_pendiente->set_id_tipoconex($row['id_tipoconex']);
            $v_cliente_pendiente->set_ip_detcliente($row['ip_detcliente']);
            $v_cliente_pendiente->set_hora_detcliente($row['hora_detcliente']);
            $v_cliente_pendiente->set_fecha_detcliente($row['fecha_detcliente']);
            $v_cliente_pendiente->set_estado_conex($row['estado_conex']);
        }

        return $v_cliente_pendiente;
    }

     public function ListClientePendientes($fecha){
        $data = array();
        $sql="SELECT * FROM v_cliente_pendiente WHERE fecha_detcliente='".$fecha."' AND estado_conex='0' ORDER BY hora_detcliente ASC";
        $result = $this->_DB->select_query($sql);
          foreach ($result as $row) {
            $v_cliente_pendiente = new v_cliente_pendiente();
            $v_cliente_pendiente->set_id_cliente($row['id_cliente']);
            $v_cliente_pendiente->set_nom_persona($row['nom_persona']);
            $v_cliente_pendiente->set_ape_persona($row['ape_persona']);
            $v_cliente_pendiente->set_ruc_persona($row['ruc_persona']);
            $v_cliente_pendiente->set_telf_persona($row['telf_persona']);
            $v_cliente_pendiente->set_cel_persona($row['cel_persona']);
            $v_cliente_pendiente->set_direc_persona($row['direc_persona']);
            
            $v_cliente_pendiente->set_id_trabajador($row['id_trabajador']);
            $v_cliente_pendiente->set_id_tipoconex($row['id_tipoconex']);
            $v_cliente_pendiente->set_ip_detcliente($row['ip_detcliente']);
            $v_cliente_pendiente->set_hora_detcliente($row['hora_detcliente']);
            $v_cliente_pendiente->set_fecha_detcliente($row['fecha_detcliente']);
            $v_cliente_pendiente->set_estado_conex($row['estado_conex']);
            $data[] = $v_cliente_pendiente;
        }

        return $data;
    }
    

}

?>


