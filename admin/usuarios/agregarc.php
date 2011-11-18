<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/formulario.php");
include("../../SVsystem/class/fecha.php");

include("security.php");

 $datos = new formulario('db');
 $fecha = new fecha("d/m/Y");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Agregar usuario a la base de datos</title>
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


<script language="javascript" type="text/javascript" src="http://www.svcmscentral.com/SVcommon/SVsystem/js/livevalidation.js"></script>
<script type="text/javascript" src="../../SVsystem/js/calendario/calendar.js"></script>
<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-es.js"></script>
<script type="text/javascript" src="../../SVsystem/js/calendario/calendar-setup.js"></script>
<script type="text/javascript" src="../../SVsystem/js/popup.js"></script>
<LINK href="../../SVsystem/js/calendario/calendario.css" type=text/css rel=stylesheet>






</head>

<body>



<?php include ("../n-encabezado.php")?>
<div id="ncuerpo">

<div id="ncontenedor">





<div id="ntitulo">Agregar Usuario a la Base de Datos</div>
<div id="ninstrucciones"><p>Llene todos los campos del formulario para agregar su contacto. Proceda con cautela.</p>




</div>


<div id="ncontenido">

<div id="nbloque">
	<?php   if(isset($_POST['Submit'])){



				$_POST['r_origen'] = 'Creado en admin';
				$_POST['r_fecha'] = date("Y-m-d H:i:s");
				$_POST['r_fechan'] = $fecha->fecha_db($_POST['r_fechan']) ;
				$datos->insert_data("r","_","cliente",$_POST);
				$NUEVO_ID = $datos->ultimoID;


						///////////////guardando campos adicionales
						 if(count($_POST['camposid'])>0){


								foreach($_POST['camposid'] as $i => $value){

									$vector9[0] = $NUEVO_ID;
									$vector9[1] = $_POST['camposid'][$i];
									$vector9[2] = $_POST['camposa'][$i];

									$datos->insertar2("campo_user","user_id,campo_id,valor",$vector9);

								}


						 }//////////////


						///////////agregando archivos
						
						 for($i2=0;$i2<count($_SESSION['ARCHIVOS']);$i2++){
							
									$vectora[0] = $NUEVO_ID;
									$vectora[1] = $_SESSION['ARCHIVOS'][$i2];
									$vectora[2] = $_SESSION['ADESCRIP'][$i2];
									$datos->insertar2("cliente_archivo","cliente_id,ruta,descrip",$vectora);
							
						 }
				
				
				
				unset($_SESSION['ARCHIVOS']);
				unset($_SESSION['ADESCRIP']);

				$datos->javaviso("Contacto insertado con exito",'agregarc.php');




	}else{
		
		
		 ////TEMPORAL PARA ARCHIVOS
 
		 $_SESSION['ARCHIVOS'] = array();
		 $_SESSION['ADESCRIP'] = array();


	?>


	  <form action="" method="post" name="form1">
								<table width="100%" border="0" cellspacing="5" cellpadding="0">



									<tr>
									 <td width="30%" class="bdc-form-title">Grupo 1</td>
										<td width="79%"><?php   echo $datos->combo_db ("r_categoria1","select nombre from cliente_categoria where grupo='1'","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?></td>
</tr>




									<tr>
									 <td width="30%" class="bdc-form-title">Grupo 2</td>
										<td width="79%"><?php   echo $datos->combo_db ("r_categoria2","select nombre from cliente_categoria where grupo='2'","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?></td>
						  </tr>




									<tr>
									 <td style="vertical-align: top;" class="bdc-form-title">Grupo 3</td>
										<td style="vertical-align: top;"><span class="subtitulito">
										  <?php   echo $datos->combo_db ("r_categoria3","select nombre from cliente_categoria where grupo='3'","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?>
									  </span></td>
									</tr>
									<tr>
									 <td style="vertical-align: top;" class="bdc-form-title">Grupo 4</td>
										<td style="vertical-align: top;"><?php   echo $datos->combo_db ("r_categoria4","select nombre from cliente_categoria where grupo='4'","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?></td>
									</tr>
									<tr>
									 <td style="vertical-align: top;" class="bdc-form-title">Grupo 5</td>
										<td style="vertical-align: top;"><?php   echo $datos->combo_db ("r_categoria5","select nombre from cliente_categoria where grupo='5'","nombre","nombre","Seleccionar",false,false,'<span class="bdc-span-explicacion">No existen categorias registradas en este grupo</span>',false,false,"form-box"); ?></td></tr>
									<tr>
									  <td style="vertical-align: top;">&nbsp;</td>
									  <td style="vertical-align: top;">&nbsp;</td>
								  </tr>

                                    <?php

										///campos adicionales

										  $datos->query("select id,nombre,tipo,longitud,lineas,valores from campo where modulo = 'user' order by orden");


											 while ($row2 = mysql_fetch_assoc($datos->result)) {


												 ?>

											 <tr>
											  <td width="30%" style="vertical-align: top;" class="bdc-form-title"><?php echo $row2['nombre'] ?></td>
											  <td width="79%">
											  <?php

											  if($row2['tipo']=='texto'){
												  echo '<input style="vertical-align: top;" class="n-form-box" id="camposa[]" name="camposa[]" type="text" size="'.$row2['longitud'].'">';

											  }else if($row2['tipo']=='textarea'){

											  	echo '<textarea  class="n-form-box" name="camposa[]" id="camposa[]" cols="'.$row2['longitud'].'" rows="'.$row2['lineas'].'"></textarea>';

											  }else{

												  $valorc = explode(",",$row2['valores']);
												  echo $datos->combo_array ("camposa[]",$valorc,$valorc,false,false,false,'no',false,false,"form-box");

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
 <td width="30%" class="bdc-form-title">Nombre</td>
<td width="79%"><input id="r_nombre" name="r_nombre" type="text" class="n-form-box" size="45" />
<script type="text/javascript">
var r_nombre = new LiveValidation('r_nombre');
r_nombre.add(Validate.Presence,{ failureMessage: "Epa... el Nombre" });
</script></td>
</tr>


<tr>
 <td class="bdc-form-title">CI-RIF</td>
<td><input name="r_rif" type="text" class="n-form-box" id="r_rif" size="45"></td>
</tr>



<tr>
 <td width="30%" class="bdc-form-title">Empresa</td>
<td width="79%"><input name="r_empresa" type="text"	class="n-form-box" size="60"></td>
</tr>

<tr>
 <td class="bdc-form-title">Actividad a la que se dedica </td>
<td><input name="r_actividad" type="text" class="n-form-box" id="r_actividad" size="60"></td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Cargo</td>
<td width="79%"><input name="r_cargo" type="text" class="n-form-box" size="45"></td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Email</td>
<td width="79%">
<input name="r_email" id="r_email" type="text"	class="n-form-box" size="45" > 
<script type="text/javascript">
var r_email = new LiveValidation('r_email');
r_email.add(Validate.Presence,{ failureMessage: "Su email! por favor" });
r_email.add(Validate.Exclusion, { within: [ 'cantv.net' ],failureMessage: "Sorry, No aceptamos  emails de cantv.net", partialMatch: true });
r_email.add(Validate.Inclusion, { within: [ '@' ],failureMessage: "Esta no parece una dirección de email todavía", partialMatch: true });
r_email.add(Validate.Inclusion, { within: [ '.' ],failureMessage: "Esta no parece una dirección de email todavía", partialMatch: true });
 </script>

</td>
</tr>
<tr>
  <td class="bdc-form-title">Email2</td>
  <td><input name="r_email2" type="text"	class="n-form-box" size="45"></td>
</tr>

<tr>
 <td class="bdc-form-title">Password</td>
<td>
<input  name="r_password" type="password" class="n-form-box" id="r_password" size="20">
<script type="text/javascript">
var r_password = new LiveValidation('r_password');
r_password.add(Validate.Presence,{ failureMessage: "Epa... te falta el password" });
r_password.add( Validate.Length, { minimum: 5 ,failureMessage: "Mínimo 5 caracteres por favor"} );
</script>
</td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Telefono</td>
<td width="79%"><input name="r_tlf1" type="text"class="n-form-box" id="r_tlf1" size="30"></td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Celular</td>
<td width="79%"><input name="r_celular" type="text" class="n-form-box" size="30"></td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Fax</td>
<td width="79%"><input name="r_fax" type="text" class="n-form-box" size="30"></td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Ciudad</td>
<td width="79%"><input name="r_ciudad" type="text" class="n-form-box" size="20"></td>
</tr>


<tr>
 <td width="30%" class="bdc-form-title">Estado</td>
 <td width="79%"><input name="r_estado" id="r_estado" type="text" class="n-form-box" size="20">

</td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">País</td>
 <td width="79%"><select name="r_pais" class="n-form-box" id="r_pais">
  <option>Seleccione</option>
<option value="Afganistán">Afganistán</option>
<option value="Albania">Albania</option>
<option value="Alemania">Alemania</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguila">Anguila</option>
<option value="Antártida">Antártida</option>
<option value="Antigua y Barbuda">Antigua y Barbuda</option>
<option value="Antillas holandesas">Antillas holandesas</option>
<option value="Arabia Saudíta">Arabia Saudíta</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaiyán">Azerbaiyán</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrein">Bahrein</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Bélgica">Bélgica</option>
<option value="Belice">Belice</option>
<option value="Benín">Benín</option>
<option value="Bermudas">Bermudas</option>
<option value="Bhután">Bhután</option>
<option value="Bielorrusia">Bielorrusia</option>
<option value="Birmania">Birmania</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
<option value="Botsuana">Botsuana</option>
<option value="Brasil">Brasil</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cabo Verde">Cabo Verde</option>
<option value="Camboya">Camboya</option>
<option value="Camerún">Camerún</option>
<option value="Canadá">Canadá</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Chipre">Chipre</option>
<option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
<option value="Colombia">Colombia</option>
<option value="Comores">Comores</option>
<option value="Congo">Congo</option>
<option value="Corea">Corea</option>
<option value="Corea del Norte">Corea del Norte</option>
<option value="Costa del Marfíl">Costa del Marfíl</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Croacia (Hrvatska)">Croacia (Hrvatska)</option>
<option value="Cuba">Cuba</option>
<option value="Dinamarca">Dinamarca</option>
<option value="Djibouri">Djibouri</option>
<option value="Dominica">Dominica</option>
<option value="Ecuador">Ecuador</option>
<option value="Egipto">Egipto</option>
<option value="El Salvador">El Salvador</option>
<option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
<option value="Eritrea">Eritrea</option>
<option value="Eslovaquia">Eslovaquia</option>
<option value="Eslovenia">Eslovenia</option>
<option value="España">España</option>
<option value="Estados Unidos">Estados Unidos</option>
<option value="Estonia">Estonia</option>
<option value="Etiopía">Etiopía</option>
<option value="Ex-República de Macedonia">Ex-República de Macedonia</option>
<option value="Filipinas">Filipinas</option>
<option value="Finlandia">Finlandia</option>
<option value="Francia">Francia</option>
<option value="Gabón">Gabón</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Georgia del Surr">Georgia del Surr</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Granada">Granada</option>
<option value="Grecia">Grecia</option>
<option value="Groenlandia">Groenlandia</option>
<option value="Guadalupe">Guadalupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guayana">Guayana</option>
<option value="Guayana Francesa">Guayana Francesa</option>
<option value="Guinea">Guinea</option>
<option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Haití">Haití</option>
<option value="Holanda">Holanda</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong R. A. E">Hong Kong R. A. E</option>
<option value="Hungría">Hungría</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Irak">Irak</option>
<option value="Irán">Irán</option>
<option value="Irlanda">Irlanda</option>
<option value="Isla Bouvet">Isla Bouvet</option>
<option value="Isla Christmas">Isla Christmas</option>
<option value="Isla Heard e Islas McDonald">Isla Heard e Islas McDonald</option>
<option value="Islandia">Islandia</option>
<option value="Islas Caimán">Islas Caimán</option>
<option value="Islas Cook">Islas Cook</option>
<option value="Islas de Cocos o Keeling">Islas de Cocos o Keeling</option>
<option value="Islas Faroe">Islas Faroe</option>
<option value="Islas Fiyi">Islas Fiyi</option>
<option value="Islas Malvinas">Islas Malvinas</option>
<option value="Islas Marianas del Norte">Islas Marianas del Norte</option>
<option value="Islas Marshall">Islas Marshall</option>
<option value="Islas menores de EE.UU">Islas menores de EE.UU</option>
<option value="Islas Palau">Islas Palau</option>
<option value="Islas Tokelau">Islas Tokelau</option>
<option value="Islas Turks y Caicos">Islas Turks y Caicos</option>
<option value="Islas Vírgenes (EE.UU.)">Islas Vírgenes (EE.UU.)</option>
<option value="Islas Vírgenes (Reino Unido)">Islas Vírgenes (Reino Unido)</option>
<option value="Israel">Israel</option>
<option value="Italia">Italia</option>
<option value="Jamaica">Jamaica</option>
<option value="Japón">Japón</option>
<option value="Jordania">Jordania</option>
<option value="Kazajistán">Kazajistán</option>
<option value="Kenia">Kenia</option>
<option value="Kirguizistán">Kirguizistán</option>
<option value="Kiribati">Kiribati</option>
<option value="Kuwait">Kuwait</option>
<option value="Laos">Laos</option>
<option value="Lesoto">Lesoto</option>
<option value="Letonia">Letonia</option>
<option value="Jamaica">Jamaica</option>
<option value="Líbano">Líbano</option>
<option value="Liberia">Liberia</option>
<option value="Libia">Libia</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lituania">Lituania</option>
<option value="Luxemburgo">Luxemburgo</option>
<option value="Macao R. A. E">Macao R. A. E</option>
<option value="Madagascar">Madagascar</option>
<option value="Malasia">Malasia</option>
<option value="Malawi">Malawi</option>
<option value="Maldivas">Maldivas</option>
<option value="Malí">Malí</option>
<option value="Malta">Malta</option>
<option value="Marruecos">Marruecos</option>
<option value="Martinica">Martinica</option>
<option value="Mauricio">Mauricio</option>
<option value="Mauritania">Mauritania</option>
<option value="Mayotte">Mayotte</option>
<option value="México">México</option>
<option value="Micronesia">Micronesia</option>
<option value="Moldavia">Moldavia</option>
<option value="Mónaco">Mónaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Mozambique">Mozambique</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Níger">Níger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk">Norfolk</option>
<option value="Noruega">Noruega</option>
<option value="Nueva Caledonia">Nueva Caledonia</option>
<option value="Nueva Zelanda">Nueva Zelanda</option>
<option value="Omán">Omán</option>
<option value="Panamá">Panamá</option>
<option value="Papua Nueva Guinea">Papua Nueva Guinea</option>
<option value="Paquistán">Paquistán</option>
<option value="Paraguay">Paraguay</option>
<option value="Perú">Perú</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Polinesia Francesa">Polinesia Francesa</option>
<option value="Polonia">Polonia</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reino Unido">Reino Unido</option>
<option value="República Centroafricana">República Centroafricana</option>
<option value="República Checa">República Checa</option>
<option value="República de Sudáfrica">República de Sudáfrica</option>
<option value="República del Congo (Zaire)">República del Congo (Zaire)</option>
<option value="República Dominicana">República Dominicana</option>
<option value="Reunión">Reunión</option>
<option value="Ruanda">Ruanda</option>
<option value="Rumania">Rumania</option>
<option value="Rusia">Rusia</option>
<option value="Samoa">Samoa</option>
<option value="Samoa occidental">Samoa occidental</option>
<option value="San Kitts y Nevis">San Kitts y Nevis</option>
<option value="San Marino">San Marino</option>
<option value="San Pierre y Miquelon">San Pierre y Miquelon</option>
<option value="San Vicente e Islas Granadinas">San Vicente e Islas Granadinas</option>
<option value="Santa Helena">Santa Helena</option>
<option value="Santa Lucía">Santa Lucía</option>
<option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
<option value="Senegal">Senegal</option>
<option value="Serbia y Montenegro">Serbia y Montenegro</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leona">Sierra Leona</option>
<option value="Singapur">Singapur</option>
<option value="Siria">Siria</option>
<option value="Somalia">Somalia</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Suazilandia">Suazilandia</option>
<option value="Sudán">Sudán</option>
<option value="Suecia">Suecia</option>
<option value="Suiza">Suiza</option>
<option value="Surinam">Surinam</option>
<option value="Svalbard">Svalbard</option>
<option value="Tailandia">Tailandia</option>
<option value="Taiwán">Taiwán</option>
<option value="Tanzania">Tanzania</option>
<option value="Tayikistán">Tayikistán</option>
<option value="Territorios Franceses del Sur">Territorios Franceses del Sur</option>
<option value="Timor Oriental">Timor Oriental</option>
<option value="Togo">Togo</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad y Tobago">Trinidad y Tobago</option>
<option value="Túnez">Túnez</option>
<option value="Turkmenistán">Turkmenistán</option>
<option value="Turquía">Turquía</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Ucrania">Ucrania</option>
<option value="Uganda">Uganda</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistán">Uzbekistán</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela" selected>Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Wallis y Futuna">Wallis y Futuna</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabue">Zimbabue</option>
  </select>
</td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Codigo postal / ZIP</td>
<td width="79%"><input name="r_zip" type="text" class="n-form-box" size="10"></td>
</tr>
<tr>
  <td class="bdc-form-title">Fecha de Nacimiento</td>
  <td>
  <input name="r_fechan" type="text" class="n-form-box" id="r_fechan" size="10" readonly="readonly" OnFocus="this.blur()" onClick="alert('usar el boton del calendario para llenar este campo')">
 		<img src="../icon/cal.gif" width="16" height="16" id="f_trigger_d" style="cursor: hand; border: 0px;" title="seleccionar fecha"> 
				<script type="text/javascript">
					Calendar.setup({
						inputField     :    "r_fechan",     // id of the input field
						ifFormat       :    "<?=strtolower("d/m/Y")?>",    // format of the input field
						button         :    "f_trigger_d",  // trigger for the calendar (button ID)
						singleClick    :    true
					});
				</script>	</td>
</tr>

<tr>
 <td class="bdc-form-title">Usuario Activo? <a href="javascript:;" onClick="MM_openBrWindow('../help/usuarioactivo.php','','scrollbars=yes,resizable=yes,width=500,height=500')"><img src="../icon/icon-info.gif" width="16" height="16" border="0" align="absmiddle"></a></td>
 <td><input name="r_activo" type="checkbox" id="r_activo" value="1" checked></td>
</tr>


<tr>
<td width="30%" class="bdc-form-title">Direcci&oacute;n</td>
<td width="79%"><textarea name="r_direccion" cols="100" rows="5" class="n-form-box"></textarea></td>
</tr>

<tr>
 <td width="30%" class="bdc-form-title">Mensajes del admin al usuario:<font size="1"> <br>
Lo que usted escriba aqui es lo primero que el usuario	ver&aacute; cuando	se	loguea	en	el	sitio web.</font></td>
<td width="79%"><textarea name="r_notas" cols="100" rows="15" class="n-form-box"></textarea></td>
</tr>
<tr>
  <td class="bdc-form-title">Archivos adjuntos:<font size="1"> <br>
suba los archivos que necesite , que los<br>
usuarios de sus sitio visualicen </font></td>
  <td><iframe id="archivos" src="archivos.php" height="320" width="100%" frameborder="0"></iframe></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>
  <input name="Submit" type="submit" class="form-button" value="OK, Agregar Usuario">&nbsp;
  <input name="Button" type="button" class="form-button" onClick="location.replace('index.php');" value="Cancelar" />
  </td>
</tr>
								</table>
</form>

	  <?php

	  }

	  ?>



<!-- termina nbloque -->
</div>




<!-- termina ncontenido -->
</div>

<div id="nnavbar"><?php include "n-include-menu.php"?></div>

</div>
</div>
<?php include ("../n-footer.php")?>
<?php // include ("../n-include-mensajes.php") NO SIRVE EN ESTA PAGINA ?>




















































































<!--INCLUDES-->
<?php include("../include-menu-salir.php");?>
<?php include("menu.php");?>

<!--END INCLUDES-->
</body>
</html>
<?php $datos->cerrar(); ?>
