<?php 
 include 'DAC/Database.class.php';
 include 'MODEL/Persona.php';
 include 'MODEL/Descuento_venta.php';
session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$persona=$persona->showPersona($id_persona);
$clsDescto=new descuento_venta();
$arr_descto=$clsDescto->ComboDescuento_ventas();
?>
<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="UTMACH "/>
        <meta name="description" content=""/>
        <meta name="generator" content=""/>
        <title>SISTEMA DE FACTURACIÓN</title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>
<!--        <link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/>-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
        
        <link rel="stylesheet" href="CSS_INTERNO/demo_table_jui.css"/> 
	<link rel="stylesheet" href="CSS_INTERNO/external/jquery-ui-1.8.4.custom.css"/>
         <link rel="stylesheet" href="CSS_INTERNO/TableTools_JUI.css"/> 
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->

<script type="text/javascript" src="JS/jquery-1.6.2.min.js" ></script>
<!--        <script   src="new_js/jquery-1.7.1.min.js"></script>-->
        <script src="new_js/jquery-ui-1.8.16.min.js"></script>
<!--        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>-->
        
          <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
<!--         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>-->
        <script type="text/javascript" src="new_js/Pago.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Pagos de Clientes</a></li>
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
                                        <h2 class="box-header">PAGO DE CLIENTES </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">PAGOS PENDIENTES</a></li> 
                                               
                                            </ul>
                                        
                                        <div class="box-content"> 
                                            
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                  <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                        
                                            
                                            <div id="tabs-1">
                                               <label class="form-label">LISTADO DE CLIENTES CON PAGOS PENDIENTES</label>
                                                
                                                 <table border="0" style="width: 600px">
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
                                                                         <input id="fecIni_cliente_buscar" name="fecIni_cliente_buscar" 
                                                                                class="form-field datepicker" type="text"/>
                                                                 </td>
                                                                 <td>
                                                                     <label class="form-label required"> Fecha Inicial </label>
                                                                         <input id="fecFin_cliente_buscar" name="fecFin_cliente_buscar" 
                                                                                class="form-field datepicker" type="text"/>
                                                                 </td>
                                                                 <td>
                                                                     <input id="btn_Cliente_filtrar" class="button themed" type="button" 
                                                                                value="Visualizar" name="btn_Cliente_filtrar" />
                                                                 </td>
                                                             </tr>
                                                         </tbody>
                                                     </table>

                                               
                                                 
                                                
                                                 
                                                 
                                                  <hr/>
                                                  <div id="div_pago_pendiente">
                                                       <table id="table-example" cellpadding="0" cellspacing="0" border="0" class="display" >
									<thead>
										<tr>
											<th>ID</th>
											<th>Nombre</th>
											<th>Apellido</th>
											<th>RUC</th>
											<th>Teléfono</th>
											<th>Celular</th>
											<th>Fecha</th>
											<th>Estado</th>
											
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
<!--    <script type="text/javascript" charset="utf-8" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/ZeroClipboard.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/TableTools.js"></script>-->
    <script type="text/javascript" charset="utf-8" src="new_js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" src="new_js/ZeroClipboard.js"></script>
    <script type="text/javascript" charset="utf-8" src="new_js/TableTools.js"></script>

    </body>
</html>
<?php 
}else{
    header("location:index.php");
}
?>
