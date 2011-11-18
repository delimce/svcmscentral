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
//-->
</script>


</head>

<body>
<!--INCLUDES-->
<?php include "include-menu2.php" ?>

<!--INCLUDES-->

<table width="965" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="main.php"><img src="header-opciones.jpg" width="964" height="130" border="0"></a></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <!-- SUPER MENU !!! -->
<tr><td><?php include ("supermenu.php")?></td></tr>
<!--/// SUPER MENU -->
     <tr>
      <td class="td-titulo1">e-mails autom&aacute;ticos del sistema <a href="javascript:;" onClick="MM_openBrWindow('help/emails-automaticos.php','','scrollbars=yes,resizable=yes,width=900,height=550')"><img src="icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
     </tr>
     <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
       <tr>
        <td class="td-texto1"><p>Estos son lose-mails que le llegan al administrador del Web Site (usted) y a los usuarios de
          su sitio web cuando pasan cosas importantes en la p&aacute;gina. <a href="opciones-admin-identidad.php">La opci&oacute;n
            de identidad del Admin</a> le permite configurar el
          correo desde d&oacute;nde le llegan los correos a&nbsp; sus usuarios y hacia d&oacute;nde llegan los correos destinados al administrador de&nbsp; su&nbsp; p&aacute;gina.</p>
          <p>Los correos autom&aacute;ticos usan una serie de &quot;<a href="help/emails-automaticos.php" target="_blank">variables</a>&quot; que remplazan ciertos datos que son imposibles de colocar de otra forma. </p>
          <p>Por ejemplo... Cuando un&nbsp; usuario se inscribe en la&nbsp; p&aacute;gina web, a&nbsp; usted le&nbsp; debe llegar un correo inform&aacute;ndole de ello. Para que el sistema le&nbsp; informe el NOMBRE del usuario que se inscribe, el correo debe tener la variable &quot; $usern&nbsp;&quot; ... Entonces, cuando se inscribe <strong>Pedro</strong> en&nbsp; su p&aacute;gina web, si&nbsp;el correo de registro de nuevo usuario que va dirigido al administrador dice <em>&quot; <strong>$usern&nbsp;se ha registrado </strong>&quot;</em>, a&nbsp; usted le llegar&aacute;lo siguiente: &quot; <strong>Pedro se&nbsp; ha registrado</strong> &quot;</p>
          <p><a href="help/emails-automaticos.php" target="_blank">Vea la&nbsp; gu&iacute;a de variables para los&nbsp; emails autom&aacute;ticos</a>,&nbsp; aprenda un poco de codificaci&oacute;n HTML y p&oacute;ngase creativo&nbsp; con los mensajes que su sistema emite.</p></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
       </tr>
       <tr>
        <td><form name="form1" method="post" action="">
         <table width="100%" border="0" align="center" cellpadding="0" cellspacing="4">
          <tr>
           <td colspan="2" valign="top" class="td-headertabla4">Cat&aacute;logo de Productos</td>
         </tr>
          <tr>
           <td width="20%" rowspan="6" valign="top" class="td-form-title"><font size="4">Usuario realiza una nueva orden de compra<br>
           <font size="1">El usuario ve alg&uacute;n producto de su cat&aacute;logo y elige realizar una compra, cuando el proceso finaliza, se env&iacute;an
           dos correos, uno hacia el email registrado del usuario y otro al correo que usted tiene identificado en &quot;<a href="opciones-admin-identidad.php">Identidad
           de la Empresa</a>&quot;</font></font></td>
           <td width="67%" valign="top" class="td-form-title-izq">Mensaje al Admin</td>
          </tr>
          <tr>
           <td valign="top"><input name="r-subject_orden_compra_admin" type="text" class="form-box" id="r-subject_orden_compra_admin" value="<?=$data['subject_orden_compra_admin']?>" size="150"></td>
          </tr>
          <tr>
           <td valign="top"><textarea name="r-prod_orden_compra_admin" cols="155" rows="30" class="form-box" id="r-prod_orden_compra_admin"><?=$data['prod_orden_compra_admin']?>
           </textarea></td>
          </tr>
          <tr>
           <td valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          <tr>
           <td valign="top"><input name="r-subject_orden_compra_user" type="text" class="form-box" id="r-subject_orden_compra_user" value="<?=$data['subject_orden_compra_user']?>" size="150"></td>
          </tr>
          <tr>
          <td valign="top"><textarea name="r-prod_orden_compra_user" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-prod_orden_compra_user"><?=$data['prod_orden_compra_user']?>
          </textarea></td>
          </tr>
          <tr>
           <td valign="top">&nbsp;</td>
           <td valign="top">&nbsp;</td>
          </tr>
          <tr>
           <td rowspan="3" valign="top" class="td-form-title"><font size="4">Orden de compra es revisada por el Admin<br>
           <font size="1">En la secci&oacute;n <a href="productos/ordenes.php">&oacute;rdenes de compra</a>, cuando usted apruebe la misma, ha de cambiar el status a &quot;procesada&quot;. En este
           momento, al usuario le llega un correo para informarle que su ordend e compra ya fue procesada por usted. Usted
           deber&aacute; describir en este mensaje cu&aacute;l es el proceso a seguir luego de que la ordend e compra ha sido procesada.</font></font></td>
           <td valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          <tr>
           <td valign="top"><input name="r-subject_prod_orden_admin" type="text" class="form-box" id="r-subject_prod_orden_admin" value="<?=$data['subject_prod_orden_admin']?>" size="150"></td>
          </tr>
          <tr>
           <td valign="top"><textarea name="r-prod_orden_admin" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-prod_orden_admin"><?=$data['prod_orden_admin']?>
           </textarea>           </td>
          </tr>
          <tr>
            <td valign="top" class="td-form-title">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="top" class="td-headertabla4">Usuarios del Sitio Web <a href="javascript:;" onClick="MM_openBrWindow('help/usuarios-busqueda.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="icon/icon-info.gif" alt="" width="16" height="16" border="0" align="absmiddle"></a></td>
          </tr>
          <tr>
            <td rowspan="6" valign="top" class="td-form-title"><font size="4">Se registra un nuevo usuario</font></td>
            <td valign="top" class="td-form-title-izq">Mensaje al Admin</td>
          </tr>
          <tr>
            <td valign="top"><input name="r-subject_users_registro_admin" type="text" class="form-box" id="r-subject_users_registro_admin" value="<?=$data['subject_users_registro_admin']?>" size="150"></td>
          </tr>
          <tr>
            <td valign="top"><textarea name="r-users_registro_admin" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-users_registro_admin"><?=$data['users_registro_admin']?>
           </textarea></td>
          </tr>
          <tr>
            <td valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          <tr>
            <td valign="top"><input name="r-subject_users_registro_user" type="text" class="form-box" id="r-subject_users_registro_user" value="<?=$data['subject_users_registro_user']?>" size="150"></td>
          </tr>
          <tr>
            <td valign="top"><textarea name="r-users_registro_user" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-users_registro_user"><?=$data['users_registro_user']?>
           </textarea></td>
          </tr>
          <tr>
            <td rowspan="2" valign="top" class="td-form-title"><font size="4">Mensaje manual de Bienvenida al Usuario</font><br>

