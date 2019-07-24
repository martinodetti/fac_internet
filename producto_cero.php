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
 include 'MODEL/Tiporetencion.php';
 include 'MODEL/Marca_producto.php';
 include 'MODEL/Unidad_medida.php';
 include 'MODEL/Ganancia.php';
 include 'MODEL/Tipoiva.php';
session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$persona=$persona->showPersona($id_persona);

$TipoReten=new tiporetencion();
$arr_tiporeten=array();
$arr_tiporeten=$TipoReten->ComboTipoRetencion();

$TipoIva=new tipoiva();
$arr_tipoiva=array();
$arr_tipoiva=$TipoIva->ComboTipoIva();

$Marca=new marca_producto();
$arr_marca=array();
$arr_marca=$Marca->ComboMarca();

$Unidad=new unidad_medida();
$arr_unidad=array();
$arr_unidad=$Unidad->ComboUnidadMedida();

$Ganancia=new ganancia();
$arr_ganancia=array();
$arr_ganancia=$Ganancia->ComboGanancia();

$arr_provd=array();
$arr_provd=$persona->ComboProveedor();



?>


<html  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="UTMACH "/>
        <meta name="description" content=""/>
        <meta name="generator" content="Bluefish 2.2.3" />
        <title>SISTEMA DE FACTURACIÓN</title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
<!--        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/autocomplete.css"  media="screen"/>-->
        
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
       <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
        <!--link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/upload.css" type="text/css"/>
         <link rel="stylesheet" href="CSS_INTERNO/demo_table_jui.css"/> 
	<link rel="stylesheet" href="CSS_INTERNO/external/jquery-ui-1.8.4.custom.css"/>
         <link rel="stylesheet" href="CSS_INTERNO/TableTools_JUI.css"/> 
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->

        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
         <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
          <script type="text/javascript" src="JS/ajaxupload.3.5.js" ></script>
        <script type="text/javascript" src="new_js/Producto_cero.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> PRODUCTOS</a></li>
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
                                        <h2 class="box-header">ARTICULOS </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">MODIFICAR</a></li>
