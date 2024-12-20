<?php
include 'Ciudad.php';

class provincia {

    public $_DB;
    public $_id_provincia;
    public $_nom_provincia;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function provincia($id_provincia, $nom_provincia) {

        $this->_id_provincia = $id_provincia;

        $this->_nom_provincia = $nom_provincia;
    }

    public function get_id_provincia() {
        return $this->_id_provincia;
    }

    public function set_id_provincia($id_provincia) {

        $this->_id_provincia = $id_provincia;
    }

    public function get_nom_provincia() {

        return $this->_nom_provincia;
    }

    public function set_nom_provincia($nom_provincia) {

        $this->_nom_provincia = $nom_provincia;
    }

    public function addprovincia($provincia) {

        $sql = "";

        $sql = $sql . "'" . $provincia->get_nom_provincia() . "'";

        $result = $this->_DB->select_query("call sp_provincia_insert (" . $sql . ")");

        return $result;
    }

    public function updateprovincia($provincia) {

        $sql = "";

        $sql = $sql . "'" . $provincia->get_id_provincia() . "',";

        $sql = $sql . "'" . $provincia->get_nom_provincia() . "'";

        $result = $this->_DB->alteration_query("call sp_provinciaupdate (" . $sql . ")");

        return $result;
    }

    public function deleteprovincia($id_provincia) {

        $sql = "DELETE FROM provincia WHERE id_provincia='" . $id_provincia . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showprovincia($nom_provincia) {

        $provincia = new provincia();

        $sql = "SELECT * FROM provincia WHERE id_provincia=" . $id_provincia;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {
            $provincia->set_id_provincia($row['id_provincia']);
            $provincia->set_nom_provincia($row['nom_provincia']);
        }
        return $provincia;
    }

    public function listprovincias() {
        $data = array();
        $sql = "SELECT * FROM provincia ";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $provincia = new provincia();
            $provincia->set_id_provincia($row['id_provincia']);
            $provincia->set_nom_provincia($row['nom_provincia']);
            $data[] = $provincia;
        }
        return $data;
    }
    
    public function listCiudades($idprovincia) {
        $data = array();
        $sql = "SELECT * FROM ciudad 
        		WHERE id_provincia = " . $idprovincia;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {

            $ciudad = new ciudad();
            $ciudad->set_id_ciudad(		$row['id_ciudad']	);
            $ciudad->set_nom_ciudad(	$row['nom_ciudad']	);
            $data[] = $ciudad;
        }

        return $data;
    }
    
    
    
}
?>
