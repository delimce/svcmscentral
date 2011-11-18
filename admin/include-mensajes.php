
<?php 

	$mensajes = $tool->array_query2("select
							          (select count(*) from  cliente where (origen = 'Inscrito por la página web' or origen = 'Inscrito por la pÃƒÂ¡gina web') and activo = 0) as usuarios,
									  (select count(*) from  orden_compra o where estatus = 'nueva') as ordenes,
									  (select count(*) from  pago where estatus = 0) as pagos,
									  (select count(*) from  articulo where revisado = 0) as articulos,
									  (select count(*) from  mensaje where tipo = 'cliente') as mensa 

									  
									  ");
									  
		  
	$totalm = $tool->suma_array($mensajes);
	$_SESSION['PORDENES'] = $mensajes[1];

?>


<link href="estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>

 <?php if($totalm>0){
 
 	if($totalm>1) $pre = 's';
 
  ?> 
<div id="botonera2" style="position:absolute; left:734px; top:102px; width:161px; height:13px; z-index:1">
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="td-warningbarra"> <a href="#" class="link-amarillo" onMouseOver="MM_showHideLayers('navmensajes','','show')"><?php echo $totalm ?>&nbsp;&iexcl;nuevo<?php echo $pre  ?> registro<?php echo $pre ?>!</a></td>
    </tr>
  </table>
</div>
<?php } ?>
  
<div id="navmensajes" style="position:absolute; left:683px; top:126px; width:220px; height:100px; z-index:2; visibility: hidden;" onClick="MM_showHideLayers('navmensajes','','hide')">
<div class="mens-mensaje-container">
<div class="mens-mensaje-imgcerrar">
<a href="#" title="cerrar"><img src="icon/botonsito-borrar-mensajes.jpg" width="15" height="15" border="0"></a></div>
<?php if($mensajes[0]>0){
			if($mensajes[0]>1) $pre1 = 's';
 ?> 
<div class="nuevomensajediv"><a href="/admin/usuarios/busquedac.php?categoria1=&telefono=&categoria2=&celular=&categoria3=&fax=&pais=&estado=&nombre1=&ciudad=&empresa=&estatus=-1&mail1=&activo=0&direccion=&campos%5B%5D=email&campos%5B%5D=tlf1&campos%5B%5D=celular&campos%5B%5D=fax&campos%5B%5D=ciudad&campos%5B%5D=estado&campos%5B%5D=pais&campos%5B%5D=zip&campos%5B%5D=direccion&band=1&Submit=Buscar" class="link-nuevosmensajes"><?php echo $mensajes[0] ?> nuevo<?php echo $pre1  ?> usuario<?php echo $pre1  ?> registrado<?php echo $pre1  ?></a></div>
<?php } ?>

<?php if($mensajes[1]>0){
		if($mensajes[1]>1){ $pre2 = 's'; $pre22 = 'es'; }
 ?> 
<div class="nuevomensajediv"><a href="/admin/productos/ordenes.php" class="link-nuevosmensajes"><?php echo $mensajes[1] ?> nueva<?php echo $pre2  ?> órden<?php echo $pre22  ?> de compra</a></div>
<?php } ?>

<?php if($mensajes[2]>0){
		if($mensajes[2]>1) $pre3 = 's';
 ?> 
<div class="nuevomensajediv"><a href="/admin/pagos/main.php" class="link-nuevosmensajes"><?php echo $mensajes[2] ?> nuevo<?php echo $pre3  ?> pago<?php echo $pre3  ?></a></div>
<?php } ?>

<?php if($mensajes[3]>0){
			if($mensajes[3]>1) $pre4 = 's';
 ?> 
<div class="nuevomensajediv"><a href="/admin/contenido/arbol.php" class="link-nuevosmensajes"><?php echo $mensajes[3] ?>  nuevo<?php echo $pre4  ?> artículo<?php echo $pre4  ?> </a></div>
<?php } ?>

<?php if($mensajes[4]>0){
			if($mensajes[4]>1) $pre5 = 's';
 ?> 
<div class="nuevomensajediv"><a href="/admin/mensajes/main.php" class="link-nuevosmensajes"><?php echo $mensajes[4] ?>  nuevo<?php echo $pre5  ?> mensaje<?php echo $pre5  ?></a></div>
<?php } ?>

</div>
</div>
