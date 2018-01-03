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
        <!--link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
         <link rel="stylesheet" href="CSS_INTERNO/demo_table_jui.css"/> 
	<link rel="stylesheet" href="CSS_INTERNO/external/jquery-ui-1.8.4.custom.css"/>
         <link rel="stylesheet" href="CSS_INTERNO/TableTools_JUI.css"/> 
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->
        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
         <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
        <script type="text/javascript" src="new_js/Unidad_medida.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Unidades de medida</a></li>
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
                                        <h2 class="box-header">UNIDADES DE MEDIDA </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">MODIFICAR</a></li>
                                                <li class="tab"><a href="#tabs-2">NUEVO</a></li>
                                                <li class="tab"><a href="#tabs-3">ELIMINAR</a></li>
                                            </ul>
                                        
                                        <div class="box-content">  
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                             	<span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                							<a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            	</div>
                                            
                                            	<div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">   
                                                	<form id="frmUnidadMedida_Update" method="post" action="">
														<input type="hidden" id="update_id_unimedida" name="update_id_unimedida" value="" />
														<label class="form-label required"> Unidad de Medida </label>
														<input id="update_nom_unimedida" class="form-field width40" name="update_nom_unimedida" type="text" value="" maxlength="100"/>
														<hr/>
														<p class="fr">
														<input id="btn_UnidadMedida_Cancelar" class="button themed" type="button" value="Cancelar" name="btn_UnidadMedida_Cancelar" />
														<input id="btn_UnidadMedida_Update" class="button themed" type="submit" value="Actualizar" name="btn_UnidadMedida_Update" />
														</p>
													</form>
												</div>

                                            <div id="tabs-1">
												<div id="tabla_result">
													<table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
														<thead>
															<tr>
																<th>ID</th>
																<th>Unidad</th>
																<th>Opción</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
                                            </div>
                                            
											<div id="tabs-2">
												<form id="frmUnidad_medida_Add" method="post" action="">
													<label class="form-label required"> Unidad de Medida </label>
													<input id="save_nom_unimedida" class="form-field width40" name="save_nom_unimedida" type="text" value="" maxlength="100"/>
													<p>
													<input id="btn_Unidad_medida_New" class="button themed" type="submit" value="Nuevo" name="btn_Unidad_medida_New" />
													<input id="btn_Unidad_medida_Add" class="button themed" type="submit" value="Guardar" name="btn_Unidad_medida_Add" />
													</p>
												</form>	
											</div>
                                            
											<div id="tabs-3">
												<form id="frmMedida_Buscar_Delete" method="post" action="">
													<label class="form-label required"> Búsquedad por Unidad de Medida</label>
													<input id="txt_Buscar_Delete" class="form-field width40" name="txt_Buscar_Delete" type="text" value="" maxlength="100"/>
													<input id="btn_Ganancia_Buscar_Delete" class="button themed" type="submit" value="Buscar" name="btn_Ganancia_Buscar_Delete" />
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