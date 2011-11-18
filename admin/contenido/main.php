<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Administrar secciones de la p&aacute;gina</title>
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


<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Contenidos (p&aacute;ginas) de su web site</div>
<div id="ninstrucciones"><p>En este m&oacute;dulo usted podr&aacute; controlar todas las secciones o p&aacute;ginas  de su web site. Contar&aacute; con un sistema de categor&iacute;as de tres niveles y art&iacute;culos que le permitir&aacute;n reflejar todo tipo de contenido, desde galer&iacute;as de fotos, p&aacute;ginas de informaci&oacute;n,  eventos,  noticias, etc.</p>

</div>




<div id="ncontenido">
<div id="nbloque">


<div id="tituloizq" style="width:65px; height:60px;">
<a href="arbol.php"><img src="../icon/icon-admin-contenido.gif" alt="administrar arbol de contenido" width="48" height="48" border="0"></a></div>
<div id="dataderecha" style="width:860px; height:60px;">
<div id="ntitulo3"><a href="arbol.php">Administrar &aacute;rbol de contenido (p&aacute;ginas) del web site</a></div>
<p>Crear, editar y borrar categorías, sub categorías y <a class="instruccion"><strong>art&iacute;culos</strong><span>Los artículos (o  páginas o pestañas, o secciones) son la unidad de contenido de su  página web; son el lugar donde usted va a colocar su información: fotos, textos, archivos, videos, etc. Éstos son el verdadero cuerpo del contenido de su página web.<br><br>Para mayor orden y navegabilidad, los artículos están  organizados dentro de Categorias .</span></a> (tambi&eacute;n llamados: p&aacute;ginas, secciones, pesta&ntilde;as, etc.) en el web site.</p>
</div>


<div id="tituloizq" style="width:65px; height:60px;">
<a href="opciones.php" title="opciones"><img src="../icon/icon-admin-opciones.gif" width="48" height="48" border="0"></a></div>
<div id="dataderecha" style="width:860px; height:60px;">
<div id="ntitulo3"><a href="opciones.php">Opciones para nuevas p&aacute;ginas</a></div>
<p>Status por defecto de nuevos art&iacute;culos.</p>
</div>

<div id="tituloizq" style="width:65px; height:60px;">
<a href="articulos-fastedit.php" title="edición rapida"><img src="../icon/icon-admin-productos-fastedit.gif" width="48" height="48" border="0"></a></div>
<div id="dataderecha" style="width:860px; height:60px;">
<div id="ntitulo3"><a href="articulos-fastedit.php">Tablero de edici&oacute;n r&aacute;pida de p&aacute;ginas</a></div>
<p>Ver todos sus art&iacute;culos en una sola hoja para poder editar&nbsp; masivamente caracter&iacute;sticas como &quot;Nombre, Autor, visibilidad y fecha&quot;; tambi&eacute;n podr&aacute; copiar, mover y borrar varios art&iacute;culos de una sola vez.</p>
</div>












<div id="nseparador"></div>
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
