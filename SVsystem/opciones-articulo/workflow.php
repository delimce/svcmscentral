<?php session_start();

include("../../SVsystem/config/dbconfig.php"); ////////setup
include("../../SVsystem/class/tools.php");
 
 
 $datos = new tools();
 $datos->autoconexion();
 
 
		 switch ($_POST['tipo']) {
		case 1:
		   $data = $_POST['valor'];
		   $_SESSION['TITULOIT'] = $data;
		   break;
		case 2:
		
		   break;
		   
		}

 
$datos->cerrar();

?>