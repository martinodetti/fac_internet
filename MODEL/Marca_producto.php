<?php

class marca_producto {

    public $_DB;
    public $_id_marca;
    public $_nom_marca;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function marca_producto($id_marca, $nom_marca) {

        $this->_id_marca = $id_marca;

        $this->_nom_marca = $nom_marca;
    }

    public function get_id_marca() {
        return $this->_id_marca;
    }

    public function set_id_marca($id_marca) {

        $this->_id_marca = $id_marca;
    }

    public function get_nom_marca() {

        return $this->_nom_marca;
    }

    public function set_nom_marca($nom_marca) {

        $this->_nom_marca = $nom_marca;
    }

    public function addMarca_producto($marca_producto) {
        $sql="";
        $sql = $sql . "'" . $marca_producto->get_nom_marca() . "'";
        $result = $this->_DB->select_query("call sp_marca_productoinsert (" . $sql . ")");
        return $result;
    }

    public function updateMarca_producto($marca_producto) {
        $sql="";
        $sql = $sql . "'" . $marca_producto->get_id_marca() . "',";
        $sql = $sql . "'" . $marca_producto->get_nom_marca() . "'";
        $result = $this->_DB->alteration_query("call sp_marca_productoupdate (" . $sql . ")");
        return $result;
    }

    public function deleteMarca_producto($id_marca) {
        $sql = "DELETE FROM marca_producto WHERE id_marca='" . $id_marca . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }
    
    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showMarca_producto($nom_marca) {

        $marca_producto = new marca_producto();
        $sql = "SELECT * FROM marca_producto WHERE id_marca=" . $id_marca;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $marca_producto->set_id_marca($row['id_marca']);
            $marca_producto->set_nom_marca($row['nom_marca']);
        }

        return $marca_producto;
    }

    public function listMarca_productos($marca) {
        $data = array();
        $sql = "SELECT * FROM marca_producto WHERE nom_marca like '".$marca."%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $marca_producto = new marca_producto();
            $marca_producto->set_id_marca($row['id_marca']);
            $marca_producto->set_nom_marca($row['nom_marca']);
            $data[] = $marca_producto;
        }

        return $data;
    }
    /**
     *Combo con marca producto
     * @return marca_producto 
     */
    public function ComboMarca() {
        $data = array();
        $sql = "SELECT * FROM marca_producto";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $marca_producto = new marca_producto();
            $marca_producto->set_id_marca($row['id_marca']);
            $marca_producto->set_nom_marca($row['nom_marca']);
            $data[] = $marca_producto;
        }
        return $data;
    }
    /**
     *retorna 0 si se puede eliminar y >=1 si no se puede eliminar
     * @param type $id_marca
     * @return type 
     */
    public function puedeEliminar($id_marca){
        $sql="SELECT (COUNT(id_marca)+1) AS total FROM producto WHERE  id_marca=".$id_marca;
         $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
    }

}

