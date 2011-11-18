<?php
function Conectarse()
{
   if (!($link=mysql_connect("localhost","clydecar_clydeca","clydecar")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db("clydecar_clyde",$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}

function comillas_inteligentes($valor)
{
   Conectarse();
   // Retirar las barras
   if (get_magic_quotes_gpc()) {
       $valor = stripslashes($valor);
   }

   // Colocar comillas si no es entero

   if (!is_numeric($valor)) {
       $valor = " '" . mysql_real_escape_string($valor) . "' ";
   }

   return $valor;
}

// func: redirect($to,$code=307)
// spec: http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
// funcion obtenida en: http://www.edoceo.com/creo/php-redirect.php
function redirect($to,$code=301)
{
  $location = null;
  $sn = $_SERVER['SCRIPT_NAME'];
  $cp = dirname($sn);
  if (substr($to,0,4)=='http') $location = $to; // Absolute URL
  else
  {
    $schema = $_SERVER['SERVER_PORT']=='443'?'https':'http';
    $host = strlen($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
    if (substr($to,0,1)=='/') $location = "$schema://$host$to";
    elseif (substr($to,0,1)=='.') // Relative Path
    {
      $location = "$schema://$host/";
      $pu = parse_url($to);
      $cd = dirname($_SERVER['SCRIPT_FILENAME']).'/';
      $np = realpath($cd.$pu['path']);
      $np = str_replace($_SERVER['DOCUMENT_ROOT'],'',$np);
      $location.= $np;
      if ((isset($pu['query'])) && (strlen($pu['query'])>0)) $location.= '?'.$pu['query'];
    }
  }

  $hs = headers_sent();
  if ($hs==false)
  {
    if ($code==301) header("301 Moved Permanently HTTP/1.1"); // Convert to GET
    elseif ($code==302) header("302 Found HTTP/1.1"); // Conform re-POST
    elseif ($code==303) header("303 See Other HTTP/1.1"); // dont cache, always use GET
    elseif ($code==304) header("304 Not Modified HTTP/1.1"); // use cache
    elseif ($code==305) header("305 Use Proxy HTTP/1.1");
    elseif ($code==306) header("306 Not Used HTTP/1.1");
    elseif ($code==307) header("307 Temorary Redirect HTTP/1.1");
    else trigger_error("Unhandled redirect() HTTP Code: $code",E_USER_ERROR);
    header("Location: $location");
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
  }
  elseif (($hs==true) || ($code==302) || ($code==303))
  {
    // todo: draw some javascript to redirect
    $cover_div_style = 'background-color: #ccc; height: 100%; left: 0px; position: absolute; top: 0px; width: 100%;';
    echo "<div style='$cover_div_style'>\n";
    $link_div_style = 'background-color: #fff; border: 2px solid #f00; left: 0px; margin: 5px; padding: 3px; ';
    $link_div_style.= 'position: absolute; text-align: center; top: 0px; width: 95%; z-index: 99;';
    echo "<div style='$link_div_style'>\n";
    echo "<p>Please See: <a href='$to'>".htmlspecialchars($location)."</a></p>\n";
    echo "</div>\n</div>\n";
  }
  exit(0);
}

function logear($login,$passwd){
     $query = " select nombre,apellido, now() logeo from usuarios ";
     $query.= " where login=".comillas_inteligentes($login)." and passwd = ".comillas_inteligentes($passwd)." ";

     $link2=Conectarse();
     $result = mysql_query($query,$link2);

     if ($result) {
        if ($row = mysql_fetch_array($result)){
		session_start();
        	$_SESSION["nombre"]   = $row["nombre"];
        	$_SESSION["apellido"] = $row["apellido"];
        	$_SESSION["lastLogin"]   = $row["logeo"];
                $_SESSION["validUser"]=	$login;

                $query = " update usuarios set lastLogin=now() ";
                $query.= " where login=".comillas_inteligentes($login);
                mysql_query($query,$link2);
                return TRUE;
        }
     }
     return FALSE;
}


function deslogear($login,$passwd){
	session_start();
	$_SESSION["lastLogin"]  = "";
	$_SESSION["nombre"]   = "";
	$_SESSION["apellido"] = "";
	$_SESSION["validUser"] = "";
	return TRUE;
}



function beginsWith( $str, $sub ) {
   return ( substr( $str, 0, strlen( $sub ) ) === $sub );
}
function endsWith( $str, $sub ) {
   return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
}

function contieneKey($array, $ckey, $value){
    $array_count = count($array);
    for($y=0; $y<$array_count; $y++) {
        if ($array[$y][$ckey]==$value){
            return true;
        }
    }
    return false;
}

function salvarUsuario($login,$passwd,$nombre,$apellido,$descripcion){
    $query = " insert into usuarios (login, passwd, nombre, apellido, descripcion, lastLogin) ";
    $query.= " values (".comillas_inteligentes($login).", ".comillas_inteligentes($passwd).", ".comillas_inteligentes($nombre).", ".comillas_inteligentes($apellido).", ".comillas_inteligentes($descripcion).", now() ) ";
    $result = mysql_query($query);
    if (!$result){
        $query = " update usuarios set ";
        $query.= "   passwd=".comillas_inteligentes($passwd)." ";
        $query.= " , nombre=".comillas_inteligentes($nombre)." ";
        $query.= " , apellido=".comillas_inteligentes($apellido)." ";
        $query.= " , descripcion=".comillas_inteligentes($descripcion)." ";
        $query.= " where login=".comillas_inteligentes($login)." ";

        $result = mysql_query($query);
    }
}

function borrarUsuario($login){
    $query = " delete from usuarios where login=".comillas_inteligentes($login)." ";
    $result = mysql_query($query);
}

function salvarCampo($nombreCampo,$tipoCampo,$icono,$all){
    $query = " select max(posicion) + 1 newPosicion, max(ccampo) + 1 newCampo from campos ";
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        $posicion = $row['newPosicion'];
        $ccampo = $row['newCampo'];
    }

    $query = " insert into campos (ccampo, xcampo, icampo, icono,posicion) ";
    $query.= " values (".comillas_inteligentes($ccampo);
    $query.= " , ".comillas_inteligentes($nombreCampo)." ";
    $query.= " , ".comillas_inteligentes($tipoCampo)." ";
    $query.= " , ".comillas_inteligentes($icono)." ";
    $query.= " , ".comillas_inteligentes($posicion)." ";
    $query.= " ) ";
    $result = mysql_query($query);

    if ($tipoCampo=='ssu'){
        foreach ($all as $key  => $valor) {
            if (substr($key, 0, 4)=='ssu_' && $valor!=''){
                $copcion = substr($key,4);

                $query = " insert into opcionesxcampo (ccampo,copcion,xopcion) values (";
                $query.= "   ".comillas_inteligentes($ccampo)." ";
                $query.= " , ".comillas_inteligentes($copcion)." ";
                $query.= " , ".comillas_inteligentes($valor)." ";
                $query.= " )";
                $result = mysql_query($query);
            }
        }
    }else if ($tipoCampo=='ssm'){
        foreach ($all as $key  => $valor) {
            if (substr($key, 0, 4)=='ssm_' && $valor!=''){
                $copcion = substr($key,4);

                $query = " insert into opcionesxcampo (ccampo,copcion,xopcion) values (";
                $query.= "   ".comillas_inteligentes($ccampo)." ";
                $query.= " , ".comillas_inteligentes($copcion)." ";
                $query.= " , ".comillas_inteligentes($valor)." ";
                $query.= " )";
                $result = mysql_query($query);
            }
        }
    }

    $result = mysql_query($query);
}

function actualizarCampo($ccampo,$nombreCampo,$tipoCampo,$icono,$all){
    $query = " update campos set  ";
    $query.= "   xcampo = ".comillas_inteligentes($nombreCampo);
    $query.= " , icampo = ".comillas_inteligentes($tipoCampo)." ";
    $query.= " , icono  = ".comillas_inteligentes($icono)." ";
    $query.= " where ccampo = ".comillas_inteligentes($ccampo)." ";

    $result = mysql_query($query);
}

function borrarCampo($ccampo){
    $query = " select posicion from campos ";
    $query.= " where ccampo = ".comillas_inteligentes($ccampo);
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        $cposicion = $row['posicion'];
    }

    $query = " delete from campos where ccampo=".comillas_inteligentes($ccampo)." ";
    $result = mysql_query($query);

    $query = " update campos ";
    $query.= " set posicion=posicion-1 ";
    $query.= " where posicion >= ".comillas_inteligentes($cposicion+$cantidad);
    $result = mysql_query($query);

}

function moverCampo($ccampo,$cantidad){
    $query = " select posicion from campos ";
    $query.= " where ccampo = ".comillas_inteligentes($ccampo);
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        $cposicion = $row['posicion'];
    }

    $query = " update campos set posicion=0 ";
    $query.= " where ccampo = ".comillas_inteligentes($ccampo);
    $query.= " and posicion = ".comillas_inteligentes($cposicion);
    $result = mysql_query($query);

    $query = " update campos ";
    if ($cantidad>0){
        $query.= " set posicion=posicion-".comillas_inteligentes($cantidad);
        $query.= " where posicion > ".comillas_inteligentes($cposicion);
        $query.= " and posicion <= ".comillas_inteligentes($cposicion+$cantidad);
    }else{
        $query.= " set posicion=posicion+".comillas_inteligentes(-1*$cantidad);
        $query.= " where posicion < ".comillas_inteligentes($cposicion);
        $query.= " and posicion >= ".comillas_inteligentes($cposicion+$cantidad);
    }
    $query.= " ";
    $result = mysql_query($query);

    $query = " update campos set posicion=".($cposicion+$cantidad);
    $query.= " where ccampo = ".comillas_inteligentes($ccampo);
    $query.= " and posicion = 0 ";
    $result = mysql_query($query);
}

function salvarContacto($ccontacto, $xnombre,$xapellido,$campos){
    $query = " update contactos set ";
    $query.= "   xnombre=".comillas_inteligentes($xnombre);
    $query.= " , xapellido= ".comillas_inteligentes($xapellido);
    $query.= " where ccontacto=".comillas_inteligentes($ccontacto);

    $result = mysql_query($query);

    /**** Insercion de los campos adicionales ****/
    foreach ($campos as $key=>$xvalor){
        if (substr($key,0,6)=='campo-'){
            $ccampo = substr($key,6);
            if (isset($xvalor) && $xvalor!=''){
                $query = " insert into camposxcontacto (ccontacto, ccampo, xvalor) ";
                $query.= " values (".comillas_inteligentes($ccontacto);
                $query.= " , ".comillas_inteligentes($ccampo);
                $query.= " , ".comillas_inteligentes($xvalor);
                $query.= " ) ";
                $result = mysql_query($query);

                if (!$result){
                    $query = " update camposxcontacto set ";
                    $query.= "   xvalor=".comillas_inteligentes($xvalor);
                    $query.= " where ccontacto=".comillas_inteligentes($ccontacto);
                    $query.= " and ccampo= ".comillas_inteligentes($ccampo);
                    $result = mysql_query($query);
                }
            }
        }
    }
}

function crearContacto($xnombre,$xapellido,$campos){
    $query = " insert into contactos (xnombre, xapellido) ";
    $query.= " values (".comillas_inteligentes($xnombre);
    $query.= " , ".comillas_inteligentes($xapellido);
    $query.= " ) ";
    $result = mysql_query($query);

    $query = " select max(ccontacto) maximo from contactos ";
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        $ccontacto = $row['maximo'];
    }

    /**** Insercion de los campos adicionales ****/
    foreach ($campos as $key=>$xvalor){
        if (substr($key,0,6)=='campo-'){
            $ccampo = substr($key,6);
            $query = " insert into camposxcontacto (ccontacto, ccampo, xvalor) ";
            $query.= " values (".comillas_inteligentes($ccontacto);
            $query.= " , ".comillas_inteligentes($ccampo);
            $query.= " , ".comillas_inteligentes($xvalor);
            $query.= " ) ";
            $result = mysql_query($query);
        }
    }
}

