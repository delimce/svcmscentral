<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

 $datos = new tools();
 $datos->autoconexion();
 
 $campos = $datos->array_query("SHOW COLUMNS FROM `cliente`");
 
 $data = $datos->simple_db("select * from cliente where id = {$_REQUEST['ide']}");
 
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Detalle de contacto</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">


</head>

<body class="body-popup">

  <div class="td-titulo-popup">Detalle de Contacto</div>
  <div class="bdc-span-nombre-detalle"><?php echo $data['nombre'] ?></div>
                          <?php 
						  
						  for($i=2;$i<count($campos);$i++){
						  
							  if(!empty($data[$campos[$i]])){
								  ?>
								  
								 <div class="bdc-td-dato-detalle"> <strong><?php echo $campos[$i]?>:</strong>  <?php echo $data[$campos[$i]] ?></div> 
								  <?
							  
							  }
						  
						  }
						  
						  $add = $datos->estructura_db("SELECT 
												  c.nombre,
												  ca.valor
												FROM
												  campo_user ca
												  INNER JOIN campo c ON (ca.campo_id = c.id) where ca.user_id= '{$_REQUEST['ide']}' ");
						  
						  
							
							
							for($i=0;$i<count($add);$i++){
						  
							  if(!empty($add[$i]['valor'])){
								  ?>
								  
								 <div class="bdc-td-dato-detalle"> <strong><?php echo $add[$i]['nombre']?>:</strong>  <?php echo $add[$i]['valor'] ?></div> 
								  <?
							  
							  }
						  
						  }
						  
						  
						  
						  ?>
</body>
</html>
<?php $datos->cerrar(); ?>
