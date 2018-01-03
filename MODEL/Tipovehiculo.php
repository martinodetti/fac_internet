<?php

class tipovehiculo {

    public $_DB;
    public $_id_tipovehiculo;
    public $_nom_tipovehiculo;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function tipovehiculo($id_tipovehiculo, $nom_tipovehiculo) {

        $this->_id_tipovehiculo = $id_tipovehiculo;

        $this->_nom_tipovehiculo = $nom_tipovehiculo;
    }

    public function get_id_tipovehiculo() {
        return $this->_id_tipovehiculo;
    }

    public function set_id_tipovehiculo($id_tipovehiculo) {

        $this->_id_tipovehiculo = $id_tipovehiculo;
    }

    public function get_nom_tipovehiculo() {

        return $this->_nom_tipovehiculo;
    }

    public function set_nom_tipovehiculo($nom_tipovehiculo) {

        $this->_nom_tipovehiculo = $nom_tipovehiculo;
    }

    public function addTipovehiculo($tipovehiculo) {
		//no está el sp en la db. debería crearlo si en algun momento se va a realizar al ABM este
        $sql;

        $sql = $sql . "'" . $ciudad->get_nom_ciudad() . "'";

        $result = $this->_DB->select_query("call sp_ciudad_insert (" . $sql . ")");

        return $result;
    }

    public function updateTipovehiculo($tipovehiculo) {
		//no está el sp en la db. Deberia crearlo si en algun momento se va a realizar el ABM este
        $sql;

        $sql = $sql . "'" . $ciudad->get_id_ciudad() . "',";

        $sql = $sql . "'" . $ciudad->get_nom_ciudad() . "'";

        $result = $this->_DB->alteration_query("call sp_ciudad_update (" . $sql . ")");

        return $result;
    }

    public function deleteTipovehiculo($id_tipovehiculo) {
		//no está el sp en la db. Deberia crearlo si en algun momento se va a realizar el ABM este
        $sql = "DELETE FROM ciudad WHERE id_ciudad='" . $id_ciudad . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showTipovehiculo($id_tipovehiculo) {

        $ciudad = new tipovehiculo();

        $sql = "SELECT * FROM tipovehiculo WHERE id_tipovehiculo=" . $id_tipovehiculo;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $ciudad->set_id_tipovehiculo($row['id_tipovehiculo']);

            $ciudad->set_nom_tipovehiculo($row['nom_tipovehiculo']);
        }

        return $ciudad;
    }

    public function listTipovehiculo() {
        $data = array();
        $sql = "SELECT * FROM tipovehiculo ";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
        	$tipovehiculo = array();
            $tipovehiculo['id'] 			= $row['id_tipovehiculo'];
            $tipovehiculo['tipovehiculo'] 	= $row['nom_tipovehiculo'];
            $data[] = $tipovehiculo;
        }
        return $data;
    }

}

?>
