<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

$tool = new tools('db');

$data = $tool->simple_db("select estatus_happybirth as hp from preferencias  ");

	 if(isset($_POST['Submit'])){

		 if(!empty($_POST['cumple'])) $hp = 1; else $hp = 0;
		
		$tool->abrir_transaccion();
		
		$tool->query("update preferencias set estatus_happybirth = $hp where ide = 1 ");
		
		$tool->cerrar_transaccion(true);
		
		
		$tool->cerrar();
		
		
		$tool->javaviso("Los cambios se han efectuado correctamente","index.php");


	 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Opciones del Módulo de Usuarios</title>
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

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>


</head>

<body>
<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include "menu.php" ?>

<!--INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td><a href="/admin/main.php"><img src="../header-bdc.jpg" width="900" height="130"></a></td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<!-- SUPER MENU !!!!! -->
<tr><td><?php include ("../supermenu.php")?></td></tr>
<!--//////////  SUPER MENU !!!!! -->
       <tr>
        <td class="td-titulo1">Opciones</td>
       </tr>
       <tr>
        <td><form name="form1" method="post" action="">
          <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
           <tr>
             <td class="td-texto1">Desde aqui puede activar el servicio de mandar un correo de felicitaciones al usuario en su cumplea&ntilde;os. Usted deber&aacute; editar el texto autom&aacute;tico que el sistema enviar&aacute; <a href="../opciones-mensajes.php">aqui</a>.</td>
           </tr>
           <tr>
             <td class="td-texto1"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
               <tr>
                 <td width="9%" align="center" valign="top" class="form-box"><input name="cumple" type="checkbox" id="cumple" value="1" <?php if($data['hp']==1) echo 'checked'; ?>></td>
                 <td width="91%" class="td-texto1">Activar env&iacute;o de mensajes de cumplea&ntilde;os.</td>
               </tr>
               <tr>
                 <td colspan="2" align="center" valign="top"><input name="Submit" type="submit" class="form-button" value="Guardar">
                   &nbsp;
                   <input name="Submit2" type="button" class="form-button" onClick="history.back();" value="Cancelar"></td>
                 </tr>
             </table></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
           </tr>
          </table>
         </form>        </td>
       </tr>
       <tr>
        <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto
          Internet</a></td>
       </tr>
      </table>     </td>
     </tr>
   </table>
  </td>
 </tr>
</table>

</body>
</html>
<?php $tool->cerrar(); ?>