<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Ayuda - B&uacute;squeda de usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>


</head>

<body class="body-popup">
<div class="td-titulo-popup">Campos adicionales en su base de datos de usuarios</div>
<div class="textohelp">
 <p class="help-boton-volver"><a href="index.php"><img src="../icon/icon-left.gif" width="16" height="16" border="0" align="absmiddle"> Volver
   al índice de la ayuda</a></p>


<p>Para entender mejor qu&eacute; son los campos adicionales,&nbsp; es quizas mejor el entender primero que son los &quot; campos &quot; en una base de datos: los campos son&nbsp;cada uno de los diferentes datos que uno desea almacenar, por ejemplo. Quiero hacer una base de datos de mis Clientes, entonces creo una&nbsp; tabla que tenga como&nbsp; COLUMNAS, los campos: Nombre, Email y Tel&eacute;fono. Luego&nbsp; al llenarla, y tener uno, dos&nbsp; &nbsp;o tres clientes.. cada una de esas &quot;filas&quot; son registros.</p>
<p>La&nbsp; siguiente imagen deber&iacute;a aclarar esto que&nbsp; acabamos de exponer:</p>
<p><img src="usuarios-campos-registros.jpg" alt="campos y registros en una base de datos" width="749" height="279" border="1"></p>
<p>Nuestro sistema de base de datos de usuarios tiene campos fijos (nombre, telefono, c&eacute;dula, direcci&oacute;n, etc.) sin embargo, para personalizar su base de datos, el sistema le permite tener una serie de campos adicionales creados por usted mismo, con las caracter&iacute;sticas que desee. Estos campos adicionales que&nbsp; usted agregue se ver&aacute;n en el<strong> <a href="javascript:;" onClick="MM_openBrWindow('usuarios-muestra-popup-registro.jpg','','resizable=yes,width=700,height=600')">popup de registro de usuario</a></strong> y en el<strong> popup de modificar datos del usuario</strong> en la parte externa de su&nbsp; web site.</p>
<p>En este video nos ver&aacute; agregando&nbsp; nuevos campos a nuestra base de datos de usuarios.</p>



<object id="scPlayer"  width="901" height="516" type="application/x-shockwave-flash" data="http://content.screencast.com/users/proyectointernet/folders/Jing/media/4235697c-59e8-4c0c-a563-9fe0460d245a/jingswfplayer.swf" >
 <param name="movie" value="http://content.screencast.com/users/proyectointernet/folders/Jing/media/4235697c-59e8-4c0c-a563-9fe0460d245a/jingswfplayer.swf" />
 <param name="quality" value="high" />
 <param name="bgcolor" value="#FFFFFF" />
 <param name="flashVars" value="thumb=http://content.screencast.com/users/proyectointernet/folders/Jing/media/4235697c-59e8-4c0c-a563-9fe0460d245a/FirstFrame.jpg&containerwidth=901&containerheight=516&content=http://content.screencast.com/users/proyectointernet/folders/Jing/media/4235697c-59e8-4c0c-a563-9fe0460d245a/Creando%20Campos%20Adicionales%20en%20la%20Base%20de%20Datos.swf&blurover=false" />
 <param name="allowFullScreen" value="true" />
 <param name="scale" value="showall" />
 <param name="allowScriptAccess" value="always" />
 <param name="base" value="http://content.screencast.com/users/proyectointernet/folders/Jing/media/4235697c-59e8-4c0c-a563-9fe0460d245a/" />
 Unable to display content. Adobe Flash is required.
</object>


 <p>&nbsp;</p>
 <p><img src="usuarios-muestra-popup-registro.jpg" alt="registro de usuario" width="500" height="372" border="1"></p>
 <p>A Partir del momento en que&nbsp; usted agregue su nuevo campo adicional, sus <strong>nuevos usuarios ver&aacute;n estos campos</strong> en su popup de reg&iacute;stro  y tendr&aacute;n la oportunidad de completarlos. Si usted agrega estos campos&nbsp; luego de un tiempo de que su&nbsp; web site ha comenzado a&nbsp; funcionar, quizas quiera solicitarle a los&nbsp; usuarios anteriores que&nbsp; vayan a la secci&oacute;n &quot;modificar sus datos de registro&quot; para que &eacute;stos puedan completar sus nuevos campos adicionales.</p>
 <p>Lamentablemente hay manera autom&aacute;tica de configurar estos  campos adicionales como &quot;obligatorios&quot;.</p>
 <p>Usted puede crear tres tipos de campo, dependiendo del tipo de informaci&oacute;n que desee recopilar de sus&nbsp; usuarios al registrarse:</p>
 <p class="help-subtitulo">Tipos de campos adicionales que&nbsp; usted puede agregar</p>
<p class="help-subtitulo2"><img src="../icon/icon-campo-text.jpg" alt="texto sencillo" width="18" height="14" align="absmiddle"> Campo de Texto Sencillo: </p>
 <p>Para los casos en los que desee recopilar informaci&oacute;n en una sola frase. Por ejemplo, puede crear el campo &quot;Color Favorito&quot; , porque sabe que las respuestas seran del tipo &quot; rojo, negro,verde, azul&quot;&nbsp; y cn&nbsp; una frase corta o una palabra es suficiente. Al agregar un campo de texto simple, usted ver&aacute;:</p>
 <p><img src="usuarios-agregar-camposimple.jpg" alt="agregar campo de texto simple" width="567" height="175" border="1"></p>
 <p><strong>Su campo de texto simple se ver&aacute; asi:</strong></p>
 <p><img src="usuarios-camposimple.jpg" width="344" height="35" alt="campo simple"></p>
 <p class="help-subtitulo2"><img src="../icon/icon-campo-textarea.jpg" alt="text area" width="18" height="18" align="absmiddle"> Campo Texto Amplio o Largo</p>
 <p>Para los casos en los que usted requiera recopilar informaci&oacute;n mas extensa, como&nbsp; direcciones, opiniones,&nbsp;comentarios, testimonios, etc. </p>
 <p><strong>Al agregar un campo de texto largo, usted ver&aacute; este popup:</strong></p>
 <p><img src="usuarios-agregar-campotexto.jpg" alt="agregar campo de texto largo" width="651" height="216" border="1"></p>
 <p><strong>Su campo de  Texto Amplio se ver&aacute; asi:</strong></p>
 <p><img src="usuarios-campotextarea.jpg" alt="text area" width="442" height="57" border="0"></p>
 <p class="help-subtitulo2"><img src="../icon/icon-campo-text.jpg" width="18" height="14" alt="campo de lista"> Campo de Lista</p>
 <p>Para los casos en los que usted desee recopilar informaci&oacute;n de manera cerrada y desea que sus&nbsp; usuarios seleccione los valores de una lista, use este campo.</p>
 <p><strong>Al agregar un campo de lista, usted ver&aacute; un popup asi:</strong></p>
 <p><img src="usuarios-agregar-campo-lista.jpg" alt="agregar campo de lista" width="650" height="179" border="1"></p>
 <p>Adem&aacute;s de seleccionar el nombre del campo, usted podr&aacute; elegir la lista de opciones que va a tener el campo.</p>
 <p><strong>Su campo se ver&aacute; asi: </strong></p>
 <p><img src="usuarios-campolista.jpg" width="165" height="77" alt="campo de lista"></p>
<p class="help-boton-volver"><a href="index.php"><img src="../icon/icon-left.gif" width="16" height="16" border="0" align="absmiddle"> Volver
  al índice de la ayuda</a></p>
</div>
</body>
</html>
