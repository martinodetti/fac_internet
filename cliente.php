<?php
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
// include 'MODEL/Ciudad.php';
 include 'MODEL/Tipo_conexion.php';
 include 'MODEL/Provincia.php';
 include 'MODEL/Listaprecio.php';

session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];
$persona=new persona();
//$persona2=new persona();
$persona=$persona->showPersona($id_persona);
//$Lista_trabajador=$persona2->ComboTrabajador2();
$provincia = new provincia();
$arr_prov = $provincia->listprovincias();

$Listaprecio = new listaprecio();
$arr_listaprecio = $Listaprecio->Combolistaprecio();

/*
$Ciudad=new ciudad();
$tipo_conex=new tipo_conexion();
$Lista_tipo_conex=$tipo_conex->listTipo_conexions();

$arr_ciudad=$Ciudad->listCiudads();
*/

?>

<html  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="UTMACH "/>
        <meta name="description" content=""/>
        <meta name="generator" content="Bluefish 2.2.3" />
        <title>SISTEMA DE FACTURACIÓN </title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>

        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
        <link rel="stylesheet" href="CSS_INTERNO/demo_table_jui.css"/>
		<link rel="stylesheet" href="CSS_INTERNO/external/jquery-ui-1.8.4.custom.css"/>
        <link rel="stylesheet" href="CSS_INTERNO/TableTools_JUI.css"/>

        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>

        <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>

        <script type="text/javascript" src="JS/jquery-ui-timepicker-addon.js" ></script>
        <script type="text/javascript" src="new_js/Cliente.js" ></script>


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
                            <li class="fr"><a class="button gray fl" title="admin" href="#"><?php echo $persona->get_nom_persona() ?><span class="icon_text admin"></span></a></li>
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
										<li class="tab"><a href="#tabs-1">MODIFICAR</a></li>
										<li class="tab"><a href="#tabs-2">NUEVO</a></li>
										<li class="tab"><a href="#tabs-4">CTAS CTES</a></li>
										<li class="tab"><a href="#tabs-3">ELIMINAR</a></li>
										</ul>

                                        <div class="box-content">
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">
												<span id="msg" class="message success"></span>
												<p class="fr"></p>
												<a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>

											<div id="tabla_ctacte">	</div>
											<div id="dialg_ctacte" class="dialog" title="CUENTA CORRIENTE">
												<div id="ctacte_table">	</div>

												</br>
												<p class="fr">
												<input id="btn_Detalle_imprimir" class="button themed" type="button" value="Imprimir" name="btn_Detalle_imprimir" />
												<input id="btn_Detalle_cerrar" class="button themed" type="button" value="Cerrar" name="btn_Detalle_Cerrar" />
												</p>
											</div>


                                            <div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">
                                                <form id="frmPersona_Update" method="post" action="">
                                                  	<input type="hidden" id="update_id_persona" name="update_id_persona" value="" />
                                                  	<input type="hidden" id="update_id_tipoper" name="update_id_tipoper" value="2" />
                                                  	<input type="hidden" id="update_id_detcliente" name="update_id_detcliente" value="" />

                                                       <table border="0"  width="700" cellspacing="80">
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
                                                                         <input id="update_nom_persona" class="form-field width80"
                                                                        name="update_nom_persona" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                    <td >
                                                                        <label class="form-label required"> Nombre fantasía </label>
                                                                         <input id="update_ape_persona" class="form-field width80"
                                                                        name="update_ape_persona" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                </tr>

                                                                <tr>
