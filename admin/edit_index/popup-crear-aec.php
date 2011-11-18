<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");

	$tool = new formulario();
	$tool->autoconexion();
	
	
	if(isset($_REQUEST['fuente'])) $pref = $_REQUEST['fuente']; else $pref = "cont";
	
	
	if(isset($_POST['Submit'])){
	
		$_POST['r-titulo'] = trim($_POST['titulo']);
		$_POST['r-orden']  = $tool->simple_db("select count(*) from artxcat");
		$_POST['r-catego'] = trim($_POST['catego']);
		
			$tool->insert_data("r","-","artxcat",$_POST);
			
					
		   ?>
             <script language="javascript">
    
					window.opener.location.reload();
					window.close();
					
			</script>
            
            <?
			
			die();
	
	}
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

<script type="text/javascript">
function asignar (){


}
</script>


<title>Agregar / editar bloques de listados de art&iacute;culos en categor&iacute;a</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="td-titulo-popup"> Agregar  bloques de listados de art&iacute;culos en categor&iacute;a</td>
</tr>
<tr>
<td class="textohelp">Elija la categor&iacute;a de donde quiere sacar el listado de art&iacute;culos que se muestran en este bloque. Tambi&eacute;n puede elegir si los art&iacute;culos muestran su resumen o no (el resumen es uno de los campos del detalle del art&iacute;culo, si usted no lo escribe, el listado no lo mostrar&aacute;). Tambi&eacute;n puede elegir la cantidad de art&iacute;culos que este bloque ha de mostrar.</td>
</tr>
<tr>
<td>

<form name="form1" method="post" action="">


<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr>
<td width="34%" class="td-form-title">T&iacute;tulo del Bloque</td>
<td width="66%"><input name="titulo" type="text" class="form-box" id="titulo" value="<?=$_REQUEST['titulo'] ?>" size="60"></td>
</tr>
<tr>
  <td class="td-form-title">Extraer de    </td>
  <td>
    <select name="r-fuente" class="form-box" id="select" onChange="location.replace('<?=$PHP_SELF ?>?fuente='+this.value+'&titulo='+document.form1.titulo.value);">
      <option value="cont" <?php if($pref=="cont") echo 'selected'; ?>>Articulos</option>
      <option value="prod" <?php if($pref=="prod") echo 'selected'; ?>>Productos</option>
    </select>
 </td>
</tr>
<tr>
<td class="td-form-title">Categor&iacute;a de donde salen los art&iacute;culos<br></td>
<td>

<select name="r-cat" class="form-box" onChange="document.form1.catego.value = this.options[this.selectedIndex].text;">
 <option value="" selected>Elija dónde buscar
 
 <?php $cats = $tool->estructura_db("select id,nombre,(select count(*) from ".$pref."_subcategoria where cat_id = c.id ) as subca from ".$pref."_categoria c order by orden");	
 
	 for($c1=0;$c1<count($cats);$c1++){
	 
	 ?>
	 <option value="1_<?php echo $cats[$c1]['id']?>" <?php if($_REQUEST['categoria']=="1_{$cats[$c1]['id']}") echo 'selected'?>><?php echo $cats[$c1]['nombre']?> </option>
     
     <?php if($cats[$c1]['subca']>0){ 
	 
	 $subcats = $tool->estructura_db("select id,nombre,
				(select count(*) from ".$pref."_sub_subcategoria where sub_id = s.id ) as subca 
				from ".$pref."_subcategoria s where cat_id = {$cats[$c1]['id']} order by orden");
	 
	 
	  for($c2=0;$c2<count($subcats);$c2++){
	 ?>
	 <option value="2_<?php echo $subcats[$c2]['id']?>" <?php if($_REQUEST['categoria']=="2_{$subcats[$c2]['id']}") echo 'selected'?>>&nbsp;&nbsp;<?php echo $subcats[$c2]['nombre']?>  </option>
     <?php
	 
	 	  if($subcats[$c2]['subca']>0){ 
		  
		   $subsub = $tool->estructura_db("select id,nombre
				from ".$pref."_sub_subcategoria s where sub_id = {$subcats[$c2]['id']} order by orden");
				
			 for($c3=0;$c3<count($subsub);$c3++){
			 ?>
              <option value="3_<?php echo $subsub[$c3]['id']?>" <?php if($_REQUEST['categoria']=="3_{$subsub[$c3]['id']}") echo 'selected'?>>&nbsp;&nbsp;&nbsp;<?php echo $subsub[$c3]['nombre'] ?></option>
             <?
			 
			 }
			
			}	
	 
	 
	  } ?>
     
	
	<?php
	
		}
	 }?>
    </select></td>
</tr>
<tr>
<td class="td-form-title">Cantidad de art&iacute;culos a listar</td>
<td><input name="r-cantidad" type="text" class="form-box" size="5" id="r-cantidad"></td>
</tr>
<tr>
<td class="td-form-title">&iquest;Mostrar resumen?</td>
<td><select name="r-resumen" class="form-box" id="r-resumen">
  <option value="1" selected>Si 
  <option value="0">No 
  </select>
  <input name="catego" type="hidden" id="catego" value="ninguno"></td>
</tr>
<tr>
  <td class="td-form-title">Orden de articulos</td>
  <td><select name="r-ordeni" class="form-box" id="r-ordeni">
    <option value="asc" selected>Ascendente
    <option value="desc">Descendente
    </select></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right"><input name="Submit" type="submit" class="form-button" value="OK">
&nbsp;

<input name="Submit2" type="button" class="form-button" value="Cancelar" onClick="window.close();"></td>
</tr>
</table>
</form>


</td>
</tr>
</table>
</body>
</html>
