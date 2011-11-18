<?

if(!in_array('1',$_SESSION['MODULOS'])){ ///si se encuentra el modulo

session_destroy();

 ?>

 <script language="JavaScript" type="text/javascript">

 top.location.replace('<?=$LOGINPAGE ?>');

 </script>

 <?
die();

}


?>