function borrarContacto($ccontacto){
    $query = " delete from contactos where ccontacto=".comillas_inteligentes($ccontacto)." ";
    $result = mysql_query($query);
    $query = " delete from camposxcontacto where ccontacto=".comillas_inteligentes($ccontacto)." ";
    $result = mysql_query($query);
}




/*--------------------------- Funciones Aun no utilizadas... borrables--------------- */

function salvarContactoDir($ccontacto,$nombre,$apellido,$profesion,$cargo,$codpostal,$pais,$estado,$ciudad,$direccion,$contenido){
    $query = " insert into contactosDirectorio (ccontacto, nombre, apellido, profesion, cargo, codpostal, pais, estado, ciudad, direccion, contenido) ";
    $query.= " values (".comillas_inteligentes($ccontacto);
    $query.= " , ".comillas_inteligentes($nombre);
    $query.= " , ".comillas_inteligentes($apellido)." ";
    $query.= " , ".comillas_inteligentes($profesion)." ";
    $query.= " , ".comillas_inteligentes($cargo)." ";
    $query.= " , ".comillas_inteligentes($codpostal)." ";
    $query.= " , ".comillas_inteligentes($pais)." ";
    $query.= " , ".comillas_inteligentes($estado)." ";
    $query.= " , ".comillas_inteligentes($ciudad)." ";
    $query.= " , ".comillas_inteligentes($direccion)." ";
    $query.= " , ".comillas_inteligentes($contenido)." ";
    $query.= " ) ";

    $result = mysql_query($query);
    if (!$result){
        $query = " update contactosDirectorio set ";
        $query.= "   nombre=".comillas_inteligentes($nombre)." ";
        $query.= " , apellido=".comillas_inteligentes($apellido)." ";
        $query.= " , profesion=".comillas_inteligentes($profesion)." ";
        $query.= " , codpostal=".comillas_inteligentes($codpostal)." ";
        $query.= " , pais=".comillas_inteligentes($pais)." ";
        $query.= " , estado=".comillas_inteligentes($estado)." ";
        $query.= " , ciudad=".comillas_inteligentes($ciudad)." ";
        $query.= " , direccion=".comillas_inteligentes($direccion)." ";
        $query.= " , cargo=".comillas_inteligentes($cargo)." ";
        $query.= " , contenido=".comillas_inteligentes($contenido)." ";
        $query.= " where ccontacto=".comillas_inteligentes($ccontacto)." ";
        $result = mysql_query($query);
        return $ccontacto;
    }else{
        $query = " select max(ccontacto) maximo from contactosDirectorio ";
        $result = mysql_query($query);
        if ($row = mysql_fetch_array($result)){
            return $row['maximo'];
        }
    }
}

