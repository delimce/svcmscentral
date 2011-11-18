<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
include("../../SVsystem/config/setup.php"); ////////setup
include("../../SVsystem/class/clases.php");

include("security.php");


//////para ver en el front

$front = $_SESSION['SURL'].'/SV-detalle-articulo.php';////url relativa del detalle de articulo en el front
$front2 = $_SESSION['SURL'].'/SV-listado-articulos.php';////url relativa del detalle de articulo en el front

$tool = new tools('db');

if (isset($_REQUEST['se'])){
	include "ordenar_prod.php";
}

	if($_REQUEST['nivel']==1){ ////para listar subcategorias

						  	/*
							 	 $subcategoria = $tool->estructura_db("select id,nombre,orden,
							 	 if(s.users = 1,'<img src=\"../icon/icon-flag_green.gif\" title=\"Alimentable\" border=\"0\">','<img src=\"../icon/icon-flag_red.gif\" title=\"No Alimentable\" border=\"0\">') as users,
				 			 	 s.users as users2,(select count(*) from cont_sub_subcategoria where sub_id = s.id ) as subca,(select count(*) from articulo where cat_nivel = 2 and cat_id = s.id) as art
						     	 from cont_subcategoria s where cat_id = '{$_REQUEST['id']}' order by orden");
							*/

								 $subcategoria = $tool->estructura_db("select id,nombre,orden,
						(select count(*) from prod_sub_subcategoria where sub_id = s.id ) as subca,(select count(*) from producto where cat_nivel = 2 and cat_id = s.id) as prod
						 from prod_subcategoria s where cat_id = '{$_REQUEST['id']}' order by orden");


									if($tool->nreg>0){


											for($j=0;$j<count($subcategoria);$j++){

										 	$NIVEL = 2;
											$NIVEL_ID = $subcategoria[$j]['id'];
											$ART = $subcategoria[$j]['prod'];


												  ?>
											  <div class="cont-div-cat2"">
											  <div class="cont-div-cat-imagenes">
											  <?php if( ($subcategoria[$j]['subca']==0 && $subcategoria[$j]['prod']==0) || ($subcategoria[$j]['subca']>0 && $subcategoria[$j]['prod']==0) ){ ?>
											  <a href="#" title="agregar sub sub categoria"  onClick="popup('popup-insert-ssubcategoria.php?id=<?=$subcategoria[$j]['id']?>','new','500','900');"><img src="../icon/icon-cat-add.gif" width="16" height="16" border="0"></a>
											  <?php } ?>

											  <img src="../icon/icon-cat-delete.gif" width="16" height="16" border="0" onClick="borrar('<?=$subcategoria[$j]['id'] ?>','<? echo 'Subcategoria '.$subcategoria[$j]['id'];  ?>','prod_subcategoria','<?=$_REQUEST['id'] ?>',1);" title="borrar subcategoría y TODO lo que ésta contiene. esta accion es IRREVERSIBLE proceda con cautela" style="cursor:pointer;">

											  <a href="#" title="editar características de esta categoría"  onClick="popup('popup-editar-subcategoria.php?id=<?=$subcategoria[$j]['id']?>','new','500','900');"><img src="../icon/icon-cat-edit.gif" width="16" height="16" border="0"></a>
											  <?php if( ($subcategoria[$j]['subca']==0 && $subcategoria[$j]['art']==0) || ($subcategoria[$j]['subca']==0 && $subcategoria[$j]['art']>0) ){ ?>
											  <a href="#" title="agregar producto a esta categoría"  onClick="GP_AdvOpenWindow('popup-insert-producto.php?nivel=<?php echo $NIVEL; ?>&cat=<?php echo $NIVEL_ID; ?>','nuevo','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,channelmode=no,directories=no',0,0,'fitscreen','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue"><img src="../icon/icon-prod-add.gif" width="16" height="16" border="0"></a>





											  <?php } ?>
											  <?php if($j!=count($subcategoria)-1){?>
											  <img src="../icon/icon-down.gif" onClick="ordenar('<?=$subcategoria[$j]['orden'] ?>','prod_subcategoria','d','<?=$_REQUEST['id'] ?>',1);" width="16" height="16" border="0" title="Mover esta sub categoria hacia abajo" style="cursor:pointer;">
											  <?php } ?>
											  <?php if($j!=0){?>
											  <img src="../icon/icon-up.gif" onClick="ordenar('<?=$subcategoria[$j]['orden'] ?>','prod_subcategoria','u','<?=$_REQUEST['id'] ?>',1);" width="16" height="16" border="0" title="Mover esta sub categoria hacia arriba" style="cursor:pointer;">
											  <?php } ?>

											  </div>
											  <span style="cursor:pointer" onClick="abrir_cat('<?php echo $subcategoria[$j]['id'] ?>','<?php echo $NIVEL ?>');"><? echo $subcategoria[$j]['id'].' - '.utf8_encode($subcategoria[$j]['nombre']); ?></span>

                                              </div>
                                              <!--bloque de categoría 1-->
                                              <div style="display:none" id="subcon<?php echo $subcategoria[$j]['id'] ?>"><!-- aca es donde va el contenido de cada subcategoria-->

                                              </div> <!--fin del contenido de cada categoria-->



										  <?

											} ///for subcategorias

									}else{ //// muestra articulos


											require("prod.php"); ////mostrando articulos por CATEGORIAS (no consiguio subcategorias)


									} ///if subcategorias



	}else if($_REQUEST['nivel']==2){ ////para listar sub subcategorias




								  /*
									  $ssubcategoria = $tool->estructura_db("select id,nombre,orden,(select count(*) from articulo where cat_nivel = 3 and cat_id = s.id) as art,
																				  if(s.users = 1,'<img src=\"../icon/icon-flag_green.gif\" title=\"Alimentable\" border=\"0\">','<img src=\"../icon/icon-flag_red.gif\" title=\"No Alimentable\" border=\"0\">') as users,
				  																  s.users as users2
									  											  from cont_sub_subcategoria s where sub_id = '{$_REQUEST['id']}' order by orden");


									   */

									   $ssubcategoria = $tool->estructura_db("select id,nombre,orden,(select count(*) from producto where cat_nivel = 3 and cat_id = s.id) as prod from prod_sub_subcategoria s where sub_id = '{$_REQUEST['id']}' order by orden");


									    if($tool->nreg>0){





											for($z=0;$z<count($ssubcategoria);$z++){


											$NIVEL = 3;
									        $NIVEL_ID = $ssubcategoria[$z]['id'];
											$ART = $ssubcategoria[$z]['prod'];



												  ?>

												  <div class="cont-div-cat3">
												  <div class="cont-div-cat-imagenes">

												  <img src="../icon/icon-cat-delete.gif" width="16" height="16" border="0" onClick="borrar('<?=$ssubcategoria[$z]['id'] ?>','<? echo 'sub subcategoria '.$ssubcategoria[$z]['id']; ?>','prod_sub_subcategoria','<?=$_REQUEST['id'] ?>',2);" title="borrar subcategoría y TODO lo que ésta contiene. esta accion es IRREVERSIBLE proceda con cautela" style="cursor:pointer;">

												  <a href="#" title="editar características de esta categoría"  onClick="popup('popup-editar-ssubcategoria.php?id=<?=$ssubcategoria[$z]['id']?>','new','500','900');"><img src="../icon/icon-cat-edit.gif" width="16" height="16" border="0"></a>
												  <a href="#" title="agregar artículo a esta categoría"  onClick="GP_AdvOpenWindow('popup-insert-producto.php?nivel=<?php echo $NIVEL; ?>&cat=<?php echo $NIVEL_ID; ?>','nuevo','fullscreen=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,channelmode=no,directories=no',0,0,'fitscreen','ignoreLink','',0,'',0,1,5,'');return document.MM_returnValue"><img src="../icon/icon-prod-add.gif" width="16" height="16" border="0"></a>



												  <?php if($z!=count($ssubcategoria)-1){?>
												  <img src="../icon/icon-down.gif" onClick="ordenar('<?=$ssubcategoria[$z]['orden'] ?>','prod_sub_subcategoria','d','<?=$_REQUEST['id'] ?>',2);" width="16" height="16" border="0" title="Mover esta sub categoria hacia abajo" style="cursor:pointer;">
												  <?php } ?>
												  <?php if($z!=0){?>
												  <img src="../icon/icon-up.gif" onClick="ordenar('<?=$ssubcategoria[$z]['orden'] ?>','prod_sub_subcategoria','u','<?=$_REQUEST['id'] ?>',2);" width="16" height="16" border="0" title="Mover esta sub categoria hacia arriba" style="cursor:pointer;">
												  <?php } ?>

												  </div> <span style="cursor:pointer" onClick="abrir_cat('<?=$ssubcategoria[$z]['id'] ?>','<?php echo $NIVEL ?>');"><?php echo $ssubcategoria[$z]['id'].' - '.utf8_encode($ssubcategoria[$z]['nombre']); ?></span>
												  </div>
                                                    <!--bloque de categoría 1-->
                                                    <div style="display:none" id="sub2con<?php echo $ssubcategoria[$z]['id'] ?>"><!-- aca es donde va el contenido de cada subcategoria-->

                                                    </div> <!--fin del contenido de cada categoria-->

												  <?
											} ////for sub sub categorias

										}else{ //// muestra articulos

												require("prod.php"); ////mostrando articulos por SUBCATEGORIAS (no consiguio sub subcategorias)

										}



	}else{


		require("prod.php"); ////mostrando articulos por SUBSUBCATEGORIAS

	}

$tool->cerrar();
?>