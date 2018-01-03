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
        <script type="text/javascript" src="MYJS/Gastos.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> GASTOS</a></li>
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
                                        <h2 class="box-header">GASTOS </h2>
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
                                                  
                                                <form id="frmGastos_Add">
                                                    
                                                    <input type="hidden" id="save_iva_gast" name="save_iva_gast" value="" />
                                                    <input type="hidden" id="save_cant_gast" name="save_cant_gast" value="" />
                                                    
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
                                                                       <label class="form-label required" > Codigo Factura:</label>
                                                                       <input type="text" id="save_id_factura"  name="save_id_factura"  class="form-field width80" maxlength="15"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Fecha:</label>  
                                                                          <input id="save_fecha_gast" class="form-field datepicker"
                                                                            name="save_fecha_gast" type="text"  />
                                                                    </td>
                                                                       
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                      <label class="form-label required"> Proveedor :</label>   
                                                                        <input id="save_nom_empresa_gast" class="form-field width80" 
                                                                       name="save_nom_empresa_gast" type="text" value="" maxlength="100"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required">Nombre Comprador:</label>
                                                                        <input id="save_nom_comp_gast" name="save_nom_comp_gast"
                                                                          class="form-field width80" type="text" value="" maxlength="30"/>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                      <label class="form-label required"> Por concepto de :</label>  
                                                                      <input id="save_descrip_gast" class="form-field width90" 
                                                                       name="save_descrip_gast" type="text" value="" maxlength="190"/>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                     <div id="div_aux" style="display: none" >
                                                        <input id="btn_aux" name="btn_aux" type="submit" value="Auxiliar" />
                                                     </div>
                                                </form>
                                                 <hr/>
                                                 <form id="frm_AddProducto" >
                                                     
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
                                                                        <label class="form-label required">Nombre del Producto:</label>  
                                                                        <input id="txt_nomproduc" class="form-field width90" 
                                                                        name="txt_nomproduc" type="text" value="" maxlength="50"/> 
                                                                     </td>
                                                                     
                                                                     <td>
                                                                         <label class="form-label required">Costo:</label>  
                                                                         <input id="txt_precio" class="form-field width60" 
                                                                        name="txt_precio" type="text" value="" maxlength="6"/>
                                                                     </td>
                                                                     <td>
                                                                         <label class="form-label required">Cantidad:</label>  
                                                                         <input id="txt_cantidad" class="form-field width60" 
                                                                       name="txt_cantidad" type="text" value="" maxlength="6"/>
                                                                     </td>
                                                                     <td>
                                                                        <label class="form-label required">Total:</label>  
                                                                         <input id="txt_sub" class="form-field width60" 
                                                                                name="txt_sub" readonly="true" type="text" value="" maxlength="20"/> 
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
                                                 
                                                  <input id="btn_AddProducto" class="button themed" type="button" 
                                                                   value="Agregar" name="btn_AddProducto" />
                                                   <input id="btn_QuitarProducto" class="button themed" type="button" 
                                                                   value="Quitar" name="btn_QuitarProducto" />
                                                   
                                                   
                                                 <hr/>
                                                
                                               
                                                  <table id="tt" class="easyui-datagrid" style="width:700px;height:250px"
                                                           fitColumns="true"	title="Detalle de Gastos"  singleSelect="true" showFooter="true"
                                                           rownumbers="true" >
                                                        <thead>
                                                            <tr>
                                                                <!--<th field="id" width="80">ID</th>-->
                                                                <th field="producto" width="120">Producto</th>
                                                                <th field="precio" width="120">Precio</th>
                                                                <th field="cantidad" width="120">Cantidad</th>
                                                                <th field="total" width="120">subtotal</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                 <hr/>
                                                  <input id="btn_gasto_Add" class="fr button themed" type="button" 
                                                                   value="Guardar Gastos" name="btn_gasto_Add" />
                                                  
                                                <input id="btn_gasto_New" class="fl button themed" type="button" 
                                                                   value="Nuevo" name="btn_gasto_New" />
                                             
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
