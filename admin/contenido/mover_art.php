<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");



$tool = new tools();
$tool->autoconexion();


    if(isset($_REQUEST['button'])){
	
		
		$valor = explode("_",$_REQUEST['mover']);
		
		$datos[0] = 'cat_nivel';  $valores[0] = $valor[0];
		$datos[1] = 'cat_id';     $valores[1] = $valor[1];
		
		$tool->update("articulo",$datos,$valores,"id = {$_POST['art_id']}");
		$tool->cerrar();
		
		?>
		 <script language="JavaScript" type="text/JavaScript">
	   window.opener.location.reload(); window.close();
	   </script>
		
		<?
	
	}


	$categorias = $tool->estructura_db("select id,nombre,(select count(*) from cont_subcategoria where cat_id = c.id ) as subca,(select count(*) from articulo where cat_nivel = 1 and cat_id = c.id) as art from cont_categoria c order by orden");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Categorías de contenido del web site</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body>
<form name="form1" method="post" action=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Mover Art&iacute;culo a Otra Categor&iacute;a</td>
 </tr>
 
 <tr>
  <td>
  
  <?php for($i=0;$i<count($categorias);$i++){ ?>
  <input name="art_id" type="hidden" id="art_id" value="<?=$_REQUEST['id'] ?>">
<!--bloque de categoría 1-->
<div class="cont-div-cat1-container">
<div class="cont-div-cat1">
<?php if($categorias[$i]['art']>0 || $categorias[$i]['subca']==0  ){ ?><input name="mover" type="radio" value="<?php echo '1_'.$categorias[$i]['id']  ?>" <?php if($_REQUEST['nivel']==1 && $_REQUEST['cat']==$categorias[$i]['id']) echo 'checked'; ?>> <?php }  ?>  
<?php echo $categorias[$i]['nombre']; ?> </div>


 <?php 
 
 		$subcatego = $tool->estructura_db("select id,nombre,(select count(*) from cont_sub_subcategoria where sub_id = c.id ) as subca,(select count(*) from articulo where cat_nivel = 2 and cat_id = c.id) as art from cont_subcategoria c where cat_id = {$categorias[$i]['id']} order by orden");
		
 		for($j=0;$j<count($subcatego);$j++){ 

 ?>
 
<div class="cont-div-cat2">
<?php if($subcatego[$j]['art']>0 || $subcatego[$j]['subca']==0){ ?><input type="radio" name="mover" <?php if($_REQUEST['nivel']==2 && $_REQUEST['cat']==$subcatego[$j]['id']) echo 'checked'; ?> value="<?php echo '2_'. $subcatego[$j]['id']  ?>"> <?php }  ?> 
<?php echo $subcatego[$j]['nombre']; ?> </div>


  <?php 
 
 		$ssubcatego = $tool->estructura_db("select id,nombre from cont_sub_subcategoria c where sub_id = {$subcatego[$j]['id']} order by orden");
		
 		for($z=0;$z<count($ssubcatego);$z++){ 

 ?>

<div class="cont-div-cat3">
<input type="radio" name="mover" <?php if($_REQUEST['nivel']==3 && $_REQUEST['cat']==$ssubcatego[$z]['id']) echo 'checked'; ?>  value="<?php echo '3_'. $ssubcatego[$z]['id']  ?>"> 
<?php echo $ssubcatego[$z]['nombre']; ?> </div>


 
  <?php 
  
 // unset($ssubcatego);
  }
  	
	
	//	unset($subcatego);
		} ///subcatego
	  
  
  
  ?>

</div>
  <?php } ///categorias ?>   </td>
 </tr>
 <tr>
  <td align="center"><input name="button" type="submit" class="form-button" id="button" value="OK">&nbsp; 
 
  
  &nbsp; 
  <input name="Submit2" type="button" class="form-button" onClick="window.close();" value="Cancelar"></td>
 </tr>
</table>
</form>
</body>
</html>
<?php 

$tool->cerrar();

?>
