<?php
require_once 'MyPDO.php';
require_once 'Ubicacion.php';
$ubicaciones= array();
$ubic = 5;
print_r($ubic);

function recursiva($ubic){
	$query="SELECT tr006_ubicacion.co_ubicacion 
								FROM public.tr006_ubicacion
								WHERE tr006_ubicacion.co_ubicacion_padre= '".$ubic."'";
	$r = $ubic->pdo->_query($query);
	return $r;
	/*if ($r!=NULL){
	while ($row = pg_fetch_array($r)){
	array_push($ubicaciones, $row['co_ubicacion']);	
	$ubic = $this->recursiva($row['co_ubicacion'] $ubic );}
			
	}
	else
	{
		return $r;    //break;
	print_r($row);
	}
 echo '{"Resultados":'.json_encode($r).'}';	*/
}

?>
