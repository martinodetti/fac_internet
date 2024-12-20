<?php

class detalle_orden {

    public $_DB;
    public $_id_detord;
    public $_id_orden;
    public $_id_producto;
	public $_nom_producto;
	public $_descrip_producto;
    public $_canti_detorden;
    public $_precio_detorden;
    public $_estado_detorden;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_orden($id_detord, $id_orden, $id_producto, $canti_detorden, $precio_detorden, $estado_detorden) {

        $this->_id_detord 			= $id_detord;
        $this->_id_orden 			= $id_orden;
        $this->_id_producto 		= $id_producto;
        $this->_canti_detorden 		= $canti_detorden;
        $this->_precio_detorden		= $precio_detorden;
        $this->_estado_detorden 	= $estado_detorden;
    }

    public function get_id_detord() {
        return $this->_id_detord;
    }

    public function set_id_detord($id_detord) {

        $this->_id_detord = $id_detord;
    }

    public function get_id_orden() {

        return $this->_id_orden;
    }

    public function set_id_orden($id_orden) {

        $this->_id_orden = $id_orden;
    }

    public function get_id_producto() {

        return $this->_id_producto;
    }

    public function set_id_producto($id_producto) {

        $this->_id_producto = $id_producto;
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

    public function get_canti_detorden() {

        return $this->_canti_detorden;
    }

    public function set_canti_detorden($canti_detorden) {

        $this->_canti_detorden = $canti_detorden;
    }

    public function get_precio_detorden() {

        return $this->_precio_detorden;
    }

    public function set_precio_detorden($precio_detorden) {

        $this->_precio_detorden = $precio_detorden;
    }

    public function get_estado_detorden() {

        return $this->_estado_detorden;
    }

    public function set_estado_detorden($estado_detorden) {

        $this->_estado_detorden = $estado_detorden;
    }

    public function addDetalle_orden($detalle_orden) {
        $sql="";
        $sql = $sql . "'" . $detalle_orden->get_id_orden() . "',";
        $sql = $sql . "'" . $detalle_orden->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_orden->get_canti_detorden() . "',";
        $sql = $sql . "'" . $detalle_orden->get_precio_detorden() . "',";
        $sql = $sql . "'" . $detalle_orden->get_estado_detorden() . "'";
   
        $result = $this->_DB->select_query("call sp_detalle_ordeninsert (" . $sql . ")");
        return $result;
    }

    public function updateDetalle_orden($detalle_orden) {
        $sql="";
        $sql = $sql . "'" . $detalle_orden->get_id_detfact() . "',";
        $sql = $sql . "'" . $detalle_orden->get_id_fact() . "',";
        $sql = $sql . "'" . $detalle_orden->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_orden->get_canti_detorden() . "',";
        $sql = $sql . "'" . $detalle_orden->get_precio_detorden() . "',";
        $sql = $sql . "'" . $detalle_orden->get_estado_detorden() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_ordenupdate (" . $sql . ")");
        return $result;
    }

    public function deleteDetalle_orden($id_orden) {

        $sql = "DELETE FROM detalle_ordenreparacion WHERE id_orden='" . $id_orden . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_orden_Idorden($id_orden) {

        $detalle_orden = new detalle_orden();
        $sql = "SELECT * FROM detalle_ordenreparacion WHERE id_orden=" .$id_orden;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $detalle_ordento->set_id_detord(		$row['id_detord']		);
            $detalle_ordento->set_id_orden(			$row['id_orden']		);
            $detalle_ordento->set_id_producto(		$row['id_producto']		);
            $detalle_ordento->set_canti_detorden(	$row['canti_detord']	);
            $detalle_ordento->set_precio_detorden(	$row['precio_detord']	);
            $detalle_ordento->set_estado_detorden(	$row['estado_detord']	);
        }
        return $detalle_orden;
    }
	
	public function showDetalle_orden_vista($id_orden) {
        $detalle_orden = new detalle_orden();
		$detalle = array();
		$sql = "SELECT * FROM v_orden_reparacion_detalle WHERE id_orden = " . $id_orden;
		
		$existen_2_mo = 0;
		
		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			//esto lo hago para identificar la segunda mano de obra
			if($existen_2_mo == 1 && $row['id_producto'] == '0')
				$row['id_producto'] = '-2';
		
			$detalle_orden = new detalle_orden();
            $detalle_orden->set_id_orden		(	$row['id_orden']		);
			$detalle_orden->set_id_producto		(	$row['id_producto']		);
            $detalle_orden->set_descrip_producto(	$row['descrip_producto']);
            $detalle_orden->set_nom_producto	(	$row['nom_producto']	);
            $detalle_orden->set_canti_detorden	(	$row['canti_detord']	);
            $detalle_orden->set_precio_detorden	(	$row['precio_detord']	);
			$detalle[] = $detalle_orden;
			
			//para identificar la segunda mano de obra
			if($row['id_producto'] == '0')
				$existen_2_mo = 1;
		}
		return $detalle;
	}
	
	public function showDetalle_orden_vista_edit($id_orden) {
        $detalle_orden = new detalle_orden();
		$detalle = array();
		$sql = "SELECT * FROM v_orden_reparacion_detalle WHERE id_orden = " . $id_orden;
		
		$existen_2_mo = 0;
		
		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			//esto lo hago para identificar la segunda mano de obra
			if($existen_2_mo == 1 && $row['id_producto'] == '0')
				$row['id_producto'] = '-2';

			$detalle_orden = new detalle_orden();
            $detalle_orden->set_id_orden		(	$row['id_orden']		);
			$detalle_orden->set_id_producto		(	$row['id_producto']		);
            $detalle_orden->set_descrip_producto(	$row['descrip_producto']);
            $detalle_orden->set_nom_producto	(	$row['nom_producto']	);
            $detalle_orden->set_canti_detorden	(	$row['canti_detord']	);
            $detalle_orden->set_precio_detorden	(	$row['pvp1_producto']	);
			$detalle[] = $detalle_orden;
			
			
			//para identificar la segunda mano de obra
			if($row['id_producto'] == '0')
				$existen_2_mo = 1;
		}
		return $detalle;
	}
}
?>
