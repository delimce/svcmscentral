<?php
includeCommonClass('tools');
includeCommonClass('funciones');

if (!class_exists('widget')) {
	includeCommonClass('widget');
}

if (!class_exists('articulo')) {
	includeCommonClass('articulo');
}

if (!class_exists('producto')) {
	includeCommonClass('producto');
}

/**
 *
 * Clase para presentar los listados en la página.
 * <br>Estan los listados tanto para artículos como para productos y se pueden usar combinados o separados
 * <br>Cada listado tiene parametros que lo configuran, sin embargo los parametros de la clase, tanto los propios
 * como los heredados de widget aplican para todos los métodos, según el caso en algunos pueden tener o no significado
 * @author Luis Poggi
 * @package svcms2
 * @subpackage widget
 */
class simpleList extends widget{
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $formatoTitulo;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $titulo;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $formatoPresentacionHoja;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $autorArticulo;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $funciones;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $maxElementos;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $tagInterno;
	/**
	 * Articulo en el widget
	 * @var articulo
	 */
	var $articulo;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $categoria;
	/**
	 * Enter description here ...
	 * @var producto
	 */
	var $producto;

	/**
	 *
	 * Constructor. Permite instanciar el widget.
	 *
	 */
	function __construct (){
		$this->autorArticulo="1";
		$this->maxElementos=3;
		$this->formatoPresentacion="SVwidgets/SimpleList/formato.php";
		$this->formatoTitulo="SVwidgets/SimpleList/formato-titulo.php";
		$this->funciones = new funciones();
		$this->tagInterno = "<element/>";
		$this->articulo= new articulo();
		$this->producto = new producto();
		$this->categoria = new categoria();
	}

	/**
	 *
	 * Sirve para obtener un listado de articulos dado un query específico.
	 * <br>Su uso no se recomienda, ha sido creado para ser usado por métodos de la clase que enmascaren los querys.
	 * @param String $titulo, titulo del widget a mostrar en la página
	 * @param String $query, query directo a la base de datos
	 * @param Number $maxResults, número máximo de resultados que se van a presentar
	 * @access private
	 */
	function listarArticulosByQuery($titulo, $query, $maxResults){
		$this->articulo->setRutaBase($this->rutaBase);
		$items = $this->articulo->obtenerArticulosByQuery($query, $maxResults);
		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){
				if ($titulo!="NO"){	$datos['titulo'] = utf8_encode($titulo);}
				else{$datos['titulo'] = utf8_encode($this->titulo);}
				include $this->formatoTitulo;
			}
			foreach($items as $datos){
				include $this->formatoPresentacion;
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
	}

