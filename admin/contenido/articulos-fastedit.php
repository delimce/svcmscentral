<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

	
	if(isset($_REQUEST['ids'])){
	
			if($_REQUEST['opcion']==1){
			
					$ids 	 = $_REQUEST['ids'];
					$nombre  = $_REQUEST['nombre'];
					$resumen  = $_REQUEST['resumen'];
					$autor  = $_REQUEST['autor'];
					$activos = $_REQUEST['activos'];
					
					$campos = $tool->llenar_array("titulo¥resumen¥autor¥estatus",'¥');
					
						for($i=0;$i<count($ids);$i++){ ////modifica todos los registros
									
								$vector = $tool->llenar_array("$nombre[$i]¥$resumen[$i]¥$autor[$i]¥0",'¥');
								$tool->update('articulo',$campos,$vector,"id = '$ids[$i]' ");
								unset($vector);
									
						}
					
					
						if(!empty($activos[0])){ 
						
								$iid = implode(',',$activos);
								$tool->query("update articulo set estatus = 1 where id in ($iid) ");
								
						}		
					
			}else if($_REQUEST['opcion']==2){
				
					
			
				   $borrados = $_REQUEST['borrados'];
				   
					
				   if(!empty($borrados[0])){ 
				   
				   			include("../../SVsystem/class/funciones.php");
							$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL	
							
							$iid = implode(',',$borrados);
							
							
							//////////////////borrar todos los archivos del producto

								$queryA = "(select ruta,tipo from cont_adjunto where art_id in ($iid) and tipo != 'link')
											union( select imagen,'imagen' as tipo from articulo where id in ($iid) ) ";
										
								$archivos = $tool->estructura_db($queryA);
								
								//borrando datos
								for($i=0;$i<count($archivos);$i++){
								
									borrar_datac($archivos[$i]['ruta'],$archivos[$i]['tipo']);
								}
										
							////////////////////////////////////////////////////////
							
							
							$tool->query("delete from articulo where id in ($iid) ");
							
					}	
			
			
			} else if($_REQUEST['opcion']==3) {
			
					
				 if($_SESSION['MOVER'][0]>0){
				 
					$activos = $_REQUEST['borrados'];
					$valores1 = $_SESSION['MOVER'][0];
					$valores2 = $_SESSION['MOVER'][1];
					
					$iid = implode(',',$activos);
					$tool->query("update articulo set cat_nivel = '$valores1', cat_id = '$valores2'  where id in ($iid) ");
				  }
					unset($_SESSION['MOVER']);
				
				
			
			}else{
			
				
						$activos = $_REQUEST['borrados'];
						$valor = $_SESSION['MOVER'];
						
						
										
					for($w=0;$w<count($activos);$w++){
						
						$valores = $tool->array_query2("SELECT a.autor, a.tipo_autor, a.titulo, a.fecha, a.resumen,
												a.texto, a.imagen, a.extra,  a.estatus, a.revisado 
												FROM articulo a where id = '{$activos[$w]}' ");
																	
						$elementos = $tool->estructura_db("select * from cont_adjunto where art_id = '{$activos[$w]}' order by id");						
													
						$valores[10] = $valor[0];
						$valores[11] = $valor[1];
						$valores[12] = $tool->simple_db("select max(orden)+1 as total from articulo where cat_nivel = $valor[0] and cat_id = $valor[1] ");
						
						$campos = "autor,tipo_autor,titulo,fecha,resumen,texto,imagen,extra,estatus,revisado,cat_nivel,cat_id,orden";
							
						$tool->insertar2("articulo",$campos,$valores);
						$NUEVO_ID = $tool->ultimoID;
						
						
						
						for($i=0;$i<count($elementos);$i++){
						
							$valores3[0] = $NUEVO_ID;
							$valores3[1] = $elementos[$i]['tipo'];
							$valores3[2] = $elementos[$i]['ruta'];
							$valores3[3] = $elementos[$i]['titulo'];
							
							
							$tool->insertar2("cont_adjunto","art_id,tipo,ruta,titulo",$valores3);
						
						}
						
						
						
						}
						
						
						unset($_SESSION['MOVER']);
		
			
			}	
			
	
	}
	
	
	///////////categoria de articulos 
$catea = " (CASE cat_nivel WHEN 1 THEN 
  (SELECT DISTINCT 
  cont_categoria.nombre
FROM
  articulo
  INNER JOIN cont_categoria ON (articulo.cat_id = cont_categoria.id)
WHERE
  articulo.id = a.id) 
   WHEN 2 THEN 
 
(SELECT DISTINCT 
  concat(c.nombre,' > ',s.nombre)
FROM
  articulo p
  INNER JOIN cont_subcategoria s ON (p.cat_id = s.id)
  INNER JOIN cont_categoria c ON (s.cat_id = c.id)
WHERE
  p.id = a.id)  
   
    ELSE 
	
 (SELECT DISTINCT 
  concat(c.nombre, ' > ', s.nombre,' > ', ss.nombre)
FROM
   cont_sub_subcategoria ss
  INNER JOIN cont_subcategoria s ON (ss.sub_id = s.id)
  INNER JOIN cont_categoria c ON (s.cat_id = c.id)
  INNER JOIN articulo p ON (ss.id = p.cat_id)
WHERE
  p.id = a.id)   
    
     END) as categoria";
	
	$tool->query("select id,titulo,resumen,autor,estatus,
	
	$catea
	
	 from articulo a order by cat_nivel,cat_id,orden ");


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Edici&oacute;n r&aacute;pida de art&iacute;culos</title>
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





<div id="ntitulo">Tablero de edici&oacute;n r&aacute;pida de art&iacute;culos</div>
<div id="ninstrucciones">
<p>Aqui usted podr&aacute; editar algunos atributos de todos sus art&iacute;culos de manera r&aacute;pida  y c&oacute;moda. Adem&aacute;s de los cambios particulares que puede realizar en cada uno, puede seleccionar (en el checkbox de la extrema derecha) los art&iacute;culos a los que desee aplicar las acciones masivas ubicadas al final
        de la p&aacute;gina. Usted puede mover, copiar y borrar varios &iacute;tems en un solo movimiento. <strong>Proceda
        con cautela.</strong></p>
</div>


<div id="ncontenido">

<form name="form1" method="post" action="">
<input name="opcion" type="hidden" id="opcion" value="1">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
<!--CABECERA DE LA TABLA DE ARTICULOS-->
 <tr>

<td width="37%" class="td-headertabla">Nombre del Art&iacute;culo</td>
 <td width="37%" class="td-headertabla">Resumen</td>
  <td width="12%" class="td-headertabla">Etiqueta</td>
  <td width="7%" class="td-headertabla"><img src="../icon/icon-ojo-pelao.gif" width="16" height="16" title="¿Activo o inactivo?"></td>
  <td width="7%" class="td-headertabla"><img src="../icon/botonsito-confirmar-pago-done.jpg" width="15" height="15" title="Seleccionar"></td>
 </tr>
<!--FIN CABECERA DE LA TABLA DE ARTICULOS-->

<!--loop de artículos--> 
<?php while ($row = mysql_fetch_assoc($tool->result)) { ?>

<tr>
  
  <td class="fastedit-data-td">
<div class="fastedit-categorias"><?php echo $row['categoria']  ?>
  <input name="ids[]" type="hidden" id="ids[]" value="<?=$row['id'] ?>">
</div>
<input name="nombre[]" type="text" class="form-box" id="nombre[]" value="<?=$row['titulo'] ?>" size="60"></td>
<td  class="fastedit-data-td"><input name="resumen[]" type="text" class="form-box" id="resumen[]" value="<?=$row['resumen'] ?>" size="60"></td>
<td   class="fastedit-data-td"><input name="autor[]" type="text" class="form-box" id="autor[]" value="<?=$row['autor'] ?>" size="15"></td>

  <td  class="fastedit-data-td"><input name="activos[]" type="checkbox" id="activos[]" value="<?=$row['id'] ?>" <?php if($row['estatus']==1) echo 'checked'; ?>></td>
  <td class="fastedit-data-td"><input name="borrados[]" type="checkbox" id="borrados[]" value="<?=$row['id'] ?>"></td>
</tr>
<!--fin loop de articulos--> 
<?php } ?>
</table>




<!--FIN LISTADO DE ARTÍCULOS-->
</form>


<center>
<input type="button" onClick="document.form1.opcion.value='2'; document.form1.submit();" class="form-button" name="Button" value=" [-] Borrar Seleccionados">  &nbsp;

 <input name="Button" type="button" class="form-button" onClick="popup('mover_art_mass.php', 'nuevo','600','600');" value="[^] Mover Seleccionados a Otra Categoría..."> &nbsp; 

 <input name="Button2" type="button" class="form-button" onClick="popup('copiar_art_mass.php', 'nuevo','600','600');" value=" [cc] Copiar Seleccionados a Otra Categoría...">&nbsp; 

<input type="button" onClick="document.form1.opcion.value='1'; document.form1.submit();" class="form-button" name="Button" value="[ok] Aplicar"> &nbsp;

<input name="Reset" type="reset" class="form-button" onClick="MM_goToURL('parent','arbol.php');return document.MM_returnValue" value="[<]  Volver">

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