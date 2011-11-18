<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

 $tool = new tools('db');
 
	 if(isset($_REQUEST['borra2'])){ ///borrando del temporal
						
						$ab = "../../SVsitefiles/".$_SESSION['DIRSERVER']."/usuario/doc/".$_SESSION['ARCHIVOS'][$_REQUEST['borra2']];
						@unlink($ab);
						 
						 for($i=$_REQUEST['borra2'];$i<count($_SESSION['ARCHIVOS']);$i++){
						
						
								$_SESSION['ARCHIVOS'][$i]   = $_SESSION['ARCHIVOS'][$i+1];				
						
							}
							
							@array_pop ($_SESSION['ARCHIVOS']);
							
						for($i=$_REQUEST['borra2'];$i<count($_SESSION['ADESCRIP']);$i++){
						
						
								$_SESSION['ADESCRIP'][$i]   = $_SESSION['ADESCRIP'][$i+1];				
						
							}
							
							@array_pop ($_SESSION['ADESCRIP']);
	
							
		 
	 }
	 
	 
	  if(isset($_REQUEST['borra'])){ ///borrando del temporal
						
						$ab = "../../SVsitefiles/".$_SESSION['DIRSERVER']."/usuario/doc/".$_REQUEST['borra'];
						unlink($ab);
						 
						$tool->query("delete from cliente_archivo where ruta = '{$_REQUEST['borra']}' and cliente_id = '{$_SESSION['USERACTUAL']}' ");
		 
	  }
 
 
 
 if(!empty( $_SESSION['USERACTUAL'] )) $tool->query("select * from cliente_archivo where cliente_id = '{$_SESSION['USERACTUAL']}' ");
 
 if(isset($_REQUEST['submit'])){
	 
			//$prefi = @date('his_').$_FILES['archivo']['name'];
			$prefi = $_FILES['archivo']['name'];
			$subido = $tool->upload_file($_FILES['archivo'],'../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/usuario/doc/'.$prefi,5);
			if($subido == false)$tool->javaviso("El archivo no fue subido","archivos.php");
			
			array_push($_SESSION['ARCHIVOS'],$prefi); //GUARDANDO EL ARCHIVO EN TEMPORAL
			array_push($_SESSION['ADESCRIP'],$_REQUEST['descrip']); //GUARDANDO EL ARCHIVO EN TEMPORAL
	 
 }
 
 
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>archivos adjuntos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function validar(){

if(document.form1.descrip.value==""){

  alert('Debe colocar un titulo del documento');
 return false;

}

return true;

}
</script>




</head>
<body style="background:#fff url(none);">
<form action="archivos.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="return validar();">
  <table  width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td class="td-headertabla4" colspan="3">Archivos Ya Cargados</td>


</tr>   

<tr>
<td width="30%" class="td-headertabla3">Nombre de Archivo</td>
<td width="60%" class="td-headertabla3">Título visible del documento</td>
<td width="5%" class="td-headertabla3">Borrar?</td>
</tr>

   <?php if(isset( $_SESSION['USERACTUAL'])){  while ($row = mysql_fetch_assoc($tool->result)) {?>

<tr>
      <td class="td-content" width="40%" align="left"><b><?php echo $row['ruta'] ?></b></td>
      <td class="td-content" width="55%" align="left"><?php echo $row['descrip'] ?></td>
      <td class="td-content" width="5%" align="center"><a href="archivos.php?borra=<?php echo $row['ruta'] ?>"><img border="0" src="../icon/icon-delete.gif" width="16" height="16" title="borrar este archivo. Esta accion es IRREVERSIBLE. Proceda con cautela"></a></td>
    </tr>
    <?php } } ?>
    
    <?php  for($i=0;$i<count($_SESSION['ARCHIVOS']);$i++){ ?>
     <tr>
      
      <td width="40%"  class="td-content"><b><?php echo $_SESSION['ARCHIVOS'][$i] ?></b></td>
      <td width="55%" class="td-content"><?php echo $_SESSION['ADESCRIP'][$i] ?></td>
      <td width="5%" align="center" class="td-content"><a href="archivos.php?borra2=<?php echo $i ?>"><img border="0" src="../icon/icon-delete.gif" width="16" height="16" title="borrar este archivo. Esta accion es IRREVERSIBLE. Proceda con cautela"></a></td>
    </tr>
    <?php }  ?>
    
    <tr>
     <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
     <td colspan="3" class="td-form-title-izq">Subir Nuevo Archivo</td>
    </tr>
    <tr>
<td colspan="3" class="td-content2">NO use caracteres especiales (acentos, &ntilde;, &ordm;, # $ % &amp;, etc, etc) en los nombres de los archivos que est&aacute; por cargar. Por favor S&Oacute;LO use numeros y letras.</td>
</tr>
<tr>
  <td colspan="3"> 
  <font color="#003399" size="1">Archivo:</font>
  <input name="archivo" type="file" class="form-box" id="archivo" size="15">

&nbsp;&nbsp; 

<font color="#003399" size="1">Descripci&oacute;n        </font>:&nbsp;
  <input name="descrip" type="text" class="form-box" id="descrip" size="40">
</td>
</tr>
    <tr>
      <td colspan="4" align="right"></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input name="submit" type="submit" class="form-button" id="submit" value="Subir Archivo"></td>
    </tr>
  </table>
</form>
</body>
</html>
 <?
 
 $tool->cerrar();
 
 ?>