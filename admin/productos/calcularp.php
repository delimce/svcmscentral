<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/tools.php");

$tool = new tools('db');

$calcula = $tool->simple_db("SELECT 
								  sum(c.cantidad*(select precio from producto where id = c.prod_id)) as monto,
								  (select iva from preferencias) as iva,
								  ifnull(ca.descuento,0) as descuento
								FROM
								  `orden_compra` o
								  INNER JOIN `orden_item` c ON (o.id = c.orden_id) 
								  left Join cliente  AS c2 ON o.cliente_id = c2.id
								  left Join cliente_categoria  AS ca ON ca.nombre = c2.categoria1
								   where o.id = {$_SESSION['ORDENIDP']}
								   group by o.id");
		
		
				////sacando el iva
				
   				$preciod = $calcula['monto']-bcdiv($calcula['monto']*$calcula['descuento'],100,2);
				
				$valor = (float) $_POST['valor'];
				$envio =  (float) $_POST['envio'];
				
								
				 
											  
								  
			switch($_POST['tipo']){
				
				case 1: ///+%
				
				if($valor>0)$preciod+= bcmul($preciod,bcdiv($valor,100,2),2);
				
				
				break;
				
				case 2:  //-%
				
				if($valor>0) $preciod-= bcmul($preciod,bcdiv($valor,100,2),2);
				
				
				break;
				
				case 3:///+monto
				
				if($valor>0) $preciod+= $valor;
				
				
				break;
				
				case 4:///-monto
				
				if($valor>0) $preciod-= $valor;
				
				
				break;
				
				
				
			}
								  
  
  
  	 $preciod+=$envio;
  
  
   ////calculando el iva de todo
  //if($calcula['iva']!=0){ $tiva = bcdiv($preciod*$calcula['iva'],100,2); }
  //$preciod+=$tiva;
  
  
  //echo number_format($preciod,2);
   echo $preciod;
  
  
 

$tool->cerrar();

?>