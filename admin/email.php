<?

		
				$dataemail = $tool->array_query2("select nombre_empresa,soporte_email from preferencias");
			
				include("../SVsystem/class/email.php");
				$mail = new email(); 
				
				
				$mail->From = $dataemail[1];
				$mail->FromName = $dataemail[0];
				$mail->AddAddress($email_send, $nombre_email);
				//$mail->AddAddress("ellen@example.com");                  // name is optional
				$mail->AddReplyTo($dataemail[1],"administrador $dataemail[0] ");
				
				$mail->WordWrap = 90;                                 // set word wrap to 50 characters
				//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
				//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
				$mail->IsHTML(true);                                  // set email format to HTML
				
				$mail->Subject = $email_subject;
				$mail->Body    = $email_content;
								
				
				//$mail->AltBody = LANG_email_mes1_ins.'\n\r'.LANG_emai2_mes2_ins.'\n\r'.LANG_email_mes3_ins.'\n\r'.LANG_login.' '.$_POST['login1'].'\n\r'.LANG_pass.' '.$_POST['pass1'].'\n\r'.LANG_email_mes4_ins.' '.$dataemail[1];
				
				if(!$mail->Send())
				{
				   echo 'no se pudo enviar el correo';
				   echo "Mailer Error: " . $mail->ErrorInfo;
				   exit;
				}

					
			

?>