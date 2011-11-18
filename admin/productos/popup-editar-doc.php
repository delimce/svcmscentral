<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");


	if(isset($_POST['Submit'])){
		
	/////////////////borrar el anterior
	
	
	if(!empty($_POST['actual'])){
		
		@unlink('../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/doc/'.$_POST['actual']);
		
	}
	
	////////////////////////////////////	
		
		
	///////////////
	
		$tool = new tools();
		$tool->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/producto/doc/'.$_FILES['archivo']['name'],5);
	
	//////////////		
	
	
	?>
     <script language="JavaScript" type="text/JavaScript">
   window.opener.document.getElementById('doc_file').value = '<?php echo $_FILES['archivo']['name']  ?>'; 
   window.opener.document.getElementById('doc_file2').innerHTML= '<?php echo $_FILES['archivo']['name']  ?>';
   window.close();
   </script>
    
    <?
	
	
		
	}	


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title> Agregar / Editar Documento</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>

</head>

<body class="body-popup">
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Agregar / Editar Documento</td>
 </tr>
 <tr>
  <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
   <tr>
    <td width="24%" class="td-form-title">Ubicaci&oacute;n del documento</td>
    <td width="76%"><input name="archivo" type="file" class="form-box" size="40" id="archivo">
      <input name="actual" type="hidden" id="actual" value="<?php echo $_REQUEST['actual'] ?>"></td>
   </tr>

   <tr>
    <td>&nbsp;</td>
   <td><input name="Submit" type="submit" class="form-button" value="OK">&nbsp;
     <input name="Submit2" type="button" class="form-button" onClick="window.close();" value="Cancelar"></td>
   </tr>
  </table></td>
 </tr>
</table>
</form>
<span id="ccSpan" style="display:none"><a href="#"></a></span>
</body>
</html>
