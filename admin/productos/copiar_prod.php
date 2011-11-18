<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");



$tool = new tools();
$tool->autoconexion();


    if(isset($_REQUEST['button'])){
	
		
		$valor = explode("_",$_REQUEST['mover']);
		
		$valores = $tool->array_query2("SELECT  codigo,nombre,precio,resumen,descripcion,activo,destacado,empaque,medidas,peso,url,doc_label,doc_file,variaciones,stock,meta_google,meta_desc,meta_keywords
												FROM producto a where id = {$_POST['prod_id']} ");
								
		$elementos = $tool->estructura_db("select id,ruta from imagen_producto where prod_id = {$_POST['prod_id']} order by id");						
									
		$valores[18] = $valor[0];
		$valores[19] = $valor[1];
		$valores[20] = $tool->simple_db("select max(orden)+1 as total from producto where cat_nivel = $valor[0] and cat_id = $valor[1] ");
		
		$campos = "codigo,nombre,precio,resumen,descripcion,activo,destacado,empaque,medidas,peso,url,doc_label,doc_file,variaciones,stock,meta_google,meta_desc,meta_keywords,cat_nivel,cat_id,orden";
			
		$tool->insertar2("producto",$campos,$valores);
		$NUEVO_ID = $tool->ultimoID;
		
		
		
		for($i=0;$i<count($elementos);$i++){
		
			$valores3[0] = $NUEVO_ID;
			$valores3[1] = $elementos[$i]['ruta'];
			
			
			$tool->insertar2("imagen_producto","prod_id,ruta",$valores3);
		
		}
		
		$tool->cerrar();
		
		?>
		 <script language="JavaScript" type="text/JavaScript">
	   window.opener.location.reload(); window.close();
	   </script>
		
		<?
	
	}


	$categorias = $tool->estructura_db("select id,nombre,(select count(*) from prod_subcategoria where cat_id = c.id ) as subca,(select count(*) from producto where cat_nivel = 1 and cat_id = c.id) as prod from prod_categoria c order by orden");


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Categorías de productos del web site</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<form name="form1" method="post" action=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Copiar  producto a Otra Categor&iacute;a</td>
 </tr>
 
 <tr>
  <td>
  
  <?php for($i=0;$i<count($categorias);$i++){ ?>
  <input name="prod_id" type="hidden" id="prod_id" value="<?=$_REQUEST['id'] ?>">
<!--bloque de categoría 1-->
<div class="cont-div-cat1-container">
<div class="cont-div-cat1">
<?php if($categorias[$i]['prod']>0 || $categorias[$i]['subca']==0  ){ ?><input name="mover" type="radio" value="<?php echo '1_'.$categorias[$i]['id']  ?>" <?php if($_REQUEST['nivel']==1 && $_REQUEST['cat']==$categorias[$i]['id']) echo 'checked'; ?>> <?php }  ?>  
<?php echo $categorias[$i]['nombre']; ?> </div>


 <?php 
 
 		$subcatego = $tool->estructura_db("select id,nombre,(select count(*) from prod_sub_subcategoria where sub_id = c.id ) as subca,(select count(*) from producto where cat_nivel = 2 and cat_id = c.id) as prod from prod_subcategoria c where cat_id = {$categorias[$i]['id']} order by orden");
		
 		for($j=0;$j<count($subcatego);$j++){ 

 ?>
 
<div class="cont-div-cat2">
<?php if($subcatego[$j]['prod']>0 || $subcatego[$j]['subca']==0){ ?><input type="radio" name="mover" <?php if($_REQUEST['nivel']==2 && $_REQUEST['cat']==$subcatego[$j]['id']) echo 'checked'; ?> value="<?php echo '2_'. $subcatego[$j]['id']  ?>"> <?php }  ?> 
<?php echo $subcatego[$j]['nombre']; ?> </div>


  <?php 
 
 		$ssubcatego = $tool->estructura_db("select id,nombre from prod_sub_subcategoria c where sub_id = {$subcatego[$j]['id']} order by orden");
		
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
  <?php } ///categorias ?> 
  
   </td>
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
