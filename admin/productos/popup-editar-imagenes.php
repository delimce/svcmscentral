<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/image.php");
include("../../SVsystem/class/funciones.php");


if(isset($_REQUEST['Submit'])){

			///////////////

			$tool = new tools();
			$tool->autoconexion();


			$subido = $tool->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/orig/'.$_FILES['archivo']['name'],2,'image/gif,image/jpeg,image/png,image/pjpeg');
			if($subido == false)$tool->redirect("cerrar");

			if($subido){ ///se subio la imagen con exito


				 /////tamaño imagenes
			 $iima = $tool->simple_db("select image_prod_h,image_prod_ht,image_prod_w,image_prod_wt from preferencias");


				$ruta = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/orig/'.$_FILES['archivo']['name'];
				$ruta2 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/med/'.$_FILES['archivo']['name'];
				$ruta3 = '../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/turn/'.$_FILES['archivo']['name'];

                                $height = $iima['image_prod_wt'];
                                $width = $iima['image_prod_ht'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta3, false, false );

                                $height = $iima['image_prod_w'];
                                $width = $iima['image_prod_h'];
                                smart_resize_image( $ruta , $height, $width, false, $ruta2, false, false );

			//	@unlink($ruta); ///borra la imagen subida original

                                /*
				$imagen = new image($ruta);
			        $imagen->redimensionar($ruta2, $iima['image_prod_w'], $iima['image_prod_h'], 100); ///redimen med
				$imagen->redimensionar($ruta3, $iima['image_prod_wt'], $iima['image_prod_ht'], 100); ///turn
				$imagen->destruir();
                                 */


			}


			$I = count($_SESSION['IMAGENES']);

			if(!in_array($_FILES['archivo']['name'],$_SESSION['IMAGENES']))
				$_SESSION['IMAGENES'][$I] = $_FILES['archivo']['name'];

			/////////////////
			?>

            <script type="text/javascript">
			window.opener.imagen.location.replace('imagenes.php');
			window.close();
			</script>

            <?


	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Imagen</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script language="JavaScript" type="text/JavaScript">

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>


<script type="text/javascript">
function validar(){


	if(document.form1.archivo.value==""){

		alert("Seleccione una imagen para subir");
		return false;
	}


	oXML = AJAXCrearObjeto();
	oXML.open('post', 'buscarimagen.php');
	oXML.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	oXML.onreadystatechange = function(){
		if (oXML.readyState == 4 && oXML.status == 200) {

				if(oXML.responseText==1){

					if(confirm("La imagen ya existe desea sobre escribirla?")) {

						document.form1.submit();

					}else{ return false; }

				}else{

				document.form1.submit();

				}

				vaciar(oXML);

		}
	 }

	oXML.send('file='+document.form1.archivo.value);




}
</script>





</head>

<body class="body-popup">
<form id="form" action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Editar  Imagen </td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="24%" class="td-form-title">Ubicaci&oacute;n de la Imagen     </td>
    <td width="76%"><input id="archivo" name="archivo" type="file" class="form-box" size="25" >
      <input name="Submit" type="hidden" id="Submit" value="1"></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
   <td><input name="Button" type="button" class="form-button" onClick="validar();" value="OK">&nbsp;
    <input name="Submit2" type="button" onClick="window.close();" class="form-button" value="Cancelar"></td>
   </tr>
  </table></td>
 </tr>
</table>
</form>
<span id="ccSpan" style="display:none"><a href="#"></a></span>
</body>
</html>