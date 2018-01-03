<html>
<h2>Cambiar estado de remito</h2>
<form method="GET">
<input type="text" value="" name="remito"/>
<input type="submit"/>
</form>

<?php
if(isset($_GET['remito']) && $_GET['remito'] != "")
{
	$sql = "update remito set estado_remi = 1 where id_remito = " . $_GET['remito'];
	mysql_connect("localhost", "root", "");
	mysql_select_db("fac_internet");
	mysql_query($sql);
	echo "Remito ".$_GET['remito']." en estado abierto";
}
?>