<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

	$tool = new formulario();
	$tool->autoconexion();
	
	
	if(isset($_REQUEST['borrar'])){
	
		$tool->query("SET AUTOCOMMIT=0"); ////iniciando la transaccion
		$tool->query("START TRANSACTION");	
		$tool->query("delete from artxcat where id = '{$_REQUEST['borrar']}' ");
		if(!empty($_REQUEST['orden']))$tool->query("update artxcat set orden = orden-1 where orden > {$_REQUEST['orden']} ");
		$tool->query("COMMIT");
		$tool->redirect('bloques_aec.php');

	
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Index</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>


<script language="JavaScript" type="text/JavaScript">
function ordenar_art(orden,id,sentido){
	
	  
	  location.replace('bloques_aec.php');
	  ajaxsend("post","ordenar_aec.php","orden="+orden+"&id="+id+"&se="+sentido);
	  
	  
	 
	}



//-->
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>


</head>

<body style="background-image:none;">

 			<?php 
			 
			 $tool->query("select * from artxcat order by orden ");
			 $ART = $tool->nreg;
			 if($tool->nreg>0){
			 
			 ?>
             
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="37%" class="td-headertabla3">T&iacute;tulo del bloque</td>
    <td width="40%" class="td-headertabla3">Categor&iacute;a fuente</td>
    <td width="8%" class="td-headertabla3"># de &iacute;tems</td>
    <td width="15%" class="td-headertabla3">Opciones</td>
  </tr>
  <?php 
			 
			 $ii=0;
			 while ($row = mysql_fetch_assoc($tool->result)) { 
			 
			 				
			 
			 ?>
  <tr>
    <td class="td-content"><?php echo $row['titulo'] ?></td>
    <td class="td-content"><?php echo $row['catego'] ?></td>
    <td align="center" class="td-content"><?php echo $row['cantidad'] ?></td>
    <td class="td-content"><a href="javascript:location.replace('bloques_aec.php?borrar=<?php echo $row['id'] ?>&orden=<?php echo $row['orden'] ?>');" title="borrar este bloque (no borra el contenido)"><img src="../icon/icon-delete.gif" width="16" height="16" border="0"></a> <a href="javascript:;" onClick="MM_openBrWindow('popup-editar-aec.php?id=<?php echo $row['id'] ?>','','scrollbars=yes,resizable=yes,width=700,height=400')" title="editar caracter&iacute;sticas de este bloque"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a>
        <?php if($ii!=0){?>
        <img style="cursor:pointer" onClick="ordenar_art('<? echo $row['orden']?>','<?=$row['id'] ?>','u');" title="mover hacia arriba" src="../icon/icon-up.gif" width="16" height="16" border="0">
        <?php } ?>
        <?php if($ii!=$ART-1){?>
        <img style="cursor:pointer" onClick="ordenar_art('<? echo $row['orden']?>','<?=$row['id'] ?>','d');" title="mover hacia abajo" src="../icon/icon-down.gif" width="16" height="16" border="0">
        <?php } ?>
    </td>
  </tr>
  <?php
			 
			 $ii++;
			 
			  } ?>
</table>

 	<?php } ?>
    
</body>
</html>
