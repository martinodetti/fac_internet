<?php
session_start();

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Descuento_venta.php';
include 'MODEL/Producto.php';
include_once 'afip/awsfe.php';


if(!isset($_SESSION['id_persona'])){
    header('Location: index.php');
	exit();
}

if(isset ($_SESSION['id_persona'])){
	$id_persona		= $_SESSION['id_persona'];   
	$persona		= new persona();
	$persona		= $persona->showPersona($id_persona);	
	$clsDescto		= new descuento_venta();
	$arr_descto		= $clsDescto->ComboDescuento_ventas();
	$clsProducto	= new producto();
	$ListaProductos	= $clsProducto->listProductosPorNombre("");
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
        <title>SISTEMA FRENOS OESTE</title>

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
		<script type="text/javascript" src="JS/jquery.dataTables.js" ></script>
        <script type="text/javascript" src="JS/jquery.easyui.min.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
        <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
<!--         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>-->
        <script type="text/javascript" src="MYJS/Factura.js" ></script>


    </head>
    <body>
		<div id="tblLoading" class="loading">
        	<img src="img/ajax-loader.gif" style="top:50%">
        </div>
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
                            <li><a class="breadcrumb underline" href="#">Home -> Factura</a></li>
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
                                		
                                <h2 class="box-header">FACTURA </h2>
                               		<ul class="tabs-nav">
                                		<li class="tab"><a href="#tabs-1">NUEVO</a></li> 
										<li class="tab"><a href="#tabs-2">COBRANZA</a></li> 
										<li class="tab"><a href="#tabs-3">NOTAS DE CREDITO</a></li> 
										<li class="tab"><a href="#tabs-4">NOTAS DE DEBITO</a></li> 
                               		</ul>
                                    
                                    <div class="box-content"> 
                                        
                                    	<div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                    		<span id="msg" class="message success"></span>
											<p class="fr"></p>
							                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                    	</div>
                                    	
                                    	<div id="dialg_error" class="dialog" title="SYSFACTURA INFORMA">     
                                            <span id="msg_err" class="message error">
                                            El número de factura ingresado ya se encuentra cargado para este tipo de factura
                                            </span>
                                            <p class="fr"></p>
			                				<a id="dialg_error_close" class="button themed closer">Aceptar</a>
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
                                    	
                                    	<!-- mano de obra 2-->
                                    	<div id="dialg_manoobra2" class="dialog" title="SYSFACTURA INFORMA">     
                                    		<form id="frm_addManoobra2">
												<input type="hidden" id="id_manoobra2" name="id_manoobra2" value="" />
                                                <label class="form-label required"> Importe </label>
                                                <input id="importe_manoobra2" class="form-field width40" name="importe_manoobra2" type="text" value="" maxlength="20"/>
                                                <label class="form-label required"> Descripcion </label>
                                                <textarea id="descripcion_manoobra2" class="form-field width100" style="height:60px" name="descripcion_manoobra2" type="text" value=""></textarea>
                                               	<hr/>
                                               	<p>
                                               		<input id="dialg_manoobra_acept2" class="button themed" type="button" value="Aceptar" name="dialg_manoobra_acept2" />
                                               		<input id="dialg_manoobra_close2" class="button themed" type="button" value="Cancelar" name="dialg_manoobra_acept2" />
                                               	</p>
                                           	</form>
                                    	</div>      
                                    	
                                    	<!-- torneria -->
                                    	<div id="dialg_torneria" class="dialog" title="SYSFACTURA INFORMA">     
                                    		<form id="frm_addTorneria">
												<input type="hidden" id="id_torneria" name="id_torneria" value="" />
                                                <label class="form-label required"> Importe </label>
                                                <input id="importe_torneria" class="form-field width40" name="importe_torneria" type="text" value="" maxlength="20"/>
                                                <label class="form-label required"> Descripcion </label>
                                                <textarea id="descripcion_torneria" class="form-field width100" style="height:60px" name="descripcion_torneria" type="text" value=""></textarea>
                                               	<hr/>
                                               	<p>
                                               		<input id="dialg_torneria_acept" class="button themed" type="button" value="Aceptar" name="dialg_torneria_acept" />
                                               		<input id="dialg_torneria_close" class="button themed" type="button" value="Cancelar" name="dialg_torneria_acept" />
                                               	</p>
                                           	</form>
                                    	</div>                              	

                                        <div id="dialg_form_factura" class="dialog" title="SYSFACTURA INFORMA">

                                            <div id="div_facturas_pendientes" name="div_remitos_pendientes">
                                                <table id="facturas_table" class="easyui-datagrid" style="width:450px;height:auto" fitColumns="TRUE" title="Facturas pendientes"  singleSelect="true" showFooter="true" rownumbers="true" >
                                                    <thead>
                                                        <tr>
                                                            <th field="id" width="30">ID</th>
                                                            <th field="tipo_num" width="80">Tipo y Num</th>
                                                            <th field="fecha" width="100">Fecha</th>
                                                            <th field="or_rem" width="100">OR y Remitos</th>
                                                            <th field="total" width="80">Monto</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                            </br>
                                            <p class="fr">
                                            <input id="btn_Detalle_Usar" class="button themed" type="button" value="Usar" name="btn_Detalle_Usar" />
                                            <input id="btn_Detalle_cerrar_fact" class="button themed" type="button" value="Cerrar" name="btn_Detalle_Cerrar_fact" />
                                            </p>

                                        </div>


                                    	
										<div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA"> 
											<div id="div_remitos_pendientes" name="div_remitos_pendientes">
												<table id="remitos_table" class="easyui-datagrid" style="width:450px;height:auto" fitColumns="TRUE" title="Remitos pendientes"  singleSelect="true" showFooter="true" rownumbers="true" >
                                                    <thead>
                                                        <tr>
                                                            <th field="tipo" width="50">Tipo</th>
                                                            <th field="id" width="50">ID</th>
                                                            <th field="fecha" width="100">Fecha</th>
                                                            <th field="dominio" width="100">Dominio</th>
                                                            <th field="total" width="80">Subtotal</th>
                                                        </tr>
                                                    </thead>
													<tbody>
													
													</tbody>
                                                </table>
											</div>
											</br>
											<p class="fr">
											<input id="btn_Detalle_Ver" class="button themed" type="button" value="Detalle" name="btn_Detalle_Ver" />
											<input id="btn_Detalle_Cobrar" class="button themed" type="button" value="Cobrar" name="btn_Detalle_Cobrar" />
											<input id="btn_Detalle_cerrar" class="button themed" type="button" value="Cerrar" name="btn_Detalle_Cerrar" />
											</p>
										
										</div>
										
										<div id="dialg_cobrar" class="dialog" title="SYSFACTURA INFORMA">   
											<input type="hidden" name="save_cobro_id_fact" id="save_cobro_id_fact" value=""/>
											<label class="form-label required"> Forma de pago :</label>
											<select id="cmb_cobro_forma_de_pago" name="cmb_cobro_forma_de_pago" class="form-field width80">
												<option value="1">Contado efectivo</option>
												<option value="2">Contado documento</option>
											</select> 
											<hr/>
											<p class="fr">
											<input id="btn_cobro_cobrar" class="button themed" type="button" value="Cobrar" name="btn_cobro_cobrar" />
											<input id="btn_cobro_cerrar" class="button themed" type="button" value="Cerrar" name="btn_cobro_cerrar" />
											</p>
                                               
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
                                   
										<div id="dialg_form_2" class="dialog" title="SYSFACTURA INFORMA">   
											<div id="tabla_result">
												 <table id="table_detalle_remito_popup" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th>Cod</th>
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
											<input id="btn_Detalle_cerrar_2" class="button themed" type="button" value="Cerrar" name="btn_Detalle_cerrar_2" />
											</p>
                                               
										</div>
                                        <div id="tabs-1">
											<form id="frm_factura">	
												<table border="0" width="800" >
													<thead>
														<tr>
															<th style="width: 300px"></th>
															<th style="width: 200px"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td colspam=2>
																<label class="form-label required"> Tipo de documento :</label>
																<select id="cmb_tipo_fact" name="cmb_tipo_fact" class="form-field width30">
																	<option value="1" selected="selected">Factura</option>
																	<option value="2">Nota de crédito</option>
																	<option value="3">Nota de débito</option>
																</select> 
															</td>
														</tr>
														<tr>
													
															<td>
																<br>
																<label class="form-label required"> Tipo de factura :</label>
																<input id="save_tipo_fact" readonly="true" class="form-field width20" name="save_tipo_fact" type="text" value="A" maxlength="15"/>
															</td>
															<td>
																<br>
																<label class="form-label required"> Número de factura :</label>  
																<input id="txt_num_fact" class="form-field width40" name="save_num_fact" type="text" value="" maxlength="15"/>
															</td>
														</tr>
														<tr>
															<td>
																<label class="form-label required"> Forma de pago :</label>
																<select id="cmb_forma_pago" name="save_forma_pago" class="form-field width30">
																	<option value="1">Contado efectivo</option>
																	<option value="2">Contado documento</option>
																	<option value="3" selected="selected">Cuenta corriente</option>
																</select> 
															</td>
														</tr>
														<tr>
															<td>
																</br>
																<label class="form-label required">Búsqueda de Cliente</label>
																<input id="cmbgridCliente" name="cmbgridCliente"   />
																&nbsp;
																<a href="#" id="link_pendientes">Pendientes de cobro</a>
															</td>
															<td>
																
															</td>
														</tr>
													</tbody>
												</table>
<!--                                        
			                                          	<label clas="form-label required">Búsqueda de Cliente</label><br/>
			                                         		<input id="cmbgridCliente" name="cmbgridCliente"   />
-->                                            
                                                <input type="hidden" id="save_id_cliente" name="save_id_cliente" value="" />
                                                <input type="hidden" id="txt_id_fact" name="txt_id_fact" value=""/>
                                                <input type="hidden" id="txt_id_fact_nc" name="txt_id_fact_nc" value=""/>
                                                <input type="hidden" id="save_id_empresa" name="save_id_empresa" value="1" />
                                                <input type="hidden" id="save_id_vendedor" name="save_id_vendedor" value="<?php  echo $persona->get_id_persona();?>" />
												<input type="hidden" id="txt_dominio_print" name="txt_dominio_print" value=""/>
                                                <input type="hidden" id="save_descto_fact" name="save_descto_fact" value="" />
                                                <input type="hidden" id="iva21_fact" name="save_iva21_fact" value="" />
                                                <input type="hidden" id="iva105_fact" name="save_iva105_fact" value="" />
                                                <input type="hidden" id="total_fact" name="save_total_fact" value="" />
                                                <input type="hidden" id="txt_temporal" name="txt_temporal" value="" />
												<input type="hidden" id="txt_idremitos" name="txt_idremitos" value=""/>
												<input type="hidden" id="txt_idordenes" name="txt_idordenes" value=""/>
												<input type="hidden" id="txt_importe_manoobra" name="txt_importe_manoobra" value=""/>
												<input type="hidden" id="txt_descripcion_manoobra" name="txt_descripcion_manoobra" value=""/>
												<input type="hidden" id="txt_importe_manoobra2" name="txt_importe_manoobra2" value=""/>
												<input type="hidden" id="txt_descripcion_manoobra2" name="txt_descripcion_manoobra2" value=""/>
												<input type="hidden" id="txt_importe_torneria" name="txt_importe_torneria" value=""/>
												<input type="hidden" id="txt_descripcion_torneria" name="txt_descripcion_torneria" value=""/>
												<input type="hidden" id="txt_porcentaje" name="txt_porcentaje" value=""/>
												<input type="hidden" id="txt_id_condiva" name="txt_id_condiva" value=""/>
												<input type="hidden" id="txt_cae" name="txt_cae" value=""/>
												<input type="hidden" id="txt_cae_vto" name="txt_cae_vto" value=""/>
												<input type="hidden" id="txt_punto_de_venta" name="txt_punto_de_venta" value=""/>
                                                <table border="0" width="800" >
													<thead>
														<tr>
															<th style="width: 300px"></th>
															<th style="width: 200px"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																</br>
																<label class="form-label required"> Nombre y Apellido :</label>   
																<input id="txt_apellidos_fact" readonly="true" class="form-field width80" name="txt_apellidos_fact" type="text" value="" maxlength="100"/>
															</td>
															<td>
																</br>
																<label class="form-label required"> CUIT :</label>  
																<input id="txt_ruc_fact" class="form-field width60" name="txt_ruc_fact" readonly="true" type="text" value="" maxlength="130"/>
															</td>
														</tr>
														<tr>
															<td>
																<label class="form-label required"> Por concepto de :</label>  
																<input id="save_obs_fact" class="form-field width80" name="save_obs_fact" type="text" value="" maxlength="190"/>
															</td>
															<td>
																<label class="form-label required"> Fecha de Pago</label>  
																<input id="save_fecemi_fact" class="form-field datepicker" name="save_fecemi_fact" type="text"  />
															</td>
														</tr>
														<tr>
															<td>
																<label class="form-label">Percepción</label>
																<input id="save_percepcion" class="form-field width20" name="save_percepcion" type="text" value="" maxlength="10"/>   
															</td>
															<td>
																<label class="form-label">OORR y/o Remitos</label>
																<input id="save_orden_y_remito" class="form-field width60" name="save_orden_y_remito" type="text" value="" readonly="readonly"/>   
															</td>
														</tr>
													</tbody>
												</table>
												<div id="div_aux" style="display:none" >
													<input id="btn_aux" name="btn_aux" type="submit" value="Auxiliar" />
                                                </div>
                                            </form>
                                            <hr/>
											
											<!-- DIV REMITOS PENDIENTES -->
											
                                            <form id="frm_AddProducto" >
                                                 <input type="hidden" id="txt_idproducto" name="txt_idproducto" value="" />
                                                 <input type="hidden" id="txt_nom_producto" name="txt_nom_producto" value="" />
                                                 <input type="hidden" id="txt_cod_producto" name="txt_cod_producto" value="" />
                                                 <input type="hidden" id="txt_tipoiva" name="txt_tipoiva" value=""/>
                                                 <input type="hidden" id="txt_precio_limpio" name="txt_precio_limpio" value="" />
                                   
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
																 <label class="form-label required">Precio s/iva:</label>  
																 <input id="txt_precio" class="form-field width60" name="txt_precio" type="text"  value="" maxlength="10"/>
															 </td>
															 <td>
																 <label class="form-label required">Cantidad:</label>  
																 <input id="txt_cantidad" class="form-field width60" name="txt_cantidad" type="text" value="" maxlength="6"/>
															 </td>
															 <td>
																<label class="form-label required">Subtotal s/iva:</label>  
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
                                                             <td>&nbsp;</td>
                                                             <td style="width: 150px">
                                                               <input id="btn_manoobra" class="button themed" type="button" value="Mano de obra" name="btn_manoobra" />
                                                             </td>
                                                             <td style="width: 150px">
                                                               <input id="btn_manoobra2" class="button themed" type="button" value="Mano de obra 2" name="btn_manoobra2" />
                                                             </td>
                                                             <td style="width: 150px">
		                                                        <input id="btn_torneria" class="button themed" type="button" value="Torneria" name="btn_torneria" />
	                                                    </td>

                                                         </tr>
                                                     </tbody>
                                                 </table>

												<hr/>
												<table border="0"  >   
													<tbody>
														<tr>
															<td>
																<label class="form-label required">Descuento:</label>  
															</td>
															<td style="width: 100px"></td>
															<td >
																<label class="form-label required"></label>  
															</td>
														</tr>
														<tr>
															<td>
<!--
																<select id="cmbDescto" name="cmbDescto" class="form-field width100">

																<?php foreach($arr_descto as $clsDescto){ ?>
																<option value="<?php echo $clsDescto->get_id_descto() ?>"><?php echo $clsDescto->get_porctj_descto()?></option>
																<?php }?>
																</select>
-->
																<input type="text" id="cmbDescto" name="cmbDescto" class="form-field width60" value="0" />
															</td>
															<td style="width: 100px"></td>
															<td >
																<div style="display:none">
																	<input type="checkbox"  name="checkiva" id="checkiva">
																</div>
															</td>
														</tr>
													</tbody>
												</table>
												<table id="tt" class="easyui-datagrid" style="width:700px;height:350px" fitColumns="true" title="Detalle de Factura"  singleSelect="true" showFooter="true" rownumbers="true" >
                                                    <thead>
                                                        <tr>
                                                            <th field="id" width="40">ID</th>
                                                            <th field="codigo" width="60">Cod</th>
                                                            <th field="producto" width="280">Producto</th>
                                                            <th field="precio" width="60">Precio</th>
                                                            <th field="cantidad" width="60">Cantidad</th>
                                                            <th field="total" width="60">subtotal</th>
                                                        </tr>
                                                    </thead>
                                                </table>
											
											<input id="btn_Factura_Add" class="fr button themed" type="button" value="Guardar Factura" name="btn_Factura_Add" />
                                            <input id="btn_Factura_New" class="fl button themed" type="button" value="Nuevo" name="btn_Factura_New" />

                                            <input id="btn_Factura_Print" class="fl button themed" type="button" value="Imprimir Factura" name="btn_Factura_Print" />
                                            <input id="btn_Factura_Cancel" class="fr button themed" type="button" value="Anular Factura" name="btn_Factura_Cancel" />
                                        </div>
                                        
										<div id="tabs-2">
											<div id="tabla_result">
												 <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th width=25px>Num</th>
															<th width=80px>Fecha</th>
															<th width=80px>OR y Remito</th>
															<th>Cliente</th>
															<th width=120px>Forma de pago</th>
															<th width="60px">Estado</th>
															<th width=50px>TOTAL</th>
															
															<th width=150px></th>
														</tr>
													</thead>
													<tbody>
										
													</tbody>
												</table>
											</div>
										</div>
										
										<div id="tabs-3">
											<div id="tabla_result_nc">
												 <table id="table-example-nc" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th width=25px>Num</th>
															<th width=80px>Fecha</th>
															<th>Cliente</th>
															<th width=50px>TOTAL</th>
															<th width=150px></th>
														</tr>
													</thead>
													<tbody>
										
													</tbody>
												</table>
											</div>
										</div>
                                        <div class="clear"></div>
                                        
                                        <div id="tabs-4">
											<div id="tabla_result_nd">
												 <table id="table-example-nd" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th width=25px>Num</th>
															<th width=80px>Fecha</th>
															<th>Cliente</th>
															<th width=50px>TOTAL</th>
															<th width=150px></th>
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
