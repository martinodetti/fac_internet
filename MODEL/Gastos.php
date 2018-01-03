<?php

class gastos {

    public $_DB;
    public $_id_gasto;
    public $_descrip_gast;
    public $_cant_gast;
    public $_fecha_gast;
    public $_id_factura;
    public $_nom_empresa_gast;
    public $_nom_comp_gast;
    public $_iva_gast;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function gastos($id_gasto, $descrip_gast, $cant_gast, $fecha_gast, $id_factura, $nom_empresa_gast, $nom_comp_gast, $iva_gast) {

        $this->_id_gasto = $id_gasto;

        $this->_descrip_gast = $descrip_gast;

        $this->_cant_gast = $cant_gast;

        $this->_fecha_gast = $fecha_gast;

        $this->_id_factura = $id_factura;

        $this->_nom_empresa_gast = $nom_empresa_gast;

        $this->_nom_comp_gast = $nom_comp_gast;

        $this->_iva_gast = $iva_gast;
    }

    public function get_id_gasto() {

        return $this->_id_gasto;
    }

    public function set_id_gasto($id_gasto) {

        $this->_id_gasto = $id_gasto;
    }

    public function get_descrip_gast() {

        return $this->_descrip_gast;
    }

    public function set_descrip_gast($descrip_gast) {

        $this->_descrip_gast = $descrip_gast;
    }

    public function get_cant_gast() {

        return $this->_cant_gast;
    }

    public function set_cant_gast($cant_gast) {

        $this->_cant_gast = $cant_gast;
    }

    public function get_fecha_gast() {

        return $this->_fecha_gast;
    }

    public function set_fecha_gast($fecha_gast) {

        $this->_fecha_gast = $fecha_gast;
    }

   
    public function get_id_factura() {

        return $this->_id_factura;
    }

    public function set_id_factura($id_factura) {

        $this->_id_factura = $id_factura;
    }

    public function get_nom_empresa_gast() {

        return $this->_nom_empresa_gast;
    }

    public function set_nom_empresa_gast($nom_empresa_gast) {

        $this->_nom_empresa_gast = $nom_empresa_gast;
    }

    public function get_nom_comp_gast() {

        return $this->_nom_comp_gast;
    }

    public function set_nom_comp_gast($nom_comp_gast) {

        $this->_nom_comp_gast = $nom_comp_gast;
    }

    public function get_iva_gast() {

        return $this->_iva_gast;
    }

    public function set_iva_gast($iva_gast) {

        $this->_iva_gast = $iva_gast;
    }

    public function addGastos($gastos) {

        $sql = "";

        $sql = $sql . "'" . $gastos->get_descrip_gast() . "',";

        $sql = $sql . "'" . $gastos->get_cant_gast() . "',";

        $sql = $sql . "'" . $gastos->get_fecha_gast() . "',";

        $sql = $sql . "'" . $gastos->get_id_factura() . "',";

        $sql = $sql . "'" . $gastos->get_nom_empresa_gast() . "',";

        $sql = $sql . "'" . $gastos->get_nom_comp_gast() . "',";

        $sql = $sql . "'" . $gastos->get_iva_gast() . "'";

        $result = $this->_DB->select_query("call sp_gastosinsert (" . $sql . ")");

        return $result;
    }

    public function updateGastos($gastos) {

        $sql = "";

        $sql = $sql . "'" . $gastos->get_id_gasto() . "',";

        $sql = $sql . "'" . $gastos->get_descrip_gast() . "',";

        $sql = $sql . "'" . $gastos->get_cant_gast() . "',";

        $sql = $sql . "'" . $gastos->get_fecha_gast() . "',";

        $sql = $sql . "'" . $gastos->get_id_factura() . "',";

        $sql = $sql . "'" . $gastos->get_nom_empresa_gast() . "',";

        $sql = $sql . "'" . $gastos->get_nom_comp_gast() . "',";

        $sql = $sql . "'" . $gastos->get_iva_gast() . "'";

        $result = $this->_DB->alteration_query("call sp_gastosupdate (" . $sql . ")");

        return $result;
    }

    public function deleteGastos($id_gasto) {

        $sql = "DELETE FROM gastos WHERE id_gasto='" . $id_gasto . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showGastos($descrip_gast) {

        $gastos = new gastos();

        $sql = "SELECT * FROM gastos WHERE id_gasto=" . $id_gasto;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $gastos->set_id_gasto($row['id_gasto']);

            $gastos->set_descrip_gast($row['descrip_gast']);

            $gastos->set_cant_gast($row['cant_gast']);

            $gastos->set_fecha_gast($row['fecha_gast']);

            $gastos->set_id_factura($row['id_factura']);

            $gastos->set_nom_empresa_gast($row['nom_empresa_gast']);

            $gastos->set_nom_comp_gast($row['nom_comp_gast']);

            $gastos->set_iva_gast($row['iva_gast']);
        }

        return $gastos;
    }

    public function listGastoss($fecIni, $fecFinal) {

        $data = array();

        $sql = "SELECT * FROM gastos WHERE fecha_gastos>='" . $fecIni . "' AND fecha_gastos <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $gastos = new gastos();

            $gastos->set_id_gasto($row['id_gasto']);

            $gastos->set_descrip_gast($row['descrip_gast']);

            $gastos->set_cant_gast($row['cant_gast']);

            $gastos->set_fecha_gast($row['fecha_gast']);

            $gastos->set_id_factura($row['id_factura']);

            $gastos->set_nom_empresa_gast($row['nom_empresa_gast']);

            $gastos->set_nom_comp_gast($row['nom_comp_gast']);

            $gastos->set_iva_gast($row['iva_gast']);

            $data[] = $gastos;
        }

        return $data;
    }
    
    
    
      public function listJsonGastos($fecIni, $fecFinal) {
        $data = array();
        $sql = "SELECT * FROM gastos WHERE fecha_gast>='" . $fecIni . "' AND fecha_gast<='" . $fecFinal . "'";
        $result = $this->_DB->select_query($sql);
        foreach ($result as $row) {
            $data[] = array("id_gasto"=>$row['id_gasto'],"fecha_gast"=>$row['fecha_gast'],"descrip_gast"=>$row['descrip_gast'],
                "iva_gast"=>$row['iva_gast'],"cant_gast"=>$row['cant_gast']);
        }

        return json_encode($data);
    }
    
    

}

