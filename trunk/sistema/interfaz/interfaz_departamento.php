<?php
	require_once '../clases/Departamento.php';
	
	$departamento = new Departamento();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$departamentos = array_filter($_REQUEST, "vacio");

	switch($accion){
		case 'refrescar':
			
			$resultado = $departamento->cargarDepartamento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $departamento->contarDepartamento();
			$total= $resultado3 [0]['count'];
			

			break;
			
		case 'nuevo':
			
			$resultado = $departamento->NuevoDepartamento();
			$total= 1;

			break;
			
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$departamentos = json_decode($cond, true);
			$departamentos = array_filter($departamentos, "vacio");

		
			$respuesta = $departamento->insertarDepartamento($departamentos);		
			$resultado = $departamento->cargarDepartamento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$departamentos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $departamento->actualizarDepartamento($departamentos, $condiciones); 		
			$resultado = $departamento->cargarDepartamento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $departamento->eliminarDepartamento($condiciones); 		
			$resultado = $departamento->cargarDepartamento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "departamentos":'.json_encode($resultado).'}';
?>