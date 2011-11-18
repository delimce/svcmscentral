<?php session_start();
$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/funciones.php"); ////////clase
include("../../SVsystem/class/fecha.php");


$tool = new tools();
$fecha = new fecha("d/m/Y");

$tool->autoconexion();


	  if(isset($_POST['Submit'])){

		  $tool->abrir_transaccion();

		/////////////////////

		$datax = $tool->simple_db("select cat_id, cat_nivel from producto where id = '{$_POST['id']}'");
		////////////////////

		$campos[0] = 'codigo';                 $valores[0] = $_POST['codigo'];
		$campos[1] = 'nombre';                 $valores[1] = $_POST['nombre'];
		$campos[2] = 'resumen';                $valores[2] = $_POST['resumen'];

		$campos[3] = 'activo';                  $valores[3] = $_POST['activo'];
		$campos[4] = 'fecha_publi_inicio';      $valores[4] = $_POST['finicio'];
		$campos[5] = 'fecha_publi_fin';         $valores[5] = $_POST['ffin'];

		$campos[6] = 'precio';        			 $valores[6] = $_POST['precio'];
		$campos[7] = 'descripcion';   			 $valores[7] = $_POST['desc'];
		$campos[8] = 'empaque';       			 $valores[8] = $_POST['empaque'];

		$campos[9] = 'medidas';       			 $valores[9]  = $_POST['medidas'];
		$campos[10] = 'peso';        			 $valores[10] = $_POST['peso'];
		$campos[11] = 'url';          			 $valores[11] = $_POST['url'];
		$campos[12] = 'doc_label';     			 $valores[12] = $_POST['doc_label'];
		$campos[13] = 'variaciones';   			 $valores[13] = $_POST['varia'];
		$campos[14] = 'doc_file';      			 $valores[14] = $_POST['doc_file'];
		$campos[15] = 'destacado';     			 $valores[15] = $_POST['destaca'];
		$campos[16] = 'fecha_mod';     			 $valores[16] = date("Y-m-d H:i");
		$campos[17] = 'stock';     			 	 $valores[17] = $_POST['stock'];

		$campos[18] = 'meta_google';			 $valores[18]  = trim($_POST['google_text']);
		$campos[19] = 'meta_desc';			     $valores[19]  = trim($_POST['description']);
		$campos[20] = 'meta_keywords';			 $valores[20]  = trim($_POST['keywords']);

		if(empty($_POST['doc_label'])) $_POST['doc_label'] = ''; ///bug de los 0
		if(empty($_POST['doc_label'])) $_POST['doc_file'] = ''; ///bug de los 0

		////peso volumetrico
	    if(!empty($_POST['pesov'])){ $campos[21] = 'pesov';	 $valores[21]  = $_POST['pesov']; }

		$tool->update("producto",$campos,$valores,"id = {$_POST['id']}");



		if(count($_SESSION['VARIACION_valor'])>0){

		$tool->query("delete from prod_varia where prod_id = {$_POST['id']} ");

		$varia2[0] = $_POST['id'];



				for($w=0;$w<count($_SESSION['VARIACION_valor']);$w++){

					$varia2[1] = $_SESSION['VARIACION_valor'][$w];
					$tool->insertar2("prod_varia","prod_id,variacion",$varia2);


				}


		}



		if(count($_SESSION['IMAGENES'])>0){

		$tool->query("delete from imagen_producto where prod_id = {$_POST['id']} ");

		$varia3[0] = $_POST['id'];



				for($w=0;$w<count($_SESSION['IMAGENES']);$w++){

					$varia3[1] = $_SESSION['IMAGENES'][$w];
					$tool->insertar2("imagen_producto","prod_id,ruta",$varia3);


				}


		}


		$tool->cerrar_transaccion();

		$tool->cerrar();
		unset($_SESSION['VARIACION_valor']);
		unset($_SESSION['IMAGENES']);

		?>
		 <script language="JavaScript" type="text/JavaScript">
	  	 window.opener.abrir_cat('<?=$datax['cat_id'] ?>','<?=$datax['cat_nivel']?>');
		 window.opener.abrir_cat('<?=$datax['cat_id'] ?>','<?=$datax['cat_nivel']?>');

		 window.close();
	    </script>

		<?


	}else{

	 $datos = $tool->simple_db("select p.activo prodActivo, p.*, pref.* from producto p,preferencias pref where id = {$_REQUEST['id']} ");

	}

