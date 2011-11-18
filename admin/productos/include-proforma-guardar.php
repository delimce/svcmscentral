<?php

		$tool->abrir_transaccion();


						$PENVIO = (float) $_POST['envio'].'<br>';
//						$PIVA = (float) $_POST['ivaf'].'<br>';
						$PTOTAL = (float) $_POST['preciof'].'<br>';
						$PIVA = (float) $_POST['ivaf'].'<br>';
//                                                $PIVA = $PIVA/10;
//                                                $PIVA += 10;
//						$PIVA = $PTOTAL/$PIVA;


						  $campos = "`cliente_id`,`nfactura`,`fecha`,`nombre`,`rif`,`direccion`,`ciudad`,`pais`,`telefono`,`precio_envio`,`subtotal`,`iva`,`total`,`observaciones`";

							$cliente = $tool->simple_db("SELECT
														  c.id,
														  c.rif,
														  c.nombre,
														  c.tlf1,
														  c.tlf2,
														  ca.descuento,
														  o.monto,
														  c.direccion,
														  c.ciudad,
														  c.pais,
														  date_format(o.fecha,'%d/%m/%Y') as fecha
														FROM
														  `orden_compra` o
														  INNER JOIN `cliente` c ON (o.cliente_id = c.id)
														  left Join cliente_categoria  AS ca ON ca.nombre = c.categoria1
														  where o.id = {$_SESSION['ORDENIDP']}");


						  ////datos de la factura
						  $vector[0] = $cliente['id'];
						  $vector[1] = $_SESSION['ORDENIDP'];
						  $vector[2] = date("Y-m-d");
						  $vector[3] = $cliente['nombre'];
						  $vector[4] = $cliente['rif'];
						  $cliente_dir = $vector[5] = $cliente['direccion']; ///direccion para el email
						  $cliente_city = $vector[6] = $cliente['ciudad']; ///ciudad email
						  $vector[7] = $cliente['pais'];
						  $vector[8] = $cliente['tlf1'].'-'.$cliente['tlf2'];
						  $fact_envio = $vector[9] = $PENVIO; ///email de envio
						  $vector[10] = $PTOTAL-$PIVA; ///sub total de la orden para email
						  $fact_iva = $vector[11] = $PIVA; ///iva email
						  $fact_total = $vector[12] = $PTOTAL; ///total a pagar email
						  $fact_obs = $vector[13] = $_POST['observaciones'];


		$idfactura = $tool->simple_db("select id from factura where nfactura = {$_SESSION['ORDENIDP']}");


		if($tool->nreg==0){ ////no se ha creado la factura


						  /////guardando info tabla factura

						  $tool->insertar2("factura",$campos,$vector);

						  $idfactura = $tool->ultimoID;



						  $query = "select p.id,p.nombre,p.precio,o.cantidad from orden_item o inner join producto p on (o.prod_id = p.id)	where orden_id = {$_SESSION['ORDENIDP']}";

						   $items = $tool->estructura_db($query);

						   foreach($items as $i => $valor){

								  /////guardando info tabla factura item
								  $vector2[0] = $idfactura;
								  $vector2[1] = $items[$i]['id'];
								  $vector2[2] = $items[$i]['nombre'];
								  $vector2[3] = $items[$i]['cantidad'];
								  $vector2[4] = $items[$i]['precio'];

								  $tool->insertar2("factura_item","factura_id,producto_id,producto,cantidad,precio",$vector2);

						   }




			}else{ ///ya existe la factura


				$campos1 = explode(',',$campos);
				$tool->update("factura",$campos1,$vector,"id = $idfactura ");



			}



		   /////factura modificador
						   $tool->query("delete from factura_mod where factura_id =  $idfactura ");
							 /////guardando info tabla factura item
							$vector2[0] = $idfactura;
							$vector2[1] = $_POST['mod1'];
							////////////
							switch($_POST['tipo']){

							case 1:
							$uni = '%';
							$ope = '+';

							break;

							case 2:
							$uni = '%';
							$ope = '-';
							break;


							case 3:
							$uni = 'monto';
							$ope = '+';
							break;

							case 4:
							$uni = 'monto';
							$ope = '-';
							break;


							}


							///////////

							$vector2[2] = $uni;
							$vector2[3] = $ope;
							$vector2[4] = (float) $_POST['valor'];
							$tool->insertar2("factura_mod","factura_id,nombre,unidad,operacion,valor",$vector2);

							$fact_mod_nombre = $vector2[1];
							$fact_mod_signo = $ope;
							if($uni == 'monto') $uni = 'monto';
							$fact_mod_monto = $uni.' '.$vector2[4];


		$tool->cerrar_transaccion();



?>