<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

$front = $_SESSION['SURL'].'/SV-detalle-articulo.php';////url relativa del detalle de articulo en el front
$front2 = $_SESSION['SURL'].'/SV-listado-articulos.php';////url relativa del detalle de articulo en el front

	$categorias = $tool->estructura_db("select id,nombre,orden,
	if(c.users = 1,'<img src=\"../icon/icon-flag_green.gif\" title=\"Alimentable\" border=\"0\">','<img src=\"../icon/icon-flag_red.gif\" title=\"No Alimentable\" border=\"0\">') as users, 
				  c.users as users2,
	(select count(*) from cont_subcategoria where cat_id = c.id ) as subca,(select count(*) from articulo where cat_nivel = 1 and cat_id = c.id) as art from cont_categoria c order by orden");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Administrar &aacute;rbol de contenidos </title>
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


<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script type="text/javascript" src="../../SVsystem/js/arbol.js"></script>



</head>

<body>
<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include "include-menu.php"?>
<!--END INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../header-contenido.jpg" width="900" height="130"></td>
  </tr>
  <tr>
    <td><form><table width="99%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td class="td-titulo1">Administrar &aacute;rbol de contenidos</td>
     </tr>
     <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
       <tr>
        <td class="td-texto1">Aqu&iacute; puede visualizar y controlar todas las categor&iacute;as&nbsp; y art&iacute;culos
        de su p&aacute;gina web. <a href="#" title="ayuda para esta sección" onClick="MM_openBrWindow('../help/contenido-arbol.php','','scrollbars=yes,resizable=yes,width=900,height=550')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
       </tr>
       
       <tr>
        <td align="right" class="td-barra-inferior">&nbsp;&nbsp; <a href="javascript:popup('insert_categoria.php','new','400','700');" class="link-boton-principal"> <img src="../icon/icon-cat-add.gif" width="16" height="16" border="0" align="absmiddle"> agregar
        categor&iacute;a de primer nivel</a> </td>
       </tr>
       <tr>
        
<!--AQUI COMIENZA EL ARBOL-->

<td>
<!--bloque de categoría 1-->

 <?php 
					  
	  if(count($categorias)>0){



		for($i=0;$i<count($categorias);$i++){
		
		
		$NIVEL = 1;
		$NIVEL_ID = $categorias[$i]['id'];
		$ART = $categorias[$i]['art'];
								
					  
 ?>

<!--bloque categorias-->
<div id="catmain<?php echo $categorias[$i]['id'] ?>" onClick="abrir_cat('<?php echo $categorias[$i]['id'] ?>','<?php echo $NIVEL ?>');" class="cont-div-cat1-container">

<div class="cont-div-cat1">
<div class="cont-div-cat-imagenes">
<!--delimce. nuevo. indicador de categoría de primer nivel privada, todo lo que esté dentro de esta categoría solo puede ser visto por los usuarios logueados, borrar este comentario al realizar el trabajo-->
<a href="javascript:;" title="Esta categoría es privada, solo sus usuarios registrados podrán verla. este atributo se cambia al editar la categoría"><img src="../icon/icon_key.gif" width="16" height="16" border="0"></a>
<!--/ delimce.  nuevo-->
<?php if( ($categorias[$i]['subca']==0 && $categorias[$i]['art']==0) || ($categorias[$i]['subca']>0 && $categorias[$i]['art']==0) ){ ?>
<a href="#" title="agregar sub categoria"  onClick="javascript:popup('insert_scategoria.php?id=<?=$categorias[$i]['id']?>','new','400','700');"><img src="../icon/icon-cat-add.gif" width="16" height="16" border="0"></a> 
<?php } ?>

<img src="../icon/icon-cat-delete.gif" width="16" height="16" border="0" onClick="borrar('<?=$categorias[$i]['id'] ?>','<?=$categorias[$i]['nombre'] ?>','cont_categoria');" title="borrar categoría y TODO lo que ésta contiene. esta accion es IRREVERSIBLE proceda con cautela" style="cursor:pointer;">
<a href="#" title="editar características de esta categoría"  onClick="GP_AdvOpenWindow('edit_categoria.php?id=<?=$categorias[$i]['id']?>','','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,channelmode=no,directories=no',700,400,'center','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue"><img src="../icon/icon-cat-edit.gif" width="16" height="16" border="0"></a>
<?php if( ($categorias[$i]['subca']==0 && $categorias[$i]['art']==0) || ($categorias[$i]['subca']==0 && $categorias[$i]['art']>0) ){ ?>
<a href="#" title="agregar artículo a esta categoría"  onClick="popup('insert_articulo.php?nivel=<?php echo $NIVEL; ?>&cat=<?php echo $NIVEL_ID; ?>','nuevo','593','935');"><img src="../icon/icon-agregar-articulo.gif" width="16" height="16" border="0"></a>
<?php } ?>
<?php if($i!=count($categorias)-1){?>
<img src="../icon/icon-down.gif" onClick="ordenar('<?=$categorias[$i]['orden'] ?>','cont_categoria','d');" width="16" height="16" border="0" title="Mover esta categoria hacia abajo" style="cursor:pointer;">
<?php } ?>
<?php if($i!=0){?>
<img src="../icon/icon-up.gif" onClick="ordenar('<?=$categorias[$i]['orden'] ?>','cont_categoria','u');" width="16" height="16" border="0" title="Mover esta categoria hacia arriba" style="cursor:pointer;">
<?php } ?>
<a href="#" title="esta categor&iacute;a permite adiciones de art&iacute;culos por los usuarios">
<span id="estado_<?=$categorias[$i]['id'] ?>_1" onClick="estatus('<?=$categorias[$i]['id'] ?>','1');">
<?php echo $categorias[$i]['users'];  ?>
</span>
</a>
<input name="escom_<?=$categorias[$i]['id'] ?>_1" type="hidden" id="escom_<?=$categorias[$i]['id'] ?>_1" value="<?php if($categorias[$i]['users2']==1) echo 1; else 0; ?>"> 
</div>
<?php echo $categorias[$i]['id'].' - '.$categorias[$i]['nombre']; ?></div>
</div>
<!--bloque de categoría 1-->
<div style="display:none" id="catcon<?php echo $categorias[$i]['id'] ?>"><!-- aca es donde va el contenido de cada categoria-->

</div> <!--fin del contenido de cada categoria-->


<?php  } ////catego for
					  
					  
  }else{ ///catego if
  
  echo "<span class='td-texto1'>Actualmente no existen Articulos agregados</span>";
  
  }
  
  ?></td>

<!--AQUI TERMINA EL ARBOL-->
       </tr>
       <tr>
        <td class="td-refooter">&nbsp;</td>
       </tr>
      </table>
      </td>
     </tr>
     <tr>
      <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto Internet</a></td>
     </tr>
    </table></form></td>
  </tr>
</table>

</body>
</html>
<?php 

$tool->cerrar();

?>