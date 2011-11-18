<?php session_start();

include("SVsystem/config/dbconfig.php"); ////////setup
include("SVsystem/class/formulario.php");
include("SVsystem/class/fecha.php");

$fecha = new fecha("d/m/Y");

$tool = new formulario();
$tool->autoconexion();


	if(isset($_POST['r_email'])){
		
		$_SESSION['CLIENTE_NOMBRE'] = $_POST['r_nombre']; 
		
		$_POST['r_fechan']  = $fecha->fecha_db($_POST['r_fechan']);
		
		$tool->update_data('r','_','cliente',$_POST,"id = '{$_SESSION['CLIENTE_ID']}'");
		
		
		///////////////guardando campos adicionales
						 if(count($_POST['camposid'])>0){
						 
						 		$tool->query("delete from campo_user where user_id = '{$_SESSION['CLIENTE_ID']}' ");
								foreach($_POST['camposid'] as $i => $value){
									
									$vector9[0] = $_SESSION['CLIENTE_ID'];
									$vector9[1] = $_POST['camposid'][$i];
									$vector9[2] = $_POST['camposa'][$i];
									
									$tool->insertar2("campo_user","user_id,campo_id,valor",$vector9);
								
								}		
									
						 
						 }//////////////
		
		
		$tool->javaviso('Sus datos han sido modificados con exito');
		
		?>
         <script language="JavaScript" type="text/JavaScript">
					   window.opener.location.reload(); window.close();
		   </script>
        <?

	}else{
	
		$_datos = $tool->simple_db("select *,popup_style from cliente,preferencias where id = '{$_SESSION['CLIENTE_ID']}'");
		
		$fecha = explode('-',$_datos['fechan']);
		$fecha2 = $fecha[2].'/'.$fecha[1].'/'.$fecha[0];
		
	
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Modificar sus datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="http://www.svcmscentral.com/estilos-popups/<?php echo $_datos['popup_style'] ?>" rel="stylesheet" type="text/css">


<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}


//-->
</script>


<script language="JavaScript" type="text/javascript">
		  function validar(){
		  
		  
		 // var login2 = document.form1.login12.value;
		 // var i;
		 
		    if (document.form1.r_nombre.value == ''){
			   alert("Por favor ingrese su nombre");
			   document.form1.r_nombre.focus();
			   return (false);
			 }	
			 
			 
			  if (document.form1.r_rif.value == ''){
			   alert("Por favor ingrese su CI o Rif ");
			   document.form1.r_rif.focus();
			   return (false);
			 }
			 
			 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.form1.r_email.value)==false){
			  alert("Su dirección de correo es invalida");
			  document.form1.r_email.focus();
			  return (false);
			 }
			 
			 
			 if (document.form1.r_password.value.length < 5){
			   alert("El password debe ser mayor de 5 caracteres");
			   document.form1.r_password.focus();
			   return (false);
			 }
			 
			 
					 
			 if (document.form1.r_password.value != document.form1.password.value){
			   alert("la confirmación del password no coincide con el original");
			   document.form1.password.focus();
			   return (false);
			 }
			 
			 			 
			  if (document.form1.r_tlf1.value == ''){
			   alert("Por favor ingrese su telefono de contacto");
			   document.form1.r_tlf1.focus();
			   return (false);
			 }	
			 
			 
			 return (true);   
					 			 			 
			   
		   }
</script>


</head>

<body class="body-popup">
<div class="popup-titulo">Actualice sus datos</div>
<div class="popup-instrucciones">
En caso que alg&uacute;n dato haya cambiado aqui puede modificarlo, por favor trate de&nbsp; completar todos los campos para que&nbsp; podamos atenderle mejor.</div>

