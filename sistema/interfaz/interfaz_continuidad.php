<?php
	require_once '../clases/Continuidad.php';
	
	$continuidad = new Continuidad();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$$continuidades = array_filter($_REQUEST, "vacio");
	
	

	switch($accion){
		case 'refrescar':
			$resultado = $continuidad->cargarContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $continuidad->contarContinuidad();
			$total= $resultado3 [0]['count'];
			
			break;
			
	case 'nuevo':
			
			$resultado = $continuidad->NuevoContinuidad();
			$total= 1;

			break;		
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$continuidades = json_decode($cond, true);
			$continuidades = array_filter($continuidades, "vacio");

		
			$respuesta = $continuidad->insertarContinuidad($continuidades);	
			$resultado = $continuidad->cargarContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$continuidades = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			$respuesta = $continuidad->actualizarContinuidad($continuidades, $condiciones); 		
			$resultado = $continuidad->cargarContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
			
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $continuidad->eliminarContinuidad($condiciones); 		
			$resultado = $continuidad->cargarContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "continuidades":'.json_encode($resultado).'}';
?>