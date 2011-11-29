<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");
include("../../SVsystem/class/clases.php");
include("../../SVsystem/class/paginas.php");

 $datos = new tools();
 $datos2 = new tools();
 $datos->autoconexion();
 $datos2->dbc = $datos->dbc;
$tool = new tools('db');







 ///////////////////////eliminar

 if(isset($_REQUEST['delete'])){

	 $datos->query("delete from cliente where id = {$_REQUEST['delete']} ");
	 $datos->redirect("busquedac.php");

 }


 ////////////////variables de session


 if(isset($_REQUEST['band']))$_SESSION['CAMPOSX'] = $_REQUEST['campos'];

 /////////campos a mostrar
 $totalcampos = ceil((@count($_SESSION['CAMPOSX'])+1)/4);
 if(@count($_SESSION['CAMPOSX'])+1 < 4) $totalc = count($_SESSION['CAMPOSX'])+1; else $totalc = 4; ///columnas minimas a mostrar

 $campos1[0] = 'Nombre';
 $alias[0] = 'nombre';
 $a=0;

	 for($j=0;$j<count($_SESSION['CAMPOSX']);$j++){

		 if(!is_numeric($_SESSION['CAMPOSX'][$j])){ ///para saber si son o  no adicionales

			 $alias[$j+1] = $_SESSION['CAMPOSX'][$j];
			 $campos1[$j+1]  = $_SESSION['CAMPOSX'][$j];

		 }else{

			 $adicionales2[$a] = $_SESSION['CAMPOSX'][$j];
			 $a++;
		 }

	 }


 $campos2 = @implode(",",$campos1);
 $datashow =  $campos2.',notas';



 ///////////FILTRO


  if(isset($_REQUEST['band'])){ ///si viene de la pagina de busquedas

	 if($_REQUEST['nombre1']!="") $filtroname = " and nombre LIKE '%{$_REQUEST['nombre1']}%' ";
	 if($_REQUEST['mail1']!="") $filtromail = " and email LIKE '%{$_REQUEST['mail1']}%' ";
	 if($_REQUEST['categoria1']!="") $filtrorigen = " and categoria1 = '{$_REQUEST['categoria1']}' ";
	 if($_REQUEST['categoria2']!="") $filtrocatego = " and categoria2 = '{$_REQUEST['categoria2']}' ";
	 if($_REQUEST['categoria3']!="") $filtrocatego = " and categoria3 = '{$_REQUEST['categoria3']}' ";
	 if($_REQUEST['categoria4']!="") $filtrocatego = " and categoria4 = '{$_REQUEST['categoria4']}' ";
	 if($_REQUEST['categoria5']!="") $filtrocatego = " and categoria5 = '{$_REQUEST['categoria5']}' ";
	 if($_REQUEST['empresa']!="") $filtroempresa = " and empresa LIKE '%{$_REQUEST['empresa']}%' ";
	 if($_REQUEST['telefono']!="") $filtrotlf = " and tlf1 LIKE '%{$_REQUEST['telefono']}%' ";
	 if($_REQUEST['celular']!="") $filtrocell = " and celular LIKE '%{$_REQUEST['celular']}%' ";
	 if($_REQUEST['profesion']!="") $filtroprofesion = " and profesion LIKE '%{$_REQUEST['profesion']}%' ";
	 if($_REQUEST['nivel']!="") $filtronivel = " and nivel LIKE '%{$_REQUEST['nivel']}%' ";
	 if($_REQUEST['estado']!="") $filtroedo = " and estado LIKE '%{$_REQUEST['estado']}%' ";
     if($_REQUEST['pais']!="") $filtropais = " and pais LIKE '%{$_REQUEST['pais']}%' ";
	 if($_REQUEST['ciudad']!="") $filtrocity = " and ciudad LIKE '%{$_REQUEST['ciudad']}%' ";
	 if($_REQUEST['intereses']!="") $filtrodir = " and intereses LIKE '%{$_REQUEST['intereses']}%' ";
	 if($_REQUEST['password']!="") $filtropassword = " and password LIKE '%{$_REQUEST['password']}%' ";

	 if(!empty($_REQUEST['estatus'])){

	 	if($_REQUEST['estatus']==1) $filtroe = " and activo = '{$_REQUEST['estatus']}' "; else $filtroe = " and activo != 1 ";

	  }
	 if(!empty($_REQUEST['origen']))  $filtroo = " and origen = '{$_REQUEST['origen']}' ";


	 $_SESSION['QUERYX'] = "select id,email,$datashow,
	  (select count(*) from orden_compra where cliente_id = c.id and estatus = 'nueva' ) as ordenesn,
	 (select count(*) from orden_compra where cliente_id = c.id ) as ordenes,
	 (select count(*) from pago where cliente_id = c.id and  estatus = 0) as pagosn,
	 (select count(*) from pago where cliente_id = c.id ) as pagos from cliente c where id >0 ";
	 $_SESSION['QUERYY'] = "select id from cliente where id >0 "; ///PARA LOS ADICIONALES
	 $_SESSION['QUERYX'].= $filtroname.$filtromail.$filtrorigen.$filtrocatego.$filtroempresa.$filtrotlf.$filtrocell.$filtroprofesion.$filtronivel.$filtroedo.$filtropais.$filtrocity.$filtrodir.$filtropassword.$filtroo.$filtroe;
	 $_SESSION['QUERYY'].= $filtroname.$filtromail.$filtrorigen.$filtrocatego.$filtroempresa.$filtrotlf.$filtrocell.$filtroprofesion.$filtronivel.$filtroedo.$filtropais.$filtrocity.$filtrodir.$filtropassword.$filtroo.$filtroe;
 }



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Resultados de la b&uacute;squeda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script language="JavaScript" type="text/JavaScript" src="../../SVsystem/js/utils.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--


