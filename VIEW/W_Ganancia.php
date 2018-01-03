<?php

class W_ganancia {

    public $Ganancia;

    public function __construct() {

        $this->Ganancia = new ganancia();
    }

    public function printGanancia($idGanancia) {

        $ret = "";

        $this->Ganancia = $this->Ganancia->showGanancia($idGanancia);

        $ret = $ret . "<br>" . $this->Ganancia->get_id_ganancia();

        $ret = $ret . "<br>" . $this->Ganancia->get_porctj_ganancia();

        $ret = $ret . "<br>" . $this->Ganancia->get_descrip_ganancia();

        return $ret;
    }

    public function printGananciasPorPorcentaje($porcentaje) {

        $ret = "";
        $data = array();
        $Ganan=new ganancia();
        $data = $this->Ganancia->listGananciasPorPorcentaje($porcentaje);
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>id</th>";
        $ret = $ret . "<th class='tc'>Porcentaje</th>";
        $ret = $ret . "<th class='tc'>Descripción</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
       
        foreach ($data as $Ganan) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'> <input type='hidden' id='id_".$Ganan->get_id_ganancia()."' name='id_".$Ganan->get_id_ganancia()."' value='".$Ganan->get_id_ganancia()."' />" . $Ganan->get_id_ganancia() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='porctj_".$Ganan->get_id_ganancia()."' name='porctj_".$Ganan->get_id_ganancia()."' value='".$Ganan->get_porctj_ganancia()."' />" . $Ganan->get_porctj_ganancia() . "</td>";
            $ret = $ret . "<td ><input type='hidden' id='descrip_".$Ganan->get_id_ganancia()."' name='descrip_".$Ganan->get_id_ganancia()."' value='".$Ganan->get_descrip_ganancia()."' />" . $Ganan->get_descrip_ganancia() . "</td>";
          //  $ret = $ret . "<td > <input id='btn_update".$Ganan->get_id_ganancia()."' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update".$Ganan->get_id_ganancia()."' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" .$Ganan->get_id_ganancia() . "' name='btn_update" .$Ganan->get_id_ganancia() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
    
    public function printGananciasPorPorcentajeDelete($porcentaje) {

        $ret = "";
        $data = array();
        $Ganan=new ganancia();
        $data = $this->Ganancia->listGananciasPorPorcentaje($porcentaje);
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>id</th>";
        $ret = $ret . "<th class='tc'>Porcentaje</th>";
        $ret = $ret . "<th class='tc'>Descripción</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
       
        foreach ($data as $Ganan) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'> <input type='hidden' id='id_".$Ganan->get_id_ganancia()."' name='id_".$Ganan->get_id_ganancia()."' value='".$Ganan->get_id_ganancia()."' />" . $Ganan->get_id_ganancia() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='porctj_".$Ganan->get_id_ganancia()."' name='porctj_".$Ganan->get_id_ganancia()."' value='".$Ganan->get_porctj_ganancia()."' />" . $Ganan->get_porctj_ganancia() . "</td>";
            $ret = $ret . "<td ><input type='hidden' id='descrip_".$Ganan->get_id_ganancia()."' name='descrip_".$Ganan->get_id_ganancia()."' value='".$Ganan->get_descrip_ganancia()."' />" . $Ganan->get_descrip_ganancia() . "</td>";
            //$ret = $ret . "<td > <input id='btn_delete".$Ganan->get_id_ganancia()."' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete".$Ganan->get_id_ganancia()."' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_delete" . $Ganan->get_id_ganancia() . "' name='btn_delete" .$Ganan->get_id_ganancia(). "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
   
   

}

?>
