<?php
	require_once '../clases/Garantia.php';
	
	$garantia = new Garantia();
	
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
	function vacio($var) {
    return ($var != '');
}
	$garantias = array_filter($_REQUEST, "vacio");
	
	switch($accion){
		case 'refrescar':
			
			$resultado = $garantia->cargarGarantia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			//$total = count($resultado);
			$resultado3= $garantia->contarGarantia();
			$total= $resultado3 [0]['count'];
		

			break;
		
		case 'nuevo':
			
			$resultado = $garantia->NuevoGarantia();
			$total= 1;

			break;
			
		case 'tipo_activo':
			
			$resultado = $garantia->cargarTpActivo($_REQUEST['ubicacion']);
			$total = count($resultado);
			//$resultado3= $falla->contarFalla();
			//$total= $resultado3 [0]['count'];

		break;	
			
		case 'activo':
			
			$resultado = $garantia->cargarActivo($_REQUEST['ubicacion'],$_REQUEST['tpactivo']);
			$total = count($resultado);
			//$resultado3= $falla->contar();
			//$total= $resultado3 [0]['count'];

		break;
		case 'insertar':	 			
			
			$cond = $_REQUEST['columnas'];
			$cond = str_replace('\"','"',$cond);
			$garantias = json_decode($cond, true);
			$garantias = array_filter($garantias, "vacio");

		
			$respuesta = $garantia->insertarGarantia($garantias);		
			$resultado = $garantia->cargarGarantia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);

			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		case 'actualizar':
			
			
			$col = $_REQUEST['columnas']; 			
			$cond = $_REQUEST['condiciones']; 
			$col	= str_replace('\"','"',$col);
			$columnas = json_decode($col, true); 
			$garantias = array_filter($columnas, "vacio");
			$cond	= str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");

			$respuesta = $garantia->actualizarGarantia($garantias, $condiciones); 		
			$resultado = $garantia->cargarGarantia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
				

			break;
		
		case 'eliminar':
			
			$cond = $_REQUEST['condiciones'];
			$cond = str_replace('\"','"',$cond);
			$condiciones = json_decode($cond, true);
			$condiciones = array_filter($condiciones, "vacio");
			
			$respuesta = $garantia->eliminarGarantia($condiciones); 		
			$resultado = $garantia->cargarGarantia($_REQUEST['start'], $_REQUEST['limit'], $_REQUEST["sort"], $_REQUEST["dir"]);
			$total = count($resultado);
			
			for($i=0; $i<count($resultado); $i++)
     		$resultado[$i]['resp'] = $respuesta;
			
		break;
		
	}
		
		echo $resultado2='{"total":'.$total.', "garantias":'.json_encode($resultado).'}';
?>