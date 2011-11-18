<?php session_start();
 include('SVsystem/config/dbconfig.php');
 include('SVsystem/class/tools.php');

$tool = new tools();
$tool->autoconexion();	 
	 
$data = $tool->simple_db("select moneda_simbolo,moneda_factor,date_format(fecha,'%d/%m/%Y') as fecha,iva,popup_style,estatus from preferencias, orden_compra where id = '{$_REQUEST['id']}'");	 
$DATA = $tool->estructura_db("SELECT
							p.id,
							p.precio,
							p.nombre,
							i.cantidad
							FROM
							producto AS p
							Inner Join orden_item AS i ON p.id = i.prod_id
							WHERE
							i.orden_id =  '{$_REQUEST['id']}'");
							
							
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


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Detalle de Su orden de compra</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data['popup_style'] ?>" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">
<div class="popup-titulo">Detalle de su orden de compra realizada el <?php echo $data['fecha'] ?></div>


 <div class="popup-instrucciones">Estos son los productos que orden&oacute;.</div>

 <form>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

<!--TABLA DE PRODUCTOS EN LA ORDEN-->

<!--cabecera de la tabla de lista de productos en la orden-->





<tr>
<td width="55%" class="td-headertabla">Nombre del Producto</td>
<td width="8%" class="td-headertabla">
<a href="#" title="modifique la cantidad de productos que desea y luego presione el botón RECALCULAR">Cantidad</a></td>
<td width="13%" class="td-headertabla">Precio (<?php echo $data['moneda_simbolo'] ?>)</td>
<td width="15%" class="td-headertabla">Sub total (<?php echo $data['moneda_simbolo'] ?>)</td>
</tr>
<!--cabecera de la tabla-->

<!--loop producto-->

<?php for($i=0;$i<count($DATA);$i++){ 
	
	
	   			$rprecio = $DATA[$i]['precio'];
	   			$tprecio = (float)($DATA[$i]['precio']*$DATA[$i]['cantidad']);
					  
	   			$TOTAL+=$tprecio;
?>


<tr>
<td class="td-datotabla">
<strong><a href="SV-detalle-producto.php?id=<?=$DATA[$i]['id'] ?>" title="ver detalle de producto" target="_blank"><?php echo $DATA[$i]['nombre']; ?></a></strong>
</td>
<td align="center" class="td-datotabla"><?php echo $DATA[$i]['cantidad'] ?>
<!--cantidad-->
</td>
<!--fin cantidad-->


<td align="center" class="td-datotabla">
<!--precio del producto-->
<?php echo number_format($rprecio,2); ?>
<!--fin precio del producto-->
</td>


<td align="center" class="td-datotabla">
<!--precio del producto x cantidad-->
<?php echo number_format($tprecio,2); ?>
<!--fin precio del producto x cantidad-->
</td>
</tr>
<!--fin loop producto-->
<?php } ?>



</table>
<!--TABLA DE PRODUCTOS EN LA ORDEN-->



<!--TABLA DE TOTALES-->
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
   <tr>
    <td class="shoppingcart-td-total">&nbsp;</td>
    <td align="right" class="shoppingcart-td-montos">&nbsp;</td>
   </tr>
   <tr>
    <td width="85%" class="shoppingcart-td-total">Sub Total (<?php echo $data['moneda_simbolo'] ?>):</td>
    <td width="15%" align="right" class="shoppingcart-td-montos"><?php echo number_format($TOTAL,2); ?></td>
   </tr>
  
  
    <?php if($descuento>0){ ?>
  
   <tr>
     <td class="shoppingcart-td-total">Total Descuentos:</td>
     <td align="right" class="shoppingcart-td-montos">
	 <?php  $preciod = $TOTAL - (bcmul($TOTAL,bcdiv($descuento,100,2),2)  ); echo number_format($preciod,2); $TOTAL = $preciod;  ?></td>
   </tr>
   <?php } ?>
  
  
   <tr>
    <td class="shoppingcart-td-total">Iva (<?php echo $data['moneda_simbolo'] ?>):</td>
    <td align="right" class="shoppingcart-td-montos"><?php if($data['iva']!=0){ $tiva = bcdiv($TOTAL*$data['iva'],100,2); echo number_format($tiva,2); }else{ echo 0.00; } ?></td>
   </tr>
   <tr>
    <td class="shoppingcart-td-total">Total (<?php echo $data['moneda_simbolo'] ?>): </td>
    <td align="right" class="shoppingcart-td-montos"><?php echo number_format($TOTAL+$tiva,2);  ?></td>
   </tr>
   <tr>
    <td class="shoppingcart-td-total">Status de Su orden:</td>
    <td align="right" class="shoppingcart-td-montos"><font color="#003366"><?php echo $data['estatus'] ?></font></td>
   </tr>
</table>
<!-- FIN TABLA DE TOTALES-->



<div align="center">&nbsp;&nbsp; &nbsp;
<input name="Submit32" type="button" onClick="window.close();" class="popup-form-button" value="OK">
</div>
</form>




</body>
</html>