<!--                                                <li class="tab"><a href="#tabs-2">NUEVO</a></li>
                                                <li class="tab"><a href="#tabs-3">ELIMINAR</a></li>
                                                <li class="tab"><a href="#tabs-4">AUMENTO DE PRECIOS</a></li>-->
                                            </ul>
                                        
                                        <div class="box-content">   
                                            
                                            <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                				<a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                            
                                            <div id="dialg_error" class="dialog" title="SYSFACTURA INFORMA">     
                                                <span id="msg" class="message error">
                                                El código ingresado ya está cargado y asociado al proveedor seleccionado
                                                </span>
                                                <p class="fr"></p>
				                				<a id="dialg_error_close" class="button themed closer">Aceptar</a>
                                            </div>
                                            
                                            <!-- UPDATE DE PRODUCTOS -->
                                            
                                               <div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">   
                                                      
                                                 <form id="frmProducto_Update" method="post" action="">
													<input type="hidden" id="update_id_producto" name="update_id_producto" value="" />
													<input type="hidden" id="update_cambio_fecha" name="update_cambio_fecha" value="0"/>
													<table border="0"  width="450" cellspacing="60">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%"></th>
                                                                <th style="width: 50%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                                           
                                                                <tr>
                                                                    <td >
                                                                        <label class="form-label required"> Código </label>
                                                                         <input id="update_nom_producto" class="form-field width40" name="update_nom_producto" type="text" value="" maxlength="100"/>
                                                                    </td>   
                                                                    <td>
                                                                       
                                                                        <label class="form-label required"> Proveedor </label>
                                                                        <div id="div_proveedor2" class="ui-helper-clearfix"> 
                                                                        <input id="update_tipo_proveedor" class="form-field width20" name="update_tipo_proveedor" type="text" />
                                                                         </div>
                                                                    </td>
                                                                </tr>                                                         
                                                                                                              
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Nombre del producto </label>
                                                                       <input id="update_descrip_producto" class="form-field width60" name="update_descrip_producto" type="text" value="" maxlength="200"/>
                                                                    </td>
																	<td>
																		<label class="form-label required"> Tipo </label>
																		<select id="update_tipo" name="update_tipo" class="form-field width40">
                                                                             <option value="comerciable">Comerciable</option>
																			 <option value="insumo">insumo</option>
                                                                        </select> 
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Código de Barra </label>
                                                                        <input id="update_codbarra_producto" class="form-field width60" name="update_codbarra_producto" type="text" value="" maxlength="50"/>  
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Marca</label>
                                                                         <select id="update_id_marca" name="update_id_marca" class="form-field width40">
                                                                            <?php foreach($arr_marca as $Marca){?>
                                                                             <option value="<?php echo $Marca->get_id_marca()?>"><?php echo $Marca->get_nom_marca()?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Tipo de IVA </label>
                                                                          <select id="update_id_tipoiva" name="update_id_tipoiva" class="form-field width40">
                                                                            <?php foreach($arr_tipoiva as $tipoiva){?>
                                                                              <option value="<?php echo $tipoiva->get_id_tipoiva()?>"><?php  $dat=$tipoiva->get_nom_tipoiva();$dat=$dat.' -> '.$tipoiva->get_porcentaje_iva();echo $dat;?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Unidad de Medida</label>
                                                                         <select id="update_id_unimedida" name="update_id_unimedida" class="form-field width40">
                                                                            <?php foreach($arr_unidad as $Unidad){?>
                                                                             <option value="<?php echo $Unidad->get_id_unimedida()?>"><?php echo $Unidad->get_nom_unimedida()?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                </tr>   
                                                                <tr >
                                                                    <td >
                                                                         <label class="form-label required"> Costo </label>
                                                                          <input id="update_costo_producto" class="form-field width40" 
                                                                        name="update_costo_producto" type="text" value="" maxlength="10"/>
                                                                    </td>
                                                                    <td >
<!--
                                                                         <label class="form-label required"> Ganancia(%) </label>
                                                                          <select id="update_id_ganancia" name="update_id_ganancia" class="form-field width40">
                                                                            <?php foreach($arr_ganancia as $Ganancia){?>
                                                                              <option value="<?php echo $Ganancia->get_id_ganancia()?>"><?php echo $Ganancia->get_porctj_ganancia()?></option>
                                                                              <?php } ?>
                                                                        </select> 
-->
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                         <label class="form-label required"> Precio de Venta </label>
                                                                         <input id="update_pvp1_producto" class="form-field width40" name="update_pvp1_producto" type="text"  value="" maxlength="10"/>
                                                                    </td>
																	<td colspan>
                                                                        <label class="form-label required"> Posición </label>
                                                                        <input id="update_posicion_producto" name="update_posicion_producto" class="form-field width40" type="text" value=""/>
                                                                    </td> 
                                                                </tr>
                                                                <tr>
																	<td >
                                                                         <label class="form-label required"> Stock Mínimo </label>
                                                                          <input id="update_stkmin_producto" class="form-field width40" name="update_stkmin_producto" type="text" value="" maxlength="10"/>
                                                                    </td>
                                                                    <td >
                                                                         <label class="form-label required"> Stock Máximo </label>
                                                                          <input id="update_stkmax_producto" class="form-field width40" name="update_stkmax_producto" type="text" value="" maxlength="10"/>
                                                                    </td>
                                                                </tr>
																<tr>
																	<td >
                                                                         <label class="form-label required"> Stock Actual </label>
                                                                          <input id="update_stkactual_producto" class="form-field width40" name="update_stkactual_producto" type="text" value="" maxlength="10"/>
                                                                    </td>
                                                                </tr>
                                                                <tr >

																	<td >
                                                                         <label class="form-label required"> Fecha de Ingreso </label>
                                                                          <input id="update_fecing_producto" name="update_fecing_producto" class="form-field datepicker" type="text"/>
                                                                    </td>
                                                                    <td colspan>
                                                                        <label class="form-label required"> Fecha de actualización </label>
                                                                        <input id="update_fecupdate_producto" name="update_fecupdate_producto" class="form-field datepicker" type="text"/>
                                                                    </td>
                                                                </tr>

                                                                <tr >

                                                                    <td >
                                                                         <label class="form-label"> Chequeado </label>
                                                                          <input id="update_chequeado_producto" name="update_chequeado_producto" class="form-field" type="checkbox"/>
                                                                    </td>
                                                                    <td>
                                                                    </td>
                                                                </tr>
<!--
                                                                <tr>
                                                                    <td >
                                                                        <label class="form-label required"> Imagen del Producto </label>
                                                                        <input type="text" class="form-field width60"  readonly="true" name="update_img_producto" id="update_img_producto" value="" />
                                                                        <div id="vision2" class="Uploadfrontal">
                                                                         
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                         <input id="upload_img2" class="button themed" type="button" value="Subir Imagen" name="upload_img"  />
                                                                         <span id="status2" ></span>
                                                                    </td>
                                                                </tr>
-->
                                                              
                                                        </tbody>
                                                    </table>
                                                     <hr/>
                                                  <p>
                                                   <input id="btn_Producto_Cancel" class="button themed" type="button" 
                                                   value="Cancel" name="btn_Producto_Cancel" />
                                                   <input id="btn_Producto_Update" class="button themed" type="submit" 
                                                   value="Actualizar" name="btn_Producto_Update" />
                                                    </p>
                                                   </form>
                                                
                                               
                                            </div>
                                            
                                            
                                            <div id="tabs-1">                                            
                                                   
                                                    <div id="tabla_result">
                                                        
                                                        <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Código</th>
																	<th>Producto</th>
																	<th>Marca</th>
																	<th>Costo</th>
																	<th>Precio de Venta</th>
																	<th>Stock min</th>
																	<th>Stock actual</th>
																	<th>Ingreso</th>
																	<th>Actualización</th>
																	<th>Opción</th>
																</tr>
															</thead>
															<tbody>	

															</tbody>
                                                        </table>
                                                    </div>
                                                    
                                                </div>
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
