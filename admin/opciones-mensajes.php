<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/clases.php");

 $tool = new formulario();
 $tool->autoconexion();
 
 if(isset($_REQUEST['Submit'])){
	 
	 
	 $tool->update_data('r','-','preferencias',$_POST);
	 $tool->javaviso('Mensajes actualizados con exito','opciones.php');
	 
 }
 
 
 
 
 $data = $tool->simple_db("select * from preferencias");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Mensajes Predefinidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../SVsystem/js/ajax.js"></script>
<script type="text/javascript" src="../SVsystem/editor2/tiny_mce.js"></script>



<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "r-prod_orden_compra_admin,r-prod_orden_compra_user,r-prod_orden_admin,r-users_registro_admin,r-users_registro_user,r-users_registro_activo, r-pay_user,r-pay_admin,r-pay_confirm_admin,r-pay_deny_admin,r-msg_admin,r-msg_user_happybirth,r-msg_admin_happybirth",
        theme : "advanced",
        language: "es",
        theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
        apply_source_formatting : true,
        remove_script_host : false,
        convert_urls : false,
preformatted : true,

		plugins : "autoresize,autolink,lists,table,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,fullscreen,wordcount,advlist,autosave",



		// Theme options
		theme_advanced_buttons1 : "undo,redo,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,insertdate,inserttime,|,image,media,|,tablecontrols",
		theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,bold,italic,underline,strikethrough,sub,sup",
		theme_advanced_buttons3 : "bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,|,hr,advhr,|,charmap,attribs,|,|,|,cleanup,removeformat,preview,code,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "none",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",


plugin_insertdate_dateFormat : "<? echo "%d/%m/%Y"; ?> ",
plugin_insertdate_timeFormat : "%H:%M:%S",

extended_valid_elements : "a[name|href|target|title|onclick|style|class],img[style|class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],iframe[src|width|height|name|align],object[align|width|height],param[name|value],embed[src|type|wmode|width|height],div[id|style|align|class]"
		
	});
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
function P7_MultiClass2() { //v1.0 by PVII
 var args=P7_MultiClass2.arguments;if(document.getElementById){
  for(var i=0;i<args.length;i+=2){if(document.getElementById(args[i])!=null){
  if(document.p7setdown){for(var k=0;k<p7dco.length-1;k+=2){
  if(args[i]==p7dco[k]){args[i+1]=p7dco[k+1];break;}}}
  document.getElementById(args[i]).className=args[i+1];}}}
}
//-->
</script>


</head>

<body>



<?php include ("n-encabezado.php")?>
<div id="ncuerpo">
<?php include ("n-include-mensajes.php")?>
<div id="ncontenedor">
<div id="nnavbar"><?php include "n-include-menu2.php"?></div>




<div id="ntitulo">Emails Autom&aacute;ticos que env&iacute;a el Sistema  <a href="javascript:;" onClick="MM_openBrWindow('help/emails-automaticos.php','','scrollbars=yes,resizable=yes,width=900,height=550')"><img src="icon/icon-info.gif" width="16" height="16" border="0"></a></div>

<div id="ninstrucciones">
<p>Estos son los e-mails que le llegan al administrador del Web Site (usted) y a los usuarios de
          su sitio web cuando pasan cosas importantes en la p&aacute;gina. <a href="opciones-admin-identidad.php">La opci&oacute;n
            de identidad del Admin</a> le permite configurar el
          correo desde d&oacute;nde le llegan los correos a&nbsp; sus usuarios y hacia d&oacute;nde llegan los correos destinados al administrador de&nbsp; su&nbsp; p&aacute;gina.</p>
<p>Los correos autom&aacute;ticos usan una serie de &quot;<a href="help/emails-automaticos.php" target="_blank">variables</a>&quot; que remplazan ciertos datos que son imposibles de colocar de otra forma. </p>
<p>Por ejemplo... Cuando un&nbsp; usuario se inscribe en la&nbsp; p&aacute;gina web, a&nbsp; usted le&nbsp; debe llegar un correo inform&aacute;ndole de ello. Para que el sistema le&nbsp; informe el NOMBRE del usuario que se inscribe, el correo debe tener la variable &quot; $usern&nbsp;&quot; ... Entonces, cuando se inscribe <strong>Pedro</strong> en&nbsp; su p&aacute;gina web, si&nbsp;el correo de registro de nuevo usuario que va dirigido al administrador dice <em>&quot; <strong>$usern&nbsp;se ha registrado </strong>&quot;</em>, a&nbsp; usted le llegar&aacute;lo siguiente: &quot; <strong>Pedro se&nbsp; ha registrado</strong> &quot;</p>
<p><a href="help/emails-automaticos.php" target="_blank">Vea la&nbsp; gu&iacute;a de variables para los&nbsp; emails autom&aacute;ticos</a>,&nbsp; aprenda un poco de codificaci&oacute;n HTML y p&oacute;ngase creativo&nbsp; con los mensajes que su sistema emite.</p>
</div>


