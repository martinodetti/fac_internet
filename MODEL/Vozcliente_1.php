<?php

class vozcliente_1 {

    public $_DB;
    public $_id_vozcliente;
    public $_detalle;
    public $_contacto;
    public $_patente;
    public $_fecha;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function vozcliente_1($id_vozcliente, $detalle,$contacto, $patente, $fecha) {

        $this->_id_vozcliente = $id_vozcliente;
        $this->_contacto = $contacto;
        $this->_detalle = $detalle;
        $this->_patente = $patente;
        $this->_fecha = $fecha;
    }

    public function get_id_vozcliente() {
        return $this->_id_vozcliente;
    }

    public function set_id_vozcliente($id_vozcliente) {

        $this->_id_vozcliente = $id_vozcliente;
    }
    
    public function get_patente() {

        return $this->_patente;
    }

    public function set_patente($patente) {

        $this->_patente = $patente;
    }

    public function get_detalle() {

        return $this->_detalle;
    }

    public function set_detalle($detalle) {

        $this->_detalle = $detalle;
    }

	public function get_fecha() {

        return $this->_fecha;
    }

    public function set_fecha($fecha) {

        $this->_fecha = $fecha;
    }

    public function get_contacto() {

        return $this->_contacto;
    }

    public function set_contacto($contacto) {

        $this->_contacto = $contacto;
    }
    
    public function addvozcliente($vozcliente) {

        $sql = "";

        $sql = $sql . "'" . $vozcliente->get_detalle() . "',";
        $sql = $sql . "'" . $vozcliente->get_patente() . "',";
        $sql = $sql . "'" . $vozcliente->get_contacto() . "'";
        $result = $this->_DB->select_query("call sp_vozcliente_insert (" . $sql . ")");

        return $result;
    }

    public function updatevozcliente($vozcliente) {

        $sql = "";

        $sql = $sql . "'" . $vozcliente->get_id_vozcliente() . "',";
        $sql = $sql . "'" . $vozcliente->get_detalle() . "',";
        $sql = $sql . "'" . $vozcliente->get_patente() . "',";
        $sql = $sql . "'" . $vozcliente->get_contacto() . "'";        

        $result = $this->_DB->alteration_query("call sp_vozclienteupdate (" . $sql . ")");

        return $result;
    }
    
    public function usarVozcliente($id_vozcliente)
    {
    	$sql = "";
    	$sql = "UPDATE vozcliente SET usada = 1 WHERE id_vozcliente = " . $id_vozcliente;
    	
    	$result = $this->_DB->alteration_query($sql);
    	
    	return $result;
    }

    public function deletevozcliente($id_vozcliente) {

        $sql = "DELETE FROM vozcliente WHERE id_vozcliente='" . $id_vozcliente . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showvozcliente($id_vozcliente) {

        $vozcliente = new vozcliente();

        $sql = "SELECT * FROM vozcliente WHERE id_vozcliente=" . $id_vozcliente;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {
            $vozcliente->set_id_vozcliente(	$row['id_vozcliente']	);
            $vozcliente->set_detalle(		$row['detalle']			);
            $vozcliente->set_contacto(		$row['contacto']		);
            $vozcliente->set_patente(		$row['patente']			);
        }
        return $vozcliente;
    }

    public function listvozclientes() {
        $data = array();
        $sql = "SELECT * FROM vozcliente WHERE usada = 0";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $vozcliente = new vozcliente();
            $vozcliente->set_id_vozcliente($row['id_vozcliente']);
            $vozcliente->set_detalle($row['detalle']);
            $vozcliente->set_contacto($row['contacto']);
            $vozcliente->set_fecha($row['fecha']);
            $vozcliente->set_patente($row['patente']);
            $data[] = $vozcliente;
        }
        return $data;
    }
}
?>
