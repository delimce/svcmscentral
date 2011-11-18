<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/paginas.php");

include("security.php");

$tool = new tools();
$tool->autoconexion();

////////paginacion

 $TOTAL = $tool->simple_db("select count(*) from mensaje ");
 if(isset($_REQUEST['cuenta'])) $cuenta = $_REQUEST['cuenta']; else $cuenta = 20;
 if(isset($_REQUEST['desde'])) 	$desde = $_REQUEST['desde']; else $desde = 0;

///////////////
	if(isset($_REQUEST['borrar'])){


			$tool->query("delete from mensaje where id = {$_REQUEST['borrar']} ");
			$tool->javaviso("Mensaje {$_REQUEST['borrar']} ha sido borrado","main.php");

	}


	if(isset($_REQUEST['leer'])){


			$tool->query("update mensaje set tipo = 'admin' where id = '{$_REQUEST['leer']}' ");
			$tool->javaviso("Mensaje {$_REQUEST['leer']} ha sido marcado como leido","main.php");

	}







/////////////filtros

$query = "SELECT
	  (select nombre from cliente where id = p.autor ) as nombre,
	  (select email from cliente where id = p.autor ) as email,
	  p.id,
	  p.tipo,
	  p.titulo,
	  p.contenido,
	  p.origen,
	  DATE_FORMAT(p.fecha,'%d/%m/%Y %H:%i') as fecha
	FROM
	  mensaje p ";

	  if(!isset($_REQUEST['orden1'])) $_REQUEST['orden1'] = 'id';

$query.= " order by {$_REQUEST['orden1']} {$_REQUEST['orden2']} limit $desde,$cuenta ";

//////////////////////


	$tool->query($query);





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>Mensajes de los Usuarios</title>
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





<div id="ntitulo">Comentarios de sus usuarios en las páginas de su Web Site</div>
<div id="ninstrucciones">
<p>En este módulo usted podrá leer los comentarios que dejan los usuarios en cada uno de los artículos que tengan esta opción activada. Para responder públicamente a los comentarios, vaya a la página donde fue publicado, ingrese como usuario registrado y escriba un comentario.</p>


</div>


<div id="ncontenido">





<div id="nbloque">
<div id="nbotonera">
<form name="form1" method="post" action="">
              Ver
                 <?php

	 $r21[0] = "20 registros"; $r22[0] = "20";
	 $r21[1] = "50 registros"; $r22[1] = "50";
	  $r21[2] = "100 registros"; $r22[2] = "100";

	 echo $tool->combo_array("cuenta",$r21,$r22,false,false,"submit();",'',false,false,"form-box")?>
&nbsp; Ordenar por:
<?php

	 $i21[0] = "fecha"; $i22[0] = "fecha";
	 $i21[1] = "nombre"; $i22[1] = "nombre";

	 echo $tool->combo_array ("orden1",$i21,$i22,false,false,"submit();",'',false,false,"form-box")?>
&nbsp;En orden
<?php

	 $o21[0] = "Decreciente";$o22[0] = "DESC";
	 $o21[1] = "Creciente";$o22[1] = "ASC";

	 echo $tool->combo_array ("orden2",$o21,$o22,false,false,"submit();",'',false,false,"form-box")?>
             
               </form> 
</div>


<div  id="npaginacion"><?php paginas($TOTAL,$cuenta,$desde,"main.php"); ?></div>


<?php
	while ($row = mysql_fetch_assoc($tool->result)) {


	?>

            <!--loop mensajes-->
            <div class="mens-mensaje-container">




 <div class="mens-mensaje-imgborrar" style="margin-left:10px;"><a href="main.php?borrar=<?php echo $row['id'] ?>" class="instruccion"><img src="../icon/botonsito-borrar-mensajes.jpg" width="15" height="15" border="0"><span class="derecha">Borrar</span></a></div>




<?php if($row['tipo']=='cliente'){ ?>

<!-- LUIS AL DARLE CLICK AQUI SE LE CAMBIA  EL CAMPO "TIPO" :  DE "CLIENTE" A "ADMIN" -->
<div class="mens-mensaje-imgborrar" style="margin-left:10px;"><a href="main.php?leer=<?php echo $row['id'] ?>" class="instruccion" style="cursor:pointer;"><img src="../icon/botonsito-confirmar-pago.jpg" width="15" height="15" border="0"><span class="derecha">Marcar como Leido</span></a></div>




<?php }else if($row['tipo']=='admin'){?>
<div class="mens-mensaje-imgborrar"><img src="../icon/botonsito-confirmar-pago-done.jpg" width="15" height="15" border="0"></div>


<?php } ?>






            <div class="mens-mensaje-fecha"><?php echo $row['fecha'] ?></div>
            <div class="mens-mensaje-fecha"><strong>Desde</strong>: <?php echo $row['origen'] ?></div>
            <div class="mens-mensaje-titulo"><?php echo $row['titulo']; ?></div>
            <div class="mens-mensaje-contenido"><?php echo $row['contenido']; ?> </div>
            <div class="mens-mensaje-autor">

<a href="http://www.svcmscentral.com/admin/usuarios/busquedac.php?categoria1=&telefono=&categoria2=&celular=&categoria3=&fax=&pais=&estado=&nombre1=&ciudad=&empresa=&estatus=0&mail1=<?php echo $row['email'] ?>&origen=0&direccion=&Usuario+de+Twitter=&Su++Email+registrado+en+Facebook=&notas=&campos[]=email&campos[]=tlf1&campos[]=celular&campos[]=fax&campos[]=ciudad&campos[]=estado&campos[]=pais&campos[]=zip&campos[]=direccion&band=1&Submit=Buscar" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-lupa.gif" border="0" align="absmiddle"><span class="derecha">Ver Detalles de este Usuario</span></a>



<a href="../opciones-sm.php?esolo=<?php echo $row['email'] ?>" class="instruccion" style="cursor:pointer;"> <?php echo utf8_encode($row['nombre']); ?><span class="derecha">Responder por Email a este usuario</span>




</a></div>
            </div>
            <!--termina loop mensajes-->

	<?php } ?>













</div>


<div  id="npaginacion"><?php paginas($TOTAL,$cuenta,$desde,"main.php"); ?></div>









<!-- termina ncontenido -->
</div>
<?php include ("../n-include-mensajes.php")?>
<div id="nnavbar"><?php include "n-include-menu.php"?></div>
</div>
</div>
<?php include ("../n-footer.php")?>



















</body>
</html>
<?php $tool->cerrar(); ?>