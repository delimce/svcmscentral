<?php session_start();

include("../config/dbconfig.php"); ////////setup
include("../class/tools.php");
include("../class/image.php");

$form = new tools();
///////////////

//////CONTENIDO  ARTÍCULO - redimensionar imagen media
 $cont_art_imgmed_width = 5;
 $cont_art_imgmed_height = 5;
 ///////CONTENIDO ARTICULO - redimensionar turnate
 $cont_art_imgsmall_width = 186;
 $cont_art_imgsmall_height = 260;


 if(isset($_POST['Submit'])){	
	
	$prefi = @date('his_').$_FILES['archivo']['name'];
				
				if(!empty($_FILES['archivo']['name'])){
				
						$form->upload_file($_FILES['archivo'],'../../SVcontent/contenido/orig/'.$prefi,1);
			
						$ruta = '../../SVcontent/contenido/orig/'.$prefi;
						//$ruta2 = 'SVcontent/categoria/med/'.$_FILES['archivo']['name'];
						$ruta3 = '../../SVcontent/contenido/turn/'.$prefi;
						
						$imagen = new image($ruta);
						//$imagen->redimensionar($ruta2, $cont_art_imgmed_width, $cont_art_imgsmed_height, 90); ///media
						$imagen->redimensionar($ruta3, $cont_art_imgsmall_width, $cont_art_imgsmall_height, 100); ///turn
						
						$imagen->destruir();
						
						//@unlink($ruta); ///borra la imagen subida original
						
						$_SESSION['IMAGENT'] = $prefi;
				
				}
				
				$_SESSION['TITULOIT'] = $_REQUEST['titulo'];
				
				
 }else if(isset($_REQUEST['borra'])){	
 
 						$ruta = '../../SVcontent/contenido/orig/'.$_SESSION['IMAGENT'];
						$ruta3 = '../../SVcontent/contenido/turn/'.$_SESSION['IMAGENT'];
						@unlink($ruta); ///borra la imagen subida original
						@unlink($ruta3); ///borra la imagen subida original
						$_SESSION['IMAGENT'] = '';
 
 
 }
//////////////



if(!empty($_SESSION['IMAGENT'])){ 
$imagen = '../../SVcontent/contenido/turn/'.$_SESSION['IMAGENT']; 
$ima2 = '../../SVcontent/contenido/orig/'.$_SESSION['IMAGENT'];
 }else{ $imagen = 'tn-sinimagen.jpg';  $ima2 = 'tn-sinimagen.jpg'; } 
 
  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="../../admin/estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>

<title>imagen principal</title>


</head>

<body>
<form name="form1" method="post" action="" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td class="td-form-title3">Imagen Tem&aacute;tica</td>
  </tr>
  <tr>
    <td align="center" valign="top">
    
    <a href="<?php echo $ima2 ?>" target="_blank" title="<?=$_SESSION['TITULOIT'] ?>">
   
    <img src="<?php echo $imagen ?>" width="80" height="80" border="1" class="td-container-azul">
    
    </a>
    
    <br>
        <font size="1"><?php echo $_SESSION['IMAGENT'] ?><br>
      <a href="pimagen.php?borra=1" title="borrar esta imagen"><img src="../../admin/icon/icon-delete.gif" width="16" height="16" border="0"></a> </font></td>
  	
  
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
