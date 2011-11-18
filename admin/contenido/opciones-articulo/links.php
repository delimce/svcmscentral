<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../../SVsystem/config/setup.php"); ////////setup

include("../security.php");

///////////////

 
  if(isset($_REQUEST['Submit523'])){
  
  
  				$prefi = $_REQUEST['url'];
	
			///////////////
	
			
			if(!empty($_SESSION['LINKS'][$_POST['ordenl']])){
			
						
				/*for($j=count($_SESSION['LINKS']);$j>$_POST['ordenl'];$j--){
				
					$_SESSION['LINKS'][$j] = $_SESSION['LINKS'][$j-1];
					$_SESSION['LINKS_T'][$j] = $_SESSION['LINKS_T'][$j-1];
					
				
				
				}*/
				
				$_SESSION['LINKS'][$_POST['ordenl']]   = $prefi;
				$_SESSION['LINKS_T'][$_POST['ordenl']] = $_POST['titulol'];
			
			}else{
			
				$I = count($_SESSION['LINKS']);
				$_SESSION['LINKS'][$I] = $prefi;
				$_SESSION['LINKS_T'][$I] = $_POST['titulol'];
			
			}
			/////////////////
		
	
	}else if(isset($_REQUEST['borrar'])){
			
				$imag = $_SESSION['LINKS'][$_REQUEST['borrar']];
				$titu = $_SESSION['LINKS_T'][$_REQUEST['borrar']];
								
				for($i=$_REQUEST['borrar'];$i<count($_SESSION['LINKS']);$i++){
			
			
					$_SESSION['LINKS'][$i]   = $_SESSION['LINKS'][$i+1];
					$_SESSION['LINKS_T'][$i] = $_SESSION['LINKS_T'][$i+1];
						
			
				}
			
				array_pop ($_SESSION['LINKS']);
				array_pop ($_SESSION['LINKS_T']);
				
				
							
	}else if (isset($_REQUEST['orden'])){
			
				if($_REQUEST['sent']=="u" && $_SESSION['LINKS'][$_REQUEST['orden']-1]!=''){
					
						$temp = $_SESSION['LINKS'][$_REQUEST['orden']-1];
						$_SESSION['LINKS'][$_REQUEST['orden']-1] = $_SESSION['LINKS'][$_REQUEST['orden']];
						$_SESSION['LINKS'][$_REQUEST['orden']] = $temp;
						
						$temp2 = $_SESSION['LINKS_T'][$_REQUEST['orden']-1];
						$_SESSION['LINKS_T'][$_REQUEST['orden']-1] = $_SESSION['LINKS_T'][$_REQUEST['orden']];
						$_SESSION['LINKS_T'][$_REQUEST['orden']] = $temp2;
			
				}else if($_REQUEST['sent']=="d" && $_SESSION['LINKS'][$_REQUEST['orden']+1]!=''){
					
						$temp = $_SESSION['LINKS'][$_REQUEST['orden']+1];
						$_SESSION['LINKS'][$_REQUEST['orden']+1] = $_SESSION['LINKS'][$_REQUEST['orden']];
						$_SESSION['LINKS'][$_REQUEST['orden']] = $temp;
						
						$temp2 = $_SESSION['LINKS_T'][$_REQUEST['orden']+1];
						$_SESSION['LINKS_T'][$_REQUEST['orden']+1] = $_SESSION['LINKS_T'][$_REQUEST['orden']];
						$_SESSION['LINKS_T'][$_REQUEST['orden']] = $temp2;
			
			
				}
			
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="../../estilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


</head>

<body  style="background-image:none;">
<table width="100%" border="0" cellspacing="5" cellpadding="0">

 <?php for($i=0;$i<count($_SESSION['LINKS']);$i++){ ?>
 
  <tr>
    <td width="2%"><img src="../../icon/file_list_icons/icon_htm.gif" width="15" height="15"></td>
    <td width="2%" class="bdc-td-dato-detalle2"><?php echo $i+1 ?></td>
    <td width="46%" class="bdc-td-dato-detalle2"><strong><?php echo utf8_encode($_SESSION['LINKS'][$i]) ?></strong></td>
    <td width="39%" class="bdc-td-dato-detalle2"><?php echo utf8_encode($_SESSION['LINKS_T'][$i]) ?></td>
    <td width="11%"><img style="cursor:pointer" title="borrar este documento" onClick="location.replace('links.php?borrar=<?=$i?>');" src="../../icon/icon-delete.gif" width="16" height="16" border="0" /> <img style="cursor:pointer" title="bajar de lugar" onClick="location.replace('links.php?orden=<?=$i?>&sent=d');" src="../../icon/icon-down.gif" width="16" height="16" border="0" /><img title="subir de lugar" style="cursor:pointer" onClick="location.replace('links.php?orden=<?=$i?>&sent=u');" src="../../icon/icon-up.gif" width="16" height="16" border="0" /></td>
  </tr>
  
  <?php } ?>
  
</table>
</body>
</html>
