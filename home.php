<?php
include_once 'CONTROLLER/C_Debug.php';
include 'DAC/Database.class.php';
include 'MODEL/Persona.php';
include 'MODEL/V_acceso_modulo.php';
include 'MODEL/Producto.php';
session_start();
if(!isset($_SESSION['id_persona'])){
    header('Location: index.php');
    exit();
}
?>

<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>

        <meta name="robots" content="index"/>
        <meta name="keywords" content="UTMACH "/>
        <meta name="description" content=""/>
        <meta name="generator" content="Bluefish 2.2.3" />
        <title>FRENOS OESTE </title>

        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>

        <!--link rel="stylesheet" href="CSS_OTHER/general_sht.css" type="text/css"/-->
        <link rel="stylesheet"  href="CSS_INTERNO/layout.css" type="text/css"/> 
        <link rel="stylesheet"  href="CSS_INTERNO/layout2.css" type="text/css"/> 
        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />
        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
        <script type="text/javascript" src="JS/custom.js" ></script>
         <script type="text/javascript" src="JS/jquery.cmenu.js" ></script>
         <script type="text/javascript" src="MYJS/Tema.js" ></script>

    </head>
    <body>
    
<?php 
 

$id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$v_mod_acc=new v_acceso_modulo();
$persona=$persona->showPersona($id_persona);
//array de mdluos

$arr_acceso=array();
$arr_acceso=$v_mod_acc->listV_acceso_modulos($id_persona);
$producto = new producto();
$prod_en_cero = $producto->getPreductoPrecioVtaIgualCero();
$prod_vta_costo = $producto->getProductoPrecioVtaIgualCosto();

?>

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
                            <li><a class="button gray fl" title="Salir del sistema" href="#" ><span class="icon_single preview"></span></a></li>
                            <li class="s_1"></li>
                            <li class="logo"><strong></strong></li>
                            
                            <li><a class="breadcrumb underline" href="#">Home</a></li>
                            <li class="fr"><a class="button gray fl" title="logout" href="CONTROLLER/Salir.php" >
                                    <span class="icon_text logout"></span>Salir</a></li>
                            <li class="s_1 fr"></li>
                           
                        
                            <li class="fr"><a class="button gray fl" title="admin" href="#"><span class="icon_text admin"></span><?php echo $persona->get_nom_persona() ?></a></li>
                            <li class="fr"><a id="logged">Logeado como:</a></li>
                            <!--li class="clear">
                            </li-->
                        </ul>


                    </div>
                    <div>
                    	<?php if ($prod_en_cero > 0){?>
	                    	<label style="color:#FF0000">Hay productos con precio de venta igual a 0 (cero)</label>
                            <a href="producto_cero.php">VER AQUI</a>
	                    <?php } ?>
                    </div>
                    <div>
                        <?php if ($prod_vta_costo > 0){?>
                            <label style="color:#FF0000">Hay productos con precio de venta igual al costo</label>
                            <a href="producto_fallidos.php">VER AQUI</a>
                        <?php } ?>
                    </div>
                    
                    <!--fin de cabecera-->
                        <!-- contentLayout va aqui con todo lo que tiene wilfo-->
                        <div class="contentLayout">
                            <div id="content" >
                                <?php if(count($arr_acceso)>=1){ 
                                    foreach($arr_acceso as $v_mod_acc){
                                 ?>
                                <div class="column full ">
                                    <div class="box themed_box">
                                        <h2 class="box-header">	<?php echo $v_mod_acc->get_nom_modulo(); ?>  </h2>
                                        <div class="box-content">                                        
                                                <div class="contentLayoutSNS">
                                                    <div class="sidebar1">
                                                        <!--Inicio de widget convocatoria(todo el widget)****************************-->
                                                        <div class="Block">                                                            
                                                        </div>
                                                    </div>
                                                    <!--Inicio Content de la pagina donde se muestra todo-->
                                                    <div id="div-1" class="content">
                                                        <?php 
                                                        $modulos=array();
                                                        $modulos=$v_mod_acc->listV_modulos_hijos($id_persona, $v_mod_acc->get_id_modulo());
                                                        if(count($modulos)>=1){
                                                        ?>
                                                         <ul class="menu">
                                                            <?php foreach ($modulos as $v_mod_acc) { ?>
                                                                <li  action="<?php echo $v_mod_acc->get_url_modulo(); ?>?mod=<?php echo $v_mod_acc->get_id_modulo(); ?>" label="<?php echo $v_mod_acc->get_nom_modulo(); ?>">
                                                                    <div class="etiqueta" style="display: block">
                                                                    	<label><?php echo $v_mod_acc->get_nom_modulo(); ?></label>
                                                                    </div>
                                                                    <img src="IMGBKEND/<?php echo $v_mod_acc->get_img_modulo(); ?>" />    
                                                                </li>
                                                            <?php } ?> 
                                                    
                                                        </ul>
                                                        <?php } ?>
                                                    </div>    
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                    </div>
                                </div>
                                <?php    
                                         }
                                     } 
                                ?>
                            </div>
                        </div>

                    <div class="cleared"></div><!-- Limpio divs-->


                </div>
            </div>


            <!-- fin del sheet -->


        </div>


    </body>
</html>
