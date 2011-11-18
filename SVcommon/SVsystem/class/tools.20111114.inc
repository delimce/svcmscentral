<?php

if (!class_exists('database')) {
	includeCommonClass('database');
}

/**
 *
 * clase que cosntruye diversas herramientas fopara usar en la construccion de forms
 * IMPORTANTE: por defecto se asume que se esta conectado a la base de datos
 * en caso de que desee llamar herramientas del tipo database
 * @author Desconocido
 * @package svcms1
 * @subpackage database
 */
class tools extends  database {


	function __construct ($conect=''){ ///constructor de la clase

		if(!empty($conect)){

			$this->autoconexion();

		}


	}

	//--------------------------------- operaciones con db


	///////////// Funcion que construye una estrctura tipo registro c++ con todas las tuplas
	/*  las tuplas resultantes de la consulta solo recibe la consulta sql para generar la
	/*  estructura esta se trabaja como si fuera un arreglo asociativo con n elementos
	/*  numero de registros, devuelve una estructura manipulable */

	public function estructura_db($query){

		$this->query($query);  //llamando las funciones de la clase database heredada
		$campos = $this->campos_query($this->result);


		$i=0;

		while ($row = mysql_fetch_row($this->result)) {    //N de registros

			for($j=0;$j<count($campos);$j++){   ////N campos

				$a[$i][$campos[$j]] = stripslashes($row[$j]);

			}

			$i++;
		}

		$this->liberar();
		return $a;

	}




	///////////// Funcion que construye una fila de datos dentro de un vector asociativo
	/*  las tuplas resultantes de la consulta solo recibe la consulta sql para generar la
	/*  estructura esta se trabaja como si fuera un arreglo asociativo con n elementos
	/*  numero de registros, y solo 1 fila  NOTA: en el caso de un solo valor se puede utilizar el nombre de arreglo sin indice*/

	public function simple_db($query){

		$this->query($query);  //llamando las funciones de la clase database heredada
		$campos = $this->campos_query($this->result);
		$row = mysql_fetch_row($this->result);

		if(count($campos)<=1){

			$a = stripslashes($row[0]);

		}else{

			for($j=0;$j<count($campos);$j++) $a[$campos[$j]] = stripslashes($row[$j]);

		}

		$this->liberar();
		return $a;

	}


	/////////funcion para buscar un elemento en una estructura db, se necesita el arreglo, el elemento y en la columna
	/////////clave donde se desea buscar, retorna el primer valor del elemento en la posicion del valor de la columna a consultar
	///////// en el parametro consultar

	public function buscar_estructdb($matriz,$clave,$elemento,$consultar){


		for($j=0;$j<count($matriz);$j++){

			if($matriz[$j][$clave] == $elemento){ $a = $matriz[$j][$consultar]; break;  }

		}

		return $a;

	}



	/////////////////funcion que crea un objeto combo a partir de una sentencia sql
	//// parametros: 1: id/nombre, 2: query, 3:opcion(campos del query) 4: valor (campos del query)
	/// opcionales: 5: primer valor por defecto (seleccionar ejemplo: cualquiera o seleccione),
	//// 6: seleccion (valor de la variable a seleccionar $id, variable),
	//// 7: on submit();
	//// 8. en caso de no conseguir ningun registro
	//// 9. si se desea seleccion multiple
	//// 10. desabilitar combo true o false

	public function combo_db ($id,$query,$option,$value,$select=false,$seleccion=false,$onchange=false,$noreg='',$multiple=false,$desabilita=false,$estilo=false){

		$this->query($query);  //llamando las funciones de la clase database heredada

		if($this->nreg>0){

			$combo = '<select name="'.$id.'" id="'.$id.'"';
			if($onchange)$combo.=' onChange="'.$onchange.'"';
			if($multiple)$combo.=' multiple size = "'.($this->nreg/2+1).'" ';
			if($desabilita)$combo.=' disabled="disabled"';
			if($estilo)$combo.=' class="'.$estilo.'"';
			$combo.= '>';
			if($select) $combo.= '<option value="">'.$select.'</option>';
			if(!$seleccion)$seleccion = $_REQUEST[$id];

			while ($row = mysql_fetch_assoc($this->result)) {
				$combo.= '<option value="';
				$combo.= stripslashes($row["$value"]);
				$combo.= '"';
				if($seleccion == $row["$value"]) $combo.= ' selected';
				$combo.= '>';
				$combo.= stripslashes($row["$option"]);
				$combo.= '</option>';
			}
			$combo.= '</select>';

		}else{

			$combo = '<b>'.$noreg.'</b>';
		}


		$this->liberar();
		return $combo;

	}



