<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");
include("security.php");

$tool = new tools('db');

if(!empty($_POST['categoria'])){

		$tool->query("update cliente_categoria set descuento = '{$_POST['descuento']}' where id = '{$_POST['categoria']}' ");
			?>
		 <script language="JavaScript" type="text/JavaScript">
	   window.opener.location.reload(); window.close();
	   </script>

		<?
	
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../estilos.css" rel="stylesheet" type="text/css">
<title>Crear Descuento</title>
</head>

<script type="text/javascript">
		function validar(){
		
				if(document.getElementById('descuento').value>99.0){
					alert('Monto errado, solo hasta 99%');
		
					return false;
		
				}
		
				return true;
		
		}
</script>


<body>
<form id="form1" name="form1" method="post" action="" onSubmit="return validar();">
<table width="100%" border="0">
  <tr>
    <td colspan="2" class="td-headertabla">Agregar Descuento</td>
  </tr>
  <tr>
    <td width="45%"><span class="form-box-td">
      <?php   echo $tool->combo_db ("categoria","select id,nombre from cliente_categoria where grupo = 1","nombre","id","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas</span>',false,false,"form-box"); ?>
    </span></td>
    <td width="55%"><span class="form-box-td">
      <input name="descuento" type="text" class="form-box" id="descuento" size="6" />
%</span></td>
  </tr>
  <tr align="center">
  <td colspan="2"><input name="button" type="submit" class="link-boton-principal" id="button" value="Guardar Cambios" /></td>
</tr>
</table>

</form>
</body>
</html>
<?php $tool->cerrar(); ?>