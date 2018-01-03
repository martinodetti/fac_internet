<?php 


class W_producto { 

 public $Producto; 

 public function  __construct() { 

 $this->Producto=new producto();

 }

 

public function printProducto($idProducto){ 

$ret="";

$this->Producto= $this->Producto->showProducto($idProducto);

$ret=$ret."<br>".$this->Producto->get_id_producto();

$ret=$ret."<br>".$this->Producto->get_id_tiporeten();

$ret=$ret."<br>".$this->Producto->get_id_marca();

$ret=$ret."<br>".$this->Producto->get_id_unimedida();

$ret=$ret."<br>".$this->Producto->get_id_ganancia();

$ret=$ret."<br>".$this->Producto->get_codbarra_producto();

$ret=$ret."<br>".$this->Producto->get_nom_producto();

$ret=$ret."<br>".$this->Producto->get_descrip_producto();

$ret=$ret."<br>".$this->Producto->get_costo_producto();

$ret=$ret."<br>".$this->Producto->get_pvp1_producto();

$ret=$ret."<br>".$this->Producto->get_stock_producto();

$ret=$ret."<br>".$this->Producto->get_stkmin_producto();

$ret=$ret."<br>".$this->Producto->get_stkmax_producto();

$ret=$ret."<br>".$this->Producto->get_img_producto();

$ret=$ret."<br>".$this->Producto->get_fecing_producto();

$ret=$ret."<br>".$this->Producto->get_fecvenci_producto();

$ret=$ret."<br>".$this->Producto->get_posicion_producto();

$ret=$ret."<br>".$this->Producto->get_estado_producto();

 return $ret;

} 



public function printProductosPorNombre($ProductoNom) {

        $ret = "";
        $data = array();
        $Producto = new producto();
        $data = $this->Producto->listProductosPorNombre($ProductoNom);
        $ret = $ret . "<table class='display' id='dt_example'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Producto</th>";
        $ret = $ret . "<th class='tc'>Costo</th>";
        $ret = $ret . "<th class='tc'>Precio de Venta</th>";
        $ret = $ret . "<th class='tc'>Fecha de Ingreso</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        $cont=0;
        foreach ($data as $Producto) {
 
            $ret = $ret . "<tr class='even'>";
          
            $ret = $ret . "<input type='hidden' id='idproducto_" . $Producto->get_id_producto() . "' name='idproducto_" . $Producto->get_id_producto() . "' value='" . $Producto->get_id_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='nom_" . $Producto->get_id_producto() . "' name='nom_" . $Producto->get_id_producto() . "' value='" . $Producto->get_nom_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='costo_" . $Producto->get_id_producto() . "' name='costo_" . $Producto->get_id_producto() . "' value='" . $Producto->get_costo_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='pvp_" . $Producto->get_id_producto() . "' name='pvp_" . $Producto->get_id_producto() . "' value='" . $Producto->get_pvp1_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='fecing_" . $Producto->get_id_producto() . "' name='fecing_" . $Producto->get_id_producto() . "' value='" . $Producto->get_fecing_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='fecvenci_" . $Producto->get_id_producto() . "' name='fecvenci_" . $Producto->get_id_producto() . "' value='" . $Producto->get_fecvenci_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='codbarra_" . $Producto->get_id_producto() . "' name='codbarra_" . $Producto->get_id_producto() . "' value='" . $Producto->get_codbarra_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='posprod_" . $Producto->get_id_producto() . "' name='posprod_" . $Producto->get_id_producto() . "' value='" . $Producto->get_posicion_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='descrip_" . $Producto->get_id_producto() . "' name='descrip_" . $Producto->get_id_producto() . "' value='" . $Producto->get_descrip_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='stkmin_" . $Producto->get_id_producto() . "' name='stkmin_" . $Producto->get_id_producto() . "' value='" . $Producto->get_stkmin_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='stkmax_" . $Producto->get_id_producto() . "' name='stkmax_" . $Producto->get_id_producto() . "' value='" . $Producto->get_stkmax_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='imgprod_" . $Producto->get_id_producto() . "' name='imgprod_" . $Producto->get_id_producto() . "' value='" . $Producto->get_img_producto() . "' />";
            

            $ret = $ret . "<input type='hidden' id='tiporeten_" . $Producto->get_id_producto() . "' name='tiporeten_" . $Producto->get_id_producto() . "' value='" . $Producto->get_id_tiporeten() . "' />";
            $ret = $ret . "<input type='hidden' id='marca_" . $Producto->get_id_producto() . "' name='marca_" . $Producto->get_id_producto() . "' value='" . $Producto->get_id_marca(). "' />";
            $ret = $ret . "<input type='hidden' id='medida_" . $Producto->get_id_producto() . "' name='medida_" . $Producto->get_id_producto() . "' value='" . $Producto->get_id_tiporeten() . "' />";
            $ret = $ret . "<input type='hidden' id='ganancia_" . $Producto->get_id_producto() . "' name='ganancia_" . $Producto->get_id_producto() . "' value='" . $Producto->get_id_ganancia(). "' />";     
            
            $ret = $ret . "<td class='tc'>" . $Producto->get_id_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_nom_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_costo_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_pvp1_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_fecing_producto() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_update" . $Producto->get_id_producto() . "' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Producto->get_id_producto() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $Producto->get_id_producto()  . "' name='btn_update" .$Producto->get_id_producto() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
              $cont++;
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
    

public function printProductosPorNombreDelete($ProductoNom) {

        $ret = "";
        $data = array();
        $Producto = new producto();
        $data = $this->Producto->listProductosPorNombre($ProductoNom);
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Codigo</th>";
        $ret = $ret . "<th class='tc'>Producto</th>";
        $ret = $ret . "<th class='tc'>Costo</th>";
        $ret = $ret . "<th class='tc'>Precio de Venta</th>";
        $ret = $ret . "<th class='tc'>Stock</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        $cont=0;
        foreach ($data as $Producto) {
            
             $ret = $ret . "<tr class='even'>";  
          
            $ret = $ret . "<input type='hidden' id='idproducto_" . $Producto->get_id_producto() . "' name='idproducto_" . $Producto->get_id_producto() . "' value='" . $Producto->get_id_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='nom_" . $Producto->get_id_producto() . "' name='nom_" . $Producto->get_id_producto() . "' value='" . $Producto->get_nom_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='costo_" . $Producto->get_id_producto() . "' name='costo_" . $Producto->get_id_producto() . "' value='" . $Producto->get_costo_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='pvp_" . $Producto->get_id_producto() . "' name='pvp_" . $Producto->get_id_producto() . "' value='" . $Producto->get_pvp1_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='fecing_" . $Producto->get_id_producto() . "' name='fecing_" . $Producto->get_id_producto() . "' value='" . $Producto->get_fecing_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='fecvenci_" . $Producto->get_id_producto() . "' name='fecvenci_" . $Producto->get_id_producto() . "' value='" . $Producto->get_fecupdate_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='codbarra_" . $Producto->get_id_producto() . "' name='codbarra_" . $Producto->get_id_producto() . "' value='" . $Producto->get_codbarra_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='posprod_" . $Producto->get_id_producto() . "' name='posprod_" . $Producto->get_id_producto() . "' value='" . $Producto->get_posicion_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='descrip_" . $Producto->get_id_producto() . "' name='descrip_" . $Producto->get_id_producto() . "' value='" . $Producto->get_descrip_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='stkmin_" . $Producto->get_id_producto() . "' name='stkmin_" . $Producto->get_id_producto() . "' value='" . $Producto->get_stkmin_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='stkmax_" . $Producto->get_id_producto() . "' name='stkmax_" . $Producto->get_id_producto() . "' value='" . $Producto->get_stkmax_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='imgprod_" . $Producto->get_id_producto() . "' name='imgprod_" . $Producto->get_id_producto() . "' value='" . $Producto->get_img_producto() . "' />";
            $ret = $ret . "<input type='hidden' id='stkmax" . $Producto->get_id_producto() . "' name='stkmax" . $Producto->get_id_producto() . "' value='" . $Producto->get_stkmax_producto() . "' />";


            $ret = $ret . "<td class='tc'>" . $Producto->get_id_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_nom_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_descrip_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_costo_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_pvp1_producto() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Producto->get_stock_producto() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_delete" . $Producto->get_id_producto() . "' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete" . $Producto->get_id_producto() . "' /></td>";
             $ret = $ret . "<td class='tc'><a id='btn_delete" .$Producto->get_id_producto(). "' name='btn_delete" .$Producto->get_id_producto() . "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
            $cont++;
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
        

} 
?>
