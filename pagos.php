<?php
session_start();

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include_once 'MODEL/Recibo.php';
include 'MODEL/Persona.php';
include 'MODEL/Tiporetencion.php';

if(!isset($_SESSION['id_persona'])){
    header('Location: index.php');
	exit();
}

if(isset ($_SESSION['id_persona'])){
	$id_persona		= $_SESSION['id_persona'];   
	$persona		= new persona();
	$persona		= $persona->showPersona($id_persona);	
	$recibo 		= new recibo();
	$TipoReten=new tiporetencion();
	$arr_tiporeten=array();
	$arr_tiporeten=$TipoReten->ComboTipoRetencion();

/*

*/
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
        <script type="text/javascript" src="MYJS/Recibo.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Cobros</a></li>
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
                                		
                                <h2 class="box-header">RECIBO </h2>
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
                                    	
	                                	<div id="dialg_reten" class="dialog" title="SYSFACTURA INFORMA">
		                                	<form id="frm_retencion">
		                                		<table id="tbl_reten" width="200">
		                            				<tr>
			                            				<td>
			                            					<label class="form-label required"> Tipo </label>
			                            					<select id="txt_id_tiporeten" name="txt_id_tiporeten" class="form-field width60">
																<?php foreach($arr_tiporeten as $TipoReten){?>
																  <option value="<?php echo $TipoReten->get_id_tiporeten()?>"><?php echo $TipoReten->get_nom_codRetAir()?></option>
																  <?php } ?>
															</select> 
			                            				</td>
			                            			</tr>
			                            			<tr>
			                            				<td>
			                            					<label class="form-label required"> Número </label>
			                            					<input id="txt_reten_numero" class="form-field width40" name="txt_reten_numero" type="text" value="" maxlength="20"/>
			                            				</td>
			                            			</tr>
			                            			<tr>
			                            				<td>
			                            					<label class="form-label required"> Importe </label>
			                            					<input id="txt_reten_importe" class="form-field width40" name="txt_reten_importe" type="text" value="" maxlength="10"/>
			                            				</td>
			                            			</tr>
		                                		</table>
		                                		<input id="btn_Retencion_Add" class="button themed" type="button" value="Agregar" name="btn_Retencion_Add" />
												<input id="btn_Retencion_Cerrar" class="button themed" type="button" value="Cerrar" name="btn_Retencion_Cerrar" />
											</form>
                                    	</div>
										
										<div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA"> 
													
												<div id="div_facturas_pendientes" name="div_remitos_pendientes">
													<table id="facturas_table" class="easyui-datagrid" style="width:450px;height:auto" fitColumns="TRUE" title="Remitos pendientes"  singleSelect="true" showFooter="true" rownumbers="true" >
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
												<input id="btn_Detalle_Cobrar" class="button themed" type="button" value="Cobrar" name="btn_Detalle_Cobrar" />
												<input id="btn_Detalle_cerrar" class="button themed" type="button" value="Cerrar" name="btn_Detalle_Cerrar" />
												</p>
											
										</div>
										
										<div id="dialg_form_cheque" class="dialog" title="SYSFACTURA INFORMA">                                    
											<form id="frm_cheque">	
												<table border="0" width="450" >
													<thead>
														<tr>
														<th style="width: 200px"></th>
														<th style="width: 200px"></th>
														</tr>
													</thead>
													<tbody>                                                           
                                                        <tr>
                                                            <td >
                                                                <label class="form-label required"> Número </label>
                                                                <input id="save_num_cheque" class="form-field width60" name="save_num_cheque" type="text" value="" maxlength="100"/>
                                                            </td>    
                                                            <td >
                                                                <label class="form-label required"> Monto </label>
                                                                <input id="save_monto_cheque" class="form-field width60" name="save_monto_cheque" type="text" value="" maxlength="100"/>
                                                            </td>   
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                            	<label class="form-label required"> Fecha de pago </label>
                                                            	<input id="save_fecpago_cheque" name="save_fecrec_cheque" class="form-field datepicker" type="text"/>
                                                            </td>
                                                            <td>
                                                            	<label class="form-label required"> Estado </label>
                                                            	<select id="save_estado_cheque" class="form-field width60" name="save_estado_cheque" type="text" value="" maxlength="100">
                                                            		<option value=1>En mano</option>
                                                            		<option value=2>Depositado</option>
                                                            		<option value=3>Entregado</option>
                                                            	</select>
                                                            </td>                                                          
                                                        </tr>
                                                        <tr>
                                                            <td colspam=2>
                                                                <label class="form-label required"> Banco</label>
                                                                <input id="save_banco_cheque" class="form-field width60" name="save_banco_cheque" type="text" value=""/>
                                                            </td>
                                                            
                                                        </tr>
                                                        <tr>
                                                        	<td>
                                                                <label class="form-label required"> Propietario</label>
                                                                <input id="save_propietario_cheque" class="form-field width60" name="save_propietario_cheque" type="text" value="" />
                                                            </td>
                                                            <td>
                                                                <label class="form-label required"> Cuit propietario</label>
                                                                <input id="save_cuit_propie_cheque" class="form-field width60" name="save_cuit_propie_cheque" type="text" value="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        	<td colspan=2>
	                                                        	<label class="form-label required">Observaciones</label>
	                                                        	<input id="save_obs_cheque" class="form-field width80" name="save_obs_cheque" type="text" value=""/>
                                                        	</td>
                                                        </tr> 

                                                    </tbody>
												</table>
                                       
                                           </form>
                                            
                                            <hr/>
                                            
											<input id="btn_Cheque_Add" class="fr button themed" type="button" value="Guardar Cheque" name="btn_Cheque_Add" />
											<input id="btn_Cheque_New" class="fl button themed" type="button" value="Nuevo" name="btn_Cheque_New" />
										</div>
										
										
										<!--EDITAR-->
										
                                        <div id="tabs-1">                                    
											<form id="frm_recibo">	
												<table border="0" width="800" >
													<thead>
														<tr>
														<th style="width: 400px"></th>
														<th style="width: 400px"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<label class="form-label required"> Número de recibo :</label>  
																<input id="save_num_recibo" class="form-field width60" name="save_num_recibo" type="text" value="" maxlength="15"/>
															</td>
															<td>
																<label class="form-label required"> Fecha de Pago</label>  
																<input id="save_fecemi_recibo" class="form-field datepicker" name="save_fecemi_recibo" type="text"  />
															</td>

														</tr>	

														<tr>
															<td>
																<label class="form-label required"> Cliente</label>
																<input id="cmbgridCliente" name="cmbgridCliente" />
																&nbsp;
																<a href="#" id="link_pendientes">Pendientes de cobro</a>
															</td>
														</tr>
														<tr>
															<td>
																<label class="form-label required"> Razón Social :</label>   
																<input id="txt_cliente" readonly="true" class="form-field width60" name="txt_cliente" type="text" value="" maxlength="100"/>
															</td>
															<td>
																<label class="form-label required"> CUIT :</label>   
																<input id="txt_cuit" readonly="true" class="form-field width35" name="txt_cuit" type="text" value="" maxlength="100"/>
															</td>
														</tr>
														<tr>
															<td colspan=2>
																<label class="form-label required"> Observaciones :</label>  
																<input id="save_obs_recibo" class="form-field width70" name="save_obs_recibo" type="text" value="" maxlength="190"/>
															</td>
														</tr>
														<tr>
															<td colspan=2>
																<label class="form-label required"> Efectivo: </label>
																<input id="save_efectivo_recibo" class="form-field width20" name="save_efectivo_recibo" type="text" value="" maxlength="10"/>
															</td>
															
														</tr>
													</tbody>
												</table>

												<input type="hidden" id="save_total_recibo" name="save_total_recibo" value="0"/>
												<input type="hidden" id="save_total_cheque" name="save_total_cheque" value="0"/>
												<input type="hidden" id="save_total_retencion" name="save_total_retencion" value="0"/>
												<input type="hidden" id="save_id_cliente" name="save_id_cliente" value=""/>
												<input type="hidden" id="tipo_guardar" name="tipo_guardar" value="nuevo"/>
												

                                            </form>
                                            <hr/>
                                             
                                            <table border=0 width="750px">
                                            	<tr>	
                                            		<td> 
														<table id="tt" class="easyui-datagrid" style="width:360px;height:350px" fitColumns="true" title="Facturas"  singleSelect="true" showFooter="true" rownumbers="false" >
						                                    <thead>
																<tr>
																	<th field="id" width="30">ID</th>
																	<th field="tipo_num" width="80">Número</th>
																	<th field="fecha" width="100">Fecha</th> 
																	<th field="total" width="60">A cobrar</th> 
																	<th field="pendiente" width="60">Pendiente</th> 
																	<th field="check" width="20"></th>
																</tr>
															</thead>
														</table>
													</td>
													<td>
														<table id="ttc" class="easyui-datagrid" style="width:300px;height:180px" fitColumns="true" singleSelect="true" showFooter="false" rownumbers="false" title="Cheques <a style='color:blue;' id='link_nuevoCheque' href='#'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NUEVO CHEQUE</a>" >
						                                    <thead>
																<tr>
																	<th field="numero" width="80">Número</th>
																	<th field="banco" width="100">Banco</th> 
																	<th field="fecha" width="80">Fecha</th> 
																	<th field="monto" width="80">Monto</th> 
																	<th field="check" width="20"></th>
																</tr>
															</thead>
														</table>
														<table>
															<tr>
																<td width="200px"></th>
																<td width="100px">TOTAL: $<spam id="total_cheques"></spam></th>
															</tr>
														</table>
														<br>
														<table id="ttr" class="easyui-datagrid" style="width:300px;height:120px" fitColumns="true" singleSelect="true" showFooter="false" rownumbers="false" title="Retenciones <a style='color:blue;' id='link_nuevaRetencion' href='#'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NUEVA RETENCION</a>" >
						                                    <thead>
																<tr>
																	<th field="numero" width="100">Num</th>
																	<th field="tipo" width="100">Tipo</th>
																	<th field="monto" width="80">Monto</th> 
																	<th field="check" width="20"></th>
																</tr>
															</thead>
														</table>
														<table>
															<tr>
																<td width="200px"></th>
																<td width="100px">TOTAL: $<spam id="total_retencion"></spam></th>
															</tr>
														</table>
														<br>
														<table>
															<tr>
																<td width="100px"></th>
																<td width="200px" style="font-size:15px">TOTAL REMITO: $ <spam  id="total_remito"></spam></th>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<hr/>
											<input id="btn_Recibo_Add" class="fr button themed" type="button" value="Guardar Recibo" name="btn_Recibo_Add" />
											<input id="btn_Recibo_New" class="fl button themed" type="button" value="Nuevo" name="btn_Recibo_New" />
										</div>
                                        
                                        
                                        <div id="tabs-2">
											<div id="tabla_result">
												 <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th>Numero</th>
															<th>Fecha</th>
															<th>Cliente</th>
															<th>Efectivo</th>
															<th>TOTAL</th>
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
