<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");
include("../../SVsystem/class/image.php");
include("../../SVsystem/class/funciones.php");

include("security.php");


$form = new formulario();
$form->autoconexion();

/////para las categorias de clientes
$catis =  $form->estructura_db("select nombre,id from cliente_categoria");

	 if(isset($_POST['Submit'])){



	/////////////////////
		if($_POST['imagen2'] != $_FILES['imagen']['name'] && $_FILES['imagen']['name']!=''){


			$sesubio = $form->upload_file($_FILES['imagen'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['imagen']['name'],1,'image/gif,image/jpeg,image/png,image/pjpeg');
			if($sesubio == false)$form->redirect("cerrar");


			@unlink('../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_POST['imagen2']);

			 /////tamaño imagenes
			 $iima = $form->simple_db("select image_cont_cat_h,image_cont_cat_ht,image_cont_cat_w,image_cont_cat_wt from preferencias");


				$image1 = $_FILES['imagen']['name'];
			    $ruta = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/orig/'.$_FILES['imagen']['name'];
				//$ruta2 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/med/'.$_FILES['imagen']['name'];
				$ruta3 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/categoria/turn/'.$_FILES['imagen']['name'];

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


		}else{

			$image1 = $_POST['imagen2'];

		}

		////////////////////


					$_POST['r-imagen'] = $image1;
					$form->update_data("r","-","cont_categoria",$_POST,"id = '{$_REQUEST['id']}'");


					?>
                      <script language="JavaScript" type="text/JavaScript">
					   window.opener.location.reload(); window.close();
					   </script>
                    <?

		}else{

			 $datos = $form->simple_db("select id,nombre,imagen,descrip,users,only_for from cont_categoria where id = {$_REQUEST['id']}");


		}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Categoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/SVsystem/editor2/tiny_mce.js"></script>
<script type="text/javascript" src="/SVsystem/editor2/editor-categorias.js"></script>

<script type="text/javascript">
	

<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->



//-->
</script>


</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup"> Editar Categor&iacute;a </td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>
   <table width="100%" border="0" cellspacing="4" cellpadding="0">
    <tr>
     <td width="250" class="td-form-title">Nombre de Categor&iacute;a</td>
     <td><input name="r-nombre" type="text" class="form-box" id="r-nombre" value="<?=$datos['nombre'] ?>" size="40">
     </td>
    </tr>
    <tr>
     <td class="td-form-title">Descripci&oacute;n de Categor&iacute;a</td>
     <td><textarea name="r-descrip" cols="80" rows="5" class="form-box" id="r-descrip"><?=$datos['descrip'] ?>
     </textarea></td>
    </tr>
    <tr>
     <td class="td-form-title">Imagen de Categor&iacute;a</td>
     <td><input name="imagen" type="file" class="form-box" id="imagen">
      <input name="imagen2" type="hidden" id="imagen2" value="<?=$datos['imagen'] ?>"><?php echo '<span class="span-agregar">'.$datos['imagen'].'</span>'; ?>
      <input name="id" type="hidden" id="id" value="<?=$datos['id'] ?>"></td>
    </tr>
    <tr style="display:none;">
     <td class="td-form-title">&iquest;Alimentable por Usuarios? <a href="#" title="Permitir que a esta categoría, los usuarios de su web site puedan agregarle artículos"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
     <td><select name="r-users" class="form-box" id="r-users">
       <option>Seleccione</option>
       <option value="1" <?php if($datos['users']==1) echo 'selected'  ?> >Si</option>
       <option value="0" <?php if($datos['users']==0) echo 'selected'  ?>>No</option>
     </select></td>
    </tr>
    <tr>


<!--delimce. nuevo!!-->
     <td class="td-form-title">Visible Para:</td>
     <td>
<select name="r-only_for" class="form-box" id="r-only_for">
<option value="0" <?php if($datos['only_for']==0) echo 'selected'  ?>>Todos (Pública)</option>
<option value="1" <?php if($datos['only_for']==1) echo 'selected'  ?>>Sólo usuarios registrados y logueados</option>


 <?php for ($i1=0;$i1<count($catis);$i1++){ ?>
     <option value="<?php echo $catis[$i1]['id'] ?>" <?php if($datos['only_for']==$catis[$i1]['id']) echo 'selected'  ?>><?php echo $catis[$i1]['nombre'] ?></option>
  <?php } ?>

</select>
</td>
<!--/ delimce. nuevo!!-->


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