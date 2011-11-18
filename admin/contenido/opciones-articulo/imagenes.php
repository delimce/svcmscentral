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


  if(isset($_REQUEST['Submit5'])){


  				$prefi = @date('his_').$_FILES['file2']['name'];

			///////////////

			$tool = new tools();
			$subido = $tool->upload_file($_FILES['file2'],'../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$prefi,3,'image/gif,image/jpeg,image/png,image/pjpeg');
			if($subido == false)$tool->redirect("imagenes.php");

			if($subido){ ///se subio la imagen con exito

					/////tamaño imagenes
			 		  $iima = $form->simple_db("select image_cont_h,image_cont_ht,image_cont_w,image_cont_wt from preferencias");


				$ruta  = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$prefi;
				//$ruta2 = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/med/'.$prefi;
				$ruta3 = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/turn/'.$prefi;

                                $height = $iima['image_cont_wt'];
                                $width = $iima['image_cont_ht'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta3, false, false );

/*
				$imagen = new image($ruta);
				//$imagen->redimensionar($ruta2, $iima['image_cont_w'], $iima['image_cont_h'], 90); ///redimen orig
				$imagen->redimensionar($ruta3, $iima['image_cont_wt'], $iima['image_cont_ht'], 100); ///turn
				$imagen->destruir();
*/

			}

			if(!empty($_SESSION['IMAGENES'][$_POST['ordeni']])){


			/*	for($j=count($_SESSION['IMAGENES']);$j>$_POST['ordeni'];$j--){

					$_SESSION['IMAGENES'][$j] = $_SESSION['IMAGENES'][$j-1];
					$_SESSION['IMAGENES_T'][$j] = $_SESSION['IMAGENES_T'][$j-1];



				}*/

				borrar_imagenes2($_SESSION['IMAGENES'][$_POST['ordeni']]);

				$_SESSION['IMAGENES'][$_POST['ordeni']]   = $prefi;
				$_SESSION['IMAGENES_T'][$_POST['ordeni']] = $_POST['tituloi'];

			}else{

				$I = count($_SESSION['IMAGENES']);
				$_SESSION['IMAGENES'][$I] = $prefi;
				$_SESSION['IMAGENES_T'][$I] = $_POST['tituloi'];

			}
			/////////////////


	}else if(isset($_REQUEST['borrar'])){

				$imag = $_SESSION['IMAGENES'][$_REQUEST['borrar']];
				$titu = $_SESSION['IMAGENES_T'][$_REQUEST['borrar']];

				for($i=$_REQUEST['borrar'];$i<count($_SESSION['IMAGENES']);$i++){


					$_SESSION['IMAGENES'][$i]   = $_SESSION['IMAGENES'][$i+1];
					$_SESSION['IMAGENES_T'][$i] = $_SESSION['IMAGENES_T'][$i+1];


				}

				array_pop ($_SESSION['IMAGENES']);
				array_pop ($_SESSION['IMAGENES_T']);
				$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL
				borrar_imagenes3($imag);


	}else if (isset($_REQUEST['orden'])){

				if($_REQUEST['sent']=="u" && $_SESSION['IMAGENES'][$_REQUEST['orden']-1]!=''){

						$temp = $_SESSION['IMAGENES'][$_REQUEST['orden']-1];
						$_SESSION['IMAGENES'][$_REQUEST['orden']-1] = $_SESSION['IMAGENES'][$_REQUEST['orden']];
						$_SESSION['IMAGENES'][$_REQUEST['orden']] = $temp;

						$temp2 = $_SESSION['IMAGENES_T'][$_REQUEST['orden']-1];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']-1] = $_SESSION['IMAGENES_T'][$_REQUEST['orden']];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']] = $temp2;

				}else if($_REQUEST['sent']=="d" && $_SESSION['IMAGENES'][$_REQUEST['orden']+1]!=''){

						$temp = $_SESSION['IMAGENES'][$_REQUEST['orden']+1];
						$_SESSION['IMAGENES'][$_REQUEST['orden']+1] = $_SESSION['IMAGENES'][$_REQUEST['orden']];
						$_SESSION['IMAGENES'][$_REQUEST['orden']] = $temp;

						$temp2 = $_SESSION['IMAGENES_T'][$_REQUEST['orden']+1];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']+1] = $_SESSION['IMAGENES_T'][$_REQUEST['orden']];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']] = $temp2;


				}

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="../../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../../SVsystem/js/ajax.js"></script>


<title>Untitled Document</title>


</head>

<body class="body-popup">

<table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
   <?php for($i=0;$i<count($_SESSION['IMAGENES']);$i++){

   		  if($_SESSION['IMAGENES'][$i]==""){

		   $imagen = '../tn-sinimagen.jpg';

		  }else{
		  $imagen = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/turn/'.$_SESSION['IMAGENES'][$i];
		  $imagen3 = '../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$_SESSION['IMAGENES'][$i];

		  }
    ?>
   	  <td align="center" valign="top">
   		 <a href="<?php echo $imagen3 ?>" target="_blank" title="<?php echo $_SESSION['IMAGENES_T'][$i] ?>"><img src="<?php echo $imagen ?>" width="80" height="80" border="1" class="td-container-azul"></a><br>
     	 <font size="1"><?php echo $_SESSION['IMAGENES_T'][$i] ?><br>
      	<img title="subir de orden" style="cursor:pointer" onClick="location.replace('imagenes.php?orden=<?=$i?>&sent=u');" src="../../icon/icon-left.gif" width="16" height="16" border="0"><img style="cursor:pointer" title="borrar esta imagen" onClick="location.replace('imagenes.php?borrar=<?=$i?>');" src="../../icon/icon-delete.gif" width="16" height="16" border="0"><img title="bajar de orden" style="cursor:pointer" onClick="location.replace('imagenes.php?orden=<?=$i?>&sent=d');" src="../../icon/icon-right.gif" width="16" height="16" border="0"> </font>
      </td>
    <?php } ?>
  </tr>
</table>
</body>
</html>