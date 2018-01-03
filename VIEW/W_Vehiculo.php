<?php 


class W_vehiculo { 

 public $Vehiculo; 

 public function  __construct() { 

 $this->Vehiculo = new vehiculo();

 }

 

public function printVehiculo($idVehiculo){ 

$ret="";

$this->Vehiculo = $this->Vehiculo->showVehiculo($idVehiculo);

$ret=$ret."<br>".$this->Vehiculo->get_id_vehiculo();

$ret=$ret."<br>".$this->Vehiculo->get_marca();

$ret=$ret."<br>".$this->Vehiculo->get_modelo();

$ret=$ret."<br>".$this->Vehiculo->get_anio();

$ret=$ret."<br>".$this->Vehiculo->get_dominio();

$ret=$ret."<br>".$this->Vehiculo->get_observacion();

return $ret;

} 



public function printVehiculosPorDominio($VehiculoDom) {
        $ret = "";
        $data = array();
        $Vehiculo = new vehiculo();
        $data = $this->Vehiculo->listVehiculosPorDominio($VehiculoNom);
        $ret = $ret . "<table class='display' id='dt_example'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Dominio</th>";
        $ret = $ret . "<th class='tc'>Marca</th>";
        $ret = $ret . "<th class='tc'>Modelo</th>";
        $ret = $ret . "<th class='tc'>Año</th>";
        $ret = $ret . "<th class='tc'>Observación</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        $cont=0;
        foreach ($data as $Vehiculo) {
 
            $ret = $ret . "<tr class='even'>";
          
            $ret = $ret . "<input type='hidden' id='idvehiculo_" . $Vehiculo->get_id_vehiculo() . "' name='idvehiculo_" . $Vehiculo->get_id_vehiculo() . "' value='" . $Vehiculo->get_id_vehiculo() . "' />";
            $ret = $ret . "<input type='hidden' id='dominio_" . $Vehiculo->get_dominio() . "' name='dominio_" . $Vehiculo->get_dominio() . "' value='" . $Vehiculo->get_dominio() . "' />";
            $ret = $ret . "<input type='hidden' id='marca_" . $Vehiculo->get_marca() . "' name='marca_" . $Vehiculo->get_marca() . "' value='" . $Vehiculo->get_marca() . "' />";
            $ret = $ret . "<input type='hidden' id='modelo_" . $Vehiculo->get_modelo() . "' name='modelo_" . $Vehiculo->get_modelo() . "' value='" . $Vehiculo->get_modelo() . "' />";
            $ret = $ret . "<input type='hidden' id='anio_" . $Vehiculo->get_anio() . "' name='anio_" . $Vehiculo->get_anio() . "' value='" . $Vehiculo->get_anio() . "' />";
            $ret = $ret . "<input type='hidden' id='observacion_" . $Vehiculo->get_observacion() . "' name='observacion_" . $Vehiculo->get_observacion() . "' value='" . $Vehiculo->get_observacion() . "' />";
            
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_id_vehiculo() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_dominio() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_marca() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_modelo() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_anio() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_update" . $Vehiculo->get_id_vehiculo() . "' class='button themed clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Vehiculo->get_id_vehiculo() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $Vehiculo->get_id_vehiculo()  . "' name='btn_update" .$Vehiculo->get_id_vehiculo() . "' class='button gray clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
              $cont++;
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
    

public function printVehiculosPorDominioDelete($VehiculoDom) {
        $ret = "";
        $data = array();
        $Vehiculo = new vehiculo();
        $data = $this->Vehiculo->listVehiculosPorDominio($VehiculoDom);
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Id</th>";
        $ret = $ret . "<th class='tc'>Dominio</th>";
        $ret = $ret . "<th class='tc'>Marca</th>";
        $ret = $ret . "<th class='tc'>Modelo</th>";
        $ret = $ret . "<th class='tc'>Anio</th>";
        $ret = $ret . "<th class='tc'>Observación</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        $cont=0;
        foreach ($data as $Vehiculo) {
            
             $ret = $ret . "<tr class='even'>";  
          
            $ret = $ret . "<input type='hidden' id='idvehiculo_" . $Vehiculo->get_id_vehiculo() . "' name='idvehiculo_" . $Vehiculo->get_id_vehiculo() . "' value='" . $Vehiculo->get_id_vehiculo() . "' />";
            $ret = $ret . "<input type='hidden' id='dominio_" . $Vehiculo->get_dominio() . "' name='dominio_" . $Vehiculo->get_dominio() . "' value='" . $Vehiculo->get_dominio() . "' />";
            $ret = $ret . "<input type='hidden' id='marca_" . $Vehiculo->get_marca() . "' name='marca_" . $Vehiculo->get_marca() . "' value='" . $Vehiculo->get_marca() . "' />";
            $ret = $ret . "<input type='hidden' id='modelo_" . $Vehiculo->get_modelo() . "' name='modelo_" . $Vehiculo->get_modelo() . "' value='" . $Vehiculo->get_modelo() . "' />";
            $ret = $ret . "<input type='hidden' id='anio_" . $Vehiculo->get_anio() . "' name='anio_" . $Vehiculo->get_anio() . "' value='" . $Vehiculo->get_anio() . "' />";
            $ret = $ret . "<input type='hidden' id='observacion_" . $Vehiculo->get_observacion() . "' name='observacion_" . $Vehiculo->get_observacion() . "' value='" . $Vehiculo->get_observacion() . "' />";
            

            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_id_vehiculo() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_dominio() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_marca() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_modelo() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_anio() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Vehiculo->get_observacion() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_delete" . $Vehiculo->get_id_vehiculo() . "' class='button themed clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete" . $Vehiculo->get_id_vehiculo() . "' /></td>";
             $ret = $ret . "<td class='tc'><a id='btn_delete" .$Vehiculo->get_id_vehiculo(). "' name='btn_delete" .$Vehiculo->get_id_vehiculo() . "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
            $cont++;
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
        

} 
?>