	///// combo array, construye un comobo select a partir de un vector


	/////////////////funcion que crea un objeto combo a partir de una sentencia sql
	//// parametros: 1: id/nombre, 2: arreglo (option), 3:array 2 (value)
	/// opcionales: 4: primer valor por defecto (seleccionar ejemplo: cualquiera o seleccione),
	//// 5: seleccion (valor de la variable a seleccionar $id, variable),
	//// 6: on submit();
	//// 7. en caso de no conseguir ningun registro
	//// 8. si se desea seleccion multiple
	//// 9. desabilitar combo true o false


	public function combo_array ($id,$array,$array2,$select=false,$seleccion=false,$onchange=false,$noreg='',$multiple=false,$desabilita=false,$estilo=false){

		if(count($array)>0){

			$combo = '<select name="'.$id.'" id="'.$id.'"';
			if($onchange)$combo.=' onChange="'.$onchange.'"';
			if($multiple)$combo.=' multiple size = "'.(count($array)/2+1).'" ';
			if($desabilita)$combo.=' readonly="true"';
			if($estilo)$combo.=' class="'.$estilo.'"';
			$combo.= '>';
			if($select) $combo.= '<option value="">'.$select.'</option>';
			if(!$seleccion)$seleccion = $_REQUEST[$id];
			$i=0;

			while($i<count($array)) {
				$combo.= '<option value="';
				$combo.= $array2[$i];
				$combo.= '"';
				if($seleccion == $array2[$i]) $combo.= ' selected';
				$combo.= '>';
				$combo.= $array[$i];
				$combo.= '</option>';
				$i++;
			}
			$combo.= '</select>';

		}else{

			$combo = '<b>'.$noreg.'</b>';
		}

		return $combo;

	}



	/// construye un vector simple (1 campo n registros) a partir de un query sql

	public function array_query($query){

		$i=0;
		$this->query($query); //ejecuta el query
		while ($row = @mysql_fetch_row($this->result)){
			$vector[$i] =  stripslashes($row[0]);
			$i++;
		}
		$this->liberar();
		return $vector;
	}




	/// construye un vector simple ((1 registro n campos) a partir de un query sql

	public function array_query2($query){

		$i=0;
		$this->query($query); //ejecuta el query
		$campos = $this->campos_query();
		$row = @mysql_fetch_row($this->result);   ///se trae el primer registro

		while ($i < count($campos)){
			$vector[$i] =  stripslashes($row[$i]);
			$i++;
		}


		$this->liberar();
		return $vector;
	}







	//------------------------------------- operaciones sobre arrays





	///////////////// encuentra la posicion en donde se encuentra el elemento en el vector
	//////////////// parametros 1: elemento a buscar, 2: vector en donde busca

	public function seencuentra($buscar,$en){
		$i=0;
		$pos=false;
		while(($i<count($en))and($pos==false)){
			if($buscar==$en[$i]){
				$pos = true;
				break;
			}
			$i++;
		}
		if($pos) return $i; else return false;
	}



	//////////////////metodos para ARREGLOS

	///limpia de un vector el elemento deseado, devuelve todo lo distinto a elelemento en sus posiciones

	public function limpiar_array($array,$element){
		$j=0;
		for($i=0;$i<count($array);$i++){
			if($array[$i]!=$element){
				$nuevo[$j] = $array[$i];
				$j++;
			}
		}

		return $nuevo;

	}


	///Suma todos los elementos de un vector

	public function suma_array($array){

		$result = 0;

		for($i=0;$i<count($array);$i++){

			$result+= $array[$i];
		}

		return $result;

	}




