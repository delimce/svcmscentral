<?php session_start();


		if($_POST['tipo']>2){
		$profile = 'admin'; /////////////// perfil requerido
		include("../../SVsystem/config/setup.php"); ////////setup

		}else{

		include("../../SVsystem/config/masterconfig.php"); ////////config

		}


 include("../../SVsystem/class/clases.php");
 $datos = new tools('db');

		 switch ($_POST['tipo']) {
		
		case 0:

		    $data = $_POST['valor'];
		    $datos->query("update admin set servicios = '$data' where id = '{$_POST['id']}'");
			if($_POST['id'] == $_SESSION['USERID'])$_SESSION['SERVICIO'] =  $data; ///actualizando servicios

		   break;
		case 1:
		   $datos->query("update admin set es_admin = '{$_POST['valor']}' where id = '{$_POST['id']}'");
		   break;
		case 2:
		   $datos->query("update admin set activo = '{$_POST['valor']}' where id = '{$_POST['id']}'");
		   break;
		case 3:

			if($_POST['valor']=='true')$data = 1; else $data = 0;
		   $datos->query("update preferencias set activo = '$data'");
		   break;

		case 4:

		   if($_POST['valor']=='true')$data = 1; else $data = 0;
		   $ser = $datos->simple_db("select servicios from preferencias");
		   $serv = @explode(',',$ser); ///vector de servicios

		   if($data==1){//inserta

		   	array_push($serv,$_POST['serv']);


		   }else {//elimina

		   $serv = $datos->eliminar_de($serv,$_POST['serv']);


		   }

		   $data = implode(",",$serv);
		   $datos->query("update preferencias set servicios = '$data'");


		  case 5:

		  $valor = utf8_decode($_POST['valor']);
		  $datos->query("update preferencias set {$_POST['campo']} = '$valor'");

		    break;
			
		   case 6:///para los popups

		  	$valor = utf8_decode($_POST['valor']);
		  	$datos->query("update preferencias set popup_style = '$valor'");

		    break;

		}


$datos->cerrar();

?>
