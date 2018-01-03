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
        <!--link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/>
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/>
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->
        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
        <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
        <script type="text/javascript" src="MYJS/Ganancia.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Porcentaje de Ganancia</a></li>
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
                                        <h2 class="box-header">GANANCIA </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">NUEVO</a></li>
                                                <li class="tab"><a href="#tabs-2">MODIFICAR</a></li>
                                                <li class="tab"><a href="#tabs-3">ELIMINAR</a></li>
                                            </ul>
                                        
                                        <div class="box-content">     
                                            <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                  <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                            
                                            <div id="dialg_form" class="dialog" title="SYSFACTURA INFORMA">   
                                                
                                                <form id="frmGanancia_Update" method="post" action="">
                                                    <input type="hidden" id="update_id_ganancia" name="update_id_ganancia" value="" />
                                                    
                                                    <label class="form-label required"> Porcentaje de Ganancia </label>
			                            <input id="update_porctj_ganancia" class="form-field width40" 
                                                    name="update_porctj_ganancia" type="text" value="" maxlength="100"/>
                                                    
                                                    <label class="form-label required"> Descripción </label>
			                            <input id="update_descrip_ganancia" class="form-field width80" 
                                                    name="update_descrip_ganancia" type="text" value="" maxlength="100"/>
                                                    <hr/>
                                                     <p class="fr">
				                    <input id="btn_Ganancia_Cancelar" class="button themed" type="submit" 
                                                    value="Cancelar" name="btn_Ganancia_Cancelar" />
                                                    <input id="btn_Ganancia_Update" class="button themed" type="submit" 
                                                    value="Actualizar" name="btn_Ganancia_Update" />
                                                    </p>
                                                </form>
                                               
                                            </div>
                                            
                                            <div id="tabs-1">
                                                 <form id="frmGanancia_Add" method="post" action="">
                                                    <label class="form-label required"> Porcentaje de Ganancia </label>
			                            <input id="save_porctj_ganancia" class="form-field width40" 
                                                    name="save_porctj_ganancia" type="text" value="" maxlength="100"/>
                                                    <label class="form-label required"> Descripción </label>
			                            <input id="save_descrip_ganancia" class="form-field width60" 
                                                    name="save_descrip_ganancia" type="text" value="" maxlength="100"/>
                                                    
                                                    <p>
                                                   <input id="btn_Ganancia_New" class="button themed" type="submit" 
                                                   value="Nuevo" name="btn_Ganancia_New" />
                                                   <input id="validate" class="button themed" type="submit" 
                                                   value="Guardar" name="btn_Ganancia_Add" />
                                                    </p>
                                                </form>
                                              
                                            </div>
                                            
                                                <div id="tabs-2">
<!--                                                    <input id="btn_html" class="button themed" type="button" 
                                                   value="Add html" name="btn_html" />-->
                                                    
                                                     <form id="frmGanancia_Buscar" method="post" action="">
                                                      <label class="form-label required"> Búsquedad por Porcentaje</label>
                                                     <input id="txt_Buscar_Modificar" class="form-field width40" 
                                                    name="txt_Buscar_Modificar" type="text" value="" maxlength="100"/>
                                                      <input id="btn_Ganancia_Buscar" class="button themed" type="submit" 
                                                   value="Buscar" name="btn_Ganancia_Buscar" />
                                                     </form>
                                                    <hr/>
                                                    <div id="tabla_result"></div>
                                                 
                                                    
                                                </div>
                                            
                                                <div id="tabs-3">
                                                    
                                                    <form id="frmGanancia_Buscar_Delete" method="post" action="">
                                                      <label class="form-label required"> Búsquedad por Porcentaje</label>
                                                     <input id="txt_Buscar_Delete" class="form-field width40" 
                                                    name="txt_Buscar_Delete" type="text" value="" maxlength="100"/>
                                                      <input id="btn_Ganancia_Buscar_Delete" class="button themed" type="submit" 
                                                   value="Buscar" name="btn_Ganancia_Buscar_Delete" />
                                                     </form>
                                                    <div id="tabla_result_delete"></div>
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

