<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/masterconfig.php"); ////////setup
include("../../SVsystem/class/clases.php");
include("../../SVsystem/class/paginas.php");
require("security.php"); //////// solo accesible para administradores

 $tool = new tools('db');
 
 
 if(isset($_REQUEST['borrar'])){ $tool->query("truncate table log_fallos"); $tool->redirect("accesos-fallidos.php"); }
 
 
 
 ////////paginacion

 $TOTAL = $tool->simple_db("select count(*) from log_fallos ");
 
 if(empty($_SESSION['CUENTA1'])){ $_SESSION['CUENTA1'] = 100;  }
 if(isset($_REQUEST['cuenta'])) $_SESSION['CUENTA1'] = $_REQUEST['cuenta'];
 if(isset($_REQUEST['desde'])) 	$desde = $_REQUEST['desde']; else $desde = 0;
 ////query
 
 if(!empty($_REQUEST['orden1'])) $_SESSION['ORDEN1'] = "order by {$_REQUEST['orden1']}";
 if(empty($_SESSION['ORDEN1']))$_SESSION['ORDEN1'] = "order by id"; 
 if(empty($_SESSION['ORDEN2']))$_SESSION['ORDEN2'] = "desc"; 
 if(!empty($_REQUEST['orden2'])) $_SESSION['ORDEN2'] = $_REQUEST['orden2'];
 
 $query = "select *,date_format(DATE_ADD(fecha, INTERVAL 30 MINUTE),'%d/%m/%Y <B>%h:%i %p</B>') as fecha1 from log_fallos {$_SESSION['ORDEN1']} {$_SESSION['ORDEN2']} limit $desde,{$_SESSION['CUENTA1']}";
 
 
 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>reporte total de accesos fallidos </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--

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




<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Reportes de Accesos Fallidos</div>
<div id="ninstrucciones" style="display:none;">
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">
<select name="cuenta" class="form-box" onChange="location.replace('accesos-fallidos.php?cuenta='+this.value);">
         <option value="">Items por p&aacute;gina</option>
         <option value="100" <?php if($_SESSION['CUENTA1'] == 100)echo 'selected'; ?>>100 &iacute;tems por pagina </option>
         <option value="200" <?php if($_SESSION['CUENTA1'] == 200)echo 'selected'; ?>>200 &iacute;tems por pagina </option>
         <option value="500" <?php if($_SESSION['CUENTA1'] == 500)echo 'selected'; ?>>500 &iacute;tems por pagina </option>
</select> 
       &nbsp;&nbsp;               
       
        <select name="orden1" class="form-box" onChange="location.replace('accesos-fallidos.php?orden1='+this.value);">
       		<option value="">ordenar por</option>
       		<option value="user" <?php if($_SESSION['ORDEN1'] == "order by user")echo 'selected'; ?>>usuario</option> 
       		<option value="id" <?php if($_SESSION['ORDEN1'] == "order by id")echo 'selected'; ?>>fecha de acceso</option> 
       		<option value="ip" <?php if($_SESSION['ORDEN1'] == "order by ip")echo 'selected'; ?>>ip</option> 
       </select>&nbsp; 
      
       &nbsp; <select name="orden1" class="form-box" onChange="location.replace('accesos-fallidos.php?orden2='+this.value);">
       <option value="">ordenar en forma...</option>
       <option value="desc" <?php if($_SESSION['ORDEN2'] == "desc")echo 'selected'; ?>>el &uacute;ltimo de primero</option>
       <option value="asc" <?php if($_SESSION['ORDEN2'] == "asc")echo 'selected'; ?>>el primero de primero </option>
       </select>&nbsp; 

<a href="javascript:if(confirm('¿Esta seguro que desea eliminar todos los registros de acceso fallido?'))location.replace('accesos-fallidos.php?borrar=1');" class="boton">Borrar todos los Registros</a>
</div>


<div id="npaginacion"><?php paginas($TOTAL,$_SESSION['CUENTA1'],$desde,"accesos-fallidos.php"); ?></div>



<table width="100%" border="0" cellspacing="5" cellpadding="0">
       <tr>
       <td width="16%" class="td-headertabla">usuario</td>
       <td width="17%" class="td-headertabla">password</td>
       <td width="12%" class="td-headertabla"> browser</td>
       <td width="20%" class="td-headertabla">fecha y hora</td>
       <td width="35%" class="td-headertabla">ip de acceso</td>
       </tr>
      
      <?php   
	  
	  $tool->query($query);
	  while ($row = mysql_fetch_assoc($tool->result)) {?>
      
       <tr>
       <td valign="top" class="td-content"><?php echo $row['user'] ?></td>
       <td valign="top" class="td-content"><?php echo $row['pwd'] ?></td>
       <td valign="top" class="td-content">Mozilla</td>
       <td valign="top" class="td-content"><?php echo $row['fecha1'] ?></td>
       <td valign="top" class="td-content"><?php echo $row['ip'] ?></td>
       </tr>
       
        <?php } ?>
       
</table>












<!-- termina nbloque -->
</div>

<div id="npaginacion"><?php paginas($TOTAL,$_SESSION['CUENTA1'],$desde,"accesos-fallidos.php"); ?></div>










<!-- termina ncontenido -->
</div>
<?php //include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>    
</div>

</div>
<?php include ("../n-footer.php")?>





































































</body>
</html>
<?php $tool->cerrar(); ?>
