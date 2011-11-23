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
	
	
	$cat1 = $tool->array_query("select distinct categoria1 from cliente order by categoria1");
	$cat2 = $tool->array_query("select distinct categoria2 from cliente order by categoria2");
	$cat3 = $tool->array_query("select distinct categoria3 from cliente order by categoria3");
	
	$tool->query("select * from cliente a  order by nombre ");
	


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





<div id="ntitulo">Tablero de edici&oacute;n r&aacute;pida de Usuarios</div>
<div id="ninstrucciones">
<p>Aqui usted podr&aacute; editar todos los campos de todos los usuarios de manera r&aacute;pida  y c&oacute;moda. Adem&aacute;s de los cambios particulares que puede realizar en cada uno, puede seleccionar (en el checkbox de la extrema derecha) los usuarios a los que desee aplicar las acciones masivas ubicadas al final
        de la p&aacute;gina. Usted puede  borrar varios &iacute;tems en un solo movimiento. <strong>Proceda
        con cautela.</strong></p>
</div>


<div id="ncontenido">

<form name="form1" method="post" action="">
<input name="opcion" type="hidden" id="opcion" value="1">
<table width="3900" border="0" cellspacing="3" cellpadding="0">
<!--CABECERA DE LA TABLA DE ARTICULOS-->
 <tr>

<td width="3%" class="td-headertabla">Origen</td>
<td width="9%" class="td-headertabla">Categoria 1</td>
<td width="13%" class="td-headertabla">Categoria 2</td>
<td width="9%" class="td-headertabla">Categoria 3</td>
<td width="3%" class="td-headertabla">Rif</td>
<td width="3%" class="td-headertabla">Nombre</td>
<td width="3%" class="td-headertabla">Password</td>
<td width="3%" class="td-headertabla">Email</td>
<td width="3%" class="td-headertabla">Email2</td>
<td width="3%" class="td-headertabla">Web</td>
<td width="3%" class="td-headertabla">Empresa</td>
<td width="3%" class="td-headertabla">Actividad</td>
<td width="3%" class="td-headertabla">Cargo</td>
<td width="3%" class="td-headertabla">TLF1</td>
<td width="3%" class="td-headertabla">TLF2</td>
<td width="3%" class="td-headertabla">Celular</td>
<td width="3%" class="td-headertabla">Fax</td>
<td width="5%" class="td-headertabla">Direcci&oacute;n</td>
<td width="3%" class="td-headertabla">Zip</td>
<td width="3%" class="td-headertabla">Ciudad</td>
<td width="3%" class="td-headertabla">Estado</td>
<td width="3%" class="td-headertabla">pais</td>
<td width="4%" class="td-headertabla">Noticias Titulo</td>
<td width="4%" class="td-headertabla">Noticias Texto</td>
 <td width="1%" class="td-headertabla"><img src="../icon/icon-ojo-pelao.gif" width="16" height="16" title="¿Activo o inactivo?"></td>
  <td width="1%" class="td-headertabla"><img src="../icon/botonsito-confirmar-pago-done.jpg" width="15" height="15" title="Seleccionar"></td>
 </tr>
<!--FIN CABECERA DE LA TABLA DE ARTICULOS-->

<!--loop de artículos--> 
<?php while ($row = mysql_fetch_assoc($tool->result)) { ?>

<tr>
  
  <td class="fastedit-data-td">
  <div class="fastedit-categorias"><?php echo $row['categoria']  ?>
    <input name="ids[]" type="hidden" id="ids[]" value="<?=$row['id'] ?>">
  </div>
  <input name="origen[]" type="text" class="form-box" id="origen[]" value="<?=$row['origen'] ?>" size="20"></td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria1[]",$cat1,$cat1,false,$row['categoria1']); ?>&nbsp;</td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria2[]",$cat2,$cat2,false,$row['categoria2']); ?></td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria3[]",$cat3,$cat3,false,$row['categoria3']); ?></td>
  <td class="fastedit-data-td"><input name="rif[]" type="text" class="form-box" id="rif[]" value="<?=$row['rif'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="nombre[]" type="text" class="form-box" id="nombre[]" value="<?=$row['nombre'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="password[]" type="text" class="form-box" id="password[]" value="<?=$row['password'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="email[]" type="text" class="form-box" id="email[]" value="<?=$row['email'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="email2[]" type="text" class="form-box" id="email2[]" value="<?=$row['email2'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="web[]" type="text" class="form-box" id="web[]" value="<?=$row['web'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="empresa[]" type="text" class="form-box" id="empresa[]" value="<?=$row['empresa'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="actividad[]" type="text" class="form-box" id="actividad[]" value="<?=$row['actividad'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="cargo[]" type="text" class="form-box" id="cargo[]" value="<?=$row['cargo'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="tlf1[]" type="text" class="form-box" id="tlf1[]" value="<?=$row['tlf1'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="tlf2[]" type="text" class="form-box" id="tlf2[]" value="<?=$row['tlf2'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="celular[]" type="text" class="form-box" id="celular[]" value="<?=$row['celular'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="fax[]" type="text" class="form-box" id="fax[]" value="<?=$row['fax'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="direccion[]" type="text" class="form-box" id="direccion[]" value="<?=$row['direccion'] ?>" size="30" /></td>
  <td class="fastedit-data-td"><input name="zip[]" type="text" class="form-box" id="zip[]" value="<?=$row['zip'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="ciudad[]" type="text" class="form-box" id="ciudad[]" value="<?=$row['ciudad'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="estado[]" type="text" class="form-box" id="estado[]" value="<?=$row['estado'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><input name="pais[]" type="text" class="form-box" id="pais[]" value="<?=$row['pais'] ?>" size="20" /></td>
  <td class="fastedit-data-td"><textarea name="noticias_titulo[]" cols="25" class="form-box" id="noticias_titulo[]"><?=$row['noticias_titulo'] ?>
  </textarea></td>
  <td class="fastedit-data-td"><textarea name="noticias_texto[]" cols="25" class="form-box" id="noticias_texto[]"><?=$row['noticias_texto'] ?>
  </textarea></td>
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