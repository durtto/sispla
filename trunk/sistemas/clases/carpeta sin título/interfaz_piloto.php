<?php
	require_once 'Piloto.php';
	
	$piloto = new Piloto();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$pilotos = array_filter($_REQUEST, "vacio");
	//$filtro = str_replace('\"','"',$_REQUEST["filter"]);
	//$filtros = json_decode($filtro, true);	
	

	switch($accion){
		case 'refrescar':
			$resultado = $piloto->cargarPiloto($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$pilotos = json_decode($cond, true);
			$pilotos = array_filter($pilotos, "vacio");

			//$pilotos = array('co_cedula'=>'16315340', 'nb_piloto'=>'jesus', 'tx_direccion'=>'mi casa');
			
			$respuesta = $piloto->insertarPiloto($pilotos);	
			$resultado = $piloto->cargarPiloto($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$pilotos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
		//	$pilotos = array('nb_piloto'=>'luis', 'tx_direccion'=>'mi casa');
			//$condiciones = array('co_cedula'=>'16315340');
			$respuesta = $piloto->actualizarPiloto($pilotos, $condiciones); 		
			$resultado = $piloto->cargarPiloto($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
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

			$respuesta = $piloto->eliminarPiloto($condiciones); 		
			$resultado = $piloto->cargarPiloto($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "piloto":'.json_encode($resultado).'}';
?>