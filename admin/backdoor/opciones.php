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


</head>

<body>



<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Opciones Generales de Super Administrador</div>
<div id="ninstrucciones" style="display:none;">
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">

</div>

<div id="tituloizq" style="width:130px; margin-left:100px;"><a href="opciones-modulos.php"><img src="../icon/icon-admin-modulos.gif" alt="administrar contenido" width="48" height="48" border="0"></a></div>
<div id="dataderecha">
<div id="ntitulo3"><a href="opciones-modulos.php">M&oacute;dulos Activos</a></div>
<p>Seleccionar qu&eacute; modulos est&aacute;n activos en el web site.</p>
</div>

   
           














<div id="nseparador"></div>


<!-- termina nbloque -->
</div>












<!-- termina ncontenido -->
</div>
<?php //include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>    
</div>

</div>
<?php include ("../n-footer.php")?>
</body>
</html>
<?php $datos->cerrar(); ?>
