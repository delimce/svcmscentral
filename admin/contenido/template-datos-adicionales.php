<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Campos Adicionales</title>
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

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
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
      <td class="td-titulo1">Datos o Campos Adicionales para Art&iacute;culos . <font color="#CC0000">LUIS LEE LOS COMENTARIOS EN EL CODIGO!!</font></td>
     </tr>
     <tr>
      <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
       <tr>
        <td class="td-texto1"><p>Aqu&iacute; usted podr&aacute; configurar los <strong>datos adicionales</strong>  que
        todos los art&iacute;culos
        han de tener. Utilice esta opci&oacute;n si desea colocar datos especiales,  aparte de la descripci&oacute;n
        general que&nbsp; todos o algunos de sus art&iacute;culos han de tener.  Active los campos seleccionandolos
        en la columna de la izquierda seg&uacute;n la necesidad que tenga para organizar la informaci&oacute;n de sus art&iacute;culos. Estos
        datos adicionales se mostrar&aacute;n de forma tabulada en un lugar especial de la p&aacute;gina de detalle del mismo.</p>
        <p><strong>Ej.</strong> Puede agregar un campo &quot;<em>medidas</em>&quot; para colocarlo en sus art&iacute;culos; para eso seleccione el campo de
        texto sencillo (CATF) y escriba &quot;medidas&quot; en el nombre de campo. A partir de ese momento, todos sus art&iacute;culos tendr&aacute;n
        la opci&oacute;n de escribirle informaci&oacute;n en ese nuevo campo. Sin embargo, usted desea que este campo aparezca en s&oacute;lo
        en&nbsp; algunos
        de los articulos de ciertas categor&iacute;as
        y no desea que salgan estos datos en los art&iacute;culos
        de otra categor&iacute;a...&nbsp; No se preocupe, si en la edici&oacute;n de un art&iacute;culo, usted no escribe nada en sus detalles,
        no aparecer&aacute; el campo, ni siquiera aparecer&aacute; el
        titulo &quot;medidas&quot;. Usted ha de configurar la p&aacute;gina de detalle de art&iacute;culo considerando las p&aacute;ginas que
        m&aacute;s detalles tengan.</p></td>
       </tr>
       <tr>
        <td class="cont-td-nav1"><strong>Leyenda</strong>:&nbsp;&nbsp;&nbsp; <img src="../icon/icon-campo-text.jpg" width="18" height="14" border="0" align="absmiddle"> Campo
        de Texto Sencillo&nbsp;&nbsp;&nbsp; &nbsp; <img src="../icon/icon-campo-textarea.jpg" width="18" height="18" border="0" align="absmiddle"> Campo
        Textarea&nbsp;&nbsp;&nbsp; &nbsp; <img src="../icon/icon-campo-select.jpg" width="17" height="17" border="0" align="absmiddle"> Campo
        de Lista</td>
       </tr>
       <tr>
        <td align="center"><form name="form1" method="post" action="">
         <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
           <td width="4%" align="center"><img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="¿Activar este campo?, márquelo si desea utilizar este campo"></td>
           <td width="4%" class="td-headertabla">Tipo</td>
           <td width="27%" class="td-headertabla">Nombre de Campo</td>
           <td width="54%" class="td-headertabla">Opciones</td>
           <td width="11%" class="td-headertabla">Acciones</td>
          </tr>
          <tr>

<!--campo sencillo de texto: repetir 5 veces-->
           <td valign="top" class="td-content"><input name="CATF1check" type="checkbox" id="CATF1check" value="checkbox"></td>
           <td valign="top" class="td-content"><img src="../icon/icon-campo-text.jpg" width="18" height="14" border="0" align="absmiddle" title="CATF. Campo de texto sencillo, para datos puntuales con información corta"></td>
           <td valign="top" class="td-content"><input name="CATF1nombre" type="text" class="form-box" id="CATF1nombre" size="40"></td>
           <td valign="top" class="td-content"><strong>Longitud</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Longitud del campo de texto en caracteres. Se muestra en el editor de artículo">           <input name="CATF1longitud" type="text" class="form-box" id="CATF1longitud" size="4"></td>
           <td width="11%" valign="top" class="td-content"><a href="#" title="borrar este campo"><img src="../icon/icon-delete.gif" width="16" height="16" border="0"></a> <a href="#" title="bajar de lugar"><img src="../icon/icon-down.gif" width="16" height="16" border="0"></a> <a href="#" title="subir de lugar"><img src="../icon/icon-up.gif" width="16" height="16" border="0"></a> <a href="#" title="editar campo"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a></td>
          </tr>
