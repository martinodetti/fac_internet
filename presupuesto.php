<?php
session_start();

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Presupuesto.php';
include 'MODEL/Producto.php';
include 'MODEL/Persona.php';

//para dar de alta nuevos clientes
include 'MODEL/Provincia.php';
include 'MODEL/Listaprecio.php';
include 'MODEL/Tipovehiculo.php';

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
	$presupuesto 	= new presupuesto();

	$provincia = new provincia();
	$arr_prov = $provincia->listprovincias();

	$Listaprecio = new listaprecio();
	$arr_listaprecio = $Listaprecio->Combolistaprecio();

	$tipovehiculo = new tipovehiculo();
	$arr_tipovehiculo = $tipovehiculo->listTipovehiculo();
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
        <script type="text/javascript" src="MYJS/Presupuesto.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> presupuesto de reparación</a></li>
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

                                <h2 class="box-header">PRESUPUESTO </h2>
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

										<div id="error_msg" class="error" title="SYSFACTURA INFORMA">
                                    		<span id="msg_err" class="message success"></span>
											<p class="fr"></p>
							                <a id="error_msg_close" class="button themed closer">Aceptar</a>
                                    	</div>

                                    	<div id="dialg_error" class="dialog" title="SYSFACTURA INFORMA">
                                            <span id="msg" class="message error">
                                            El dominio ingresado ya se encuentra registrado en el sistema
                                            </span>
                                            <p class="fr"></p>
			                				<a id="dialg_error_close" class="button themed closer">Aceptar</a>
                                        </div>

                                    	<!-- mano de obra -->
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
                                                <input id="importe_torneria" class="form-field width40" name="importe_torneria" type="text" maxlength="20"/>
                                                <label class="form-label required"> Descripcion </label>
                                                <textarea id="descripcion_torneria" class="form-field width100" style="height:60px" name="descripcion_torneria" type="text"></textarea>
                                               	<hr/>
                                               	<p>
                                               		<input id="dialg_torneria_acept" class="button themed" type="button" value="Aceptar" name="dialg_torneria_acept" />
                                               		<input id="dialg_torneria_close" class="button themed" type="button" value="Cancelar" name="dialg_torneria_acept" />
                                               	</p>
                                           	</form>
                                    	</div>

                                    	<!-- voz de cliente -->
<!--
                                    	<div id="dialg_vozcliente" class="dialog" title="SYSFACTURA INFORMA">
											<div id="div_vozcliente" name="div_vozcliente">
												<table id="vozcliente_table" class="easyui-datagrid" style="width:650px;height:auto" fitColumns="TRUE" title="Voz de cliente libres"  singleSelect="true" showFooter="true" rownumbers="true" >
                                                    <thead>
                                                        <tr>
	                                                        <th field="id" width="15">id</th>
                                                            <th field="fecha" width="150">Fecha</th>
                                                            <th field="patente" width="60">Patente</th>
                                                            <th field="detalle" width="190">Detalle</th>
                                                            <th field="contacto" width="200">Contacto</th>
                                                        </tr>
                                                    </thead>
													<tbody>

													</tbody>
                                                </table>
											</div>
											</br>
											<p class="fr">
											<input id="btn_vozcliente_usar" class="button themed" type="button" value="Usar" name="btn_vozcliente_usar" />
											<input id="dialg_vozcliente_close" class="button themed" type="button" value="Cerrar" name="dialg_vozcliente_close" />
											</p>

										</div>
-->
                                    	<div id="dialg_vervozcliente" class="dialog" title="SYSFACTURA INFORMA">
<!--
		                                    	<label class="form-label required"> Patente </label>
						                        <input id="patente_vozcliente" class="form-field width20" readonly="readonly" name="patente_vozcliente" type="text" value="" maxlength="100"/>
