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
			//$total = count($resultado);
			$resultado3= $planlocalizacion->contarPlanLocalizacion();
			$total= $resultado3 [0]['count'];
		
			break;
			
		case 'nuevo':
			
			$resultado = $planlocalizacion->NuevoPlanLocalizacion();
			$total= 1;

			break;
			
			case 'persona':
			
			$resultado = $planlocalizacion->cargarPlanLocalizacionPersona($_REQUEST['plan'],$_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$resultado3= $planlocalizacion->contarPlanLocalizacionPersona($_REQUEST['plan']);
			$total= $resultado3 [0]['count'];
		
			break;	
			
			case 'proveedor':
			
			$resultado = $planlocalizacion->cargarPlanLocalizacionProveedor($_REQUEST['plan'],$_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$resultado3= $planlocalizacion->contarPlanLocalizacionProveedor($_REQUEST['plan']);
			$total= $resultado3 [0]['count'];
		
			break;
			
			case 'directorio':
			
			$resultado = $planlocalizacion->cargarPlanLocalizacionDirectorio($_REQUEST['plan'],$_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$resultado3= $planlocalizacion->contarPlanLocalizacionDirectorio($_REQUEST['plan']);
			$total= $resultado3 [0]['count'];
		
			break;
						
			case 'equipo':
			
			$resultado = $planlocalizacion->cargarPlanLocalizacionEquipo($_REQUEST['plan'],$_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$resultado3= $planlocalizacion->contarPlanLocalizacionEquipo($_REQUEST['plan']);
			$total= $resultado3 [0]['count'];
		
			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$planeslocalizacion = json_decode($cond, true);
			$planeslocalizacion = array_filter($planeslocalizacion, "vacio");

			$cond1 = $_REQUEST['proveedores'];
			$cond1 = str_replace('\"','"',$cond1);
			$proveedores = json_decode($cond1, true);
			$proveedores = array_filter($proveedores, "vacio");

			$cond2 = $_REQUEST['directorios'];
			$cond2 = str_replace('\"','"',$cond2);
			$directorios = json_decode($cond2, true);
			$directorios = array_filter($directorios, "vacio");
			
			$cond3 = $_REQUEST['personas'];
			$cond3 = str_replace('\"','"',$cond3);
			$personas = json_decode($cond3, true);
			$personas = array_filter($personas, "vacio");
			
			$cond4 = $_REQUEST['equipos'];
			$cond4 = str_replace('\"','"',$cond4);
			$equipos = json_decode($cond4, true);
			$equipos = array_filter($equipos, "vacio");					
			
			$cond5 = $_REQUEST['componente'];
			$cond5 = str_replace('\"','"',$cond5);
			$componente = json_decode($cond5, true);
			$componente= array_filter($componente, "vacio");	
			
			
			$respuesta = $planlocalizacion->insertarPlanLocalizacion($planeslocalizacion, $proveedores, $directorios, $personas, $equipos, $componente);		
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