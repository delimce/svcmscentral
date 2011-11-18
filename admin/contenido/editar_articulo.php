<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");
include("../../SVsystem/class/funciones.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();


 if(isset($_REQUEST['r-titulo'])){

 					$_POST['r-imagen'] =  $_SESSION['IMAGENT'];
					$_POST['r-imagen_titulo'] =  $_SESSION['TITULOIT'];


					$tool->query("SET AUTOCOMMIT=0"); ////iniciando la transaccion
					$tool->query("START TRANSACTION");

					$tool->query("delete from cont_adjunto where art_id = {$_REQUEST['id']}"); ///borra todo elemento no actualizado

					$tool->update_data("r","-","articulo",$_POST,"id = '{$_REQUEST['id']}'");
					$datax = $tool->simple_db("select cat_id, cat_nivel from articulo where id = '{$_REQUEST['id']}'");


					///////////////guardando campos adicionales
						 if(count($_POST['camposid'])>0){

						 		$tool->query("delete from campo_art where art_id = '{$_REQUEST['id']}' ");
								foreach($_POST['camposid'] as $i => $value){

									$vector9[0] = $_REQUEST['id'];
									$vector9[1] = $_POST['camposid'][$i];
									$vector9[2] = $_POST['camposa'][$i];

									$tool->insertar2("campo_art","art_id,campo_id,valor",$vector9);

								}


						 }//////////////



					$NUEVO_ID = $_REQUEST['id'];

							   for($i=0;$i<count($_SESSION['IMAGENES']);$i++){  ///imagenes

									$vector1[0] = $_REQUEST['id'];
									$vector1[1] = 'imagen';
									$vector1[2] = $_SESSION['IMAGENES'][$i];
									$vector1[3] = $_SESSION['IMAGENES_T'][$i];

									$tool->insertar2("cont_adjunto","art_id,tipo,ruta,titulo",$vector1);

								} ////////////////////////////////////////////////////// ARCHIVOS

								for($r=0;$r<count($_SESSION['FILES']);$r++){

									$vector2[0] = $NUEVO_ID;
									$vector2[1] = 'archivo';
									$vector2[2] = $_SESSION['FILES'][$r];
									$vector2[3] = $_SESSION['FILES_T'][$r];

									$tool->insertar2("cont_adjunto","art_id,tipo,ruta,titulo",$vector2);

								}


								for($s=0;$s<count($_SESSION['LINKS']);$s++){  ////liks

									$vector3[0] = $NUEVO_ID;
									$vector3[1] = 'link';
									$vector3[2] = $_SESSION['LINKS'][$s];
									$vector3[3] = $_SESSION['LINKS_T'][$s];

									$tool->insertar2("cont_adjunto","art_id,tipo,ruta,titulo",$vector3);

								}



					$tool->query("COMMIT");

					if($_REQUEST['opcion']==1){ ///depende si es ok o aplicar

						?>
						  <script language="JavaScript" type="text/JavaScript">
						   	window.opener.abrir_cat('<?=$datax['cat_id'] ?>','<?=$datax['cat_nivel']?>');
							window.opener.abrir_cat('<?=$datax['cat_id'] ?>','<?=$datax['cat_nivel']?>');

						   window.close();
						   </script>
						<?

					}else{

						$tool->redirect("editar_articulo.php?id=$NUEVO_ID");

					}


 }else{


 		$datos = $tool->simple_db("select * from articulo where id = {$_REQUEST['id']} ");


		 ///imagen tematica
		 $_SESSION['IMAGENT']  = $datos['imagen'];
 		 $_SESSION['TITULOIT'] = $datos['imagen_titulo'];

		 //imagenes adicionales
		 $_SESSION['IMAGENES']   = $tool->array_query("select ruta from cont_adjunto where tipo = 'imagen' and art_id = {$_REQUEST['id']} order by id ");
 		 $_SESSION['IMAGENES_T'] = $tool->array_query("select titulo from cont_adjunto where tipo = 'imagen' and art_id = {$_REQUEST['id']} order by id ");

		 //archivos adicionales
		 $_SESSION['FILES'] = $tool->array_query("select ruta from cont_adjunto where tipo = 'archivo' and art_id = {$_REQUEST['id']} order by id ");
		 $_SESSION['FILES_T'] = $tool->array_query("select titulo from cont_adjunto where tipo = 'archivo' and art_id = {$_REQUEST['id']} order by id ");

	 	//enlace adicionales
		 $_SESSION['LINKS'] = $tool->array_query("select ruta from cont_adjunto where tipo = 'link' and art_id = {$_REQUEST['id']} order by id ");
		 $_SESSION['LINKS_T'] = $tool->array_query("select titulo from cont_adjunto where tipo = 'link' and art_id = {$_REQUEST['id']} order by id ");


 }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title> Editar Art&iacute;culo: <?=$datos['titulo']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/SVsystem/lightbox/css/lightbox.css" type="text/css" media="screen" />
<link href="../estilos.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../../SVsystem/editor2/tiny_mce.js"></script>



<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "r-texto",
        theme : "advanced",
        language: "es",
        theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
         apply_source_formatting : true,
        remove_script_host : false,
        convert_urls : false,
        inline_styles : true,


		plugins : "autoresize,autolink,lists,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,fullscreen,wordcount,advlist,autosave,style",



		// Theme options
		theme_advanced_buttons1 : "save,restoredraft,|,undo,redo,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,insertdate,inserttime,|,image,media,|,tablecontrols",
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

<div id="ncuerpo" style="width:100%; margin:0; padding:0; top:0; background:url(/admin/SVimages/nfondo.jpg) repeat fixed 0 0;">
<div id="ncontenedor" style="width:100%; margin:0 auto;">
<div id="nnavbar" style="width:100%;">
<a href="javascript:window.close();" class="especial" style="background-color:#C00; color:#fff;">[x]Salir sin Guardar</a>
<a class="especial" style="background-color:#039; color:#fff; cursor:pointer;" onClick="document.form1.submit();" >Guardar y Cerrar</a>
<a class="especial" style="background-color:#039; color:#fff;cursor:pointer;" onClick="document.form1.opcion.value='2';document.form1.submit();">Guardar y Quedarse</a>
<a class="especial" style="background-color:#039; color:#fff;cursor:pointer;" onClick="document.form1.action='insert_articulo.php';document.form1.submit();" >Guardar Duplicado</a>



</div>




<div id="ntitulo">Editar Art�culo: <?=$datos['titulo']?></div>



<div id="ncontenido">


<!-- comienza mega form 1 -->
<form action="" method="post" name="form1" id="form1">

<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Contenido del Art�culo</div>
<label class="especial"><span class="especial">Titulo</span><input name="r-titulo" type="text" class="n-form-box" id="r-titulo" value="<?=$datos['titulo']?>" size="154"></label>
<div id="nseparador" style="height:20px;"></div>
<label class="especial"><span class="especial">Resumen</span><input name="r-resumen" type="text" class="n-form-box" id="r-resumen" value="<?=$datos['resumen']?>" size="154"></label>
<div id="nseparador" style="height:20px;"></div>


<div id="nizquierda">
<div id="titulo">Imagen Principal</div>
<iframe name="ima" id="ima" height="375" width="100%" src="opciones-articulo/pimagen.php" frameborder="0" allowtransparency="yes"></iframe>
<div id="nseparador"></div>
<div id="titulo">Caracter�sticas Generales</div>
<div id="titulo2">�Publicado? <a href="javascript:;" title="�qu� rayos significa esto?" onClick="MM_openBrWindow('../help/contenido-articulo-activo.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></div>
<div id="cajita"><select name="r-estatus" id="r-estatus">
               <option value="1" <?php if($datos['estatus']==1)echo 'selected';  ?> >Si</option>
               <option value="0" <?php if($datos['estatus']==0)echo 'selected';  ?>>No</option>
             </select>
               <input name="id" type="hidden" id="id" value="<?=$datos['id']?>">
               
               <input name="opcion" type="hidden" id="opcion" value="1">
               <input name="nivel" type="hidden" id="nivel" value="<?=$datos['cat_nivel'] ?>">
               <input name="cat" type="hidden" id="cat" value="<?=$datos['cat_id'] ?>">
               <input name="r-fecha_mod" type="hidden" id="r-fecha_mod" value="<?=date("Y-m-d H:i") ?>">
</div>



<div id="titulo2">Palabra Clave</div>
<p>Si su web site tiene <strong>listado de art&iacute;culos destacados</strong> en su p&aacute;gina principal, es aqu&iacute; donde debe escribir la palabra clave que&nbsp; har&aacute; que su&nbsp; art&iacute;culo salga listado en alguno de esos listados.</p>
<div id="cajita"><input name="r-autor" type="text" class="form-box" id="r-autor" value="<?=$datos['autor'] ?>" size="45"></div>


<div id="titulo2">�Acepta comentarios? <a href="javascript:;" title="�qu� rayos significa esto?" onClick="MM_openBrWindow('../help/contenido-articulo-mensajes.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></div>
<p>Decida si su  art�culo tiene  habilitada la opci�n para que  los usuarios registrados escriban comentarios p�blicos en el mismo</p>
<div id="cajita"><select name="r-user_mens" class="form-box" id="r-user_mens">
            <option <?php if($datos['user_mens']==1)echo 'selected';  ?> value="1">Si acepta</option>
            <option value="0" <?php if($datos['user_mens']==0)echo 'selected';  ?> >No acepta</option>
          </select>  </div>


<div id="titulo2">Lugar</div>
<p>Campo opcional para eventos</p>
<div id="cajita"><input name="r-lugar" type="text" class="n-form-box" id="r-lugar" value="<?=$datos['lugar']?>" size="40"></div>


<div id="titulo2">Fecha</div>
<p>Campo opcional para eventos</p>
<div id="cajita"><input name="r-fecha" type="text" class="n-form-box" id="r-fecha" value="<?=$datos['fecha']?>" size="15"></div>





<!-- termina izquierda -->
</div>









<div id="nderecha">
<div id="titulo">Texto del art�culo o P�gina</div>
<p><a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-texto-articulo.php','','scrollbars=yes,resizable=yes,width=900,height=500')" title="ayuda con el texto del art�culo">
ATENCI�N: �Lea instrucciones primero! <img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a>
<br/>
�Desea incluir im�genes adicionales en el cuerpo del  art�culo?:

<a href="javascript:;" onClick="MM_openBrWindow('../help/imagenes-personalizadas.php','','scrollbars=yes,resizable=yes,width=900,height=500')" title="Ayuda para colocar imagenes en el texto del art�culo">
 <img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>

<label class="especial"><span class="especial">Texto</span><textarea name="r-texto" cols="85" rows="23" id="r-texto" class="n-form-box"><?=$datos['texto']?>
    </textarea></label>

<!-- termina derecha -->
</div>







<div id="nseparador"></div>
<!-- fin nbloque -->
</div>



<!-- datos adicionales -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Datos o Campos Adicionales</div>
<p>Aqui van los campos que usted haya creado en la secci�n <a href="datos-adicionales.php">"Campos Adicionales"</a> en la base de datos.</p>


 <?php

	 			$camposa = $tool->estructura_db("SELECT DISTINCT
												  c.id,
												  c.nombre,
												  c.tipo,
												  c.longitud,
												  c.lineas,
												  c.valores,
												  (select valor from campo_art where art_id = '{$_REQUEST['id']}' and campo_id = c.id) as valor
												FROM
												  campo c
												WHERE c.modulo = 'cont'
												  order by c.orden ");

	 		?>





       

      <?php for($ii=0;$ii<count($camposa);$ii++){

	  		switch ($camposa[$ii]['tipo']) {
				case "texto":
				   $campo1 = '<input value="'.$camposa[$ii]['valor'].'" name="camposa[]" type="text" id="camposa[]" size="'.$camposa[$ii]['longitud'].'" />';
				   break;
				case "textarea":
				  $campo1 = '<textarea name="camposa[]" cols="'.$camposa[$ii]['longitud'].'" rows="'.$camposa[$ii]['lineas'].'" id="camposa[]">'.$camposa[$ii]['valor'].'</textarea>';
				   break;
				case "combo":
				   $campo1 = '<select name="camposa[]" id="camposa[]">';
				   $va = explode(',',$camposa[$ii]['valores']);
				   foreach($va as $valor){

						 if($camposa[$ii]['valor']==$valor) $sele = "selected"; else $sele = "";
						 $campo1.= "<option  $sele>".$valor.'</option>';

					}


				   $campo1.= '</select>';
				   break;
				}

	  			$campo1.='<input name="camposid[]" type="hidden" id="camposid[]" value="'.$camposa[$ii]['id'].'" />';
	  ?>

<div id="tituloizq"><?php echo $camposa[$ii]['nombre'] ?></div>
<div id="dataderecha"><?php echo $campo1; ?></div>

       <?php } ?>




<div id="nseparador"></div>
</div>






<!-- google -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Meta Tags para Posicionamiento en Buscadores</div>

<div id="ntitulo3">Descripci�n de la p�gina</div>
<p>Inserte una descripci�n concisa sobre esta p�gina que incluya la mayor cantidad de veces la frase de b�sqeuda por la cual usted desea posicionar. La frase de b�squeda debe ser igual al t�tulo de la  p�gina y tambi�n  aparecer la mayor cantidad de veces posible en el TEXTO de su  art�culo. Sea <b>coherentemente redundante</b> en este campo.</p>
<label class="especial"><span class="especial">Meta Tag Description</span><textarea name="r-meta_desc" cols="100" rows="5" class="n-form-box" id="r-meta_desc"><?=$datos['meta_desc']?></textarea></label>
<div id="nseparador" style="height:20px;"></div>

<div id="ntitulo3">Keywords o Palabras Clave</div>
<p>Repita las palabras claves relacionadas a la frase de b�squeda por la que quiere posicionar; las palabras deben estar separadas por coma. Puede ser ligeramente redundante.</p>
<label class="especial"><span class="especial">Meta Tag Keywords</span><textarea name="r-meta_keywords" cols="100" rows="5" class="n-form-box" id="r-meta_keywords"><?=$datos['meta_keywords']?></textarea></label>
<div id="nseparador" style="height:20px;"></div>

<div id="ntitulo3">Texto para Google Spam</div>
<p>Pr�ctica Ilegal que  potencia el posicionamiento en Google. Extremadamente �til pero penalizable. Esta opci�n NO est� activa en su Web site, pero si usted quiere  correr el riesgo, puede solicitarnos que la activemos.</p>
<label class="especial"><span class="especial">Google Spam</span><textarea name="r-meta_google" cols="100" rows="5" class="n-form-box" id="r-meta_google"><?=$datos['meta_google']?></textarea></label>
<div id="nseparador" style="height:20px;"></div>





<!-- termina nbloque de google -->
</div>





<!-- codigo html libre -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">C�digo HTML libre</div>
<p>Inserte (Bajo su Responsabilidad) el c�digo html de videos de Youtube u otros c&oacute;digos aqu�. PROCEDA CON CAUTELA.</p>

<label class="especial"><span class="especial">HTML</span><textarea name="r-textosimple" cols="110" rows="15" id="r-textosimple" class="n-form-box"><?=$datos['textosimple']?></textarea></label>





<!-- termina nbloque codigo libre -->
</div>






<!-- termina  mega form 1 -->
</form>



<!-- imagenes adicionales -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Im�genes Adicionales del  art�culo</div>
<p>Para ver la imagen  original, haga click en la miniatura. La imagen se abrir� en una nueva ventana en la que  usted podr� tambi�n copiar la direcci�n o URL de la imagen. No deje de leer la ayuda: <a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-imagenes-adicionales.php','','scrollbars=yes,resizable=yes,width=925,height=550')" title="ayuda con las im�genes"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>

<iframe name="imagenes" src="opciones-articulo/imagenes.php" frameborder="0" scrolling="auto" width="100%" height="155" style="background-color:#FFFFFF"></iframe>
<div id="nseparador"></div>
<div id="ntitulo3">Cargar Imagen nueva o Remplazar Imagen Existente (Seleccione el puesto donde desea ubicar su imagen)</div>


<form action="opciones-articulo/imagenes.php" target="imagenes" enctype="multipart/form-data" method="post" name="form2">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="6%" class="td-form-title4">Imagen</td>
    <td width="28%"><input name="file2" type="file" class="form-box" size="35">    </td>
    <td width="5%" class="td-form-title4">T&iacute;tulo</td>
    <td width="28%"><input name="tituloi" type="text" class="form-box" id="tituloi" size="50"></td>
    <td width="5%" class="td-form-title4">Lugar</td>
    <td width="12%"><select name="ordeni" class="form-box" id="ordeni">
      <?php for($i3=0;$i3<60;$i3++){ echo "<option value='$i3'>"; echo $i3+1; echo "</option>"; } ?>
    </select></td>
    <td width="16%"><input name="Submit5" type="submit" class="form-button" value="Subir Imagen"></td>
   </tr>
  </table>
</form>


<!-- fin nbloque imagenes adicionales -->
</div>





<!-- documentos adicionales -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Documentos y Archivos Adjuntos para Descarga Directa</div>
<p>Agregue aqu� todo archivo o documento adjunto que usted quiera sea descargado desde esta p�gina. Lea la  ayuda: <a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-documentos-adicionales.php','','scrollbars=yes,resizable=yes,width=925,height=550')" title="ayuda con los documentos o attachments"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>

<iframe width="100%" height="100" frameborder="0" scrolling="auto" name="archivo" src="opciones-articulo/files.php" ></iframe>
<div id="nseparador"></div>
<div id="ntitulo3">Cargar Documento Nuevo o Remplazar Documento Existente (Seleccione el puesto donde desea ubicar su documento)</div>

 <form action="opciones-articulo/files.php" target="archivo" enctype="multipart/form-data" method="post" name="form3">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="8%" class="td-form-title4">Documento</td>
    <td width="28%"><input name="file3" type="file" class="form-box" id="file3" size="35">    </td>
    <td width="5%" class="td-form-title4">T&iacute;tulo</td>
    <td width="28%"><input name="titulof" type="text" class="form-box" id="titulof" size="50">    </td>
    <td width="5%" class="td-form-title4">Lugar</td>
    <td width="11%"><select name="ordenf" class="form-box" id="ordenf">
    <?php for($i3=0;$i3<30;$i3++){ echo "<option value='$i3'>"; echo $i3+1; echo "</option>"; } ?>
    </select></td>
    <td width="15%"><input name="Submit52" type="submit" class="form-button" value="Subir Documento">    </td>
   </tr>
  </table>
</form> 



<!-- cierra nbloque documentos -->
</div>





<!-- enlaces externos -->
<div id="nbloque" class="fondoblanco">
<div id="ntitulo2">Links o Enlaces </div>
<p>Ingrese aqu� la lista de enlaces hacia otras p�ginas (internas o  externas) que se ver�n desde esta p�gina. Usted puede usar esta secci�n como  bloque de " Art�culos similares o relacionados". <a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-links.php','','scrollbars=yes,resizable=yes,width=925,height=550')" title="ayuda con los enlaces externos"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>

<iframe width="100%" height="100" frameborder="0" scrolling="auto" name="enlace" src="opciones-articulo/links.php" ></iframe>
<div id="nseparador"></div>
<div id="ntitulo3">Cargar Enlace nuevo o Remplazar Enlace Existente (Seleccione el puesto donde desea ubicar
  su Enlace)</div>
 <form action="opciones-articulo/links.php" target="enlace"  method="post" name="form4">

  <table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="8%" class="td-form-title4">URL</td>
   <td width="28%"><input name="url" type="text" class="form-box" id="url" value="http://" size="50"></td>
    <td width="5%" class="td-form-title4">T&iacute;tulo</td>
    <td width="28%"><input name="titulol" type="text" class="form-box" size="50" id="titulol">    </td>
    <td width="5%" class="td-form-title4">Lugar</td>
    <td width="15%"><select name="ordenl" class="form-box" id="ordenl">
      <?php for($i3=0;$i3<30;$i3++){ echo "<option value='$i3'>"; echo $i3+1; echo "</option>"; } ?>
    </select></td>
    <td width="11%"><input name="Submit523" type="submit" class="form-button" value="Actualizar">    </td>
   </tr>
  </table>
</form> 


<!-- cierra nbloque enlaces externos -->
</div>


<center>
<input name="Button" onClick="document.form1.submit();" type="button" class="form-button" value="OK">
  &nbsp;
  <input name="Submit4" type="button" onClick="document.form1.action='insert_articulo.php';document.form1.submit();" class="form-button" value="Guardar Duplicado">
  &nbsp;
  <input name="Submit2" type="button" onClick="document.form1.opcion.value='2';document.form1.submit();" class="form-button" value="Aplicar">
  &nbsp;
  <input name="Submit3" type="button" onClick="window.close();" class="form-button" value="Cancelar">
</center>



<!-- termina ncontenido -->
</div>


</div>
</div>




</body>
</html>
<?php

$tool->cerrar();

?>