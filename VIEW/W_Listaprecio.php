<?php

class W_listaprecio {

    public $Listaprecio;

    public function __construct() {

        $this->Listaprecio = new listaprecio();
    }

    public function printListaprecio($idListaprecio) {

        $ret = "";

        $this->Listaprecio = $this->Listaprecio->showListaprecio($idListaprecio);

        $ret = $ret . "<br>" . $this->Listaprecio->get_id_listaprecio();

        $ret = $ret . "<br>" . $this->Listaprecio->get_porcentaje_listaprecio();

        $ret = $ret . "<br>" . $this->Listaprecio->get_nombre_listaprecio();

        return $ret;
    }

    public function printListapreciosPorPorcentaje($porcentaje) {

        $ret = "";
        $data = array();
        $Ganan=new listaprecio();
        $data = $this->Listaprecio->listListapreciosPorPorcentaje($porcentaje);
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
            $ret = $ret . "<td class='tc'> <input type='hidden' id='id_".$Ganan->get_id_listaprecio()."' name='id_".$Ganan->get_id_listaprecio()."' value='".$Ganan->get_id_listaprecio()."' />" . $Ganan->get_id_listaprecio() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='porcentaje_".$Ganan->get_id_listaprecio()."' name='porcentaje_".$Ganan->get_id_listaprecio()."' value='".$Ganan->get_porcentaje_listaprecio()."' />" . $Ganan->get_porcentaje_listaprecio() . "</td>";
            $ret = $ret . "<td ><input type='hidden' id='nombre_".$Ganan->get_id_listaprecio()."' name='nombre_".$Ganan->get_id_listaprecio()."' value='".$Ganan->get_nombre_listaprecio()."' />" . $Ganan->get_nombre_listaprecio() . "</td>";
          //  $ret = $ret . "<td > <input id='btn_update".$Ganan->get_id_listaprecio()."' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update".$Ganan->get_id_listaprecio()."' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" .$Ganan->get_id_listaprecio() . "' name='btn_update" .$Ganan->get_id_listaprecio() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
    
    public function printListapreciosPorPorcentajeDelete($porcentaje) {

        $ret = "";
        $data = array();
        $Ganan=new listaprecio();
        $data = $this->Listaprecio->listListapreciosPorPorcentaje($porcentaje);
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
            $ret = $ret . "<td class='tc'> <input type='hidden' id='id_".$Ganan->get_id_listaprecio()."' name='id_".$Ganan->get_id_listaprecio()."' value='".$Ganan->get_id_listaprecio()."' />" . $Ganan->get_id_listaprecio() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='porcentaje_".$Ganan->get_id_listaprecio()."' name='porcentaje_".$Ganan->get_id_listaprecio()."' value='".$Ganan->get_porcentaje_listaprecio()."' />" . $Ganan->get_porcentaje_listaprecio() . "</td>";
            $ret = $ret . "<td ><input type='hidden' id='nombre_".$Ganan->get_id_listaprecio()."' name='nombre_".$Ganan->get_id_listaprecio()."' value='".$Ganan->get_nombre_listaprecio()."' />" . $Ganan->get_nombre_listaprecio() . "</td>";
            //$ret = $ret . "<td > <input id='btn_delete".$Ganan->get_id_listaprecio()."' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete".$Ganan->get_id_listaprecio()."' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_delete" . $Ganan->get_id_listaprecio() . "' name='btn_delete" .$Ganan->get_id_listaprecio(). "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
   
   

}

?>
