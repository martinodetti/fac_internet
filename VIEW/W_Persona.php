<?php 

class W_persona { 

 public $Persona; 

 public function  __construct() { 

 $this->Persona=new persona();

 }

 

public function printPersona($idPersona){ 

$ret="";

$this->Persona= $this->Persona->showPersona($idPersona);

$ret=$ret."<br>".$this->Persona->get_id_persona();

$ret=$ret."<br>".$this->Persona->get_id_tipoper();

$ret=$ret."<br>".$this->Persona->get_id_ciudad();

$ret=$ret."<br>".$this->Persona->get_id_sexo();

$ret=$ret."<br>".$this->Persona->get_id_civil();

$ret=$ret."<br>".$this->Persona->get_nom_persona();

$ret=$ret."<br>".$this->Persona->get_ape_persona();

$ret=$ret."<br>".$this->Persona->get_ruc_persona();

$ret=$ret."<br>".$this->Persona->get_direc_persona();

$ret=$ret."<br>".$this->Persona->get_telf_persona();

$ret=$ret."<br>".$this->Persona->get_cel_persona();

$ret=$ret."<br>".$this->Persona->get_email_persona();

$ret=$ret."<br>".$this->Persona->get_web_persona();

$ret=$ret."<br>".$this->Persona->get_obs_persona();

$ret=$ret."<br>".$this->Persona->get_fec_persona();

$ret=$ret."<br>".$this->Persona->get_estado_persona();

$ret=$ret."<br>".$this->Persona->get_clave_persona();

$ret=$ret."<br>".$this->Persona->get_id_listaprecio();

 return $ret;

} 

/**
 *Lista proveedores por su razon social
 * @param type $RazonSocial
 * @return string 
 */

public function printPersonasRazon($RazonSocial) {

        $ret = "";
        $data = array();
        $Proveedor = new persona();
        $data = $this->Persona->listPersonasPorRazon($RazonSocial);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>id_persona</th>";
        $ret = $ret . "<th class='tc'>Razón Social</th>";
        $ret = $ret . "<th class='tc'>RUC</th>";
        $ret = $ret . "<th class='tc'>Teléfono</th>";
        $ret = $ret . "<th class='tc'>Celular</th>";
        $ret = $ret . "<th class='tc'>E-mail</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Proveedor) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<input type='hidden' id='id_tipoper_" . $Proveedor->get_id_persona() . "' name='id_tipoper_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_id_tipoper() . "' />";
            $ret = $ret . "<input type='hidden' id='ciudad_" . $Proveedor->get_id_persona() . "' name='ciudad_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_id_ciudad() . "' />";
            $ret = $ret . "<input type='hidden' id='razon_" . $Proveedor->get_id_persona() . "' name='razon_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_nom_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='ruc_" . $Proveedor->get_id_persona() . "' name='ruc_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_ruc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='tel_" . $Proveedor->get_id_persona() . "' name='tel_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_telf_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='cel_" . $Proveedor->get_id_persona() . "' name='cel_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_cel_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='email_" . $Proveedor->get_id_persona() . "' name='email_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_email_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='direc_" . $Proveedor->get_id_persona() . "' name='direc_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_direc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='obs_" . $Proveedor->get_id_persona() . "' name='obs_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_obs_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='web_" . $Proveedor->get_id_persona() . "' name='web_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_web_persona() . "' />";

            $ret = $ret . "<td class='tc'>" . $Proveedor->get_id_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_nom_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_ruc_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_telf_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_cel_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_email_persona() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_update" . $Proveedor->get_id_persona() . "' class='button gray clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Proveedor->get_id_persona() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $Proveedor->get_id_persona() . "' name='btn_update" . $Proveedor->get_id_persona() . "' class='button white clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

    

public function printPersonasRazonDelete($RazonSocial) {

        $ret = "";
        $data = array();
        $Proveedor = new persona();
        $data = $this->Persona->listPersonasPorRazon($RazonSocial);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>id_persona</th>";
        $ret = $ret . "<th class='tc'>Razón Social</th>";
        $ret = $ret . "<th class='tc'>RUC</th>";
        $ret = $ret . "<th class='tc'>Teléfono</th>";
        $ret = $ret . "<th class='tc'>Celular</th>";
        $ret = $ret . "<th class='tc'>E-mail</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Proveedor) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<input type='hidden' id='id_tipoper_" . $Proveedor->get_id_persona() . "' name='id_tipoper_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_id_tipoper() . "' />";
            $ret = $ret . "<input type='hidden' id='ciudad_" . $Proveedor->get_id_persona() . "' name='ciudad_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_id_ciudad() . "' />";
            $ret = $ret . "<input type='hidden' id='razon_" . $Proveedor->get_id_persona() . "' name='razon_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_nom_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='ruc_" . $Proveedor->get_id_persona() . "' name='ruc_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_ruc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='tel_" . $Proveedor->get_id_persona() . "' name='tel_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_telf_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='cel_" . $Proveedor->get_id_persona() . "' name='cel_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_cel_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='email_" . $Proveedor->get_id_persona() . "' name='email_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_email_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='direc_" . $Proveedor->get_id_persona() . "' name='direc_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_direc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='obs_" . $Proveedor->get_id_persona() . "' name='obs_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_obs_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='web_" . $Proveedor->get_id_persona() . "' name='web_" . $Proveedor->get_id_persona() . "' value='" . $Proveedor->get_web_persona() . "' />";

            $ret = $ret . "<td class='tc'>" . $Proveedor->get_id_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_nom_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_ruc_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_telf_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_cel_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Proveedor->get_email_persona() . "</td>";
            //$ret = $ret . "<td class='tc'><input id='btn_delete" . $Proveedor->get_id_persona() . "' class='button gray clsMatrizEliminar' type='button'  value='Eliminar' name='btn_delete" . $Proveedor->get_id_persona() . "' /></td>";
             $ret = $ret . "<td class='tc'><a id='btn_delete" . $Proveedor->get_id_persona() . "' name='btn_delete" . $Proveedor->get_id_persona() . "' class='button gray clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
    
    
/*
 * Métodos para trabajador
 * 
 */
    
 
public function printTrabajadorApe($Apellido) {

        $ret = "";
        $data = array();
        $Trabajador = new persona();
        $data = $this->Persona->listTrabajadorPorApe($Apellido);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>ID</th>";
        $ret = $ret . "<th class='tc'>Nombre</th>";
        $ret = $ret . "<th class='tc'>Apellido</th>";
        $ret = $ret . "<th class='tc'>RUC</th>";
        $ret = $ret . "<th class='tc'>Celular</th>";
        $ret = $ret . "<th class='tc'>E-mail</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Trabajador) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<input type='hidden' id='id_tipoper_" . $Trabajador->get_id_persona() . "' name='id_tipoper_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_tipoper() . "' />";
            $ret = $ret . "<input type='hidden' id='ciudad_" . $Trabajador->get_id_persona() . "' name='ciudad_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_ciudad() . "' />";
            $ret = $ret . "<input type='hidden' id='sexo_" . $Trabajador->get_id_persona() . "' name='sexo_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_sexo(). "' />";
            $ret = $ret . "<input type='hidden' id='civil_" . $Trabajador->get_id_persona() . "' name='civil_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_civil() . "' />";
            $ret = $ret . "<input type='hidden' id='nom_" . $Trabajador->get_id_persona() . "' name='nom_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_nom_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='ape_" . $Trabajador->get_id_persona() . "' name='ape_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_ape_persona() . "' />";
          
            $ret = $ret . "<input type='hidden' id='ruc_" . $Trabajador->get_id_persona() . "' name='ruc_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_ruc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='tel_" . $Trabajador->get_id_persona() . "' name='tel_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_telf_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='cel_" . $Trabajador->get_id_persona() . "' name='cel_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_cel_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='email_" . $Trabajador->get_id_persona() . "' name='email_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_email_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='direc_" . $Trabajador->get_id_persona() . "' name='direc_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_direc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='obs_" . $Trabajador->get_id_persona() . "' name='obs_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_obs_persona() . "' />";
          

            $ret = $ret . "<td class='tc'>" . $Trabajador->get_id_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_nom_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_ape_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_ruc_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_cel_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_email_persona() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_update" . $Proveedor->get_id_persona() . "' class='button gray clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Proveedor->get_id_persona() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $Trabajador->get_id_persona() . "' name='btn_update" . $Trabajador->get_id_persona() . "' class='button white clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
   

 
public function printTrabajadorApeDelete($Apellido) {

        $ret = "";
        $data = array();
        $Trabajador = new persona();
        $data = $this->Persona->listTrabajadorPorApe($Apellido);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>ID</th>";
        $ret = $ret . "<th class='tc'>Tipo</th>";
        $ret = $ret . "<th class='tc'>Nombre</th>";
        $ret = $ret . "<th class='tc'>Apellido</th>";
        $ret = $ret . "<th class='tc'>Celular</th>";
        $ret = $ret . "<th class='tc'>Telefono</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Trabajador) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<input type='hidden' id='id_tipoper_" . $Trabajador->get_id_persona() . "' name='id_tipoper_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_tipoper() . "' />";
            $ret = $ret . "<input type='hidden' id='ciudad_" . $Trabajador->get_id_persona() . "' name='ciudad_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_ciudad() . "' />";
            $ret = $ret . "<input type='hidden' id='sexo_" . $Trabajador->get_id_persona() . "' name='sexo_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_sexo(). "' />";
            $ret = $ret . "<input type='hidden' id='civil_" . $Trabajador->get_id_persona() . "' name='civil_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_civil() . "' />";
            $ret = $ret . "<input type='hidden' id='nom_" . $Trabajador->get_id_persona() . "' name='nom_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_nom_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='ape_" . $Trabajador->get_id_persona() . "' name='ape_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_ape_persona() . "' />";
          
            $ret = $ret . "<input type='hidden' id='tel_" . $Trabajador->get_id_persona() . "' name='tel_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_telf_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='cel_" . $Trabajador->get_id_persona() . "' name='cel_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_cel_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='email_" . $Trabajador->get_id_persona() . "' name='email_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_email_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='direc_" . $Trabajador->get_id_persona() . "' name='direc_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_direc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='obs_" . $Trabajador->get_id_persona() . "' name='obs_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_obs_persona() . "' />";
          

            $ret = $ret . "<td class='tc'>" . $Trabajador->get_id_persona() . "</td>";
            if($Trabajador->get_id_tipoper() == 1) 	$tipoper = "OPERADOR";
            else									$tipoper = "MECANICO";
            $ret = $ret . "<td class='tc'>" . $tipoper . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_nom_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_ape_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_cel_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_telf_persona() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_update" . $Proveedor->get_id_persona() . "' class='button gray clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Proveedor->get_id_persona() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_delete" . $Trabajador->get_id_persona() . "' name='btn_delete" . $Trabajador->get_id_persona() . "' class='button white clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }    
    

    
public function printClienteApe($Apellido) {

        $ret = "";
        $data = array();
        $Trabajador = new persona();
        $DetCliente=new detalle_cliente();
        $data = $this->Persona->listClientePorApe($Apellido);
        
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>ID</th>";
        $ret = $ret . "<th class='tc'>Nombre</th>";
        $ret = $ret . "<th class='tc'>Apellido</th>";
        $ret = $ret . "<th class='tc'>RUC</th>";
        $ret = $ret . "<th class='tc'>Celular</th>";
        $ret = $ret . "<th class='tc'>E-mail</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Trabajador) {
            $DetCliente=$DetCliente->showDetalle_cliente($Trabajador->get_id_persona());
            
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<input type='hidden' id='id_tipoper_" . $Trabajador->get_id_persona() . "' name='id_tipoper_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_tipoper() . "' />";
            $ret = $ret . "<input type='hidden' id='ciudad_" . $Trabajador->get_id_persona() . "' name='ciudad_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_ciudad() . "' />";
            $ret = $ret . "<input type='hidden' id='sexo_" . $Trabajador->get_id_persona() . "' name='sexo_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_sexo(). "' />";
            $ret = $ret . "<input type='hidden' id='civil_" . $Trabajador->get_id_persona() . "' name='civil_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_id_civil() . "' />";
            $ret = $ret . "<input type='hidden' id='nom_" . $Trabajador->get_id_persona() . "' name='nom_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_nom_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='ape_" . $Trabajador->get_id_persona() . "' name='ape_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_ape_persona() . "' />";
          
            $ret = $ret . "<input type='hidden' id='ruc_" . $Trabajador->get_id_persona() . "' name='ruc_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_ruc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='tel_" . $Trabajador->get_id_persona() . "' name='tel_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_telf_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='cel_" . $Trabajador->get_id_persona() . "' name='cel_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_cel_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='email_" . $Trabajador->get_id_persona() . "' name='email_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_email_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='direc_" . $Trabajador->get_id_persona() . "' name='direc_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_direc_persona() . "' />";
           
            $ret = $ret . "<input type='hidden' id='detcli_traba_" .$Trabajador->get_id_persona() . "' name='detcli_traba_" . $Trabajador->get_id_persona() . "' value='" . $DetCliente->get_id_trabajador(). "' />";
            $ret = $ret . "<input type='hidden' id='detcli_idcli_" .$Trabajador->get_id_persona() . "' name='detcli_idcli_" . $Trabajador->get_id_persona() . "' value='" . $DetCliente->get_id_detcliente(). "' />";
           
            $ret = $ret . "<input type='hidden' id='detcli_tipoconex_" .$Trabajador->get_id_persona() . "' name='detcli_tipoconex_" . $Trabajador->get_id_persona() . "' value='" . $DetCliente->get_id_tipoconex(). "' />";
            $ret = $ret . "<input type='hidden' id='detcli_ip_" .$Trabajador->get_id_persona() . "' name='detcli_ip_" . $Trabajador->get_id_persona() . "' value='" .$DetCliente->get_ip_detcliente() . "' />";
            
            $ret = $ret . "<input type='hidden' id='detcli_hora_" .$Trabajador->get_id_persona() . "' name='detcli_hora_" . $Trabajador->get_id_persona() . "' value='" .$DetCliente->get_hora_detcliente() . "' />";
            $ret = $ret . "<input type='hidden' id='detcli_fecha_" .$Trabajador->get_id_persona() . "' name='detcli_fecha_" . $Trabajador->get_id_persona() . "' value='" .$DetCliente->get_fecha_detcliente() . "' />";
            $ret = $ret . "<input type='hidden' id='detcli_estado_" .$Trabajador->get_id_persona() . "' name='detcli_estado_" . $Trabajador->get_id_persona() . "' value='" .$DetCliente->get_estado_conex() . "' />";
//            $ret = $ret . "<input type='hidden' id='obs_" . $Trabajador->get_id_persona() . "' name='obs_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_obs_persona() . "' />";
          

            $ret = $ret . "<td class='tc'>" . $Trabajador->get_id_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_nom_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_ape_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_ruc_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_cel_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Trabajador->get_email_persona() . "</td>";
//           // $ret = $ret . "<td class='tc'><input id='btn_update" . $Proveedor->get_id_persona() . "' class='button gray clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Proveedor->get_id_persona() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_update" . $Trabajador->get_id_persona() . "' name='btn_update" . $Trabajador->get_id_persona() . "' class='button white clsMatrizModificar' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }
   

 
	public function printClienteApeDelete($Apellido) {

        $ret = "";
        $data = array();
        $Cliente = new persona();
        $data = $this->Persona->listClientePorApe($Apellido);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>ID</th>";
        $ret = $ret . "<th class='tc'>Razón Social</th>";
        $ret = $ret . "<th class='tc'>Nombre Fantasía</th>";
        $ret = $ret . "<th class='tc'>CUIT / DNI</th>";
        $ret = $ret . "<th class='tc'>Celular</th>";
        $ret = $ret . "<th class='tc'>E-mail</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Cliente) {
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<input type='hidden' id='id_tipoper_" . $Cliente->get_id_persona() . "' name='id_tipoper_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_id_tipoper() . "' />";
            $ret = $ret . "<input type='hidden' id='ciudad_" . $Cliente->get_id_persona() . "' name='ciudad_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_id_ciudad() . "' />";
            $ret = $ret . "<input type='hidden' id='sexo_" . $Cliente->get_id_persona() . "' name='sexo_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_id_sexo(). "' />";
            $ret = $ret . "<input type='hidden' id='civil_" . $Cliente->get_id_persona() . "' name='civil_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_id_civil() . "' />";
            $ret = $ret . "<input type='hidden' id='nom_" . $Cliente->get_id_persona() . "' name='nom_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_nom_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='ape_" . $Cliente->get_id_persona() . "' name='ape_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_ape_persona() . "' />";
          
            $ret = $ret . "<input type='hidden' id='ruc_" . $Cliente->get_id_persona() . "' name='ruc_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_ruc_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='tel_" . $Cliente->get_id_persona() . "' name='tel_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_telf_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='cel_" . $Cliente->get_id_persona() . "' name='cel_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_cel_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='email_" . $Cliente->get_id_persona() . "' name='email_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_email_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='direc_" . $Cliente->get_id_persona() . "' name='direc_" . $Cliente->get_id_persona() . "' value='" . $Cliente->get_direc_persona() . "' />";
//            $ret = $ret . "<input type='hidden' id='obs_" . $Trabajador->get_id_persona() . "' name='obs_" . $Trabajador->get_id_persona() . "' value='" . $Trabajador->get_obs_persona() . "' />";

            $ret = $ret . "<td class='tc'>" . $Cliente->get_id_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente->get_nom_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente->get_ape_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente->get_ruc_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente->get_cel_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente->get_email_persona() . "</td>";
           // $ret = $ret . "<td class='tc'><input id='btn_update" . $Proveedor->get_id_persona() . "' class='button gray clsMatrizModificar' type='button'  value='Modificar' name='btn_update" . $Proveedor->get_id_persona() . "' /></td>";
            $ret = $ret . "<td class='tc'><a id='btn_delete" . $Cliente->get_id_persona() . "' name='btn_delete" . $Cliente->get_id_persona() . "' class='button white clsMatrizEliminar' href='#'><span class='icon_text cancel'></span>Eliminar</a></td>";
            $ret = $ret . "</tr>";
        }

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }    
    
    
    
    public function printCuentaCorriente($idc) {

        $ret = "";
        $data = array();
        $Cliente = new Persona();
        $data = $Cliente->getCtaCte($idc);

        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>Factura</th>";
        $ret = $ret . "<th class='tc'>Fecha</th>";
        $ret = $ret . "<th class='tc'>Remito</th>";
        $ret = $ret . "<th class='tc'>Fecha remito</th>";
        $ret = $ret . "<th class='tc'>Dominio</th>";
        $ret = $ret . "<th class='tc'>Total</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        
        $total = 0;

        foreach ($data as $dat) {
            $ret = $ret . "<tr class='gradeC'>";
            
            $ret = $ret . "<td class='tc'>" . $dat['factura'] . "</td>";
            $ret = $ret . "<td class='tc'>" . $dat['fecha'] . "</td>";
            $ret = $ret . "<td class='tc'>" . $dat['remito'] . "</td>";
            $ret = $ret . "<td class='tc'>" . $dat['fec_remi'] . "</td>";
            $ret = $ret . "<td class='tc'>" . $dat['dominio'] . "</td>";
            $ret = $ret . "<td style='text-align: right;' class='tc'>" . $dat['total'] . "</td>";

            $ret = $ret . "</tr>";
            $total = $total + $dat['total'];
        }
        $ret = $ret . "<td class='tc'></td><td class='tc'></td><td class='tc'></td><td class='tc'></td><td class='tc'>TOTAL</td><td style='text-align: right;' class='tc'>".$total."</td>";

        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }    
    
    
public function printClientePendiente($fecha) {

        $ret = "";
        $data = array();
         $Cliente = new persona();
         
        $Cliente_pendiente = new v_cliente_pendiente();
        $data= $Cliente_pendiente->ListClientePendientes($fecha);
        
        $ret = $ret . "<table class='display' id='tabledata'>";
        $ret = $ret . "<thead>";
        $ret = $ret . "<tr>";
        $ret = $ret . "<th class='tc'>ID</th>";
        $ret = $ret . "<th class='tc'>Nombres</th>";
        $ret = $ret . "<th class='tc'>RUC</th>";
        $ret = $ret . "<th class='tc'>Fecha</th>";
        $ret = $ret . "<th class='tc'>Hora</th>";
        $ret = $ret . "<th class='tc'>Tipo de Conexión</th>";
        $ret = $ret . "<th class='tc'>Estado</th>";
        $ret = $ret . "<th class='tc'>Opción</th>";
        $ret = $ret . " </tr>";
        $ret = $ret . "</thead>";
        $ret = $ret . "<tbody>";
        foreach ($data as $Cliente_pendiente) {
            
            $Cliente=$this->Persona->showPersona($Cliente_pendiente->get_id_trabajador());
            
            $ret = $ret . "<tr class='gradeC'>";
            $ret = $ret . "<input type='hidden' id='id_cliente_" . $Cliente_pendiente->get_id_cliente() . "' name='id_cliente_" . $Cliente_pendiente->get_id_cliente() . "' value='" . $Cliente_pendiente->get_id_cliente() . "' />";
            $ret = $ret . "<input type='hidden' id='id_detcli_nombres_" . $Cliente_pendiente->get_id_cliente(). "' name='id_detcli_nombres_" . $Cliente_pendiente->get_id_cliente() . "' value='" . $Cliente_pendiente->get_nom_persona().' '.$Cliente_pendiente->get_ape_persona() . "' />";
            $ret = $ret . "<input type='hidden' id='id_detcli_trabajador_" . $Cliente_pendiente->get_id_cliente(). "' name='id_detcli_trabajador_" . $Cliente_pendiente->get_id_cliente() . "' value='" . $Cliente->get_nom_persona().' '.$Cliente->get_ape_persona(). "' />";
            $ret = $ret . "<input type='hidden' id='id_detcli_ruc_" . $Cliente_pendiente->get_id_cliente() . "' name='id_detcli_ruc_" . $Cliente_pendiente->get_id_cliente() . "' value='" . $Cliente_pendiente->get_ruc_persona(). "' />";
           
            $ret = $ret . "<input type='hidden' id='id_detcli_tel_" . $Cliente_pendiente->get_id_cliente() . "' name='id_detcli_tel_" . $Cliente_pendiente->get_id_cliente() . "' value='" . $Cliente_pendiente->get_telf_persona(). "' />";
            $ret = $ret . "<input type='hidden' id='id_detcli_cel_" . $Cliente_pendiente->get_id_cliente() . "' name='id_detcli_cel_" . $Cliente_pendiente->get_id_cliente() . "' value='" . $Cliente_pendiente->get_cel_persona(). "' />";
            $ret = $ret . "<input type='hidden' id='id_detcli_direc_" . $Cliente_pendiente->get_id_cliente() . "' name='id_detcli_direc_" . $Cliente_pendiente->get_id_cliente() . "' value='" . $Cliente_pendiente->get_direc_persona(). "' />";
            
            $ret = $ret . "<td class='tc'>" . $Cliente_pendiente->get_id_cliente() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente_pendiente->get_nom_persona() . ' ' . $Cliente_pendiente->get_ape_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente_pendiente->get_ruc_persona() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente_pendiente->get_fecha_detcliente() . "</td>";
            $ret = $ret . "<td class='tc'>" . $Cliente_pendiente->get_hora_detcliente() . "</td>";
            if($Cliente_pendiente->get_id_tipoconex()==1)
            $ret = $ret . "<td class='tc'>INALÁMBRICA</td>";
            else
            $ret = $ret . "<td class='tc'>CABLEADO</td>";
            
            $ret = $ret . "<td class='tc'>Pendiente</td>";
            $ret = $ret . "<td class='tc'><a id='btn_update_detcliente" . $Cliente_pendiente->get_id_cliente() . "' name='btn_update_detcliente" . $Cliente_pendiente->get_id_cliente() . "' class='button white clsMatrizDetalle' href='#'><span class='icon_text edit'></span>Editar</a></td>";
            $ret = $ret . "</tr>";
        }
        $ret = $ret . "</tbody>";
        $ret = $ret . "</table>";
        return $ret;
    }

} 



?>
