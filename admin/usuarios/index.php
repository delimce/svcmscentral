<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

 	$datos = new tools('db');
 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Usuarios - buscador de contactos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>


</head>

<body>
<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Buscador de Usuarios</div>
<div id="ninstrucciones">
<p><p>Escriba la data que desea buscar en cada uno de los campos para refinar su búsqueda. Luego
        elija los campos que desea que la base de datos muestre en el listado. Si no selecciona nigún campo, el listado será solo
        de nombres. <a href="javascript:;" onClick="MM_openBrWindow('../help/usuarios-busqueda.php','','scrollbars=yes,resizable=yes,width=500,height=500')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p></p>




</div>


<div id="ncontenido">

<div id="nbloque">
<div id="nbotonera" >



</div>



<form name="form1" method="get" action="busquedac.php">
          <table width="100%" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td width="20%" class="bdc-form-title">Grupo 1</td>
              <td width="43%"><?php   echo $datos->combo_db ("categoria1","select nombre from cliente_categoria where grupo = 1 ","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas</span>',false,false,"form-box"); ?></td>
              <td width="13%" align="right" class="bdc-form-title">Telefono</td>
              <td width="24%"><input name="telefono" type="text" class="form-box" id="telefono" size="40"></td>
            </tr>
            <tr>
              <td class="bdc-form-title">Grupo 2</td>
              <td><?php   echo $datos->combo_db ("categoria2","select nombre from cliente_categoria where grupo = 2","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas</span>',false,false,"form-box"); ?></td>
              <td align="right" class="bdc-form-title">Celular</td>
              <td><input name="celular" type="text" class="form-box" id="celular" size="30"></td>
            </tr>
            <tr>
              <td class="bdc-form-title">Grupo 3</td>
              <td><?php   echo $datos->combo_db ("categoria3","select nombre from cliente_categoria where grupo = 3","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas</span>',false,false,"form-box"); ?></td>
              <td align="right" class="bdc-form-title">Fax</td>
              <td><input name="fax" type="text" class="form-box" id="fax" size="30"></td>
            </tr>
            <tr>
              <td class="bdc-form-title">Grupo 4</td>
              <td><?php   echo $datos->combo_db ("categoria4","select nombre from cliente_categoria where grupo = 4","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas</span>',false,false,"form-box"); ?></td>
              <td align="right" class="bdc-form-title">Pais</td>
              <td><input name="pais" type="text" class="form-box" id="pais" size="30"></td>
            </tr>
            <tr>
              <td class="bdc-form-title">Grupo 5</td>
              <td><?php   echo $datos->combo_db ("categoria5","select nombre from cliente_categoria where grupo = 5","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas</span>',false,false,"form-box"); ?></td>
              <td align="right" class="bdc-form-title">Estado</td>
              <td><input name="estado" type="text" class="form-box" id="estado" size="30"></td>
            </tr>
            <tr>
              <td width="20%" class="bdc-form-title">Nombre</td>
              <td width="43%"><input name="nombre1" type="text" class="form-box" id="nombre1" size="40"></td>
              <td align="right" class="bdc-form-title">Ciudad</td>
              <td><input name="ciudad" type="text" class="form-box" id="ciudad" size="30"></td>
            </tr>
            <tr>
              <td class="bdc-form-title">Empresa</td>
              <td><input name="empresa" type="text" class="form-box" id="empresa" size="30"></td>
              <td align="right" class="bdc-form-title">Estatus</td>
              <td><select name="estatus" class="form-box" id="estatus">
                <option value="0" selected>Ambos</option>
                <option value="1">Activo</option>
                <option value="-1">Inactivo</option>
              </select></td>
            </tr>
            <tr>
              <td align="right" class="bdc-form-title">Email</td>
              <td><input name="mail1" type="text" class="form-box" id="mail12" size="30"></td>
              <td align="right" class="bdc-form-title">Origen</td>
              <td><select name="origen" class="form-box" id="origen">
                <option value="0" selected>Todos</option>
                <option>Agregado masivo</option>
                <option>Creado en admin</option>
                <option>Inscrito por la p&aacute;gina web</option>
              </select></td>
            </tr>
            <tr>
              <td align="right" class="bdc-form-title">Direccion</td>
              <td><textarea name="direccion" cols="40" rows="1" class="form-box" id="direccion"></textarea></td>
              <td colspan="2" rowspan="3" valign="top"><?php /////campos adicionales
		  
		  
		  $datos->query("select id,nombre,tipo,valores from campo where modulo = 'user' order by orden");
		  
		  if($datos->nreg>0){
			  
			  
			            
            echo   '<table width="100%" border="0">';
            
          
          	$w=0;
			 while ($row2 = mysql_fetch_assoc($datos->result)) {
				 
				 
				 ?>
          <tr>
                <td width="20%" class="bdc-form-title"><?php echo $row2['nombre'] ?></td>
                <td width="43%"><?php 
			  
			  if($row2['tipo']=='texto' or $row2['tipo']=='textarea'){
				  echo '<input class="form-box" name="'.$row2['nombre'].'" type="text" size="20">';
				  
			  }else{
				  
				  $valorc = explode(",",$row2['valores']);
				  echo $datos->combo_array ($row2['nombre'],$valorc,$valorc,'Seleccione',false,false,'no',false,false,"form-box");
				  
			  }
			  
			  $camposad[$w] = $row2['nombre'];
			  $valorad[$w] = $row2['id'];
			  $w++;
			  ?></td>
          </tr>
            <?
		  
			  
		  }
		  
		  

       		echo '</table>';
	   
		  }
		  
		  ?>
            <tr>
              <td align="right" class="bdc-form-title">Notas</td>
              <td><textarea name="notas" cols="40" rows="1" class="form-box" id="notas"></textarea></td>
            </tr>
            <tr>
              <td class="bdc-form-title">&iquest;Qu&eacute; campos desea ver en el listado?<br>
                <span class="bdc-span-explicacion">Presione la tecla CTRL para seleccionar o des-seleccionar los campos que desea o no ver en el listado.</span></td>
              <td><select name="campos[]" size="<?php echo 9+count($camposad); ?>" multiple class="form-box" id="campos[]">
                <option value="email">Email</option>
                <option value="tlf1">Telefono</option>
                <option value="celular">Celular</option>
                <option value="fax">Fax</option>
                <option value="ciudad">Ciudad</option>
                <option value="estado">Estado</option>
                <option value="pais">Pais</option>
                <option value="zip">Codigo postal</option>
                <option value="direccion">Direccion</option>
                
                <?php for($w=0;$w<count($camposad);$w++) echo '<option value="'.$valorad[$w].'">'.$camposad[$w].'</option>'; ?>
              </select></td>
            </tr>
            <tr>
              <td align="right"><input name="band" type="hidden" id="band" value="1"></td>
              <td>&nbsp;
                 </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>

<center><input type="submit" name="Submit" value="¡Buscar Usuarios!" class="form-button"></center>

</form>




























<!--  termina nbloque-->
</div>











<!-- termina ncontenido -->
</div>

<div id="nnavbar"><?php include "n-include-menu.php"?></div>

</div>
</div>
<?php include ("../n-footer.php")?>
<?php // include ("../n-include-mensajes.php") NO SIRVE EN ESTA PAGINA ?>














































































































<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include("menu.php");?>


<!--END INCLUDES-->
</body>
</html>
<?php $datos->cerrar(); ?>
