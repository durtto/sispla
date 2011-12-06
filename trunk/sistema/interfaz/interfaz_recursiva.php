<?php
	require_once '../clases/Recursiva.php';
	$ubic = 3;
	$recursiva = new Recursiva();
	$ubics= array();
	$ubicaciones=array();
	//print_r($ubicaciones);
	//$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	$accion= 'recursiva';
	
	function vacio($var) {
    return ($var != '');
}
	$recursivas = array_filter($_REQUEST, "vacio");
	switch($accion){
	case 'recursiva':
	$resultado = $recursiva->crecursiva($ubic);
	
	echo '<pre>';
    print_r($resultado);
	echo '</pre>';
	break;
	
	}

?>
