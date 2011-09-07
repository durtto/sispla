<?php
	require_once '../clases/PlanLocalizacion.php';
	
	$planlocalizacion = new PlanLocalizacion();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$planeslocalizacion = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $planlocalizacion->cargarPlanLocalizacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
		
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$planeslocalizacion = json_decode($cond, true);
			$planeslocalizacion = array_filter($planeslocalizacion, "vacio");

		
			$respuesta = $planlocalizacion->insertarPlanLocalizacion($planeslocalizacion);		
			$resultado = $planlocalizacion->cargarPlanLocalizacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$planeslocalizacion = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $planlocalizacion->actualizarPlanLocalizacion($planeslocalizacion, $condiciones); 		
			$resultado = $planlocalizacion->cargarPlanLocalizacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $planlocalizacion->eliminarPlanLocalizacion($condiciones); 		
			$resultado = $planlocalizacion->cargarPlanLocalizacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "planeslocalizacion":'.json_encode($resultado).'}';
?>