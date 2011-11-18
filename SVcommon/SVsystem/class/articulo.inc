<?php
includeCommonClass('formulario');
includeCommonClass('funciones');
includeCommonClass('categoria');

/**
 * Clase que representa a los articulos
 * @author Luis Poggi
 * @package svcms2
 * @subpackage elementos
 * @todo Crear CRUD y utilizar la clase para administración del articulo
 */
class articulo{
	/**
	 * Enter description here ...
	 * @var unknown_type
	 * @access private
	 */
	var $activos;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 * @access private
	 */
	var $funciones;
	/**
	 * Enter description here ...
	 * @var unknown_type
	 * @access private
	 */
	var $rutaBase;
	/**
	 * Identificador del articulo
	 * @var String
	 */
	var $id;
	/**
	 * Titulo del articulo
	 * @var String
	 */
	var $titulo;
	/**
	 * Link al articulo
	 * @var String
	 */
	var $link;
	/**
	 * Resumen del articulo (512 caracteres)
	 * @var String
	 */
	var $resumen;
	/**
	 * Resumen completo del articulo
	 * @var String
	 */
	var $resumenCompleto;
	/**
	 * Nonbre de la imagen
	 * @var String
	 */
	var $imagen;
	/**
	 * Fuente de la imagen ya procesada
	 * @var String
	 */
	var $srcImg;
	/**
	 * Ultima fecha de modificacion del articulo
	 * @var DateTime
	 */
	var $fecha_mod;

	function __construct($id="",$titulo="",$resumen="",$imagen="",$fecha_mod="",$rutaBase=""){
		$this->funciones = new funciones();
		$this->rutaBase = $rutaBase;
		$this->id = $id;
		$this->titulo = $titulo;
		$this->link = "/articulo-".$this->funciones->limpiarUrl($this->titulo);
		$this->resumen = utf8_encode(substr($resumen,0,512));
		$this->resumenCompleto = utf8_encode($resumen);
		$this->imagen = $imagen;
		$this->srcImg = $this->rutaBase."/contenido/turn/".utf8_encode($this->imagen);
		$this->fecha_mod = $fecha_mod;
		$this->activos=1;
	}

	/**
	 * 
	 * @param unknown_type $ruta
	 * @access private
	 */
	function setRutaBase($ruta){
		$this->rutaBase = $ruta;
	}

	/**
	 * Permite obtener los articulos dadas las condiciones y ordenamiento
	 * @param String $condiciones
	 * @param String $orderBy
	 * @param Number $maxResults
	 */
	function obtenerArticulos($condiciones="", $orderBy="", $maxResults=0){
		$query = " select id,titulo,imagen,fecha_mod,resumen,cat_id,cat_nivel from articulo ";
		if ($this->activos==1){
			$query.= " where estatus=1 ";
			if ((isset($condiciones)) && $condiciones!=''){
				$query.= " and ".$condiciones;
			}
		}else{
			if ((isset($condiciones)) && $condiciones!=''){
				$query.= " where ".$condiciones;
			}
		}

		if ((isset($orderBy)) && $orderBy!=''){
			$query.= " order by ".$orderBy;
		}else{
			$query.= " order by orden, titulo, id ";
		}
		return $this->obtenerArticulosByQuery($query, $maxResults);
	}

	/**
	 * Permite obtener los articulos dado un query especificado
	 * @param String $query
	 * @param Number $maxResults
	 * @access private
	 */
	function obtenerArticulosByQuery($query, $maxResults){
		$ConnArt = new formulario('db');
		$items = $ConnArt->estructura_db($query);
		if(count($items)>0){
			$i=0;
				
			$catId = $items[$i]['cat_id'];
			$catNivel = $items[$i]['cat_nivel'];
			if (isset($catId)){
				$categoria = new categoria();
				$datosCategoria = $categoria->obtenerCategoria($catId,$catNivel);
				$datos['categoria'] = $datosCategoria;
			}
			foreach($items as $item){
				$datos[$i]['id'] = $item['id'];
				$datos[$i]['link'] = "/articulo-".$this->funciones->limpiarUrl($item['titulo']);
				$datos[$i]['nombre'] = utf8_encode($item['titulo']);
				$datos[$i]['fecha_mod'] = utf8_encode($item['fecha_mod']);
				$datos[$i]['resumen'] = utf8_encode(substr($item['resumen'],0,512));
				$datos[$i]['srcImg'] = $this->rutaBase."/contenido/turn/".utf8_encode($item['imagen']);
				$datos[$i]['articulo'] = new articulo($item['id'],$item['titulo'],$item['resumen'],$item['imagen'],$item['fecha_mod'],$this->rutaBase);
				$i=$i+1;
				if ($maxResults!=0 && $maxResults<=$i){break;}
			}
		}
		$ConnArt->cerrar();
		return $datos;
	}

}

?>