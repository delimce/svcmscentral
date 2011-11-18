<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

 $datos = new tools('db');
 
 $dataempre = $datos->simple_db("select * from preferencias");
 
   //////////datos de la empresa
  $nombre_empresa = $dataempre['nombre_empresa'];
  $url_empresa = $dataempre['url_empresa'];

 
 if(!empty($_REQUEST['too'])){
	 
	  $estos = implode(',',$_REQUEST['too']); 
	 
	  
	  
	  $dataemail3 = $datos->simple_db("select soporte_email,nombre_empresa,subject_users_registro_activo, users_registro_activo from preferencias");
	  $usuarios = $datos->estructura_db("select email,nombre,password from cliente where id in ($estos)");					
	  
	  		$datos->query("SET AUTOCOMMIT=0"); ////iniciando la transaccion
			$datos->query("START TRANSACTION");	
			
		 		$datos->query("update cliente set activo = 1 where id in ($estos) ");
			
			$datos->query("COMMIT");
			
	  		$datos->cerrar();
	  
	 $datos->javaviso('usuarios activados con exito');
	 
	 
	 
	 /////////////////////////envio de emails
	 for($i=0;$i<count($_REQUEST['too']);$i++){
		 
		 		
				
						//////envio de corrreo activo
					
						 
						  $original  = array('$usern', '$usere', '$claven', '$nombre_empresa', '$url_empresa');
						  $reemplazo = array($usuarios[$i]['nombre'], $usuarios[$i]['email'], $usuarios[$i]['password'], $nombre_empresa, $url_empresa);
			
						  $email_subject = str_replace($original, $reemplazo, $dataemail3['subject_users_registro_activo']);
						  $email_content = str_replace($original, $reemplazo, $dataemail3['users_registro_activo']);
						  
						  $headers  = 'MIME-Version: 1.0' . "\r\n";
						  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

						  // colocando el from
						  $headers .= "From: {$dataemail3['nombre_empresa']} < {$dataemail3['soporte_email']} >" . "\r\n";
		  
						  ////////enviando correo
						  if(!mail($usuarios[$i]['email'], $email_subject, $email_content, $headers)){
							  $datos->javaviso("No se pudo enviar el correo");
		  
						  }
					  
						//////////////////	  
				
		 
	 }
	 
	 
	
 }else{
	 
	  $datos->javaviso('ERROR: Debe seleccionar al menos un usuario para poder activarlo con exito');
 }
 
 

 

 
 ?>
 <script type="text/javascript">
history.back();
</script>

