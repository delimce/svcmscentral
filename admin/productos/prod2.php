<?php 

$NIVEL = $_REQUEST['nivel'];
$NIVEL_ID = $_REQUEST['id'];

$query = "select id,nombre,codigo,orden,precio,stock from producto where cat_nivel = $NIVEL and cat_id = $NIVEL_ID order by orden ";

$tool->query($query);

$ii=0;

while ($fila = mysql_fetch_assoc($tool->result)) {
	

 ?>
<div class="cat-td-arbol-producto">

<img onClick="borrar_prod('<?=$fila['id'] ?>','<?=$fila['nombre'] ?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>');" title="Borrar este producto. IRREVERSIBLE!" style="cursor:pointer" src="../icon/icon-prod-delete.gif" width="16" height="16" border="0">
<img onClick="popup('popup-editar-producto.php?id=<?php echo $fila['id'] ?>','nuevo','595','935');" style="cursor:pointer" title="Editar las caracteristicas de este producto" src="../icon/icon-prod-edit.gif" width="16" height="16" border="0">

<img onClick="popup('popup-categorias.php?id=<?=$fila['id'] ?>&nivel=<?=$NIVEL ?>','nuevo','595','935');" title="Mover producto a otra categoria" style="cursor:pointer" src="../icon/icon-prod-copy.gif" width="16" height="16" border="0">

<a href="<?php echo $_SESSION['SURL'];  ?>/SV-detalle-producto.php?id=<?=$fila['id'] ?>" target="_blank" title="Vista previa del producto"><img src="../icon/icon-prod-view.gif" width="16" height="16" border="0"  ></a> 

<?php if($ii!=$tool->nreg-1){?>
<img style="cursor:pointer" title="bajar de orden" onClick="ordenar_pro('<? echo $fila['orden']?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>','d');" src="../icon/icon-down.gif" width="16" height="16" border="0">
<?php }  ?>
<?php if($ii!=0){?>
<img style="cursor:pointer" title="subir de orden" onClick="ordenar_pro('<? echo $fila['orden']?>','<?=$NIVEL ?>','<?=$NIVEL_ID ?>','u');" src="../icon/icon-up.gif" width="16" height="16" border="0">
<?php } ?>


<!--datos del producto en el listado-->
<span class="cat-nombreproducto-en-listado"><? echo $tool->abreviar(utf8_encode($fila['nombre']),72); ?>. &nbsp; &nbsp;</span>
<font color="#006633"><b>Cod:</b> <? echo $fila['codigo']?></font>&nbsp; &nbsp;
<b>Precio:</b> <? echo number_format($fila['precio'],2); ?>&nbsp; &nbsp;
<b>Stock:</b> <? echo $fila['stock']?>
<!--/ datos del producto en el listado--> 

</div><br />


<?php

 $ii++;

 }


 
 
 ?>
