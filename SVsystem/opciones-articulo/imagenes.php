<?php session_start();

include("../config/dbconfig.php"); ////////setup
include("../class/tools.php");
include("../class/image.php");
include("../class/funciones.php");

$form = new tools();
///////////////

//////CONTENIDO  GALERIAS DE ARTÍCULO - redimensionar imagen media
 $cont_gal_imgmed_width = 560;
 $cont_gal_imgmed_height = 420;
 ///////CONTENIDO GALERÍAS DE ARTICULO - redimensionar turnate
 $cont_gal_imgsmall_width = 80;
 $cont_gal_imgsmall_height = 80;
 
 
 
  if(isset($_REQUEST['Submit5'])){
  
  
  				$prefi = @date('his_').$_FILES['file2']['name'];
	
			///////////////
	
			$tool = new tools();
			$subido = $tool->upload_file($_FILES['file2'],'../../SVcontent/contenido/orig/'.$prefi,1);
			
			if($subido){ ///se subio la imagen con exito
			
				$ruta  = '../../SVcontent/contenido/orig/'.$prefi;
				$ruta2 = '../../SVcontent/contenido/med/'.$prefi;
				$ruta3 = '../../SVcontent/contenido/turn/'.$prefi;
				
				$imagen = new image($ruta);
				$imagen->redimensionar($ruta2, $cont_gal_imgmed_width, $cont_gal_imgmed_height, 95); ///media
				$imagen->redimensionar($ruta3, $cont_gal_imgsmall_width, $cont_gal_imgsmall_height, 95); ///turn
				$imagen->destruir();
								
				
			}
			
			if(!empty($_SESSION['IMAGENES'][$_POST['ordeni']])){
			
						
			/*	for($j=count($_SESSION['IMAGENES']);$j>$_POST['ordeni'];$j--){
				
					$_SESSION['IMAGENES'][$j] = $_SESSION['IMAGENES'][$j-1];
					$_SESSION['IMAGENES_T'][$j] = $_SESSION['IMAGENES_T'][$j-1];
					
				
				
				}*/
				
				borrar_imagenes2($_SESSION['IMAGENES'][$_POST['ordeni']]);
				
				$_SESSION['IMAGENES'][$_POST['ordeni']]   = $prefi;
				$_SESSION['IMAGENES_T'][$_POST['ordeni']] = $_POST['tituloi'];
			
			}else{
			
				$I = count($_SESSION['IMAGENES']);
				$_SESSION['IMAGENES'][$I] = $prefi;
				$_SESSION['IMAGENES_T'][$I] = $_POST['tituloi'];
			
			}
			/////////////////
		
	
	}else if(isset($_REQUEST['borrar'])){
			
				$imag = $_SESSION['IMAGENES'][$_REQUEST['borrar']];
				$titu = $_SESSION['IMAGENES_T'][$_REQUEST['borrar']];
								
				for($i=$_REQUEST['borrar'];$i<count($_SESSION['IMAGENES']);$i++){
			
			
					$_SESSION['IMAGENES'][$i]   = $_SESSION['IMAGENES'][$i+1];
					$_SESSION['IMAGENES_T'][$i] = $_SESSION['IMAGENES_T'][$i+1];
						
			
				}
			
				array_pop ($_SESSION['IMAGENES']);
				array_pop ($_SESSION['IMAGENES_T']);
				borrar_imagenes2($imag);
			
			
	}else if (isset($_REQUEST['orden'])){
			
				if($_REQUEST['sent']=="u" && $_SESSION['IMAGENES'][$_REQUEST['orden']-1]!=''){
					
						$temp = $_SESSION['IMAGENES'][$_REQUEST['orden']-1];
						$_SESSION['IMAGENES'][$_REQUEST['orden']-1] = $_SESSION['IMAGENES'][$_REQUEST['orden']];
						$_SESSION['IMAGENES'][$_REQUEST['orden']] = $temp;
						
						$temp2 = $_SESSION['IMAGENES_T'][$_REQUEST['orden']-1];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']-1] = $_SESSION['IMAGENES_T'][$_REQUEST['orden']];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']] = $temp2;
			
				}else if($_REQUEST['sent']=="d" && $_SESSION['IMAGENES'][$_REQUEST['orden']+1]!=''){
					
						$temp = $_SESSION['IMAGENES'][$_REQUEST['orden']+1];
						$_SESSION['IMAGENES'][$_REQUEST['orden']+1] = $_SESSION['IMAGENES'][$_REQUEST['orden']];
						$_SESSION['IMAGENES'][$_REQUEST['orden']] = $temp;
						
						$temp2 = $_SESSION['IMAGENES_T'][$_REQUEST['orden']+1];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']+1] = $_SESSION['IMAGENES_T'][$_REQUEST['orden']];
						$_SESSION['IMAGENES_T'][$_REQUEST['orden']] = $temp2;
			
			
				}
			
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<link href="../../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>


<title>imagenes</title>


</head>

<body>
<table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
   <?php for($i=0;$i<count($_SESSION['IMAGENES']);$i++){
   
   		  if($_SESSION['IMAGENES'][$i]==""){
		   
		   $imagen = '../tn-sinimagen.jpg';
		 
		  }else{
		  $imagen = '../../SVcontent/contenido/turn/'.$_SESSION['IMAGENES'][$i];
		  $imagen3 = '../../SVcontent/contenido/orig/'.$_SESSION['IMAGENES'][$i];
		  
		  }
    ?>
   	  <td width="20%" align="center" valign="top">
   		 <a href="<?php echo $imagen3 ?>" target="_blank" title="<?php echo $_SESSION['IMAGENES_T'][$i] ?>"><img src="<?php echo $imagen ?>" width="80" height="80" border="1" class="td-container-azul"></a><br>
     	 <font size="1"><?php echo $_SESSION['IMAGENES_T'][$i] ?><br>
      	<img title="subir de orden" style="cursor:pointer" onClick="location.replace('imagenes.php?orden=<?=$i?>&sent=u');" src="../../admin/icon/icon-left.gif" width="16" height="16" border="0"><img style="cursor:pointer" title="borrar esta imagen" onClick="location.replace('imagenes.php?borrar=<?=$i?>');" src="../../admin/icon/icon-delete.gif" width="16" height="16" border="0"><img title="bajar de orden" style="cursor:pointer" onClick="location.replace('imagenes.php?orden=<?=$i?>&sent=d');" src="../../admin/icon/icon-right.gif" width="16" height="16" border="0"> </font>
      </td>
    <?php } ?> 
  </tr>
</table>
</body>
</html>
