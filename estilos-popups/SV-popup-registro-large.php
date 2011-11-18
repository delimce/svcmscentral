<?php session_start();

include("SVsystem/config/dbconfig.php"); ////////setup
include("SVsystem/class/formulario.php");
include("SVsystem/class/fecha.php");
include("SVsystem/class/email.php");
$mail = new email();

$tool = new formulario();
$tool->autoconexion();


	if(isset($_POST['r_email'])){
		
		$_POST['r_origen'] = 'Inscrito por la página web';
		
		
		$_POST['r_fecha'] = date("Y-m-d H:i:s") ;
		////codigo de activacion 7-12-2009
		$cod_activo = $_POST['r_codactivo'] = time();
		
		
		$tool->insert_data("r","_","cliente",$_POST);
		$NUEVO_ID = $id11 = $tool->ultimoID;
		
						///////////////guardando campos adicionales
						 if(count($_POST['camposid'])>0){


								foreach($_POST['camposid'] as $i => $value){

									$vector9[0] = $NUEVO_ID;
									$vector9[1] = $_POST['camposid'][$i];
									$vector9[2] = $_POST['camposa'][$i];

									$tool->insertar2("campo_user","user_id,campo_id,valor",$vector9);

								}


						 }//////////////

				
		//////////////////////////////////////////////////////////////////////
			//email usuario
			
			$dat4 = $tool->simple_db("SELECT DISTINCT 
						  c.nombre,
						  c.email,
						  (SELECT preferencias.subject_users_registro_user FROM preferencias) AS etitulo,
						  (SELECT preferencias.users_registro_user FROM preferencias) AS emensaje,
						  (SELECT preferencias.nombre_empresa FROM preferencias) AS nempresa,
						  (SELECT preferencias.url_empresa FROM preferencias) AS urlempresa
						FROM
						  cliente c
						WHERE
						  id = '$id11' ");
						  				  
			$usern = $dat4['nombre'];
			$usere = $dat4['email'];
			$claven = $_POST['r_password'];	
			$nombre_empresa = $dat4['nempresa'];
			$url_empresa = $dat4['urlempresa'];	
		
			$nombre_email   = $dat4['nombre'];
  			$email_send 	= $dat4['email'];
			
			
								 $original  = array('$nombre_email', '$email_send','$usern','$usere', '$claven','$nombre_empresa','$url_empresa','$cod_activo');
			 					 $reemplazo = array($nombre_email, $email_send, $usern, $usere, $claven, $nombre_empresa, $url_empresa, $cod_activo);
								
								  $email_subject = str_replace($original, $reemplazo, $dat4['etitulo']);
			  					  $email_content = str_replace($original, $reemplazo, $dat4['emensaje']);

			
			$dataemail = $tool->array_query2("select nombre_empresa,soporte_email from preferencias");
			  $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= "From: $dataemail[0] <$dataemail[1]>" . "\r\n" .
   "Reply-To: $dataemail[1]" . "\r\n";
			
			mail($dat4['email'],$email_subject,$email_content,$headers);
			
			//email admin
			
			$dat4 = $tool->simple_db("SELECT DISTINCT 
							soporte_email as email,
							nombre_empresa as nombre,
							subject_users_registro_admin as etitulo,
							users_registro_admin as emensaje
						 from preferencias");
						  
		 						  $email_subject = str_replace($original, $reemplazo, $dat4['etitulo']);
			  					  $email_content = str_replace($original, $reemplazo, $dat4['emensaje']);
								  
			$nombre_email   = $dat4['nombre'];
  			$email_send 	= $dat4['email'];
			
					
			mail($dat4['email'],$email_subject,$email_content,$headers);
	////////////////////////////////////////////////////////////////////	
			

		$tool->redirect('SV-popup-registro-ok.php');
		
	}else{
        
        $data = $tool->simple_db("select popup_style from preferencias"); 
        
    }
	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Reg&iacute;strese gratis en nuestra base de datos</title>
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

<script language="JavaScript" type="text/javascript">
		  function validar(){
		  
		  
		 // var login2 = document.form1.login12.value;
		 // var i;
		 
		    if (document.form1.r_nombre.value == ''){
			   alert("Por favor ingrese su nombre");
			   document.form1.r_nombre.focus();
			   return (false);
			 }	
			 
			 
			  if (document.form1.r_rif.value == ''){
			   alert("Por favor ingrese su CI o Rif ");
			   document.form1.r_rif.focus();
			   return (false);
			 }
			 
			 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.form1.r_email.value)==false){
			  alert("Su dirección de correo es invalida");
			  document.form1.r_email.focus();
			  return (false);
			 }
			 
			 
			 if (document.form1.r_password.value.length < 5){
			   alert("El password debe ser mayor de 5 caracteres");
			   document.form1.r_password.focus();
			   return (false);
			 }
			 
			 
					 
			 if (document.form1.r_password.value != document.form1.password.value){
			   alert("la confirmación del password no coincide con el original");
			   document.form1.password.focus();
			   return (false);
			 }
			 
			 			 
			  if (document.form1.r_tlf1.value == ''){
			   alert("Por favor ingrese su telefono de contacto");
			   document.form1.r_tlf1.focus();
			   return (false);
			 }	

					 
			 return (true);   
					 			 			 
			   
		   }
