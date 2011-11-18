<?php
includeCommonClass('formulario');
includeCommonClass('funciones');


class categoria{
	var $funciones;
	var $rutaBase;
	var $nivel;

	function __construct (){
		$this->activos=1;
		$this->nivel=1;
		$this->funciones = new funciones();
	}

	function setRutaBase($ruta){
		$this->rutaBase = $ruta;
	}

	function obtenerCategoria($catId, $catNivel){
		$condiciones = " id = ".$catId;
		$categorias = $this->obtenerCategorias($condiciones, $catNivel);
		if (count($categorias)>0) return $categorias[0];
	}

	function obtenerCategorias($condiciones="", $nivel=1, $orderBy="", $maxResults=0){
		$query = " select id, nombre, descrip, imagen, orden, users from ";
		if (isset($nivel)){
			if ($nivel == 1){
				$query.= " cont_categoria ";
			}else if ($nivel == 2){
				$query.= " cont_subcategoria ";
			}else if ($nivel == 3){
				$query.= " cont_sub_subcategoria ";
			}else{
				return;
			}
		}else{
			$query.= " cont_categoria ";
		}
		if ((isset($condiciones)) && $condiciones!=''){
			$query.= " where ".$condiciones;
		}

		if ((isset($orderBy)) && $orderBy!=''){
			$query.= " order by ".$orderBy;
		}else{
			$query.= " order by orden, nombre, id ";
		}
		$this->nivel = $nivel;
		return $this->obtenerCategoriasByQuery($query, $maxResults);
	}

	function obtenerCategoriasByQuery($query, $maxResults){
		$ConnArt = new formulario('db');
		$items = $ConnArt->estructura_db($query);
		if(count($items)>0){
			$i=0;
			foreach($items as $item){
				$datos[$i]['id'] = $item['id'];
				$datos[$i]['nombre'] = $item['nombre'];
				$datos[$i]['descrip'] = $item['descrip'];
				$datos[$i]['imagen'] = $item['imagen'];
				$datos[$i]['orden'] = $item['orden'];
				$datos[$i]['users'] = $item['users'];
				$datos[$i]['link'] = "/SV-listado-articulos.php?nivel=".$this->nivel."&catid=".$item['id'];
				$datos[$i]['srcImg'] = $this->rutaBase."/contenido/turn/".utf8_encode($item['imagen']);
				$i=$i+1;
				if ($maxResults!=0 && $maxResults<=$i){break;}
			}
		}
		$ConnArt->cerrar();
		return $datos;
	}

	function obtenerSubCategorias($catId, $nivel=1){
		if (isset($nivel)){
			if ($nivel == 1){
				$condiciones.= " cat_id=".$catId;
			}else if ($nivel == 2){
				$condiciones.= " sub_id=".$catId;
			}else{
				return;
			}
		}else{
			return;
		}
		$datos = $this->obtenerCategorias($condiciones, $nivel+1);
		$categoria = new categoria();
		$datosCategoria = $categoria->obtenerCategoria($catId,$catNivel);
		$datos['categoria'] = $datosCategoria;
		return $datos;
	}

}

?>