function salvarEmpresa($ccontacto,$nombre,$apellido,$profesion,$cargo,$codpostal,$pais,$estado,$ciudad,$direccion,$bdonante){
    $query = " insert into empresas (ccontacto,  nombre, apellido, profesion, cargo, codpostal, pais, estado, ciudad, direccion,bdonante) ";
    $query.= " values (".comillas_inteligentes($ccontacto);
    $query.= " , ".comillas_inteligentes($nombre);
    $query.= " , ".comillas_inteligentes($apellido)." ";
    $query.= " , ".comillas_inteligentes($profesion)." ";
    $query.= " , ".comillas_inteligentes($cargo)." ";
    $query.= " , ".comillas_inteligentes($codpostal)." ";
    $query.= " , ".comillas_inteligentes($pais)." ";
    $query.= " , ".comillas_inteligentes($estado)." ";
    $query.= " , ".comillas_inteligentes($ciudad)." ";
    $query.= " , ".comillas_inteligentes($direccion)." ";
    $query.= " , ".comillas_inteligentes($bdonante)." ";
    $query.= " ) ";

    $result = mysql_query($query);
    if (!$result){
        $query = " update empresas set ";
        $query.= "   nombre=".comillas_inteligentes($nombre)." ";
        $query.= " , apellido=".comillas_inteligentes($apellido)." ";
        $query.= " , profesion=".comillas_inteligentes($profesion)." ";
        $query.= " , codpostal=".comillas_inteligentes($codpostal)." ";
        $query.= " , pais=".comillas_inteligentes($pais)." ";
        $query.= " , estado=".comillas_inteligentes($estado)." ";
        $query.= " , ciudad=".comillas_inteligentes($ciudad)." ";
        $query.= " , direccion=".comillas_inteligentes($direccion)." ";
        $query.= " , cargo=".comillas_inteligentes($cargo)." ";
        $query.= " , bdonante=".comillas_inteligentes($bdonante)." ";
        $query.= " where ccontacto=".comillas_inteligentes($ccontacto)." ";
        $result = mysql_query($query);
        return $ccontacto;
    }else{
        $query = " select max(ccontacto) maximo from empresas ";
        $result = mysql_query($query);
        if ($row = mysql_fetch_array($result)){
            return $row['maximo'];
        }
    }
}