<span style="font-size:10px">Use este email para dar una bienvenida detallada a sus nuevos usuarios registrados. Este Email se envía cuando se elecciona la opcion "Dar Bienvenida" en la  búsqueda de usuarios.</span>

</td>
            <td valign="top"><input name="r-subject_users_registro_activo" type="text" class="form-box" id="r-subject_users_registro_activo"  value="<?=$data['subject_users_registro_activo']?>" size="150"></td>
          </tr>
          <tr>
            <td valign="top"><textarea name="r-users_registro_activo" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-users_registro_activo"><?=$data['users_registro_activo']?>
            </textarea></td>
          </tr>
          <tr>
            <td valign="top" class="td-form-title">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" valign="top" class="td-headertabla4">M&oacute;dulo de Pagos <a href="javascript:;" onClick="MM_openBrWindow('help/pagos.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="icon/icon-info.gif" alt="" width="16" height="16" border="0" align="absmiddle"></a></td>
          </tr>
          <tr>
            <td rowspan="6" valign="top" class="td-form-title"><font size="4">Pago notificado por el usuario en el sitio web</font></td>
            <td valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          <tr>
            <td valign="top"><input name="r-subject_pay_user" type="text" class="form-box" id="r-subject_pay_user" value="<?=$data['subject_pay_user']?>" size="150"></td>
          </tr>
          <tr>
            <td valign="top"><textarea name="r-pay_user" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-pay_user"><?=$data['pay_user']?>
           </textarea></td>
          </tr>
          <tr>
            <td valign="top" class="td-form-title-izq">Mensaje al Admin</td>
          </tr>
          <tr>
            <td valign="top"><input name="r-subject_pay_admin" type="text" class="form-box" id="r-subject_pay_admin" value="<?=$data['subject_pay_admin']?>" size="150"></td>
          </tr>
          <tr>
            <td valign="top"><textarea name="r-pay_admin" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-pay_admin"><?=$data['pay_admin']?>
           </textarea></td>
          </tr>
          <tr>
            <td rowspan="3" valign="top" class="td-form-title"><font size="4">Pago confirmado por el admin en el <a href="pagos/main.php" target="_blank">m&oacute;dulo
              de pagos</a></font></td>
            <td valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          <tr>
            <td valign="top"><input name="r-subject_pay_confirm_admin" type="text" class="form-box" id="r-subject_pay_confirm_admin" value="<?=$data['subject_pay_confirm_admin']?>" size="150"></td>
          </tr>
          <tr>
            <td valign="top"><textarea name="r-pay_confirm_admin" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-pay_confirm_admin"><?=$data['pay_confirm_admin']?>
           </textarea></td>
          </tr>
          <tr>
            <td rowspan="3" valign="top" class="td-form-title"><font size="4">Pago <font color="#CC3300">negado</font> por el admin en el <a href="pagos/main.php" target="_blank">m&oacute;dulo
              de pagos</a></font></td>
            <td valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          <tr>
            <td valign="top"><input name="r-subject_pay_deny_admin" type="text" class="form-box" id="r-subject_pay_deny_admin" value="<?=$data['subject_pay_deny_admin']?>" size="150"></td>
          </tr>
          <tr>
            <td valign="top"><textarea name="r-pay_deny_admin" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-pay_deny_admin"><?=$data['pay_deny_admin']?>
           </textarea></td>
          </tr>
          <tr>
            <td valign="top" class="td-form-title">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr style="display:none;">
           <td colspan="2" valign="top" class="td-headertabla4">Categor&iacute;as alimentables por usuarios en el m&oacute;dulo de contenidos <a href="javascript:;" onClick="MM_openBrWindow('help/contenido-categorias-alimentables.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
         </tr>
          <tr style="display:none;">
           <td rowspan="6" valign="top" class="td-form-title"><font size="4">Usuario crea un nuevo art&iacute;culo en una categor&iacute;a</font></td>
           <td valign="top" class="td-form-title-izq">Mensaje al Admin</td>
          </tr>
          <tr style="display:none;">
           <td valign="top"><input name="r-subject_cont_art_admin" type="text" class="form-box" id="r-subject_cont_art_admin" value="<?=$data['subject_cont_art_admin']?>" size="150"></td>
          </tr>
          <tr style="display:none;">
           <td valign="top"><textarea name="r-cont_art_admin" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-cont_art_admin"><?=$data['cont_art_admin']?>
           </textarea>           </td>
          </tr>
          <tr style="display:none;">
           <td valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          <tr style="display:none;">
           <td valign="top"><input name="r-subject_cont_art_user" type="text" class="form-box" id="r-subject_cont_art_user" value="<?=$data['subject_cont_art_user']?>" size="150"></td>
          </tr>
          <tr style="display:none;">
           <td valign="top"><textarea name="r-cont_art_user" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="r-cont_art_user"><?=$data['cont_art_user']?>
           </textarea>           </td>
          </tr>
          <tr  style="display:none;">
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          
          
          <tr>
            <td colspan="2" valign="top" class="td-headertabla4">Mensajes de Usuarios, Escritos en&nbsp; sus P&aacute;ginas<a href="javascript:;" onClick="MM_openBrWindow('help/contenido-articulo-mensajes.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
          </tr>
          
          
          <tr>
           <td rowspan="3" valign="top" class="td-form-title"><font size="4">Mensaje enviado por usuario en alg&uacute;n art&iacute;culo
           del sitio web</font></td>
           <td valign="top" class="td-form-title-izq">Mensaje al Admin</td>
          </tr>
          
          <tr>
           <td valign="top"><input name="r-subject_msg_admin" type="text" class="form-box" id="r-subject_msg_admin" value="<?=$data['subject_msg_admin']?>" size="150"></td>
          </tr>
          <tr>
           <td valign="top"><textarea name="r-msg_admin" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="textarea"><?=$data['msg_admin']?>
           </textarea></td>
          </tr>
          
          
          
          
          <tr>
           <td colspan="2" valign="top" class="td-headertabla4">Mensajes de cumpleaños </td>
          </tr>
          
          
          <tr>
           <td rowspan="3" valign="top" class="td-form-title"><font size="4">Mensaje de felicitaciones al usuario por concepto de cumplea&ntilde;os</font></td>
           <td height="24" valign="top" class="td-form-title-izq">Mensaje al Usuario</td>
          </tr>
          
          <tr>
           <td valign="top"><input name="r-subject_msg_user_happybirth" type="text" class="form-box" id="r-subject_msg_user_happybirth" value="<?=$data['subject_msg_user_happybirth']?>" size="150"></td>
          </tr>
          <tr>
           <td valign="top"><textarea name="r-msg_user_happybirth" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="textarea"><?=$data['msg_user_happybirth']?>
           </textarea></td>
          </tr>
          
            <tr>
           <td rowspan="3" valign="top" class="td-form-title"><font size="4">Mensaje de felicitaciones al Admin por concepto de cumplea&ntilde;os de usuario</font></td>
           <td valign="top" class="td-form-title-izq">Mensaje al Admin</td>
          </tr>
          
          <tr>
           <td valign="top"><input name="r-subject_msg_admin_happybirth" type="text" class="form-box" id="r-subject_msg_admin_happybirth" value="<?=$data['subject_msg_admin_happybirth']?>" size="150"></td>
          </tr>
          <tr>
           <td valign="top"><textarea name="r-msg_admin_happybirth" cols="155" rows="30" wrap="VIRTUAL" class="form-box" id="textarea"><?=$data['msg_admin_happybirth']?>
           </textarea></td>
          </tr>
          
          
          <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top"><input name="Submit" type="submit" class="form-button" value="Guardar">
              &nbsp;
              <input name="Submit2" type="button" class="form-button" onClick="history.back();" value="Cancelar"></td>
          </tr>
         </table>
        </form></td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
      </table>
      </td>
     </tr>
     <tr>
      <td align="center" bgcolor="#E5ECFA"><a href="http://www.proyecto-internet.com" target="_blank"><font size="1">Proyecto Internet</font></a><font size="1">&nbsp;</font></td>
     </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php $tool->cerrar(); ?>
