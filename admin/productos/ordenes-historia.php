<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();

$dats = $tool->simple_db("select iva,moneda_simbolo from preferencias ");
$moneda = $dats['moneda_simbolo'];

if(!empty($_REQUEST['borrar'])){ $tool->query("delete from factura where id = {$_REQUEST['borrar']} "); $tool->javaviso("Factura Borrada!","ordenes-historia.php"); }
	 
	
	 $query = "SELECT 
					  f.nombre,
					  f.cliente_id,
					  f.rif,
					  m.valor,
					  date_format(f.fecha,'%d/%m/%Y') as fecha,
					  format(f.precio_envio,2) as envio,
					  group_concat(i.producto) AS productos,
					  (group_concat(i.cantidad)) as cants,
					  format(f.iva,2) as iva,
					  format(f.total,2) as total,
					  f.nfactura,
					  f.id
					FROM
					  factura f
					  INNER JOIN factura_item i ON (f.id = i.factura_id)
					  INNER JOIN factura_mod m ON (f.id = m.factura_id)
					GROUP BY
					  f.id";
   

	

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
	
		location.replace('ordenes.php?filtro='+valor);
	
	}
</script>
<script language="JavaScript" type="text/javascript">
	function borrar(id){
	
	  if (confirm("Esta seguro que desea borrar la orden de compra con el numero "+id)) {
	  
	  ajaxsend("post","borrar_orden.php","id="+id);
	  
	  alert("Orden de compra Borrada!");
	  location.replace('ordenes.php');
	  
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
//-->
</script>



</head>

<body>
<?php include ("../n-encabezado.php")?>
<div id="ncuerpo" style="width:100%;">

<div id="ncontenedor" style="width:99%; margin:0 auto 0 auto;">





<div id="ntitulo">Hist&oacute;rico de &oacute;rdenes&nbsp; procesadas</div>
<div id="ninstrucciones">
<p>En este listado usted podrá ver todas las  órdenes que ha procesado con mucho mayor detalle.</p>
</div>


<div id="ncontenido">
<div id="nbotonera">
Ordenar por 
<select name="ordenar" class="form-box" id="ordenar">
                <option>Fecha (Mas recientes de primero)</option>
                <option>Fecha (Mas recientes de &uacute;ltimo)</option>
                <option>Cliente A&gt;Z</option>
                <option>Cliente Z&lt;A</option>
                <option>Monto (Menores de primero)</option>
                <option>Monto (Menores de &uacute;ltimo)</option>
                <option>Cantidad de Productos (Menores de primero)</option>
                <option>Cantidad de Productos (Menores de &uacute;ltimo)</option>
              </select>
</div>



            <?php 
		
		$tool->query($query);
		
		if($tool->nreg>0){
		
		
		?>
           
           
             <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
               <td width="5%" class="td-headertabla">[ ]</td>
               <td width="4%" class="td-headertabla">ID</td>
               <td width="7%" class="td-headertabla">Fecha</td>
               <td width="14%" class="td-headertabla">Cliente</td>
               <td width="29%" class="td-headertabla">Productos</td>
               <td width="12%" class="td-headertabla">Monto Recargo</td>
               <td width="11%" class="td-headertabla">Monto Env&iacute;o</td>
               <td width="8%" class="td-headertabla">IVA</td>
               <td width="10%" class="td-headertabla">Monto total</td>
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
               <td class="td-content"> 

				<a href="#" onClick="popup('popup-ver-orden-readonly.php?id=<?php echo $row['nfactura']; ?>','ordenes',690,960)" title="VER detalles de esta orden de compra"><img src="../icon/icon-prod-view.gif" width="16" height="16" border="0"></a>&nbsp;<img title="Borrar Factura Proforma" style="cursor:pointer" src="../icon/icon-delete.gif" onClick="location.replace('ordenes-historia.php?borrar=<?php echo $row['id']; ?>');" width="16" height="16" border="0"></td>
               <td class="td-content"><?php echo $row['nfactura']; ?></td>
               <td class="td-content"><?php echo $row['fecha']; ?></td>
               <td class="td-content"><a href="javascript:popup('../usuarios/detallec.php?ide=<?php echo $row["cliente_id"]; ?>','detalle','500','550');"><img src="../icon/icon-lupa.gif" alt="ver datos del cliente" width="16" height="16" border="0" align="absmiddle"></a><?php echo $row['nombre']; ?></td>
               <td class="td-content"><?php echo $productos; ?></td>
               <td align="right" class="td-content">&nbsp;<?php echo $moneda ?>
                 <?php echo $row['valor']; ?></td>
               <td align="right" class="td-content">&nbsp;<?php echo $moneda ?>
                 <?php echo $row['envio']; ?></td>
               <td align="right" class="td-content">&nbsp;<?php echo $moneda ?>
                 <?php echo $row['iva']; ?></td>
               <td align="right" class="td-content">&nbsp;<?php echo $moneda ?>
                 <?php echo $row['total']; ?></td>
             </tr>
              
            <?php 
			
			}
			
			?>
           </table>
            
          <?php    }else{
		 
		 echo "<span class='td-texto1'>No existen ordenes de compra</span>";
		 
		 }?>    




      <center><input name="Reset" type="reset" class="form-button" onClick="history.back();" value="[<] Volver"></center>






<!-- termina ncontenido -->
</div>
<?php // include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>
















































</body>
</html>
<?php $tool->cerrar(); ?>