<!--
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
-->
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> CUIT / DNI</label>
                                                                         <input id="update_ruc_persona" class="form-field width80"
                                                                        name="update_ruc_persona" type="text" value="" maxlength="13"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Provincia </label>
                                                                          <select id="update_id_provincia" name="update_id_provincia" class="form-field width40">
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
                                                                        <input id="update_telf_persona" class="form-field width80" name="update_telf_persona" type="text" value="" maxlength="32"/>
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
                                                                        <label class="form-label required"> Teléfono 2</label>
                                                                        <input id="update_telf_persona_2" class="form-field width80" name="update_telf_persona_2" type="text" value="" maxlength="32"/>
                                                                    </td>


                                                                    <td>
                                                                       <label class="form-label required"> Condición IVA </label>
                                                                          <select id="update_id_condiva" name="update_id_condiva" class="form-field width40">
                                                                          	<option value="1">Responsable Inscripto</option>
                                                                          	<option value="2">Monotrobutista</option>
                                                                          	<option value="3">Consumidor final</option>
																			<option value="4">Exento</option>
																			<option value="5">Cliente extranjero</option>
                                                                        </select>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                	<td>
                                                                        <label class="form-label required"> Celular</label>
                                                                         <input id="update_cel_persona" class="form-field width80" name="update_cel_persona" type="text" value=""  maxlength="32"/>
                                                                    </td>

                                                                    <td>
		                                                               <label class="form-label required"> Tiene cuenta corriente </label>
		                                                                  <select id="update_tiene_ctacte" name="update_tiene_ctacte" class="form-field width40">
		                                                                  	<option value="1">Si</option>
		                                                                  	<option value="2">No</option>
		                                                                  	<option value="3">Suspendida</option>
		                                                                </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td >
                                                                      <label class="form-label required"> Factura Credito</label>
                                                                   <div>
                                                                    <input type="checkbox"  name="update_factura_credito" id="update_factura_credito">
                                                                   </div>
                                                                 </td>
                                                                <td>
                                                                        <label class="form-label required"> Limite cuenta corriente</label>
                                                                        <input id="update_limite_ctacte" class="form-field width20" name="update_limite_ctacte" type="text" value="0"  maxlength="32"/>
		                                                            </td>
                                                                </tr>
                                                                <tr>
                                                                	<td>
                                                                        <label class="form-label required"> E-mail </label>
                                                                           <input id="update_email_persona" class="form-field width80" name="update_email_persona" type="text" value="" />
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Lista de precios </label>
                                                                        <select id="update_id_listaprecio" name="update_id_listaprecio" class="form-field width40">
                                                                            <?php foreach($arr_listaprecio as $Listaprecio){?>
                                                                              <option value="<?php echo $Listaprecio->get_id_listaprecio()?>"><?php echo $Listaprecio->get_nombre_listaprecio()?></option>
                                                                              <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr >
                                                                    <td colspan="2">
                                                                         <label class="form-label required"> Dirección </label>
                                                                          <input id="update_direc_persona" class="form-field width90" name="update_direc_persona" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                </tr>
                                                                <tr >
                                                                    <td colspan="2">
                                                                         <label class="form-label required"> Observaciones </label>
                                                                          <input id="update_obs_persona" class="form-field width90" name="update_obs_persona" type="text" value="" maxlength="255"/>
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
												<div id="tabla_result">
													<table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
														<thead>
															<tr>
																<th width="10">ID</th>
																<th width="180">Razón Social</th>
																<th width="150">Nombre fantasía</th>
																<th width="90">CUIT / DNI</th>
																<th width="130">Teléfonos</th>
<!--																<th>Celular</th>
																<th>Email</th> -->
																<th width="170">Opción</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>


											<div id="tabs-2">
												 <form id="frmPersona_Add" method="post" action="">
													<input type="hidden" id="save_id_tipoper" name="save_id_tipoper" value="2" />
													<input type="hidden" id="txt_id_cliente_temp" name="txt_id_cliente_temp" value=""/>
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
																	<input id="save_telf_persona" class="form-field width80" name="save_telf_persona" type="text" value="" maxlength="32"/>
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
                                                                        <input id="save_telf_persona_2" class="form-field width80" name="save_telf_persona_2" type="text" value="" maxlength="32"/>
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
																	 <input id="save_cel_persona" class="form-field width80" name="save_cel_persona" type="text" value=""  maxlength="32"/>
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
                                                                <td >
                                                                      <label class="form-label required"> Factura Credito</label>
                                                                   <div>
                                                                    <input type="checkbox"  name="save_factura_credito" id="save_factura_credito">
                                                                   </div>
                                                                 </td>
                                                                <td>
                                                                    <label class="form-label required"> Limite cuenta corriente</label>
                                                                    <input id="save_limite_ctacte" class="form-field width20" name="save_limite_ctacte" type="text" value="0"  maxlength="32"/>
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

															<tr >
																<td colspan="2">
																	 <label class="form-label required"> Dirección </label>
																	  <input id="save_direc_persona" class="form-field width90" name="save_direc_persona" type="text" value="" maxlength="100"/>
																</td>
															</tr>
															<tr >
																<td colspan="2">
																	 <label class="form-label required">Observaciones</label>
																	  <input id="save_obs_persona" class="form-field width90" name="save_obs_persona" type="text" value="" maxlength="255"/>
																</td>
															</tr>

														</tbody>
													</table>
													<hr/>
													<p>
													<input id="btn_Persona_New" class="button themed" type="button" value="Nuevo" name="btn_Persona_New" />
													<input id="btn_Persona_Add" class="button themed" type="submit" value="Guardar" name="btn_Persona_Add" />
													</p>
												</form>
											</div>

											<div id="tabs-3">
												<form id="frmTrabajador_Buscar_Delete" method="post" action="">
													<label class="form-label required"> Búsquedad razón social</label>
													<input id="txt_Buscar_Delete" class="form-field width40" name="txt_Buscar_Delete" type="text" value="" maxlength="20"/>
													<input id="btn_Trabajador_Buscar_Delete" class="button themed" type="submit" value="Buscar" name="btn_Trabajador_Buscar_Delete" />
												</form>
												<div id="tabla_result_delete"></div>
											</div>

											<div id="tabs-4">
				 								<div id="tabla_result">
													<table id="table-ctacte" cellpadding="0" cellspacing="0" border="0" class="display" >
														<thead>
															<tr>
																<th width="10">ID</th>
																<th width="180">Razón Social</th>
																<th width="90">CUIT / DNI</th>
																<th width="200">Teléfonos</th>
																<th width="170">Saldo</th>
																<th width="170">Acción</th>
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

		<script type="text/javascript" charset="utf-8" src="new_js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="new_js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="new_js/TableTools.js"></script>
    </body>
</html>

<?php
}
