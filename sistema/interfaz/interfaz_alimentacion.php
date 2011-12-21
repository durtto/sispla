<?php
	require_once '../clases/Alimentacion.php';
	
	$alimentacion = new Alimentacion();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$alimentos = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $alimentacion->cargarAlimentacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $alimentacion->contarAlimentacion();
			$total= $resultado3 [0]['count'];

			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$alimentos = json_decode($cond, true);
			$alimentos = array_filter($alimentos, "vacio");

		
			$respuesta = $alimentacion->insertarAlimentacion($alimentos);		
			$resultado = $alimentacion->cargarAlimentacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
			
		case 'nuevo':
			
			$resultado = $alimentacion->NuevoAlimentacion();
			$total= 1;

			break;
			
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$alimentos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $alimentacion->actualizarAlimentacion($alimentos, $condiciones); 		
			$resultado = $alimentacion->cargarAlimentacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");		
				
			$respuesta = $alimentacion->eliminarAlimentacion($condiciones); 		
			$resultado = $alimentacion->cargarAlimentacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			//for($i=0; $i<count($resultado); $i++)
     		//$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "alimentos":'.json_encode($resultado).'}';
?>