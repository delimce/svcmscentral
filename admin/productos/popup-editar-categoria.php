<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/image.php");
include("../../SVsystem/class/funciones.php");

$tool = new tools();
$tool->autoconexion();


	  if(isset($_POST['Submit'])){

		/////////////////////
		if($_POST['imagen2'] != $_FILES['imagen']['name'] && $_FILES['imagen']['name']!=''){


			$sesubio = $tool->upload_file($_FILES['imagen'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['imagen']['name'],1,'image/gif,image/jpeg,image/png,image/pjpeg');
			if($sesubio == false)$tool->redirect("cerrar");


			@unlink('../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_POST['imagen2']);
			$image1 = $_FILES['imagen']['name'];

			    /////tamaño imagenes
			    $iima = $tool->simple_db("select image_prod_cat_h,image_prod_cat_ht,image_prod_cat_w,image_prod_cat_wt from preferencias");


			    $ruta = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['imagen']['name'];
				//$ruta2 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/med/'.$_FILES['imagen']['name'];
				$ruta3 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/turn/'.$_FILES['imagen']['name'];

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


		}else{

			$image1 = $_POST['imagen2'];

		}

		////////////////////

		$datos[0] = 'nombre';  $valores[0] = $_POST['nombre'];
		$datos[1] = 'descrip';  $valores[1] = $_POST['desc'];
		$datos[2] = 'imagen';   $valores[2] = $image1;

		$tool->update("prod_categoria",$datos,$valores,"id = {$_POST['id']}");
		$tool->cerrar();


		?>
		 <script language="JavaScript" type="text/JavaScript">
	   window.opener.location.reload(); window.close();
	   </script>

		<?


	}else{

	 $datos = $tool->simple_db("select id,nombre,imagen,descrip from prod_categoria where id = {$_REQUEST['id']}");


	}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Categor&iacute;a</title>
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
  <td class="td-titulo-popup">Editar Categor&iacute;a</td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="250" class="td-form-title">Nombre de la categor&iacute;a</td>
   <td width="0"><input name="nombre" type="text" class="form-box" id="nombre" value="<?=$datos['nombre'] ?>" size="50"></td>
   </tr>
   <tr>
    <td class="td-form-title">Imagen</td>
    <td><input name="imagen" type="file" class="form-box" id="imagen">
      <input name="imagen2" type="hidden" id="imagen2" value="<?=$datos['imagen'] ?>"><?php echo '<span class="span-agregar">'.$datos['imagen'].'</span>'; ?></td>
   </tr>
   <tr>
    <td class="td-form-title">Descripci&oacute;n breve de la categor&iacute;a</td>
    <td><textarea name="desc" cols="80" rows="5" class="form-box" id="desc"><?=$datos['descrip'] ?>
    </textarea></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" class="form-button" value="OK">&nbsp;
     <input name="Submit2" type="button" class="form-button" onClick="window.close();" value="Cancelar">
     <input name="id" type="hidden" id="id" value="<?=$datos['id'] ?>"></td>
   </tr>
  </table></td>
 </tr>
</table>
</form>
<span id="ccSpan" style="display:none"><a href="#"></a></span>
</body>
</html>
<?php

$tool->cerrar();

?>