<?php session_start();
 include('SVsystem/config/dbconfig.php');
 include('SVsystem/class/tools.php');

$tool = new tools();
$tool->autoconexion();    

$data = $tool->simple_db("select moneda_simbolo,moneda_factor,iva,popup_style from preferencias");   


$tool->cerrar();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Solicitud de registro enviada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data['popup_style'] ?>" rel="stylesheet" type="text/css">


<!--FIN ESTILOS-->


</head>

<body class="body-popup">
<div class="popup-titulo">Solo un paso mas...</div>
<div class="popup-mensajes">
  <p>Un correo de confirmaci&oacute;n ha sido enviado a la direcci&oacute;n de&nbsp; email que&nbsp; usted suscribi&oacute;. Usted deber&aacute; activar su cuenta para poder tener acceso a nuestro sistema de usuarios registrados. </p>
  <p>Si el correo no le llega en&nbsp; 10 minutos, <strong>revise su carpeta de spam o &quot;Correo no deseado&quot;</strong> y  m&aacute;rque nuestro mensaje como &quot;No es Spam&quot;.</p>

<p>Al Activar su cuenta usted acceder&aacute; autom&aacute;ticamente&nbsp; a su p&aacute;gina de usuario y podr&aacute; realizar operaciones en  nuestra p&aacute;gina web.
</p>


</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td align="center">&nbsp;</td>
  </tr>
  <tr>
   <td width="50%" align="center">&nbsp; 
   
   <input name="Submit2" type="button" class="popup-form-button" value="OK, voy a revisar mi correo ahora" onClick="window.close();"></td></tr>
 </table>
</body>
</html>
