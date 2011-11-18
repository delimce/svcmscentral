<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");



$tool = new tools();
$tool->autoconexion();


    if(isset($_REQUEST['button'])){
	
		
		$_SESSION['MOVER'] = explode("_",$_REQUEST['mover']);
		
		?>
	   <script language="JavaScript" type="text/JavaScript">
	   window.opener.document.form1.opcion.value='4'; 
	   window.opener.document.form1.submit();	 
	   window.close();
	   </script>
		
		<?
	
	}


	$categorias = $tool->estructura_db("select id,nombre,(select count(*) from prod_subcategoria where cat_id = c.id ) as subca,(select count(*) from producto where cat_nivel = 1 and cat_id = c.id) as prod from prod_categoria c order by orden");


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Mover a otra categoria</title>
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

<body>
<form name="form1" method="post" action="">


<?php for($i=0;$i<count($categorias);$i++){ ?>

<input name="prod_id" type="hidden" id="prod_id" value="<?=$_REQUEST['id'] ?>">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td width="3%" class="cat-td-arbol-icons-categoria1"><?php if($categorias[$i]['prod']>0 || $categorias[$i]['subca']==0  ){ ?><input name="mover" type="radio" value="<?php echo '1_'.$categorias[$i]['id']  ?>"> <?php }  ?>    </td>
    <td width="97%" class="cat-td-arbol-categoria1"><?php echo $categorias[$i]['nombre']; ?></td>
  </tr>
 
 
 <?php 
 
 		$subcatego = $tool->estructura_db("select id,nombre,(select count(*) from prod_sub_subcategoria where sub_id = c.id ) as subca,(select count(*) from producto where cat_nivel = 2 and cat_id = c.id) as prod from prod_subcategoria c where cat_id = {$categorias[$i]['id']} order by orden");

 		for($j=0;$j<count($subcatego);$j++){ 

 ?>
 
 
  <tr>
    <td align="center" class="cat-td-arbol-icons-categoria2"><?php if($subcatego[$j]['prod']>0 || $subcatego[$j]['subca']==0){ ?><input type="radio" name="mover" value="<?php echo '2_'. $subcatego[$j]['id']  ?>"> <?php }  ?>    </td>
    <td class="cat-td-arbol-categoria2"><?php echo $subcatego[$j]['nombre']; ?></td>
  </tr>
  
  
  <?php 
 
 		$ssubcatego = $tool->estructura_db("select id,nombre from prod_sub_subcategoria c where sub_id = {$subcatego[$j]['id']} order by orden");

 		for($z=0;$z<count($ssubcatego);$z++){ 

 ?>
  
  
  <tr>
    <td align="center" class="cat-td-arbol-icons-categoria3"><input type="radio" name="mover" value="<?php echo '3_'. $ssubcatego[$z]['id']  ?>">  </td>
    <td class="cat-td-arbol-categoria3"><?php echo $ssubcatego[$z]['nombre']; ?></td>
  </tr>
  
  
  
  
  
  <?php 
  
  //unset($ssubcatego);
  }
  	
	
		//unset($subcatego);
		} ///subcatego
	  
  
  
  ?>
  
  <?php } ///categorias ?>
  
    <tr>
    <td colspan="2" align="center"><input name="button" type="submit" class="form-button" id="button" value="Submit">
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