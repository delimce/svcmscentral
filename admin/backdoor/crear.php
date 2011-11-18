<?php session_start();

include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores


 $datos = new tools();
 $datos->autoconexion();

	if(isset($_POST['nombre'])){

			$valores2[0]= $_POST['nombre'];
			$valores2[1]= $_POST['login'];
			$valores2[2]= md5($_POST['pass']);
			$valores2[3]= $_POST['email'];
			$valores2[4]= date("Y-m-d");
			$valores2[5]= trim($_POST['cuenta']);

			$datos->insertar2("admin","nombre,user,pass,email,fecha_creado,cuenta_id",$valores2);


			?>
             <script language="javascript">

					window.opener.location.reload();
					window.close();

			</script>

            <?

	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

 <script language="JavaScript" type="text/javascript">
		  function validar(){

		  var login2 = document.form1.login.value;


			  if (document.form1.cuenta.value == ''){
			   alert("seleccione una cuenta");
			   document.form1.cuenta.focus();
			   return (false);
			 }


			 if (document.form1.nombre.value == ''){
			   alert("coloque el nombre");
			   document.form1.nombre.focus();
			   return (false);
			 }


			 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.form1.email.value)==false){
			  alert("la dirección email es erronea");
			  document.form1.email.focus();
			  return (false);
			 }


			  if (login2 == '' || login2.indexOf(" ")>=0){
			   alert("el login no puede ser vacio o tener espacios en blanco");
			   document.form1.login.focus();
			   return (false);
			 }


		    if (document.form1.pass.value.length < 5){
			   alert("la clave debe tener mas de 5 caracteres");
			   document.form1.pass.focus();
			   return (false);
			 }


			 if (document.form1.pass.value != document.form1.pass2.value){
			   alert("la confirmación de la clave es erronea");
			   document.form1.pass2.focus();
			   return (false);
			 }


			   return (true);
		   }
		</script>

<title>crear / editar admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Crear  usuario administrador</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td><form name="form1" method="post" action="" onSubmit="return validar();">
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
   <tr>
     <td class="td-form-title">Cuenta (SITE)</td>
     <td><?php echo $datos->combo_db("cuenta","select id,titulo from cuenta order by titulo ","titulo","id",'Seleccionar'); ?></td>
   </tr>
   <tr>
    <td class="td-form-title">Nombre completo</td>
    <td><input name="nombre" type="text" class="form-box" id="nombre" size="40"></td>
   </tr>
   <tr>
     <td class="td-form-title">Email</td>
     <td><input name="email" type="text" class="form-box" id="email" size="40"></td>
   </tr>
   <tr>
     <td class="td-form-title">Login</td>
     <td><input name="login" type="text" class="form-box" id="login" size="20"></td>
   </tr>
   <tr>
     <td class="td-form-title">contrase&ntilde;a</td>
     <td><input name="pass" type="password" class="form-box" id="pass" size="30"></td>
   </tr>
   <tr>
     <td class="td-form-title">repetir contrase&ntilde;a</td>
     <td><input name="pass2" type="password" class="form-box" id="pass2" size="30"></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td align="right"><input name="Submit" type="submit" class="form-button" value="OK">&nbsp;
    <input name="Submit2" type="button" class="form-button" value="Cancelar" onClick="window.close();"></td>
   </tr>
  </table>
  </form></td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
</table>
</body>
</html>
