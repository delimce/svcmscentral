<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/clases.php");

$tool = new tools();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Opciones Generales</title>
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
<!--INCLUDES-->
<?php include("include-menu-salir.php");?>
<?php include "include-menu2.php" ?>
<?php include "include-mensajes.php"?>
<!--INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td><a href="main.php"><img src="header-backup.jpg" width="900" height="130"></a></td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<!-- SUPER MENU !!!!! -->
<tr><td><?php include ("supermenu.php")?></td></tr>
<!--//////////  SUPER MENU !!!!! -->

       <tr>
        <td class="td-titulo1">backup</td>
       </tr>
       <tr>
        <td><form name="form1" method="post" action="">
          <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
           <tr>
            <td class="td-texto1"><p>Descargue&nbsp; la base de datos,  los archivos adicionales (imagenes  y archivos adjuntos de art&iacute;culos y productos) y los archivos del front de su&nbsp; p&aacute;gina web.<br>
            </p>           </td>
           </tr>
           <tr>
             <td class="td-headertabla">Base de datos del contenido de su web site</td>
           </tr>
           <tr>
             <td class="td-texto1"><p>Contiene la estructura de categor&iacute;as de art&iacute;culos y/o productos, texto de la&nbsp; p&aacute;gina principal, preferencias,&nbsp; enlaces y todos los textos que usted carg&oacute; en su&nbsp; p&aacute;gina web hasta el momento en el que descargue el backup.</p>
               <p>Usted no&nbsp; podr&aacute; hacer un restore de este backup pero si podr&aacute; cualquier asesor&nbsp; o dise&ntilde;ador web con conocimientos de SQL. (incluyendo nosotros mismos).</p>
               <p>Al mandar a hacer el&nbsp; backup, es probable que el sistema se tarde un tiempo comprimiendo la base de datos y prepar&aacute;ndola. Sea Paciente.</p></td>
           </tr>
           <tr>
             <td class="td-mensajes1">

<a href="opciones-backup-db.php" title="Hacer Backup de base de datos de contenido"><img src="icon/boton-hacerbackup-de-bd.jpg" alt="Hacer Backup de base de datos de contenido" border="0"></a></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td class="td-headertabla">Im&aacute;genes y Archivos Adjuntos</td>
           </tr>
           <tr>
             <td class="td-texto1"><p>Contiene todas las <strong>imagenes y archivos adjuntos</strong> de art&iacute;culos y/o productos que&nbsp; <strong>usted</strong> carg&oacute; a su p&aacute;gina web! Este archivo puede ser muy grande si&nbsp; usted ha subido una gran cantidad de archivos a su p&aacute;gina web. Sea m&aacute;s paciente aun. Este backup NO incluye los archivos realizados por nosotros en el front de su&nbsp; pagina, que son parte del dise&ntilde;o.</p>                 </td>
           </tr>
           <tr>
             <td class="td-mensajes1">



<a href="opciones-backup-zipdir.php" title="Hacer Backup imágenes y Archivos Adjuntos"><img src="icon/boton-hacerbackup-de-archivos.jpg" alt="Hacer Backup de base de datos de contenido" border="0"></a></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
           </tr>
           
           <tr>
             <td class="td-headertabla">Archivos del FRONT de su Web Site</td>
           </tr>
           <tr>
             <td class="td-texto1"><p>El Front es&nbsp; la cara p&uacute;blica de su&nbsp; p&aacute;gina web. Estos son los archivos producidos por nosotros durante el proceso de programaci&oacute;n y dise&ntilde;o. Estos archivos son la fachada de la&nbsp; p&aacute;gina web y es mas o menos la mitad del trabajo. Usted tiene derecho a conservarlos. Si usted nos solicit&oacute; hacer un backup de los archivos&nbsp; del front  de su web site, Deber&iacute;a encontrar el link aqui en esta secci&oacute;n. Si usted desea descargar el backup&nbsp; del front de su Web Site y no encuentra el  link aqu&iacute;, por favor comun&iacute;quese con nosotros&nbsp; para realizar el backup y colocarselo aqui. (Alguinos costos puede que apliquen)</p></td>
           </tr>
           
           <tr>
             <td>

			<iframe src="<?php echo $_SESSION['SURL'].'/backup/';  ?>" width="679" height="400" scrolling="auto" frameborder="0" marginheight="0" marginwidth="0" name="backup" id="backup"></iframe>			</td>
           </tr>
           <tr>
            <td>&nbsp;</td>
           </tr>
           <tr>
             <td align="center">&nbsp;
               <input name="Submit2" type="button" class="form-button" onClick="history.back();" value="Regresar"></td>
           </tr>
           <tr>
             <td align="center">&nbsp;</td>
           </tr>
          </table>
         </form>        </td>
       </tr>
       <tr>
        <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto
          Internet</a></td>
       </tr>
      </table>     </td>
     </tr>
   </table>
  </td>
 </tr>
</table>

</body>
</html>
<?php $tool->cerrar(); ?>
