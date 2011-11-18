<?php


/**
 * Clase que representa los widgets. Todos los widgets heredan las propiedades y métodos aquí definidos
 * @author Luis Poggi
 * @package svcms2
 * @subpackage widget
 */
class widget {
	/**
	 * Formato de la presentación, sirve para mostrar los resultados del widget
	 * @var String
	 */
	var $formatoPresentacion;
	/**
	 * Formato para colocar el widget sin resultados.
	 * <br>Todos los widgets que presentan resultados consideran que puede no venir ninguno, para ello se usa este formato
	 * @var String
	 */
	var $formatoSinResultados;
	/**
	 * Ruta Base donde se encuentran las imágenes. Próximo a ser deprecado
	 * <br>Mientras se mantengan las imagenes en el servidor centralizado permanecerá, luego desaparecerá
	 * @var String
	 */
	var $rutaBase;

	/**
	 * Contiene el string del la presentacion extendida
	 * @access private
	 * @var String
	 */
	var $presentacionExp;

	/**
	 * Permite obtener el tag de cierre de un tag. Ejemplo si se coloca "<tag>" como parametro
	 * retorna "</tag>". Debe recibir como parametro un tag bien formado sin espacios antes del "<" inicial
	 * @access private
	 * @param String $tag
	 * @return String tag de cierre
	 */
	function obtenerTagCierre($tag){
		if (strpos($tag,"/")>0) return $tag;
		return "</".substr($tag, 1);
	}

	function obtenerPreTagPresentacion($tag){
		if (!isset($this->presentacionExp)){$this->explodePresentacion();}
		if (strpos($this->presentacionExp, $tag)>=0){
			$cierreTag = $this->obtenerTagCierre($tag);
			$posOpenTag = strpos($this->presentacionExp, $tag);
			$posCierreTag = strpos($this->presentacionExp, $cierreTag);
			return substr($this->presentacionExp, 0, $posOpenTag-1);
		}
	}

	function obtenerTagPresentacion($tag){
		if (!isset($this->presentacionExp)){$this->explodePresentacion();}
		if (strpos($this->presentacionExp, $tag)>=0){
			$cierreTag = $this->obtenerTagCierre($tag);
			$posOpenTag = strpos($this->presentacionExp, $tag);
			$posCierreTag = strpos($this->presentacionExp, $cierreTag);
			return substr($this->presentacionExp, $posOpenTag+strlen($tag), $posCierreTag-($posOpenTag+strlen($tag)));
		}
	}

	function obtenerPostTagPresentacion($tag){
		if (!isset($this->presentacionExp)){$this->explodePresentacion();}
		if (strpos($this->presentacionExp, $tag)>=0){
			$cierreTag = $this->obtenerTagCierre($tag);
			$posOpenTag = strpos($this->presentacionExp, $tag);
			$posCierreTag = strpos($this->presentacionExp, $cierreTag);
			return substr($this->presentacionExp, $posCierreTag+strlen($cierreTag));
		}
	}

	function reemplazarTagPresentacion($tag, $newValue, $originalString=""){
		$cierreTag = $this->obtenerTagCierre($tag);
                if (isset($originalString)){
		$posOpenTag = strpos($originalString, $tag);
		$posCierreTag = strpos($originalString, $cierreTag);
			return substr_replace($originalString, $newValue, $posOpenTag, $posCierreTag-$posOpenTag);
                }else{
		$posOpenTag = strpos($this->presentacionExp, $tag);
		$posCierreTag = strpos($this->presentacionExp, $cierreTag);
			$this->presentacionExp = substr_replace($this->presentacionExp, $newValue, $posOpenTag, $posCierreTag-$posOpenTag);
                }
	}

	/**
	 *
	 * Permite cargar en la lista el formato de la presentacion
	 * @access private
	 */
	function explodePresentacion(){
		$this->presentacionExp = file_get_contents($this->formatoPresentacion, true);
	}

}
?>