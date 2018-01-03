<html>
<h2>Cambiar estado de orden de reparacion</h2>
<form method="GET">
<input type="text" value="" name="orden"/>
<input type="submit"/>
</form>

<?php
if(isset($_GET['orden']) && $_GET['orden'] != "")
{
	$sql = "update orden_reparacion set estado = 1 where id_orden = " . $_GET['orden'];
	mysql_connect("localhost", "root", "");
	mysql_select_db("fac_internet");
	mysql_query($sql);
	echo "Orden de reparacion ".$_GET['orden']." en estado abierto";
}
?>