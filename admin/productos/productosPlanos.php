<?php


$query = "select id,nombre,codigo,orden,precio,stock from producto where cat_nivel = $NIVEL and cat_id = $NIVEL_ID order by orden ";

$tool->query($query);

$ii=0;

while ($fila = mysql_fetch_assoc($tool->result)) {


 ?>
<div class="cat-td-arbol-producto">

<a href="javascript:;" class="instruccion"><img onClick="borrar_prod('<?=$fila['id'] ?>','<?=$fila['nombre'] ?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>');" src="../icon/icon-prod-delete.gif" width="16" height="16" border="0" style="cursor:pointer!important;"><span>Borrar producto de la  base de datos. Esta acción es IRREVERSIBLE, proceda con cautela.</span></a>

<a href="javascript:;" class="instruccion"><img onclick="GP_AdvOpenWindow('popup-editar-producto.php?id=<?php echo $fila['id'] ?>','nuevo','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,channelmode=no,directories=no',0,0,'fitscreen','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue" style="cursor:pointer" src="../icon/icon-prod-edit.gif" width="16" height="16" border="0" /><span>Editar las caracteristicas de este producto</span></a>


<a href="javascript:;" class="instruccion"> <img onClick="popup('popup-categorias.php?id=<?=$fila['id'] ?>&nivel=<?=$NIVEL ?>','nuevo','595','935');"  style="cursor:pointer" src="../icon/icon-mover-articulo.gif" width="16" height="16" border="0"><span>MOVER producto a otra categoria</span></a>


<a href="javascript:;" class="instruccion"><img src="../icon/icon-prod-copy.gif" width="16" height="16" border="0" style="cursor:pointer" onClick="popup('copiar_prod.php?id=<?=$fila['id'] ?>&nivel=<?=$NIVEL ?>&cat=<?=$NIVEL_ID ?>','new','595','600');"><span>COPIAR producto a  otra categoría. Crea un duplicado con el mismo nombre y características pero lo coloca en la categoría de su elección.</span></a>


<a href="<?php echo $_SESSION['SURL'];  ?>/SV-detalle-producto.php?id=<?=$fila['id'] ?>" target="_blank"" class="instruccion">
<img src="../icon/icon-prod-view.gif" width="16" height="16" border="0" style="cursor:pointer"><span>Ver Producto en Vivo</span></a>



<?php if($ii!=$tool->nreg-1){?>
<a href="javascript:;" class="instruccion"> <img style="cursor:pointer" onClick="ordenar_pro('<? echo $fila['orden']?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>','<?=$fila['id'] ?>','d');" src="../icon/icon-down.gif" width="16" height="16" border="0"><span>Bajar este producto en la lista. Si al hacer click el producto se queda en su lugar, haga click hasta lograrlo. Estamos trabajando en arreglar esto.<br>Disculpe las molestias</span></a>


<?php }  ?>
<?php if($ii!=0){?>
<a href="javascript:;" class="instruccion"><img style="cursor:pointer" onClick="ordenar_pro('<? echo $fila['orden']?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>','<?=$fila['id'] ?>','u');" src="../icon/icon-up.gif" width="16" height="16" border="0"><span>Subir este producto en la lista. Si al hacer click el producto se queda en su lugar, haga click hasta lograrlo. Estamos trabajando en arreglar esto.<br>Disculpe las molestias</span></a>

<?php } ?>


<!--datos del producto en el listado-->
<span class="cat-nombreproducto-en-listado"><? echo $tool->abreviar(utf8_encode($fila['nombre']),72); ?>. &nbsp; &nbsp;</span>
<font color="#006633"><b>id:</b> <? echo $fila['id']?></font>&nbsp; &nbsp;
<font color="#006633"><b>Cod:</b> <? echo $fila['codigo']?></font>&nbsp; &nbsp;
<b>Precio:</b> <? echo number_format($fila['precio'],2); ?>&nbsp; &nbsp;
<b>Stock:</b> <? echo $fila['stock']?>
<!--/ datos del producto en el listado-->

</div>
<br />


<?php

 $ii++;

 }




?>