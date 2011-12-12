<?php
	require_once '../clases/Falla.php';
	
	$falla = new Falla();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$fallas = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $falla->cargarFalla($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $falla->contarFalla();
			$total= $resultado3 [0]['count'];

			break;
			
		case 'tipo_activo':
			
			$resultado = $falla->cargarTpActivo();
			$total = count($resultado);
			//$resultado3= $falla->contarFalla();
			//$total= $resultado3 [0]['count'];

		break;	
			
		case 'activo':
			
			$resultado = $falla->cargarActivo($_REQUEST['tpactivo']);
			$total = count($resultado);
			//$resultado3= $falla->contar();
			//$total= $resultado3 [0]['count'];

		break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$fallas = json_decode($cond, true);
			$fallas = array_filter($fallas, "vacio");

		
			$respuesta = $falla->insertarFalla($fallas);		
			$resultado = $falla->cargarFalla($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$fallas = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $falla->actualizarFalla($fallas, $condiciones); 		
			$resultado = $falla->cargarFalla($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $falla->eliminarFalla($condiciones); 		
			$resultado = $falla->cargarFalla($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "fallas":'.json_encode($resultado).'}';
?>