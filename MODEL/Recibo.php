<?php
class recibo {

    public $_DB;
    public $_id_recibo;
    public $_id_cliente;
    public $_id_provd;
    public $_fecemi_recibo;
    public $_num_recibo;
    public $_total_recibo;
    public $_obs_recibo;
    public $_estado_recibo;
    public $_efectivo;
    public $_facturas;
    public $_cheques;
    public $_tipo_recibo;
    public $_id_responsable;
    public $_saldo_a_favor;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function recibo($id_recibo, $id_cliente, $fecemi_recibo, $num_recibo, $total_recibo, $obs_recibo,$efectivo) {

        $this->_id_recibo 		= $id_recibo;
        $this->_id_cliente 		= $id_cliente;
        $this->_num_recibo		= $num_recibo;
        $this->_obs_recibo 		= $obs_recibo;
        $this->_total_recibo 	= $total_recibo;
        $this->_fecemi_recibo	= $fecemi_recibo;
        $this->_estado_recibo 	= $estado_recibo;
        $this->_efectivo		= $efectivo;
    }

    public function get_id_recibo() {
        return $this->_id_recibo;
    }

    public function set_id_recibo($id_recibo) {

        $this->_id_recibo = $id_recibo;
    }

    public function get_id_cliente() {

        return $this->_id_cliente;
    }

    public function set_id_cliente($id_cliente) {

        $this->_id_cliente = $id_cliente;
    }

	public function get_id_provd() {

        return $this->_id_provd;
    }

    public function set_id_provd($id_provd) {

        $this->_id_provd = $id_provd;
    }

    public function get_num_recibo() {

        return $this->_num_recibo;
    }

    public function set_num_recibo($num_recibo) {

        $this->_num_recibo = $num_recibo;
    }

    public function get_obs_recibo() {

        return $this->_obs_recibo;
    }

    public function set_obs_recibo($obs_recibo) {

        $this->_obs_recibo = $obs_recibo;
    }


    public function get_total_recibo() {

        return $this->_total_recibo;
    }

    public function set_total_recibo($total_recibo) {

        $this->_total_recibo = $total_recibo;
    }

    public function get_fecemi_recibo() {

        return $this->_fecemi_recibo;
    }

    public function set_fecemi_recibo($fecemi_recibo) {
		$arr = explode("-",$fecemi_recibo);
        $this->_fecemi_recibo = $arr[2] . "-" . $arr[1] . "-" . $arr[0];
    }

    public function get_estado_recibo() {

        return $this->_estado_recibo;
    }

    public function set_estado_recibo($estado_recibo) {

        $this->_estado_recibo = $estado_recibo;
    }

	public function get_efectivo_recibo() {

        return $this->_efectivo_recibo;
    }

    public function set_efectivo_recibo($efectivo_recibo) {

        $this->_efectivo_recibo = $efectivo_recibo;
    }

    public function get_debito_recibo() {

        return $this->_debito_recibo;
    }

    public function set_debito_recibo($debito_recibo) {

        $this->_debito_recibo = $debito_recibo;
    }

    public function get_saldo_a_favor() {

        return $this->_saldo_a_favor;
    }

    public function set_saldo_a_favor($saldo_a_favor) {

        $this->_saldo_a_favor = $saldo_a_favor;
    }

    public function get_tipo_recibo() {

        return $this->_tipo_recibo;
    }

    public function set_tipo_recibo($tipo_recibo) {

        $this->_tipo_recibo = $tipo_recibo;
    }

    public function get_id_responsable(){
        return $this->_id_responsable;
    }

    public function set_id_responsable($id_responsable){
        $this->_id_responsable = $id_responsable;
    }

    public function addRecibo($recibo) {
        $sql="INSERT INTO recibo (id_cliente, fecemi_recibo, num_recibo, total_recibo, obs_recibo, estado_recibo,efectivo_recibo, tipo_recibo, id_responsable) VALUE (";
        $sql = $sql . "'" . $recibo->get_id_cliente() . "',";
        $sql = $sql . "'" . $recibo->get_fecemi_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_num_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_total_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_obs_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_estado_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_efectivo_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_tipo_recibo() . "',";
        $sql = $sql . "" . $recibo->get_id_responsable() . ");";

        $this->_DB->alteration_query($sql);

        $sql = "SELECT LAST_INSERT_ID();";
   		$result = $this->_DB->select_query($sql);
//        $result = $this->_DB->select_query("call sp_reciboinsert (" . $sql . ")");

        return $result;
    }

