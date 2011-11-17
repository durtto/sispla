<?php
	require_once '../clases/Fabricante.php';
	
	$fabricante = new Fabricante();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$fabricantes = array_filter($_REQUEST, "vacio");

	switch($accion){
		case 'refrescar':
			$resultado = $fabricante->cargarFabricante($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $fabricante->contarFabricante();
			$total= $resultado3 [0]['count'];
			
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$fabricantes = json_decode($cond, true);
			$fabricantes = array_filter($fabricantes, "vacio");

			
			$respuesta = $fabricante->insertarFabricante($fabricantes);	
			$resultado = $fabricante->cargarFabricante($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$fabricantes = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
	
			$respuesta = $fabricante->actualizarFabricante($fabricantes, $condiciones); 		
			$resultado = $fabricante->cargarFabricante($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $fabricante->eliminarFabricante($condiciones); 		
			$resultado = $fabricante->cargarFabricante($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "fabricantes":'.json_encode($resultado).'}';
?>