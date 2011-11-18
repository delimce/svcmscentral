<?php session_start();

$profile = 'admin'; /////////////// perfil requerido
//include("../../SVsystem/config/setup.php"); ////////setup
//include("../../SVsystem/class/tools.php");

//$tool = new tools();
//$tool->autoconexion();

$orden = $_REQUEST['orden'];
$idMyself = $_REQUEST['idMyself'];

	if($_REQUEST['se']=='u'){
        	$queryObtenerMenores = "select id, orden from articulo  where cat_id='{$_REQUEST['cat']}' and cat_nivel='{$_REQUEST['nivel']}' and orden in (select max(orden) from articulo where cat_id='{$_REQUEST['cat']}' and cat_nivel='{$_REQUEST['nivel']}' and orden<$orden) ";
                $menores = $tool->estructura_db($queryObtenerMenores);
                if (count($menores)>0){
	                for($i=0;$i<count($menores);$i++){
	                        $id = $menores[$i]['id'];
	                        $ordenId = $menores[$i]['orden'];
	                        $idUpdateMenores.= "'".$id."', ";
	                }
	                $idUpdateMenores = substr($idUpdateMenores,0,-2);
	                $queryUpdateMenores = "update articulo set orden = '".($ordenId+1)."' where id in (";
                        $queryUpdateMenores.= $idUpdateMenores;
	                $queryUpdateMenores.= ")";
	                $tool->query($queryUpdateMenores);
	                $queryUpdateMyself = "update articulo set orden='".$ordenId."' where id='".$idMyself."'";
                }else{
	                $queryUpdateMyself = "update articulo set orden='".($orden-1)."' where id='".$idMyself."'";
                }
                $tool->query($queryUpdateMyself);
	}else{
        	$queryObtenerMayores = "select id, orden from articulo  where cat_id='{$_REQUEST['cat']}' and cat_nivel='{$_REQUEST['nivel']}' and orden in (select min(orden) from articulo where cat_id='{$_REQUEST['cat']}' and cat_nivel='{$_REQUEST['nivel']}' and orden>$orden) ";
                $mayores = $tool->estructura_db($queryObtenerMayores);
                if (count($mayores)>0){
	                for($i=0;$i<count($mayores);$i++){
	                        $id = $mayores[$i]['id'];
	                        $ordenId = $mayores[$i]['orden'];
	                        $idUpdateMayores.= "'".$id."', ";
	                }
	                $idUpdateMayores = substr($idUpdateMayores,0,-2);
	                $queryUpdateMayores = "update articulo set orden = '".($ordenId-1)."' where id in (";
                        $queryUpdateMayores.= $idUpdateMayores;
	                $queryUpdateMayores.= ")";
	                $tool->query($queryUpdateMayores);
	                $queryUpdateMyself = "update articulo set orden='".$ordenId."' where id='".$idMyself."'";
                }else{
	                $queryUpdateMyself = "update articulo set orden='".($orden+1)."' where id='".$idMyself."'";
                }
                $tool->query($queryUpdateMyself);
	}
//$tool->cerrar();
?>