	/**
	 * Permite mostrar los artículos dadas unas condiciones específicas
	 * <br>Su uso no se recomienda, ha sido creado para ser usado por métodos de la clase que enmascaren los querys.
	 * @param String $titulo, titulo del widget a ser mostrado en el site
	 * @param String $condiciones, condiciones del query para la base de datos
	 * @param String $orderBy, campos de la base de datos por los cuales se va a ordenar el listado
	 * @param Number $maxResults, número máximo de resultados que se van a presentar,
	 * si no se indica el valor se asume valor por defecto = 0 (es decir, muestra todos los resultados que se obtengan)
	 * @access private
	 */
	function listarArticulos($titulo="NO", $condiciones="", $orderBy="", $maxResults=0){
		$this->articulo->setRutaBase($this->rutaBase);
		$articulos = $this->articulo->obtenerArticulos($condiciones, $orderBy, $maxResults);
		if(count($articulos)>0){
			if ($this->formatoTitulo!="NO"){
				$datos = $articulos;
				if ($titulo!="NO"){	$datos['titulo'] = utf8_encode($titulo);}
				else{$datos['titulo'] = utf8_encode($this->titulo);}
				include $this->formatoTitulo;
			}
			unset($articulos['categoria']);
			foreach($articulos as $datos){
				$articulo = $datos['articulo'];
				include $this->formatoPresentacion;
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
	}

	/**
	 * Permite listar los articulos destacados del site. Utiliza las siguientes variables
	 * <ul>
	 * <li>titulo, Si no esta configurado toma el valor por defecto "Artículos Destacados", si se coloca como valor "NO", no se carga ningun valor
	 * <li>autorArticulo, Si no esta configurado toma el valor por defecto "1"
	 * <li>rutaBase, permite configurar la ruta desde donde se toman las imagenes
	 * <li>formatoPresentacion, ubicación del archivo de presentación de los articulos encontrados
	 * <li>formatoSinResultados, ubicación del archivo de presentación cuando no hay resultados encontrados
	 * <li>formatoTitulo, ubicación del archivo de presentación del titulo de los articulos. Si se coloca como valor "NO", no se muestra el formato
	 * </ul>
	 * <br>La forma estándar de colocar el widget es como sigue
	 * <code>
	 * $widget = new simpleList();
	 * $widget->formatoPresentacion="SVwidgets/SimpleList/formato-articulo.php";
	 * $widget->formatoTitulo="SVwidgets/SimpleList/formato-titulo.php";
	 * $widget->titulo="Articulos Destacados";
	 * $widget->rutaBase = $DOMINIOSV;
	 * $widget->articulosDestacados();
	 * </code>
	 * <br>Si se quiere indicar el máximo número de resultados
	 * <code>
	 * $widget = new simpleList();
	 * $widget->formatoPresentacion="SVwidgets/SimpleList/formato-articulo.php";
	 * $widget->formatoTitulo="SVwidgets/SimpleList/formato-titulo.php";
	 * $widget->titulo="Articulos Destacados Maximo 1";
	 * $widget->rutaBase = $DOMINIOSV;
	 * $widget->articulosDestacados(1);    //El valor 1 indica que solo se muestre un resultado
	 * </code>
	 * @example ArticulosDestacados.php Ejemplo de uso de los articulos Destacados
	 * @example ArticulosDestacadosCombinados.php Ejemplo de uso de los articulos Destacados
	 * @example formato-articulo.php Ejemplo de formato del articulo destacado
	 * @example formato-titulo.php Ejemplo de formato del titulo del widget
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacados.php Véalo en funcionamiento! Varios Tipos
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacadosCombinados.php Véalo en funcionamiento! Tipos Combinados
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacadosSinResultados.php Véalo en funcionamiento! Sin Resultados
	 * @param $maxResults Número máximo de resultados que se desea colocar, si no se coloca o se coloca 0 se muestran todos los resultados
	 */
	function articulosDestacados($maxResults=0){
		if (!isset($this->titulo)){	$this->titulo = " Artículos Destacados"; 	}
		$condiciones = " autor='".$this->autorArticulo."' ";
		$this->listarArticulos($this->titulo, $condiciones,"",$maxResults);
	}

	/**
	 * Permite obtener los articulos en una categoría específica. Utiliza las siguientes variables
	 * <ul>
	 * <li>titulo, Si no esta configurado toma el valor por defecto "Artículos Destacados", si se coloca como valor "NO", no se carga ningun valor
	 * <li>rutaBase, permite configurar la ruta desde donde se toman las imagenes
	 * <li>formatoPresentacion, ubicación del archivo de presentación de los articulos encontrados
	 * <li>formatoSinResultados, ubicación del archivo de presentación cuando no hay resultados encontrados
	 * <li>formatoTitulo, ubicación del archivo de presentación del titulo de los articulos. Si se coloca como valor "NO", no se muestra el formato
	 * </ul>
	 * <br>La forma estándar de colocar el widget es como sigue
	 * <code>
	 * $widget = new simpleList();
	 * $widget->formatoPresentacion="SVwidgets/SimpleList/formato-articulo.php";
	 * $widget->formatoTitulo="SVwidgets/SimpleList/formato-titulo.php";
	 * $widget->titulo="Articulos de una categoría específica (FAQ)";
	 * $widget->rutaBase = $DOMINIOSV;
	 * $widget->articulosEnCategoria($catId, $nivel);
	 * </code>
	 * <br>Si se quiere indicar el máximo número de resultados
	 * <code>
	 * $widget = new simpleList();
	 * $widget->formatoPresentacion="SVwidgets/SimpleList/formato-articulo.php";
	 * $widget->formatoTitulo="SVwidgets/SimpleList/formato-titulo.php";
	 * $widget->titulo="Articulos de una sub categoría específica (El Sistema por dentro) y max results";
	 * $widget->rutaBase = $DOMINIOSV;
	 * $widget->articulosEnCategoria($catId, $nivel, "", 3);
	 * </code>
	 * @example ArticulosEnCategoria.php Muestra los articulos de una categoria
	 * @example formato-articulo.php Ejemplo de formato del articulo
	 * @example formato-titulo.php Ejemplo de formato del titulo del widget
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosEnCategoria.php Véalo en funcionamiento! Varios Tipos
	 * @param Number $catId Identificador de la categoria a mostrar
	 * @param Number $nivel Nivel de la categoria a mostrar
	 * @param String $orderBy campos separados por coma por los cuales se va a ordenar el resultado, si no se configura ninguno
	 * se ordena por orden, titulo, id
	 * @param Number $maxResults maximo numero de resultados a mostrar. Si se coloca 0 (o no se coloca nada) salen todos los resultados posibles
	 */
	function articulosEnCategoria($catId, $nivel, $orderBy="", $maxResults=0){
		if (!isset($this->titulo)){ $this->titulo = "Artículos en Categorías"; }
		if (isset($catId) && isset($nivel)){ $condiciones = " cat_nivel=".$nivel." and cat_id='".$catId."' "; }
		if (isset($this->formatoPresentacionHoja)){
			$formato = $this->formatoPresentacion;
			$this->formatoPresentacion = $this->formatoPresentacionHoja;
			$this->listarArticulos($this->titulo, $condiciones, $orderBy, $maxResults);
			$this->formatoPresentacion = $formato;
		}else{
			$this->listarArticulos($this->titulo, $condiciones, $orderBy, $maxResults);
		}
	}

	/**
	 * Permite obtener las categorias hija de una categoría.
	 * @param unknown_type $catId
	 * @param unknown_type $nivel
	 * @param unknown_type $orderBy
	 * @param unknown_type $maxResults
	 */
	function categoriasEnCategoria($catId, $nivel, $orderBy="", $maxResults=0){
		if (!isset($this->titulo)){ $this->titulo = "Categorias en Categorías"; }
		$this->categoria->setRutaBase($this->rutaBase);
		$categorias = $this->categoria->obtenerSubCategorias($catId, $nivel);
		if(count($categorias)>0){
			$datos = $categorias;
			if ($this->formatoTitulo!="NO"){
				if ($titulo!="NO"){	$datos['titulo'] = utf8_encode($titulo);}
				else{$datos['titulo'] = utf8_encode($this->titulo);}
				include $this->formatoTitulo;
			}
			unset($categorias['categoria']);
			foreach($categorias as $datos){
				include $this->formatoPresentacion;
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}

	}

	/**
	 * Permite obtener los articulos mas vistos del site.
	 * @since svcms2 Requiere cambios en la BD para su funcionamiento
	 */
	function articulosMasVistos(){
		if (!isset($this->titulo)){ $this->titulo = "Artículos Mas Vistos"; }
		$condiciones = "";
		$orderBy = " num_visitas desc ";
		$this->listarArticulos($this->titulo, $condiciones, $orderBy, $this->maxElementos);
	}

	/**
	 * Obtiene los articulos relacionados a un artículo específico
	 * @param String $idArticulo Identificador del articulo a buscar sus relacionados
	 * @since svcms2 Requiere cambios en la BD para su funcionamiento
	 */
	function articulosRelacionados($idArticulo){
		if (!isset($this->titulo)){ $this->titulo = "Artículos Relacionados";	}

		$query = "Select id,titulo,imagen,fecha_mod,resumen
	from articulo p inner join
    (select count(idElemento) cuenta,idElemento from tag_x_elemento where idelemento!='".$idArticulo."' and idtag in
    (select idtag from tag_x_elemento where tipoElemento='art' and idElemento='".$idArticulo."')
    group by idElemento) e on p.id = e.idElemento
    order by cuenta desc";
		$this->listarArticulosByQuery($this->titulo, $query, $this->maxElementos);
	}


	/**
	 * Permite encontrar las categorias y subcategorias de articulos que están configuradas.
	 * Según las configuraciones se muestran mas o menos niveles de categorias y los articulos de la misma.
	 * Además de los parámetros toma en cuenta lo siguientes parametros de la clase
	 * <ul>
	 * <li>formatoPresentacion, formato para las categorías. Se debe colocar en el formato el tag <element/> para indicar donde se quieren los hijos.
	 * <li>formatoPresentacionHoja, formato del último nivel del widget. Si se configura para mostrarse 4 niveles, pero en el nivel 2
	 * alguna categoría no tiene mas hijos, los articulos (si están configurados para salir) se muestran con este formato
	 * <li>formatoTitulo, formato del titulo del widget
	 * <li>rutaBase, próximo a ser eliminado, indica la ruta base de las imagenes. Se configura con  $DOMINIOSV usualmente
	 * </ul>
	 * En el comportamiento estandar de la función se incluye la revisión de la permisología de las categorías.
	 * <br>Si en la sesión no hay usuario logueado solo se muestran las categorías con only_for=0
	 * <br>Si en la sesión hay un usuario logueado se muestran las categorias con only_for=0,1 y cualquier grupo al cual el pertenezca.
	 * @example menu-categorias-1-nivel.php Categorias de Articulos y Productos de 1 nivel
	 * @example menu-categorias-todas.php Arbol Completo
	 * @example menu-categorias-articulos.php Solo categorias de articulos
	 * @example menu-categorias-combinado.php Categorias de Articulos y Productos en diferentes niveles
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacados.php Véalo en funcionamiento!
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacadosCombinados.php Véalo en funcionamiento!
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacadosSinResultados.php Véalo en funcionamiento!
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosEnCategoria.php Véalo en funcionamiento!
	 * @param Number $nivel Determina el nivel de categorias que se muestran
	 * @param boolean $mostrarArticulos Indica si se muestran los articulos en el nivel final. Acepta los valores siguientes
	 * <b>true para mostrarlos</b>,
	 * <b>false para no mostrarlos</b>
	 * @param boolean $incluirGeneral Indica si se muestra la categoria de articulos #1, la de información General. Acepta los valores siguientes
	 * <b>true para mostrarla</b>,
	 * <b>false para no mostrarla</b>
	 */
	function categoriasDeArticulos($nivel=1,$mostrarArticulos=true,$incluirGeneral=true){
		if (!isset($this->titulo)){
			$datos['titulo'] = "Categoría de Articulos";
		}
		$SWSLcat = new formulario('db');
		$categoriasExcluidas = "('0'".($incluirGeneral?'':',1').")";

		if(empty($_SESSION['CLIENTE_ID'])){
			$extra1 = "where c.id not in ".$categoriasExcluidas." and c.only_for = 0";
		}else{
			$extra1 = "where c.id not in ".$categoriasExcluidas." and c.only_for in (0,1";
			/** Aqui colocar la identiciacion de categorias extras excluidas según el perfil del cliente **/

			$queryCats = 'SELECT '
			.'  cc1.id as idCategoria1, c.categoria1 '
			.', cc2.id as idCategoria2, c.categoria2 '
			.', cc3.id as idCategoria3, c.categoria3 '
			.', cc4.id as idCategoria4, c.categoria4 '
			.', cc5.id as idCategoria5, c.categoria5 '
			.'FROM cliente c '
			.'left join ( cliente_categoria cc1) ON (c.categoria1=cc1.nombre ) '
			.'left join ( cliente_categoria cc2) ON (c.categoria2=cc2.nombre ) '
			.'left join ( cliente_categoria cc3) ON (c.categoria3=cc3.nombre ) '
			.'left join ( cliente_categoria cc4) ON (c.categoria4=cc4.nombre ) '
			.'left join ( cliente_categoria cc5) ON (c.categoria5=cc5.nombre ) '
			.'WHERE c.id='.$_SESSION['CLIENTE_ID'].' ';

			$extraCats = $SWSLcat->estructura_db($queryCats);

			$idCategoriaExtra1 = $extraCats[0]['idCategoria1'];
			$idCategoriaExtra2 = $extraCats[0]['idCategoria2'];
			$idCategoriaExtra3 = $extraCats[0]['idCategoria3'];
			$idCategoriaExtra4 = $extraCats[0]['idCategoria4'];
			$idCategoriaExtra5 = $extraCats[0]['idCategoria5'];

			if (!empty ($idCategoriaExtra1)) $extra1.= ', '.$idCategoriaExtra1;
			if (!empty ($idCategoriaExtra2)) $extra1.= ', '.$idCategoriaExtra2;
			if (!empty ($idCategoriaExtra3)) $extra1.= ', '.$idCategoriaExtra3;
			if (!empty ($idCategoriaExtra4)) $extra1.= ', '.$idCategoriaExtra4;
			if (!empty ($idCategoriaExtra5)) $extra1.= ', '.$idCategoriaExtra5;

			$extra1 .= " ) ";
		}

		$queryCategorias = "SELECT id, nombre, imagen,descrip AS resumen, only_for FROM cont_categoria c ".$extra1." ORDER BY orden ";
		$items = $SWSLcat->estructura_db($queryCategorias);

		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){ $datos['titulo'] = utf8_encode($datos['titulo']); $this->formatoTitulo; }
			foreach($items as $item){
				$linkCat = 'SV-listado-categorias-art.php?nivel=1&catid=';
				$linkArt = 'SV-listado-articulos.php?nivel=1&catid=';
				$datos['id'] = $item['id'];
				$datos['nombre'] = utf8_encode($item['nombre']);
				$only = utf8_encode($item['only_for']);
				$datos['resumen'] = utf8_encode(substr($item['resumen'],0,512));
				$sitems = $SWSLcat->estructura_db($sql = "SELECT id FROM articulo WHERE cat_nivel=1 AND cat_id = ".$item['id']." AND estatus = 1 order by orden");
				$subCats = $SWSLcat->simple_db("select count(*) as cuenta from cont_subcategoria c where cat_id = '".$datos['id']."' ");
				$datos['link'] = count($sitems)==0?$linkCat:$linkArt;
				$datos['link'] = $datos['link'].$datos['id'];
				$datos['nivelCategoria']=1;
				$existeImagen = !empty($item['imagen']);
				if ($existeImagen){
					$datos['srcImg'] = $this->rutaBase.'/categoria/turn/'.$item['imagen'];
				}else{
					$datos['srcImg'] = $this->rutaBase.'/categoria/orig/noimagen.jpg';
				}
				if ($nivel>1){
					if ($subCats['cuenta']>0){
						$datos['tiene_hijos']="SI";
					}elseif (count($sitems)>0 && $mostrarArticulos){
						$datos['tiene_hijos']="SI";
					}else{
						$datos['tiene_hijos']="NO";
					}
				}else{
					$datos['tiene_hijos']="NO";
				}
				if ($only=="0"){ //valido para todos
					includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);
					if ($datos['tiene_hijos']=="SI"){
						if ($nivel>1){
							if (count($sitems)==0){
								$this->subCategoriasDeArticulos($datos['id'],$nivel,$mostrarArticulos);
							}elseif ($mostrarArticulos && count($sitems)>0){
								$this->articulosEnCategoria($datos['id'], 1);
							}else{

							}
						}
					}
					includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
				}else if (($only!="0") && (isset($_SESSION['CLIENTE_ID']))){  //valido para clientes registrados
					includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);
					if ($datos['tiene_hijos']=="SI"){
						if ($nivel>1){
							if (count($sitems)==0){
								$this->subCategoriasDeArticulos($datos['id'],$nivel,$mostrarArticulos);
							}elseif ($mostrarArticulos && count($sitems)>0){
								$this->articulosEnCategoria($datos['id'], 1);
							}else{

							}
						}
					}
					includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
					//                }else if (){ //valido para una categora especfica
				}else {
					//No se muestra esta categoria
				}
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
		$SWSLcat->cerrar();
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $catId
	 * @param unknown_type $nivel
	 * @param unknown_type $mostrarArticulos
	 * @access private
	 * @return number
	 */
	function subCategoriasDeArticulos($catId, $nivel, $mostrarArticulos=true){
		if (!isset($this->titulo)){
			$datos['titulo'] = "Sub Categoría de Artículos";
		}
		$SWSLscat = new formulario('db');

		$querySubCategorias = "select 'arti' as tipo, id, imagen, nombre, descrip as resumen from cont_subcategoria c where cat_id = '$catId' order by orden";
		$items = $SWSLscat->estructura_db($querySubCategorias);

		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){ $datos['titulo'] = utf8_encode($datos['titulo']); $this->formatoTitulo; }
			foreach($items as $item){
				$linkCat = 'SV-listado-categorias-art.php?nivel=1&catid=';
				$linkArt = 'SV-listado-articulos.php?nivel=2&catid=';
				$datos['id'] = $item['id'];
				$datos['nombre'] = utf8_encode($item['nombre']);
				$datos['resumen'] = utf8_encode(substr($item['resumen'],0,512));
				$sitems = $SWSLscat->estructura_db($sql = "SELECT id FROM articulo WHERE cat_nivel=2 AND cat_id = ".$item['id']." AND estatus = 1 order by orden");
				$subCats = $SWSLscat->simple_db("select count(*) cuenta from cont_sub_subcategoria c where sub_id = '".$datos['id']."' ");
				$datos['link'] = count($sitems)==0?$linkCat:$linkArt;
				$datos['link'] = $datos['link'].$datos['id'];
				$datos['nivelCategoria']=2;
				$existeImagen = !empty($item['imagen']);
				if ($existeImagen){
					$datos['srcImg'] = $this->rutaBase.'/categoria/turn/'.$item['imagen'];
				}else{
					$datos['srcImg'] = $this->rutaBase.'/categoria/orig/noimagen.jpg';
				}

				if ($nivel>2){
					if ($subCats['cuenta']>0){
						$datos['tiene_hijos']="SI";
					}elseif (count($sitems)>0 && $mostrarArticulos){
						$datos['tiene_hijos']="SI";
					}else{
						$datos['tiene_hijos']="NO";
					}
				}else{
					$datos['tiene_hijos']="NO";
				}

				includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);
				if ($datos['tiene_hijos']=="SI"){

					if ($nivel>2){
						if (count($sitems)==0){
							$this->subSubCategoriasDeArticulos($datos['id'],$nivel,$mostrarArticulos);
						}elseif ($mostrarArticulos){
							$this->articulosEnCategoria($datos['id'], 2);
						}else{

						}
					}
				}
				includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
		$SWSLscat->cerrar();
		return count($items);
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $catId
	 * @param unknown_type $nivel
	 * @param unknown_type $mostrarArticulos
	 * @access private
	 */
	function subSubCategoriasDeArticulos($catId, $nivel, $mostrarArticulos=true){
		if (!isset($this->titulo)){
			$datos['titulo'] = "Sub Categoría de Artículos";
		}
		$SWSLsscat = new formulario('db');

		$querySubCategorias = "select 'arti' as tipo, id, imagen, nombre, descrip as resumen from cont_sub_subcategoria c where sub_id = '$catId' order by orden";
		$items = $SWSLsscat->estructura_db($querySubCategorias);

		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){ $datos['titulo'] = utf8_encode($datos['titulo']); $this->formatoTitulo; }
			foreach($items as $item){
				$linkCat = 'SV-listado-categorias-art.php?nivel=3&catid=';
				$linkArt = 'SV-listado-articulos.php?nivel=3&catid=';
				$datos['id'] = $item['id'];
				$datos['nombre'] = utf8_encode($item['nombre']);
				$datos['resumen'] = utf8_encode(substr($item['resumen'],0,512));
				$sitems = $SWSLsscat->estructura_db($sql = "SELECT id FROM articulo WHERE cat_nivel=3 AND cat_id = ".$item['id']." AND estatus = 1 order by orden");
				$datos['link'] = count($sitems)==0?$linkCat:$linkArt;
				$datos['link'] = $datos['link'].$datos['id'];
				$datos['nivelCategoria']=3;
				$existeImagen = !empty($item['imagen']);
				if ($existeImagen){
					$datos['srcImg'] = $this->rutaBase.'/categoria/turn/'.$item['imagen'];
				}else{
					$datos['srcImg'] = $this->rutaBase.'/categoria/orig/noimagen.jpg';
				}
				if ($nivel>3 && count($sitems)>0 && $mostrarArticulos){
					$datos['tiene_hijos']="SI";
				}else{
					$datos['tiene_hijos']="NO";
				}


				includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);
				if ($datos['tiene_hijos']=="SI"){

					if ($nivel>3){
						if ($mostrarArticulos && count($sitems)>=0){
							$this->articulosEnCategoria($datos['id'], 3);
						}else{

						}
					}
				}
				includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
		$SWSLsscat->cerrar();
	}


	/**
	 * Permite encontrar las categorias y subcategorias de productos que están configuradas.
	 * Según las configuraciones se muestran mas o menos niveles de categorias y los productos de la misma.
	 * Además de los parámetros toma en cuenta lo siguientes parametros de la clase
	 * <ul>
	 * <li>formatoPresentacion, formato para las categorías. Se debe colocar en el formato el tag <element/> para indicar donde se quieren los hijos.
	 * <li>formatoPresentacionHoja, formato del último nivel del widget. Si se configura para mostrarse 4 niveles, pero en el nivel 2
	 * alguna categoría no tiene mas hijos, los productos (si están configurados para salir) se muestran con este formato
	 * <li>formatoTitulo, formato del titulo del widget
	 * <li>rutaBase, próximo a ser eliminado, indica la ruta base de las imagenes. Se configura con  $DOMINIOSV usualmente
	 * </ul>
	 * @example menu-categorias-1-nivel.php Categorias de Articulos y Productos de 1 nivel
	 * @example menu-categorias-todas.php Arbol Completo
	 * @example menu-categorias-productos.php Solo categorias de productos
	 * @example menu-categorias-combinado.php Categorias de Articulos y Productos en diferentes niveles
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacados.php Véalo en funcionamiento!
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacadosCombinados.php Véalo en funcionamiento!
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosDestacadosSinResultados.php Véalo en funcionamiento!
	 * @link http://common.svcmscentral.com/SVwidgets/SimpleList/examples/ArticulosEnCategoria.php Véalo en funcionamiento!
	 * @param Number $nivel Determina el nivel de categorias que se muestran
	 * @param boolean $mostrarProductos Indica si se muestran los productos en el nivel final. Acepta los valores siguientes:
	 * <b>true para mostrarlos</b>,
	 * <b>false para no mostrarlos</b>
	 */
		function categoriasDeProductos($nivel=1,$mostrarProductos=true){
		if (!isset($this->titulo)){
			$this->titulo = "Categoria de productos";
		}
		$SWSLprod = new formulario('db');

		$items = $SWSLprod->estructura_db("SELECT id, nombre, imagen,descrip AS resumen, only_for FROM prod_categoria ORDER BY orden ");
		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){ $datos['titulo'] = utf8_encode($this->titulo); include $this->formatoTitulo; }
			foreach($items as $item){
				$linkCats = 'SV-listado-categorias.php?nivel=1&catid='.$item['id'];
				$linkProds = 'SV-listado-productos.php?nivel=1&catid='.$item['id'];
				$datos['id'] = $item['id'];
				$datos['nombre'] = utf8_encode($item['nombre']);
				$datos['resumen'] = utf8_encode(substr($item['resumen'],0,512));
				$sitems = $SWSLprod->estructura_db($sql = "SELECT id FROM producto WHERE cat_nivel=1 AND cat_id = ".$item['id']." AND activo = 1  order by orden");
				$subCats = $SWSLprod->simple_db("select count(*) as cuenta from prod_subcategoria c where cat_id = '".$datos['id']."' ");
				$datos['link'] = count($sitems)==0?$linkCats:$linkProds;
				$datos['nivelCategoria']=1;
				$existeImagen = !empty($item['imagen']);
				if ($existeImagen){
					$datos['srcImg'] = $this->rutaBase.'/categoria/turn/'.$item['imagen'];
				}else{
					$datos['srcImg'] = $this->rutaBase.'/categoria/orig/noimagen.jpg';
				}
				if ($nivel>1){
					if ($subCats['cuenta']>0){
						$datos['tiene_hijos']="SI";
					}elseif (count($sitems)>0 && $mostrarProductos){
						$datos['tiene_hijos']="SI";
					}else{
						$datos['tiene_hijos']="NO";
					}
				}else{
					$datos['tiene_hijos']="NO";
				}
				$only = $item['only_for'];
				if ($only=="0"){ //valido para todos
					includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);
					if ($datos['tiene_hijos']=="SI"){
						if ($nivel>1){
							if (count($sitems)==0){
								$this->subCategoriasDeProductos($datos['id'],$nivel,$mostrarProductos);
							}elseif ($mostrarProductos && count($sitems)>0){
								$this->productosEnCategoria($datos['id'], 1);
							}else{

							}
						}
					}
					includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
				}else if (($only=="1") && (isset($_SESSION['CLIENTE_ID']))){  //valido para clientes registrados
					includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);
					if ($datos['tiene_hijos']=="SI"){
						if ($nivel>1){
							if (count($sitems)==0){
								$this->subCategoriasDeProductos($datos['id'],$nivel,$mostrarProductos);
							}elseif ($mostrarProductos && count($sitems)>0){
								$this->productosEnCategoria($datos['id'], 1);
							}else{

							}
						}
					}
					includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
					//                }else if (){ //valido para una categora especfica

				}else {
					//No se muestra esta categoria
				}
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
		$SWSLprod->cerrar();
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $catId
	 * @param unknown_type $nivel
	 * @param unknown_type $mostrarProductos
	 * @return number
	 * @access private
	 */
	function subCategoriasDeProductos($catId, $nivel, $mostrarProductos=true){
		if (!isset($this->titulo)){
			$datos['titulo'] = "Sub Categoría de Productos";
		}
		$SWSLscat = new formulario('db');

		$querySubCategorias = "select 'prod' as tipo, id, imagen, nombre, descrip as resumen from prod_subcategoria c where cat_id = '$catId' order by orden";
		$items = $SWSLscat->estructura_db($querySubCategorias);

		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){ $datos['titulo'] = utf8_encode($datos['titulo']); $this->formatoTitulo; }
			foreach($items as $item){
				$linkCat = 'SV-listado-categorias.php?nivel=1&catid=';
				$linkArt = 'SV-listado-productos.php?nivel=2&catid=';
				$datos['id'] = $item['id'];
				$datos['nombre'] = utf8_encode($item['nombre']);
				$datos['resumen'] = utf8_encode(substr($item['resumen'],0,512));
				$sitems = $SWSLscat->estructura_db($sql = "SELECT id FROM producto WHERE cat_nivel=2 AND cat_id = ".$item['id']." AND stock>0 order by orden");

				$subCats = $SWSLscat->simple_db("select count(*) cuenta from prod_sub_subcategoria c where sub_id = '".$datos['id']."' ");
				$datos['link'] = count($sitems)==0?$linkCat:$linkArt;
				$datos['link'] = $datos['link'].$datos['id'];
				$datos['nivelCategoria']=2;
				$existeImagen = !empty($item['imagen']);
				if ($existeImagen){
					$datos['srcImg'] = $this->rutaBase.'/categoria/turn/'.$item['imagen'];
				}else{
					$datos['srcImg'] = $this->rutaBase.'/categoria/orig/noimagen.jpg';
				}

				if ($nivel>2){
					if ($subCats['cuenta']>0){
						$datos['tiene_hijos']="SI";
					}elseif (count($sitems)>0 && $mostrarProductos){
						$datos['tiene_hijos']="SI";
					}else{
						$datos['tiene_hijos']="NO";
					}
				}else{
					$datos['tiene_hijos']="NO";
				}

				includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);

