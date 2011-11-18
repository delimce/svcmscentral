<?php session_start();

	$profile = 'admin'; /////////////// perfil requerido
	include("../../SVsystem/config/setup.php"); ////////setup
	include("../../SVsystem/class/tools.php");

	$tool = new tools('db');


	 if($_POST['opcion']==2){ ///guarda y envia

		include("include-proforma-envio.php");

	}else{

		if(!empty($_REQUEST['id'])) $_SESSION['ORDENIDP'] = $_REQUEST['id'];

	}





$cliente = $tool->simple_db("SELECT
  c.id,
  c.rif,
  c.nombre,
  c.tlf1,
  c.tlf2,
  ca.descuento,
  o.monto,
o.extra1,
o.extra2,
o.extra3,
o.extra4,
o.observaciones,
  concat(direccion,' ',ciudad,' ',pais) as direccion,
  c.ciudad,
  c.pais,
  date_format(o.fecha,'%d/%m/%Y') as fecha
FROM
  `orden_compra` o
  INNER JOIN `cliente` c ON (o.cliente_id = c.id)
  left Join cliente_categoria  AS ca ON ca.nombre = c.categoria1
  where o.id = {$_SESSION['ORDENIDP']}");


$datos = $tool->simple_db("select nombre_empresa,rif_empresa,telefonos,direccion,moneda_simbolo,moneda_factor,iva from orden_compra,preferencias");





  //////verificando si hay una factura proforma guardada

			$fact =  $tool->simple_db("SELECT
										  f.subtotal,
										  f.iva,
										  f.total,
										  f.observaciones,
										  m.nombre,
										  if(m.unidad='%' and m.operacion='+',1, if(m.unidad='%' and m.operacion='-',2,if(m.unidad='monto' and m.operacion='+',3,4))) as ope,
										  FORMAT(m.valor,2) as valor,
										  f.precio_envio as envio
										FROM
										  factura f
										  INNER JOIN factura_mod m ON (f.id = m.factura_id)
										WHERE
										  f.nfactura = {$_SESSION['ORDENIDP']}");

	///////////////



  /////////////detalle
  $query = "select p.id,p.nombre,p.codigo,p.precio,o.cantidad from orden_item o inner join producto p on (o.prod_id = p.id)
 		  where orden_id = {$_SESSION['ORDENIDP']}";
  $tool->query($query);







?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Ver Estado de Cuenta enviado  a<? echo $datos['nombre']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>



<script type="text/javascript" src="../../SVsystem/editor2/tiny_mce.js"></script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "observaciones",
        theme : "advanced",
        language: "es",
        theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
        apply_source_formatting : false,
        remove_script_host : false,
        convert_urls : false,
        inline_styles : true,
		plugins : "autoresize,autolink,lists,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,fullscreen,wordcount,advlist,autosave,style",



		// Theme options
		theme_advanced_buttons1 : "save,restoredraft,|,undo,redo,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,insertdate,inserttime,|,image,media,|,tablecontrols",
		theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,bold,italic,underline,strikethrough,sub,sup",
		theme_advanced_buttons3 : "bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,|,hr,advhr,|,charmap,attribs,styleprops,|,|,|,cleanup,removeformat,preview,code,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "none",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",


plugin_insertdate_dateFormat : "<? echo "%d/%m/%Y"; ?> ",
plugin_insertdate_timeFormat : "%H:%M:%S"



	});
