<?php
include_once '../MODEL/Factura.php';

class W_factura {

    public $Factura;

    public function __construct() {

        $this->Factura = new factura();
    }

    public function printFactura($idFactura) {

        $ret = "";

        $this->Factura = $this->Factura->showFactura($idFactura);

        $ret = $ret . "<br>" . $this->Factura->get_id_fact();

        $ret = $ret . "<br>" . $this->Factura->get_id_empresa();

        $ret = $ret . "<br>" . $this->Factura->get_id_cliente();

        $ret = $ret . "<br>" . $this->Factura->get_id_vendedor();

        $ret = $ret . "<br>" . $this->Factura->get_descto_fact();

        $ret = $ret . "<br>" . $this->Factura->get_obs_fact();

        $ret = $ret . "<br>" . $this->Factura->get_fecemi_fact();

        $ret = $ret . "<br>" . $this->Factura->get_estado_fact();
        
        $ret = $ret . "<br>" . $this->Factura->get_or_y_remito_fact();

        return $ret;
    }

    public function printFacturas($fecIni, $fecFinal) {

        $ret = "";

        $data = array();

        $data = $this->Factura->listFacturas($fecIni, $fecFinal);

        $ret = $ret . "<table border='1'>";

        $ret = $ret . "<thead>";

        $ret = $ret . "<tr>";

        $ret = $ret . "<th>id_fact</th>";

        $ret = $ret . "<th>id_empresa</th>";

        $ret = $ret . "<th>id_cliente</th>";

        $ret = $ret . "<th>id_vendedor</th>";

        $ret = $ret . "<th>descto_fact</th>";

        $ret = $ret . "<th>obs_fact</th>";

        $ret = $ret . "<th>fecemi_fact</th>";

        $ret = $ret . "<th>estado_fact</th>";

        $ret = $ret . " </tr>";

        $ret = $ret . "</thead>";

        $ret = $ret . "<tbody>";

        foreach ($data as $Factura) {

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_id_fact() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_id_empresa() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_id_cliente() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_id_vendedor() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_descto_fact() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_obs_fact() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_fecemi_fact() . "</td>";

            $ret = $ret . "</tr>";

            $ret = $ret . "<tr>";

            $ret = $ret . "<td>" . $this->Factura->get_estado_fact() . "</td>";

            $ret = $ret . "</tr>";
        }



        $ret = $ret . "</tbody>";

        $ret = $ret . "</table>";
	}

	public function printfacturasClienteToNotaCredito($idCliente){
		$factura = new factura();
		$ret = "";
		$data = array();
		$data = $this->Factura->listFacturasClienteToNotaCredito($idCliente);

		foreach ($data as $factura) {

			$ret = $ret . trim($factura->get_id_fact()) . ";";

			$ret = $ret . trim($factura->get_num_fact()) . ";";

			$ret = $ret . trim($factura->get_total_fact()) . ";";
			
			$ret = $ret . trim($factura->get_fecemi_fact()) . ";";
													            
			$ret = $ret . trim($factura->get_or_y_remito_fact());
			$ret = $ret . "|";
																            
			$factura = new factura();

		}

		return trim($ret);

	}		
    
    public function printfacturasCliente($idCliente) {
		
		$factura = new factura();
		
        $ret = "";

        $data = array();

        $data = $this->Factura->listFacturasCliente($idCliente);

        foreach ($data as $factura) {

            $ret = $ret . trim($factura->get_id_fact()) . ";";
            
            $ret = $ret . trim($factura->get_num_fact()) . ";";

            $ret = $ret . trim($factura->get_total_fact()) . ";";

            $ret = $ret . trim($factura->get_fecemi_fact()) . ";";
            
            $ret = $ret . trim($factura->get_or_y_remito_fact());

            $ret = $ret . "|";
			
			$factura = new factura();
			
        }
        
        return trim($ret);
    }
    
    public function printUltimasfacturasCliente($idCliente) {
		
		$factura = new factura();
		
        $ret = "";

        $data = array();

        $data = $this->Factura->listUltimasFacturasCliente($idCliente);

        foreach ($data as $factura) {

            $ret = $ret . trim($factura->get_id_fact()) . ";";
            
            $ret = $ret . trim($factura->get_num_fact()) . ";";

            $ret = $ret . trim($factura->get_total_fact()) . ";";

            $ret = $ret . trim($factura->get_fecemi_fact()) . ";";
            
            $ret = $ret . trim($factura->get_or_y_remito_fact());

            $ret = $ret . "|";
			
			$factura = new factura();
			
        }
        
        return trim($ret);
    }

}

?>
