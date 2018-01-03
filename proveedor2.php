<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<?php 
 include 'DAC/Database.class.php';
 include 'MODEL/Persona.php';
 include 'MODEL/Ciudad.php';
session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$persona=$persona->showPersona($id_persona);
$Ciudad=new ciudad();
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
         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
        <script type="text/javascript" src="MYJS/Persona.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Proveedor</a></li>
                            <li class="fr"><a class="button gray fl" title="logout" href="CONTROLLER/Salir.php" >
                                    <span class="icon_text logout"></span>Salir</a></li>
                            <li class="s_1 fr"></li>
                           
<!--                            <li class="s_1 fr"></li>-->
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
                                        <h2 class="box-header">PROVEEDOR </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">NUEVO</a></li>
                                                <li class="tab"><a href="#tabs-2">MODIFICAR</a></li>
                                                <li class="tab"><a href="#tabs-3">ELIMINAR</a></li>
                                            </ul>
                                        
                                        <div class="box-content">  
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                  <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                            
                                            <div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">   
                                                <form id="frmPersona_Update" method="post" action="">
                                                  <input type="hidden" id="update_id_persona" name="update_id_persona" value="" />
                                                  <input type="hidden" id="update_id_tipoper" name="update_id_tipoper" value="" />
                                                  <table   width="820" cellspacing="80">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%"></th>
                                                                <th style="width: 50%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                                           
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <label class="form-label required"> Razón Social </label>
                                                                         <input id="update_nom_persona" class="form-field width90" 
                                                                        name="update_nom_persona" type="text" value="" maxlength="100"/>
                                                                    </td>    
                                                                </tr>                                                         
                                                                                                              
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Ciudad </label>
                                                                        
                                                                          <select id="update_id_ciudad" name="update_id_ciudad" class="form-field width40">
                                                                                  <?php foreach($arr_ciudad as $Ciudad){?>
                                                                              <option value="<?php echo $Ciudad->get_id_ciudad()?>"><?php echo $Ciudad->get_nom_ciudad()?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> RUC</label>
                                                                         <input id="update_ruc_persona" class="form-field width80" 
                                                                        name="update_ruc_persona" type="text" value="" maxlength="15"/>
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Teléfono </label>
                                                                        <input id="update_telf_persona" class="form-field width80" 
                                                                        name="update_telf_persona" type="text" value="" maxlength="14"/>  
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Celular</label>
                                                                         <input id="update_cel_persona" class="form-field width80" 
                                                                        name="update_cel_persona" type="text" value="" maxlength="14"/>
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> E-mail </label>
                                                                           <input id="update_email_persona" class="form-field width80" 
                                                                        name="update_email_persona" type="text" value="" maxlength="50"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Sitio Web</label>
                                                                         <input id="update_web_persona" class="form-field width80" 
                                                                        name="update_web_persona" type="text" value="" maxlength="50"/>
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
                                                                         <label class="form-label required"> Descripción </label>
                                                                          <input id="update_obs_persona" class="form-field width90" 
                                                                        name="update_obs_persona" type="text" value="" maxlength="100"/>
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
                                                
                                                 <form id="frmPersona_Add" method="post" action="">
                                                  <input type="hidden" id="save_id_tipoper" name="save_id_tipoper" value="3" />
                                                  <table border="0"  width="880" cellspacing="80">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%"></th>
                                                                <th style="width: 50%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                                           
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <label class="form-label required"> Razón Social </label>
                                                                         <input id="save_nom_persona" class="form-field width90" 
                                                                        name="save_nom_persona" type="text" value="" maxlength="100"/>
                                                                    </td>    
                                                                </tr>                                                         
                                                                                                              
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Ciudad </label>
                                                                          <select id="save_id_ciudad" name="save_id_ciudad" class="form-field width40">
                                                                            <?php foreach($arr_ciudad as $Ciudad){?>
                                                                              <option value="<?php echo $Ciudad->get_id_ciudad()?>"><?php echo $Ciudad->get_nom_ciudad()?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> RUC</label>
                                                                         <input id="save_ruc_persona" class="form-field width80" 
                                                                        name="save_ruc_persona" type="text" value="" maxlength="13"/>
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
                                                                        <label class="form-label required"> Sitio Web</label>
                                                                         <input id="save_web_persona" class="form-field width80" 
                                                                        name="save_web_persona" type="text" value="" maxlength="50"/>
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
                                                                         <label class="form-label required"> Descripción </label>
                                                                          <input id="save_obs_persona" class="form-field width90" 
                                                                        name="save_obs_persona" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                  <p>
                                                   <input id="btn_Persona_New" class="button themed" type="button" 
                                                   value="Nuevo" name="btn_Persona_New" />
                                                   <input id="btn_Persona_Add" class="button themed" type="submit" 
                                                   value="Guardar" name="btn_Persona_Add" />
                                                    </p>
                                                   </form>

                                               
                                                
                                            </div>
                                            
                                                <div id="tabs-2">
                                                   
                                                     <form id="frmProveedor_Buscar" method="post" action="">
                                                      <label class="form-label required"> Búsquedad por Razón Social</label>
                                                     <input id="txt_Buscar_Modificar" class="form-field width40" 
                                                    name="txt_Buscar_Modificar" type="text" value="" maxlength="10"/>
                                                      <input id="btn_Proveedor_Buscar" class="button themed" type="submit" 
                                                   value="Buscar" name="btn_Proveedor_Buscar" />
                                                     </form>
                                                    <hr/>
                                                    <div id="tabla_result"></div>
                                                    
                                                </div>
                                            
                                                <div id="tabs-3">
                                                     <form id="frmProveedor_Buscar_Delete" method="post" action="">
                                                      <label class="form-label required"> Búsquedad por Razón Social</label>
                                                     <input id="txt_Buscar_Delete" class="form-field width40" 
                                                    name="txt_Buscar_Delete" type="text" value="" maxlength="10"/>
                                                      <input id="btn_Proveedor_Buscar_Delete" class="button themed" type="submit" 
                                                   value="Buscar" name="btn_Proveedor_Buscar_Delete" />
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

