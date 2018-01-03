<?php
function pre($str = "")
{
	echo '<pre>';
	print_r($str);
	echo '</pre>';
}

function pr($str = "")
{
	echo '<pre>';
	print_r($str);
	echo '</pre>';
}

function logger($text = "")
{
	$marca = date("h:m:s");	
	$path = '../log/log-' . date('Y-m-d') . '.log';
	if($ar=fopen($path,"a" )){
		fwrite($ar,"\n " . $marca. ": " . $text . " ");
		fclose($ar);
	}
}
?>
