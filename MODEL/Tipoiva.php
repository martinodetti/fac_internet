<?php

class tipoiva {

    public $_DB;
    public $_id_tipoiva;
    public $_nom_tipoiva;
    public $_porcentaje_iva;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function tipoiva($id_tipoiva, $nom_tipoiva, $porcentaje_iva) {

        $this->_id_tipoiva = $id_tipoiva;

        $this->_nom_tipoiva = $nom_tipoiva;

        $this->_porcentaje_iva = $porcentaje_iva;

    }

    public function get_id_tipoiva() {

        return $this->_id_tipoiva;
    }

    public function set_id_tipoiva($id_tipoiva) {

        $this->_id_tipoiva = $id_tipoiva;
    }

    public function get_nom_tipoiva() {

        return $this->_nom_tipoiva;
    }

    public function set_nom_tipoiva($nom_tipoiva) {

        $this->_nom_tipoiva = $nom_tipoiva;
    }

    public function get_porcentaje_iva() {

        return $this->_porcentaje_iva;
    }

    public function set_porcentaje_iva($porcentaje_iva) {

        $this->_porcentaje_iva = $porcentaje_iva;
    }


    public function addTipoova($tipoiva) {
        $sql="";
        $sql = $sql . "'" . $tipoiva->get_nom_tipoiva() . "',";
        $sql = $sql . "'" . $tipoiva->get_porcentaje_iva() . "',";
        $result = $this->_DB->select_query("call sp_tipoivainsert (" . $sql . ")");
        return $result;
    }

    public function updateTipoiva($tipoiva) {
        $sql="";
        $sql = $sql . "'" . $tipoiva->get_id_tipoiva() . "',";
        $sql = $sql . "'" . $tipoiva->get_nom_tipoiva() . "',";
        $sql = $sql . "'" . $tiporetencion->get_porcentaje_iva() . "'";
        $result = $this->_DB->alteration_query("call sp_tiporetencionupdate (" . $sql . ")");
        return $result;
    }

    public function deleteTiporetencion($id_tipoiva) {
        $sql = "DELETE FROM tipoiva WHERE id_tipoiva='" . $id_tipoiva . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showTipoIva($id_tipoiva) {
        $tipoiva = new tipoiva();
        $sql = "SELECT * FROM tipoiva WHERE id_tipoiva=" . $id_tipoiva;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $tipoiva->set_id_tipoiva($row['id_tiporeten']);
            $tipoiva->set_nom_tipoiva($row['nom_tipoiva']);
            $tipoiva->set_porcentaje_iva($row['porcentaje_iva']);
        }

        return $tipoiva;
    }

    public function listTipoiva($descripcion) {
        $data = array();
        $sql = "SELECT * FROM tipoiva WHERE nom_tipoiva like '".$descripcion."%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $tipoiva = new tiporetencion();
            $tipoiva->set_id_tipoiva($row['id_tipoiva']);
            $tipoiva->set_nom_tipoiva($row['nom_tipoiva']);
            $tipoiva->set_porcentaje_iva($row['porcentaje_iva']);
            $data[] = $tipoiva;
        }
        return $data;
    }
    /**
     *ComboTipoIva
     * @return tipoiva 
     */
    public function ComboTipoIva(){
        $data = array();
        $sql = "SELECT * FROM tipoiva";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $tipoiva = new tipoiva();
            $tipoiva->set_id_tipoiva($row['id_tipoiva']);
            $tipoiva->set_nom_tipoiva($row['nom_tipoiva']);
            $tipoiva->set_porcentaje_iva($row['porcentaje_iva']);
            $data[] = $tipoiva;
        }
        return $data;
    }
    
     public function puedeEliminar($id_tipoiva){
        $sql="SELECT (COUNT(id_tipoiva)+1) AS total FROM producto WHERE  id_tipoiva=".$id_tipoiva;
         $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
    }

}