<div id="ncontenido">

<div id="nbotonera">

<?php  if(in_array(3,$_SESSION['MODULOS'])){ ?>
<!-- usuarios -->
<!-- 3 --><a href="javascript:;" class="boton" id="boton3" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloqueoculto','nbloque3','nbloquevisible','nbloque4','nbloqueoculto','nbloque5','nbloqueoculto','nbloque6','nbloqueoculto','nbloque7','nbloqueoculto','nbloque8','nbloqueoculto','nbloque9','nbloqueoculto','boton1','boton','boton2','boton','boton3','botonactivo','boton4','boton','boton5','boton','boton6','boton','boton7','boton','boton8','boton','boton9','boton')">Registro de usuario<span>Si su web site tiene sistema de usuarios registrados, &eacute;stos son los&nbsp; e-mails que le llegan tanto al usuario como al administrador  (Usted) justo luego de completar el formulario de registro.</span></a>


<!-- 4 --><a href="javascript:;" class="boton" id="boton4" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloqueoculto','nbloque3','nbloqueoculto','nbloque4','nbloquevisible','nbloque5','nbloqueoculto','nbloque6','nbloqueoculto','nbloque7','nbloqueoculto','nbloque8','nbloqueoculto','nbloque9','nbloqueoculto','boton1','boton','boton2','boton','boton3','boton','boton4','botonactivo','boton5','boton','boton6','boton','boton7','boton','boton8','boton','boton9','boton')">Bienvenida al usuario <span>Use este email para dar una bienvenida detallada a sus nuevos usuarios registrados. Este Email se envía cuando se elecciona la opcion "Dar Bienvenida" en la búsqueda de usuarios.</span></a>


<?php  if(in_array(2,$_SESSION['MODULOS'])){ ?>

<!-- ordenes de compra -->
<!-- 1 --><a href="javascript:;" class="boton" id="boton1" onclick="P7_MultiClass2('nbloque1','nbloquevisible','nbloque2','nbloqueoculto','nbloque3','nbloqueoculto','nbloque4','nbloqueoculto','nbloque5','nbloqueoculto','nbloque6','nbloqueoculto','nbloque7','nbloqueoculto','nbloque8','nbloqueoculto','nbloque9','nbloqueoculto','boton1','botonactivo','boton2','boton','boton3','boton','boton4','boton','boton5','boton','boton6','boton','boton7','boton','boton8','boton','boton9','boton')">orden de compra<span>El usuario ve algún producto de su catálogo y elige realizar una compra, cuando el proceso finaliza, se envían dos correos, uno hacia el email registrado del usuario y otro al correo que usted tiene identificado en "Identidad de la Empresa"</span></a>

<!-- 2 --><a href="javascript:;" class="boton" id="boton2" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloquevisible','nbloque3','nbloqueoculto','nbloque4','nbloqueoculto','nbloque5','nbloqueoculto','nbloque6','nbloqueoculto','nbloque7','nbloqueoculto','nbloque8','nbloqueoculto','nbloque9','nbloqueoculto','boton1','boton','boton2','botonactivo','boton3','boton','boton4','boton','boton5','boton','boton6','boton','boton7','boton','boton8','boton','boton9','boton')">factura<span>En la sección órdenes de compra, usted podrá revisar los datos de la misma, agregar cargos (recargos, costo de envío, etc), aplicar descuentos y escribir observaciones adicionales; esta "factura proforma" será enviada a su cliente; aquí es donde se controla el formato de ese mensaje.</span></a>


<?php } ?>
<?php  if(in_array(4,$_SESSION['MODULOS'])){ ?>

<!-- pagos -->

<!-- 5 --><a href="javascript:;" class="boton" id="boton5" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloqueoculto','nbloque3','nbloqueoculto','nbloque4','nbloqueoculto','nbloque5','nbloquevisible','nbloque6','nbloqueoculto','nbloque7','nbloqueoculto','nbloque8','nbloqueoculto','nbloque9','nbloqueoculto','boton1','boton','boton2','boton','boton3','boton','boton4','boton','boton5','botonactivo','boton6','boton','boton7','boton','boton8','boton','boton9','boton')">reporte de pago<span>Aquí puede darle formato al email que le llega a usted cuando un usuario reporta un pago en su web site.</span></a>


<!-- 6 --><a href="javascript:;" class="boton" id="boton6" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloqueoculto','nbloque3','nbloqueoculto','nbloque4','nbloqueoculto','nbloque5','nbloqueoculto','nbloque6','nbloquevisible','nbloque7','nbloqueoculto','nbloque8','nbloqueoculto','nbloque9','nbloqueoculto','boton1','boton','boton2','boton','boton3','boton','boton4','boton','boton5','boton','boton6','botonactivo','boton7','boton','boton8','boton','boton9','boton')">pago aprobado<span>Aquí puede darle formato al email que le llega al usuario cuando usted aprueba o acepta un pago en el módulo de pagos. Este es el mensaje qu3e le indica al usuario lo que va a ocurrir ahora que el  pago ya  se ha hecho efectivo... ¿cuál es el siguiente paso?</span></a>


<!-- 7 --><a href="javascript:;" class="boton" id="boton7" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloqueoculto','nbloque3','nbloqueoculto','nbloque4','nbloqueoculto','nbloque5','nbloqueoculto','nbloque6','nbloqueoculto','nbloque7','nbloquevisible','nbloque8','nbloqueoculto','nbloque9','nbloqueoculto','boton1','boton','boton2','boton','boton3','boton','boton4','boton','boton5','boton','boton6','boton','boton7','botonactivo','boton8','boton','boton9','boton')">pago negado<span class="derecha">Aquí puede darle formato al email que le llega al usuario si usted rechaza el reporte  de pago, sea por datos errados o porque  el pago no se hizo efectivo.</span></a>


 <?php  if(in_array(5,$_SESSION['MODULOS'])){ ?>

<!-- mensajes -->

<!-- 8 --><a href="javascript:;" class="boton" id="boton8" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloqueoculto','nbloque3','nbloqueoculto','nbloque4','nbloqueoculto','nbloque5','nbloqueoculto','nbloque6','nbloqueoculto','nbloque7','nbloqueoculto','nbloque8','nbloquevisible','nbloque9','nbloqueoculto','boton1','boton','boton2','boton','boton3','boton','boton4','boton','boton5','boton','boton6','boton','boton7','boton','boton8','botonactivo','boton9','boton')">comentarios<span class="derecha">Este es el email que le llega a  usted cuando  alguien  escribe un comentario en alguna de sus páginas de su web site</span></a>

<!-- cumpleaños -->
<!-- 9 --><a href="javascript:;" class="boton" id="boton9" onclick="P7_MultiClass2('nbloque1','nbloqueoculto','nbloque2','nbloqueoculto','nbloque3','nbloqueoculto','nbloque4','nbloqueoculto','nbloque5','nbloqueoculto','nbloque6','nbloqueoculto','nbloque7','nbloqueoculto','nbloque8','nbloqueoculto','nbloque9','nbloquevisible','boton1','boton','boton2','boton','boton3','boton','boton4','boton','boton5','boton','boton6','boton','boton7','boton','boton8','boton','boton9','botonactivo')">cumpleaños<span class="derecha">Si usted tiene  instalado el  módulo de cunpleaños, este es el  mensaje  de felicitaciones que le llega a su usuario el día que cumple años</span></a>

<?php } ?>
<?php } ?>
<?php } ?>




