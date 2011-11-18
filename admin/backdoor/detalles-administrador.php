<?php session_start();

include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores


 $datos = new tools('db');

	if(isset($_POST['nombre'])){

			$valores2[0]= $_POST['nombre']; $campos = explode(",","nombre,user,pass,email,cuenta_id");
			$valores2[1]= $_POST['login'];
			if($_POST['passv']==$_POST['pass']) $valores2[2]= $_POST['passv']; else $valores2[2]= md5($_POST['pass']);
			$valores2[3]= $_POST['email'];
			$valores2[4]= $_POST['cuenta'];

			$datos->update("admin",$campos,$valores2,"id = '{$_POST['id']}'");


			?>
             <script language="javascript">

					<?php if($_POST['id']==$_SESSION['USERID']){ ?>
					 if (confirm("ATENCION: Acaba de editar sus datos ¿desea volver a entrar con sus nuevas credenciales?")) {

					  opener.location.replace('../salir.php');
					  window.close();

					  }else{

					  window.opener.location.reload();
					  window.close();

					  }

					  <?php }else{ ?>


					window.opener.location.reload();
					window.close();

					<?php } ?>

			</script>

            <?

	}else{


		$data = $datos->simple_db("select id,user,nombre,pass,email,(select titulo from cuenta where id = a.cuenta_id) as cuenta from admin a where id = '{$_GET['id']}'");


	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>detalles admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Ver detalles de usuario administrador</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
   <tr>
     <td width="37%" class="td-form-title">Cuenta (SITE)</td>
     <td width="63%"><?php echo $data['cuenta'] ?></td>
   </tr>
   <tr>
    <td class="td-form-title">Nombre completo</td>
    <td><?=$data['nombre']?></td>
   </tr>
   <tr>
     <td class="td-form-title">Email</td>
     <td><?=$data['email']?></td>
   </tr>
   <tr>
     <td class="td-form-title">Login</td>
     <td><?=$data['user']?></td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td align="left">&nbsp;
       <input name="Submit2" type="button" class="form-button" value="Cerrar" onClick="window.close();"></td></tr>
  </table>
 </td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
</table>
</body>
</html>
