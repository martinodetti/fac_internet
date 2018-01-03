<?php

class detalle_presupuesto {

    public $_DB;
    public $_id_detpres;
    public $_id_presupuesto;
    public $_id_producto;
	public $_nom_producto;
	public $_descrip_producto;
    public $_canti_detpresupuesto;
    public $_precio_detpresupuesto;
    public $_estado_detpresupuesto;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_presupuesto($id_detord, $id_presupuesto, $id_producto, $canti_detpresupuesto, $precio_detpresupuesto, $estado_detpresupuesto) {

        $this->_id_detord 				= $id_detord;
        $this->_id_presupuesto 			= $id_presupuesto;
        $this->_id_producto 			= $id_producto;
        $this->_canti_detpresupuesto 	= $canti_detpresupuesto;
        $this->_precio_detpresupuesto	= $precio_detpresupuesto;
        $this->_estado_detpresupuesto 	= $estado_detpresupuesto;
    }

    public function get_id_detord() {
        return $this->_id_detord;
    }

    public function set_id_detord($id_detord) {

        $this->_id_detord = $id_detord;
    }

    public function get_id_presupuesto() {

        return $this->_id_presupuesto;
    }

    public function set_id_presupuesto($id_presupuesto) {

        $this->_id_presupuesto = $id_presupuesto;
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

    public function get_canti_detpresupuesto() {

        return $this->_canti_detpresupuesto;
    }

    public function set_canti_detpresupuesto($canti_detpresupuesto) {

        $this->_canti_detpresupuesto = $canti_detpresupuesto;
    }

    public function get_precio_detpresupuesto() {

        return $this->_precio_detpresupuesto;
    }

    public function set_precio_detpresupuesto($precio_detpresupuesto) {

        $this->_precio_detpresupuesto = $precio_detpresupuesto;
    }

    public function get_estado_detpresupuesto() {

        return $this->_estado_detpresupuesto;
    }

    public function set_estado_detpresupuesto($estado_detpresupuesto) {

        $this->_estado_detpresupuesto = $estado_detpresupuesto;
    }

    public function addDetalle_presupuesto($detalle_presupuesto) {
        $sql="";
        $sql = $sql . "'" . $detalle_presupuesto->get_id_presupuesto() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_canti_detpresupuesto() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_precio_detpresupuesto() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_estado_detpresupuesto() . "'";
   
        $result = $this->_DB->select_query("call sp_detalle_presupuestoinsert (" . $sql . ")");
        return $result;
    }

    public function updateDetalle_presupuesto($detalle_presupuesto) {
        $sql="";
        $sql = $sql . "'" . $detalle_presupuesto->get_id_detfact() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_id_fact() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_canti_detpresupuesto() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_precio_detpresupuesto() . "',";
        $sql = $sql . "'" . $detalle_presupuesto->get_estado_detpresupuesto() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_presupuestoupdate (" . $sql . ")");
        return $result;
    }
    
    public function descontarStock($detalle_presupuesto)
    {
    	$sql = "UPDATE producto SET ";
    	$sql = $sql . "stock_producto = stock_producto - " . $detalle_presupuesto->get_canti_detpresupuesto() . " ";
    	$sql = $sql . "WHERE id_producto = " . $detalle_presupuesto->get_id_producto();
 	
    	$result = $this->_DB->alteration_query($sql);
    }

    public function deleteDetalle_presupuesto($id_presupuesto) {

        $sql = "DELETE FROM detalle_presupuesto WHERE id_presupuesto='" . $id_presupuesto . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_presupuesto_Idpresupuesto($id_presupuesto) {

        $detalle_presupuesto = new detalle_presupuesto();
        $sql = "SELECT * FROM detalle_presupuesto WHERE id_presupuesto=" .$id_presupuesto;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $detalle_presupuestoto->set_id_detord(				$row['id_detord']		);
            $detalle_presupuestoto->set_id_presupuesto(			$row['id_presupuesto']	);
            $detalle_presupuestoto->set_id_producto(			$row['id_producto']		);
            $detalle_presupuestoto->set_canti_detpresupuesto(	$row['canti_detpresu']	);
            $detalle_presupuestoto->set_precio_detpresupuesto(	$row['precio_detpresu']	);
            $detalle_presupuestoto->set_estado_detpresupuesto(	$row['estado_detpresu']	);
        }
        return $detalle_presupuesto;
    }
	
	public function showDetalle_presupuesto_vista($id_presupuesto) {
        $detalle_presupuesto = new detalle_presupuesto();
		$detalle = array();
		$sql = "SELECT * FROM v_presupuesto_detalle WHERE id_presupuesto = " . $id_presupuesto;
		
		$existen_2_mo = 0;

		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			//esto lo hago para identificar la segunda mano de obra
			if($existen_2_mo == 1 && $row['id_producto'] == '0')
				$row['id_producto'] = '-2';

			$detalle_presupuesto = new detalle_presupuesto();
            $detalle_presupuesto->set_id_presupuesto		(	$row['id_presupuesto']	);
			$detalle_presupuesto->set_id_producto			(	$row['id_producto']		);
            $detalle_presupuesto->set_descrip_producto		(	$row['descrip_producto']);
            $detalle_presupuesto->set_nom_producto			(	$row['nom_producto']	);
            $detalle_presupuesto->set_canti_detpresupuesto	(	$row['canti_detpresu']	);
            $detalle_presupuesto->set_precio_detpresupuesto	(	$row['precio_detpresu']	);
			$detalle[] = $detalle_presupuesto;
			
			//para identificar la segunda mano de obra
			if($row['id_producto'] == '0')
				$existen_2_mo = 1;
		}
		return $detalle;
	}
	
	public function showDetalle_presupuesto_vista_edit($id_presupuesto) {
        $detalle_presupuesto = new detalle_presupuesto();
		$detalle = array();
		$sql = "SELECT * FROM v_presupuesto_detalle WHERE id_presupuesto = " . $id_presupuesto;
		
		$existen_2_mo = 0;

		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			//esto lo hago para identificar la segunda mano de obra
			if($existen_2_mo == 1 && $row['id_producto'] == '0')
				$row['id_producto'] = '-2';
		
			$detalle_presupuesto = new detalle_presupuesto();
            $detalle_presupuesto->set_id_presupuesto		(	$row['id_presupuesto']	);
			$detalle_presupuesto->set_id_producto			(	$row['id_producto']		);
            $detalle_presupuesto->set_descrip_producto		(	$row['descrip_producto']);
            $detalle_presupuesto->set_nom_producto			(	$row['nom_producto']	);
            $detalle_presupuesto->set_canti_detpresupuesto	(	$row['canti_detpresu']	);
            $detalle_presupuesto->set_precio_detpresupuesto	(	$row['pvp1_producto']	);
			$detalle[] = $detalle_presupuesto;
			
			//para identificar la segunda mano de obra
			if($row['id_producto'] == '0')
				$existen_2_mo = 1;
		}
		return $detalle;
	}
}
?>
