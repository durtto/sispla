<?php
require_once 'MyPDO.php';
	$obj = new MyPDO();
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
    $ubicaciones= array();
	
class Recursiva extends MyPDO  //WARNING: PHP5 does not support multiple inheritance but there is more than 1 superclass defined in your UML model!
{

public function crecursiva($ubic) {
	
  $query = "SELECT tr006_ubicacion.co_ubicacion 
								FROM public.tr006_ubicacion
								WHERE tr006_ubicacion.co_ubicacion_padre= '".$ubic."'";   
   $r = $this->pdo->_query($query);
   //while ($row = pg_fetch_array($r)){
	//while ($row = pg_fetch_row($r)){
	//echo $row;
	//array_push($ubicaciones, $row['co_ubicacion']);	
	//recursiva($row['co_ubicacion']);
	//}

   echo '{"Resultados":'.json_encode($r).'}';

  }
 
}
?>