function salvarContenido($cpagina,$titulo,$numArt,$contenido){
    salvarContenidoArticulo($cpagina,0,$titulo,$numArt,$contenido,"","","","y");
}

function salvarContenidoArticulo($cpagina,$ccategoria, $titulo,$numArt,$contenido,$resumen,$autor,$seccionLinks,$bpublicado){

    $query = " insert into paginas (";
    if ($cpagina!=-1){$query.= " cpagina, ";}
    $query.= " titulo, numArt, contenido, resumen, cautor, seccionLinks, bpublicado) ";
    $query.= " values (";
    if ($cpagina!=-1){$query.= comillas_inteligentes($cpagina).", ";}
    $query.= comillas_inteligentes($titulo);
    $query.= " , ".comillas_inteligentes($numArt)." ";
    $query.= " , ".comillas_inteligentes($contenido)." ";
    $query.= " , ".comillas_inteligentes($resumen)." ";
    $query.= " , ".comillas_inteligentes($autor)." ";
    $query.= " , ".comillas_inteligentes($seccionLinks)." ";
    $query.= " , ".comillas_inteligentes($bpublicado)." ";
    $query.= " ) ";

    $result = mysql_query($query);
    if (!$result){
        $query = " update paginas set ";
        $query.= "   titulo=".comillas_inteligentes($titulo)." ";
        $query.= " , numArt=".comillas_inteligentes($numArt)." ";
        $query.= " , contenido=".comillas_inteligentes($contenido)." ";
        $query.= " , resumen=".comillas_inteligentes($resumen)." ";
        $query.= " , cautor=".comillas_inteligentes($autor)." ";
        $query.= " , seccionLinks=".comillas_inteligentes($seccionLinks)." ";
        $query.= " , bpublicado=".comillas_inteligentes($bpublicado)." ";
        $query.= " where cpagina=".comillas_inteligentes($cpagina)." ";
        $result = mysql_query($query);
    }else{
        $query = " SELECT max( cpagina ) maximo FROM paginas ";
        $result = mysql_query($query);
        if ($row = mysql_fetch_array($result)){
            $maximo = $row['maximo'];
            $query = " insert into articulosxcategoria ";
            $query.= " (carticulo, ccategoria) ";
            $query.= " values ";
            $query.= " ( ";
            $query.= $maximo.", ".$ccategoria;
            $query.= " ) ";
            $result = mysql_query($query);
        }
    }
}

function borrarContenido($cpagina){
    $query = " delete from paginas where cpagina=".comillas_inteligentes($cpagina)." ";
    $result = mysql_query($query);
}

function borrarCategoria($ccategoria){
    $query = " delete from categorias where ccategoria=".comillas_inteligentes($ccategoria)." ";
    $result = mysql_query($query);
}

function borrarArticulo($carticulo){
    $query = " delete from paginas where cpagina=".comillas_inteligentes($carticulo)." ";
    $result = mysql_query($query);
}

function borrarDirectorio($cdirectorio){
    if ($cdirectorio>1){
        $query = " delete from directorios where cdirectorio=".comillas_inteligentes($cdirectorio)." ";
        $result = mysql_query($query);
    }
}

