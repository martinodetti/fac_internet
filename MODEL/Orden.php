<?php

class orden {

    public $_DB;
    public $_id_orden;
	public $_id_vehiculo;
	public $_id_cliente;
    public $_num_orden;
    public $_obs_orden;
    public $_fecingreso_orden;
    public $_fecegreso_orden;
    public $_fecemi_orden;
    public $_total_orden;
    public $_estado_orden;
    public $_responsable_orden;
	public $_dominio;
	public $_descrip_vc;
	public $_contacto_vc;
	public $_id_vozcliente;
	public $_id_responsable;
    public $_kms_orden;
    public $_control;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function orden($id_orden, $id_vehiculo, $id_cliente, $num_orden, $obs_orden, $total_orden, $fecemi_orden,$fecingreso_orden,$fecegreso_orden, $estado_orden, $descrip_vc, $id_vozcliente, $id_responsable) {

        $this->_id_orden			= $id_orden;
		$this->_id_vehiculo			= $id_vehiculo;
        $this->_id_vendedor			= $id_vendedor;
		$this->_id_cliente			= $id_cliente;
		$this->_num_orden			= $num_orden;
        $this->_obs_orden			= $obs_orden;
        $this->_total_orden			= $total_orden;
        $this->_fecemi_orden		= $fecemi_orden;
        $this->_fecingreso_orden	= $fecingreso_orden;
		$this->_fecegreso_orden		= $fecegreso_orden;
        $this->_estado_orden		= $estado_orden;
        $this->_descrip_vc			= $descrip_vc;
        $this->_id_vozcliente		= $id_vozcliente;
        $this->_id_responsable		= $id_responsable;
    }

    public function get_id_orden() {
        return $this->_id_orden;
    }

