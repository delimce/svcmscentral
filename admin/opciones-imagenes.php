<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/formulario.php");

$tool = new formulario();
$tool->autoconexion();

	if(isset($_REQUEST['Submit'])){
	
		$tool->update_data("r","-","preferencias",$_POST,"");
		$tool->javaviso("opciones de imagen guardadas");
	
	}

$data = $tool->simple_db("select `image_index_h`,
`image_index_w`,
`image_cont_cat_h`,
`image_cont_cat_ht`,
`image_cont_cat_w`,
`image_cont_cat_wt`,
`image_cont_h`,
`image_cont_ht`,
`image_cont_w`,
`image_cont_wt`,
`image_prod_cat_h`,
`image_prod_cat_ht`,
`image_prod_cat_w`,
`image_prod_cat_wt`,
`image_prod_h`,
`image_prod_ht`,
`image_prod_w`,
`image_prod_wt`,
 image_pcont_h,
 image_pcont_w
from preferencias");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Tama&ntilde;o de las im&aacute;genes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">



<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>


</head>

<body>


<?php include ("n-encabezado.php")?>
<div id="ncuerpo">
<?php include ("n-include-mensajes.php")?>
<div id="ncontenedor">
<div id="nnavbar"><?php include "n-include-menu2.php"?></div>




<div id="ntitulo">Tamaño de las Imágenes </div>
<div id="ninstrucciones">Esta es una opción avanzada. NO cambie estos parámetros sin consultar antes con nosotros.</div>


<div id="ncontenido">

<form name="form" method="post" action="" id="form1">



<div id="nbloque">
<h1>P&aacute;gina Principal</h1>
<div id="tituloizq">Tamaño de la imagen del home page (TURN)</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_index_w" type="text" class="n-form-box" id="r-image_index_w" value="<?=$data['image_index_w'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_index_h" type="text" class="n-form-box" id="r-image_index_h" value="<?=$data['image_index_h'] ?>" size="10">    
</label>
</div>

<div id="nseparador"></div>
</div>


<div id="nbloque">
<h1>Sistema de contenidos</h1>


<div id="tituloizq">Thumbnails en Listado de Categorias (TURN)</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_cont_cat_wt" type="text" class="n-form-box" id="r-image_cont_cat_wt" value="<?=$data['image_cont_cat_wt'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_cont_cat_ht" type="text" class="n-form-box" id="r-image_cont_cat_ht" value="<?=$data['image_cont_cat_ht'] ?>" size="10">    
</label>
</div>


<div id="tituloizq">Imagen Mediana de Categoría</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_cont_cat_w" type="text" class="n-form-box" id="r-image_cont_cat_w" value="<?=$data['image_cont_cat_w'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_cont_cat_h" type="text" class="n-form-box" id="r-image_cont_cat_h" value="<?=$data['image_cont_cat_h'] ?>" size="10">    
</label>
</div>






<div id="tituloizq">Listado de  Artículos</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_pcont_w" type="text" class="n-form-box" id="r-image_pcont_w" value="<?=$data['image_pcont_w'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_pcont_h" type="text" class="n-form-box" id="r-image_pcont_h" value="<?=$data['image_pcont_h'] ?>" size="10">   
</label>
</div>



<div id="tituloizq">Imagen Principal del Artículo</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_cont_w" type="text" class="n-form-box" id="r-image_cont_w" value="<?=$data['image_cont_w'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_cont_h" type="text" class="n-form-box" id="r-image_cont_h" value="<?=$data['image_cont_h'] ?>" size="10">  
</label>
</div>



<div id="tituloizq">Thumbnails de Galería de fotos en Artículo</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_cont_wt" type="text" class="n-form-box" id="r-image_cont_wt" value="<?=$data['image_cont_wt'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_cont_ht" type="text" class="n-form-box" id="r-image_cont_ht" value="<?=$data['image_cont_ht'] ?>" size="10">
</label>
</div>







<div id="nseparador"></div>
</div>


<div id="nbloque">
<h1>Catálogo de Productos</h1>


<div id="tituloizq">Thumbnails en Listado de Categorias (TURN)</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_prod_cat_wt" type="text" class="n-form-box" id="r-image_prod_cat_wt" value="<?=$data['image_prod_cat_wt'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_prod_cat_ht" type="text" class="n-form-box" id="r-image_prod_cat_ht" value="<?=$data['image_prod_cat_ht'] ?>" size="10">
</label>
</div>


<div id="tituloizq">Imagen Mediana de Categoría</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_prod_cat_w" type="text" class="n-form-box" id="r-image_prod_cat_w" value="<?=$data['image_prod_cat_w'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_prod_cat_h" type="text" class="n-form-box" id="r-image_prod_cat_h" value="<?=$data['image_prod_cat_h'] ?>" size="10">    
</label>
</div>






<div id="tituloizq">Listado de Productos y Thumbnails</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_prod_wt" type="text" class="n-form-box" id="r-image_prod_wt" value="<?=$data['image_prod_wt'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_prod_ht" type="text" class="n-form-box" id="r-image_prod_ht" value="<?=$data['image_prod_ht'] ?>" size="10">
</label>
</div>



<div id="tituloizq">Imagen Principal del Producto</div>
<div id="dataderecha">
<label><span>Ancho</span>
<input name="r-image_prod_w" type="text" class="n-form-box" id="r-image_prod_w" value="<?=$data['image_prod_w'] ?>" size="10">
</label>
 
<label><span>Alto</span>         
<input name="r-image_prod_h" type="text" class="n-form-box" id="r-image_prod_h" value="<?=$data['image_prod_h'] ?>" size="10">  
</label>
</div>











<div id="nseparador"></div>
</div>



<div id="botonsotes">
<center>
<input name="Submit" type="submit" class="form-button" value="Guardar">&nbsp; 
<input name="Submit2" type="reset" class="form-button" onClick="MM_goToURL('parent','opciones.php');return document.MM_returnValue" value="Cancelar">
</center>
</div>










</form>

<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?>

</body>
</html>
