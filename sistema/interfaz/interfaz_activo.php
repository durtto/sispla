<?php
	require_once '../clases/Activo.php';
	
	$activo = new Activo();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$activos = array_filter($_REQUEST, "vacio");

	
	switch($accion){
		case 'refrescar':
			
			$resultado = $activo->cargarActivoAA($_REQUEST['ubicacion'], $_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado2= $activo->contarActivo($_REQUEST['ubicacion']);
			$total= $resultado2 [0]['count'];
			break;
		
		case 'critico':
			
			$resultado = $activo->cargarActivoCritico($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$activos = json_decode($cond, true);
			$activos = array_filter($activos, "vacio");

		
			$respuesta = $activo->insertarActivo($activos);		
			$resultado = $activo->cargarActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$activos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $activo->actualizarActivo($activos, $condiciones); 		
			$resultado = $activo->cargarActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $activo->eliminarActivo($condiciones); 		
			$resultado = $activo->cargarActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			//for($i=0; $i<count($resultado); $i++)
     		//$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "activos":'.json_encode($resultado).'}';
?>
