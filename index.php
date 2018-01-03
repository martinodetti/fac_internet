<?php 
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title> SISTEMA DE FACTURACIÓN ONLINE</title>
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/jquery.ui.all.css"  media="screen"/>
<!--			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/table_data.css"  media="screen"/>-->
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/style.css"  media="screen"/>
			<link rel="stylesheet" type="text/css" href="CSS_INTERNO/style-1.css"  title="style_blue" media="screen"/>

			<script type="text/javascript" src="JS/jquery-1.4.2.js" ></script>
			<script type="text/javascript" src="JS/jquery-ui-1.8.2.js" ></script>
<!--			<script type="text/javascript" src="JS/jquery.fancybox-1.3.2.js" ></script>-->
			<script type="text/javascript" src="JS/jquery.validate.js" ></script>
			<!--script type="text/javascript" src="JS/jquery.wysiwyg.js"  ></script-->
			<!---script type="text/javascript" src="JS/jquery.dataTables.js" ></script-->
<!--			<script type="text/javascript" src="JS/jquery.flot.js" ></script>
			<script type="text/javascript" src="JS/jquery.flot.stack.js" ></script>-->
			<!--script type="text/javascript" src="JS/styleswitch.js" ></script-->
			<script type="text/javascript" src="MYJS/Login.js" ></script>
	</head>
<body>

<div id="wrapper">
      <ul id="topbar">
        <li class="logo"><strong>SISTEMA DE FACTURACIÓN ONLINE</strong> </li>
      </ul>
	<div id="content-login">
	<img style="width: 342px" src="IMGBKEND/LOGO.png"></img>
	<form id="box-login" name="box-login"  method="POST">
		<p>
			<label class="req"> Usuario</label>
			<br/>
			<input type="text" name="username" value="" id="username"/>
		</p>
		<p>
			<label class="req"> Clave </label>
			<br/>
			<input type="password" name="password" value="" id="password"/>
		</p>
		<p class="fr">
		<input type="button" value="Login" class="button themed" id="login" name="login"/>
		</p>
		<div class="clear"></div>
	</form>
	<span class="message error">Error al acceder <strong>Nick</strong> y/o <strong>Clave</strong> son incorrectas. </span>
 <!--	<span class="message  information">Just press <strong>Login</strong> or <strong>Error Test</strong></span> -->
	</div>
</div>


</body>
</html>
