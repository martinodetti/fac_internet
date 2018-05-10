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
        <meta name="generator" content=""/>
        <title>SISTEMA DE FACTURACIÓN </title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
        <!--link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/-->
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
        <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
        <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="MYJS/Compra.js" ></script>
<!--
<script type="text/javascript">

    $(function(){
         $("#btn_Persona_New").click(function(){
             Add();
             reloadData();
         });
        });
        </script>-->

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
                            <li><a class="breadcrumb underline" href="#">Home</a></li>
                            <li class="fr"><a class="button gray fl" title="logout" href="CONTROLLER/Salir.php" >
							<span class="icon_text logout"></span>Salir</a></li>
                            <li class="s_1 fr"></li>
                            <li class="fr"><a class="button gray fl" title="admin" href="#"><span class="icon_text admin"></span><?php echo $persona->get_nom_persona() ?></a></li>
                            <li class="fr"><a id="logged">Logeado como:</a></li>
                        </ul>
                    </div>
                    <!--fin de cabecera-->

					<!-- contentLayout va aqui con todo lo que tiene wilfo-->
					<div class="contentLayout">
						<div id="content" >
							<div class="column full fl">
								<div class="box tabs themed_box">
									<h2 class="box-header">MERCADERÍA </h2>
									<ul class="tabs-nav">
										<li class="tab"><a href="#tabs-1">INGRESO DE MERCADERÍA</a></li>
										<li class="tab"><a href="#tabs-2">COMPRAS ANTERIORES</a></li>
										<li class="tab"><a href="#tabs-3">NOTAS DE CREDITO</a></li>
									</ul>

									<div class="box-content">
										<div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">
											<span id="msg" class="message success"></span>
											<p class="fr"></p>
											<a id="dial_msg_close" class="button themed closer">Aceptar</a>
										</div>

										<div id="dialg_error" class="dialog" title="SYSFACTURA INFORMA">
                                            <span id="msg" class="message error">
                                            El número de factura ingresado ya se encuentra cargado para este proveedor
                                            </span>
                                            <p class="fr"></p>
			                				<a id="dialg_error_close" class="button themed closer">Aceptar</a>
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

										<div id="tabs-1">
										<!--   CAMPO ESCONDIDO PARA TOTAL    -->
											<form id="frmCompra_Add" method="post" action="">
												<input type="hidden" id="save_total_compra" name="save_total_compra" value="" />
												<input type="hidden" id="save_iva21_compra" name="save_iva21_compra" value=""/>
												<input type="hidden" id="save_iva10_compra" name="save_iva10_compra" value=""/>
												<input type="hidden" id="save_subtotal_compra" name="save_subtotal_compra" value=""/>
												<input type="hidden" id="margen_ganancia" name="margen_ganancia" value="0.00"/>
                                                <input type="hidden" id="id_condiva" name="id_condiva" value="1"/>
												<input type="hidden" id="tipo_guardar" name="tipo_guardar" value="nuevo"/>
												<input type="hidden" id="update_id_compra" name="update_id_compra" value=""/>
												<table border="0"  width="880" cellspacing="80">
													<thead>
														<tr>
															<th style="width: 50%"></th>
															<th style="width: 50%"></th>
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
															<td >
																<br>
																<label class="form-label required"> Proveedor </label>
																 <select id="save_id_provd" name="save_id_provd" class="form-field width40">
																 	<option value="0"></option>
																	<?php foreach($arr_provd as $persona){?>
																	<option value="<?php echo $persona->get_id_persona();?>"><?php echo $persona->get_nom_persona();?></option>
																	<?php } ?>
																</select>
																<label id="label_ganancia"></label>
															</td>
															<td>
																<label class="form-label required"> Fecha </label>
																<input id="save_fec_compra" name="save_fec_compra" class="form-field datepicker" type="text"/>
															</td>
														</tr>
														<tr>
															<td>
																<label class="form-label required"> Número de Factura </label>
																<input id="save_guiacod_compra" class="form-field width40" name="save_guiacod_compra" type="text" value="" maxlength="30"/>
															</td>
															<td>
                                                                <label class="form-label required"> Fecha de imputación </label>
                                                                <input id="save_fec_ingreso" name="save_fec_compra_ingreso" class="form-field datepicker" type="text"/>

<!--
																<label class="form-label">Percepción</label>
																<input id="txt_percepcion" class="form-field width20" name="txt_percepcion" type="text" value="" maxlength="10"/>
