<?php session_start();
 include('SVsystem/config/dbconfig.php');
 include('SVsystem/class/clases.php');

$tool = new tools('db');

	$data = $tool->simple_db("select popup_style from preferencias");   




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Seleccione su  m&eacute;todo de Pago</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data ?>" rel="stylesheet" type="text/css">




</head>

<body class="body-popup">
<div class="popup-titulo">Seleccione su m&eacute;todo de pago</div>
<div class="popup-mensajes"> <p>Seleccione el m&eacute;todo con el que desea pagar esta orden de compra. #<?php echo $_REQUEST['id']  ?></p>
<p>
<strong>Productos en la Orden:</strong> [Productos Aqui]<br/>
<strong>Monto Neto:</strong>[Moneda] [Monto de la orden sin impuestos]<br/>
<strong>Impuesto:</strong>[Moneda] [IVA]<br/>
<strong>Monto total a Pagar:</strong>[Moneda] [Monto Total]

</p>
</div>


 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td width="50%" align="center">&nbsp;</td>
   <td width="50%" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td >
<center>
<a href="SV-popup-form-pago.php?ordenid=<?php echo $_REQUEST['id']  ?>"><img src="http://www.svcmscentral.com/admin/icon/icon-pago-deposito.png" alt="Pago por deposito o transferencia bancaria" border="0"></a>
</center>
</td>

    <td>
<center>
<a href="SV-paypal.php?ordenid=<?php echo $_REQUEST['id'] ?>"><img src="http://www.svcmscentral.com/admin/icon/icon-pago-paypal.png" alt="Pago vía Paypal con su tarjeta de crédito" border="0"></a>
</center>
</td>
  </tr>
  <tr>
   <td width="50%" align="center"><a href="SV-popup-datos-pago.php" target="_blank">Ver Cuentas Bancarias</a></td>
   <td width="50%" align="center">&nbsp;</td>
  </tr>
 </table>

<div align="center"><input name="Submit32" type="button" onClick="window.close();" class="popup-form-button" value="Oops! Todavía no quiero pagar, Ya  vuelvo"></div>

</body>
</html>
<?php $tool->cerrar(); ?>