-->
                                                <label class="form-label required"> Descripcion </label>
                                                <textarea id="detalle_vozcliente" class="form-field width100" style="height:125px" name="detalle_vozcliente" type="text" value=""></textarea>
                                               	<hr/>
                                               	<label class="form-label required"> Contacto </label>
                                                <textarea id="contacto_vozcliente" class="form-field width100" style="height:50px" name="contacto_vozcliente" type="text" value=""></textarea>
                                               	<hr/>
                                               	<p>
                                               		<input id="dialg_vozcliente_acept" class="button themed" type="button" value="Guardar" name="dialg_vozcliente_acept" />
                                               		<input id="dialg_vozcliente_close" class="button themed" type="button" value="Cerrar" name="dialg_vozcliente_close" />
                                               	</p>
                                    	</div>

                                    	<div id="dialg_open" class="dialog" title="SYSFACTURA INFORMA">
                                    		<form id="frm_addpresupuestoopen">
												<label class="form-label required"> Clave </label>
                                                <input id="clave_usuario" class="form-field width40" name="clave_usuario" type="password" value="" maxlength="50"/>
                                               		<input id="dialg_open_acept" class="button themed" type="button" value="Aceptar" name="dialg_open_acept" />
                                               		<input id="dialg_open_close" class="button themed" type="button" value="Cancelar" name="dialg_open_close" />
                                               	</p>
                                           	</form>
                                    	</div>


                                    	<!-- nuevo cliente y vehiculo -->
                                    	<div id="dialg_nuevoCliente" class="dialog" title="NUEVO CLIENTE">
                                			<form id="frmPersona_Add" method="post" action="">
												<input type="hidden" id="save_id_tipoper" name="save_id_tipoper" value="2" />
												<input type="hidden" id="txt_id_cliente_temp" name="txt_id_cliente_temp" value=""/>
												<table border="0"  width="600" cellspacing="80">
													<thead>
														<tr>
															<th style="width: 50%"></th>
															<th style="width: 50%"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td >
																<label class="form-label required"> Razón Social </label>
																 <input id="save_nom_persona" class="form-field width90" name="save_nom_persona" type="text" value="" maxlength="100"/>
															</td>
															<td >
																<label class="form-label required"> Nombre fantasía </label>
																 <input id="save_ape_persona" class="form-field width90" name="save_ape_persona" type="text" value="" maxlength="100"/>
															</td>
														</tr>

														<tr>
															<td>
																<label class="form-label required"> CUIT / DNI</label>
																 <input id="save_ruc_persona" class="form-field width80" name="save_ruc_persona" type="text" value="" maxlength="11"/>
															</td>
															<td>
                                                                <label class="form-label required"> Provincia </label>
                                                                  <select id="save_id_provincia" name="save_id_provincia" class="form-field width40">
                                                                  	<option value="0"></option>
                                                                    <?php foreach($arr_prov as $prov){?>
                                                                      <option value="<?php echo $prov->get_id_provincia()?>"><?php echo $prov->get_nom_provincia()?></option>
                                                                      <?php } ?>
                                                                </select>
                                                            </td>

														</tr>
														<tr>
															<td>
																<label class="form-label required"> Teléfono </label>
																<input id="save_telf_persona" class="form-field width80" name="save_telf_persona" type="text" value=""/>
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
                                                                    <label class="form-label required"> Teléfono 2</label>
                                                                    <input id="save_telf_persona_2" class="form-field width80" name="save_telf_persona_2" type="text" value="" maxlength="15"/>
                                                                </td>
															<td>
                                                               <label class="form-label required"> Condición IVA </label>
                                                                  <select id="save_id_condiva" name="save_id_condiva" class="form-field width40">
                                                                  	<option value="1">Responsable Inscripto</option>
                                                                  	<option value="2">Monotrobutista</option>
                                                                  	<option value="3">Consumidor final</option>
                                                                </select>
                                                            </td>
														</tr>
														<tr>
															<td>
																<label class="form-label required"> Celular</label>
																 <input id="save_cel_persona" class="form-field width80" name="save_cel_persona" type="text" value="" />
															</td>
															<td>
                                                               <label class="form-label required"> Tiene cuenta corriente </label>
                                                                  <select id="save_tiene_ctacte" name="save_tiene_ctacte" class="form-field width40">
                                                                  	<option value="1">Si</option>
                                                                  	<option value="2">No</option>
                                                                  	<option value="3">Suspendida</option>
                                                                </select>
                                                            </td>
														</tr>
														<tr>
															<td>
																<label class="form-label required"> E-mail </label>
																<input id="save_email_persona" class="form-field width80" name="save_email_persona" type="text" value="" maxlength="50"/>
															</td>
															<td>
                                                                <label class="form-label required"> Lista de precios </label>
                                                                <select id="save_id_listaprecio" name="save_id_listaprecio" class="form-field width40">
                                                                    <?php foreach($arr_listaprecio as $Listaprecio){?>
                                                                      <option value="<?php echo $Listaprecio->get_id_listaprecio()?>"><?php echo $Listaprecio->get_nombre_listaprecio()?></option>
                                                                      <?php } ?>
                                                                </select>
                                                            </td>
														</tr>

														<tr>
															<td>
																 <label class="form-label required"> Dirección </label>
																  <input id="save_direc_persona" class="form-field width90" name="save_direc_persona" type="text" value="" maxlength="100"/>
															</td>
															<td>
																 <label class="form-label required">Observaciones</label>
																  <input id="save_obs_persona" class="form-field width90" name="save_obs_persona" type="text" value="" maxlength="255"/>
															</td>
														</tr>

													</tbody>
												</table>
												</p>
												<table border="0"  width="600">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 25%"></th>
                                                                <th style="width: 25%"></th>
                                                                <th style="width: 25%"></th>
                                                                <th style="width: 25%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
	                                                          <tr>
	                                                          	  <td>
	                                                                  <label class="form-label required"> Dominio </label>
	                                                                  <input id="save_dominio_vehiculo" class="form-field width60" name="save_dominio_vehiculo" type="text" value="" maxlength="6"/>
	                                                              </td>
	                                                              <td>
	                                                                  <label class="form-label required"> Marca </label>
	                                                                   <input id="save_marca_vehiculo" class="form-field width60" name="save_marca_vehiculo" type="text" value="" maxlength="20"/>
	                                                              </td>
	                                                              <td>
                                                                  	<label class="form-label required"> Tipo </label>

                                                                    <select id="save_id_tipovehiculo" name="save_id_tipovehiculo" class="form-field width60">
                                                                    	<?php foreach($arr_tipovehiculo as $tipovehiculo){?>
                                                                        <option value="<?php echo $tipovehiculo['id']?>"><?php echo $tipovehiculo['tipovehiculo']?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                  </td>
                                                        	      <td>
	                                                                  <label class="form-label required"> Modelo </label>
	                                                                 <input id="save_modelo_vehiculo" class="form-field width60" name="save_modelo_vehiculo" type="text" value="" maxlength="40"/>
	                                                              </td>
	                                                          </tr>
                                                        	  <tr>
	                                                              <td>
	                                                                  <label class="form-label required"> Año </label>
	                                                                  <input id="save_anio_vehiculo" class="form-field width40" name="save_anio_vehiculo" type="text" value="" maxlength="4"/>
	                                                              </td>
	                                                          	  <td colspan="3">
	                                                                  <label class="form-label required"> Observación </label>
	                                                                  <input id="save_observacion_vehiculo" class="form-field width80" name="save_observacion_vehiculo" type="text" value="" maxlength="200"/>
	                                                              </td>
	                                                          </tr>
                                                        </tbody>
                                                    </table>
												<hr/>
												<p>
												<input id="btn_Persona_Add" class="button themed" type="submit" value="Guardar" name="btn_Persona_Add" />
												</p>
											</form>

                                    	</div>
										<div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">
											<div id="tabla_result">
												 <table id="table_detalle_presupuesto_popup" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th>ID</th>
															<th>Codigo</th>
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
										<!--FIN VER-->

                                  		<!--TABS-->
                                        <div id="tabs-1">
											<form id="frm_presupuesto">
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
																<label class="form-label required"> Número de presupuesto</label>
																<input id="txt_num_presupuesto" readonly="true"  class="form-field width40" name="save_num_presupuesto" type="text" value="" maxlength="15"/>
															</td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td>
																<label class="form-label required"> Fecha de emisión</label>
																<input id="save_fecemi_presupuesto" class="form-field datepicker" name="save_fecemi_presupuesto" type="text"  />
															</td>
<!--
															<td>
																<label class="form-label required"> Fecha de ingreso</label>
																<input id="save_fecingreso_presupuesto" class="form-field datepicker" name="save_fecingreso_presupuesto" type="text"/>
															</td>
															<td>
																<label class="form-label required"> Fecha de egreso</label>
																<input id="save_fecegreso_presupuesto" class="form-field datepicker" name="save_fecegreso_presupuesto" type="text"  />
															</td>
-->
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
															<td>
																<br>
																<label class="form-label required"> Kilometraje :</label>
																<input id="save_kms_presupuesto" class="form-field width90" name="save_kms_presupuesto" type="text" value="" maxlength="130"/>
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
												<input type="hidden" id="save_total_presupuesto" name="save_total_presupuesto" value="" />
												<input type="hidden" id="save_id_vehiculo" name="save_id_vehiculo" value=""/>
												<input type="hidden" id="save_id_cliente" name="save_id_cliente" value=""/>
												<input type="hidden" id="save_patente" name="save_patente" value=""/>
												<input type="hidden" id="save_id_vozcliente" name="save_id_vozcliente" value=""/>
												<input type="hidden" id="txt_importe_manoobra" name="txt_importe_manoobra" value=""/>
												<input type="hidden" id="txt_descripcion_manoobra" name="txt_descripcion_manoobra" value=""/>
												<input type="hidden" id="txt_importe_manoobra2" name="txt_importe_manoobra2" value=""/>
												<input type="hidden" id="txt_descripcion_manoobra2" name="txt_descripcion_manoobra2" value=""/>
												<input type="hidden" id="txt_importe_torneria" name="txt_importe_torneria" value=""/>
												<input type="hidden" id="txt_descripcion_torneria" name="txt_descripcion_torneria" value=""/>
												<input type="hidden" id="txt_detalle_vozcliente" name="txt_detalle_vozcliente" value=""/>
												<input type="hidden" id="txt_contacto_vozcliente" name="txt_contacto_vozcliente" value=""/>
												<input type="hidden" id="txt_obs_vehiculo" name="txt_obs_vehiculo" value=""/>
												<input type="hidden" id="txt_porcentaje" name="txt_porcentaje" value=""/>
												<input type="hidden" id="tipo_submit" name="tipo_submit" value="nuevo"/>
												<input type="hidden" id="tipo_guardar" name="tipo_guardar" value="abierto"/>
                        <input type="hidden" id="txt_estado_presupuesto" name="txt_estado_presupuesto" value=""/>
												<input type="hidden" id="save_descto_fact" name="save_descto_fact" value="" />
												<table border="0" width="800" >
													<thead>
														<tr>
															<th style="width: 900px"></th>
															<th style="width: 150px"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td >
																<label class="form-label required"> Observaciones :</label>
																<input id="save_obs_presupuesto" class="form-field width80" name="save_obs_presupuesto" type="text" value="" maxlength="190"/>
															</td>

															<td >
																<label class="form-label required"> Descuento:</label>
																<input type="text" id="cmbDescto" name="cmbDescto" class="form-field width40" value="0" />
															</td>
													</tbody>
												</table>
												<table border="0" style="width: 350px">
													<tbody>
														<tr>
<!--
															<td style="width: 150px">
		                                                        <input id="btn_vozcliente" class="button themed" type="button" value="Elegir voz de cliente" name="btn_vozcliente" />
		                                                    </td>
-->
		                                                    <td style="width: 150px">
		                                                        <input id="btn_vervozcliente" class="button themed" type="button" value="Voz de cliente" name="btn_vervozcliente" />
		                                                        <label id="lbl_tiene_voz_cliente" style="display:none">Con voz de cliente</label>
		                                                    </td>
														</tr>
													</tbody>
                                            	</table>
                                            	</br>
<!--
												<div id="div_aux" style="display: none" >
													<input id="btn_aux" name="btn_aux" type="submit" value="Auxiliar" />
												</div>
-->
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
																<input id="cmbgridProducto" name="cmbgridProducto"/>
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
														<td style="width:300px">
															<input id="btn_AddProducto" class="button themed" type="button" value="Agregar" name="btn_AddProducto" />
															<input id="btn_QuitarProducto" class="button themed" type="button"  value="Quitar" name="btn_QuitarProducto" />
														</td>
														<td>&nbsp</td>
														<td style="width: 150px">
		                                                        <input id="btn_manoobra" class="button themed" type="button" value="Mano de obra" name="btn_manoobra" />
	                                                    </td>
														</td>
														<td style="width: 150px">
		                                                        <input id="btn_manoobra2" class="button themed" type="button" value="Mano de obra2" name="btn_manoobra" />
	                                                    </td>
	                                                    <td style="width: 150px">
		                                                        <input id="btn_torneria" class="button themed" type="button" value="Torneria" name="btn_torneria" />
	                                                    </td>
													</tr>
												</tbody>
                                            </table>

                                            <hr/>


											<table id="tt" class="easyui-datagrid" style="width:700px;height:400px" fitColumns="true" title="Detalle del presupuesto"  singleSelect="true" showFooter="true" rownumbers="true" >
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

											<input id="btn_Presupuesto_Generar" class="fr button themed" type="button" value="Generar OR" name="btn_Presupuesto_Generar" />
											<input id="btn_Presupuesto_Generar_2" class="fr button themed" type="button" value="Generar REMITO" name="btn_Presupuesto_Generar_2" />
											<input id="btn_Presupuesto_Add" class="fr button themed" type="button" value="Guardar" name="btn_Presupuesto_Add" />
											<input id="btn_Presupuesto_Rechazar" class="fr button themed" type="button" value="Rechazar" name="btn_Presupuesto_Rechazar" />
											<input id="btn_Presupuesto_Close" class="fr button themed" type="button" value="Vencer" name="btn_Presupuesto_Close" />
                      <input id="btn_Presupuesto_Accepts" class="fr button themed" type="button" value="Aceptar" name="btn_Presupuesto_Accepts" />
                      <input id="btn_Presupuesto_New" class="fl button themed" type="button" value="Nuevo" name="btn_Presupuesto_New" />
											<input id="btn_Presupuesto_Print" class="fl button themed" type="button" value="Imprimir" name="btn_Presupuesto_Print" />
<!--											<input id="btn_Presupuesto_Pdf" class="fl button themed" type="button" value="Generar PDF" name="btn_Presupuesto_Pdf" /> -->
											<input id="btn_Presupuesto_Open" class="fr button themed" type="button" value="Re-abrir Orden" name="btn_Presupuesto_Open"/>
										</div>

                                        <!-- listado -->
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
