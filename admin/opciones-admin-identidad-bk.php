<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/clases.php");

$tool = new formulario();
$tool->autoconexion();


	if(isset($_POST['Submit'])){
	
	
			$tool->update_data("r","2","preferencias",$_POST,"");
			
			$tool->cerrar();
			
			$tool->javaviso("Opciones de identidad guardadas","opciones.php");
		
	
		}else{
		
		 $datos = $tool->simple_db("select nombre_empresa,rif_empresa,direccion,telefonos,soporte_email as email,url_empresa as url from preferencias ");
		
	
	}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Identidad de la Empresa</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="/SVsystem/js/utils.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->

function CC_startTip(){ //v1.0 333Creative
  ccID=document.getElementById;ccIE=(document.all);ccN4=(document.layers);
  i5=(ccID&&ccIE);ccN6=(ccID&&!ccIE);ccI4=(!ccID&&ccIE);ccMC=(navigator.userAgent.indexOf("Mac")!= -1);
  cc1=null;ccF=0;index=0;ccX=15;ccY=15;n=0;ccPX=(ccID)?"px":"";var T="ccToolTip";
   if(ccN4){el=document.layers[T];document.captureEvents(Event.MOUSEMOVE);document.onmousemove=eval("CC_"+"Follow")}
  else if(ccID){el=document.getElementById(T)}
  else if(ccI4){el=document.all[T]}
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>


</head>

<body>
<!--INCLUDES-->


<!--INCLUDES-->


<?php include ("n-encabezado.php")?>
<div id="ncuerpo">
<?php include ("n-include-mensajes.php")?>
<div id="ncontenedor">
<div id="nnavbar"><?php include "n-include-menu2.php"?></div>




<div id="ntitulo">Opciones de Identidad de la Empresa <?php echo $_SESSION['STITULO']  ?></div>
<div id="ninstrucciones">
Aqui usted puede personalizar el remitente de los envíos de correo que realizará el sistema a los clientes. Ponga el mouse sobre el título de cada campo para mayor información.
</div>


<div id="ncontenido">
<form action="" method="post" id="opciones-admin-identidad.php">
<table width="99%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td><table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr>
<td width="34%" align="right" valign="top" class="td-headertabla"><a class="instruccion" style="white-space:nowrap;" >Nombre <span>Este es el nombre que aparecer&aacute; en el campo &quot;remitente&quot; de los coreos que env&iacute;e el sistema. <b>IMPORTANTE: NO use comas (,) o comillas (&quot;) .</b></span></a></td>
<td width="66%"><input name="r2nombre_empresa" type="text" class="form-box" id="r2nombre_empresa" value="<?=$datos['nombre_empresa']?>" size="50" /></td>
</tr>
<tr>
<td valign="top" class="td-headertabla" align="right"><a class="instruccion">Rif<span>RIF de su Empresa</span></a></td>
<td><input name="r2rif_empresa" type="text" class="form-box" id="r2rif_empresa" value="<?=$datos['rif_empresa']?>" size="50" /></td>
</tr>
<tr>
<td valign="top" class="td-headertabla" align="right"><a class="instruccion">Direccion Fiscal<span>Para efectos de Estados de cuenta y facturaci&oacute;n es necesaria la direcci&oacute;n fiscal de su empresa</span></a></td>
<td><textarea name="r2direccion" cols="50" rows="3" class="form-box" id="r2direccion"><?=$datos['direccion']?>
               </textarea></td>
</tr>
<tr>
<td valign="top" class="td-headertabla" align="right">Telefonos</td>
<td><input name="r2telefonos" type="text" class="form-box" id="r2telefonos" value="<?=$datos['telefonos']?>" size="50" /></td>
</tr>
<tr>
<td valign="top" class="td-headertabla" align="right"><a class="instruccion">Email <span>Este es el email que&nbsp; aparecer&aacute; como remitente de los correos ue env&iacute;e el sistema y a donde le llegar&aacute;n a usted los correos que el sistema le env&iacute;e a&nbsp; usted.  es MUY importante que configure correctamente esta opci&oacute; porque de lo contrario no recibir&aacute; ning&uacute;n correo relativo a las actividades relacionadas con  su p&aacute;gina.</span></a><br /></td>
<td><input name="r2soporte_email" type="text" class="form-box" id="r2soporte_email" value="<?=$datos['email']?>" size="60" /></td>
</tr>
<tr>
<td class="td-headertabla" align="right"><a  class="instruccion">Url<span>Esta es la direccion en internet de su&nbsp; p&aacute;gina web.</span></a><br /></td>
<td><input name="r2url_empresa" type="text" class="form-box" id="email" value="<?=$datos['url']?>" size="50" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="Submit" type="submit" class="form-button" value="Guardar" />
&nbsp;
<input name="Submit2" type="reset" class="form-button" onclick="MM_goToURL('parent','opciones.php');return document.MM_returnValue" value="Cancelar" /></td>
</tr>
</table></td>
</tr>
<tr>
<td></td>
</tr>
</table>
</form>
<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?>
















































</body>
</html>
