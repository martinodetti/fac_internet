<?php

class W_detalle_compra {

    public $Detalle_compra;

    public function __construct() {

        $this->Detalle_compra = new detalle_compra();
    }

    public function printDetalle_compra($idDetalle_compra) {

        $ret = "";

        $this->Detalle_compra = $this->Detalle_compra->showDetalle_compra($idDetalle_compra);

        $ret = $ret . "<br>" . $this->Detalle_compra->get_id_detcompra();

        $ret = $ret . "<br>" . $this->Detalle_compra->get_id_compra();

        $ret = $ret . "<br>" . $this->Detalle_compra->get_id_producto();

        $ret = $ret . "<br>" . $this->Detalle_compra->get_costouni_detcompra();

        $ret = $ret . "<br>" . $this->Detalle_compra->get_canti_detcompra();

        $ret = $ret . "<br>" . $this->Detalle_compra->get_estado_detcompra();

        return $ret;
    }

    public function printDetalle_compras($fecIni, $fecFinal) {

        $ret = "";

        $data = array();

        $data = $this->Detalle_compra->listDetalle_compras($fecIni, $fecFinal);

        $ret = $ret . "<table border='1'>";

        $ret = $ret . "<thead>";

        $ret = $ret . "<tr>";

        $ret = $ret . "<th>id_detcompra</th>";

        $ret = $ret . "<th>id_compra</th>";

        $ret = $ret . "<th>id_producto</th>";

        $ret = $ret . "<th>costouni_detcompra</th>";

        $ret = $ret . "<th>canti_detcompra</th>";

        $ret = $ret . "<th>estado_detcompra</th>";

        $ret = $ret . " </tr>";

        $ret = $ret . "</thead>";

        $ret = $ret . "<tbody>";

        foreach ($data as $Detalle_compra) {

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_compra->get_id_detcompra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_compra->get_id_compra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_compra->get_id_producto() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_compra->get_costouni_detcompra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_compra->get_canti_detcompra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_compra->get_estado_detcompra() . "</td>";

            $ret = $ret . "</tr>";
        }



        $ret = $ret . "</tbody>";

        $ret = $ret . "</table>";
    }

}

?>
