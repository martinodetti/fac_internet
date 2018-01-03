<?php
include '../MODEL/Orden.php';
include_once '../MODEL/Presupuesto.php';
include_once '../MODEL/Remito.php';

class W_remito {

    public $remito;
    public $orden;

    public function __construct() {

        $this->remito = new remito();
        $this->orden = new orden();
    }

    public function printremito($idremito) {

        $ret = "";

        $this->remito = $this->remito->showremito($idremito);

        $ret = $ret . "<br>" . $this->remito->get_id_remi();

        $ret = $ret . "<br>" . $this->remito->get_id_vehiculo();

        $ret = $ret . "<br>" . $this->remito->get_id_cliente();

        $ret = $ret . "<br>" . $this->remito->get_id_orden();
		
		$ret = $ret . "<br>" . $this->remito->get_id_vendedor();

        $ret = $ret . "<br>" . $this->remito->get_num_remi();

        $ret = $ret . "<br>" . $this->remito->get_obs_remi();

        $ret = $ret . "<br>" . $this->remito->get_total_remi();

        $ret = $ret . "<br>" . $this->remito->get_fecemi_remi();
		
		$ret = $ret . "<br>" . $this->remito->get_estado_remi();

        return $ret;
    }

    public function printremitos($fecIni, $fecFinal) {

        $ret = "";

        $data = array();

        $data = $this->remito->listremitos($fecIni, $fecFinal);

        $ret = $ret . "<table border='1'>";

        $ret = $ret . "<thead>";

        $ret = $ret . "<tr>";

        $ret = $ret . "<th>id_remi</th>";

        $ret = $ret . "<th>id_orden</th>";

        $ret = $ret . "<th>id_vehiculo</th>";

		$ret = $ret . "<th>id_cliente</th>";
		
        $ret = $ret . "<th>id_vendedor</th>";

        $ret = $ret . "<th>obs_remi</th>";

        $ret = $ret . "<th>total_remi</th>";

        $ret = $ret . "<th>fecemi_remi</th>";

        $ret = $ret . "<th>estado_remi</th>";

        $ret = $ret . " </tr>";

        $ret = $ret . "</thead>";

        $ret = $ret . "<tbody>";

        foreach ($data as $remito) {

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_id_remi() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_id_vehiculo() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";
			
			$ret = $ret . "<td>" . $this->remito->get_id_orden() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_id_cliente() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_id_vendedor() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_obs_remi() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_total_remi() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_fecemi_remi() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->remito->get_estado_fact() . "</td>";

            $ret = $ret . "</tr>";
        }



        $ret = $ret . "</tbody>";

        $ret = $ret . "</table>";
    }
	
	public function printremitosCliente($idCliente) {

        $ret = "";

        $data = array();

        $data = $this->remito->listRemitosCliente($idCliente);

        foreach ($data as $remito) {

            $ret = $ret . trim($remito->get_id_remi()) . ";";

			$ret = $ret . "remito;";

            $ret = $ret . trim($remito->get_dominio()) . ";";

            $ret = $ret . trim($remito->get_total_remi()) . ";";

            $ret = $ret . trim($remito->get_fecemi_remi()) . "";

            $ret = $ret . "|";
			
			$remito = new remito();
			
        }
        
        $data = array();
        
        $data = $this->orden->listordenCliente($idCliente);
        
		foreach ($data as $orden) {

            $ret = $ret . trim($orden->get_id_orden()) . ";";

			$ret = $ret . "orden;";

            $ret = $ret . trim($orden->get_dominio()) . ";";

            $ret = $ret . trim($orden->get_total_orden()) . ";";

            $ret = $ret . trim($orden->get_fecemi_orden()) . "";

            $ret = $ret . "|";
			
			$orden = new orden();
			
        }
        
        
		return trim($ret);
    }
    
    //lo meti aca porque no tenia ganas de hacer un archivo nuevo para estar sola funcion
    
    public function printPresupuestos() { // para importar un presupuesto desde una orden

        $ret = "";

        $data = array();
        
        $presu = new presupuesto();
        $data = $presu->listpresupuesto();
        
		foreach ($data as $presu) {

            $ret = $ret . trim($presu->get_id_presupuesto()) . ";";
            
            $ret = $ret . trim($presu->get_fecemi_presupuesto()) . ";";

            $ret = $ret . trim($presu->get_dominio()) . ";";

            $ret = $ret . trim($presu->get_total_presupuesto()) . "";

            $ret = $ret . "|";
			
        }
        
        
		return trim($ret);
    }
	

}

?>
