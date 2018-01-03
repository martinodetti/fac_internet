<?php

class W_tiporetencion {

    public $Tiporetencion;

    public function __construct() {

        $this->Tiporetencion = new tiporetencion();
    }

    public function printTiporetencions($descrip) {

        $ret = "";
        $data = array();
        $Retencion = new tiporetencion();
        $data = $this->Tiporetencion->listTiporetencions($descrip);
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Código</th>";
        $ret = $ret . "<th class='tc'>Descripción</th>";
        $ret = $ret . "<th class='tc'>Porcentaje</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Retencion) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_" . $Retencion->get_id_tiporeten() . "' name='id_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_id_tiporeten() . "' />" . $Retencion->get_id_tiporeten() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='cod_" . $Retencion->get_id_tiporeten() . "' name='cod_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_cod_codRetAir() . "' />" . $Retencion->get_cod_codRetAir() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='reten_" . $Retencion->get_id_tiporeten() . "' name='reten_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_nom_codRetAir() . "' />" . $Retencion->get_nom_codRetAir() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='porce_" . $Retencion->get_id_tiporeten() . "' name='porce_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_porcentaje_codRetAir() . "' />" . $Retencion->get_porcentaje_codRetAir() . "</td>";
//$ret=$ret."<td class='tc'><input id='btn_update" . $Retencion->get_id_tiporeten(). "' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Retencion->get_id_tiporeten() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $Retencion->get_id_tiporeten() . "' name='btn_update" . $Retencion->get_id_tiporeten() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";

            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

    public function printTiporetencionsDelete($descrip) {

        $ret = "";
        $data = array();
        $Retencion = new tiporetencion();
        $data = $this->Tiporetencion->listTiporetencions($descrip);
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Código</th>";
        $ret = $ret . "<th class='tc'>Descripción</th>";
        $ret = $ret . "<th class='tc'>Porcentaje</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Retencion) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='id_" . $Retencion->get_id_tiporeten() . "' name='id_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_id_tiporeten() . "' />" . $Retencion->get_id_tiporeten() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='cod_" . $Retencion->get_id_tiporeten() . "' name='cod_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_cod_codRetAir() . "' />" . $Retencion->get_cod_codRetAir() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='reten_" . $Retencion->get_id_tiporeten() . "' name='reten_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_nom_codRetAir() . "' />" . $Retencion->get_nom_codRetAir() . "</td>";
            $ret = $ret . "<td class='tc'><input type='hidden' id='porce_" . $Retencion->get_id_tiporeten() . "' name='porce_" . $Retencion->get_id_tiporeten() . "' value='" . $Retencion->get_porcentaje_codRetAir() . "' />" . $Retencion->get_porcentaje_codRetAir() . "</td>";
//$ret=$ret."<td class='tc'><input id='btn_delete" . $Retencion->get_id_tiporeten(). "' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete" . $Retencion->get_id_tiporeten() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_delete" . $Retencion->get_id_tiporeten() . "' name='btn_delete" . $Retencion->get_id_tiporeten() . "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

}

?>
