<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores

 $datos = new tools('db');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>titulo de la pagina</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
</script>
</head>

<body>
<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include("menu.php");?>

<!--END INCLUDES-->

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="../main.php"><img src="../header-backdoor.jpg" width="900" height="130" border="0"></a></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
 <!-- SUPER MENU !!! -->
<tr><td><?php include ("http://svcmscentral.com/admin/supermenu.php")?></td></tr>
<!--/// SUPER MENU -->
     <tr>
      <td class="td-titulo1">titulo de la pagina</td>
     </tr>
     <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
       <tr>
         <td>&nbsp;</td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
      </table>
      </td>
     </tr>
     <tr>
      <td align="center" bgcolor="#E5ECFA"><a href="http://www.proyecto-internet.com" target="_blank"><font size="1">Proyecto Internet</font></a><font size="1">&nbsp;</font></td>
     </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php $datos->cerrar(); ?>