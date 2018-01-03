<?php 

class W_unidad_medida { 

 public $Unidad_medida; 

 public function  __construct() { 

 $this->Unidad_medida=new unidad_medida();

 }




public function printUnidad_medidasPorNombre($medida_nom) {
        $ret = "";
        $data = array();
        $Medida=new unidad_medida();
        $data = $this->Unidad_medida->listUnidad_medidasPorNombre($medida_nom);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Unidad de Medida</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Medida) {
            $ret = $ret . "<tr  class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_". $Medida->get_id_unimedida()."' name='id_". $Medida->get_id_unimedida()."' value='".$Medida->get_id_unimedida()."' />" . $Medida->get_id_unimedida() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='medida_". $Medida->get_id_unimedida()."' name='medida_". $Medida->get_id_unimedida()."' value='".$Medida->get_nom_unimedida()."' />" . $Medida->get_nom_unimedida() . "</td>";
           // $ret = $ret . "<td > <input id='btn_update".$Medida->get_id_unimedida()."' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update".$Medida->get_id_unimedida()."' /></td>";
           $ret = $ret . "<td class='tc'><a id='btn_update" . $Medida->get_id_unimedida() . "' name='btn_update" .$Medida->get_id_unimedida() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
      return $ret;
    }

public function printUnidad_medidasPorNombreDelete($medida_nom) {
        $ret = "";
        $data = array();
        $Medida=new unidad_medida();
        $data = $this->Unidad_medida->listUnidad_medidasPorNombre($medida_nom);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Unidad de Medida</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Medida) {
            $ret = $ret . "<tr  class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_". $Medida->get_id_unimedida()."' name='id_". $Medida->get_id_unimedida()."' value='".$Medida->get_id_unimedida()."' />" . $Medida->get_id_unimedida() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='medida_". $Medida->get_id_unimedida()."' name='medida_". $Medida->get_id_unimedida()."' value='".$Medida->get_nom_unimedida()."' />" . $Medida->get_nom_unimedida() . "</td>";
            //$ret = $ret . "<td > <input id='btn_delete".$Medida->get_id_unimedida()."' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete".$Medida->get_id_unimedida()."' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_delete" . $Medida->get_id_unimedida() . "' name='btn_delete" .$Medida->get_id_unimedida() . "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

} 



?>
