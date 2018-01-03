<?php

class presupuesto {

    public $_DB;
    public $_id_presupuesto;
	public $_id_vehiculo;
	public $_id_cliente;
    public $_num_presupuesto;
    public $_obs_presupuesto;
    public $_fecemi_presupuesto;
    public $_total_presupuesto;
    public $_estado_presupuesto;
    public $_responsable_presupuesto;
	public $_dominio;
	public $_descrip_vc;
	public $_contacto_vc;
	public $_id_vozcliente;
	public $_kms_presupuesto;
	public $_descto_presupuesto;


    public function __construct() {

        $this->_DB = new Database();
    }

    public function presupuesto($id_presupuesto, $id_vehiculo, $id_cliente, $num_presupuesto, $obs_presupuesto, $total_presupuesto, $fecemi_presupuesto, $estado_presupuesto, $descrip_vc, $id_vozcliente) {

        $this->_id_presupuesto 		= $id_presupuesto;
		$this->_id_vehiculo			= $id_vehiculo;
        $this->_id_vendedor 		= $id_vendedor;
		$this->_id_cliente			= $id_cliente;
    	$this->_num_presupuesto		= $num_presupuesto;
        $this->_obs_presupuesto 	= $obs_presupuesto;
        $this->_total_presupuesto 	= $total_presupuesto;
        $this->_fecemi_presupuesto	= $fecemi_presupuesto;
        $this->_estado_presupuesto 	= $estado_presupuesto;
        $this->_descrip_VC			= $descrip_vc;
        $this->_id_vozcliente		= $id_vozcliente;
    }

    public function get_id_presupuesto() {
        return $this->_id_presupuesto;
    }

    public function set_id_presupuesto($id_presupuesto) {

        $this->_id_presupuesto = $id_presupuesto;
    }

	public function get_id_vehiculo() {

        return $this->_id_vehiculo;
    }

    public function set_id_vehiculo($id_vehiculo) {

        $this->_id_vehiculo = $id_vehiculo;
    }

    public function get_id_vozcliente() {
    	if($this->_id_vozcliente == "")
    		return 'NULL';
    	else
	        return $this->_id_vozcliente;
    }

    public function set_id_vozcliente($id_vozcliente) {

        $this->_id_vozcliente = $id_vozcliente;
    }

	public function get_dominio() {

        return $this->_dominio;
    }

    public function set_dominio($dominio) {

        $this->_dominio = $dominio;
    }

	public function get_id_cliente() {

        return $this->_id_cliente;
    }

    public function set_id_cliente($id_cliente) {

        $this->_id_cliente = $id_cliente;
    }

    public function get_num_presupuesto() {

        return $this->_num_presupuesto;
    }

    public function set_num_presupuesto($num_presupuesto) {

        $this->_num_presupuesto = $num_presupuesto;
    }

    public function get_obs_presupuesto() {

        return $this->_obs_presupuesto;
    }

    public function set_obs_presupuesto($obs_presupuesto) {

        $this->_obs_presupuesto = $obs_presupuesto;
    }


    public function get_total_presupuesto() {

        return $this->_total_presupuesto;
    }

    public function set_total_presupuesto($total_presupuesto) {

        $this->_total_presupuesto = $total_presupuesto;
    }

    public function get_fecemi_presupuesto() {

        return $this->_fecemi_presupuesto;
    }

    public function set_fecemi_presupuesto($fecemi_presupuesto) {

        $this->_fecemi_presupuesto = $fecemi_presupuesto;
    }

    public function get_estado_presupuesto() {

        return $this->_estado_presupuesto;
    }

    public function set_estado_presupuesto($estado_presupuesto) {

        $this->_estado_presupuesto = $estado_presupuesto;
    }

    public function get_descrip_vc() {

        return $this->_descrip_vc;
    }

    public function set_descrip_vc($descrip_vc) {

        $this->_descrip_vc = $descrip_vc;
    }

    public function get_contacto_vc() {

        return $this->_contacto_vc;
    }

    public function set_contacto_vc($contacto_vc) {

        $this->_contacto_vc = $contacto_vc;
    }


    public function get_kms_presupuesto() {

        return $this->_kms_presupuesto;
    }

    public function set_kms_presupuesto($kms_presupuesto) {

        $this->_kms_presupuesto = $kms_presupuesto;
    }