function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function locateObject(n, d) { //v3.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=locateObject(n,d.layers[i].document); return x;
}


//-->
</script>

<script language="javascript">
		function CheckAll()
		{
	    	len = document.form1.elements.length;
	        var i;
	        for (i=0; i < len; i++)
			{
	        	if (document.form1.elements[i].checked==true)
				{
	        		document.form1.elements[i].checked=false;
	        	}else
				{
	        		document.form1.elements[i].checked=true;
	        	}
	        }
	   	}
	</script>

<script language="JavaScript" type="text/javascript">
function borrar(id,nombre){

  if (confirm("¿Esta seguro que desea borrar el contacto con el nombre "+nombre+" ?")) {

  location.replace('busquedac.php?delete='+id);

  }else{


  return false;

  }
}

function envio(valor){


valor2 = document.getElementById('orden1').value;

location.replace('busquedac.php?orden2='+valor+'&orden1='+valor2);

}





</script>


</head>

<body>

<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Resultados de la&nbsp; b&uacute;squeda de&nbsp; usuarios</div>
<div id="ninstrucciones">
<p>Este es el resultado de la  búsqueda de usuarios que usted realizó. Usted podrá <strong>realizar operaciones</strong> que afectan a uno, todos  o algunos de los usuarios que  están en esta página. Si desea excluir a alguno de ellos, desmárquelo en los controles del lado izquierdo de su Ficha.</p>


<p><strong>Recomendamos</strong> <a href="/admin/help/usuarios-categorias.php" target="_blank">organizar a&nbsp; sus usuarios en categor&iacute;as</a> para poder hacer un mejor uso de este sistema.</p>


</div>


<div id="ncontenido">