</script>


</head>

<body class="body-popup">
<div class="popup-titulo">Reg&iacute;strese Ahora!</div>
<div class="popup-instrucciones">
 <p>Ingrese todos los datos que le solicitamos de la manera m&aacute;s precisa
  posible. El registro en&nbsp; nuestra base
 de
datos es indispensable para inscribirse en cualquiera de nuestros cursos, realizar
  pagos y recibir notificaciones. </p>
 <p>Los campos marcados con <font color="#133DDA">*</font> son obligatorios.</p>
</div>

<form action="" method="post" name="form1" onSubmit="return validar();">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td align="center">
   <table  id="interna" width="99%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="32%" class="popup-form-title"><font color="#133DDA">*</font> Nombre y Apellido</td>
     <td width="71%"><input name="r_nombre" type="text" class="popup-form-box" size="45">     </td>
    </tr>
    <tr>
     <td class="popup-form-title"><font color="#133DDA">*</font> Su E-mail de contacto</td>
     <td><input name="r_email" type="text"	class="popup-form-box" size="45">     </td>
    </tr>
    <tr>
      <td class="popup-form-title">Email secundario</td>
      <td><input name="r_email2" type="text"	class="popup-form-box" size="45"></td>
    </tr>
    <tr>
     <td class="popup-form-title"><font color="#133DDA">*</font> Su contrase&ntilde;a deseada</td>
     <td><input name="r_password" type="password"	class="popup-form-box" id="r_password" size="20">     </td>
    </tr>
    <tr>
     <td class="popup-form-title"><font color="#133DDA">*</font> Repita la contrase&ntilde;a</td>
     <td><input name="password" type="password"	class="popup-form-box" id="password" size="20"></td>
    </tr>
    <tr>
     <td class="popup-form-title"><font color="#133DDA">*</font> Tel&eacute;fonos fijos (hab. ofic, fax...)</td>
     <td><input name="r_tlf1" type="text"class="popup-form-box" id="r_tlf1" size="45">     </td>
    </tr>
    <tr>
    <td class="popup-form-title"><font color="#133DDA">*</font> C&eacute;dula de identidad</td>
    <td><input name="r_rif" type="text" class="popup-form-box" id="r_rif" size="30">    </td>
    </tr>
    <tr>
      <td class="popup-form-title"><font color="#133DDA">*</font>&nbsp;Fecha de nacimiento.</td>
      <td><input name="r_fechan" type="text" class="popup-form-box" id="r_fechan" size="10" readonly="readonly" OnFocus="this.blur()" onClick="alert('usar el boton del calendario para llenar este campo')">
          <img src="http://www.svcmscentral.com/admin/icon/cal.gif" name="f_trigger_d" id="f_trigger_d" style="cursor: hand; border: 0px;" title="seleccionar fecha">
          <script type="text/javascript">
					Calendar.setup({
						inputField     :    "r_fechan",     // id of the input field
						ifFormat       :    "<?=strtolower("d/m/Y")?>",    // format of the input field
						button         :    "f_trigger_d",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script>      </td>
    </tr>
    <tr>
     <td class="popup-form-title">Celular</td>
     <td><input name="r_celular" type="text" class="popup-form-box" size="30">     </td>
    </tr>
    <tr>
      <td class="popup-form-title">Pa&iacute;s</td>
      <td><select name="r_pais" id="r_pais">
          <option value="Afganist&aacute;n">Afganist&aacute;n</option>
          <option value="Albania">Albania</option>
          <option value="Alemania">Alemania</option>
          <option value="Andorra">Andorra</option>
          <option value="Angola">Angola</option>
          <option value="Anguila">Anguila</option>
          <option value="Ant&aacute;rtida">Ant&aacute;rtida</option>
          <option value="Antigua y Barbuda">Antigua y Barbuda</option>
          <option value="Antillas holandesas">Antillas holandesas</option>
          <option value="Arabia Saud&iacute;ta">Arabia Saud&iacute;ta</option>
          <option value="Argentina">Argentina</option>
          <option value="Armenia">Armenia</option>
          <option value="Aruba">Aruba</option>
          <option value="Australia">Australia</option>
          <option value="Austria">Austria</option>
          <option value="Azerbaiy&aacute;n">Azerbaiy&aacute;n</option>
          <option value="Bahamas">Bahamas</option>
          <option value="Bahrein">Bahrein</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Barbados">Barbados</option>
          <option value="B&eacute;lgica">B&eacute;lgica</option>
          <option value="Belice">Belice</option>
          <option value="Ben&iacute;n">Ben&iacute;n</option>
          <option value="Bermudas">Bermudas</option>
          <option value="Bhut&aacute;n">Bhut&aacute;n</option>
          <option value="Bielorrusia">Bielorrusia</option>
          <option value="Birmania">Birmania</option>
          <option value="Bolivia">Bolivia</option>
          <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
          <option value="Botsuana">Botsuana</option>
          <option value="Brasil">Brasil</option>
          <option value="Brunei">Brunei</option>
          <option value="Bulgaria">Bulgaria</option>
          <option value="Burkina Faso">Burkina Faso</option>
          <option value="Burundi">Burundi</option>
          <option value="Cabo Verde">Cabo Verde</option>
          <option value="Camboya">Camboya</option>
          <option value="Camer&uacute;n">Camer&uacute;n</option>
          <option value="Canad&aacute;">Canad&aacute;</option>
          <option value="Chad">Chad</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Chipre">Chipre</option>
          <option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
          <option value="Colombia">Colombia</option>
          <option value="Comores">Comores</option>
          <option value="Congo">Congo</option>
          <option value="Corea">Corea</option>
          <option value="Corea del Norte">Corea del Norte</option>
          <option value="Costa del Marf&iacute;l">Costa del Marf&iacute;l</option>
          <option value="Costa Rica">Costa Rica</option>
          <option value="Croacia (Hrvatska)">Croacia (Hrvatska)</option>
          <option value="Cuba">Cuba</option>
          <option value="Dinamarca">Dinamarca</option>
          <option value="Djibouri">Djibouri</option>
          <option value="Dominica">Dominica</option>
          <option value="Ecuador">Ecuador</option>
          <option value="Egipto">Egipto</option>
          <option value="El Salvador">El Salvador</option>
          <option value="Emiratos &Aacute;rabes Unidos">Emiratos &Aacute;rabes Unidos</option>
          <option value="Eritrea">Eritrea</option>
          <option value="Eslovaquia">Eslovaquia</option>
          <option value="Eslovenia">Eslovenia</option>
          <option value="Espa&ntilde;a">Espa&ntilde;a</option>
          <option value="Estados Unidos">Estados Unidos</option>
          <option value="Estonia">Estonia</option>
          <option value="Etiop&iacute;a">Etiop&iacute;a</option>
          <option value="Ex-Rep&uacute;blica de Macedonia">Ex-Rep&uacute;blica de Macedonia</option>
          <option value="Filipinas">Filipinas</option>
          <option value="Finlandia">Finlandia</option>
          <option value="Francia">Francia</option>
          <option value="Gab&oacute;n">Gab&oacute;n</option>
          <option value="Gambia">Gambia</option>
          <option value="Georgia">Georgia</option>
          <option value="Georgia del Surr">Georgia del Surr</option>
          <option value="Ghana">Ghana</option>
          <option value="Gibraltar">Gibraltar</option>
          <option value="Granada">Granada</option>
          <option value="Grecia">Grecia</option>
          <option value="Groenlandia">Groenlandia</option>
          <option value="Guadalupe">Guadalupe</option>
          <option value="Guam">Guam</option>
          <option value="Guatemala">Guatemala</option>
          <option value="Guayana">Guayana</option>
          <option value="Guayana Francesa">Guayana Francesa</option>
          <option value="Guinea">Guinea</option>
          <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
          <option value="Guinea-Bissau">Guinea-Bissau</option>
          <option value="Hait&iacute;">Hait&iacute;</option>
          <option value="Holanda">Holanda</option>
          <option value="Honduras">Honduras</option>
          <option value="Hong Kong R. A. E">Hong Kong R. A. E</option>
          <option value="Hungr&iacute;a">Hungr&iacute;a</option>
          <option value="India">India</option>
          <option value="Indonesia">Indonesia</option>
          <option value="Irak">Irak</option>
          <option value="Ir&aacute;n">Ir&aacute;n</option>
          <option value="Irlanda">Irlanda</option>
          <option value="Isla Bouvet">Isla Bouvet</option>
          <option value="Isla Christmas">Isla Christmas</option>
          <option value="Isla Heard e Islas McDonald">Isla Heard e Islas McDonald</option>
          <option value="Islandia">Islandia</option>
          <option value="Islas Caim&aacute;n">Islas Caim&aacute;n</option>
          <option value="Islas Cook">Islas Cook</option>
          <option value="Islas de Cocos o Keeling">Islas de Cocos o Keeling</option>
          <option value="Islas Faroe">Islas Faroe</option>
          <option value="Islas Fiyi">Islas Fiyi</option>
          <option value="Islas Malvinas">Islas Malvinas</option>
          <option value="Islas Marianas del Norte">Islas Marianas del Norte</option>
          <option value="Islas Marshall">Islas Marshall</option>
          <option value="Islas menores de EE.UU">Islas menores de EE.UU</option>
          <option value="Islas Palau">Islas Palau</option>
          <option value="Islas Tokelau">Islas Tokelau</option>
          <option value="Islas Turks y Caicos">Islas Turks y Caicos</option>
          <option value="Islas V&iacute;rgenes (EE.UU.)">Islas V&iacute;rgenes (EE.UU.)</option>
          <option value="Islas V&iacute;rgenes (Reino Unido)">Islas V&iacute;rgenes (Reino Unido)</option>
          <option value="Israel">Israel</option>
          <option value="Italia">Italia</option>
          <option value="Jamaica">Jamaica</option>
          <option value="Jap&oacute;n">Jap&oacute;n</option>
          <option value="Jordania">Jordania</option>
          <option value="Kazajist&aacute;n">Kazajist&aacute;n</option>
          <option value="Kenia">Kenia</option>
          <option value="Kirguizist&aacute;n">Kirguizist&aacute;n</option>
          <option value="Kiribati">Kiribati</option>
          <option value="Kuwait">Kuwait</option>
          <option value="Laos">Laos</option>
          <option value="Lesoto">Lesoto</option>
          <option value="Letonia">Letonia</option>
          <option value="Jamaica">Jamaica</option>
          <option value="L&iacute;bano">L&iacute;bano</option>
          <option value="Liberia">Liberia</option>
          <option value="Libia">Libia</option>
          <option value="Liechtenstein">Liechtenstein</option>
          <option value="Lituania">Lituania</option>
          <option value="Luxemburgo">Luxemburgo</option>
          <option value="Macao R. A. E">Macao R. A. E</option>
          <option value="Madagascar">Madagascar</option>
          <option value="Malasia">Malasia</option>
          <option value="Malawi">Malawi</option>
          <option value="Maldivas">Maldivas</option>
          <option value="Mal&iacute;">Mal&iacute;</option>
          <option value="Malta">Malta</option>
          <option value="Marruecos">Marruecos</option>
          <option value="Martinica">Martinica</option>
          <option value="Mauricio">Mauricio</option>
          <option value="Mauritania">Mauritania</option>
          <option value="Mayotte">Mayotte</option>
          <option value="M&eacute;xico">M&eacute;xico</option>
          <option value="Micronesia">Micronesia</option>
          <option value="Moldavia">Moldavia</option>
          <option value="M&oacute;naco">M&oacute;naco</option>
          <option value="Mongolia">Mongolia</option>
          <option value="Montserrat">Montserrat</option>
          <option value="Mozambique">Mozambique</option>
          <option value="Namibia">Namibia</option>
          <option value="Nauru">Nauru</option>
          <option value="Nepal">Nepal</option>
          <option value="Nicaragua">Nicaragua</option>
          <option value="N&iacute;ger">N&iacute;ger</option>
          <option value="Nigeria">Nigeria</option>
          <option value="Niue">Niue</option>
          <option value="Norfolk">Norfolk</option>
          <option value="Noruega">Noruega</option>
          <option value="Nueva Caledonia">Nueva Caledonia</option>
          <option value="Nueva Zelanda">Nueva Zelanda</option>
          <option value="Om&aacute;n">Om&aacute;n</option>
          <option value="Panam&aacute;">Panam&aacute;</option>
          <option value="Papua Nueva Guinea">Papua Nueva Guinea</option>
          <option value="Paquist&aacute;n">Paquist&aacute;n</option>
          <option value="Paraguay">Paraguay</option>
          <option value="Per&uacute;">Per&uacute;</option>
          <option value="Pitcairn">Pitcairn</option>
          <option value="Polinesia Francesa">Polinesia Francesa</option>
          <option value="Polonia">Polonia</option>
          <option value="Portugal">Portugal</option>
          <option value="Puerto Rico">Puerto Rico</option>
          <option value="Qatar">Qatar</option>
          <option value="Reino Unido">Reino Unido</option>
          <option value="Rep&uacute;blica Centroafricana">Rep&uacute;blica Centroafricana</option>
          <option value="Rep&uacute;blica Checa">Rep&uacute;blica Checa</option>
          <option value="Rep&uacute;blica de Sud&aacute;frica">Rep&uacute;blica de Sud&aacute;frica</option>
          <option value="Rep&uacute;blica del Congo (Zaire)">Rep&uacute;blica del Congo (Zaire)</option>
          <option value="Rep&uacute;blica Dominicana">Rep&uacute;blica Dominicana</option>
          <option value="Reuni&oacute;n">Reuni&oacute;n</option>
          <option value="Ruanda">Ruanda</option>
          <option value="Rumania">Rumania</option>
          <option value="Rusia">Rusia</option>
          <option value="Samoa">Samoa</option>
          <option value="Samoa occidental">Samoa occidental</option>
          <option value="San Kitts y Nevis">San Kitts y Nevis</option>
          <option value="San Marino">San Marino</option>
          <option value="San Pierre y Miquelon">San Pierre y Miquelon</option>
          <option value="San Vicente e Islas Granadinas">San Vicente e Islas Granadinas</option>
          <option value="Santa Helena">Santa Helena</option>
          <option value="Santa Luc&iacute;a">Santa Luc&iacute;a</option>
          <option value="Santo Tom&eacute; y Pr&iacute;ncipe">Santo Tom&eacute; y Pr&iacute;ncipe</option>
          <option value="Senegal">Senegal</option>
          <option value="Serbia y Montenegro">Serbia y Montenegro</option>
          <option value="Seychelles">Seychelles</option>
          <option value="Sierra Leona">Sierra Leona</option>
          <option value="Singapur">Singapur</option>
          <option value="Siria">Siria</option>
          <option value="Somalia">Somalia</option>
          <option value="Sri Lanka">Sri Lanka</option>
          <option value="Suazilandia">Suazilandia</option>
          <option value="Sud&aacute;n">Sud&aacute;n</option>
          <option value="Suecia">Suecia</option>
          <option value="Suiza">Suiza</option>
          <option value="Surinam">Surinam</option>
          <option value="Svalbard">Svalbard</option>
          <option value="Tailandia">Tailandia</option>
          <option value="Taiw&aacute;n">Taiw&aacute;n</option>
          <option value="Tanzania">Tanzania</option>
          <option value="Tayikist&aacute;n">Tayikist&aacute;n</option>
          <option value="Territorios Franceses del Sur">Territorios Franceses del Sur</option>
          <option value="Timor Oriental">Timor Oriental</option>
          <option value="Togo">Togo</option>
          <option value="Tonga">Tonga</option>
          <option value="Trinidad y Tobago">Trinidad y Tobago</option>
          <option value="T&uacute;nez">T&uacute;nez</option>
          <option value="Turkmenist&aacute;n">Turkmenist&aacute;n</option>
          <option value="Turqu&iacute;a">Turqu&iacute;a</option>
          <option value="Tuvalu">Tuvalu</option>
          <option value="Ucrania">Ucrania</option>
          <option value="Uganda">Uganda</option>
          <option value="Uruguay">Uruguay</option>
          <option value="Uzbekist&aacute;n">Uzbekist&aacute;n</option>
          <option value="Vanuatu">Vanuatu</option>
          <option selected value="Venezuela">Venezuela</option>
          <option value="Vietnam">Vietnam</option>
          <option value="Wallis y Futuna">Wallis y Futuna</option>
          <option value="Yemen">Yemen</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabue">Zimbabue</option>
        </select>      </td>
    </tr>
    <tr>
     <td class="popup-form-title">Ciudad </td>
     <td><input name="r_ciudad" type="text" class="popup-form-box" size="20">     </td>
    </tr>
    <tr>
      <td class="popup-form-title">Empresa</td>
      <td><input name="r_empresa" type="text"
											class="popup-form-box" size="50"></td>
    </tr>
    <tr>
      <td class="popup-form-title">P&aacute;gina Web, Blog, perfil de Facebook, Twitter, etc.</td>
      <td><input name="r_web" type="text"
											class="popup-form-box" size="50"></td>
    </tr>
    <tr>
      <td class="popup-form-title">Direcci&oacute;n F&iacute;sica</td>
      <td><textarea name="r_direccion" cols="40" rows="2" class="popup-form-box" id="r_direccion"></textarea></td>
    </tr>
    
    
    
     <?php

						  ///campos adicionales

							$tool->query("select id,nombre,tipo,longitud,lineas,valores from campo where modulo = 'user' order by orden");


							   while ($row2 = mysql_fetch_assoc($tool->result)) {


								   ?>

							   <tr>
                                 <td style="vertical-align: top;" class="popup-form-title"><?php echo $row2['nombre'] ?></td>
							     <td><?php

								if($row2['tipo']=='texto'){
									echo '<input style="vertical-align: top;" class="popup-form-box" id="camposa[]" name="camposa[]" type="text" size="'.$row2['longitud'].'">';

								}else if($row2['tipo']=='textarea'){

								  echo '<textarea  class="popup-form-box" name="camposa[]" id="camposa[]" cols="'.$row2['longitud'].'" rows="'.$row2['lineas'].'"></textarea>';

								}else{

									$valorc = explode(",",$row2['valores']);
									echo $tool->combo_array ("camposa[]",$valorc,$valorc,false,false,false,'no',false,false,"popup-form-box");

								}

								echo '<input name="camposid[]" type="hidden" id="camposid[]" value="'.$row2['id'].'" />';
								?>
                                 </td>
	      </tr>

							  <?


							}


					  ?>
   </table></td>
  </tr>
  <tr>
   <td align="center">&nbsp;</td>
  </tr>
  <tr>
   <td>

<center>
<input name="Submit" type="submit" class="popup-form-button" value="Regístrese en Nuestra Base de Datos">
   &nbsp; 
<input name="Submit2" type="button" class="popup-form-button" value="Cancelar" onClick="window.close();">

</center>

</td></tr>
 </table>
</form>
</body>
</html>
