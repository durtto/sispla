<?php
	require_once 'Avion.php';
	
	$avion = new Avion();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$aviones = array_filter($_REQUEST, "vacio");
	//$filtro = str_replace('\"','"',$_REQUEST["filter"]);
	//$filtros = json_decode($filtro, true);	
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $avion->cargarAvion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			//$tot = $general->contarCultivos();
			//$total= $tot[0]['count'];
			//for($i=0; $i<count($resultado); $i++)
			//	$resultado[$i]['resp'] = $respuesta;	
			//print_r($resultado);
			//echo '<br>'.json_decode($resultado2, true);  

			//	print_r($resultado);

			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$aviones = json_decode($cond, true);
			$aviones = array_filter($aviones, "vacio");

		
			$respuesta = $avion->insertarAvion($aviones);		
			$resultado = $avion->cargarAvion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$aviones = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $avion->actualizarAvion($aviones, $condiciones); 		
			$resultado = $avion->cargarAvion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $avion->eliminarAvion($condiciones); 		
			$resultado = $avion->cargarAvion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "aviones":'.json_encode($resultado).'}';
?>