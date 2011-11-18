<? session_start();
require '../../../SVsystem/class/remoteFunctions.php';
require '../../../SVsystem/config/dbconfig.php';
require '../../../SVsystem/config/dominio.php';
includeWidget("SimpleList.SimpleList");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>Articulos Destacados</title>
<link rel="stylesheet"
	href="estilo.css" type="text/css"
	media="screen" title="no title" charset="utf-8">

</head>
<body>
	<div id="wrapper">
		<div id="contenido">
			<div id="izquierda">
				<?php include "menu-categorias-combinado.php";?>
			</div>
			<div id="centro">
				<div id="aecs">
				<?php
				$widget = new simpleList();
				$widget->formatoPresentacion="formato-articulo.php";
				$widget->formatoTitulo="formato-titulo.php";
				$widget->formatoSinResultados="formato-sin-resultados.php";
				$widget->titulo="Articulos Destacados";
				$widget->rutaBase = $DOMINIOSV;
				$widget->articulosDestacados();
				?>
					<div id="separador"></div>
				</div>
				<div id="aecs">
				<?php
				$widget = new simpleList();
				$widget->formatoPresentacion="formato-articulo.php";
				$widget->formatoTitulo="formato-titulo.php";
				$widget->formatoSinResultados="formato-sin-resultados.php";
				$widget->titulo="Articulos Destacados Maximo 1";
				$widget->rutaBase = $DOMINIOSV;
				$widget->articulosDestacados(1);
				?>
					<div id="separador"></div>
				</div>
				<div id="aecs">
				<?php
				$widget = new simpleList();
				$widget->formatoPresentacion="formato-articulo.php";
				$widget->formatoTitulo="formato-titulo.php";
				$widget->formatoSinResultados="formato-sin-resultados.php";
				$widget->autorArticulo="Rafael Ju�rez";
				$widget->titulo="Articulos de un autor (Rafael Ju�rez)";
				$widget->rutaBase = $DOMINIOSV;
				$widget->articulosDestacados();
				?>
					<div id="separador"></div>
				</div>
			</div>

		</div>
	</div>

</body>
</html>