<!-- fin campo sencillo de texto-->

<!--campo de text area. solo 1. no repetir-->
          <tr>
           <td valign="top" class="td-content"><input name="CATA1check" type="checkbox" id="CATA1check" value="checkbox"></td>
           <td valign="top" class="td-content"><img src="../icon/icon-campo-textarea.jpg" width="18" height="18" border="0" align="absmiddle" title="CATA. Campo de texto grande. Para datos con información en más de una línea."></td>
           <td valign="top" class="td-content"><input name="CATA1nombre" type="text" class="form-box" id="CATA1nombre" size="40"></td>
           <td valign="top" class="td-content"><strong>Longitud</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Longitud del campo en caracteres. Se muestra en el editor de artículos">
           <input name="CATA1longitud" type="text" class="form-box" id="CATA1longitud" size="4">&nbsp;  &nbsp; <strong>Lineas</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Numero de lineas del campo. Se muestra en el editor de artículo">
           <input name="CATA1lineas" type="text" class="form-box" id="CATA1lineas" size="4">
           </td>
           <td width="11%" valign="top" class="td-content"><a href="#" title="borrar este campo"><img src="../icon/icon-delete.gif" width="16" height="16" border="0"></a> <a href="#" title="bajar de lugar"><img src="../icon/icon-down.gif" width="16" height="16" border="0"></a> <a href="#" title="subir de lugar"><img src="../icon/icon-up.gif" width="16" height="16" border="0"></a> <a href="#" title="editar campo"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a></td>
          </tr>
<!--fin campo de text area. -->

<!--campo de seleccion multiple. repetir 4 veces 

para eliminarnos trabajo nosotros, siempre lo ponremos multiple y con 5 lineas de alto, o sea tipo list, no tipo combo... o sea asi: 
"<select name="select" size="5" multiple></select> "  

Las opciones hay que sacarlas de la lista que  pondra el usuario en CAL1valores, estos estarán separados por COMA. sise te hace mas facil separarlos con otra cosa, cambia el caracter en las instrucciones!!
-->
          <tr>
           <td valign="top" class="td-content"><input name="CAL1check" type="checkbox" id="CAL1check" value="checkbox"></td>
           <td valign="top" class="td-content"><img src="../icon/icon-campo-select.jpg" width="17" height="17" border="0" align="absmiddle" title="CAL. Campo de lista de datos"></td>
           <td valign="top" class="td-content"><input name="CAL1nombre" type="text" class="form-box" id="CAL1nombre" size="40"></td>
           <td valign="top" class="td-content"><strong>Valores</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Escriba los valores de la lista de opciones para este campo SEPARADOS por COMA; asi: verde, rojo, azul, etc." >
           <input name="CAL1valores" type="text" class="form-box" id="CAL1valores" size="70">
           </td>
           <td width="11%" valign="top" class="td-content"><a href="#" title="borrar este campo"><img src="../icon/icon-delete.gif" width="16" height="16" border="0"></a> <a href="#" title="bajar de lugar"><img src="../icon/icon-down.gif" width="16" height="16" border="0"></a> <a href="#" title="subir de lugar"><img src="../icon/icon-up.gif" width="16" height="16" border="0"></a> <a href="#" title="editar campo"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a></td>
          </tr>
<!--fin campo de seleccion multiple-->
         </table>
<input name="Submit" type="submit" class="form-button" value="Guardar Cambios">
&nbsp; 
<input name="Submit2" type="button" class="form-button" onClick="MM_goToURL('parent','arbol.php');return document.MM_returnValue" value="Cancelar">
        </form>
       </td>
       </tr>
       <tr>
        <td class="td-refooter">&nbsp;</td>
       </tr>
      </table>
      </td>
     </tr>
     <tr>
      <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto Internet</a></td>
     </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
