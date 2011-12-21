<?php
	require_once '../clases/PlanLogistica.php';
	
	$planlogistica = new PlanLogistica();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$planeslogistica = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $planlogistica->cargarPlanLogistica($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $planlogistica->contarPlanLogistica();
			$total= $resultado3 [0]['count'];
		
			break;
			
		case 'nuevo':
			
			$resultado = $planlogistica->NuevoPlanLogistica();
			$total= 1;

			break;
							
		case 'alimentacion':
			
			$resultado = $planlogistica->cargarPlanLogisticaAlimentacion($_REQUEST['plan'],$_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$resultado3= $planlogistica->contarPlanLogisticaAlimentacion($_REQUEST['plan']);
			$total= $resultado3 [0]['count'];
		
		break;	
			
		case 'alojamiento':
			
			$resultado = $planlogistica->cargarPlanLogisticaAlojamiento($_REQUEST['plan'],$_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$resultado3= $planlogistica->contarPlanLogisticaAlojamiento($_REQUEST['plan']);
			$total= $resultado3 [0]['count'];
		
		break;		
						
		case 'transporte':
			
			$resultado = $planlogistica->cargarPlanLogisticaTransporte($_REQUEST['plan'],$_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$resultado3= $planlogistica->contarPlanLogisticaTransporte($_REQUEST['plan']);
			$total= $resultado3 [0]['count'];
		
		break;
		
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$planeslogistica = json_decode($cond, true);
			$planeslogistica = array_filter($planeslogistica, "vacio");

			$cond1 = $_REQUEST['palimentaciones'];
			$cond1 = str_replace('\"','"',$cond1);
			$alimentaciones = json_decode($cond1, true);
			$alimentaciones = array_filter($alimentaciones, "vacio");
			
			$cond2 = $_REQUEST['palojamientos'];
			$cond2 = str_replace('\"','"',$cond2);
			$alojamientos = json_decode($cond2, true);
			$alojamientos = array_filter($alojamientos, "vacio");
			
			$cond3 = $_REQUEST['ptransportes'];
			$cond3 = str_replace('\"','"',$cond3);
			$transportes = json_decode($cond3, true);
			$transportes = array_filter($transportes, "vacio");
			
			$cond4 = $_REQUEST['componente'];
			$cond4 = str_replace('\"','"',$cond4);
			$componente = json_decode($cond4, true);
			$componente= array_filter($componente, "vacio");
			
			$respuesta = $planlogistica->insertarPlanLogistica($planeslogistica, $alimentaciones , $alojamientos, $transportes, $componente);		
			$resultado = $planlogistica->cargarPlanLogistica($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$planeslogistica = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $planlogistica->actualizarPlanLogistica($planeslogistica, $condiciones); 		
			$resultado = $planlogistica->cargarPlanLogistica($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $planlogistica->eliminarPlanLogistica($condiciones); 		
			$resultado = $planlogistica->cargarPlanLogistica($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "planeslogistica":'.json_encode($resultado).'}';
?>