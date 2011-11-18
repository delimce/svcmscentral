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

<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Cat&aacute;logo de Productos y &oacute;rdenes de compra</div>
<div id="ninstrucciones"><p>Desde esta aplicaci&oacute;n usted podr&aacute; controlar  todos los aspectos relacionados con su cat&aacute;logo de productos; desde los productos como tal hasta las &oacute;rdenes de compra realizada por los usuarios del sistema.</p>

</div>




<div id="ncontenido">
<div id="nbloque">


<div id="tituloizq" style="width:65px; height:60px;">
<a href="productos.php"><img src="../icon/icon-admin-productos.gif" alt="administrar productos" width="48" height="48" border="0"></a>
</div>
<div id="dataderecha" style="width:860px; height:60px;">
<div id="ntitulo3">
<a href="productos.php">Administrar Árbol de Productos de su Web Site</a>
</div>
<p>
Crear, editar y borrar categorías y productos del catálogo en el web site. Cargar las fotos para las categorías y los productos. Crear, editar y borrar promociones...
</p>
</div>




<div id="tituloizq" style="width:65px; height:60px;">
<a href="productos-fastedit.php" title="edición rapida"><img src="../icon/icon-admin-productos-fastedit.gif" width="48" height="48" border="0"></a>
</div>
<div id="dataderecha" style="width:860px; height:60px;">
<div id="ntitulo3">
<a href="productos-fastedit.php">Tablero de edici&oacute;n  r&aacute;pida de productos</a>
</div>
<p>
Ver todos sus productos en una sola hoja para poder editar masivamente características como "Stock, Nombre, Código, visibilidad y precio"; también podrá borrar varios artículos de una sola vez.
</p>
</div>




<div id="tituloizq" style="width:65px; height:60px;">
<a href="ordenes.php"><img src="../icon/icon-admin-ordenes.gif" width="48" height="48" border="0"></a>
</div>
<div id="dataderecha" style="width:860px; height:60px;">
<div id="ntitulo3">
<a href="ordenes.php">Ordenes de Compra</a>
</div>
<p>
Ver las órdenes de compra / solicitudes realizadas por los usuarios, y cambiar su status.
</p>
</div>




<div id="tituloizq" style="width:65px; height:60px;"> 
<a href="productos-descuentos.php"><img src="../icon/icon-admin-descuentos.gif" width="48" height="48" border="0"></a>
</div>
<div id="dataderecha" style="width:860px; height:60px;">
<div id="ntitulo3">
<a href="productos-descuentos.php">Descuentos</a>
</div>
<p>
Seleccione un porcentaje de descuento que cada grupo de <a href="../usuarios/categorias.php" class="instruccion">usuarios registrados<span>Usted puede organizar sus usuaarios en grupos o categorías  y luego aplicar distintos privilegios o modificaciones generales en el web site exclusivas para cada grupo.</span></a> ha de tener en los precios de todos los productos </p>
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
