<?php
include 'Persona.php';
include '../CONTROLLER/C_Debug.php';

class factura {

    public $_DB;
    public $_id_fact;
    public $_id_empresa;
    public $_id_cliente;
    public $_id_vendedor;
    public $_descto_fact;
    public $_obs_fact;
    public $_iva21_fact;
    public $_iva105_fact;
    public $_num_fact;
    public $_tipo_fact;
    public $_total_fact;
    public $_fecemi_fact;
    public $_estado_fact;
	public $_forma_pago;
	public $detalle;
	public $cliente;
	public $_percepcion_fact;
	public $_remitos_fact;
	public $_or_y_remito_fact;
	public $_punto_de_venta;
	public $_nro_cae;
	public $cae_vto;

    public function __construct() {
        //ESTADOS 
        //Factura: 1-Pendiente, 2-Cancelado, 3-Anulado , 4-Pago parcial 

        $this->_DB = new Database();
    }

    public function factura($id_fact, $forma_pago, $id_empresa, $id_cliente, $id_vendedor, $num_fact, $tipo_fact, $descto_fact, $obs_fact, $iva21_fact,$iva105_fact, $total_fact, $fecemi_fact, $estado_fact, $or_y_remito) {

        $this->_id_fact = $id_fact;

        $this->_id_empresa 	= $id_empresa;

        $this->_id_cliente 	= $id_cliente;

        $this->_id_vendedor = $id_vendedor;

        $this->_descto_fact = $descto_fact;

        $this->_obs_fact 	= $obs_fact;

        $this->_iva21_fact 	= $iva12_fact;

        $this->_iva105_fact = $iva105_fact;
        
        $this->_num_fact	= $num_fact;
        
        $this->_tipo_fact	= $tipo_fact;

        $this->_total_fact 	= $total_fact;

        $this->_fecemi_fact = $fecemi_fact;

        $this->_estado_fact = $estado_fact;
		
		$this->_forma_pago	= $forma_pago;
		
		$this->_or_y_remito_fact	= $or_y_remito;
    }

    public function get_id_fact() {
        return $this->_id_fact;
    }

    public function set_id_fact($id_fact) {

        $this->_id_fact = $id_fact;
    }

    public function get_id_empresa() {

        return $this->_id_empresa;
    }

