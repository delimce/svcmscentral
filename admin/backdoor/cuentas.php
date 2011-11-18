<?php session_start();

include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores


 $datos = new tools('db');

 if(isset($_GET['borrar'])){ ///para borrar

 	$dirf = $datos->simple_db("select ifnull(dirserver,'NONE') from cuenta where id = '{$_GET['borrar']}' ");
 	$datos->query("delete from cuenta where id = '{$_GET['borrar']}' ");
	$datos->query("delete from admin_log where id_cuenta = '{$_GET['borrar']}' ");

	$datos->delete_directory('../../SVsitefiles/'.$dirf); ///borra todos los archivos generados por la cuenta

	$datos->redirect('cuentas.php');

 }

 $datos->query("select id,titulo,date_format(fecha_creada,'%d/%m/%Y') as fecha,(select count(*) from admin where cuenta_id = c.id) as users from cuenta c order by id desc");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>administraci&oacute;n de cuentas clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


<script language="JavaScript" type="text/javascript">
	function borrar(id,nombre){

	  if (confirm(" ATENCION: ¿Seguro que desea borrar la cuenta "+nombre+" y todos sus ARCHIVOS y ADMINISTRADORES ?")) {

	  location.replace('cuentas.php?borrar='+id);

	  }else{


	  return false;

	  }
	}
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>


</head>

<body>
<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Administraci&oacute;n de cuentas de Administradores</div>
<div id="ninstrucciones" style="display:none;">
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">
 

<a href="javascript:;" class="boton" onClick="MM_openBrWindow('crear-cuenta.php','','scrollbars=no,resizable=yes,width=600,height=450')"><img src="../icon/add.png" align="absmiddle"> Agregar Nueva Cuenta de administrador</a>
</div>






<table width="100%" border="0" cellspacing="3">
       <tr>
       <td width="31%" class="td-headertabla">Nombre</td>
       <td width="18%" align="center" class="td-headertabla">Fecha creaci&oacute;n</td>
        <td width="32%" align="center" class="td-headertabla"># usuarios</td>
       <td width="19%"class="td-headertabla">Acciones</td>
       </tr>

       <?php

	   while ($row = mysql_fetch_assoc($datos->result)) {

	   ?>

       <tr>
       <td class="td-content3"><?php echo $row['titulo'] ?></td>
       <td align="center" class="td-content3"><?php echo $row['fecha'] ?></td>
        <td align="center" class="td-content3"><?php echo $row['users'] ?></td>
       <td class="td-content">
<!--botones de acciones de la cuenta-->
<a href="javascript:;" onClick="borrar('<?php echo $row['id'] ?>','<?php echo $row['titulo'] ?>');" title="borrar cuenta"><img src="../icon/icon-delete.gif" width="16" height="16" border="0"></a>&nbsp;
<a href="javascript:;" onClick="MM_openBrWindow('editar-cuenta.php?id=<?php echo $row['id'] ?>','','scrollbars=yes,resizable=yes,width=600,height=550')" title="ver y editar datos"><img src="../icon/icon-prod-edit.gif" width="16" height="16" border="0"></a>&nbsp;

<!--/ botones de acciones de la cuenta--></td>
       </tr>

       <?php

	   }

	   ?>

</table>










<!-- termina nbloque -->
</div>












<!-- termina ncontenido -->
</div>
<?php //include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>    
</div>

</div>
<?php include ("../n-footer.php")?>
</body>
</html>
<?php $datos->cerrar(); ?>
