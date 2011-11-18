<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Editar cuenta Bancaria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>

<body class="body-popup">
<div class="td-titulo-popup">Editar cuenta Bancaria</div>




<table width="100%" border="0" cellspacing="4" cellpadding="0">
<tr>
<td width="23%" height="20" class="td-form-title">Banco</td>
<td width="77%"><input name="banco" type="text" class="form-box" id="banco" size="60">
<span class="td-content">
<input name="ide" type="hidden" id="ide" value="<?=$_REQUEST['id']?>">
</span> </td>
</tr>
<tr>
<td class="td-form-title">N&uacute;mero de cuenta (20 digitos!)</td>
<td><input name="cuenta" type="text" class="form-box" id="cuenta" size="30"></td>
</tr>
<tr>
<td class="td-form-title">Beneficiario<br>
</td>
<td><input name="beneficiario" type="text" class="form-box" id="beneficiario" size="50">
</td>
</tr>
<tr>
<td class="td-form-title">Rif / CI</td>
<td><input name="rif" type="text" class="form-box" id="rif" size="25"></td>
</tr>
<tr>
<td class="td-form-title">E-Mail</td>
<td><input name="email" type="text" class="form-box" id="email" size="50"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="Submit" type="submit" class="form-button" value="OK">
&nbsp;
<input name="Submit2" type="button" class="form-button" value="Cancelar" onClick="window.close();">
</td>
</tr>
</table>
</body>
</html>
