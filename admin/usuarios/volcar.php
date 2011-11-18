<? session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$volcar = new tools();
$volcar->autoconexion();


$filename = "values.csv";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);



$valores = explode("¥",$contents);


$j=0;



$valores[17] = str_replace('"', '', $valores[17]);
$empezar = explode("
",$valores[17]);
$valores[17] = $empezar[1];
//$valores[17] = $empezar[1];

unset($empezar);


for($i=17;$i<count($valores);$i++){

	$insertar[$j] = str_replace('"', '', $valores[$i]);
	$j++;
	if($j==17){







		//print_r($insertar);
		echo '<p>';

			$volcar->insertar2("cliente","origen,categoria,empresa,cargo,nombre,email,telefono,celular,fax,pais,area_pais,estado,ciudad,direccion,zip,apartado,notas",$insertar);


		$j=0;
		unset($insertar);

	}

}



$volcar->cerrar();


 ?>