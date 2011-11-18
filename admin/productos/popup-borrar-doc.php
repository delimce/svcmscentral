<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");


	
	/////////////////borrar el anterior
	
	
	if(!empty($_POST['archivo'])){
		
		@unlink('../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/doc/'.$_POST['archivo']);
		
	}
	

?>