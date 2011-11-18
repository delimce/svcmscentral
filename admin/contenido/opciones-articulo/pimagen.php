<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../../SVsystem/config/setup.php"); ////////setup
include("../../../SVsystem/class/tools.php");
include("../../../SVsystem/class/image.php");
include("../../../SVsystem/class/funciones.php");

include("../security.php");

$form = new tools();
$form->autoconexion();
///////////////





 if(isset($_POST['Submit'])){

	$prefi = @date('his_').$_FILES['archivo']['name'];

				if(!empty($_FILES['archivo']['name'])){

						$sesubio = $form->upload_file($_FILES['archivo'],'../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$prefi,3,'image/gif,image/jpeg,image/png,image/pjpeg');
						if($sesubio == false)$form->redirect("pimagen.php");

										/////tamaño imagenes
			 		  $iima = $form->simple_db("select image_cont_h,image_pcont_h,image_cont_w,image_pcont_w from preferencias");


						$ruta = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$prefi;
						$ruta2 = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/med/'.$prefi;
						$ruta3 = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/turn/'.$prefi;

                                $height = $iima['image_pcont_w'];
                                $width = $iima['image_pcont_h'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta3, false, false );

                                $height = $iima['image_cont_w'];
                                $width = $iima['image_cont_h'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta2, false, false );

/*
						$imagen = new image($ruta);
						$imagen->redimensionar($ruta2, $iima['image_cont_w'], $iima['image_cont_h'], 100); ///med
						$imagen->redimensionar($ruta3, $iima['image_pcont_w'], $iima['image_pcont_h'], 100); ///turn
						$imagen->destruir();
*/
					//	@unlink($ruta); ///borra la imagen subida original

						$_SESSION['IMAGENT'] = $prefi;

				}

				$_SESSION['TITULOIT'] = $_REQUEST['titulo'];


 }else if(isset($_REQUEST['borra'])){

 						$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL
            borrar_imagenes3($_SESSION['IMAGENT']);
						unset($_SESSION['IMAGENT']);


 }
//////////////



if(!empty($_SESSION['IMAGENT'])){
$imagen = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/med/'.$_SESSION['IMAGENT'];
$ima2 = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$_SESSION['IMAGENT'];
 }else{ $imagen = '../tn-sinimagen.jpg';  $ima2 = '../tn-sinimagen.jpg'; }  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="../../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../../SVsystem/js/ajax.js"></script>

<title>imagen principal</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>


</head>

<body style="background-image:none;">
<form name="form1" method="post" action="" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
    <tr>
    <td align="center" valign="top">

    <a href="<?php echo $ima2 ?>" target="_blank" title="<?=$_SESSION['TITULOIT'] ?>">

    <img src="<?php echo $imagen ?>" width="160" height="160" border="1" class="td-container-azul">

    </a>

    <br>
        <font size="1"><?php echo $_SESSION['IMAGENT'] ?><br>
      <a href="pimagen.php?borra=1" title="borrar esta imagen"><img src="../../icon/icon-delete.gif" width="16" height="16" border="0"></a> </font></td>


  </tr>
  <tr>
    <td align="center" class="td-form-title4-centrada">Cargar Imagen</td>
  </tr>
  <tr>
    <td align="center"><input name="archivo" type="file" class="form-box" size="18" id="archivo"></td>
  </tr>
  <tr>
    <td align="center" class="td-form-title4-centrada">T&iacute;tulo</td>
  </tr>
  <tr>
    <td align="center"><input name="titulo" onKeyUp="ajaxsend('post','workflow.php','valor='+this.value+'&tipo=1');" type="text" class="form-box" id="titulo" value="<?=$_SESSION['TITULOIT'] ?>" size="27"></td>
  </tr>
  <tr>
    <td align="center"><input name="Submit" type="submit" class="form-button" value="Subir Imagen" id="Submit"></td>
  </tr>
</table>

</form>
</body>
</html>