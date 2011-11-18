<?php session_start();
$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

$front = '/SV-detalle-articulo.php';////url relativa del detalle de articulo en el front
$front2 = $_SESSION['SURL'].'/SV-listado-articulos.php';////url relativa del detalle de articulo en el front

	$queryCategorias = "select id,nombre,orden,
	if(c.users = 1,'<img src=\"../icon/icon-flag_green.gif\" title=\"Alimentable\" border=\"0\">','<img src=\"../icon/icon-flag_red.gif\" title=\"No Alimentable\" border=\"0\">') as users,
				  c.users as users2,
	(select count(*) from cont_subcategoria where cat_id = c.id ) as subca,(select count(*) from articulo where cat_nivel = 1 and cat_id = c.id) as art,only_for from cont_categoria c order by orden";
         $categorias = $tool->estructura_db($queryCategorias);
	//echo $queryCategorias;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Administrar &aacute;rbol de contenidos </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
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


<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script type="text/javascript" src="../../SVsystem/js/arbol.js"></script>







<script type="text/javascript">
<!--
function GP_AdvOpenWindow(theURL,winName,ft,pw,ph,wa,il,aoT,acT,bl,tr,trT,slT,pu) { //v3.08
  // Copyright(c) George Petrov, www.dmxzone.com member of www.DynamicZones.com
  var rph=ph,rpw=pw,nlp,ntp,lp=0,tp=0,acH,otH,slH,w=480,h=340,d=document,OP=(navigator.userAgent.indexOf("Opera")!=-1),IE=d.all&&!OP,IE5=IE&&window.print,NS4=d.layers,NS6=d.getElementById&&!IE&&!OP,NS7=NS6&&(navigator.userAgent.indexOf("Netscape/7")!=-1),b4p=IE||NS4||NS6||OP,bdyn=IE||NS4||NS6,olf="",sRes="";
  imgs=theURL.split('|'),isSL=imgs.length>1;aoT=aoT&&aoT!=""?true:false;
  var tSWF='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" ##size##><param name=movie value="##file##"><param name=quality value=high><embed src="##file##" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" ##size##></embed></object>'
  var tQT='<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" ##size##><param name="src" value="##file##"><param name="autoplay" value="true"><param name="controller" value="true"><embed src="##file##" ##size## autoplay="true" controller="true" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>'
  var tIMG=(!IE?'<a href="javascript:'+(isSL?'nImg()':'window.close()')+'">':'')+'<img id=oImg name=oImg '+((NS4||NS6||NS7)?'onload="if(isImg){nW=pImg.width;nH=pImg.height}window.onload();" ':'')+'src="##file##" border="0" '+(IE?(isSL?'onClick="nImg()"':'onClick="window.close()"'):'')+(IE&&isSL?' style="cursor:pointer"':'')+(!NS4&&isSL?' onload="show(\\\'##file##\\\',true)"':'')+'>'+(!IE?'</a>':'')
  var tMPG='<OBJECT classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,02,902" ##size## type="application/x-oleobject"><PARAM NAME="FileName" VALUE="##file##"><PARAM NAME="animationatStart" VALUE="true"><PARAM NAME="transparentatStart" VALUE="true"><PARAM NAME="autoStart" VALUE="true"><PARAM NAME="showControls" VALUE="true"><EMBED type="application/x-mplayer2" pluginspage = "http://www.microsoft.com/Windows/MediaPlayer/" SRC="##file##" ##size## AutoStart=true></EMBED></OBJECT>'
  omw=aoT&&IE5;bl=bl&&bl!=""?true:false;tr=IE&&tr&&isSL?tr:0;trT=trT?trT:1;ph=ph>0?ph:100;pw=pw>0?pw:100;
  re=/\.(swf)/i;isSwf=re.test(theURL);re=/\.(gif|jpg|png|bmp|jpeg)/i;isImg=re.test(theURL);re=/\.(avi|mov|rm|rma|wav|asf|asx|mpg|mpeg)/i;isMov=re.test(theURL);isEmb=isImg||isMov||isSwf;
  if(isImg&&NS4)ft=ft.replace(/resizable=no/i,'resizable=yes');if(b4p){w=screen.availWidth;h=screen.availHeight;}
  if(wa&&wa!=""){if(wa.indexOf("center")!=-1){tp=(h-ph)/2;lp=(w-pw)/2;ntp='('+h+'-nWh)/2';nlp='('+w+'-nWw)/2'}if(wa.indexOf("bottom")!=-1){tp=h-ph;ntp=h+'-nWh'} if(wa.indexOf("right")!=-1){lp=w-pw;nlp=w+'-nWw'}
    if(wa.indexOf("left")!=-1){lp=0;nlp=0} if(wa.indexOf("top")!=-1){tp=0;ntp=0}if(wa.indexOf("fitscreen")!=-1){lp=0;tp=0;ntp=0;nlp=0;pw=w;ph=h}
    ft+=(ft.length>0?',':'')+'width='+pw;ft+=(ft.length>0?',':'')+'height='+ph;ft+=(ft.length>0?',':'')+'top='+tp+',left='+lp;
  } if(IE&&bl&&ft.indexOf("fullscreen")!=-1&&!aoT)ft+=",fullscreen=1";
  if(omw){ft='center:no;'+ft.replace(/lbars=/i,'l=').replace(/(top|width|left|height)=(\d+)/gi,'dialog$1=$2px').replace(/=/gi,':').replace(/,/gi,';')}
  if (window["pWin"]==null) window["pWin"]= new Array();var wp=pWin.length;pWin[wp]=(omw)?window.showModelessDialog(imgs[0],window,ft):window.open('',winName,ft);
  if(pWin[wp].opener==null)pWin[wp].opener=self;window.focus();
  if(b4p){ if(bl||wa.indexOf("fitscreen")!=-1){pWin[wp].resizeTo(pw,ph);pWin[wp].moveTo(lp,tp);}
    if(aoT&&!IE5){otH=pWin[wp].setInterval("window.focus();",50);olf='window.setInterval("window.focus();",50);'}
  } sRes='\nvar nWw,nWh,d=document,w=window;'+(bdyn?';dw=parseInt(nW);dh=parseInt(nH);':'if(d.images.length == 1){var di=d.images[0];dw=di.width;dh=di.height;\n')+
    'if(dw>0&&dh>0){nWw=dw+'+(IE?12:NS7?15:NS6?14:0)+';nWh=dh+'+(IE?32:NS7?50:NS6?1:0)+';'+(OP?'w.resizeTo(nWw,nWh);w.moveTo('+nlp+','+ntp+')':(NS4||NS6?'w.innerWidth=nWw;w.innerHeight=nWh;'+(NS6?'w.outerWidth-=14;':''):(!omw?'w.resizeTo(nWw,nWh)':'w.dialogWidth=nWw+"px";w.dialogHeight=nWh+"px"')+';eh=dh-d.body.clientHeight;ew=dw-d.body.clientWidth;if(eh!=0||ew!=0)\n'+
  	(!omw?'w.resizeTo(nWw+ew,nWh+eh);':'{\nw.dialogWidth=(nWw+ew)+"px";\nw.dialogHeight=(nWh+eh)+"px"}'))+(!omw?'w.moveTo('+nlp+','+ntp+')'+(!(bdyn)?'}':''):'\nw.dialogLeft='+nlp+'+"px";w.dialogTop='+ntp+'+"px"\n'))+'}';
  var iwh="",dwh="",sscr="",sChgImg="";tRep=".replace(/##file##/gi,cf).replace(/##size##/gi,(nW>0&&nH>0?'width=\\''+nW+'\\' height=\\''+nH+'\\'':''))";
  var chkType='re=/\\.(swf)$/i;isSwf=re.test(cf);re=/\\.(mov)$/i;isQT=re.test(cf);re=/\\.(gif|jpg|png|bmp|jpeg)$/i;isImg=re.test(cf);re=/\.(avi|rm|rma|wav|asf|asx|mpg|mpeg)/i;isMov=re.test(cf);';
  var sSize='tSWF=\''+tSWF+'\';\ntQT=\''+tQT+'\';tIMG=\''+tIMG+'\';tMPG=\''+tMPG+'\'\n'+"if (cf.substr(cf.length-1,1)==']'){var bd=cf.lastIndexOf('[');if(bd>0){var di=cf.substring(bd+1,cf.length-1);var da=di.split('x');nW=da[0];nH=da[1];cf=cf.substring(0,bd)}}"+chkType;
  if(isEmb){if(isSL) {
      sChgImg=(NS4?'var l = document.layers[\'slide\'];ld=l.document;ld.open();ld.write(nHtml);ld.close();':IE?'document.all[\'slide\'].innerHTML = nHtml;':NS6?'var l=document.getElementById(\'slide\');while (l.hasChildNodes()) l.removeChild(l.lastChild);var range=document.createRange();range.setStartAfter(l);var docFrag=range.createContextualFragment(nHtml);l.appendChild(docFrag);':'');
      sscr='var pImg=new Image(),slH,ci=0,simg="'+theURL+'".split("|");'+
      'function show(cf,same){if(same){di=document.images[0];nW=di.width;nH=di.height}'+sRes+'}\n'+
      'function nImg(){if(slH)window.clearInterval(slH);nW=0;nH=0;cf=simg[ci];'+sSize+'document.title=cf;'+
      (tr!=0?';var fi=IElem.filters[0];fi.Apply();IElem.style.visibility="visible";fi.transition='+(tr-1)+';fi.Play();':'')+
      'if (nW==0&&nH==0){if(isImg){nW=pImg.width;nH=pImg.height}else{nW='+pw+';nH='+ph+'}}'+
      (bdyn?'nHtml=(isSwf?tSWF'+tRep+':isQT?tQT'+tRep+':isImg?tIMG'+tRep+':isMov?tMPG'+tRep+':\'\');'+sChgImg+';':'if(document.images)document["oImg"].src=simg[ci];')+
      sRes+';ci=ci==simg.length-1?0:ci+1;cf=simg[ci];re=/\\.(gif|jpg|png|bmp|jpeg)$/i;isImg=re.test(cf);if(isImg)pImg.src=cf;'+
      (isSL?(!NS4?'if(ci>1)':'')+'slH=window.setTimeout("nImg()",'+slT*1000+')}':'');
    } else {sscr='var re,pImg=new Image(),nW=0,nH=0,nHtml="",cf="'+theURL+'";'+chkType+'if(isImg)pImg.src=cf;\n'+
      'function show(){'+sSize+';if (nW==0&&nH==0){if(isImg){;nW=pImg.width;nH=pImg.height;if (nW==0&&nH==0){nW='+pw+';nH='+ph+'}}else{nW='+pw+';nH='+ph+
      '}};nHtml=(isSwf?tSWF'+tRep+':isQT?tQT'+tRep+':isImg?tIMG'+tRep+':isMov?tMPG'+tRep+':\'\');document.write(nHtml)};'}
    pd = pWin[wp].document;pd.open();pd.write('<html><'+'head><title>'+imgs[0]+'</title><'+'script'+'>'+sscr+'</'+'script>'+(!NS4?'<STYLE TYPE="text/css">BODY {margin:0;border:none;padding:0;}</STYLE>':'')+'</head><body '+(NS4&&isSL?'onresize=\'ci--;nImg()\' ':'')+'onload=\''+olf+(isSL?';nImg()':sRes)+'\' bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">');
    if(rpw>0){iwh='width="'+rpw+'" ';dwh='width:'+rpw} if(rph>0){iwh+='height="'+rph+'"';dwh+='height:'+rph}
    if(tr!=0) pd.write('<span id=IElem Style="Visibility:hidden;Filter:revealTrans(duration='+trT+');width:100%;height=100%">');
    if(isSL&&bdyn) {pd.write(NS4?'<layer id=slide></layer>':'<span id=slide></span>')} else {pd.write('<'+'script>show()'+'</'+'script>')}
    if(tr!=0) pd.write('</span>');pd.write('</body></html>');pd.close();
  }else {if(!omw)pWin[wp].location.href=imgs[0];}
  if((acT&&acT>0)||(slT&&slT>0&&isSL)){if(pWin[wp].document.body)pWin[wp].document.body.onunload=function(){if(acH)window.clearInterval(acH);if(slH)window.clearInterval(slH)}}
  if(acT&&acT>0)acH=window.setTimeout("pWin["+wp+"].close()",acT*1000);if(slT&&slT>0&&isSL)slH=window.setTimeout("if(pWin["+wp+"].nImg)pWin["+wp+"].nImg()",slT*1000);
  if(pu&&pu!=""){pWin[wp].blur();window.focus()} else pWin[wp].focus();document.MM_returnValue=(il&&il!="")?false:true;
}
//-->
</script>

















