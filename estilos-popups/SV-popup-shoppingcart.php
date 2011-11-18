<?php session_start();
 include('SVsystem/config/dbconfig.php');
 include('SVsystem/class/formulario.php');
 include("SVsystem/class/email.php");
$mail = new email();
 
 
	if(isset($_REQUEST['id1'])){
		
		
		//include('SVG-alcarrito.php');
		
	}
 
 
 
	 if(!isset($_SESSION['CLIENTE_ID'])){
	 
	 		?>
            
            <script type="text/javascript">
			
			alert("Necesita ingresar como usuario registrado para ordenar productos");
			window.close();
			</script>

            
            <?
	 
	 }
	 
	 
	 
$tool = new formulario();
$tool2 = new formulario();
$tool->autoconexion();	 
	 
$data = $tool->simple_db("select moneda_simbolo,moneda_factor,iva,popup_style from preferencias");

/////////////valor del descuento//////////////////////////////
$descuento = $tool->simple_db("SELECT 
  ca.descuento
FROM
  cliente c
  INNER JOIN cliente_categoria ca ON (c.categoria1 = ca.nombre)
WHERE
  c.id = '{$_SESSION['CLIENTE_ID']}'");

if(empty($descuento)) $descuento = 0;

//////////////////////////////////////////////////////////////



		
			////llenando el carrito
			
			if(!empty($_REQUEST['id1'])){
			
					if($_SESSION['CARRITO_ID'][0]!=""){
					
					/*	unset($_SESSION['CARRITO_ID']);
						unset($_SESSION['CARRITO_CANT']);
						unset($_SESSION['DATOSC']);
						*/
						////evitar q se repita
						if(!in_array($_REQUEST['id1'],$_SESSION['CARRITO_ID'])){
							
								@array_push($_SESSION['CARRITO_ID'],$_REQUEST['id1']);
								@array_push($_SESSION['CARRITO_CANT'],1);
						}
						
					}else{
					
						$_SESSION['CARRITO_ID'][0]    = $_REQUEST['id1']; 
						$_SESSION['CARRITO_CANT'][0]  = 1; 
					
					}
			}
			///////////////////////
			
			
			if(isset($_REQUEST['final'])){ ///crear orden de compra
			
							$tool2 = new formulario();
							$tool2->dbc = $tool->dbc;		
						
							///////crear orden de compra
							$orden[0] = $_SESSION['CLIENTE_ID'];
							$NOMBRE = $_SESSION['CLIENTE_NOMBRE'];
							$orden[1] = date("Y-m-d H:i:s");
							$FECHA = date("d/m/Y H:i");
							$orden[2] = $_SESSION['PRECIO'] = 0;
							
							 $tool->query("SET AUTOCOMMIT=0"); ////iniciando la transaccion
							 $tool->query("START TRANSACTION");
					
							$tool->insertar2("orden_compra","cliente_id,fecha,monto",$orden);
							$orden_id = $tool->ultimoID;
							
							for($i=0;$i<count($_SESSION['CARRITO_ID']);$i++){
								
								$item[0] = $orden_id;
								$item[1] = $_SESSION['CARRITO_ID'][$i];
								$item[2] = $_SESSION['CARRITO_CANT'][$i];
								
								
								$datapea = $tool2->simple_db("select nombre,precio from producto where id = {$_SESSION['CARRITO_ID'][$i]} ");
								
								$productosc[$i] = $datapea['nombre']; 
								$precionline = $datapea['precio'];
								
								///precio con descuento
								
								$precionline = $precionline - (bcmul($precionline,bcdiv($descuento,100,2),2)  );
								$precionline = $precionline + bcdiv($precionline*$data['iva'],100,2);
								
								/////
								
								$_SESSION['PRECIO']+= ($_SESSION['CARRITO_CANT'][$i]*$precionline);
													
								$tool->insertar2("orden_item","orden_id,prod_id,cantidad",$item);
							
							}
							
							////actualizando el monto de la orden
							$tool->query("update orden_compra set monto = {$_SESSION['PRECIO']} where id = $orden_id ");							

							$tool->query("COMMIT");
							
							///////////////emails
							
							
								/////user
							
							$dat4 = $tool->simple_db("SELECT DISTINCT 
															  c.nombre,
															  c.rif,
															  c.email,
															  (SELECT preferencias.subject_orden_compra_user FROM preferencias) AS etitulo,
															  (SELECT preferencias.prod_orden_compra_user FROM preferencias) AS emensaje,
															  (SELECT preferencias.nombre_empresa FROM preferencias) AS nempresa,
						 									 (SELECT preferencias.url_empresa FROM preferencias) AS urlempresa
															FROM
															  cliente c
															WHERE
															  id = '{$_SESSION['CLIENTE_ID']}' AND 
															  activo = 1");
							
								$losproductos = implode(',',$productosc);
								$rif 			= $dat4['rif'];
								$nombre_email   = $dat4['nombre'];
								$email_send 	= $dat4['email'];
								$nombre_empresa = $dat4['nempresa'];
								$url_empresa = $dat4['urlempresa'];	
								$montocompra = $data['moneda_simbolo'].' '.$_SESSION['PRECIO']; //cambiar 20101120
								
								 $original  = array('$nombre_email', '$email_send','$fecha_orden','$orden_id','$nombre_empresa','$url_empresa','$montocompra','$rif','$id_orden','$productos_orden'); //cambiar 20110310
			 					 $reemplazo = array($nombre_email, $email_send, $FECHA, $orden_id, $nombre_empresa, $url_empresa,$montocompra,$rif,$orden_id,$losproductos); //cambiar 20110310
								
								  $email_subject = str_replace($original, $reemplazo, $dat4['etitulo']);
			  					  $email_content = str_replace($original, $reemplazo, $dat4['emensaje']);

							
							  /////////manda email cliente
								  	$dataemail = $tool->array_query2("select nombre_empresa,mail_compra_cliente from preferencias");
								    $headers  = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
									$headers .= "From: $dataemail[0] <$dataemail[1]>" . "\r\n" .
								 "Reply-To: $dataemail[1]" . "\r\n";
										  
										  mail($dat4['email'],$email_subject,$email_content,$headers);
										  
							
							/////////admin
							$dat4 = $tool->simple_db("SELECT soporte_email as email, subject_orden_compra_admin as titulo,prod_orden_compra_admin AS mensaje
														FROM preferencias 
															");
							
								
							  $email_subject = str_replace($original, $reemplazo, $dat4['titulo']);
							  $email_content = str_replace($original, $reemplazo, $dat4['mensaje']);
							  
							///manda email al admin
							mail($dat4['email'],$email_subject,$email_content,$headers);
							
						
							
							/////////////////////
							
							unset($_SESSION['CARRITO_ID']); 
							unset($_SESSION['CARRITO_CANT']); 
							unset($_SESSION['PRECIO']);
							
			
							$tool->javaviso("Su orden de compra ha sido enviada!","SV-popup-shoppingcart-ok.php");
						
			}
			
			
			if(isset($_REQUEST['delete'])){
			
			
				unset($_SESSION['CARRITO_ID']);
				unset($_SESSION['CARRITO_CANT']);
			
			
			}


			if(isset($_REQUEST['borrar'])){
			
		
						for($i=$_REQUEST['borrar'];$i<count($_SESSION['CARRITO_ID']);$i++){
					
					
							$_SESSION['CARRITO_ID'][$i]   = $_SESSION['CARRITO_ID'][$i+1];
							$_SESSION['CARRITO_CANT'][$i] = $_SESSION['CARRITO_CANT'][$i+1];
								
					
						}
						
						@array_pop ($_SESSION['CARRITO_ID']);
						@array_pop ($_SESSION['CARRITO_CANT']);
										
						if(empty($_SESSION['CARRITO_ID'][0])){
						
							unset($_SESSION['CARRITO_ID']);
							unset($_SESSION['CARRITO_CANT']);
		
						
						}
				
			}

	 
	 


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Su orden de compra</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!--para los estilos de popups-->
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data['popup_style'] ?>" rel="stylesheet" type="text/css">


<script type="text/javascript" src="SVsystem/js/ajax.js"></script>
</head>

<body class="body-popup">
<div class="popup-titulo">Su Orden de Compra</div>


 <div class="popup-instrucciones">Estos son los productos que usted ha elegido comprar. Usted puede cambiar la cantidad y luego&nbsp; recalcular los&nbsp; precios. Tambi&eacute;n puede continuar comprando y dejar estos productos en su carrito de compras mientras sigue viendo nuestro&nbsp; Web Site. Puede&nbsp; volver y finalizar su compra en cualquier momento. Si abandona la&nbsp; p&aacute;gina sin enviar su &oacute;rden de compra &eacute;sta se eliminar&aacute;.</div>


<?php if(count($_SESSION['CARRITO_ID'])>0){ ?> 


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

<!--TABLA DE PRODUCTOS EN LA ORDEN-->

<!--cabecera de la tabla de lista de productos en la orden-->
<tr>
<td width="55%" class="td-headertabla">Nombre del Producto</td>
<td width="8%" class="td-headertabla">
<a href="#" title="modifique la cantidad de productos que desea y luego presione el botón RECALCULAR">Cantidad</a></td>
<td width="13%" class="td-headertabla">Precio (<?php echo $data['moneda_simbolo'] ?>)</td>
<td width="15%" class="td-headertabla">Sub total (<?php echo $data['moneda_simbolo'] ?>)</td>
<td width="9%" class="td-headertabla">Eliminar?</td>
</tr>
<!--cabecera de la tabla-->

 <?php for($i=0;$i<count($_SESSION['CARRITO_ID']);$i++){ 
	
	             
				$DATA = $tool->simple_db("select id,codigo,nombre,precio from producto where id = '{$_SESSION['CARRITO_ID'][$i]}' ");
		
	  			///precio con descuento
	   			$rprecio = $DATA['precio']; // = $DATA['precio'] - (bcmul($DATA['precio'],bcdiv($descuento,100,2),2)  );
	   			$tprecio = (float)($DATA['precio']*$_SESSION['CARRITO_CANT'][$i]);
					  
	   			$TOTAL+=$tprecio;
	
	?>
    
<!--loop producto-->
<tr>
<td class="td-datotabla">
<strong><a href="SV-detalle-producto.php?id=<?php echo $DATA['id'] ?>" title="ver detalle de producto" target="_blank"><?php echo $DATA['nombre'] ?></a></strong>
</td>
<td align="center" class="td-datotabla">
<!--cantidad-->
<input name="cant[]" type="text" onKeyUp="ajaxsend('post','ccantidad.php','i=<?php echo $i ?>&valor='+this.value);" class="cat-form-box" id="cant[]" style="text-align:center" value="<?=$_SESSION['CARRITO_CANT'][$i] ?>" size="2"></td>
<!--fin cantidad-->


<td align="center" class="td-datotabla">
<!--precio del producto-->
<input name="precio1[]" type="hidden" id="precio1[]" value="<?php echo $DATA['precio']; ?>"><?php echo number_format($rprecio,2); ?>
<!--fin precio del producto-->
</td>


<td align="center" class="td-datotabla">
<!--precio del producto x cantidad-->
<?php echo number_format($tprecio,2); ?>
<!--fin precio del producto x cantidad-->
</td>


<td align="center" class="td-datotabla">
<a href="#" onClick="location.replace('SV-popup-shoppingcart.php?borrar=<?php echo $i ?>');" title="eliminar producto de la orden de compra"><img src="http://www.svcmscentral.com/admin/icon/icon-delete.gif" width="16" height="16" border="0"></a>
</td>
</tr>
<!--fin loop producto-->
<?php } ?>
</table>
<!--FIN TABLA DE PRODUCTOS EN LA ORDEN-->

<!--TABLA DE TOTALES-->
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
   <tr>
    <td class="shoppingcart-td-total">&nbsp;</td>
    <td align="right" class="shoppingcart-td-montos">&nbsp;</td>
   </tr>
   <tr>
    <td width="85%" class="shoppingcart-td-total">&nbsp;Sub Total (<?php echo $data['moneda_simbolo'] ?>):</td>
    <td width="15%" align="right" class="shoppingcart-td-montos"><?php echo number_format($TOTAL,2); ?></td>
   </tr>
  
  <?php if($descuento>0){ ?>
  
   <tr>
     <td class="shoppingcart-td-total">Descuento:</td>
     <td align="right" class="shoppingcart-td-montos">
	 <?php  $preciod = $TOTAL - (bcmul($TOTAL,bcdiv($descuento,100,2),2)  ); echo number_format($preciod,2); $TOTAL = $preciod;  ?></td>
   </tr>
   <?php } ?>
   
   <tr>
    <td class="shoppingcart-td-total">Iva (<?php echo $data['moneda_simbolo'] ?>):</td>
    <td align="right" class="shoppingcart-td-montos"> <?php if($data['iva']!=0){ $tiva = bcdiv($TOTAL*$data['iva'],100,2); echo number_format($tiva,2); }else{ echo 0.00; } ?></td>
   </tr>
   <tr>
    <td class="shoppingcart-td-total">Total (<?php echo $data['moneda_simbolo'] ?>): </td>
    <td align="right" class="shoppingcart-td-montos"><?php echo number_format($TOTAL+$tiva,2); $_SESSION['PRECIO'] = (float)$TOTAL+$tiva;  ?></td>
   </tr>
   <tr>
     <td class="shoppingcart-td-total">&nbsp;</td>
     <td align="right" class="shoppingcart-td-montos">&nbsp;</td>
   </tr>
</table>
<!-- FIN TABLA DE TOTALES-->

<div align="center">
 <input onClick="location.replace('SV-popup-shoppingcart.php');" name="Button" type="button" class="popup-form-button" value="Recalcular precios">
 &nbsp; 
 <input onClick="location.replace('SV-popup-shoppingcart.php?final=1');" name="Submit2" type="button" class="popup-form-button" value="Finalizar y enviar solicitud">
 &nbsp; 
 <input onClick="location.replace('SV-popup-shoppingcart.php?delete=1');" name="Submit3" type="button" class="popup-form-button" value="Eliminar toda la orden">
 &nbsp;
<input name="Submit32" type="button" onClick="window.close();" class="popup-form-button" value="Continuar Comprando!">
</div>

  
    <?php 

 }else{

	$tool->javaviso("no existen productos en el pedido");
	$tool->redirect("cerrar");

 }

 ?>


</body>
</html>
<?php $tool->cerrar(); ?>