function borrarContactoDirectorio($ccontactoDirectorio){
    $query = " delete from contactosDirectorio where ccontacto=".comillas_inteligentes($ccontactoDirectorio)." ";
    $result = mysql_query($query);
}

function salvarURLBarra($cbarra, $cposicion, $url, $nombre, $abriren, $ccategoria){
    if ($cposicion==-1){
        $query = " insert into barras (cbarra, url, nombre, abriren, ccategoria) ";
        $query.= " values (".comillas_inteligentes($cbarra);
        $query.= " , ".comillas_inteligentes($url)." ";
        $query.= " , ".comillas_inteligentes($nombre)." ";
        $query.= " , ".comillas_inteligentes($abriren)." ";
        $query.= " , ".comillas_inteligentes($ccategoria)." ";
        $query.= " ) ";
        $result = mysql_query($query);
    }else{
        $query = " update barras set ";
        $query.= "   url=".comillas_inteligentes($url)." ";
        $query.= " , nombre=".comillas_inteligentes($nombre)." ";
        $query.= " , abriren=".comillas_inteligentes($abriren)." ";
        $query.= " , ccategoria=".comillas_inteligentes($ccategoria)." ";
        $query.= " where cbarra=".comillas_inteligentes($cbarra)." ";
        $query.= " and posicion=".comillas_inteligentes($cposicion)." ";
        $result = mysql_query($query);
    }
}

function salvarCatBarra($cbarra, $ccategoria){
    $url = "articulos.php?ccategoria=".$ccategoria;
    $query = " select xcategoria from categorias ";
    $query.= " where ccategoria=".comillas_inteligentes($ccategoria);
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        $xcategoria = $row['xcategoria'];
    }
    salvarURLBarra($cbarra,-1,$url,$xcategoria,'y',$ccategoria);
}

function salvarDirBarra($cbarra, $cdirectorio){
    $url = "directorios.php?cdirectorio=".$cdirectorio;
    $query = " select xdirectorio from directorios ";
    $query.= " where cdirectorio=".comillas_inteligentes($cdirectorio);
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        $xdirectorio = $row['xdirectorio'];
    }
    salvarURLBarra($cbarra,-1,$url,$xdirectorio,'y',$cdirectorio);
}

function borrarURLBarra($cbarra,$cposicion){
    $query = " delete from barras where cbarra=".comillas_inteligentes($cbarra)." ";
    $query.= " and posicion=".comillas_inteligentes($cposicion);
    $result = mysql_query($query);
    $query = " update barras ";
    $query.= " set posicion=posicion-1 ";
    $query.= " where cbarra = ".comillas_inteligentes($cbarra);
    $query.= " and posicion > ".comillas_inteligentes($cposicion);
    $result = mysql_query($query);
}

function moverURLBarra($cbarra,$cposicion,$cantidad){
    $query = " update barras set posicion=0 ";
    $query.= " where cbarra = ".comillas_inteligentes($cbarra);
    $query.= " and posicion = ".comillas_inteligentes($cposicion);
    $result = mysql_query($query);

    $query = " update barras ";
    if ($cantidad>0){
        $query.= " set posicion=posicion-".comillas_inteligentes($cantidad);
        $query.= " where posicion > ".comillas_inteligentes($cposicion);
        $query.= " and posicion <= ".comillas_inteligentes($cposicion+$cantidad);
    }else{
        $query.= " set posicion=posicion+".comillas_inteligentes(-1*$cantidad);
        $query.= " where posicion < ".comillas_inteligentes($cposicion);
        $query.= " and posicion >= ".comillas_inteligentes($cposicion+$cantidad);
    }
    $query.= " ";
    $result = mysql_query($query);

    $query = " update barras set posicion=".($cposicion+$cantidad);
    $query.= " where cbarra = ".comillas_inteligentes($cbarra);
    $query.= " and posicion = 0 ";
    $result = mysql_query($query);
}

function salvarCatPag($cpagina, $ccategoria){
    $query = " insert into categoriasxpagina ";
    $query.= " (cpagina,ccategoria) ";
    $query.= " values (";
    $query.= "  ".comillas_inteligentes($cpagina);
    $query.= " ,".comillas_inteligentes($ccategoria);
    $query.= " ) ";
    $result = mysql_query($query);
}

function deleteCatPag($cpagina, $ccategoria){
    $query = " delete from categoriasxpagina ";
    $query.= " where ccategoria=".comillas_inteligentes($ccategoria);
    $query.= " and cpagina=".comillas_inteligentes($cpagina);
    $result = mysql_query($query);
}

function salvarBarra($cbarra,$xbarra){
    $query = " insert into mbarra (cbarra, xbarra) ";
    $query.= " values (".comillas_inteligentes($cbarra).", ".comillas_inteligentes($xbarra);
    $query.= " ) ";

    $result = mysql_query($query);
    if (!$result){
        $query = " update mbarra set ";
        $query.= "   xbarra=".comillas_inteligentes($xbarra)." ";
        $query.= " where cbarra=".comillas_inteligentes($cbarra)." ";
        $result = mysql_query($query);
    }
}

