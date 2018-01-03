<?php
include_once 'CONTROLLER/C_Debug.php';
session_start();
if(!isset($_SESSION['id_persona'])){
        header('Location: index.php');
        exit();
}
?>
<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<?php 
 include 'DAC/Database.class.php';
 include 'MODEL/Provincia.php';
 include 'MODEL/Persona.php';
session_start();

if(isset ($_SESSION['id_persona'])){
 	$id_persona=$_SESSION['id_persona'];   
	$persona=new persona();
	$persona=$persona->showPersona($id_persona);
?>


<html  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="UTMACH "/>
        <meta name="description" content=""/>
        <meta name="generator" content="Bluefish 2.2.4" />
        <title>SISTEMA DE FACTURACIÓN </title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/datagrid.css"/>
        
        <!--link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
        <link rel="stylesheet" href="CSS_INTERNO/demo_table_jui.css"/> 
		<link rel="stylesheet" href="CSS_INTERNO/external/jquery-ui-1.8.4.custom.css"/>
        <link rel="stylesheet" href="CSS_INTERNO/TableTools_JUI.css"/> 
        
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->
<!--        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script> -->
        <script type="text/javascript" src="JS/jquery-1.6.2.min.js" ></script>
        <script type="text/javascript" src="JS/jquery.easyui.min.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
        <script type="text/javascript" src="JS/jquery.dataTables.js" ></script>
        <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
        <script type="text/javascript" src="MYJS/Provincia.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Provincias</a></li>
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
                                        <h2 class="box-header">PROVINCIAS </h2>
                                          	<ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">MODIFICAR</a></li>
                                                <li class="tab"><a href="#tabs-2">NUEVO</a></li>
												<li class="tab"><a href="#tabs-3">LOCALIDADES</a></li>
                                                <li class="tab"><a href="#tabs-4">ELIMINAR</a></li>
                                          	</ul>
                                        
                                        	<div class="box-content">  
                                             	<div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                             		<span id="msg" class="message success"></span>
                                                	<p class="fr"></p>
				                					<a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            	</div>
                                            	
                                            	<!-- NUEVA CIUDAD -->
                                            	<div id="dialg_form_2" class="dialog" title="SYSFACTURA INFORMA">       
                                             		<br>
		                                         	<label class="form-label required"> Localidad </label>
					                    			<input id="update_nom_ciudad" class="form-field width60" name="update_nom_ciudad" type="text" value="" maxlength="100"/>
                                            		<p class="fr">
					                				<input id="btn_ciudad_Cancel" class="button themed" type="button" value="Cancelar" name="btn_ciudad_Cancel" />
	                                               	<input id="btn_ciudad_update" class="button themed" type="submit" value="Guardar" name="btn_ciudad_update" />
	                                               	</p>
                                            	</div>
                                            
                                            	<!-- UPDATE PROVINCIA -->
                                            	<div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">   
                                                
		                                        	<form id="frmProvincia_Update" method="post" action="">
		                                        		<table width="500" cellspacing="50">
		                                                    <thead>
		                                                        <tr>
		                                                            <th style="width: 40%"></th>
		                                                            <th style="width: 60%"></th>
		                                                        </tr>
		                                                    </thead>
		                                                    <tbody>                                                           
		                                                    	<tr>
		                                                            <td>
		                                                            	<br>
		                                                            	<input type="hidden" id="update_id_provincia" name="update_id_provincia" value="" />
							                                         	<label class="form-label required"> PROVINCIA </label>
										                    			<input id="update_nom_provincia" class="form-field width60" name="update_nom_provincia" type="text" value="" maxlength="100"/>
		                                                            </td>
		                                                            <td>
		                                                            	<table id="localidad_table" class="easyui-datagrid" style="width:220px;height:auto" fitColumns="TRUE" title="Localidades"  singleSelect="true" showFooter="true" rownumbers="true" >
												                            <thead>
												                                <tr>
												                                    <th field="id" width="20">ID</th>
												                                    <th field="ciudad" width="150">Localidad</th>
												                                </tr>
												                            </thead>
																			<tbody>
													
																			</tbody>
												                        </table>
												                        <br>
												                        <input id="btn_Ciudad_new" class="button themed" type="button" value="Nueva" name="btn_Ciudad_new" />
		                                                            </td>
		                                                    	</tr>
		                                                    </tbody>
                                                   		</table>
		                                        		
		                                            	
		                                               	<hr/>
		                                               	<p class="fr">
						                				<input id="btn_Provincia_Cancel" class="button themed" type="button" value="Cancelar" name="btn_Provincia_Cancel" />
		                                               	<input id="btn_Provincia_Update" class="button themed" type="submit" value="Actualizar" name="btn_Provincia_Update" />
		                                               	</p>
		                                            </form>
		                                    	</div>
												
												<!-- UPDATE PROVINCIA -->
                                            	<div id="dialg_form_ciudad" class="dialog" title="SYSFACTURA INFORMA">   
                                                
		                                        	<form id="frmCiudad_Update" method="post" action="">
		                                        		<table width="300" cellspacing="50">
		                                                    <thead>
		                                                        <tr>
		                                                            <th style="width: 40%"></th>
		                                                            <th style="width: 60%"></th>
		                                                        </tr>
		                                                    </thead>
		                                                    <tbody>                                                           
		                                                    	<tr>
		                                                            <td>
		                                                            	<br>
		                                                            	<input type="hidden" id="update_id_ciudad_edit" name="update_id_ciudad_edit" value="" />
							                                         	<label class="form-label required"> CIUDAD </label>
										                    			<input id="update_nom_ciudad_edit" class="form-field width200" name="update_nom_ciudad_edit" type="text" value="" maxlength="100"/>
		                                                            </td>
		                                                    	</tr>
		                                                    </tbody>
                                                   		</table>
		                                        		
		                                            	
		                                               	<hr/>
		                                               	<p class="fr">
						                				<input id="btn_Ciudad_Cancel" class="button themed" type="button" value="Cancelar" name="btn_Ciudad_Cancel" />
		                                               	<input id="btn_Ciudad_Edit" class="button themed" type="submit" value="Actualizar" name="btn_Ciudad_Edit" />
		                                               	</p>
		                                            </form>
		                                    	</div>



                                            <div id="tabs-1">
                                                    <div id="tabla_result">
                                                         <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Provincia</th>
																	<th>Opción</th>
																</tr>
															</thead>
															<tbody>
												
															</tbody>
                                                        </table>
                                                    </div>
                                                    
                                            </div>
                                            
                                                <div id="tabs-2">
                                                
                                                 <form id="frmProvincia_Add" method="post" action="">
                                                    <label class="form-label required"> Provincia </label>
						                            <input id="save_nom_provincia" class="form-field width40" name="save_nom_provincia" type="text" value="" maxlength="100"/>
                            
                                                    <p>
                                                   	<input id="btn_Provincia_New" class="button themed" type="button" value="Nuevo" name="btn_Provincia_New" />
                                                   	<input id="btn_Provincia_Add" class="button themed" type="submit" value="Guardar" name="btn_Provincia_Add" />
                                                    </p>
                                                </form>

                                                </div>
												
												<div id="tabs-3">
                                                    <div id="tabla_result_loc">
                                                         <table id="table-example_loc" cellpadding="0" cellspacing="0" border="0" class="display" >
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Localidad</th>
																	<th>Provincia</th>
																	<th>Opción</th>
																</tr>
															</thead>
															<tbody>
												
															</tbody>
                                                        </table>
                                                    </div>
                                                    
                                            </div>
                                            
                                                <div id="tabs-4">
                                                     <form id="frmProvincia_Buscar_Delete" method="post" action="">
		                                                 <label class="form-label required"> Búsqueda por Provincia</label>
		                                                 <input id="txt_Buscar_Delete" class="form-field width40" name="txt_Buscar_Delete" type="text" value="" maxlength="100"/>
		                                                 <input id="btn_Provincia_Buscar_Delete" class="button themed" type="submit" value="Buscar" name="btn_Provincia_Buscar_Delete" />
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
<script type="text/javascript" charset="utf-8" src="new_js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" src="new_js/ZeroClipboard.js"></script>
    <script type="text/javascript" charset="utf-8" src="new_js/TableTools.js"></script>

    </body>
</html>

<?php 
}
?>
