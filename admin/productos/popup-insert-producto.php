<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/fecha.php");
include("../../SVsystem/class/funciones.php"); ////////clase


$tool = new tools();
$tool->autoconexion();


 $ff = "31/12/".date("Y"); ///fecha fin

 $moneda = $tool->simple_db("select moneda_simbolo from preferencias");

if(isset($_POST['Submit'])){


	$fecha = new fecha("d/m/Y");

	///////////////

	//$tool->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['archivo']['name'],1);

	//////////////

	$valores[0]  = '';
	$valores[1]  = $_POST['codigo'];
	$valores[2]  = $_POST['nombre'];
	$valores[3]  = $_POST['precio'];
	$valores[4]  = $_POST['resumen'];
	$valores[5]  = $_POST['desc'];
	$valores[6]  = $_POST['activo'];
	$valores[7]  = $_POST['empaque'];
	$valores[8]  = $_POST['medidas'];
	$valores[9]  = $_POST['peso'];
	$valores[10] = $_POST['url'];
	$valores[11] = $_POST['finicio'];
	$valores[12] = $_POST['ffin'];
	$valores[13] = $_POST['nivel'];
	$valores[14] = $_POST['cat'];
	$valores[15] = $tool->simple_db("select max(orden)+1 as total from producto where cat_nivel = {$_POST['nivel']} and cat_id = {$_POST['cat']} ");
	$valores[16] = $_POST['titulo_doc'];
	$valores[17] = $_POST['doc_file'];
	$valores[18] = $_POST['varia'];
	$valores[19]  = $_POST['destaca'];
	$valores[20]  = $_POST['fecha_mod'];
	$valores[21]  = $_POST['stock'];
	$valores[22]  = $_POST['google_text'];
	$valores[23]  = $_POST['description'];
	$valores[24]  = $_POST['keywords'];

	$sv = 'SVsitefiles/'.$_SESSION['DIRSERVER'];

	if($_POST['titulo_doc']=="") @unlink("../../$sv/producto/doc/{$_POST['doc_file']}"); //elimina el archivo si se subio antes

	/////campos de insercion si viene lleno el campo de formulario
	$campos = "id,codigo,nombre,precio,resumen,descripcion,activo,empaque,medidas,peso,url,fecha_publi_inicio,fecha_publi_fin,cat_nivel,cat_id,orden,doc_label,doc_file,variaciones,destacado,fecha_mod,stock,meta_google,meta_desc,meta_keywords";
	////peso volumetrico
	if(!empty($_POST['pesov'])){ $campos.=",pesov"; $valores[25]  = $_POST['pesov']; }

	$tool->insertar2("producto",$campos,$valores);

	if(count($_SESSION['VARIACION_valor'])>0){

		$varia2[0] = $tool->ultimoID;

		for($w=0;$w<count($_SESSION['VARIACION_valor']);$w++){

			$varia2[1] = $_SESSION['VARIACION_valor'][$w];
			$tool->insertar2("prod_varia","prod_id,variacion",$varia2);


		}


	}


	if(count($_SESSION['IMAGENES'])>0){

		$varia3[0] = $tool->ultimoID;

		for($w=0;$w<count($_SESSION['IMAGENES']);$w++){

			$varia3[1] = $_SESSION['IMAGENES'][$w];
			$tool->insertar2("imagen_producto","prod_id,ruta",$varia3);


		}


	}



	$tool->cerrar();
	unset($_SESSION['VARIACION_valor']);
	unset($_SESSION['IMAGENES']);

	?>
     <script language="JavaScript" type="text/JavaScript">

		window.opener.abrir_cat('<?=$_POST['cat'] ?>','<?=$_POST['nivel'] ?>');
		window.opener.abrir_cat('<?=$_POST['cat'] ?>','<?=$_POST['nivel'] ?>');
		window.close();
   </script>

    <?


}

