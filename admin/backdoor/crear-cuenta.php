<?php session_start();

include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
require("security.php"); //////// solo accesible para administradores


$tool = new formulario();
$tool->autoconexion();

	if(isset($_POST['r-titulo'])){


			$_POST['r-fecha_creada'] = date("Y-m-d");
			$dirimagen = trim($_POST['r-dirserver']);

						/*****crear el DIR de la imagen en SVsitefiles ******/
							mkdir ('../../SVsitefiles/'.$dirimagen, 0777);
							/******banner ***/
							mkdir ('../../SVsitefiles/'.$dirimagen.'/banner', 0777);
							/******categorias ***/
							mkdir ('../../SVsitefiles/'.$dirimagen.'/categoria', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/categoria/turn', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/categoria/orig', 0777);
							/******producto ***/
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/doc', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/med', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/orig', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/turn', 0777);
							/******producto ***/
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/doc', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/med', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/orig', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/producto/turn', 0777);
							/******contenido ***/
							mkdir ('../../SVsitefiles/'.$dirimagen.'/contenido', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/contenido/doc', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/contenido/med', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/contenido/orig', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/contenido/turn', 0777);
							///////////usuarios
							mkdir ('../../SVsitefiles/'.$dirimagen.'/usuario', 0777);
							mkdir ('../../SVsitefiles/'.$dirimagen.'/usuario/doc', 0777);


			$tool->insert_data("r","-","cuenta",$_POST);

			$tool->cerrar();

			?>
             <script language="javascript">

					window.opener.location.reload();
					window.close();

			</script>

            <?

	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>



<title>crear / editar cuenta cliente</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../SVsystem/js/ajax.js"></script>

<script language="JavaScript" type="text/javascript">
function traerip() {

  	oXML = AJAXCrearObjeto();
	oXML.open('post', 'buscarip.php');
	oXML.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	oXML.onreadystatechange = function(){
		if (oXML.readyState == 4 && oXML.status == 200) {

			 document.getElementById('r-dbserver').value = oXML.responseText;

				vaciar(oXML);

		}
	 }

	oXML.send('url='+document.getElementById('r-url').value);

 }
 
 
 
 function autocompleta() {
	 
	 var may,nombre;
	 
	 nombre = document.getElementById('r-dirserver').value;

	if(nombre==''){
	
		alert("Debe escribir un nombre de carpeta de archivos");
		
		return false;
		
	}
	
	document.getElementById('r-dbuser').value = nombre+'_admin';
	may = nombre.toUpperCase();
	document.getElementById('r-dbpass').value = may+'2003';
	document.getElementById('r-dbname').value = nombre+'_db';
	
	

 }
 
 
  function validar(){
	  
	  if(document.getElementById('r-titulo').value==''){
		  
		  alert("Error: debe escribir un nombre para la cuenta");
		  document.getElementById('r-titulo').focus();
		  
		  return false;
		  
	  }
	  
	  
	   if(document.getElementById('r-dirserver').value==''){
		  
		  alert("Error: debe colocar una CARPETA DE ARCHIVOS ");
		  document.getElementById('r-dirserver').focus();
		  
		  return false;
		  
	  }
	  
	  
	   if(document.getElementById('r-dbuser').value==''){
		  
		  alert("Error: coloque un DB USER ");
		  document.getElementById('r-dbuser').focus();
		  
		  return false;
		  
	  }
	  
	  
	  if(document.getElementById('r-dbpass').value==''){
		  
		  alert("Error: coloque un DB PASSWORD ");
		  document.getElementById('r-dbpass').focus();
		  
		  return false;
		  
	  }
	  
	  
	   if(document.getElementById('r-dbname').value==''){
		  
		  alert("Error: coloque un DB NAME ");
		  document.getElementById('r-dbname').focus();
		  
		  return false;
		  
	  }  
	  
	  return true;
	  
  }
 
 
 
</script>




</head>





<body class="body-popup">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td class="td-titulo-popup">Crear  cuenta</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td><form name="form1" method="post" action="" onSubmit="return validar();">
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
   <tr>
   <td width="29%" class="td-form-title">Nombre de la cuenta</td>
   <td width="71%"><input name="r-titulo" type="text" class="form-box" id="r-titulo" size="30"></td>
   </tr>
   <tr>
   <td class="td-form-title">Url</td>
   <td><input name="r-url" type="text" class="form-box" id="r-url" value="http://" size="30">
     &nbsp;<span class="bdc-td-formbox"><a href="javascript:traerip();">Buscar dir IP</a>&nbsp;&nbsp;(para db server)</span></td>
   </tr>
   <tr>
   <td class="td-form-title">Carpeta de archivos</td>
   <td class="bdc-span-explicacion"><input name="r-dirserver" type="text" class="form-box" id="r-dirserver">
     &nbsp;<a class="bdc-td-formbox" href="javascript:autocompleta();">Autocompletar</a></td>
   </tr>
   <tr>
     <td class="td-form-title">db Server</td>
     <td><input name="r-dbserver" type="text" class="form-box" id="r-dbserver" value="localhost"></td>
   </tr>
   <tr>
   <td class="td-form-title">db User</td>
   <td><input name="r-dbuser" type="text" class="form-box" id="r-dbuser"></td>
   </tr>
   <tr>
   <td class="td-form-title">db Password</td>
   <td><input name="r-dbpass" type="text" class="form-box" id="r-dbpass"></td>
   </tr>
   <tr>
   <td class="td-form-title">db Name</td>
   <td><input name="r-dbname" type="text" class="form-box" id="r-dbname"></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td align="right"><input name="Submit" type="submit" class="form-button" value="OK">&nbsp;
    <input name="Submit2" type="button" class="form-button" value="Cancelar" onClick="window.close();"></td>
   </tr>
  </table>
  </form></td>
 </tr>
 <tr>
  <td>&nbsp;</td>
 </tr>
</table>
</body>
</html>
