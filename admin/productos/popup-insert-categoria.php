<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/funciones.php");
include("../../SVsystem/class/image.php");

$tool = new tools();


if(isset($_POST['Submit'])){

	$tool->autoconexion();


		if(!empty($_FILES['archivo']['name'])){ ////si se sube una imagen
	///////////////


	$sesubio = $tool->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['archivo']['name'],1,'image/gif,image/jpeg,image/png,image/pjpeg,image/jpg,image/pjpg');
	if($sesubio == false)$tool->redirect('cerrar');


	             /////tamaño imagenes
			    $iima = $tool->simple_db("select image_prod_cat_h,image_prod_cat_ht,image_prod_cat_w,image_prod_cat_wt from preferencias");


				$ruta = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['archivo']['name'];
				//$ruta2 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/med/'.$_FILES['archivo']['name'];
				$ruta3 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/turn/'.$_FILES['archivo']['name'];
/*
				$imagen = new image($ruta);
				$imagen->redimensionar($ruta, $iima['image_prod_cat_w'], $iima['image_prod_cat_h'], 90); ///redimen orig
				$imagen->redimensionar($ruta3, $iima['image_prod_cat_wt'], $iima['image_prod_cat_ht'], 90); ///turn

				$imagen->destruir();
  */

                                $height = $iima['image_prod_cat_wt'];
                                $width = $iima['image_prod_cat_ht'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta3, false, false );

                                $height = $iima['image_prod_cat_w'];
                                $width = $iima['image_prod_cat_h'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta, false, false );
				@unlink($ruta); ///borra la imagen subida original


	//////////////

	}

	$valores[0] = '';
	$valores[1] = $_POST['nombre'];
	$valores[2] = $_FILES['archivo']['name'];
	$valores[3] = $_POST['desc'];
	$valores[4] = $tool->simple_db("select max(orden)+1 as total from prod_categoria");


	$tool->insertar2("prod_categoria","id,nombre,imagen,descrip,orden",$valores);
	$tool->cerrar();

	?>
     <script language="JavaScript" type="text/JavaScript">
   window.opener.location.reload(); window.close();
   </script>

    <?


}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Agregar Categor&iacute;a</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/SVsystem/editor2/tiny_mce.js"></script>
<script type="text/javascript" src="/SVsystem/editor2/editor-categorias.js"></script>
<script language="JavaScript" type="text/JavaScript">


function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>



</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Agregar Categor&iacute;a</td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="250" class="td-form-title">Nombre de la categor&iacute;a</td>
   <td><input name="nombre" type="text" class="form-box" size="50" id="nombre"></td>
   </tr>
   <tr>
    <td class="td-form-title">Imagen</td>
    <td><input name="archivo" type="file" class="form-box" id="archivo"></td>
   </tr>
   <tr>
    <td class="td-form-title">Descripci&oacute;n breve de la categor&iacute;a</td>
    <td><textarea name="desc" cols="80" rows="5" class="form-box" id="desc"></textarea></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" class="form-button" value="OK">&nbsp;
     <input name="Submit2" type="button" class="form-button" onClick="window.close();" value="Cancelar"></td>
   </tr>
  </table></td>
 </tr>
</table>
</form>
<span id="ccSpan" style="display:none"></span>
</body>
</html>