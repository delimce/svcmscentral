<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/funciones.php"); ////////clase
include("../../SVsystem/class/fecha.php");


$tool = new tools();
$fecha = new fecha("d/m/Y");

$tool->autoconexion();


	  if(isset($_POST['Submit'])){
		  
		  $tool->abrir_transaccion();
	
		/////////////////////
		
		$datax = $tool->simple_db("select cat_id, cat_nivel from producto where id = '{$_POST['id']}'");
		////////////////////
		
		$campos[0] = 'codigo';                 $valores[0] = $_POST['codigo'];
		$campos[1] = 'nombre';                 $valores[1] = $_POST['nombre'];
		$campos[2] = 'resumen';                $valores[2] = $_POST['resumen'];
		
		$campos[3] = 'activo';                  $valores[3] = $_POST['activo'];
		$campos[4] = 'fecha_publi_inicio';      $valores[4] = $_POST['finicio'];
		$campos[5] = 'fecha_publi_fin';         $valores[5] = $_POST['ffin'];
		
		$campos[6] = 'precio';        			 $valores[6] = $_POST['precio'];
		$campos[7] = 'descripcion';   			 $valores[7] = $_POST['desc'];
		$campos[8] = 'empaque';       			 $valores[8] = $_POST['empaque'];
		
		$campos[9] = 'medidas';       			 $valores[9]  = $_POST['medidas'];
		$campos[10] = 'peso';        			 $valores[10] = $_POST['peso'];
		$campos[11] = 'url';          			 $valores[11] = $_POST['url'];
		$campos[12] = 'doc_label';     			 $valores[12] = $_POST['doc_label'];
		$campos[13] = 'variaciones';   			 $valores[13] = $_POST['varia'];
		$campos[14] = 'doc_file';      			 $valores[14] = $_POST['doc_file'];
		$campos[15] = 'destacado';     			 $valores[15] = $_POST['destaca'];
		$campos[16] = 'fecha_mod';     			 $valores[16] = date("Y-m-d H:i");
		$campos[17] = 'stock';     			 	 $valores[17] = $_POST['stock'];
		
		$campos[18] = 'meta_google';			 $valores[18]  = trim($_POST['google_text']);
		$campos[19] = 'meta_desc';			     $valores[19]  = trim($_POST['description']);
		$campos[20] = 'meta_keywords';			 $valores[20]  = trim($_POST['keywords']);
		
		if(empty($_POST['doc_label'])) $_POST['doc_label'] = ''; ///bug de los 0 
		if(empty($_POST['doc_label'])) $_POST['doc_file'] = ''; ///bug de los 0 
		
		////peso volumetrico
	    if(!empty($_POST['pesov'])){ $campos[21] = 'pesov';	 $valores[21]  = $_POST['pesov']; }
		
		$tool->update("producto",$campos,$valores,"id = {$_POST['id']}");
		
		
		
		if(count($_SESSION['VARIACION_valor'])>0){
		
		$tool->query("delete from prod_varia where prod_id = {$_POST['id']} ");
		
		$varia2[0] = $_POST['id'];
		
		
		
				for($w=0;$w<count($_SESSION['VARIACION_valor']);$w++){
			
					$varia2[1] = $_SESSION['VARIACION_valor'][$w];
					$tool->insertar2("prod_varia","prod_id,variacion",$varia2);
			
			
				}
		
		
		}
		
		
		
		if(count($_SESSION['IMAGENES'])>0){
		
		$tool->query("delete from imagen_producto where prod_id = {$_POST['id']} ");
		
		$varia3[0] = $_POST['id'];
		
		
		
				for($w=0;$w<count($_SESSION['IMAGENES']);$w++){
			
					$varia3[1] = $_SESSION['IMAGENES'][$w];
					$tool->insertar2("imagen_producto","prod_id,ruta",$varia3);
			
			
				}
		
		
		}
		
		
		$tool->cerrar_transaccion();
		
		$tool->cerrar();
		unset($_SESSION['VARIACION_valor']);
		unset($_SESSION['IMAGENES']);
		
		?>
		 <script language="JavaScript" type="text/JavaScript">
	  	 window.opener.abrir_cat('<?=$datax['cat_id'] ?>','<?=$datax['cat_nivel']?>');
		 window.opener.abrir_cat('<?=$datax['cat_id'] ?>','<?=$datax['cat_nivel']?>');
		 
		 window.close();
	    </script>
		
		<?
	
	
	}else{
	
	 $datos = $tool->simple_db("select * from producto p,preferencias where id = {$_REQUEST['id']} ");
	
	
	}

