<?php
class vehiculo {

    public $_DB;
    public $_id_vehiculo;
    public $_id_cliente;
    public $_marca;
    public $_modelo;
    public $_anio;
    public $_dominio;
    public $_observacion;
    public $_id_tipovehiculo;

    public function __construct() {
        $this->_DB = new Database();
    }

    public function vehiculo($id_vehiculo,$id_cliente, $marca, $modelo, $anio, $dominio, $observacion,$id_tipovehiculo) {

        $this->_id_vehiculo 	= $id_vehiculo;
        $this->_id_cliente 		= $id_cliente;
        $this->_marca			= $marca;
        $this->_modelo 			= $modelo;
        $this->_anio 			= $anio;
        $this->_dominio 		= $dominio;
        $this->_observacion 	= $observacion;
        $this->_id_tipovehiculo	= $id_tipovehiculo;
    }

    public function get_id_vehiculo() {
        return $this->_id_vehiculo;
    }

    public function set_id_vehiculo($id_vehiculo) {
        $this->_id_vehiculo = $id_vehiculo;
    }

    public function get_id_cliente() {
        return $this->_id_cliente;
    }

    public function set_id_cliente($id_cliente) {
        $this->_id_cliente = $id_cliente;
    }
    
    public function get_id_tipovehiculo() {
        return $this->_id_tipovehiculo;
    }

    public function set_id_tipovehiculo($id_tipovehiculo) {
        $this->_id_tipovehiculo = $id_tipovehiculo;
    }
    
    public function get_marca() {
        return $this->_marca;
    }

    public function set_marca($marca) {
        $this->_marca = $marca;
    }
    
    public function get_modelo() {
        return $this->_modelo;
    }

    public function set_modelo($modelo) {
        $this->_modelo = $modelo;
    }
    
    public function get_anio() {
        return $this->_anio;
    }

    public function set_anio($anio) {
        $this->_anio = $anio;
    }

    public function get_dominio() {
        return $this->_dominio;
    }

    public function set_dominio($dominio) {
        $this->_dominio = $dominio;
    }
    
    public function get_observacion() {
        return $this->_observacion;
    }

    public function set_observacion($observacion) {
        $this->_observacion = $observacion;
    }  
    
    public function addVehiculo($vehiculo) {

        $sql="";
        $sql = $sql . "'" . $vehiculo->get_marca() . "',";
        $sql = $sql . "'" . $vehiculo->get_modelo() . "',";
        $sql = $sql . "'" . $vehiculo->get_anio() . "',";
        $sql = $sql . "'" . $vehiculo->get_dominio() . "',";
        $sql = $sql . "'" . $vehiculo->get_observacion() . "',";
        $sql = $sql . "'" . $vehiculo->get_id_tipovehiculo() . "'";

        $result = $this->_DB->select_query("call sp_vehiculoinsert (" . $sql . ")");

        return $result;
    }

    public function updateVehiculo($vehiculo) {

        $sql="";
        $sql = $sql . "'" . $vehiculo->get_id_vehiculo() . "',";
        $sql = $sql . "'" . $vehiculo->get_marca() . "',";
        $sql = $sql . "'" . $vehiculo->get_modelo() . "',";
        $sql = $sql . "'" . $vehiculo->get_anio() . "',";
        $sql = $sql . "'" . $vehiculo->get_dominio() . "',";
        $sql = $sql . "'" . $vehiculo->get_observacion() . "',";
        $sql = $sql . "'" . $vehiculo->get_id_tipovehiculo() . "'";

        $result = $this->_DB->alteration_query("call sp_vehiculoupdate (" . $sql . ")");

        return $result;
    }

