<?php

class compra {

    public $_DB;
    public $_id_compra;
    public $_id_provd;
    public $_guiacod_compra;
    public $_total_compra;
    public $_obs_compra;
    public $_baseGrava_compra;
    public $_fec_compra;
    public $_fec_ingreso;
    public $_estado_compra;
    public $_iva21_compra;
    public $_iva10_compra;
    public $_subtotal_compra;
    public $_percepcion_compra;
    public $_iva_ret_compra;
    public $_ganancia_ret_compra;
    public $_descuento_compra;
    public $_iibb_ret_compra;
	public $_concepto_nograv;
    public $_regimen_general;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function compra($id_compra, $id_provd, $guiacod_compra, $total_compra, $obs_compra, $baseGrava_compra, $fec_compra, $estado_compra) {

        $this->_id_compra = $id_compra;

        $this->_id_provd = $id_provd;

        $this->_guiacod_compra = $guiacod_compra;

        $this->_total_compra = $total_compra;

        $this->_obs_compra = $obs_compra;

        $this->_baseGrava_compra = $baseGrava_compra;

        $this->_fec_compra = $fec_compra;

        $this->_estado_compra = $estado_compra;
    }

    public function get_id_compra() {
        return $this->_id_compra;
    }

    public function set_id_compra($id_compra) {

        $this->_id_compra = $id_compra;
    }

    public function get_id_provd() {

        return $this->_id_provd;
    }

    public function set_id_provd($id_provd) {

        $this->_id_provd = $id_provd;
    }

    public function get_guiacod_compra() {

        return $this->_guiacod_compra;
    }

    public function set_guiacod_compra($guiacod_compra) {

        $this->_guiacod_compra = $guiacod_compra;
    }

    public function get_total_compra() {

        return $this->_total_compra;
    }

    public function set_total_compra($total_compra) {

        $this->_total_compra = $total_compra;
    }

    public function get_obs_compra() {

        return $this->_obs_compra;
    }

    public function set_obs_compra($obs_compra) {

        $this->_obs_compra = $obs_compra;
    }

    public function get_baseGrava_compra() {

        return $this->_baseGrava_compra;
    }

    public function set_baseGrava_compra($baseGrava_compra) {

        $this->_baseGrava_compra = $baseGrava_compra;
    }

    public function get_fec_compra() {

        return $this->_fec_compra;
    }

    public function set_fec_compra($fec_compra) {

        $this->_fec_compra = $fec_compra;
    }

    public function get_fec_ingreso_compra() {

        return $this->_fec_ingreso;
    }

    public function set_fec_ingreso_compra($fec_ingreso) {

        $this->_fec_ingreso = $fec_ingreso;
    }

    public function get_estado_compra() {

        return $this->_estado_compra;
    }

    public function set_estado_compra($estado_compra) {

        $this->_estado_compra = $estado_compra;
    }

    public function get_subtotal_compra() {

        return $this->_subtotal_compra;
    }

    public function set_subtotal_compra($subtotal_compra) {

        $this->_subtotal_compra = $subtotal_compra;
    }

    public function get_iva21_compra() {

        return $this->_iva21_compra;
    }

    public function set_iva21_compra($iva21_compra) {

        $this->_iva21_compra = $iva21_compra;
    }

    public function get_iva10_compra() {

        return $this->_iva10_compra;
    }

    public function set_iva10_compra($iva10_compra) {

        $this->_iva10_compra = $iva10_compra;
    }

    public function get_percepcion_compra() {

        return $this->_percepcion_compra;
    }

    public function set_percepcion_compra($percepcion_compra) {

        $this->_percepcion_compra = $percepcion_compra;
    }

    public function get_iva_ret_compra() {

        return $this->_iva_ret_compra;
    }

    public function set_iva_ret_compra($iva_ret_compra) {

        $this->_iva_ret_compra = $iva_ret_compra;
    }

    public function get_iibb_ret_compra() {

        return $this->_iibb_ret_compra;
    }

    public function set_iibb_ret_compra($iibb_ret_compra) {

        $this->_iibb_ret_compra = $iibb_ret_compra;
    }

