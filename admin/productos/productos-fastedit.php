<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");


include("security.php");


$tool = new tools('db');

	
	if(isset($_REQUEST['ids'])){
	
			if($_REQUEST['opcion']==1){
			
					$ids 	 = $_REQUEST['ids'];
					$nombre  = $_REQUEST['nombre'];
					$codigo  = $_REQUEST['codigo'];
					$precio  = $_REQUEST['precio'];
					$activos = $_REQUEST['activos'];
					$destaca = $_REQUEST['dest'];
					$stock   = $_REQUEST['stock'];
					
					$tool->abrir_transaccion();
					
					$campos = $tool->llenar_array("nombre¥codigo¥precio¥activo¥stock",'¥');
					
					for($i=0;$i<count($ids);$i++){ ////modifica todos los registros
								
							$vector = $tool->llenar_array("$nombre[$i]¥$codigo[$i]¥$precio[$i]¥0¥$stock[$i]",'¥');
							$tool->update('producto',$campos,$vector,"id = '$ids[$i]' ");
							unset($vector);
								
					}
					
					///activos
					if(!empty($activos[0])){ 
							
							$iid = implode(',',$activos);
							$tool->query("update producto  set activo = 1 where id in ($iid) ");
							
					}
					
					
					////destacados
					if(!empty($destaca[0])){ 
							
							$iid2 = implode(',',$destaca);
							$tool->query("update producto  set destacado = 0 ");
							$tool->query("update producto  set destacado = 1 where id in ($iid2) ");
							
					}
					
					
					$tool->cerrar_transaccion();
							
					
			}else if($_REQUEST['opcion']==2){
			
				   $borrados = $_REQUEST['borrados'];
				   
					
				   if(!empty($borrados[0])){ ////para borrar
				   
				   include("../../SVsystem/class/funciones.php");
				   
				   			$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL								
							$iid = implode(',',$borrados);
							
							///////////////borrando elementos
							
							$queryA = "(select 
											doc_file as ele,
											'file' as tipo
											from `producto` where id in ($iid) )
											UNION(
											select
											ruta as ele,
											'image' as tipo
											from `imagen_producto` where prod_id in ($iid) )
											order by tipo";
											
							$archivos = $tool->estructura_db($queryA);
							
							
							//borrando datos
							for($i=0;$i<count($archivos);$i++){
							
								borrar_datap($archivos[$i]['ele'],$archivos[$i]['tipo']);
								
							}
													
							//////////////////////////////
							
							
							$tool->query("delete from producto where id in ($iid) ");
							
					}	
			
			
			} else if($_REQUEST['opcion']==3) {
			
			
			 if($_SESSION['MOVER'][0]>0){
				 
					$activos = $_REQUEST['borrados'];
					$valores1 = $_SESSION['MOVER'][0];
					$valores2 = $_SESSION['MOVER'][1];
					
					$iid = implode(',',$activos);
					$tool->query("update producto set cat_nivel = '$valores1', cat_id = '$valores2'  where id in ($iid) ");
				  }
					unset($_SESSION['MOVER']);
			
			
			}else{
			
			
			
			
				
						$activos = $_REQUEST['borrados'];
						$valor = $_SESSION['MOVER'];
						
						
										
					for($w=0;$w<count($activos);$w++){
						
						$valores = $tool->array_query2("SELECT a.codigo, a.nombre, a.precio, a.resumen, a.descripcion,
												a.activo, a.destacado, a.empaque,  a.medidas, a.peso, a.url, a.doc_label, a.doc_file,
												a.stock, a.fecha_publi_inicio, a.fecha_publi_fin 
												
												FROM producto a where id = '{$activos[$w]}' ");
																	
						$elementos = $tool->estructura_db("select * from imagen_producto where prod_id = '{$activos[$w]}' order by id");
						$varia = $tool->estructura_db("select * from prod_varia where prod_id = '{$activos[$w]}' order by id");						
													
						$valores[16] = $valor[0];
						$valores[17] = $valor[1];
						$valores[18] = $tool->simple_db("select max(orden)+1 as total from producto where cat_nivel = $valor[0] and cat_id = $valor[1] ");
						
						$campos = "codigo,nombre,precio,resumen,descripcion,activo,destacado,empaque,medidas,peso,url,doc_label,doc_file,stock,fecha_publi_inicio,fecha_publi_fin,cat_nivel,cat_id,orden";
							
						$tool->insertar2("producto",$campos,$valores);
						$NUEVO_ID = $tool->ultimoID;
						
						
						
						for($i=0;$i<count($elementos);$i++){
						
							$valores3[0] = $NUEVO_ID;
							$valores3[1] = $elementos[$i]['ruta'];
							$tool->insertar2("imagen_producto","prod_id,ruta",$valores3);
						
						}
						
						
						for($i=0;$i<count($varia);$i++){
						
							$valores3[0] = $NUEVO_ID;
							$valores3[1] = $elementos[$i]['variacion'];
							$tool->insertar2("prod_varia","prod_id,variacion",$valores3);
						
						}
						
						
						
						}
						
						
						unset($_SESSION['MOVER']);
		
			
			
			
			
			}		
			
	
	}
	
	///consulta de categorias de productos
		$catep = " (CASE cat_nivel WHEN 1 THEN 
		  (SELECT DISTINCT 
		  prod_categoria.nombre
		FROM
		  producto
		  INNER JOIN prod_categoria ON (producto.cat_id = prod_categoria.id)
		WHERE
		  producto.id = a.id) 
		   WHEN 2 THEN 
		 
		(SELECT DISTINCT 
		  concat(c.nombre,' : ',s.nombre)
		FROM
		  producto p
		  INNER JOIN prod_subcategoria s ON (p.cat_id = s.id)
		  INNER JOIN prod_categoria c ON (s.cat_id = c.id)
		WHERE
		  p.id = a.id)  
		   
			ELSE 
			
		 (SELECT DISTINCT 
		  concat(c.nombre, ' : ', s.nombre,' : ', ss.nombre)
		FROM
		  prod_sub_subcategoria ss
		  INNER JOIN prod_subcategoria s ON (ss.sub_id = s.id)
		  INNER JOIN prod_categoria c ON (s.cat_id = c.id)
		  INNER JOIN producto p ON (ss.id = p.cat_id)
		WHERE
		  p.id = a.id)   
			
			 END) as categoria";
	
	$tool->query("select id,nombre,codigo,precio,activo,stock,destacado,
	
	$catep
	
	 from producto a order by cat_nivel,cat_id,orden ");


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Edición rápida de productos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../../SVsystem/js/utils.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>





</head>

<body>

<?php include ("../n-encabezado.php")?>
<div id="ncuerpo" style="width:100%;">

<div id="ncontenedor" style="width:99%; margin:0 auto 0 auto;">





<div id="ntitulo">Tablero de edici&oacute;n r&aacute;pida de productos</div>
<div id="ninstrucciones">
<p>Aqui usted podr&aacute; editar algunos atributos de todos sus productos de manera r&aacute;pida  y c&oacute;moda. Adem&aacute;s de los cambios particulares que puede realizar en cada producto, puede seleccionar (en el checkbox de la extrema derecha) los productos a los que desee aplicar las acciones masivas ubicadas al final de  la p&aacute;gina.  Usted puede mover, copiar y borrar varios productos en un solo movimiento. <strong>Proceda con cautela.</strong></p>
</div>


<div id="ncontenido">

<form name="form1" method="post" action="">
<input name="opcion" type="hidden" id="opcion" value="1">

<table width="100%" border="0" cellspacing="1" cellpadding="0">
<!--CABECERA DE LA TABLA DE PRODUCTOS-->
 <tr>
  <td width="9%" class="td-headertabla"> Stock</td>
  <td width="48%" class="td-headertabla">Nombre del Producto</td>
  <td width="17%" class="td-headertabla">C&oacute;digo</td>
  <td width="15%" class="td-headertabla">Precio</td>
  <td width="3%" class="td-headertabla"><img src="../icon/icon-ojo-pelao.gif" width="16" height="16" title="¿Activo o inactivo?"></td>
  <td width="4%" class="td-headertabla">des</td>
  <td width="4%" class="td-headertabla"><img src="../icon/botonsito-confirmar-pago-done.jpg" width="15" height="15" title="Seleccionar"></td>
 </tr>
<!--FIN CABECERA DE LA TABLA DE PRODUCTOS-->

<!--loop de productos--> 
<?php while ($row = mysql_fetch_assoc($tool->result)) { ?>

<tr>
  <td class="fastedit-data-td"><input name="stock[]" type="text" class="form-box" id="stock[]" value="<?=$row['stock'] ?>" size="5">
    <input name="ids[]" type="hidden" id="ids[]" value="<?=$row['id'] ?>"></td>
  <td class="fastedit-data-td">
<div class="fastedit-categorias"><?php echo $row['categoria']  ?></div>
<input name="nombre[]" type="text" class="form-box" id="nombre[]" value="<?=$row['nombre'] ?>" size="75"></td>
<td  class="fastedit-data-td"><input name="codigo[]" type="text" class="form-box" id="codigo[]" value="<?=$row['codigo'] ?>" size="15"></td>
  <td  class="fastedit-data-td"><input name="precio[]" type="text" class="form-box" id="precio[]" value="<?=$row['precio'] ?>" size="10"></td>
  <td align="center"  class="fastedit-data-td"><input name="activos[]" type="checkbox" id="activos[]" value="<?=$row['id'] ?>" <?php if($row['activo']==1) echo 'checked'; ?>></td>
  <td align="center"  class="fastedit-data-td"><input name="dest[]" type="checkbox" id="dest[]" value="<?=$row['id'] ?>" <?php if($row['destacado']==1) echo 'checked'; ?>></td>
  <td align="center"  class="fastedit-data-td"><input name="borrados[]" type="checkbox" id="borrados[]" value="<?=$row['id'] ?>"></td>
</tr>
<!--fin loop de productos--> 
<?php } ?>
</table>



<!--FIN LISTADO DE ARTÍCULOS-->
</form>


<center>

<input type="button" onClick="document.form1.opcion.value='2'; document.form1.submit();" class="form-button" name="Button" value="[-] Borrar Seleccionados">
&nbsp; 
<input name="Button2" type="button" class="form-button" onClick="popup('mover_prod_mass.php', 'nuevo','600','600');" value="[^] Mover Seleccionados a Otra Categoría...">
&nbsp; 
<input name="Button3" type="button" class="form-button" onClick="popup('copiar_prod_mass.php', 'nuevo','600','600');" value="[cc] Copiar Seleccionados a Otra Categoría...">
&nbsp; 
<input type="button" onClick="document.form1.opcion.value='1'; document.form1.submit();" class="form-button" name="Button" value="[ok] Aplicar">
&nbsp; 
<input name="Reset" type="reset" class="form-button" onClick="MM_goToURL('parent','productos.php');return document.MM_returnValue" value="[<] Volver ">
</center>





<!-- termina ncontenido -->
</div>
<?php // include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>
</body>
</html>
<?php 

$tool->cerrar();

?>