</div>








<form name="form1" method="post" action="" id="form1">


<div id="nbloque3" class="nbloqueoculto">
<div id="nbloque">
<h1>Se registra un nuevo usuario en su web site</h1>
<p>Si su web site tiene sistema de usuarios registrados, &eacute;stos son los&nbsp; e-mails que le llegan tanto al usuario como al administrador  (Usted) justo luego de completar el formulario de registro.</p>


<h2>Mensaje al Admin</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_users_registro_admin" type="text" class="n-form-box" id="r-subject_users_registro_admin" value="<?=$data['subject_users_registro_admin']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>
<label class="especial"><span class="especial">Contenido</span><textarea name="r-users_registro_admin" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-users_registro_admin"><?=$data['users_registro_admin']?>
           </textarea></label>


<h2>Mensaje al Usuario</h2>

<label class="especial"><span class="especial">Titulo</span><input name="r-subject_users_registro_user" type="text" class="n-form-box" id="r-subject_users_registro_user" value="<?=$data['subject_users_registro_user']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>
<label class="especial"><span class="especial">Contenido</span><textarea name="r-users_registro_user" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-users_registro_user"><?=$data['users_registro_user']?>
           </textarea></label>





<div id="nseparador"></div>
</div>
</div>

<div id="nbloque4" class="nbloqueoculto">
<div id="nbloque">
<h1>Mensaje manual de Bienvenida al Usuario</h1>
<p>Use este email para dar una bienvenida detallada a sus nuevos usuarios registrados. Este Email se envía cuando se elecciona la opcion "Dar Bienvenida" en la búsqueda de usuarios.</p>



