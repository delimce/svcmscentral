<?php session_start();
$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();



		switch ($_REQUEST['nivel']) {
		case 1:
		   $tabla = 'cont_categoria';	
		   break;
		case 2:
		     $tabla = 'cont_subcategoria';	
		   break;
		case 3:
		     $tabla = 'cont_sub_subcategoria';	
		   break;
		}
		
 $actual = 	$tool->simple_db("select users from $tabla where id = '{$_REQUEST['id']}' ");	
 
 if($actual==1) $est = 0; else $est = 1; 

 $tool->query("update $tabla set users = '$est' where id = '{$_REQUEST['id']}' ");
 echo $est;
  

$tool->cerrar();

?>