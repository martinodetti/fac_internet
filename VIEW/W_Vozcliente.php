<?php
include '../MODEL/Vozcliente.php';

class W_vozcliente {

    public $vozcliente;

    public function __construct() {

        $this->vozcliente = new vozcliente();
    }

	public function printVozcliente($idvc = 0, $patente = "") {

        $ret = "";

        $data = array();

        $data = $this->vozcliente->listvozclientes($idvc, $patente);

        foreach ($data as $vozcliente) {

            $ret = $ret . trim($vozcliente->get_id_vozcliente()) . "^";
			
			$fec_arr_1 = explode(" ", $vozcliente->get_fecha());
			$fec_arr_2 = explode("-", $fec_arr_1[0]);
			$fecha = $fec_arr_2[2] . '-' . $fec_arr_2[1] . '-' . $fec_arr_2[0] . ' ' .  $fec_arr_1[1];
			
			
			$ret = $ret . trim($fecha) . "^";

            $ret = $ret . trim($vozcliente->get_patente()) . "^";

            $ret = $ret . trim($vozcliente->get_detalle()) . "^";

            $ret = $ret . trim($vozcliente->get_contacto()) . "";

			$ret = $ret . "|";
			
			$vozcliente = new vozcliente();
			
        }
                
		return trim($ret);
    }
	

}

?>