	///// llena un vector de elementos separados por comas un vector
	////////////separador, por defecto coma

	public function llenar_array($ELEMENTOS,$sep=','){

		$elementos = explode($sep,$ELEMENTOS);

		for($i=0;$i<count($elementos);$i++){

			$ARRAY[$i] = $elementos[$i];

		}

		return $ARRAY;

	}



	public function burbuja($array,$modo=0){

		for ($i=1; $i<count($array); $i++){
			for ($j=0; $j<count($array)-1; $j++){

				if($modo==0){

					if ($array[$j]>$array[$j+1]){
						$temp = $array[$j];
						$array[$j] = $array[$j+1];
						$array[$j+1] = $temp;
					}

				}else{

					if ($array[$j]<$array[$j+1]){
						$temp = $array[$j];
						$array[$j] = $array[$j+1];
						$array[$j+1] = $temp;
					}

				}


			}
		}

		return  $array;
	}



	////////////extrae los elementos unicos (elimina los repetidos)

	public function unicos($estos){

		$i = 1;
		$j = 1;
		if(count($estos)>0){ ///para saber que por lo menos uno tiene

			$result[0] = $estos[0];
			while($i<count($estos)){  //////while

				if(!in_array($estos[$i],$result)){  $result[$j] = $estos[$i]; $j++;  }

				$i++;

			}////while

		}

		return  $result;

	}


	//// valida se el arreglo tiene elementos repetidos       TRUE O FALSE
	public function repetidos ($array){
		$repeat  = @array_unique($array);
		if(count($repeat)!= count($array)) return true; else return false;
	}

	//// retorna el arreglo con el elemento eliminado
	public function eliminar_de (&$array,$element){

		$pos = array_search($element, $array);
		for($i=$pos;$i<count($array);$i++){

			$array[$i] = $array[$i+1];
		}
		array_pop($array);
		return $array;

	}

	/////////////////////////////// otras funciones

	///function que redirecciona a alguna direccion url, parent (opcional)
	///nota si se desea cerrar un popup coloque el texto: cerrar

	public function redirect($url,$parent=''){


		if($parent!='') $parent.='.';

		if($url=="cerrar") $var = "window.close();"; else $var = "$parent"."location.replace('$url');";

		echo " <script language=\"JavaScript\"
                        type=\"text/javascript\">
                        $var
                         </script>";

                        die();

	}


	/////////funcion para mostrar un aviso en javascript y redireccionar si asi se quiere

	public function javaviso($aviso,$url=false){


		echo "<script language=\"JavaScript\" type=\"text/javascript\">
         alert('$aviso');
         </script>";

		if($url)$this->redirect($url);


	}



	///////////devolver el formato original del texto ingresado en la base de datos usando la funcion inserar o update
	////////// nota esta funcion recibe el campo texto y lo formatea con los caracteres originales usados
	///////// todos los campos de texto que se repliegan deberian mostrarse con esta funcion

	public function format_txt($texto,$textarea=false){

		///////conversion

		if(!$textarea) $contenido = str_replace('\r\n','<p>', mysql_escape_string ($texto));
		$contenido = str_replace('\\','',$contenido);

		///////////

		return $contenido;

	}



	////// abreviar necesita el texto a abreviar y el numero de caracteres a los que se va a reducir
	public function abreviar($texto,$cmax){

		///////conversion

		if(strlen($texto)>$cmax){

			$frase = '<span title="'.$texto.'">';
			$frase.= substr($texto, 0, $cmax).'...';
			$frase.= '</span>';

		}else{ $frase = $texto; }
		///////////

		return $frase;

	}



	////////////////////////////////////////////////METODOS PARA ARCHIVOS//////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////


