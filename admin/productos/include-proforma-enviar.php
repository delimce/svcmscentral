<?php


	require("include-proforma-guardar.php");

	////////////cambiando el estatus de la orden y mandando correo

	$tool->query("update orden_compra set estatus = 'procesada' where id = {$_SESSION['ORDENIDP']}");




//////descontando cantidad de productos del inventario

		$tool->abrir_transaccion();

		$invent = $tool->estructura_db("SELECT o.prod_id as prod,
									 ifnull(o.cantidad,0) as cant
									FROM
									orden_item AS o where orden_id = {$_SESSION['ORDENIDP']} ");

		for($i=0;$i<count($invent);$i++){

				$cant = $invent[$i]['cant'];
				$prod = $invent[$i]['prod'];
				$tool->query("update producto set stock = stock - $cant where id = $prod ");

		}


		$tool->cerrar_transaccion();

////////////////////



//////envio de correo


$dat4 = $tool->simple_db("SELECT DISTINCT
  c.nombre,
  c.rif,
  c.notas,
  c.email,
  c.tlf1,
  c.direccion,
  date_format(o.fecha,'%d/%m/%Y') as fecha,
  (select sum(p2.precio*o2.cantidad) from producto p2 inner join orden_item o2 on (p2.id = o2.prod_id) inner join orden_compra o3 on (o3.id = o2.orden_id)  where o3.id = o.id group by o3.id ) as monto,
   ca.descuento,
  o.estatus,
  o.id,
  (SELECT preferencias.subject_prod_orden_admin FROM preferencias) AS etitulo,
  (SELECT preferencias.prod_orden_admin FROM preferencias) AS emensaje
FROM
  orden_compra o
  INNER JOIN cliente c ON (o.cliente_id = c.id)
  left Join cliente_categoria  AS ca ON ca.nombre = c.categoria1
WHERE
  o.id = {$_SESSION['ORDENIDP']} AND
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
  $cliente_tlf = $dat4['tlf1']; //nuevo
  $cliente_dir = $dat4['direccion']; //nuevo

  $fecha_orden = $dat4['fecha'];
  $email_send = $dat4['email'];
  $notasusuario = $dat4['notas']; //nuevo
  $orden_id = $dat4['id'];

  $fact_subtotal_con_recargos =  $PTOTAL-$PIVA; ///sub total de la orden para email

  //////////datos de la empresa
  $dataempre = $tool->simple_db("select * from preferencias");


  $fact_subtotal1 = $dat4['monto'];
  $fact_descuento = $dat4['monto']-bcdiv($dat4['monto']*$dat4['descuento'],100,2);

  $nombre_empresa = $dataempre['nombre_empresa'];
  $url_empresa = $dataempre['url_empresa'];
  $direccion_empresa = $dataempre['direccion'];
  $tlf_empresa = $dataempre['telefonos'];
  $email_empresa = $dataempre['soporte_email'];
  $tifempresa = $dataempre['rif_empresa'];
  $moneda_simbolo = $dataempre['moneda_simbolo'];
  $factorConversion = $dataempre['moneda_factor'];

$fact_subtotal1Bs = $fact_subtotal1*$factorConversion;
$fact_descuentoBs = $fact_descuento*$factorConversion;
$fact_mod_montoBs = $fact_mod_monto*$factorConversion;
$fact_envioBs = $fact_envio*$factorConversion;
$fact_subtotal_con_recargosBs = $fact_subtotal_con_recargos*$factorConversion;
$fact_ivaBs = $fact_iva*$factorConversion;
$fact_totalBs = $fact_total*$factorConversion;


  $original  = array('$estatus_orden', '$nombre_email', '$fecha_orden', '$email_send', '$nombre_empresa', '$url_empresa','$orden_id','$rif','$productos_orden','$notasusuario','$cliente_dir','$cliente_tlf','$fact_obs','$fact_envioBs','$fact_envio','$fact_subtotal1Bs','$fact_subtotal1','$fact_ivaBs','$fact_iva','$fact_totalBs','$fact_total','$fact_mod_nombre','$fact_mod_signo','$fact_mod_montoBs','$fact_mod_monto','$fact_subtotal1','$fact_descuentoBs','$fact_descuento','$fact_subtotal_con_recargosBs','$fact_subtotal_con_recargos','$direccion_empresa','$tlf_empresa','$tifempresa','$email_empresa','$moneda_simbolo');
  $reemplazo = array($estatus_orden, $nombre_email, $fecha_orden, $email_send, $nombre_empresa, $url_empresa,$orden_id,$rif,$productos_orden,$notasusuario,$cliente_dir,$cliente_tlf,$fact_obs,$fact_envioBs,$fact_envio,$fact_subtotal1Bs,$fact_subtotal1,$fact_ivaBs,$fact_iva,$fact_totalBs,$fact_total,$fact_mod_nombre,$fact_mod_signo,$fact_mod_montoBs,$fact_mod_monto,$fact_subtotal1,$fact_descuentoBs,$fact_descuento,$fact_subtotal_con_recargosBs,$fact_subtotal_con_recargos,$direccion_empresa,$tlf_empresa,$tifempresa,$email_empresa,$moneda_simbolo);

  $email_subject = str_replace($original, $reemplazo, $dat4['etitulo']);
  $email_content = str_replace($original, $reemplazo, $dat4['emensaje']);


  									 /////////manda email cliente
								    $headers  = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
									$headers .= "From: $nombre_empresa  < $email_empresa>" . "\r\n" .
								 "Reply-To:  $email_empresa" . "\r\n";

										  mail($dat4['email'],$email_subject,$email_content,$headers);
								 ////////		email al admin
                      mail( $email_empresa,$email_subject,$email_content,$headers);



$tool->cerrar();



	unset($_SESSION['ORDENIDP']);
	unset($_SESSION['MONTOINICIO']);

	$tool->javaviso(utf8_decode("La información ha sido Enviada "),"actualizar");




?>