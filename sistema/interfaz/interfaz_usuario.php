<?php
	require_once '../clases/Usuario.php';
	require_once '../arauca-activos/validar.php';
	
	$usuario = new Usuario();
	
	//$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
		$accion = login;
	
	function vacio($var) {
    return ($var != '');
}
	$usuarios = array_filter($_REQUEST, "vacio");	
	
	switch($accion){
		case 'refrescar':
			$resultado = $usuario->cargarUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $usuario->contarUsuario();
			$total= $resultado3 [0]['count'];
		
			break;
			
		case 'login':
			$resultado = $usuario->cargarUsuarioLogin($_REQUEST['login'], $_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $usuario->contarUsuario();
			$total= $resultado3 [0]['count'];
		echo $resultado;
			break;
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$usuarios = json_decode($cond, true);
			$usuarios = array_filter($usuarios, "vacio");

			
			$respuesta = $usuario->insertarUsuario($usuarios);	
			$resultado = $usuario->cargarUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			break;
			
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$usuarios = array_filter($columnas, "vacio");
			$cond = $_REQUEST['condiciones']; 
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $usuario->actualizarUsuario($usuarios, $condiciones); 		
			$resultado = $usuario->cargarUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			

			break;
			
		
		case 'eliminar':
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $usuario->eliminarUsuario($condiciones); 		
			$resultado = $usuario->cargarUsuario($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "usuarios":'.json_encode($resultado).'}';
?>