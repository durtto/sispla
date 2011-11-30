<?php
	require_once '../clases/EquipoContinuidad.php';
	
	$equipocont = new EquipoContinuidad();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$equiposcont = array_filter($_REQUEST, "vacio");

	switch($accion){
		case 'refrescar':
			$resultado = $equipocont->cargarEquipoContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $equipocont->contarEquipoContinuidad();
			$total= $resultado3 [0]['count'];
			
			break;
		case 'clienteproceso':
			$resultado = $equipocont->cargarEquipoContinuidadProceso($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$equiposcont = json_decode($cond, true);
			$equiposcont = array_filter($equiposcont, "vacio");

			
			$respuesta = $equipocont->insertarEquipoContinuidad($equiposcont);	
			$resultado = $equipocont->cargarEquipoContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$equiposcont = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
	
			$respuesta = $equipocont->actualizarEquipoContinuidad($equiposcont, $condiciones); 		
			$resultado = $equipocont->cargarEquipoContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $equipocont->eliminarEquipoContinuidad($condiciones); 		
			$resultado = $equipocont->cargarEquipoContinuidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "equipos":'.json_encode($resultado).'}';
?>