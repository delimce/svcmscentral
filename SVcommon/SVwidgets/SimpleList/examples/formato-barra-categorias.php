<li>
<?	if ($datos['tiene_hijos']=="NO"){		?>
		<a href="<?= $datos['link'] ?>"><h<?= $datos['nivelCategoria']+1 ?>><?= $datos['nombre']?></h<?= $datos['nivelCategoria']+1 ?>></a>
<?	}else{					?>
		<h<?= $datos['nivelCategoria']+1 ?>><?= $datos['nombre']?> </h<?= $datos['nivelCategoria']+1 ?>>
<?	}     					?>
		<ul class="menu-<?= $datos['nivelCategoria']+1 ?>">
			<element/>
		</ul>
</li>