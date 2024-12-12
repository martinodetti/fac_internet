<?php

class persona {

    public $_DB;
    public $_id_persona;
    public $_id_tipoper;
    public $_id_ciudad;
    public $_id_sexo;
    public $_id_civil;
    public $_nom_persona;
    public $_ape_persona;
    public $_ruc_persona;
    public $_direc_persona;
    public $_telf_persona;
    public $_telf_persona_2;
    public $_cel_persona;
    public $_email_persona;
    public $_web_persona;
    public $_obs_persona;
    public $_fec_persona;
    public $_estado_persona;
    public $_clave_persona;
    public $_id_condiva;
    public $_tiene_ctacte;
    public $_limite_ctacte;
    public $_id_listaprecio;
    public $_ganancia;
    public $_factura_credito;

    public function __construct() {
        $this->_DB = new Database();

    }

    public function persona($id_persona, $id_tipoper, $id_ciudad, $id_sexo, $id_civil, $nom_persona, $ape_persona, $ruc_persona, $direc_persona, $telf_persona, $cel_persona, $email_persona, $web_persona, $obs_persona, $fec_persona, $estado_persona, $clave_persona, $tiene_ctacte, $id_condiva, $telf_persona_2, $ganancia, $factura_credito) {

        $this->_id_persona = $id_persona;

        $this->_id_tipoper = $id_tipoper;

        $this->_id_ciudad = $id_ciudad;

        $this->_id_sexo = $id_sexo;

        $this->_id_civil = $id_civil;

        $this->_nom_persona = $nom_persona;

        $this->_ape_persona = $ape_persona;

        $this->_ruc_persona = $ruc_persona;

        $this->_direc_persona = $direc_persona;

        $this->_telf_persona = $telf_persona;

        $this->_telf_persona_2 = $telf_persona_2;

        $this->_cel_persona = $cel_persona;

        $this->_email_persona = $email_persona;

        $this->_web_persona = $web_persona;

        $this->_obs_persona = $obs_persona;

        $this->_fec_persona = $fec_persona;

        $this->_estado_persona = $estado_persona;

        $this->_clave_persona = $clave_persona;

        $this->_tiene_ctacte = $tiene_ctacte;

        $this->_id_condiva  = $id_condiva;

        $this->_ganancia = $ganancia;

        $this->_factura_credito = $factura_credito;
    }

    public function get_id_persona() {

        return $this->_id_persona;
    }

    public function set_id_persona($id_persona) {

        $this->_id_persona = $id_persona;
    }

    public function get_id_tipoper() {

        return $this->_id_tipoper;
    }

    public function set_id_tipoper($id_tipoper) {

        $this->_id_tipoper = $id_tipoper;
    }

    public function get_id_ciudad() {

        return $this->_id_ciudad;
    }

    public function set_id_ciudad($id_ciudad) {

        $this->_id_ciudad = $id_ciudad;
    }

    public function get_id_sexo() {

        return $this->_id_sexo;
    }

    public function set_id_sexo($id_sexo) {

        $this->_id_sexo = $id_sexo;
    }

    public function get_id_civil() {

        return $this->_id_civil;
    }

    public function set_id_civil($id_civil) {

        $this->_id_civil = $id_civil;
    }

    public function get_nom_persona() {

        return $this->_nom_persona;
    }

    public function set_nom_persona($nom_persona) {

        $this->_nom_persona = $nom_persona;
    }

    public function get_ape_persona() {

        return $this->_ape_persona;
    }

    public function set_ape_persona($ape_persona) {

        $this->_ape_persona = $ape_persona;
    }

    public function get_ruc_persona() {

        return $this->_ruc_persona;
    }

    public function set_ruc_persona($ruc_persona) {

        $this->_ruc_persona = $ruc_persona;
    }

    public function get_direc_persona() {

        return $this->_direc_persona;
    }

    public function set_direc_persona($direc_persona) {

        $this->_direc_persona = $direc_persona;
    }

    public function get_telf_persona() {

        return $this->_telf_persona;
    }

    public function set_telf_persona($telf_persona) {

        $this->_telf_persona = $telf_persona;
    }

    public function get_telf_persona_2() {

        return $this->_telf_persona_2;
    }

    public function set_telf_persona_2($telf_persona_2) {

        $this->_telf_persona_2 = $telf_persona_2;
    }

    public function get_cel_persona() {

        return $this->_cel_persona;
    }

    public function set_cel_persona($cel_persona) {

        $this->_cel_persona = $cel_persona;
    }

    public function get_email_persona() {

        return $this->_email_persona;
    }

    public function set_email_persona($email_persona) {

        $this->_email_persona = $email_persona;
    }

    public function get_web_persona() {

        return $this->_web_persona;
    }

    public function set_web_persona($web_persona) {

        $this->_web_persona = $web_persona;
    }

    public function get_obs_persona() {

        return $this->_obs_persona;
    }

    public function set_obs_persona($obs_persona) {

        $this->_obs_persona = $obs_persona;
    }

    public function get_fec_persona() {

        return $this->_fec_persona;
    }

    public function set_fec_persona($fec_persona) {

        $this->_fec_persona = $fec_persona;
    }

    public function get_estado_persona() {

        return $this->_estado_persona;
    }

