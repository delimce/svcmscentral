<?php includeWidget("SimpleList.SimpleList");?>
<div class="menu">
  <ul class="menu-1">
<?php
	$widget = new simpleList();
	$widget->formatoPresentacion="formato-barra-categorias.php";
	$widget->formatoPresentacionHoja="formato-barra-articulos-categorias.php";
	$widget->formatoTitulo="NO";
	$widget->rutaBase = $DOMINIOSV;
	$widget->categoriasDeProductos(1,true);
?>
	</ul>
</div>
