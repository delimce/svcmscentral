<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/tools.php");

	$tool = new tools();
	$tool->autoconexion();
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Administrador del Sistema de Contenidos</title>
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

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>


</head>

<body OnLoad="javascript:supermenu.supermenu1.focus();" >
<!--INCLUDES-->
<?php include("include-menu-salir.php");?>
<?php include "include-menu.php"?>
<?php include "include-mensajes.php"?>

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="header.jpg" width="900" height="130"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<!-- SUPER MENU !!!!! -->
<tr><td><?php include ("supermenu.php")?></td></tr>
<!--//////////  SUPER MENU !!!!! -->
         


 <tr>
            <td class="td-titulo1">Panel de Control
              de <?php echo $_SESSION['STITULO']  ?></td>
          </tr>
          <tr>
            <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td class="td-texto1"><p>Desde esta aplicaci&oacute;n usted podr&aacute; controlar
                  todos los aspectos relacionados con su p&aacute;gina web desarrollada con <strong>Pagina Inteligente</strong>. Adem&aacute;s del enlace principal a cada secci&oacute;n usted podr&aacute; ubicar, para acceso r&aacute;pido, <strong>enlaces directos a las funciones m&aacute;s importantes</strong> del sistema en el texto descriptivo de cada m&oacute;dulo.</p>
<p>POR FAVOR, NO DEJE DE LEER LA AYUDA antes de comenzar a trabajar con su p&aacute;gina web. Adicionalmente, puede obtener ayuda cada vez que vea&nbsp; el signo  <a href="javascript:;" onClick="MM_openBrWindow('help/index.php','','scrollbars=yes,resizable=yes,width=900,height=550')" title="HAGA CLICK AQUI &iexcl;AHORA!"><img src="icon/icon-info.gif" alt="Ayuda" width="16" height="16" border="0" align="absmiddle" ></a> cerca
                  de los t&iacute;tulos de las operaciones complejas del sistema. </p>
<p style="text-align:center; color:#F00; font-weight:bold;">Le aconsejamos firmemente que&nbsp; utilice <strong><a href="http://www.mozilla.com/es/firefox/" target="_blank">MOZILLA FIREFOX</a></strong> para trabajar con este administrador de contenidos.<br>
Es decir: NO USE INTERNET EXPLORER.</p></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>


<!-- NEW SHIT %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<!-- ayuda -->
<div id="menucontainer">

<div id="imagen">
<a href="help/index.php"  title="LEA LA AYUDA PRIMERO">
<img src="botones-admin/boton-ayuda.png" width="238" height="158" alt="ayuda">
</a>
</div>

<div id="titulo"> 
<a href="help/intro.php" >Lea la  Ayuda Por Favor
</a>
</div>

<div id="descripcion">
T&oacute;mese un tiempo para <a href="help/intro.php" >conocer el sistema</a>, sus posibilidades, limitaciones y caracter&iacute;sticas. Aprenda c&oacute;mo <a href="help/editar-index.php" >configurar su&nbsp; p&aacute;gina principal</a>, <a href="help/contenido-texto-articulo.php" > manejar el editor de texto de las p&aacute;ginas</a>, <a href="help/contenido-arbol.php" >manejar el sistema de contenido</a>, <a href="help/productos-arbol.php" >manejar sus productos</a>, <a href="help/banners.php" >banners</a>, <a href="help/pagos.php" >pagos</a>, <a href="help/usuarios-busqueda.php" >usuarios</a>, <a href="help/imagenes/index.html" >manejo de sus&nbsp; im&aacute;genes para la&nbsp; p&aacute;gina</a>...


</div>
</div>
















<!-- opciones -->

<div id="menucontainer">

<div id="imagen">
<a href="opciones.php"  title="Opciones del Sistema">
<img src="botones-admin/boton-opciones.png" width="238" height="158" alt="Opciones del Sistema">
</a>
</div>

<div id="titulo"> 
<a href="opciones.php" >Opciones del Sistema
</a>
</div>

