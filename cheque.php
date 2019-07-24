<?php
session_start();

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Cheque.php';
include 'MODEL/Persona.php';

if(!isset($_SESSION['id_persona'])){
    header('Location: index.php');
	exit();
}

if(isset ($_SESSION['id_persona'])){
	$id_persona		= $_SESSION['id_persona'];   
	$persona		= new persona();
	$persona		= $persona->showPersona($id_persona);	
	$cheque 		= new cheque();
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
        <script type="text/javascript" src="MYJS/Cheque.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Cheque de reparación</a></li>
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
                                		
                                <h2 class="box-header">CHEQUE </h2>
                               		<ul class="tabs-nav">
                                		<li class="tab"><a href="#tabs-1">LISTADO</a></li> 
<!--                                		<li class="tab"><a href="#tabs-2">NUEVO</a></li> -->
                               		</ul>
                                    
                                    <div class="box-content"> 
                                        
                                    	<div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                    		<span id="msg" class="message success"></span>
											<p class="fr"></p>
							                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                    	</div>
                                    	
                                    	<div id="dialg_chequeDetalle" class="dialog" title="SYSFACTURA INFORMA">
                                    		<form id="frmPersona_Update" method="post" action="">
                                              	<input type="hidden" id="update_id_cheque" name="update_id_cheque" value="" />
                                         
                                                   <table border="0"  width="500" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50%"></th>
                                                            <th style="width: 50%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                                           
                                                        <tr>
                                                            <td >
                                                                <label class="form-label required"> Número </label>
                                                                <input id="update_num_cheque" class="form-field width60" name="update_num_cheque" type="text" value="" maxlength="100" readonly="readonly"/>
                                                            </td>    
                                                            <td >
                                                                <label class="form-label required"> Monto </label>
                                                                <input id="update_monto_cheque" class="form-field width60" name="update_monto_cheque" type="text" value="" maxlength="100" readonly="readonly"/>
                                                            </td>    
                                                        </tr>  
                                                        <tr>
                                                        	<td>
                                                        		<label class="form-label required"> Fecha recibido </label>
                                                            	<input id="update_fecrec_cheque" name="update_fecrec_cheque" class="form-field datepicker" type="text" readonly="readonly"/>
                                                            </td>
                                                            <td>
                                                            	<label class="form-label required"> Fecha de pago </label>
                                                            	<input id="update_fecpago_cheque" name="update_fecrec_cheque" class="form-field datepicker" type="text" readonly="readonly"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        	<td >
                                                                <label class="form-label required"> Número de recibo </label>
                                                                <input id="update_num_recibo_cheque" class="form-field width60" name="update_num_recibo_cheque" type="text" value="" maxlength="100" readonly="readonly"/>
                                                            </td> 
                                                            <td >
                                                                <label class="form-label required"> Cliente </label>
                                                                <input id="update_cliente_cheque" class="form-field width60" name="update_cliente_cheque" type="text" value="" maxlength="100" readonly="readonly"/>
                                                            </td> 
                                                        </tr>                                                       
                                                        <tr>
                                                            <td>
                                                                <label class="form-label required"> Banco</label>
                                                                <input id="update_banco_cheque" class="form-field width60" name="update_banco_cheque" type="text" value="" readonly="readonly"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label required"> Propietario</label>
                                                                <input id="update_propietario_cheque" class="form-field width60" name="update_propietario_cheque" type="text" value=""  readonly="readonly"/>
                                                            </td>
                                                            <td>
                                                                <label class="form-label required"> Cuit</label>
                                                                <input id="update_cuit_propietario_cheque" class="form-field width60" name="update_cuit_propietario_cheque" type="text" value=""  readonly="readonly"/>
                                                            </td>
                                                        </tr>
							                            <tr>
                                                            <td>
                                                                <label class="form-label required"> Entregado a </label>
                                                                <input id="update_provd_cheque" class="form-field width60" name="update_provd_cheque" type="text" value="" readonly="readonly"/>
                                                            </td>
                                                            <td>
                                                            <label class="form-label required"> Estado </label>
                                                                <input id="update_estado_cheque" class="form-field width60" name="update_estado_cheque" type="text" value="" readonly="readonly"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <label class="form-label required"> Observaciones </label>
                                                                <input id="update_obs_cheque" class="form-field width80" name="update_obs_cheque" type="text" value=""/>
                                                            </td>
                                                        </tr>
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                              	<hr/>
<!--
												<table id="remitos_table" class="easyui-datagrid" style="width:475px;height:auto" fitColumns="TRUE" title="MOVIMIENTOS"  singleSelect="true" showFooter="true" rownumbers="true" >
                                                    <thead>
                                                        <tr>
                                                            <th field="fecha" width="80">Fecha</th>
                                                            <th field="observacion" width="350">Observación</th>
                                                        </tr>
                                                    </thead>
													<tbody>
													
													</tbody>
                                                </table>
                                              
												<hr/>
-->
                                                <p class="fr">
                                                    <input id="btn_Cheque_Entregar" clasS="fr button themed" type="button" value="Entregar" name="btn_Cheque_Entregar" />
                                                	<input id="btn_Cheque_Depositar" clasS="fr button themed" type="button" value="Depositar" name="btn_Cheque_Depositar" />
													<input id="dialg_chequeDetalle_close" class="button themed" type="button" value="Cerrar" name="dialg_chequeDetalle_close" />
<!--                                                	<input id="btn_Cheque_Update" class="button themed" type="submit" value="Actualizar" name="btn_Cheque_Update" />
-->
                                                </p>
											</form>
											
                                    	
                                			
                                    	</div>

                                    	
                                    	
                                  		<!--TABS-->
                                        
                                        <!-- listado -->

                                        <div id="tabs-1">
											<div id="tabla_result">
												 <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
													<thead>
														<tr>
															<th>ID</th>
															<th>Número</th>
															<th>Fec ingreso</th>
															<th>Fec pago</th>
															<th>Monto</th>
															<th>Banco</th>
															<th>Propietario</th>
															<th>Cliente</th>
															<th>Estado</th>
															<th></<th>
														</tr>
													</thead>
													<tbody>
										
													</tbody>
												</table>
											</div>
                                        </div>
<!--                                        
                                        <div id="tabs-2">                                    
											<form id="frm_cheque">	
												<table border="0" width="750" >
													<thead>
														<tr>
														<th style="width: 250px"></th>
														<th style="width: 250px"></th>
														<th style="width: 250px"></th>
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
                                                            <td >
                                                                <label class="form-label required"> Número de recibo </label>
                                                                <input id="save_num_recibo_cheque" class="form-field width60" name="save_num_recibo_cheque" type="text" value="" maxlength="100"/>
                                                            </td>  
                                                        </tr> 
                                                        <tr>
                                                        	<td>
                                                        		<label class="form-label required"> Fecha recibido </label>
                                                            	<input id="save_fecrec_cheque" name="save_fecrec_cheque" class="form-field datepicker" type="text"/>
                                                            </td>
                                                            <td>
                                                            	<label class="form-label required"> Fecha de pago </label>
                                                            	<input id="save_fecpago_cheque" name="save_fecrec_cheque" class="form-field datepicker" type="text"/>
                                                            </td>
                                                            <td>
                                                            	<label class="form-label required"> Estado </label>
                                                            	<input id="save_estado_cheque" class="form-field width60" name="save_estado_cheque" type="text" value="" maxlength="100"/>
                                                            </td>                                                          
                                                        </tr>
                                                        <tr>
                                                            <td >
                                                                <label class="form-label required"> Cliente </label>
                                                                <input id="save_cliente_cheque" class="form-field width60" name="save_cliente_cheque" type="text" value="" maxlength="100"/>
                                                            </td> 
                                                            <td>
                                                                <label class="form-label required"> Banco</label>
                                                                <input id="save_banco_cheque" class="form-field width60" name="save_banco_cheque" type="text" value=""/>
                                                            </td>
                                                            <td>
                                                                <label class="form-label required"> Propietario</label>
                                                                <input id="save_propietario_cheque" class="form-field width60" name="save_propietario_cheque" type="text" value="" />
                                                            </td>
                                                            
                                                        </tr> 

                                                    </tbody>
												</table>
                                       
                                           </form>
                                            
                                            <hr/>
                                            
                                           
											<input id="btn_Cheque_Add" class="fr button themed" type="button" value="Guardar Cheque" name="btn_Cheque_Add" />
											<input id="btn_Cheque_New" class="fl button themed" type="button" value="Nuevo" name="btn_Cheque_New" />
										</div>
                                        
                                        
                                        <div class="clear"></div>
-->
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
