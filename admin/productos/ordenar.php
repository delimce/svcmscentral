<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();

$orden = $_REQUEST['orden'];

	if($_REQUEST['se']=='u'){

	$id = $tool->simple_db("select id from {$_REQUEST['tabla']} where orden = $orden-1 ");
	$tool->query("update {$_REQUEST['tabla']} set orden = orden-1 where orden = $orden ");


	}else{

	$id = $tool->simple_db("select id from {$_REQUEST['tabla']} where orden = $orden+1 ");
	$tool->query("update {$_REQUEST['tabla']} set orden = orden+1 where orden = $orden ");


	}


	$tool->query("update {$_REQUEST['tabla']} set orden = $orden where id = $id ");


$tool->cerrar();



?>