<?
	  
  /**************** PARAMETROS MODIFICABLES************************/
 $DIRAPP = ""; //// nombre del directorio de la aplicacion, en caso de que sea el raiz se obvia por ""
 	
 //////////////CORREO SMTP///////////////////////////////////////////////
 $HOSTSMTP = ''; ///smtp1.example.com;smtp2.example.com";  // specify main and backup server
 $SMTPAUTH = true;     // turn on SMTP authentication
 $SMTPUSER= "DELIMCE";  // SMTP username
 $SMTPPASS = "secret"; // SMTP password
 
 
 
 /****************** NO ALTERE ESTE BLOQUE **************************/
    	  
  require('redirect.php');    	  
  include('dbconfig.php');

 /******************PARA SUBIR ARCHIVOS*************************/
 
 ///////CATALOGO DE PRODUCTOS  - redimensionar imagen media
 $image_rmw = 250;
 $image_rml = 204;
 ///////CATALOGO DE PRODUCTOS - redimensionar turnate
 $image_rtw = 50;
 $image_rtl = 41;

///////CONTENIDO  CATEGORIA - redimensionar imagen media
 $cont_cat_imgmed_width = 5;
 $cont_cat_imgmed_height = 5;
 ///////CONTENIDO CATEGORIA - redimensionar turnate
 $cont_cat_imgsmall_width = 267;
 $cont_cat_imgsmall_height = 200;

//////CONTENIDO  ARTÍCULO - redimensionar imagen media
 $cont_art_imgmed_width = 5;
 $cont_art_imgmed_height = 5;
 ///////CONTENIDO ARTICULO - redimensionar turnate
 $cont_art_imgsmall_width = 200;
 $cont_art_imgsmall_height = 200;

//////CONTENIDO  GALERIAS DE ARTÍCULO - redimensionar imagen media
 $cont_gal_imgmed_width = 560;
 $cont_gal_imgmed_height = 420;
 ///////CONTENIDO GALERÍAS DE ARTICULO - redimensionar turnate
 $cont_gal_imgsmall_width = 80;
 $cont_gal_imgsmall_height = 80;
 
 
 $TMAX = "20" ////TAMANO MAXIMO DE ARCHIVOS A SUBIR EN MB
 
 
 

?>
