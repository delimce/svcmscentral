<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

include("security.php");

$tool = new formulario();
$tool->autoconexion();


		if(isset($_POST['r_link'])){	
			
			///////////////
	
			 
				 if(!empty($_FILES['archivo']['name'])){
				 
					 $prefi = @date('his_').$_FILES['archivo']['name'];
					 $sesubio =  $tool->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/banner/'.$prefi,1,'image/gif,image/jpeg,image/png,image/pjpeg,image/jpg,image/pjpg');
					 if($sesubio == false)$tool->redirect("cerrar");
					
					$_POST['r_archivo'] = $prefi;
					 
				 }else{
					 
						$_POST['r_archivo'] = $_POST['imagen2'];
				 
				 }
				 
				 
				 
				  if(!empty($_FILES['archivo2']['name'])){
				 
					 $prefi = @date('his_').$_FILES['archivo2']['name'];
					 $sesubio = $tool->upload_file($_FILES['archivo2'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/banner/'.$prefi,1,'image/gif,image/jpeg,image/png,image/pjpeg,image/jpg,image/pjpg');
					  if($sesubio == false)$tool->redirect("cerrar");
					 $_POST['r_archivover'] = $prefi;
					
					 
				 }else{
					 
						$_POST['r_archivover'] = $_POST['imagen3'];
				 
				 }
			 	
		
			 $tool->update_data("r","_","banner",$_POST,"id='{$_POST['id']}'");	
			 
			
			?>
						  <script language="JavaScript" type="text/JavaScript">
						   window.opener.location.reload(); window.close();
						   </script>
			<?	
			
			
		}else{
		
		
			$data = $tool->simple_db("select * from banner where id = '{$_REQUEST['id']}'");
		
		}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar Banner</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>


</head>

<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="td-titulo-popup">Editar Banner</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
 <td><form action="" method="post" enctype="multipart/form-data" name="form1">
 <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
   <td class="td-form-title">&nbsp;</td>
   <td><img src="<?php echo '/SVsitefiles/'.$_SESSION['DIRSERVER'].'/banner/'.$data['archivo'] ?>" ></td>
  </tr>
  <tr>
   <td width="25%" class="td-form-title">Archivo</td>
   <td width="75%"><input name="archivo" type="file" class="form-box" size="50" id="archivo">
     <input name="id" type="hidden" id="id" value="<?=$data['id']?>">
     <input name="imagen2" type="hidden" id="imagen2" value="<?=$data['archivo']?>"></td>
  </tr>
  <tr>
    <td class="td-form-title">Archivo (mouse over)</td>
    <td><input name="archivo2" type="file" class="form-box" size="50" id="archivo2">
      <input name="imagen3" type="hidden" id="imagen3" value="<?=$data['archivover']?>"></td>
  </tr>
  <tr>
   <td class="td-form-title">Enlace</td>
   <td><input name="r_link" type="text" class="form-box" id="r_link" value="<?=$data['link']?>" size="60"></td>
  </tr>
  <tr>
   <td class="td-form-title">Destino</td>
   <td><select name="r_target" class="form-box" id="r_target">
     <option value="_self" <?php if($data['target']=="_self") echo "selected";  ?>>Misma Ventana</option>
     <option value="_blank" <?php if($data['target']=="_blank") echo "selected";  ?>>Ventana Nueva</option>
   </select></td>
  </tr>
  <tr>
   <td class="td-form-title">Caption</td>
   <td><input name="r_caption" type="text" class="form-box" id="r_caption" value="<?=$data['caption']?>" size="60"></td>
  </tr>
  <tr>
   <td class="td-form-title">&nbsp;</td>
   <td><input name="Submit" type="submit" class="form-button" value="OK">&nbsp; 
   <input name="Submit2" type="button" onClick="window.close();" class="form-button" value="Cancelar"></td>
  </tr>
 </table>
 </form></td>
</tr>
<tr>
 <td>&nbsp;</td>
</tr>
</table>

</body>
</html>
<?php $tool->cerrar(); ?>