    public function deleteVehiculo($id_vehiculo) {
        $sql = "DELETE FROM vehiculo WHERE id_vehiculo='" . $id_vehiculo . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {
        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showVehiculo($id_vehiculo) {

        $vehiculo = new vehiculo();
        if($id_vehiculo != '')
        {
		    $sql = "SELECT * FROM vehiculo WHERE id_vehiculo = " . $id_vehiculo;
		    $result = $this->_DB->select_query($sql);

		    foreach ($result as $row) {
		        $vehiculo->set_id_vehiculo(	$row['id_vehiculo']);
		        $vehiculo->set_marca(		$row['marca']);
		        $vehiculo->set_modelo(		$row['modelo']);
		        $vehiculo->set_anio(		$row['anio']);
		        $vehiculo->set_dominio(		$row['dominio']);
		        $vehiculo->set_observacion(	$row['observacion']);
		        $vehiculo->set_id_cliente(	$row['id_cliente']);
		        $vehiculo->set_id_tipovehiculo($row['id_tipovehiculo']);
		    }
	 	}

        return $vehiculo;
    }

    public function listVehiculosPorDominio($dominio) {
        $data = array();
        $sql = "SELECT * FROM vehiculo WHERE dominio like '".$dominio."%'";

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $vehiculo = new vehiculo();
            
            $vehiculo->set_id_vehiculo(	$row['id_vehiculo']);
            $vehiculo->set_marca(			$row['marca']);
            $vehiculo->set_modelo(			$row['modelo']);
            $vehiculo->set_anio(				$row['anio']);
            $vehiculo->set_dominio(			$row['dominio']);
            $vehiculo->set_observacion(	$row['observacion']);
            
            $data[] = $vehiculo;
        }
        return $data;
    }


    public function getVehiculosPorDominio($dominio) {
        $sql = "SELECT * FROM vehiculo WHERE dominio = '".$dominio."'";

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $vehiculo = new vehiculo();

            $vehiculo->set_id_vehiculo( $row['id_vehiculo']);
            $vehiculo->set_marca(                       $row['marca']);
            $vehiculo->set_modelo(                      $row['modelo']);
            $vehiculo->set_anio(                        $row['anio']);
            $vehiculo->set_dominio(                     $row['dominio']);
            $vehiculo->set_observacion( $row['observacion']);

            $vehiculo;
        }
        return $vehiculo;
    }


    
    /**
     *
     * @param type $nombre
     * @return type json devuelve un listado de vehiculos buscando por nombre de cliente
     */
    public function listVehiculosPorCliente($nombre) {
        $data = array();
        $sql = "	SELECT 	c.`id_persona`, concat(c.`nom_persona`,'(',c.`ape_persona`,')') cliente, v.* 
					FROM 		vehiculo v 
					JOIN 		vehiculo_cliente vc 
						ON 	(vc.`id_vehiculo` = v.`id_vehiculo`) 
					JOIN 		persona c 
						ON 	(c.`id_persona` = vc.`id_cliente`)
					WHERE		c.`nom_persona` LIKE '%$nombre%'  
						OR 	c.`ape_persona` LIKE '%$nombre%'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[]= array(	"id_vehiculo" 	=>	$row["id_vehiculo"]	, "cliente"		=>$row["cliente"],
            				"id_persona"	=>	$row["id_persona"] 	, "marca"		=> $row["marca"],
            				"modelo"		=>	$row["modelo"] 	 	, "anio"		=> $row["anio"],
            				"dominio"		=>	$row["dominio"] 	, "observacion"	=> $row["observacion"]
            					);	
        }
        return json_encode($data);
    }
	
	public function listVehiculosPorDominioJson($dominio){
		$data = array();
		$sql = "	SELECT * 
					FROM 	vehiculo
					WHERE	dominio LIKE '$dominio%'";
		$result = $this->_DB->select_query($sql);
		foreach($result as $row){
			$data[] = array("id_vehiculo" 	=> $row['id_vehiculo']	, "dominio"	=> $row['dominio'], 
							"vehiculo"		=> $row['marca'] . ' ' . $row['modelo']);
		}
		return json_encode($data);
	}
	
	public function VerificarExistenciaDominio($dominio)
	{
		$sql = "SELECT id_vehiculo FROM vehiculo WHERE dominio = '" . $dominio . "'";

		$result = $this->_DB->select_query($sql);
		
		if(count($result) > 0){
			return $result[0]['id_vehiculo'];
		}
		else
			return 0;
	}

}
?>
