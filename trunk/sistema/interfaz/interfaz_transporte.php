<?php
	require_once '../clases/Transporte.php';
	
	$transporte = new Transporte();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$transportes = array_filter($_REQUEST, "vacio");
	//$filtro = str_replace('\"','"',$_REQUEST["filter"]);
	//$filtros = json_decode($filtro, true);	
	//$vehiculos = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			$resultado = $transporte->cargarTransporte($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $transporte->contarTransporte();
			$total= $resultado3 [0]['count'];
		break;
		
				
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$transportes = json_decode($cond, true);
			$transportes = array_filter($transportes, "vacio");

			$con1 = $_REQUEST['vehiculos']; 	
			$con1	= str_replace('\"','"',$con1);
			$vehiculos = json_decode($con1, true);
			$vehiculos = array_filter($vehiculos, "vacio");
			
			$con2 = $_REQUEST['lineas']; 	
			$con2	= str_replace('\"','"',$con2);
			$lineas = json_decode($con2, true);
			$lineas = array_filter($lineas, "vacio");
			
			$respuesta = $transporte->insertarTransporte($transportes, $vehiculos, $lineas);	
			$resultado = $transporte->cargarTransporte($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
			
			case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$transportes = array_filter($columnas, "vacio");
			$cond = $_REQUEST['condiciones']; 
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $transporte->actualizarTransporte($transportes, $condiciones); 		
			$resultado = $transporte->cargarTransporte($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
			
			/*$respuesta = $general->actualizarGeneral($columnas, $condiciones);		
			$resultado = $general->cargarGeneral($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$tot = $general->contarGeneral();
			$total= $tot[0]['count'];
			for($i=0; $i<count($resultado); $i++)
				$resultado[$i]['resp'] = $respuesta;
				
			if(is_object($general->pdo->monitor) && $general->pdo->monitor->notify_update)
					$general->pdo->popNotify(); // Libera posicion reg_padre
			break;*/
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $transporte->eliminarTransporte($condiciones); 		
			$resultado = $transporte->cargarTransporte($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "transportes":'.json_encode($resultado).'}';
?>