    public function set_id_orden($id_orden) {

        $this->_id_orden = $id_orden;
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
	
    public function get_num_orden() {

        return $this->_num_orden;
    }

    public function set_num_orden($num_orden) {

        $this->_num_orden = $num_orden;
    }

    public function get_obs_orden() {

        return $this->_obs_orden;
    }

    public function set_obs_orden($obs_orden) {

        $this->_obs_orden = $obs_orden;
    }

    
    public function get_total_orden() {

        return $this->_total_orden;
    }

    public function set_total_orden($total_orden) {

        $this->_total_orden = $total_orden;
    }

    public function get_fecemi_orden() {

        return $this->_fecemi_orden;
    }

    public function set_fecemi_orden($fecemi_orden) {

        $this->_fecemi_orden = $fecemi_orden;
    }
    
    public function get_fecingreso_orden() {

        return $this->_fecingreso_orden;
    }

    public function set_fecingreso_orden($fecingreso_orden) {

        $this->_fecingreso_orden = $fecingreso_orden;
    }
    
    public function get_fecegreso_orden() {

        return $this->_fecegreso_orden;
    }

    public function set_fecegreso_orden($fecegreso_orden) {

        $this->_fecegreso_orden = $fecegreso_orden;
    }

    public function get_estado_orden() {

        return $this->_estado_orden;
    }

    public function set_estado_orden($estado_orden) {

        $this->_estado_orden = $estado_orden;
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
    
    public function get_id_responsable() {

        return $this->_id_responsable;
    }

    public function set_id_responsable($id_responsable) {

        $this->_id_responsable = $id_responsable;
    }
    
    public function get_kms_orden() {

        return $this->_kms_orden;
    }

    public function set_kms_orden($kms_orden) {

        $this->_kms_orden = $kms_orden;
    }

    public function get_control_orden() {

        return $this->_control;
    }

    public function set_control_orden($control_orden) {

        $this->_control = $control_orden;
    }

    public function addOrden($orden) {
        $sql="";
		$sql = $sql . "'" . $orden->get_id_cliente() . "',";
        $sql = $sql . "'" . $orden->get_id_vehiculo() . "',";
		$sql = $sql . "'" . $orden->get_num_orden() . "',";
        $sql = $sql . "'" . $orden->get_fecingreso_orden() . "',";
		if($orden->_fecegreso_orden != '')
			$sql = $sql . "'" . $orden->get_fecegreso_orden() . "',";
		else
			$sql = $sql . "NULL,";

        $sql = $sql . "'" . $orden->get_fecemi_orden() . "',";
        $sql = $sql . "'" . $orden->get_obs_orden() . "',";
        $sql = $sql . "'" . $orden->get_total_orden() . "',";
        $sql = $sql . "'" . $orden->get_estado_orden() . "',";
        $sql = $sql . "'" . $orden->get_descrip_vc() . "&&" . $orden->get_contacto_vc() . "',";
        $sql = $sql . "'"  . $orden->get_id_vozcliente() . "',";
        $sql = $sql . "'"  . $orden->get_id_responsable() . "',";
        $sql = $sql . "'"  . $orden->get_kms_orden() . "',";
        $sql = $sql . "'"  . $orden->get_control_orden() . "'";
        
        $result = $this->_DB->select_query("call sp_ordeninsert (" . $sql . ")");
       
        return $result;
    }

    public function updateorden($orden) {
        $sql=""; 
        $sql = $sql . "'" . $orden->get_id_orden() . "',";
        $sql = $sql . "'" . $orden->get_id_cliente() . "',";
        $sql = $sql . "'" . $orden->get_id_vehiculo() . "',";
		$sql = $sql . "'" . $orden->get_num_orden() . "',";
	$sql = $sql . "'" . $orden->get_fecingreso_orden() . "',";
	if($orden->_fecegreso_orden != '')
		$sql = $sql . "'" . $orden->get_fecegreso_orden() . "',";
	else
		$sql = $sql . "NULL,";
        $sql = $sql . "'" . $orden->get_fecemi_orden() . "',";
        $sql = $sql . "'" . $orden->get_obs_orden() . "',";
        $sql = $sql . "'" . $orden->get_total_orden() . "',";
        $sql = $sql . "'" . $orden->get_estado_orden() . "',";
        $sql = $sql . "'" . $orden->get_descrip_vc() . "&&" . $orden->get_contacto_vc() . "',";
        $sql = $sql . ""  . $orden->get_id_vozcliente() . ",";
        $sql = $sql . "'" . $orden->get_id_responsable() . "',";
        $sql = $sql . "'" . $orden->get_kms_orden() . "',";
        $sql = $sql . "'" . $orden->get_control_orden() . "'";
 
        $this->_DB->alteration_query("call sp_ordenupdate (" . $sql . ")");

        return $orden->get_id_orden();
    }

    public function deleteorden($id_orden) {
        $sql = "DELETE FROM orden_reparacion WHERE id_orden='" . $id_orden . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showorden($id_orden) {
        $orden = new orden();
        $sql = "SELECT * FROM orden_reparacion WHERE id_orden=" . $id_orden;
        
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $orden->set_id_orden(			$row['id_orden']		);
            $orden->set_id_cliente(			$row['id_cliente']		);
			$orden->set_id_vehiculo(		$row['id_vehiculo']		);
            $orden->set_obs_orden(			$row['observaciones']	);
            $orden->set_total_orden(		$row['total']			);
            $orden->set_fecemi_orden(		$row['fecemi_orden']	);
			$orden->set_fecingreso_orden(	$row['fecingreso_orden']);
			$orden->set_fecegreso_orden(	$row['fecegreso_orden']	);
            $orden->set_estado_orden(		$row['estado']			);
            $orden->set_id_responsable(		$row['id_responsable']	);
        }
        return $orden;
    }
    
    public function showOrdenEdit($ido) {
		$orden = new orden();
		$sql  = "SELECT * FROM v_orden_reparacion WHERE id_orden = ". $ido;
		$result = $this->_DB->select_query($sql);
		$return = array();
		foreach($result as $row) {
			$return = $row;
		}
		
		$sql = "SELECT porcentaje_listaprecio FROM listaprecio JOIN persona USING(id_listaprecio) WHERE id_persona = " . $row['id_cliente'];
		$result = $this->_DB->select_query($sql);
		$return['porcentaje'] = $result[0]['porcentaje_listaprecio'];
		
		$arr_tmp = $orden->getManoObra($ido,1);
		$return['importe_MO'] = $arr_tmp['importe'];
		$return['descripcion_MO'] = $arr_tmp['descripcion'];
		$arr_tmp1 = $orden->getManoObra($ido,2);
		$return['importe_MO2'] = $arr_tmp1['importe'];
		$return['descripcion_MO2'] = $arr_tmp1['descripcion'];
		
		$arr_tmp1 = $orden->getTorneria($ido);
		$return['importe_TO'] = $arr_tmp1['importe'];
		$return['descripcion_TO'] = $arr_tmp1['descripcion'];
		
		$arr_tmp = explode("&&",$return['descrip_vc']);
		$return['descrip_vc'] = $arr_tmp[0];
		$return['contacto_vc'] = $arr_tmp[1];
		
		return $return;    
    }
    

    public function listorden($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM orden_reparacion WHERE fecemi_orden>='" . $fecIni . "' AND fecemi_orden <='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $orden = new ordento();
            $orden->set_id_orden(			$row['id_orden']		);
			$orden->set_id_vehiculo(		$row['id_vehiculo']		);
			$orden->set_id_vehiculo(		$row['id_cliente']		);
            $orden->set_obs_orden(			$row['observaciones']	);
            $orden->set_total_orden(		$row['total_orden']		);
            $orden->set_fecemi_orden(		$row['fecemi_orden']	);
            $orden->set_fecingreso_orden(	$row['fecingreso_orden']);
            $orden->set_fecegreso_orden(	$row['fecegreso_orden']	);
            $orden->set_estado_orden(		$row['estado_orden']	);
            $orden->set_id_responsable(		$row['id_responsable']	);
            $data[] = $orden;
        }

        return $data;
    }
	
	public function listordenCliente($idcliente) {
        $data = array();
        $sql = "SELECT	o.*, DATE_FORMAT(o.fecemi_orden,'%d-%m-%Y') fecemi_orden, 
						DATE_FORMAT(o.fecingreso_orden,'%d-%m-%Y') fecingreso_orden,
						DATE_FORMAT(o.fecegreso_orden,'%d-%m-%Y') fecgreso_orden,
						c.nom_persona , ve.dominio
				FROM	orden_reparacion o 
				LEFT JOIN persona c 
					ON (o.id_cliente = c.id_persona) 
				LEFT JOIN `vehiculo` ve 
					ON (ve.`id_vehiculo` = o.`id_vehiculo`) 
				WHERE	id_cliente = " . $idcliente . " 
				AND		estado = 2";

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {

            $orden = new orden();	
            $orden->set_id_orden(			$row['id_orden']		);
			$orden->set_id_vehiculo(		$row['id_vehiculo']		);
			$orden->set_id_cliente(			$row['id_cliente']		);
            $orden->set_dominio(			$row['dominio']			);	
            $orden->set_obs_orden(			$row['observaciones']	);
            $orden->set_total_orden(		$row['total']			);
            $orden->set_fecemi_orden(		$row['fecemi_orden']	);
            $orden->set_fecingreso_orden(	$row['fecingreso_orden']);
            $orden->set_fecegreso_orden(	$row['fecegreso_orden']	);
            $orden->set_estado_orden(		$row['estado']			);
//			$orden->set_nom_vendedor(		$row['nom_persona']		);
            $data[] = $orden;
        }

        return $data;
    }
	
	
    public function listJsonorden($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM ordento WHERE fecemi_orden>='" . $fecIni . "' AND fecemi_orden <='" . $fecFinal . "'";        
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
            $data[] = array("id_orden"	=> $row['id_orden']		, "obs_orden"	=> $row['observaciones'],
							"total_orden"=> $row['total_orden']	, "fecemi_orden"	=> $row['fecemi_orden']);
        }

        return json_encode($data);
    }
    
