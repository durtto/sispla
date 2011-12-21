<?php
	require_once '../clases/Crecimiento.php';
	
	$crecimiento = new Crecimiento();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$crecimientos = array_filter($_REQUEST, "vacio");
	

	switch($accion){
		case 'refrescar':
			$resultado = $crecimiento->cargarCrecimiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $crecimiento->contarCrecimiento();
			$total= $resultado3 [0]['count'];
			
			break;
			
		case 'nuevo':
			
			$resultado = $crecimiento->NuevoCrecimiento();
			$total= 1;

			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$crecimientos = json_decode($cond, true);
			$crecimientos = array_filter($crecimientos, "vacio");

			$respuesta = $crecimiento->insertarCrecimiento($crecimientos);	
			$resultado = $crecimiento->cargarCrecimiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$crecimientos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $crecimiento->actualizarCrecimiento($crecimientos, $condiciones); 		
			$resultado = $crecimiento->cargarCrecimiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;

		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $crecimiento->eliminarCrecimiento($condiciones); 		
			$resultado = $crecimiento->cargarCrecimiento($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "crecimientos":'.json_encode($resultado).'}';
?>