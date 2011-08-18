<?php
	require_once '../clases/NivelObsolescencia.php';
	
	$nivelobsolescencia = new NivelObsolescencia();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$nivelesobsolescencia = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $nivelobsolescencia->cargarNivelObsolescencia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$nivelesobsolescencia = json_decode($cond, true);
			$nivelesobsolescencia = array_filter($nivelesobsolescencia, "vacio");

		
			$respuesta = $nivelobsolescencia->insertarNivelObsolescencia($nivelesobsolescencia);		
			$resultado = $nivelobsolescencia->cargarNivelObsolescencia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$nivelesobsolescencia = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $nivelobsolescencia->actualizarNivelObsolescencia($nivelesobsolescencia, $condiciones); 		
			$resultado = $nivelobsolescencia->cargarNivelObsolescencia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $nivelobsolescencia->eliminarNivelObsolescencia($condiciones); 		
			$resultado = $nivelobsolescencia->cargarNivelObsolescencia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "NivelObsolescencia":'.json_encode($resultado).'}';
?>