<h2>Mensaje al Usuario</h2>

<label class="especial"><span class="especial">Titulo</span><input name="r-subject_users_registro_activo" type="text" class="n-form-box" id="r-subject_users_registro_activo"  value="<?=$data['subject_users_registro_activo']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>
<label class="especial"><span class="especial">Contenido</span><textarea name="r-users_registro_activo" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-users_registro_activo"><?=$data['users_registro_activo']?>
            </textarea></label>






<div id="nseparador"></div>
</div>
</div>


<div id="nbloque1" class="nbloqueoculto">
<div id="nbloque">
<h1>Usuario realiza una nueva orden de compra</h1>
<p>El usuario ve algún producto de su catálogo y elige realizar una compra, cuando el proceso finaliza, se envían dos correos, uno hacia el email registrado del usuario y otro al correo que usted tiene identificado en "Identidad de la Empresa"</p>
<h2>Mensaje al Admin</h2>
<label class="especial"><span class="especial">Titulo</span>
<input name="r-subject_orden_compra_admin" type="text" class="n-form-box" id="r-subject_orden_compra_admin" value="<?=$data['subject_orden_compra_admin']?>" size="150"></label>
<div id="nseparador" style="height:10px;"></div>
<label class="especial"><span class="especial">Mensaje</span>
<textarea name="r-prod_orden_compra_admin" cols="155" rows="5" class="n-form-box" id="r-prod_orden_compra_admin"><?=$data['prod_orden_compra_admin']?></textarea></label>


<h2>Mensaje al Usuario</h2>

<label class="especial"><span class="especial">Titulo</span><input name="r-subject_orden_compra_user" type="text" class="n-form-box" id="r-subject_orden_compra_user" value="<?=$data['subject_orden_compra_user']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>

<label class="especial"><span class="especial">Mensaje</span><textarea name="r-prod_orden_compra_user" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-prod_orden_compra_user"><?=$data['prod_orden_compra_user']?>
          </textarea></label>




<div id="nseparador"></div>
</div>
</div>

<div id="nbloque2" class="nbloqueoculto">
<div id="nbloque">
<h1>Orden de compra es revisada por el Admin</h1>
<p>En la secci&oacute;n &oacute;rdenes de compra, usted podr&aacute; revisar los datos de la misma, agregar cargos (recargos, costo de env&iacute;o, etc), aplicar descuentos y escribir observaciones adicionales; esta &quot;factura proforma&quot; ser&aacute; enviada a su cliente; aqu&iacute; es donde se controla el formato de ese mensaje.</p>
<h2>Mensaje al Usuario</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_prod_orden_admin" type="text" class="n-form-box" id="r-subject_prod_orden_admin" value="<?=$data['subject_prod_orden_admin']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>

<label class="especial"><span class="especial">Contenido</span><textarea name="r-prod_orden_admin" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-prod_orden_admin"><?=$data['prod_orden_admin']?>
           </textarea></label>

<div id="nseparador"></div>
</div>
</div>




<div id="nbloque5" class="nbloqueoculto">
<div id="nbloque">
<h1>Pago Notificado por el usuario en su web site</h1>
<p>Éste E-mail se envía tanto al usuario como al administrador del web site cuando u usuario  llena el formulario de reporte de pago en su web site.</p>


<h2>Mensaje al Admin</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_pay_admin" type="text" class="n-form-box" id="r-subject_pay_admin" value="<?=$data['subject_pay_admin']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>
<label class="especial"><span class="especial">Contenido</span><textarea name="r-pay_admin" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-pay_admin"><?=$data['pay_admin']?>
           </textarea></label>


<h2>Mensaje al Usuario</h2>

<label class="especial"><span class="especial">Titulo</span><input name="r-subject_pay_user" type="text" class="n-form-box" id="r-subject_pay_user" value="<?=$data['subject_pay_user']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>
<label class="especial"><span class="especial">Contenido</span><textarea name="r-pay_user" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-pay_user"><?=$data['pay_user']?>
           </textarea></label>


