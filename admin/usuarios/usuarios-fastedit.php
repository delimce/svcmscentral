<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

	
	if(isset($_REQUEST['ids'])){
	
			if($_REQUEST['opcion']==1){
			
					$ids 	  	 = $_REQUEST['ids'];
					$origen   	 = $_REQUEST['origen'];
					$categoria1  = $_REQUEST['categoria1'];
					$categoria2  = $_REQUEST['categoria2'];
					$categoria3  = $_REQUEST['categoria3'];
					$categoria4  = $_REQUEST['categoria4'];
					$categoria5  = $_REQUEST['categoria5'];
					$rif         = $_REQUEST['rif'];
					$nombre      = $_REQUEST['nombre'];
					$password      = $_REQUEST['password'];
					$email      = $_REQUEST['email'];
					$email2      = $_REQUEST['email2'];
					$web      = $_REQUEST['web'];
					$empresa      = $_REQUEST['empresa'];
					$actividad      = $_REQUEST['actividad'];
					$cargo      = $_REQUEST['cargo'];
					$tlf1      = $_REQUEST['tlf1'];
					$tlf2      = $_REQUEST['tlf2'];
					$celular      = $_REQUEST['celular'];
					$fax      = $_REQUEST['fax'];
					$direccion      = $_REQUEST['direccion'];
					$zip      = $_REQUEST['zip'];
					$ciudad      = $_REQUEST['ciudad'];
					$estado      = $_REQUEST['estado'];
					$pais      = $_REQUEST['pais'];
					$notas      = $_REQUEST['notas'];
										
					
					$campos = $tool->llenar_array("origen¥categoria1¥categoria2¥categoria3¥categoria4¥categoria5¥rif¥nombre¥password¥email¥email2¥web¥empresa¥actividad¥cargo¥tlf1¥tlf2¥celular¥fax¥direccion¥zip¥ciudad¥estado¥pais¥notas",'¥');
					
						$tool->abrir_transaccion();
						
						for($i=0;$i<count($ids);$i++){ ////modifica todos los registros
									
								$vector = $tool->llenar_array("$origen[$i]¥$categoria1[$i]¥$categoria2[$i]¥$categoria3[$i]¥$categoria4[$i]¥$categoria5[$i]¥$rif[$i]¥$nombre[$i]¥$password[$i]¥$email[$i]¥$email2[$i]¥$web[$i]¥$empresa[$i]¥$actividad[$i]¥$cargo[$i]¥$tlf1[$i]¥$tlf2[$i]¥$celular[$i]¥$fax[i]¥$direccion[$i]¥$zip[$i]¥$ciudad[$i]¥$estado[$i]¥$pais[$i]¥$notas[$i]",'¥');
							
								$tool->update('cliente',$campos,$vector,"id = '$ids[$i]' ");
								unset($vector);
									
						}
						
						$tool->query("update cliente set activo = 0");
						$activos = $_REQUEST['activos'];
						$iid = implode(',',$activos);
						$tool->query("update cliente set activo = 1 where id in ($iid) ");
						
						
						/////////para los campos adicionales
						
						$tool->query("delete from campo_user");
						
												
						$tcampos = $tool->array_query("select id from campo where modulo = 'user' order by id");
						
						
						for($w1=0;$w1<count($ids);$w1++){
							
							for($wi=0;$wi<count($tcampos);$wi++){
								
								$valores1[0] = $tcampos[$wi];
								$valores1[1] = $ids[$w1]; 
								$campoadic = "adicional_".$tcampos[$wi]."_".$ids[$w1];
								$valores1[2] = $_POST[$campoadic];
								
								$tool->insertar2("campo_user","campo_id,user_id,valor",$valores1);
								
																
							}
						
						}
						
						////////////////////////////////////
						
						$tool->cerrar_transaccion();
						
						$tool->javaviso("usuarios actualizados con exito","usuarios-fastedit.php");
						

							
					
			}else if($_REQUEST['opcion']==2){ ////borrar usuarios
				
					
			
				   $borrados = $_REQUEST['borrados'];
				   
					
				   if(!empty($borrados[0])){ 
				   
				   			
							$DIR = $_SESSION['DIRSERVER']; ///LA CARPETA DE ARCHIVOS ACTUAL	
							
							$iid = implode(',',$borrados);
							
							
							//////////////////borrar todos los archivos del producto

								$queryA = "select ruta from cliente_archivo where cliente_id in ($iid) ";
										
								$archivos = $tool->array_query($queryA);
								
								//borrando datos
								for($i=0;$i<count($archivos);$i++){
								
									@unlink("../../SVsitefiles/$DIR/usuario/doc/".$archivos[i]);
								}
										
							////////////////////////////////////////////////////////
							
							
							$tool->query("delete from cliente where id in ($iid) ");
							$tool->javaviso("usuarios borrados con exito","usuarios-fastedit.php");
							
					}	
			
			
			} 	
			
	
	}
	
	
	$cat1 = $tool->array_query("select distinct nombre from cliente_categoria where grupo = 1 order by nombre");
	$cat2 = $tool->array_query("select distinct nombre from cliente_categoria where grupo = 2 order by nombre");
	$cat3 = $tool->array_query("select distinct nombre from cliente_categoria where grupo = 3 order by nombre");
	$cat4 = $tool->array_query("select distinct nombre from cliente_categoria where grupo = 4 order by nombre");
	$cat5 = $tool->array_query("select distinct nombre from cliente_categoria where grupo = 5 order by nombre");
	
	
	/////////campos adicionales
	$camposTitle = $tool->estructura_db("SELECT c.nombre,c.id,c.tipo,c.valores
												FROM
												campo AS c
												where c.modulo = 'user' order by orden");
												
	
	$adicionales = $tool->estructura_db("SELECT campo_id,user_id,valor FROM campo_user ORDER BY user_id,campo_id");											
	
	/////////////////////////////
	
	/////en caso de ordenamiento
	if(isset($_REQUEST['orden'])) $pordena = $_REQUEST['orden'].',';
	$tool->query("select * from cliente a  order by $pordena id asc ");
	


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Edici&oacute;n r&aacute;pida de Usuarios</title>
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

	function ordenar(valor){
		
		location.replace('usuarios-fastedit.php?orden='+valor);
		
	}
	
	
	function validarBorrados(){
		
		var i=0;
		var band = 0;
		
		for(i=1;i<=<?=$tool->nreg ?>;i++){
				
		if(document.getElementById('borrados_'+i).checked==true)
			band = 1;
		
		}
		

		
		if(band==0)
		{ alert('No hay ningun usuario seleccionado para borrar'); 
		}else{
			
			document.form1.opcion.value='2'; 
			document.form1.submit();
			
		}
		

		
		
	}


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
<table width="4800" border="0" cellspacing="3" cellpadding="0">
<!--CABECERA DE LA TABLA DE ARTICULOS-->
 <?php  $encabezado = '
 
 <tr>
<td width="1%" class="td-headertabla"><img src="../icon/icon-ojo-pelao.gif" width="16" height="16" title="¿Activo o inactivo?"></td>
<td width="1%" class="td-headertabla"><img src="../icon/botonsito-confirmar-pago-done.jpg" width="15" height="15" title="Seleccionar"></td>
<td width="3%" align="center" class="td-headertabla" id="id" style="cursor:pointer" title="ordenar por ID" onclick="ordenar(this.id)">ID</td>
<td width="3%" class="td-headertabla" id="origen" style="cursor:pointer" title="ordenar por Origen" onclick="ordenar(this.id)">Origen</td>
<td width="7%" class="td-headertabla">Categoria 1</td>
<td width="8%" class="td-headertabla">Categoria 2</td>
<td width="7%" class="td-headertabla">Categoria 3</td>
<td width="7%" class="td-headertabla">Categoria 4</td>
<td width="6%" class="td-headertabla">Categoria 5</td>
<td width="3%" class="td-headertabla">Rif</td>
<td width="3%" class="td-headertabla" id="nombre" style="cursor:pointer" title="ordenar por nombre" onclick="ordenar(this.id)">Nombre</td>
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
<td width="3%" class="td-headertabla" id="ciudad" style="cursor:pointer" title="ordenar por ciudad" onclick="ordenar(this.id)">Ciudad</td>
<td width="3%" class="td-headertabla" id="estado" style="cursor:pointer" title="ordenar por estado" onclick="ordenar(this.id)">Estado</td>
<td width="3%" class="td-headertabla" id="pais" style="cursor:pointer" title="ordenar por pais" onclick="ordenar(this.id)">pais</td>
<td width="4%" class="td-headertabla">Notas</td>';


for($z=0;$z<count($camposTitle);$z++)
$encabezado.= '<td width="3%" class="td-headertabla">'.$camposTitle[$z]['nombre'].'</td>';

$encabezado.= '</tr> ';


echo $encabezado;

 ?>
 
 
<!--FIN CABECERA DE LA TABLA DE ARTICULOS-->

<!--loop de artículos--> 
<?php 
	
	$j=1;
	$ii=1; ///loop para controlar el encabezado
	$repite = 10; ///repetir encabezado cada tantos..

	while ($row = mysql_fetch_assoc($tool->result)) {
	
	if($ii==$repite+1){ echo $encabezado; $ii=1; } 
	
	 ?>

<tr>
  <td  class="fastedit-data-td"><input name="activos[]" type="checkbox" id="activos[]" value="<?=$row['id'] ?>" <?php if($row['activo']==1) echo 'checked'; ?>></td>
  <td class="fastedit-data-td"><input name="borrados[]" type="checkbox" id="borrados_<?=$j ?>" value="<?=$row['id'] ?>"></td>
  <td align="center" class="fastedit-data-td"><?=$row['id'] ?></td>
  
  <td class="fastedit-data-td">
  <div class="fastedit-categorias"><?php echo $row['categoria']  ?>
    <input name="ids[]" type="hidden" id="ids[]" value="<?=$row['id'] ?>">
  </div>
  <input name="origen[]" type="text" class="form-box" id="origen[]" value="<?=$row['origen'] ?>" size="20"></td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria1[]",$cat1,$cat1,' ',$row['categoria1'],false,'',false,false,'n-form-box'); ?>&nbsp;</td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria2[]",$cat2,$cat2,' ',$row['categoria2'],false,'',false,false,'n-form-box'); ?></td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria3[]",$cat3,$cat3,' ',$row['categoria3'],false,'',false,false,'n-form-box'); ?></td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria4[]",$cat4,$cat4,' ',$row['categoria4'],false,'',false,false,'n-form-box'); ?></td>
  <td class="fastedit-data-td"><?php echo $tool->combo_array("categoria5[]",$cat5,$cat5,' ',$row['categoria5'],false,'',false,false,'n-form-box'); ?></td>
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
  <td class="fastedit-data-td"><textarea name="notas[]" cols="25" class="form-box" id="noticias_titulo[]"><?=$row['notas'] ?></textarea></td>

