<?php
	require_once '../clases/PrivilegioUsuario.php';
	
	$privilegio = new PrivilegioUsuario();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$privilegios = array_filter($_REQUEST, "vacio");
		
	switch($accion){
		case 'refrescar':
			
			$resultado = $privilegio->cargarPrivilegioUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $privilegio->contarPrivilegioUsuario();
			$total= $resultado3 [0]['count'];

			break;
			
		case 'nuevo':
			
			$resultado = $privilegio->NuevoPrivilegio();
			$total= 1;

			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$privilegios = json_decode($cond, true);
			$privilegios = array_filter($privilegios, "vacio");

		
			$respuesta = $privilegio->insertarPrivilegioUsuario($privilegios);		
			$resultado = $privilegio->cargarPrivilegioUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$privilegios = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $privilegio->actualizarPrivilegioUsuario($privilegios, $condiciones); 		
			$resultado = $privilegio->cargarPrivilegioUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $privilegio->eliminarPrivilegioUsuario($condiciones); 		
			$resultado = $privilegio->cargarPrivilegioUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "privilegios":'.json_encode($resultado).'}';
?>