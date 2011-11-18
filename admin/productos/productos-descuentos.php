<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

include("security.php");

$tool = new tools('db');


	
	if(isset($_GET['borrar'])){
		$tool->query("update cliente_categoria set descuento = '' where id = '{$_GET['borrar']}'");	
		$tool->redirect('productos-descuentos.php');
	}
		
	
	
	$tool->query("select id,nombre,descuento from cliente_categoria where descuento > 0 order by nombre");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Descuentos discriminados por grupos de usuario</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>


</head>

<body>
<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Descuentos discriminados por grupos de usuario</div>
<div id="ninstrucciones">
<p>En &eacute;ste m&oacute;dulo usted podr&aacute; decidir qu&eacute; porcentaje de descuento aplica para cada grupo o categor&iacute;a de usuarios que usted haya ya creado en el sistema de usuarios. Primero usted debe crear las categor&iacute;as de usuario y luego puede asignarle a cada categor&iacute;a un descuento. </p>
                <p>Los cambios realizados en este m&oacute;dulo se har&aacute;n efectivos inmediatamente en su cat&aacute;logo pero no afectar&aacute;n los montos de &oacute;rdenes de compra ya realizadas.</p>
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera"><a href="javascript:popup('popup-descuentos.php','new','150','350');" class="boton">Crear nuevo Descuento</a></div>





 <table width="100%" border="0" cellspacing="5" cellpadding="0">
                <tr>
                <td width="45%" class="td-headertabla">Categor&iacute;a</td>
                <td colspan="2" class="td-headertabla">Descuento (% sobre el precio)</td>
                </tr>
                
                <?php while ($row = mysql_fetch_assoc($tool->result)) { ?>
                <tr>
                  <td class="td-texto1"><?php echo $row['nombre'] ?></td>
                  <td width="43%" class="td-texto1"><?php echo $row['descuento'] ?> %</td>
                  <td width="12%" class="td-texto1"><a href="productos-descuentos.php?borrar=<?php echo $row['id'] ?>" title="borrar Descuento"><img src="../icon/icon-delete.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
                </tr>
               <?php } ?>
               
</table>
























<!-- final nbloque -->
</div>












<!-- termina ncontenido -->
</div>
<?php include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>















































</body>
</html>
<?php $tool->cerrar(); ?>
