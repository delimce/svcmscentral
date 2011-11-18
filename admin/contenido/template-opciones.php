<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

$estado = $tool->simple_db("select estatus_art from preferencias");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Opciones Generales</title>
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


<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
</head>

<body>
<!--INCLUDES-->
<?php include "include-menu.php"?>
<!--END INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../header-contenido.jpg" width="900" height="130"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%">&nbsp;</td>
        <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="td-titulo1">Opciones generales</td>
          </tr>
          <tr>
            <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td class="td-texto1">Modifique ciertos par&aacute;metros generales para todo el contenido del Web Site</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><form name="form1" method="post" action="">
                <table width="100%" border="0" cellspacing="5" cellpadding="0">
                 <tr>
                  <td width="39%" class="td-form-title">Estado por default de los art&iacute;culos nuevos</td>
                  <td width="61%"><select name="select" class="form-box" onChange="ajaxsend('post','cambioestado','estado='+this.value);">
                    <option value="1" <?php if($estado==1) echo 'selected'; ?>>Publicado</option>
                    <option value="0" <?php if($estado==0) echo 'selected'; ?>>Oculto</option>
                  </select></td>
                 </tr>
                 <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                 </tr>
                </table>
                </form></td>
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
        <td width="7%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<?php $tool->cerrar();?>