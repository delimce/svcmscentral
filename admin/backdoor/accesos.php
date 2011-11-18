<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/masterconfig.php"); ////////setup
include("../../SVsystem/class/clases.php");
include("../../SVsystem/class/paginas.php");
require("security.php"); //////// solo accesible para administradores

  $tool = new tools('db');
 
 
 
  
 ////////paginacion

 $TOTAL = $tool->simple_db("select count(*) from admin_log ");
 
 if(empty($_SESSION['CUENTA12'])){ $_SESSION['CUENTA12'] = 500;  }
 if(isset($_REQUEST['cuenta'])) $_SESSION['CUENTA12'] = $_REQUEST['cuenta'];
 if(isset($_REQUEST['desde'])) 	$desde = $_REQUEST['desde']; else $desde = 0;
 ////query
 
 if(!empty($_REQUEST['orden1'])) $_SESSION['ORDEN12'] = "order by {$_REQUEST['orden1']}";
 if(empty($_SESSION['ORDEN12']))$_SESSION['ORDEN12'] = "order by id"; 
  if(empty($_SESSION['ORDEN22']))$_SESSION['ORDEN22'] = "desc"; 
 if(!empty($_REQUEST['orden2'])) $_SESSION['ORDEN22'] = $_REQUEST['orden2'];
 
 
 $query = "SELECT 
  l.id,
  a.email,
  a.id as id2,
  a.user,
  date_format(DATE_ADD(l.fecha, INTERVAL 30 MINUTE),'%d/%m/%Y <B>%h:%i %p</B>') as fecha,
  l.dir_ip,
  c.titulo
FROM
  admin a
  INNER JOIN admin_log l ON (a.id = l.admin_id)
  INNER JOIN cuenta c ON (l.id_cuenta = c.id)";
 
 
 $query.= "  {$_SESSION['ORDEN12']} {$_SESSION['ORDEN22']} limit $desde,{$_SESSION['CUENTA12']}";
 

 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>reporte total de accesos de administradores svcms</title>
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





<div id="ntitulo">Reportes Total de Accesos de Administradores</div>
<div id="ninstrucciones" style="display:none;">
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">
<select name="cuenta" class="form-box" onChange="location.replace('accesos.php?cuenta='+this.value);">
         <option value="">Items por p&aacute;gina</option>
         <option value="500" <?php if($_SESSION['CUENTA12'] == 100)echo 'selected'; ?>>500 &iacute;tems por pagina </option>
         <option value="1000" <?php if($_SESSION['CUENTA12'] == 200)echo 'selected'; ?>>1000 &iacute;tems por pagina </option>
         <option value="5000" <?php if($_SESSION['CUENTA12'] == 100)echo 'selected'; ?>>5000 &iacute;tems por pagina </option>
</select>
       &nbsp;&nbsp;               
       
<select name="orden1" class="form-box" onChange="location.replace('accesos.php?orden1='+this.value);">
       		<option value="">ordenar por</option>
       		<option value="user" <?php if($_SESSION['ORDEN12'] == "order by user")echo 'selected'; ?>>usuario</option> 
       		<option value="id" <?php if($_SESSION['ORDEN12'] == "order by id")echo 'selected'; ?>>fecha de acceso</option> 
       		<option value="dir_ip" <?php if($_SESSION['ORDEN12'] == "order by ip")echo 'selected'; ?>>ip</option> 
       </select>&nbsp;
      
       &nbsp; <select name="orden1" class="form-box" onChange="location.replace('accesos.php?orden2='+this.value);">
       <option value="">ordenar en forma...</option>
       <option value="desc" <?php if($_SESSION['ORDEN22'] == "desc")echo 'selected'; ?>>el &uacute;ltimo de primero</option>
       <option value="asc" <?php if($_SESSION['ORDEN22'] == "asc")echo 'selected'; ?>>el primero de primero </option>
       </select>&nbsp; 

<a href="javascript:if(confirm('¿Esta seguro que desea eliminar todos los registros de acceso ?'))location.replace('accesos.php?borrar=1');" class="boton">Borrar todos los Registros</a>
</div>


<div id="npaginacion"><?php paginas($TOTAL,$_SESSION['CUENTA12'],$desde,"accesos.php"); ?></div>




<table width="100%" border="0" cellspacing="5" cellpadding="0">
       <tr>
       <td width="23%" class="td-headertabla">usuario</td>
       <td width="20%" class="td-headertabla">cuenta</td>
       <td width="26%" class="td-headertabla">fecha y hora</td>
       <td width="31%" class="td-headertabla">ip de acceso</td>
       </tr>
      
          <?php   
	  
	  $tool->query($query);
	  while ($row = mysql_fetch_assoc($tool->result)) {?>
      
       <tr>
       <td valign="top" class="td-content"><strong><a href="mailto:<?php echo $row['email'] ?>"  title="enviar mensaje a este admin"><img src="../icon/icon-mail.gif" width="16" height="16" border="0" align="absmiddle"></a> <a href="javascript:;" title="ver detalles"><img src="../icon/icon-lupa.gif" width="16" height="16" border="0" align="absmiddle" onClick="MM_openBrWindow('detalles-administrador.php?id=<?php echo $row['id2'] ?>','','width=600,height=380')"></a> <?php echo $row['user'] ?></strong></td>
       <td valign="top" class="td-content"><?php echo $row['titulo'] ?></td>
       <td valign="top" class="td-content"><?php echo $row['fecha'] ?></td>
       <td valign="top" class="td-content"><?php echo $row['dir_ip'] ?></td>
       </tr>
       
         <?php } ?>
       
</table>











<!-- termina nbloque -->
</div>

<div id="npaginacion"><?php paginas($TOTAL,$_SESSION['CUENTA12'],$desde,"accesos.php"); ?></div>










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