    public function addReciboProvd($recibo){
    	$sql="INSERT INTO recibo (id_provd, fecemi_recibo, num_recibo, total_recibo, obs_recibo, estado_recibo,efectivo_recibo, debito_recibo, tipo_recibo, saldo_a_favor) VALUE (";
    	$sql = $sql . "'" . $recibo->get_id_provd() . "',";
        $sql = $sql . "'" . $recibo->get_fecemi_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_num_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_total_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_obs_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_estado_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_efectivo_recibo() . "',";
        $sql = $sql . "'" . $recibo->get_debito_recibo() . "', 3,";
        $sql = $sql . "'" . $recibo->get_saldo_a_favor() . "');";

        $this->_DB->alteration_query($sql);

        $sql = "SELECT LAST_INSERT_ID();";
   		$result = $this->_DB->select_query($sql);
//        $result = $this->_DB->select_query("call sp_reciboinsert (" . $sql . ")");

        return $result;
    }

    public function addRetencion($ret){
    	$sql = "INSERT INTO recibo_retencion VALUE (".$ret['id_recibo'].",".$ret['idtipo'].",".$ret['monto'].", '".$ret['numero']."')";

    	$result = $this->_DB->alteration_query($sql);

    	return $result;
    }

    public function addTransferencia($tra)
    {
    	$sql = "INSERT INTO transferencia VALUE (0,".$tra['id_recibo'].",'".$tra['numero']."',".$tra['monto'].",'".$tra['fecha']."')";
    	$result = $this->_DB->alteration_query($sql);
    	return $result;
    }

    public function addFacturaRecibo($dat){
    	$sql = "INSERT INTO recibo_factura (id_recibo, id_fact, monto_fact, saldo_fact) VALUES (";
    	$sql = $sql . $dat['id_recibo'].",".$dat['id_fact'].",".$dat['monto'].",".$dat['saldo'].")";

    	$result = $this->_DB->alteration_query($sql);

    	$estado = 2;
    	if($dat['saldo'] != 0)
    		$estado = 4; //saldo pendiente

    	$sql1 = "UPDATE factura SET estado_fact = ".$estado." WHERE id_fact = " . $dat['id_fact'];
    	$result = $this->_DB->alteration_query($sql1);

    	//actualizo las OR y los remitos
    	$sql2 = "SELECT or_y_remito_fact FROM factura WHERE id_fact = " . $dat['id_fact'];
    	$rs = $this->_DB->select_query($sql2);

    	foreach($rs as $row)
    	{
    		$arr = explode(' ',$row['or_y_remito_fact']);
    		foreach($arr as $or_rm)
    		{
    			$arr_1 = explode('-',$or_rm);
    			$sql3 = "";
    			if($arr_1[0] == 'R')
    			{
    				$sql3 = "UPDATE remito SET estado_remi = 4 WHERE id_remito = " . $arr_1[1];
    			}
    			if($arr_1[0] == 'OR')
    			{
    				$sql3 = "UPDATE orden_reparacion SET estado = 5 WHERE id_orden = " . $arr_1[1];
    			}
    			$this->_DB->alteration_query($sql3);
    		}
    	}
    }

    public function addCompraRecibo($dat){
    	$sql = "INSERT INTO recibo_factura (id_recibo, id_fact, monto_fact, saldo_fact, fact_contra_fact) VALUES (";
    	$sql = $sql . $dat['id_recibo'].",".$dat['id_compra'].",".$dat['monto'].",".$dat['saldo'].",1)";

    	$result = $this->_DB->alteration_query($sql);

    	$estado = 2;
    	if($dat['saldo'] != 0)
    		$estado = 4; //saldo pendiente

    	$sql1 = "UPDATE compra SET estado_compra = ".$estado." WHERE id_compra = " . $dat['id_compra'];
    	$result = $this->_DB->alteration_query($sql1);

    }

