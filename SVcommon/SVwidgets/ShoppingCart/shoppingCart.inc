<?php
includeCommonClass('tools');
includeCommonClass('formulario');
includeCommonClass('widget');
includeCommonClass('producto');
includeCommonClass('carrito');


/**
 *
 * Clase para representar al carrito de compras. Permite manipularlo y trabajarlo.
 * Acepta dos tipos de comportamiento, puede ser guardado en cookies o guardado en BD solo para registrados
 * @author Luis Poggi
 * @package svcms2
 * @subpackage widget
 *
 */
class shoppingCart extends widget{
	/**
	 *
	 * Indica si el carrito se almacena en cookies o no.
	 * @var boolean
	 */
	var $guardadoEnCookies;

	var $carrito;

	/**
	 *
	 * Constructor de la clase. El comportamiento por defecto es que se guarda en cookies
	 * @param $cookie, Variable que indica si el carrito de compras es guardado en cookie o no. Valor por defecto = true
	 */
	function __construct($idCliente,$cookie=true){
		$this->guardadoEnCookies=$cookie;
		$this->obtenerShoppingCart();
	}

	/**
	 * Permite agregar un producto al carrito de compras
	 * @param Number $idProducto, Identificador del producto a agregar
	 * @param Number $cantidad, cantidad a agregar
	 */
	function agregarProducto($idProducto, $cantidad=1){
		if ($cantidad<1) $cantidad = 1;
		if (isset($idProducto)){
			if (isset($this->carrito->productos[$idProducto])){
				$this->carrito->productos[$idProducto] += $cantidad;
			}else{
				$this->carrito->productos[$idProducto] = $cantidad;
			}
			$this->salvar();
		}
	}

	/**
	 * Saca un producto del carrito
	 * @param Number $idProducto, Identificador del producto a eliminar
	 */
	function eliminarProducto($idProducto){
		unset($this->carrito->productos[$idProducto]);
		$this->salvar();
	}

	/**
	 * Cambia la cantidad de producto de un carrito
	 * @param Number $idProducto, producto a cambiar su cantidad
	 * @param Number $cantidad, nueva cantidad, sobreescribe la anterior
	 */
	function cambiarCantidadProducto($idProducto, $cantidad){
		if (isset($idProducto)){
			$this->carrito->productos[$idProducto] = $cantidad;
			$this->salvar();
		}
	}

	/**
	 *
	 * Guarda el carrito. Es afectado por la variable guardadoEnCookies, según esta indique se almacena en BD o en cookies
	 */
	function salvar(){
		if ($this->guardadoEnCookies){
			$this->saveCookie();
		}else{
			$this->saveDB();
		}
	}

	/**
	 *
	 * Guarda el carrito en Base de datos
	 */
	function saveDB(){

	}

	/**
	 * Enter description here ...
	 */
	function obtenerShoppingCart(){
		if ($this->guardadoEnCookies){
			$this->obtenerCookie();
		}else{
			$this->obtenerDB();
		}
	}

	/**
	 * Guarda el carrito en la sesion
	 */
	function saveCookie(){
		$_SESSION["carrito_productos"] = $this->carrito->productos;
		$_SESSION["carrito_observaciones"] = $this->carrito->observaciones;
	}

	/**
	 * Obtiene el carrito de la sesión
	 */
	function obtenerCookie(){
		$this->carrito = new carrito($this->idCliente, $_SESSION["carrito_productos"]);
		$this->carrito->observaciones = $_SESSION["carrito_observaciones"];
	}

	/**
	 * Muestra el contenido del carrito
	 *
	 */
	function show(){
		if(count($this->carrito->productos)>0){
			$this->carrito->recalcular($this->rutaBase);
			eval(includeClosingTag().$this->obtenerPreTagPresentacion("<producto>"));
			foreach($this->carrito->productosInstanciados as $producto){
				eval(includeClosingTag().$this->obtenerTagPresentacion("<producto>"));
			}
			$postProducto = $this->obtenerPostTagPresentacion("<producto>");

			$carrito = $this->carrito;

			if ($this->carrito->descuento==0){
				$postProducto = $this->reemplazarTagPresentacion("<descuento>", "", $postProducto);
			}

			if (!isset($this->carrito->iva)){
				$postProducto = $this->reemplazarTagPresentacion("<iva>", "", $postProducto);
			}

			if (!isset($this->carrito->idCliente) || $this->carrito->idCliente==""){
				$postProducto = $this->reemplazarTagPresentacion("<boton_finalizar>", "", $postProducto);
			}

			eval(includeClosingTag().$postProducto);
		}else{
			if (isset($this->formatoSinResultados)) include $this->formatoSinResultados;
		}
	}


	function vaciarCarrito($vaciar){
		if (isset($vaciar) & $vaciar==1){
			unset($this->carrito->productos);
			unset($this->carrito->productosInstanciados);
			$this->salvar();
		}
	}

	function finalizarOrden($finalizar){
		if (isset($finalizar) & $finalizar==1){
			if(count($this->carrito->productos)>0){
				$this->carrito->recalcular($this->rutaBase);
				$tool = new formulario('db');

				$orden[0] = $this->carrito->idCliente;
				$orden[1] = date("Y-m-d H:i:s");
				$orden[2] = $this->carrito->total;

				$tool->query("SET AUTOCOMMIT=0");
				$tool->query("START TRANSACTION");

				$tool->insertar2("orden_compra","cliente_id,fecha,monto",$orden);
				$orden_id = $tool->ultimoID;
				try{
					//Campos Extras. No todas las bases de datos los tienen.
					$tool->query2("update orden_compra set observaciones = '".$this->carrito->observaciones."' where id = ".$orden_id);
				}catch (Exception $e){

				}

				foreach(array_keys($this->carrito->productos) as $idProducto){
					$item[0] = $orden_id;
					$item[1] = $idProducto;
					$item[2] = $this->carrito->productos[$idProducto];
					$tool->insertar2("orden_item","orden_id,prod_id,cantidad",$item);
				}
				$tool->query("COMMIT");
				$this->vaciarCarrito($finalizar);
			}
		}
	}

	function cambiarObservaciones($observaciones){
		$this->carrito->observaciones = $observaciones;
		$this->salvar();
	}
}

?>