unset($_SESSION['VARIACION_valor']);
unset($_SESSION['IMAGENES']);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Editar Producto  <?=$datos['nombre']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/editor/tiny_mce.js"></script>
<script type="text/javascript" src="../../SVsystem/editor/plugins/media/jscripts/embed.js"></script>

	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar.js"></script>
	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-es.js"></script>
	<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-setup.js"></script>
	<LINK href="../../SVsystem/js/calendario/calendario.css" type=text/css rel=stylesheet>


<script language="javascript" type="text/javascript">
tinyMCE.init({
mode : "exact",
elements : "desc",
theme : "advanced",
theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
apply_source_formatting : "true",
convert_urls : "false",
plugins : "style,layer,table,charmap,advimage,advhr,advlink,insertdatetime,paste,visualchars",
language: "es",
theme_advanced_buttons1 : "cut,copy,paste,undo,redo,link,unlink,separator,image,media,charmap,tablecontrols,separator,insertdate,inserttime", 
theme_advanced_buttons2 : "formatselect,separator,bold,italic,underline,sub,sup,separator,hr,justifyleft,justifycenter, justifyright,justifyfull,outdent,indent,bullist,numlist,forecolor,separator,removeformat, preview,code",
theme_advanced_buttons3 : "",
plugin_preview_width : "800",
plugin_preview_height : "550",
flash_wmode : "transparent",
flash_quality : "high",
flash_menu : "false",
media_use_script:"true",
nonbreaking_force_tab:"true",
plugin_insertdate_dateFormat : "<? echo "%d/%m/%Y"; ?> ",
plugin_insertdate_timeFormat : "%H:%M:%S",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
content_css : "example_word.css",
extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],iframe[src|width|height|name|align],object[align|width|height],param[name|value],embed[src|type|wmode|width|height],ul[class|compact<compact|id]"


});
</script>

<script language="javascript" src="../../SVsystem/class/libreriajax.js" type="text/javascript"></script>
<script language="javascript" src="../../SVsystem/class/efectos.js" type="text/javascript"></script>
<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>

<script language="JavaScript" type="text/JavaScript">


var TopFrameObj;
	TopFrameObj = window;
	

function borrar_doc(){
	
	var archivo;
	
		 if (confirm('Esta seguro que desea borrar el archivo (esta opcion es irreversible) ?')) { 
		 
		 		archivo = document.getElementById('doc_file').value;
				
				//alert(archivo);
				
				ajaxsend('post','popup-borrar-doc.php','archivo='+archivo);
				
				document.form1.doc_label.value = ''; 
			    document.form1.doc_file.value = ''; 
				document.getElementById('doc_file2').innerHTML='';
		 
		 } 
	
}



//del calendario
function fPopCalendar(popCtrl, dateCtrl, popCal, YOffset, XOffset) {
	popFrame.fPopCalendar(popCtrl,dateCtrl,popCal, YOffset, XOffset);
	return;
}

function fHideCalendar () {
	popCal.style.visibility = "hidden";
	return;
}

function KeepAliveNoError () {
	return true;
}	


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

function CC_startTip(){ //v1.0 333Creative
  ccID=document.getElementById;ccIE=(document.all);ccN4=(document.layers);
  i5=(ccID&&ccIE);ccN6=(ccID&&!ccIE);ccI4=(!ccID&&ccIE);ccMC=(navigator.userAgent.indexOf("Mac")!= -1);
  cc1=null;ccF=0;index=0;ccX=15;ccY=15;n=0;ccPX=(ccID)?"px":"";var T="ccToolTip";
   if(ccN4){el=document.layers[T];document.captureEvents(Event.MOUSEMOVE);document.onmousemove=eval("CC_"+"Follow")}
  else if(ccID){el=document.getElementById(T)}
  else if(ccI4){el=document.all[T]}
}

function CC_hideTip(){ //v1.0 333Creative
 if(ccN4){el.visibility="hidden"}
 if(ccN6){if(cc1!=null){clearTimeout(cc1);cc1=null;}el.style.MozOpacity = '0%';ccF=0;
  el.style.visibility="hidden";}else 
 if(ccIE){el.style.visibility="hidden"}}

