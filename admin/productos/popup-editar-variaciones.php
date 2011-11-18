<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");


if(isset($_REQUEST['Submit'])){
	
			$I = $_REQUEST['pos'];
			$_SESSION['VARIACION_valor'][$I] = $_REQUEST['nombre'];
			
			/////////////////
			?>
            
            <script type="text/javascript">
			window.opener.varia.location.replace('variaciones_prod.php');
			window.close();
			</script>

            <?

	
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Agregar Variaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>



</head>

<body>
<form action="" method="post" enctype="application/x-www-form-urlencoded" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Editar Variaci&oacute;n</td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="24%" class="td-form-title">Nombre </td>
    <td width="76%"><input name="nombre" value="<?=$_SESSION['VARIACION_valor'][$_REQUEST['id']]?>" type="text" class="form-box" size="50">
    <input type="hidden" name="pos" id="pos" value="<?=$_REQUEST['id']?>"></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" class="form-button" value="OK"></td>
   </tr>
  </table></td>
 </tr>
</table>
</form>
<span id="ccSpan" style="display:none"><a href="#"></a></span>
</body>
</html>
