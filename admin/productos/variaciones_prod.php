<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");


if(isset($_REQUEST['prod_id']) && !isset($_SESSION['VARIACION_valor'])){

	
	
	$tool = new tools();
	$tool->autoconexion();
	
	$varias = $tool->array_query("select variacion from prod_varia where prod_id = '{$_REQUEST['prod_id']}' ");
	
	if($tool->nreg>0)  $_SESSION['VARIACION_valor'] = $varias;
	
	$tool->cerrar();
	
	
	

}else if(isset($_REQUEST['borrar'])){


	for($i=$_REQUEST['borrar'];$i<count($_SESSION['VARIACION_valor']);$i++){


		$_SESSION['VARIACION_valor'][$i] = $_SESSION['VARIACION_valor'][$i+1];



	}

	array_pop ($_SESSION['VARIACION_valor']);


}else if (isset($_REQUEST['orden'])){

	if($_REQUEST['sent']=="u" && $_SESSION['VARIACION_valor'][$_REQUEST['orden']-1]!=''){
		
		$temp = $_SESSION['VARIACION_valor'][$_REQUEST['orden']-1];
		$_SESSION['VARIACION_valor'][$_REQUEST['orden']-1] = $_SESSION['VARIACION_valor'][$_REQUEST['orden']];
		$_SESSION['VARIACION_valor'][$_REQUEST['orden']] = $temp;

	}else if($_REQUEST['sent']=="d" && $_SESSION['VARIACION_valor'][$_REQUEST['orden']+1]!=''){
		
		$temp = $_SESSION['VARIACION_valor'][$_REQUEST['orden']+1];
		$_SESSION['VARIACION_valor'][$_REQUEST['orden']+1] = $_SESSION['VARIACION_valor'][$_REQUEST['orden']];
		$_SESSION['VARIACION_valor'][$_REQUEST['orden']] = $temp;


	}

}






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Variaciones Imagen</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>

body {
    background-image:none;
	background-color:transparent;
}
</style>

<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
		else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->


		//-->
</script>
<style type="text/css" title="ccToolStyle">
 .tool {
	padding:2px;
	moz-opacity:0%;
	font-size: 12px;
 }
</style>


</head>

<body class="body-popup">
<table width="100%" border="0" cellspacing="4" cellpadding="0">
  
  <?php 

  for($i=0;$i<count($_SESSION['VARIACION_valor']);$i++){

  ?>
  
  <tr>
    <td width="21%" class="td-form-title2">
<a href="#" onClick="location.replace('variaciones_prod.php?borrar=<?=$i?>');" title="eliminar variación"><img src="../icon/icon-prod-delete.gif" width="16" height="16" border="0"></a>

<a href="#" onClick="GP_AdvOpenWindow('popup-editar-variaciones.php?id=<?=$i?>','','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,channelmode=no,directories=no',400,100,'center','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue" title="Editar valor"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a>

<a href="#" onClick="location.replace('variaciones_prod.php?orden=<?=$i?>&sent=u');" title="subir"><img src="/admin/icon/icon-up.gif" width="16" height="16" border="0"></a>
     <a href="#" onClick="location.replace('variaciones_prod.php?orden=<?=$i?>&sent=d');" title="bajar"><img src="/admin/icon/icon-down.gif" width="16" height="16" border="0"></a>
</td>

    <td width="79%" class="span-agregar"><?php echo $_SESSION['VARIACION_valor'][$i]; ?></td>
  </tr>
 
  <?php 

  }

  ?>
</table>
</body>
</html>
