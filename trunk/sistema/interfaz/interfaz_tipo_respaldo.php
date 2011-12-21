<?php
	require_once '../clases/TipoDeRespaldo.php';
	
	$tprespaldo = new TpRespaldo();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$tprespaldos = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			$resultado = $tprespaldo->cargarTpRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $tprespaldo->contarTpRespaldo();
			$total= $resultado3 [0]['count'];
			
			break;
		
		case 'nuevo':
			
			$resultado = $tprespaldo->NuevoTpRespaldo();
			$total= 1;

			break;
		
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$tprespaldos = json_decode($cond, true);
			$tprespaldos = array_filter($tprespaldos, "vacio");

			
			$respuesta = $tprespaldo->insertarTpRespaldo($tprespaldos);	
			$resultado = $tprespaldo->cargarTpRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$tprespaldos = array_filter($columnas, "vacio");
			$cond = $_REQUEST['condiciones']; 
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tprespaldo->actualizarTpRespaldo($tprespaldos, $condiciones); 		
			$resultado = $tprespaldo->cargarTpRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tprespaldo->eliminarTpRespaldo($condiciones); 		
			$resultado = $tprespaldo->cargarTpRespaldo($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "tprespaldos":'.json_encode($resultado).'}';
?>