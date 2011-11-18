<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();

	switch ($_REQUEST['tabla']) {
	
		case 'cont_categoria':
			$nivel = 1;
			break;
		case 'cont_subcategoria':
			$nivel = 2;
			break;
		case 'cont_sub_subcategoria':
			$nivel = 3;
			break;
		
   }

$tool->abrir_transaccion();

$orden = $tool->simple_db("select if(orden='','0',orden) from {$_REQUEST['tabla']} where id = {$_REQUEST['id']} ");

$tool->query("update {$_REQUEST['tabla']} set orden = orden-1 where orden > $orden");

$tool->query("delete from {$_REQUEST['tabla']} where id = {$_REQUEST['id']} ");

$tool->query("delete from articulo where cat_nivel = $nivel and cat_id = {$_REQUEST['id']} "); /// para borrar productos

$tool->cerrar_transaccion();

$tool->cerrar();



?>