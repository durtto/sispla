<?php
	require_once '../clases/RolResponsabilidad.php';
	
	$rolresponsabilidad = new RolResponsabilidad();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$rolresponsabilidades = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $rolresponsabilidad->cargarRolResponsabilidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $rolresponsabilidad->contarRolResponsabilidad();
			$total= $resultado3 [0]['count'];

			break;
		
		case 'nuevo':
			
			$resultado = $rolresponsabilidad->NuevoRolResponsabilidad();
			$total= 1;

			break;
		
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$rolresponsabilidades = json_decode($cond, true);
			$rolresponsabilidades = array_filter($rolresponsabilidades, "vacio");

		
			$respuesta = $rolresponsabilidad->insertarRolResponsabilidad($rolresponsabilidades);		
			$resultado = $rolresponsabilidad->cargarRolResponsabilidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$rolresponsabilidades = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $rolresponsabilidad->actualizarRolResponsabilidad($rolresponsabilidades, $condiciones); 		
			$resultado = $rolresponsabilidad->cargarRolResponsabilidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $rolresponsabilidad->eliminarRolResponsabilidad($condiciones); 		
			$resultado = $rolresponsabilidad->cargarRolResponsabilidad($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "rolresponsabilidades":'.json_encode($resultado).'}';
?>