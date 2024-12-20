<?php
class remito {

    public $_DB;
    public $_id_remi;
	public $_id_vehiculo;
    public $_id_orden;
	public $_id_cliente;
    public $_id_vendedor;
    public $_num_remi;
    public $_obs_remi;
    public $_total_remi;
    public $_fecemi_remi;
    public $_estado_remi;
	public $_nom_vendedor;
	public $_dominio;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function remito($id_remi, $id_orden, $id_vendedor, $id_vehiculo, $id_cliente, $num_remi, $obs_remi, $total_remi, $fecemi_remi, $estado_remi) {

        $this->_id_remi 	= $id_remi;
        $this->_id_orden 	= $id_orden;
		$this->_id_vehiculo	= $id_vehiculo;
        $this->_id_vendedor = $id_vendedor;
		$this->_id_cliente	= $id_cliente;
        $this->_num_remi	= $num_remi;
        $this->_obs_remi 	= $obs_remi;
        $this->_total_remi 	= $total_remi;
        $this->_fecemi_remi	= $fecemi_remi;
        $this->_estado_remi = $estado_remi;
    }

    public function get_id_remi() {
        return $this->_id_remi;
    }

    public function set_id_remi($id_remi) {

        $this->_id_remi = $id_remi;
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

    public function get_id_vendedor() {

        return $this->_id_vendedor;
    }

    public function set_id_vendedor($id_vendedor) {

        $this->_id_vendedor = $id_vendedor;
    }

	public function get_nom_vendedor() {

        return $this->_nom_vendedor;
    }

    public function set_nom_vendedor($nom_vendedor) {

        $this->_nom_vendedor = $nom_vendedor;
    }


    public function get_num_remi() {

        return $this->_num_remi;
    }

    public function set_num_remi($num_remi) {

        $this->_num_remi = $num_remi;
    }

    public function get_obs_remi() {

        return $this->_obs_remi;
    }

    public function set_obs_remi($obs_remi) {

        $this->_obs_remi = $obs_remi;
    }


    public function get_total_remi() {

        return $this->_total_remi;
    }

    public function set_total_remi($total_remi) {

        $this->_total_remi = $total_remi;
    }

    public function get_fecemi_remi() {

        return $this->_fecemi_remi;
    }

    public function set_fecemi_remi($fecemi_remi) {
		$arr = explode("-",$fecemi_remi);
        $this->_fecemi_remi = $arr[2] . "-" . $arr[1] . "-" . $arr[0];
    }

    public function get_estado_remi() {

        return $this->_estado_remi;
    }

    public function set_estado_remi($estado_remi) {

        $this->_estado_remi = $estado_remi;
    }

    public function addRemito($remito) {
        $sql="";
        $sql = $sql . "'" . $remito->get_id_orden() . "',";
		$sql = $sql . "'" . $remito->get_id_vehiculo() . "',";
        $sql = $sql . "'" . $remito->get_id_vendedor() . "',";
		$sql = $sql . "'" . $remito->get_id_cliente() . "',";
        $sql = $sql . "'" . $remito->get_obs_remi() . "',";
        $sql = $sql . "'" . $remito->get_num_remi() . "',";
        $sql = $sql . "'" . $remito->get_total_remi() . "',";
        $sql = $sql . "'" . $remito->get_fecemi_remi() . "',";
        $sql = $sql . "'" . $remito->get_estado_remi() . "'";

        $result = $this->_DB->select_query("call sp_remitoinsert (" . $sql . ")");

        return $result;
    }


    public function updateRemito($remito) {


        $sql="";
        $sql = $sql . "'" . $remito->get_id_remi() . "',";
        $sql = $sql . "'" . $remito->get_id_orden() . "',";
		$sql = $sql . "'" . $remito->get_id_vehiculo() . "',";
        $sql = $sql . "'" . $remito->get_id_vendedor() . "',";
		$sql = $sql . "'" . $remito->get_id_cliente() . "',";
        $sql = $sql . "'" . $remito->get_obs_remi() . "',";
        $sql = $sql . "'" . $remito->get_num_remi() . "',";
        $sql = $sql . "'" . $remito->get_total_remi() . "',";
        $sql = $sql . "'" . $remito->get_fecemi_remi() . "',";
        $sql = $sql . "'" . $remito->get_estado_remi() . "'";

        $result = $this->_DB->alteration_query("call sp_remitoupdate (" . $sql . ")");

        return $result;
    }

    public function deleteRemito($id_remi) {
        $sql = "DELETE FROM remito WHERE id_remito='" . $id_remi . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showRemito($id_remi) {
        $remito = new remito();
        $sql = "SELECT * FROM remito WHERE estado_remi='1' AND  id_remito=" . $id_remi;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $remito->set_id_remi(		$row['id_remi']		);
            $remito->set_id_orden(		$row['id_orden']	);
			$remito->set_id_vehiculo(	$row['id_vehiculo']	);
            $remito->set_id_vendedor(	$row['id_vendedor']	);
            $remito->set_obs_remi(		$row['obs_remi']	);
            $remito->set_total_remi(	$row['total_remi']	);
            $remito->set_fecemi_remi(	$row['fecemi_remi']	);
            $remito->set_estado_remi(	$row['estado_remi']	);
        }

        return $remito;
    }

    public function showRemitoEdit($id_remi) {
		$remito = new remito();
		$sql = "SELECT *, DATE_FORMAT(fecemi_remi,'%d-%m-%Y') fecha_remito, lp.porcentaje_listaprecio
				FROM remito
				LEFT JOIN persona on (remito.id_cliente = persona.id_persona)
				LEFT JOIN vehiculo on (vehiculo.id_vehiculo = remito.id_vehiculo)
				LEFT JOIN listaprecio lp on(lp.id_listaprecio = persona.id_listaprecio)
				WHERE id_remito=" . $id_remi;

		$result = $this->_DB->select_query($sql);
		$return = array();
		foreach($result as $row) {
			$return = $row;
		}
		$arr_tmp = $remito->getManoObra($id_remi);
		$return['importe_MO'] 		= $arr_tmp['importe'];
		$return['descripcion_MO'] 	= $arr_tmp['descripcion'];

		$clsDetalleRemito 			= new detalle_remito();
		$return['detalle'] 			= array();

		if($row['estado_remi'] == 1)
		{
			$return['detalle'] 			= $clsDetalleRemito->showDetalle_remito_vista_edit($id_remi);
		}
		else
		{
			$return['detalle'] 			= $clsDetalleRemito->showDetalle_remito_vista($id_remi);
		}

		return $return;
    }

    public function getManoObra($idremito){
		$sql = "SELECT * FROM manoobra WHERE id_remito = " . $idremito;
		$result = $this->_DB->select_query($sql);
		$data = array('importe' => '', 'descripcion' => '');
		foreach($result as $row){
			$data['importe'] 	= $row['importe'];
			$data['descripcion']= $row['descripcion'];
		}
		return $data;
	}


    public function listRemitos($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM remito WHERE fecemi_remi>='" . $fecIni . "' AND fecemi_remi <='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $remito = new remito();
            $remito->set_id_remi(		$row['id_remi']		);
            $remito->set_id_orden(		$row['id_orden']	);
			$remito->set_id_vehiculo(	$row['id_vehiculo']	);
			$remito->set_id_vehiculo(	$row['id_cliente']	);
            $remito->set_id_vendedor(	$row['id_vendedor']	);
            $remito->set_obs_remi(		$row['obs_remi']	);
            $remito->set_total_remi(	$row['total_remi']	);
            $remito->set_fecemi_remi(	$row['fecemi_remi']	);
            $remito->set_estado_remi(	$row['estado_remi']	);
            $data[] = $remito;
        }

        return $data;
    }

