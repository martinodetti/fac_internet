<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<?php 
 include 'DAC/Database.class.php';
 include 'MODEL/Persona.php';
 include 'MODEL/Ciudad.php';
 include 'MODEL/Tipo_conexion.php';
session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$persona2=new persona();
$persona=$persona->showPersona($id_persona);
$Lista_trabajador=$persona2->ComboTrabajador2();
$Ciudad=new ciudad();
$tipo_conex=new tipo_conexion();
$Lista_tipo_conex=$tipo_conex->listTipo_conexions();

$arr_ciudad=$Ciudad->listCiudads();
?>


<html  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="UTMACH "/>
        <meta name="description" content=""/>
        <meta name="generator" content=""/>
        <title>SISTEMA DE FACTURACIÓN </title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
        <!--link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->
        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
         <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
<!--         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>-->
         <script type="text/javascript" src="JS/jquery-ui-timepicker-addon.js" ></script>
        <script type="text/javascript" src="MYJS/Cliente.js" ></script>


    </head>
    <body>

        <div class="Main">

            <div class="Sheet">
                <div class="Sheet-tl"></div>
                <div class="Sheet-tr"><div></div></div>
                <div class="Sheet-bl"><div></div></div>
                <div class="Sheet-br"><div></div></div>
                <div class="Sheet-tc"><div></div></div>
                <div class="Sheet-bc"><div></div></div>
                <div class="Sheet-cl"><div></div></div>
                <div class="Sheet-cr"><div></div></div>
                <div class="Sheet-cc"></div>
                <div class="Sheet-body">


                    <!--cabecera-->
                    <div id="cabecera1" >

                        <ul id="topbar">
                            <li><a class="button gray fl" title="Ir a home" href="home.php" ><span class="icon_single preview"></span></a></li>
                            <li class="s_1"></li>
                            <li class="logo"><strong></strong></li>
<!--                            <li class="s_1"></li>-->
                            <li><a class="breadcrumb underline" href="#">Home -> Cliente</a></li>
                            <li class="fr"><a class="button gray fl" title="logout" href="CONTROLLER/Salir.php" >
                                    <span class="icon_text logout"></span>Salir</a></li>
