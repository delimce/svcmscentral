<?php session_start();

include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores


$tool = new formulario();
$tool->autoconexion();


		if(isset($_POST['ide2'])){

			$dirf = $tool->simple_db("select dirserver from cuenta where id = '{$_POST['ide2']}'");
			$tool->update_data("r","-","cuenta",$_POST,"id = '{$_POST['ide2']}'");

			rename("../../SVsitefiles/".$dirf,"../../SVsitefiles/".$_REQUEST['r-dirserver']); ///renombrando el dir de archivos

			?>
             <script language="javascript">

					window.opener.location.reload();
					window.close();

			</script>

            <?

			die();

		}


			 $data = $tool->simple_db("select * from cuenta where id = '{$_GET['id']}' ");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>



<title>crear / editar cuenta cliente</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script type="text/javascript">

  function validar(){
	  	  
	  if(document.getElementById('r-titulo').value==''){
		  
		  alert("Error: debe escribir un nombre para la cuenta");
		  document.getElementById('r-titulo').focus();
		  
		  return false;
		  
	  }
	  
	  
	   if(document.getElementById('r-dirserver').value==''){
		  
		  alert("Error: debe colocar una CARPETA DE ARCHIVOS ");
		  document.getElementById('r-dirserver').focus();
		  
		  return false;
		  
	  }
	  
	  
	   if(document.getElementById('r-dbuser').value==''){
		  
		  alert("Error: coloque un DB USER ");
		  document.getElementById('r-dbuser').focus();
		  
		  return false;
		  
	  }
	  
	  
	  if(document.getElementById('r-dbpass').value==''){
		  
		  alert("Error: coloque un DB PASSWORD ");
		  document.getElementById('r-dbpass').focus();
		  
		  return false;
		  
	  }
	  
	  
	   if(document.getElementById('r-dbname').value==''){
		  
		  alert("Error: coloque un DB NAME ");
		  document.getElementById('r-dbname').focus();
		  
		  return false;
		  
	  }  
	  
	  return true;
	  
  }
</script>



</head>

<body class="body-popup">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Editar  cuenta</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>
  <form name="form1" method="post" action="" onSubmit="return validar();">
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
   <tr>
   <td width="29%" class="td-form-title">Nombre de la cuenta</td>
   <td colspan="2"><input name="r-titulo" type="text" class="form-box" id="r-titulo" value="<?=$data['titulo'] ?>" size="30"></td>
   </tr>
   <tr>
   <td class="td-form-title">Url</td>
   <td colspan="2"><input name="r-url" type="text" class="form-box" id="r-url" value="<?=$data['url'] ?>" size="30"></td>
   </tr>
   <tr>
   <td class="td-form-title">Ruta de htdocs</td>
   <td colspan="2"><input name="r-dirserver" type="text" class="form-box" id="r-dirserver" value="<?=$data['dirserver'] ?>"></td>
   </tr>
   <tr>
     <td class="td-form-title">db Server</td>
     <td colspan="2"><input name="r-dbserver" type="text" class="form-box" id="r-dbserver" value="<?=$data['dbserver'] ?>"></td>
   </tr>
   <tr>
   <td class="td-form-title">db User</td>
   <td colspan="2"><input name="r-dbuser" type="text" class="form-box" id="r-dbuser" value="<?=$data['dbuser'] ?>"></td>
   </tr>
   <tr>
   <td class="td-form-title">db Password</td>
   <td colspan="2"><input name="r-dbpass" type="text" class="form-box" id="r-dbpass" value="<?=$data['dbpass'] ?>"></td>
   </tr>
   <tr>
   <td class="td-form-title">db Name</td>
   <td colspan="2"><input name="r-dbname" type="text" class="form-box" id="r-dbname" value="<?=$data['dbname'] ?>"></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td width="52%" align="left" class="bdc-span-explicacion">
    
    <?php if($data['dbname']==$_SESSION['SDBNAME']){ ?>
    
    <a href="#" onClick="
    if(confirm('¿Esta seguro que desea reiniciar las tablas de esta cuenta?'))
	{
		ajaxsend('post','reiniciar.php','cuenta=<?=$data['titulo'] ?>&url=<?=$data['url'] ?>');
        alert('Tablas borradas!');
	}">reiniciar tablas</a>
    
    <?php } ?>
    </td>
    <td width="19%" align="left"><input name="ide2" type="hidden" id="ide2" value="<?=$data['id'] ?>">
      <input name="Submit" type="submit" class="form-button" value="OK">
      &nbsp;
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