    public function ListaJsonFactDetalleProducto($id_orden){
        $data = array();
        $sql = "SELECT * FROM v_ordento_detalle WHERE id_orden=".$id_orden;
        $result = $this->_DB->select_query($sql); 
        foreach ($result as $row) {
            $data[]=$row;//meto todos
        }
        return json_encode($data);
    }

	public function listJsonordenDetalle($id_orden){
		$data = array();
        $sql = "SELECT * FROM v_orden_detalle WHERE id_ordento=".$id_orden;
        $result = $this->_DB->select_query($sql);  
		foreach ($result as $row) {
            $data[]=array(	"id_orden"			=>$row['id_ordento']		,	"nom_producto"	=>$row['nom_producto'],
							"canti_detorden"	=>$row['canti_detorden']	,	"precio_detorden"=>$row['precio_detorden']);
        }
        return json_encode($data);
       
   }
   
	public function listJsonordenDetalleFactura($id_orden){
		$data = array();
        $sql = "SELECT	do.id_orden, p.nom_producto, do.canti_detord, p.pvp1_producto AS precio_detord, do.canti_detord,
						do.id_producto, p.descrip_producto, p.id_tipoiva
				FROM	detalle_ordenreparacion do
				JOIN	producto p USING (id_producto) 
				WHERE	do.id_orden=".$id_orden;
        
        
        $result = $this->_DB->select_query($sql);  
		foreach ($result as $row) {
            $data[]=array(	"id_orden"		=>$row['id_orden']			,	"nom_producto"	=>$row['nom_producto'],
							"canti_detord"	=>$row['canti_detord']		,	"precio_detord" =>$row['precio_detord'],
							"id_tipoiva"	=>$row['id_tipoiva']		,	"subtotal"		=>$row['precio_detord'] * $row['canti_detord'],
							"id_producto"	=>$row['id_producto']		,	"descrip_producto"	=>$row['descrip_producto'],);
        }
        
        //MANOS DE OBRA
        $sql1 ="SELECT	id_orden, '0' AS id_producto, '1' AS canti_detord, 'MO' AS nom_producto, importe AS precio_detord, descripcion AS descrip_producto
				FROM	manoobra 
				WHERE	id_orden = ".$id_orden;
        $result1 = $this->_DB->select_query($sql1);
        $primera_mo_ocupada = 0;
        foreach($result1 as $row) {
			$id_p = -2;
    
			if($primera_mo_ocupada == 0){
				$id_p = 0;
				$primera_mo_ocupada = 1;
			}
            $data[]=array(	"id_orden"		=>$row['id_orden']			,	"nom_producto"	=>$row['nom_producto'],
							"canti_detord"	=>$row['canti_detord']		,	"precio_detord" =>$row['precio_detord'],
							"id_tipoiva"	=>'1'						,	"subtotal"		=>$row['precio_detord'] * $row['canti_detord'],
							"id_producto"	=>$id_p						,	"descrip_producto"	=>$row['descrip_producto'],);
        }
        
        //TORNERIA
        $sql2 ="SELECT	id_orden, '-1' AS id_producto, '1' AS canti_detord, 'TO' AS nom_producto, importe AS precio_detord, descripcion AS descrip_producto
				FROM	torneria 
				WHERE	id_orden = ".$id_orden;
        $result2 = $this->_DB->select_query($sql2);
        foreach($result2 as $row) {
            $data[]=array(	"id_orden"		=>$row['id_orden']			,	"nom_producto"	=>$row['nom_producto'],
							"canti_detord"	=>$row['canti_detord']		,	"precio_detord" =>$row['precio_detord'],
							"id_tipoiva"	=>'1'						,	"subtotal"		=>$row['precio_detord'] * $row['canti_detord'],
							"id_producto"	=>$row['id_producto']		,	"descrip_producto"	=>$row['descrip_producto'],);
        }
		
		$orden = $this->showorden($id_orden);
		
		$orden->detalle = $data;
        
        return json_encode($orden);
	}
	
