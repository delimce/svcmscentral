<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");
include("../../SVsystem/class/image.php");
include("../../SVsystem/class/funciones.php");

include("security.php");


$form = new formulario();
$form->autoconexion();

	 if(isset($_POST['Submit'])){



	///////////////

			if(!empty($_FILES['archivo']['name'])){ ////si se sube una imagen
				$sesubio = $form->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['archivo']['name'],1,'image/gif,image/jpeg,image/png,image/pjpeg,image/jpg,image/pjpg');
				if($sesubio == false)$form->redirect("cerrar");

									 /////tamaño imagenes
			   $iima = $form->simple_db("select image_cont_cat_h,image_cont_cat_ht,image_cont_cat_w,image_cont_cat_wt from preferencias");



				$ruta = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['archivo']['name'];
				//$ruta2 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/med/'.$_FILES['archivo']['name'];
				$ruta3 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/turn/'.$_FILES['archivo']['name'];

                                $height = $iima['image_cont_cat_wt'];
                                $width = $iima['image_cont_cat_ht'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta3, false, false );

                                $height = $iima['image_cont_cat_w'];
                                $width = $iima['image_cont_cat_h'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta, false, false );

/*
				$imagen = new image($ruta);
				$imagen->redimensionar($ruta, $iima['image_cont_cat_w'], $iima['image_cont_cat_h'], 90); ///redimen orig
				$imagen->redimensionar($ruta3, $iima['image_cont_cat_wt'], $iima['image_cont_cat_ht'], 90); ///turn
				$imagen->destruir();
*/
				@unlink($ruta); ///borra la imagen subida original
		    }

	//////////////


					$_POST['r-imagen'] = $_FILES['archivo']['name'];
					$_POST['r-orden'] = $form->simple_db("select max(orden)+1 as total from cont_subcategoria");
					$form->insert_data("r","-","cont_subcategoria",$_POST);


					?>
                      <script language="JavaScript" type="text/JavaScript">
					  		window.opener.abrir_cat('<?=$_REQUEST['r-cat_id'] ?>','1');
							window.opener.abrir_cat('<?=$_REQUEST['r-cat_id'] ?>','1');
						   window.close();
					   </script>
                    <?

		}else{

			$estado = $form->simple_db("select acont_cat2 from preferencias ");

		}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Agregar sub categoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/SVsystem/editor2/tiny_mce.js"></script>
<script type="text/javascript" src="/SVsystem/editor2/editor-categorias.js"></script>


</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Agregar  Sub Categor&iacute;a </td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>
   <table width="100%" border="0" cellspacing="4" cellpadding="0">
    <tr>
     <td width="250" class="td-form-title">Nombre de Categor&iacute;a</td>
     <td><input name="r-nombre" type="text" class="form-box" size="60" id="r-nombre">
     </td>
    </tr>
    <tr>
     <td class="td-form-title">Descripci&oacute;n de Categor&iacute;a</td>
     <td><textarea name="r-descrip" cols="80" rows="5" class="form-box" id="r-descrip"></textarea></td>
    </tr>
    <tr>
     <td class="td-form-title">Imagen de Categor&iacute;a</td>
     <td><input name="archivo" type="file" class="form-box" size="50" id="archivo"></td>
    </tr>
    <tr style="display:none;">
     <td class="td-form-title">&iquest;Alimentable por Usuarios? <a href="#" title="Permitir que a esta categoría, los usuarios de su web site puedan agregarle artículos"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
     <td>

     <select name="r_users" class="form-box" id="r_users">
       <option value="1" <?php if($estado==1) echo 'selected'  ?> >Si</option>
       <option value="0" <?php if($estado==0) echo 'selected'  ?>>No</option>
     </select>

       <input name="r-cat_id" type="hidden" id="r-cat_id" value="<?=$_REQUEST['id']?>"></td>
    </tr>
    <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td>&nbsp;</td>
     <td><input name="Submit" type="submit" class="form-button" value="Guardar">
       &nbsp;
       <input name="Button" type="button" class="form-button" onClick="window.close();" value="Cancelar" /></td>
    </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
</table></form>
</body>
</html>
<?php $form->cerrar(); ?>