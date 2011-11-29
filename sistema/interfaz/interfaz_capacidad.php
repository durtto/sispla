<?php
	require_once '../clases/Capacidad.php';
	
	$capacidad = new Capacidad();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	
	function vacio($var) {
    return ($var != '');
}
	$capacidades = array_filter($_REQUEST, "vacio");

	switch($accion){
		case 'refrescar':
			
			$resultado = $capacidad->cargarCapacidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $capacidad->contarCapacidad();
			$total= $resultado3 [0]['count'];

			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$capacidades = json_decode($cond, true);
			$capacidades = array_filter($capacidades, "vacio");

		
			$respuesta = $capacidad->insertarCapacidad($capacidades);		
			$resultado = $capacidad->cargarCapacidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$capacidades = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $capacidad->actualizarCapacidad($capacidades, $condiciones); 		
			$resultado = $capacidad->cargarCapacidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $capacidad->eliminarCapacidad($condiciones); 		
			$resultado = $capacidad->cargarCapacidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "capacidades":'.json_encode($resultado).'}';
?>