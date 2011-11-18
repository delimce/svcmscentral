<?php session_start();

	
	if(!empty($_SESSION['USERID'])){ ///si esta iniciada la sesion
	
	include("../SVsystem/class/tools.php");
    $entrar = new tools();
	$entrar->redirect("main.php");
	
	}


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Administraci&oacute;n del contenido de su Sitio Web</title>
<link href="estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../SVsystem/js/ajax.js"></script>
<script language="JavaScript" type="text/javascript" src="../SVsystem/js/utils.js"></script>
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


<script language="JavaScript" type="text/javascript">
function validar(form1) {

  if (document.form1.user.value.length < 1) {
    alert("Escriba el Email de usuario en el campo \"Email\".");
        document.form1.user.focus();
    return (false);
  }

  if (document.form1.pass.value.length < 1) {
    alert("Escriba la Contraseña de usuario en el campo \"Contraseña\".");
        document.form1.pass.focus();
    return (false);
  }


  	oXML = AJAXCrearObjeto();
	oXML.open('post', 'valida.php');
	oXML.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	oXML.onreadystatechange = function(){
		if (oXML.readyState == 4 && oXML.status == 200) {

				if(oXML.responseText==1){

				location.replace('main.php');
				
				}else if(oXML.responseText==2){
				
				
				location.replace('no.php');
	
				}else{

				alert('Error: Usuario o Contraseña incorrecta');

				}

				vaciar(oXML);

		}
	 }

	oXML.send('user='+document.form1.user.value+'&pass='+document.form1.pass.value);


  return (false);
 }
</script>


</head>

<body OnLoad=" javascript:form1.user.focus();">
<?php include ("n-encabezado.php")?>


<div id="ncuerpo">
<div id="ncontenedor">


<div id="ntitulo">Administrador de contenidos de su Página Inteligente</div>
<div id="ninstrucciones">Ingrese su nombre de usuario y contraseña.</div>
<div id="ncontenido">
<form name="form1" method="post" action="" onSubmit="return validar();">
                  <table width="60%" border="0" align="center" cellpadding="0" cellspacing="5">
                    <tr>
                      <td width="43%" class="td-form-title">Usuario</td>
                      <td width="57%"><input name="user" type="text" class="form-box" id="user"></td>
                    </tr>
                    <tr>
                      <td class="td-form-title">Contrase&ntilde;a</td>
                      <td><input name="pass" type="password" class="form-box" id="pass" size="26"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="Submit" type="submit" class="form-button" value="Entrar al Sistema"></td>
                    </tr>
                  </table>
                </form>

<!-- termina ncontenido -->
</div>
<div id="firefox" style="text-align:center;"><a href="http://www.mozilla.com/es/firefox/" target="_blank"><img src="firefox-download-logo.jpg" alt="Descargue FireFox" width="334" height="121" border="0" /></a></div>

</div>
</div>






</body>
</html>