<?php

  //////////////////ejecuta la busqueda
  $query = $_SESSION['QUERYX'];



	//////////filtro sobre campos adicionales
	$adicionales = $datos->array_query("select nombre from campo where modulo = 'user' ");

	for($j=0;$j<count($adicionales);$j++){

			if(!empty($_REQUEST[$adicionales[$j]])){
					$valor4 = $_REQUEST[$adicionales[$j]];
					$query.= " and id in (select user_id from campo_user where valor LIKE '%$valor4%' ) ";

			}
	}///////////////////////////////////////////



  if(!empty($_REQUEST['orden1'])){

	  $_SESSION['ORDENP'] = $_REQUEST['orden1'];

  }else{

	  $_SESSION['ORDENP'] = 'id';
  }

   if(!empty($_REQUEST['orden2'])){

	  $_SESSION['ORDENP2'] = $_REQUEST['orden2'];

  }else{ $_SESSION['ORDENP2'] = ''; }


  if(isset($_REQUEST['orden1']) or isset($_REQUEST['orden2'])){


	  	$query.= " order by {$_SESSION['ORDENP']} {$_SESSION['ORDENP2']}";

  }





   ////////////campos normales

  $datos->query($query);

   //////////campo adicionales

    if($datos->nreg>0 and count($adicionales2)>0){


		$addi = implode(',',$adicionales2);

		$adic = $datos2->estructura_db("SELECT
								c.nombre,
								u.valor,
								u.user_id
							  FROM
								campo c
								INNER JOIN campo_user u ON (c.id = u.campo_id)
							  WHERE
								c.id IN ($addi) and
								u.user_id in ({$_SESSION['QUERYY']})");


	}



  if($datos->nreg>0){
  ?>


<div id="nbotonera" style="text-align:center; display:none;">

</div>


<form name="form1" id="form1" method="post" action="../opciones-sm.php">


  <table width="99%" border="0" cellspacing="0" cellpadding="0">

<tr>
    <td align="center">

<input name="button2" type="button" class="form-button" id="button2" onClick="if (confirm('&iquest;Esta seguro que desea activar los usuarios ?')){
  document.form1.action = 'activar.php'; document.form1.submit(); } " value="Dar Bienvenida a Seleccionados">



<a  href="../opciones-mensajes.php" target="_blank" class="instruccion" style="cursor:pointer"><img src="../icon/icon-info.gif" border="0"><span>Esta opción , ademas de activar a sus usuarios para que puedan acceder a su pagina privada, les envía el correo automático de Bienvenida al Usuario . Usted puede configurar el contenido de ese e-mail. Haga click en el ícono que despliega este mensaje (!) para configurar los Emails Automáticos</span></a>
      &nbsp;
<input name="button" type="button" class="form-button" id="button" onClick="if (confirm('¿Esta seguro que desea borrar los usuarios ?')){
  document.form1.action = 'borrarl.php'; document.form1.submit(); } " value="Borrar usuarios Seleccionados" style="display:none">
      &nbsp;
<input name="boton" type="button" class="form-button" id="boton" value="Enviar E-mail a Seleccionados"><a  class="instruccion"><img src="../icon/icon-info.gif" border="0"><span>Enviar Correo electrónico a usuarios seleccionados</span></a>

   &nbsp;  <input name="boton2" onClick="location.replace('index.php');" type="button" class="form-button" id="boton2" value="Volver a Buscar">

</td>
</tr>

    <tr>
      <td align="center" class="td-headertabla"><p >

       			  Seleccionar
       			  <select name="ordenar" class="form-box" id="ordenar" onChange="javascript:CheckAll();">
       			    <option selected>Todos</option>
       			    <option>Ninguno</option>
     			    </select>
       			  Ordenar por <?php echo $datos->combo_array ("orden1",$campos1,$campos1,"Id",$_SESSION['ORDENP'],"false",'',false,false,"form-box")?>

   En orden

     <?php

	 $o21[0] = "Decreciente";$o22[0] = "DESC";
	 $o21[1] = "Creciente";$o22[1] = "ASC";

	 echo $datos->combo_array ("orden2",$o21,$o22,"seleccione",$_SESSION['ORDENP2'],"envio(this.value);",'',false,false,"form-box")?>

