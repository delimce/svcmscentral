<div id="categoria">
	<a href="<?=$articulo->link?>">
		<img src="<?=$articulo->srcImg?>" border="0"  alt="<?= $articulo->nombre?>" />
	</a>
	<h3>
		<a href="<?=$articulo->link?>"><?= $articulo->nombre?>
		</a>
	</h3>
	<div>
	<?= $articulo->resumen?>
	</div>
</div>
