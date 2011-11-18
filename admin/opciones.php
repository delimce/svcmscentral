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
</script>
<style type="text/css">
<!--
.style1 {color: #990000}
-->
</style>


</head>

<body>



<?php include ("n-encabezado.php")?>
<div id="ncuerpo">
<?php include ("n-include-mensajes.php")?>
<div id="ncontenedor">
<div id="nnavbar"><?php include "n-include-menu.php"?></div>




<div id="ntitulo">Opciones del Sistema</div>
<div id="ninstrucciones">
Aquí usted puede administrar las opciones generales del sistema de manejo de contenidos de su Web site.
</div>


<div id="ncontenido">



<div id="nbotoneshome" style="margin:0 0 0 55px;">
<!-- NEW SHIT %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<!-- ayuda -->
<div id="menucontainer">

<div id="imagen">
<a href="opciones-backup.php"  title="Backup">
<img src="botones-admin/boton-opciones-backup.png" width="238" height="158" alt="Backup">
</a>
</div>

<div id="titulo"> 
<a href="opciones-backup.php" >Backup</a>
</div>

<div id="descripcion">Descargue la base de datos, los archivos adicionales (imagenes y archivos adjuntos de artículos y productos) y los archivos del front de su página web.</div>
</div>
















<!-- opciones -->

<div id="menucontainer">

<div id="imagen">
<a href="opciones-admin-identidad.php"  title="Identidad de la Empresa">
<img src="botones-admin/boton-opciones-identidad.png" width="238" height="158" alt="Identidad de la Empresa">
</a>
</div>

<div id="titulo"> 
<a href="opciones-admin-identidad.php" >Identidad de la&nbsp; Empresa</a>
</div>

<div id="descripcion">Nombre y dirección del usuario administrador del sitio web. Desde esta dirección y a esta direcion llegan los correos relacionados con las operaciones del sitio.</div>
</div>

















































 <?php if(in_array(1,$_SESSION['MODULOS'])){ ?>

<!-- contenido -->

<div id="menucontainer">

<div id="imagen">
<a href="contenido/opciones.php"  title="Opciones del modulo de contenidos">
<img src="botones-admin/boton-opciones-contenido.png" width="238" height="158" alt="Opciones del modulo de contenidos">
</a>
</div>

<div id="titulo"> 
<a href="contenido/opciones.php" >Opciones del m&oacute;dulo de contenidos</a>
</div>

<div id="descripcion">Modifique ciertos parámetros generales para los artículos y categorías del módulo de contenidos de su Sitio Web.</div>
</div>
<?php } ?>










 <?php  if(in_array(2,$_SESSION['MODULOS'])){ ?>

<!-- productos -->

<div id="menucontainer">

<div id="imagen">
<a href="opciones-moneda.php"  title="Moneda y Precios">
<img src="botones-admin/boton-opciones-moneda.png" width="238" height="158" alt="Moneda y Precios">
</a>
</div>

<div id="titulo"> <a href="opciones-moneda.php" >Moneda y Precios</a></div>
<div id="descripcion">Cambiar la moneda en la que se encuentran los precios del catálogo de productos. Transformar los precios de una moneda a otra; Manejar el monto del IVA. Decidir si los precios se muestran o no en la página web.</div>
</div>






<?php } ?>





<?php  if(in_array(3,$_SESSION['MODULOS'])){ ?>
<!-- usuarios -->

<div id="menucontainer">

<div id="imagen">
<a href="opciones-popups.php"  title="Estilo de los Popups">
<img src="botones-admin/boton-opciones-estilospopups.png" width="238" height="158" alt="Estilo de los Popups">
</a>
</div>

<div id="titulo"> 
<a href="opciones-popups.php" >Estilo de los Popups</a>
</div>

<div id="descripcion">Aqui usted podrá cambiar el diseño (colores) de los popups o ventanas emergentes de su página web.</div>
</div>





<!-- mensajes -->

<div id="menucontainer">

<div id="imagen">
<a href="opciones-mensajes.php"  title="Emails automaticos que envia el sistema">
<img src="botones-admin/boton-opciones-emailsautomaticos.png" width="238" height="158" alt="Emails automaticos que envia el sistema">
</a>
</div>

<div id="titulo"> 
<a href="opciones-mensajes.php" >Emails autom&aacute;ticos</a>
</div>

<div id="descripcion">Configurar los mensajes que se envían por correo tanto a los usuarios como al administrador cuando se efectúa alguna operación importante en el sitio web, tanto en la parte pública como en este administrador.</div>
</div>









<?php  if(in_array(2,$_SESSION['MODULOS'])){ ?>

<!-- ordenes de compra -->

<div id="menucontainer" style="display:none;">

<div id="imagen">
<a href="productos/ordenes.php"  title="&Oacute;rdenes de compra">
<img src="botones-admin/boton-ordenes-compra.png" width="238" height="158" alt="&Oacute;rdenes de compra">
</a>
</div>

<div id="titulo"> 
<a href="productos/ordenes.php" >&Oacute;rdenes de Compra
</a>
</div>

<div id="descripcion"></div>
</div>



















<?php  if(in_array(4,$_SESSION['MODULOS'])){ ?>

<!-- pagos -->

<div id="menucontainer">

<div id="imagen">
<a href="pagos/datosdepago.php"  title="Editar datos de Pago">
<img src="botones-admin/boton-opciones-datosdepago.png" width="238" height="158" alt="Editar datos de Pago">
</a>
</div>

<div id="titulo"> 
<a href="pagos/datosdepago.php" >Editar Datos de Pago
</a>
</div>

<div id="descripcion">Modifique aqui los datos de sus cuentas bancarias para que sus usuarios  sepan a dónde transferir sus pagos. Aquí tambien puede editar el email de su cuenta Paypal (si aplicare).</div>
</div>

































<?php } ?>
<?php } ?>


 <?php } ?>
















                  <?php  if(in_array(6,$_SESSION['MODULOS'])){ ?>


<!-- banners -->

<div id="menucontainer" style="display:none;">

<div id="imagen">
<a href="banners/main.php"  title="Banners  o anuncios en  su  página web">
<img src="botones-admin/boton-banners.png" width="238" height="158" alt="Banners o  anuncios en  su página web">
</a>
</div>

<div id="titulo"> 
<a href="banners/main.php" >Banners  o  Anuncios
</a>
</div>

<div id="descripcion"></div>
</div>



 <?php } ?>










<div id="menucontainer">

<div id="imagen">
<a href="opciones-imagenes.php"  title="Editar Index o p&aacute;gina principal">
<img src="botones-admin/boton-opciones-tamanoimagenes.png" width="238" height="158" alt="Editar Index o p&aacute;gina principal">
</a>
</div>

<div id="titulo"> 
<a href="opciones-imagenes.php" >Tamaño de las Imágenes
</a>
</div>

<div id="descripcion">Opción avanzada  para cambiar las medidas a las que el sistema transforma las imagenes que usted sube.</div>
</div>























<!-- NEW SHIT %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<div id="nseparador"></div>
</div>






<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?>
</body>
</html>
