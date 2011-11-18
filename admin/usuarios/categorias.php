<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");



 $datos = new formulario();
 $fecha = new fecha("d/m/Y");
 $datos->autoconexion();
 
 if(!empty($_POST['r-nombre']))$datos->insert_data("r","-","cliente_categoria",$_POST);
 
 if(isset($_GET['borrar'])){ ///borrar categoria
 
 		$datos->query("SET AUTOCOMMIT=0"); ////iniciando la transaccion
      	$datos->query("START TRANSACTION");
  
 
 		$datacat = $datos->simple_db("select nombre,grupo from cliente_categoria where id = '{$_GET['borrar']}'");
 		$datos->query("delete from cliente_categoria where id = '{$_GET['borrar']}' ");
		$datos->query("update cliente set categoria{$datacat['grupo']} = '' where categoria{$datacat['grupo']} = '{$datacat['nombre']}' ");
		
		$datos->query("COMMIT"); 
		
		$datos->redirect('categorias.php');
		
		
		
 }
 
 
 $cat = $datos->estructura_db("select id,nombre,grupo from cliente_categoria ");


?>

<html>
<head>
<title>Editar Categor&iacute;as de usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript" src="../../SVsystem/js/scripts.js"></script>

<script language="JavaScript" type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
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





<div id="ntitulo">Editar Categor&iacute;as de Usuarios</div>
<div id="ninstrucciones">
<p>En este m&oacute;dulo usted podr&aacute; editar las  categor&iacute;as de usuarios en cada uno de los 5 grupos que&nbsp; hemos dispuesto para que usted pueda realizar una organizaci&oacute;n multi - dimensional de sus contactos.</p>
						<p>Por ejemplo, <strong>usted puede crear, en el primer grupo, las categor&iacute;as mas importantes</strong> como : Clientes, Proveedores, Mayoristas, P&uacute;blico en General, Etc...</p>
						<p>Para organizar o filtrar sus contactos seg&uacute;n otros criterios, usted dispone de otros 4 grupos. En el segundo grupo, usted podr&iacute;a, por ejemplo crear otras categor&iacute;as de inter&eacute;s, que no interfieran o se solapen con&nbsp; las categor&iacute;as del primer grupo.</p>
<p style="text-align:right;"><a href="../help/usuarios-categorias.php" target="_blank"><strong>Lea m&aacute;s  ayuda sobre este tema </strong><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></p>




</div>


<div id="ncontenido">

<div id="nbloque">

	<table width="100%" border="0" cellspacing="10" cellpadding="0">
						<tr>
						<td width="32%" class="td-headertabla">Grupo</td>
						<td width="68%" class="td-headertabla">Categor&iacute;as creadas en el grupo</td>
						</tr>
						<tr>
						<td class="td-form-title"><a href="javascript:;" class="instruccion" style="font-size:20px;">Grupo 1<span>Ponga en este grupo sus categorías principales de usuarios. Debe cuidar que estas categorías sean mutuamente excluyentes. Si usted desea aplicar descuentos discriminados por tipo de usuario, <strong>este es el grupo</strong> en el cual usted debe crear esos "tipos" de usuario  que van a recibir cada uno un descuento.</span></a></td>
						<td valign="top">

            <?php for($i=0;$i<count($cat);$i++){ if($cat[$i]['grupo']==1){ ?>
            <div class="div-listado-items"><?php echo $cat[$i]['nombre']  ?>
            <a href="categorias.php?borrar=<?php echo $cat[$i]['id'] ?>" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-delete.gif" width="16" height="16" border="0" align="absmiddle"><span><strong>Borrar Categoria:</strong> Al borrar esta categoría, los usuarios no serán borrados pero si quedarán "huérfanos". Usted quizás deba reubicarlos.</span></a>
            </div>
            <?php } } ?>

<form name="form1" id="form1" method="post" action="">						
<div id="mens-mensaje-container" style="margin-top:5px;">
<input name="r-nombre" type="text" class="form-box" id="r-nombre" size="35">&nbsp; 
	<a href="javascript:form1.submit();"><img src="../icon/add.png" border="0" width="16" height="16" align="absmiddle"></a> Agregar	esta categor&iacute;a al grupo
    <input name="r-grupo" type="hidden" id="r-grupo" value="1">
</div>
</form>


</td>


						</tr>
						<tr>
						<td class="td-form-title"><a href="javascript:;" class="instruccion" style="font-size:20px;">Grupo 2<span>Cree en este grupo otro set de categorías que le permita discriminar a sus usuarios, de acuerdo a los intereses de su empresa.</span></a></td>
						<td>
                          <?php for($i=0;$i<count($cat);$i++){ if($cat[$i]['grupo']==2){ ?>
            <div class="div-listado-items"><?php echo $cat[$i]['nombre']  ?>
            <a href="categorias.php?borrar=<?php echo $cat[$i]['id'] ?>" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-delete.gif" width="16" height="16" border="0" align="absmiddle"><span><strong>Borrar Categoria:</strong> Al borrar esta categoría, los usuarios no serán borrados pero si quedarán "huérfanos". Usted quizás deba reubicarlos.</span></a>
            </div>
            <?php } } ?>


