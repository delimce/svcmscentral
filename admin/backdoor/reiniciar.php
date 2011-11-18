<?php session_start();

include("../../SVsystem/config/dbconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores


$re = new database();
$re->autoconexion();

$re->query("call sp_reiniciar_tablas ('{$_POST['cuenta'] }','{$_POST['url'] }') ");

$re->cerrar();



?>