<?php
	require_once '../clases/Respaldo.php';
	
	$respaldo = new Respaldo();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$respaldos = array_filter($_REQUEST, "vacio");

	
	switch($accion){
		case 'refrescar':
			
			$resultado = $respaldo->cargarRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $respaldo->contarRespaldo();
			$total= $resultado3 [0]['count'];
	
			break;
		
		case 'nuevo':
			
			$resultado = $respaldo->NuevoRespaldo();
			$total= 1;

			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$respaldos = json_decode($cond, true);
			$respaldos = array_filter($respaldos, "vacio");

		
			$respuesta = $respaldo->insertarRespaldo($respaldos);		
			$resultado = $respaldo->cargarRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$respaldos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $respaldo->actualizarRespaldo($respaldos, $condiciones); 		
			$resultado = $respaldo->cargarRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $respaldo->eliminarRespaldo($condiciones); 		
			$resultado = $respaldo->cargarRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "respaldos":'.json_encode($resultado).'}';
?>