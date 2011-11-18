<?php 

                     include('SVsystem/config/dbconfig.php');
                     include('SVsystem/class/tools.php');
                     include('SVsystem/class/email.php'); 
                     $mail = new email();
                     $tool = new tools();
                     $tool->autoconexion();

		 if(!empty($_REQUEST['email'])){
		 
			 
			  $existe = $tool->simple_db("select password from cliente where email = '{$_REQUEST['email']}' limit 1");
			  
			  if($tool->nreg>0){
			   
			   $dataemail = $tool->array_query2("select nombre_empresa,mail_compra_cliente from preferencias");
			   $email_send = $_REQUEST['email'];
			   $nombre_email = $_REQUEST['email'];
			   $email_subject = "Recordatorio de su clave $dataemail[0] ";
			   $email_content = "Su clave para entrar al sistema $dataemail[0] es: '$existe' ";
			   
			   
			   
			  $headers  = 'MIME-Version: 1.0' . "\r\n";
      		  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      		  $headers .= "From: $dataemail[0] <$dataemail[1]>" . "\r\n" .
   							"Reply-To: $dataemail[1]" . "\r\n";
			
				if(!mail($email_send,$email_subject,$email_content,$headers))echo 'el mail no se envio!!';
			   
			   
			   
			    $tool->javaviso("Su clave ha sido enviada con exito","cerrar");
			   
			   }else{
			   
			    $tool->javaviso("El email no existe en la base de datos","cerrar");
				
				}
			  
		 
		 }else{
        
              $data = $tool->simple_db("select popup_style from preferencias"); 
        
         }	
		 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Olvido su Password?</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $data ?>" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">
<div class="popup-titulo">¿Olvidó su contraseña?</div>
<div class="popup-instrucciones">
Inserte su email registrado para que el sistema le envíe su contraseña inmediatamente. si su e-mail no est&aacute; registrado usted deber&iacute;a registrarse de nuevo o contactarnos para solicitar soporte.
</div>

<form name="form1" method="post" action="">
 <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td align="center" class="popup-form-title">&nbsp;</td>
   <td align="center" class="popup-form-title">&nbsp;</td>
  </tr>
  <tr>
   <td class="popup-form-title">Su email registrado</td>
   <td width="50%"><input name="email" type="text" class="popup-form-box" size="30" id="email">
   </td>
  </tr>
  <tr>
   <td align="center">&nbsp;</td>
   <td><input name="Submit" type="submit" class="popup-form-button" value="Envíenme mi contraseña"></td>
  </tr>
 </table>
</form>
</body>
</html>
<?  $tool->cerrar(); ?>
