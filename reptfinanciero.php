<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<?php 
 include 'DAC/Database.class.php';
 include 'MODEL/Persona.php';

session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$persona=$persona->showPersona($id_persona);

?>


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
   
         <link rel="stylesheet" type="text/css" href="CSS_INTERNO/datagrid.css"/>
	<link rel="stylesheet" type="text/css" href="CSS_INTERNO/combo.css"/>
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->
<!--        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>-->
<script type="text/javascript" src="JS/jquery-1.6.2.min.js" ></script>
        <script type="text/javascript" src="JS/jquery.easyui.min.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
        <script type="text/javascript" src="MYJS/datagrid-detailview.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
        <script type="text/javascript" src="MYJS/ReptFinanciero.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> REPORTE FINANCIERO</a></li>
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
                                        <h2 class="box-header">REPORTE FINANCIERO </h2>
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
                                                                              <input id="btn_Buscar" class="button themed" type="button" 
                                                                   value="Buscar" name="btn_Buscar" />
                                                                     </td>
                                                                 </tr>
                                                                
                                                             </tbody>
                                                         </table>
                                                <hr/>
                                                <table id="dg" style="width:700px;height:250px" url="CONTROLLER/C_Factura.php?opc=8"  title="Reporte de Ventas" singleselect="true" fitcolumns="true">  
                                                        <thead>  
                                                            <tr>  
                                                                <th field="id_fact" width="80">Id Factura</th>  
                                                                <th field="obs_fact" width="100">Observación</th>  
                                                                <th field="descto_fact" align="right" width="80">Descuento</th>  
                                                                <th field="iva12_fact" align="right" width="80">Iva</th>  
                                                                <th field="total_fact" width="220">Total</th>  
                                                                <th field="fecemi_fact" width="60" align="center">Fecha</th>  
                                                            </tr>  
                                                        </thead>  
                                                    </table>  
                                                 <hr/>
                                                 
                                                 <table id="tt" style="width:700px;height:250px" url="CONTROLLER/C_Compra.php?opc=8"  title="Reporte de Compras" singleselect="true" fitcolumns="true">  
                                                        <thead>  
                                                            <tr>  
                                                                <th field="id_compra" width="80">Id Compra</th> 
                                                                <th field="fec_compra" width="60" align="center">Fecha</th>  
                                                                <th field="obs_compra" width="100">Observación</th>                                  
                                                                <th field="baseGrava_compra" align="right" width="80">Iva</th>  
                                                                <th field="total_compra" width="220">Total</th>  
                                                                
                                                            </tr>  
                                                        </thead>  
                                                  </table> 
                                                 
                                                 <hr/>
                                                 <table id="tg" style="width:700px;height:250px"  title="Reporte de Gastos" singleselect="true" fitcolumns="true" showFooter="true">  
                                                        <thead>  
                                                            <tr>  
                                                                <th field="id_gasto" width="80">Id Gasto</th> 
                                                                <th field="fecha_gast" width="60" align="center">Fecha</th>  
                                                                <th field="descrip_gast" width="100">Observación</th>                                  
                                                                <th field="iva_gast" align="right" width="80">Iva</th>  
                                                                <th field="cant_gast" width="220">Total</th>  
                                                                
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
}else{
    header("location:index.php");
}
?>
