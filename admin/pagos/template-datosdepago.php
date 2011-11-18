<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();


	if(isset($_REQUEST['borrar'])){
	
	
			@$tool->update_data("r","-","pago_datos",$_POST);
			$tool->javaviso("Datos actualizados","main.php");
	
	
	}else{
	
	
		$tool->query("select * from pago_datos");
	
	
	}


?>
<html>
<head>
<title>Editar Datos de Pago</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
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
<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include "include-menu.php"?>
<!--END INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../header-pagos.jpg" width="900" height="130"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td class="td-titulo1">Datos de Pago en bancos venezolanos</td>
    </tr>
    <tr>
    <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
    <td class="td-texto1">En este m&oacute;dulo usted podr&aacute; modificar los datos de pago en bancos venezolanos que aparecen en la p&aacute;gina de pago de su sitio web. </td>
    </tr>
    <tr>
    <td align="right" class="td-barra-inferior">&nbsp;&nbsp; <a href="javascript:;" class="link-boton-principal"> <img src="../icon/icon-cat-add.gif" width="16" height="16" border="0" align="absmiddle"> agregar cuenta bancaria</a></td>
    </tr>
    <tr>
    <td><table width="100%" border="0" cellspacing="4" cellpadding="0">
    <tr>
    <td width="13%" class="td-headertabla">Banco</td>
    <td width="16%"  class="td-headertabla">Cuenta</td>
    <td width="19%" class="td-headertabla">Beneficiario</td>
    <td width="13%" class="td-headertabla">Rif / C.I.</td>
    <td width="29%" class="td-headertabla">E-Mail</td>
    <td width="10%" class="td-headertabla">Acciones</td>
    </tr>
   
   
      <?php 
	  
	while ($row = mysql_fetch_assoc($tool->result)) {
	
	?>
   
    <tr>
    <td class="td-content"><?php echo $row['banco']?></td>
    <td class="td-content"><?php echo $row['ncuenta']?></td>
    <td class="td-content"><?php echo $row['nombre']?></td>
    <td class="td-content"><?php echo $row['rif']?></td>
    <td class="td-content"><?php echo $row['email']?></td>
    <td class="td-content">
     <img src="../icon/icon-delete.gif" width="16" height="16">
     <img src="../icon/icon-edit.gif" width="16" height="16"></td>
    </tr>
    
    <?php } ?>
    
    </table>
    </td>
    </tr>
    <tr>
    <td class="td-refooter">
    <!--navegador de paginas-->
    <!--fin navegador de paginas-->
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto Internet</a></td>
    </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<?php $tool->cerrar(); ?>