<?php
	require_once '../clases/Directorio.php';
	
	$directorio = new Directorio();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$directorios = array_filter($_REQUEST, "vacio");

	
	switch($accion){
		case 'refrescar':
			
			$resultado = $directorio->cargarDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $directorio->contarDirectorio();
			$total= $resultado3 [0]['count'];
	
			break;
			
		case 'nuevo':
			
			$resultado = $directorio->NuevoDirectorio();
			$total= 1;

			break;	
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$directorios = json_decode($cond, true);
			$directorios = array_filter($directorios, "vacio");

		
			$respuesta = $directorio->insertarDirectorio($directorios);		
			$resultado = $directorio->cargarDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$directorios = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $directorio->actualizarDirectorio($directorios, $condiciones); 		
			$resultado = $directorio->cargarDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $directorio->eliminarDirectorio($condiciones); 		
			$resultado = $directorio->cargarDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "directorios":'.json_encode($resultado).'}';
?>