    public function updateRecibo($recibo) {

    	$sql = "";
        $sql="UPDATE recibo ";
        $sql = $sql . "SET id_cliente 		= '" . $recibo->get_id_cliente() 		. "',";
        $sql = $sql . " fecemi_recibo 	= '" . $recibo->get_fecemi_recibo() . "',";
        $sql = $sql . " num_recibo 		= '" . $recibo->get_num_recibo() 	. "',";
        $sql = $sql . " total_recibo 	= '" . $recibo->get_total_recibo() 	. "',";
        $sql = $sql . " obs_recibo 		= '" . $recibo->get_obs_recibo() 	. "',";
        $sql = $sql . " estado_recibo 	= '" . $recibo->get_estado_recibo() . "',";
        $sql = $sql . " efectivo_recibo 	= '" . $recibo->get_efectivo_recibo(). "', ";
        $sql = $sql . " id_responsable  = " . $recibo->get_id_responsable() ." ";
        $sql = $sql . "WHERE id_recibo 		= " . $recibo->get_id_recibo();

	    $result = $this->_DB->alteration_query($sql);

//        $result = $this->_DB->alteration_query("call sp_reciboupdate (" . $sql . ")");

        return $result;
    }

    public function deleteRecibo($id_recibo) {
        $sql = "DELETE FROM recibo WHERE id_recibo='" . $id_recibo . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

	public function deleteContenido($id_recibo){
		$sql = "delete from cheque where id_recibo = " . $id_recibo;
		$this->_DB->alteration_query($sql);
		$sql = "delete from recibo_retencion where id_recibo = ".$id_recibo;
		$this->_DB->alteration_query($sql);
		$sql = "delete from transferencia where id_recibo = ".$id_recibo;
		$this->_DB->alteration_query($sql);
		$sql = "delete from recibo_factura where id_recibo = ".$id_recibo;
		$this->_DB->alteration_query($sql);
	}

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showRecibo($id_recibo) {
        $recibo = new recibo();
        $sql = "SELECT * FROM recibo WHERE estado_recibo='1' AND  id_recibo=" . $id_recibo;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $recibo->set_id_recibo(		$row['id_recibo']		);
            $recibo->set_id_cliente(	$row['id_cliente']		);
            $recibo->set_obs_recibo(	$row['obs_recibo']		);
            $recibo->set_total_recibo(	$row['total_recibo']	);
            $recibo->set_fecemi_recibo(	$row['fecemi_recibo']	);
            $recibo->set_estado_recibo(	$row['estado_recibo']	);
            $recibo->set_efectivo_recibo($row['efectivo_recibo']);
        }

        return $recibo;
    }