	public function get_descto_presupuesto() {

        return $this->_descto_presupuesto;
    }

    public function set_descto_presupuesto($descto_presupuesto) {

        $this->_descto_presupuesto = $descto_presupuesto;
    }


    public function addPresupuesto($presupuesto) {
        $sql="";
		$sql = $sql . "'" . $presupuesto->get_id_cliente() . "',";
        $sql = $sql . "'" . $presupuesto->get_id_vehiculo() . "',";
		$sql = $sql . "'" . $presupuesto->get_num_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_fecemi_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_obs_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_total_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_estado_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_descrip_vc() . "&&" . $presupuesto->get_contacto_vc() . "',";
        $sql = $sql . "'" . $presupuesto->get_id_vozcliente() . "',";
        $sql = $sql . "'" . $presupuesto->get_kms_presupuesto()."',";
		$sql = $sql . "'" . $presupuesto->get_descto_presupuesto()."'";

        $result = $this->_DB->select_query("call sp_presupuestoinsert (" . $sql . ")");

        return $result;
    }

    public function updatepresupuesto($presupuesto) {
        $sql="";
        $sql = $sql . "'" . $presupuesto->get_id_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_id_cliente() . "',";
        $sql = $sql . "'" . $presupuesto->get_id_vehiculo() . "',";
		$sql = $sql . "'" . $presupuesto->get_num_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_fecemi_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_obs_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_total_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_estado_presupuesto() . "',";
        $sql = $sql . "'" . $presupuesto->get_descrip_vc() . "&&" . $presupuesto->get_contacto_vc() . "',";
        $sql = $sql . ""  . $presupuesto->get_id_vozcliente() . ",";
        $sql = $sql . "'" . $presupuesto->get_kms_presupuesto() . "',";
		$sql = $sql . "'" . $presupuesto->get_descto_presupuesto()."'";

        $this->_DB->alteration_query("call sp_presupuestoupdate (" . $sql . ")");

        return $presupuesto->get_id_presupuesto();
    }

    public function deletepresupuesto($id_presupuesto) {
        $sql = "DELETE FROM presupuesto WHERE id_presupuesto='" . $id_presupuesto . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showpresupuesto($id_presupuesto) {
        $presupuesto = new presupuesto();
        $sql = "SELECT * FROM presupuesto WHERE id_presupuesto=" . $id_presupuesto;

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $presupuesto->set_id_presupuesto(		$row['id_presupuesto']		);
            $presupuesto->set_id_cliente(			$row['id_cliente']			);
			$presupuesto->set_id_vehiculo(			$row['id_vehiculo']			);
            $presupuesto->set_obs_presupuesto(		$row['observaciones']		);
            $presupuesto->set_total_presupuesto(	$row['total']				);
            $presupuesto->set_fecemi_presupuesto(	$row['fecemi_presupuesto']	);
            $presupuesto->set_estado_presupuesto(	$row['estado']				);
            $presupuesto->set_kms_presupuesto(		$row['kms_presupuesto']		);
        }
        return $presupuesto;
    }

    public function showPresupuestoEdit($ido) {
		$presupuesto = new presupuesto();
		$sql  = "SELECT * FROM v_presupuesto WHERE id_presupuesto = ". $ido;
		$result = $this->_DB->select_query($sql);
		$return = array();
		foreach($result as $row) {
			$return = $row;
		}

		$sql = "SELECT porcentaje_listaprecio FROM listaprecio JOIN persona USING(id_listaprecio) WHERE id_persona = " . $row['id_cliente'];
		$result = $this->_DB->select_query($sql);
		$return['porcentaje'] = $result[0]['porcentaje_listaprecio'];

		$arr_tmp = $presupuesto->getManoObra($ido,1);
		$return['importe_MO'] = $arr_tmp['importe'];
		$return['descripcion_MO'] = $arr_tmp['descripcion'];
		$arr_tmp1 = $presupuesto->getManoObra($ido,2);
		$return['importe_MO2'] = $arr_tmp1['importe'];
		$return['descripcion_MO2'] = $arr_tmp1['descripcion'];


		$arr_tmp1 = $presupuesto->getTorneria($ido);
		$return['importe_TO'] = $arr_tmp1['importe'];
		$return['descripcion_TO'] = $arr_tmp1['descripcion'];

		$arr_tmp = explode("&&",$return['descrip_vc']);
		$return['descrip_vc'] = $arr_tmp[0];
		$return['contacto_vc'] = $arr_tmp[1];

		return $return;
    }


