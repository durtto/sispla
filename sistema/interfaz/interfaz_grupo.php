<?php
	require_once '../clases/Grupo.php';
	
	$grupo = new Grupo();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$grupos = array_filter($_REQUEST, "vacio");

	switch($accion){
		case 'refrescar':
			
			$resultado = $grupo->cargarGrupo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $grupo->contarGrupo();
			$total= $resultado3 [0]['count'];
			

			break;
			
			case 'nuevo':
			
			$resultado = $grupo->NuevoGrupo();
			$total= $resultado3 [0]['count'];

			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$grupos = json_decode($cond, true);
			$grupos = array_filter($grupos, "vacio");

		
			$respuesta = $grupo->insertarGrupo($grupos);		
			$resultado = $grupo->cargarGrupo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$grupos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $grupo->actualizarGrupo($grupos, $condiciones); 		
			$resultado = $grupo->cargarGrupo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $grupo->eliminarGrupo($condiciones); 		
			$resultado = $grupo->cargarGrupo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "grupos":'.json_encode($resultado).'}';
?>