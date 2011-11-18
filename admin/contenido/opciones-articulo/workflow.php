<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../../SVsystem/config/setup.php"); ////////setup
include("../../../SVsystem/class/tools.php");
require("../security.php"); //////// solo accesible para administradores
 
 
 $datos = new tools();
 $datos->autoconexion();
 
 
		 switch ($_POST['tipo']) {
		case 1:
		   $data = $_POST['valor'];
		   $_SESSION['TITULOIT'] = $data;
		   break;
		case 2:
		   $datos->query("update admin set activo = '{$_POST['valor']}' where id = '{$_POST['id']}'");
		   break;
		   
		}

 
$datos->cerrar();

?>