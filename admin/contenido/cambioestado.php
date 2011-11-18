<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

$tool->query("update preferencias set estatus_art = '{$_REQUEST['estado']}' ");
$tool->cerrar();

?>