<?php
	require_once '../clases/VehiculoEmpresa.php';
	
	$vehiculo = new VehiculoEmpresa();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$vehiculos = array_filter($_REQUEST, "vacio");
	
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $vehiculo->cargarVehiculo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $vehiculo->contarVehiculo();
			$total= $resultado3 [0]['count'];
			

			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$vehiculos = json_decode($cond, true);
			$vehiculos = array_filter($vehiculos, "vacio");

			$respuesta = $vehiculo->insertarVehiculo($vehiculos);		
			$resultado = $vehiculo->cargarVehiculo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$vehiculos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $vehiculo->actualizarVehiculo($vehiculos, $condiciones); 		
			$resultado = $vehiculo->cargarVehiculo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $vehiculo->eliminarVehiculo($condiciones); 		
			$resultado = $vehiculo->cargarVehiculo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "vehiculos":'.json_encode($resultado).'}';
?>