function CC_Follow(evt){ //v1.0 333Creative
  var d=document.body;
  if(ccN4){tW=(el.document.width)?el.document.width:el.clip.width;tH=(el.document.height)?el.document.height:el.clip.height;}else 
  if(ccI4){tW=(el.style.pixelWidth)?el.style.pixelWidth:el.offsetWidth;tH=(el.style.pixelHeight)?el.style.pixelHeight:el.offsetHeight;
  }else{ tW=(el.style.width)?parseInt(el.style.width):parseInt(el.offsetWidth);tH=parseInt(el.offsetHeight)}
  if(ccIE){pX=d.clientWidth;sx=d.scrollLeft;sy=d.scrollTop;mx=event.clientX;my=event.clientY;
  }else{pX=window.innerWidth;sx=window.pageXOffset;sy=window.pageYOffset;mx=evt.pageX;my=evt.pageY;}
  if(n==1){if(ccN4||ccN6){mx-=sx}if(ccN4){my-=sy}xo=mx+ccX;yo=(my+tH+ccY-((ccN6)?sy:0)>=pY)?-5-tH-ccY:ccY;
   var X=Math.min(pX-tW,Math.max(2,xo))+sx,Y=my+yo+((!ccN6)?sy:0);
  if(ccN4){el.moveTo(X,Y)}else{el.style.left=X+ccPX;el.style.top=Y+ccPX}
 }
}

function CC_displayTip(o,m,e,w,h,l,t,g,z,p,s,y,b,a,q){ //v1.0 333Creative
  var lnk=document.links,x=el.style,f=eval("CC_"+"Follow");for(var i=0;i<lnk.length;i++){if(q=='1'&&!ccN6){
  lnk[i].onmousemove=f;n=1}else if(q=='2'&&!ccN6){n=2}else 
  if(ccN6&&q=='1'){lnk[i].addEventListener("mousemove",f,false);n=1}else 
  if(ccN6&&q=='2'){n=2}}pY=(ccIE)?document.body.clientHeight:window.innerHeight;if(ccID||ccIE){
  x.backgroundColor=g;x.color=z;x.width=w+ccPX;x.height=h+ccPX;x.borderStyle=s;
  x.borderColor=y;x.borderWidth=b+ccPX;x.textAlign=a;x.left=l+ccPX;x.top=t+ccPX;}
  if(ccN4){el.resizeTo(parseInt(w)+b*3,parseInt(h)+b*3);el.visibility ="visible";el.left=l;el.top=t;el.document.open();
  el.document.write('<table cellspacing="0"cellpadding="0"width="'+w+'"height="'+h+'"border="'+b+'"bordercolor="'+y+'"bgcolor="'+g+'"><tr><td align="'+a+'"><font color="'+z+'">'+m+'</font></td></tr></table>');
  el.document.close()}if(window.opera||ccMC||ccI4){x.visibility="visible";el.innerHTML=m}else 
  if(i5){x.filter=e;el.filters[0].Apply();x.visibility="visible";el.filters[0].Play(p);el.innerHTML=m;
  if(o<100){x.filter="alpha(opacity="+o+")"}}else if(ccN6){x.visibility="visible";el.innerHTML=m;if(ccF<o){ccOP=ccF+8;ccF=ccOP;
  cc1=setTimeout("CC_displayTip('"+o+"','"+m+"')",40);
  el.style.MozOpacity=ccOP+'%';
  }}
}
//-->
</script>
<style type="text/css" title="ccToolStyle">
 .tool {
	padding:2px;
	moz-opacity:0%;
	font-size: 12px;
	font-size: 12px;
 }
.style1 {font-size: 10px}
</style>
</head>

