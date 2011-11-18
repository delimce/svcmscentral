<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Ayuda - Los art&iacute;culos destacados</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">
<div class="td-titulo-popup">Modificando los slides del Carrusel (Encabezado M&oacute;vil)</div>
<div class="textohelp">
<p class="help-boton-volver"><a href="index.php"><img src="../icon/icon-left.gif" width="16" height="16" border="0" align="absmiddle"> Volver
 al índice de la ayuda</a></p>

<p class="help-subtitulo">Consideraciones</p>
<p>Estas imagenes puden ser simples JPG.

</p>
<p>Su Medida, por lo general, es 1000 x 330 px.

En todo caso, pregunte al dise&ntilde;ador.</p>
<p>Puede producir la cantidad&nbsp; de slides que desee.

</p>
<p>El nombre que ha de colocarle a cada archivo <strong>NO puede tener espacios ni  caracteres especiales</strong>. Recomendamos nombres descriptivos y sencillos. </p>
<p class="help-subtitulo">Cargue&nbsp; sus im&aacute;genes personalizadas en su propio servidor</p>
<p>Si su carrusel no es controlado desde la seccion &quot; banners&quot; de svcmscentral.com , usted deber&aacute; hacer esto &quot;a mano&quot;; Es un procedimiento complejo al principio pero extremadamente &uacute;til e interesante, que adem&aacute;s le acercar&aacute; much&iacute;simo mas&nbsp; a todas als posibilidades de control que vienen con el lograr modificar ciertos aspectos del c&oacute;digo de su&nbsp; propia p&aacute;gina web. </p>
<p>Todas las imagenes que usted produzca deben ser colocadas (cargadas, "uploaded" o subidas ... son sinónimos) en la carpeta /carrusel/ del servidor de su pagina web. (para aprender a acceder vía  FTP al servidor de su pagina web <strong><a href="http://proyecto-internet.com/help/ftp/" target="_blank">vea este link</a></strong>) </p>
<p class="help-subtitulo">Descargue el archivo que controla su carrusel</p>
<p>Una vez que haya colocado las imagenes en el servidor, debe modificar el archivo que las controla, para eso descargue del servidor y luego edite el archivo <strong>"SVG-carrusel.php "</strong> con "notepad (Block de Notas)" o  Dreamweaver. NO USE WORD. NO USE EXCEL. NO USE WORDPAD.

</p>
<p>Entre todo el código  del archivo verá el siguiente conjunto de lineas:</p>
<p>&lt;div id=&quot;featured&quot;&gt;<br />
&lt;a <strong>href=&quot;sulinkaqui&quot;</strong>&gt;&lt;div class=&quot;carruselfoto&quot; style=&quot;background: url(<strong>carrusel/h001.jpg</strong>);&quot;&gt;&lt;/div&gt;&lt;/a&gt;<br />
&lt;a href=&quot;sulinkaqui&quot;&gt;&lt;div class=&quot;carruselfoto&quot; style=&quot;background: url(carrusel/h002.jpg);&quot;&gt;&lt;/div&gt;&lt;/a&gt;<br />
&lt;a href=&quot;sulinkaqui&quot;&gt;&lt;div class=&quot;carruselfoto&quot; style=&quot;background: url(carrusel/h003.jpg);&quot;&gt;&lt;/div&gt;&lt;/a&gt;<br />
&lt;a href=&quot;sulinkaqui&quot;&gt;&lt;div class=&quot;carruselfoto&quot; style=&quot;background: url(carrusel/h004.jpg);&quot;&gt;&lt;/div&gt;&lt;/a&gt;<br />
&lt;a href=&quot;sulinkaqui&quot;&gt;&lt;div class=&quot;carruselfoto&quot; style=&quot;background: url(carrusel/h005.jpg);&quot;&gt;&lt;/div&gt;&lt;/a&gt;<br />
&lt;a href=&quot;sulinkaqui&quot;&gt;&lt;div class=&quot;carruselfoto&quot; style=&quot;background: url(carrusel/h006.jpg);&quot;&gt;&lt;/div&gt;&lt;/a&gt;<br />
</p>
<p>&lt;/div&gt;</p>
<p class="help-subtitulo"> Editando SVG-carrusel.php ...:
</p>
<p>1.- <strong>Cada línea es una imagen</strong>. Si desea agregar espacio para otra imagen deberá copiar una linea entera , desde &lt;a href...haaaasta &lt;/a&gt; . . Proceda con cautela. Luego de duplicar la linea deberá modificar  los parámetros para que no se repita el slide.

</p>
<p>2.- El orden de las líneas es el orden de aparición de las imagenes

</p>
<p>3.- Para cada slide, puede modificar <strong>el enlace (link)</strong> hacia donde apuntará cada slide al hacerle click (quizás  alguna pagina que usted ya haya creado) modificando lo que está entre las comillas en <strong>href="sulinkaqui"</strong> . Si su  artículo se llama , por ejemplo,  "registrese en nuestra base de datos" ,  el link a colocar  puede ser: articulo-registrese-en-nuestra-base-de-datos  o  http://www.supagina.com/articulo-registrese-en-nuestra-base-de-datos . Tambien puede serun link externo como http://www.google.com

</p>
<p>4.- Para cada slide, puede <strong>modificar la imagen</strong>, escribiendo EXACTAMENTE (mayúsculas y minúsculas importan, ojo!) el nombre de la imagen que acaba de colocar en el servidor, enla carpeta /carrusel/; para eso modifique la parte en negritas  del pedazo: url(carrusel/h001.jpg)

</p>
<p>5.- Por supuesto que una vez que domine este codigo, usted podrá colocar las imagenes en la carpeta que  desee. Recomendamos cuidado y siempre hacer backup.

</p>
<p>6.- <strong>Lo del cuidado es en serio</strong>.  Al editar este código, el borrar por accidente  1 solo caracter puede deshabilitar  partes importantes de la página  entera. <strong>Proceda con CAUTELA.</strong></p>
<p class="help-subtitulo">Cargando el archivo en el servidor</p>
<p>Luego de que  haya finalizado de editar el archivo SVG-carrusel.php puede cargarlo al servidor, remplazando el anterior. Si  hizo adecuadamente el trabajo  de nombrar las imagenes y reflejar su nombre adecuadamente en el codigo php. verá inmediatamente su cambio.




-- 




</p>
</div>
</body>
</html>
