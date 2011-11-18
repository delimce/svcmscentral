<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

include("security.php");


 $datos = new formulario('db');
 $fecha = new fecha("d/m/Y");


 if(isset($_GET['ide'])){

	 $_datos1 = $datos->simple_db("select * from cliente where id = {$_GET['ide']} ");
	 $_SESSION['USERACTUAL'] = $_GET['ide'];

 }




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Editar informacion de usuario</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript" src="../../SVsystem/js/scripts.js"></script>

<script language="JavaScript" type="text/javascript" src="../../SVsystem/js/ajax.js"></script>
<script language="JavaScript" type="text/JavaScript" src="../../SVsystem/js/utils.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--


function locateObject(n, d) { //v3.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=locateObject(n,d.layers[i].document); return x;
}


//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
function borrar(id,nombre){

  if (confirm("¿Esta seguro que desea borrar el contacto con el nombre "+nombre+" ?")) {

  location.replace('busquedac.php?delete='+id);

  }else{


  return false;

  }
}

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
      if (t==1){ //fromto
        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
      } else if (t==2){
        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
      } else if (t==3){ // date
        ma=a[i+1].split("#");at=v.match(ma[0]);
        if(at){
          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
          dte=new Date(cy,cm,cd);
          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
        }else{err=true}
      } else if (t==4){ // time
        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
      } else if (t==5){ // check this 2
            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!o1.checked){err=true}
      } else if (t==6){ // the same
            if(v!=MM_findObj(a[i+1]).value){err=true}
      }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
          at = a[i].match(/(.*)\[(\d+)\].*/i);
          o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+s)}
  document.MM_returnValue = (s=='');
}
//-->
</script>


<!--javascript para el editor . agregado por rafael-->

<script type="text/javascript" src="../../SVsystem/editor/tiny_mce.js"></script>

<script language="javascript" type="text/javascript">
<!--
tinyMCE.init({
	mode : "exact",
	elements : "r_notas",
	theme : "advanced",
	plugins : "style,layer,table,charmap,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable",
	language: "es",
	theme_advanced_buttons1_add_before : "newdocument,preview,separator,cut,copy,paste,undo,redo,separator,bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator",
	theme_advanced_buttons1 : ",outdent,indent,bullist,numlist,separator,forecolor,backcolor",
	theme_advanced_buttons2 : "",
	plugin_insertdate_dateFormat : "<?=$_SESSION['DB_FORMATO_DB']?> ",
	plugin_insertdate_timeFormat : "%H:%M:%S",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	content_css : "example_word.css",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"

	});

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<!--javascript para el editor . agregado por rafael-->

<script type="text/javascript" src="../../SVsystem/js/calendario/calendar.js"></script>
<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-es.js"></script>
<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-setup.js"></script>
<script type="text/javascript" src="../../SVsystem/js/popup.js"></script>
<LINK href="../../SVsystem/js/calendario/calendario.css" type=text/css rel=stylesheet>



</head>

<body>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td class="td-titulo1">editar informaci&Oacute;n de usuario</td>
     </tr>
     <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
       <tr>
        <td class="td-texto1"><p>Llene los campos del formulario para agregar/editar su contacto.</p></td>
       </tr>

       <tr>
