<?php 

class W_Provincia { 
 public $provincia; 
 
 public function  __construct() { 
 $this->provincia=new provincia();
 }

public function printProvincia($idProvincia){ 
$ret="";
$this->provincia= $this->provincia->showprovincia($idprovincia);
$ret=$ret."<br>".$this->provincia->get_id_provincia();
$ret=$ret."<br>".$this->provincia->get_nom_provincia();
 return $ret;

} 


public function printprovinciasPorNombre($provincia_nom) {

        $ret = "";
        $data = array();
        $provincia = new provincia();
        $data = $this->provincia->listprovincias($provincia_nom);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>provincia</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";

        foreach ($data as $provincia) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_" . $provincia->get_id_provincia() . "' name='id_" . $provincia->get_id_provincia() . "' value='" . $provincia->get_id_provincia() . "' />" . $provincia->get_id_provincia() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='provincia_" . $provincia->get_id_provincia() . "' name='provincia_" . $provincia->get_id_provincia() . "' value='" . $provincia->get_nom_provincia() . "' />" . $provincia->get_nom_provincia() . "</td>";
            //$ret = $ret . "<td > <input id='btn_update" . $provincia->get_id_provincia() . "' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $provincia->get_id_provincia() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $provincia->get_id_provincia() . "' name='btn_update" .$provincia->get_id_provincia() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

    
public function printprovinciasPorNombreDelete($provincia_onm) {

        $ret = "";
        $data = array();
        $provincia = new provincia();
        $data = $this->provincia->listprovincias($provincia_onm);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>provincia</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";

        foreach ($data as $provincia) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_" . $provincia->get_id_provincia() . "' name='id_" . $provincia->get_id_provincia() . "' value='" . $provincia->get_id_provincia() . "' />" . $provincia->get_id_provincia() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='provincia_" . $provincia->get_id_provincia() . "' name='provincia_" . $provincia->get_id_provincia() . "' value='" . $provincia->get_nom_provincia() . "' />" . $provincia->get_nom_provincia() . "</td>";
            //$ret = $ret . "<td > <input id='btn_delete" . $provincia->get_id_provincia() . "' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete" . $provincia->get_id_provincia() . "' /></td>";
             $ret = $ret . "<td class='tc'><a id='btn_delete" . $provincia->get_id_provincia() . "' name='btn_delete" .$provincia->get_id_provincia() . "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }    

	public function printLocalidadesProvincia($idprovincia) {

        $ret = "";

        $data = array();

        $data = $this->provincia->listCiudades($idprovincia);

        foreach ($data as $ciudad) {

            $ret = $ret . trim($ciudad->get_id_ciudad()) . ";";

            $ret = $ret . trim($ciudad->get_nom_ciudad());

            $ret = $ret . "|";
			
			$ciudad = new ciudad();
			
        }
        
		return trim($ret);
    }
    
    
} 

?>