<form action="" method="post" name="form1" onSubmit="return validar();">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td align="center">
   <table width="90%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="26%" class="popup-form-title">Nombre y Apellido</td>
     <td width="76%"><input name="r_nombre" type="text"
											class="popup-form-box" value="<?=$_datos['nombre'] ?>" size="50">
     </td>
    </tr>
    <tr>
     <td class="popup-form-title">E - mail</td>
     <td><input name="r_email" type="text"
											class="popup-form-box" value="<?=$_datos['email'] ?>" size="45">
     </td>
    </tr>
    <tr>
     <td class="popup-form-title">Modifique su contrase&ntilde;a</td>
     <td><input name="r_password" type="password"
											class="popup-form-box" id="r_password" value="<?=$_datos['password'] ?>" size="20">
     </td>
    </tr>
    <tr>
     <td class="popup-form-title">Repita su contrase&ntilde;a</td>
     <td><input name="password" type="password"
											class="popup-form-box" id="password" value="<?=$_datos['password'] ?>" size="20"></td>
    </tr>
    <tr>
      <td class="popup-form-title">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    
    
  <?php 
		  
			  ///campos adicionales
		  
				$vcampos = $tool->estructura_db("select campo_id,valor from campo_user where user_id = '{$_SESSION['CLIENTE_ID']}' ");
				$tool->query("select id,nombre,tipo,longitud,lineas,valores from campo where modulo = 'user' order by orden");
				  
		  
				   while ($row2 = mysql_fetch_assoc($tool->result)) {
					   
					   
					   $valorc2 = $tool->buscar_estructdb($vcampos,'campo_id',$row2['id'],'valor'); ///buscando el valor


					   ?>
					   
				   <tr>
					<td width="27%" style="vertical-align: top;" class="popup-form-title"><?php echo $row2['nombre'] ?></td>
					<td width="73%">
					<?php 
					
					if($row2['tipo']=='texto'){
						echo '<input style="vertical-align: top;" class="popup-form-box" id="camposa[]" name="camposa[]" value="'.$valorc2.'" type="text" size="'.$row2['longitud'].'">';
						
					}else if($row2['tipo']=='textarea'){
					
					  echo '<textarea  class="popup-form-box" name="camposa[]" id="camposa[]" cols="'.$row2['longitud'].'" rows="'.$row2['lineas'].'">'.$valorc2.'</textarea>';
					
					}else{
						
						$valorc = explode(",",$row2['valores']);
						echo $tool->combo_array ("camposa[]",$valorc,$valorc,'Seleccionar',$valorc2,false,'no',false,false,"popup-form-box");
						
					}
					
					echo '<input name="camposid[]" type="hidden" id="camposid[]" value="'.$row2['id'].'" />';
					?>
					
					</td>
				  </tr>
				  
				  <?
				
					
				}
		  
		  
		  ?>
    
    
    
    
    
    <tr>
      <td class="popup-form-title">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
     <td class="popup-form-title">Tel&eacute;fonos fijos (hab. ofic, fax...)</td>
     <td><input name="r_tlf1" type="text"
											class="popup-form-box" id="r_tlf1" value="<?=$_datos['tlf1'] ?>" size="30">
     </td>
    </tr>
    <tr>
     <td class="popup-form-title">Celular</td>
     <td><input name="r_celular" type="text"
											class="popup-form-box" value="<?=$_datos['celular'] ?>" size="30">
     </td>
    </tr>
    <tr>
     <td class="popup-form-title">Ciudad donde vive</td>
     <td><input name="r_ciudad" type="text"
											class="popup-form-box" value="<?=$_datos['ciudad'] ?>" size="30">
     </td>
    </tr>
    <tr>
     <td class="popup-form-title">Pa&iacute;s</td>
     <td><input name="r_pais" type="text"
											class="popup-form-box" id="r_pais" value="<?=$_datos['pais'] ?>" size="30">
     </td>
    </tr>
    <tr>
     <td class="popup-form-title">Empresa</td>
     <td><input name="r_empresa" type="text"
											class="popup-form-box" value="<?=$_datos['empresa'] ?>" size="50">
     </td>
    </tr>
    <tr>
    <td class="popup-form-title">Web de Su Empresa</td>
    <td><input name="r_web" type="text"
											class="popup-form-box" value="<?=$_datos['web'] ?>" size="50"></td>
    </tr>
    <tr>
    <td class="popup-form-title">Rif de su Empresa</td>
    <td><input name="r_rif" type="text" class="popup-form-box"
											id="r_rif" value="<?=$_datos['rif'] ?>" size="15"></td>
    </tr>
    <tr>
     <td class="popup-form-title"> Direcci&oacute;n Fiscal</td>
     <td><textarea name="r_direccion" cols="50" rows="3" wrap="VIRTUAL"
											class="popup-form-box"><?=$_datos['direccion'] ?>
										</textarea>
     </td>
    </tr>
   </table></td>
  </tr>
  <tr>
   <td align="center">&nbsp;</td>
  </tr>
  <tr>
   <td width="50%" align="center"><input name="Submit" type="submit" class="popup-form-button" value="Guardar Información">
   &nbsp; 
   
   <input name="Submit2" type="button" class="popup-form-button" value="Cancelar" onClick="window.close();"></td></tr>
 </table>
</form>
</body>
</html>
