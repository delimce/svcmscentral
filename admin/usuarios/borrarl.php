<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

 $datos = new tools();

 
 if(!empty($_REQUEST['too'])){
	 
	  $estos = implode(',',$_REQUEST['too']); 
	 
	  $datos->autoconexion();
	  
	 		$datos->query("delete from cliente where id in ($estos) ");
	  		$datos->cerrar();
	  
	 $datos->javaviso('usuarios eliminados con exito');
	
 }else{
	 
	  $datos->javaviso('ERROR: Debe seleccionar al menos un usuario para poder eliminar con exito');
 }
 
 

 

 
 ?>
 <script type="text/javascript">
history.back();
</script>

 <?
 
 ?>