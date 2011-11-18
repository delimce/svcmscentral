<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/tools.php");

$tool = new tools();
$tool->autoconexion();

$MONEDA = $tool->llenar_array("Bolivar F.,Bolivar,Dolar,Euro");
$MONEDAS = $tool->llenar_array("Bsf.,Bs.,$,€");


	if(isset($_POST['Submit'])){
	
			$datos[0] = 'moneda_simbolo';  $valores[0] = $_POST['moneda'];
			$datos[1] = 'moneda_factor';   $valores[1] = $_POST['fcambio'];
			$datos[2] = 'iva';  		   $valores[2] = $_POST['iva'];
			$datos[3] = 'ocultar_precio';  $valores[3] = $_POST['oculto'];
		
			
			$tool->update("preferencias",$datos,$valores,"");
			$tool->cerrar();
			
			$tool->javaviso("Opciones de moneda Guardadas","opciones.php");
		
	
		}else{
		
		 $datos = $tool->simple_db("select moneda_simbolo,iva,moneda_factor,ocultar_precio from preferencias ");
		
	
	}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Opciones de Moneda y Precios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}



function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->

function CC_startTip(){ //v1.0 333Creative
  ccID=document.getElementById;ccIE=(document.all);ccN4=(document.layers);
  i5=(ccID&&ccIE);ccN6=(ccID&&!ccIE);ccI4=(!ccID&&ccIE);ccMC=(navigator.userAgent.indexOf("Mac")!= -1);
  cc1=null;ccF=0;index=0;ccX=15;ccY=15;n=0;ccPX=(ccID)?"px":"";var T="ccToolTip";
   if(ccN4){el=document.layers[T];document.captureEvents(Event.MOUSEMOVE);document.onmousemove=eval("CC_"+"Follow")}
  else if(ccID){el=document.getElementById(T)}
  else if(ccI4){el=document.all[T]}
}
//-->
</script>


</head>

<body>
<?php include ("n-encabezado.php")?>
<div id="ncuerpo">
<?php include ("n-include-mensajes.php")?>
<div id="ncontenedor">
<div id="nnavbar"><?php include "n-include-menu2.php"?></div>




<div id="ntitulo">Opciones de Moneda y Precios</div>
<div id="ninstrucciones">Elija en que moneda se encuentran los montos y el IVA.<br />
<strong>Nota</strong>: El factor de cambio, funciona si necesita que los precios de los productos ya ingresados se visualicen en otra moneda, con respecto a los precios iniciales que inserto en la moneda origen.</div>


<div id="ncontenido">

<form name="form" method="post" action="" id="form1">



<div id="nbloque">
<h1>Moneda y Cambio</h1>
<p>Si usted desea cambiar entre una moneda y otra, utilice este factor de cambio para hacer el cambio de precios</p>
<div id="tituloizq" style="width:180px; height:70px"><?php echo $tool->combo_array ("moneda",$MONEDA,$MONEDAS,false,$datos['moneda_simbolo'],"document.form1.simbolo.value = this.value;"); ?></div>
<div id="dataderecha" style="height:70px;">
<label><span class="especial">Factor de Cambio</span>
<input  style="width:110px;" name="fcambio" type="text" class="n-form-box" id="fcambio" value="<?=number_format($datos['moneda_factor'],3) ?>" size="8">
</label>
 
<label><span class="especial">IVA</span>         
<input style="width:110px;" name="iva" type="text" class="n-form-box" id="iva" value="<?=$datos['iva'] ?>" size="5">    
</label>


<label><span class="especial">Símbolo</span><input style="width:110px;" name="simbolo" readonly type="text" class="n-form-box" id="simbolo" value="<?=$datos['moneda_simbolo'] ?>" size="5"></label>

</div>

<div id="nseparador"></div>
</div>



<div id="nbloque">
<h1>Visibilidad de Precios en su Web Site</h1>

<div style="font-size:13px; margin:10px 0 0 0;"><input name="oculto" type="radio" id="oculto" value="0" <?php if($datos['ocultar_precio']==0)echo 'checked'; ?>>
                    <a href="javascript:;" class="instruccion">Precios Siempre Visibles<span>Los precios de sus productos estarán  disponibles para todos los visitantes de la pagina, registrados o no</span></a>
<input type="radio" name="oculto" id="oculto" value="1" <?php if($datos['ocultar_precio']==1)echo 'checked'; ?>> 
                    <a href="javascript:;" class="instruccion">Ocultar a TODOS<span>Sus precios estarán ocultos para todos los visitantes, incluyendo usuarios registrados</span></a>

<input type="radio" name="oculto" id="oculto" value="2" <?php if($datos['ocultar_precio']==2)echo 'checked'; ?>> 
                    <a href="javascript:;" class="instruccion">Visibles solo para usuarios registrados<span>Sus precios serán visibles  solamente para los usuarios que se hayan registrado y logueado dentro de la pagina</span></a></div>


<div id="nseparador"></div>
</div>




<div id="botonsotes">
<center>
<input name="Submit" type="submit" class="form-button" value="Guardar">&nbsp; 
<input name="Submit2" type="reset" class="form-button" onClick="MM_goToURL('parent','opciones.php');return document.MM_returnValue" value="Cancelar">
</center>
</div>










</form>

<!-- termina ncontenido -->
</div>


</div>
</div>
<?php include ("n-footer.php")?>
</body>
</html>