-->
															</td>
														</tr>
															<tr>
																<td colspan="2">
																	<label class="form-label required"> Observación </label>
																	<input id="save_obs_compra" class="form-field width80" name="save_obs_compra" type="text" value="" maxlength="150"/>
																</td>
															</tr>
													</tbody>
												</table>
												<div id="div_aux" style="display: none" >
													<input id="btn_aux" name="btn_aux" type="submit" value="Auxiliar" />
												</div>
												<hr/>
												<label class="form-label">Otros valores</label>
												<br>
												<table width="880">
													<tr>
														<td>
															<label class="form-label">Retención IIBB</label>
															<input id="save_iibb_ret" class="form-field width30" name="save_iibb_ret" type="text" value="" maxlength="10"/>
														</td>
														<td>
															<label class="form-label">Percepción IVA</label>
															<input id="save_iva_ret" class="form-field width30" name="save_iva_ret" type="text" value="" maxlength="10"/>
															</td>
														<td>
															<label class="form-label">Retención GANANCIA</label>
															<input id="save_ganancia_ret" class="form-field width30" name="save_ganancia_ret" type="text" value="" maxlength="10"/>
														</td>
														<td>
															<label class="form-label">Concep. no grav.</label>
															<input id="save_concepto_nograv" class="form-field width30" name="save_concepto_nograv" type="text" value="" maxlength="10"/>
														</td>
														<td>
															<label class="form-label">Descuento</label>
															<input id="save_descuento" class="form-field width30" name="save_descuento" type="text" value="" maxlength="10"/>
														</td>
													</tr>
												</table>
											</form>
											<hr/>

											<form id="frm_add_producto" name="frm_add_producto" method="">
												<table >
													<thead>
														<tr>
															<th style="width: 60%" colspan="4" >
																<label class="form-label required">Búsqueda de Productos</label><br/>
																<input id="cmbgrid" name="cmbgrid"   />
															</th>
														</tr>
													</thead>
													<tbody>
														<tr style="width: 100%">
															<td>
																<input type="hidden" id="txt_idproducto" name="txt_idproducto" value="" />
																<input type="hidden" id="txt_cod_producto" name="txt_cod_producto" value="" />
																<input type="hidden" id="txt_nom_producto" name="txt_nom_producto" value="" />
																<input type="hidden" id="txt_tipoiva" name="txt_tipoiva" value=""/>
                                                                <input type="hidden" id="txt_porcentaje_iva" name="txt_porcentaje_iva" value="" />
																<br>
																<label class="form-label required">Costo</label>
																<input id="txt_costo" class="form-field width40" name="txt_costo" type="text" value="" maxlength="10"/>
															</td>
															<td>
																<br>
																<label class="form-label required">Cantidad</label>
																<input id="txt_cantidad" class="form-field width40" name="txt_cantidad" type="text" value="" maxlength="10"/>
															</td>
															<td>
																<br>
																<label class="form-label required">Precio de venta</label>
																<input id="txt_precio" class="form-field width40" name="txt_precio" type="text" value="" maxlength="10"/>
															</td>
															<td>
																<br>
																<label class="form-label required">Descuento</label>
																<input id="txt_descuento_prod" class="form-field width40" name="txt_descuento_prod" type="text" value="" maxlength="5"/>
															</td>
														</tr>
													</tbody>
												</table>
												<div style="display: none">
													 <input type="submit" value="btn_addProducto_aux" />
												</div>

											</form>
											<input id="btn_AddProducto" class="button themed" type="submit" value="Agregar" name="btn_AddProducto" />
											<input id="btn_QuitarProducto" class="button themed" type="button" value="Quitar" name="btn_QuitarProducto" />
											<hr/>
											<table id="tt" class="easyui-datagrid" style="width:750px;height:350px" fitColumns="true"	title="Detalle de Compra"  singleSelect="true" showFooter="true" rownumbers="true" >
												<thead>
													<tr>
														<th field="id" width="30">ID</th>
														<th field="cod" width="50">Cod</th>
														<th field="producto" width="160">Producto</th>
														<th field="precio" width="30">Costo</th>
														<th field="preciovta" width="30">Precio Vta</th>
														<th field="tipoiva" width="30">Tipo IVA</th>
														<th field="iva" width="30">IVA</th>
														<th field="cantidad" width="30">Cantidad</th>
														<th field="total" width="40">subtotal</th>
													</tr>
												</thead>
											</table>
											<hr/>

											<input id="btn_Compra_Add" class="fr button themed" type="button" value="Guardar Mercadería" name="btn_Compra_Add" />
											<input id="btn_Compra_Update" class="fr button themed" type="button" value="Activar actualización" name="btn_Compra_Update" />
											<input id="btn_Compra_New" class="fr button themed" type="button" value="Nuevo" name="btn_Compra_New" />
										</div>
										<div id="tabs-2">
											<div id="tabla_result">
												 <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th width=80px>Numero</th>
															<th width=80px>Fecha Factura</th>
															<th width=80px>Fecha Ingreso</th>
															<th>Proveedor</th>
															<th width=70px>Subtotal</th>
															<th width=70px>Iva 21</th>
															<th width=70px>Estado</th>
															<th width=70px>TOTAL</th>
															<th width=80px></th>
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
