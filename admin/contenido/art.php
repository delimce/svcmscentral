<?php

$NIVEL = $_REQUEST['nivel'];
$NIVEL_ID = $_REQUEST['id'];

$query = "select id,titulo,estatus,revisado,
 if(estatus = 1,'<img src=\"../icon/icon-ojo-pelao.gif\" title=\"este articulo esta visible. haga click para esconderlo\" border=\"0\">','<img src=\"../icon/icon-ojo-cerrao.gif\" title=\"este articulo esta escondido. haga click para publicarlo\" border=\"0\">') as estatus1,
 if(revisado = 0,'<img src=\"../icon/icon-nuevo.gif\" title=\"NUEVO articulo agregado por usuario, usted no lo ha revisado todavia\" border=\"0\">','<img src=\"../icon/icon-usuario-verde.gif\" title=\"articulo agregado por usuario, usted ya lo reviso\" border=\"0\">') as revisado1,
orden from articulo where cat_nivel = '$NIVEL' and cat_id = '$NIVEL_ID' order by orden ";

$tool->query($query);

$ii=0;

while ($fila = mysql_fetch_assoc($tool->result)) {


 ?>

<div class="cont-div-articulo">
<div class="cont-div-cat-imagenes">&nbsp;<img onclick="borrar_art('<?php echo $fila['id'] ?>','<?php echo utf8_encode($fila['titulo']); ?>',<?=$NIVEL ?>,<?=$NIVEL_ID ?>);" style="cursor:pointer" title="borrar articulo. esta accion es IRREVERSIBLE y no tiene confirmacion. proceda con cautela" src="../icon/icon-prod-delete.gif" width="16" height="16" border="0">
<img title="editar articulo" onClick="GP_AdvOpenWindow('editar_articulo.php?id=<?php echo $fila['id'] ?>','nuevo','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,channelmode=no,directories=no',0,0,'fitscreen','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue" style="cursor:pointer" src="../icon/icon-prod-edit.gif" width="16" height="16" border="0">





<a target="_blank" href="<? echo $front.'?id='.$fila['id']; ?>" title="ver articulo en el front end"><img src="../icon/icon-prod-view.gif" width="16" height="16" border="0"></a>
<a href="#" title="copiar articulo a otra categoria" onClick="popup('copiar_art.php?id=<?=$fila['id'] ?>&nivel=<?=$NIVEL ?>&cat=<?=$NIVEL_ID ?>','new','595','600');"><img src="../icon/icon-prod-copy.gif" width="16" height="16" border="0"></a>
<a href="#" title="mover articulo a otra categoria" onClick="popup('mover_art.php?id=<?=$fila['id'] ?>&nivel=<?=$NIVEL ?>&cat=<?=$NIVEL_ID ?>','new','595','600');"><img src="../icon/icon-mover-articulo.gif" width="16" height="16" border="0"></a>
<span id="est_<?=$fila['id'] ?>" onClick="activo1('<?=$fila['id'] ?>');">
<?php echo $fila['estatus1'] ?></span>
<input name="escoma_<?=$fila['id'] ?>" type="hidden" id="escoma_<?=$fila['id'] ?>" value="<?php if($fila['estatus']==1) echo 1; else 0; ?>">

<span id="rev_<?=$fila['id'] ?>" onClick="revisado('<?=$fila['id'] ?>');">
<?php echo $fila['revisado1'] ?>
</span>
<input name="escomar_<?=$fila['id'] ?>" type="hidden" id="escomar_<?=$fila['id'] ?>" value="<?php if($fila['revisado']==1) echo 1; else 0; ?>">


<?php if($ii!=$tool->nreg-1){?>
<img style="cursor:pointer" title="bajar de orden" onClick="ordenar_articulo('<? echo $fila['orden']?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>','<?=$fila['id']?>','d');" src="../icon/icon-down.gif" width="16" height="16" border="0">
<?php }  ?>
<?php if($ii!=0){?>
<img style="cursor:pointer" title="subir de orden" onClick="ordenar_articulo('<? echo $fila['orden']?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>','<?=$fila['id']?>','u');" src="../icon/icon-up.gif" width="16" height="16" border="0">
<?php } ?>
</div>
<?php echo $fila['id'].' - '.utf8_encode($fila['titulo']); ?></div>
<?php

 $ii++;

 }


?>