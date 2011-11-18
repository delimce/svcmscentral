<?php session_start();

include("../../SVsystem/config/dbconfig.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();

$orden = $_REQUEST['orden'];

	if($_REQUEST['se']=='u'){
	
	$id = $tool->simple_db("select id from artxcat where orden = $orden-1 ");
	$tool->query("update artxcat set orden = orden-1 where orden = $orden ");
	
	
	
	}else{
	
	$id = $tool->simple_db("select id from artxcat where orden = $orden+1 ");
	$tool->query("update artxcat set orden = orden+1 where orden = $orden ");
	
	
	}
	
	
	$tool->query("update artxcat set orden = $orden where id = $id ");


$tool->cerrar();



?>