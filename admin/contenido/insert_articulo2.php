<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");
include("../../SVsystem/class/funciones.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();


	 if(isset($_REQUEST['r-titulo'])){


						$_POST['r-cat_nivel'] = $_REQUEST['nivel'];
						$_POST['r-cat_id'] = $_REQUEST['cat'];
						$_POST['r-revisado'] = 1;
						$_POST['r-orden'] = $tool->simple_db("select max(orden)+1 as total from articulo where cat_nivel = '{$_REQUEST['nivel']}' and cat_id = '{$_REQUEST['cat']}' ");
						$_POST['r-imagen'] = $_SESSION['IMAGENT'];
						$_POST['r-imagen_titulo'] = $_SESSION['TITULOIT'];


						 $tool->query("SET AUTOCOMMIT=0"); ////iniciando la transaccion
						 $tool->query("START TRANSACTION");

						 $tool->insert_data("r","-","articulo",$_POST);
						 $NUEVO_ID = $tool->ultimoID;

						 ///////////////guardando campos adicionales
						 if(count($_POST['camposid'])>0){


								foreach($_POST['camposid'] as $i => $value){

									$vector9[0] = $NUEVO_ID;
									$vector9[1] = $_POST['camposid'][$i];
									$vector9[2] = $_POST['camposa'][$i];

									$tool->insertar2("campo_art","art_id,campo_id,valor",$vector9);

								}


						 }//////////////


						 if(count($_SESSION['IMAGENES'])>0){ ///si existen imagenes adicionales

								foreach($_SESSION['IMAGENES'] as $i => $value){

									$vector1[0] = $NUEVO_ID;
									$vector1[1] = 'imagen';
									$vector1[2] = $_SESSION['IMAGENES'][$i];
									$vector1[3] = $_SESSION['IMAGENES_T'][$i];

									$tool->insertar2("cont_adjunto","art_id,tipo,ruta,titulo",$vector1);

								}

						 }

						  if(count($_SESSION['FILES'])>0){ ///si existen archivos adicionales

								foreach($_SESSION['FILES'] as $r => $value){

									$vector2[0] = $NUEVO_ID;
									$vector2[1] = 'archivo';
									$vector2[2] = $_SESSION['FILES'][$r];
									$vector2[3] = $_SESSION['FILES_T'][$r];

									$tool->insertar2("cont_adjunto","art_id,tipo,ruta,titulo",$vector2);

								}

						 }

						  if(count($_SESSION['LINKS'])>0){ ///si existen archivos adicionales

								foreach($_SESSION['LINKS'] as $s => $value){

									$vector3[0] = $NUEVO_ID;
									$vector3[1] = 'link';
									$vector3[2] = $_SESSION['LINKS'][$s];
									$vector3[3] = $_SESSION['LINKS_T'][$s];

									$tool->insertar2("cont_adjunto","art_id,tipo,ruta,titulo",$vector3);

								}

						 }

						 $tool->query("COMMIT");


					if($_REQUEST['opcion']==1){ ///depende si es ok o aplicar

						?>
						  <script language="JavaScript" type="text/JavaScript">

						  	window.opener.abrir_cat('<?=$_REQUEST['cat'] ?>','<?=$_REQUEST['nivel'] ?>');
							window.opener.abrir_cat('<?=$_REQUEST['cat'] ?>','<?=$_REQUEST['nivel'] ?>');
						   window.close();
						   </script>
						<?

					}else{

						$tool->redirect("editar_articulo.php?id=$NUEVO_ID");

					}


	 }else{

			 $_SESSION['IMAGENT'] = ''; ///imagen tematica
			 $_SESSION['TITULOIT'] = '';

			 unset($_SESSION['IMAGENES']); // imagenes del articulo
			 unset($_SESSION['IMAGENES_T']);

			 unset($_SESSION['FILES']); // archivos del articulo
			 unset($_SESSION['FILES_T']);

			 unset($_SESSION['LINKS']); // archivos del articulo
			 unset($_SESSION['LINKS_T']);

			 $estado9 = $tool->simple_db("select estatus_art from preferencias ");

	 }


?>
<html>
<head>
<title>Agregar Art&iacute;culo</title>
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
        apply_source_formatting : "false",
        remove_script_host : "false",
        convert_urls : "false",
		plugins : "autoresize,autolink,lists,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,fullscreen,wordcount,advlist,autosave",



		// Theme options
		theme_advanced_buttons1 : "save,restoredraft,|,undo,redo,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,insertdate,inserttime,|,image,media,|,tablecontrols",
		theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,bold,italic,underline,strikethrough,sub,sup",
		theme_advanced_buttons3 : "bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,|,hr,advhr,|,charmap,attribs,|,|,|,cleanup,removeformat,preview,code,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
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

<body class="body-popup">

<table width="98%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Agregar Art&iacute;culo Nuevo</td>
 </tr>
 <tr>
 <td>


 <form action="" method="post" name="form1">

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td class="td-headertabla4">Caracter&iacute;sticas Generales</td>
   </tr>
   <tr>
     <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
         <tr>
           <td width="18%" class="td-form-title4">&iquest;Publicado (visible) <a href="javascript:;" title="¿qué rayos significa esto?" onClick="MM_openBrWindow('../help/contenido-articulo-activo.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
           <td width="16%">
            <select name="r-estatus" class="form-box" id="r-estatus">
       <option value="1" <?php if($estado9==1) echo 'selected'  ?> >Si</option>
       <option value="0" <?php if($estado9==0) echo 'selected'  ?>>No</option>
     </select>  </td>
           <td width="25%" class="td-form-title4">Autor del Art&iacute;culo</td>
           <td width="41%" class="td-content">
               <input name="r-autor" type="text" class="form-box" size="40" id="r-autor">
               <input name="opcion" type="hidden" id="opcion" value="1">
               <input name="r-fecha_mod" type="hidden" id="r-fecha_mod" value="<?=date("Y-m-d H:i") ?>"></td>
         </tr>
         <tr>
           <td class="td-form-title4">Lugar</td>
           <td><input name="r-lugar" type="text" class="form-box" size="40" id="r-lugar"></td>
          <td width="25%" class="td-form-title4">&iquest;Acepta mensajes de usuarios? <a href="javascript:;" title="¿qué rayos significa esto?" onClick="MM_openBrWindow('../help/contenido-articulo-mensajes.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
          <td class="td-content"><select name="r-user_mens" class="form-box" id="r-user_mens">
            <option value="1">Si</option>
            <option value="0" selected>No</option>
          </select></td>
         </tr>
         <tr>
           <td class="td-form-title4">&nbsp;</td>
           <td>&nbsp;</td>
           <td class="td-form-title4">Fecha (dd/mm/aaaa)</td>
           <td><input name="r-fecha" type="text" class="form-box" size="30" id="r-fecha">
             &nbsp; </td>
         </tr>
     </table></td>
   </tr>
   <tr>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td class="td-headertabla4">Contenido del Art&iacute;culo</td>
   </tr>
   <tr>
     <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
         <tr>
           <td class="td-form-title4">T&iacute;tulo del Art&iacute;culo</td>
           <td><input name="r-titulo" type="text" class="form-box" size="154" id="r-titulo"></td>
         </tr>
         <tr>
           <td width="11%" class="td-form-title4">Resumen</td>
           <td width="89%"><input name="r-resumen" type="text" class="form-box" size="154" id="r-resumen"></td>
         </tr>
     </table></td>
   </tr>
   <tr>



    <td align="center" class="td-headertabla">Texto de la P&aacute;gina  <BR>
<font color="#CC0000" size="+1">
<a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-texto-articulo.php','','scrollbars=yes,resizable=yes,width=900,height=500')" title="ayuda con el texto del artículo">
ATENCIÓN: ¡Lea instrucciones primero!. <img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a>
<br>
¡NO COPIE Y PEGUE DIRECTAMENTE DESDE OTRA PÁGINA WEB O DOCUMENTO DE OFFICE! LEA LA AYUDA</font><br/><br/>
¿Desea incluir imágenes adicionales en el cuerpo del  artículo?:

<a href="javascript:;" onClick="MM_openBrWindow('../help/imagenes-personalizadas.php','','scrollbars=yes,resizable=yes,width=900,height=500')" title="Ayuda para colocar imagenes en el texto del artículo">
 <img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a><br/>

  <a href="../help/html.php" target="_blank">Puede usar c&oacute;digo &lt;html&gt; <img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a>


</td>
   </tr>
   <tr>
     <td align="center"><table width="100%" border="0" cellspacing="3" cellpadding="0">
         <tr>
           <td width="26%" align="center" valign="top"><iframe name="ima" id="ima" height="359" width="100%" src="opciones-articulo/pimagen.php" frameborder="0" allowtransparency="yes"></iframe>              </td>
           <td width="74%" valign="top"><textarea name="r-texto" cols="85" rows="23" id="r-texto"></textarea></td>
         </tr>
     </table></td>
   </tr>
   <tr>
     <td class="td-headertabla4">Datos Adicionales</td>
   </tr>
   <tr>
     <td><?php

	 	$camposa = $tool->estructura_db("select * from campo where modulo = 'cont' order by orden ");

	 ?>

       <table width="100%" border="0" cellspacing="5" cellpadding="0">

      <?php for($ii=0;$ii<count($camposa);$ii++){

	  		switch ($camposa[$ii]['tipo']) {
				case "texto":
				   $campo1 = '<input name="camposa[]" type="text" id="camposa[]" size="'.$camposa[$ii]['longitud'].'" />';
				   break;
				case "textarea":
				  $campo1 = '<textarea name="camposa[]" cols="'.$camposa[$ii]['longitud'].'" rows="'.$camposa[$ii]['lineas'].'" id="camposa[]"></textarea>';
				   break;
				case "combo":
				   $campo1 = '<select name="camposa[]" id="camposa[]">';
				   $va = explode(',',$camposa[$ii]['valores']);
				   foreach($va as $valor) $campo1.= '<option>'.$valor.'</option>';
				   $campo1.= '</select>';
				   break;
				}

	  			$campo1.='<input name="camposid[]" type="hidden" id="camposid[]" value="'.$camposa[$ii]['id'].'" />';
	  ?>

   <tr>
         <td width="18%" class="td-form-title4"><?php echo $camposa[$ii]['nombre'] ?></td>
         <td width="82%"><?php echo $campo1; ?></td>
 </tr>
       <?php } ?>
</table>        </td>
   </tr>

<!--google **************************************************************-->
<tr>
     <td align="center" class="td-headertabla4">Datos para posicionamiento en Google</td>
   </tr>
   <tr>
     <td align="center"><table width="100%" border="0" cellspacing="5" cellpadding="0">
       <tr>
         <td width="31%" align="right" class="td-headertabla">Descripci&oacute;n Larga</td>
         <td width="69%"><textarea name="r-meta_google" cols="100" rows="5" class="form-box" id="r-meta_google"></textarea></td>
       </tr>
       <tr>
         <td align="right" class="td-headertabla"><span class="titulo-googlefield">Meta tag description (descripci&oacute;n breve)</span></td>
         <td><textarea name="r-meta_desc" cols="100" rows="5" class="form-box" id="r-meta_desc"></textarea></td>
       </tr>
       <tr>
         <td align="right" class="td-headertabla">Meta tag keywords o palabras clave (separadas por coma)</td>
         <td><textarea name="r-meta_keywords" cols="100" rows="5" class="form-box" id="r-meta_keywords"></textarea></td>
       </tr>
     </table></td>
   </tr>
   <tr><td align="center">&nbsp;</td>
   </tr>
<!--/ google ***************************************************************-->

<!--texto simple ****************************************************-->

<tr>
  <td align="right" class="td-headertabla4">Campo de C&oacute;digo Libre.<br>
      <span class="subtitulito">Inserte (Bajo su Responsabilidad) el código html de videos de Youtube u otros c&oacute;digos aquí. PROCEDA CON CAUTELA.</span></td>
</tr>
   <tr>
     <td align="center">
           <textarea name="r-textosimple" cols="110" rows="15" class="form-box" id="r-textosimple">
           </textarea>     </td>
   </tr>


<!--/ texto simple ***************************************************-->
</table>
 </form> </td>
 </tr>
 <tr>
  <td class="td-headertabla4">&nbsp; Im&aacute;genes Adicionales.<a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-imagenes-adicionales.php','','scrollbars=yes,resizable=yes,width=925,height=550')" title="ayuda con las imágenes"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a><br/>



<span class="subtitulito">
Para ver la imagen  original, haga click en la miniatura. La imagen se abrirá en una nueva ventana en la que  usted podrá también copiar la dirección o URL de la imagen.</span>

</td>
 </tr>
 <tr>
   <td><iframe name="imagenes" src="opciones-articulo/imagenes.php" frameborder="0" scrolling="auto" width="100%" height="135"></iframe> </td>
 </tr>
 <tr>
  <td class="td-form-title-izq">Cargar Imagen nueva o Remplazar Imagen Existente (Seleccione el puesto donde desea ubicar
  su imagen)</td>
 </tr>
 <tr>
  <td>


 <form action="opciones-articulo/imagenes.php" target="imagenes" enctype="multipart/form-data" method="post" name="form2">
  <table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
   <tr>
    <td width="6%" class="td-form-title4">Imagen</td>
    <td width="28%"><input name="file2" type="file" class="form-box" size="35">    </td>
    <td width="5%" class="td-form-title4">T&iacute;tulo</td>
    <td width="28%"><input name="tituloi" type="text" class="form-box" id="tituloi" size="50"></td>
    <td width="5%" class="td-form-title4">Lugar</td>
    <td width="12%"><select name="ordeni" class="form-box" id="ordeni">
      <?php for($i3=0;$i3<30;$i3++){ echo "<option value='$i3'>"; echo $i3+1; echo "</option>"; } ?>
    </select></td>
    <td width="16%"><input name="Submit5" type="submit" class="form-button" value="Subir Imagen"></td>
   </tr>
 </table>
  </form>  </td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td class="td-headertabla4">Documentos o Attachments<font size="1">&nbsp;<a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-documentos-adicionales.php','','scrollbars=yes,resizable=yes,width=925,height=550')" title="ayuda con los documentos o attachments"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></font></td>
 </tr>
 <tr>
   <td><iframe width="100%" height="100" frameborder="0" scrolling="auto" name="archivo" src="opciones-articulo/files.php" ></iframe> </td>
 </tr>
 <tr>
  <td class="td-form-title-izq">Cargar Documento Nuevo o Remplazar Documento Existente (Seleccione el puesto donde desea
  ubicar su documento)</td>
 </tr>
 <tr>
  <td>


  <form action="opciones-articulo/files.php" target="archivo" enctype="multipart/form-data" method="post" name="form3">
  <table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
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
  </form>  </td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td class="td-headertabla4">Enlaces Externos <font size="1"><a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-imagenes-adicionales.php','','scrollbars=yes,resizable=yes,width=925,height=550')" title="ayuda con los enlaces externos"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></font></td>
 </tr>
 <tr>
   <td><iframe width="100%" height="100" frameborder="0" scrolling="auto" name="enlace" src="opciones-articulo/links.php" ></iframe></td>
 </tr>
 <tr>
  <td class="td-form-title-izq">Cargar Enlace nuevo o Remplazar Enlace Existente (Seleccione el puesto donde desea ubicar
  su Enlace)</td>
 </tr>
 <tr>
  <td>


  <form action="opciones-articulo/links.php" target="enlace"  method="post" name="form4">

  <table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
   <tr>
    <td width="8%" class="td-form-title4">URL</td>
   <td width="28%"><input name="url" type="text" class="form-box" id="url" value="http://" size="50"></td>
    <td width="5%" class="td-form-title4">T&iacute;tulo</td>
    <td width="28%"><input name="titulol" type="text" class="form-box" id="titulol" size="50">    </td>
    <td width="5%" class="td-form-title4">Lugar</td>
    <td width="15%"><select name="ordenl" class="form-box" id="ordenl">
      <?php for($i3=0;$i3<30;$i3++){ echo "<option value='$i3'>"; echo $i3+1; echo "</option>"; } ?>
    </select></td>
    <td width="11%"><input name="Submit523" type="submit" class="form-button" value="Actualizar">    </td>
   </tr>
  </table>
  </form>  </td>
 </tr>


<!--GOOGLE ****************************************************************-->
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td align="center"><input name="Button" type="button" onClick="document.form1.opcion.value='1';document.form1.submit();" class="form-button" value="OK">
  &nbsp;&nbsp;
  <input name="Submit2" type="button" onClick="document.form1.opcion.value='2';document.form1.submit();" class="form-button" value="Aplicar">
  &nbsp;
  <input name="Submit3" type="button" onClick="window.close();" class="form-button" value="Cancelar"></td>
 </tr>
</table>
</body>
</html>
<?php

$tool->cerrar();

?>