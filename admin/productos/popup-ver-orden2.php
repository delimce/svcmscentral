<?php session_start();

	$profile = 'admin'; /////////////// perfil requerido
	include("../../SVsystem/config/setup.php"); ////////setup
	include("../../SVsystem/class/tools.php");

	$tool = new tools('db');



	if($_POST['opcion']==1){ ///solo guarda
		include("include-proforma-guardar.php");
		$tool->cerrar();
		$tool->javaviso("La información ha sido guardada","actualizar");

	}else if($_POST['opcion']==2){ ///guarda y envia
		include("include-proforma-enviar.php");

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


$datos = $tool->simple_db("select nombre_empresa,rif_empresa,telefonos,direccion,moneda_simbolo,moneda_factor,iva from preferencias");





  //////verificando si hay una factura proforma guardada

			$fact =  $tool->simple_db("SELECT
										  f.subtotal,
										  f.iva,
										  f.total,
										  f.observaciones,
										  m.nombre,
										  if(m.unidad='%' and m.operacion='+',1, if(m.unidad='%' and m.operacion='-',2,if(m.unidad='monto' and m.operacion='+',3,4))) as ope,
										  FORMAT(m.valor,2) as valor,
										  FORMAT(f.precio_envio,2) as envio
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
<title>Ver Orden de Compra de <? echo $datos['nombre']?></title>
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


function calcularp() {

	var subtotal,total2,iva,toti,venvio,vmod;

  	oXML = AJAXCrearObjeto();
	oXML.open('post', 'calcularp.php');
	oXML.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	oXML.onreadystatechange = function(){
		if (oXML.readyState == 4 && oXML.status == 200) {


			 venvio = Number(document.getElementById('envio').value);
			 vmod = Number(document.getElementById('valor').value);

			 total2 = Number(oXML.responseText);

			if(total2>=0 && venvio>=0 && vmod>=0){

	 		 iva = Number((total2.toFixed(2))*<?php echo bcdiv($datos['iva'],100,2) ?>);

			 toti = Number(total2+iva);

			 document.getElementById('preciof').value = toti.toFixed(2);
			 document.getElementById('preciot').innerHTML = toti.toFixed(2);


			 document.getElementById('rec').innerHTML = total2.toFixed(2);
			 document.getElementById('ivaf').value = iva.toFixed(2);
			 document.getElementById('viva').innerHTML = iva.toFixed(2);

			}else if(venvio<0){

			 alert("ERROR: El costo de envio no puede ser un valor negativo");

			 }else if(vmod<0){

			 alert("ERROR: El modificador no puede ser un valor negativo");


			}else{

				alert('ERROR: Alguno de los cargos adicionales que está intentando cargar no son válidos: \n 1.- No puede restar más del 100% o un monto mayor que el monto del subtotal. \n	2.- NO puede colocar un costo de envío negativo.');

			}

				vaciar(oXML);

		}
	 }

	oXML.send('tipo='+document.getElementById('tipo').value+'&valor='+document.getElementById('valor').value+'&envio='+document.getElementById('envio').value);

 }


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
   <td class="td-titulo-popup">Editar Detalles de  Orden de compra # <? echo $_REQUEST['id']; ?> de <?php echo $cliente["nombre"]; ?></td>
  </tr>
  <tr>
   <td class="td-texto1">Este es el detalle de la orden de compra de <?php echo $cliente["nombre"]; ?>. Aquí usted podrá ver los productos que ha comprado, el precio total de su  orden, el precio con descuento (si aplicare) y <strong>aplicar los modificadores del monto de la orden de compra y el costo de envío que desee</strong>, luego podrá recalcular el  monto total y enviar esta información ya convertida en <strong>&quot;Estado de Cuenta&quot; o&nbsp; &quot;Factura ProForma&quot;</strong> a su cliente informándole del monto total que debe cancelar. También puede agregar una nota con información personalizada.</td>
  </tr>


  <tr>
   <td>

    <form name="form1" method="post" action="">

   <table width="100%" border="0" cellspacing="5" cellpadding="0">
     <tr>
       <td class="td-form-title">Datos de Su Empresa</td>
       <td class="td-content"><strong>Nombre:</strong> <?php echo $datos['nombre_empresa']  ?>, &nbsp;&nbsp;<strong>Rif:</strong> <?php echo $datos['rif_empresa']  ?>.&nbsp;&nbsp; <strong>Direcci&oacute;n:</strong> <?php echo $datos['direccion']  ?>.&nbsp; <strong>Tlf:</strong> <?php echo $datos['telefonos']  ?>&nbsp; &nbsp;<a href="../opciones-admin-identidad.php" title="Editar sus datos (Abandona esta p&aacute;gina)" target="_parent"><img src="../icon/icon-edit.gif" alt="Editar sus datos (Abandona esta p&aacute;gina)" width="16" height="16" border="0" align="absmiddle"></a></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td class="td-form-title">Fecha de la orden</td>
       <td class="td-content"><?php echo $cliente["fecha"]; ?></td>
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

      <table width="100%" border="0" cellspacing="3" cellpadding="0">
       <tr>
        <td width="36%" class="td-headertabla">Producto</td>
        <td width="13%" align="center" class="td-headertabla">Cantidad</td>
        <td width="26%" align="center" class="td-headertabla">Precio</td>
        <td width="25%" align="center" class="td-headertabla">Sub total</td>
       </tr>


       <?php while($row = mysql_fetch_assoc($tool->result)){  ?>

       <tr>
        <td class="td-content"><strong><?php echo $row['nombre'] ?></strong> <a href="<?php echo $_SESSION['SURL'].'/'; ?>SV-detalle-producto.php?id=<?php echo $row['id'] ?>" target="_blank"><img src="../icon/icon-lupa.gif" alt="ver producto" width="16" height="16" border="0" align="absmiddle"></a></td>
        <td align="center" class="td-content"><?php echo $row['cantidad'] ?></td>
        <td align="right" class="td-content"><?php $preal =  $row['precio'];echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($preal,2); ?></td>
        <td align="right" class="td-content"><?php $sreal =  $preal*$row['cantidad']; echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($sreal,2); $stotal+= $sreal; ?></td>
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
	   <?php  $preciod = $stotal - (bcmul($stotal,bcdiv($cliente['descuento'],100,2),2)  ); echo $datos['moneda_simbolo'].'&nbsp;'; echo number_format($preciod,2); $stotal = $preciod;  ?>
       </td>

     </tr>
     <?php } ?>


     <tr>
       <td colspan="2" class="td-headertabla">Modificadores del Monto de la Orden</td>
     </tr>
     <tr>
       <td class="td-form-title">Modificador Personalizado</td>
       <td class="td-content"><input name="mod1" type="text" class="form-box" id="mod1" value="<?=$fact['nombre']  ?>" size="20" OnFocus="clearText(this)">
         :
         <select name="tipo" class="form-box" id="tipo">
        <option>Seleccione</option>
        <option value="1" <?php if($fact['ope']==1)echo 'selected';  ?>>Agregar %</option>
        <option value="2" <?php if($fact['ope']==2)echo 'selected';  ?>>Restar %</option>
        <option value="3" <?php if($fact['ope']==3)echo 'selected';  ?>>Agregar monto fijo</option>
        <option value="4" <?php if($fact['ope']==4)echo 'selected';  ?>>Restar monto fijo</option>
         </select>
      <input name="valor" type="text" class="form-box" id="valor" value="<?=$fact['valor']  ?>" size="5">
         &nbsp;&nbsp;</td>
     </tr>
     <tr>
       <td class="td-form-title">Costo Fijo de Env&iacute;o</td>
       <td class="td-content"><?php echo $datos['moneda_simbolo'] ;?>
           <input name="envio" type="text" class="form-box" id="envio" value="<?=$fact['envio']  ?>" size="5"></td>
     </tr>
     <tr>
       <td class="td-form-title">Sub total + Recargos</td>
       <td class="td-content">
       <?php echo $datos['moneda_simbolo'] ;?>&nbsp;
       <span id="rec">
       <?php if($fact['subtotal']>0)  echo $reset = number_format($fact['subtotal'],2); else echo  $reset = number_format($stotal,2);  ?>
       </span>     </td>
     </tr>

     <tr>
      <td class="td-form-title">IVA&nbsp;(<?php echo (int) $datos['iva'] ?>%)</td>
      	<td class="td-content">
			<?php echo $datos['moneda_simbolo'] ;?>
            <span id="viva">
       		<?php if($datos['iva']!=0){ $riva = $tiva = bcdiv($stotal*$datos['iva'],100,2);  if($fact['iva']>0)  echo $riva =  number_format($fact['iva'],2); else echo $riva = number_format($tiva,2); }else{ echo $riva = 0.00; } ?>
           	</span>
        </td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><input name="Submit1" type="button" onClick="calcularp();" class="form-button" value="Recalcular Total">
         &nbsp;&nbsp;
         <input name="Submit2" type="button" onClick="resetea();" class="form-button" value="Resetear Valores">       </td>
     </tr>
     <tr>
      <td class="td-form-title"><font size="3"><strong>TOTAL</strong></font></td>
      <td class="td-content"><?php echo $datos['moneda_simbolo'] ;?>&nbsp;
      	<span id="preciot">
        <?php if($fact['total']>0){  echo number_format($fact['total'],2); $_SESSION['MONTOINICIO'] = $fact['total'];  }else{ echo number_format($stotal+$tiva-$cliente['montocd'],2);  $_SESSION['MONTOINICIO'] = $stotal+$tiva-$cliente['montocd']; } ?>
        </span>
        <input name="preciof" type="hidden" id="preciof" value="<?php echo $_SESSION['MONTOINICIO']; ?>">
        <input name="porcentajeIva" type="hidden" id="porcentajeIva" value="<?php echo $datos['iva']; ?>">
        <input name="ivaf" type="hidden" id="ivaf" value="<?= $riva ?>">
        <input name="opcion" type="hidden" id="opcion" value="1"></td>
     </tr>
     <tr>
       <td class="td-form-title"> Observaciones<br>
         y Anotaciones Finales</td>
       <td class="td-content">
     <textarea name="observaciones" cols="90" rows="6" class="form-box" id="observaciones"><?=$fact['observaciones']  ?>
         </textarea></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td><input name="Submit3" type="button" onClick="custom_print()" class="form-button" value="Imprimir">
         &nbsp; &nbsp;

 <input name="Submit4" type="button" onClick="calcularp();guardar();" class="form-button" value="Guardar">
         &nbsp; &nbsp;

         <input name="Submit4" type="button" onClick="calcularp();enviar();" class="form-button" value="Guardar y Enviar al Usuario">
         &nbsp; &nbsp;

         <input name="Submit5" type="button" onClick="window.close();" class="form-button" value="Cancelar"></td>
     </tr>
    </table>

</form>

    </td>
  </tr>
 </table>
</body>
</html>
<script type="text/javascript">
	function resetea(){

		 document.getElementById('valor').value = '<?=$fact['valor']  ?>';
		 document.getElementById('envio').value = '<?=$fact['envio']  ?>';
		 document.getElementById('mod1').value = '<?=$fact['nombre']  ?>';

		  document.getElementById('preciof').value = <?php echo  $_SESSION['MONTOINICIO'] ; ?>;
		  document.getElementById('preciot').innerHTML = '<?php echo number_format( $_SESSION['MONTOINICIO'],2) ?>';
		  document.getElementById('viva').innerHTML = '<?php echo $riva ?>';
		  document.getElementById('rec').innerHTML = '<?php echo $reset ?>';

	}

	function guardar(){

		document.getElementById('opcion').value = 1;
		document.form1.submit();

	}

	function enviar(){

		document.getElementById('opcion').value = 2;
		document.form1.submit();

	}


</script>

<?php $tool->cerrar(); ?>