</script>









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
   <td class="td-titulo-popup">Ver  Detalles de  Estado de cuenta # <? echo $_REQUEST['id']; ?> Enviado a <?php echo $cliente["nombre"]; ?></td>
  </tr>
  <tr>
   <td class="td-texto1">Estos son los detalles de la Orden de compra de <?php echo $cliente["nombre"]; ?>. Si la orden de compra es <strong>nueva</strong> usted puede editarla haciendo click en el ícono <img src="../icon/icon-edit.gif" alt="editar" width="16" height="16" align="absmiddle"> en la lista de órdenes de compra. Cierre esta ventana para&nbsp; acceder a esa ventana. La información en esta  ventana es sólo para referencia y control.</td>
  </tr>


  <tr>
   <td>

    <form name="form1" method="post" action="">

   <table width="100%" border="0" cellspacing="5" cellpadding="0">
     <tr>
       <td class="td-form-title">Fecha de la orden</td>
       <td class="td-content"><?php echo $cliente["fecha"]; ?></td>
     </tr>
     <tr>
       <td class="td-form-title">Sus datos</td>
       <td class="td-content"><strong>Nombre:</strong><?php echo $datos['nombre_empresa']  ?>, <strong>Rif:</strong><?php echo $datos['rif_empresa']  ?>.&nbsp;&nbsp; <strong>Dirección:</strong><?php echo $datos['direccion']  ?>.&nbsp; <strong>Tlf:</strong><?php echo $datos['telefonos']  ?></td>
     </tr>
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
       <td class="td-form-title">Ciudad</td>
       <td class="td-content"><?php echo $cliente["ciudad"]; ?></td>
     </tr>
     <tr>
       <td class="td-form-title">Pa&iacute;s</td>
       <td class="td-content"><?php echo $cliente["pais"]; ?></td>
     </tr>

     <tr>
      <td class="td-form-title">Tel&eacute;fonos</td>
      <td class="td-content"><?php echo $cliente["tlf1"]; ?><?php if($cliente["tlf2"]!="") echo '/ '.$cliente["tlf_2"]; ?></td>
     </tr>
     <tr>
      <td class="td-form-title">Detalle de los productos ordenados</td>
      <td class="td-content">

<?
	$varSubtotal = 0;
        $varTotal = 0;
?>

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
        <td align="right" class="td-content"><?php $preal =  $row['precio']; echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($preal,2); ?></td>
        <td align="right" class="td-content"><?php $sreal =  $preal*$row['cantidad']; echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($sreal,2); $stotal+= $sreal; ?></td>
<?	$varSubtotal += $sreal; ?>
       </tr>


       <?php } ?>
      </table></td>
     </tr>
     <tr>
<td class="td-form-title">Datos</td>
<td class="td-content"><?php echo utf8_decode($cliente["extra1"]); ?></td>
</tr>
<tr>
<td class="td-form-title">Datos</td>
<td class="td-content"><?php echo utf8_decode($cliente["extra2"]); ?></td>
</tr>
<tr>
<td class="td-form-title">Datos</td>
<td class="td-content"><?php echo utf8_decode($cliente["extra3"]); ?></td>
</tr>
<tr>
<td class="td-form-title">Datos</td>
<td class="td-content"><?php echo utf8_decode($cliente["extra4"]); ?></td>
</tr>
<tr>
<td class="td-form-title">Observaciones del cliente</td>
<td class="td-content"><?php echo utf8_decode($cliente["observaciones"]); ?></td>
</tr>
<tr>
 <td class="td-form-title">Sub Total Orden</td>
 <td class="td-content"><?php echo $datos['moneda_simbolo'].'&nbsp;';  echo number_format($stotal,2); ?></td>
