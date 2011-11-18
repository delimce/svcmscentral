<?php session_start();
$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

$datos = new tools('db');

require("security.php"); //////// solo accesible para administradores



 $servicios = $datos->estructura_db("select id,nombre from servicio");
 $ms = $datos->simple_db("select activo,servicios from preferencias");

 $miservicios = explode(",",$ms['servicios']);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Backdoor - Modulos Activos</title>
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
//-->
</script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>


</head>

<body>

<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Modulos Activos</div>
<div id="ninstrucciones" style="display:none;">
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">
<a href="opciones.php" title="volver a opciones de super administrador" class="boton"><img src="/admin/icon/icon-back.png" align="absmiddle" /> volver a opciones del super administrador</a>

</div>
<form name="form1" method="post" action="">
<div id="tituloizq" style="border-bottom:#E0E4D6 solid 1px;">Acceso General a Todo el Web Site</div>
<div id="dataderecha" style="border-bottom:#E0E4D6 solid 1px;"><input type="checkbox" <? if($ms['activo']==1) echo "checked" ?> name="checkbox3" onClick="ajaxsend('post','workflow.php','valor='+this.checked+'&tipo=3');" value="checkbox" class="form-box" style="margin:10px 0 0 0;"></div>

<? foreach ($servicios as $i => $value){


         	?>
         <div id="tituloizq" style="border-bottom:#E0E4D6 solid 1px;"><?=$servicios[$i]['nombre'] ?></div>

          <div  id="dataderecha" style="border-bottom:#E0E4D6 solid 1px;"><input <? if(in_array($servicios[$i]['id'],$miservicios)) echo "checked"; ?> type="checkbox" onClick="ajaxsend('post','workflow.php','valor='+this.checked+'&tipo=4&serv=<?=$servicios[$i]['id'] ?>');" name="checkbox" value="checkbox" class="form-box" style="margin:10px 0 0 0;"></div>


         <? } ?>


        <div id="nseparador"></div>
           
</form>
















<!-- termina nbloque -->
</div>












<!-- termina ncontenido -->
</div>
<?php //include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>    
</div>

</div>
<?php include ("../n-footer.php")?>












































</body>
</html>
<?php $datos->cerrar(); ?>