	public function setordenesPagados($str = '', $id_fact = 0) {
		if($str != "") {
			$sql = "UPDATE orden_reparacion SET estado = 3, id_fact = ".$id_fact." WHERE id_orden IN(".$str.")";
			$this->_DB->alteration_query($sql);
		}
	}
	
	
    public function anularOrden($ido, $obs = ""){
		//detalle
		$sql1 = "SELECT id_producto, canti_detord FROM detalle_ordenreparacion WHERE id_producto is not null AND  id_orden = " . $ido;
		$result = $this->_DB->select_query($sql1);

		foreach($result as $row){
			$sql2 = "";
			$sql2 = "UPDATE producto SET stock_producto = stock_producto + " . $row['canti_detord'] . " WHERE id_producto = " . $row['id_producto'];
			$this->_DB->select_query($sql2);
		}
		//orden
		$sql3 = "UPDATE orden_reparacion SET estado = 4, observaciones = '".$obs."' WHERE id_orden = ". $ido;

		$result = $this->_DB->select_query($sql3);

		return $result;
    }
	
	
	public function getProximoorden() {
//		$sql = "SELECT  MAX(id_orden) + 1 AS id FROM orden_reparacion";
		$sql = "SHOW TABLE STATUS LIKE 'orden_reparacion'";
		$result = $this->_DB->select_query($sql);
		return $result[0][10];
	}
	
