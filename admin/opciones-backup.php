<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/clases.php");

$tool = new tools();
$tool->autoconexion();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Hacer Backup</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->


//-->
</script>


</head>

<body>




<?php include ("n-encabezado.php")?>
<div id="ncuerpo">
<?php include ("n-include-mensajes.php")?>
<div id="ncontenedor">
<div id="nnavbar"><?php include "n-include-menu2.php"?></div>




<div id="ntitulo">Haga Respaldo (Backup) de su Informaci&oacute;n </div>
<div id="ninstrucciones">Descargue&nbsp; la base de datos,  los archivos adicionales (imagenes  y archivos adjuntos de art&iacute;culos y productos) y los archivos del front de su&nbsp; p&aacute;gina web.</div>


<div id="ncontenido">
<div id="nbloque">
<h1>Base de datos del contenido de su web site</h1>
<p>Contiene la estructura de categorías de artículos y/o productos, texto de la página principal, preferencias, enlaces y todos los textos que usted cargó en su página web hasta el momento en el que descargue el backup.</p>

<p>Sin conocimientos avanzados, usted no podrá hacer un restore de este backup pero si podrá cualquier asesor o diseñador web con conocimientos de SQL. (incluyendo nosotros mismos).</p>

<p>Al mandar a hacer el backup, es probable que el sistema se tarde un tiempo comprimiendo la base de datos y preparándola. Sea Paciente.</p>

<div id="botonsotes"><a href="opciones-backup-db.php" title="Hacer Backup de base de datos de contenido"><img src="icon/boton-hacerbackup-de-bd.jpg" alt="Hacer Backup de base de datos de contenido" border="0"></a></div>


</div>



<div id="nbloque">
<h1>Imágenes y Archivos Adjuntos</h1>
<p>Contiene todas las imagenes y archivos adjuntos de artículos y/o productos que usted cargó a su página web! Este archivo puede ser muy grande si usted ha subido una gran cantidad de archivos a su página web. Sea más paciente aun. Este backup NO incluye los archivos realizados por nosotros en el front de su pagina, que son parte del diseño.</p>

<div id="botonsotes"><a href="opciones-backup-zipdir.php" title="Hacer Backup imágenes y Archivos Adjuntos"><img src="icon/boton-hacerbackup-de-archivos.jpg" alt="Hacer Backup de base de datos de contenido" border="0"></a></div>

</div>



<div id="nbloque">
<h1>Archivos del FRONT de su Web Site</h1>
<p>El Front es la cara pública de su página web. Estos son los archivos producidos por nosotros durante el proceso de programación y diseño. Estos archivos son la fachada de la página web y es mas o menos la mitad del trabajo. Usted tiene derecho a conservarlos. Si usted nos solicitó hacer un backup de los archivos del front de su web site, debería encontrar el link aqui en esta sección. Si usted desea descargar el backup del front de su Web Site y no encuentra el link aquí, por favor comuníquese con nosotros para realizar el backup cargar aquí el archivo.</p>

<div  id="botonsotes"><iframe src="<?php echo $_SESSION['SURL'].'/backup/';  ?>" width="679" height="300" scrolling="auto" frameborder="0" marginheight="0" marginwidth="0" name="backup" id="backup"></iframe></div>

</div>











<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?>
</body>
</html>
<?php $tool->cerrar(); ?>
