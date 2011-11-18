<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();

$dats = $tool->simple_db("select iva,moneda_simbolo from preferencias ");
$moneda = $dats['moneda_simbolo'];
$iva = $dats['iva'];

 if(empty($_REQUEST['filtro'])){
	 
	  if(isset($_REQUEST['iduser'])) $filtro3 = " where o.cliente_id = '{$_REQUEST['iduser']}' ";
 	
	 $query = "SELECT
					o.id,
					date_format(o.fecha,'%d/%m/%Y') as fecha,
					o.estatus,
					(select group_concat(p2.nombre) from producto p2 inner join orden_item o2 on (p2.id = o2.prod_id) inner join orden_compra o3 on (o3.id = o2.orden_id)  where o3.id = o.id group by o3.id ) as productos,
					(group_concat(i.cantidad)) as cants,
					ca.descuento,
				    (select sum(p2.precio*o2.cantidad) from producto p2 inner join orden_item o2 on (p2.id = o2.prod_id) inner join orden_compra o3 on (o3.id = o2.orden_id)  where o3.id = o.id group by o3.id ) as monto,
					c.nombre as cliente,
                    c.email,
					c.id as cliente_id
					FROM
					orden_compra AS o 
					left Join orden_item AS i ON o.id = i.orden_id
                    left Join cliente  AS c ON o.cliente_id = c.id
                    left Join cliente_categoria  AS ca ON ca.nombre = c.categoria1
					$filtro3
					group by o.id";
   

 }else{
	 
  			 $query = "select o.id,
					date_format(o.fecha,'%d/%m/%Y') as fecha,
					o.estatus,
				    (select group_concat(p2.nombre) from producto p2 inner join orden_item o2 on (p2.id = o2.prod_id) inner join orden_compra o3 on (o3.id = o2.orden_id)  where o3.id = o.id group by o3.id ) as productos,
					(group_concat(i.cantidad)) as cants,
					ca.descuento,
				    (select sum(p2.precio*o2.cantidad) from producto p2 inner join orden_item o2 on (p2.id = o2.prod_id) inner join orden_compra o3 on (o3.id = o2.orden_id)  where o3.id = o.id group by o3.id ) as monto,
					c.nombre as cliente,
                    c.email,
					c.id as cliente_id
					FROM
					orden_compra AS o 
					left Join orden_item AS i ON o.id = i.orden_id
                    left Join cliente  AS c ON o.cliente_id = c.id
                    left Join cliente_categoria  AS ca ON ca.nombre = c.categoria1
					where o.estatus = '{$_REQUEST['filtro']}' group by o.id";
 }	
	




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Administrar Ordenes de Compra</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>

<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	function buscar(valor){
	
		location.replace('<?php echo $PHP_SELF ?>?filtro='+valor);
	
	}
</script>
<script language="JavaScript" type="text/javascript">
	function borrar(id){
	
	  if (confirm("Esta seguro que desea borrar la orden de compra con el numero "+id)) {
	  
	  ajaxsend("post","borrar_orden.php","id="+id);
	  
	  alert("Orden de compra Borrada!");
	  location.replace('<?php echo $PHP_SELF ?>');
	  
	  }else{
	  
	  
	  return false;
	  
	  }
	}
	
	function cambio_estatus (id,estado){
	
	
	  ajaxsend("post","cambio_estado.php","id="+id+"&estado="+estado);
	  
	  alert("Estatus cambiado!");
	  //location.replace('ordenes.php?filtro='+estado);
		
	}
	
	
	
	
	</script>
<script language="JavaScript" type="text/JavaScript">
<!--


function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);



function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>



</head>

<body>



<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Orden de compra &gt; Factura proforma</div>
<div id="ninstrucciones">
<p>En esta secci&oacute;n usted podr&aacute; ver y eliminar las &oacute;rdenes de compra realizadas por los clientes en el  Web Site. Cada &iacute;cono
  le mostrar&aacute; la acci&oacute;n que puede realizar con cada elemento. Las &oacute;rdenes est&aacute;n  distribuidas por fecha en orden decreciente, es decir que las &uacute;ltimas se muestran primero. </p>

 <p>Usted puede <strong>editar los detalles de la orden de compra</strong> para agregar los costos de env&iacute;o&nbsp; y otros modificadores al monto de la orden. Entonces podr&aacute; enviar a su cliente un correo detallado (Factura proforma) con todos los datos de la compra y el monto definitivo que el cliente ha de cancelar. </p>
             <p>Una vez que  usted guarde y env&iacute;e a su cliente los datos de la factura proforma, podr&aacute; procesarla y su clente recibir&aacute; el correo con todos los datos, incluyendo los impuestos&nbsp; y modificadores. Es entonces cuando su cliente podr&aacute; realizar el pago correspondiente desde su P&aacute;gina de Usuario.</p> 
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">

Mostrar Ordenes de tipo:
           
           <select name="filtro" class="form-box" id="filtro" onChange="buscar(this.value)">
            <option value="">todas
            <option <?php if($_REQUEST['filtro']=="nueva") echo "selected"; ?> value="nueva">Nueva 
            <option <?php if($_REQUEST['filtro']=="procesada") echo "selected"; ?>  value="procesada">Procesada 
           </select>


<a href="ordenes-historia.php" class="boton" title="Ver Historia de Órdenes Procesadas"> <img src="../icon/icon-aut.gif" width="16" height="16" border="0" align="absmiddle"> Ver Historia de Órdenes Procesadas</a>


</div>



