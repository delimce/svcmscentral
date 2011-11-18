<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/image.php");
include("../../SVsystem/class/funciones.php");



$form = new tools();
$form->autoconexion();
///////////////





 if(isset($_POST['Submit'])){

	$prefi = @date('his_').$_FILES['archivo']['name'];

				if(!empty($_FILES['archivo']['name'])){

						$sesubio = $form->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$prefi,1,'image/gif,image/jpeg,image/png,image/pjpeg');
						if($sesubio == false)$form->redirect("pimagen.php");

						
				//		$imagen = new image($ruta);

						$iima = $form->simple_db("select image_index_h, image_index_w from preferencias");
						
						
						$ruta1 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$prefi;

                                $height = $iima['image_index_w'];
                                $width = $iima['image_index_h'];

                                smart_resize_image( $ruta1 , $height, $width, false, $ruta1, false, false );
                                @unlink($ruta); ///borra la imagen subida original

//						$imagen->redimensionar($ruta, $dim1['image_index_w'], $dim1['image_index_h'], 90); ///turn
//						$imagen->destruir();

						$_SESSION['IMAGENT'] = $prefi;

				}

				$_SESSION['TITULOIT'] = $_REQUEST['titulo'];


 }else if(isset($_REQUEST['borra'])){

 						$ruta = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$_SESSION['IMAGENT'];
						@unlink($ruta); ///borra la imagen subida original
						$_SESSION['IMAGENT'] = '';


 }
//////////////



if(!empty($_SESSION['IMAGENT'])){
$ima2 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$_SESSION['IMAGENT'];
 }else{ $imagen = '../contenido/tn-sinimagen.jpg';  $ima2 = '../contenido/tn-sinimagen.jpg'; }  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>

<title>imagen principal</title>


</head>

<body style="background-image:none;">
<form name="form1" method="post" action="" enctype="multipart/form-data">

<center>
    <a href="<?php echo $ima2 ?>" target="_blank">

    <img src="<?php echo $ima2 ?>"  border="0">    </a>

    <br>
      <a href="pimagen.php?borra=1" title="borrar esta imagen"><img src="../icon/icon-delete.gif" width="16" height="16" border="0"></a> <br>
  <input name="archivo" type="file" class="form-box" size="30" id="archivo" style="font-size:30px;"><br>
 <input name="Submit" type="submit" class="form-button" value="Subir Imagen" id="Submit">
 </center>

</form>
</body>
</html>
<?php
    $form->cerrar();
?>