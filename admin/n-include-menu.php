<?
	if(!empty($_SESSION['SERVICIO'])){
	
	
		include("../SVsystem/config/masterconfig.php"); ////////se conecta a la base de datos central
		$tool->autoconexion();
		
		$modulos = $tool->estructura_db("SELECT 
		  s.id,
		  s.alias,
		  s.nombre,
		  s.ruta
			FROM                  
			servicio s
			where s.id in ({$_SESSION['SERVICIO']})");
			
	}	
	
	
	include("../SVsystem/config/dbconfig.php"); ////////base de datos ocasional
	$tool->autoconexion();
  
 
   unset($_SESSION['MODULOS']); 

?>

<a href="./main.php" title="ir a la p�gina principal" class="especial">[^] Volver al inicio</a>
<a href="./opciones.php" title="opciones del sistema" class="especial">opciones</a>
<a href="./edit_index/editar-index.php" title="editar index o  home page del web site" >editar index</a>
  


<!--MODULOS PERMITIDOS; DINAMICOS-->
<? for ($i=0;$i<count($modulos);$i++){


$_SESSION['MODULOS'][$i] = $modulos[$i]['id']; ///modulos permitidos

	if($i>0) echo '';

 ?>
 <a href="<?=$modulos[$i]['ruta'] ?>" title="<?=$modulos[$i]['nombre'] ?>"> <?=$modulos[$i]['alias'] ?></a>
<? } ?>

<?php if($_SESSION['ESADMIN']==1){ ?> <a href="backdoor/index.php" title="administrac�on">admin</a><?php } ?>

<!--FIN MODULOS PERMITIDOS; DINAMICOS-->







