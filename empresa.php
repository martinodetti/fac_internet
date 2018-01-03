
<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<?php 
 include 'DAC/Database.class.php';
 include 'MODEL/Persona.php';
 include 'MODEL/Ciudad.php';
 include 'MODEL/Empresa.php';

session_start();

if(isset ($_SESSION['id_persona'])){
 $id_persona=$_SESSION['id_persona'];   
$persona=new persona();
$Ciudad=new ciudad();
$arr_ciudad=$Ciudad->listCiudads();
$persona=$persona->showPersona($id_persona);
$clsEmpresa=new empresa();
$clsEmpresa=$clsEmpresa->showEmpresa(1);
$arr_persona=$persona->ComboTrabajador();
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
<!--        <link type="text/css" rel="stylesheet" href="CSS_INTERNO/csspantalla.css" />-->
        <script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
         <script type="text/javascript" src="JS/jquery.livequery.js" ></script>
        <script type="text/javascript" src="JS/jquery.validate.js" ></script>
         <script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>
        <script type="text/javascript" src="MYJS/Empresa.js" ></script>


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
                            <li><a class="breadcrumb underline" href="#">Home -> Empresa</a></li>
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
                                        <h2 class="box-header">EMPRESA </h2>
                                          <ul class="tabs-nav">
                                                <li class="tab"><a href="#tabs-1">MODIFICAR</a></li>
                                            </ul>
                                        
                                        <div class="box-content">  
                                             <div id="dialg_msg" class="dialog" title="SYSFACTURA INFORMA">     
                                                  <span id="msg" class="message success"></span>
                                                <p class="fr"></p>
				                <a id="dial_msg_close" class="button themed closer">Aceptar</a>
                                            </div>
                                           
                                            <div id="tabs-1">
                                                
                                                 <form id="frmEmpresa_Update" method="post" action="">
                                                     <input type="hidden" id="update_id_empresa" name="update_id_empresa" value="<?php echo $clsEmpresa->get_id_empresa();?>" />
                                                     <input type="hidden" id="id_contador" name="id_contador" value="<?php echo $clsEmpresa->get_id_contador();?>" />
                                                     <input type="hidden" id="id_representante" name="id_representante" value="<?php echo $clsEmpresa->get_id_representante();?>" />
                                                     <input type="hidden" id="id_ciudad" name="id_ciudad" value="<?php echo $clsEmpresa->get_id_ciudad();?>" />
                                                  <table border="0"  width="880" cellspacing="80">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%"></th>
                                                                <th style="width: 50%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                                           
                                                                <tr>
                                                                    <td >
                                                                        <label class="form-label required"> Razón Social </label>
                                                                         <input id="update_razsocial_empresa" class="form-field width90" 
                                                                                name="update_razsocial_empresa" type="text" value="<?php echo $clsEmpresa->get_razsocial_empresa();?>" maxlength="100"/>
                                                                    </td>    
                                                                    <td >
                                                                        <label class="form-label required"> RUC </label>
                                                                         <input id="update_ruc_empresa" class="form-field width90" 
                                                                                name="update_ruc_empresa" type="text" value="<?php echo $clsEmpresa->get_ruc_empresa(); ?>" maxlength="100"/>
                                                                    </td>    
                                                                </tr>                                                         
                                                                                                              
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Ciudad </label>
                                                                          <select id="update_id_ciudad" name="update_id_ciudad" class="form-field width40">
                                                                            <?php foreach($arr_ciudad as $Ciudad){?>
                                                                              <option value="<?php echo $Ciudad->get_id_ciudad()?>"><?php echo $Ciudad->get_nom_ciudad()?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                    <td>
                                                                       <label class="form-label required"> Contador </label>
                                                                          <select id="update_id_contador" name="update_id_contador" class="form-field width40">
                                                                            <?php foreach($arr_persona as $persona){?>
                                                                              <option value="<?php echo $persona->get_id_persona();?>"><?php $nom_ape=$persona->get_nom_persona().' '.$persona->get_ape_persona();echo $nom_ape;?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Representante </label>
                                                                         <select id="update_id_representante" name="update_id_representante" class="form-field width40">
                                                                            <?php foreach($arr_persona as $persona){?>
                                                                              <option value="<?php echo $persona->get_id_persona();?>"><?php $nom_ape=$persona->get_nom_persona().' '.$persona->get_ape_persona();echo $nom_ape;?></option>
                                                                              <?php } ?>
                                                                        </select> 
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Celular</label>
                                                                         <input id="update_cel_empresa" class="form-field width80" 
                                                                                name="update_cel_empresa" type="text" value="<?php echo $clsEmpresa->get_cel_empresa(); ?>" maxlength="9"/>
                                                                    </td>
                                                                </tr>                                                         
                                                                <tr>
                                                                    <td>
                                                                        <label class="form-label required"> Teléfono </label>
                                                                           <input id="update_telf_empresa" class="form-field width80" 
                                                                                  name="update_telf_empresa" type="text" value="<?php echo $clsEmpresa->get_telf_empresa(); ?>" maxlength="7"/>
                                                                    </td>
                                                                    <td>
                                                                        <label class="form-label required"> Sitio Web</label>
                                                                         <input id="update_web_empresa" class="form-field width80" 
                                                                                name="update_web_empresa" type="text" value="<?php echo $clsEmpresa->get_web_empresa(); ?>" maxlength="50"/>
                                                                    </td>
                                                                </tr>   
                                                                <tr >
                                                                    <td colspan="2">
                                                                         <label class="form-label required"> Correo </label>
                                                                          <input id="update_correo_empresa" class="form-field width50" 
                                                                                 name="update_correo_empresa" type="text" value="<?php echo $clsEmpresa->get_correo_empresa(); ?>" maxlength="50"/>
                                                                    </td>
                                                                </tr>
                                                                <tr >
                                                                    <td colspan="2">
                                                                         <label class="form-label required"> Dirección </label>
                                                                          <input id="update_direc_empresa" class="form-field width90" 
                                                                                 name="update_direc_empresa" type="text" value="<?php echo $clsEmpresa->get_direc_empresa(); ?>" maxlength="150"/>
                                                                    </td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                  <p>
                                                
                                                   <input id="btn_Empresa_Update" class="button themed" type="submit" 
                                                   value="Actualizar" name="btn_Empresa_Update" />
                                                    </p>
                                                   </form>

                                               
                                                
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