<!--                            <li class="s_1 fr"></li>-->
                           
                            <li class="s_1 fr"></li>
                            <li class="fr"><a class="button gray fl" title="admin" href="#"><span class="icon_text admin"></span><?php echo $persona->get_nom_persona() ?></a></li>
                            <li class="fr"><a id="logged">Logeado como:</a></li>
                            <!--li class="clear">
                            </li-->
                        </ul>


                    </div>
                    <!--fin de cabecera-->
                        <!-- contentLayout va aqui con todo lo que tiene wilfo-->
                        <div class="contentLayout">
                            <div id="content" >
                               
                                <div class="column full fl">
                                    <div class="box tabs themed_box">
                                        <h2 class="box-header">CLIENTE </h2>
                                          <ul class="tabs-nav">
                                               <li class="tab"><a href="#tabs-1">PENDIENTES</a></li>
                                                <li class="tab"><a href="#tabs-2">NUEVO</a></li>
                                                <li class="tab"><a href="#tabs-3">MODIFICAR</a></li>
                                                <li class="tab"><a href="#tabs-4">ELIMINAR</a></li>
                                                
                                            </ul>
                                        
                                        <div class="box-content">  
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                  <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                            
                                             <div id="dialg_cliente_update" class="dialog" title="SYSFACTURA INFORMA">   
                                            
                                                 
                                                 
                                                  <table border="0">
                                                          <thead>
                                                              <tr>
                                                                  <th style="width: 400px"></th>
                                                                  <th style="width: 400px"></th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                              <tr>
                                                                  <td>
                                                                       <label class="form-label required"> Nombres </label>
                                                                       <input id="txt_ver_nombres" class="form-field width90" disabled="true"
                                                                        name="txt_ver_nombres" type="text" value="" maxlength="100"/>
                                                                         
                                                                  </td>
                                                                  <td>
                                                                       <label class="form-label required"> RUC </label>
                                                                       <input id="txt_ver_ruc" class="form-field width90" disabled="true"
                                                                        name="txt_ver_ruc" type="text" value="" maxlength="100"/>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td>
                                                                      <label class="form-label required"> Teléfono </label>
                                                                      <input id="txt_ver_telefono" class="form-field width90" disabled="true"
                                                                        name="txt_ver_telefono" type="text" value="" maxlength="100"/>
                                                                  </td>
                                                                  <td>
                                                                      <label class="form-label required"> Celular </label>
                                                                       <input id="txt_ver_celular" class="form-field width90" disabled="true"
                                                                        name="txt_ver_celular" type="text" value="" maxlength="100"/>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td >
                                                                        <label class="form-label required"> Dirección </label>
                                                                        <input id="txt_ver_direc" class="form-field width90" disabled="true"
                                                                        name="txt_ver_direc" type="text" value="" maxlength="100"/>
                                                                  </td>
                                                                  <td>
                                                                      <label class="form-label required"> Trabajador </label>
                                                                      <input id="txt_ver_trabajador" class="form-field width90" disabled="true"
                                                                        name="txt_ver_trabajador" type="text" value="" maxlength="100"/>
                                                                  </td>
                                                              </tr>
                                                          </tbody>
                                                      </table>
                                                  <hr/>
                                                  <label class="form-label required"> Detalle de Cliente </label>
                                                  <form id="form_detalle_cliente" method="post">
                                                       <input type="hidden" id="txt_ver_idcliente" name="txt_ver_idcliente" value="" />
                                                       <table border="0">
                                                               <thead>
                                                                   <tr>
                                                                       <th style="width: 400px"></th>
                                                                       <th style="width: 400px"></th>
                                                                   </tr>
                                                               </thead>
                                                               <tbody>
                                                                   <tr>
                                                                       <td>
                                                                            <label class="form-label required"> Dirección IP </label>
                                                                            <input id="txt_ver_ip" class="form-field width90" 
                                                                        name="txt_ver_ip" type="text" value="" maxlength="100"/>
                                                                       </td>
                                                                       <td>
                                                                            <label class="form-label required"> Estado </label>
                                                                            <select id="txt_ver_estado" name="txt_ver_estado" class="form-field width40">
                                                                              <option value="0">PENDIENTE</option>
                                                                              <option value="1">ACTIVAR</option>
                                                                        </select>
                                                                       </td>
                                                                   </tr>
                                                               </tbody>
                                                           </table>
                                                        <input id="btn_ver_cancel" class="button themed" type="button" 
                                                   value="Cancelar" name="btn_ver_cancel" />
                                                       <input id="btn_ver_update" class="button themed" type="button" 
                                                   value="Guardar" name="btn_ver_update" />
                                                  
                                                 </form>
                                             </div>
                                            
                                            <div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">   
                                                <form id="frmPersona_Update" method="post" action="">
                                                  <input type="hidden" id="update_id_persona" name="update_id_persona" value="" />
                                                  <input type="hidden" id="update_id_tipoper" name="update_id_tipoper" value="2" />
                                                  <input type="hidden" id="update_id_detcliente" name="update_id_detcliente" value="" />
                                             
                                                       <table border="0"  width="880" cellspacing="80">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%"></th>
                                                                <th style="width: 50%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                                           
                                                                <tr>
                                                                    <td >
                                                                        <label class="form-label required"> Nombre </label>
                                                                         <input id="update_nom_persona" class="form-field width90" 
                                                                        name="update_nom_persona" type="text" value="" maxlength="100"/>
                                                                    </td>    
                                                                    <td >
                                                                        <label class="form-label required"> Apellido </label>
                                                                         <input id="update_ape_persona" class="form-field width90" 
                                                                        name="update_ape_persona" type="text" value="" maxlength="100"/>
                                                                    </td>    
                                                                </tr>                                                         
                                                                                                              
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Sexo </label>
                                                                          <select id="update_id_sexo" name="update_id_sexo" class="form-field width40">
                                                                              <option value="1">MASCULINO</option>
                                                                              <option value="2">FEMENINO</option>
                                                                        </select> 
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Estado Civil </label>
                                                                          <select id="update_id_civil" name="update_id_civil" class="form-field width40">
                                                                           <option value="1">SOLTERO(A)</option>
                                                                           <option value="2">CASADO(A)</option>
                                                                           <option value="3">DIVORCIADO(A)</option>
                                                                           <option value="4">VIUDO(A)</option>
                                                                           <option value="5">UNIÓN LIBRE</option>
                                                                        </select> 
                                                                    </td>
                                                                    
                                                                </tr> 
                                                                   
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Cédula</label>
                                                                         <input id="update_ruc_persona" class="form-field width80" 
                                                                        name="update_ruc_persona" type="text" value="" maxlength="13"/>
                                                                    </td>
                                                                    <td>
                                                                       <label class="form-label required"> Ciudad </label>
                                                                          <select id="update_id_ciudad" name="update_id_ciudad" class="form-field width40">
                                                                            <?php foreach($arr_ciudad as $Ciudad){?>
                                                                              <option value="<?php echo $Ciudad->get_id_ciudad()?>"><?php echo $Ciudad->get_nom_ciudad()?></option>
                                                                              <?php } ?>
                                                                        </select>  
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Teléfono </label>
                                                                        <input id="update_telf_persona" class="form-field width80" 
                                                                        name="update_telf_persona" type="text" value="" maxlength="7"/>  
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Celular</label>
                                                                         <input id="update_cel_persona" class="form-field width80" 
                                                                        name="update_cel_persona" type="text" value="" maxlength="9"/>
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> E-mail </label>
                                                                           <input id="update_email_persona" class="form-field width80" 
                                                                        name="update_email_persona" type="text" value="" maxlength="50"/>
                                                                    </td>
                                                                    <td>
