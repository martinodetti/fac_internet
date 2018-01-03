<?php

class W_detalle_remito {

    public $Detalle_remito;

    public function __construct() {

        $this->Detalle_remito = new detalle_remito();
    }

    public function printDetalle_remito($id_remito) {

        $ret = "";
        $this->Detalle_remito = $this->Detalle_remito->showDetalle_remito_vista($id_remito);

        $ret = $ret . "<table border='1'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";

        $ret = $ret . "<th>Producto</th>";
        $ret = $ret . "<th>Precio unitario</th>";
        $ret = $ret . "<th>Cantidad</th>";
        $ret = $ret . "<th>Subtotal</th>";

        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";

        $ret = $ret . "<tbody>";

        foreach ($data as $Detalle_remito) {

            $ret = $ret . "<tr>";
            $ret = $ret . "<td>" . $this->Detalle_remito->get_nom_producto() . "</td>";
            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";
            $ret = $ret . "<td>" . $this->Detalle_remito->precio_detremi() . "</td>";
            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";
            $ret = $ret . "<td>" . $this->Detalle_remito->get_canti_detremi() . "</td>";
            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";
            $ret = $ret . "<td>" . $this->Detalle_remito->precio_detremi() * $this->Detalle_remito->get_canti_detremi() . "</td>";
			$ret = $ret . "</tr>";

        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";

        return $ret;
    }

    public function printDetalle_remitos($fecIni, $fecFinal) {

        $ret = "";

        $data = array();

        $data = $this->Detalle_remito->listDetalle_remitos($fecIni, $fecFinal);

        $ret = $ret . "<table border='1'>";

        $ret = $ret . "<thead>";

        $ret = $ret . "<tr>";

        $ret = $ret . "<th>id_detremito</th>";

        $ret = $ret . "<th>id_remito</th>";

        $ret = $ret . "<th>id_producto</th>";

        $ret = $ret . "<th>costouni_detremito</th>";

        $ret = $ret . "<th>canti_detremito</th>";

        $ret = $ret . "<th>estado_detremito</th>";

        $ret = $ret . " </tr>";

        $ret = $ret . "</thead>";

        $ret = $ret . "<tbody>";

        foreach ($data as $Detalle_remito) {

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_remito->get_id_detremito() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_remito->get_id_remito() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_remito->get_id_producto() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_remito->get_costouni_detremito() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_remito->get_canti_detremito() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Detalle_remito->get_estado_detremito() . "</td>";

            $ret = $ret . "</tr>";
        }



        $ret = $ret . "</tbody>";

        $ret = $ret . "</table>";
    }

}

?>
