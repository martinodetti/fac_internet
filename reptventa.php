<?php
session_start();

include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/Descuento_venta.php';


if(!isset($_SESSION['id_persona'])){
    header('Location: index.php');
	exit();
}
?>
<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<?php 


if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$persona=$persona->showPersona($id_persona);
$clsDescto=new descuento_venta();
$arr_descto=$clsDescto->ComboDescuento_ventas();
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
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/datagrid.css"/>
		<link rel="stylesheet" type="text/css" href="CSS_INTERNO/combo.css"/>

		<script type="text/javascript" src="JS/jquery-1.6.2.min.js" ></script>
        <script type="text/javascript" src="JS/jquery.easyui.min.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
        <script type="text/javascript" src="MYJS/datagrid-detailview.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
        <script type="text/javascript" src="JS/datagrid-export.js"></script>
        <script type="text/javascript" src="MYJS/Reporteventa.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Reporte de Ventas</a></li>
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
                                        <h2 class="box-header">REPORTE DE VENTAS </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">NUEVO</a></li> 
                                            </ul>
                                        
                                        <div class="box-content"> 
                                            
											<div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
												<span id="msg" class="message success"></span>
                                                <p class="fr"></p>
												<a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                        
                                            
                                            <div id="tabs-1">
                                                <table border="0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 200px"></th>
                                                            <th style="width: 200px"></th>
                                                            <th style="width: 200px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label class="form-label required"> Fecha Inicial </label>
                                                                <input id="fec_ini" name="fec_ini" class="form-field datepicker" type="text"/>
                                                            </td>
                                                            <td>
                                                                <label class="form-label required"> Fecha Final </label>
                                                                <input id="fec_final" name="fec_final" class="form-field datepicker" type="text"/>
                                                            </td>
                                                            <td>
                                                                <input id="btn_Buscar" class="button themed" type="button" value="Buscar" name="btn_Buscar" />
                                                            </td>
                                                            <td>
                                                                <input id="btn_Exportar" class="button themed" type="button" value="Exportar" name="btn_Exportar" />
                                                            </td>
                                                         </tr>
                                                        
                                                     </tbody>
                                                </table>
                                                <hr/>
                                                <table id="dg" style="width:800px;height:250px" url="CONTROLLER/C_Factura.php?opc=8"  title="Reporte de Ventas" singleselect="true" fitcolumns="true">  
                                                        <thead>  
                                                            
                                                        </thead>  
                                                    </table>  
                                                <br/>
												<div>
													<table style="width:830px">
														<tr>
															<!--<th> Subtotal <input id="label_subtotal" value="" disabled style="width:70px"/></th>-->
															<th> M.de Obra <input id="label_manoobra" value="" disabled style="width:70px"/></th>
															<th> Iva 10,5% <input id="label_iva105" value="" disabled style="width:70px"/></th>
															<th> Iva 21% <input id="label_iva21" value="" disabled style="width:70px"/></th>
															<th> TOTAL <input id="label_total" value="" disabled style="width:70px"/></th>
														</tr>
													</table>
												<hr/>
												</div>
                                                <table id="tt" style="width:800px;height:250px"   title="Detalle de Factura" singleselect="true" fitcolumns="true">  
													<thead>  
														<tr>  
															<th field="id_fact" width="40">Id Fac</th>  
															<th field="nom_producto" width="70">Codigo</th>
															<th field="descrip_producto" width="100">Producto</th>  
															<th field="canti_detfact" align="right" width="80">Cantidad</th>  
															<th field="precio_detfact" align="right" width="80">Precio</th>  
														</tr>  
													</thead>  
												</table>  
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