    public function set_id_empresa($id_empresa) {

        $this->_id_empresa = $id_empresa;
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

    public function get_descto_fact() {

        return $this->_descto_fact;
    }

    public function set_descto_fact($descto_fact) {

        $this->_descto_fact = $descto_fact;
    }
    
    public function get_num_fact() {

        return $this->_num_fact;
    }

    public function set_num_fact($num_fact) {

        $this->_num_fact = $num_fact;
    }

    public function get_tipo_fact() {

        return $this->_tipo_fact;
    }

    public function set_tipo_fact($tipo_fact) {
		if($tipo_fact == "B")
			$tipo_fact = 2;
		if($tipo_fact == "A")
			$tipo_fact = 1;
        $this->_tipo_fact = $tipo_fact;
    }
	
	public function get_forma_pago() {

        return $this->_forma_pago;
    }

    public function set_forma_pago($forma_pago) {

        $this->_forma_pago = $forma_pago;
    }

    public function get_obs_fact() {

        return $this->_obs_fact;
    }

    public function set_obs_fact($obs_fact) {

        $this->_obs_fact = $obs_fact;
    }

    public function get_iva21_fact() {

        return $this->_iva21_fact;
    }

    public function set_iva21_fact($iva21_fact) {

        $this->_iva21_fact = $iva21_fact;
    }

    public function get_iva105_fact() {

        return $this->_iva105_fact;
    }

    public function set_iva105_fact($iva105_fact) {

        $this->_iva105_fact = $iva105_fact;
    }

    public function get_total_fact() {

        return $this->_total_fact;
    }

    public function set_total_fact($total_fact) {

        $this->_total_fact = $total_fact;
    }

    public function get_fecemi_fact() {

        return $this->_fecemi_fact;
    }

    public function set_fecemi_fact($fecemi_fact) {

        $this->_fecemi_fact = $fecemi_fact;
    }

    public function get_estado_fact() {

        return $this->_estado_fact;
    }

    public function set_estado_fact($estado_fact) {

        $this->_estado_fact = $estado_fact;
    }
    public function get_percepcion_fact() {

        return $this->_percepcion_fact;
    }

    public function set_percepcion_fact($percepcion) {

        $this->_percepcion_fact = $percepcion;
    }
    
    public function get_remitos_fact() {

        return $this->_remitos_fact;
    }

    public function set_remitos_fact($remitos) {

        $this->_remitos_fact = $remitos;
    }
    
    public function get_or_y_remito_fact() {

        return $this->_or_y_remito_fact;
    }

    public function set_or_y_remito_fact($or_y_remito) {

        $this->_or_y_remito_fact = $or_y_remito;
    }
	
	public function get_punto_de_venta() {

        return $this->_punto_de_venta;
    }

    public function set_punto_de_venta($punto_de_venta) {

        $this->_punto_de_venta = $punto_de_venta;
    }
	
	public function get_nro_cae() {

        return $this->_nro_cae;
    }

    public function set_nro_cae($cae) {

        $this->_nro_cae = $cae;
    }
    
	public function get_cae_vto() {

        return $this->_cae_vto;
    }

    public function set_cae_vto($cae_vto) {

        $this->_cae_vto = $cae_vto;
    }

    public function addFactura($factura) {
        $sql="";
        $sql = $sql . "'" . $factura->get_id_empresa() . "',";
        $sql = $sql . "'" . $factura->get_id_cliente() . "',";
        $sql = $sql . "'" . $factura->get_id_vendedor() . "',";
        $sql = $sql . "'" . $factura->get_descto_fact() . "',";
        $sql = $sql . "'" . $factura->get_obs_fact() . "',";
        $sql = $sql . "'" . $factura->get_iva21_fact() . "',";
        $sql = $sql . "'" . $factura->get_iva105_fact() . "',";
        $sql = $sql . "'" . $factura->get_num_fact() . "',";
        $sql = $sql . "'" . $factura->get_tipo_fact() . "',";        
		$sql = $sql . "'" . $factura->get_forma_pago() . "',";
        $sql = $sql . "'" . $factura->get_total_fact() . "',";
        $sql = $sql . "'" . $factura->get_fecemi_fact() . "',";
        $sql = $sql . "'" . $factura->get_estado_fact() . "',";
        $sql = $sql . "'" . $factura->get_percepcion_fact() . "',";
        $sql = $sql . "'" . $factura->get_remitos_fact() . "',";
        $sql = $sql . "'" . $factura->get_or_y_remito_fact() . "',";
		$sql = $sql . "'" . $factura->get_punto_de_venta() . "',";
		$sql = $sql . "'" . $factura->get_nro_cae() . "',";
		$sql = $sql . "'" . $factura->get_cae_vto() . "'";

        $result = $this->_DB->select_query("call sp_facturainsert (" . $sql . ")");
        return $result;
    }

    public function updateFactura($factura) {
        $sql="";
        $sql = $sql . "'" . $factura->get_id_fact() . "',";
        $sql = $sql . "'" . $factura->get_id_empresa() . "',";
        $sql = $sql . "'" . $factura->get_id_cliente() . "',";
        $sql = $sql . "'" . $factura->get_id_vendedor() . "',";
        $sql = $sql . "'" . $factura->get_descto_fact() . "',";
        $sql = $sql . "'" . $factura->get_obs_fact() . "',";
        $sql = $sql . "'" . $factura->get_iva21_fact() . "',";
        $sql = $sql . "'" . $factura->get_iva105_fact() . "',";        
        $sql = $sql . "'" . $factura->get_total_fact() . "',";
        $sql = $sql . "'" . $factura->get_fecemi_fact() . "',";
        $sql = $sql . "'" . $factura->get_estado_fact() . "'";
        $result = $this->_DB->alteration_query("call sp_facturaupdate (" . $sql . ")");

        return $result;
    }

    public function deleteFactura($id_fact) {
        $sql = "DELETE FROM factura WHERE id_fact='" . $id_fact . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showFactura($id_fact) {
        $factura = new factura();
        $sql = "SELECT * FROM factura WHERE id_fact=" . $id_fact;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {

            $factura->set_id_fact($row['id_fact']);
            $factura->set_id_empresa($row['id_empresa']);
            $factura->set_id_cliente($row['id_cliente']);
            $factura->set_id_vendedor($row['id_vendedor']);
			$factura->set_forma_pago($row['forma_pago']);
			$factura->set_tipo_fact($row['tipo_fact']);
            $factura->set_descto_fact($row['descto_fact']);
            $factura->set_obs_fact($row['obs_fact']);
            $factura->set_iva21_fact($row['iva21_fact']);
            $factura->set_iva105_fact($row['iva105_fact']);            
            $factura->set_total_fact($row['total_fact']);
            $factura->set_fecemi_fact($row['fecemi_fact']);
            $factura->set_estado_fact($row['estado_fact']);
            $factura->set_num_fact($row['num_fact']);
            $factura->set_or_y_remito_fact($row['or_y_remito_fact']);
            
            $factura->detalle = array();
        }

        return $factura;
    }
    
    public function showFactura_vista($id_fact) {
        $factura = new factura();
        $sql = "SELECT factura.*, listaprecio.porcentaje_listaprecio as porcentaje , vehiculo.dominio
				FROM factura 
				left join persona on (id_cliente = id_persona)
				left join orden_reparacion using(id_fact)
				left join vehiculo using(id_vehiculo)
				left join listaprecio using(id_listaprecio) WHERE id_fact=" . $id_fact;

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
   
        	$arr = explode("-",$row['fecemi_fact']);
        	$fecha = $arr[2] . '-' . $arr[1] . '-' . $arr[0];

            $factura->set_id_fact(			$row['id_fact']			);
            $factura->set_id_empresa(		$row['id_empresa']		);
            $factura->set_id_cliente(		$row['id_cliente']		);
            $factura->set_id_vendedor(		$row['id_vendedor']		);
			$factura->set_forma_pago(		$row['forma_pago']		);
			$factura->set_tipo_fact(		$row['tipo_fact']		);
            $factura->set_descto_fact(		$row['descto_fact']		);
            $factura->set_obs_fact(			$row['obs_fact']		);
            $factura->set_iva21_fact(		$row['iva21_fact']		);
            $factura->set_iva105_fact(		$row['iva105_fact']		);            
            $factura->set_total_fact(		$row['total_fact']		);
            $factura->set_fecemi_fact(		$fecha					);
            $factura->set_estado_fact(		$row['estado_fact']		);
            $factura->set_num_fact(			$row['num_fact']		);
            $factura->set_percepcion_fact(	$row['percepcion_fact']	);
            $factura->set_or_y_remito_fact(	$row['or_y_remito_fact']);
			$factura->set_nro_cae(			$row['nro_cae']			);
			$factura->set_cae_vto(			$row['cae_vto']			);
			$factura->set_punto_de_venta(	$row['punto_venta']		);
            $factura->_nota_credito     =   $row['nota_credito'];
            $factura->_nota_debito      =   $row['nota_debito'];
			$factura->porcentaje		=	$row['porcentaje'];
			$factura->dominio			=	$row['dominio'];
            
            $clsDetalleFact = new detalle_factura();
            if($factura->_estado_fact == 1 && false) //con precios de la tabla producto
            {
            	$factura->detalle = $clsDetalleFact->showDetalle_factura_vista_edit($id_fact);
            } 
            else //con precios de la tabla detalle factura
            {
            	$factura->detalle = $clsDetalleFact->showDetalle_factura_vista($id_fact);
            }
            $manoObra = $factura->getManoObra($id_fact,1);
            $manoObra2 = $factura->getManoObra($id_fact,2);

            $torneria = $factura->getTorneria($id_fact);
            if($manoObra['importe'] != "")
            {
	            $factura->detalle[] = array('_id_producto' 		=> 0, 
	            							'_canti_detfact' 	=> 1,
    	        							'_nom_producto' 	=> 'MO', 
    	        							'_descrip_producto'	=> $manoObra['descripcion'],
    	        							'_precio_detfact' 	=> $manoObra['importe'],
                                            '_id_tipoiva'       => 1);
    	    }
    	    if($manoObra2['importe'] != "")
            {
	            $factura->detalle[] = array('_id_producto' 		=> -2, 
	            							'_canti_detfact' 	=> 1,
    	        							'_nom_producto' 	=> 'MO', 
    	        							'_descrip_producto'	=> $manoObra2['descripcion'],
    	        							'_precio_detfact' 	=> $manoObra2['importe'],
                                            '_id_tipoiva'       => 1);
    	    }
    	    
    	    
    	    if($torneria != 0)
            {
	            $factura->detalle[] = array('_id_producto' 		=> -1, 
	            							'_canti_detfact' 	=> 1,
    	        							'_nom_producto' 	=> 'TO', 
    	        							'_descrip_producto'	=> $torneria['descripcion'],
    	        							'_precio_detfact' 	=> $torneria['importe'],
                                            '_id_tipoiva'       => 1);
    	    }    						
            $clsCliente = new persona();
            $factura->cliente = $clsCliente->showPersona($row['id_cliente']);
            
        }


        return $factura;
    }

    public function listFacturas($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM factura WHERE fecemi_fact>='" . $fecIni . "' AND fecemi_fact <='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $factura = new factura();
            $factura->set_id_fact($row['id_fact']);
            $factura->set_id_empresa($row['id_empresa']);
            $factura->set_id_cliente($row['id_cliente']);
            $factura->set_id_vendedor($row['id_vendedor']);
            $factura->set_descto_fact($row['descto_fact']);
			$factura->set_tipo_fact($row['tipo_fact']);
			$factura->set_forma_pago($row['forma_fact']);
            $factura->set_obs_fact($row['obs_fact']);
            $factura->set_iva12_fact($row['iva21_fact']);
            $factura->set_iva12_fact($row['iva105_fact']);            
            $factura->set_total_fact($row['total_fact']);
            $factura->set_fecemi_fact($row['fecemi_fact']);
            $factura->set_estado_fact($row['estado_fact']);
            $data[] = $factura;
        }

        return $data;
    }
    public function listJsonFacturas($fecIni, $fecFinal) {
		//VAMOS A DAR VUELTA LA FECHA
		$arr_ini = explode('/',$fecIni);
		$fecIni = $arr_ini[2] . '-' . $arr_ini[1] . '-' . $arr_ini[0];
		$arr_fin = explode('/',$fecFinal);
		$fecFinal = $arr_fin[2] . '-' . $arr_fin[1] . '-' . $arr_fin[0];
        $data = array();
        $sql = "SELECT 	*, concat(p.nom_persona, ' (',p.id_persona,')') cliente, DATE_FORMAT(fecemi_fact, '%d-%m-%Y') fecemi_fact, IF(nota_credito = 1,'Nc','Fx') AS tipo
        		FROM 	factura 
        		LEFT JOIN 
        				persona p on (p.id_persona = id_cliente) WHERE fecemi_fact>='" . $fecIni . "' AND fecemi_fact <='" . $fecFinal . "'";
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
            $data[] = array("id_fact"		=>$row['id_fact']		,"obs_fact"		=>$row['obs_fact']		,"descto_fact"	=>$row['descto_fact'],
							"iva21_fact"	=>$row['iva21_fact']	,"iva105_fact"	=>$row['iva105_fact']	,"total_fact"	=>$row['total_fact'],
							"fecemi_fact"	=>$row['fecemi_fact']	,"cliente" 		=>$row['cliente']		,"tipo"			=>$row['tipo'] );
        }

