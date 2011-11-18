<?php
includeCommonClass('formulario');
includeCommonClass('funciones');
includeCommonClass('categoria');
includeCommonClass('producto');

/**
 * Clase que representa a el carrito de compras
 * @author Luis Poggi
 * @package svcms2
 * @subpackage elementos
 */
class carrito{
	/**
	 *
	 * Productos almacenados en el carrito con sus cantidades.
	 * Solo se guardan los ID para que cuando se muestre siempre tenga la información mas exacta.
	 * @var number_array
	 */
	var $productos;

	var $idCliente;

	var $productosInstanciados;

	var $subtotal;

	var $iva;

	var $valorIva;

	var $descuento;

	var $total;

	var $observaciones;

	function __construct($idCliente, $productos){
		$this->idCliente = $idCliente;
		$this->productos = $productos;
	}


	function recalcular($rutaBase){
		$this->subtotal = 0;
		foreach(array_keys($this->productos) as $idProducto){
			$producto = new producto();
			$producto->newInstance($idProducto, $rutaBase);
			$producto->cantidad = number_format($this->productos[$idProducto],0);
			$producto->precioTotal = number_format($producto->cantidad*$producto->precio,2);
			$this->subtotal += $producto->cantidad*$producto->precio;
			$producto->precio = number_format($producto->precio,2);
			$producto->linkEliminar = "?idDel=".$idProducto;
			$this->productosInstanciados[$idProducto] = $producto;
		}
		$tools = new formulario('db');
		$this->iva = $tools->obtenerConfiguracionProductosV2("IVA");
		$this->moneda = $tools->obtenerConfiguracionProductosV2("MONEDA");
		$this->descuento = $this->obtenerDescuento($this->idCliente);
		$this->valorIva = ($iva/100)*($carrito->subtotal - $carrito->descuento);
		$this->total = $this->calcularTotal();

		$this->linkVaciar = "?vaciar=1";
		$this->linkFinalizar = "?finalizar=1";
		$this->descuento = number_format($this->descuento,2);
		$this->iva       = number_format($this->iva,2);
		$this->valorIva  = number_format($this->valorIva,2);
		$this->subtotal  = number_format($this->subtotal,2);
		$this->total     = number_format($this->total,2);
	}

	function calcularTotal(){
		return $this->valorIva + ($this->subtotal - $this->descuento);
	}

	function obtenerDescuento($idCliente){
		if (isset($idCliente)){
			$queryDescuento = "SELECT ca.descuento FROM cliente c INNER JOIN cliente_categoria ca ON (c.categoria1 = ca.nombre) WHERE c.id = '.$idCliente.'";
			$tools = new formulario('db');
			$descuento = $tools->simple_db($queryDescuento);
			if(empty($descuento)) $descuento = 0;
			return $descuento;
		}
		return 0;
	}


}

?>