    public function listpresupuesto() {
        $data = array();
        $sql = "SELECT  p.*, ve.dominio, date_format(fecemi_presupuesto,'%d-%m-%Y') as fecha
        		FROM 	presupuesto p
        		LEFT JOIN `vehiculo` ve
					ON 	(ve.`id_vehiculo` = p.`id_vehiculo`)
				LEFT JOIN persona c
					ON 	(p.id_cliente = c.id_persona) ";

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {

            $presupuesto = new presupuesto();
            $presupuesto->set_id_presupuesto(		$row['id_presupuesto']		);
			$presupuesto->set_dominio(				$row['dominio']				);
            $presupuesto->set_total_presupuesto(	$row['total']				);
            $presupuesto->set_fecemi_presupuesto(	$row['fecha']				);
            if($row['estado'] == 1)
	            $data[] = $presupuesto;
        }

        return $data;
    }

	public function listpresupuestoCliente($idcliente) {
        $data = array();
        $sql = "SELECT 	o.*, DATE_FORMAT(o.fecemi_presupuesto,'%d-%m-%Y') fecemi_presupuesto,
        				DATE_FORMAT(o.fecingreso_presupuesto,'%d-%m-%Y') fecingreso_presupuesto,
        				DATE_FORMAT(o.fecegreso_presupuesto,'%d-%m-%Y') fecgreso_presupuesto,
        				c.nom_persona , ve.dominio
				FROM 	presupuesto_reparacion o
				LEFT JOIN persona c
					ON (o.id_cliente = c.id_persona)
				LEFT JOIN `vehiculo` ve
					ON (ve.`id_vehiculo` = o.`id_vehiculo`)
				WHERE 	id_cliente = " . $idcliente . "
				AND		estado = 2";

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {

            $presupuesto = new presupuesto();
            $presupuesto->set_id_presupuesto(		$row['id_presupuesto']		);
			$presupuesto->set_id_vehiculo(			$row['id_vehiculo']			);
			$presupuesto->set_id_cliente(			$row['id_cliente']			);
            $presupuesto->set_dominio(				$row['dominio']				);
            $presupuesto->set_obs_presupuesto(		$row['observaciones']		);
            $presupuesto->set_total_presupuesto(	$row['total']				);
            $presupuesto->set_fecemi_presupuesto(	$row['fecemi_presupuesto']	);
            $presupuesto->set_estado_presupuesto(	$row['estado']				);
//			$presupuesto->set_nom_vendedor(		$row['nom_persona']		);
            $data[] = $presupuesto;
        }

        return $data;
    }


    public function listJsonpresupuesto($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM presupuestoto WHERE fecemi_presupuesto >='" . $fecIni . "' AND fecemi_presupuesto <='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
//            $factura = new factura();
//            $factura->set_id_fact($row['id_fact']);
//            $factura->set_id_empresa($row['id_empresa']);
//            $factura->set_id_cliente($row['id_cliente']);
//            $factura->set_id_vendedor($row['id_vendedor']);
//            $factura->set_descto_fact($row['descto_fact']);
//            $factura->set_obs_fact($row['obs_fact']);
//            $factura->set_iva12_fact($row['iva12_fact']);
//            $factura->set_total_fact($row['total_fact']);
//            $factura->set_fecemi_fact($row['fecemi_fact']);
//            $factura->set_estado_fact($row['estado_fact']);
            $data[] = array("id_presupuesto"	=> $row['id_presupuesto']		, "obs_presupuesto"	=> $row['observaciones'],
            				"total_presupuesto"=> $row['total_presupuesto']	, "fecemi_presupuesto"	=> $row['fecemi_presupuesto']);
        }

