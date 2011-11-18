<?php session_start();

include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores


	$tool = new tools('db');
	
	$dirs = $tool->array_query("select dirserver from cuenta");
	
	
	
	foreach($dirs as $valor){
	
							echo "<br>dando permisos a: $valor..."; 
							
							@chmod ('../../SVsitefiles.old/'.$valor, 0777);
							/******banner ***/
							@chmod ('../../SVsitefiles.old/'.$valor.'/banner', 0777);
							/******categorias ***/
							@chmod ('../../SVsitefiles.old/'.$valor.'/categoria', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/categoria/turn', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/categoria/orig', 0777);
							/******producto ***/
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/doc', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/med', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/orig', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/turn', 0777);
							/******producto ***/
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/doc', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/med', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/orig', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/producto/turn', 0777);
							/******contenido ***/
							@chmod ('../../SVsitefiles.old/'.$valor.'/contenido', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/contenido/doc', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/contenido/med', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/contenido/orig', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/contenido/turn', 0777);
							///////////usuarios
							@chmod ('../../SVsitefiles.old/'.$valor.'/usuario', 0777);
							@chmod ('../../SVsitefiles.old/'.$valor.'/usuario/doc', 0777);
							
							
		
	}
	
	$tool->cerrar();

?>