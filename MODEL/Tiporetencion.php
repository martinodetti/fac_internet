<?php

class tiporetencion {

    public $_DB;
    public $_id_tiporeten;
    public $_cod_codRetAir;
    public $_nom_codRetAir;
    public $_porcentaje_codRetAir;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function tiporetencion($id_tiporeten, $cod_codRetAir, $nom_codRetAir, $porcentaje_codRetAir) {

        $this->_id_tiporeten = $id_tiporeten;

        $this->_cod_codRetAir = $cod_codRetAir;

        $this->_nom_codRetAir = $nom_codRetAir;

        $this->_porcentaje_codRetAir = $porcentaje_codRetAir;
    }

    public function get_id_tiporeten() {

        return $this->_id_tiporeten;
    }

    public function set_id_tiporeten($id_tiporeten) {

        $this->_id_tiporeten = $id_tiporeten;
    }

    public function get_cod_codRetAir() {

        return $this->_cod_codRetAir;
    }

    public function set_cod_codRetAir($cod_codRetAir) {

        $this->_cod_codRetAir = $cod_codRetAir;
    }

    public function get_nom_codRetAir() {

        return $this->_nom_codRetAir;
    }

    public function set_nom_codRetAir($nom_codRetAir) {

        $this->_nom_codRetAir = $nom_codRetAir;
    }

    public function get_porcentaje_codRetAir() {

        return $this->_porcentaje_codRetAir;
    }

    public function set_porcentaje_codRetAir($porcentaje_codRetAir) {

        $this->_porcentaje_codRetAir = $porcentaje_codRetAir;
    }

    public function addTiporetencion($tiporetencion) {
        $sql="";
        $sql = $sql . "'" . $tiporetencion->get_cod_codRetAir() . "',";
        $sql = $sql . "'" . $tiporetencion->get_nom_codRetAir() . "',";
        $sql = $sql . "'" . $tiporetencion->get_porcentaje_codRetAir() . "'";
        $result = $this->_DB->select_query("call sp_tiporetencioninsert (" . $sql . ")");
        return $result;
    }

    public function updateTiporetencion($tiporetencion) {
        $sql="";
        $sql = $sql . "'" . $tiporetencion->get_id_tiporeten() . "',";
        $sql = $sql . "'" . $tiporetencion->get_cod_codRetAir() . "',";
        $sql = $sql . "'" . $tiporetencion->get_nom_codRetAir() . "',";
        $sql = $sql . "'" . $tiporetencion->get_porcentaje_codRetAir() . "'";
        $result = $this->_DB->alteration_query("call sp_tiporetencionupdate (" . $sql . ")");
        return $result;
    }

    public function deleteTiporetencion($id_tiporeten) {
        $sql = "DELETE FROM tiporetencion WHERE id_tiporeten='" . $id_tiporeten . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showTiporetencion($cod_codRetAir) {
        $tiporetencion = new tiporetencion();
        $sql = "SELECT * FROM tiporetencion WHERE id_tiporeten=" . $id_tiporeten;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $tiporetencion->set_id_tiporeten($row['id_tiporeten']);
            $tiporetencion->set_cod_codRetAir($row['cod_codRetAir']);
            $tiporetencion->set_nom_codRetAir($row['nom_codRetAir']);
            $tiporetencion->set_porcentaje_codRetAir($row['porcentaje_codRetAir']);
        }

        return $tiporetencion;
    }

    public function listTiporetencions($descripcion) {
        $data = array();
        $sql = "SELECT * FROM tiporetencion WHERE nom_codRetAir like '".$descripcion."%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $tiporetencion = new tiporetencion();
            $tiporetencion->set_id_tiporeten($row['id_tiporeten']);
            $tiporetencion->set_cod_codRetAir($row['cod_codRetAir']);
            $tiporetencion->set_nom_codRetAir($row['nom_codRetAir']);
            $tiporetencion->set_porcentaje_codRetAir($row['porcentaje_codRetAir']);
            $data[] = $tiporetencion;
        }
        return $data;
    }
    /**
     *ComboTipoRetencion
     * @return tiporetencion 
     */
    public function ComboTipoRetencion(){
        $data = array();
        $sql = "SELECT * FROM tiporetencion";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $tiporetencion = new tiporetencion();
            $tiporetencion->set_id_tiporeten($row['id_tiporeten']);
            $tiporetencion->set_cod_codRetAir($row['cod_codRetAir']);
            $tiporetencion->set_nom_codRetAir($row['nom_codRetAir']);
            $tiporetencion->set_porcentaje_codRetAir($row['porcentaje_codRetAir']);
            $data[] = $tiporetencion;
        }
        return $data;
    }
    
     public function puedeEliminar($id_reten){
        $sql="SELECT (COUNT(id_tiporeten)+1) AS total FROM producto WHERE  id_tiporeten=".$id_reten;
         $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
    }

}


