<?php session_start(); 

	$ruta = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/orig/'.$_REQUEST['file'];

	if(file_exists($ruta)) echo 1; else echo 0;

?>