<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../../SVsystem/config/setup.php"); ////////setup
include("../../../SVsystem/class/tools.php");

include("../security.php");

$form = new tools();
///////////////

 
  if(isset($_REQUEST['Submit52'])){
  
  
  				$prefi = @date('his_').$_FILES['file3']['name'];
				
	
			///////////////
	
			$tool = new tools();
			$subido = $tool->upload_file($_FILES['file3'],'../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/doc/'.$prefi,50);
			if(!$subido) $tool->javaviso('error subiendo el archivo');
						
			if(!empty($_SESSION['FILES'][$_POST['ordenf']])){
			
				/*		
				for($j=count($_SESSION['FILES']);$j>$_POST['ordenf'];$j--){
				
					$_SESSION['FILES'][$j] = $_SESSION['FILES'][$j-1];
					$_SESSION['FILES_T'][$j] = $_SESSION['FILES_T'][$j-1];
					
				
				
				}*/
				
				@unlink('../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/doc/'.$prefi);
				
				$_SESSION['FILES'][$_POST['ordenf']]   = $prefi;
				$_SESSION['FILES_T'][$_POST['ordenf']] = $_POST['titulof'];
			
			}else{
			
				$I = count($_SESSION['FILES']);
				$_SESSION['FILES'][$I] = $prefi;
				$_SESSION['FILES_T'][$I] = $_POST['titulof'];
			
			}
			/////////////////
		
	
	}else if(isset($_REQUEST['borrar'])){
			
				$imag = $_SESSION['FILES'][$_REQUEST['borrar']];
				$titu = $_SESSION['FILES_T'][$_REQUEST['borrar']];
								
				for($i=$_REQUEST['borrar'];$i<count($_SESSION['FILES']);$i++){
			
			
					$_SESSION['FILES'][$i]   = $_SESSION['FILES'][$i+1];
					$_SESSION['FILES_T'][$i] = $_SESSION['FILES_T'][$i+1];
						
			
				}
			
				array_pop ($_SESSION['FILES']);
				array_pop ($_SESSION['FILES_T']);
				
				
				@unlink('../../../SVsitefiles/'.$_SESSION['DIRSERVER'].'/contenido/doc/'.$imag);
			
			
	}else if (isset($_REQUEST['orden'])){
			
				if($_REQUEST['sent']=="u" && $_SESSION['FILES'][$_REQUEST['orden']-1]!=''){
					
						$temp = $_SESSION['FILES'][$_REQUEST['orden']-1];
						$_SESSION['FILES'][$_REQUEST['orden']-1] = $_SESSION['FILES'][$_REQUEST['orden']];
						$_SESSION['FILES'][$_REQUEST['orden']] = $temp;
						
						$temp2 = $_SESSION['FILES_T'][$_REQUEST['orden']-1];
						$_SESSION['FILES_T'][$_REQUEST['orden']-1] = $_SESSION['FILES_T'][$_REQUEST['orden']];
						$_SESSION['FILES_T'][$_REQUEST['orden']] = $temp2;
			
				}else if($_REQUEST['sent']=="d" && $_SESSION['FILES'][$_REQUEST['orden']+1]!=''){
					
						$temp = $_SESSION['FILES'][$_REQUEST['orden']+1];
						$_SESSION['FILES'][$_REQUEST['orden']+1] = $_SESSION['FILES'][$_REQUEST['orden']];
						$_SESSION['FILES'][$_REQUEST['orden']] = $temp;
						
						$temp2 = $_SESSION['FILES_T'][$_REQUEST['orden']+1];
						$_SESSION['FILES_T'][$_REQUEST['orden']+1] = $_SESSION['FILES_T'][$_REQUEST['orden']];
						$_SESSION['FILES_T'][$_REQUEST['orden']] = $temp2;
			
			
				}
			
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="../../estilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>files</title>


</head>

<body style="background-image:none;">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
   <?php for($j=0;$j<count($_SESSION['FILES']);$j++){
   
   				$prei = explode(".",$_SESSION['FILES'][$j]);
				$iconn = $prei[1].'.gif';
				unset($prei);
   
    ?>
  <tr>
    <td width="2%"><img src="../../icon/file_list_icons/icon_<?php echo $iconn; ?>" width="16" height="16" /></td>
    <td width="2%" class="bdc-td-dato-detalle2"><?php echo $j+1; ?></td>
    <td width="51%" class="bdc-td-dato-detalle2"><strong><?php echo $_SESSION['FILES'][$j]; ?></strong></td>
    <td width="34%" class="bdc-td-dato-detalle2"><?php echo utf8_encode($_SESSION['FILES_T'][$j]); ?></td>
    <td width="11%"><img style="cursor:pointer" title="borrar este documento" onClick="location.replace('files.php?borrar=<?=$j?>');" src="../../icon/icon-delete.gif" width="16" height="16" border="0" /> <img style="cursor:pointer" title="bajar de lugar" onClick="location.replace('files.php?orden=<?=$j?>&sent=d');" src="../../icon/icon-down.gif" width="16" height="16" border="0" /><img title="subir de lugar" style="cursor:pointer" onClick="location.replace('files.php?orden=<?=$j?>&sent=u');" src="../../icon/icon-up.gif" width="16" height="16" border="0" /></td>
  </tr>
  <?php } ?>
  
  
</table>
</body>
</html>