<?php 
		
		$tool->query($query);
		
		if($tool->nreg>0){
		
		
		?>
           
           
             <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
               <td width="11%" class="td-headertabla">Acciones</td>
               <td width="7%" align="center" class="td-headertabla">ID</td>
               <td width="7%" align="center" class="td-headertabla">Fecha</td>
               <td width="21%" class="td-headertabla">Cliente</td>
               <td width="30%" class="td-headertabla">Productos en la Orden</td>
               <td width="13%" class="td-headertabla">Monto Neto</td>
               <td width="11%" class="td-headertabla">Status</td>
              </tr>
              
               <?php 
			
			while($row = mysql_fetch_assoc($tool->result)){
				
				
				$productos = '';
				
				
				////ordenando productos y cantidades
				$pp = explode(',',$row['productos']);
				$cc = explode(',',$row['cants']);
				
				for($j=0;$j<count($pp);$j++){
						$productos.= $pp[$j].'&nbsp;('.$cc[$j].')<br>'; 
							
				}
			
			?>
              
              
              <tr>
               <td class="td-content"
<?php if($row['estatus']=="nueva"){ ?>
style="background-color:#ebf1f6"
<?php } ?>> 


<a href="javascript:;" class="instruccion" style="cursor:pointer"><img src="../icon/icon-delete.gif" onClick="borrar(<?php echo $row['id']; ?>)" width="16" height="16" border="0"><span>Borrar esta orden de compra de la base de datos.</span></a>



<?php if($row['estatus']=="nueva"){ ?>
<a href="javascript:;" onClick="MM_openBrWindow('popup-ver-orden2.php?id=<?php echo $row['id']; ?>','','scrollbars=yes,resizable=yes,width=960,height=780')" class="instruccion" style="cursor:pointer"><img src="../icon/icon-edit.gif" width="16" height="16" border="0"><span><strong>Editar detalles de esta orden de compra:</strong> Revisar los detalles de la compra, agregar cargos o descuentos, agregar costo de envío, agregar observaciones o instrucciones y  enviar al cliente en forma de ESTADO DE CUENTA, para que éste pueda reportar el pago relacionado.</span></a>&nbsp;
<?php } ?>


<?php if($row['estatus']=="procesada"){ ?>
<a href="javascript:;" onClick="MM_openBrWindow('popup-ver-orden-readonly.php?id=<?php echo $row['id']; ?>','','scrollbars=yes,resizable=yes,width=960,height=780')" class="instruccion" style="cursor:pointer"><img src="../icon/icon-lupa.gif" width="16" height="16" border="0"><span>Ver detalles de esta orden de compra ya procesada</span></a>&nbsp;
<?php } ?>



<a href="../opciones-sm.php?esolo=<?php echo $row['email']; ?>" class="instruccion" style="cursor:pointer"><img src="../icon/icon-mail.gif" width="16" height="16" border="0"><span>Enviar Email a este usuario</span></a>
</td>

               <td align="center" class="td-content"
<?php if($row['estatus']=="nueva"){ ?>
style="background-color:#ebf1f6"
<?php } ?> >

<?php if($row['estatus']=="nueva") echo "<b>".$row['id']."</b>"; else echo $row['id']; ?></td>




               <td align="center" class="td-content"
<?php if($row['estatus']=="nueva"){ ?>
style="background-color:#ebf1f6"
<?php } ?>
>

<?php if($row['estatus']=="nueva") echo "<b>".$row['fecha']."</b>"; else echo $row['fecha']; ?></td>




               <td class="td-content" 
<?php if($row['estatus']=="nueva"){ ?>
style="background-color:#ebf1f6"
<?php } ?>
>



<a href="javascript:;" onClick="popup('../usuarios/detallec.php?ide=<?=$row["cliente_id"] ?>','detalle','500','550');"  class="instruccion"><img src="../icon/icon-lupa.gif" width="16" height="16" border="0" ><span>Ver detalles de este usuario</span></a> <?php if($row['estatus']=="nueva") echo "<b>".$row['cliente']."</b>"; else echo $row['cliente']; ?></td>




               <td class="td-content"
<?php if($row['estatus']=="nueva"){ ?>
style="background-color:#ebf1f6"
<?php } ?>
>

<?php echo $productos; ?></td>



               <td align="right" class="td-content"

<?php if($row['estatus']=="nueva"){ ?>
style="background-color:#ebf1f6"
<?php } ?>
>


&nbsp;<?php echo $moneda ?>                 <?php $monti = $row['monto']-bcdiv($row['monto']*$row['descuento'],100,2); /*$monti = $monti+bcdiv($monti*$iva,100,2); */ echo number_format($monti,2); ?></td>



               <td class="td-content"
<?php if($row['estatus']=="nueva"){ ?>
style="background-color:#ebf1f6"
<?php } ?>

>

<select name="select" class="form-box" onChange="cambio_estatus('<?php echo $row['id']; ?>',this.value)" disabled>
                 <option  <?php if($row['estatus']=="nueva") echo "selected"; ?> value="nueva">Nueva</option>
                 <option <?php if($row['estatus']=="procesada") echo "selected"; ?> value="procesada">Procesada</option>
               </select>








</td>
              </tr>
              
            <?php 
			
			}
			
			?>
           </table>
            
          <?php    }else{
		 
		 echo "<span class='td-texto1'>No existen ordenes de compra</span>";
		 
		 }?> 


























<!-- final nbloque -->
</div>












<!-- termina ncontenido -->
</div>
<?php include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>
</body>
</html>
<?php $tool->cerrar(); ?>