function obtenerDirectoriosxNivel($padre){
    $query = " select * from directorios where ccategoriapadre=".comillas_inteligentes($padre);
    $result = mysql_query($query);
    $i=0;
    while ($row = mysql_fetch_array($result)){
        $results[$i][0] = $row['cdirectorio'];
        $results[$i][1] = $row['xdirectorio'];
        $results[$i][2] = obtenerDirectoriosxNivel($row['cdirectorio']);
        $results[$i][3] = obtenerContactosxDirectorio($row['cdirectorio']);
        $i = $i + 1;
    }
    return $results;
}

function obtenerCategoriasxNivel($padre){
    $query = " select * from categorias where ccategoriapadre=".comillas_inteligentes($padre);
    $result = mysql_query($query);
    $i=0;
    while ($row = mysql_fetch_array($result)){
        $results[$i][0] = $row['ccategoria'];
        $results[$i][1] = $row['xcategoria'];
        $results[$i][2] = obtenerCategoriasxNivel($row['ccategoria']);
        $results[$i][3] = obtenerArticulosXCategoria($row['ccategoria']);
        $i = $i + 1;
    }
    return $results;
}

function obtenerArticulosXCategoria($ccategoria){
    $query = " select carticulo, titulo, bpublicado from articulosxcategoria, paginas ";
    $query.= " where ccategoria=".comillas_inteligentes($ccategoria);
    $query.= " and carticulo=cpagina ";
    $result = mysql_query($query);
    $i=0;
    while ($row = mysql_fetch_array($result)){
        $results[$i][0] = $row['carticulo'];
        $results[$i][1] = $row['titulo'];
        $results[$i][2] = $row['bpublicado'];
        $i = $i + 1;
    }
    return $results;
}

function obtenerContactosXDirectorio($cdirectorio){

    $sql = 'select c.ccontacto , nombre , apellido '
        . ' from contactosxdirectorio c , contactosDirectorio d '
        . ' where cdirectorio = '.comillas_inteligentes($cdirectorio)
        . ' and c.ccontacto = d.ccontacto LIMIT 0, 30 ';
    $result = mysql_query($sql);
    $i=0;
    while ($row = mysql_fetch_array($result)){
        $results[$i][0] = $row['ccontacto'];
        $results[$i][1] = $row['nombre']." ".$row['apellido'];
        $results[$i][2] = 'y';
        $i = $i + 1;
    }
    return $results;
}

function salvarCategoria ($padre,$xcategoria){
    $query = " insert into categorias ";
    $query.= " (xcategoria, ccategoriapadre, beditable) ";
    $query.= " values ( ";
    $query.=      comillas_inteligentes($xcategoria);
    $query.= ", ".comillas_inteligentes($padre);
    $query.= ", 't' ";
    $query.= " ) ";
    $result = mysql_query($query);
}

function actualizarCategoria ($ccategoria,$xcategoria){
    $query = " update categorias ";
    $query.= " set xcategoria=".comillas_inteligentes($xcategoria);
    $query.= " where ccategoria=".comillas_inteligentes($ccategoria);
    $result = mysql_query($query);
}

function salvarDirectorio ($padre,$xdirectorio){
    $query = " insert into directorios ";
    $query.= " (xdirectorio, ccategoriapadre, beditable) ";
    $query.= " values ( ";
    $query.=      comillas_inteligentes($xdirectorio);
    $query.= ", ".comillas_inteligentes($padre);
    $query.= ", 't' ";
    $query.= " ) ";
    $result = mysql_query($query);
}

function salvarLinks($cpagina,$url,$nombreUrl){
    $query = " insert into linksxarticulo ";
    $query.= " (carticulo, url, nombre) ";
    $query.= " values ( ";
    $query.=      comillas_inteligentes($cpagina);
    $query.= ", ".comillas_inteligentes($url);
    $query.= ", ".comillas_inteligentes($nombreUrl);
    $query.= " ) ";
    $result = mysql_query($query);
}

function salvarLinksDirectorio($ccontacto,$url,$nombreUrl){
    $query = " insert into linksxdirectorio ";
    $query.= " (ccontacto, url, nombre) ";
    $query.= " values ( ";
    $query.=      comillas_inteligentes($ccontacto);
    $query.= ", ".comillas_inteligentes($url);
    $query.= ", ".comillas_inteligentes($nombreUrl);
    $query.= " ) ";
    $result = mysql_query($query);
}

function borrarLinks($cpagina,$clink){
    $query = " delete from linksxarticulo ";
    $query.= " where ";
    $query.= " carticulo=".comillas_inteligentes($cpagina);
    $query.= " and clink=".comillas_inteligentes($clink);
    $result = mysql_query($query);
}

function salvarDocs($ccontacto,$titulo,$descripcion,$documento,$tipoDoc){
    if (is_uploaded_file($documento['tmp_name'])) {
        move_uploaded_file($documento['tmp_name'], "/home/ontvvene/public_html/files/articulos/".$ccontacto.".".$documento['name']);
        $query = " insert into documentosxarticulo ";
        $query.= " (carticulo, xtitulo, xdocumento, fileName, tipoDoc) ";
        $query.= " values ( ";
        $query.=      comillas_inteligentes($ccontacto);
        $query.= ", ".comillas_inteligentes($titulo);
        $query.= ", ".comillas_inteligentes($descripcion);
        $query.= ", ".comillas_inteligentes($documento['name']);
        $query.= ", ".comillas_inteligentes($tipoDoc);
        $query.= " ) ";

        $result = mysql_query($query);
    }
}

