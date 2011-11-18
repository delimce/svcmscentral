<?php session_start();
$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
//include('../../SVsystem/config/dbconfig.php');
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();
		
 $actual = 	$tool->simple_db("select estatus from articulo where id = '{$_REQUEST['id']}' ");	
 
 if($actual==1) $est = 0; else $est = 1; 

 $tool->query("update articulo set estatus = '$est' where id = '{$_REQUEST['id']}' ");
 echo $est;
  

$tool->cerrar();

?>