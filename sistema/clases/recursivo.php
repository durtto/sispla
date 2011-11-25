<?php
require_once 'MyPDO.php';
$ubi = new MyPDO();
function Ubic_Recursiva($ubic){
	
	$r = $ubi->pdo->_query("SELECT tr006_ubicacion.co_ubicacion, 
								FROM public.tr006_ubicacion
								WHERE tr006_ubicacion.co_ubicacion_padre= '".$ubic."'");
	print_r($r);
	/*if(){
	}
	else{
	}*/
}
Ubic_Recursiva(2);
?>