	////subir archivos funcion que sube un archivo de un origen a un destino con ciertas validaciones
	//// parametros
	//// origen: archivo subido con un campo file de un form   $_FILES['archivo']
	//// destino: ruta en donde sera copiado el archivo (incluyendo en nombre del archivo) ej: ../files/nuevo.gif   nota: por defecto sube al mismo dir con el mismo nombre
	//// tmax: tamano maximo del archivo a subir en MB por defecto ilimitado
	//// tipo: tipos de archivo que acepta por defecto cualquiera separados por comas eje: image/gif,image/jpeg,text/plain,application/octet-stream,application/zip,application/force-download
	///// para ams informacion o conocer el tipo del archivo que desea subir en http://www.cs.tut.fi/~jkorpela/forms/file.html
	//// overwrite si acepta over write por defecto true

	public function upload_file($origen,$destino=false,$tmax=false,$tipo=false,$overwrite=true){


		if(!$destino) $destino = $origen['name'];


		//////valida el tamano maximo
		if($tmax){
			$tama =  bcdiv($origen['size'],1048576,2); ///tamano en mb
			if($tama>$tmax){ $this->javaviso("El archivo es demasiado grande");
			return false;
			}
		}


		//////valida el tipo de archivo
		if($tipo){

			$vectortipo = explode(",",strtolower($tipo));

			if(!in_array(strtolower($origen['type']),$vectortipo)){

				$this->javaviso("El tipo de archivo a subir es invalido");
				return false;


			}


		}


		////////////valida si ya existe
		if($overwrite==false){ ////en caso de que no acepte sobre escribir no guarda el archivo

			if (file_exists($destino)) {

				$this->javaviso("Ya existe un archivo con el mismo nombre");
				return false;

			}


		}



		////////////proceso de subir el archivo

	 if(!copy($origen['tmp_name'], $destino)){

	 	$this->javaviso("Error al subir el archivo, Verifique los permisos de escritura en el directorio ' $destino ' ");
	 	return false;

	 }else{

	 	return true;

	 }


	 ///////////////////////////


	}




	///// esta funcion devuelve tosdos los elementos de un directorio en un array
	//////// con solo especificar el path

	public function listar_archivos($dirname=".") {
		$i=0;
		if($handle = opendir($dirname)) {
			while(false !== ($file = readdir($handle))) {
				if (($file!='..') && ($file!='.') && ($file!='Thumbs.db')){
					$files[$i] = $file;
					$i++;
				}
			}
			closedir($handle);
		}
		return($files);
	}


	////////////////////////////////////////////////////////////////////

	public function combo_dir($id,$path,$select=false,$seleccion=false,$submit=false,$noreg,$multiple=false,$desabilita=false){

		$array = $this->listar_archivos($path);

		if(count($array)>0){

			$combo = '<select name="'.$id.'" id="'.$id.'"';
			if($submit)$combo.=' onChange="submit();"';
			if($multiple)$combo.=' multiple size = "'.(count($array)/2+1).'" ';
			if($desabilita)$combo.=' readonly="true"';
			$combo.= '>';
			if($select) $combo.= '<option value="">'.$select.'</option>';
			$i=0;

			while($i<count($array)) {
				$combo.= '<option value="';
				$combo.= $array[$i];
				$combo.= '"';
				if($seleccion == $array[$i]) $combo.= ' selected';
				$combo.= '>';
				$combo.= $array[$i];
				$combo.= '</option>';
				$i++;
			}
			$combo.= '</select>';

		}else{

			$combo = '<b>'.$noreg.'</b>';
		}

		return $combo;


	}



	///funcion que borra todos los elementos de un directorio
	///parametros: $dirname ruta del directorio, y si borra el directorio o no?

	public function delete_directory($dir) {

		if ($dh = @opendir($dir)) {
			while (($file = readdir ($dh)) != false) {
				if (($file == ".") || ($file == "..")) continue;
				if (is_dir($dir . '/' . $file))
				$this->delete_directory($dir . '/' . $file);
				else
				unlink($dir . '/' . $file);
			}
			@closedir($dh);
			rmdir($dir);
		}
	}

	public function obtenerConfiguracionProductos($config){
		$query = " select ".$config."  as valor from preferencias ";
		$results = $this->estructura_db($query);
		if (count($results)>0) return $results[0]['valor'];
		else return '';
	}

