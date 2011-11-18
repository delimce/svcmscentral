<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Ayuda - Emails autom&aacute;ticos a los usuarios y a usted</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">
<div class="td-titulo-popup">Mensajes autom&aacute;ticos </div>
<div class="textohelp">
 <p class="help-boton-volver"><a href="index.php"><img src="../icon/icon-left.gif" width="16" height="16" border="0" align="absmiddle"> Volver
   al índice de la ayuda</a></p>
<p>Los mensajes autom&aacute;ticos son emails que se env&iacute;an tanto al usuario que realiza alguna operaci&oacute;n en su sitio web como a usted; para mantenerles apropiadamente informados de sucesos importantes en los procesos&nbsp; que se llevan a cabo. Usted debe ecribir en las casillas respectivas el subject y el cuerpo de los correos que se env&iacute;an.</p>
<p> Por ejemplo... <strong>cu&aacute;ndo se registra un nuevo usuario</strong>, el sistema envia un email de notificaci&oacute;n, tanto al usuario como a usted. En esta secci&oacute;n <strong>usted podr&aacute; redactar lo que &eacute;stos emails dicen</strong>.</p>
<p class="help-boxdestacado"> Estos mensajes dar&aacute;n la cara por usted ante sus usuarios, es muy importante que los redacte adecuadamente.</p>
<p>En la redacci&oacute;n del cuerpo de cada email, usted puede utilizar estos <a href="javascript:;" class="help-link-explicativo" title="caracteres que le dan formato al texto que escribe">tags html</a> para darle formato a su mensaje:</p>
<p>&lt;b&gt;<strong>texto en negritas</strong>&lt;/b&gt;<br>
&lt;p&gt;texto en forma de p&aacute;rrafos&lt;/p&gt;<br>
&lt;p align=&quot;right&quot;&gt;texto en forma de p&aacute;rrafo alineado a
la derecha&lt;/p&gt;<br>
Salto de l&iacute;nea sencillo: &lt;br&gt;</p>
<p><strong><a href="html.php">&lt;M&aacute;s ayuda sobre el texto en html&gt;</a></strong></p>
<p class="help-subtitulo">Variables utilizables en los mensajes</p>
<p>Si usted desea incluir algun dato variable en los mensajes como, monto de una orden de compra,&nbsp; datos de un usuario, su correo, etc,&nbsp; utilice estas variables para redactar sus mensajes. Utilice las variables en cada m&oacute;dulo correspondiente o no se mostrar&aacute;n adecuadamente. Solo debe copiar el nombre de la variable que desea utilizar e integrarla dentro de su mensaje.</p>
<p><strong>Ejemplo:</strong></p>
<p>En &quot;Usuario realiza una nueva orden de compra&quot;, usted querr&iacute;a&nbsp; colocar
 algo como:</p>
<p class="help-boxdestacado">Muchas gracias $nombre_email ! su orden de compra
 ha sido recibida el d&iacute;a $fecha_orden</p>
<p class="help-subtitulo2">Usuario realiza una nueva orden de compra</p>
<p> <strong>nombre del usuario</strong>: $nombre_email<br>
 <strong>Monto de la orden:</strong> $montocompra<br>
<strong>email del usuario:</strong> $email_send<br>
<strong>id de la orden de compra:</strong> $orden_id<br>
<strong>fecha de la orden de compra</strong> : $fecha_orden<br>
<strong>Nombre de la Empresa:</strong> $nombre_empresa<br>
<strong>Direccion o URL de la P&aacute;gina Web:</strong> $url_empresa<br>
</p>
<p class="help-subtitulo2">Orden de compra es revisada por el administrador del
 web site</p>
<p> <strong>nombre del usuario:</strong> $nombre_email<br>
 <strong>Monto de la orden:</strong> $montocompra<br>
<strong>email del usuario:</strong> $email_send<br>
<strong>estatus de la orden de compra</strong>: $estatus_orden<br>
<strong>fecha de la orden de compra</strong> : $fecha_orden <br>
<strong>Nombre de la Empresa:</strong> $nombre_empresa<br>
<strong>Direccion o URL de la P&aacute;gina Web:</strong> $url_empresa<br>
<strong>Cedula del Cliente:</strong> $rif <br>
<strong>Productos en la orden de compra:</strong> $productos_orden<br>
<strong>Notas al usuario</strong> (Lo que usted le haya escrito al&nbsp; usuario en&nbsp; el campo &quot;notas&quot; en M&oacute;dulo de usuarios / editar detalles de usuario): $notasusuario </p>


<p class="help-subtitulo2">Se registra un nuevo usuario</p>
<p> <strong>nombre del usuario:</strong> $usern<br>
<strong>email del usuario:</strong> $usere<br>
<strong>clave del usuario:</strong> $claven<br>
<strong>Nombre de la Empresa:</strong> $nombre_empresa<br>
<strong>Direccion o URL de la P&aacute;gina Web:</strong> $url_empresa</p>


<p class="help-subtitulo2">Se Activa un usuario</p>
<p> <strong>nombre del usuario:</strong> $usern<br>
<strong>email del usuario:</strong> $usere<br>
<strong>clave del usuario:</strong> $claven<br>
<strong>Nombre de la Empresa:</strong> $nombre_empresa<br>
<strong>Direccion o URL de la P&aacute;gina Web:</strong> $url_empresa</p>
<p>&nbsp;</p>


<p class="help-subtitulo2">Todos los e-mails de reportes de pagos (Reporte de
 Pago, Pago Negado y Pago Aprobado)</p>
<p> <strong>nombre del usuario:</strong> $nombre_email<br>
 <strong>email del usuario:</strong> $email_send<br>
<strong>concepto o descripci&oacute;n del pago:</strong> $conceptop<br>
<strong>banco:</strong> $bancop<br>
<strong>monto depositado:</strong> $montop<br>
<strong>fecha del pago:</strong> $fechap <br>
<strong>estatus del pago:</strong> $estatus_pago<br>
<strong>Nombre de la Empresa:</strong> $nombre_empresa<br>
<strong>Direccion o URL de la P&aacute;gina Web:</strong> $url_empresa<br>
<strong>N&uacute;mero de la transacci&oacute;n:</strong> $numerop </p>
<p class="help-subtitulo2">Comentario enviado por usuario en alg&uacute;n art&iacute;culo del sitio web</p>
<p> <strong>Nombre de usuario:</strong> $nombre_email<br>
<strong>Email del usuario:</strong> $email_send<br>
<strong>El articulo donde se escribi&oacute; el comentario:</strong> $mensaje_origen<br>
<strong>Nombre de la Empresa:</strong> $nombre_empresa<br>
<strong>Direccion o URL de la P&aacute;gina Web:</strong> $url_empresa<br>
<strong>Contenido del Comentario:</strong> $mensaje_contenido <br>
<strong>T&iacute;tulo del comentario:</strong> $mensaje_titulo </p>



<p class="help-subtitulo2">Usuario crea un nuevo art&iacute;culo en una categor&iacute;a</p>
<p> <strong>id del articulo creado por el usuario:</strong> $NUEVO_ID<br>
<strong>nombre del usuario que cre&oacute; el nuevo art&iacute;culo:</strong> $usuario<br>
<strong>Nombre de la Empresa:</strong> $nombre_empresa<br>
<strong>Direccion o URL de la P&aacute;gina Web:</strong> $url_empresa</p>
<p class="help-boton-volver"><a href="index.php"><img src="../icon/icon-left.gif" width="16" height="16" border="0" align="absmiddle"> Volver
  al índice de la ayuda</a></p>
</div>
</body>
</html>
