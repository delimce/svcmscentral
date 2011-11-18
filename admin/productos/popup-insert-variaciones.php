<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

	if(isset($_REQUEST['Submit'])){
	
			$I = count($_SESSION['VARIACION_valor']);
			$_SESSION['VARIACION_valor'][$I] = $_REQUEST['nombre'];
			
			/////////////////
			?>
            
            <script type="text/javascript">
			window.opener.varia.location.replace('variaciones_prod.php');
			window.close();
			</script>

            <?

	
	}


?>

<html>
<head>
<title>Agregar Variaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">

</head>

<body class="body-popup">
<form action="" method="post" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Agregar Variaci&oacute;n</td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="27%" class="td-form-title">Nombre </td>
    <td width="73%"><input name="nombre" type="text" class="form-box" size="50" id="nombre"></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" class="form-button" value="OK">
<input name="Submit2" type="button" class="form-button" value="Cancelar" onClick="window.close();"></td>
   </tr>
  </table></td>
 </tr>
</table>
</form>
</body>
</html>
