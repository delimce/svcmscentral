<?php session_start();

include("../../SVsystem/config/dbconfig.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools('db');

$dataempre = $tool->simple_db("select * from preferencias");

$tool->query("update orden_compra set estatus = '{$_REQUEST['estado']} ' where id = {$_REQUEST['id']} ");


//////descontando cantidad de productos del inventario
	if($_REQUEST['estado']=="procesada"){
		$tool->abrir_transaccion();
		
		$invent = $tool->estructura_db("SELECT o.prod_id as prod,
									 ifnull(o.cantidad,0) as cant
									FROM
									orden_item AS o where orden_id = {$_REQUEST['id']} ");
									
		for($i=0;$i<count($invent);$i++){
			
				$cant = $invent[$i]['cant'];
				$prod = $invent[$i]['prod'];
				$tool->query("update producto set stock = stock - $cant where id = $prod ");
						
		}
									
		
		$tool->cerrar_transaccion();
	}

////////////////////



//$_SESSION['PORDENES'] = $tool->simple_db("SELECT IFNULL((select count(*) from orden_compra where estatus = 'nueva'),0)");

$dat4 = $tool->simple_db("SELECT DISTINCT 
  c.nombre,
  c.rif,
  c.notas,
  c.email,
  date_format(o.fecha,'%d/%m/%Y') as fecha,
  o.estatus,
  o.id,
  (SELECT preferencias.subject_prod_orden_admin FROM preferencias) AS etitulo,
  (SELECT preferencias.prod_orden_admin FROM preferencias) AS emensaje
FROM
  orden_compra o
  INNER JOIN cliente c ON (o.cliente_id = c.id)
WHERE
  o.id = {$_REQUEST['id']} AND 
  c.activo = 1");
  
  
  
  $productos_orden = $tool->simple_db("SELECT group_concat(distinct p.nombre) as pp
										FROM
										producto AS p
										INNER JOIN orden_item AS o ON o.prod_id = p.id
										WHERE
										o.orden_id = '{$dat4['id']}'  ");
  
  
  $estatus_orden = $dat4['estatus'];
  $rif = $dat4['rif'];
  $nombre_email = $dat4['nombre'];
  $fecha_orden = $dat4['fecha'];
  $email_send = $dat4['email'];
  $notasusuario = $dat4['notas']; //nuevo
  $orden_id = $dat4['id'];
  
  //////////datos de la empresa
  $nombre_empresa = $dataempre['nombre_empresa'];
  $url_empresa = $dataempre['url_empresa'];
  
  
  
  $original  = array('$estatus_orden', '$nombre_email', '$fecha_orden', '$email_send', '$nombre_empresa', '$url_empresa','$orden_id','$rif','$productos_orden','$notasusuario');
  $reemplazo = array($estatus_orden, $nombre_email, $fecha_orden, $email_send, $nombre_empresa, $url_empresa,$orden_id,$rif,$productos_orden,$notasusuario);
  
  $email_subject = str_replace($original, $reemplazo, $dat4['etitulo']);
  $email_content = str_replace($original, $reemplazo, $dat4['emensaje']);
  
  
  									 /////////manda email cliente
								  	$dataemail = $tool->array_query2("select nombre_empresa,soporte_email from preferencias");
								    $headers  = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
									$headers .= "From: $dataemail[0] <$dataemail[1]>" . "\r\n" .
								 "Reply-To: $dataemail[1]" . "\r\n";
										  
									//	  mail($dat4['email'],$email_subject,$email_content,$headers);
								 ////////		email al admin  
                     // mail($dataemail[1],$email_subject,$email_content,$headers);
  
  

$tool->cerrar();



?>