<form name="form2" id="form2" method="post" action="">								
<div id="mens-mensaje-container" style="margin-top:5px;">
<input name="r-nombre" type="text" class="form-box" id="r-nombre" size="35">&nbsp; 
	<a href="javascript:form2.submit();"><img border="0" src="../icon/add.png" width="16" height="16" align="absmiddle"></a>	Agregar	esta categor&iacute;a al grupo
    <input name="r-grupo" type="hidden" id="r-grupo" value="2">
</div>
</form>

</td>
						</tr>
						<tr>
      <td class="td-form-title"><a href="javascript:;" class="instruccion" style="font-size:20px;">Grupo 3<span>Cree en este grupo otro set de categorías que le permita discriminar a sus usuarios, de acuerdo a los intereses de su empresa.</span></a></td>
      <td>
       		<?php for($i=0;$i<count($cat);$i++){ if($cat[$i]['grupo']==3){ ?>
            <div class="div-listado-items"><?php echo $cat[$i]['nombre']  ?>
            <a href="categorias.php?borrar=<?php echo $cat[$i]['id'] ?>" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-delete.gif" width="16" height="16" border="0" align="absmiddle"><span><strong>Borrar Categoria:</strong> Al borrar esta categoría, los usuarios no serán borrados pero si quedarán "huérfanos". Usted quizás deba reubicarlos.</span></a>
            </div>
            <?php } } ?>
     
      
      <form name="form3" id="form3" method="post" action="">
      <div id="mens-mensaje-container" style="margin-top:5px;">
      <input name="r-nombre" type="text" class="form-box" id="r-nombre" size="35">
      &nbsp; 
      <a href="javascript:form3.submit();"><img border="0" src="../icon/add.png" width="16" height="16" align="absmiddle"></a> Agregar	esta categor&iacute;a al grupo 
      <input name="r-grupo" type="hidden" id="r-grupo" value="3">
       </div>
      </form>
      
      
      </td>
						</tr>
						<tr>
      <td class="td-form-title"><a href="javascript:;" class="instruccion" style="font-size:20px;">Grupo 4<span>Cree en este grupo otro set de categorías que le permita discriminar a sus usuarios, de acuerdo a los intereses de su empresa.</span></a></td>
      <td>
      
        <?php for($i=0;$i<count($cat);$i++){ if($cat[$i]['grupo']==4){ ?>
            <div class="div-listado-items"><?php echo $cat[$i]['nombre']  ?>
            <a href="categorias.php?borrar=<?php echo $cat[$i]['id'] ?>" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-delete.gif" width="16" height="16" border="0" align="absmiddle"><span><strong>Borrar Categoria:</strong> Al borrar esta categoría, los usuarios no serán borrados pero si quedarán "huérfanos". Usted quizás deba reubicarlos.</span></a>
            </div>
            <?php } } ?>
     
     <form name="form4" id="form4" method="post" action="">
    <div id="mens-mensaje-container" style="margin-top:5px;">
      <input name="r-nombre" type="text" class="form-box" id="r-nombre" size="35">
      &nbsp; 
      <a href="javascript:form4.submit();"><img border="0" src="../icon/add.png" width="16" height="16" align="absmiddle"></a> Agregar	esta categor&iacute;a al grupo 
      <input name="r-grupo" type="hidden" id="r-grupo" value="4">
      </div>
      </form>
      
      </td>
						</tr>
						<tr>
      <td class="td-form-title"><a href="javascript:;" class="instruccion" style="font-size:20px;">Grupo 5<span>Cree en este grupo otro set de categorías que le permita discriminar a sus usuarios, de acuerdo a los intereses de su empresa.</span></a></td>
      <td>
      
      
      		 <?php for($i=0;$i<count($cat);$i++){ if($cat[$i]['grupo']==5){ ?>
            <div class="div-listado-items"><?php echo $cat[$i]['nombre']  ?>
           <a href="categorias.php?borrar=<?php echo $cat[$i]['id'] ?>" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-delete.gif" width="16" height="16" border="0" align="absmiddle"><span><strong>Borrar Categoria:</strong> Al borrar esta categoría, los usuarios no serán borrados pero si quedarán "huérfanos". Usted quizás deba reubicarlos.</span></a>
            </div>
            <?php } } ?>
      
      <form name="form5" id="form5" method="post" action="">
      <div id="mens-mensaje-container" style="margin-top:5px;">
      <input name="r-nombre" type="text" class="form-box" id="r-nombre" size="35">
      &nbsp; 
      <a href="javascript:form5.submit();"><img border="0" src="../icon/add.png" width="16" height="16" align="absmiddle"></a> Agregar	esta categor&iacute;a al grupo 
      <input name="r-grupo" type="hidden" id="r-grupo" value="5">
      </div>
      </form>
      
      </td>
						</tr>
</table>
						




<!-- termina nbloque -->
</div>




<!-- termina ncontenido -->
</div>

<div id="nnavbar"><?php include "n-include-menu.php"?></div>

</div>
</div>
<?php include ("../n-footer.php")?>
<?php // include ("../n-include-mensajes.php") NO SIRVE EN ESTA PAGINA ?>
</body>
</html>
<?php $datos->cerrar(); ?>