    public function set_estado_persona($estado_persona) {

        $this->_estado_persona = $estado_persona;
    }

    public function get_clave_persona() {

        return $this->_clave_persona;
    }

    public function set_clave_persona($clave_persona) {

        $this->_clave_persona = $clave_persona;
    }

    public function get_id_condiva() {

        return $this->_id_condiva;
    }

    public function set_id_condiva($id_condiva) {

        $this->_id_condiva = $id_condiva;
    }

    public function get_tiene_ctacte() {

        return $this->_tiene_ctacte;
    }


    public function set_tiene_ctacte($tiene_ctacte) {

        $this->_tiene_ctacte = $tiene_ctacte;
    }

    public function get_limite_ctacte() {

        return $this->_limite_ctacte;
    }


    public function set_limite_ctacte($limite_ctacte) {

        $this->_limite_ctacte = $limite_ctacte;
    }

    public function get_id_listaprecio() {

        return $this->_id_listaprecio;
    }

    public function set_id_listaprecio($id_listaprecio) {

        $this->_id_listaprecio = $id_listaprecio;
    }

    public function get_ganancia() {

        return $this->_ganancia;
    }

    public function set_ganancia($ganancia) {

        $this->_ganancia = $ganancia;
    }

    public function get_factura_credito() {

        return $this->_factura_credito;
    }

    public function set_factura_credito($factura_credito) {

        $this->_factura_credito = $factura_credito;
    }

    public function addPersona($persona) {

        $sql="";

        $sql = $sql . "'" . $persona->get_id_tipoper() . "',";

        $sql = $sql . "'" . $persona->get_id_ciudad() . "',";

        $sql = $sql . "'" . $persona->get_id_sexo() . "',";

        $sql = $sql . "'" . $persona->get_id_civil() . "',";

        $sql = $sql . "'" . $persona->get_nom_persona() . "',";

        $sql = $sql . "'" . $persona->get_ape_persona() . "',";

        $sql = $sql . "'" . $persona->get_ruc_persona() . "',";

        $sql = $sql . "'" . $persona->get_direc_persona() . "',";

        $sql = $sql . "'" . $persona->get_telf_persona() . "',";

        $sql = $sql . "'" . $persona->get_telf_persona_2() . "',";

        $sql = $sql . "'" . $persona->get_cel_persona() . "',";

        $sql = $sql . "'" . $persona->get_email_persona() . "',";

        $sql = $sql . "'" . $persona->get_web_persona() . "',";

        $sql = $sql . "'" . $persona->get_obs_persona() . "',";

        $sql = $sql . "'" . $persona->get_fec_persona() . "',";

        $sql = $sql . "'" . $persona->get_estado_persona() . "',";

        $sql = $sql . "'" . $persona->get_clave_persona() . "',";

        $sql = $sql . "'" . $persona->get_id_condiva() . "',";

        $sql = $sql . "'" . $persona->get_tiene_ctacte() . "',";

        $sql = $sql . "'" . $persona->get_id_listaprecio() . "',";

        $sql = $sql . ""  . $persona->get_ganancia() . ",";

        $sql = $sql . ""  . $persona->get_limite_ctacte() . ",";

        $sql = $sql . ""  . $persona->get_factura_credito() . "";

        $result = $this->_DB->select_query("call sp_personainsert (" . $sql . ")");

        return $result;
    }

    public function updatePersona($persona) {

        $sql="";

        $sql = $sql . "'" . $persona->get_id_persona() . "',";

        $sql = $sql . "'" . $persona->get_id_tipoper() . "',";

        $sql = $sql . "'" . $persona->get_id_ciudad() . "',";

        $sql = $sql . "'" . $persona->get_id_sexo() . "',";

        $sql = $sql . "'" . $persona->get_id_civil() . "',";

        $sql = $sql . "'" . $persona->get_nom_persona() . "',";

        $sql = $sql . "'" . $persona->get_ape_persona() . "',";

        $sql = $sql . "'" . $persona->get_ruc_persona() . "',";

        $sql = $sql . "'" . $persona->get_direc_persona() . "',";

        $sql = $sql . "'" . $persona->get_telf_persona() . "',";

        $sql = $sql . "'" . $persona->get_telf_persona_2() . "',";

        $sql = $sql . "'" . $persona->get_cel_persona() . "',";

        $sql = $sql . "'" . $persona->get_email_persona() . "',";

        $sql = $sql . "'" . $persona->get_web_persona() . "',";

        $sql = $sql . "'" . $persona->get_obs_persona() . "',";

        $sql = $sql . "'" . $persona->get_fec_persona() . "',";

        $sql = $sql . "'" . $persona->get_estado_persona() . "',";

        $sql = $sql . "'" . $persona->get_clave_persona() . "',";

        $sql = $sql . "'" . $persona->get_id_condiva() . "',";

        $sql = $sql . "'" . $persona->get_tiene_ctacte() . "',";

        $sql = $sql . "'" . $persona->get_id_listaprecio() . "',";

        $sql = $sql . ""  . $persona->get_ganancia() . ",";

        $sql = $sql . ""  . $persona->get_limite_ctacte() . ",";

        $sql = $sql . ""  . $persona->get_factura_credito() . "";

        $result = $this->_DB->alteration_query("call sp_personaupdate (" . $sql . ")");

        return $result;
    }

