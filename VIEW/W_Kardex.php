<?php

class W_kardex {

    public $Kardex;

    public function __construct() {

        $this->Kardex = new kardex();
    }

    

    public function printKardexs($idproducto,$fecIni, $fecFinal,$stock) {

        $ret = "";
        $data = array();
        $clsKardex=new kardex();
        $clsDetKardex=new detalle_kardex();
         $cal=0;
        $data = $this->Kardex->listKardexs($idproducto,$fecIni, $fecFinal);
        $ret = $ret . "<table class='display'  border='0'>";
        $ret = $ret . "<thead>";
        $ret = $ret ."<tr>";
        $ret = $ret ."<th style='width: 100px' rowspan='2' scope='col'>Fecha</th>";
        $ret = $ret ."<th style='width: 100px' rowspan='2' scope='col'>Documento</th>";
        $ret = $ret ."<th style='width: 250px'  colspan='3' scope='col'>Entradas</th>";
        $ret = $ret ."<th style='width: 250px' colspan='3' scope='col'>Salidas</th>";
        $ret = $ret . " <th style='width: 100px' rowspan='2' scope='col'>En Stock</th>";

        $ret = $ret ." </tr>";
        $ret = $ret ." <tr>";
        $ret = $ret ." <th style='width: 80px' scope='col'>C</th>";
        $ret = $ret ."<th style='width: 80px'   scope='col'>V.U</th>";
        $ret = $ret ."<th style='width: 80px'  scope='col'>V.T</th>";
        $ret = $ret ." <th style='width: 80px' scope='col'>C</th>";
        $ret = $ret ."<th style='width: 80px'   scope='col'>V.U</th>";
        $ret = $ret ."<th style='width: 80px'  scope='col'>V.T</th>";
        $ret = $ret ."</tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . " <tfoot>";
        $ret = $ret ."  <tr>";
        $ret = $ret . "<th colspan='7'></th>";
        $ret = $ret ." <th>Total :</th>";
        $ret = $ret ."<th>".$stock."</th>";
        $ret = $ret ."</tr>";
        $ret = $ret ." </tfoot>";
        $ret = $ret . "<tbody>";
        foreach ($data as $clsKardex) {
            $clsDetKardex=$clsDetKardex->showDetalle_kardex($clsKardex->get_id_kardex());
            $ret = $ret . "<tr class='odd'>";
            $ret = $ret . "<td>" .$clsKardex->get_fecha_kardex(). "</td>";
          
            $cal=$clsDetKardex->get_canti_detkardex()*$clsDetKardex->get_costo_detkardex();
            if($clsKardex->get_tipo_cmpbt_kardex()=='1'){//compra ó devol. de compra
                if($clsKardex->get_tipo_entrdsald_kardex()=='1'){//compro
                $ret = $ret . "<td>Compra nº ".$clsKardex->get_id_factcmp_kardex()." </td>";
                $ret = $ret . "<td>" . $clsDetKardex->get_canti_detkardex(). "</td>";
                $ret = $ret . "<td>" . $clsDetKardex->get_costo_detkardex(). "</td>";
                $ret = $ret . "<td>" . $cal. "</td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                }else{//4 devolución de mercadería
                 $ret = $ret . "<td>Dev.Compra nº ".$clsKardex->get_id_factcmp_kardex()." </td>";
                $ret = $ret . "<td>(" . $clsDetKardex->get_canti_detkardex(). ")</td>";
                $ret = $ret . "<td>(" . $clsDetKardex->get_costo_detkardex(). ")</td>";
                $ret = $ret . "<td>(" . $cal. ")</td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                }
               
            }else{//venta ó dev. de venta
                 if($clsKardex->get_tipo_entrdsald_kardex()=='3'){//3 venta
                $ret = $ret . "<td>Venta nº ".$clsKardex->get_id_factcmp_kardex()." </td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td>" .$clsDetKardex->get_canti_detkardex(). "</td>";
                $ret = $ret . "<td>" . $clsDetKardex->get_costo_detkardex().  "</td>";
                $ret = $ret . "<td>" . $cal."</td>";
                $ret = $ret . "<td></td>";
                 }else{//4 devol. de venta
                $ret = $ret . "<td>Dev.Venta nº ".$clsKardex->get_id_factcmp_kardex()." </td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td></td>";
                $ret = $ret . "<td>(" .$clsDetKardex->get_canti_detkardex(). ")</td>";
                $ret = $ret . "<td>(" . $clsDetKardex->get_costo_detkardex().")</td>";
                $ret = $ret . "<td>(" . $cal.")</td>";
                $ret = $ret . "<td></td>";
                 }
            }            
              
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

}

?>