unset($_SESSION['VARIACION_valor']);
unset($_SESSION['IMAGENES']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Insertar Nuevo Producto</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<link href="../../SVsystem/js/calendario/calendario.css" type=text/css rel=stylesheet>
	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar.js"></script>
	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-es.js"></script>
	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-setup.js"></script>



<script type="text/javascript" src="../../SVsystem/editor2/tiny_mce.js"></script>



<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "desc",
        theme : "advanced",
        language: "es",
        theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
        apply_source_formatting : true,
        remove_script_host : false,
        convert_urls : false,
        inline_styles : true,


		plugins : "autoresize,autolink,lists,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,fullscreen,wordcount,advlist,autosave,style",

		paste_auto_cleanup_on_paste : true,
		paste_block_drop : true,
		paste_text_sticky : true,
		paste_text_use_dialog: true,

		// Theme options
		theme_advanced_buttons1 : "save,restoredraft,|,undo,redo,|,pastetext,pasteword,|,search,replace,|,insertdate,inserttime,|,image,media,|,tablecontrols",
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


<script language="javascript" src="../../SVsystem/class/libreriajax.js" type="text/javascript"></script>
<script language="javascript" src="../../SVsystem/class/efectos.js" type="text/javascript"></script>
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>


	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar.js"></script>
	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-es.js"></script>
	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-setup.js"></script>
	<LINK href="../../SVsystem/js/calendario/calendario.css" type=text/css rel=stylesheet>

<script language="JavaScript" type="text/JavaScript">


var TopFrameObj;
	TopFrameObj = window;



function borrar_doc(){

	var archivo;

		 if (confirm('Esta seguro que desea borrar el archivo (esta opcion es irreversible) ?')) {

		 		archivo = document.getElementById('doc_file').value;

				ajaxsend('post','popup-borrar-doc.php','archivo='+archivo);

				document.form1.doc_label.value = '';
			    document.form1.doc_file.value = '';
				document.getElementById('doc_file2').innerHTML='';

		 }

}

//del calendario
function fPopCalendar(popCtrl, dateCtrl, popCal, YOffset, XOffset) {
	popFrame.fPopCalendar(popCtrl,dateCtrl,popCal, YOffset, XOffset);
	return;
}

function fHideCalendar () {
	popCal.style.visibility = "hidden";
	return;
}

function KeepAliveNoError () {
	return true;
}


function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}


//-->
</script>



















</head>




<body>

<div id="ncuerpo" style="width:100%; margin:0; padding:0; top:0; background:url(/admin/SVimages/nfondo.jpg) repeat fixed 0 0;">
<div id="ncontenedor" style="width:100%; margin:0 auto;">
<div id="nnavbar" style="width:100%;">
<a href="javascript:window.close();" class="especial" style="background-color:#C00; color:#fff;">[x]Cancelar</a>






</div>




<div id="ntitulo">Crear Producto </div>

<!-- comienza mega form 1 -->
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

<div id="ncontenido">




<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Contenido del Producto </div>
<label class="especial"><span class="especial">Titulo</span>
<input name="nombre" type="text" class="n-form-box" size="80" id="nombre" />
</label>
<div id="nseparador" style="height:20px;"></div>
<label class="especial"><span class="especial">Resumen</span>
<input name="resumen" type="text" class="n-form-box" size="100" id="resumen" />
</label>
<div id="nseparador" style="height:20px;"></div>


<div id="nizquierda">

<div id="titulo">Características Generales</div>
<div id="titulo2">¿Publicado? <a href="javascript:;" title="¿qué rayos significa esto?" onClick="MM_openBrWindow('../help/contenido-articulo-activo.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></div>
<div id="cajita"><input name="activo" type="checkbox" value="1" checked id="activo">
               
              
</div>



<div id="titulo2"><a href="javascript:;" class="instruccion">&iquest;Destacado?<span>Si usted tiene una sección de productos destacados en su pagina web, sus productos marcados como destacados saldr&aacute;n listados</span></a></div>

<div id="cajita"><input name="destaca" type="checkbox" value="1" id="destaca">
</div>


<div id="titulo2">C&oacute;digo</div>
<p>Sea ordenado, asígnele un código a sus productos.</p>
<div id="cajita"><input name="codigo" type="text" class="n-form-box" size="15" id="codigo">
<input type="hidden" name="nivel" value="<?php echo $_REQUEST['nivel'] ?>" id="nivel">
               <input type="hidden" name="cat" value="<?php echo $_REQUEST['cat'] ?>" id="cat">
               <input name="fecha_mod" type="hidden" id="fecha_mod" value="<?=date("Y-m-d H:i") ?>">   </div>







<div id="titulo2">Precio <?php echo $moneda; ?> <a href="../opciones-moneda.php" title="cambiar moneda" target="_blank"> <font size="2">[cambiar moneda]</font> </a></div>
<div id="cajita">
<input name="precio" type="text" class="n-form-box" size="10" id="precio"></div>





<div id="titulo2">Stock</div>
<p>Cantidades del producto en Inventario. <span style="color:#900;">Si el Stock es "0" (cero), el producto se desactiva automaticamente.</span></p>
<div id="cajita">
<input name="stock" type="text" class="n-form-box" size="10" id="stock">
</div>

