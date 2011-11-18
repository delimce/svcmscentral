<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

$tool = new tools('db');

$data = $tool->simple_db("select noticias_titulo as n1,noticias_texto as n2 from cliente where id>0 limit 1 ");

	 if(isset($_POST['Submit'])){

		$titulo  = $_POST['titulo'];
		$mensaje = $_POST['mensaje'];

		
		$tool->query("update cliente set noticias_titulo = '$titulo', noticias_texto = '$mensaje' ");
		
		$tool->cerrar();
		
		
		$tool->javaviso("Los cambios se han efectuado correctamente","index.php");


	 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Noticia general para todos los usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/editor/tiny_mce.js"></script>

<script language="javascript" type="text/javascript">
tinyMCE.init({
mode : "exact",
elements : "mensaje",
theme : "advanced",
theme_advanced_blockformats : "p,div,h1,h2,h3,h4,h5,h6",
apply_source_formatting : "true",
convert_urls : "false",
plugins : "style,layer,table,charmap,advimage,save,advhr,advlink,emotions,insertdatetime,searchreplace,print,paste,fullscreen, preview,media,nonbreaking,visualchars",
language: "es",
theme_advanced_buttons1 : "search,replace,cut,copy,paste,undo,redo,separator,bold,italic,underline,strikethrough,sub,sup,separator,justifyleft,justifycenter,justifyright,justifyfull,nonbreaking,outdent,indent,bullist,numlist,forecolor,backcolor",
theme_advanced_buttons2 : "link,unlink,anchor,separator,charmap,tablecontrols,separator,insertdate,inserttime,image,media,emotions",
theme_advanced_buttons3 : "formatselect,fontselect,separator,fontsizeselect,separator,separator,removeformat,fullscreen, preview, code",
plugin_preview_width : "800",
plugin_preview_height : "550",
flash_wmode : "transparent",
flash_quality : "high",
flash_menu : "false",
media_use_script:"true",
nonbreaking_force_tab:"true",
plugin_insertdate_dateFormat : "<? echo "%d/%m/%Y"; ?> ",
plugin_insertdate_timeFormat : "%H:%M:%S",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
content_css : "example_word.css",
extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],iframe[src|width|height|name|align],object[align|width|height],param[name|value],embed[src|type|wmode|width|height]"


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
//-->

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>


</head>

<body>


<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Noticia General para Todos los Usuarios</div>
<div id="ninstrucciones">

<p>Desde aqu&iacute; usted puede escribir un mensaje que <strong>todos</strong> sus clientes suscritos ver&aacute;n en&nbsp; su p&aacute;gina de usuario.</p>
<p>Esta opcion no envía  los mensajes por correo, sólo los coloca en la pagina personal de todos los usuarios. Si usted desea enviar un EMAIL a todos sus usuarios, vaya <a href="/admin/opciones-sm.php">Aquí.</a></p>



</div>


<div id="ncontenido">

<div id="nbloque">
<div id="nbotonera" >



</div>


<form name="form1" method="post" action="" id="form1">

<label class="especial"><span class="especial">Objeto</span><input name="titulo" type="text" class="form-box" id="titulo" value="<? echo $data['n1'] ?>" size="130"></label>
<div id="nseparador" style="height:20px;"></div>
<label class="especial"><span class="especial">Objeto</span><textarea name="mensaje" cols="130" rows="20" class="form-box" id="mensaje"><? echo $data['n2'] ?></textarea></label>






<center><input name="Submit" type="submit" class="form-button" value="¡OK Publicar Mensaje!">&nbsp;
               <input name="Submit2" type="button" class="form-button" onClick="history.back();" value="Cancelar"></center>



</form>





























<!--  termina nbloque-->
</div>











<!-- termina ncontenido -->
</div>

<div id="nnavbar"><?php include "n-include-menu.php"?></div>

</div>
</div>
<?php include ("../n-footer.php")?>
<?php // include ("../n-include-mensajes.php") NO SIRVE EN ESTA PAGINA ?>












































<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include "menu.php" ?>
<!--INCLUDES-->
</body>
</html>
<?php $tool->cerrar(); ?>