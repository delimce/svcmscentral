<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

	$tool = new formulario();
	$tool->autoconexion();
	
	
	if($_POST['opcion']==1){
				
			$_POST['r-index_image'] = $_SESSION['IMAGENT'];
			$tool->update_data("r","-","preferencias",$_POST,"");
			$tool->redirect('../main.php');	
	
	}else if($_POST['opcion']==2){
	
			$_POST['r-index_image'] = $_SESSION['IMAGENT'];
			$tool->update_data("r","-","preferencias",$_POST,"");
			$tool->redirect('editar-index.php');
	
	}
	
	
	$dataindex = $tool->simple_db("select * from preferencias");
	
	$_SESSION['IMAGENT'] = $dataindex['index_image'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Index</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>

<script type="text/javascript" src="../../SVsystem/editor2/tiny_mce.js"></script>



<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "r-index_texto,r-index_footer",
        theme : "advanced",
        language: "es",
        theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
        apply_source_formatting : true,
        remove_script_host : false,
        convert_urls : false,
        inline_styles : true,


		plugins : "autoresize,autolink,lists,table,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,fullscreen,wordcount,advlist,style",

		paste_auto_cleanup_on_paste : true,
		paste_block_drop : true,
		paste_text_sticky : true,
		paste_text_use_dialog: true,

		// Theme options
		theme_advanced_buttons1 : "undo,redo,|,pastetext,pasteword,|,search,replace,|,insertdate,inserttime,|,image,media,|,tablecontrols",
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
</script>

<script language="JavaScript" type="text/JavaScript">



	function ordenar_art(orden,id,sentido){
	
	  
	  ajaxsend("post","ordenar_aec.php","orden="+orden+"&id="+id+"&se="+sentido);
	  location.replace('editar-index.php');
	  
	 
	}


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





<div id="ntitulo">Editar Página Pricipal de su Web Site</div>
<div id="ninstrucciones"><p>
En esta secci&oacute;n usted puede controlar la informaci&oacute;n que aparece en el <strong>index</strong> o p&aacute;gina principal de su web site. Por favor guarde los cambios realizados en el t&iacute;tulo y texto de la p&aacute;gina antes de agregar res&uacute;menes de art&iacute;culos en categor&iacute;as. <a href="javascript:;" onClick="MM_openBrWindow('../help/editar-index.php','','scrollbars=yes,resizable=yes,width=900,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>
</div>

<form name="form1" method="post" action="" id="form1">
<div id="ncontenido">

<div id="nbloque">
<div id="ntitulo2">Título de su página principal</div>

<input name="r-index_titulo" type="text" class="form-box" id="r-index_titulo" value="<?=$dataindex['index_titulo'] ?>" style="width:90%;"  >
</div>



<div id="nbloque">
<div id="ntitulo2">Imagen Principal</div>
<iframe name="ima" id="ima" height="280" width="100%" src="./pimagen.php" frameborder="0" allowtransparency="yes"></iframe>
<input name="opcion" type="hidden" id="opcion" value="1">
</div>




<div id="nbloque">
<div id="ntitulo2">Texto de la  página</div>
<textarea name="r-index_texto" rows="20" class="form-box" id="r-index_texto" ><?=$dataindex['index_texto'] ?></textarea>
</div>


<div id="nbloque">
<div id="ntitulo2"><a name="footer" id="footer"></a>Texto del pie de página</div>
<textarea name="r-index_footer" rows="10" class="form-box" id="r-index_footer" ><?=$dataindex['index_footer'] ?></textarea>
</div>



<div id="nbloque">
<div id="ntitulo2"><a name="yt" id="y"></a>Bloque de C&oacute;digo HTML Libre</div>
<textarea name="r-index_youtube" rows="10" class="form-box" id="r-index_youtube" ><?=$dataindex['index_youtube'] ?></textarea>
</div>


<div id="nbloque">
<div id="ntitulo2"><a name="metatags" id="metatags"></a>Meta Tags para Buscadores</div>

<label class="especial"><span class="especial">Description</span><textarea name="r-index_desc" rows="5" class="n-form-box" id="r-index_desc" ><?=$dataindex['index_desc'] ?></textarea></label>

<div id="nseparador" style="height:20px;"></div>

<label class="especial"><span class="especial">Keywords</span><textarea name="r-index_meta" rows="4" class="n-form-box" id="r-index_meta"><?=$dataindex['index_meta'] ?></textarea></label>
</div>


<div id="nbloque">
<div id="ntitulo2"><a name="aec" id="aec"></a>Bloques de P&aacute;ginas Destacadas 
<a href="javascript:;" class="instruccion" style="cursor:pointer;"  onClick="MM_openBrWindow('../help/aec.php','','scrollbars=yes,resizable=yes,width=900,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"> <span><strong>¿Qué es esto? </strong> haga click para leer las instrucciones</span></a></div>
<p>Una vez que usted haya completado las secciones de su p&aacute;gina web usando el árbol de <a href="../contenido/arbol.php">contenidos</a> o <a href="../productos/productos.php">productos</a>, usted podrá complementar su Index o página principal con bloques que muestran resúmenes de las p&aacute;ginas más importantes dentro de  algunas de las categorás que usted elija. <a href="javascript:;" onClick="MM_openBrWindow('../help/aec.php','','scrollbars=yes,resizable=yes,width=900,height=550')">(Leer mas)</a></p>


<div id="nbotonera">
<a href="javascript:;" class="boton" onClick="MM_openBrWindow('popup-crear-aec.php','','scrollbars=yes,resizable=yes,width=700,height=400')"><img src="/admin/icon/add.png" width="16" height="16" border="0" align="absmiddle">&nbsp; Agregar Nuevo Bloque</a>
</div>

<iframe name="bloque" width="100%" height="110" allowtransparency="yes" frameborder="0" src="bloques_aec.php"></iframe>

</div>





             




<center>
<input name="Button" type="button" onClick="document.form1.opcion.value='1';document.form1.submit();" class="form-button" value="Guardar y Finalizar">
 &nbsp;
<input name="Button" type="button" onClick="document.form1.opcion.value='2';document.form1.submit();" class="form-button" value="Guardar y Quedarse">
 &nbsp;
<input name="Submit2" type="button" class="form-button" onClick="location.replace('../main.php');" value="Salir sin Guardar"></td>
        </center> 


<!-- termina ncontenido -->
</div></form>
<?php include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>

































t


    



</body>
</html>
