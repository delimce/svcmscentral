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
<link href="estilos.css" rel="stylesheet" type="text/css">
<div id="botonera1" style="position:absolute; left:12px; top:104px; width:657px; height:13px; z-index:1;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="td-barra1">
<!--BOTON MAIN-->
<a href="main.php" class="link-blanco" title="ir a la página principal">home</a> &nbsp; &#8226; &nbsp;
<a href="edit_index/editar-index.php" class="link-blanco" title="editar index o página principal">editar index</a> &nbsp; &#8226; &nbsp;
<!--FIN BOTON MAIN-->

<!--MODULOS PERMITIDOS; DINAMICOS-->
<? for ($i=0;$i<count($modulos);$i++){


$_SESSION['MODULOS'][$i] = $modulos[$i]['id']; ///modulos permitidos

	if($i>0) echo '&nbsp; &#8226; &nbsp;';

 ?>
 <a href="<?=$modulos[$i]['ruta'] ?>" class="link-blanco"  title="<?=$modulos[$i]['nombre'] ?>"> <?=$modulos[$i]['alias'] ?></a>
<? } ?>

<?php if($_SESSION['ESADMIN']==1){ ?> &nbsp; &#8226; &nbsp; <a href="backdoor/index.php" title="administracíon" target="_self" class="link-blanco">administrador</a><?php } ?>&nbsp; &#8226; &nbsp;

<!--FIN MODULOS PERMITIDOS; DINAMICOS-->

<a href="opciones.php" class="link-blanco" title="opciones generales del sistema">opciones </a> 



</td>
</tr>
</table>
</div>
