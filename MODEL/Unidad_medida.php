<?php

class unidad_medida {

    public $_DB;
    public $_id_unimedida;
    public $_nom_unimedida;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function unidad_medida($id_unimedida, $nom_unimedida) {

        $this->_id_unimedida = $id_unimedida;

        $this->_nom_unimedida = $nom_unimedida;
    }

    public function get_id_unimedida() {

        return $this->_id_unimedida;
    }

    public function set_id_unimedida($id_unimedida) {

        $this->_id_unimedida = $id_unimedida;
    }

    public function get_nom_unimedida() {
        return $this->_nom_unimedida;
    }

    public function set_nom_unimedida($nom_unimedida) {
        $this->_nom_unimedida = $nom_unimedida;
    }

    public function addUnidad_medida($unidad_medida) {
        $sql="INSERT INTO unidad_medida values (0,";
        $sql = $sql . "'" . $unidad_medida->get_nom_unimedida() . "')";
 
        $result = $this->_DB->select_query($sql);       
//        $result = $this->_DB->select_query("call sp_unidad_medidainsert (" . $sql . ")");
        return $result;
    }

    public function updateUnidad_medida($unidad_medida) {
        $sql="";
        $sql = $sql . "'" . $unidad_medida->get_id_unimedida() . "',";
        $sql = $sql . "'" . $unidad_medida->get_nom_unimedida() . "'";
        $result = $this->_DB->alteration_query("call sp_unidad_medidaupdate (" . $sql . ")");
        return $result;
    }

    public function deleteUnidad_medida($id_unimedida) {
        $sql = "DELETE FROM unidad_medida WHERE id_unimedida='" . $id_unimedida . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

   
   
    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showUnidad_medida($nom_unimedida) {

        $unidad_medida = new unidad_medida();
        $sql = "SELECT * FROM unidad_medida WHERE id_unimedida=" . $id_unimedida;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $unidad_medida->set_id_unimedida($row['id_unimedida']);
            $unidad_medida->set_nom_unimedida($row['nom_unimedida']);
        }

        return $unidad_medida;
    }

    public function listUnidad_medidasPorNombre($medida) {

        $data = array();
        $sql = "SELECT * FROM unidad_medida WHERE nom_unimedida like '".$medida."%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $unidad_medida = new unidad_medida();
            $unidad_medida->set_id_unimedida($row['id_unimedida']);
            $unidad_medida->set_nom_unimedida($row['nom_unimedida']);
            $data[] = $unidad_medida;
        }

        return $data;
    }
    
    /**
     *Combo UnidadMEDIDA
     * @return unidad_medida 
     */
    public function ComboUnidadMedida() {
        $data = array();
        $sql = "SELECT * FROM unidad_medida";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $unidad_medida = new unidad_medida();
            $unidad_medida->set_id_unimedida($row['id_unimedida']);
            $unidad_medida->set_nom_unimedida($row['nom_unimedida']);
            $data[] = $unidad_medida;
        }

        return $data;
    }
    
    public function puedeEliminar($id_unidad){
        $sql="SELECT (COUNT(id_unimedida)+1) AS total FROM producto WHERE  id_unimedida=".$id_unidad;
         $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
    }

}

