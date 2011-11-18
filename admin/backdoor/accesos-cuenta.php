<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/masterconfig.php"); ////////setup
include("../../SVsystem/class/clases.php");
include("../../SVsystem/class/paginas.php");
require("security.php"); //////// solo accesible para administradores

 $tool = new tools('db');
 
 ////////paginacion

 $TOTAL = $tool->simple_db("select count(*) from cuenta ");




 if(isset($_REQUEST['cuenta'])) $cuenta = $_REQUEST['cuenta']; else $cuenta = 10;
 if(isset($_REQUEST['desde'])) 	$desde = $_REQUEST['desde']; else $desde = 0;
 
 $query = "SELECT 
  c.titulo as cuenta,
  count(l.id) as nacc,
  GROUP_CONCAT(DISTINCT a.user) as users,
  GROUP_CONCAT(DISTINCT l.dir_ip) as ips,
  date_format(DATE_ADD(MAX(l.fecha), INTERVAL 30 MINUTE),'%d/%m/%Y <B>%h:%i %p</B>') as ult,
  (select user from admin where id =(select admin_id from `admin_log` where id = MAX(l.id)) ) as ultuser
  from cuenta c
  INNER JOIN admin_log l ON (c.id = l.id_cuenta)
  INNER JOIN admin a ON (l.admin_id = a.id)
GROUP BY
  l.id_cuenta";
  
  $tool->query($query);
 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>reporte de accesos por cuenta</title>
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





<div id="ntitulo">Reportes de Accesos por cuenta</div>
<div id="ninstrucciones">
</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">
<form name="form1" method="post" action="">
              Ver
                 <?php

	 $r21[0] = "10 registros"; $r22[0] = "10";
	 $r21[1] = "50 registros"; $r22[1] = "50";
	  $r21[2] = "100 registros"; $r22[2] = "100";

	 

	?>
                
               </form>
</div>


<div id="npaginacion"><?php paginas($TOTAL,$cuenta,$desde,"accesos-cuenta.php"); ?></div>





<table width="100%" border="0" cellspacing="5" cellpadding="0">
       <tr>
       <td width="22%" class="td-headertabla">cuenta</td>
       <td width="23%" class="td-headertabla">usuarios (#acc)</td>
       <td width="29%" class="td-headertabla">&uacute;ltimo acceso</td>
       <td width="17%" class="td-headertabla">ips de acceso</td>
       <td width="9%" class="td-headertabla"># accs</td>
       </tr>
      
      
      <?php 
	  
	  
	  while ($row = mysql_fetch_assoc($tool->result)) {
	  
	  ?>
      
       <tr>
       <td valign="top" class="td-content"><strong><?php echo $row['cuenta'] ?></strong></td>
       <td valign="top" class="td-content">
       <?php $users = explode(',',$row['users']); foreach($users as $value){ ?>
      	<a href="javascript:;"  title="enviar mensaje a este admin">
       <img src="../icon/icon-mail.gif" width="16" height="16" border="0" align="absmiddle"></a>
        <a href="javascript:;" title="ver detalles"><img src="../icon/icon-lupa.gif" width="16" height="16" border="0" align="absmiddle" onClick="MM_openBrWindow('detalles-administrador.php','','width=600,height=380')"></a>
        <?php echo $value.'<br>'; ?>
        <?php } ?>
       </td>
       <td valign="top" class="td-content"><?php echo $row['ult'] ?>&nbsp; (<?php echo $row['ultuser'] ?>)</td>
       <td valign="top" class="td-content">
       <?php $ips = explode(',',$row['ips']);
	   
	   foreach($ips as $value) echo $value.'<br>';
	   
	   ?></td>
       <td valign="top" class="td-content"><?php echo $row['nacc'] ?></td>
       </tr>
       
       <?php } ?>
       
       
</table>










<!-- termina nbloque -->
</div>

<div id="npaginacion"><?php paginas($TOTAL,$cuenta,$desde,"accesos-cuenta.php"); ?></div>










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
