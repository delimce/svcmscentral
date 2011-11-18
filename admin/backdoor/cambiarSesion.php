<?php
include("../../SVsystem/config/masterconfig.php");
include("../../SVsystem/class/clases.php");
include("../../SVsystem/class/tools.php");

$salir = new tools();
session_destroy();

$i = new formulario('db');
if(isset($_POST['user'])){

        session_start();
	$user = $i->getvar("user",$_POST);

	$queryLogeo = "SELECT
	                c.id as cid,
                        c.dbserver,
                        c.dbuser,
                        c.dbpass,
                        c.titulo,
                        c.dbname,
                        c.dirserver,
                        c.url,
                        a.nombre,
                        a.id,
                        a.activo,
                        a.es_admin,
                        a.servicios
                      FROM
                        admin a
                        INNER JOIN cuenta c ON (a.cuenta_id = c.id)
                                        where user = '$user' ";

	$DATOS = $i->simple_db($queryLogeo);

        $_SESSION['PROFILE']     = 'admin'; ///perfil de ingreso
        $_SESSION['USERID']      = $DATOS['id'];
        $_SESSION['ESADMIN']     = $DATOS['es_admin'];
        $_SESSION['SERVICIO']    = $DATOS['servicios'];
        $_SESSION['STITULO']     = $DATOS['titulo'];
        $_SESSION['SSERVER']     = $DATOS['dbserver'];
        $_SESSION['SDBUSER']     = $DATOS['dbuser'];
        $_SESSION['SDBPASS']     = $DATOS['dbpass'];
        $_SESSION['SDBNAME']     = $DATOS['dbname'];
        $_SESSION['SURL']        = $DATOS['url'];
        $_SESSION['DIRSERVER']   = $DATOS['dirserver']; ///variable de carpeta archivos e imagenes


}
$i->cerrar();

?>