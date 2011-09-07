<?php
	require_once '../clases/TipoDeActivo.php';
	
	$tpactivo = new TpActivo();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$tpactivos = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			$resultado = $tpactivo->cargarTpActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$tpactivos = json_decode($cond, true);
			$tpactivos = array_filter($tpactivos, "vacio");

			
			$respuesta = $tpactivo->insertarTpActivo($tpactivos);	
			$resultado = $tpactivo->cargarTpActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$tpactivos = array_filter($columnas, "vacio");
			$cond = $_REQUEST['condiciones']; 
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tpactivo->actualizarTpActivo($tpactivos, $condiciones); 		
			$resultado = $tpactivo->cargarTpActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tpactivo->eliminarTpActivo($condiciones); 		
			$resultado = $tpactivo->cargarTpActivo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "tpactivos":'.json_encode($resultado).'}';
?>