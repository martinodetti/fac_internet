<?php

class cheque {

    public $_DB;
    public $_id_cheque;
	public $_id_cliente;
	public $_id_recibo;
    public $_id_recibo_provd;
    public $_num_cheque;
    public $_monto_cheque;
    public $_fecrec_cheque;
    public $_fecpago_cheque;
    public $_banco_cheque;
    public $_propietario;
    public $_cuit_propietario;
    public $_obs_cheque;
    public $_num_recibo;
    public $_estado_cheque;

    public $_movimientos;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function cheque($id_cheque,  $id_cliente, $id_recibo, $num_cheque, $monto_cheque, $fecrec_cheque, $fecpago_cheque, $banco_cheque, $propietario, $cuit_propietario, $num_recibo, $estado_cheque) {

        $this->_id_cheque 			= $id_cheque;
        $this->_id_recibo		 	= $id_recibo;
		$this->_id_cliente			= $id_cliente;
    	$this->_num_cheque			= $num_cheque;
        $this->_monto_cheque		= $monto_cheque;
        $this->_fecrec_cheque		= $fecrec_cheque;
        $this->_fecpago_cheque		= $fecpago_cheque;
		$this->_banco_cheque		= $banco_cheque;
		$this->_propietario			= $propietario;
		$this->_cuit_propietario	= $cuit_propietario;
		$this->_num_recibo 			= $num_recibo;
        $this->_estado_cheque 		= $estado_cheque;
    }

    public function get_id_cheque() {
        return $this->_id_cheque;
    }

    public function set_id_cheque($id_cheque) {

        $this->_id_cheque = $id_cheque;
    }

	public function get_id_cliente() {

        return $this->_id_cliente;
    }

    public function set_id_cliente($id_cliente) {

        $this->_id_cliente = $id_cliente;
    }

    public function get_id_recibo() {

        return $this->_id_recibo;
    }

    public function get_id_recibo_provd() {

        return $this->_id_recibo_provd;
    }

    public function set_id_recibo($id_recibo) {

        $this->_id_recibo = $id_recibo;
    }

    public function set_id_recibo_provd($id_recibo_provd) {

        $this->_id_recibo_provd = $id_recibo_provd;
    }

    public function get_num_cheque() {

        return $this->_num_cheque;
    }

    public function set_num_cheque($num_cheque) {

        $this->_num_cheque = $num_cheque;
    }

    public function get_monto_cheque() {

        return $this->_monto_cheque;
    }

    public function set_monto_cheque($monto_cheque) {

        $this->_monto_cheque = $monto_cheque;
    }

    public function get_fecrec_cheque() {

        return $this->_fecrec_cheque;
    }

    public function set_fecrec_cheque($fecrec_cheque) {

        $this->_fecrec_cheque = $fecrec_cheque;
    }

    public function get_fecpago_cheque() {

        return $this->_fecpago_cheque;
    }

    public function set_fecpago_cheque($fecpago_cheque) {

        $this->_fecpago_cheque = $fecpago_cheque;
    }

    public function get_banco_cheque() {

        return $this->_banco_cheque;
    }

    public function set_banco_cheque($banco_cheque) {

        $this->_banco_cheque = $banco_cheque;
    }

    public function get_propietario() {

        return $this->_propietario;
    }

    public function set_propietario($propietario) {

        $this->_propietario = $propietario;
    }

    public function get_cuit_propietario() {

        return $this->_cuit_propietario;
    }

    public function set_cuit_propietario($cuit_propietario) {

        $this->_cuit_propietario = $cuit_propietario;
    }

    public function get_num_recibo_cheque() {

        return $this->_num_recibo_cheque;
    }

    public function set_num_recibo($num_recibo) {

        $this->_num_recibo = $num_recibo;
    }

    public function get_estado_cheque() {

        return $this->_estado_cheque;
    }

    public function set_estado_cheque($estado_cheque) {

        $this->_estado_cheque = $estado_cheque;
    }

    public function get_obs_cheque() {

        return $this->_obs_cheque;
    }

    public function set_obs_cheque($obs_cheque) {

        $this->_obs_cheque = $obs_cheque;
    }

    public function addCheque($cheque) {
        $sql="";
        $sql = "INSERT INTO cheque (id_cliente, id_recibo, num_cheque, monto_cheque, fecrec_cheque, fecpago_cheque, banco_cheque, propietario, cuit_propietario, estado_cheque, obs_cheque) VALUE (";
		$sql = $sql . "'" . $cheque->get_id_cliente() . "',";
        $sql = $sql . "'" . $cheque->get_id_recibo() . "',";
		$sql = $sql . "'" . $cheque->get_num_cheque() . "',";
		$sql = $sql . "'" . $cheque->get_monto_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_fecrec_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_fecpago_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_banco_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_propietario() . "',";
        $sql = $sql . "'" . $cheque->get_cuit_propietario() . "',";
        $sql = $sql . "'" . $cheque->get_estado_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_obs_cheque() . "'";
        $sql = $sql . ");";
        $sql = $sql . "SELECT LAST_INSERT_ID();";

        $result = $this->_DB->select_query($sql);

//        $result = $this->_DB->select_query("call sp_cheque_insert (" . $sql . ")");

        return $result;
    }

