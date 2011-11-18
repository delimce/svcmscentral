<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Cat&aacute;logo de Productos. Administrador</title>
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
<!--IINCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include ("include-menu.php");?>
<?php include ("include-warning.php");?>

<!--INCLUDES-->


<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../header-productos.jpg"
 width="900" height="130"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="td-titulo1"> opciones del Cat&aacute;logo de Productos </td>
          </tr>
          <tr>
            <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td class="td-texto1">Modifique aspectos generales el comportamiento de su cat&aacute;logo de productos</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td width="9%" align="center" valign="top" class="td-texto2"><a href="../opciones-moneda.php"><img src="../icon/icon-admin-opciones-moneda.gif" width="48" height="48" border="0"></a></td>
                  <td width="91%" valign="top" class="td-texto2"><a href="../opciones-moneda.php"><strong>Moneda del cat&aacute;logo de productos:</strong></a>  Cambiar la moneda en la que se expresan los precios de su cat&aacute;logo de productos, decidir si su cat&aacute;logo  muestra los precios o no.</td>
                  </tr>
                  <tr>
                  <td align="center" valign="top" class="td-texto2"><a href="../opciones-imagenes.php"><img src="../icon/icon-admin-opciones-imagenes.gif" width="48" height="48" border="0"></a></td>
                  <td width="91%" valign="top" class="td-texto2"><a href="../opciones-imagenes.php"><strong>Tama&ntilde;o de las im&aacute;genes de categor&iacute;as y productos</strong></a>: Modificar el tama&ntilde;o que van a tener l&aacute;s im&aacute;genes en los listados de productos, el tama&ntilde;o de la im&aacute;gen en el detalle de cada producto y el tama&ntilde;o de los thumbnails de las im&aacute;genes adicionales.</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="td-refooter">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto Internet</a></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
