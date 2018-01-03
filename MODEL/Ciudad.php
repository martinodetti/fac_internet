<?php

class ciudad {

    public $_DB;
    public $_id_ciudad;
    public $_nom_ciudad;
    public $_id_provincia;
    public $_nom_provicia;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function ciudad($id_ciudad, $nom_ciudad) {

        $this->_id_ciudad = $id_ciudad;

        $this->_nom_ciudad = $nom_ciudad;
    }

    public function get_id_ciudad() {
        return $this->_id_ciudad;
    }

    public function set_id_ciudad($id_ciudad) {

        $this->_id_ciudad = $id_ciudad;
    }
    
    public function get_id_provincia() {
        return $this->_id_provincia;
    }

    public function set_id_provincia($id_provincia) {

        $this->_id_provincia = $id_provincia;
    }

    public function get_nom_ciudad() {

        return $this->_nom_ciudad;
    }

    public function set_nom_ciudad($nom_ciudad) {

        $this->_nom_ciudad = $nom_ciudad;
    }
    
    public function get_nom_provincia() {

        return $this->_nom_provincia;
    }

    public function set_nom_provincia($nom_provincia) {

        $this->_nom_provincia = $nom_provincia;
    }

    public function addCiudad($ciudad) {

        $sql = "";

        $sql = $sql . "'" . $ciudad->get_nom_ciudad() . "',";
        
        $sql = $sql . "'" . $ciudad->get_id_provincia() . "'";

        $result = $this->_DB->select_query("call sp_ciudad_insert (" . $sql . ")");

        return $result;
    }

    public function updateCiudad($ciudad) {

        $sql = "UPDATE ciudad set nom_ciudad = ";

        $sql = $sql . "'" . $ciudad->get_nom_ciudad() . "'";

		$sql = $sql . " WHERE id_ciudad = ";
					
		$sql = $sql . "" . $ciudad->get_id_ciudad() . "";

        $result = $this->_DB->alteration_query( $sql );

        return $result;
    }

    public function deleteCiudad($id_ciudad) {

        $sql = "DELETE FROM ciudad WHERE id_ciudad='" . $id_ciudad . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showCiudad($nom_ciudad = '', $id_ciudad= '') {

        $ciudad = new ciudad();

        $sql = "SELECT ciudad.*, provincia.nom_provincia FROM ciudad JOIN provincia USING(id_provincia) WHERE id_ciudad=" . $id_ciudad;

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {

            $ciudad->set_id_ciudad($row['id_ciudad']);

            $ciudad->set_nom_ciudad($row['nom_ciudad']);
            
            $ciudad->set_id_provincia($row['id_provincia']);
            
            $ciudad->set_nom_provincia($row['nom_provincia']);
        }

        return $ciudad;
    }

    public function listCiudads() {
        $data = array();
        $sql = "SELECT * FROM ciudad ";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $ciudad = new ciudad();
            $ciudad->set_id_ciudad($row['id_ciudad']);
            $ciudad->set_nom_ciudad($row['nom_ciudad']);
            $data[] = $ciudad;
        }

        return $data;
    }
   
    public function listCiudadesjson($id_prov){
    	$data = array();
    	$sql = "select * from ciudad where id_provincia = " . $id_prov;
    	$result = $this->_DB->select_query($sql);
    	foreach($result as $row){
    		$data[] = array("id_ciudad" => $row['id_ciudad'], "nom_ciudad" => $row['nom_ciudad']);
    	}
    	return json_encode($data);
    }
    
    public function listCiudadejsonPaso2($id_c){
    	$sql = "select * from ciudad where id_provincia = (select id_provincia from ciudad where id_ciudad = ". $id_c . ")";
    	$result = $this->_DB->select_query($sql);
    	foreach($result as $row){
    		$data[] = array("id_ciudad" => $row['id_ciudad'], "nom_ciudad" => $row['nom_ciudad'], "id_provincia" => $row['id_provincia']);
    	}
    	return json_encode($data);    	
    }
}
?>
