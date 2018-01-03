<?php

class detalle_gastos {

    public $_DB;
    public $_id_detgasto;
    public $_id_gasto;
    public $_nombre_produc;
    public $_costouni_detgasto;
    public $_canti_detgasto;
    public $_estado_detgasto;

    public function __construct() {

        $this->_DB = new Database();
    }

    public function detalle_gastos($id_detgasto, $id_gasto, $nombre_produc, $costouni_detgasto, $canti_detgasto, $estado_detgasto) {

        $this->_id_detgasto = $id_detgasto;

        $this->_id_gasto = $id_gasto;

        $this->_nombre_produc = $nombre_produc;

        $this->_costouni_detgasto = $costouni_detgasto;

        $this->_canti_detgasto = $canti_detgasto;

        $this->_estado_detgasto = $estado_detgasto;
    }

    public function get_id_detgasto() {

        return $this->_id_detgasto;
    }

    public function set_id_detgasto($id_detgasto) {

        $this->_id_detgasto = $id_detgasto;
    }

    public function get_id_gasto() {

        return $this->_id_gasto;
    }

    public function set_id_gasto($id_gasto) {

        $this->_id_gasto = $id_gasto;
    }

    public function get_nombre_produc() {

        return $this->_nombre_produc;
    }

    public function set_nombre_produc($nombre_produc) {

        $this->_nombre_produc = $nombre_produc;
    }

    public function get_costouni_detgasto() {

        return $this->_costouni_detgasto;
    }

    public function set_costouni_detgasto($costouni_detgasto) {

        $this->_costouni_detgasto = $costouni_detgasto;
    }

    public function get_canti_detgasto() {

        return $this->_canti_detgasto;
    }

    public function set_canti_detgasto($canti_detgasto) {

        $this->_canti_detgasto = $canti_detgasto;
    }

    public function get_estado_detgasto() {

        return $this->_estado_detgasto;
    }

    public function set_estado_detgasto($estado_detgasto) {

        $this->_estado_detgasto = $estado_detgasto;
    }

    public function addDetalle_gastos($detalle_gastos) {

        $sql = "";

        $sql = $sql . "'" . $detalle_gastos->get_id_gasto() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_nombre_produc() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_costouni_detgasto() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_canti_detgasto() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_estado_detgasto() . "'";

        $result = $this->_DB->select_query("call sp_detalle_gastosinsert (" . $sql . ")");

        return $result;
    }
    

    public function updateDetalle_gastos($detalle_gastos) {

        $sql = "";

        $sql = $sql . "'" . $detalle_gastos->get_id_detgasto() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_id_gasto() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_nombre_produc() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_costouni_detgasto() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_canti_detgasto() . "',";

        $sql = $sql . "'" . $detalle_gastos->get_estado_detgasto() . "'";

        $result = $this->_DB->alteration_query("call sp_detalle_gastosupdate (" . $sql . ")");

        return $result;
    }

    public function deleteDetalle_gastos($id_detgasto) {

        $sql = "DELETE FROM detalle_gastos WHERE id_detgasto='" . $id_detgasto . "'";

        $result = $this->_DB->alteration_query($sql);

        return $result;
    }

    /**

     * Login detalle_gastos 

     * @param <string> $user 

     * @param <string> $clave 

     * @return <> 

     * Devuelve en formato json lo siguiente: Si {1,'Next.php'} No {0,'Login incorrecto'} . 

     */
    public function json($estado, $txt) {

        return '{"estado":' . $estado . ',"txt":"' . $txt . '"}';
    }

    public function showDetalle_gastos($id_gasto) {

        $detalle_gastos = new detalle_gastos();

        $sql = "SELECT * FROM detalle_gastos WHERE id_detgasto=" . $id_detgasto;

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_gastos->set_id_detgasto($row['id_detgasto']);

            $detalle_gastos->set_id_gasto($row['id_gasto']);

            $detalle_gastos->set_nombre_produc($row['nombre_produc']);

            $detalle_gastos->set_costouni_detgasto($row['costouni_detgasto']);

            $detalle_gastos->set_canti_detgasto($row['canti_detgasto']);

            $detalle_gastos->set_estado_detgasto($row['estado_detgasto']);
        }

        return $detalle_gastos;
    }

    public function listDetalle_gastoss($fecIni, $fecFinal) {

        $data = array();

        $sql = "SELECT * FROM detalle_gastos WHERE fecha_detalle_gastos>='" . $fecIni . "' AND fecha_detalle_gastos <='" . $fecFinal . "'";

        $result = $this->_DB->select_query($sql);

        foreach ($result as $row) {

            $detalle_gastos = new detalle_gastos();

            $detalle_gastos->set_id_detgasto($row['id_detgasto']);

            $detalle_gastos->set_id_gasto($row['id_gasto']);

            $detalle_gastos->set_nombre_produc($row['nombre_produc']);

            $detalle_gastos->set_costouni_detgasto($row['costouni_detgasto']);

            $detalle_gastos->set_canti_detgasto($row['canti_detgasto']);

            $detalle_gastos->set_estado_detgasto($row['estado_detgasto']);

            $data[] = $detalle_gastos;
        }

        return $data;
    }

}

