<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/funciones.php");


			if(isset($_REQUEST['prod_id']) && !isset($_SESSION['IMAGENES'])){
			
				
				$tool = new tools();
				$tool->autoconexion();
				
				$varias = $tool->array_query("select ruta from imagen_producto where prod_id = '{$_REQUEST['prod_id']}' ");
				
				if($tool->nreg>0)  $_SESSION['IMAGENES'] = $varias;
				
				$tool->cerrar();
				
				
				
			
			}else if(isset($_REQUEST['borrar'])){
			
				$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL
			
				$imag = $_SESSION['IMAGENES'][$_REQUEST['borrar']];
				
				for($i=$_REQUEST['borrar'];$i<count($_SESSION['IMAGENES']);$i++){
			
			
					$_SESSION['IMAGENES'][$i] = $_SESSION['IMAGENES'][$i+1];
			
			
			
				}
			
				array_pop ($_SESSION['IMAGENES']);
				borrar_imagenes($imag);
			
			
			}else if (isset($_REQUEST['orden'])){
			
				if($_REQUEST['sent']=="u" && $_SESSION['IMAGENES'][$_REQUEST['orden']-1]!=''){
					
					$temp = $_SESSION['IMAGENES'][$_REQUEST['orden']-1];
					$_SESSION['IMAGENES'][$_REQUEST['orden']-1] = $_SESSION['IMAGENES'][$_REQUEST['orden']];
					$_SESSION['IMAGENES'][$_REQUEST['orden']] = $temp;
			
				}else if($_REQUEST['sent']=="d" && $_SESSION['IMAGENES'][$_REQUEST['orden']+1]!=''){
					
					$temp = $_SESSION['IMAGENES'][$_REQUEST['orden']+1];
					$_SESSION['IMAGENES'][$_REQUEST['orden']+1] = $_SESSION['IMAGENES'][$_REQUEST['orden']];
					$_SESSION['IMAGENES'][$_REQUEST['orden']] = $temp;
			
			
				}
			
			}






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Imagenes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


<style>

body {
    background-color:none;
	background-color:transparent;
}
</style>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
		else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->




</script>



</head>

<body leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
  <?php for($i=0;$i<count($_SESSION['IMAGENES']);$i++){ ?>
  <td align="center">
   
    <table width="50" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"> 
<a href="<?php echo '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/orig/'.$_SESSION['IMAGENES'][$i] ?>" target="_blank">
<img src="<?php echo '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/turn/'.$_SESSION['IMAGENES'][$i] ?>" alt="click para agrandar" border="0">
</a>

</td>
      </tr>
      <tr>
        <td align="center" class="bdc-span-explicacion"><?php echo $_SESSION['IMAGENES'][$i] ?></td>
      </tr>
      <tr>
        <td align="center"><a href="#" title="ordenar a la izquierda"><img onClick="location.replace('imagenes.php?orden=<?=$i?>&sent=u');" border="0" src="/admin/icon/icon-left.gif" width="16" height="16"></a><a href="#" title="Borrar imagen"><img border="0" src="/admin/icon/icon-delete.gif" onClick="location.replace('imagenes.php?borrar=<?=$i?>');" width="16" height="16"></a><a href="#" title="ordenar a la derecha"><img onClick="location.replace('imagenes.php?orden=<?=$i?>&sent=d');" src="/admin/icon/icon-right.gif" border="0" width="16" height="16"></a></td>
      </tr>
    </table>
    
    </td>
     <?php } ?> 
  </tr>
</table>
</body>
</html>
