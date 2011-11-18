<?php

class funciones {

////FUNCION DE CALENDARIO
function LoadCalendario($CEtiqueta,$CnombreId,$CValues,$CVisible,$CEjeX,$CEjeY,$CImagenClick,$clase_t, $clase_in)
//CEtiqueta							' Nombre que se muestra al lado del calendario
//$CnombreId							' Nombre e ID del calendario
//$CValues								' Valor por defecto
//$CVisible							' Booleano para mostrar o no el calendario
//$CEjeX								' Posicion del eje X de calendario
//$CEjeY								' Posicion del eje Y de calendario
//$CImagenClick						' imagen de boton para mostrar el calendario
//$strtxt								' contiene la cadena de todo el html generado para la caja de texto
{

		$NameCalendario='Calendario';

		if (!$CVisible)
			$sStyle = " style='display:none;' ";

		if ($CnombreId != "") $NameCalendario="'Tbl". $CnombreId . "'";

		$strtxt = "<TABLE border=0 id=". $NameCalendario ." ". sStyle ." cellpadding='0' cellspacing='0'> \n";
		$strtxt .= "		<TR>\n";
		if ($CEtiqueta!=''){
			$strtxt .= "			<TD valign=middle class='".$clase_t."'>&nbsp;". str_ireplace(" ","&nbsp;",$CEtiqueta) ."</TD>\n";
			$strtxt .= "			<TD width=3px>&nbsp;</TD>\n";
		}
		$strtxt .= "			<TD valign=middle >\n";
		$strtxt .= "			<input class='".$clase_in."' name='". $CnombreId ."' \n";
		$strtxt .= "			id='". $CnombreId  ."' value='". $CValues ."' size='12'> \n";
		$strtxt .= "			</TD>";
		$strtxt .= "			<TD>";
		 if ($CImagenClick=="")
			$strtxt .= "<input type='button' title='ver calendario' value='v' border='1'  \n";
		 else
			$strtxt .= "<input type='image' title='ver calendario' SRC='". $CImagenClick ."' border='1'  \n";

		 $strtxt .= "			WIDTH='20' HEIGHT='18'  \n";
		 $strtxt .="			class='CalBoton'  \n";
		 $strtxt .="			onclick='event.cancelBubble=true;  \n";
		 $strtxt .="			TopFrameObj.fPopCalendar(". $CnombreId . "," . $CnombreId . ",TopFrameObj.popCal";
		 if ($CEjeY!="")
				$strtxt .= ", " . $CEjeY;
		 else
				$strtxt .= ",0 ";


		 if ($CEjeX!="")
			$strtxt .= "," .$CEjeX;
		 else
			$strtxt .= ",0 ";


		 $strtxt .= " ); \n";
		 $strtxt .= " return false;' ";
		 $strtxt .= " > \n";
		 $strtxt .= " </TD> \n";
		$strtxt .= "</TR> \n";
		$strtxt .= "</TABLE> \n";
		return $strtxt;
}



	function borrar_imagenes($imagen){

	    $imagen = strtolower($imagen);
		@unlink('/SVcontent/producto/turn/'.$imagen);
		@unlink('/SVcontent/producto/med/'.$imagen);
		@unlink('/SVcontent/producto/orig/'.$imagen);


	}

