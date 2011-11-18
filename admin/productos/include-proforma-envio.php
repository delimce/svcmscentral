<?php 

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
                    
                    
                    
  $enviof = $tool->simple_db("SELECT
                                      f.precio_envio,
                                      f.subtotal,
                                      f.iva,
                                      f.total,
                                      f.observaciones,
                                      m.nombre,
                                      m.unidad,
                                      m.operacion,
                                      m.valor
                                      FROM
                                      factura AS f
                                      INNER JOIN factura_mod AS m ON f.id = m.factura_id
                                      where f.nfactura = {$_SESSION['ORDENIDP']} ");     


     $PTOTAL = (float) $enviof['total'];
     $PIVA   = (float) $enviof['iva'];                      
     $fact_obs = $enviof['observaciones'];                 
     $fact_envio = (float) $enviof['precio_envio'];                
     $fact_iva = $PIVA;
     $fact_total = $PTOTAL;
     
     $fact_mod_nombre = $enviof['nombre'];
     $fact_mod_signo = $enviof['operacion'];
     if($enviof['unidad'] == 'monto') $enviof['unidad'] = 'Bsf';
     $fact_mod_monto = $enviof['unidad'].' '.$enviof['valor'];               
                    
                   
  
  
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
  
  $original  = array('$estatus_orden', '$nombre_email', '$fecha_orden', '$email_send', '$nombre_empresa', '$url_empresa','$orden_id','$rif','$productos_orden','$notasusuario','$cliente_dir','$cliente_tlf','$fact_obs','$fact_envio','$fact_subtotal1','$fact_iva','$fact_total','$fact_mod_nombre','$fact_mod_signo','$fact_mod_monto','$fact_subtotal1','$fact_descuento','$fact_subtotal_con_recargos','$direccion_empresa','$tlf_empresa','$tifempresa','$email_empresa','$moneda_simbolo');
  $reemplazo = array($estatus_orden, $nombre_email, $fecha_orden, $email_send, $nombre_empresa, $url_empresa,$orden_id,$rif,$productos_orden,$notasusuario,$cliente_dir,$cliente_tlf,$fact_obs,$fact_envio,$fact_subtotal1,$fact_iva,$fact_total,$fact_mod_nombre,$fact_mod_signo,$fact_mod_monto,$fact_subtotal1,$fact_descuento,$fact_subtotal_con_recargos,$direccion_empresa,$tlf_empresa,$tifempresa,$email_empresa,$moneda_simbolo);
  
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
	
	$tool->javaviso(utf8_decode("La información ha sido Enviada "),"cerrar");
	
	


?>