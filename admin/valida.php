<?php session_start();
 include("../SVsystem/config/masterconfig.php");
 include("../SVsystem/class/clases.php");

 $i = new formulario('db');


 if(isset($_POST['user'])){


 		/////me traigo las credenciales de forma segura
		 $user = $i->getvar("user",$_POST);
		 $pass2 = $i->getvar("pass",$_POST);


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
										  where user = '$user' and pass = MD5('$pass2')");

		 if($i->nreg>0){


				if($DATOS['activo']==1){

						$_SESSION['PROFILE']     = 'admin'; ///perfil de ingreso
						$_SESSION['USERID']      = $DATOS['id'];
						$_SESSION['USER']      = $user;
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

						///vaciando variables de sesion de accesos denegados
						unset($_SESSION['VECESI']);
                        unset($_SESSION['ROBOIP']);

						echo "1"; ///puede entrar

				}else{

						echo '2';

				}



		 }else{ ////si ingresa mal pwd y login

		 	if(!isset($_SESSION['VECESI'])) $_SESSION['VECESI'] = 1; else $_SESSION['VECESI']++;


            ////guarda intento fallido

               $vector[0] =  $user;
               $vector[1] =  $pass2;
               $vector[2] =  $_SERVER['REMOTE_ADDR'];
               $vector[3] =  date("Y-m-d H:i:s");
               $vector[4] =  $_SERVER['HTTP_USER_AGENT'];

              $i->insertar2("log_fallos","user,pwd,ip,fecha,navegador",$vector);
            ////////////////////////////



			    if($_SESSION['VECESI']==3){ ///tercer intento fallido

				    unset($_SESSION['VECESI']);
                    if(!isset($_SESSION['ROBOIP'])) $_SESSION['ROBOIP'][0] = '';

                    $i->query("update admin set activo = 2 where user = '$user' "); ///desactivando al intruso
                    $mensaje = "User: $user Password: $pass2 IP: {$_SERVER['REMOTE_ADDR']} ";

                       if(!in_array($_SERVER['REMOTE_ADDR'],$_SESSION['ROBOIP'])){

                         array_push($_SESSION['ROBOIP'], $_SERVER['REMOTE_ADDR']);   ///guardando lista de ip con correo
                         mail("esteban.didito@gmail.com"," Reporte de intento fallido de acceso en svcmscentral.com",$mensaje);

                       }
			     }


			echo "0";

		 }


 }


$i->cerrar();

?>