<?php
	require_once '../clases/EquipoRequerido.php';
	
	$equiporequerido = new EquipoRequerido();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$equiposrequeridos = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			$resultado = $equiporequerido->cargarEquipoRequerido($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $equiporequerido->contarEquipoRequerido();
			$total= $resultado3 [0]['count'];
			
			break;
			
		case 'nuevo':
			
			$resultado = $equiporequerido->NuevoEquipoRequerido();
			$total= 1;

			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$equiposrequeridos = json_decode($cond, true);
			$equiposrequeridos = array_filter($equiposrequeridos, "vacio");

			
			$con1 = $_REQUEST['personas']; 	
			$con1	= str_replace('\"','"',$con1);
			$personas = json_decode($con1, true);
			$personas = array_filter($personas, "vacio");
			
			$con2 = $_REQUEST['tpactivos']; 	
			$con2	= str_replace('\"','"',$con2);
			$tpactivos = json_decode($con2, true);
			$tpactivos = array_filter($tpactivos, "vacio");
			
			$con3 = $_REQUEST['equipos']; 	
			$con3	= str_replace('\"','"',$con3);
			$equipos = json_decode($con3, true);
			$equipos = array_filter($equipos, "vacio");
		
			$con4 = $_REQUEST['necesarios']; 	
			$con4	= str_replace('\"','"',$con4);
			$necesarios = json_decode($con4, true);
			$necesarios = array_filter($necesarios, "vacio");
			
			$respuesta = $equiporequerido->insertarEquipoRequerido($equiposrequeridos, $personas, $tpactivos, $equipos, $necesarios);	
			$resultado = $equiporequerido->cargarEquipoRequerido($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$equiposrequeridos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $equiporequerido->actualizarEquipoRequerido($equiposrequeridos, $condiciones); 		
			$resultado = $equiporequerido->cargarEquipoRequerido($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
	
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $equiporequerido->eliminarEquipoRequerido($condiciones); 		
			$resultado = $equiporequerido->cargarEquipoRequerido($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "equiposrequeridos":'.json_encode($resultado).'}';
?>