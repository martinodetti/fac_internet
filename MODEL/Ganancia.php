<?php

class ganancia {

    public $_DB;
    public $_id_ganancia;
    public $_porctj_ganancia;
    public $_descrip_ganancia;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function ganancia($id_ganancia, $porctj_ganancia, $descrip_ganancia) {

        $this->_id_ganancia = $id_ganancia;

        $this->_porctj_ganancia = $porctj_ganancia;

        $this->_descrip_ganancia = $descrip_ganancia;
    }

    public function get_id_ganancia() {
        return $this->_id_ganancia;
    }

    public function set_id_ganancia($id_ganancia) {

        $this->_id_ganancia = $id_ganancia;
    }

    public function get_porctj_ganancia() {

        return $this->_porctj_ganancia;
    }

    public function set_porctj_ganancia($porctj_ganancia) {

        $this->_porctj_ganancia = $porctj_ganancia;
    }

    public function get_descrip_ganancia() {

        return $this->_descrip_ganancia;
    }

    public function set_descrip_ganancia($descrip_ganancia) {

        $this->_descrip_ganancia = $descrip_ganancia;
    }

    public function addGanancia($ganancia) {
        $sql="";
        $sql = $sql . "'" . $ganancia->get_porctj_ganancia() . "',";
        $sql = $sql . "'" . $ganancia->get_descrip_ganancia() . "'";
        $result = $this->_DB->select_query("call sp_gananciainsert (" . $sql . ")");
        return $result;
    }

    public function updateGanancia($ganancia) {
        $sql="";
        $sql = $sql . "'" . $ganancia->get_id_ganancia() . "',";
        $sql = $sql . "'" . $ganancia->get_porctj_ganancia() . "',";
        $sql = $sql . "'" . $ganancia->get_descrip_ganancia() . "'";
        $result = $this->_DB->alteration_query("call sp_gananciaupdate (" . $sql . ")");
        return $result;
    }

    public function deleteGanancia($id_ganancia) {
        $sql = "DELETE FROM ganancia WHERE id_ganancia='" . $id_ganancia . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showGanancia($porctj_ganancia) {
        $ganancia = new ganancia();
        $sql = "SELECT * FROM ganancia WHERE id_ganancia=" . $id_ganancia;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $ganancia->set_id_ganancia($row['id_ganancia']);
            $ganancia->set_porctj_ganancia($row['porctj_ganancia']);
            $ganancia->set_descrip_ganancia($row['descrip_ganancia']);
        }

        return $ganancia;
    }

    public function listGananciasPorPorcentaje($porcentaje) {
        $data = array();
        $sql = "SELECT * FROM ganancia WHERE porctj_ganancia>=".$porcentaje;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $ganancia = new ganancia();
            $ganancia->set_id_ganancia($row['id_ganancia']);
            $ganancia->set_porctj_ganancia($row['porctj_ganancia']);
            $ganancia->set_descrip_ganancia($row['descrip_ganancia']);
            $data[] = $ganancia;
        }
        return $data;
    }
    
    /**
     *CmboGANANCIA
     * @return ganancia 
     */
    public function ComboGanancia() {
        $data = array();
        $sql = "SELECT * FROM ganancia";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $ganancia = new ganancia();
            $ganancia->set_id_ganancia($row['id_ganancia']);
            $ganancia->set_porctj_ganancia($row['porctj_ganancia']);
            $ganancia->set_descrip_ganancia($row['descrip_ganancia']);
            $data[] = $ganancia;
        }
        return $data;
    }
    
     public function puedeEliminar($id_ganacia){
        $sql="SELECT (COUNT(id_ganancia)+1) AS total FROM producto WHERE  id_ganancia=".$id_ganacia;
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