<!--aqui va la accion-->
        <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>

	<?php


	if(isset($_POST['Submit'])){



				if($_POST['nc1']=="1")$_POST['r_categoria1'] = $_POST['nc1v'];
				if($_POST['nc2']=="1")$_POST['r_categoria2'] = $_POST['nc2v'];
				if($_POST['nc3']=="1")$_POST['r_categoria3'] = $_POST['nc3v'];
				if($_POST['nc4']=="1")$_POST['r_categoria4'] = $_POST['nc4v'];
				if($_POST['nc5']=="1")$_POST['r_categoria5'] = $_POST['nc5v'];

				if($_POST['r_activo']!=1){

					$_POST['r_activo'] = 0;

				}

				/*
						//////envio de corrreo activo

						  $dataemail3 = $datos->simple_db("select soporte_email,nombre_empresa,subject_users_registro_activo, users_registro_activo from preferencias");

						  $original  = array('$usern', '$usere', '$claven');
						  $reemplazo = array($_POST['r_nombre'], $_POST['r_email'],$_POST['r_password']);

						  $email_subject = str_replace($original, $reemplazo, $dataemail3['subject_users_registro_activo']);
						  $email_content = str_replace($original, $reemplazo, $dataemail3['users_registro_activo']);

						  $headers  = 'MIME-Version: 1.0' . "\r\n";
						  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

						  // colocando el from
						  $headers .= "From: {$dataemail3['nombre_empresa']} < {$dataemail3['soporte_email']} >" . "\r\n";

						  ////////enviando correo
						  if(!mail($_POST['r_email'], $email_subject, $email_content, $headers)){
							  $datos->javaviso("No se pudo enviar el correo","editarc.php");

						  }

						//////////////////


				*/
//  echo 'fecha: '.$_POST['r_fechan'];
//				$_POST['r_fechan'] = $fecha->fecha_db($_POST['r_fechan']) ;
//  echo 'fecha: '.$_POST['r_fechan'];
  			$datos->update_data("r","_","cliente",$_POST,"id = '{$_POST['ide2']}'");


					///////////////guardando campos adicionales
						 if(count($_POST['camposid'])>0){

						 		$datos->query("delete from campo_user where user_id = '{$_POST['ide2']}' ");
								foreach($_POST['camposid'] as $i => $value){

									$vector9[0] = $_REQUEST['ide2'];
									$vector9[1] = $_POST['camposid'][$i];
									$vector9[2] = $_POST['camposa'][$i];

									$datos->insertar2("campo_user","user_id,campo_id,valor",$vector9);

								}


						 }//////////////

						  for($i2=0;$i2<count($_SESSION['ARCHIVOS']);$i2++){

									$vectora[0] = $_REQUEST['ide2'];
									$vectora[1] = $_SESSION['ARCHIVOS'][$i2];
									$vectora[2] = $_SESSION['ADESCRIP'][$i2];

									$datos->insertar2("cliente_archivo","cliente_id,ruta,descrip",$vectora);

						 }





				$datos->javaviso("Contacto editado con exito. Si desea ver los nuevos datos, recargue la pagina","autocierre.php");
				unset($_SESSION['USERACTUAL']);

	}else if(isset($_POST['Submit3'])){


			$datos->insert_data("r","_","cliente",$_POST);



			for($i2=0;$i2<count($_SESSION['ARCHIVOS']);$i2++){

									$vectora[0] = $datos->ultimoID;
									$vectora[1] = $_SESSION['ARCHIVOS'][$i2];
									$vectora[2] = $_SESSION['ADESCRIP'][$i2];

									$datos->insertar2("cliente_archivo","cliente_id,ruta, descrip",$vectora);

			  }
			unset($_SESSION['USERACTUAL']);
			unset($_SESSION['ARCHIVOS']);
			unset($_SESSION['ADESCRIP']);

				$datos->javaviso("Contacto replicado con exito. Recargue la página manualmente para ver el contacto duplicado","autocierre.php");



	}else{

			 $_SESSION['ARCHIVOS'] = array();
			 $_SESSION['ADESCRIP'] = array();

	?>



	  <form action="" method="post" name="form1" onSubmit="YY_checkform('form1','r_nombre','#q','0','Debe escribir un  Nombre','r_email','S','2','El Email debe ser Válido');return document.MM_returnValue">
								<table width="100%" border="0" cellspacing="3" cellpadding="0">



									<tr>
									 <td width="30%" class="bdc-form-title">Grupo 1</td>
										<td width="79%"><span class="bdc-span-nombre-listado">
										  <?php   echo $datos->combo_db ("r_categoria1","select nombre from cliente_categoria where grupo='1'","nombre","nombre","Seleccionar",$_datos1['categoria1'],false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?>
									  &nbsp;</span></td>
									</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Grupo 2</td>
										<td width="79%"><span class="bdc-span-nombre-listado">
										  <?php   echo $datos->combo_db ("r_categoria2","select nombre from cliente_categoria where grupo='2'","nombre","nombre","Seleccionar",$_datos1['categoria2'],false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?>
										</span></td>
						  </tr>




									<tr>
									 <td style="vertical-align: top;" class="bdc-form-title">Grupo 3</td>
										<td style="vertical-align: top;"><span class="bdc-span-nombre-listado">
										  <?php   echo $datos->combo_db ("r_categoria3","select nombre from cliente_categoria where grupo='3'","nombre","nombre","Seleccionar",$_datos1['categoria3'],false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?>
										</span></td>
									</tr>
									<tr>
									 <td style="vertical-align: top;" class="bdc-form-title">Grupo 4</td>
										<td style="vertical-align: top;"><span class="bdc-span-nombre-listado">
										  <?php   echo $datos->combo_db ("r_categoria4","select nombre from cliente_categoria where grupo='4'","nombre","nombre","Seleccionar",$_datos1['categoria4'],false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?>
										</span></td>
									</tr>
									<tr>
									 <td style="vertical-align: top;" class="bdc-form-title">Grupo 5</td>
										<td style="vertical-align: top;"><span class="bdc-span-nombre-listado">
										  <?php   echo $datos->combo_db ("r_categoria5","select nombre from cliente_categoria where grupo='5'","nombre","nombre","Seleccionar",$_datos1['categoria5'],false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?>
										</span></td>
									</tr>
									<tr>
									  <td style="vertical-align: top;">&nbsp;</td>
									  <td style="vertical-align: top;">&nbsp;</td>
						  </tr>

                                     <?php

										///campos adicionales

										  $vcampos = $datos->estructura_db("select campo_id,valor from campo_user where user_id = '{$_GET['ide']}' ");
										  $datos->query("select id,nombre,tipo,longitud,lineas,valores from campo where modulo = 'user' order by orden");


											 while ($row2 = mysql_fetch_assoc($datos->result)) {


												 $valorc2 = $datos->buscar_estructdb($vcampos,'campo_id',$row2['id'],'valor'); ///buscando el valor


												 ?>

											 <tr>
											  <td width="30%" style="vertical-align: top;" class="bdc-form-title"><?php echo $row2['nombre'] ?></td>
											  <td width="79%">
											  <?php

											  if($row2['tipo']=='texto'){
												  echo '<input style="vertical-align: top;" class="form-box" id="camposa[]" name="camposa[]" value="'.$valorc2.'" type="text" size="'.$row2['longitud'].'">';

											  }else if($row2['tipo']=='textarea'){

											  	echo '<textarea  class="form-box" name="camposa[]" id="camposa[]" cols="'.$row2['longitud'].'" rows="'.$row2['lineas'].'">'.$valorc2.'</textarea>';

											  }else{

												  $valorc = explode(",",$row2['valores']);
												  echo $datos->combo_array ("camposa[]",$valorc,$valorc,'Seleccionar',$valorc2,false,'no',false,false,"form-box");

											  }

											  echo '<input name="camposid[]" type="hidden" id="camposid[]" value="'.$row2['id'].'" />';
											  ?>

											  </td>
											</tr>

											<?


										  }


									?>


									<tr>
									  <td style="vertical-align: top;">&nbsp;</td>
									  <td style="vertical-align: top;">&nbsp;</td>
						  </tr>
									<tr>
									 <td class="bdc-form-title">CI-RIF</td>
										<td><input name="r_rif" type="text" class="form-box"
											id="r_rif" value="<?=$_datos1['rif'] ?>" size="15"></td>
									</tr>
									<tr>
									 <td width="30%" class="bdc-form-title">Nombre</td>
										<td width="79%"><input name="r_nombre" type="text"
											class="form-box" value="<?=$_datos1['nombre'] ?>" size="50"></td>
									</tr>

									<tr>
									 <td width="30%" class="bdc-form-title">Empresa</td>
										<td width="79%"><input name="r_empresa" type="text"
											class="form-box" value="<?=$_datos1['empresa'] ?>" size="50"></td>
									</tr>
									<tr>
									 <td class="bdc-form-title">Actividad a la que se dedica </td>
									  <td><input name="r_actividad" type="text"
											class="form-box" id="r_actividad" value="<?=$_datos1['actividad'] ?>" size="60"></td>
						  </tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Cargo</td>
										<td width="79%"><input name="r_cargo" type="text"
											class="form-box" value="<?=$_datos1['cargo'] ?>" size="45"></td>
									</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Email</td>
										<td width="79%"><input name="r_email" type="text"
											class="form-box" value="<?=$_datos1['email'] ?>" size="45"></td>
									</tr>
									<tr>
									  <td class="bdc-form-title">Email2</td>
									  <td><input name="r_email2" type="text"
											class="form-box" value="<?=$_datos1['email2'] ?>" size="45"></td>
								  </tr>
									<tr>
									 <td class="bdc-form-title">Password</td>
									  <td><input name="r_password" type="password"
											class="form-box" id="r_password" value="<?=$_datos1['password'] ?>" size="20"></td>
						  </tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Telefono</td>
										<td width="79%"><input name="r_tlf1" type="text"
											class="form-box" id="r_tlf1" value="<?=$_datos1['tlf1'] ?>" size="30"></td>
									</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Celular</td>
										<td width="79%"><input name="r_celular" type="text"
											class="form-box" value="<?=$_datos1['celular'] ?>" size="30"></td>
									</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Fax</td>
										<td width="79%"><input name="r_fax" type="text"
											class="form-box" value="<?=$_datos1['fax'] ?>" size="30"></td>
									</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Ciudad</td>
										<td width="79%"><input name="r_ciudad" type="text"
											class="form-box" value="<?=$_datos1['ciudad'] ?>" size="30"></td>
									</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Estado</td>
										<td width="79%"><input name="r_estado" type="text"
											class="form-box" value="<?=$_datos1['estado'] ?>" size="30"></td>
									</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">País</td>
										<td width="79%"><input name="r_pais" type="text"
											class="form-box" value="<?=$_datos1['pais'] ?>" size="45"></td>
									</tr>





									<tr>
									 <td width="30%" class="bdc-form-title">Codigo postal / ZIP</td>
										<td width="79%"><input name="r_zip" type="text"
											class="form-box" value="<?=$_datos1['zip'] ?>" size="10"></td>
									</tr>
									<tr>
									  <td class="bdc-form-title">Fecha de Nacimiento</td>
									  <td><span class="bdc-span-nombre-listado"><?= $fecha->switchfecha($_datos1['fechan']) ?></span></td>
<!--
                                                                          <input name="r_fechan" type="text" class="form-box" id="r_fechan" OnFocus="this.blur()" onClick="alert('usar el boton del calendario para llenar este campo')" value="<?php echo $fecha->switchfecha($_datos1['fechan']);  ?>" size="10" readonly="readonly">
                                        <img src="../icon/cal.gif" width="16" height="16" id="f_trigger_d" style="cursor: hand; border: 0px;" title="seleccionar fecha">
                                      <script type="text/javascript">
					Calendar.setup({
						inputField     :    "r_fechan",     // id of the input field
						ifFormat       :    "<?=strtolower("d/m/Y")?>",    // format of the input field
						button         :    "f_trigger_d",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				                        </script></td>
-->
								  </tr>

									<tr>
									 <td class="bdc-form-title">Usuario Activo? <a href="javascript:;" onClick="MM_openBrWindow('../help/usuarioactivo.php','','scrollbars=yes,resizable=yes,width=500,height=500')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
									 <td><input name="r_activo" type="checkbox" id="r_activo"
											value="1" <?php if($_datos1['activo']==1) echo "checked"; ?>></td>
									</tr>




									<tr>
										<td width="30%" class="bdc-form-title">Direccion</td>
										<td width="79%"><textarea name="r_direccion" cols="125"
											class="form-box"><?=$_datos1['direccion'] ?>
										</textarea></td>
									</tr>




									<tr>
										<td width="30%" class="bdc-form-title">Mensajes del admin al usuario:<font size="1"> <br>
										Lo que usted escriba aqui es lo primero que el usuario
										ver&aacute; cuando	se	loguea	en	el	sitio web.</font></td>
										<td width="79%"><textarea name="r_notas" cols="125" rows="30" wrap="VIRTUAL"
											class="form-box"><?=$_datos1['notas'] ?>
										</textarea></td>
									</tr>




									<tr>
									  <td class="bdc-form-title">Archivos adjuntos:<font size="1"> <br>
								      Aqu&iacute; usted podr&aacute; cargar los archivos que desea que visualice este
								        usuario en su p&aacute;gina privada (Userhome). <br>
			        El tama&ntilde;o m&aacute;ximo de
								        los archivos que puede colocar es de 5mb.<br>
								        NO use MAYUSCULAS en la descripci&oacute;n de sus archivos.<br>
								        La integridad de sus archivos queda enteramente bajo su responsabilidad.</font></td>
									  <td colspan="2"><iframe id="archivos" src="archivos.php" height="400" width="100%" frameborder="0"></iframe></td>
						  </tr>
									<tr>
										<td class="bdc-form-title"><input name="ide2" type="hidden" value="<?=$_GET['ide'] ?>"></td>
									  <td colspan="2"><input name="Submit" type="submit" class="form-button" value="Guardar">
                                        <input name="Submit3" type="submit" class="form-button" value="Guardar Duplicado">
                                        <input name="Submit2" type="button" class="form-button" onClick="window.close();" value="Cancelar">           </td>
        </tr>
								</table>
						</form>





	  <?php

	  }

	  ?>


	  </td>
    </tr>
  </table></td>
        <!--aquí termina la acción-->
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
      </table>
      </td>
     </tr>
     <tr>
      <td align="center" bgcolor="#E5ECFA"><a href="http://www.proyecto-internet.com" target="_blank"><font size="1">Proyecto Internet</font></a><font size="1">&nbsp;</font></td>
     </tr>
    </table></td>
  </tr>
</table>
</body>
</html>