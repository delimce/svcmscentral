<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/class/tools.php");

$salir = new tools();
session_destroy();

$salir->redirect("index.php");


?>