&nbsp;  <a href="#" class="link-gris" onClick="popup('imprimir.php','imprime','595','1000');">Versi&oacute;n Imprimible <img src="../icon/icon-print.gif" width="16" height="14" border="0"></a></p>
    </td>
    </tr>





    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">

		<?php



		while ($row = mysql_fetch_assoc($datos->result)) {

		$i=0;
		$ii=0;
		?>


		<tr>
          <td class="bdc-td-registro-container"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="top">
              <td width="4%" class="bdc-td-botones-busquedac" >
<!--FUNCIONES PARA CADA CONTACTO-->

<a href="../opciones-sm.php?esolo=<?=$row['email'] ?>" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-mail.gif" width="16" height="16" border="0"> <span>Enviar Email a Este Usuario</span></a><br>

<a href="javascript:;" onClick="popup('editarc.php?ide=<?=$row["id"] ?>','editar','500','950');" class="instruccion" style="cursor:pointer;" ><img border="0" src="../icon/icon-edit.gif" width="16" height="16" > <span>Editar detalles de usuario</span></a><br>

<a href="javascript:;" onClick="popup('detallec.php?ide=<?=$row["id"] ?>','detalle','500','550');" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-lupa.gif" width="16" height="16" border="0" ><span>Ver detalles de este usuario</span></a><br>

<a href="javascript:;" onClick="borrar('<?=$row["id"] ?>','<?=$row["Nombre"] ?>');" class="instruccion" style="cursor:pointer;"><img src="../icon/icon-delete.gif" width="16" height="16" border="0"> <span>Borrar este usuario. ACCION IRREVERSIBLE</span></a><br>

<input name="too[]" type="checkbox" id="too[]" value="<?=$row["id"] ?>" checked>
<!--FIN FUNCIONES PARA CADA CONTACTO-->
</td>

<td width="96%"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#E8ECEC">

				<?php while($ii<$totalcampos){ ?>
				 <tr>

                   <?php for($w=0;$w<$totalc;$w++){

				   if($alias[$i]=="nombre"){
					?>
				   <td width="32%" class="bdc-span-nombre-listado">
                   <a href="javascript:;" onClick="popup('detallec.php?ide=<?=$row["id"] ?>','detalle','500','550');" class="instruccion"   style="cursor:pointer;"><?php echo $row[$campos1[$i]]?> <span>Click en el nombre para ver detalles de este usuario</span></a>
                   <?php if($row['ordenesn']>0){ ?><a href="../productos/ordenes.php?iduser=<?=$row["id"] ?>"  class="instruccion"   style="cursor:pointer;"><img border="0" src="../icon/icon-user-orden-nueva.gif" width="15" height="15"  align="absmiddle"> <font size="1" style="normal" >(<?php echo $row['ordenesn'] ?>)</font>  <span>Este usuario tiene órdenes de compra NUEVAS que usted no ha revisado!</span>      </a>


				   <?php }else if($row['ordenes']>0){ ?><a href="../productos/ordenes.php?iduser=<?=$row["id"] ?>"  class="instruccion"  style="cursor:pointer;"><img border="0" src="../icon/icon-user-ordenes.gif" width="15" height="15" align="absmiddle">  <font size="1"  style="normal"> (<?php echo $row['ordenes'] ?>)  </font>  <span>Órdenes de compra que ha realizado este usuario</span></a><?php } ?>&nbsp;

                   <?php if($row['pagosn']>0){ ?><a href="../pagos/main.php?iduser=<?=$row["id"] ?>" class="instruccion"  style="cursor:pointer;" ><img border="0" src="../icon/icon-user-pago-nuevo.gif" width="15" height="15" align="absmiddle">  <font size="1" style="normal">(<?php echo $row['pagosn'] ?>)</font> <span>Este usuario ha realizado pagos NUEVOS que  usted no ha revisado!</span></a>

                    <?php }else if($row['pagos']>0){ ?><a href="../pagos/main.php?iduser=<?=$row["id"] ?>" class="instruccion"  style="cursor:pointer;" ><img border="0" src="../icon/icon-user-pagos.gif" width="15" height="15" align="absmiddle"> <font size="1" style="normal">(<?php echo $row['pagos'] ?>) </font> <span>Pagos realizados por este usuario</span></a><?php } ?>
                   </td>
					<?php

					}else if(!empty($row[$campos1[$i]])){
					?>
					  <td width="25%" class="bdc-td-dato-listado"><strong><?=$alias[$i] ?>:&nbsp</strong><?=$row[$campos1[$i]]?></td>

					<?


					}


					 $i++;

					 }

					  ?>
              </tr>

			   <?php $ii++;

			   }


			   ////////escribe campos adicionales

			   for($jj=0;$jj<count($adic);$jj++){


				   if($adic[$jj]['user_id']==$row["id"] and !empty($adic[$jj]['valor'])){

					  ?>
					  <td width="25%" class="bdc-td-dato-listado"><strong><?=$adic[$jj]['nombre']?>:&nbsp</strong><?=$adic[$jj]['valor']?></td>
					<?

				   }


			   }


			   ?>

</table>
<!--notas-->
<?php if(!empty($row['notas'])){ ?>
<div class="bdc-div-notas"><strong>Notas del admin:</strong> <?=$row['notas'] ?></div>
<?php } ?>
<!--fin notas-->

</td>
</tr>


</table></td>
      </tr>


		<?php

		}

		?>
      </table></td>
    </tr>

