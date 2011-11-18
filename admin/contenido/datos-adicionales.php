<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/image.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

	if(isset($_REQUEST['borrar'])){ ///borra el campo
	
	
		$orden = $tool->simple_db("select orden from campo where id = {$_REQUEST['borrar']} ");
		if(empty($orden)) $orden = 0;
		$tool->query("update campo set orden = orden-1 where orden > $orden and modulo = 'cont'");
		$tool->query("delete from campo where id = '{$_REQUEST['borrar']}' ");
		$tool->redirect('datos-adicionales.php');
	
	}


	$tool->query("select * from campo where modulo = 'cont' order by orden");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Campos Adicionales</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>


<script language="JavaScript" type="text/JavaScript">


	function ordenar(orden,nivel,sentido){
	
	  
	  ajaxsend("post","ordenar.php","orden="+orden+"&tabla="+nivel+"&se="+sentido);
	  location.replace('datos-adicionales.php');
	  
	 
	}


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
<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor" >





<div id="ntitulo">Datos o Campos Adicionales para Art&iacute;culos.</div>
<div id="ninstrucciones">
<p>Aqu&iacute; usted podr&aacute; configurar los <strong>datos adicionales</strong>  que
        todos los art&iacute;culos
        han de tener. Utilice esta opci&oacute;n si desea colocar datos especiales,  aparte de la descripci&oacute;n
        general que&nbsp; todos o algunos de sus art&iacute;culos han de tener.  Active los campos seleccionandolos
        en la columna de la izquierda seg&uacute;n la necesidad que tenga para organizar la informaci&oacute;n de sus art&iacute;culos. Estos
datos adicionales se mostrar&aacute;n de forma tabulada en un lugar especial de la p&aacute;gina de detalle del mismo.</p>
        <p><strong>Ej.</strong> Puede agregar un campo &quot;<em>medidas</em>&quot; para colocarlo en sus art&iacute;culos; para eso agregue el campo de
        texto sencillo  y escriba &quot;medidas&quot; en el nombre de campo. A partir de ese momento, todos sus art&iacute;culos tendr&aacute;n
        la opci&oacute;n de escribirle informaci&oacute;n en ese nuevo campo. Sin embargo, usted desea que este campo aparezca en s&oacute;lo
        en&nbsp; algunos
        de los articulos de ciertas categor&iacute;as
        y no desea que salgan estos datos en los art&iacute;culos
        de otra categor&iacute;a...&nbsp; No se preocupe, si en la edici&oacute;n de un art&iacute;culo, usted no escribe nada en sus detalles,
        no aparecer&aacute; el campo, ni siquiera aparecer&aacute; el
        titulo &quot;medidas&quot;. Usted ha de configurar la p&aacute;gina de detalle de art&iacute;culo considerando las p&aacute;ginas que
        m&aacute;s detalles tengan.</p>
</div>


<div id="ncontenido">
<div id="nbloque">
<div id="nbotonera" style="text-align:center;">


<a href="javascript:popup('popup-CATF.php','nuevocampo','200','600');" class="boton"><img src="../icon/icon-campo-text.jpg" width="18" height="14" border="0" align="absmiddle">agregar Campo tipo Texto Sencillo</a>

 
<a href="javascript:popup('popup-CATA.php','nuevocampo','240','680');" class="boton"><img src="../icon/icon-campo-textarea.jpg" width="18" height="18" border="0" align="absmiddle">agregar Campo tipo Texto Largo</a>