    public function showReciboEdit($id_recibo) {
		$recibo = new recibo();
		$sql = "SELECT *, DATE_FORMAT(fecemi_recibo,'%d-%m-%Y') fecha_recibo
				FROM recibo
				LEFT JOIN persona on (recibo.id_cliente = persona.id_persona)
				WHERE id_recibo=" . $id_recibo;

		$result = $this->_DB->select_query($sql);
		$return = array();
		foreach($result as $row) {
			$return = $row;
		}
		$return['transferencias'] 	= array();
		$return['retenciones'] 		= array();
		$return['facturas'] 		= array();
		$return['cheques'] 			= array();
		$return['facturas_prov']	= array();

		//facturas
		$sql = "SELECT 	f.id_fact, f.num_fact, DATE_FORMAT(fecemi_fact, '%d-%m-%Y') AS fecha, rf.monto_fact, rf.saldo_fact
				FROM 	recibo_factura rf
				JOIN 	factura f USING(id_fact)
				WHERE	fact_contra_fact = 0
				AND		rf.id_recibo = " . $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['facturas'][] = $row;
		}
		//facturas del prveedor
		$sql = "SELECT 	c.id_compra as id_fact, c.guiacod_compra as num_fact, DATE_FORMAT(fec_compra, '%d-%m-%Y') AS fecha, rf.monto_fact, rf.saldo_fact
				FROM 	recibo_factura rf
				JOIN 	compra c ON (rf.id_fact = c.id_compra)
				WHERE	fact_contra_fact = 1
				AND		rf.id_recibo = " . $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['facturas_prov'][] = $row;
		}

		//cheques
		$sql = "SELECT 	c.num_cheque, c.banco_cheque, DATE_FORMAT(c.fecpago_cheque,'%d-%m-%Y') as fecha, c.monto_cheque
				FROM 	cheque c
				WHERE	id_recibo = ". $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['cheques'][] = $row;
		}

		//retenciones
		$sql = "SELECT 	rc.numero, tr.nom_codRetAir AS tipo, rc.monto
				FROM 	recibo_retencion rc
				JOIN 	tiporetencion tr USING(id_tiporeten)
				WHERE	rc.id_recibo = ". $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['retenciones'][] = $row;
		}

		//transferencias
		$sql = "SELECT 	t.num_transferencia, t.monto
				FROM 	transferencia t
				WHERE	id_recibo = ". $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['transferencias'][] = $row;
		}

		return $return;
    }

    public function showReciboProvd($id_recibo)
    {
    	$recibo = new recibo();
		$sql = "SELECT *, DATE_FORMAT(fecemi_recibo,'%d-%m-%Y') fecha_recibo
				FROM recibo
				LEFT JOIN persona on (recibo.id_provd = persona.id_persona)
				WHERE id_recibo=" . $id_recibo;

		$result = $this->_DB->select_query($sql);
		$return = array();
		foreach($result as $row) {
			$return = $row;
		}
		$return['retenciones'] 		= array();
		$return['facturas'] 		= array();
		$return['cheques'] 			= array();
		$return['transferencias']	= array();

		//facturas
		$sql = "SELECT 	c.id_compra, c.guiacod_compra, DATE_FORMAT(fec_compra, '%d-%m-%Y') AS fecha, rf.monto_fact, rf.saldo_fact
				FROM 	recibo_factura rf
				JOIN 	compra c ON(c.id_compra = rf.id_fact)
				WHERE	rf.id_recibo = " . $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['facturas'][] = $row;
		}

		//cheques
		$sql = "SELECT 	c.num_cheque, c.banco_cheque, DATE_FORMAT(c.fecpago_cheque,'%d-%m-%Y') as fecha, c.monto_cheque
				FROM 	cheque c
				WHERE	id_recibo_provd = ". $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['cheques'][] = $row;
		}

		//retenciones
		$sql = "SELECT 	rc.numero, tr.nom_codRetAir AS tipo, rc.monto
				FROM 	recibo_retencion rc
				JOIN 	tiporetencion tr USING(id_tiporeten)
				WHERE	rc.id_recibo = ". $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['retenciones'][] = $row;
		}

		//transferencias
		$sql = "SELECT 	t.num_transferencia, t.monto
				FROM 	transferencia t
				WHERE	id_recibo = ". $id_recibo;
		$result = $this->_DB->select_query($sql);
		foreach($result as $row)
		{
			$return['transferencias'][] = $row;
		}

		return $return;
    }


    public function getcheques($idr){
    	$sql = "SELECT id_cheque, num_cheque, monto_cheque, fecrec_cheque, fecpago_cheque, banco_cheque FROM cheque " .
    		   "WHERE id_recibo = "	 . $idr;
    }

    public function getFacturas($idr){

    }


    public function listRecibos($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM recibo WHERE fecemi_recibo>='" . $fecIni . "' AND fecemi_recibo <='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $recibo = new recibo();
            $recibo->set_id_recibo(		$row['id_recibo']		);
            $recibo->set_id_cliente(		$row['id_cliente']		);
            $recibo->set_obs_recibo(	$row['obs_recibo']		);
            $recibo->set_total_recibo(	$row['total_recibo']	);
            $recibo->set_fecemi_recibo(	$row['fecemi_recibo']	);
            $recibo->set_estado_recibo(	$row['estado_recibo']	);
            $data[] = $recibo;
        }

        return $data;
    }

	public function listRecibosCliente($idcliente) {
        $data = array();
        $sql = "SELECT 	r.*, DATE_FORMAT(r.fecemi_recibo,'%d-%m-%Y') fecemi_recibo, v.nom_persona , ve.dominio
				FROM 	recibo r
				LEFT JOIN persona v
					ON (r.id_vendedor = v.id_persona)
				LEFT JOIN `vehiculo` ve
					ON (ve.`id_vehiculo` = r.`id_vehiculo`)
				WHERE 	id_cliente = " . $idcliente . "
				AND		estado_recibo = 1";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $recibo = new recibo();
            $recibo->set_id_recibo(		$row['id_recibo']	);
            $recibo->set_id_idcliente(	$row['id_cliente']	);
		    $recibo->set_obs_recibo(	$row['obs_recibo']	);
            $recibo->set_total_recibo(	$row['total_recibo']	);
            $recibo->set_fecemi_recibo(	$row['fecemi_recibo']	);
            $recibo->set_estado_recibo(	$row['estado_recibo']	);
            $data[] = $recibo;
        }

        return $data;
    }


    public function listJsonRecibos($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM recibo WHERE fecemi_recibo>='" . $fecIni . "' AND fecemi_recibo <='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {

            $data[] = array("id_recibo"	=> $row['id_recibo']		, "obs_recibo"	=> $row['obs_recibo'],
            				"total_recibo"=> $row['total_recibo']	, "fecemi_recibo"	=> $row['fecemi_recibo']);
        }

        return json_encode($data);
    }

    public function ListaJsonFactDetalleProducto($id_recibo){
        $data = array();
        $sql = "SELECT * FROM v_recibo_detalle WHERE id_recibo=".$id_recibo;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[]=$row;//meto todos
        }
        return json_encode($data);
    }

	public function listJsonReciboDetalle($id_recibo){
		$data = array();
        $sql = "SELECT * FROM v_recibo_detalle WHERE id_recibo=".$id_recibo;
        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]=array(	"id_recibo"		=>$row['id_recibo']		,	"nom_producto"	=>$row['nom_producto'],
							"canti_detrecibo"	=>$row['canti_detrecibo']	,	"precio_detrecibo"=>$row['precio_detrecibo']);
        }
        return json_encode($data);

   }

	public function listJsonReciboDetalleFactura($id_recibo){
		$data = array();
        $sql = "SELECT * FROM v_recibo_detalle WHERE id_recibo=".$id_recibo;
        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]=array(	"id_recibo"		=>$row['id_recibo']		,	"nom_producto"	=>$row['nom_producto'],
							"canti_detrecibo"	=>$row['canti_detrecibo']	,	"precio_detrecibo"=>$row['precio_detrecibo'],
							"id_tipoiva"	=>$row['id_tipoiva']	,	"subtotal"		=>$row['precio_detrecibo'] * $row['canti_detrecibo'],
							"id_producto"	=>$row['id_producto']	,	"descrip_producto"	=>$row['descrip_producto']);
        }
        return json_encode($data);
	}

	public function getProximoRecibo() {
		$sql = "SELECT  MAX(id_recibo) + 1 AS id FROM recibo";
		$result = $this->_DB->select_query($sql);
		return $result[0][0];
	}

	public function getProximoNumeroReciboLocal() {
		$sql = "SELECT  MAX(num_recibo) + 1 AS numero FROM v_recibo WHERE tipo_recibo = 2";
		$result = $this->_DB->select_query($sql);
		return $result[0][0];
	}

	public function getProximoNumeroReciboProveedor() {
		$sql = "SELECT  MAX(num_recibo) + 1 AS numero FROM recibo WHERE tipo_recibo = 3";
		$result = $this->_DB->select_query($sql);
		return $result[0][0];
	}

    public function checkNumeroReciboManual($num)
    {
        $sql = "SELECT id_recibo FROM recibo WHERE  num_recibo = '".$num."' and tipo_recibo = 1";
        $result = $this->_DB->select_query($sql);
		return $result[0][0];
    }

}
?>
