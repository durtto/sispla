<?php
	require_once '../clases/Recursiva.php';
	$ubic = 1;
	$recursiva = new Recursiva();
	$ubics= array();
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
	
	/*echo '<pre>';
    print_r($ubicaciones);
	echo '</pre>';*/
	break;
	
	}

?>