unset($_SESSION['VARIACION_valor']);
unset($_SESSION['IMAGENES']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Producto  <?=$datos['nombre']?></title>
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

<script language="JavaScript" type="text/JavaScript">
var TopFrameObj;
	TopFrameObj = window;


function borrar_doc(){

	var archivo;

		 if (confirm('Esta seguro que desea borrar el archivo (esta opcion es irreversible) ?')) {

		 		archivo = document.getElementById('doc_file').value;

				//alert(archivo);

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



//-->
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>



</head>

<body>

<div id="ncuerpo" style="width:100%; margin:0; padding:0; top:0; background:url(/admin/SVimages/nfondo.jpg) repeat fixed 0 0;">
<div id="ncontenedor" style="width:100%; margin:0 auto;">
<div id="nnavbar" style="width:100%;">
<a href="javascript:window.close();" class="especial" style="background-color:#C00; color:#fff;">[x]Cancelar</a>






</div>




<div id="ntitulo">Editar Producto <?=$datos['nombre']?>   <a href="../help/productos-detalle-de-producto.php"><img src="../icon/icon-info.gif" alt="lea la ayuda!" width="16" height="16" border="0" align="absmiddle" > </a> </div>

<!-- comienza mega form 1 -->
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

<div id="ncontenido">




<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Contenido del Producto </div>
<label class="especial"><span class="especial">Titulo</span>
<input name="nombre" type="text" class="n-form-box" id="nombre" value="<?=$datos['nombre']?>" size="70" />
</label>
<div id="nseparador" style="height:20px;"></div>
<label class="especial"><span class="especial">Resumen</span>
<input name="resumen" type="text" class="n-form-box" id="resumen" value="<?=$datos['resumen']?>" size="100" />
</label>
<div id="nseparador" style="height:20px;"></div>


<div id="nizquierda">

<div id="titulo">Características Generales</div>
<div id="titulo2"><a href="javascript:;" class="instruccion">&iquest;Publicado? <span>Aquí usted decide si el producto es mostrado o no en el catálogo. Esta acción no borra el producto de la base de datos pero si lo oculta de la  página web. Útil para cuando se quiere sacar un producto del inventario momentáneamente o cuando se está editando el producto y no se tiene todavía una versión definitiva.</span></a>

<a href="javascript:;" title="¿qué rayos significa esto?" onClick="MM_openBrWindow('../help/contenido-articulo-activo.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></div>

<div id="cajita"><input name="activo" type="checkbox" value="1" <?php  if($datos['prodActivo']==1) echo "checked"; ?> id="activo">
               
              
</div>



<div id="titulo2"><a href="javascript:;" class="instruccion">&iquest;Destacado?<span>Si usted tiene una sección de productos destacados en su pagina web, sus productos marcados como destacados saldr&aacute;n listados</span></a></div>

<div id="cajita"><input name="destaca" type="checkbox" value="1" <?php  if($datos['destacado']==1) echo "checked"; ?> id="destaca">
</div>


<div id="titulo2">C&oacute;digo</div>
<p>Sea ordenado, asígnele un código a sus productos.</p>
<div id="cajita"><input name="codigo" type="text" class="n-form-box" id="codigo" value="<?=$datos['codigo']?>" size="15">
  </div>







<div id="titulo2">Precio <?php echo $moneda; ?> <a href="../opciones-moneda.php" title="cambiar moneda" target="_blank"> <font size="2">[cambiar]</font> </a></div>
<div id="cajita">
<input name="precio" type="text" class="n-form-box" id="precio" value="<?=round($datos['precio'],2)?>" size="10" />
</div>





<div id="titulo2">Stock</div>
<p>Cantidades del producto en Inventario. <span style="color:#900;">Si el Stock es "0" (cero), el producto se desactiva automaticamente.</span></p>
<div id="cajita">
<input name="stock" type="text" class="n-form-box" id="stock" value="<?=$datos['stock']?>" size="10">
</div>

<div id="titulo2">Empaque</div>
<p>Unidades por paquete.</p>
<div id="cajita">
<input name="empaque" type="text" class="n-form-box" id="empaque" value="<?=$datos['empaque']?>" size="10" />
</div>


<div id="titulo2">Medidas</div>
<div id="cajita">
<input name="medidas" type="text" class="n-form-box" id="medidas" value="<?=$datos['medidas']?>" size="30" />
</div>



<div id="titulo2">Peso</div>
<div id="cajita">
<input name="peso" type="text" class="n-form-box" id="peso" value="<?=$datos['peso']?>" size="10" />
</div>



<div id="titulo2">Peso Volum&eacute;trico</div>
<p>No funciona en todos  los web sites.</p>
<div id="cajita">
<input name="pesov" type="text" class="n-form-box" id="pesov" value="<?=$datos['pesov']?>" size="10" />
</div>




<div id="titulo2">Rango de Fechas de publicaci&oacute;n</div>
<p><strong>Rango de fechas en las cuales su producto estará publicado.</strong> Al finalizar el rango de fechas, su producto pasará automáticamente de publicado a NO publicado.</p>
<div id="cajita">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
<td width="6%"><input name="ind" type="checkbox" value="1" <?php  if($datos['activo']==1) echo "checked"; ?> id="ind"></td>
<td width="31%"><font size="2"><a href="javascript:;" class="instruccion">Indefinidamente<span>Si selecciona esta opci&oacute;n, su producto estar&aacute; publicado siempre.</span></a></font></td>
<td width="31%"><input name="finicio" type="text" class="n-form-box" id="finicio" value="<?=$datos['fecha_publi_inicio']?>" size="12" /><img src="../icon/cal.gif" alt="" name="f_trigger_d" width="16" height="16" id="f_trigger_d" style="cursor: hand; border: 0px;" title="fecha">
<script type="text/javascript">
					Calendar.setup({
						inputField     :    "finicio",     // id of the input field
						ifFormat       :    "<?=strtolower("Y-m-d")?>",    // format of the input field
						button         :    "f_trigger_d",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script></td>
           <td width="3%"><font size="2">&nbsp;a</font></td>
           <td width="29%"><input name="ffin" type="text" class="n-form-box" id="ffin" value="<?=$datos['fecha_publi_fin']?>" size="12" /><img src="../icon/cal.gif" alt="" name="f_trigger_c" width="16" height="16" id="f_trigger_c" style="cursor: hand; border: 0px;" title="fecha">
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

<label class="especial"><span class="especial">Texto</span><textarea name="desc" cols="100" rows="35" id="desc" class="n-form-box"><?=$datos['descripcion']?></textarea></label>

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

<label class="especial"><span class="especial">HTML</span><textarea name="google_text" cols="100" rows="5" class="n-form-box" id="google_text"><?=$datos['meta_google']?></textarea></label>





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
           <td width="27%"><input name="doc_label" type="text" class="n-form-box" value="<?=$datos['doc_label']?>" size="40" id="doc_label" /></td>
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
<input name="url" type="text" class="n-form-box" id="url" value="<?=$datos['url']?>" size="60" />
<!-- cierra nbloque enlaces externos -->
</div>




<!-- enlaces externos -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Variaciones</div>
<p>Especifique el titulo de la variaci&oacute;n del producto (Ej. colores)  y luego agregue los tipos de variaciones (Ej. verde, rojo, negro) Puede borrarlas y moverlas de orden. </p>
<table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
<tr>
<td width="21%" class="td-headertabla">T&iacute;tulo del Grupo de Variaciones</td>
<td width="50%" class="td-headertabla">Variaciones Agregadas</td>
<td width="29%" class="td-headertabla">Agregar Variaci&oacute;n</td>
</tr>
<tr>
<td><input name="varia" type="text" class="n-form-box" id="varia" value="<?=$datos['variaciones']?>" size="30" /></td>
<td><iframe src="variaciones_prod.php?prod_id=<?=$datos['id']?>" name="varia" width="100%" height="80" frameborder="0" id="varia2"></iframe></td>
<td><input name="variacion" type="button" class="form-button" id="variacion" onclick="MM_openBrWindow('popup-insert-variaciones.php','variaciones','width=400,height=180')" value="[+] Agregar Variaci&oacute;n" /></td>
</tr>
</table>
<!-- cierra nbloque enlaces externos -->
</div>








<!-- google -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Meta Tags para Posicionamiento en Buscadores</div>

<div id="ntitulo3">Descripción de la página</div>
<p>Inserte una descripción concisa sobre esta página que incluya la mayor cantidad de veces la frase de búsqeuda por la cual usted desea posicionar. La frase de búsqueda debe ser igual al título de la  página y también  aparecer la mayor cantidad de veces posible en el TEXTO de su  artículo. Sea <b>coherentemente redundante</b> en este campo.</p>
<label class="especial"><span class="especial">Meta Tag Description</span><textarea name="description" cols="100" rows="5" class="n-form-box" id="description"><?=$datos['meta_desc']?></textarea></label>
<div id="nseparador" style="height:20px;"></div>

<div id="ntitulo3">Keywords o Palabras Clave</div>
<p>Repita las palabras claves relacionadas a la frase de búsqueda por la que quiere posicionar; las palabras deben estar separadas por coma. Puede ser ligeramente redundante.</p>
<label class="especial"><span class="especial">Meta Tag Keywords</span><textarea name="keywords" cols="100" rows="5" class="n-form-box" id="keywords"><?=$datos['meta_keywords']?></textarea></label>
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
<?php

$tool->cerrar();

?>