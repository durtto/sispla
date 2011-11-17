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
	case 'tipo_respaldo':
	$resultado = $combo->cargarTpRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'tipo_ubicacion':
	$resultado = $combo->cargarTpUbicacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'ubicacion_padre':
	$resultado = $combo->cargarUbicacionPadre($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
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
	case 'estado':
	$resultado = $combo->cargarEstado($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'proceso':
	$resultado = $combo->cargarProceso($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'proveedor':
	$resultado = $combo->cargarProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'nivel':
	$resultado = $combo->cargarNivel($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'unidad':
	$resultado = $combo->cargarUnidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'ubicacion':
	$resultado = $combo->cargarUbicacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'fabricante':
	$resultado = $combo->cargarFabricante($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'modelo':
	$resultado = $combo->cargarModelo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'activo':
	$resultado = $combo->cargarActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'servicio':
	$resultado = $combo->cargarServicio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'capacidad':
	$resultado = $combo->cargarCapacidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;	
	case 'categoria':
	$resultado = $combo->cargarCategoria($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'privilegio':
	$resultado = $combo->cargarPrivilegio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'caracteristica':
	$resultado = $combo->cargarCaracteristica($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	}

?>