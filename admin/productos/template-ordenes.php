<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();


 if(empty($_REQUEST['filtro'])){
	 
	  if(isset($_REQUEST['iduser'])) $filtro3 = " where o.cliente_id = '{$_REQUEST['iduser']}' ";
 	
	 $query = "SELECT
					o.id,
					date_format(o.fecha,'%d/%m/%Y') as fecha,
					o.estatus,
					sum(i.cantidad) as nprod,
					(o.monto-(o.monto*(ifnull(ca.descuento,0)/100))) as monto,
					c.nombre as cliente
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
					sum(i.cantidad) as nprod,
					(o.monto-(o.monto*(ifnull(ca.descuento,0)/100))) as monto,
					c.nombre as cliente
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



function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

</head>

<body>
<!--IINCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include ("include-menu.php");?>
<?php include ("include-warning.php");?>

<!--INCLUDES-->
<table width="900" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td><img src="../header-productos.jpg"
 width="900" height="130"></td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="76%" bgcolor="#E5ECFA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td class="td-titulo1">Administrar Ordenes de Compra</td>
       </tr>
       <tr>
        <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
           <td class="td-texto1"><p>En esta secci&oacute;n usted podr&aacute; ver
             y eliminar las &oacute;rdenes de compra realizadas por los clientes
             en el
             Web Site. Cada &iacute;cono
             le mostrar&aacute; la
             acci&oacute;n que puede realizar con cada elemento. Las &oacute;rdenes est&aacute;n
             distribuidas por fecha en orden decreciente, es decir que las &uacute;ltimas
             se muestran primero. Cuando le cambie el status a una orden se enviar&aacute;
             un correo al cliente que le informar&aacute; que su orden ha comenzado a
             ser revisada por usted.</p>
             <p>Si usted desea agregar recargos adicionales&nbsp; como impuestos&nbsp; o cargos de env&iacute;o Seleccione el&nbsp; &iacute;cono <img src="../icon/icon-edit.gif" alt="Editar Orden de Compra para agregar recargos o descuentos adicionales" width="16" height="16" border="0" align="absmiddle"> en cada orden y&nbsp;modifique&nbsp; la orden de compra antes de cambiar su status a revisada.</p></td>
          </tr>
          <tr>
           <td>&nbsp;</td>
          </tr>
          <tr>
           <td><span class="span-agregar">Mostrar Ordenes de tipo:</span>
           
           <select name="filtro" class="form-box" id="filtro" onChange="buscar(this.value)">
            <option value="">todas
            <option <?php if($_REQUEST['filtro']=="nueva") echo "selected"; ?> value="nueva">Nueva 
            <option <?php if($_REQUEST['filtro']=="procesada") echo "selected"; ?>  value="procesada">Procesada 
           </select></td>
          </tr>
          <tr>
           <td>
           
           
            <?php 
		
		$tool->query($query);
		
		if($tool->nreg>0){
		
		
		?>
           
           
             <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
               <td width="12%" class="td-headertabla">Acciones</td>
               <td width="7%" class="td-headertabla">ID</td>
               <td width="9%" class="td-headertabla">Fecha</td>
               <td width="30%" class="td-headertabla">Cliente</td>
               <td width="11%" class="td-headertabla"># Prods.</td>
               <td width="17%" class="td-headertabla">Monto</td>
               <td width="14%" class="td-headertabla">Status</td>
              </tr>
              
               <?php 
			
			while($row = mysql_fetch_assoc($tool->result)){
			
			?>
              
              
              <tr>
               <td class="td-content"> 
<a href="javascript:;" title="borrar esta orden de compra. IRREVERSIBLE"><img src="../icon/icon-delete.gif" onClick="borrar(<?php echo $row['id']; ?>)" width="16" height="16" border="0"></a>&nbsp;
<a href="javascript:;" onClick="MM_openBrWindow('popup-ver-orden.php?id=<?php echo $row['id']; ?>','','scrollbars=yes,resizable=yes,width=925,height=550')" title="ver detalles de esta orden de compra"><img src="../icon/icon-edit.gif" alt="Editar Orden de Compra para agregar recargos o descuentos adicionales" width="16" height="16" border="0"></a>&nbsp; 
<a href="../opciones-email.php?esolo=<?php echo $row['email']; ?>" title="enviar correo a este usuario"><img src="../icon/icon-mail.gif" width="16" height="16" border="0"></a></td>
               <td class="td-content"><?php echo $row['id']; ?></td>
               <td class="td-content"><?php echo $row['fecha']; ?></td>
               <td class="td-content"><?php echo $row['cliente']; ?></td>
               <td class="td-content"><?php echo $row['nprod']; ?></td>
               <td class="td-content"><?php echo number_format($row['monto'],2); ?></td>
               <td class="td-content"><select name="select" class="form-box" onChange="cambio_estatus('<?php echo $row['id']; ?>',this.value)">
                 <option  <?php if($row['estatus']=="nueva") echo "selected"; ?> value="nueva">Nueva</option>
                 <option <?php if($row['estatus']=="procesada") echo "selected"; ?> value="procesada">Procesada</option>
               </select></td>
              </tr>
              
            <?php 
			
			}
			
			?>
           </table>
            
          <?php    }else{
		 
		 echo "<span class='td-texto1'>No existen ordenes de compra</span>";
		 
		 }?>           </td>
          </tr>
         </table>        </td>
       </tr>
       <tr>
        <td class="td-footer"><a href="http://www.proyecto-internet.com" target="_blank">Proyecto Internet</a></td>
       </tr>
      </table>     </td>
     </tr>
   </table>
  </td>
 </tr>
</table>


</body>
</html>
<?php $tool->cerrar(); ?>