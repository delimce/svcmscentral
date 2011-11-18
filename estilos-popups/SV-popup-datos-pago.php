<?php session_start();

	include("SVsystem/config/dbconfig.php"); ////////setup
	include("SVsystem/class/formulario.php");
	include("SVsystem/class/email.php");
	$mail = new email();
	
	$tool = new formulario();
	$tool->autoconexion();
	
	
	if(isset($_REQUEST['r-ntransacc'])){
	
			if(empty($_REQUEST['r-fecha'])){ $_POST['r-fecha'] = date("Y-m-d"); 
			
			}else{
			
			 	$fechi = explode("/",$_REQUEST['r-fecha']);
				$_POST['r-fecha'] = $fechi[2].'-'.$fechi[1].'-'.$fechi[0];
			
			}
			
			
				
			$montop = $_POST['r-monto'];
			$fechap = $_POST['r-fecha'];	
			
			$_POST['r-cliente_id'] = $_SESSION['CLIENTE_ID'];
			$tool->insert_data("r","-","pago",$_POST);
			
			
			$bancop = $tool->simple_db("select banco from pago_datos where id = '{$_POST['r-dato_id']}' ");
			
			
			///////////////////
			/////user
			$dat4 = $tool->simple_db("SELECT DISTINCT 
											  c.nombre,
											  c.email,
											  (SELECT preferencias.subject_pay_user FROM preferencias) AS etitulo,
											  (SELECT preferencias.pay_user FROM preferencias) AS emensaje
											FROM
											  cliente c
											WHERE
											  id = '{$_SESSION['CLIENTE_ID']}' AND 
											  activo = 1");
						  
						  
			$usern = $dat4['nombre'];
			$usere = $dat4['email'];
			$concepton = $_REQUEST['r-comentario'];		  
		
			$nombre_email   = $dat4['nombre'];
  			$email_send 	= $dat4['email'];
						
			 $original  = array('$nombre_email', '$email_send','$usern','$usere', '$concepton','$bancop','$montop','$fechap');
			 $reemplazo = array($nombre_email, $email_send, $usern, $usere, $concepton, $bancop, $montop, $fechap);
			
			  $email_subject = str_replace($original, $reemplazo, $dat4['etitulo']);
			  $email_content = str_replace($original, $reemplazo, $dat4['emensaje']);
			
			
			include('email.php');
			
			/////////admin
			$dat4 = $tool->simple_db("SELECT subject_pay_admin as titulo,pay_admin AS mensaje
														FROM preferencias 
															");
							
							
							      $email_subject = str_replace($original, $reemplazo, $dat4['titulo']);
			  					  $email_content = str_replace($original, $reemplazo, $dat4['mensaje']);
						  
			
			unset($nombre_email);
  			unset($email_send);


			include('email.php');
			
			
			//////////////////
			
			$tool->redirect('SV-popup-form-pago-ok.php');
	
	}else{
	
		$pagodata = $tool->estructura_db("select banco,nombre,ncuenta,rif from pago_datos ");
        $data = $tool->simple_db("select popup_style from preferencias");   
	
	}
	

 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Datos de Pago</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data ?>" rel="stylesheet" type="text/css">


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
  if (s!=''){alert('Oops!:\t\t\t\t\t\n\n'+s)}
  document.MM_returnValue = (s=='');
}
//-->
</script>
</head>

<body class="body-popup">
<div class="popup-titulo">Cuentas Bancarias</div>
<div class="popup-instrucciones"> Haga su  transferencia online o  dep&oacute;sito bancario a cualquiera de estas cuentas.
</div>

<form action="" method="post" name="form1" onSubmit="YY_checkform('form1','r-fecha','#^\([0-9][0-9]\)\/\([0-9][0-9]\)\/\([0-9]{4}\)$#1#2#3','3','¿Cuando fue que hizo su pago?','r-ntransacc','#1000_999999999999','1','Por favor escriba el numero de deposito correctamente','r-monto','#1_10000','1','¿Seguro que ese fue el monto que depositó?','r-modo','#q','1','Seleccione el tipo de operación');return document.MM_returnValue">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td align="center"><?php for($j=0;$j<count($pagodata);$j++){ ?>
            <div class="pago-container">
            <div class="pago-banco"><?php echo $pagodata[$j]['banco'] ?></div>
            <div class="pago-numero"><?php echo $pagodata[$j]['ncuenta'] ?></div>
            <div class="pago-nombre"><?php echo $pagodata[$j]['nombre'] ?></div>
            <div class="pago-nombre"><?php echo $pagodata[$j]['rif'] ?></div>
            </div>
            
            <?php }?></td>
  </tr>
  <tr>
   <td align="center"  >&nbsp; 
  <input name="Submit2" type="button" class="popup-form-button" value="Cerrar Ventana" onClick="window.close();"></td>
  </tr>
 </table>
</form>
</body>
</html>
