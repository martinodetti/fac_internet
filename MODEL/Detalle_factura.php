<?php

class detalle_factura {

    public $_DB;
    public $_id_detfact;
    public $_id_fact;
    public $_id_producto;
    public $_canti_detfact;
    public $_nom_producto;
    public $_precio_detfact;
    public $_estado_detfact;
    public $_descrip_producto;
    public $_id_tipoiva;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_factura($id_detfact, $id_fact, $id_producto, $canti_detfact, $precio_detfact, $estado_detfact) {

        $this->_id_detfact = $id_detfact;

        $this->_id_fact = $id_fact;

        $this->_id_producto = $id_producto;

        $this->_canti_detfact = $canti_detfact;

        $this->_precio_detfact = $precio_detfact;

        $this->_estado_detfact = $estado_detfact;
    }

    public function get_id_detfact() {
        return $this->_id_detfact;
    }

    public function set_id_detfact($id_detfact) {

        $this->_id_detfact = $id_detfact;
    }

    public function get_id_fact() {

        return $this->_id_fact;
    }

    public function set_id_fact($id_fact) {

        $this->_id_fact = $id_fact;
    }

    public function get_id_producto() {

        return $this->_id_producto;
    }

    public function set_id_producto($id_producto) {

        $this->_id_producto = $id_producto;
    }

    public function get_canti_detfact() {

        return $this->_canti_detfact;
    }

    public function set_canti_detfact($canti_detfact) {

        $this->_canti_detfact = $canti_detfact;
    }

    public function get_precio_detfact() {

        return $this->_precio_detfact;
    }

    public function set_precio_detfact($precio_detfact) {

        $this->_precio_detfact = $precio_detfact;
    }

    public function get_estado_detfact() {

        return $this->_estado_detfact;
    }

    public function set_estado_detfact($estado_detfact) {

        $this->_estado_detfact = $estado_detfact;
    }
    
    public function get_nom_producto() {

        return $this->_nom_producto;
    }

    public function set_nom_producto($nom_producto) {

        $this->_nom_producto = $nom_producto;
    }
    
    public function get_descrip_producto() {

        return $this->_descrip_producto;
    }

    public function set_descrip_producto($descrip_producto) {

        $this->_descrip_producto = $descrip_producto;
    }

    public function set_id_tipoiva($id_tipoiva){
        $this->_id_tipoiva = $id_tipoiva;
    }

    public function addDetalle_factura($detalle_factura) {
        $sql="";
        $sql = $sql . "'" . $detalle_factura->get_id_fact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_factura->get_canti_detfact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_precio_detfact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_estado_detfact() . "'";
        $result = $this->_DB->select_query("call sp_detalle_facturainsert (" . $sql . ")");
        return $result;
    }
    
    public function addDetalle_notacredito($detalle_factura){
        $sql="";
        $sql = $sql . "'" . $detalle_factura->get_id_fact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_factura->get_canti_detfact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_precio_detfact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_estado_detfact() . "'";
        $result = $this->_DB->select_query("call sp_detalle_notacreditoinsert (" . $sql . ")");
        return $result;    
    }

    public function updateDetalle_factura($detalle_factura) {
        $sql="";
        $sql = $sql . "'" . $detalle_factura->get_id_detfact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_id_fact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_factura->get_canti_detfact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_precio_detfact() . "',";
        $sql = $sql . "'" . $detalle_factura->get_estado_detfact() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_facturaupdate (" . $sql . ")");
        return $result;
    }

    public function deleteDetalle_factura($id_detfact) {

        $sql = "DELETE FROM detalle_factura WHERE id_detfact='" . $id_detfact . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_facturaIdFactura($id_fact) {

        $detalle_factura = new detalle_factura();
        $sql = "SELECT * FROM detalle_factura WHERE id_fact=" .$id_fact;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $detalle_factura->set_id_detfact($row['id_detfact']);
            $detalle_factura->set_id_fact($row['id_fact']);
            $detalle_factura->set_id_producto($row['id_producto']);
            $detalle_factura->set_canti_detfact($row['canti_detfact']);
            $detalle_factura->set_precio_detfact($row['precio_detfact']);
            $detalle_factura->set_estado_detfact($row['estado_detfact']);
        }
        return $detalle_factura;
    }
    
    public function showDetalle_factura_vista($id_fact) {
        $detalle_factura = new detalle_factura();
		$detalle = array();
		$sql = "SELECT f.*, p.id_tipoiva
                FROM v_factura_detalle f 
                JOIN producto p on p.id_producto = f.id_producto  
                WHERE id_fact = " . $id_fact;
		
		$existen_2_mo = 0;
		
		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			//esto lo hago para identificar la segunda mano de obra
			if($existen_2_mo == 1 && $row['id_producto'] == '0')
				$row['id_producto'] = '-2';
		
			$detalle_fact = new detalle_factura();
            $detalle_fact->set_id_fact(			$row['id_fact']			);
			$detalle_fact->set_id_producto(		$row['id_producto']		);
            $detalle_fact->set_descrip_producto($row['descrip_producto']);
            $detalle_fact->set_canti_detfact(	$row['canti_detfact']	);
            $detalle_fact->set_precio_detfact(	$row['precio_detfact']	);
            $detalle_fact->set_nom_producto(	$row['nom_producto']	);
            $detalle_fact->set_id_tipoiva(      $row['id_tipoiva']      );
			$detalle[] = $detalle_fact;
			
			//para identificar la segunda mano de obra
			if($row['id_producto'] == '0')
				$existen_2_mo = 1;

		}
		return $detalle;
	}

	public function showDetalle_factura_vista_edit($id_fact) {
        $detalle_factura = new detalle_factura();
		$detalle = array();
		$sql = "SELECT * FROM v_factura_detalle WHERE id_fact = " . $id_fact;
		
		$existen_2_mo = 0;
		
		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			//esto lo hago para identificar la segunda mano de obra
			if($existen_2_mo == 1 && $row['id_producto'] == '0')
				$row['id_producto'] = '-2';

			$detalle_fact = new detalle_factura();
            $detalle_fact->set_id_fact(			$row['id_fact']			);
			$detalle_fact->set_id_producto(		$row['id_producto']		);
            $detalle_fact->set_descrip_producto($row['descrip_producto']);
            $detalle_fact->set_canti_detfact(	$row['canti_detfact']	);
            $detalle_fact->set_precio_detfact(	$row['pvp1_producto']	);
            $detalle_fact->set_nom_producto(	$row['nom_producto']	);
			$detalle[] = $detalle_fact;
			
			//para identificar la segunda mano de obra
			if($row['id_producto'] == '0')
				$existen_2_mo = 1;

		}
		return $detalle;
	}
    

}

?>