    public function get_ganancia_ret_compra() {

        return $this->_ganancia_ret_compra;
    }

    public function set_ganancia_ret_compra($ganancia_ret_compra) {

        $this->_ganancia_ret_compra = $ganancia_ret_compra;
    }

    public function get_descuento_compra() {

        return $this->_descuento_compra;
    }

    public function set_descuento_compra($descuento_compra) {

        $this->_descuento_compra = $descuento_compra;
    }

	public function get_concepto_nograv() {

        return $this->_concepto_nograv;
    }

    public function set_concepto_nograv($concepto_nograv) {

        $this->_concepto_nograv = $concepto_nograv;
    }

    public function get_regimen_general() {

        return $this->_regimen_general;
    }

    public function set_regimen_general($regimen_general){
        $this->_regimen_general = $regimen_general;
    }

    public function addCompra($compra) {
        $sql="";
        $sql = $sql . "'" . $compra->get_id_provd() . "',";
        $sql = $sql . "'" . $compra->get_guiacod_compra() . "',";
        $sql = $sql . "'" . $compra->get_total_compra() . "',";
        $sql = $sql . "'" . $compra->get_obs_compra() . "',";
        $sql = $sql . "'" . $compra->get_baseGrava_compra() . "',";
        $sql = $sql . "'" . $compra->get_fec_compra() . "',";
        $sql = $sql . "'" . $compra->get_estado_compra() . "',";
        $sql = $sql . "'" . $compra->get_iva21_compra() . "',";
        $sql = $sql . "'" . $compra->get_iva10_compra() . "',";
        $sql = $sql . "'" . $compra->get_subtotal_compra() . "',";
        $sql = $sql . "'" . $compra->get_iva_ret_compra() . "',";
        $sql = $sql . "'" . $compra->get_iibb_ret_compra() . "',";
        $sql = $sql . "'" . $compra->get_ganancia_ret_compra() . "',";
        $sql = $sql . "'" . $compra->get_descuento_compra() . "',";
        $sql = $sql . "'" . $compra->get_fec_ingreso_compra() . "',";
		$sql = $sql . "'" . $compra->get_concepto_nograv() . "',";
        $sql = $sql . "'" . $compra->get_regimen_general() . "'";

        $result = $this->_DB->select_query("call sp_comprainsert (" . $sql . ")");
        return $result;
    }

    public function updateCompra($compra) {
        $sql="";
        $sql = $sql . "'" . $compra->get_id_compra() . "',";
        $sql = $sql . "'" . $compra->get_id_provd() . "',";
        $sql = $sql . "'" . $compra->get_guiacod_compra() . "',";
        $sql = $sql . "'" . $compra->get_total_compra() . "',";
        $sql = $sql . "'" . $compra->get_obs_compra() . "',";
        $sql = $sql . "'" . $compra->get_baseGrava_compra() . "',";
        $sql = $sql . "'" . $compra->get_fec_compra() . "',";
        $sql = $sql . "'" . $compra->get_estado_compra() . "',";
        $sql = $sql . "'" . $compra->get_iva21_compra() . "',";
        $sql = $sql . "'" . $compra->get_iva10_compra() . "',";
        $sql = $sql . "'" . $compra->get_subtotal_compra() . "',";
        $sql = $sql . "'" . $compra->get_iva_ret_compra() . "',";
        $sql = $sql . "'" . $compra->get_iibb_ret_compra() . "',";
        $sql = $sql . "'" . $compra->get_ganancia_ret_compra() . "',";
        $sql = $sql . "'" . $compra->get_descuento_compra() . "',";
        $sql = $sql . "'" . $compra->get_fec_ingreso_compra() . "',";
		$sql = $sql . "'" . $compra->get_concepto_nograv() . "',";
        $sql = $sql . "'" . $compra->get_regimen_general() . "'";

        $result = $this->_DB->alteration_query("call sp_compraupdate (" . $sql . ")");

        return $result;
    }

    public function deleteCompra($id_compra) {
        $sql = "DELETE FROM compra WHERE id_compra='" . $id_compra . "'";
        $result = $this->_DB->alteration_query($sql);
        return $result;
    }