function salvarDocsDirectorio($ccontacto,$titulo,$descripcion,$documento,$tipoDoc){
    if (is_uploaded_file($documento['tmp_name'])) {
        move_uploaded_file($documento['tmp_name'], "/home/ontvvene/public_html/files/directorio/".$ccontacto.".".$documento['name']);
        $query = " insert into documentosxdirectorio ";
        $query.= " (ccontacto, xtitulo, xdocumento, fileName, tipoDoc) ";
        $query.= " values ( ";
        $query.=      comillas_inteligentes($ccontacto);
        $query.= ", ".comillas_inteligentes($titulo);
        $query.= ", ".comillas_inteligentes($descripcion);
        $query.= ", ".comillas_inteligentes($documento['name']);
        $query.= ", ".comillas_inteligentes($tipoDoc);
        $query.= " ) ";
        $result = mysql_query($query);
    }
}

function borrarDocs($cpagina,$cdoc){
    $query = " delete from documentosxarticulo ";
    $query.= " where ";
    $query.= " carticulo=".comillas_inteligentes($cpagina);
    $query.= " and cfile=".comillas_inteligentes($cdoc);
    $result = mysql_query($query);
}

function salvarImgs($cpagina,$titulo,$img){

}

function salvarRamo($xramo){
    $query = " insert into ramos (xramo) values (";
    $query.=      comillas_inteligentes($xramo);
    $query.= " ) ";
    $result = mysql_query($query);
}

function getPadresArticulo($carticulo){
    $query = " select ccategoria from articulosxcategoria ";
    $query.= " where carticulo=".comillas_inteligentes($carticulo);
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        return getPadres($row['ccategoria']);
    }
}

function getPadres($ccategoria){
    $padre = getPadre($ccategoria);
    if ($padre['ccategoria'] == 0){
        $arbol = anadirArray($arbol,$padre);
    }else{
        $arbol = getPadres($padre['ccategoria']);
    }
    $query = " select xcategoria from categorias ";
    $query.= " where ccategoria=".comillas_inteligentes($ccategoria);
    $resultQuery = mysql_query($query);
    if ($row = mysql_fetch_array($resultQuery)){
        $hijo['ccategoria'] = $ccategoria;
        $hijo['xcategoria'] = $row['xcategoria'];
        $arbol = anadirArray($arbol,$hijo);
    }
    return $arbol;
}

function getPadre($ccategoria){
    $sql = 'select c1.ccategoriapadre , c2.xcategoria '
        . ' from categorias c1 left join categorias c2 '
        . ' on c1.ccategoriapadre = c2.ccategoria '
        . ' where c1.ccategoria = '. comillas_inteligentes($ccategoria)
        . ' LIMIT 0, 30 ';
    $resultQuery = mysql_query($sql);
    if ($row = mysql_fetch_array($resultQuery)){
        $results['ccategoria'] = $row['ccategoriapadre'];
        $results['xcategoria'] = $row['xcategoria']==null?"home":$row['xcategoria'];
    }else{
        $results['ccategoria'] = 0;
        $results['xcategoria'] = 'home';
    }
    return $results;
}

function getPadresContactoDirectorio($ccontacto){
    $query = " select cdirectorio from contactosxdirectorio ";
    $query.= " where ccontacto=".comillas_inteligentes($ccontacto);
    $result = mysql_query($query);
    if ($row = mysql_fetch_array($result)){
        return getPadres($row['cdirectorio']);
    }
}

function getPadresDirectorio($cdirectorio){
    $padre = getPadreDirectorio($cdirectorio);
    if ($padre['ccategoria'] == 0){
        $arbol = anadirArray($arbol,$padre);
    }else{
        $arbol = getPadresDirectorio($padre['ccategoria']);
    }
    $query = " select xdirectorio from directorios ";
    $query.= " where cdirectorio=".comillas_inteligentes($cdirectorio);
    $resultQuery = mysql_query($query);
    if ($row = mysql_fetch_array($resultQuery)){
        $hijo['ccategoria'] = $cdirectorio;
        $hijo['xcategoria'] = $row['xdirectorio'];
        $arbol = anadirArray($arbol,$hijo);
    }
    return $arbol;
}

function getPadreDirectorio($cdirectorio){
    $sql = 'select c1.ccategoriapadre , c2.xdirectorio '
        . ' from directorios c1 left join directorios c2 '
        . ' on c1.ccategoriapadre = c2.cdirectorio '
        . ' where c1.cdirectorio = '. comillas_inteligentes($cdirectorio)
        . ' LIMIT 0, 30 ';

    $resultQuery = mysql_query($sql);
    if ($row = mysql_fetch_array($resultQuery)){
        $results['ccategoria'] = $row['ccategoriapadre'];
        $results['xcategoria'] = $row['xdirectorio']==null?"home":$row['xdirectorio'];
    }else{
        $results['ccategoria'] = 0;
        $results['xcategoria'] = 'home';
    }
    return $results;
}

