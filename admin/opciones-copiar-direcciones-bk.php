<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();





	 if(isset($_POST['Submit'])){


	    $dirs = explode(',',$_REQUEST['para']);
	    $to1 = trim($_REQUEST['para']); ////uso de la funcion mail
		$titulo  = $_POST['titulo'];
		$mensaje = $_POST['mensaje'];

	 	include("email_masa.php");

		$tool->javaviso("Los emails han sido enviados correctamente","opciones.php");


	 }else{


		  if(!isset($_REQUEST['too']) && !isset($_REQUEST['bus'])){

				  if(isset($_REQUEST['esolo'])){

				  	$emails[0] = $_REQUEST['esolo'];

				  }else{				  	 $emails = $tool->array_query("select distinct email from cliente");
		             if($tool->nreg==0)$tool->javaviso('No existen usuarios registrados para enviar emails','opciones.php');
				  }



		  }else if(isset($_REQUEST['too']) && isset($_REQUEST['bus'])){

				  $mini = implode(',',$_REQUEST['too']); $emails = $tool->array_query("select email from cliente where id in ($mini)");


		  }else if(!isset($_REQUEST['too']) && isset($_REQUEST['bus'])){

			  ?>
              <script type="text/javascript">
			  alert("No existen contactos seleccionados");
			  history.back();
			  </script>

              <?


		  }



	 }



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Copiar direcciones de correo de sus Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">




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


<script type="text/javascript">

function selectAll()
{
document.form1.copiar.focus();
document.form1.copiar.select();
}

</script>





</head>

<body>
<!--INCLUDES-->
<?php include("include-menu-salir.php");?>
<?php include "include-menu2.php" ?>
<?php include "include-mensajes.php"?>
<!--INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td><a href="main.php"><img src="header-email.jpg" width="900" height="130"></a></td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<!-- SUPER MENU !!!!! -->
<tr><td><?php include ("supermenu.php")?></td></tr>
<!--//////////  SUPER MENU !!!!! -->
       <tr>
        <td class="td-titulo1"> DIRECCIONES DE e-mail de sus clientes</td>
       </tr>
       <tr>
        <td><form name="form1" method="post" action="">
          <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
           <tr>
            <td class="td-texto1"><p>Hemos tenido problemas debido al uso abusivo de esta funcion por parte de algunos usuarios del sistema. <strong>La funci&oacute;n de env&iacute;os de correo masivo desde esta p&aacute;gina ha sido DESHABILITADA.</strong> Sin&nbsp; embargo usted <strong>puede todav&iacute;a puede copiar las direcciones de correo de sus clientes</strong> y utilizar su programa de e-mail favorito para escribirles desde ahi.</p>
<p>Desde aqu&iacute; usted puede copiar las direcciones de los clientes seleccionados. </p>
<p>1.- Seleccione todas las direcciones&nbsp;presionando el bot&oacute;n &quot; Seleccionar Todas...&quot;</p>
<p>2.- C&oacute;pielas al portapapeles (Presione CTRL+ C) </p>
<p>3.- En su programa de correo favorito (Outlook, Gmail, Hotmail, Etc), PEGUE (CTRL + V) las direcciones.</p>
<p>4.- Escriba su correo normalmente.</p>
<p>5.-  Recomendamos leer este art&iacute;culo sobre <strong><a href="http://proyectointernet.posterous.com/uso-apropiado-del-correo-electronico-email" target="_blank">El uso apropiado del E-Mail</a>.</strong></p></td>
           </tr>
           <tr>
<td class="td-headertabla4" style="text-align:center;"><a href="#" class="instruccion">Correos de Sus Usuarios<span>Presione el botón "Seleccionar todas las Direcciones de E-Mail" y luego Presione "CTRL + C" Para copiar. </span> Seleccionados</a>
<tr>
 <td align="center"><textarea name="copiar" cols="130" rows="20" wrap="VIRTUAL" class="form-box" id="copiar" onClick="selectAll ();"><?php echo $emails = implode(',',$emails) ?></textarea>
<tr>
        <td align="center">
<input type="button" name="selectit" class="form-button" value="Seleccionar Todas las Direcciones de  E-Mail" onClick="selectAll ();">
&nbsp;
         <input name="Submit2" type="button" class="form-button" onClick="history.back();" value="Cancelar"></td>
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