<div id="titulo2">Empaque</div>
<p>Unidades por paquete.</p>
<div id="cajita">
<input name="empaque" type="text" class="form-box" size="10" id="empaque">
</div>


<div id="titulo2">Medidas</div>
<div id="cajita">
<input name="medidas" type="text" class="n-form-box" size="30" id="medidas" />
</div>



<div id="titulo2">Peso</div>
<div id="cajita">
<input name="peso" type="text" class="n-form-box" size="10" id="peso" />
</div>



<div id="titulo2">Peso Volum&eacute;trico</div>
<p>No funciona en todos  los web sites.</p>
<div id="cajita">
<input name="pesov" type="text" class="n-form-box" size="10" id="pesov">
</div>




<div id="titulo2">Rango de Fechas de publicaci&oacute;n</div>
<p><strong>Rango de fechas en las cuales su producto estará publicado.</strong> Al finalizar el rango de fechas, su producto pasará automáticamente de publicado a NO publicado.</p>
<div id="cajita">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
<td width="6%"><input name="ind" type="checkbox" value="1" checked id="ind"></td>
<td width="31%"><font size="2"><a href="javascript:;" class="instruccion">Indefinidamente<span>Si selecciona esta opci&oacute;n, su producto estar&aacute; publicado siempre.</span></a></font></td>
<td width="31%"><input name="finicio" type="text" class="n-form-box" id="finicio" size="12">
  <img src="../icon/cal.gif" alt="" name="f_trigger_d" width="16" height="16" id="f_trigger_d" style="cursor: hand; border: 0px;" title="fecha">
  <script type="text/javascript">
					Calendar.setup({
						inputField     :    "finicio",     // id of the input field
						ifFormat       :    "<?=strtolower("Y-m-d")?>",    // format of the input field
						button         :    "f_trigger_d",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script></td>
           <td width="3%"><font size="2">&nbsp;a</font></td>
           <td width="29%"><input name="ffin" type="text" class="n-form-box" id="ffin" size="12">
             <img src="../icon/cal.gif" alt="" name="f_trigger_c" width="16" height="16" id="f_trigger_c" style="cursor: hand; border: 0px;" title="fecha">
             <script type="text/javascript">
					Calendar.setup({
						inputField     :    "ffin",     // id of the input field
						ifFormat       :    "<?=strtolower("Y-m-d")?>",    // format of the input field
						button         :    "f_trigger_c",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script></td>
         </tr>
       </table>
</div>



<!-- termina izquierda -->
</div>









<div id="nderecha">
<div id="titulo">Texto del artículo o Página</div>
<p> Por favor lea las instrucciones: <a href="javascript:;"  class="instruccion" onClick="MM_openBrWindow('../help/productos-detalle-de-producto.php','','scrollbars=yes,resizable=yes,width=900,height=500')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle" style="cursor:pointer;"> <span>Por favor LEA LAS INSTRUCCIONES</span></a>
<br/>
¿Desea incluir imágenes adicionales en el cuerpo del  artículo?:

<a href="javascript:;" onClick="MM_openBrWindow('../help/imagenes-personalizadas.php','','scrollbars=yes,resizable=yes,width=900,height=500')" title="Ayuda para colocar imagenes en el texto del artículo">
 <img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>

<label class="especial"><span class="especial">Texto</span><textarea name="desc" cols="100" rows="35" id="desc" class="n-form-box"></textarea></label>

<!-- termina derecha -->
</div>







<div id="nseparador"></div>
<!-- fin nbloque -->
</div>




<!-- imagenes adicionales -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Imágenes  del Producto </div>

<p>La primera imagen es la imagen principal del producto. Para ver la imagen  original, haga click en la miniatura. La imagen se abrirá en una nueva ventana en la que  usted podrá también copiar la dirección o URL de la imagen. No deje de leer la ayuda: <a href="../help/producto-imagenes-adicionales.php"><img src="../icon/icon-info.gif" alt="ayuda!" width="16" height="16" border="0" align="absmiddle" ></a></p>

<center><input name="agregarimagen" type="button"  class="form-button" id="agregarimagen" onClick="MM_openBrWindow('popup-editar-imagenes.php','agregarimagen','width=600,height=160')" value="[+] Agregar Imagen" ></center>

<iframe frameborder="0" name="imagen" src="imagenes.php?prod_id=<?=$datos['id']?>" width="100%" height="300"></iframe>
<div id="nseparador"></div>






<!-- fin nbloque imagenes adicionales -->
</div>









<!-- codigo html libre -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Código HTML libre</div>
<p>Inserte (Bajo su Responsabilidad) el código html de videos de Youtube u otros c&oacute;digos aquí. PROCEDA CON CAUTELA.</p>

<label class="especial"><span class="especial">HTML</span><textarea name="google_text" cols="100" rows="5" class="n-form-box" id="google_text"></textarea></label>





<!-- termina nbloque codigo libre -->
</div>
















<!-- documentos adicionales -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Documentos y Archivos Adjuntos para Descarga Directa</div>
<p>Agregue aquí todo archivo o documento adjunto que usted quiera sea descargado desde esta página. </p>


<div id="ntitulo3">Cargar Documento Nuevo o Remplazar Documento Existente</div>

<table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
         <tr>
           <td class="td-headertabla">T&iacute;tulo del Documento</td>
           <td class="td-headertabla">Archivo Cargado</td>
           <td class="td-headertabla">Acciones</td>
         </tr>
         <tr>
           <td width="27%"><input name="doc_label" type="text" class="n-form-box" value="" size="40" id="doc_label"></td>
           <td width="40%" class="bdc-td-dato-detalle2"><div id="doc_file2"></div>
            <input name="doc_file" type="hidden" id="doc_file" value="0"></td>

<td width="33%">

<input name="Cargar" type="button" class="form-button" id="Cargar" onClick="MM_openBrWindow('popup-editar-doc.php','cargardoc','width=400,height=200')" value="[^] Cargar Documento">
&nbsp;

<a title="Eliminar documento" onClick="borrar_doc();"><img src="../icon/icon-prod-delete.gif" width="16" height="16" border="0"></a> </td>
         </tr>
</table>



<!-- cierra nbloque documentos -->
</div>





<!-- enlaces externos -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Enlace Externo</div>
<p>Ingrese aquí un  enlace hacia otra página (interna o  externas) que se verá desde esta página. </p>

<input name="url" type="text" class="form-box" size="60" id="url">


<!-- cierra nbloque enlaces externos -->
</div>




<!-- enlaces externos -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Variaciones</div>
<p>Especifique el titulo de la variaci&oacute;n del producto (Ej. colores)  y luego agregue los tipos de variaciones (Ej. verde, rojo, negro) Puede borrarlas y moverlas de orden. </p>
<table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
         <tr>
           <td width="20%" class="td-headertabla">T&iacute;tulo del Grupo de Variaciones</td>
           <td width="56%" class="td-headertabla">Variaciones Agregadas</td>
           <td width="24%" class="td-headertabla">Agregar Variaci&oacute;n</td>
         </tr>
         <tr>
           <td> <input name="varia" type="text" class="n-form-box" id="varia" value="" size="30"></td>
           <td><iframe frameborder="0" name="varia" src="variaciones_prod.php?prod_id=<?=$datos['id']?>" width="100%" height="80"></iframe></td>
           <td><input name="variacion" type="button" class="form-button" id="variacion" onClick="MM_openBrWindow('popup-insert-variaciones.php','variaciones','width=400,height=180')" value="[+] Agregar Variación"></td>
         </tr>
       </table>




<!-- cierra nbloque enlaces externos -->
</div>








<!-- google -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Meta Tags para Posicionamiento en Buscadores</div>

<div id="ntitulo3">Descripción de la página</div>
<p>Inserte una descripción concisa sobre esta página que incluya la mayor cantidad de veces la frase de búsqeuda por la cual usted desea posicionar. La frase de búsqueda debe ser igual al título de la  página y también  aparecer la mayor cantidad de veces posible en el TEXTO de su  artículo. Sea <b>coherentemente redundante</b> en este campo.</p>
<label class="especial"><span class="especial">Meta Tag Description</span><textarea name="description" cols="100" rows="5" class="n-form-box" id="description"></textarea></label>
<div id="nseparador" style="height:20px;"></div>

<div id="ntitulo3">Keywords o Palabras Clave</div>
<p>Repita las palabras claves relacionadas a la frase de búsqueda por la que quiere posicionar; las palabras deben estar separadas por coma. Puede ser ligeramente redundante.</p>
<label class="especial"><span class="especial">Meta Tag Keywords</span><textarea name="keywords" cols="100" rows="5" class="n-form-box" id="keywords"></textarea></label>
<div id="nseparador" style="height:20px;"></div>







<!-- termina nbloque de google -->
</div>



























<center>
<input name="Submit" type="submit" class="form-button" id="button" value="[OK] Guardar">
         &nbsp;
         <input name="Submit2" type="button" class="form-button" onClick="window.close();" value="[x] Cancelar">
</center>



<!-- termina ncontenido -->
</div>
<!-- termina  mega form 1 -->
</form>

</div>
</div>





































</body>
</html>