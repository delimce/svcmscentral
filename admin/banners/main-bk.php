<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("security.php");

$tool = new tools();
$tool->autoconexion();
$sv = 'SVsitefiles/'.$_SESSION['DIRSERVER'];


	if(isset($_REQUEST['borrar'])){
		
		
	
			$imagen = $tool->simple_db("select archivo from banner where id = '{$_REQUEST['borrar']}' ");
			$tool->query("delete from banner where id = {$_REQUEST['borrar']} ");
			@unlink("../../$sv/banner/$imagen");
			$tool->javaviso("Banner {$_REQUEST['borrar']} ha sido borrado","main.php");
	
	}


	$tool->query("select * from banner ");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Banners</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script type="text/javascript" src="../../SVsystem/js/scripts.js"></script>
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
//-->
</script>


</head>

<body>
<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include "include-menu.php"?>
<!--END INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><a href="/admin/main.php"><img src="../header-banners.jpg" width="900" height="130" border="0"></a></td>
</tr>
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="76%" bgcolor="#D9DCE3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<!-- SUPER MENU !!! -->
<tr><td><?php include ("http://svcmscentral.com/admin/supermenu.php")?></td></tr>
<!--/// SUPER MENU -->
<tr>
<td class="td-titulo1"> banners o anuncios <a href="javascript:;" onClick="MM_openBrWindow('../help/banners.php','','scrollbars=yes,resizable=yes,width=700,height=550')" title="ayuda sobre este topico"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="bottom"></a></td>
</tr>
<tr>
<td><form name="form1" method="post" action="">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<td class="td-texto1"><p>En este m&oacute;dulo usted podr&aacute; controlar los banners  que se
  encuentran en su p&aacute;gina web: crear cu&aacute;ntos banners desee, verificar estad&iacute;sticas b&aacute;sicas como impresiones (cantidad
  de veces que ha sido mostrado) y clicks( cantidad de veces que han sido clickeados). Debajo de cada archivo est&aacute; el codigo
  a introducir en el web site para mostrar dicho banner. </p>
<p>Su dise&ntilde;ador es el encargado de colocar los banners en los distintos lugares del web site y estos est&aacute;n identificados por su ID, usted puede modificar cada banner y su enlace pero no deber&iacute;a borrarlos sin consultarlo con su dise&ntilde;ador. <a href="javascript:;" onClick="MM_openBrWindow('../help/banners.php','','scrollbars=yes,resizable=yes,width=700,height=550')" title="ayuda sobre este topico"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
 <td class="td-barra-inferior"><a href="javascript:;" title="agregar nuevo banner" class="link-boton-principal" onClick="MM_openBrWindow('agregar_banner.php','','resizable=yes,width=500,height=600,scrollbars=yes')">&nbsp; <img src="../icon/icon-banners-add.gif" width="16" height="16" border="0" align="absmiddle"> Agregar
 Banner</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>


<?php 

while ($row = mysql_fetch_assoc($tool->result)) { 


/*$dir = 'http://'.$_SERVER['HTTP_HOST'].'/SVsitefiles/'.$_SESSION['DIRSERVER'].'/banner/'.$row['archivo']; ///url de la imagen del banner
$dir1 = 'http://'.$_SERVER['HTTP_HOST'].'/SVsitefiles/'.$_SESSION['DIRSERVER'].'/banner/'.$row['archivover']; ///url de la imagen mouseover del banner
$dir2 = '/admin/banners/workflow.php'; ///url de la pagina de workflow

$click = "ajaxsend('post','$dir2','tipo=0&id={$row['id']}');";
$click2 = "flvFSTI1('banner{$row['id']}','$dir1',0,0,1,1);";*/

$enlace = "<?php mostrar_banner({$row['id']})  ?>";

?>
<!--loop banners-->
<div class="mens-mensaje-container"> 
<div class="mens-mensaje-imgborrar"><a href="#"  onClick="GP_AdvOpenWindow('edit_banner.php?id=<?php echo $row['id']; ?>','','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,channelmode=no,directories=no',500,500,'center','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue" title="editar"><img src="../icon/icon-edit-cuadrito.gif" width="16" height="16" border="0"></a> 
<img style="cursor:pointer" onClick="ajaxsend('post','workflow.php','tipo=2&id=<?php echo $row['id'] ?>');alert('estadisticas reseteadas'); document.getElementById('est_<?php echo $row['id'] ?>').innerHTML='0'; document.getElementById('est2_<?php echo $row['id'] ?>').innerHTML='0';document.getElementById('est_<?php echo $row['id'] ?>').innerHTML='0';" src="../icon/icon-reset.gif" width="16" height="16" border="0">
<a href="main.php?borrar=<?php echo $row['id'] ?>" title="borrar banner"><img src="../icon/botonsito-borrar-mensajes.jpg" width="15" height="15" border="0"></a></div>
<div class="mens-mensaje-fecha"><strong>Posición o ID:</strong> <?php echo $row['id'] ?></div>
<div class="mens-mensaje-fecha">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="6%"><strong class="mens-mensaje-fecha">Clicks:</strong></td>
      <td width="94%" class="mens-mensaje-fecha"><div id="est_<?php echo $row['id'] ?>"><?php echo $row['cliks'] ?></div></td>
    </tr>
  </table>
</div>
<div class="mens-mensaje-fecha">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="11%"><strong class="mens-mensaje-fecha">Impresiones:</strong></td>
      <td width="89%" class="mens-mensaje-fecha"><div id="est2_<?php echo $row['id'] ?>"><?php echo $row['views'] ?> </div></td>
    </tr>
  </table>
</div>
<div class="mens-mensaje-fecha"><strong>Archivo</strong>: <?php echo $row['archivo'] ?></div>
<div class="mens-mensaje-titulo"><?php echo $row['caption'] ?></div>
<div class="mens-mensaje-contenido2">
<!--poner imagen al tamaño predefinido-->
<img src="../../<?php echo $sv ?>/banner/<?php echo $row['archivo'] ?>" border="1"></div>
<div align="center">
  <textarea name="code" cols="90" rows="4" class="form-box" id="code"><?php echo $enlace; ?></textarea>
  &nbsp; <a href="javascript:;" title="codigo del banner. copie este codigo e introduzcalo en  la posicion deseada"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></div> 
</div>
<?php } ?>

</div>
<!--termina loop banners--></td>
              </tr>
              <tr>
               <td class="td-refooter">&nbsp;</td>
              </tr>
             </table>
            </form></td>
          </tr>
          <tr>
            <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto Internet</a></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<?php $tool->cerrar(); ?>