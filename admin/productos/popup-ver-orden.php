<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools('db');

$cliente = $tool->simple_db("SELECT 
  c.id,
  c.rif,
  c.nombre,
  c.tlf1,
  c.tlf2,
  ca.descuento,
  o.monto,
  concat(direccion,' ',ciudad,' ',pais) as direccion
FROM
  `orden_compra` o
  INNER JOIN `cliente` c ON (o.cliente_id = c.id) 
  left Join cliente_categoria  AS ca ON ca.nombre = c.categoria1
  where o.id = {$_REQUEST['id']}");
  
 
$datos = $tool->simple_db("select moneda_simbolo,moneda_factor,iva from orden_compra,preferencias");
 
  
  $query = "select p.id,p.nombre,p.codigo,p.precio,o.cantidad from orden_item o inner join producto p on (o.prod_id = p.id)
 		  where orden_id = {$_REQUEST['id']}";
  $tool->query($query);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Ver Orden de Compra de <? echo $datos['nombre']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
<!--

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function custom_print() {
    if (document.all) {
        if (navigator.appVersion.indexOf("5.0") == -1) {
            var OLECMDID_PRINT = 6;
            var OLECMDEXECOPT_DONTPROMPTUSER = 2;
            var OLECMDEXECOPT_PROMPTUSER = 1;
            var WebBrowser = "<OBJECT ID=\"WebBrowser1\" WIDTH=0 HEIGHT=0 CLASSID=\"CLSID:8856F961-340A-11D0-A96B-00C04FD705A2\"></OBJECT>";
            document.body.insertAdjacentHTML("beforeEnd", WebBrowser);
            WebBrowser1.ExecWB(6, 2);
            WebBrowser1.outerHTML = "";
        } else {
            self.print();
        }
    } else {
        self.print();
    }
}
//-->
</script>


</head>

<body class="body-popup" style="filter:progid:DXImageTransform.Microsoft.Gradient(startColorstr='#DCE5E6', endColorstr='#ffffff', gradientType='0');">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td class="td-titulo-popup">Ver Detalles de  Orden de compra # <? echo $_REQUEST['id']; ?></td>
  </tr>
  <tr>
   <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
     <tr>
      <td width="17%" class="td-form-title">Cliente</td>
      <td width="83%" class="td-content"><?php echo $cliente["nombre"]; ?> <a href="javascript:popup('../usuarios/detallec.php?ide=<?php echo $cliente["id"]; ?>','detalle','500','550');"><img src="../icon/icon-lupa.gif" alt="ver datos del cliente" width="16" height="16" border="0" align="absmiddle"></a></td>
     </tr>
     <tr>
      <td class="td-form-title">C&eacute;dula / Rif</td>
      <td class="td-content"><?php echo $cliente["rif"]; ?></td>
     </tr>
     <tr>
      <td class="td-form-title">Direcci&oacute;n</td>
      <td class="td-content"><?php echo $cliente["direccion"]; ?></td>
     </tr>
     <tr>
      <td class="td-form-title">Tel&eacute;fonos</td>
      <td class="td-content"><?php echo $cliente["tlf1"]; ?><?php if($cliente["tlf2"]!="") echo '/ '.$cliente["tlf_2"]; ?></td>
     </tr>
     <tr>
      <td class="td-form-title">Detalle de los productos ordenados</td>
      <td class="td-content">
      
      
      
      
      <table width="100%" border="0" cellspacing="3" cellpadding="0">
       <tr>
        <td width="36%" class="td-headertabla">Producto</td>
        <td width="13%" align="center" class="td-headertabla">Cantidad</td>
        <td width="26%" align="center" class="td-headertabla">Precio</td>
        <td width="25%" align="center" class="td-headertabla">Sub total</td>
       </tr>
       
       
       <?php while($row = mysql_fetch_assoc($tool->result)){  ?>  
       
       <tr>
        <td class="td-content"><strong><?php echo $row['nombre'] ?></strong> <a href="<?php echo $_SESSION['SURL'].'/'; ?>SV-detalle-producto-print.php?id=<?php echo $row['id'] ?>" target="_blank"><img src="../icon/icon-lupa.gif" alt="ver producto" width="16" height="16" border="0" align="absmiddle"></a></td>
        <td align="center" class="td-content"><?php echo $row['cantidad'] ?></td>
        <td align="right" class="td-content"><?php $preal =  $row['precio']*$datos['moneda_factor']; echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($preal,2); ?></td>
        <td align="right" class="td-content"><?php $sreal =  $preal*$row['cantidad']; echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($sreal,2); $stotal+= $sreal; ?></td>
       </tr>
       
       
       <?php } ?>
      </table></td>
     </tr>
     <tr>
      <td class="td-form-title">Sub Total Orden</td>
      <td class="td-content"><?php echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($stotal,2); ?></td>
     </tr>
     
     <?php if($cliente['descuento']>0){ ?>
     <tr>
       <td class="td-form-title">Precio con descuento :</td>
       <td class="td-content"> 
	   <?php  $preciod = $stotal - (bcmul($stotal,bcdiv($cliente['descuento'],100,2),2)  ); echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($preciod,2); $stotal = $preciod;  ?>
	   </td>
     </tr>
     <?php } ?>
     
     
     <tr>
      <td class="td-form-title">IVA</td>
      <td class="td-content"><?php echo $datos['moneda_simbolo'] ;?> <?php if($datos['iva']!=0){ $tiva = bcdiv($stotal*$datos['iva'],100,2); echo number_format($tiva,2); }else{ echo 0.00; } ?></td>
     </tr>
    

     
     <tr>
      <td class="td-form-title"><font size="3"><strong>TOTAL</strong></font></td>
      <td class="td-content"><?php echo $datos['moneda_simbolo'] ;?>
        <?php echo number_format($stotal+$tiva-$cliente['montocd'],2);  ?></td>
     </tr>
     <tr>
      <td>&nbsp;</td>
      <td><a href="#"><img src="../icon/icon-print.gif" alt="imprimir orden" width="16" height="16" border="0" onClick="custom_print()"></a>      <input name="Submit2" type="button" onClick="window.close();" class="form-button" value="Cerrar"></td></tr>
    </table>
   </td>
  </tr>
 </table>
</body>
</html>
<?php $tool->cerrar(); ?>