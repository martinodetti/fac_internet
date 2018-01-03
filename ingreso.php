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
        <script type="text/javascript" src="MYJS/Vozcliente.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Categorías</a></li>
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
                                        <h2 class="box-header">INSPECCIÓN PREVIA </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">LISTADO (para generar orden de reparación)</a></li>
                                                <li class="tab"><a href="#tabs-2">NUEVO</a></li>
                                            </ul>
                                        
                                        <div class="box-content">  
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                             	<span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                							<a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            	</div>
                               
                                             	
                                             	<div id="dialg_vervozcliente" class="dialog" title="SYSFACTURA INFORMA">
                                             		<form id="frmVozcliente_Update" method="post" action="">
	                                             		<input id="update_id_vozcliente" name="update_id_vozcliente" type="hidden" value="" maxlength="100"/>
						                            	<label class="form-label required"> Patente </label>
										                <input id="update_patente_vozcliente" class="form-field width20" name="update_patente_vozcliente" type="text" value="" maxlength="6"/>
										                         
				                                        <label class="form-label required"> Descripcion </label>
				                                        <textarea id="update_detalle_vozcliente" class="form-field width100" style="height:125px" name="update_detalle_vozcliente" type="text" value=""></textarea>
				                                       	<hr/>
				                                       	<label class="form-label required"> Contacto </label>
				                                        <textarea id="update_contacto_vozcliente" class="form-field width100" style="height:125px" name="update_contacto_vozcliente" type="text" value=""></textarea>
				                                       	<hr/>
				                                       	<p>
				                                       		<input id="dialg_vozcliente_close" class="button themed" type="button" value="Cerrar" name="dialg_vozcliente_close" />
				                                       		<input id="btn_vozcliente_Update" class="button themed" type="button" value="Actualizar" name="btn_vozcliente_Update" />
				                                       		<input id="btn_vozcliente_Print" class="button themed" type="button" value="Imprimir" name="btn_vozcliente_Print" />
				                                       	</p>
		                                           	</form>
		                                		</div> 
                                             	
                                             	
                                            <div id="tabs-1">
                                                    <div id="tabla_result">
                                                         <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
															<thead>
																<tr>
																	<th width="30px">ID</th>
																	<th width="115px">Fecha y hora</th>
																	<th width="50px">Patente</th>
																	<th>Detalle</th>
																	<th>Contacto</th>
																	<th width="60">Acciones</th>
																</tr>
															</thead>
															<tbody>
												
															</tbody>
                                                        </table>
                                                    </div>
                                                    
                                            </div>
                                            
                                                <div id="tabs-2">
                                                
                                                 <form id="frmMarca_producto_Add" method="post" action="">
                                                    <label class="form-label required"> Patente </label>
						                            <input id="save_patente" class="form-field width40" name="save_patente" type="text" value="" maxlength="6"/>
						                            
	                                                <label class="form-label required"> Detalle </label>
	                                                <textarea id="save_detalle" class="form-field width100" style="height:135px" name="save_detalle" type="text" value=""></textarea>
	                                                <label class="form-label required"> Contactos </label>
	                                                <textarea id="save_contacto" class="form-field width100" style="height:135px" name="save_contacto" type="text" value=""></textarea>
		                        
                            
                                                    <p>
                                                   <input id="btn_Marca_producto_New" class="button themed" type="button" value="Nuevo" name="btn_Marca_producto_New" />
                                                   <input id="btn_Marca_producto_Add" class="button themed" type="submit" value="Guardar" name="btn_Marca_producto_Add" />
                                                    </p>
                                                </form>

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