	public function asociarClienteProveedor($idcli, $idprov)
	{
		$sql = "UPDATE persona SET id_cliente_proveedor = ". $idcli ." WHERE id_persona = " . $idprov;
		$this->_DB->alteration_query($sql);
	}

    public function deletePersona($id_persona) {

        $sql = "DELETE FROM persona WHERE id_persona='" . $id_persona . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    /**
     * Retorna id_persona si existe.0 si no existe.
     * @param type $user
     * @param type $clave
     * @return type
     */
    public function loginPersona($cedula, $clave) {
        $sql = "";
        $msg = 0;
        $sql = "SELECT *  FROM persona WHERE ruc_persona='" . $cedula . "' AND clave_persona='" . $clave . "'";
        $result = $this->_DB->select_query($sql);
//si tiene almenos un registro.if(count($result)>=1){
        foreach ($result as $row) {
            $msg = $row['id_persona'];
        }
        if (count($result) < 1)
            $msg = 0;

        return $msg;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showPersona($id_persona) {

        $persona = new persona();
        if($id_persona != '')
		{
       		$sql = "SELECT * FROM persona WHERE id_persona=" . $id_persona;
		    $result = $this->_DB->select_query($sql);
		    foreach ($result as $row) {
		        $persona->set_id_persona($row['id_persona']);
		        $persona->set_id_tipoper($row['id_tipoper']);
		        $persona->set_id_ciudad($row['id_ciudad']);
		        $persona->set_id_sexo($row['id_sexo']);
		        $persona->set_id_civil($row['id_civil']);
		        $persona->set_nom_persona($row['nom_persona']);
		        $persona->set_ape_persona($row['ape_persona']);
		        $persona->set_ruc_persona($row['ruc_persona']);
		        $persona->set_direc_persona($row['direc_persona']);
		        $persona->set_telf_persona($row['telf_persona']);
				$persona->set_telf_persona_2($row['telf_persona_2']);
		        $persona->set_cel_persona($row['cel_persona']);
		        $persona->set_email_persona($row['email_persona']);
		        $persona->set_web_persona($row['web_persona']);
		        $persona->set_obs_persona($row['obs_persona']);
		        $persona->set_fec_persona($row['fec_persona']);
		        $persona->set_estado_persona($row['estado_persona']);
		        $persona->set_clave_persona($row['clave_persona']);
		        $persona->set_id_condiva($row['id_condiva']);
		        $persona->set_tiene_ctacte($row['tiene_ctacte']);
		        $persona->set_id_listaprecio($row['id_listaprecio']);
		        $persona->set_ganancia($row['ganancia']);
                $persona->set_limite_ctacte($row['limite_ctacte']);
                $persona->set_factura_credito($row['factura_credito']);
                $persona->_saldo = $row['saldo'];
				$persona->_id_cliente_proveedor = $row['id_cliente_proveedor'];
		    }
	   	}

        return $persona;
    }

    public function showpersonaJson($id_persona)
    {
    	$persona = new persona();
    	$persona = $persona->showPersona($id_persona);

    	$per = array(	'id_persona' => $persona->_id_persona, 'nom_persona' => $persona->_nom_persona,
    					'ape_persona' => $persona->_ape_persona,'id_condiva' => $persona->_id_condiva,
    					'tiene_ctacte' => $persona->_tiene_ctacte);

    	return json_encode($per);
    }

    /**
     *Listo proveeores por razon social
     * @param type $RazonSocial
     * @return persona
     */
    public function listPersonasPorRazon($RazonSocial) {
        $data = array();
        $sql = "SELECT * FROM persona WHERE id_tipoper=3 AND nom_persona like '".$RazonSocial."%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $persona = new persona();
            $persona->set_id_persona($row['id_persona']);
            $persona->set_id_tipoper($row['id_tipoper']);
            $persona->set_id_ciudad($row['id_ciudad']);
            $persona->set_id_sexo($row['id_sexo']);
            $persona->set_id_civil($row['id_civil']);
            $persona->set_nom_persona($row['nom_persona']);
            $persona->set_ape_persona($row['ape_persona']);
            $persona->set_ruc_persona($row['ruc_persona']);
            $persona->set_direc_persona($row['direc_persona']);
            $persona->set_telf_persona($row['telf_persona']);
            $persona->set_cel_persona($row['cel_persona']);
            $persona->set_email_persona($row['email_persona']);
            $persona->set_web_persona($row['web_persona']);
            $persona->set_obs_persona($row['obs_persona']);
            $persona->set_fec_persona($row['fec_persona']);
            $persona->set_estado_persona($row['estado_persona']);
            $persona->set_clave_persona($row['clave_persona']);
            $persona->set_id_condiva($row['id_condiva']);
            $persona->set_tiene_ctacte($row['tiene_ctacte']);

            $data[] = $persona;
        }

        return $data;
    }

    /**
     *
     * @param type $Apellido
     * @return array_trabajador
     */
   public function listTrabajadorPorApe($Apellido) {
        $data = array();
        $sql = "SELECT * FROM persona WHERE id_tipoper IN(1,4) AND (ape_persona like '".$Apellido."%' OR nom_persona like '".$Apellido."%')";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $persona = new persona();
            $persona->set_id_persona($row['id_persona']);
            $persona->set_id_tipoper($row['id_tipoper']);
            $persona->set_id_ciudad($row['id_ciudad']);
            $persona->set_id_sexo($row['id_sexo']);
            $persona->set_id_civil($row['id_civil']);
            $persona->set_nom_persona($row['nom_persona']);
            $persona->set_ape_persona($row['ape_persona']);
            $persona->set_ruc_persona($row['ruc_persona']);
            $persona->set_direc_persona($row['direc_persona']);
            $persona->set_telf_persona($row['telf_persona']);
            $persona->set_cel_persona($row['cel_persona']);
            $persona->set_email_persona($row['email_persona']);
            $persona->set_web_persona($row['web_persona']);
            $persona->set_obs_persona($row['obs_persona']);
            $persona->set_fec_persona($row['fec_persona']);
            $persona->set_estado_persona($row['estado_persona']);
            $persona->set_clave_persona($row['clave_persona']);

            $data[] = $persona;
        }

        return $data;
    }

