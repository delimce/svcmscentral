<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/funciones.php");

$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL

$tool = new tools('db');

$tool->abrir_transaccion();

$orden = $tool->simple_db("select if(orden='','0',orden) from producto where id = {$_REQUEST['id']} ");

$tool->query("update producto set orden = orden-1 where orden > $orden and cat_nivel = {$_REQUEST['nivel']} and cat_id = {$_REQUEST['cat']}");

//////////////////borrar todos los archivos del producto

$queryA = "(select 
			doc_file as ele,
			'file' as tipo
			from `producto` where id = {$_REQUEST['id']} )
			UNION(
			select
			ruta as ele,
			'image' as tipo
			from `imagen_producto` where prod_id = {$_REQUEST['id']} )
			order by tipo";
			
	$archivos = $tool->estructura_db($queryA);
	
	//borrando datos
	for($i=0;$i<count($archivos);$i++){
	
		borrar_datap($archivos[$i]['ele'],$archivos[$i]['tipo']);
		
	}
			

////////////////////////////////////////////////////////

$tool->query("delete from producto where id = {$_REQUEST['id']} ");


$tool->cerrar_transaccion();

$tool->cerrar();

?>