</tr>

     <?php if($cliente['descuento']>0){ ?>
     <tr>
       <td class="td-form-title">Precio con Descuento</td>
       <td class="td-content">
	   <?php  $preciod = $stotal - (bcmul($stotal,bcdiv($cliente['descuento'],100,2),2)  ); echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($preciod,2); $stotal = $preciod;  ?>	   </td>
           <? $varSubtotal = $varSubtotal - (bcmul($stotal,bcdiv($cliente['descuento'],100,2),2)  ); ?>

     </tr>
     <?php } ?>


     <tr>
       <td colspan="2" class="td-headertabla">Modificadores del Monto de la Orden</td>
     </tr>
     <tr>
       <td class="td-form-title">Modificador Personalizado</td>
       <td class="td-content"><?php echo $fact['nombre'] ?>
         :
         <?php

		 switch($fact['ope']){

			 case 1:
			 echo '+%';
                         $variacionPorcentual = $fact['valor']*$varSubtotal/100;
                         $varSubtotal += $fact['valor']*$varSubtotal/100;
			 break;

			 case 2:
			 echo '-%';
                         $variacionPorcentual = $fact['valor']*$varSubtotal/100;
                         $varSubtotal -= $fact['valor']*$varSubtotal/100;
			 break;

			 case 3:
			 echo '+ '.$datos['moneda_simbolo'];
                         $varSubtotal += $fact['valor'];
			 break;

			 case 4:
			 echo '- '.$datos['moneda_simbolo'];
                         $varSubtotal -= $fact['valor'];
			 break;


		 }

		 ?>

      <?php echo $fact['valor'] ?>
      <? if (isset($variacionPorcentual)) echo '('.number_format($variacionPorcentual,2).')'; ?>

         &nbsp;&nbsp;</td>
     </tr>
     <tr>
       <td class="td-form-title">Costo Fijo de Env&iacute;o</td>
       <td class="td-content"><?php echo $datos['moneda_simbolo'] ;?>
           <?php echo number_format($fact['envio'],2) ?>
           <? $varSubtotal += $fact['envio']; ?>
       </td>
     </tr>
     <tr>
       <td class="td-form-title">Sub total + Recargos</td>
       <td class="td-content">
       <?php echo $datos['moneda_simbolo'] ;?>&nbsp;
       <span id="rec">
       <?/*php if($fact['subtotal']>0){
                 echo $reset = number_format($fact['subtotal'],2);
             }else{
                 echo  $reset = number_format($stotal,2);
             }*/
       ?>
       <?php if($varSubtotal>0){
                 echo $reset = number_format($varSubtotal,2);
             }else{
                 echo  $reset = number_format(0,2);
             }
       ?>
       </span>
       </td>
     </tr>

     <tr>
       <td class="td-form-title">IVA&nbsp;(<?php echo (int) $datos['iva'] ?>%)</td>
       <td class="td-content">
         <?php echo $datos['moneda_simbolo'] ;?>
         <span id="viva"><?= number_format($fact['iva'],2) ?> </span>
           <?php //if($datos['iva']!=0){ $riva = $tiva = bcdiv($stotal*$datos['iva'],100,2);  if($fact['iva']>0)  echo $riva =  number_format($fact['iva'],2); else echo $riva = number_format($tiva,2); }else{ echo $riva = 0.00; } ?>
           <?php/*
           	if($datos['iva']!=0){
                    $riva = $tiva = bcdiv($varSubtotal*$datos['iva'],100,2);
                    if($fact['iva']>0){
                        echo $riva =  number_format($riva,2);
                    }else{
                        echo $riva = number_format($tiva,2);
                    }
                 }else{
                    echo $riva = 0.00;
                 }
                 */
                  ?>
  &nbsp;        </td>
     </tr>
     <tr>
       <td class="td-form-title"><font size="3"><strong>TOTAL</strong></font></td>
       <td class="td-content"><?php echo $datos['moneda_simbolo'] ;?>&nbsp;
         <span id="preciot">
           <?php //if($fact['total']>0){  echo number_format($fact['total'],2); $_SESSION['MONTOINICIO'] = $fact['total'];  }else{ echo number_format($stotal+$tiva-$cliente['montocd'],2);  $_SESSION['MONTOINICIO'] = $stotal+$tiva-$cliente['montocd']; } ?>
           <?php if($fact['total']>0){
                     echo number_format($varSubtotal+$fact['iva'],2);
                     $_SESSION['MONTOINICIO'] = $fact['total'];
                 }else{
                     echo number_format($varSubtotal+$riva,2);
                     $_SESSION['MONTOINICIO'] = $varSubtotal+$riva;
                 }
           ?>
           </span>
           <input name="opcion" type="hidden" id="opcion" value="1">
           </td>
     </tr>
     <tr>
       <td class="td-form-title"> Observaciones</td>
       <td class="td-content">
     <textarea name="observaciones" cols="90" rows="3" class="form-box" id="observaciones"><?=$fact['observaciones']  ?>
         </textarea></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><input name="Submit3" type="button" onClick="custom_print()" class="form-button" value="Imprimir">
         &nbsp;&nbsp;
<input name="Submit4" type="button" onClick="enviar();" class="form-button" value="Volver a Enviar Información al Usuario">
         &nbsp; &nbsp;

         <input name="Submit5" type="button" onClick="window.close();" class="form-button" value="Cerrar"></td>
     </tr>
    </table>

</form>

    </td>
  </tr>
 </table>
</body>
</html>
<script type="text/javascript">


	function enviar(){

		document.getElementById('opcion').value = 2;
		document.form1.submit();

	}


</script>

<?php $tool->cerrar(); ?>