<tr>
      <td align="center" class="td-headertabla"><p >

       			  Seleccionar
       			  <select name="ordenar" class="form-box" id="ordenar" onChange="javascript:CheckAll();">
       			    <option selected>Todos</option>
       			    <option>Ninguno</option>
     			    </select>
       			  Ordenar por <?php echo $datos->combo_array ("orden1",$campos1,$campos1,"Id",$_SESSION['ORDENP'],"false",'',false,false,"form-box")?>

   En orden

     <?php

	 $o21[0] = "Decreciente";$o22[0] = "DESC";
	 $o21[1] = "Creciente";$o22[1] = "ASC";

	 echo $datos->combo_array ("orden2",$o21,$o22,"seleccione",$_SESSION['ORDENP2'],"envio(this.value);",'',false,false,"form-box")?>

&nbsp;  <a href="#" class="link-gris" onClick="popup('imprimir.php','imprime','595','1000');">Versi&oacute;n Imprimible <img src="../icon/icon-print.gif" width="16" height="14" border="0"></a></p>
    </td>
    </tr>




    <tr>
    <td align="center">

<input name="button2" type="button" class="form-button" id="button2" onClick="if (confirm('&iquest;Esta seguro que desea activar los usuarios ?')){
  document.form1.action = 'activar.php'; document.form1.submit(); } " value="Dar Bienvenida Seleccionados"><a  href="../opciones-mensajes.php" target="_blank" class="instruccion" style="cursor:pointer"><img src="../icon/icon-info.gif" border="0"><span>Esta opción , ademas de activar a sus usuarios para que puedan acceder a su pagina privada, les envía el correo automático de Bienvenida al Usuario . Usted puede configurar el contenido de ese e-mail. Haga click en el ícono que despliega este mensaje (!) para configurar los Emails Automáticos</span></a>
      &nbsp;
<input name="button" type="button" class="form-button" id="button" onClick="if (confirm('¿Esta seguro que desea borrar los usuarios ?')){
  document.form1.action = 'borrarl.php'; document.form1.submit(); } " value="Borrar usuarios Seleccionados" style="display:none">
      &nbsp;
<input name="boton" type="submit" class="form-button" id="boton" value="Enviar E-mail a Seleccionados"><a  class="instruccion"><img src="../icon/icon-info.gif" border="0"><span>Enviar Correo electrónico a usuarios seleccionados</span>&nbsp;</a>

   &nbsp;
   <input name="boton3" type="button" class="form-button" id="boton3" onClick="document.form1.action = 'usuarios-fastedit.php'; document.form1.submit();"  value="Fastedit de seleccionados" /><input name="boton2" onClick="history.back();" type="button" class="form-button" id="boton2" value="Volver a Buscar">



</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>


  </form>
 



 <?php }else{ ?>

<div style="text-align:center;">
<p style="font-size:20px; font-family:calibri,arial,helvetica; color:#F30">No se encontraron resultados para la búsqueda realizada</p>
<input name="boton" onClick="location.replace('index.php');" type="button" class="form-button" id="boton" value="Volver a buscar">
</div>
  <?php } ?>








<!-- termina ncontenido -->
</div>

<div id="nnavbar"><?php include "n-include-menu.php"?></div>

</div>
</div>
<?php include ("../n-footer.php")?>
<?php // include ("../n-include-mensajes.php")  NO SIRVE EN ESTA PAGINAAAAAA ?>


























































<!--END INCLUDES-->
</body>
</html>
<?php $datos->cerrar();

/*unset($_SESSION['ORDENP'] );
unset($_SESSION['ORDENP2'] );*/


?>