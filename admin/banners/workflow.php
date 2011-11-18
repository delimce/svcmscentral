<?php session_start();

include("../../SVsystem/config/dbconfig.php"); ////////setup
include("../../SVsystem/class/tools.php");
 
 
 $datos = new tools();
 $datos->autoconexion();
 
 
		switch ($_POST['tipo']) {
		
			case 0: //editar codigo
			   
				$datos->query("update banner set cliks = cliks+1 where id = '{$_POST['id']}'");
			    break;
			   
			case 1: //editar codigo
			   
				$datos->query("update banner set codigo = '$data' where id = '{$_POST['id']}'");
			    break;   
			   
			case 2:
			   $datos->query("update banner set views = 0, cliks = 0 where id = '{$_POST['id']}'");
			   
			   break;
				   
		}

 
$datos->cerrar();

?>