    public function addChequePropio($cheque) {
        $sql="";
        $sql = "INSERT INTO cheque ( id_recibo_provd, num_cheque, monto_cheque, fecrec_cheque, fecpago_cheque, banco_cheque, propietario, cuit_propietario, estado_cheque, obs_cheque) VALUE (";
        $sql = $sql . "'" . $cheque->get_id_recibo_provd() . "',";
		$sql = $sql . "'" . $cheque->get_num_cheque() . "',";
		$sql = $sql . "'" . $cheque->get_monto_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_fecrec_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_fecpago_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_banco_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_propietario() . "',";
        $sql = $sql . "'" . $cheque->get_cuit_propietario() . "',";
        $sql = $sql . "'" . $cheque->get_estado_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_obs_cheque() . "'";
        $sql = $sql . ");";
        $sql = $sql . "SELECT LAST_INSERT_ID();";

        $result = $this->_DB->select_query($sql);

//        $result = $this->_DB->select_query("call sp_cheque_insert (" . $sql . ")");

        return $result;
    }

    public function updatecheque($cheque) {
        $sql="";
        $sql = $sql . "'" . $cheque->get_id_cheque() . "',";
		$sql = $sql . "'" . $cheque->get_id_cliente() . "',";
        $sql = $sql . "'" . $cheque->get_id_pago() . "',";
		$sql = $sql . "'" . $cheque->get_num_cheque() . "',";
		$sql = $sql . "'" . $cheque->get_monto_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_fecrec_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_fecpago_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_banco_cheque() . "',";
        $sql = $sql . "'" . $cheque->get_propietario() . "',";
        $sql = $sql . "'" . $cheque->get_cuit_propietario() . "',";
        $sql = $sql . "'" . $cheque->get_num_recibo() . "',";
        $sql = $sql . "'" . $cheque->get_estado_cheque() . "'";

        $this->_DB->alteration_query("call sp_cheque_update (" . $sql . ")");

        return $cheque->get_id_cheque();
    }

    public function deletecheque($id_cheque) {
        $sql = "DELETE FROM cheque WHERE id_cheque='" . $id_cheque . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showCheque($id_cheque) {
        $cheque = new cheque();
        $sql = "SELECT * FROM v_cheque WHERE id_cheque=" . $id_cheque;

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $cheque->set_id_cheque(			$row['id_cheque']		);
            $cheque->set_id_cliente(		$row['id_cliente']		);
//            $cheque->set_id_recibo(			$row['id_pago']			);
            $cheque->set_num_cheque(		$row['num_cheque']		);
            $cheque->set_fecrec_cheque(		$row['fecrec_cheque']	);
            $cheque->set_fecpago_cheque(	$row['fecpago_cheque']	);
            $cheque->set_monto_cheque(		$row['monto_cheque']	);
            $cheque->set_banco_cheque(		$row['banco_cheque']	);
            $cheque->set_propietario(		$row['propietario']		);
            $cheque->set_cuit_propietario(	$row['cuit_propietario']);
            $cheque->set_num_recibo(		$row['num_recibo']		);
            $cheque->set_estado_cheque(		$row['estado_cheque']	);
            $cheque->set_obs_cheque(        $row['obs_cheque']      );
	    $cheque->_cliente = $row['nom_persona'];
	    $cheque->_proveedor = $row['nom_proveedor'];
	    $cheque->_id_provd = $row['id_provd'];

//            $cheque->_movimientos = $this->get_movimientos($id_cheque);
        }
        return $cheque;
    }

    public function get_movimientos($idc){
    	$sql = "SELECT *, date_format(fec_movicheque,'%d-%m-%Y') fec_movicheque FROM movimiento_cheque WHERE id_cheque = " . $idc;
    	$result = $this->_DB->select_query($sql);

    	return $result;
    }

    public function getChequesDisponibles()
    {
    	$sql = "SELECT id_cheque, num_cheque, monto_cheque, date_format(fecpago_cheque,'%d-%m-%Y') fecpago_cheque, banco_cheque, propietario, nom_persona as cliente
    			FROM cheque LEFT JOIN persona on (cheque.id_cliente = persona.id_persona)
    			WHERE estado_cheque = 1";

    	$rs = $this->_DB->select_query($sql);

    	return $rs;
    }

    public function cambiarEstado($id_cheque = 0, $estado = 0)
    {
    	if($id_cheque != 0 && $estado != 0)
    	{
    		$sql = "UPDATE cheque SET estado_cheque = " . $estado . " WHERE id_cheque = " . $id_cheque;
    		$rs = $this->_DB->alteration_query($sql);
    	}
	}

	public function setChequePago($id_cheque, $id_recibo)
	{
		$sql = "UPDATE cheque SET id_recibo_provd = " . $id_recibo . " WHERE id_cheque = " . $id_cheque;
		$rs = $this->_DB->alteration_query($sql);
	}

	public function depositar($idcheque, $obs)
	{
        $sql = "UPDATE cheque SET estado_cheque = 2, obs_cheque = '" . $obs . "'  where id_cheque = ".$idcheque;
		$rs = $this->_DB->alteration_query($sql);
    }
    
    public function entregar($idcheque, $obs)
	{
		$sql = "UPDATE cheque SET estado_cheque = 3, obs_cheque = '" . $obs . "' where id_cheque = ".$idcheque;
		$rs = $this->_DB->alteration_query($sql);
    }

    public function existe($numero, $banco)
    {
        $sql = "SELECT id_cheque from cheque where num_cheque = '" . $numero . "' and banco_cheque = '" . $banco . "'";
        $rs = $this->_DB->select_query($sql);
        return $rs;
    }


}
?>