				if ($datos['tiene_hijos']=="SI"){

					if ($nivel>2){
						if (count($sitems)==0){
							$this->subSubCategoriasDeProductos($datos['id'],$nivel,$mostrarProductos);
						}elseif ($mostrarProductos){
							$this->productosEnCategoria($datos['id'], 2);
						}else{

						}
					}
				}
				includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
		$SWSLscat->cerrar();
		return count($items);
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $catId
	 * @param unknown_type $nivel
	 * @param unknown_type $mostrarProductos
	 * @access private
	 */
	function subSubCategoriasDeProductos($catId, $nivel, $mostrarProductos=true){
		if (!isset($this->titulo)){
			$datos['titulo'] = "Sub Categoría de Artículos";
		}
		$SWSLsscat = new formulario('db');

		$querySubCategorias = "select 'prod' as tipo, id, imagen, nombre, descrip as resumen from prod_sub_subcategoria c where sub_id = '$catId' order by orden";
		$items = $SWSLsscat->estructura_db($querySubCategorias);

		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){ $datos['titulo'] = utf8_encode($datos['titulo']); $this->formatoTitulo; }
			foreach($items as $item){
				$linkCat = 'SV-listado-categorias.php?nivel=3&catid=';
				$linkArt = 'SV-listado-productos.php?nivel=3&catid=';
				$datos['id'] = $item['id'];
				$datos['nombre'] = utf8_encode($item['nombre']);
				$datos['resumen'] = utf8_encode(substr($item['resumen'],0,512));
				$sitems = $SWSLsscat->estructura_db($sql = "SELECT id FROM producto WHERE cat_nivel=3 AND cat_id = ".$item['id']." AND stock > 0 order by orden");
				$datos['link'] = count($sitems)==0?$linkCat:$linkArt;
				$datos['link'] = $datos['link'].$datos['id'];
				$datos['nivelCategoria']=3;
				$existeImagen = !empty($item['imagen']);
				if ($existeImagen){
					$datos['srcImg'] = $this->rutaBase.'/categoria/turn/'.$item['imagen'];
				}else{
					$datos['srcImg'] = $this->rutaBase.'/categoria/orig/noimagen.jpg';
				}
				if ($nivel>3 && count($sitems)>0 && $mostrarProductos){
					$datos['tiene_hijos']="SI";
				}else{
					$datos['tiene_hijos']="NO";
				}


				includeInnerElementInit($this->formatoPresentacion,$this->tagInterno, $datos);
				if ($datos['tiene_hijos']=="SI"){

					if ($nivel>3){
						if ($mostrarProductos && count($sitems)>=0){
							$this->productosEnCategoria($datos['id'], 3);
						}else{

						}
					}
				}
				includeInnerElementEnd($this->formatoPresentacion,$this->tagInterno, $datos);
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
		$SWSLsscat->cerrar();
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $titulo
	 * @param unknown_type $query
	 * @param unknown_type $maxResults
	 * @access private
	 */
	function listarProductosByQuery($titulo, $query, $maxResults){
		$this->producto->setRutaBase($this->rutaBase);
		$items = $this->producto->obtenerProductosByQuery($query, $maxResults);
		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){
				if ($titulo!="NO"){	$datos['titulo'] = utf8_encode($titulo);}
				else{$datos['titulo'] = utf8_encode($this->titulo);}
				include $this->formatoTitulo;
			}
			foreach($items as $datos){
				include $this->formatoPresentacion;
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $titulo
	 * @param unknown_type $condiciones
	 * @param unknown_type $orderBy
	 * @param unknown_type $maxResults
	 * @access private
	 */
	function listarProductos($titulo="NO", $condiciones="", $orderBy="", $maxResults=0){
		$this->producto->setRutaBase($this->rutaBase);
		$items = $this->producto->obtenerProductos($condiciones, $orderBy, $maxResults);
		if(count($items)>0){
			if ($this->formatoTitulo!="NO"){
				if ($titulo!="NO"){	$datos['titulo'] = utf8_encode($titulo);}
				else{$datos['titulo'] = utf8_encode($this->titulo);}
				include $this->formatoTitulo;
			}
			foreach($items as $datos){
				include $this->formatoPresentacion;
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $catId
	 * @param unknown_type $nivel
	 * @param unknown_type $orderBy
	 * @param unknown_type $maxResults
	 */
	function productosEnCategoria($catId, $nivel, $orderBy="", $maxResults=0){
		if (!isset($this->titulo)){ $this->titulo = "Productos en Categorías"; }
		$condiciones = " cat_nivel=".$nivel." and cat_id='".$catId."' ";
		if (isset($this->formatoPresentacionHoja)){
			$formato = $this->formatoPresentacion;
			$this->formatoPresentacion = $this->formatoPresentacionHoja;
			$this->listarProductos($this->titulo, $condiciones, $orderBy, $maxResults);
			$this->formatoPresentacion = $formato;
		}else{
			$this->listarProductos($this->titulo, $condiciones, $orderBy, $maxResults);
		}
	}

	/**
	 * Enter description here ...
	 */
	function productosDestacados(){
		if (!isset($this->titulo)){$this->titulo= "Productos Destacados"; }
		$condiciones = " destacado='1' ";
		$this->listarProductos($this->titulo, $condiciones);
	}

	/**
	 * Enter description here ...
	 */
	function productosMasVendidos(){
		if (!isset($this->titulo)){$this->titulo= "Productos Mas Vendidos"; }
		$query = "select * from (select producto_id,count(producto_id) from factura_item group by producto_id)a inner join producto p on a.producto_id = p.id";
		$this->listarProductosByQuery($this->titulo, $query, $maxResults);
	}

	/**
	 * Enter description here ...
	 */
	function productosMasVistos(){
		if (!isset($this->titulo)){ $this->titulo = "Productos Mas Vistos"; }
		$condiciones = "";
		$orderBy = " num_visitas desc ";
		$this->listarProductos($this->titulo, $condiciones, $orderBy, $this->maxElementos);
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $idProducto
	 */
	function productosRelacionados($idProducto){
		if (isset($idProducto)){
			if (!isset($this->titulo)){$this->titulo= "Productos Relacionados"; }
			$query = "Select id,nombre,precio,empaque,medidas,peso,stock,fecha_mod,(select ruta from imagen_producto where prod_id = p.id limit 1) as imagen, resumen
	from producto p inner join
    (select count(idElemento) cuenta,idElemento from tag_x_elemento where idelemento!='".$idProducto."' and idtag in
    (select idtag from tag_x_elemento where tipoElemento='prod' and idElemento='".$idProducto."')
    group by idElemento) e on p.id = e.idElemento
    order by cuenta desc";
			$this->listarProductosByQuery($this->titulo, $query, $maxResults);
		}
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $categoria
	 * @param unknown_type $tabla
	 * @param unknown_type $numero
	 * @param unknown_type $orden
	 * @access private
	 * @return string
	 */
	function traer_item_categoria($categoria,$tabla,$numero,$orden){
		if($tabla!="prod"){ $n="titulo as nombre"; $link ="SV-detalle-articulo.php";  $imagen = "imagen";   $tabla = 'articulo'; }else{  $n="nombre"; $link ="SV-detalle-producto.php"; $imagen = "(select ruta from imagen_producto where prod_id = a.id limit 1) as imagen"; $tabla = 'producto'; }
		$carpeta = "contenido";
		if($numero>0) $num = "limit $numero"; else $num = "";
		////para obtener el nivel y el id
		$cati = explode('_',$categoria);
		$query = "select id,$n,resumen,date_format(fecha_mod,'%d/%m%/%Y') as fecha,
		$imagen
			from $tabla a
			where cat_id = '$cati[1]' and cat_nivel = '$cati[0]' order by orden";
		return $query;
	}

	/**
	 * Enter description here ...
	 */
	function elementosEnCategorias(){
		$SWSLAEC = new formulario('db');
		$listadoItems = $SWSLAEC->estructura_db("select * from artxcat order by orden ");
		if(count($listadoItems)>0){
			foreach($listadoItems as $listadoItem){
				$this->titulo = $listadoItem['titulo'];
				$catNivel = $listadoItem['cat'];
				$catId = substr($catNivel,0,strpos($catNivel, "_"));
				$nivel = substr($catNivel,strpos($catNivel, "_")+1);
				$tipo = $listadoItem['fuente'];
				$maxResults = $listadoItem['cantidad'];
				$orden = "orden ".$listadoItem['ordeni'];
				if ($tipo=="cont"){
					$this->articulosEnCategoria($catId, $nivel, $orden, $maxResults);
				}else{
					$this->productosEnCategoria($catId, $nivel, $orden, $maxResults);
				}
			}
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
		$SWSLAEC->cerrar();
	}
}
?>