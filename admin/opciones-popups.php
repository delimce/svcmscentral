<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/clases.php");

$tool = new tools('db');

$estilo = $tool->simple_db("select popup_style from preferencias");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Opciones - Estilos de popups</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/SVsystem/lightbox/css/lightbox.css" type="text/css" media="screen" />

<link href="estilos.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/SVsystem/lightbox/js/prototype.js"></script>
<script type="text/javascript" src="/SVsystem/lightbox/js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="/SVsystem/lightbox/js/lightbox.js"></script>
<script type="text/javascript" src="/SVsystem/js/ajax.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--




function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->


function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

</script>


</head>

<body>
<?php include ("n-encabezado.php")?>
<div id="ncuerpo">
<?php include ("n-include-mensajes.php")?>
<div id="ncontenedor">
<div id="nnavbar"><?php include "n-include-menu2.php"?></div>




<div id="ntitulo">Estilos de los Pop-Uups de Sistema de su Web site</div>
<div id="ninstrucciones">Elija el estilo de color de los popups de sistema de su web site.<br />
</div>


<div id="ncontenido">

<form name="form" method="post" action="" id="form1">
<div id="nbloque">
<table width="100%" border="0" cellspacing="10" cellpadding="0">
<tr>
<td class="td-opciones-popup"><div align="center"><a href="icon/popups/popup-azul.jpg" title="Estilo Azul" rel="lightbox"><img src="icon/popups/tn-popup-azul.jpg" width="120" height="83" border="1"class="opciones-popup-imagen" /></a></div>
<div class="opciones-popup-titulo">Azul</div>
<div class="opciones-popup-check">
<input name="estilos" type="radio" value="estilos-popup-azul.css" onclick="ajaxsend('post','backdoor/workflow.php','valor='+this.value+'&amp;tipo=6');" <?php if($estilo=="estilos-popup-azul.css")echo 'checked'; ?> />
</div></td>
<td class="td-opciones-popup"><div align="center"><a href="icon/popups/popup-verde.jpg" title="Estilo Verde" rel="lightbox"><img src="icon/popups/tn-popup-verde.jpg" width="120" height="83" border="1"class="opciones-popup-imagen" /></a></div>
<div class="opciones-popup-titulo">Verde</div>
<div class="opciones-popup-check">
<input type="radio" name="estilos" value="estilos-popup-verde.css" onclick="ajaxsend('post','backdoor/workflow.php','valor='+this.value+'&amp;tipo=6');" <?php if($estilo=="estilos-popup-verde.css")echo 'checked'; ?> />
</div></td>
<td class="td-opciones-popup"><div align="center"><a href="icon/popups/popup-negro.jpg" title="Estilo Negro" rel="lightbox"><img src="icon/popups/tn-popup-negro.jpg" width="120" height="83" border="1"class="opciones-popup-imagen" /></a></div>
<div class="opciones-popup-titulo">Negro</div>
<div class="opciones-popup-check">
<input type="radio" name="estilos" value="estilos-popup-negro.css"  onclick="ajaxsend('post','backdoor/workflow.php','valor='+this.value+'&amp;tipo=6');" <?php if($estilo=="estilos-popup-negro.css")echo 'checked'; ?> />
</div></td>
</tr>
<tr>
<td class="td-opciones-popup"><div align="center"><a href="icon/popups/popup-gris.jpg" title="Estilo Gris" rel="lightbox"><img src="icon/popups/tn-popup-gris.jpg" width="120" height="83" border="1"class="opciones-popup-imagen" /></a></div>
<div class="opciones-popup-titulo">Gris</div>
<div class="opciones-popup-check">
<input type="radio" name="estilos" value="estilos-popup-gris.css" onclick="ajaxsend('post','backdoor/workflow.php','valor='+this.value+'&amp;tipo=6');" <?php if($estilo=="estilos-popup-gris.css")echo 'checked'; ?> />
</div></td>
<td class="td-opciones-popup"><div align="center"><a href="icon/popups/popup-rojo.jpg" title="Estilo Rojo" rel="lightbox"><img src="icon/popups/tn-popup-rojo.jpg" width="120" height="83" border="1"class="opciones-popup-imagen" /></a></div>
<div class="opciones-popup-titulo">Rojo</div>
<div class="opciones-popup-check">
<input type="radio" name="estilos" value="estilos-popup-rojo.css" onclick="ajaxsend('post','backdoor/workflow.php','valor='+this.value+'&amp;tipo=6');" <?php if($estilo=="estilos-popup-rojo.css")echo 'checked'; ?> />
</div></td>
<td class="td-opciones-popup"><div align="center"><a href="icon/popups/popup-blanco.jpg" title="Estilo Blanco" rel="lightbox"><img src="icon/popups/tn-popup-blanco.jpg" width="120" height="83" border="1"class="opciones-popup-imagen" /></a></div>
<div class="opciones-popup-titulo">Blanco</div>
<div class="opciones-popup-check">
<input type="radio" name="estilos" value="estilos-popup-blanco.css" onclick="ajaxsend('post','backdoor/workflow.php','valor='+this.value+'&amp;tipo=6');" <?php if($estilo=="estilos-popup-blanco.css")echo 'checked'; ?> />
</div></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</div>







<div id="botonsotes">
<center>
 <input name="Submit2" type="reset" class="form-button" onClick="MM_goToURL('parent','opciones.php');return document.MM_returnValue" value="Listo!">

</center>
</div>










</form>

<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?>
</body>
</html>
<?php $tool->cerrar(); ?>