<body class="body-popup" onLoad="CC_startTip()">
<form action="" method="post" enctype="multipart/form-data" name="form1">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td class="td-titulo-popup">Editar Producto</td>
  </tr>
  <tr>
   <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
     <tr>
      <td width="28%" class="td-form-title">C&oacute;digo </td>
      <td width="72%"><input name="codigo" type="text" class="form-box" id="codigo" value="<?=$datos['codigo']?>" size="15">
        <a href="#"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle" onMouseOver="CC_displayTip('100','Codigo o ID del producto. Debe ser unico en todo el catalogo.','progid:DXImageTransform.Microsoft.Iris(irisstyle=CROSS,motion=out)','200','25','-450','-450','#E5ECFA','#000000','0.1','solid','#000000','1','left','1')" onMouseOut="CC_hideTip()"></a>      <input name="id" type="hidden" id="id" value="<?=$datos['id']?>"></td>
     </tr>
     <tr>
      <td class="td-form-title">&iquest;Publicado?</td>
      <td><input name="activo" type="checkbox" value="1" <?php  if($datos['activo']==1) echo "checked"; ?> id="activo">
      <a href="#"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle" onMouseOver="CC_displayTip('100','Aquí usted decide si el producto es mostrado o no en el catálogo. Puede existir en la base de datos pero no mostrarse. Util para cuando se acaba un producto del inventario.','progid:DXImageTransform.Microsoft.Iris(irisstyle=CROSS,motion=out)','200','25','-450','-450','#E5ECFA','#000000','0.1','solid','#000000','1','left','1')" onMouseOut="CC_hideTip()"></a>      </td>
     </tr>
     <tr>
       <td class="td-form-title">&iquest;Destacado?</td>
       <td><input name="destaca" type="checkbox" value="1" <?php  if($datos['destacado']==1) echo "checked"; ?> id="destaca">
