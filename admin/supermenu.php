<script language="JavaScript" type="text/JavaScript">
function goHere(item,targ)  {
theChoice = item.selectedIndex;
theName=item.name;
item.selectedIndex = 0;
theURL=item.options[theChoice].value;

if (theChoice != 0) window.open(theURL,targ);
}

//-->
</script>




<div id="supermenu" style="height:27px; overflow:hidden; text-align:right; background-color:#D9E0D1; padding:3px;">
<form name="supermenu" >
<select name="supermenu1" onchange="goHere(this,'_self');" class="form-box" style="margin:0!important;">
<option value="" selected>Acceso R&aacute;pido</option>
<option value="http://www.svcmscentral.com/admin/main.php">PRINCIPAL</option>
<option value="http://www.svcmscentral.com/admin/opciones.php">OPCIONES</option>
<option value="http://www.svcmscentral.com/admin/opciones-admin-identidad.php">&nbsp;&nbsp; Identidad de la Empresa</option>
<option value="http://www.svcmscentral.com/admin/opciones-backup.php">&nbsp;&nbsp; Backup</option>
<option value="http://www.svcmscentral.com/admin/opciones-imagenes.php">&nbsp;&nbsp; Tama&ntilde;o de las Im&aacute;genes</option>
<option value="http://www.svcmscentral.com/admin/opciones-mensajes.php">&nbsp;&nbsp; Emails Autom&aacute;ticos de Sistema</option>
<option value="http://www.svcmscentral.com/admin/opciones-popups.php">&nbsp;&nbsp; Estilo de los PopUps</option>
<option value=""></option>
<option value="http://www.svcmscentral.com/admin/edit_index/editar-index.php">EDITAR PAGINA PRINCIPAL</option>

<?php if(in_array(1,$_SESSION['MODULOS'])){ ?>
<option value=""></option>
<option value="http://www.svcmscentral.com/admin/contenido/main.php">CONTENIDO</option>
<option value="http://www.svcmscentral.com/admin/contenido/arbol.php">&nbsp;&nbsp; Editar Paginas</option>
<option value="http://www.svcmscentral.com/admin/contenido/articulos-fastedit.php">&nbsp;&nbsp; Edicion R&aacute;pida</option>
<option value="http://www.svcmscentral.com/admin/contenido/datos-adicionales.php">&nbsp;&nbsp; Campos Adicionales</option>
<option value="http://www.svcmscentral.com/admin/contenido/opciones.php">&nbsp;&nbsp; Opciones de Contenido</option>
<option value=""></option>
<?php } ?>


 <?php  if(in_array(2,$_SESSION['MODULOS'])){ ?>

<option value="http://www.svcmscentral.com/admin/productos/main.php"> PRODUCTOS</option>
<option value="http://www.svcmscentral.com/admin/productos/productos.php">&nbsp;&nbsp; Editar Productos</option>
<option value="http://www.svcmscentral.com/admin/productos/productos-fastedit.php">&nbsp;&nbsp; Edicion R&aacute;pida</option>
<option value="http://www.svcmscentral.com/admin/opciones-moneda.php">&nbsp;&nbsp; Moneda  y Precios</option>
<option value="http://www.svcmscentral.com/admin/productos/productos-descuentos.php">&nbsp;&nbsp; Descuentos</option>
<option value=""></option>

<?php } ?>



<?php  if(in_array(3,$_SESSION['MODULOS'])){ ?>
<option value="http://www.svcmscentral.com/admin/usuarios/index.php"> USUARIOS</option>
<option value="http://www.svcmscentral.com/admin/usuarios/agregarc.php">&nbsp;&nbsp; Agregar Usuario</option>
<option value="http://www.svcmscentral.com/admin/usuarios/categorias.php">&nbsp;&nbsp; Categorias de Usuarios</option>
<option value="http://www.svcmscentral.com/admin/usuarios/datos-adicionales.php">&nbsp;&nbsp; Campos Adicionales</option>
<option value="http://www.svcmscentral.com/admin/usuarios/mensajes-usuario.php">&nbsp;&nbsp; Escribir Notificaci&oacute;n General (Web)</option>



<?php  if(in_array(2,$_SESSION['MODULOS'])){ ?>

<option value="http://www.svcmscentral.com/admin/productos/ordenes.php">&nbsp;&nbsp; &Oacute;rdenes de Compra</option>


<?php  if(in_array(4,$_SESSION['MODULOS'])){ ?>
<option value=""></option>
<option value="http://www.svcmscentral.com/admin/pagos/main.php">&nbsp;&nbsp; PAGOS</option>
<option value="http://www.svcmscentral.com/admin/pagos/datosdepago.php">&nbsp;&nbsp; Editar Datos de Pago</option>
<option value="http://www.svcmscentral.com/admin/pagos/agregar-cuenta-bancaria.php">&nbsp;&nbsp; Agregar Cuenta Bancaria</option>



 <?php  if(in_array(5,$_SESSION['MODULOS'])){ ?>
<option value=""></option>
<option value="http://www.svcmscentral.com/admin/mensajes/main.php"> MENSAJES DE USUARIOS</option>


<?php } ?>
<?php } ?>
<?php } ?>


 <?php } ?>



<?php  if(in_array(6,$_SESSION['MODULOS'])){ ?>
<option value=""></option>
<option value="http://www.svcmscentral.com/admin/banners/main.php"> BANNERS</option>
<option value=""></option>

 <?php } ?>



<option value="http://www.svcmscentral.com/admin/salir.php"> [x] SALIR DEL SISTEMA</option>
</select>
</form>
</div>