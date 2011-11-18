<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");
include("../../SVsystem/class/image.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();


	
	if(isset($_REQUEST['id'])) $campos = $tool->simple_db("select * from campo where id = '{$_REQUEST['id']}' and  modulo = 'cont'");
	
	if(isset($_POST['Submit'])){
	

			if(empty($_POST['ide'])){
			
			
				$_POST['r-orden'] = $tool->simple_db("select max(orden)+1 as total from campo where  modulo = 'cont'");
				$_POST['r-tipo'] = "textarea";
			
				 $tool->insert_data("r","-","campo",$_POST);	
			
			}else{
			
				$tool->update_data("r","-","campo",$_POST,"id = {$_POST['ide']}");
			
			}	
			
				?>
						  <script language="JavaScript" type="text/JavaScript">
						   window.opener.location.reload(); window.close();
						   </script>
				<?	
			
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Campo de TextArea</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Agregar / Editar Campo de Texto Amplio o TextArea</td>
 </tr>
 <tr>
  <td>
   <table width="100%" border="0" cellspacing="4" cellpadding="0">
    <tr>
     <td width="33%" class="td-form-title">Nombre de Campo</td>
     <td width="67%"><input name="r-nombre" type="text" class="form-box" id="r-nombre" value="<?=$campos['nombre'] ?>" size="60">

       <input name="ide" type="hidden" id="ide" value="<?=$_REQUEST['id']?>">
</td>
    </tr>
    <tr>
      <td class="td-form-title">Propiedades</td>
      <td><span class="subtitulito"><strong>Longitud</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Longitud del campo en caracteres. Se muestra en el editor de art&iacute;culos">
          <input name="r-longitud" type="text" class="form-box" id="r-longitud" value="<?=$campos['longitud'] ?>" size="4">
&nbsp;  &nbsp; <strong>Lineas</strong>:<img src="../icon/icon-info.gif" width="16" height="16" align="absmiddle" title="Numero de lineas del campo. Se muestra en el editor de art&iacute;culo">
<input name="r-lineas" type="text" class="form-box" id="r-lineas" value="<?=$campos['lineas'] ?>" size="4">
      <input name="r-modulo" type="hidden" id="r-modulo" value="cont">
      </span></td>
    </tr>
    <tr>
     <td class="td-form-title">Ejemplo</td>
     <td><textarea name="numb" cols="<?=$campos['longitud'] ?>" rows="<?=$campos['lineas'] ?>" class="form-box" id="numb"></textarea>     </td>
    </tr>
    <tr>
     <td>&nbsp;</td>
     <td><input name="Submit" type="submit" class="form-button" value="OK">
     &nbsp;
     <input name="Submit2" type="button" class="form-button" value="Cancelar" onClick="window.close();"></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
</table>
</form>
</body>
</html>
<?php $tool->cerrar(); ?>