    /**
     *Devuelve un array de cliente
     * @param type $Apellido
     * @return array_cliente
     */
     public function listClientePorApe($Apellido) {
        $data = array();
        $sql = "SELECT * FROM persona WHERE id_tipoper=2 AND (ape_persona like '".$Apellido."%' OR nom_persona like '%".$Apellido."%')";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $persona = new persona();
            $persona->set_id_persona($row['id_persona']);
            $persona->set_id_tipoper($row['id_tipoper']);
            $persona->set_id_ciudad($row['id_ciudad']);
            $persona->set_id_sexo($row['id_sexo']);
            $persona->set_id_civil($row['id_civil']);
            $persona->set_nom_persona($row['nom_persona']);
            $persona->set_ape_persona($row['ape_persona']);
            $persona->set_ruc_persona($row['ruc_persona']);
            $persona->set_direc_persona($row['direc_persona']);
            $persona->set_telf_persona($row['telf_persona']);
            $persona->set_cel_persona($row['cel_persona']);
            $persona->set_email_persona($row['email_persona']);
            $persona->set_web_persona($row['web_persona']);
            $persona->set_obs_persona($row['obs_persona']);
            $persona->set_fec_persona($row['fec_persona']);
            $persona->set_estado_persona($row['estado_persona']);
            $persona->set_clave_persona($row['clave_persona']);

            $data[] = $persona;
        }

