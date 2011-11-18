<?


				$dataemail = $tool->array_query2("select nombre_empresa,soporte_email from preferencias");

			/*
				include("../SVsystem/class/email.php");
				$mail = new email();


				$mail->From = $dataemail[1];
				$mail->FromName = $dataemail[0];
				$mail->AddAddress($email_send, $nombre_email);
				//$mail->AddAddress("ellen@example.com");                  // name is optional
				$mail->AddReplyTo($dataemail[1],"administrador $dataemail[0]");

				$mail->WordWrap = 90;                                 // set word wrap to 50 characters
				//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
				//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
				$mail->IsHTML(true);                                  // set email format to HTML

				$mail->Subject = $titulo;
				$mail->Body    = $mensaje;





				//$mail->AltBody = LANG_email_mes1_ins.'\n\r'.LANG_emai2_mes2_ins.'\n\r'.LANG_email_mes3_ins.'\n\r'.LANG_login.' '.$_POST['login1'].'\n\r'.LANG_pass.' '.$_POST['pass1'].'\n\r'.LANG_email_mes4_ins.' '.$dataemail[1];


				///enviando emails en masa

				for($i=0;$i<count($dirs);$i++){

						$mail->AddAddress($dirs[$i]);

						 if(!$mail->Send())
						{
						   echo 'no se pudo enviar el correo';
						   echo " Mailer Error: " . $mail->ErrorInfo;
						   exit;
						}


				 }

				*/



				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// colocando el from
				$headers .= "From: $dataemail[0] < $dataemail[1] >" . "\r\n";
				//$headers .= "Bcc: $to1 " . "\r\n";
				
				
				for($i=0;$i<count($dirs);$i++){

					////////enviando correos masivo
					  if(!mail($dirs[$i], $titulo, $mensaje, $headers)){
						  $tool->javaviso("No se pudo enviar el correo","opciones-email.php");
	  
					  }

				 }
				

				////////enviando correos masivo
				if(!mail($dataemail[1], $titulo, $mensaje, $headers)){
					$tool->javaviso("No se pudo enviar el correo","opciones-email.php");

				}






?>