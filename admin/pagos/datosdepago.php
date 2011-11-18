<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();


	if(isset($_REQUEST['borrar'])){
	
			$tool->query("delete from pago_datos where id = '{$_REQUEST['borrar']}'");
			$tool->javaviso("Cuenta Borrada","datosdepago.php");
	
	}
	
		$paypale = $tool->simple_db("select paypal_email from preferencias");
		$tool->query("select * from pago_datos");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Datos de Pago</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script type="text/javascript" src="../../SVsystem/js/scripts.js"></script>

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





<div id="ntitulo">Cuentas Bancarias</div>
<div id="ninstrucciones">
<p>En este módulo usted podrá modificar los datos de pago en bancos venezolanos que aparecen en la página de pago de su sitio web. Al agregar su cuenta bancaria&nbsp; por favor instroduzca sus datos SIN separadores, puntos, guiones o espacios; recuerde que en internet la informaci&oacute;n se puede <strong>copiar y pegar</strong>. El colocar todos esos caracteres adicionales s&oacute;lo le hace m&aacute;s dif&iacute;cil la tarea de copiar y pegar los n&uacute;meros a los usuarios que van a realizar transferencias bancarias.</p>


</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">
<a href="javascript:;" title="agregar nueva cuenta bancaria" class="boton" onClick="MM_openBrWindow('agregar-cuenta-bancaria.php','','resizable=yes,width=700,height=400')"><img src="../icon/add.png" align="absmiddle"> Agregar Nueva Cuenta Bancaria</a>
</div>

<div id="ntitulo">Sus cuentas Bancarias</div>
<table width="100%" border="0" cellspacing="4" cellpadding="0">
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
     <img onClick="location.replace('datosdepago.php?borrar=<?php echo $row['id']?>');" src="../icon/icon-delete.gif" width="16" height="16" style="cursor:pointer;" title="BORRAR!">
     <img onClick="popup('editar-cuenta-bancaria.php?id=<?php echo $row['id']?>', 'nuevo','350','600');" src="../icon/icon-edit.gif" width="16" height="16" style="cursor:pointer;" title="Editar información"></td>
    </tr>
    
    <?php } ?>
    
</table>





<div id="ntitulo">Su cuenta de PayPal</div>

<div id="tituloizq">Email Asociado a Paypal</div>
<div id="dataderecha">

<input name="paypale" type="text" class="form-box" id="paypale" value="<?=$paypale ?>" size="35">
<input name="button" type="button" class="form-button" id="button" value="Guardar" onClick="ajaxsend('post','../backdoor/workflow.php','campo=paypal_email&tipo=5&valor='+document.getElementById('paypale').value);alert('la cuenta paypal se ha guardado con exito!')">
</div>

<div id="nseparador"></div>
</div>




<center>
<input name="Button" type="button" class="form-button" onClick="parent.history.back(); return false;" value="Guardar Cuentas Bancarias">&nbsp; 
              <input name="Button" type="button" class="form-button" onClick="parent.history.back(); return false;" value="Regresar"></center>







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