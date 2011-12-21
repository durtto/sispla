<?php
	require_once '../clases/TipoDeUbicacion.php';
	
	$tpubicacion = new Tpubicacion();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$tpubicaciones = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			$resultado = $tpubicacion->cargarTpubicacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $tpubicacion->contarTpubicacion();
			$total= $resultado3 [0]['count'];
		
			break;
			
		case 'nuevo':
			
			$resultado = $tpubicacion->NuevoTpubicacion();
			$total= 1;

			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$tpubicaciones = json_decode($cond, true);
			$tpubicaciones = array_filter($tpubicaciones, "vacio");

			
			$respuesta = $tpubicacion->insertarTpubicacion($tpubicaciones);	
			$resultado = $tpubicacion->cargarTpubicacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$tpubicaciones = array_filter($columnas, "vacio");
			$cond = $_REQUEST['condiciones']; 
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tpubicacion->actualizarTpubicacion($tpubicaciones, $condiciones); 		
			$resultado = $tpubicacion->cargarTpubicacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
			
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tpubicacion->eliminarTpubicacion($condiciones); 		
			$resultado = $tpubicacion->cargarTpubicacion($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "tpubicaciones":'.json_encode($resultado).'}';
?>