<?php 
		for($w1=0;$w1<count($camposTitle);$w1++){
		
				for($wi=0;$wi<count($adicionales);$wi++){
					
						////campo id
						unset($campoA);
						$idc = 	$camposTitle[$w1]['id'];		
					
						if($adicionales[$wi]['user_id'] == $row['id'] && $adicionales[$wi]['campo_id'] == $idc){
						$campoA = $adicionales[$wi]['valor'];
						break;
						}
							

				}
				
				if($camposTitle[$w1]['tipo']!="combo"){
				?>
               	<td class="fastedit-data-td"><input name="adicional_<?php echo  $camposTitle[$w1]['id'] ?>_<?php echo $row['id']  ?>" type="text" class="form-box" value="<?=$campoA ?>" size="20" /></td>
               	<?
				}else{
					$combov = explode(',',$camposTitle[$w1]['valores']);
					echo '<td class="fastedit-data-td">'.$tool->combo_array("adicional_".$camposTitle[$w1]['id'].'_'.$row['id'],$combov,$combov,' ',$campoA,false,'',false,false,'n-form-box').'</td>';
					
				}
				
				
		}

?>


</tr>
<!--fin loop de articulos--> 
<?php

	$ii++;
	$j++;

 }
 
 
  ?>
</table>




<!--FIN LISTADO DE ARTÍCULOS-->
</form>


<center>
<input type="button" onClick="validarBorrados();" class="form-button" name="Button" value=" [-] Borrar Seleccionados">  &nbsp;&nbsp;
<input type="button" onClick="document.form1.opcion.value='1'; document.form1.submit();" class="form-button" name="Button" value="[ok] Aplicar"> &nbsp;

<input name="Reset" type="reset" class="form-button" onClick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="[<]  Volver">

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