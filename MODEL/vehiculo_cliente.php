<?php

class vehiculo_cliente {

    public $_DB;
    public $_id_vehi_cli;
    public $_id_vehiculo;
    public $_id_cliente;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function vehiculo_cliente($id_vehi_cli, $id_vehiculo, $id_cliente) {

        $this->_id_vehi_cli 	= $id_vehi_cli;
        $this->_id_vehiculo 	= $id_vehiculo;
        $this->_id_cliente 	= $id_cliente;
    }
    public function get_id_vehi_cli() {

        return $this->_id_vehi_cli;
    }

    public function set_id_vehi_cli($id_vehi_cli) {

        $this->_id_vehi_cli = $id_vehi_cli;
    }

    public function get_id_vehiculo() {

        return $this->_id_vehiculo;
    }

    public function set_id_vehiculo($id_vehiculo) {

        $this->_id_vehiculo = $id_vehiculo;
    }

    public function get_id_cliente() {

        return $this->_id_cliente;
    }

    public function set_id_cliente($id_cliente) {

        $this->_id_cliente = $id_cliente;
    }

    public function addVehiculo_cliente($vehiculo_cliente) {
        $sql="";
        $sql = $sql . "'" . $vehiculo_cliente->get_id_vehiculo() . "',";
        $sql = $sql . "'" . $vehiculo_cliente->get_id_cliente() . "'";
        $result = $this->_DB->select_query("call sp_vehiculo_clienteinsert (" . $sql . ")");
        return $result;
    }

    public function updateVehiculo_cliente($vehiculo_cliente) {
        $sql="";
        $sql = $sql . "'" . $vehiculo_cliente->get_id_vehi_cli() . "',";
        $sql = $sql . "'" . $vehiculo_cliente->get_id_vehiculo() . "',";
        $sql = $sql . "'" . $vehiculo_cliente->get_id_cliente() . "'";
        $result = $this->_DB->alteration_query("call sp_vehiculo_clienteupdate (" . $sql . ")");
        return $result;
    }

    public function deleteVehiculo_cliente($id_vehi_cli) {

        $sql = "DELETE FROM vehiculo_cliente WHERE id_vehi_chi='" . $id_vehi_cli . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }
    public function deleteVehiculo_clientePorVehiculo($id_vehi) {
        $sql = "DELETE FROM vehiculo_cliente WHERE id_vehiculo=".$id_vehi;
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }


    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showVehiculo_cliente($id_vehi_cli) {

        $vehiculo_cliente = new vehiculo_cliente();
        $sql = "SELECT * FROM vehiculo_cliente WHERE id_vehi_cli =" . $id_vehi_cli;
        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {
            $vehiculo_cliente->set_id_vehi_cli(	$row['id_vehi_cli']);
            $vehiculo_cliente->set_id_vehiculo(	$row['id_vehiculo']);
            $vehiculo_cliente->set_id_cliente(	$row['id_cliente']);
        }

        return $vehiculo_cliente;
    }

    public function listVehiculo_clientePorCliente($id_cliente) {
        $data = array();
        $sql = "SELECT * FROM vehiculo_cliente WHERE id_cliente=".$id_cliente;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $vehiculo_cliente = new vehiculo_cliente();
            $vehiculo_cliente->set_id_vehi_cli(	$row['id_vehi_cli']);
            $vehiculo_cliente->set_id_vehiculo(	$row['id_vehiculo']);
            $vehiculo_cliente->set_id_cliente(	$row['id_cliente']);
            $data[] = $vehiculo_cliente;
        }
        return $data;
    }
    
     public function CargarJsonVehi_cli_Idvehi($IdVehi){
        $data = array();
        $sql = "SELECT *  FROM v_vehiculo_cliente WHERE estado_persona='1' AND id_vehiculo=".$IdVehi;
        $result = $this->_DB->select_query($sql);
         foreach ($result as $row) {
            $data[] = array("id" => $row["id_cliente"],"nombre"=>$row["nom_persona"]);	
        }

        $jsonData=json_encode($data);
        return $jsonData; 
    }

}

?>
