<?php
	require_once '../clases/Proveedor.php';
	
	$proveedor = new Proveedor();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$proveedores = array_filter($_REQUEST, "vacio");

	
	switch($accion){
		case 'refrescar':
			
			$resultado = $proveedor->cargarProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $proveedor->contarProveedor();
			$total= $resultado3 [0]['count'];


			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$proveedores = json_decode($cond, true);
			$proveedores = array_filter($proveedores, "vacio");

		
			$respuesta = $proveedor->insertarProveedor($proveedores);		
			$resultado = $proveedor->cargarProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$proveedores = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $proveedor->actualizarProveedor($proveedores, $condiciones); 		
			$resultado = $proveedor->cargarProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $proveedor->eliminarProveedor($condiciones); 		
			$resultado = $proveedor->cargarProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "proveedores":'.json_encode($resultado).'}';
?>