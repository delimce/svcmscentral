<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>subir base de datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript" src="../../SVsystem/js/scripts.js"></script>

<script language="JavaScript" type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
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
    <td><img src="../header-bdc.jpg" width="900" height="130"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td class="td-titulo1">importar base de datos</td>
     </tr>
     <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
       <tr>
        <td class="td-texto1"><p><strong><font color="#990000">ATENCION:</font></strong> Para agregar archivos de bases de
        datos a este sistema es necesario que su archivo sea CSV (Archivo separado por comas) y tenga el <strong>Mismo</strong> formato
        que a continuaci&oacute;n (Usted corre el riesgo de da&ntilde;ar TODA la base de datos si su archivo no posee este formato):</p>
        <p align="center"><strong>&quot;origen,	categor&iacute;a1, categoria2, categoria3, categoria4, categoria5, rif, nombre,
        password, email, web <br>
        empresa, actividad, cargo, tlf1, celular, fax, direccion, zip, ciudad, estado, pais,
        activo, notas&quot;</strong></p></td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
       <tr>
        <td><form name="form1" method="get" action="">
      <table width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <td width="19%" class="bdc-form-title">Archivo CSV</td>
          <td width="81%"><input name="file" type="file" size="50">
</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="Submit" value="Subir Base de Datos" class="form-button">&nbsp; 
        </td>
        </tr>
      </table>
      </form></td>
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

