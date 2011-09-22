<?php
	require_once '../clases/Combos.php';
	
	$combo = new Combos();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$combos = array_filter($_REQUEST, "vacio");

	switch($accion){
		
	case 'tipo_directorio':
	$resultado = $combo->cargarTpDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'tipo_activo':
	$resultado = $combo->cargarTpActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;		
	case 'departamento':
	$resultado = $combo->cargarDepartamento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;		
	case 'rol':
	$resultado = $combo->cargarRol($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'rol_resp':
	$resultado = $combo->cargarResponsabilidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'grupo':
	$resultado = $combo->cargarGrupo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'guardia':
	$resultado = $combo->cargarGuardia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;			
	}
?>