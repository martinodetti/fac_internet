<?php

class producto_proveedor {

    public $_DB;
    public $_id_prod_provd;
    public $_id_producto;
    public $_id_proveedor;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function producto_proveedor($id_prod_provd, $id_producto, $id_proveedor) {

        $this->_id_prod_provd = $id_prod_provd;

        $this->_id_producto = $id_producto;

        $this->_id_proveedor = $id_proveedor;
    }
    public function get_id_prod_provd() {

        return $this->_id_prod_provd;
    }

    public function set_id_prod_provd($id_prod_provd) {

        $this->_id_prod_provd = $id_prod_provd;
    }

    public function get_id_producto() {

        return $this->_id_producto;
    }

    public function set_id_producto($id_producto) {

        $this->_id_producto = $id_producto;
    }

    public function get_id_proveedor() {

        return $this->_id_proveedor;
    }

    public function set_id_proveedor($id_proveedor) {

        $this->_id_proveedor = $id_proveedor;
    }

    public function addProducto_proveedor($producto_proveedor) {
        $sql="";
/*
        $sql = $sql . "'" . $producto_proveedor->get_id_producto() . "',";
        $sql = $sql . "'" . $producto_proveedor->get_id_proveedor() . "'";
        $result = $this->_DB->select_query("call sp_producto_proveedorinsert (" . $sql . ")");
*/
		$sql = "INSERT INTO producto_proveedor values (0,".$producto_proveedor->get_id_producto().", ".$producto_proveedor->get_id_proveedor().")";
        $result = $this->_DB->select_query($sql);
        return $result;
    }

    public function updateProducto_proveedor($producto_proveedor) {
        $sql="";
        $sql = $sql . "'" . $producto_proveedor->get_id_prod_provd() . "',";
        $sql = $sql . "'" . $producto_proveedor->get_id_producto() . "',";
        $sql = $sql . "'" . $producto_proveedor->get_id_proveedor() . "'";
        $result = $this->_DB->alteration_query("call sp_producto_proveedorupdate (" . $sql . ")");
        return $result;
    }

    public function deleteProducto_proveedor($id_prod_provd) {

        $sql = "DELETE FROM producto_proveedor WHERE id_prod_provd='" . $id_prod_provd . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }
    public function deleteProducto_proveedorIDProducto($id_prod) {
        $sql = "DELETE FROM producto_proveedor WHERE id_producto=".$id_prod;
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }


    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showProducto_proveedor($id_producto) {

        $producto_proveedor = new producto_proveedor();

        $sql = "SELECT * FROM producto_proveedor WHERE id_prod_provd=" . $id_prod_provd;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $producto_proveedor->set_id_prod_provd($row['id_prod_provd']);

            $producto_proveedor->set_id_producto($row['id_producto']);

            $producto_proveedor->set_id_proveedor($row['id_proveedor']);
        }

        return $producto_proveedor;
    }

    public function listProducto_proveedorsPorIdProducto($idProducto) {
        $data = array();
        $sql = "SELECT * FROM producto_proveedor WHERE id_producto=".$idProducto;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $producto_proveedor = new producto_proveedor();
            $producto_proveedor->set_id_prod_provd($row['id_prod_provd']);
            $producto_proveedor->set_id_producto($row['id_producto']);
            $producto_proveedor->set_id_proveedor($row['id_proveedor']);
            $data[] = $producto_proveedor;
        }
        return $data;
    }
    
     public function CargarJsonProd_Provd_IdpProd($IdProd){
        $data = array();
        $sql = "SELECT *  FROM v_producto_proveedor WHERE estado_persona='1' AND id_producto=".$IdProd;
        $result = $this->_DB->select_query($sql);
         foreach ($result as $row) {
            $data[] = array("id" => $row["id_proveedor"],"nombre"=>$row["nom_persona"]);	
        }

        $jsonData=json_encode($data);
        return $jsonData; 
    }

}

?>