</head>

<body>

<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Administrar &Aacute;rbol de Contenidos</div>
<div id="ninstrucciones">
<p>Aqu&iacute; puede visualizar y controlar todas las categor&iacute;as&nbsp; y art&iacute;culos de su p&aacute;gina web. <font color="#FF0000"><strong>ATENCI&Oacute;N: </strong>Haga Click en los nombres de las categor&iacute;as para Expandir su contenido</font> <a href="#" title="ayuda para esta sección" onClick="popup('../help/contenido-arbol.php','ayuda','400','700');"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>
</div>


<div id="ncontenido">



<form action="" method="post" id="form1">

<div id="nbloque">
<div id="nbotonera">
<a href="javascript:popup('insert_categoria.php','new','500','910');" class="boton"> <img src="/admin/icon/add.png" align="absmiddle"> agregar
        nueva categor&iacute;a de primer nivel</a>


</div>


<!-- comienza arbol de contenidos -->
<?php

	  if(count($categorias)>0){



		for($i=0;$i<count($categorias);$i++){


		$NIVEL = 1;
		$NIVEL_ID = $categorias[$i]['id'];
		$ART = $categorias[$i]['art'];


 ?>

<!--bloque categorias-->
<div class="cont-div-cat1-container">

<div class="cont-div-cat1">
<div class="cont-div-cat-imagenes">

<?php if($categorias[$i]['only_for']>0){ ?>
<a href="javascript:;" title="Esta categoría es privada, solo sus usuarios registrados podrán verla. este atributo se cambia al editar la categoría">
<img src="../icon/icon_key.gif" width="16" height="16" border="0">
</a>
<?php } ?>
<!--/ delimce.  nuevo-->
<?php if( ($categorias[$i]['subca']==0 && $categorias[$i]['art']==0) || ($categorias[$i]['subca']>0 && $categorias[$i]['art']==0) ){ ?>
<a href="#" title="agregar sub categoria"  onClick="javascript:popup('insert_scategoria.php?id=<?=$categorias[$i]['id']?>','new','500','910');"><img src="../icon/icon-cat-add.gif" width="16" height="16" border="0"></a>
<?php } ?>

<img src="../icon/icon-cat-delete.gif" width="16" height="16" border="0" onClick="borrar('<?=$categorias[$i]['id'] ?>','<? echo 'Categoria '.$categorias[$i]['id']; ?>','cont_categoria','0',0);" title="borrar categoría y TODO lo que ésta contiene. esta accion es IRREVERSIBLE proceda con cautela" style="cursor:pointer;">
<a href="#" title="editar características de esta categoría"  onClick="popup('edit_categoria.php?id=<?=$categorias[$i]['id']?>','nuevo','500','910');"><img src="../icon/icon-cat-edit.gif" width="16" height="16" border="0"></a>
<?php if( ($categorias[$i]['subca']==0 && $categorias[$i]['art']==0) || ($categorias[$i]['subca']==0 && $categorias[$i]['art']>0) ){ ?>

<a href="#" title="agregar artículo a esta categoría"  onClick="GP_AdvOpenWindow('insert_articulo.php?nivel=<?php echo $NIVEL; ?>&cat=<?php echo $NIVEL_ID; ?>','nuevo','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,channelmode=no,directories=no',0,0,'fitscreen','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue"><img src="../icon/icon-agregar-articulo.gif" width="16" height="16" border="0"></a>





<?php } ?>
<?php if($i!=count($categorias)-1){?>
<img src="../icon/icon-down.gif" onClick="ordenar('<?=$categorias[$i]['orden'] ?>','cont_categoria','d','1',0);" width="16" height="16" border="0" title="Mover esta categoria hacia abajo" style="cursor:pointer;">
<?php } ?>
<?php if($i!=0){?>
<img src="../icon/icon-up.gif" onClick="ordenar('<?=$categorias[$i]['orden'] ?>','cont_categoria','u','1',0);" width="16" height="16" border="0" title="Mover esta categoria hacia arriba" style="cursor:pointer;">
<?php } ?>
<a href="#" title="esta categor&iacute;a permite adiciones de art&iacute;culos por los usuarios">
<span id="estado_<?=$categorias[$i]['id'] ?>_1" onClick="estatus('<?=$categorias[$i]['id'] ?>','1');">
<?php echo $categorias[$i]['users'];  ?>
</span>
</a>
<input name="escom_<?=$categorias[$i]['id'] ?>_1" type="hidden" id="escom_<?=$categorias[$i]['id'] ?>_1" value="<?php if($categorias[$i]['users2']==1) echo 1; else 0; ?>">
</div>
<span style="cursor:pointer" id="catmain<?php echo $categorias[$i]['id'] ?>" onClick="abrir_cat('<?php echo $categorias[$i]['id'] ?>','<?php echo $NIVEL ?>');"><?php echo $categorias[$i]['id'].' - '.$categorias[$i]['nombre']; ?></span></div>

<!--bloque de categoría 1-->
<div style="display:none" id="catcon<?php echo $categorias[$i]['id'] ?>"><!-- aca es donde va el contenido de cada categoria-->
</div>
</div> <!--fin del contenido de cada categoria-->


<?php  } ////catego for


  }else{ ///catego if

  echo "<span class='td-texto1'>Actualmente no existen Articulos agregados</span>";

  }

  ?>
<!-- termina arbol de contenidos -->



























<!-- final nbloque -->
</div>




</form>







<!-- termina ncontenido -->
</div>
<?php include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>


























































 





















</body>
</html>
<?php

$tool->cerrar();

?>