	function borrar_imagenes2($imagen){

	    $imagen = strtolower($imagen);
		@unlink('/SVcontent/contenido/turn/'.$imagen);
		@unlink('/SVcontent/contenido/med/'.$imagen);
		@unlink('/SVcontent/contenido/orig/'.$imagen);


	}


function stripaccents($string){
	return strtr(utf8_decode($string),utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'),
						 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

function limpiarUrl($url){
$url = strtolower($url);
//Rememplazamos caracteres especiales latinos

$find = array('�', '�', '�', '�', '�', '�');

$repl = array('a', 'e', 'i', 'o', 'u', 'n');

$url = str_replace ($find, $repl, $url);

// A�aadimos los guiones

$find = array(' ', '&', '\r\n', '\n', '+');
$url = str_replace ($find, '-', $url);

// Eliminamos y Reemplazamos dem�s caracteres especiales

$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

$repl = array('', '-', '');

$url = preg_replace ($find, $repl, $url);

return $url;
}

function limpiarUrlBD($nombreCampo){
	return "replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(replace(".$nombreCampo.",' ',''),',',''),'�',''),'!',''),'�',''),'?',''),'(',''),')',''),'.',''),'/',''),'-',''),'+',''),'*','')";
}


function obtenerQueryBusqueda($buscar, $orden, $categoria, $precio){

$catea = " (
	CASE cat_nivel
	WHEN 1 THEN (
		SELECT DISTINCT cont_categoria.nombre
		FROM articulo  INNER JOIN cont_categoria ON (articulo.cat_id = cont_categoria.id)
		WHERE articulo.id = a.id)
	WHEN 2 THEN (
		SELECT DISTINCT concat(c.nombre,' > ',s.nombre)
		FROM articulo p
			INNER JOIN cont_subcategoria s ON (p.cat_id = s.id)
		  	INNER JOIN cont_categoria c ON (s.cat_id = c.id)
		WHERE p.id = a.id)
	ELSE (
		SELECT DISTINCT concat(c.nombre, ' > ', s.nombre,' > ', ss.nombre)
		FROM cont_sub_subcategoria ss
			INNER JOIN cont_subcategoria s ON (ss.sub_id = s.id)
		  	INNER JOIN cont_categoria c ON (s.cat_id = c.id)
		  	INNER JOIN articulo p ON (ss.id = p.cat_id)
		WHERE p.id = a.id)
	END) as categoria";


$catep = " (
	CASE cat_nivel
	WHEN 1 THEN (
		SELECT DISTINCT prod_categoria.nombre
		FROM producto
	  		INNER JOIN prod_categoria ON (producto.cat_id = prod_categoria.id)
		WHERE producto.id = pp.id)
	WHEN 2 THEN (
		SELECT DISTINCT concat(c.nombre,' > ',s.nombre)
		FROM producto p
			INNER JOIN prod_subcategoria s ON (p.cat_id = s.id)
		  	INNER JOIN prod_categoria c ON (s.cat_id = c.id)
		WHERE p.id = pp.id)
	ELSE (
		SELECT DISTINCT concat(c.nombre, ' > ', s.nombre,' > ', ss.nombre)
		FROM prod_sub_subcategoria ss
	  		INNER JOIN prod_subcategoria s ON (ss.sub_id = s.id)
			INNER JOIN prod_categoria c ON (s.cat_id = c.id)
			INNER JOIN producto p ON (ss.id = p.cat_id)
		WHERE p.id = pp.id)
	 END) as categoria";


if(!empty($orden))  $orden = " order by ".$orden;
else  $orden = " order by titulo asc ";

$queryProductos = "select id,nombre as titulo,(select ruta from imagen_producto where prod_id = pp.id limit 1) as imagen,resumen,DATE_FORMAT(fecha_mod,'%d/%m/%Y %H:%i') as fecha,fecha_mod,"
		.$catep.",'prod' as tipo"
		." from producto pp"
		." where (nombre like '%".$buscar."%' or resumen like '%".$buscar."%') and stock >0 and activo = 1";

$queryArticulos = "select id,titulo,imagen,resumen,DATE_FORMAT(fecha_mod,'%d/%m/%Y %H:%i') as fecha,fecha_mod,".$catea.","
		." 'art' as tipo"
		." from articulo a"
		." where (titulo like '%".$buscar."%' or resumen like '%".$buscar."%') and estatus = 1 ";

		if (isset($categoria)){
			if (substr($categoria, 0, 4)=='prod'){
				$categoria = substr($categoria, 5);
				$query = " select * from (".$queryProductos." and cat_id='".$categoria."' ) consulta ".$orden;
			}else if (substr($categoria, 0, 4)=='arti'){
				$categoria = substr($categoria, 5);
				$query = " select * from (".$queryArticulos." and cat_id='".$categoria."' ) consulta ".$orden;
			}else{
				if (isset($precio)){
					if (substr($categoria, 0, 1)=="#"){
						$query = " select * from ((".$queryArticulos.")union(".$queryProductos.")) consulta ".$orden;
					}else{
						$query = " select * from (".$queryProductos.") consulta ".$orden;
					}
				}
			}
		}else if (isset($precio)){
			if (substr($categoria, 0, 1)=="#"){
				$query = " select * from ((".$queryArticulos.")union(".$queryProductos.")) consulta ".$orden;
			}else{
				$query = " select * from (".$queryProductos.") consulta ".$orden;
			}
		}else{
			$query = " select * from ((".$queryArticulos.")union(".$queryProductos.")) consulta ".$orden;
		}

return $query;
}

function obtenerQueryBusquedaV2($buscar, $orden, $categoria, $precio){

if (!empty($categoria)){
	if (substr($categoria, 0,5)=="prod-"){
	       	$tipoCategoria="p";
	        $nivelCategoria = substr($categoria, 5,1);
	        $valorCategoria = substr($categoria, 7);
	        $queryCategoria = " and cat_nivel='".$nivelCategoria."' and cat_id='".$valorCategoria."' ";
	}else if (substr($categoria, 0,5)=="arti-"){
	       	$tipoCategoria="a";
	        $nivelCategoria = substr($categoria, 5,1);
	        $valorCategoria = substr($categoria, 7);
	        $queryCategoria = " and cat_nivel='".$nivelCategoria."' and cat_id='".$valorCategoria."' ";
	}else{

	}
}

if (!empty($precio)){
	if (strpos($precio, "-")>0){
	        $maximo = substr(strrchr($precio, "-"), 1);
	        $minimo = substr($precio, 0, strpos($precio, '-'));
	        $queryPrecio = " and precio between ".$minimo." and ".$maximo." ";
           }
}

if(!empty($orden))  $orden = " order by ".$orden;
else  $orden = " order by titulo asc ";

$queryProductos = "select id,nombre as titulo,(select ruta from imagen_producto where prod_id = pp.id limit 1) as imagen,resumen,DATE_FORMAT(fecha_mod,'%d/%m/%Y %H:%i') as fecha,fecha_mod,'prod' as tipo, precio"
		." from producto pp"
		." where (nombre like '%".$buscar."%' or resumen like '%".$buscar."%' or descripcion like '%".$buscar."%') ".$queryCategoria." ".$queryPrecio." and stock >0 and activo = 1";

$queryArticulos = "select id,titulo,imagen,resumen,DATE_FORMAT(fecha_mod,'%d/%m/%Y %H:%i') as fecha,fecha_mod, 'art' as tipo, 0 as precio"
		." from articulo a"
		." where (titulo like '%".$buscar."%' or resumen like '%".$buscar."%' or texto like '%".$buscar."%') ".$queryCategoria." and estatus = 1 ";

if ($tipoCategoria=='p'){
	return $queryProductos;
}else if ($tipoCategoria=='a'){
	return $queryArticulos;
}

$query = " select * from ((".$queryArticulos.")union(".$queryProductos.")) consulta ".$orden;

return $query;
}
}
?>