<a href="#"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle" onMouseOver="CC_displayTip('100','Si usted tiene una seccion de productos destacados en su pagina web, sus productos marcados como destacados saldrán listados','progid:DXImageTransform.Microsoft.Iris(irisstyle=CROSS,motion=out)','200','25','-450','-450','#E5ECFA','#000000','0.1','solid','#000000','1','left','1')" onMouseOut="CC_hideTip()"></a></td>
     </tr>
     <tr>
      <td class="td-form-title">Rango de Fechas de publicaci&oacute;n (aaaammdd)</td>
      <td>
      <div id="popCal" name="popCal" style="VISIBILITY:hidden;POSITION: absolute; LEFT:0px ; TOP:0px; WIDTH: 180px; HEIGHT: 150px;z-index:300;">
		<iframe name="popFrame" id="popFrame" src="../../js/calendario.htm" frameborder="0" scrolling="no" width="184" height="184"></iframe>
		</div>
      
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="23%"><input name="finicio" type="text" class="form-box" id="finicio" value="<?=$datos['fecha_publi_inicio']?>" size="12">
            <img src="../icon/cal.gif" name="f_trigger_d" width="16" height="16" id="f_trigger_d" style="cursor: hand; border: 0px;" title="fecha">
     			 <script type="text/javascript">
					Calendar.setup({
						inputField     :    "finicio",     // id of the input field
						ifFormat       :    "<?=strtolower("Y-m-d")?>",    // format of the input field
						button         :    "f_trigger_d",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script>
            </td>
          <td width="10%"><font size="2">&nbsp;a</font></td>
          <td width="22%"><input name="ffin" type="text" class="form-box" id="ffin" value="<?=$datos['fecha_publi_fin']?>" size="12">
            <img src="../icon/cal.gif" name="f_trigger_c" width="16" height="16" id="f_trigger_c" style="cursor: hand; border: 0px;" title="fecha">
     			 <script type="text/javascript">
					Calendar.setup({
						inputField     :    "ffin",     // id of the input field
						ifFormat       :    "<?=strtolower("Y-m-d")?>",    // format of the input field
						button         :    "f_trigger_c",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script></td>
          
          
          <td width="13%"><a href="#"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle" onMouseOver="CC_displayTip('100','El formato de la fecha debe ser como este: 20070415 -para indicar el 15 de abril del 2007-. Durante este rango de fechas el producto se encontar&aacute; publicado, luego de pasar la fecha final, el producto pasar&aacute; autom&aacute;ticamente a estado NO publicado..','progid:DXImageTransform.Microsoft.Iris(irisstyle=CROSS,motion=out)','200','25','-450','-450','#E5ECFA','#000000','0.1','solid','#000000','1','left','1')" onMouseOut="CC_hideTip()"></a></td>
          <td width="4%"><input name="ind" type="checkbox" value="1" <?php  if($datos['activo']==1) echo "checked"; ?> id="ind"></td>
          <td width="28%"><font size="2">Indefinidamente</font></td>
        </tr>
      </table></td>
     </tr>
     <tr>
      <td class="td-form-title">Stock</td>
      <td><input name="stock" type="text" class="form-box" id="stock" value="<?=$datos['stock']?>" size="10">      </td>
     </tr>
     <tr>
      <td class="td-form-title">Precio&nbsp;  <?php echo $datos['moneda_simbolo']; ?> <a href="../opciones-moneda.php" title="cambiar moneda"> <font size="1">[cambiar]</font> </a>  </td>
     <td><input name="precio" type="text" class="form-box" id="precio" value="<?=round($datos['precio'],2)?>" size="10">      </td>
     </tr>
     <tr>
      <td class="td-form-title">Nombre del Producto</td>
      <td><input name="nombre" type="text" class="form-box" id="nombre" value="<?=$datos['nombre']?>" size="70">      </td>
     </tr>
     <tr>
      <td class="td-form-title">Res&uacute;men para los Listados</td>
      <td><input name="resumen" type="text" class="form-box" id="resumen" value="<?=$datos['resumen']?>" size="100">      </td>
     </tr>
     <tr>
      <td colspan="2" class="td-headertabla4">Descripci&oacute;n del producto</td>
     </tr>
     <tr align="center">
      <td colspan="2"><textarea name="desc" cols="100" rows="35" id="desc"><?=$datos['descripcion']?>
      </textarea></td>
     </tr>
     
      












     <tr align="center">
       <td colspan="2">&nbsp;</td>
     </tr>
     






 <tr>
     

 <td colspan="2" class="td-headertabla4">Im&aacute;genes del Producto <a href="#"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle" onMouseOver="CC_displayTip('100','La primera imagen será la imagen principal del producto. El resto serán colocadas en la sección de galerías de fotos del mismo. Elija cuidadosamente la imagen principal.','progid:DXImageTransform.Microsoft.Iris(irisstyle=CROSS,motion=out)','200','25','-450','-450','#E5ECFA','#000000','0.1','solid','#000000','1','left','1')" onMouseOut="CC_hideTip()"></a><br>
   <span class="subtitulito2">La Primera imagen es la imagen principal del productoo</span></td>
     </tr>
<tr >
      <td colspan="2" class="td-barra-inferior" style="text-align:center"><input  class="form-button" type="button" name="agregarimagen" id="agregarimagen" value="[+] Agregar Imagen" onClick="GP_AdvOpenWindow('popup-editar-imagenes.php','','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,channelmode=no,directories=no',500,200,'center','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue">
        <br>
        <span class="subtitulito2">La Primera imagen es la imagen principal del producto</span></td>
     </tr>
     <tr align="center">
      <td colspan="2" style="background-color:#FFFFFF"><iframe frameborder="0" name="imagen" src="imagenes.php?prod_id=<?=$datos['id']?>" width="100%" height="300"></iframe></td>
     </tr>


     <tr align="center">
       <td colspan="2">&nbsp;</td>
     </tr>





<!-- documento -->
<tr>
 <td colspan="2" class="td-headertabla4"> Documento Adicional o Attachment del Producto<br>
         <span class="subtitulito2">Cargue desde su computadora  un archivo con especificaciones para este producto como PDF, XLS o presentaciones Power Point.</span></td>
     </tr>
     <tr align="center">
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
         <tr>
           <td class="td-headertabla">T&iacute;tulo del Documento</td>
           <td class="td-headertabla">Archivo Cargado</td>
           <td class="td-headertabla">Acciones</td>
         </tr>
         <tr>
           <td width="27%"><input name="doc_label" type="text" class="form-box" value="<?=$datos['doc_label']?>" size="40" id="doc_label"></td>
           <td width="40%" class="bdc-td-dato-detalle2"><div id="doc_file2"><?=$datos['doc_file']?></div>
            <input name="doc_file" type="hidden" id="doc_file" value="<?=$datos['doc_file']?>"></td>
           
<td width="33%">

<input name="Cargar" type="button" class="form-button" id="Cargar" onClick="popup('popup-editar-doc.php?actual=<?=$datos['doc_file']?>','docs',160,400);" value="Cargar Documento">&nbsp; 

<a title="Eliminar documento" onClick="borrar_doc();"><img src="../icon/icon-prod-delete.gif" width="16" height="16" border="0"></a> </td>
         </tr>
       </table></td>
     </tr>

<!-- /////////////////////// documento -->











     <tr align="center">
       <td colspan="2">&nbsp;</td>
     </tr>



<!-- variaciones -->
     <tr>
       <td colspan="2" class="td-headertabla4"> Variaciones del Producto<br>
         <span class="subtitulito2"> Especifique el titulo de la variaci&oacute;n del producto (Ej. colores)  y luego agregue los tipos de variaciones (Ej. verde, rojo, negro) Puede borrarlas y moverlas de orden.</span></td>
     </tr>
     <tr align="center">
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
         <tr>
           <td width="20%" class="td-headertabla">T&iacute;tulo del Grupo de Variaciones</td>
           <td width="56%" class="td-headertabla">Variaciones Agregadas</td>
           <td width="24%" class="td-headertabla">Agregar Variaci&oacute;n</td>
         </tr>
         <tr>
           <td> <input name="varia" type="text" class="form-box" id="varia" value="<?=$datos['variaciones']?>" size="30"></td>
           <td><iframe frameborder="0" name="varia" src="variaciones_prod.php?prod_id=<?=$datos['id']?>" width="100%" height="80"></iframe></td>
           <td><input type="button" name="variacion" id="variacion" value="Agregar Variación" class="form-button" onClick="GP_AdvOpenWindow('popup-insert-variaciones.php','','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,channelmode=no,directories=no',400,160,'center','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue"></td>
         </tr>
       </table></td>
     </tr>

<!-- ///////////// variaciones  -->





     <tr align="center">
      <td colspan="2">&nbsp;</td>
     </tr>
     <tr>
      <td colspan="2" class="td-headertabla4"> Datos para Posicionamiento en Google</td>
     </tr>
     <tr align="center">
      <td colspan="2"><p> <span class="titulo-googlefield">descripci&oacute;n larga (google text)</span><br>
      <textarea name="google_text" cols="100" rows="5" id="google_text"><?=$datos['meta_google']?>
      </textarea>
      </p>
      <p><span class="titulo-googlefield">meta tag description (descripci&oacute;n breve)<br>
      </span>
      <textarea name="description" cols="100" rows="5" id="description"><?=$datos['meta_desc']?>
      </textarea>
      </p>
      <p><span class="titulo-googlefield">&nbsp;meta tag keywords o palabras clave (separadas por coma)</span><br>
      <textarea name="keywords" cols="100" rows="2" id="keywords"><?=$datos['meta_keywords']?>
      </textarea>
      </p>      </td>
     </tr>
     <tr>
       <td colspan="2" class="td-headertabla4"> Datos Adicionales del Producto</td>
     </tr>
     <tr>
      <td class="td-form-title">Empaque (unidades por paquete)</td>
      <td><input name="empaque" type="text" class="form-box" id="empaque" value="<?=$datos['empaque']?>" size="10">      </td>
     </tr>
     <tr>
      <td class="td-form-title">Medidas</td>
      <td><input name="medidas" type="text" class="form-box" id="medidas" value="<?=$datos['medidas']?>" size="30">      </td>
     </tr>
     <tr>
      <td class="td-form-title">Peso</td>
      <td><input name="peso" type="text" class="form-box" id="peso" value="<?=$datos['peso']?>" size="10">      </td>
     </tr>
     <tr>
       <td class="td-form-title">Peso Volum&eacute;trico</td>
       <td><input name="pesov" type="text" class="form-box" id="pesov" value="<?=$datos['pesov']?>" size="10"></td>
     </tr>
     <tr>
      <td class="td-form-title">Url adicional</td>
      <td><input name="url" type="text" class="form-box" id="url" value="<?=$datos['url']?>" size="60">
        &nbsp; <a href="#"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle" onMouseOver="CC_displayTip('100','Coloque aqui la dirección en Internet de alguna página web con información adicional sobre este producto.','progid:DXImageTransform.Microsoft.Iris(irisstyle=CROSS,motion=out)','200','25','-450','-450','#E5ECFA','#000000','0.1','solid','#000000','1','left','1')" onMouseOut="CC_hideTip()"></a>      </td>
     </tr>
    







     <tr align="center">
       <td colspan="2"><input name="Submit" type="submit" class="form-button" id="button" value="Guardar">
&nbsp;
<input name="Submit2" type="button" class="form-button" onClick="window.close();" value="Cancelar"></td>
     </tr>
    </table>
   </td>
  </tr>
 </table>
</form>
<span id="ccSpan" style="display:none"><a href="#"></a></span>
<div id="ccToolTip" style="position:absolute; width:300px; height:25px; z-index:100; left: 0px; top: -50px; border: 1px solid #ffffff; visibility: hidden" class="tool"></div>
</body>
</html>
<?php 

$tool->cerrar();

?>