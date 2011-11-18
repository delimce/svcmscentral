<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Mensajes de los Usuarios</title>
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
<?php include "include-menu.php"?>
<!--END INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../header-mensajes.jpg" width="900" height="130"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%">&nbsp;</td>
        <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<!-- SUPER MENU !!!!! -->
<tr><td><?php include ("supermenu.php")?></td></tr>
<!--//////////  SUPER MENU !!!!! -->
          <tr>
            <td class="td-titulo1">Mensajes de los usuarios desde la p&aacute;gina web</td>
          </tr>
          <tr>
            <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td class="td-texto1">En este m&oacute;dulo usted podr&aacute; leer los mensajes que dejan los usuarios
                en la p&aacute;gina
                web.</td>
              </tr>
              <tr>
               <td><form name="form1" method="post" action="">
               <p class="bdc-td-controles-listado">&nbsp;Ver 
                <select name="select3" class="form-box">
                 <option selected>10 mensajes
                 <option>50 mensajes
                 <option>100 mensajes                 
                </select>
               &nbsp;&nbsp; Ordenar por: 
                <select name="select" class="form-box">
                 <option value="Fecha" selected>Fecha
                 <option value="Autor">Autor
                 <option value="Titulo">Titulo                 
                </select> 
                En
                orden
                <select name="select2" class="form-box">
                <option selected>Creciente
                <option>Decreciente                
                </select>  
              </p>
               </form>
               </td>
              </tr>
              <tr>
               <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
<!--loop mensajes-->
<div class="mens-mensaje-container">
<div class="mens-mensaje-imgborrar">
<a href="#" title="borrar mensaje"><img src="../icon/botonsito-borrar-mensajes.jpg" width="15" height="15" border="0"></a></div>
<div class="mens-mensaje-fecha">12/12/2007</div>
<div class="mens-mensaje-fecha"><strong>Desde</strong>: Nombre de la página</div>
<div class="mens-mensaje-titulo">titulo del Mensaje</div>
<div class="mens-mensaje-contenido">contenido del mensaje contenido del mensaje contenido del mensaje contenido del mensaje contenido del mensaje </div>
<div class="mens-mensaje-autor"><a href="email@ermail.com">Autor</a></div>
</div>
<!--termina loop mensajes-->
<!--loop mensajes REPETICION DE PRUEBA-->
<div class="mens-mensaje-container">
<div class="mens-mensaje-imgborrar">
<a href="#" title="borrar mensaje"><img src="../icon/botonsito-borrar-mensajes.jpg" width="15" height="15" border="0"></a></div>
<div class="mens-mensaje-fecha">12/12/2007</div>
<div class="mens-mensaje-fecha"><strong>Desde</strong>: Nombre de la página</div>
<div class="mens-mensaje-titulo">titulo del Mensaje</div>
<div class="mens-mensaje-contenido">contenido del mensaje contenido del mensaje contenido del mensaje contenido del mensaje contenido del mensaje </div>
<div class="mens-mensaje-autor"><a href="email@ermail.com">Autor</a></div>
</div>
<!--termina loop mensajes REPETICION DE PRUEBA-->
</td>
              </tr>
              <tr>
               <td class="td-refooter">
<!--navegador de paginas-->
<a href="#" title="primera">&lt;&lt;</a>&nbsp;&nbsp; 
<a href="#" title="anterior">&lt;</a>&nbsp; &nbsp; 
<a href="#" title="siguiente">&gt;</a>&nbsp;&nbsp; 
<a href="#" title="ultima">&gt;&gt;</a>
<!--fin navegador de paginas-->
</td>
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