function anadirArray($array,$valor){
    $array_count = count($array);
    $array[$array_count] = $valor;
    return $array;
}

function contiene($array, $value){
    $array_count = count($array);
    for($y=0; $y<$array_count; $y++) {
        if ($array[$y]==$value){
            return true;
        }
    }
    return false;
}

function salvarFormasContactoDir($ccontacto, $iforma, $xforma){
    if (isset($iforma) && isset($xforma) && $xforma!=""){
        $query = " insert into formascontactoDir ";
        $query.= " (ccontacto, iforma, xforma) ";
        $query.= " values ( ";
        $query.=      comillas_inteligentes($ccontacto);
        $query.= ", ".comillas_inteligentes($iforma);
        $query.= ", ".comillas_inteligentes($xforma);
        $query.= " ) ";
        $result = mysql_query($query);
    }
}

function salvarDatosAdicionalesContactodir($ccontacto, $cdato, $xdato){
    if (isset($cdato) && isset($xdato) && $cdato!="" && $xdato!=""){
        $query = " insert into datosxcontactoDir ";
        $query.= " (ccontacto, cdato, xdato) ";
        $query.= " values ( ";
        $query.=      comillas_inteligentes($ccontacto);
        $query.= ", ".comillas_inteligentes($cdato);
        $query.= ", ".comillas_inteligentes($xdato);
        $query.= " ) ";
        $result = mysql_query($query);
    }
}

function salvarFormasContacto($ccontacto, $iforma, $xforma){
    if (isset($iforma) && isset($xforma) && $xforma!=""){
        $query = " insert into formascontacto ";
        $query.= " (ccontacto, iforma, xforma) ";
        $query.= " values ( ";
        $query.=      comillas_inteligentes($ccontacto);
        $query.= ", ".comillas_inteligentes($iforma);
        $query.= ", ".comillas_inteligentes($xforma);
        $query.= " ) ";
        $result = mysql_query($query);
    }
}

function salvarDatosAdicionalesContacto($ccontacto, $cdato, $xdato){
    if (isset($cdato) && isset($xdato) && $cdato!="" && $xdato!=""){
        $query = " insert into datosxcontacto ";
        $query.= " (ccontacto, cdato, xdato) ";
        $query.= " values ( ";
        $query.=      comillas_inteligentes($ccontacto);
        $query.= ", ".comillas_inteligentes($cdato);
        $query.= ", ".comillas_inteligentes($xdato);
        $query.= " ) ";
        $result = mysql_query($query);
    }
}

function salvarRamosxContacto($ccontacto, $cramo){
    if (isset($cramo) && $cramo!=""){
        $query = " insert into ramosxcontacto (cramo, ccontacto ) values (";
        $query.= " , ".comillas_inteligentes($cramo)." ";
        $query.= " , ".comillas_inteligentes($ccontacto)." ";
        $result = mysql_query($query);
    }
}

function borrarDatosxContacto($ccontacto,$cdato){
    $query = " delete from datosxcontacto ";
    $query.= " where ccontacto=".comillas_inteligentes($ccontacto);
    $query.= " and cdato=".comillas_inteligentes($cdato);
    $result = mysql_query($query);
}

function borrarFormaContacto($ccontacto,$iforma,$xforma){
    $query = " delete from formascontacto ";
    $query.= " where ccontacto=".comillas_inteligentes($ccontacto);
    $query.= " and iforma=".comillas_inteligentes($iforma);
    $query.= " and xforma=".comillas_inteligentes($xforma);
    $result = mysql_query($query);
}

function borrarDatosxContactoDir($ccontacto,$cdato){
    $query = " delete from datosxcontactodir ";
    $query.= " where ccontacto=".comillas_inteligentes($ccontacto);
    $query.= " and cdato=".comillas_inteligentes($cdato);
    $result = mysql_query($query);
}

function borrarFormaContactoDir($ccontacto,$iforma,$xforma){
    $query = " delete from formascontactodir ";
    $query.= " where ccontacto=".comillas_inteligentes($ccontacto);
    $query.= " and iforma=".comillas_inteligentes($iforma);
    $query.= " and xforma=".comillas_inteligentes($xforma);
    $result = mysql_query($query);
}

function salvarContactoxDirectorio($ccontacto,$cdirectorio){
    $query = " insert into contactosxdirectorio (ccontacto, cdirectorio ) values (";
    $query.= "   ".comillas_inteligentes($ccontacto)." ";
    $query.= " , ".comillas_inteligentes($cdirectorio)." )";
    $result = mysql_query($query);
}

function moverArticuloCategoria($carticulo, $ccategoria){
    $query = " delete from articulosxcategoria where carticulo=".comillas_inteligentes($carticulo);
    $result = mysql_query($query);
    $query = " insert into articulosxcategoria (carticulo,ccategoria) ";
    $query.= " values (".comillas_inteligentes($carticulo);
    $query.= " , ".comillas_inteligentes($ccategoria);
    $query.= " ) ";
    $result = mysql_query($query);
}

?>