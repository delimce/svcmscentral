<?

if($_SESSION['ESADMIN']!=1){

 $LOGINPAGE = $_SERVER['HTTP_HOST']."/admin/index.php";
 session_destroy();
 $LOGINPAGE = "http://$LOGINPAGE";

 ?>

 <script language="JavaScript" type="text/javascript">

 top.location.replace('<?=$LOGINPAGE ?>');

 </script>

 <?
die();

}


?>