	public function listRemitosCliente($idcliente) {
        $data = array();
        $sql = "SELECT 	r.*, DATE_FORMAT(r.fecemi_remi,'%d-%m-%Y') fecemi_remi, v.nom_persona , ve.dominio
				FROM 	remito r
				LEFT JOIN persona v
					ON (r.id_vendedor = v.id_persona)
				LEFT JOIN `vehiculo` ve
					ON (ve.`id_vehiculo` = r.`id_vehiculo`)
				WHERE 	id_cliente = " . $idcliente . "
				AND		estado_remi = 1";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $remito = new remito();
            $remito->set_id_remi(		$row['id_remito']	);
            $remito->set_id_orden(		$row['id_orden']	);
			$remito->set_id_vehiculo(	$row['id_vehiculo']	);
			$remito->set_id_vehiculo(	$row['id_cliente']	);
            $remito->set_dominio(		$row['dominio']		);
            $remito->set_obs_remi(		$row['obs_remi']	);
            $remito->set_total_remi(	$row['total_remi']	);
            $remito->set_fecemi_remi(	$row['fecemi_remi']	);
            $remito->set_estado_remi(	$row['estado_remi']	);
			$remito->set_nom_vendedor(	$row['nom_persona']	);
            $data[] = $remito;
        }

        return $data;
    }


    public function listJsonRemitos($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM remito WHERE fecemi_remi>='" . $fecIni . "' AND fecemi_remi <='" . $fecFinal . "'";
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
            $data[] = array("id_remi"	=> $row['id_remi']		, "obs_remi"	=> $row['obs_remi'],
            				"total_remi"=> $row['total_remi']	, "fecemi_remi"	=> $row['fecemi_remi']);
        }

        return json_encode($data);
    }

    public function ListaJsonFactDetalleProducto($id_remi){
        $data = array();
        $sql = "SELECT * FROM v_remito_detalle WHERE id_remi=".$id_remi;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[]=$row;//meto todos
        }
        return json_encode($data);
    }

	public function listJsonRemitoDetalle($id_remi){
		$data = array();
        $sql = "SELECT * FROM v_remito_detalle WHERE id_remito=".$id_remi;
        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]=array(	"id_remi"		=>$row['id_remito']		,	"nom_producto"	=>$row['nom_producto'],
							"canti_detremi"	=>$row['canti_detremi']	,	"precio_detremi"=>$row['precio_detremi']);
        }
        return json_encode($data);

   }

	public function listJsonRemitoDetalleFactura($id_remi){

		$data = array();
		$sql = "SELECT * FROM remito WHERE id_remito = " . $id_remi;
		$result = $this->_DB->select_query($sql);
		$data = $result[0];

		$detalle = array();
        $sql = "SELECT 	dr.id_remito, p.nom_producto, dr.canti_detremi, p.pvp1_producto as precio_detremi, p.id_tipoiva,
        				dr.canti_detremi, p.id_producto, p.descrip_producto
        		FROM	detalle_remito dr
        		JOIN 	producto p USING(id_producto)
        		WHERE 	dr.id_remito=".$id_remi;
        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $detalle[]=array("id_remi"	    =>$row['id_remito']		,"nom_producto"	   =>$row['nom_producto'],
							"canti_detremi"	=>$row['canti_detremi']	,"precio_detremi"  =>$row['precio_detremi'],
							"id_tipoiva"	=>$row['id_tipoiva']	,"subtotal"		   =>$row['precio_detremi'] * $row['canti_detremi'],
							"id_producto"	=>$row['id_producto']	,"descrip_producto"=>$row['descrip_producto']);
        }


        $sql1 ="SELECT	id_remito, '0' AS id_producto, '1' AS canti_detremi, 'MO' AS nom_producto, importe AS precio_detremi, descripcion AS descrip_producto
        		FROM	manoobra
        		WHERE	id_remito = ".$id_remi;
        $result1 = $this->_DB->select_query($sql1);
        foreach($result1 as $row) {
            $detalle[]=array(	"id_orden"		=>$row['id_orden']			,	"nom_producto"	=>$row['nom_producto'],
							"canti_detremi"	=>$row['canti_detremi']		,	"precio_detremi"=>$row['precio_detremi'],
							"id_tipoiva"	=>'1'						,	"subtotal"		=>$row['precio_detremi'] * $row['canti_detremi'],
							"id_producto"	=>$row['id_producto']		,	"descrip_producto"	=>$row['descrip_producto'],);
        }

		$data['detalle'] = $detalle;
        return json_encode($data);
	}

	public function setRemitosPagados($str = '', $id_fact = 0) {
		if($str != "") {
			$sql = "UPDATE remito SET estado_remi = 2, id_fact = ".$id_fact." WHERE id_remito IN(".$str.")";

			$this->_DB->alteration_query($sql);
		}
	}

	public function getProximoRemito() {
		$sql = "SELECT  MAX(id_remito) + 1 AS id FROM remito";
		$result = $this->_DB->select_query($sql);
		return $result[0][0];
	}

	public function setManoObra($importe, $descripcion, $idremi) {
		$sql = "DELETE FROM manoobra WHERE id_remito = " . $idremi;
		$result = $this->_DB->select_query($sql);

		$sqli = "INSERT INTO manoobra (id_remito, importe, descripcion) VALUES (".$idremi.",".$importe.",'".$descripcion."')";
		$resutl = $this->_DB->select_query($sqli);
	}

	//Agarra una orden y generar un presupuesto igual
	public function generarPresupuesto($id_remito)
	{
		$sql = "call sp_copiarRemitoToPresupuesto(" . $id_remito . ") ";
		$result = $this->_DB->select_query($sql);
		return $result[0]['id_presupuesto'];
	}

	public function existePresupuestoCreado($idremito){
		$sql = "SELECT id_presupuesto FROM presupuesto WHERE observaciones like '%Remito ".$idremito."%'";
		$result = $this->_DB->select_query($sql);
		$return = "NE"; //No existe
		if(count($result) > 0){
			$return = "E"; //Existe
		}
		return $return;
	}

	public function anular($id_remi){
		//detalle
		$sql1 = "SELECT id_producto, canti_detremi FROM detalle_remito WHERE id_remito = " . $id_remi;
		$result = $this->_DB->select_query($sql1);

		foreach($result as $row){
			$sql2 = "";
			$sql2 = "UPDATE producto  SET stock_producto = stock_producto + " . $row['canti_detremi'] . " WHERE id_producto = " . $row['id_producto'];
			$this->_DB->select_query($sql2);
		}
		//factura
		$sql3 = "UPDATE remito SET estado_remi = 3 WHERE id_remito = ". $id_remi;

		$result = $this->_DB->select_query($sql3);

		return $result;
	}

    public function reAbrir($id_remi = ""){
        $result = 1;
        if($id_remi != ""){
            $sql = "update remito set estado_remi = 1 where id_remito = " . $id_remi;
            $result = $this->_DB->select_query($sql);
        }
        return $result;
    }

}
?>
