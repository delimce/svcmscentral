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

		$tool->javaviso("Los emails han sido enviados correctamente","main.php");


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
		  } else if(isset($_REQUEST['too'])){
                          $mini = implode(',',$_REQUEST['too']);
                          $emails = $tool->array_query("select email from cliente where id in ($mini)");
                  }



	 }



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Env&iacute;o de Email</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../SVsystem/editor2/tiny_mce.js"></script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "mensaje",
        theme : "advanced",
        language: "es",
        theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
        apply_source_formatting : false,
        remove_script_host : false,
        convert_urls : false,
		inline_styles: true,
		plugins : "autoresize,autolink,lists,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,fullscreen,wordcount,advlist,style",



		// Theme options
		theme_advanced_buttons1 : "undo,redo,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,insertdate,inserttime,|,image,media,|,tablecontrols",
		theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,bold,italic,underline,strikethrough,sub,sup",
		theme_advanced_buttons3 : "bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,|,hr,advhr,|,charmap,attribs,styleprops,|,|,|,cleanup,removeformat,preview,code,fullscreen",
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
plugin_insertdate_timeFormat : "%H:%M:%S"



	});

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
function MM_popupMsg(msg) { //v1.0
  alert(msg);
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




<div id="ntitulo">Env&iacute;o de E-Mail</div>
<div id="ninstrucciones"><p>Desde aqu&iacute; usted puede enviar un email a <strong>sus usuarios registrados</strong>. El uso indebido de esta herramienta (enviar emails a usuarios NO registrados en su sistema) podria ocasionar la suspensión indefinida de su cuenta en svcmscentral.com.</p>
</div>


<div id="ncontenido">

<div id="nbloque">
<form name="form1" method="post" action="" id="form1">

<label class="especial"><span class="especial">Destinatarios</span><textarea style="height:80px;"  name="para" cols="130" rows="5" readonly="readonly" wrap="virtual" class="n-form-box" id="para" onClick="MM_popupMsg('Usted no puede editar este campo. Por favor  haga una b&uacute;squeda de usuarios y seleccione \&quot; Enviar Correo a Usuarios Seleccionados\&quot;')"><?php echo $emails = implode(',',$emails) ?></textarea></label> 


<div id="nseparador" style="height:20px;"></div>
<label class="especial"><span class="especial">Asunto</span><input style="margin-bottom:5px;" name="titulo" type="text" class="n-form-box" id="titulo" value="" size="130"></label>

<div id="nseparador" style="height:5px;"></div>
<label class="especial"><span class="especial">Mensaje</span>
<textarea name="mensaje" cols="130" rows="10" class="n-form-box" id="mensaje"></textarea>
</label>


<center><input name="Submit" type="submit" class="form-button" value="Enviar Correo">&nbsp;<input name="Submit2" type="button" class="form-button" onClick="history.back();" value="Cancelar"></center>
</form>

</div>



















<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?>
</body>
</html>