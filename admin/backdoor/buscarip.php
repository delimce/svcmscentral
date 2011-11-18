<?php session_start();

include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores

		$dominio = str_replace('http://','',$_POST['url']);
		echo gethostbyname($dominio);

?>