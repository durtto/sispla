<?php
	require_once '../clases/Alojamiento.php';
	
	$alojamiento = new Alojamiento();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$alojamientos = array_filter($_REQUEST, "vacio");
		
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $alojamiento->cargarAlojamiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $alojamiento->contarAlojamiento();
			$total= $resultado3 [0]['count'];
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$alojamientos = json_decode($cond, true);
			$alojamientos = array_filter($alojamientos, "vacio");

		
			$respuesta = $alojamiento->insertarAlojamiento($alojamientos);		
			$resultado = $alojamiento->cargarAlojamiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'nuevo':
			
		$resultado = $alojamiento->NuevoAlojamiento();
		$total= 1;

		break;
		
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$alojamientos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $alojamiento->actualizarAlojamiento($alojamientos, $condiciones); 		
			$resultado = $alojamiento->cargarAlojamiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $alojamiento->eliminarAlojamiento($condiciones); 		
			$resultado = $alojamiento->cargarAlojamiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "alojamientos":'.json_encode($resultado).'}';
?>