<?php session_start();

include("SVsystem/config/dbconfig.php"); ////////setup
include("SVsystem/class/tools.php");
include("SVsystem/class/email.php");
$mail = new email();

	$tool = new tools();
	$tool->autoconexion();

if(isset($_POST['Submit'])){


	
				$articulo = $_POST['articulo'];
	
			   $email_send     = $_POST['email3'];
			   $nombre_email   = $_POST['nombre'];
			   $email_subject  = 'Hicieron una pregunta sobre  '.$_POST['articulo'];
			   $email_content  = $_POST['pregunta'];
			   
						$dataemail = $tool->array_query2("select nombre_empresa,soporte_email from preferencias");
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					   $headers .= "From: $nombre_email <$email_send> " . "\r\n" .
					   "Reply-To: $dataemail[1]" . "\r\n";
					  
					  mail($dataemail[1],$email_subject,$email_content,$headers);
				
				
				  
		?>
        <script type="text/javascript">
		alert('Su información ha sido enviada');
		window.close();
		</script>
        <?

}else{
        
     $data = $tool->simple_db("select iva,popup_style from preferencias");      
  }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Solicitar Informaci&oacute;n Sobre <?php echo $_REQUEST['nombre']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data['popup_style'] ?>" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
      if (t==1){ //fromto
        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
      } else if (t==2){
        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
      } else if (t==3){ // date
        ma=a[i+1].split("#");at=v.match(ma[0]);
        if(at){
          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
          dte=new Date(cy,cm,cd);
          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
        }else{err=true}
      } else if (t==4){ // time
        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
      } else if (t==5){ // check this 2
            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!o1.checked){err=true}
      } else if (t==6){ // the same
            if(v!=MM_findObj(a[i+1]).value){err=true}
      }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
          at = a[i].match(/(.*)\[(\d+)\].*/i);
          o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('Los siguientes campos no han sido llenados apropiadamente:\t\t\t\t\t\n\n'+s)}
  document.MM_returnValue = (s=='');
}

function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>




</head>








<body class="body-popup">
<div class="popup-titulo">Solicitar Informaci&oacute;n Sobre <?php echo $_REQUEST['nombre']; ?></div>
<div class="popup-instrucciones">
Escriba su pregunta y sus datos para solicitarnos informaci&oacute;n sobre el tema.</div>


<form action="" method="post" name="form1" onSubmit="YY_checkform('form1','nombre','#q','0','Escriba su Nombre','email','S','2','Su dirección de email debe ser válida','pregunta','10','1','Por favor escriba su pregunta');return document.MM_returnValue">
   <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <td width="50%" class="popup-form-title"> Titulo de la P&aacute;gina</td>
    <td width="50%" class="nombre-de-producto"><?php echo $_REQUEST['nombre']; ?>
    <input name="articulo" type="hidden" id="articulo" value="<?php echo $_REQUEST['nombre'] ?>">
    </td>
    </tr>
    <tr>
    <td class="popup-form-title">Su Nombre</td>
    <td class="cat-form-boxtd"><input name="nombre" type="text" class="popup-form-box" id="nombre" value="<?=$_SESSION['CLIENTE_NOMBRE'] ?>" size="40">
    </td>
    </tr>
    <tr>
    <td class="popup-form-title">Su E-Mail</td>
    <td class="cat-form-boxtd"><input name="email3" type="text" class="popup-form-box" id="email3" value="<?=$_SESSION['CLIENTE_EMAIL'] ?>" size="40">
    </td>
    </tr>
    <tr>
    <td class="popup-form-title">Su Pregunta</td>
    <td class="popup-form-title"><textarea name="pregunta" cols="50" rows="7" class="popup-form-box" id="pregunta"></textarea></td>
    </tr>
    <tr>
     <td>&nbsp;</td>
     <td><input name="Submit" type="submit" class="popup-form-button" value="Enviar Pregunta">&nbsp; 
     
     
    <input name="Submit2" type="button" class="popup-form-button" onClick="window.close();" value="Cancelar"></td>
    </tr>
</table>
</form>

</body>
</html>
