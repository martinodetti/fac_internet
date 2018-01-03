<?php 

class W_marca_producto { 
 public $Marca_producto; 
 
 public function  __construct() { 
 $this->Marca_producto=new marca_producto();
 }

public function printMarca_producto($idMarca_producto){ 
$ret="";
$this->Marca_producto= $this->Marca_producto->showMarca_producto($idMarca_producto);
$ret=$ret."<br>".$this->Marca_producto->get_id_marca();
$ret=$ret."<br>".$this->Marca_producto->get_nom_marca();
 return $ret;

} 


public function printMarca_productosPorNombre($marca_nom) {

        $ret = "";
        $data = array();
        $marca = new marca_producto();
        $data = $this->Marca_producto->listMarca_productos($marca_nom);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Marca</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";

        foreach ($data as $marca) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_" . $marca->get_id_marca() . "' name='id_" . $marca->get_id_marca() . "' value='" . $marca->get_id_marca() . "' />" . $marca->get_id_marca() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='marca_" . $marca->get_id_marca() . "' name='marca_" . $marca->get_id_marca() . "' value='" . $marca->get_nom_marca() . "' />" . $marca->get_nom_marca() . "</td>";
            //$ret = $ret . "<td > <input id='btn_update" . $marca->get_id_marca() . "' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $marca->get_id_marca() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $marca->get_id_marca() . "' name='btn_update" .$marca->get_id_marca() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

    
public function printMarca_productosPorNombreDelete($marca_onm) {

        $ret = "";
        $data = array();
        $marca = new marca_producto();
        $data = $this->Marca_producto->listMarca_productos($marca_onm);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Marca</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";

        foreach ($data as $marca) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_" . $marca->get_id_marca() . "' name='id_" . $marca->get_id_marca() . "' value='" . $marca->get_id_marca() . "' />" . $marca->get_id_marca() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='marca_" . $marca->get_id_marca() . "' name='marca_" . $marca->get_id_marca() . "' value='" . $marca->get_nom_marca() . "' />" . $marca->get_nom_marca() . "</td>";
            //$ret = $ret . "<td > <input id='btn_delete" . $marca->get_id_marca() . "' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete" . $marca->get_id_marca() . "' /></td>";
             $ret = $ret . "<td class='tc'><a id='btn_delete" . $marca->get_id_marca() . "' name='btn_delete" .$marca->get_id_marca() . "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }    
    
    
} 

?>