<div id="descripcion"><a href="opciones-sm.php">Enviar correos a todos sus usuarios registrados.</a>
Hacer <a href="opciones-backup.php">Backup</a>. Cambiar los <a href="opciones-admin-identidad.php">datos de la empresa</a>, cambiar los <a href="opciones-mensajes.php">e-mails automátios que envía el sistema</a>, cambiar el <a href="opciones-popups.php">color de los popups del sistema</a>, opciones de <a href="opciones-moneda.php">precios y moneda</a>, <a href="opciones-mensajes.php">editar e-mails autom&aacute;ticos</a> y más...


</div>
</div>






































<!-- index -->
<div id="menucontainer">

<div id="imagen">
<a href="edit_index/editar-index.php"  title="Editar Index o p&aacute;gina principal">
<img src="botones-admin/boton-index.png" width="238" height="158" alt="Editar Index o p&aacute;gina principal">
</a>
</div>

<div id="titulo"> 
<a href="edit_index/editar-index.php" >Editar Página Principal
</a>
</div>

<div id="descripcion">
Editar el contenido de su P&aacute;gina Principal o Index. Colocar videos. Crear bloques de destacados.  Modificar el contenido del <em><strong>Footer</strong></em> o pie de p&aacute;gina.


</div>
</div>










 <?php if(in_array(1,$_SESSION['MODULOS'])){ ?>

<!-- contenido -->

<div id="menucontainer">

<div id="imagen">
<a href="contenido/main.php"  title="Editar p&aacute;ginas informativas">
<img src="botones-admin/boton-contenidos.png" width="238" height="158" alt="Editar p&aacute;ginas informativas">
</a>
</div>

<div id="titulo"> 
<a href="contenido/main.php" >Manejar Páginas
</a>
</div>

<div id="descripcion">
<a href="contenido/arbol.php">Manejar Categor&iacute;as, Subcategor&iacute;as y P&aacute;ginas Informativas del Web Site</a>.  Cree campos adicionales. Decida el nivel de privacidad de las categor&iacute;as.


</div>
</div>
<?php } ?>










 <?php  if(in_array(2,$_SESSION['MODULOS'])){ ?>

<!-- productos -->

<div id="menucontainer">

<div id="imagen">
<a href="productos/main.php"  title="Editar Productos">
<img src="botones-admin/boton-productos.png" width="238" height="158" alt="Editar Productos">
</a>
</div>

<div id="titulo"> 
<a href="productos/main.php" >Manejar Productos
</a>
</div>

<div id="descripcion">
<a href="productos/productos.php">Manejar Categor&iacute;as y productos en el cat&aacute;logo de productos:</a> Editar toda la información de sus categorias y productos (descripción, fotos, precios, videos, etc). <a href="productos/productos-fastedit.php">Edici&oacute;n r&aacute;pida de productos.</a></div>
</div>




<?php } ?>





