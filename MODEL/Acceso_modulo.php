<?php

class acceso_modulo {

    public $_DB;
    public $_id_acsmod;
    public $_id_persona;
    public $_id_modulo;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function acceso_modulo($id_acsmod, $id_persona, $id_modulo) {

        $this->_id_acsmod = $id_acsmod;

        $this->_id_persona = $id_persona;

        $this->_id_modulo = $id_modulo;
    }
    
     public function get_id_acsmod() {

        return $this->_id_acsmod;
    }

    public function set_id_acsmod($id_acsmod) {

        $this->_id_acsmod = $id_acsmod;
    }

    public function get_id_persona() {

        return $this->_id_persona;
    }

    public function set_id_persona($id_persona) {

        $this->_id_persona = $id_persona;
    }

    public function get_id_modulo() {

        return $this->_id_modulo;
    }

    public function set_id_modulo($id_modulo) {

        $this->_id_modulo = $id_modulo;
    }

    public function addAcceso_modulo($acceso_modulo) {
        $sql="";
        $sql = $sql . "'" . $acceso_modulo->get_id_persona() . "',";
        $sql = $sql . "'" . $acceso_modulo->get_id_modulo() . "'";
        $result = $this->_DB->select_query("call sp_acceso_moduloinsert (" . $sql . ")");
        return $result;
    }

    public function updateAcceso_modulo($acceso_modulo) {

        $sql="";

        $sql = $sql . "'" . $acceso_modulo->get_id_acsmod() . "',";

        $sql = $sql . "'" . $acceso_modulo->get_id_persona() . "',";

        $sql = $sql . "'" . $acceso_modulo->get_id_modulo() . "'";

        $result = $this->_DB->alteration_query("call sp_acceso_modulo_update (" . $sql . ")");

        return $result;
    }

    public function deleteAcceso_modulo($id_persona) {
        $sql = "DELETE FROM acceso_modulo WHERE id_persona='" . $id_persona . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

 
   
    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showAcceso_modulo($id_persona) {

        $acceso_modulo = new acceso_modulo();

        $sql = "SELECT * FROM acceso_modulo WHERE id_acsmod=" . $id_acsmod;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $acceso_modulo->set_id_acsmod($row['id_acsmod']);

            $acceso_modulo->set_id_persona($row['id_persona']);

            $acceso_modulo->set_id_modulo($row['id_modulo']);
        }

        return $acceso_modulo;
    }
    
    public function showAcceso_modulo_persona($id_persona) {

        $acceso_modulo = new acceso_modulo();

        $sql = "SELECT * FROM acceso_modulo WHERE id_persona=" . $id_persona;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $acceso_modulo->set_id_acsmod($row['id_acsmod']);

            $acceso_modulo->set_id_persona($row['id_persona']);

            $acceso_modulo->set_id_modulo($row['id_modulo']);
        }

        return $acceso_modulo;
    }

    public function listAcceso_modulos($fecIni, $fecFinal) {

        $data = array();

        $sql = "SELECT * FROM acceso_modulo WHERE fecha_acceso_modulo>='" . $fecIni . "' AND fecha_acceso_modulo <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $acceso_modulo = new acceso_modulo();

            $acceso_modulo->set_id_acsmod($row['id_acsmod']);

            $acceso_modulo->set_id_persona($row['id_persona']);

            $acceso_modulo->set_id_modulo($row['id_modulo']);

            $data[] = $acceso_modulo;
        }

        return $data;
    }
    
    public function listModulosPorEmpleado($idp){
    	$data = array();
    	$sql = "SELECT 	m.id_modulo, m.id_padre, m.nom_modulo, mp.nom_modulo as nom_padre
				FROM 	acceso_modulo am 
				JOIN 	modulo m USING(id_modulo) 
				LEFT JOIN modulo mp ON(mp.id_modulo = m.id_padre)
				WHERE 	id_persona = " . $idp;
				
		$result = $this->_DB->select_query($sql);
		
		foreach($result as $row){
			$data[] = array("id_modulo" => $row['id_modulo'], "nom_modulo" => $row['nom_modulo'],
							"id_padre"	=> $row['id_padre'] , "nom_padre"  => $row['nom_padre']);
		}
		
		return $data;
    
    }
    
    public function addPadre($ido, $padre)
    {
    	$sql = "REPLACE INTO acceso_modulo (id_persona, id_modulo) SELECT " . $ido . " , id_modulo FROM modulo WHERE nom_modulo = '".$padre."'";
    	$result = $this->_DB->alteration_query($sql);
    	return $result;
    }
    
    
    

}


