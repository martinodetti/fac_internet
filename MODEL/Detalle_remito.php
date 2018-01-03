<?php

class detalle_remito {

    public $_DB;
    public $_id_detremi;
    public $_id_remi;
    public $_id_producto;
	public $_nom_producto;
    public $_canti_detremi;
    public $_precio_detremi;
    public $_estado_detremi;
    public $_descrip_producto;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_remito($id_detremi, $id_remi, $id_producto, $canti_detremi, $precio_detremi, $estado_detremi) {

        $this->_id_detremi 		= $id_detremi;
        $this->_id_remi 			= $id_remi;
        $this->_id_producto 		= $id_producto;
        $this->_canti_detremi 	= $canti_detremi;
        $this->_precio_detremi	= $precio_detremi;
        $this->_estado_detremi 	= $estado_detremi;
    }

    public function get_id_detremi() {
        return $this->_id_detremi;
    }

    public function set_id_detremi($id_detremi) {

        $this->_id_detremi = $id_detremi;
    }

    public function get_id_remi() {

        return $this->_id_remi;
    }

    public function set_id_remi($id_remi) {

        $this->_id_remi = $id_remi;
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

    public function get_canti_detremi() {

        return $this->_canti_detremi;
    }

    public function set_canti_detremi($canti_detremi) {

        $this->_canti_detremi = $canti_detremi;
    }

    public function get_precio_detremi() {

        return $this->_precio_detremi;
    }

    public function set_precio_detremi($precio_detremi) {

        $this->_precio_detremi = $precio_detremi;
    }

    public function get_estado_detremi() {

        return $this->_estado_detremi;
    }

    public function set_estado_detremi($estado_detremi) {

        $this->_estado_detremi = $estado_detremi;
    }

    public function addDetalle_remito($detalle_remito) {
        $sql="";
        $sql = $sql . "'" . $detalle_remito->get_id_remi() . "',";
        $sql = $sql . "'" . $detalle_remito->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_remito->get_canti_detremi() . "',";
        $sql = $sql . "'" . $detalle_remito->get_precio_detremi() . "',";
        $sql = $sql . "'" . $detalle_remito->get_estado_detremi() . "'";

        $result = $this->_DB->select_query("call sp_detalle_remitoinsert (" . $sql . ")");
        return $result;
    }

    public function updateDetalle_remito($detalle_remito) {
        $sql="";
        $sql = $sql . "'" . $detalle_remito->get_id_detfact() . "',";
        $sql = $sql . "'" . $detalle_remito->get_id_fact() . "',";
        $sql = $sql . "'" . $detalle_remito->get_id_producto() . "',";
        $sql = $sql . "'" . $detalle_remito->get_canti_detremi() . "',";
        $sql = $sql . "'" . $detalle_remito->get_precio_detremit() . "',";
        $sql = $sql . "'" . $detalle_remito->get_estado_detremi() . "'";
        $result = $this->_DB->alteration_query("call sp_detalle_remitoupdate (" . $sql . ")");
        return $result;
    }

    public function deleteDetalle_remito($id_remi) {

        $sql = "DELETE FROM detalle_remito WHERE id_remito='" . $id_remi . "'";
        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_remitoIdRemito($id_remi) {

        $detalle_remito = new detalle_remito();
        $sql = "SELECT * FROM detalle_remito WHERE id_remito=" .$id_remi;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $detalle_remito->set_id_detremi($row['id_detremi']);
            $detalle_remito->set_id_remi($row['id_remi']);
            $detalle_remito->set_id_producto($row['id_producto']);
            $detalle_remito->set_canti_detremi($row['canti_detremi']);
            $detalle_remito->set_precio_detremi($row['precio_detremi']);
            $detalle_remito->set_estado_detremi($row['estado_detremi']);
        }
        return $detalle_remito;
    }
	
	public function showDetalle_remito_vista($id_remi) {
		$detalle = array();
		$detalle_remito = new detalle_remito();
		$sql = "SELECT 	dr.id_remito, dr.id_producto, p.nom_producto, dr.canti_detremi, dr.precio_detremi, p.descrip_producto
				FROM 	detalle_remito dr
				JOIN 	producto AS p USING(id_producto) 
				WHERE 	dr.id_remito = " . $id_remi;

		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			$detalle_remito = new detalle_remito();
            $detalle_remito->set_id_remi(			$row['id_remito']		);
			$detalle_remito->set_id_producto(		$row['id_producto']		);
            $detalle_remito->set_nom_producto(		$row['nom_producto']	);
            $detalle_remito->set_canti_detremi(		$row['canti_detremi']	);
            $detalle_remito->set_precio_detremi(	$row['precio_detremi']	);
            $detalle_remito->set_descrip_producto(	$row['descrip_producto']);
			$detalle[] = $detalle_remito;
		}
		return $detalle;
	}
	
	public function showDetalle_remito_vista_edit($id_remi) {
		$detalle = array();
		$detalle_remito = new detalle_remito();
		$sql = "SELECT 	dr.id_remito, dr.id_producto, p.nom_producto, dr.canti_detremi, p.pvp1_producto as precio_detremi, p.descrip_producto
				FROM 	detalle_remito dr
				JOIN 	producto AS p USING(id_producto) 
				WHERE 	dr.id_remito = " . $id_remi;

		$result = $this->_DB->select_query($sql);
		foreach($result as $row) {
			$detalle_remito = new detalle_remito();
            $detalle_remito->set_id_remi(			$row['id_remito']		);
			$detalle_remito->set_id_producto(		$row['id_producto']		);
            $detalle_remito->set_nom_producto(		$row['nom_producto']	);
            $detalle_remito->set_canti_detremi(		$row['canti_detremi']	);
            $detalle_remito->set_precio_detremi(	$row['precio_detremi']	);
            $detalle_remito->set_descrip_producto(	$row['descrip_producto']);
			$detalle[] = $detalle_remito;
		}
		return $detalle;
	}
}
?>