    public function set_nota_credito($idc){
		$sql = "UPDATE compra SET nota_credito = 1 WHERE id_compra = ".$idc;
		$this->_DB->select_query($sql);
	}

    public function set_nota_debito($idc){
		$sql = "UPDATE compra SET nota_debito = 1 WHERE id_compra = ".$idc;
		$this->_DB->select_query($sql);
	}

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    /**
     *Muestra la compra por guia de código
     * @param type $guia_cod
     * @return compra
     */
    public function showCompra($guia_cod) {

        $compra = new compra();
        $sql = "SELECT * FROM compra WHERE guiacod_compra='" . $guia_cod."'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $compra->set_id_compra($row['id_compra']);
            $compra->set_id_provd($row['id_provd']);
            $compra->set_guiacod_compra($row['guiacod_compra']);
            $compra->set_total_compra($row['total_compra']);
            $compra->set_obs_compra($row['obs_compra']);
            $compra->set_baseGrava_compra($row['baseGrava_compra']);
            $compra->set_fec_compra($row['fec_compra']);
            $compra->set_fec_ingreso_compra($row['fec_ingreso']);
            $compra->set_estado_compra($row['estado_compra']);
        }

        return $compra;
    }


    /**
    * Devuelve una compra para ser editada
    *
    */
    public function showCompraEdit($idc) {

        $compra = new compra();
        $detalle_compra = new detalle_compra();


        $sql = "SELECT *, date_format(fec_compra,'%d-%m-%Y') as fecha_compra,date_format(fec_ingreso,'%d-%m-%Y') as fecha_ingreso FROM compra WHERE id_compra = " . $idc;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $compra->set_id_compra($row['id_compra']);
            $compra->set_id_provd($row['id_provd']);
            $compra->set_guiacod_compra($row['guiacod_compra']);
            $compra->set_total_compra($row['total_compra']);
            $compra->set_obs_compra($row['obs_compra']);
            $compra->set_baseGrava_compra($row['baseGrava_compra']);
            $compra->set_fec_compra($row['fecha_compra']);
            $compra->set_fec_ingreso_compra($row['fecha_ingreso']);
            $compra->set_estado_compra($row['estado_compra']);
            $compra->set_iibb_ret_compra($row['iibb_ret_compra']);
            $compra->set_ganancia_ret_compra($row['ganancia_ret_compra']);
            $compra->set_descuento_compra($row['descuento_compra']);
            $compra->set_iva_ret_compra($row['iva_ret_compra']);
			$compra->set_concepto_nograv($row['concepto_nograv']);
            $compra->set_regimen_general($row['regimen_general']);

            $compra->detalle = $detalle_compra->showDetalle_compraEdit($idc);
        }

        return $compra;
    }



    public function listCompras($nom_producto) {
        $data = array();
        $sql = "SELECT * FROM compra WHERE fecha_compra>='" . $fecIni . "' AND fecha_compra <='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $compra = new compra();
            $compra->set_id_compra($row['id_compra']);
            $compra->set_id_provd($row['id_provd']);
            $compra->set_guiacod_compra($row['guiacod_compra']);
            $compra->set_total_compra($row['total_compra']);
            $compra->set_obs_compra($row['obs_compra']);
            $compra->set_baseGrava_compra($row['baseGrava_compra']);
            $compra->set_fec_compra($row['fec_compra']);
            $compra->set_fec_ingreso($row['fec_ingreso']);
            $compra->set_estado_compra($row['estado_compra']);
            $data[] = $compra;
        }
        return $data;
    }


    public function listJsonCompras($fecIni, $fecFinal) {
        $data = array();
		//VAMOS A DAR VUELTA LA FECHA
		$arr_ini = explode('-',$fecIni);
		$fecIni = $arr_ini[2] . '-' . $arr_ini[1] . '-' . $arr_ini[0];
		$arr_fin = explode('-',$fecFinal);
		$fecFinal = $arr_fin[2] . '-' . $arr_fin[1] . '-' . $arr_fin[0];

        $sql = "SELECT compra.*, 
                DATE_FORMAT(fec_compra,'%d-%m-%Y') fec_compra,
                (CASE 
                WHEN (nota_credito = 1) THEN 'NC'
                ELSE (CASE 
                WHEN (nota_debito = 1) THEN 'ND'
                ELSE 'FX' 
                 END)
                 END) tipo , 
                persona.nom_persona as proveedor, 
                persona.ruc_persona as cuit
                FROM compra 
                LEFT JOIN persona on (persona.id_persona = compra.id_provd)
        		WHERE fec_ingreso>='" . $fecIni . "' AND fec_ingreso<='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $multi = 1;
            if($row['tipo'] == 'NC'){
                $multi = -1;
            }
            $data[] = array("id_compra"		=>$row['id_compra']		          ,"fec_compra"	  =>$row['fec_compra']	,
            				/*"obs_compra"	=>$row['obs_compra']	        ,*/"remito"		  =>$row['guiacod_compra'] ,
            				"iva21"			=>$row['iva21_compra']*$multi     ,"iva10"		  =>$row['iva10_compra']*$multi,
							"total_compra"	=>$row['total_compra']*$multi     ,"subtotal"	  =>$row['subtotal_compra']*$multi,
							"proveedor"		=>$row['proveedor']		          ,"iva_ret"	  =>$row['iva_ret_compra']*$multi,
							"iibb_ret"		=>$row['iibb_ret_compra']*$multi ,"descuento"	  =>$row['descuento_compra']*$multi,
							"iva_ret"		=>$row['iva_ret_compra']*$multi   ,"ganancia_ret" =>$row['ganancia_ret_compra']*$multi,
							"fec_ingreso"	=>$row['fec_ingreso']	          ,"tipo"		  =>$row['tipo'],
							"concepto_nograv"=> $row['concepto_nograv'], 
                            "cuit"          =>$row['cuit']);
        }

        return json_encode($data);
    }

    public function lisJsonCompraDetalle($id_compra) {
        $data = array();
        $sql = "SELECT * FROM v_compra_detalle WHERE id_compra=" . $id_compra;
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[] = $row;  ///meto datos
        }
        return json_encode($data);
    }

    public function lisJsonCompraDetalle_prod($id_compra){
       $data = array();
       $sql = "SELECT 	cd.*, p.pvp1_producto
       			FROM 	v_compra_detalle cd
       			LEFT JOIN producto p USING(id_producto)
       			WHERE 	id_compra=" . $id_compra;

       $result = $this->_DB->select_query($sql);
       foreach ($result as $row) {
            $data[]=array(	"id_compra"		  	=> $row['id_compra']		,"nom_producto"		 =>$row['nom_producto'],
           					"canti_detcompra" 	=> $row['canti_detcompra']	,"costouni_detcompra"=>$row['costouni_detcompra'],
           					"descrip_producto"	=> $row['descrip_producto'] ,"tipo_iva"			 =>$row['id_tipoiva'],
           					"precio"		  	=> $row['pvp1_producto']	,"id_producto"		 =>$row['id_producto']);
        }
        return json_encode($data);

   }

   public function VerificarExistenciaNumero($num_fact, $id_prov)
	{
		$sql = "SELECT id_compra FROM compra WHERE guiacod_compra = '" . $num_fact . "' AND id_provd = " . $id_prov . "";

		$result = $this->_DB->select_query($sql);

		if(count($result) > 0){
			return $result[0]['id_compra'];
		}
		else
			return 0;
	}

	public function listComprasProveedor($idprovd) {
        $data = array();
        $sql = "SELECT 	*, DATE_FORMAT(fec_compra,'%d-%m-%Y') fec_compra, if(nota_credito=1,total_compra*-1,total_compra) as total_compra
				FROM 	compra
				WHERE 	id_provd = " . $idprovd . "
				AND		estado_compra = 1";

        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $cpr = array(	'id_compra' 		=> $row['id_compra']	, 'total_compra' 	=> $row['total_compra'],
            				'fec_compra' 		=> $row['fec_compra']	, 'estado_compra' 	=> $row['estado_compra'],
            				'guiacod_compra' 	=> $row['guiacod_compra']);
            $data[] = $cpr;
        }

        return $data;
    }



}
?>
