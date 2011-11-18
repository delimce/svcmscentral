<?php session_start();
 include("../SVsystem/config/masterconfig.php");
 include("../SVsystem/class/tools.php");
 
 $i = new tools();
 $i->autoconexion();
 
 
 if(isset($_POST['user'])){
 
 
 
		 $user = trim($_POST['user']);
		 
		 
		 $DATOS = $i->simple_db("SELECT 
		 						  c.id as cid,
								  c.dbserver,
								  c.dbuser,
								  c.dbpass,
								  c.titulo,
								  c.dbname,
								  c.dirserver,
								  c.url,
								  a.nombre,
								  a.id,
								  a.activo,
								  a.es_admin,
								  a.servicios
								FROM
								  admin a
								  INNER JOIN cuenta c ON (a.cuenta_id = c.id)
										  where user = '$user' and pass = MD5('{$_POST['pass']}')");
 
		 if($i->nreg>0){
		 
				
				if($DATOS['activo']==1){		
						
						$_SESSION['PROFILE']     = 'admin'; ///perfil de ingreso
						$_SESSION['USERID']      = $DATOS['id'];
						$_SESSION['ESADMIN']     = $DATOS['es_admin'];
						$_SESSION['SERVICIO']    = $DATOS['servicios'];
						$_SESSION['STITULO']     = $DATOS['titulo'];
						$_SESSION['SSERVER']     = $DATOS['dbserver'];
						$_SESSION['SDBUSER']     = $DATOS['dbuser'];
						$_SESSION['SDBPASS']     = $DATOS['dbpass'];
						$_SESSION['SDBNAME']     = $DATOS['dbname'];
						$_SESSION['SURL']     	 = $DATOS['url'];
						$_SESSION['DIRSERVER']   = $DATOS['dirserver']; ///variable de carpeta archivos e imagenes
						
						//////guardando acceso al registro de administradores
						$acces1[0]='';
						$acces1[1]= $_SESSION['USERID'];
						$acces1[2]= date("Y-m-d H:i:s");
						$acces1[3]= $DATOS['cid'];
						$acces1[4]= $_SERVER['REMOTE_ADDR'];
						$i->insertar2("admin_log","id,admin_id,fecha,id_cuenta,dir_ip",$acces1);
						///////////////////////////////////////////////////////
						
						echo "1"; ///puede entrar
				
				}else{
				
						echo '2';
				
				}
			
			
			
		 }else{
		 
			echo "0";
		 
		 }
		 
		 
 }		 
		 
		 
$i->cerrar();

?>