<a href="javascript:popup('popup-CAL.php','nuevocampo','200','600');" class="boton">  <img src="../icon/icon-campo-select.jpg" width="17" height="17" border="0" align="absmiddle">agregar Campo tipo Lista</a>
</div>


        <?php if($tool->nreg>0){ ?>
        
        <form name="form1" method="post" action="">
         <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
           <td width="4%" class="td-headertabla">Tipo</td>
           <td width="27%" class="td-headertabla">Nombre de Campo</td>
           <td width="54%" class="td-headertabla">Opciones</td>
           <td width="11%" class="td-headertabla">Acciones</td>
          </tr>
         


<?php

$i=0;

 while ($row = mysql_fetch_assoc($tool->result)) { ?>

<?php if($row['tipo']=="texto"){ ?>
<!--campo sencillo de texto: repetir 5 veces-->
		  <tr>
           <td valign="top" class="td-content"><img src="../icon/icon-campo-text.jpg" width="18" height="14" border="0" align="absmiddle" title="CATF. Campo de texto sencillo, para datos puntuales con información corta"></td>
           <td valign="top" class="td-content"><?=$row['nombre'] ?></td>
           <td valign="top" class="td-content"><strong>Longitud</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Longitud del campo de texto en caracteres. Se muestra en el editor de artículo">
             <?=$row['longitud'] ?></td>
           <td width="11%" valign="top" class="td-content"><img title="borrar este campo" onClick="location.replace('datos-adicionales.php?borrar=<?=$row['id'] ?>');" src="../icon/icon-delete.gif" width="16" height="16" border="0">&nbsp;<img title="bajar de lugar" onClick="ordenar('<?=$row['orden'] ?>','campo','d');" src="../icon/icon-down.gif" width="16" height="16" border="0"> 
           <img onClick="ordenar('<?=$row['orden'] ?>','campo','u');" src="../icon/icon-up.gif" title="subir de lugar" width="16" height="16" border="0"> <a href="javascript:popup('popup-CATF.php?id=<?=$row['id'] ?>','nuevocampo','200','600');" title="editar campo"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a></td>
          </tr>

<!-- fin campo sencillo de texto-->

<!--campo de text area. solo 1. no repetir-->
<?php }else if($row['tipo']=="textarea"){ ?>
          <tr>
           <td valign="top" class="td-content"><img src="../icon/icon-campo-textarea.jpg" width="18" height="18" border="0" align="absmiddle" title="CATA. Campo de texto grande. Para datos con información en más de una línea."></td>
           <td valign="top" class="td-content"><?=$row['nombre'] ?></td>
           <td valign="top" class="td-content"><strong>Longitud</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Longitud del campo en caracteres. Se muestra en el editor de artículos">
             <?=$row['longitud'] ?>             &nbsp;  &nbsp; <strong>Lineas</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Numero de lineas del campo. Se muestra en el editor de artículo">
             <?=$row['lineas'] ?></td>
           <td width="11%" valign="top" class="td-content"><img title="borrar este campo" onClick="location.replace('datos-adicionales.php?borrar=<?=$row['id'] ?>');" src="../icon/icon-delete.gif" width="16" height="16" border="0">&nbsp;<img title="bajar de lugar" onClick="ordenar('<?=$row['orden'] ?>','campo','d');" src="../icon/icon-down.gif" width="16" height="16" border="0"> <img onClick="ordenar('<?=$row['orden'] ?>','campo','u');" src="../icon/icon-up.gif" title="subir de lugar" width="16" height="16" border="0">&nbsp;<a href="javascript:popup('popup-CATA.php?id=<?=$row['id'] ?>','nuevocampo','240','680');" title="editar campo"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a></td>
          </tr>
<!--fin campo de text area. -->
<?php }else{ ?>
<!--campo de seleccion multiple. repetir 4 veces 

para eliminarnos trabajo nosotros, siempre lo ponremos multiple y con 5 lineas de alto, o sea tipo list, no tipo combo... o sea asi: 
"<select name="select" size="5" multiple></select> "  

Las opciones hay que sacarlas de la lista que  pondra el usuario en CAL1valores, estos estarán separados por COMA. sise te hace mas facil separarlos con otra cosa, cambia el caracter en las instrucciones!!
-->

          <tr>
           <td valign="top" class="td-content"><img src="../icon/icon-campo-select.jpg" width="17" height="17" border="0" align="absmiddle" title="CAL. Campo de lista de datos"></td>
           <td valign="top" class="td-content"><?=$row['nombre'] ?></td>
           <td valign="top" class="td-content"><strong>Valores</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Escriba los valores de la lista de opciones para este campo SEPARADOS por COMA; asi: verde, rojo, azul, etc." >
             <?=$row['valores'] ?></td>
           <td width="11%" valign="top" class="td-content"><img title="borrar este campo" onClick="location.replace('datos-adicionales.php?borrar=<?=$row['id'] ?>');" src="../icon/icon-delete.gif" width="16" height="16" border="0">&nbsp;<img title="bajar de lugar" onClick="ordenar('<?=$row['orden'] ?>','campo','d');" src="../icon/icon-down.gif" width="16" height="16" border="0"> <img onClick="ordenar('<?=$row['orden'] ?>','campo','u');" src="../icon/icon-up.gif" title="subir de lugar" width="16" height="16" border="0">&nbsp;<a href="javascript:popup('popup-CAL.php?id=<?=$row['id'] ?>','nuevocampo','200','600');" title="editar campo"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a></td>
          </tr>
          
          
          
 <?php 
 		}
		
		$i++;
 
 } ?>  
          
          
<!--fin campo de seleccion multiple-->
         </table>
         
         
        <center>

<input name="Submit2" type="button" class="form-button" onClick="history.back();" value="OK! Listo">
</center>
        </form>
        
         <?php } ?>



</div>







<!-- termina ncontenido -->
</div>
<?php include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>













































</body>
</html>
<?php $tool->cerrar(); ?>