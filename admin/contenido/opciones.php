<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();

if(isset($_POST['r-estatus_art'])){

 $tool->update_data('r','-','preferencias',$_POST,'');

}

$estado = $tool->array_query2("select estatus_art,acont_cat1,acont_cat2,acont_cat3,estatus_art_user from preferencias");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Opciones del m&oacute;dulo de contenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>



</head>

<body>
<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Opciones del m&oacute;dulo de contenidos</div>
<div id="ninstrucciones"><p>Modifique ciertos par&aacute;metros generales para los art&iacute;culos y categor&iacute;as del m&oacute;dulo de contenidos de su Sitio Web. <a href="javascript:;" onClick="MM_openBrWindow('../help/contenido-opciones.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>

</div>




<div id="ncontenido">
<form name="form1" method="post" action="">
<div id="nbloque">
<div id="ntitulo2">Estado por defecto de artículos  y categorías</div>

<div id="tituloizq" style="width:500px;" >Estado por defecto de los art&iacute;culos nuevos</div>
<div id="dataderecha"  style="width:200px;"><select name="r-estatus_art" class="form-box" id="r-estatus_art">
                    <option value="1" <?php if($estado[0]==1) echo 'selected'; ?>>Publicado</option>
                    <option value="0" <?php if($estado[0]==0) echo 'selected'; ?>>Oculto</option>
                  </select></div>


<div id="tituloizq"  style="width:500px;display:none;">Estado por defecto de las nuevas categor&iacute;as de  I nivel </div>
<div id="dataderecha" style="width:200px;display:none;"><select name="r-acont_cat1" class="form-box" id="r-acont_cat1">
                    <option value="0" <?php if($estado[1]==0) echo 'selected'; ?>>No alimentable por usuarios</option>
                    <option value="1" <?php if($estado[1]==1) echo 'selected'; ?>>Alimentable por usuarios</option>
                  </select></div>


<div id="tituloizq"  style="width:500px;display:none;">Estado por defecto de las nuevas categor&iacute;as de II nivel </div>
<div id="dataderecha" style="width:200px;display:none;"><select name="r-acont_cat2" class="form-box" id="r-acont_cat2">
                    <option value="0" <?php if($estado[2]==0) echo 'selected'; ?>>No alimentable por usuarios</option>
                    <option value="1" <?php if($estado[2]==1) echo 'selected'; ?>>Alimentable por usuarios</option>
                  </select></div>


<div id="tituloizq"  style="width:500px;display:none;">Estado&nbsp; por defecto de las categor&iacute;as de III nivel nuevas</div>
<div id="dataderecha" style="width:200px;display:none;"><select name="r-acont_cat3" class="form-box" id="r-acont_cat3">
                    <option value="0" <?php if($estado[3]==0) echo 'selected'; ?>>No alimentable por usuarios</option>
                    <option value="1" <?php if($estado[3]==1) echo 'selected'; ?>>Alimentable por usuarios</option>
                  </select></div>


<div id="tituloizq"  style="width:500px; display:none;">Estado&nbsp; por defecto los art&iacute;culos agregados por usuarios</div>
<div id="dataderecha" style="width:200px; display:none;"><select name="r-estatus_art_user" class="form-box" id="r-estatus_art_user">
                   <option value="1" <?php if($estado[4]==1) echo 'selected'; ?>>Activos 
                   <option value="0" <?php if($estado[4]==0) echo 'selected'; ?>>Inactivos 
                   </select> <a href="javascript:;" title="ayuda" onClick="MM_openBrWindow('../help/contenido-articulo-activo.php','','scrollbars=yes,resizable=yes,width=700,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></div>
















<div id="nseparador"></div>


<center><input name="Button" onClick="document.form1.submit();" type="button" class="form-button" value="Guardar Opciones">&nbsp; 
              <input name="Button" type="button" class="form-button" onClick="parent.history.back(); return false;" value="Regresar"></center>
</div>
</form>




<!-- termina ncontenido -->
</div>
<?php include ("../n-include-mensajes.php")?>

<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>
</body>
</html>
<?php $tool->cerrar();?>