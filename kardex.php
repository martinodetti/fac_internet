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
          <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
        <script type="text/javascript" src="MYJS/Kardex.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Marca</a></li>
                            <li class="fr"><a class="button gray fl" title="logout" href="CONTROLLER/Salir.php" >
                                    <span class="icon_text logout"></span>Salir</a></li>
                            <li class="s_1 fr"></li>
                            
<!--                            <li class="s_1 fr"></li>-->
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
                                        <h2 class="box-header">REPORTE DE KARDEX </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">VER</a></li>
                                            </ul>
                                        
                                        <div class="box-content"> 
                                            
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                  <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                             
                                             <div id="tabs-1">
                                                 
                                                 <form id="frm_buscar">
                                                     <input type="hidden" id="txt_id_producto" name="txt_id_producto" value="" />
                                                     <table border="0">
                                                          <thead>
                                                            <tr>
                                                                <th style="width: 50%"></th>
                                                                <th style="width: 30%"></th>
                                                                <th style="width: 30%"></th>
                                                            </tr>
                                                        </thead>
                                                             <tbody>
                                                                 <tr>
                                                                     <td>
                                                                      <label class="form-label required"> Producto :</label>
                                                                        <input id="cmbgrid" name="cmbgrid"   />
                                                                     </td>
                                                                     <td>
                                                                         <label class="form-label required"> Fecha de Inicial </label>
                                                                          <input id="fec_ini" name="fec_ini" class="form-field datepicker" type="text"/>
                                                                     </td>
                                                                     <td>
                                                                         <label class="form-label required"> Fecha de Final </label>
                                                                          <input id="fec_final" name="fec_final" class="form-field datepicker" type="text"/>
                                                                     </td>
                                                                 </tr>
                                                                 
                                                             </tbody>
                                                         </table>
                                                     <hr/>
                                                      <input id="btn_Buscar" class="button themed" type="button" 
                                                                   value="Buscar" name="btn_Buscar" />
                                                 </form>
                                                 <hr/>
                                                 <div id="tabla_result">
                                                     <table id="dt_example" class="display"  border="0">
                                                             <thead>
                                                                 <tr>
                                                                     <th style="width: 100px" rowspan="2" scope="col">Fecha</th>
                                                                     <th style="width: 250px"   colspan="3" scope="col">Entradas</th>
                                                                     <th style="width: 250px" colspan="3" scope="col">Salidas</th> 
                                                                      <th style="width:100px" rowspan="2" scope="col">En Stock</th>
                                                                 </tr>
                                                                 <tr>
                                                                     <th style="width: 80px" scope="col">C</th>
                                                                     <th style="width: 80px"   scope="col">V.U</th>
                                                                     <th style="width: 80px"   scope="col">V.T</th>
                                                                     <th style="width: 80px"  scope="col">C</th>
                                                                     <th style="width: 80px"  scope="col">V.U</th>
                                                                     <th style="width: 80px"  scope="col">V.T</th>                                                     
                                                                 </tr>
                                                             </thead>
                                                             <tfoot>
                                                                 <tr>
                                                                     <th colspan="6"></th>
                                                                     <th>Total :</th>
                                                                     <th>0</th>
                                                                    
                                                                 </tr>
                                                             </tfoot>
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
}else{
    header("location:index.php");
}
?>
