<?php
	require_once '../clases/TipoDirectorio.php';
	
	$tpdirectorio = new TpDirectorio();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$tpdirectorios = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			$resultado = $tpdirectorio->cargarTpDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$tpdirectorios = json_decode($cond, true);
			$tpdirectorios = array_filter($tpdirectorios, "vacio");

			
			$respuesta = $tpdirectorio->insertarTpDirectorio($tpdirectorios);	
			$resultado = $tpdirectorio->cargarTpDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$tpdirectorios = array_filter($columnas, "vacio");
			$cond = $_REQUEST['condiciones']; 
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tpdirectorio->actualizarTpDirectorio($tpdirectorios, $condiciones); 		
			$resultado = $tpdirectorio->cargarTpDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $tpdirectorio->eliminarTpDirectorio($condiciones); 		
			$resultado = $tpdirectorio->cargarTpDirectorio($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "tpdirectorios":'.json_encode($resultado).'}';
?>