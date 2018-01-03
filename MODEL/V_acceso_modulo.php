<?php

class v_acceso_modulo {

    public $_DB;
    public $_id_persona;
    public $_id_modulo;
    public $_id_padre;
    public $_estado_persona;
    public $_nom_modulo;
    public $_img_modulo;
    public $_url_modulo;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function v_acceso_modulo($id_persona, $id_modulo, $id_padre, $estado_persona, $nom_modulo, $img_modulo, $url_modulo) {

        $this->_id_persona = $id_persona;

        $this->_id_modulo = $id_modulo;

        $this->_id_padre = $id_padre;

        $this->_estado_persona = $estado_persona;

        $this->_nom_modulo = $nom_modulo;

        $this->_img_modulo = $img_modulo;

        $this->_url_modulo = $url_modulo;
    }

    public function get_id_persona() {

        return $this->_id_persona;
    }

    public function set_id_persona($id_persona) {

        $this->_id_persona = $id_persona;
    }

    public function get_id_modulo() {

        return $this->_id_modulo;
    }

    public function set_id_modulo($id_modulo) {

        $this->_id_modulo = $id_modulo;
    }

    public function get_id_padre() {

        return $this->_id_padre;
    }

    public function set_id_padre($id_padre) {

        $this->_id_padre = $id_padre;
    }

    public function get_estado_persona() {

        return $this->_estado_persona;
    }

    public function set_estado_persona($estado_persona) {

        $this->_estado_persona = $estado_persona;
    }

    public function get_nom_modulo() {

        return $this->_nom_modulo;
    }

    public function set_nom_modulo($nom_modulo) {

        $this->_nom_modulo = $nom_modulo;
    }

    public function get_img_modulo() {

        return $this->_img_modulo;
    }

    public function set_img_modulo($img_modulo) {

        $this->_img_modulo = $img_modulo;
    }

    public function get_url_modulo() {

        return $this->_url_modulo;
    }

    public function set_url_modulo($url_modulo) {

        $this->_url_modulo = $url_modulo;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function existePersonaEnAcceso($id_persona) {
        $sql = "";
        $msg=0;
        $sql = "SELECT (COUNT(id_persona)+1) AS contador FROM acceso_modulo WHERE id_persona="+$id_persona;
        $result = $this->_DB->select_query($sql);
        if (count($result) >= 1) 
            $msg = 1;
       
        return $msg;
    }
    
    public function showV_acceso_modulo($id_modulo) {

        $v_acceso_modulo = new v_acceso_modulo();

        $sql = "SELECT * FROM v_acceso_modulo WHERE id_persona=" . $id_persona;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $v_acceso_modulo->set_id_persona($row['id_persona']);

            $v_acceso_modulo->set_id_modulo($row['id_modulo']);

            $v_acceso_modulo->set_id_padre($row['id_padre']);

            $v_acceso_modulo->set_estado_persona($row['estado_persona']);

            $v_acceso_modulo->set_nom_modulo($row['nom_modulo']);

            $v_acceso_modulo->set_img_modulo($row['img_modulo']);

            $v_acceso_modulo->set_url_modulo($row['url_modulo']);
        }

        return $v_acceso_modulo;
    }

    public function listV_acceso_modulos($id_persona) {
        $data = array();
        $sql = "SELECT * FROM v_acceso_modulo WHERE id_persona=".$id_persona." AND id_padre<=-1";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $v_acceso_modulo = new v_acceso_modulo();
            $v_acceso_modulo->set_id_persona($row['id_persona']);
            $v_acceso_modulo->set_id_modulo($row['id_modulo']);
            $v_acceso_modulo->set_id_padre($row['id_padre']);
            $v_acceso_modulo->set_estado_persona($row['estado_persona']);
            $v_acceso_modulo->set_nom_modulo($row['nom_modulo']);
            $v_acceso_modulo->set_img_modulo($row['img_modulo']);
            $v_acceso_modulo->set_url_modulo($row['url_modulo']);
            $v_acceso_modulo->nom_padre = $row['nom_padre'];
            $data[] = $v_acceso_modulo;
        }
        return $data;
    }
    
    /**
     *id_padre : se le envia el id_modulo para obtener sus hijos.
     * @param type $id_persona
     * @param type $id_padre 
     * @return v_acceso_modulo 
     */
    public function listV_modulos_hijos($id_persona,$id_padre){
         $data = array();
        $sql = "SELECT * FROM v_acceso_modulo WHERE id_persona=".$id_persona." AND id_padre=".$id_padre;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $v_acceso_modulo = new v_acceso_modulo();
            $v_acceso_modulo->set_id_persona($row['id_persona']);
            $v_acceso_modulo->set_id_modulo($row['id_modulo']);
            $v_acceso_modulo->set_id_padre($row['id_padre']);
            $v_acceso_modulo->set_estado_persona($row['estado_persona']);
            $v_acceso_modulo->set_nom_modulo($row['nom_modulo']);
            $v_acceso_modulo->set_img_modulo($row['img_modulo']);
            $v_acceso_modulo->set_url_modulo($row['url_modulo']);
            $data[] = $v_acceso_modulo;
        }
        return $data;
        
    }
    /**
     *Retorna un array de v_modulo
     * @return v_acceso_modulo 
     */
    public function comboModulo(){
     $data = array();
     $sql = "SELECT * FROM modulo WHERE id_padre<=-1";
     $result = $this->_DB->select_query($sql);
         foreach ($result as $row) {
              $v_acceso_modulo = new v_acceso_modulo(); 
              $v_acceso_modulo->set_id_modulo($row['id_modulo']);
              $v_acceso_modulo->set_nom_modulo($row['nom_modulo']);
              $data[] = $v_acceso_modulo;
         }
         return $data;
    }
   // 
    public function ModuloporIdPadreAndNom($idpadre){
     $data = array();
     $sql = "SELECT * FROM modulo WHERE id_padre=".$idpadre ;
     $result = $this->_DB->select_query($sql);
         foreach ($result as $row) {
              $v_acceso_modulo = new v_acceso_modulo(); 
              $v_acceso_modulo->set_id_modulo($row['id_modulo']);
              $v_acceso_modulo->set_nom_modulo($row['nom_modulo']);
              $data[] = $v_acceso_modulo;
         }
         return $data;
    }
    

}

?>
