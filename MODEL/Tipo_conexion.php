<?php

class tipo_conexion {

    public $_DB;
    public $_id_tipoconex;
    public $_nom_tipoconex;
    public $_estado_tipoconex;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function tipo_conexion($id_tipoconex, $nom_tipoconex, $estado_tipoconex) {

        $this->_id_tipoconex = $id_tipoconex;

        $this->_nom_tipoconex = $nom_tipoconex;

        $this->_estado_tipoconex = $estado_tipoconex;
    }

    public function get_id_tipoconex() {
        return $this->_id_tipoconex;
    }

    public function set_id_tipoconex($id_tipoconex) {

        $this->_id_tipoconex = $id_tipoconex;
    }

    public function get_nom_tipoconex() {

        return $this->_nom_tipoconex;
    }

    public function set_nom_tipoconex($nom_tipoconex) {

        $this->_nom_tipoconex = $nom_tipoconex;
    }

    public function get_estado_tipoconex() {

        return $this->_estado_tipoconex;
    }

    public function set_estado_tipoconex($estado_tipoconex) {

        $this->_estado_tipoconex = $estado_tipoconex;
    }
/**
 *No eestan habilitadas
 * @param type $tipo_conexion
 * @return type 
 */
    public function addTipo_conexion($tipo_conexion) {

        $sql="";
        $sql = $sql . "'" . $tipo_conexion->get_nom_tipoconex() . "',";
        $sql = $sql . "'" . $tipo_conexion->get_estado_tipoconex() . "'";
        $result = $this->_DB->select_query("call sp_tipo_conexion_insert (" . $sql . ")");
        return $result;
    }

    /**
     *No eestan habilitadas
     * @param type $tipo_conexion
     * @return type 
     */
    public function updateTipo_conexion($tipo_conexion) {

        $sql="";

        $sql = $sql . "'" . $tipo_conexion->get_id_tipoconex() . "',";

        $sql = $sql . "'" . $tipo_conexion->get_nom_tipoconex() . "',";

        $sql = $sql . "'" . $tipo_conexion->get_estado_tipoconex() . "'";

        $result = $this->_DB->alteration_query("call sp_tipo_conexion_update (" . $sql . ")");

        return $result;
    }

    public function deleteTipo_conexion($id_tipoconex) {

        $sql = "DELETE FROM tipo_conexion WHERE id_tipoconex='" . $id_tipoconex . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showTipo_conexion($nom_tipoconex) {

        $tipo_conexion = new tipo_conexion();

        $sql = "SELECT * FROM tipo_conexion WHERE id_tipoconex=" . $id_tipoconex;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $tipo_conexion->set_id_tipoconex($row['id_tipoconex']);

            $tipo_conexion->set_nom_tipoconex($row['nom_tipoconex']);

            $tipo_conexion->set_estado_tipoconex($row['estado_tipoconex']);
        }

        return $tipo_conexion;
    }

    public function listTipo_conexions() {
        $data = array();
        $sql = "SELECT * FROM tipo_conexion ";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $tipo_conexion = new tipo_conexion();
            $tipo_conexion->set_id_tipoconex($row['id_tipoconex']);
            $tipo_conexion->set_nom_tipoconex($row['nom_tipoconex']);
            $tipo_conexion->set_estado_tipoconex($row['estado_tipoconex']);
            $data[] = $tipo_conexion;
        }
        return $data;
    }

}
?>