	public function obtenerConfiguracionProductosV2($config){
		$query = " select valor from config_productos where nombre='".$config."' ";
		$results = $this->estructura_db($query);
		if (count($results)>0) return $results[0]['valor'];
		else return '';
	}


	public function obtenerConfigPages($idPage){
		$query = " select titulo ,  descripcion ,  meta ,  imagen ,  footer ,  texto  from config_pages where idPage='".$idPage."' ";
		$results = $this->estructura_db($query);
		return $results;
	}

	public function obtenerCategorias(){

		/******** CAMBIE DESDE AQUI *************/

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

		if(empty($_SESSION['CLIENTE_ID'])){
			$extra1 = "where c.only_for = 0";
		}else{
			$extra1 = "where c.only_for in (0,1";
			$extraCats = $this->estructura_db($queryCats);

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

		/******** CAMBIE HASTA AQUI *************/

		$query = "select 'prod' as tipo, id, nombre, (select count(*) from prod_subcategoria where cat_id = c.id) as sub,
					(select count(*) from producto where cat_nivel = 1 and cat_id = c.id) as art
				 from prod_categoria c $extra1
				 order by orden";
		$cat1 = $this->estructura_db($query);

		$totalProductos = count($cat1);
		for($c1=0;$c1<count($cat1);$c1++){
			$NIVEL = 1;
			$CATID = $cat1[$c1]['id'];
			$results[$c1]['nombre'] = utf8_encode($cat1[$c1]['nombre']);
			$results[$c1]['tipo'] = utf8_encode($cat1[$c1]['tipo']);
			$results[$c1]['id'] = $CATID;
			$results[$c1]['nivel']=$NIVEL;
			if(($cat1[$c1]['sub']+$cat1[$c1]['art']) > 0){
				if($cat1[$c1]['sub']>0){ ///si hay sub
					$query = "select 'prod' as tipo, id, nombre, (select count(*) from prod_sub_subcategoria where sub_id = c.id) as sub,
							(select count(*) from producto where cat_nivel = 2 and cat_id = '$CATID') as art
					 from prod_subcategoria c where cat_id = '$CATID' order by orden";

					$cat2 = $this->estructura_db($query);
					$results[$c1]['hijos']=count($cat2);

					for($c2=0;$c2<count($cat2);$c2++){
						$NIVEL = 2; $CATID = $cat2[$c2]['id'];

						$results[$c1][$c2]['nombre'] = utf8_encode($cat2[$c2]['nombre']);
						$results[$c1][$c2]['tipo'] = utf8_encode($cat2[$c2]['tipo']);
						$results[$c1][$c2]['id'] = $CATID;
						$results[$c1][$c2]['nivel']=$NIVEL;

						if($cat2[$c2]['sub']>0){ ///si hay sub sub

							$query = "select 'prod' as tipo, id,nombre from prod_sub_subcategoria c where sub_id = '$CATID' order by orden";

							$cat3 = $this->estructura_db($query);
							$results[$c1][$c2]['hijos']=count($cat3);
							for($c3=0;$c3<count($cat3);$c3++){
								$NIVEL = 3;
								$CATID = $cat3[$c3]['id'];
								$results[$c1][$c2][$c3]['nombre'] = utf8_encode($cat3[$c3]['nombre']);
								$results[$c1][$c2][$c3]['tipo'] = utf8_encode($cat3[$c3]['tipo']);
								$results[$c1][$c2][$c3]['id'] = $CATID;
								$results[$c1][$c2][$c3]['nivel']=$NIVEL;
							}
						}
					}
				}
			}
		}

		if ($totalProductos>0){
			$results[$totalProductos]['nombre'] = "----------";
			$totalProductos+=1;
		}

		$query = "select 'arti' as tipo, id, nombre,(select count(*) from cont_subcategoria where cat_id = c.id ) as sub,
( select count(*) from articulo where cat_nivel = 1 and cat_id = c.id ) as art
 from cont_categoria c $extra1 order by orden";

		$cat1 = $this->estructura_db($query);

		for($c1=0;$c1<count($cat1);$c1++){
			$NIVEL = 1;
			$CATID = $cat1[$c1]['id'];
			$nombre = ($CATID == 1?"Información General":$cat1[$c1]['nombre']);
			$results[$c1+$totalProductos]['nombre'] = utf8_encode($nombre);
			$results[$c1+$totalProductos]['tipo'] = utf8_encode($cat1[$c1]['tipo']);
			$results[$c1+$totalProductos]['id'] = $CATID;
			$results[$c1+$totalProductos]['nivel']=$NIVEL;
			$results[$c1+$totalProductos]['tipo']='arti';
			$results[$c1+$totalProductos]['sub']=$cat1[$c1]['sub'];
			$results[$c1+$totalProductos]['art']=$cat1[$c1]['art'];
			if(($cat1[$c1]['sub']+$cat1[$c1]['art']) > 0){
				if($cat1[$c1]['sub']>0){ ///si hay sub
					$query = "select 'arti' as tipo, id, nombre, ( select count(*) from cont_sub_subcategoria where sub_id = c.id ) as sub,
( select count(*) from articulo where cat_nivel = 2 and cat_id = '$CATID' ) as art
from cont_subcategoria c where cat_id = '$CATID' order by orden";

					$cat2 = $this->estructura_db($query);
					$results[$c1]['hijos']=count($cat2);
					for($c2=0;$c2<count($cat2);$c2++){
						$NIVEL = 2;
						$CATID = $cat2[$c2]['id'];

						$results[$c1+$totalProductos][$c2]['nombre'] = utf8_encode($cat2[$c2]['nombre']);
						$results[$c1+$totalProductos][$c2]['tipo'] = utf8_encode($cat2[$c2]['tipo']);
						$results[$c1+$totalProductos][$c2]['id'] = $CATID;
						$results[$c1+$totalProductos][$c2]['nivel']=$NIVEL;
						$results[$c1+$totalProductos][$c2]['sub']=$cat2[$c2]['sub'];
						if($cat2[$c2]['sub']>0){ ///si hay sub sub
							$query = "select 'arti' as tipo, id,nombre from cont_sub_subcategoria c where sub_id = '$CATID' order by orden";
							$cat3 = $this->estructura_db($query);
							$results[$c1][$c2]['hijos']=count($cat3);
							for($c3=0;$c3<count($cat3);$c3++){
								$NIVEL = 3;
								$CATID = $cat3[$c3]['id'];

								$results[$c1][$c2][$c3]['nombre'] = utf8_encode($cat3[$c3]['nombre']);
								$results[$c1][$c2][$c3]['tipo'] = utf8_encode($cat3[$c3]['tipo']);
								$results[$c1][$c2][$c3]['id'] = $CATID;
								$results[$c1][$c2][$c3]['nivel']=$NIVEL;
							}
						}
					}
				}
			}
		}
		return $results;
	}

        public function obtenerPrecios($rangos, $nivel, $categoria){
        	$query = "select max(precio) maximo, min(precio) minimo from producto";
 		$valores = $this->estructura_db($query);
                $maximo = $valores[0]['maximo'];
                $minimo = $valores[0]['minimo'];
                $valorRango = ceil(($maximo-$minimo)/$rangos);
                $anterior = floor($minimo);
                for ($i=0;$i<$rangos;$i++){
                	$results[$i]['inicioRango'] = $anterior;
                	$results[$i]['finRango'] = $anterior + $valorRango;
                        $anterior = $results[$i]['finRango'];
                }
                return $results;

        }
        
	function obtenerProductos($nivel,$id){
		$query = "select id,nombre from producto where stock > 0 and activo = 1 and cat_nivel = '$nivel' and cat_id = '$id' order by orden";
		$results = $this->estructura_db($query);
		return $results;
	}

	function obtenerArticulos($nivel,$id){
		$query = "select id,titulo from articulo where estatus = 1 and cat_nivel = '$nivel' and cat_id = '$id' order by orden";
		$results = $this->estructura_db($query);
		return $results;
	}

} //// fin de la clase tool


/////////////////////DESTRUCTOR DE LA CLASE

function __destruct(){

	if(!empty($this->dbc)){ $this->cerrar(); }

}
?>