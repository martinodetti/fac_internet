<?php
// iniciamos la session aca para que no genere ningun warning posterior
session_start();

// Capa de Seguridadinclude 'Seguridad.php';

// Capa de Acceso a BD.
include 'C_Debug.php';
include '../DAC/Database.class.php';
include '../MODEL/Persona.php';
include '../MODEL/Detalle_cliente.php';
include '../MODEL/V_acceso_modulo.php';
include '../MODEL/V_cliente_pendiente.php';
include '../VIEW/W_Persona.php';
include '../MODEL/Ciudad.php';
include '../MODEL/Vehiculo.php';
include '../MODEL/Vehiculo_cliente.php';

$out="";

if(isset ($_POST['opc']))
$opc=$_POST['opc'];
else
$opc=$_GET['opc'];



switch ($opc) {
case '1': //add
// Todos los POST que interviene.
$id_persona=0;

$id_tipoper=$_POST['save_id_tipoper'];
//datos generales
$nom_persona	= $_POST['save_nom_persona'];
$ruc_persona	= $_POST['save_ruc_persona'];
$direc_persona	= $_POST['save_direc_persona'];
$telf_persona	= $_POST['save_telf_persona'];
$telf_persona_2	= $_POST['save_telf_persona_2'];
$cel_persona	= $_POST['save_cel_persona'];

$fec_persona="";
$estado_persona="1";
//fin de generales

if($id_tipoper==1 || $id_tipoper == 4)
{ //trabajador
	$ape_persona	= $_POST['save_ape_persona'];
	$id_ciudad		= 1;
	$id_sexo		= 1;
	$id_civil		= 1;

	$email_persona	= '';
	$web_persona	= "";
	$obs_persona	= "";
	$clave_persona	= "";
	$id_condiva		= 3;
	$tiene_ctacte	= 2;
	$id_listaprecio	= 1;
	$ganancia		= 0;
	$id_cliente		= 0;
    $limite_ctacte  = 0;

}
else if($id_tipoper==2)
{//cliente
	$ape_persona	= $_POST['save_ape_persona'];
	$id_ciudad		= $_POST['save_id_ciudad'];
	$id_condiva		= $_POST['save_id_condiva'];
	$tiene_ctacte	= $_POST['save_tiene_ctacte'];
	$id_sexo		= 1;
	$id_civil		= 1;
	$email_persona	= $_POST['save_email_persona'];
	$web_persona	= "";
	$obs_persona	= $_POST['save_obs_persona'];
	$clave_persona	= "";
	$id_listaprecio	= $_POST['save_id_listaprecio'];
	$ganancia 		= 0;
	$id_cliente		= 0;
    $limite_ctacte  = $_POST['save_limite_ctacte'];
}
else
{//proveedor
	$ape_persona	= "";
	$id_ciudad		= $_POST['save_id_ciudad'];
	$id_sexo		= 1;
	$id_civil		= 1;
	$id_condiva		= $_POST['save_id_condiva'];
	$tiene_ctacte	= 2;
	$clave_persona	= "";
	$email_persona	= $_POST['save_email_persona'];
	$web_persona	= "";//$_POST['save_web_persona'];
	$obs_persona	= $_POST['save_obs_persona'];
	$id_listaprecio	= 1;
	$ganancia		= $_POST['save_ganancia_persona'];
	$id_cliente 	= $_POST['update_id_cliente'];
    $limite_ctacte  = 0;

}

$persona=new persona();
$det_cliente=new detalle_cliente();
$persona->set_id_tipoper($id_tipoper);
$persona->set_id_ciudad($id_ciudad);
$persona->set_id_sexo($id_sexo);
$persona->set_id_civil($id_civil);
$persona->set_nom_persona($nom_persona);
$persona->set_ape_persona($ape_persona);
$persona->set_ruc_persona($ruc_persona);
$persona->set_direc_persona($direc_persona);
$persona->set_telf_persona($telf_persona);
$persona->set_telf_persona_2($telf_persona_2);
$persona->set_cel_persona($cel_persona);
$persona->set_email_persona($email_persona);
$persona->set_web_persona($web_persona);
$persona->set_obs_persona($obs_persona);
$persona->set_fec_persona($fec_persona);
$persona->set_estado_persona($estado_persona);
$persona->set_clave_persona($clave_persona);
$persona->set_id_condiva($id_condiva);
$persona->set_tiene_ctacte($tiene_ctacte);
$persona->set_id_listaprecio($id_listaprecio);
$persona->set_ganancia($ganancia);
$persona->set_limite_ctacte($limite_ctacte);

$ret=$persona->addPersona($persona);
$id=$ret['0'][0]; //ID DE LA PERSONA


if(isset($id_cliente) && $id_cliente > 0)
{
	$persona->asociarClienteProveedor($id_cliente, $id_persona);
}

/*
if($id_tipoper==2){
    //guardo detalle de cliente

  $det_cliente->set_id_cliente($id);
  $det_cliente->set_id_trabajador($_POST['save_id_trabajador']);
  $det_cliente->set_id_tipoconex($_POST['save_id_tipoconex']);
  $det_cliente->set_ip_detcliente($_POST['save_ip_detcliente']);
  $det_cliente->set_hora_detcliente($_POST['save_hora_detcliente']);
  $det_cliente->set_fecha_detcliente($_POST['save_fecha_detcliente']);
  $det_cliente->set_estado_conex($_POST['save_estado_conex']);
  $out=$det_cliente->addDetalle_cliente($det_cliente);
}
*/

break;

case '2' : //update

// Todos los POST que interviene en Update.
//generales
$id_persona=$_POST['update_id_persona'];
$fec_persona	= "";
$id_tipoper		= $_POST['update_id_tipoper'];
$nom_persona	= $_POST['update_nom_persona'];
$ruc_persona	= $_POST['update_ruc_persona'];
$direc_persona	= $_POST['update_direc_persona'];
$telf_persona	= $_POST['update_telf_persona'];
$telf_persona_2	= $_POST['update_telf_persona_2'];
$cel_persona	= $_POST['update_cel_persona'];

$estado_persona	= "1";
//fin generales
if ($id_tipoper == 1 || $id_tipoper == 4)
{//trabajador
    $ape_persona 	= $_POST['update_ape_persona'];
    $id_ciudad 		= 1;
    $id_sexo 		= 1;
    $id_civil 		= 1;
    $email_persona 	= "";
    $web_persona 	= "";
    $obs_persona 	= "";
    $clave_persona 	= "";
    $id_condiva 	= 3;
    $tiene_ctacte 	= 2;
    $id_listaprecio = 1;
    $ganancia		= 0;
	$id_cliente		= 0;
    $limite_ctacte  = 0;

}
else if ($id_tipoper == 2)
{//cliente

    $ape_persona 	= $_POST['update_ape_persona'];
    $id_ciudad 		= $_POST['update_id_ciudad'];
    $id_condiva 	= $_POST['update_id_condiva'];
    $tiene_ctacte 	= $_POST['update_tiene_ctacte'];
    $clave_persona 	= "";
    $email_persona 	= $_POST['update_email_persona'];
//    $web_persona 	= $_POST['update_web_persona'];
	$web_persona	= "";
    $obs_persona 	= $_POST['update_obs_persona'];
    $id_sexo 		= 1;
    $id_civil 		= 1;
	$id_listaprecio	= $_POST['update_id_listaprecio'];
	$ganancia		= 0;
	$id_cliente		= 0;
    $limite_ctacte  = $_POST['update_limite_ctacte'];
}
else
{//proveedor
    $ape_persona 	= "";
    $id_ciudad 		= $_POST['update_id_ciudad'];
    $id_sexo 		= 1;
    $id_civil 		= 1;
	$id_condiva 	= 3;
    $tiene_ctacte 	= 2;
    $clave_persona 	= "";
    $email_persona 	= $_POST['update_email_persona'];
    $id_cliente 	= $_POST['update_id_cliente'];
    $web_persona	= "";
    $obs_persona 	= $_POST['update_obs_persona'];
    $id_listaprecio	= 1;
    $ganancia		= $_POST['update_ganancia_persona'];
    $limite_ctacte  = 0;
}



$persona=new persona();

$persona->set_id_persona($id_persona);
$persona->set_id_tipoper($id_tipoper);
$persona->set_id_ciudad($id_ciudad);
$persona->set_id_sexo($id_sexo);
$persona->set_id_civil($id_civil);
$persona->set_nom_persona($nom_persona);
$persona->set_ape_persona($ape_persona);
$persona->set_ruc_persona($ruc_persona);
$persona->set_direc_persona($direc_persona);
$persona->set_telf_persona($telf_persona);
$persona->set_telf_persona_2($telf_persona_2);
$persona->set_cel_persona($cel_persona);
$persona->set_email_persona($email_persona);
$persona->set_web_persona($web_persona);
$persona->set_obs_persona($obs_persona);
$persona->set_fec_persona($fec_persona);
$persona->set_estado_persona($estado_persona);
$persona->set_clave_persona($clave_persona);
$persona->set_id_condiva($id_condiva);
$persona->set_tiene_ctacte($tiene_ctacte);
$persona->set_id_listaprecio($id_listaprecio);
$persona->set_ganancia($ganancia);
$persona->set_limite_ctacte($limite_ctacte);

$ret=$persona->updatePersona($persona);

if(isset($id_cliente) && $id_cliente > 0)
{
	$persona->asociarClienteProveedor($id_cliente, $id_persona);
}

$out=$ret['rows_affected'][0];



/*
if($id_tipoper == 2)
{
    $clsDetalleCli->set_id_detcliente($_POST['update_id_detcliente']);
    $clsDetalleCli->set_id_trabajador($_POST['update_id_trabajador']);
    $clsDetalleCli->set_id_cliente($id_persona);
    $clsDetalleCli->set_id_tipoconex($_POST['update_id_tipoconex']);
    $clsDetalleCli->set_hora_detcliente($_POST['update_hora_detcliente']);
    $clsDetalleCli->set_fecha_detcliente($_POST['update_fecha_detcliente']);
    $clsDetalleCli->set_ip_detcliente($_POST['update_ip_detcliente']);
    $clsDetalleCli->set_estado_conex($_POST['update_estado_conex']);
    $out=$clsDetalleCli->updateDetalle_cliente($clsDetalleCli);
}
*/

break;

case '3' : //delete
// Todos los POST que interviene Delete.
$id_persona=$_POST['delete_id_persona'];
$persona=new persona();

$val1=$persona->puedeEliminarProveedor($id_persona);//pregunt asi puede eliminar proveedor 1
$val2=$persona->puedeEliminarCliente($id_persona);//pregt. si se puede eliminar cliente 0
$val3=$persona->puedeEliminarTrabajador($id_persona);//pregnt si s epuede eliminar trabajador
$valt=0;
$valt=$val1+$val2+$val3;
if($valt==0){
$ret=$persona->deletePersona($id_persona);
$out=$persona->json("1", "Registro eliminado sactisfactoriamente.");
}else{
    $out=$persona->json("0", "No se ha podido eliminar.");
}
 break;
case '4' : //show

// Todos los POST que interviene Show.

$id_persona=$_POST['show_id_persona'];

$W_persona=new W_persona();

$out=$W_persona->printPersona($id_persona);

 break;

case '5' : //print por razon social
$W_persona=new W_persona();
$razon=$_POST['show_razon'];
$out=$W_persona->printPersonasRazon($razon);

 break;
case 6:
    $cedula=$_POST['txt_cedula'];
    $clave=$_POST['txt_clave'];
    $persona=new persona();
    $v_acceso_modulo=new v_acceso_modulo();
    $idper=$persona->loginPersona($cedula, $clave);
    //si es >1 existe la persona.
    if ($idper >= 1) {
            //si es > 1 tiene acceso dicha persna.
            $contAcceso = $v_acceso_modulo->existePersonaEnAcceso($idper);
            if ($contAcceso >= 1) {
//                session_start();
                $out = $persona->json(1, "home.php");
                $_SESSION['id_persona'] = $idper; //creo la sessión
            } else {
                $out = $persona->json(0, "Usuario no registrado.");
            }
        } else {
            $out = $persona->json(0, "Usuario no registrado.");
        }

 break;
 case '7' : //print por razon social DELETE
$W_persona=new W_persona();
$razon=$_POST['show_razon_delete'];
$out=$W_persona->printPersonasRazonDelete($razon);

 break;
case 8: //muestra búsqueda de trabajrdor
 $W_persona=new W_persona();
$ape_traba=$_POST['ape_trabajador'];
$out=$W_persona->printTrabajadorApe($ape_traba);
    break;
 case 9: //muestra búsqueda delete de trabajador
 $W_persona=new W_persona();
$ape_traba=$_POST['ape_trabajador_delete'];
$out=$W_persona->printTrabajadorApeDelete($ape_traba);
     break;

 case 10: //muestra búsqueda de cliente
 $ape_cliente_show=$_POST['ape_cliente'];
 $W_persona=new W_persona();

$out=$W_persona->printClienteApe($ape_cliente_show);
    break;

 case 11: //muestra búsqueda_delete de cliente
 	$W_persona=new W_persona();
	$ape_cliente=$_POST['ape_cliente_delete'];
	$out=$W_persona->printClienteApeDelete($ape_cliente);
    break;
case 12://json array
    $strApeTrabajador = isset($_POST['q']) ? strval($_POST['q']) : '';
    $clsPersona=new persona();
    $out=$clsPersona->listTrabajadorPorApellidojson($strApeTrabajador);
    break;
case 13://json array
    $strApeTrabajador = isset($_POST['q']) ? strval($_POST['q']) : '';
    $clsPersona=new persona();
    $out=$clsPersona->listTrabajadorConAcceso($strApeTrabajador);
    break;
case 14://json array
    $strApeCliente = isset($_POST['q']) ? strval($_POST['q']) : '';
    $clsPersona=new persona();
	$out = '';
	if(strlen($strApeCliente)>= 3)
	{
		$out=$clsPersona->listClientePorApejson($strApeCliente);
	}
    break;
case 15://imprimo los clientes pendientes
    $W_persona=new W_persona();
    $fecha_cli=$_POST['fecha'];
    $out=$W_persona->printClientePendiente($fecha_cli);
    break;
case 16:
    $clsPersona=new persona();
    $id_det_cli=$_POST['txt_ver_idcliente'];
    $ip_det_cli=$_POST['txt_ver_ip'];
    $estado_det_cli=$_POST['txt_ver_estado'];
    $out=$clsPersona->updateClienteDetalleIP($id_det_cli, $ip_det_cli, $estado_det_cli);
    break;

case '17':
    $clsVcliente_pend	= new v_cliente_pendiente();
    $clspersona			= new persona();
    $id_cliente			= $_POST['show_id_cliente'];
    $clsVcliente_pend	= $clsVcliente_pend->showV_cliente_pendiente($id_cliente);
    $clspersona			= $clspersona->showPersona($clsVcliente_pend->get_id_trabajador());
    $var_nom_ape		= $clspersona->get_nom_persona().' '.$clspersona->get_ape_persona();

   	$clsVcliente_pend->set_id_trabajador($var_nom_ape);
    $out=json_encode($clsVcliente_pend);
    break;

case '18'://show trabajador
    $clspersona=new persona();
     $id_cliente=$_POST['show_id_cliente'];
     $clspersona=$clspersona->showPersona($id_cliente);
     $out=json_encode($clspersona);
    break;
case '19': //10 muestro detalle de cliente en esta cargada
    $clsDetCli=new detalle_cliente();
     $id_cliente=$_POST['show_id_cliente'];
     $clsDetCli=$clsDetCli->showDetalle_cliente($id_cliente);
     $out=json_encode($clsDetCli);
    break;
case '20':
    $clsPersona=new persona();
    $id_persona=$_POST['show_id_persona'];
    $clsPersona=$clsPersona->showPersona($id_persona);
    $out=json_encode($clsPersona);
    break;
case '21':
    $clsPersona=new persona();
    $id_persona=$_POST['show_id_persona'];
    $clsPersona=$clsPersona->showPersona($id_persona);
    $out=json_encode($clsPersona);
    break;
case '22': //clientes por vehiculo
    $strApeCliente = isset($_POST['q']) ? strval($_POST['q']) : '';
	$idv = $_GET['idv'];
    $clsPersona=new persona();
    $out=$clsPersona->listClientePorVehiculojson($idv,$strApeCliente);
    break;
case '23': //clientes y vehiculos
	$strFiltro = isset($_POST['q']) ? strval($_POST['q']) : '';
	$out = '';
	if(strlen($strFiltro) >= 3) {
		$clsPersona = new persona();
		$out = $clsPersona->listClienteConVehiculojson($strFiltro);
	}
	break;

case '24':
    $clsPersona=new persona();
    $id_persona=$_POST['show_id_persona'];
    $clsPersona=$clsPersona->showPersonaJson($id_persona);
    $out=$clsPersona;
    break;

case '25':
	$ciudad = new ciudad();
	$id_prov = $_POST['id_prov'];
	$out = $ciudad->listCiudadesjson($id_prov);
	break;

case '26':
	$ciudad = new ciudad();
	$id_c = $_POST['id_c'];
	$out = $ciudad->listCiudadejsonPaso2($id_c);
	break;

case '27':
 	$W_persona=new W_persona();
	$id_persona = $_POST['id_cliente'];
	$out=$W_persona->printCuentaCorriente($id_persona);
    break;

case '28':

    $clave=$_POST['clave'];
    $persona=new persona();
//    $v_acceso_modulo=new v_acceso_modulo();
    $idper=$persona->validarClaveAdmin($clave);


    $out = $idper;
    //si es >1 existe la persona.
/*
    if ($idper >= 1) {
            //si es > 1 tiene acceso dicha persna.
            $contAcceso = $v_acceso_modulo->existePersonaEnAcceso($idper);
            if ($contAcceso >= 1) {
//                session_start();
                $out = $persona->json(1, "home.php");
                $_SESSION['id_persona'] = $idper; //creo la sessión
            } else {
                $out = $persona->json(0, "Usuario no registrado.");
            }
        } else {
            $out = $persona->json(0, "Usuario no registrado.");
        }
*/

	break;

case '29':

	//datos generales
	$id_tipoper		=$_POST['save_id_tipoper'];
	$nom_persona	= $_POST['save_nom_persona'];
	$ruc_persona	= $_POST['save_ruc_persona'];
	$direc_persona	= $_POST['save_direc_persona'];
	$telf_persona	= $_POST['save_telf_persona'];
	$telf_persona_2	= $_POST['save_telf_persona_2'];
	$cel_persona	= $_POST['save_cel_persona'];

	$fec_persona="";
	$estado_persona="1";
	//fin de generales
	$ape_persona	= $_POST['save_ape_persona'];
	$id_ciudad		= $_POST['save_id_ciudad'];
	$id_condiva		= $_POST['save_id_condiva'];
	$tiene_ctacte	= $_POST['save_tiene_ctacte'];
	$id_sexo		= 1;
	$id_civil		= 1;
	$email_persona	= $_POST['save_email_persona'];
	$web_persona	= "";
	$obs_persona	= $_POST['save_obs_persona'];
	$clave_persona	= "";
	$id_listaprecio	= $_POST['save_id_listaprecio'];
	$ganancia 		= 0;

	$persona=new persona();
	$persona->set_id_tipoper($id_tipoper);
	$persona->set_id_ciudad($id_ciudad);
	$persona->set_id_sexo($id_sexo);
	$persona->set_id_civil($id_civil);
	$persona->set_nom_persona($nom_persona);
	$persona->set_ape_persona($ape_persona);
	$persona->set_ruc_persona($ruc_persona);
	$persona->set_direc_persona($direc_persona);
	$persona->set_telf_persona($telf_persona);
	$persona->set_telf_persona_2($telf_persona_2);
	$persona->set_cel_persona($cel_persona);
	$persona->set_email_persona($email_persona);
	$persona->set_web_persona($web_persona);
	$persona->set_obs_persona($obs_persona);
	$persona->set_fec_persona($fec_persona);
	$persona->set_estado_persona($estado_persona);
	$persona->set_clave_persona($clave_persona);
	$persona->set_id_condiva($id_condiva);
	$persona->set_tiene_ctacte($tiene_ctacte);
	$persona->set_id_listaprecio($id_listaprecio);
	$persona->set_ganancia($ganancia);

	$ret=$persona->addPersona($persona);
	$id_cli=$ret['0'][0]; //ID DE LA PERSONA

	//vehiculo
	$id_vehiculo=0;

	$marca			= $_POST['save_marca_vehiculo'];
	$modelo			= $_POST['save_modelo_vehiculo'];
	$anio			= $_POST['save_anio_vehiculo'];
	$dominio		= $_POST['save_dominio_vehiculo'];
	$observacion	= $_POST['save_observacion_vehiculo'];
	$id_tipovehiculo= $_POST['save_id_tipovehiculo'];

	$vehiculo	=new vehiculo();

	$vehiculo->set_marca(			$marca);
	$vehiculo->set_modelo(			$modelo);
	$vehiculo->set_anio(			$anio);
	$vehiculo->set_dominio(			$dominio);
	$vehiculo->set_observacion(		$observacion);
	$vehiculo->set_id_tipovehiculo(	$id_tipovehiculo);

	$ret=$vehiculo->addVehiculo($vehiculo);
	$id_vehi = $ret['0'][0]; //id del vehiculo
	$vehi_cli = new vehiculo_cliente();

	$vehi_cli = new vehiculo_cliente();
   	$vehi_cli->set_id_vehiculo($id_vehi);
   	$vehi_cli->set_id_cliente($id_cli);
	$out = $vehi_cli->addVehiculo_cliente($vehi_cli);

	$out = $id_cli . ";" . $id_vehi; //id de la persona y del vehículo

	break;

case 30://json array
    $strApeCliente = isset($_POST['q']) ? strval($_POST['q']) : '';
    $clsPersona=new persona();
	$out = '';
	if(strlen($strApeCliente)>= 3)
	{
		$out=$clsPersona->listClientePorApejsonConFxPendientes($strApeCliente);
	}
    break;

case 31://json array
    $strApeProvee = isset($_POST['q']) ? strval($_POST['q']) : '';
    $clsPersona=new persona();
	$out = '';
	if(strlen($strApeProvee)>= 3)
	{
		$out=$clsPersona->listProveePorApejsonConFxPendientes($strApeProvee);
	}
    break;

case 32: //clientes
	$strFiltro = isset($_POST['q']) ? strval($_POST['q']) : '';
	$out = '';
	if(strlen($strFiltro) >= 3) {
		$clsPersona = new persona();
		$out = $clsPersona->CargarJsonClienteNombreCtaCte($strFiltro);
	}
	break;
}

die($out);

?>
