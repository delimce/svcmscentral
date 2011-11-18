<?
    $showCampos = $_SESSION['showCampos'];
    $name = $_SESSION['nombre'];
    if (!isset($name)){ $name = '%'; }
    else { $name = '%'.$name.'%'; }

    $lastName = $_SESSION['apellido'];
    if (!isset($lastName)){ $lastName = '%'; }
    else { $lastName = '%'.$lastName.'%'; }

    $asc = $_SESSION['asc'];
    if ($asc=='asc'){ $asc = 'asc'; }
    else { $asc = 'desc'; }

    $orderBy = $_SESSION['orderBy'];
    if (!isset($orderBy)){ $orderBy = 'ccontacto '.$asc.', ccampo, posicion'; }
    else { $orderBy = 'ccontacto '.$asc.', ccampo, posicion'; }


    $query = " select ";
    $query.= " cs.icono, cs.ccampo, cxc.ccampo ccampo2, cs.icampo,  cs.xcampo ";
    $query.= " , c.ccontacto, c.xnombre, c.xapellido ";
    $query.= " , cxc.xvalor, o.xopcion ";
    $query.= " , o2.xnombre nombreRelacion, o2.xapellido apellidoRelacion ";
    $query.= " from contactos c ";
    $query.= " LEFT JOIN camposxcontacto cxc ON c.ccontacto = cxc.ccontacto ";
    $query.= " LEFT JOIN campos cs ON cxc.ccampo = cs.ccampo ";
    $query.= " LEFT JOIN opcionesxcampo o on ( cxc.ccampo = o.ccampo and cxc.xvalor = o.copcion ) ";
    $query.= " LEFT JOIN contactos o2 ON ( cxc.xvalor = o2.ccontacto ) ";
    $query.= " where ";
    $query.= " c.xnombre like ".comillas_inteligentes($name);
    $query.= " and c.xapellido like ".comillas_inteligentes($lastName);

    $query.= " AND c.ccontacto IN ( SELECT a.ccontacto FROM camposxcontacto a ";
    $query.= " WHERE 1=1 ";
    foreach($_SESSION['ccampo'] as $Key => $Value){
        if ($Value!=''){
            $query.= " AND ( a.ccampo = ".$Key." AND a.xvalor LIKE '%".$Value."%' )";
        }
    }
    $query.= " ) ";

    $query.= " group by ccontacto, ccampo, ccampo2 ";
    $query.= " order by ".$orderBy;

?>