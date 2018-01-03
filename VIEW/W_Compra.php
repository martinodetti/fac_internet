<?php
include_once '../MODEL/Compra.php';

class W_compra {

    public $Compra;

    public function __construct() {

        $this->Compra = new compra();
    }

    public function printCompra($idCompra) {

        $ret = "";

        $this->Compra = $this->Compra->showCompra($idCompra);

        $ret = $ret . "<br>" . $this->Compra->get_id_compra();

        $ret = $ret . "<br>" . $this->Compra->get_id_provd();

        $ret = $ret . "<br>" . $this->Compra->get_guiacod_compra();

        $ret = $ret . "<br>" . $this->Compra->get_total_compra();

        $ret = $ret . "<br>" . $this->Compra->get_obs_compra();

        $ret = $ret . "<br>" . $this->Compra->get_baseGrava_compra();

        $ret = $ret . "<br>" . $this->Compra->get_fec_compra();

        $ret = $ret . "<br>" . $this->Compra->get_estado_compra();

        return $ret;
    }

    public function printCompras($fecIni, $fecFinal) {

        $ret = "";

        $data = array();

        $data = $this->Compra->listCompras($fecIni, $fecFinal);

        $ret = $ret . "<table border='1'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th>id_compra</th>";
        $ret = $ret . "<th>id_provd</th>";
        $ret = $ret . "<th>guiacod_compra</th>";
        $ret = $ret . "<th>total_compra</th>";
        $ret = $ret . "<th>obs_compra</th>";
        $ret = $ret . "<th>baseGrava_compra</th>";
        $ret = $ret . "<th>fec_compra</th>";
        $ret = $ret . "<th>estado_compra</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";

        $ret = $ret . "<tbody>";

        foreach ($data as $Compra) {

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_id_compra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_id_provd() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_guiacod_compra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_total_compra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_obs_compra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_baseGrava_compra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_fec_compra() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Compra->get_estado_compra() . "</td>";

            $ret = $ret . "</tr>";
        }



        $ret = $ret . "</tbody>";

        $ret = $ret . "</table>";
    }
    
    public function printComprasProveedor($idprovd) {
		
		$compra = new compra();
		
        $ret = "";

        $data = array();

        $data = $compra->listComprasProveedor($idprovd);

        foreach ($data as $comp) {

            $ret = $ret . trim($comp['id_compra']) . ";";
            
            $ret = $ret . trim($comp['guiacod_compra']) . ";";

            $ret = $ret . trim($comp['total_compra']) . ";";

            $ret = $ret . trim($comp['fec_compra']) . ";";
			
			$ret = $ret . trim($comp['guiacod_compra']);

            $ret = $ret . "|";

			
        }
        
        return trim($ret);
    }

}

?>
