<?php
session_start();

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include_once 'MODEL/Remito.php';
include 'MODEL/Descuento_venta.php';
include 'MODEL/Producto.php';
include 'MODEL/Persona.php';

if(!isset($_SESSION['id_persona'])){
    header('Location: index.php');
	exit();
}

if(isset ($_SESSION['id_persona'])){
	$id_persona		= $_SESSION['id_persona'];
	$persona		= new persona();
	$persona		= $persona->showPersona($id_persona);
	$clsProducto	= new producto();
	$ListaProductos	= $clsProducto->listProductosPorNombre("");
	$remito 		= new remito();
?>

<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="INTERNET"/>
        <meta name="description" content="Proveedor de Internet"/>
        <meta name="generator" content="Bluefish 2.2.4" />
        <title>SISTEMA DE FACTURACIÓN</title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
<!--        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
-->
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
		<link rel="stylesheet" href="CSS_INTERNO/demo_table_jui.css"/>
         <link rel="stylesheet" type="text/css" href="CSS_INTERNO/datagrid.css"/>
		<link rel="stylesheet" type="text/css" href="CSS_INTERNO/combo.css"/>

		<script type="text/javascript" src="JS/jquery-1.6.2.min.js" ></script>
		<script type="text/javascript" src="JS/jquery.dataTables.js" ></script>
        <script type="text/javascript" src="JS/jquery.easyui.min.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
        <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
        <script type="text/javascript" src="MYJS/Remito.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Remito</a></li>
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

                                <h2 class="box-header">REMITO </h2>
                               		<ul class="tabs-nav">
                                		<li class="tab"><a href="#tabs-1">NUEVO</a></li>
										<li class="tab"><a href="#tabs-2">LISTADO</a></li>
                               		</ul>

                                    <div class="box-content">

                                    	<div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">
                                    		<span id="msg" class="message success"></span>
											<p class="fr"></p>
							                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                    	</div>

										<div id="dialg_generar" class="dialog" title="SYSFACTURA INFORMA">
                                    		<span id="msg_generar" class="message success"></span>
											<p class="fr"></p>
							                <a id="dial_generar_close" class="button themed closer">Aceptar</a>
                                    	</div>

                                    	<div id="dialg_confirmar_regenerar" class="dialog" title="SYSFACTURA INFORMA">
                                    		<span id="msg_regenerar" class="message warning">Confirma que desea crear un nuevo presupuesto con la Orden de Reparación</span>
											<p class="fr"></p>
							                <input id="btn_dialg_regenerar_acept" class="button themed" type="button" value="Aceptar" name="btn_dialg_regenerar_acept" />
                                       		<input id="btn_dialg_regenerar_close" class="button themed" type="button" value="Cancelar" name="btn_dialg_regenerar_close" />
                                    	</div>

										<div id="error_msg" class="error" title="SYSFACTURA INFORMA">
                                    		<span id="msg_err" class="message error"></span>
											<p class="fr"></p>
							                <a id="error_msg_close" class="button themed closer">Aceptar</a>
                                    	</div>

                                    	<div id="dialg_open" class="dialog" title="SYSFACTURA INFORMA">
                                    		<form id="frm_addordenopen">
												<label class="form-label required"> Clave </label>
                                                <input id="clave_usuario" class="form-field width40" name="clave_usuario" type="password" value="" maxlength="50"/>
                                               		<input id="dialg_open_acept" class="button themed" type="button" value="Aceptar" name="dialg_open_acept" />
                                               		<input id="dialg_open_close" class="button themed" type="button" value="Cancelar" name="dialg_open_close" />
                                               	</p>
                                           	</form>
                                    	</div>

										<div id="dialg_manoobra" class="dialog" title="SYSFACTURA INFORMA">
                                    		<form id="frm_addManoobra">
												<input type="hidden" id="id_manoobra" name="id_manoobra" value="" />
                                                <label class="form-label required"> Importe </label>
                                                <input id="importe_manoobra" class="form-field width40" name="importe_manoobra" type="text" value="" maxlength="20"/>
                                                <label class="form-label required"> Descripcion </label>
                                                <textarea id="descripcion_manoobra" class="form-field width100" style="height:60px" name="descripcion_manoobra" type="text" value=""></textarea>
                                               	<hr/>
                                               	<p>
                                               		<input id="dialg_manoobra_acept" class="button themed" type="button" value="Aceptar" name="dialg_manoobra_acept" />
                                               		<input id="dialg_manoobra_close" class="button themed" type="button" value="Cancelar" name="dialg_manoobra_acept" />
                                               	</p>
                                           	</form>
                                    	</div>

										<!--EDITAR-->

										<div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">
											<div id="tabla_result">
												 <table id="table_detalle_remito_popup" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th>ID</th>
															<th>Producto</th>
															<th>Precio</th>
															<th>Cantidad</th>
															<th>Subtotal</th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
											<hr/>
											<p class="fr">
											<input id="btn_Detalle_cerrar" class="button themed" type="button" value="Cerrar" name="btn_Detalle_Cerrar" />
											</p>
										</div>

                                        <div id="tabs-1">
											<form id="frm_remito">
												<table border="0" width="800" >
													<thead>
														<tr>
														<th style="width: 300px"></th>
														<th style="width: 300px"></th>
														<th style="width: 300px"></th>
														<th style="width: 100px"></th>
														<th style="width: 100px"></th>
														<th style="width: 100px"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<label class="form-label required"> Número de remito :</label>
																<input id="txt_num_remi" readonly="true"  class="form-field width40" name="save_num_remi" type="text" value="" maxlength="15"/>
															</td>
															<td>
																<label class="form-label required"> Fecha de Pago</label>
																<input id="save_fecemi_remi" class="form-field datepicker" name="save_fecemi_remi" type="text"  />
															</td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>

														<tr>
															<td>
																<label class="form-label required">Vehiculo - Cliente</label>
																<input id="cmbgridCliente" name="cmbgridCliente" />
															</td>
															<td>
																<br>
																<label class="form-label required"> Cliente :</label>
																<input id="txt_cliente" readonly="true" class="form-field width80" name="txt_cliente" type="text" value="" maxlength="100"/>
															</td>
															<td>
																<br>
																<label class="form-label required"> Vehículo :</label>
																<input id="txt_vehiculo" class="form-field width90" name="txt_vehiculo" readonly="true" type="text" value="" maxlength="130"/>
															</td>
															<td>
																<br>
																<br>
																<div id="div_deleteVehiculo">
																	<a id="btn_deleteVehiculo" href="#"><span class="icon_text cancel"></spam></a>
																</div>
															</td>
														</div>
													</tr>
													</tbody>
												</table>
<!--
											   <label clas="form-label required">Búsqueda de Cliente</label><br/>
											   <input id="cmbgridCliente" name="cmbgridCliente"   />
-->
												<input type="hidden" id="save_id_vendedor" name="save_id_vendedor" value="<?php  echo $persona->get_id_persona();?>" />
												<input type="hidden" id="total_remi" name="save_total_remi" value="" />
												<input type="hidden" id="save_id_vehiculo" name="save_id_vehiculo" value=""/>
												<input type="hidden" id="save_id_cliente" name="save_id_cliente" value=""/>
												<input type="hidden" id="txt_importe_manoobra" name="txt_importe_manoobra" value=""/>
												<input type="hidden" id="txt_descripcion_manoobra" name="txt_descripcion_manoobra" value=""/>
												<input type="hidden" id="txt_porcentaje" name="txt_porcentaje" value=""/>
												<input type="hidden" id="tipo_guardar" name="tipo_guardar" value="nuevo"/>
                                                <input type="hidden" id="estado_remi" name="estado_remi" value=""/>
												<table border="0" width="800" >
													<thead>
														<tr>
															<th style="width: 300px"></th>
															<th style="width: 200px"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td >
																<label class="form-label required"> Por concepto de :</label>
																<input id="save_obs_remi" class="form-field width100" name="save_obs_remi" type="text" value="" maxlength="190"/>
															</td>
															<td>

															</td>
													</tbody>
												</table>
												<div id="div_aux" style="display: none" >
													<input id="btn_aux" name="btn_aux" type="submit" value="Auxiliar" />
												</div>
                                            </form>
                                            <hr/>
                                            <form id="frm_AddProducto" >
                                                <input type="hidden" id="txt_idproducto" name="txt_idproducto" value="" />
                                                <input type="hidden" id="txt_nom_producto" name="txt_nom_producto" value="" />
                                                <input type="hidden" id="txt_tipoiva" name="txt_tipoiva" value=""/>
                                                <input type="hidden" id="txt_cod_producto" name="txt_cod_producto" value=""/>

                                                <table border="0" width="700">
													<thead>
														<tr>
															<th style="width: 200px"></th>
															<th style="width: 150px"></th>
															<th style="width: 150px"></th>
															<th style="width: 150px"></th>
														</tr>
                                                    </thead>
													<tbody>
														 <tr>
															<td>
																<label class="form-label required">Seleccione el Producto :</label>
																<input id="cmbgridProducto" name="cmbgridProducto"   />
															</td>
															<td>
																<br>
																<label class="form-label required">Precio:</label>
																<input id="txt_precio" class="form-field width60" name="txt_precio" type="text"  value="" maxlength="10"/>
															</td>
															<td>
																<br>
																<label class="form-label required">Cantidad:</label>
																<input id="txt_cantidad" class="form-field width60" name="txt_cantidad" type="text" value="" maxlength="6"/>
															</td>
															<td>
																<br>
																<label class="form-label required">Total:</label>
																<input id="txt_sub" class="form-field width60" name="txt_sub" readonly="true" type="text" value="" maxlength="20"/>
															</td>
														</tr>
														<tr>
															<td>
															</td>
															<td>
															</td>
														</tr>
													</tbody>
												</table>
                                                <div id="div_aux" style="display: none" >
                                                    <input id="btn_aux2" name="btn_aux2" type="submit" value="Auxiliar" />
                                                </div>
                                            </form>
											<table border="0" style="width: 600px">
												<tbody>
													<tr>
														<td style="width: 300px">
															<input id="btn_AddProducto" class="button themed" type="button" value="Agregar" name="btn_AddProducto" />
															<input id="btn_QuitarProducto" class="button themed" type="button"  value="Quitar" name="btn_QuitarProducto" />
														</td>
		                                                <td style="width: 300px">
                                                            <input id="btn_manoobra" class="button themed" type="button" value="Mano de obra" name="btn_manoobra" />
                                                        </td>
													</tr>
												</tbody>
                                            </table>

                                            <hr/>


											<table id="tt" class="easyui-datagrid" style="width:700px;height:350px" fitColumns="true"	title="Detalle de Remito"  singleSelect="true" showFooter="true" rownumbers="true" >
                                                <thead>
													<tr>
														<th field="id" width="80">ID</th>
														<th field="codigo" width="80">Código</th>
														<th field="producto" width="300">Producto</th>
														<th field="precio" width="60">Precio</th>
														<th field="cantidad" width="60">Cantidad</th>
														<th field="total" width="60">subtotal</th>
													</tr>
												</thead>
											</table>
											<hr/>
											<input id="btn_Remito_Add" class="fr button themed" type="button" value="Guardar Remito" name="btn_Remito_Add" />
											<input id="btn_Remito_New" class="fl button themed" type="button" value="Nuevo" name="btn_Remito_New" />
											<input id="btn_Remito_Print" class="fl button themed" type="button" value="Imprimir Remito" name="btn_Remito_Print" />
											<input id="btn_Remito_Print1" class="fl button themed" type="button" value="Imprimir Remito con precios" name="btn_Remito_Print1" />
											<input id="btn_Remito_Generar" class="fr button themed" type="button" value="Generar Presup" name="btn_Remito_Generar" />
											<input id="btn_Remito_Anular" class="fr button themed" type="button" value="Anular Remito" name="btn_Remito_Anular" />
                                            <input id="btn_Remito_Open" class="fr button themed" type="button" value="Re-abrir Remito" name="btn_Remito_Open"/>
										</div>


                                        <div id="tabs-2">
											<div id="tabla_result">
												 <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th>ID</th>
															<th>Fecha</th>
															<th>Vehiculo</th>
															<th>Cliente</th>
															<th>TOTAL</th>
															<th>Estado</th>
															<th></th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>

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
}
?>