<div id="nseparador"></div>
</div>
</div>

<div id="nbloque6" class="nbloqueoculto">
<div id="nbloque">
<h1>Pago aprobado por el administrador</h1>
<p>Éste e-mail le llega al usuario cuando usted  aprueba un pago desde el módulo de pagos aquí en el panel de administración del web site.</p>


<h2>Mensaje al Usuario</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_pay_confirm_admin" type="text" class="n-form-box" id="r-subject_pay_confirm_admin" value="<?=$data['subject_pay_confirm_admin']?>" size="150" /></label>
<div id="nseparador" style="height:10px;"></div>
<label class="especial"><span class="especial">Contenido</span><textarea name="r-pay_confirm_admin" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-pay_confirm_admin"><?=$data['pay_confirm_admin']?>
           </textarea></label>




<div id="nseparador"></div>
</div>
</div>

<div id="nbloque7" class="nbloqueoculto">
<div id="nbloque">
<h1>Pago negado por el administrador</h1>
<p>&Eacute;ste es el&nbsp; e-mail que le llega al usuario si usted rechaza un pago desde el m&oacute;dulo de pagos aqu&iacute; en el panel de administraci&oacute;n del web site.</p>

<h2>Mensaje al Usuario</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_pay_deny_admin" type="text" class="n-form-box" id="r-subject_pay_deny_admin" value="<?=$data['subject_pay_deny_admin']?>" size="150" /></label>

<div id="nseparador" style="height:10px;"></div>


<label class="especial"><span class="especial">Contenido</span><textarea name="r-pay_deny_admin" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="r-pay_deny_admin"><?=$data['pay_deny_admin']?>
           </textarea></label>





<div id="nseparador"></div>
</div>
</div>


<div id="nbloque8" class="nbloqueoculto">
<div id="nbloque">
<h1>
Comentarios de usuarios, escritos en&nbsp; sus p&aacute;ginas <a href="javascript:;" onclick="MM_openBrWindow('help/contenido-articulo-mensajes.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="icon/icon-info.gif" width="16" height="16" border="0" /></a></h1>
<p>Éste es el mensaje de notificación que le llega  a usted cuando un  usuario escribe un  comentario en una  de sus páginas.</p>

<h2>Mensaje al Admin</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_msg_admin" type="text" class="n-form-box" id="r-subject_msg_admin" value="<?=$data['subject_msg_admin']?>" size="150" /></label>

<div id="nseparador" style="height:10px;"></div>


<label class="especial"><span class="especial">Contenido</span><textarea name="r-msg_admin" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="textarea"><?=$data['msg_admin']?>
           </textarea></label>





<div id="nseparador"></div>
</div>
</div>


<div id="nbloque9" class="nbloqueoculto">
<div id="nbloque">
<h1>Cumpleaños del Usuario</h1>
<p>Si usted tiene éste módulo activado, el  sistema le enviará un mensaje, tanto a usted como  al usuario el día de su cumpleaños.</p>

<h2>Mensaje al Admin</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_msg_admin_happybirth" type="text" class="n-form-box" id="r-subject_msg_admin_happybirth" value="<?=$data['subject_msg_admin_happybirth']?>" size="150" /></label>

<div id="nseparador" style="height:10px;"></div>


<label class="especial"><span class="especial">Contenido</span><textarea name="r-msg_admin_happybirth" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="textarea"><?=$data['msg_admin_happybirth']?>
           </textarea></label>


<h2>Mensaje al Usuario</h2>
<label class="especial"><span class="especial">Titulo</span><input name="r-subject_msg_user_happybirth" type="text" class="n-form-box" id="r-subject_msg_user_happybirth" value="<?=$data['subject_msg_user_happybirth']?>" size="150" /></label>

<div id="nseparador" style="height:10px;"></div>


<label class="especial"><span class="especial">Contenido</span><textarea name="r-msg_user_happybirth" cols="155" rows="5" wrap="VIRTUAL" class="n-form-box" id="textarea"><?=$data['msg_user_happybirth']?>
           </textarea></label>


<div id="nseparador"></div>
</div>
</div>





































<center>

<input name="Submit" type="submit" class="form-button" value="Guardar" />
&nbsp;
<input name="Submit2" type="button" class="form-button" onclick="history.back();" value="Cancelar" />
</center>

</form>
<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?></td>
  </tr>
</table>
</body>
</html>
<?php $tool->cerrar(); ?>