        return json_encode($data);
    }
	
	public function listJsonFacturasCtaCte($idc = 0) {
		//VAMOS A DAR VUELTA LA FECHA
        $data = array();
        $sql = "SELECT 	*, concat(p.nom_persona, ' (',p.id_persona,')') cliente, DATE_FORMAT(fecemi_fact, '%d-%m-%Y') fecemi_fact, IF(nota_credito = 1,'Nc','Fx') AS tipo
        		FROM 	factura 
        		LEFT JOIN 
        				persona p on (p.id_persona = id_cliente) 
				WHERE forma_pago = 3 and estado_fact = 1";
		if($idc <> 0)
		{
			$sql = $sql . " AND id_cliente = " . $idc;
		}

		$result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[] = array("id_fact"		=>$row['id_fact']		,"obs_fact"		=>$row['obs_fact']		,"descto_fact"	=>$row['descto_fact'],
							"iva21_fact"	=>$row['iva21_fact']	,"iva105_fact"	=>$row['iva105_fact']	,"total_fact"	=>$row['total_fact'],
							"fecemi_fact"	=>$row['fecemi_fact']	,"cliente" 		=>$row['cliente']		,"tipo"			=>$row['tipo'],
							"num_fact"		=>$row['num_fact'] );
        }

        return json_encode($data);
    }
	
    
    public function ListaJsonFactDetalleProducto($id_fact){
        $data = array();
        $sql = "SELECT * FROM v_factura_detalle WHERE id_fact=".$id_fact;
        $result = $this->_DB->select_query($sql); 
        foreach ($result as $row) {
            $data[]=$row;//meto todos
        }
        return json_encode($data);
    }

   public function listJsonFacuraDetalle_dos($id_fact){
       $data = array();
        $sql = "SELECT d.*, p.id_tipoiva FROM v_factura_detalle d
                JOIN    producto p USING(id_producto)
                WHERE d.id_fact=".$id_fact;
        $result = $this->_DB->select_query($sql);  
		
       foreach ($result as $row) {
            $data[]=array(	"id_fact"		=>$row['id_fact']		,"nom_producto"		=>$row['nom_producto'], 
							"canti_detfact"	=>$row['canti_detfact']	,"precio_detfact"	=>$row['precio_detfact'],
                            "id_producto"   =>$row['id_producto']   ,"descrip_producto"	=>$row['descrip_producto'],
                            "id_tipoiva"    =>$row['id_tipoiva']
                        );
        }
        return json_encode($data);
       
   }
   /**
    *Devuelve 1 true , si existe osea ya ha sido cancelada.0 no existe y se debe cancelar.
    * @param type $id_cliente
    * @param type $fecha
    * @return type 
    */
   public function isPagadaFactura($id_cliente, $fecha) {
        $sql = "SELECT	(COUNT(id_Fact)+1) AS total 
				FROM 	factura 
				WHERE 	id_cliente=$id_cliente 
				AND 	(MONTH(fecemi_fact)=MONTH('$fecha') 
				AND 	YEAR(fecemi_fact)=YEAR('$fecha'))";
        $cont=0;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
             $cont=$row['total'];
         }
         $cont=$cont-1;
        return $cont;
    }
    /**
     *Devuelve 0 SE PROCEde A EJECUTAR EL RESTO DE CASO CONTRARIO NO.
     * @param type $id_cliente
     * @param type $fecha
     * @return type 
     */
    public function validarMesAnterior($id_cliente, $fecha){
        $sql="SELECT (COUNT(id_fact)+1) AS total FROM factura WHERE id_cliente=$id_cliente AND fecemi_fact>='$fecha'";
        $cont=0;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
             $cont=$row['total'];
         }
         $cont=$cont-1;
        return $cont;
    }
	
	public function getProximoFactura($idtipo) {
		$sql = "SELECT  num_fact + 1 AS id FROM factura WHERE id_fact = (select id_fact from factura where tipo_fact = " . $idtipo . " order by fecemi_fact desc, id_fact desc limit 1)";
		$result = $this->_DB->select_query($sql);
		return $result[0][0];
	}
	
	public function resetManoObra($idfact){
		$sql = "DELETE FROM manoobra WHERE id_fac = " . $idfact;
		$result = $this->_DB->select_query($sql);
	}
	
	public function setManoObra($importe, $descripcion, $idfact) {
		
		$sqli = "INSERT INTO manoobra (id_fac, importe, descripcion) VALUES (".$idfact.",".$importe.",'".$descripcion."')";
		$resutl = $this->_DB->select_query($sqli);
	}
	
	public function setTorneria($importe, $descripcion, $idfact) {
		$sql = "DELETE FROM torneria WHERE id_fac = " . $idfact;
		$result = $this->_DB->select_query($sql);
		
		$sqli = "INSERT INTO torneria (id_fac, importe, descripcion) VALUES (".$idfact.",".$importe.",'".$descripcion."')";

		$resutl = $this->_DB->select_query($sqli);
	}
	
	public function getManoObra($idfact, $orden = 1){
		$sql = "SELECT * FROM manoobra WHERE id_fac = " .$idfact;
		if($orden == 2)
			$sql = $sql . " ORDER BY idmanoobra DESC";
		else
			$sql = $sql . " LIMIT 1";
		
		$result = $this->_DB->select_query($sql);
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
	
	public function getTorneria($idfact){
		$sql = "SELECT * FROM torneria WHERE id_fac = " .$idfact;
		$result = $this->_DB->select_query($sql);
		if(count($result > 0))
			return $result[0];
		else
			return 0;
	}
	
	public function cobrar($id_fact, $forma_pago)
	{
		$sql = "UPDATE factura SET forma_pago = '" . $forma_pago . "', estado_fact = 2 WHERE id_fact = " . $id_fact;
		$result = $this->_DB->select_query($sql);
		return $result;
	}
	
	public function VerificarExistenciaNumero($num_fact, $tipo_fact)
	{
		$sql = "SELECT id_fact FROM factura WHERE num_fact = " . $num_fact . " AND tipo_fact = '" . $tipo_fact . "'";

		$result = $this->_DB->select_query($sql);
		
		if(count($result) > 0){
			return $result[0]['id_fact'];
		}
		else
			return 0;
	}	
	
	public function anular($id_fact){
		//orden de reparacion
		$sql = "UPDATE orden_reparacion SET estado = 2, id_fact = 0 WHERE id_fact = " . $id_fact; 
		$this->_DB->select_query($sql);
		//remito
		$sql1 = "UPDATE remito SET estado_remi = 1, id_fact = 0 WHERE id_fact = " . $id_fact;
		$this->_DB->select_query($sql1);
		//detalle
		$sql3 = "SELECT id_producto, canti_detfact FROM detalle_factura WHERE id_fact = " . $id_fact;
		$result = $this->_DB->select_query($sql3);
		
		foreach($result as $row){
			$sql4 = "";
			$sql4 = "UPDATE producto  SET stock_producto = stock_producto + " . $row['canti_detfact'] . " WHERE id_producto = " . $row['id_producto'];
			$this->_DB->select_query($sql4);
		}
		//factura
		$sql2 = "UPDATE factura SET estado_fact = 3 WHERE id_fact = ". $id_fact;
		
		
		$result = $this->_DB->select_query($sql2);
		
		return $result;
	}
	
	public function set_nota_credito($idf){
		$sql = "UPDATE factura SET nota_credito = 1 WHERE id_fact = ".$idf;
		$this->_DB->select_query($sql);
	}
	
	public function set_nota_debito($idf){
		$sql = "UPDATE factura SET nota_debito = 1 WHERE id_fact = ".$idf;
		$this->_DB->select_query($sql);
	}
	
	public function listFacturasCliente($idcliente) {
        $data = array();
        $sql = "SELECT 	*, DATE_FORMAT(fecemi_fact,'%d-%m-%Y') fecemi_fact
				FROM 	factura
				WHERE 	id_cliente = " . $idcliente . " 
				AND		estado_fact IN(1)";
//				AND 	nota_credito = 0";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {
        	if($row['tipo_fact'] == 1)
        		$tipo_num = 'A'.$row['num_fact'];
        	else
        		$tipo_num = 'B'.$row['num_fact'];
        	
            if($row['nota_credito'] == 1)
            {
                $tipo_num = 'NC'.$row['num_fact'];
                $row['total_fact'] = $row['total_fact'] * -1;
            }

            $factura = new factura();
            $factura->set_id_fact(		$row['id_fact']		);
            $factura->set_total_fact(	$row['total_fact']	);
            $factura->set_fecemi_fact(	$row['fecemi_fact']	);
            $factura->set_estado_fact(	$row['estado_fact']	);
            $factura->set_num_fact(		$tipo_num			);
            $factura->set_or_y_remito_fact($row['or_y_remito_fact']);
            $data[] = $factura;
        }
        
        //ahora las facturas pendientes parciales
        $sql1 = "SELECT 	*, DATE_FORMAT(fecemi_fact,'%d-%m-%Y') fecemi_fact, rf.saldo_fact
				FROM 	factura
				JOIN 	recibo_factura rf USING(id_fact)
				WHERE 	id_cliente = " . $idcliente . " 
				AND		estado_fact = 4
				AND 	nota_credito = 0";
				
		$result1 = $this->_DB->select_query($sql1);

        foreach ($result1 as $row) {
        	if($row['tipo_fact'] == 1)
        		$tipo_num = 'A'.$row['num_fact'];
        	else
        		$tipo_num = 'B'.$row['num_fact'];
        		
            $factura = new factura();
            $factura->set_id_fact(		$row['id_fact']		);
            $factura->set_total_fact(	$row['saldo_fact']	);
            $factura->set_fecemi_fact(	$row['fecemi_fact']	);
            $factura->set_estado_fact(	$row['estado_fact']	);
            $factura->set_num_fact(		$tipo_num			);
            $factura->set_or_y_remito_fact($row['or_y_remito_fact']);
            $data[] = $factura;
        }

        return $data;
    }
    
    public function listUltimasFacturasCliente($idcliente) {
        $data = array();
        $sql = "SELECT 	*, DATE_FORMAT(fecemi_fact,'%d-%m-%Y') fecemi_fact
				FROM 	factura
				WHERE 	id_cliente = " . $idcliente . " 
				AND		estado_fact = 2
--				AND 	nota_credito = 0
				ORDER BY id_fact DESC
				LIMIT 10";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {
        	if($row['tipo_fact'] == 1)
        		$tipo_num = 'A'.$row['num_fact'];
        	else
        		$tipo_num = 'B'.$row['num_fact'];
			
            $factura = new factura();
            $factura->set_id_fact(		$row['id_fact']		);
			
			if($row['nota_credito'] == 1)
            {
                $tipo_num = 'NC'.$row['num_fact'];
                $row['total_fact'] = $row['total_fact'] * -1;
            }
			
			$factura->set_total_fact(	$row['total_fact']);
            $factura->set_fecemi_fact(	$row['fecemi_fact']	);
            $factura->set_estado_fact(	$row['estado_fact']	);
            $factura->set_num_fact(		$tipo_num			);
            $factura->set_or_y_remito_fact($row['or_y_remito_fact']);
            $data[] = $factura;
        }
        
        return $data;
    }
	

    public function nc_contra_factura($monto, $idfact, $idnc){
        //busco la factura
        $sql1 = "SELECT * FROM factura WHERE id_fact = " . $idfact;
        $rs = $this->_DB->select_query($sql1);
        $factura = $rs[0];

        $result = false;

        //pago total de la fact y NC si coinciden los montos y la fact está pendiente
        if($factura['estado_fact'] == 1 && $factura['total_fact'] == $monto){
            $sql2 = "UPDATE factura SET estado_fact = 2 WHERE id_fact IN(" . $idfact . "," . $idnc .")";
            $result = $this->_DB->alteration_query($sql2);
        }

        return $result;
    }
}
?>