<?php  if(in_array(3,$_SESSION['MODULOS'])){ ?>
<!-- usuarios -->

<div id="menucontainer">

<div id="imagen">
<a href="usuarios/index.php"  title="Usuarios Registrados">
<img src="botones-admin/boton-usuarios.png" width="238" height="158" alt="Usuarios Registrados">
</a>
</div>

<div id="titulo"> 
<a href="usuarios/index.php" >Usuarios Registrados
</a>
</div>

<div id="descripcion">
Buscar, Editar, Borrar, <a href="usuarios/agregarc.php">Crear</a>, Activar y Desactivar usuarios registrados en su P&aacute;gina Web.  <a href="usuarios/categorias.php">Crear categorías</a> para clasificar a sus usuarios y así poder asignarles descuentos en precios y páginas privadas.


<a href="usuarios/datos-adicionales.php">Agregar campos</a> a la&nbsp; base de datos de usuarios. <a href="opciones-copiar-direcciones.php">Copiar e-mails de todos sus usuarios.</a></div>
</div>















<?php  if(in_array(2,$_SESSION['MODULOS'])){ ?>

<!-- ordenes de compra -->

<div id="menucontainer">

<div id="imagen">
<a href="productos/ordenes.php"  title="&Oacute;rdenes de compra">
<img src="botones-admin/boton-ordenes-compra.png" width="238" height="158" alt="&Oacute;rdenes de compra">
</a>
</div>

<div id="titulo"> 
<a href="productos/ordenes.php" >&Oacute;rdenes de Compra
</a>
</div>

<div id="descripcion">
 <a href="productos/ordenes.php">Vea las &oacute;rdenes de compra</a> realizadas por sus usuarios registrados, edite los cargos por  envío y otros recargos o descuentos, luego envíe estado de cuenta a sus clientes para que puedan realizar  y reportar los pagos.


</div>
</div>



















<?php  if(in_array(4,$_SESSION['MODULOS'])){ ?>

<!-- pagos -->

<div id="menucontainer">

<div id="imagen">
<a href="pagos/main.php"  title="Pagos reportados por los usuarios">
<img src="botones-admin/boton-pagos.png" width="238" height="158" alt="Pagos reportados por los usuarios">
</a>
</div>

<div id="titulo"> 
<a href="pagos/main.php" >Pagos por Dep&oacute;sito Bancario
</a>
</div>

<div id="descripcion">
<a href="pagos/main.php">Ver los reportes de pagos</a> realizados por los usuarios registrados vía depósito o transferencia bancarias. Acepte, rechace e imprima los reportes de pago. <a href="pagos/datosdepago.php">Modifique sus datos de pago. </a></div>
</div>
































 <?php  if(in_array(5,$_SESSION['MODULOS'])){ ?>

<!-- mensajes -->

<div id="menucontainer">

<div id="imagen">
<a href="mensajes/main.php"  title="Mensajes escritos por sus usuarios en  sus  p&aacute;ginas">
<img src="botones-admin/boton-mensajes.png" width="238" height="158" alt="Mensajes escritos por sus usuarios en  sus p&aacute;ginas">
</a>
</div>

<div id="titulo"> 
<a href="mensajes/main.php" >Mensajes Tipo Blog
</a>
</div>

<div id="descripcion">
Ver una lista de los mensajes escritos por los usuarios registrados en las p&aacute;ginas de art&iacute;culos que tengan esta opci&oacute;n activada (Estos mensajes son públicamente visibles en la  página web).  Conteste o  borre los mensajes que reciba por esta v&iacute;a.


</div>
</div>



<?php } ?>
<?php } ?>
<?php } ?>


 <?php } ?>
















                  <?php  if(in_array(6,$_SESSION['MODULOS'])){ ?>


<!-- banners -->

<div id="menucontainer">

<div id="imagen">
<a href="banners/main.php"  title="Banners  o anuncios en  su  página web">
<img src="botones-admin/boton-banners.png" width="238" height="158" alt="Banners o  anuncios en  su página web">
</a>
</div>

<div id="titulo"> 
<a href="banners/main.php" >Banners  o  Anuncios
</a>
</div>

<div id="descripcion">
Crear, modificar y borrar banners o anuncios publicitarios en la p&aacute;gina web.


</div>
</div>



 <?php } ?>

































<!-- NEW SHIT %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
</td>
              </tr>
           

                  
           


              <tr>
                <td class="td-refooter"></td>
              </tr>
              <tr>
                <td class="td-refooter">

<a href="http://www.mozilla.com/es/firefox/" target="_blank"><img src="firefox-download-logo.jpg" alt="Descargue FireFox" width="334" height="121" border="0"></a>&nbsp; &nbsp; 

<a href="http://proyectointernet.posterous.com" title="Blog Proyecto Internet" target="_blank"><img src="icon/banner-blog.jpg" alt="Blog Proyecto Internet" border="0"></a>


</td>
              </tr>
            </table></td>
</tr>
<tr>
<td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank" >Proyecto Internet</a></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<? $tool->cerrar(); ?>