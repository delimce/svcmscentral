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
											  (SELECT preferencias.pay_user FROM preferencias) AS emensaje,
											  (SELECT preferencias.nombre_empresa FROM preferencias) AS nempresa,
						 					  (SELECT preferencias.url_empresa FROM preferencias) AS urlempresa
											FROM
											  cliente c
											WHERE
											  id = '{$_SESSION['CLIENTE_ID']}' AND 
											  activo = 1");
						  
						  
			$usern = $dat4['nombre'];
			$usere = $dat4['email'];
			$nombre_empresa = $dat4['nempresa'];
			$url_empresa = $dat4['urlempresa'];	
			$concepton = $_REQUEST['r-comentario'];		  
		
			$nombre_email   = $dat4['nombre'];
  			$email_send 	= $dat4['email'];
						
			 $original  = array('$nombre_email', '$email_send','$usern','$usere', '$concepton','$bancop','$montop','$fechap','$nombre_empresa','$url_empresa');
			 $reemplazo = array($nombre_email, $email_send, $usern, $usere, $concepton, $bancop, $montop, $fechap, $nombre_empresa, $url_empresa);
			
			  $email_subject = str_replace($original, $reemplazo, $dat4['etitulo']);
			  $email_content = str_replace($original, $reemplazo, $dat4['emensaje']);
			
			
			  									 /////////manda email cliente
								  	$dataemail = $tool->array_query2("select nombre_empresa,mail_compra_cliente from preferencias");
								    $headers  = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
									$headers .= "From: $dataemail[0] <$dataemail[1]>" . "\r\n" .
								 "Reply-To: $dataemail[1]" . "\r\n";
										  
										  mail($dat4['email'],$email_subject,$email_content,$headers);
								 ////////
			
			
			/////////admin
			$dat4 = $tool->simple_db("SELECT subject_pay_admin as titulo,pay_admin AS mensaje
														FROM preferencias 
															");
							
							
							      $email_subject = str_replace($original, $reemplazo, $dat4['titulo']);
			  					  $email_content = str_replace($original, $reemplazo, $dat4['mensaje']);
						  
			

			 mail($dataemail[1],$email_subject,$email_content,$headers);
			
			
			//////////////////
			
			$tool->redirect('SV-popup-form-pago-ok.php');
	
	}else{
	
		$pagodata = $tool->estructura_db("select banco,nombre,ncuenta from pago_datos ");
        $data = $tool->simple_db("select popup_style from preferencias"); 
		 $datosp =  $tool->simple_db("SELECT  ifnull(trim('{$_REQUEST['ordenid']}'),0) as id,
									  (SELECT monto from orden_compra where id = '{$_REQUEST['ordenid']}' ) AS monto,
									  (SELECT p.moneda_simbolo FROM preferencias p) AS moneda,
									  (SELECT p.nombre_empresa FROM preferencias p) AS nombre "); 
	
	}
	

 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Reporte su pago</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data ?>" rel="stylesheet" type="text/css">
<link href="SVsystem/js/calendario/calendario.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="SVsystem/js/calendario/calendar.js"></script>
<script type="text/javascript" src="SVsystem/js/calendario/calendar-es.js"></script>
<script type="text/javascript" src="SVsystem/js/calendario/calendar-setup.js"></script>
<script type="text/javascript" src="SVsystem/js/popup.js"></script>


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
<div class="popup-titulo">Reporte su pago</div>
<div class="popup-instrucciones">
Deposite o transfiera dinero a alguna de las cuentas bancarias aqui descritas y luego reporte su pago. Tenga a mano el comprobante de dep&oacute;sito o transferencia y recuerde ser preciso con la informaci&oacute;n que introduce para que&nbsp; podamos procesarlo de forma&nbsp; r&aacute;pida y efectiva.</div>

<form action="" method="post" name="form1" onSubmit="YY_checkform('form1','r-fecha','#^\([0-9][0-9]\)\/\([0-9][0-9]\)\/\([0-9]{4}\)$#1#2#3','3','¿Cuando fue que hizo su pago?','r-ntransacc','#1000_999999999999','1','Por favor escriba el numero de deposito correctamente','r-monto','#1_10000','1','¿Seguro que ese fue el monto que depositó?','r-modo','#q','1','Seleccione el tipo de operación');return document.MM_returnValue">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td align="center"><table width="99%" border="0" cellspacing="5" cellpadding="0">
    <tr>
     <td width="68%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
         <tr>
          <td width="37%" rowspan="12" valign="top" class="popup-form-title">
           
         	<?php for($j=0;$j<count($pagodata);$j++){ ?>
             <div class="pago-container">
             <div class="pago-banco"><?php echo $pagodata[$j]['banco'] ?></div>
             <div class="pago-numero"><?php echo $pagodata[$j]['ncuenta'] ?></div>
             <div class="pago-nombre"><?php echo $pagodata[$j]['nombre'] ?></div>
             </div>
              
            <?php }?>         </td>
          <td class="popup-form-title">Concepto de su Pago</td>
         </tr>
         <tr>
          <td><input name="r-comentario" type="text" class="popup-form-box" id="r-comentario" value="<?php if(!empty($datosp['id'])) echo "Orden #{$datosp['id']} de {$datosp['nombre']} "; ?>" size="50">          </td>
         </tr>
       <tr>
       <td width="63%" class="popup-form-title">Fecha de su pago (dd/mm/aaaa)</td>
      </tr>
      <tr>
        <td><input name="r_fechan" type="text" class="popup-form-box" id="r_fecha" size="10" readonly="readonly" OnFocus="this.blur()" onClick="alert('usar el boton del calendario para llenar este campo')">
            <img src="http://www.svcmscentral.com/admin/icon/cal.gif" alt="calendario" name="f_trigger_d" id="f_trigger_d" style="cursor: hand; border: 0px;" title="seleccionar fecha">
            <script type="text/javascript">
					Calendar.setup({
						inputField     :    "r_fecha",     // id of the input field
						ifFormat       :    "<?=strtolower("d/m/Y")?>",    // format of the input field
						button         :    "f_trigger_d",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script>
        </td>
        </tr>
      <tr>
        <td class="popup-form-title">Beneficiario del Pago</td>
      </tr>
      <tr>
        <td><?php echo $tool->combo_db("r-dato_id","select id,concat(nombre,' - ',ncuenta,' - ',banco) as nombre from pago_datos","nombre","id",false,$seleccion=false,$onchange=false,$noreg='No existen cuentas creadas'); ?></td>
      </tr>
      <tr>
        <td class="popup-form-title">N&uacute;mero de transacci&oacute;n (dep&oacute;sito o transferencia). Sin espacios o guiones</td>
      </tr>
      <tr>
        <td><input name="r-ntransacc" type="text" class="popup-form-box" id="r-ntransacc"  size="30">       </td>
      </tr>
      <tr>
        <td class="popup-form-title">Tipo de operaci&oacute;n</td>
      </tr>
      <tr>
        <td><select name="r-modo" class="popup-form-box" id="r-modo">
       <option selected>Seleccione
       <option value="Depósito efectivo">Dep&oacute;sito efectivo
       <option value="Depósito Cheque">Dep&oacute;sito Cheque otros bancos
       <option value="Transferencia por Internet">Transferencia por Internet       
       </select>       </td>
      </tr>
      <tr>
        <td class="popup-form-title">Monto que deposit&oacute; / transfiri&oacute; (<?php echo $datosp['moneda']; ?>)</td>
      </tr>
      <tr>
        <td><input name="r-monto" type="text" class="popup-form-box" id="r-monto" size="15" value="<?php echo $datosp['monto'] ?>">       </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
       <td>&nbsp;</td>
      </tr>
     </table></td>
    </tr>
   </table></td>
  </tr>
  <tr>
   <td width="50%" align="center"><input name="Submit" type="submit" class="popup-form-button" value="Reportar Pago">&nbsp; 
   <input name="Submit2" type="button" class="popup-form-button" value="Cancelar" onClick="window.close();"></td>
  </tr>
 </table>
</form>
</body>
</html>
