<?php
	require_once '../clases/ContactoProveedor.php';
	require_once '../clases/Proveedor.php';
	
	$contacto = new ContactoProveedor();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$aviones = array_filter($_REQUEST, "vacio");
	
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $contacto->cargarContactoProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $contacto->contarContactoProveedor();
			$total= $resultado3 [0]['count'];
		

			break;
			
		case 'nuevo':
			
			$resultado = $contacto->NuevoContactoProveedor();
			$total= 1;
			break;	
			
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$contactos = json_decode($cond, true);
			$contactos = array_filter($contactos, "vacio");

			$respuesta = $contacto->insertarContactoProveedor($contactos);		
			$resultado = $contacto->cargarContactoProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$contactos = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $contacto->actualizarContactoProveedor($contactos, $condiciones); 		
			$resultado = $contacto->cargarContactoProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $contacto->eliminarContactoProveedor($condiciones); 		
			$resultado = $contacto->cargarContactoProveedor($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "contactos":'.json_encode($resultado).'}';
?>