	public function resetManoObra($id_orden)
	{
		$sql = "DELETE FROM manoobra WHERE id_orden = " . $id_orden;
		$result = $this->_DB->select_query($sql);
	}
	
	
	public function setManoObra($importe, $descripcion, $idorden) {
		
		if($importe != "")
		{
			$sqli = "INSERT INTO manoobra (id_orden, importe, descripcion) VALUES (".$idorden.",".$importe.",'".$descripcion."')";
			$resutl = $this->_DB->select_query($sqli);
		}
	}
	
	public function setTorneria($importe, $descripcion, $idorden) {
		$sql = "DELETE FROM torneria WHERE id_orden = " . $idorden;
		$result = $this->_DB->select_query($sql);
		
		if($importe != "")
		{
			$sqli = "INSERT INTO torneria (id_orden, importe, descripcion) VALUES (".$idorden.",".$importe.",'".$descripcion."')";
			$resutl = $this->_DB->select_query($sqli);
		}
	}
	
	public function getManoObra($idorden, $orden = 1){
		$sql = "SELECT * FROM manoobra WHERE id_orden = " . $idorden;
		if($orden == 2)
			$sql = $sql . " ORDER BY idmanoobra DESC";
		else
			$sql = $sql . " LIMIT 1";
		$result = $this->_DB->select_query($sql);
		$data = array('importe' => '', 'descripcion' => '');
		foreach($result as $row){
			if(count($result) > 1 || $orden == 1){
				$data['importe']	= $row['importe'];
				$data['descripcion']= $row['descripcion'];
			}else{
				$data['importe']	= "";
				$data['descripcion']= "";
			}
			break;
		}
		return $data;
	}
	
	public function getTorneria($idorden){
		$sql = "SELECT * FROM torneria WHERE id_orden = " . $idorden;
		$result = $this->_DB->select_query($sql);
		$data = array('importe' => '', 'descripcion' => '');
		foreach($result as $row){
			$data['importe']	= $row['importe'];
			$data['descripcion']= $row['descripcion'];
		}
		return $data;
	}
	
	//Agarra una orden y generar un presupuesto igual
	public function generarPresupuesto($id_orden)
	{
		$sql = "call sp_copiarOrdenToPresupuesto(" . $id_orden . ") ";
		$result = $this->_DB->select_query($sql);
		return $result[0]['id_presupuesto'];
	}
	
	public function existePresupuestoCreado($ido){
		$sql = "SELECT id_presupuesto FROM presupuesto WHERE observaciones like '%Orden ".$ido."%'";
		$result = $this->_DB->select_query($sql);
		$return = "NE"; //No existe
		if(count($result) > 0){
			$return = "E"; //Existe
		}
		return $return;
	}
}
?>
