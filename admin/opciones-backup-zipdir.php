<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../SVsystem/config/setup.php"); ////////setup
include("../SVsystem/class/tools.php");

$now = date("YmdHi", time());
$outfile = $_SESSION['DIRSERVER']."_$now.zip";

$tool = new tools();

$tool->Zip("../SVsitefiles/{$_SESSION['DIRSERVER']}/banner",'./'.$outfile, "banner");
$tool->Zip("../SVsitefiles/{$_SESSION['DIRSERVER']}/categoria",'./'.$outfile, "categoria");
$tool->Zip("../SVsitefiles/{$_SESSION['DIRSERVER']}/contenido",'./'.$outfile, "contenido");
$tool->Zip("../SVsitefiles/{$_SESSION['DIRSERVER']}/producto",'./'.$outfile, "producto");
$tool->Zip("../SVsitefiles/{$_SESSION['DIRSERVER']}/usuario",'./'.$outfile, "usuario");

$filename = './'.$outfile;

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');

// addition by Jorg Weske
$file_extension = strtolower(substr(strrchr($filename,"."),1));

if( $filename == "" )
{
echo "<html><body>ERROR: el archivo no esta especificado</body></html>";
exit;
} elseif ( ! file_exists( $filename ) )
{
echo "<html><body>ERROR: El archivo que intenta abrir no existe en el servidor.</body></html>";
exit;
};
switch( $file_extension )
{
case "pdf": $ctype="application/pdf"; break;
case "msi": $ctype="application/octet-stream"; break; /// i am already using this but file is not downloading properly.
case "exe": $ctype="application/octet-stream"; break;
case "zip": $ctype="application/zip"; break;
case "doc": $ctype="application/msword"; break;
case "docx": $ctype="application/msword"; break;
case "xls": $ctype="application/vnd.ms-excel"; break;
case "xlsx": $ctype="application/vnd.ms-excel"; break;
case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
case "pptx": $ctype="application/vnd.ms-powerpoint"; break;
case "gif": $ctype="image/gif"; break;
case "png": $ctype="image/png"; break;
case "jpeg":
case "jpg": $ctype="image/jpg"; break;
default: $ctype="application/force-download";
}
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: $ctype");
header("Content-Disposition: attachment; filename=".basename($filename).";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filename));
readfile("$filename");


unlink($filename);

exit();

?>