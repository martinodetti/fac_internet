<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<?php 
 include 'DAC/Database.class.php';
 include 'MODEL/Persona.php';
 include 'MODEL/V_acceso_modulo.php';
session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$persona=$persona->showPersona($id_persona);
$clsVmodulo=new v_acceso_modulo();
$cls_arrModulo=$clsVmodulo->comboModulo();
?>


<html  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="UTMACH "/>
        <meta name="description" content=""/>
        <meta name="generator" content=""/>
        <title>SISTEMA DE FACTURACIÓN</title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
<!--        <link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/>-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
         <link rel="stylesheet" type="text/css" href="CSS_INTERNO/datagrid.css"/>
	<link rel="stylesheet" type="text/css" href="CSS_INTERNO/combo.css"/>
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->
<!--        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>-->
        <script type="text/javascript" src="JS/jquery-1.6.2.min.js" ></script>
        <script type="text/javascript" src="JS/jquery.easyui.min.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
          <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
        <script type="text/javascript" src="MYJS/Permiso.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Permiso</a></li>
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
                                        <h2 class="box-header">PERMISO </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">ADMINISTRAR PERMISOS</a></li>
<!--
                                                <li class="tab"><a href="#tabs-2">ELIMINAR PERMISOS</a></li>
-->
                                             
                                            </ul>
                                        
                                        <div class="box-content"> 
                                            
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                				<a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                            
 
                                            <div id="tabs-1">
                                                 
                                                 <label class="form-label required"> Apellido :</label>
                                                   <input id="cmbgridApe" name="cmbgridApe"   />
                                                   <form  id="form_permiso_new" method="post">
                                                  		<label class="form-label required"> Nombre y Apellido</label>
                                                   		<input id="txt_apellidos_new" readonly="true" class="form-field width40" name="txt_apellidos_new" type="text" value="" maxlength="100"/>
                                                   		<input type="hidden" id="txt_idpersona_new" name="txt_idpersona_new" value="" />
                                                   		<label class="form-label required">Usuario</label>
                                                   		<input id="txt_usuario"  class="form-field width40" name="txt_usuario" type="text" value="" maxlength="32"/>
                                                      	<label class="form-label required"> Clave</label>
                                                      	<input id="txt_clave_new"  class="form-field width40" name="txt_clave_new" type="password" value="" maxlength="32"/>
                                                       	<div id="div_aux" style="display: none" >
                                                        	<input id="btn_aux" name="btn_aux" type="submit" value="Auxiliar" />
                                                     	</div>
                                                   </form>
                                                   <form id="frm_combo">
                                                 
                                                       <table border="0">
                                                      <thead>
                                                          <tr >
                                                              <th style="width:300px">
                                                                  
                                                              </th>
                                                              <th style="width:300px">
                                                              </th>
                                                          </tr>
                                                         
                                                      </thead>
                                                          <tbody>
                                                              <tr>
                                                                  <td>
                                                                       	<label class="form-label required"> Escoja la categoría</label>   
                                                                  		<select id="cmbModulo" name="cmbModulo" class="form-field width80" >
                                                                       		<option value="0"></option>
                                                                           <?php  foreach($cls_arrModulo as $clsVmodulo){ ?>
                                                                           <option value="<?php echo $clsVmodulo->get_id_modulo()?>"><?php echo $clsVmodulo->get_nom_modulo()?></option>
                                                                             <?php }?>
                                                                           </select>
                                                                  </td>
                                                                  <td>
                                                                    <label class="form-label required"> Escoja el módulo</label>  
                                                                    <select id="cmbAccion" name="cmbAccion" class="form-field width80" ></select>
                                                                    
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                  <td>
                                                                   <input id="btn_Permiso_Add" class="button themed" type="submit" 
                                                                  value="Agregar" name="btn_Permiso_Add" />
                                                                  </td>
                                                                  <td>
                                                                      <input id="btn_Permiso_quitar" class="button themed" type="button" 
                                                                  value="Quitar" name="btn_Permiso_quitar" />
                                                                  </td>
                                                              </tr>
                                                          </tbody>
                                                      </table>
                                                  
                                                   </form>    
                                                   <hr/>
                                                   <table id="tt" class="easyui-datagrid" style="width:400px;height:250px"
                                                           fitColumns="true" title="Modulos"  singleSelect="true" showFooter="true"
                                                           rownumbers="true" >
                                                        <thead>
                                                            <tr>
                                                                <th field="id" width="20">ID</th>
                                                                <th field="modulo" width="80">Modulo</th>
                                                                <th field="padre" width="80">Padre</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                  <hr/> 
                                                    <input id="btn_Permiso_Nuevo" class="button themed" type="button" 
                                                                  value="Nuevo" name="btn_Permiso_Nuevo" />
                                                    <input id="btn_Permiso_Guardar" class="button themed" type="button" 
                                                                  value="Guardar" name="btn_Permiso_Guardar" />
                                            </div>
<!--                                            
                                                <div id="tabs-2">
                                                     <label class="form-label required"> Seleccione el Trabajador :</label>
                                                   <input id="cmbgridTrabajador" name="cmbgridTrabajador"   />
                                                   <form id="frm_update_Acceso">
                                                       <input type="hidden" id="txt_update_idpersona" name="txt_update_idpersona" value="" />
                                                       <label class="form-label required"> Nombre y Apellido</label>
                                                       <input id="txt_update_apellidos" readonly="true" class="form-field width40" 
                                                    name="txt_update_apellidos" type="text" value="" maxlength="100"/>
                                                       <hr/>
                                                        <input id="btn_updateAcceso_Nuevo" class="button themed" type="button" 
                                                                  value="Nuevo" name="btn_Permiso_Nuevo" />
                                                    <input id="btn_updateAcceso_Actualizar" class="button themed" type="submit" 
                                                                  value="Eliminar" name="btn_Permiso_Guardar" />
                                                   </form>
                                                    
                                                </div>
                                            
                                            
-->                                              
                                              
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
