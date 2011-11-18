<?php session_start();
 include("../../SVsystem/config/dbconfig.php");
 include("../../SVsystem/class/tools.php");
 
 $i = new tools();
 $i->autoconexion();
 
 
 if(isset($_POST['user'])){
 
 
 
		 $user = trim($_POST['user']);
		 
		 
		 $DATOS = $i->simple_db("select id,nombre from admin where user = '$user' and pass = MD5('{$_POST['pass']}')");
 
		 if($i->nreg>0){
		 
					
			$_SESSION['PROFILE'] = 'admin'; ///perfil de ingreso
			$_SESSION['USERID']  = $DATOS['id'];
			$_SESSION['NOMBRE']  = $DATOS['nombre'];
			$_SESSION['PORDENES'] = $i->simple_db("SELECT IFNULL((select count(*) from orden_compra where estatus = 'nueva'),0)");
			echo "1"; ///puede entrar
			
		 }else{
		 
			echo "0";
		 
		 }
		 
		 
 }		 
		 
		 
$i->cerrar();

?>
