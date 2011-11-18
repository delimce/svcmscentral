<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();


	if(isset($_REQUEST['r-banco'])){
	
			$tool->insert_data("r","-","pago_datos",$_POST);	
			$tool->javaviso("Nueva cuenta creada con exito","cerrar");
	
	}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Agregar cuenta Bancaria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>

<body class="body-popup">
<div class="td-titulo-popup">Agregar cuenta Bancaria</div>



<form name="form1" action="" method="post">
<table width="100%" border="0" cellspacing="4" cellpadding="0">
<tr>
<td width="25%" height="20" class="td-form-title">Banco</td>
<td width="75%"><input name="r-banco" type="text" class="form-box" id="r-banco" size="60"></td>
</tr>
<tr>
<td class="td-form-title">N&uacute;mero de cuenta (20 digitos!)</td>
<td><input name="r-ncuenta" type="text" class="form-box" id="r-ncuenta" size="30"></td>
</tr>
<tr>
<td class="td-form-title">Beneficiario<br>
</td>
<td><input name="r-nombre" type="text" class="form-box" id="r-nombre" size="50">
</td>
</tr>
<tr>
<td class="td-form-title">Rif / CI</td>
<td><input name="r-rif" type="text" class="form-box" id="r-rif" size="25"></td>
</tr>
<tr>
<td class="td-form-title">E-Mail</td>
<td><input name="r-email" type="text" class="form-box" id="r-email" size="50"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="Submit" type="submit" class="form-button" value="OK">
&nbsp;
<input name="Submit2" type="button" class="form-button" value="Cancelar" onClick="window.close();">
</td>
</tr>
</table>
</form>

</body>
</html>
