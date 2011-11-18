<?
////FUNCION DE CALENDARIO
function LoadCalendario($CEtiqueta,$CnombreId,$CValues,$CVisible,$CEjeX,$CEjeY,$CImagenClick,$clase_t, $clase_in)
//CEtiqueta							' Nombre que se muestra al lado del calendario
//$CnombreId							' Nombre e ID del calendario
//$CValues								' Valor por defecto
//$CVisible							' Booleano para mostrar o no el calendario
//$CEjeX								' Posicion del eje X de calendario
//$CEjeY								' Posicion del eje Y de calendario
//$CImagenClick						' imagen de boton para mostrar el calendario
//$strtxt								' contiene la cadena de todo el html generado para la caja de texto
{

		$NameCalendario='Calendario';

		if (!$CVisible)
			$sStyle = " style='display:none;' ";

		if ($CnombreId != "") $NameCalendario="'Tbl". $CnombreId . "'";

		$strtxt = "<TABLE border=0 id=". $NameCalendario ." ". sStyle ." cellpadding='0' cellspacing='0'> \n";
		$strtxt .= "		<TR>\n";
		if ($CEtiqueta!=''){
			$strtxt .= "			<TD valign=middle class='".$clase_t."'>&nbsp;". str_ireplace(" ","&nbsp;",$CEtiqueta) ."</TD>\n";
			$strtxt .= "			<TD width=3px>&nbsp;</TD>\n";
		}
		$strtxt .= "			<TD valign=middle >\n";
		$strtxt .= "			<input class='".$clase_in."' name='". $CnombreId ."' \n";
		$strtxt .= "			id='". $CnombreId  ."' value='". $CValues ."' size='12'> \n";
		$strtxt .= "			</TD>";
		$strtxt .= "			<TD>";
		 if ($CImagenClick=="")
			$strtxt .= "<input type='button' title='ver calendario' value='v' border='1'  \n";
		 else
			$strtxt .= "<input type='image' title='ver calendario' SRC='". $CImagenClick ."' border='1'  \n";

		 $strtxt .= "			WIDTH='20' HEIGHT='18'  \n";
		 $strtxt .="			class='CalBoton'  \n";
		 $strtxt .="			onclick='event.cancelBubble=true;  \n";
		 $strtxt .="			TopFrameObj.fPopCalendar(". $CnombreId . "," . $CnombreId . ",TopFrameObj.popCal";
		 if ($CEjeY!="")
				$strtxt .= ", " . $CEjeY;
		 else
				$strtxt .= ",0 ";


		 if ($CEjeX!="")
			$strtxt .= "," .$CEjeX;
		 else
			$strtxt .= ",0 ";


		 $strtxt .= " ); \n";
		 $strtxt .= " return false;' ";
		 $strtxt .= " > \n";
		 $strtxt .= " </TD> \n";
		$strtxt .= "</TR> \n";
		$strtxt .= "</TABLE> \n";
		return $strtxt;
}



	function borrar_imagenes($imagen){

		global $DIR;

		@unlink("../../SVsitefiles/$DIR/producto/med/$imagen");
		@unlink("../../SVsitefiles/$DIR/producto/orig/$imagen");
		@unlink("../../SVsitefiles/$DIR/producto/turn/$imagen");


	}

	function borrar_imagenes2($imagen){

		global $DIR;

		@unlink("../../SVsitefiles/$DIR/contenido/med/$imagen");
		@unlink("../../SVsitefiles/$DIR/contenido/orig/$imagen");
		@unlink("../../SVsitefiles/$DIR/contenido/turn/$imagen");


	}

	function borrar_imagenes3($imagen){

		global $DIR;

		@unlink("../../../SVsitefiles/$DIR/contenido/med/$imagen");
		@unlink("../../../SVsitefiles/$DIR/contenido/orig/$imagen");
		@unlink("../../../SVsitefiles/$DIR/contenido/turn/$imagen");


	}




	function borrar_datap($archivo,$tipo){

			global $DIR;

			switch($tipo){

			case 'file':

				if(!empty($archivo))@unlink("../../SVsitefiles/$DIR/producto/doc/$archivo");

				break;

			case 'image':

				if(!empty($archivo)){
					borrar_imagenes($archivo);

				}

				break;


			}

	}



	function borrar_datac($archivo,$tipo){

			global $DIR;

			switch($tipo){

			case 'archivo':

				if(!empty($archivo))@unlink("../../SVsitefiles/$DIR/contenido/doc/$archivo");

				break;

			case 'imagen':

				if(!empty($archivo)){
					borrar_imagenes2($archivo);

				}

				break;


			}

		}


function smart_resize_image( $file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false )
{
    if ( $height <= 0 && $width <= 0 ) {
      return false;
    }

    $info = getimagesize($file);
    $image = '';

    $final_width = 0;
    $final_height = 0;
    list($width_old, $height_old) = $info;

    if ($proportional) {
      if ($width == 0) $factor = $height/$height_old;
      elseif ($height == 0) $factor = $width/$width_old;
      else $factor = min ( $width / $width_old, $height / $height_old);

      $final_width = round ($width_old * $factor);
      $final_height = round ($height_old * $factor);

    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
    }

    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        $image = imagecreatefromgif($file);
      break;
      case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($file);
      break;
      case IMAGETYPE_PNG:
        $image = imagecreatefrompng($file);
      break;
      default:
        return false;
    }

    $image_resized = imagecreatetruecolor( $final_width, $final_height );

    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $trnprt_indx = imagecolortransparent($image);

      // If we have a specific transparent color
      if ($trnprt_indx >= 0) {

        // Get the original image's transparent color's RGB values
        $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);

        // Allocate the same color in the new image resource
        $trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $trnprt_indx);

        // Set the background color for new image to transparent
        imagecolortransparent($image_resized, $trnprt_indx);


      }
      // Always make a transparent background color for PNGs that don't have one allocated already
      elseif ($info[2] == IMAGETYPE_PNG) {

        // Turn off transparency blending (temporarily)
        imagealphablending($image_resized, false);

        // Create a new transparent color for image
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $color);

        // Restore transparency blending
        imagesavealpha($image_resized, true);
      }
    }

    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

    if ( $delete_original ) {
      if ( $use_linux_commands )
        exec('rm '.$file);
      else
        @unlink($file);
    }

    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }

    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        imagegif($image_resized, $output);
      break;
      case IMAGETYPE_JPEG:
        imagejpeg($image_resized, $output);
      break;
      case IMAGETYPE_PNG:
        imagepng($image_resized, $output);
      break;
      default:
        return false;
    }

    return true;
  }


?>