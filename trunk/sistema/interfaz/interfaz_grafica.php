<?php
	require_once '../clases/Grafica.php';
	
	$grafica = new Grafica();
	$base_grafica=$_REQUEST['base'];
	$tipo_grafica=$_REQUEST['tipo'];
	if($_REQUEST['estado']!=''){
		$estado_grafica=$_REQUEST['estado'];
	}
	else{
		$estado_grafica=1;
	}
	
	function vacio($var) {
    return ($var != '');
	}
	$graficas = array_filter($_REQUEST, "vacio");

	switch($_REQUEST['base']){
	case 1:
	$resultado = $grafica->graficarActivoNivel();
	$total = count($resultado);
	break;
	case 2:
	$resultado = $grafica->graficarActivoTpActivo();
	$total = count($resultado);
	break;
	case 3:
	$resultado = $grafica->graficarActivoUbicacion();
	$total = count($resultado);
	break;
	}
?>