        return json_encode($data);
    }

    public function ListaJsonFactDetalleProducto($id_presupuesto){
        $data = array();
        $sql = "SELECT * FROM v_presupuestoto_detalle WHERE id_presupuesto=".$id_presupuesto;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[]=$row;//meto todos
        }
        return json_encode($data);
    }

	public function listJsonpresupuestoDetalle($id_presupuesto){
		$data = array();
        $sql = "SELECT * FROM v_presupuesto_detalle WHERE id_presupuestoto=".$id_presupuesto;
        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]=array(	"id_presupuesto"			=>$row['id_presupuestoto']		,	"nom_producto"	=>$row['nom_producto'],
							"canti_detpresupuesto"	=>$row['canti_detpresupuesto']	,	"precio_detpresupuesto"=>$row['precio_detpresupuesto']);
        }
        return json_encode($data);

   }

	public function listJsonpresupuestoDetalleFactura($id_presupuesto){
		$data = array();
        $sql = "SELECT * FROM v_presupuesto_reparacion_detalle WHERE id_presupuesto=".$id_presupuesto;
        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]=array(	"id_presupuesto"=>$row['id_presupuesto'],	"nom_producto"		=>$row['nom_producto'],
							"canti_detord"	=>$row['canti_detord']	,	"precio_detord" 	=>$row['precio_detord'],
							"id_tipoiva"	=>'1'					,	"subtotal"			=>$row['precio_detord'] * $row['canti_detord'],
							"id_producto"	=>$row['id_producto']	,	"descrip_producto"	=>$row['descrip_producto'],);
        }
        return json_encode($data);
	}

	public function setpresupuestoesPagados($str = '') {
		if($str != "") {
			$sql = "UPDATE presupuesto_reparacion SET estado = 3 WHERE id_presupuesto IN(".$str.")";
			$this->_DB->alteration_query($sql);
		}
	}

	public function getProximoPresupuesto() {
//		$sql = "SELECT  MAX(id_presupuesto) + 1 AS id FROM presupuesto_reparacion";
		$sql = "SHOW TABLE STATUS LIKE 'presupuesto'";
		$result = $this->_DB->select_query($sql);
		return $result[0][10];
	}

	public function resetManoObra($id_presupuesto)
	{
		$sql = "DELETE FROM manoobra WHERE id_presupuesto = " . $id_presupuesto;
		$result = $this->_DB->select_query($sql);
	}


	public function setManoObra($importe, $descripcion, $idpresupuesto) {

		if($importe != ""){
			$sqli = "INSERT INTO manoobra (id_presupuesto, importe, descripcion) VALUES (".$idpresupuesto.",".$importe.",'".$descripcion."')";
			$resutl = $this->_DB->select_query($sqli);
		}
	}

	public function setTorneria($importe, $descripcion, $idpresupuesto) {
		$sql = "DELETE FROM torneria WHERE id_presupuesto = " . $idpresupuesto;
		$result = $this->_DB->select_query($sql);

		if($importe != ""){
			$sqli = "INSERT INTO torneria (id_presupuesto, importe, descripcion) VALUES (".$idpresupuesto.",".$importe.",'".$descripcion."')";
			$resutl = $this->_DB->select_query($sqli);
		}
	}



	public function getManoObra($idpresupuesto, $orden = 1){
		$sql = "SELECT * FROM manoobra WHERE id_presupuesto = " . $idpresupuesto;
		if($orden == 2)
			$sql = $sql . " ORDER BY idmanoobra DESC";
		else
			$sql = $sql . " LIMIT 1";

		$result = $this->_DB->select_query($sql);
		$data = array('importe' => '', 'descripcion' => '');
		foreach($result as $row){
			if(count($result) > 1 || $orden == 1){
				$data['importe'] 	= $row['importe'];
				$data['descripcion']= $row['descripcion'];
			}else{
				$data['importe']	= "";
				$data['descripcion']= "";
			}
			break;
		}
		return $data;
	}

	public function getTorneria($idpresupuesto){
		$sql = "SELECT * FROM torneria WHERE id_presupuesto = " . $idpresupuesto;
		$result = $this->_DB->select_query($sql);
		$data = array('importe' => '', 'descripcion' => '');
		foreach($result as $row){
			$data['importe'] 	= $row['importe'];
			$data['descripcion']= $row['descripcion'];
		}
		return $data;
	}

	//Agarra un presupuesto y lo transforma en una orden de reparacion
	public function generarOrdenReparacion($id_presupuesto)
	{
		$sql = "call sp_copiarPresupuestoToOrden(" . $id_presupuesto . ") ";
		$result = $this->_DB->select_query($sql);
	}

	//Agarra un presupuesto y lo transforma en una orden de reparacion
	public function generarRemito($id_presupuesto)
	{
		$sql = "call sp_copiarPresupuestoToRemito(" . $id_presupuesto . ") ";
		$result = $this->_DB->select_query($sql);
	}
}
?>
