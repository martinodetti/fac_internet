<?php

class listaprecio {

    public $_DB;
    public $_id_listaprecio;
    public $_nombre_listaprecio;
    public $_porcentaje_listaprecio;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function listaprecio($id_listaprecio, $porcentaje_listaprecio, $nombre_listaprecio) {

        $this->_id_listaprecio = $id_listaprecio;

        $this->_porcentaje_listaprecio = $porcentaje_listaprecio;

        $this->_nombre_listaprecio = $nombre_listaprecio;
    }

    public function get_id_listaprecio() {
        return $this->_id_listaprecio;
    }

    public function set_id_listaprecio($id_listaprecio) {

        $this->_id_listaprecio = $id_listaprecio;
    }

    public function get_porcentaje_listaprecio() {

        return $this->_porcentaje_listaprecio;
    }

    public function set_porcentaje_listaprecio($porcentaje_listaprecio) {

        $this->_porcentaje_listaprecio = $porcentaje_listaprecio;
    }

    public function get_nombre_listaprecio() {

        return $this->_nombre_listaprecio;
    }

    public function set_nombre_listaprecio($nombre_listaprecio) {

        $this->_nombre_listaprecio = $nombre_listaprecio;
    }

    public function addlistaprecio($listaprecio) {
        $sql="";
        $sql = $sql . "'" . $listaprecio->get_porcentaje_listaprecio() . "',";
        $sql = $sql . "'" . $listaprecio->get_nombre_listaprecio() . "'";
        $result = $this->_DB->select_query("call sp_listaprecioinsert (" . $sql . ")");
        return $result;
    }

    public function updatelistaprecio($listaprecio) {
        $sql="";
        $sql = $sql . "'" . $listaprecio->get_id_listaprecio() . "',";
        $sql = $sql . "'" . $listaprecio->get_porcentaje_listaprecio() . "',";
        $sql = $sql . "'" . $listaprecio->get_nombre_listaprecio() . "'";
        $result = $this->_DB->alteration_query("call sp_listaprecioupdate (" . $sql . ")");
        return $result;
    }

    public function deletelistaprecio($id_listaprecio) {
        $sql = "DELETE FROM listaprecio WHERE id_listaprecio='" . $id_listaprecio . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showlistaprecio($porcentaje_listaprecio) {
        $listaprecio = new listaprecio();
        $sql = "SELECT * FROM listaprecio WHERE id_listaprecio=" . $id_listaprecio;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $listaprecio->set_id_listaprecio($row['id_listaprecio']);
            $listaprecio->set_porcentaje_listaprecio($row['porcentaje_listaprecio']);
            $listaprecio->set_nombre_listaprecio($row['nombre_listaprecio']);
        }

        return $listaprecio;
    }

    public function listlistapreciosPorPorcentaje($porcentaje) {
        $data = array();
        $sql = "SELECT * FROM listaprecio WHERE nombre_listaprecio like '%" .$porcentaje . "%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $listaprecio = new listaprecio();
            $listaprecio->set_id_listaprecio($row['id_listaprecio']);
            $listaprecio->set_porcentaje_listaprecio($row['porcentaje_listaprecio']);
            $listaprecio->set_nombre_listaprecio($row['nombre_listaprecio']);
            $data[] = $listaprecio;
        }
        return $data;
    }
    
    /**
     *Cmbolistaprecio
     * @return listaprecio 
     */
    public function Combolistaprecio() {
        $data = array();
        $sql = "SELECT * FROM listaprecio";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $listaprecio = new listaprecio();
            $listaprecio->set_id_listaprecio($row['id_listaprecio']);
            $listaprecio->set_porcentaje_listaprecio($row['porcentaje_listaprecio']);
            $listaprecio->set_nombre_listaprecio($row['nombre_listaprecio']);
            $data[] = $listaprecio;
        }
        return $data;
    }
    
     public function puedeEliminar($id_listaprecio){
        $sql="SELECT (COUNT(id_listaprecio)+1) AS total FROM persona WHERE  id_listaprecio=".$id_listaprecio;
         $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
    }

}
?>
