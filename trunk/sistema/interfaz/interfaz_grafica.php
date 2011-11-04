<?php
	require_once '../clases/Grafica.php';
	
	$grafica = new Grafica();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$graficas = array_filter($_REQUEST, "vacio");

	switch($accion){
	
	case 'activo':
	$resultado = $grafica->graficarActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'activo_funcional':
	$resultado = $grafica->graficarActivoFuncional($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	case 'activo_adecuado':
	$resultado = $grafica->graficarActivoAdecuado($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
	$total = count($resultado);
	break;
	}
?>