        return $data;
    }


    /**
     * cmb losproveedores cuyo tipoper=3
     */
    public function ComboProveedor() {
        $data = array();
        $sql = "SELECT *  FROM persona WHERE id_tipoper=3 ORDER BY nom_persona";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $persona = new persona();
            $persona->set_id_persona($row['id_persona']);
            $persona->set_nom_persona($row['nom_persona']);
            $data[] = $persona;
        }
        return $data;
    }

    public function CargarJsonProveedorNombre($razonSocial){
        $data = array();
        $sql = "SELECT *  FROM persona WHERE id_tipoper=3 AND nom_persona REGEXP '^$razonSocial'";
        $result = $this->_DB->select_query($sql);
         foreach ($result as $row) {
            $data[] = array("id" => $row["id_persona"],"nombre"=>$row["nom_persona"]);
        }
        $jsonData=json_encode($data);
        return $jsonData;
    }

	 public function CargarJsonClienteNombre($razonSocial){
        $data = array();
        $sql = "SELECT *  FROM persona WHERE id_tipoper=2 AND (nom_persona REGEXP '$razonSocial' OR `ape_persona` REGEXP '$razonSocial')";
        $result = $this->_DB->select_query($sql);
         foreach ($result as $row) {
            $data[] = array("id" => $row["id_persona"],"nombre"=>$row["nom_persona"] . '('.$row["ape_persona"].')');
        }
        $jsonData=json_encode($data);
        return $jsonData;
    }

	public function CargarJsonClienteNombreCtaCte($razonSocial){
        $data = array();
        $sql = "SELECT *  FROM persona WHERE id_tipoper=2 and tiene_ctacte = 1 AND (nom_persona REGEXP '$razonSocial' OR `ape_persona` REGEXP '$razonSocial')";
        $result = $this->_DB->select_query($sql);

		$data[]= array(	"id_cliente" 	=> 0 	,
						"nombre"		=> 'TODOS');
		foreach ($result as $row) {
            $data[] = array("id_cliente" => $row["id_persona"],"nombre"=>$row["nom_persona"] . '('.$row["ape_persona"].')');
        }

		$jsonData=json_encode($data);
        return $jsonData;
    }

    /**
     *Retorna un array de trabajador
     * @return persona
     */

    public function ComboTrabajador() {
        $data = array();
        $sql = "SELECT *  FROM persona WHERE id_tipoper=1";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $persona = new persona();
            $persona->set_id_persona($row['id_persona']);
            $persona->set_nom_persona($row['nom_persona']);
            $persona->set_ape_persona($row['ape_persona']);
            $data[] = $persona;
        }
        return $data;
    }
    /**
     *Muestra solo trabajdores menos administrador
     * @return persona
     */
    public function ComboTrabajador2() {
        $data = array();
        $sql = "SELECT *  FROM persona WHERE id_tipoper=1 and id_persona>1";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $persona = new persona();
            $persona->set_id_persona($row['id_persona']);
            $persona->set_nom_persona($row['nom_persona']);
            $persona->set_ape_persona($row['ape_persona']);
            $data[] = $persona;
        }
        return $data;
    }

    public function listTrabajadorPorApellidojson($apellido) {
        $data = array();
        $sql = "SELECT * FROM persona WHERE id_tipoper='1' and ape_persona like '%$apellido%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[]= array("id_persona" => $row["id_persona"],"nom_persona"=>$row["nom_persona"],
            "ape_persona"=>$row["ape_persona"], "ruc_persona"=>$row["ruc_persona"]);
        }
        return json_encode($data);
    }

   public function listClientePorApejson($CliApe, $pendientes = 0){
        $data = array();
/*		
		$sql = "SELECT 	persona.*, vcc.pendiente, COUNT(id_remito)+(select count(id_orden) from orden_reparacion where estado = 2 and id_cliente = id_persona) pendientes, nombre_listaprecio AS listaprecio, listaprecio.id_listaprecio, porcentaje_listaprecio
				FROM 	persona
				LEFT JOIN remito
					ON (id_persona = id_cliente AND estado_remi = 1)
				LEFT JOIN listaprecio
					USING(id_listaprecio)
                LEFT JOIN v_cliente_ctacte vcc
                    USING(id_persona)
				WHERE	persona.id_tipoper=2
				AND		persona.nom_persona like '%".$CliApe."%'
				GROUP BY
						persona.id_persona";
//			$sql = "SELECT * FROM persona WHERE id_tipoper=2 AND ape_persona like '".$CliApe."%' OR nom_persona like '".$CliApe."%'";
*/
		$sql = "SELECT 	persona.*,
						sum(if((factura.estado_fact = 1), factura.total_fact , recibo_factura.saldo_fact)) AS pendiente,
						COUNT(id_remito)+(select count(id_orden) from orden_reparacion where estado = 2 and id_cliente = id_persona) pendientes, 
						nombre_listaprecio AS listaprecio, listaprecio.id_listaprecio, porcentaje_listaprecio
				FROM 	persona
				LEFT JOIN remito
					ON (id_persona = id_cliente AND estado_remi = 1)
				LEFT JOIN listaprecio
					USING(id_listaprecio)
				LEFT JOIN factura
					ON (factura.id_cliente = persona.id_persona and factura.estado_fact in (1,4) and factura.forma_pago = 3)
				LEFT JOIN recibo_factura
					ON (recibo_factura.id_fact = factura.id_fact)
				WHERE	persona.id_tipoper=2
				AND		persona.nom_persona like '%".$CliApe."%'
				GROUP BY 
					persona.id_persona";


        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]= array(	"id_persona" 	=> $row["id_persona"]	, "nom_persona"	=> $row["nom_persona"],
				            "ape_persona"	=> $row["ape_persona"]	, "ruc_persona"	=> $row["ruc_persona"],
				            "pendientes"	=> $row["pendientes"]	, "listaprecio" => $row["listaprecio"],
				            "id_listaprecio"=> $row["id_listaprecio"],"porcentaje"	=> $row["porcentaje_listaprecio"],
				            "id_condiva"	=> $row["id_condiva"]   ,"tiene_ctacte" => $row["tiene_ctacte"],
                            "pendiente"     => $row["pendiente"]    ,"limite_ctacte"=> $row["limite_ctacte"]
			            );
        }
        return json_encode($data);
   }

   public function listClientePorApejsonConFxPendientes($CliApe){
        $data = array();
		$sql = "SELECT 	persona.*, COUNT(id_fact) pendientes
				FROM 	persona
				LEFT JOIN factura
					ON (id_persona = id_cliente AND estado_fact IN(1,4) AND	nota_credito = 0)
				WHERE	id_tipoper=2
				AND		(ape_persona like '%".$CliApe."%' OR nom_persona like '%".$CliApe."%' OR ruc_persona like '%".$CliApe."%')
				GROUP BY
						id_persona";
//			$sql = "SELECT * FROM persona WHERE id_tipoper=2 AND ape_persona like '".$CliApe."%' OR nom_persona like '".$CliApe."%'";

        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]= array(	"id_persona" 	=> $row["id_persona"]	, "nom_persona"	=> $row["nom_persona"],
				            "ape_persona"	=> $row["ape_persona"]	, "ruc_persona"	=> $row["ruc_persona"],
				            "pendientes"	=> $row["pendientes"]	, "saldo"		=> $row['saldo']
			            );
        }
        return json_encode($data);
   }

   public function listProveePorApejsonConFxPendientes($CliApe){
        $data = array();
		$sql = "SELECT 	persona.*, COUNT(id_compra) pendientes
				FROM 	persona
				LEFT JOIN compra
					ON (id_persona = id_provd AND estado_compra = 1 AND	nota_credito = 0)
				WHERE	id_tipoper = 3
				AND		(ape_persona like '%".$CliApe."%' OR nom_persona like '%".$CliApe."%')
				GROUP BY
						id_persona";
//			$sql = "SELECT * FROM persona WHERE id_tipoper=2 AND ape_persona like '".$CliApe."%' OR nom_persona like '".$CliApe."%'";

        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
            $data[]= array(	"id_persona" 	=> $row["id_persona"]	, "nom_persona"	=> $row["nom_persona"],
				            "ape_persona"	=> $row["ape_persona"]	, "ruc_persona"	=> $row["ruc_persona"],
				            "pendientes"	=> $row["pendientes"]	, "saldo"		=> $row["saldo"]
			            );
        }
        return json_encode($data);
   }


    public function updateTrabajadorClave($id,$clave){
      $sql = "UPDATE persona SET  clave_persona='".$clave."' WHERE id_persona=".$id;
        $result = $this->_DB->select_query($sql);
        return $result;
    }

    public function updateTrabajadorUsuario($id, $usuario){
    	$sql = "UPDATE persona SET ruc_persona= '".$usuario."' WHERE id_persona = ".$id;
    	$result = $this->_DB->select_query($sql);
    	return $result;
    }

    function listTrabajadorConAcceso($apellido){
        $data = array();
        $sql = "SELECT * FROM persona WHERE id_persona>1 AND id_tipoper='1' AND clave_persona!='' AND ape_persona like '%$apellido%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[]= array("id_persona" => $row["id_persona"],"nom_persona"=>$row["nom_persona"],
            "ape_persona"=>$row["ape_persona"], "ruc_persona"=>$row["ruc_persona"]);
        }
        return json_encode($data);
    }

    function listMecanicos(){
        $data = array();
        $sql = "SELECT * FROM persona WHERE id_tipoper = 4 AND estado_persona = 1 ";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $persona = new persona();
            $persona->set_id_persona($row['id_persona']);
            $persona->set_nom_persona($row['nom_persona']);
            $persona->set_ape_persona($row['ape_persona']);
            $data[] = $persona;
        }
        return $data;
    }

   	public function puedeEliminarProveedor($id_proveedor){
       $sql="SELECT (COUNT(id_proveedor)+1) AS total FROM producto_proveedor WHERE  id_proveedor=".$id_proveedor;
        $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
   }
   public function puedeEliminarCliente($id_cliente){
       $sql="SELECT (COUNT(id_cliente)+1) AS total FROM factura WHERE  id_cliente=".$id_cliente;
        $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
   }
   public function puedeEliminarTrabajador($id_trabajador){
       $sql="SELECT (COUNT(id_persona)+1) AS total FROM acceso_modulo WHERE  id_persona=".$id_trabajador;
        $result = $this->_DB->select_query($sql);
         $val=0;
         foreach($result as $row){
             $val=$row['total'];
         }
         $val=$val-1;
         return $val;
   }

  public function updateClienteDetalleIP($id_cliente,$ip,$estado){
      $sql="UPDATE detalle_cliente SET ip_detcliente='".$ip."',estado_conex='".$estado."' WHERE id_cliente=".$id_cliente;
      $result = $this->_DB->select_query($sql);
      return $result;
  }

  public function listClientePorVehiculojson($id_vehiculo, $CliApe){
         $data = array();
        $sql = "SELECT 	persona.*
				FROM 	persona JOIN vehiculo_cliente ON(vehiculo_cliente.id_cliente = persona.id_persona)
				WHERE 	id_tipoper=2 AND id_vehiculo = " . $id_vehiculo . "
				AND 	ape_persona like '".$CliApe."%'";

        $result = $this->_DB->select_query($sql);
		foreach ($result as $row) {
			$data[]= array(	"id_persona" 	=> $row["id_persona"] ,	"nom_persona"	=> $row["nom_persona"],
							"ape_persona"	=> $row["ape_persona"], "ruc_persona"	=> $row["ruc_persona"]);
        }
        return json_encode($data);
   }

	public function listClienteConVehiculojson($str) {
		$data = array();
		$sql = "(SELECT 	p.`nom_persona`, p.`ape_persona`, v.`dominio`, v.`modelo`, v.`id_vehiculo`, p.`id_persona` AS id_cliente, v.`marca`,
						v.observacion as obs_vehi, lp.porcentaje_listaprecio, p.tiene_ctacte, p.limite_ctacte, '' as saldo
				FROM 	persona p
				LEFT JOIN 	vehiculo_cliente vc
					ON (p.id_persona = vc.`id_cliente`)
				JOIN 	vehiculo v
					ON (v.`id_vehiculo` = vc.`id_vehiculo`)
				LEFT JOIN listaprecio lp
					USING(id_listaprecio)
				WHERE 	p.`id_tipoper` = 2
				AND (
					p.`nom_persona` 	LIKE '%".$str."%'
					OR v.`dominio` 		LIKE '%".$str."%'
				)
                )
                union
                (
                SELECT  p.`nom_persona`, p.`ape_persona`,  '' `dominio`,  '' `modelo`, '' `id_vehiculo`, p.`id_persona` AS id_cliente, '' `marca`,
                        '' as obs_vehi, lp.porcentaje_listaprecio,p.tiene_ctacte, p.limite_ctacte, '' as saldo
                FROM    persona p
                LEFT JOIN listaprecio lp
                    USING(id_listaprecio)
                WHERE   p.`id_tipoper` = 2
                AND (
                    p.`nom_persona`     LIKE '%".$str."%'
                )
                )
                ORDER by id_cliente, id_vehiculo";

		$result = $this->_DB->select_query($sql);
        $cli_anterior = "";
		foreach($result as $row) {
            //para poner un cliente sin vehiculo
/*
            if($cli_anterior != $row['id_cliente'])
            {
                $data[] = array("id_cliente"    => $row["id_cliente"],
                                "id_vehiculo"   => '',
                                "dominio"       => '',
                                "vehiculo"      => 'SIN VEHICULO',
                                "cliente"       => $row["nom_persona"] . ' - ' . $row['ape_persona'],
                                "obs_vehi"      => '',
                                "porcentaje"    => $row["porcentaje_listaprecio"] );
            }
            $cli_anterior = $row['id_cliente'];
*/
			$data[]= array(	"id_cliente" 	=> $row["id_cliente"] 	,
							"id_vehiculo"	=> $row["id_vehiculo"],
							"dominio"		=> $row["dominio"]		,
							"vehiculo"		=> $row["marca"] . ' ' . $row['modelo'],
							"cliente"		=> $row["nom_persona"] . ' - ' . $row['ape_persona'],
							"obs_vehi"		=> $row["obs_vehi"],
							"porcentaje"	=> $row["porcentaje_listaprecio"],
                            "tiene_ctacte"  => $row["tiene_ctacte"],
                            "limite_ctacte" => $row["limite_ctacte"],
                            "saldo"         => $row["saldo"]);
		}
		$data[]= array(	"id_cliente" 	=> 0 	,
						"id_vehiculo"	=> 0,
						"dominio"		=> '',
						"vehiculo"		=> '',
						"cliente"		=> 'Agregar nuevo cliente',
						"obs_vehi"		=> '',
                        "saldo"         => 0);

		return json_encode($data);
	}

	public function getCtaCte($idc)
	{
		$data = array();
		//remitos
		$sql = "SELECT 	factura.id_fact, num_fact, date_format(fecemi_fact, '%d-%m-%Y') fecha,remitos_fact, dominio,
				v_remito.fecha fec_remi,
			--	IF(recibo_factura.id_recibo is null, factura.total_fact,recibo_factura.saldo_fact) total_fact,
				IF(factura.estado_fact = 1, factura.total_fact,recibo_factura.saldo_fact) total_fact
				FROM 	factura
				JOIN 	v_remito ON (id_remito = remitos_fact)
				left JOIN recibo_factura ON(recibo_factura.id_fact = factura.id_fact and saldo_fact > 0)
				WHERE	estado_fact IN(1,4)
				AND 	forma_pago = 3
				AND 	factura.id_cliente = " . $idc . " ORDER BY factura.id_fact";

		$result = $this->_DB->select_query($sql);

		foreach($result as $row)
		{
			$data[] = array("factura"	=>	$row['num_fact']	, "fecha"	=>	$row['fecha'],
							"remito"	=>	$row['remitos_fact'], "fec_remi"=>	$row['fec_remi'],
							"dominio"	=>	$row['dominio'] 	, "total"	=>	$row['total_fact']);
		}

		//notas de debito
        $sql = "SELECT  factura.id_fact, num_fact, date_format(fecemi_fact, '%d-%m-%Y') fecha,remitos_fact, '' dominio,
                '' fec_remi, factura.total_fact
                FROM    factura
                WHERE   estado_fact IN(1,4)
                AND     forma_pago = 3
                AND     nota_debito = 1
                AND     factura.id_cliente = " . $idc . " ORDER BY factura.id_fact";

        $result = $this->_DB->select_query($sql);

        foreach($result as $row)
        {
            $data[] = array("factura"   =>  'ND'.$row['num_fact']    , "fecha"   =>  $row['fecha'],
                            "remito"    =>  $row['remitos_fact'], "fec_remi"=>  $row['fec_remi'],
                            "dominio"   =>  $row['dominio']     , "total"   =>  $row['total_fact']);
        }

		//facturas y notas de credito sin orden ni remito
		$sql = "SELECT  factura.id_fact, num_fact, date_format(fecemi_fact, '%d-%m-%Y') fecha,remitos_fact, '' dominio,
				'' fec_remi, id_orden, id_remito, factura.nota_credito,
				IF(recibo_factura.id_recibo is null, factura.total_fact,recibo_factura.saldo_fact) total_fact
                FROM    factura
				LEFT JOIN	orden_reparacion o USING(id_fact)
				LEFT JOIN 	v_remito ON (id_remito = remitos_fact)
				left JOIN recibo_factura ON(recibo_factura.id_fact = factura.id_fact and saldo_fact > 0)
                WHERE   estado_fact IN(1,4)
                AND     forma_pago = 3
                AND     nota_debito = 0
				AND		o.id_orden is null
				AND		id_remito is null
                AND     factura.id_cliente = " . $idc . " ORDER BY factura.id_fact";

        $result = $this->_DB->select_query($sql);

        foreach($result as $row)
        {
			$prefijo = '';
			$acomodador = 1;
			if($row['nota_credito'] == 1)
			{
				$prefijo = 'NC';
				$acomodador = -1;
			}

            $data[] = array("factura"   =>  $prefijo.$row['num_fact']   , "fecha"   =>  $row['fecha'],
                            "remito"    =>  $row['remitos_fact']        , "fec_remi"=>  $row['fec_remi'],
                            "dominio"   =>  $row['dominio']             , "total"   =>  $acomodador * $row['total_fact']);
        }

	//ordenes de reparacion
	//TODO: esta quiery la tengo que modificar porque est� trayendo saldos de facturas de compra porque coinciden los id de recibo
		$sql1= "SELECT 	f.id_fact, f.num_fact, date_format(f.fecemi_fact, '%d-%m-%Y') fecha, GROUP_CONCAT(id_orden) AS ordenes,
						v.dominio, date_format(o.fecemi_orden, '%d-%m-%Y') fec_orden,
						IF(recibo_factura.id_recibo is null, f.total_fact,min(recibo_factura.saldo_fact)) total_fact
				FROM 	factura f
				JOIN 	orden_reparacion o USING(id_fact)
				LEFT JOIN	vehiculo v USING(id_vehiculo)
				LEFT JOIN recibo_factura ON(recibo_factura.id_fact = f.id_fact and saldo_fact > 0)
				WHERE	f.estado_fact in(1,4)
				AND 	f.forma_pago = 3
				AND 	f.id_cliente = ".$idc."
				GROUP BY
				f.id_fact ORDER BY f.id_fact";

		$result1 = $this->_DB->select_query($sql1);

		foreach($result1 as $row)
		{
			$data[] = array("factura"	=>	$row['num_fact']	, "fecha"	=>	$row['fecha'],
							"remito"	=>	$row['ordenes']		, "fec_remi"=>	$row['fec_orden'],
							"dominio"	=>	$row['dominio'] 	, "total"	=>	$row['total_fact']);
		}

		//ordeno el array por el numero de factura
		foreach($data as $clave => $fila)
		{
			$num_fact[$clave] = $fila['num_fact'];
		}
		array_multisort($num_fact, SORT_DESC, $data);

		//saldo a favor
		$sql2 = "SELECT * from persona WHERE id_persona = " . $idc;

		$result2 = $this->_DB->select_query($sql2);
		if($result2[0]['saldo'] <> 0)
		{
			$data[] = array("factura"	=> ""				,	"fecha"		=> "",
							"remito"	=> ""				,	"fech_remi"	=> "",
							"dominio"	=> "SALDO A FAVOR"	,	"total"		=> $result2[0]['saldo']*-1);
		}

		return $data;
    }
    
    public function getCtaCteProvd($idc)
	{
		$data = array();
		
		//ordenes de reparacion
		$sql1= "SELECT c.guiacod_compra, DATE_FORMAT(c.fec_compra, '%d-%m-%Y') fecha, DATE_FORMAT(c.fec_ingreso, '%d-%m-%Y') ingreso, c.total_compra, c.nota_credito, c.nota_debito
                FROM compra c 
                WHERE c.estado_compra = 1
                AND c.id_provd = " . $idc;

		$result1 = $this->_DB->select_query($sql1);

		foreach($result1 as $row)
		{
            if($row['nota_credito'] == 1){
                $row['guiacod_compra'] = 'NC' . $row['guiacod_compra'];
                $row['total_compra'] = $row['total_compra'] *-1;
            }
            if($row['nota_debito'] == 1){
                $row['guiacod_compra'] = 'ND' . $row['guiacod_compra'];
            }
            $data[] = array("factura"	=>	$row['guiacod_compra']	, 
                            "fecha"	    =>	$row['fecha'],
                            "ingreso"   =>  $row['ingreso'],
							"total"	    =>	$row['total_compra']);
		}

		return $data;
	}

	public function get_margen_ganancia($id_provd)
	{
		$sql = "SELECT ganancia, id_condiva FROM persona WHERE id_persona = " . $id_provd;

		$result = $this->_DB->select_query($sql);

		return $result[0];
	}

	public function validarClaveAdmin($clave)
	{
		$sql = "SELECT id_persona FROM persona WHERE id_persona = 1 AND clave_persona = '".$clave."'";
		$result = $this->_DB->select_query($sql);

        return $result[0]['id_persona'];

	}

	public function set_saldo_favor($idp, $saldo)
	{
		$sql = "UPDATE persona SET saldo = " . $saldo . " WHERE id_persona = " . $idp;

		$result = $this->_DB->alteration_query($sql);
	}

	public function get_proveedor_cliente($idcli = 0, $idprov = 0)
	{
		if($idcli > 0)
		{
			$sql = "SELECT id_persona FROM persona WHERE id_cliente_proveedor = " . $idcli;
		}
		else if($idprov > 0)
		{
			$sql = "SELECT id_cliente_proveedor FROM persona WHERE id_persona = " . $idprov;
		}
		$result = $this->_DB->select_query($sql);

        return $result[0]['id_persona'];
	}

    public function validarRuc($ruc = '', $id_tipo_per = 1){
        $id_persona = FALSE;
        if($ruc != ''){
            $sql = "SELECT id_persona FROM persona WHERE id_tipoper = ".$id_tipo_per." AND ruc_persona = '".$ruc."'";
            $result = $this->_DB->select_query($sql);
            $id_persona = $result[0]['id_persona'];
        }
        return $id_persona;
    }
}

?>