<!--                                                                        <label class="form-label required"> Sitio Web</label>
                                                                         <input id="update_web_persona" class="form-field width80" 
                                                                        name="update_web_persona" type="text" value="" maxlength="50"/>-->
                                                                    </td>
                                                                </tr>   
                                                                <tr >
                                                                    <td colspan="2">
                                                                         <label class="form-label required"> Dirección </label>
                                                                          <input id="update_direc_persona" class="form-field width90" 
                                                                        name="update_direc_persona" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                </tr>
                                                                <tr >
                                                                    <td colspan="2">
                                                                        <label class="form-label required"> Detalle de Cliente </label>
<!--                                                                         <label class="form-label required"> Descripción de la Ocupación </label>
                                                                          <input id="update_obs_persona" class="form-field width90" 
                                                                        name="update_obs_persona" type="text" value="" maxlength="100"/>-->
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Trabajador Encargado </label>
                                                                        <select id="update_id_trabajador" name="update_id_trabajador" class="form-field width60" >
                                                                            <?php foreach ($Lista_trabajador as $persona2){ ?>
                                                                            <option value="<?php echo $persona2->get_id_persona();?>"><?php 
                                                                            $var_ape=$persona2->get_nom_persona().' '.$persona2->get_ape_persona();
                                                                            echo $var_ape;?></option>
                                                                             <?php }?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Tipo de Conexión </label>
                                                                         <select id="update_id_tipoconex" name="update_id_tipoconex" class="form-field width40">
                                                                            <?php foreach ($Lista_tipo_conex as $tipo_conex){ ?>
                                                                             <option value="<?php echo $tipo_conex->get_id_tipoconex();?>"><?php echo $tipo_conex->get_nom_tipoconex();?></option>
                                                                             <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Fecha de la Conexión </label>
                                                                         <input id="update_fecha_detcliente" name="update_fecha_detcliente" class="form-field datepicker" type="text"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Hora de la Conexión </label>
                                                                           <input id="update_hora_detcliente" class="form-field width50" 
                                                                        name="update_hora_detcliente" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                         <label class="form-label required"> IP de la conexión</label>
                                                                          <input id="update_ip_detcliente" class="form-field width50" 
                                                                        name="update_ip_detcliente" type="text" value="" maxlength="50"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Estado de la Conexión</label>
                                                                          <select id="update_estado_conex" name="update_estado_conex" class="form-field width40">
                                                                              <option value="0">PENDIENTE</option>
                                                                              <option value="1">ACTIVADA</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                  
                                                  
                                                  <hr/>
                                                     <p class="fr">
				                    <input id="btn_Persona_Cancel" class="button themed" type="button" 
                                                    value="Cancelar" name="btn_Persona_Cancel" />
                                                    <input id="btn_Persona_Update" class="button themed" type="submit" 
                                                    value="Actualizar" name="btn_Persona_Update" />
                                                    </p>
                                                   </form>
                                               
                                            </div>
                                            
                                            <div id="tabs-1">
                                                <label class="form-label">LISTADO DE CLIENTES PENDIENTES DEL SERVICIO</label>
                                                 <label class="form-label required"> Seleccione la Fecha </label>
                                                 <input id="fecha_cliente_buscar" name="fecha_cliente_buscar" 
                                                        class="form-field datepicker" type="text"/>
                                                  <input id="btn_Cliente_filtrar" class="button themed" type="button" 
                                                   value="Visualizar" name="btn_Cliente_filtrar" />
                                                  <hr/>
                                                  <div id="div_cliente_pendiente"></div>
                                                 
                                            </div>
                                            
                                            <div id="tabs-2">
                                                
                                                 <form id="frmPersona_Add" method="post" action="">
                                                  <input type="hidden" id="save_id_tipoper" name="save_id_tipoper" value="2" />
                                                  <table border="0"  width="880" cellspacing="80">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%"></th>
                                                                <th style="width: 50%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                                           
                                                                <tr>
                                                                    <td >
                                                                        <label class="form-label required"> Nombre </label>
                                                                         <input id="save_nom_persona" class="form-field width90" 
                                                                        name="save_nom_persona" type="text" value="" maxlength="100"/>
                                                                    </td>    
                                                                    <td >
                                                                        <label class="form-label required"> Apellido </label>
                                                                         <input id="save_ape_persona" class="form-field width90" 
                                                                        name="save_ape_persona" type="text" value="" maxlength="100"/>
                                                                    </td>    
                                                                </tr>                                                         
                                                                                                              
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Sexo </label>
                                                                          <select id="save_id_sexo" name="save_id_sexo" class="form-field width40">
                                                                             <option value="1">MASCULINO</option>
                                                                               <option value="2">FEMENINO</option>
                                                                        </select> 
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Estado Civil </label>
                                                                          <select id="save_id_civil" name="save_id_civil" class="form-field width40">
                                                                          <option value="1">SOLTERO(A)</option>
                                                                           <option value="2">CASADO(A)</option>
                                                                           <option value="3">DIVORCIADO(A)</option>
                                                                           <option value="4">VIUDO(A)</option>
                                                                           <option value="5">UNIÓN LIBRE</option>
                                                                        </select> 
                                                                    </td>
                                                                    
                                                                </tr> 
                                                                   
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Cédula</label>
                                                                         <input id="save_ruc_persona" class="form-field width80" 
                                                                        name="save_ruc_persona" type="text" value="" maxlength="13"/>
                                                                    </td>
                                                                    <td>
                                                                       <label class="form-label required"> Ciudad </label>
                                                                          <select id="save_id_ciudad" name="save_id_ciudad" class="form-field width40">
                                                                            <?php foreach($arr_ciudad as $Ciudad){?>
                                                                              <option value="<?php echo $Ciudad->get_id_ciudad()?>"><?php echo $Ciudad->get_nom_ciudad()?></option>
                                                                              <?php } ?>
                                                                        </select>  
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Teléfono </label>
                                                                        <input id="save_telf_persona" class="form-field width80" 
                                                                        name="save_telf_persona" type="text" value="" maxlength="7"/>  
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Celular</label>
                                                                         <input id="save_cel_persona" class="form-field width80" 
                                                                        name="save_cel_persona" type="text" value="" maxlength="9"/>
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> E-mail </label>
                                                                           <input id="save_email_persona" class="form-field width80" 
                                                                        name="save_email_persona" type="text" value="" maxlength="50"/>
                                                                    </td>
                                                                    <td>
<!--                                                                        <label class="form-label required"> Sitio Web</label>
                                                                         <input id="save_web_persona" class="form-field width80" 
                                                                        name="save_web_persona" type="text" value="" maxlength="50"/>-->
                                                                    </td>
                                                                </tr>   
                                                                <tr >
                                                                    <td colspan="2">
                                                                         <label class="form-label required"> Dirección </label>
                                                                          <input id="save_direc_persona" class="form-field width90" 
                                                                        name="save_direc_persona" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                </tr>
                                                                <tr >
                                                                    <td colspan="2">
                                                                        <label class="form-label">Detalle de la conexión del Cliente</label>
                                                                        <hr/>
<!--                                                                         <label class="form-label required"> Descripción de la Ocupación </label>
                                                                          <input id="save_obs_persona" class="form-field width90" 
                                                                        name="save_obs_persona" type="text" value="" maxlength="100"/>-->
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Trabajador Encargado </label>
                                                                        <select id="save_id_trabajador" name="save_id_trabajador" class="form-field width60" >
                                                                            <?php foreach ($Lista_trabajador as $persona2){ ?>
                                                                            <option value="<?php echo $persona2->get_id_persona();?>"><?php 
                                                                            $var_ape=$persona2->get_nom_persona().' '.$persona2->get_ape_persona();
                                                                            echo $var_ape;?></option>
                                                                             <?php }?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Tipo de Conexión </label>
                                                                         <select id="save_id_tipoconex" name="save_id_tipoconex" class="form-field width40">
                                                                            <?php foreach ($Lista_tipo_conex as $tipo_conex){ ?>
                                                                             <option value="<?php echo $tipo_conex->get_id_tipoconex();?>"><?php echo $tipo_conex->get_nom_tipoconex();?></option>
                                                                             <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Fecha de la Conexión </label>
                                                                         <input id="save_fecha_detcliente" name="save_fecha_detcliente" class="form-field datepicker" type="text"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Hora de la Conexión </label>
                                                                           <input id="save_hora_detcliente" class="form-field width50" 
                                                                        name="save_hora_detcliente" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                         <label class="form-label required"> IP de la conexión</label>
                                                                          <input id="save_ip_detcliente" class="form-field width50" 
                                                                        name="save_ip_detcliente" type="text" value="" maxlength="50"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Estado de la Conexión</label>
                                                                          <select id="save_estado_conex" name="save_estado_conex" class="form-field width40">
                                                                              <option value="0">PENDIENTE</option>
                                                                              <option value="1">ACTIVADA</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                
                                                        </tbody>
                                                    </table>
                                                  <hr/>
                                                  <p>
                                                   <input id="btn_Persona_New" class="button themed" type="button" 
                                                   value="Nuevo" name="btn_Persona_New" />
                                                   <input id="btn_Persona_Add" class="button themed" type="submit" 
                                                   value="Guardar" name="btn_Persona_Add" />
                                                    </p>
                                                   </form>

                                               
                                                
                                            </div>
                                            
                                                <div id="tabs-3">
                                                   
                                                     <form id="frmTrabajador_Buscar" method="post" action="">
                                                      <label class="form-label required"> Búsquedad por Apellido</label>
                                                     <input id="txt_Buscar_Modificar" class="form-field width40" 
                                                    name="txt_Buscar_Modificar" type="text" value="" maxlength="10"/>
                                                      <input id="btn_Trabajador_Buscar" class="button themed" type="submit" 
                                                   value="Buscar" name="btn_Trabajador_Buscar" />
                                                     </form>
                                                    <hr/>
                                                    <div id="tabla_result"></div>
                                                    
                                                </div>
                                            
                                                <div id="tabs-4">
                                                     <form id="frmTrabajador_Buscar_Delete" method="post" action="">
                                                      <label class="form-label required"> Búsquedad por Apellido</label>
                                                     <input id="txt_Buscar_Delete" class="form-field width40" 
                                                    name="txt_Buscar_Delete" type="text" value="" maxlength="10"/>
                                                      <input id="btn_Trabajador_Buscar_Delete" class="button themed" type="submit" 
                                                   value="Buscar" name="btn_Trabajador_Buscar_Delete" />
                                                     </form>
                                                    <div id="tabla_result_delete"></div>
                                                </div>
                                               
                                                <div class="clear"></div>
                                            </div>
                                    </div>
                                </div>      
                            </div>
                        </div>

                    <div class="cleared"></div><!-- Limpio divs-->


                </div>
            </div>


            <!-- fin del sheet -->


        </div>


    </body>
</html>

<?php 
}else{
    header("location:index.php");
}
?>


