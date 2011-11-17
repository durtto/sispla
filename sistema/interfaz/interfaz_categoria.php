<?php
	require_once '../clases/Categoria.php';
	
	$categoria = new Categoria();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$categorias = array_filter($_REQUEST, "vacio");
	
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $categoria->cargarCategoria($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $categoria->contarCategoria();
			$total= $resultado3 [0]['count'];
			
			break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$categorias = json_decode($cond, true);
			$categorias = array_filter($categorias, "vacio");

		
			$respuesta = $categoria->insertarCategoria($categorias);		
			$resultado = $categoria->cargarCategoria($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$categorias = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $categoria->actualizarCategoria($categorias, $condiciones); 		
			$resultado = $categoria->cargarCategoria($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $categoria->eliminarCategoria($condiciones); 		
			$resultado = $categoria->cargarCategoria($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "categorias":'.json_encode($resultado).'}';
?>