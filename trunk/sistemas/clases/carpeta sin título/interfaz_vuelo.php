<?php
	require_once 'Vuelo.php';
	
	$vuelo = new Vuelo();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$vuelos = array_filter($_REQUEST, "vacio");
	//$filtro = str_replace('\"','"',$_REQUEST["filter"]);
	//$filtros = json_decode($filtro, true);	
	
	switch($accion){
		case 'refrescar':
			$resultado = $vuelo->cargarVuelo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			//$tot = $general->contarCultivos();
			//$total= $tot[0]['count'];
			//for($i=0; $i<count($resultado); $i++)
			//	$resultado[$i]['resp'] = $respuesta;	
			//print_r($resultado);
			//echo '<br>'.json_decode($resultado2, true);  

			//	print_r($resultado);

			/*if(is_object($general->pdo->monitor) && $general->pdo->monitor->notify_select)
					$general->pdo->popNotify(); // Libera posicion reg_padre
		*/	break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$vuelos = json_decode($cond, true);
			$vuelos = array_filter($vuelos, "vacio");

			
			$respuesta = $vuelo->insertarVuelo($vuelos);	
			$resultado = $vuelo->cargarVuelo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$vuelos = array_filter($columnas, "vacio");
			$cond = $_REQUEST['condiciones']; 
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $vuelo->actualizarVuelo($vuelos, $condiciones); 		
			$resultado = $vuelo->cargarVuelo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
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
			
			$respuesta = $vuelo->eliminarVuelo($condiciones); 		
			$resultado = $vuelo->cargarVuelo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "vuelos":'.json_encode($resultado).'}';
?>