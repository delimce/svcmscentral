<?php session_start();

include("../../SVsystem/config/dbconfig.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();

$tool->query("delete from orden_compra where id = {$_REQUEST['id']} ");

$tool->cerrar();



?>