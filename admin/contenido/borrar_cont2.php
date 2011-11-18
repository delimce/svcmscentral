<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/funciones.php");

$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL

$tool = new tools('db');

$tool->abrir_transaccion();

$data = $tool->simple_db("select id,if(orden='','0',orden) as orden,imagen from articulo where id = {$_REQUEST['id']} ");

$orden = $data['orden'];

$tool->query("update articulo set orden = orden-1 where orden > $orden and cat_nivel = {$_REQUEST['nivel']} and cat_id = {$_REQUEST['cat']}");


//////////////////borrar todos los archivos del producto

    $queryA = "select ruta,tipo from cont_adjunto where art_id = {$_REQUEST['id']} and tipo != 'link' ";
			
	$archivos = $tool->estructura_db($queryA);
	
	//borrando datos
	for($i=0;$i<count($archivos);$i++){
	
		borrar_datac($archivos[$i]['ruta'],$archivos[$i]['tipo']);
	}
			
////////////////////////////////////////////////////////

	$tool->query("delete from articulo where id = {$_REQUEST['id']} ");

	@unlink('../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/med/'.$data['imagen']);
	@unlink('../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/orig/'.$data['imagen']);
	@unlink('../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/turn/'.$data['imagen']);

$tool->cerrar_transaccion();

$tool->cerrar();

?>