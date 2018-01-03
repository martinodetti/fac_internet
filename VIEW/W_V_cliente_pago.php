<?php 


class W_v_cliente_pago { 

 public $V_cliente_pago; 

 public function  __construct() { 

 $this->V_cliente_pago=new v_cliente_pago();

 }

 
public function printV_cliente_pagos($fecIni) {

        $ret = "";
        $data = array();
        $clsV_cli_pago = new v_cliente_pago();
        $data = $this->V_cliente_pago->listV_cliente_pagos($fecIni);

        $ret = $ret . "<table class='display'  border='0'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th style='width: 100px'  scope='col'>ID_Cliente</th>";
        $ret = $ret . "<th style='width: 200px'  scope='col'>Cliente</th>";
        $ret = $ret . "<th style='width: 100px'  scope='col'>RUC</th>";
        $ret = $ret . "<th style='width: 100px'  scope='col'>Teléfono</th>";
        $ret = $ret . "<th style='width: 100px'  scope='col'>Celular</th>";
        $ret = $ret . "<th style='width: 100px'  scope='col'>Fecha</th>";
        $ret = $ret . "<th style='width: 100px'  scope='col'>Estado</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $clsV_cli_pago) {
            $ret = $ret . "<tr class='odd'>";
            $ret = $ret . "<td>" . $clsV_cli_pago->get_id_persona() . "</td>";
            $ret = $ret . "<td>" . $clsV_cli_pago->get_nom_persona() . ' ' . $clsV_cli_pago->get_ape_persona() . "</td>";
            $ret = $ret . "<td>" . $clsV_cli_pago->get_ruc_persona() . "</td>";
            $ret = $ret . "<td>" . $clsV_cli_pago->get_telf_persona() . "</td>";
            $ret = $ret . "<td>" . $clsV_cli_pago->get_cel_persona() . "</td>";
            $ret = $ret . "<td>" . $clsV_cli_pago->get_fecha_pago() . "</td>";
            $ret = $ret . "<td>POR PAGAR</td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }



 } 



?>
