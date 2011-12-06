<?php
require_once 'MyPDO.php';
	$obj = new MyPDO();
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
	
class Recursiva extends MyPDO  //WARNING: PHP5 does not support multiple inheritance but there is more than 1 superclass defined in your UML model!
{
public function crecursiva($ubic) {
    global $ubicaciones;
	
 $query = "SELECT tr006_ubicacion.co_ubicacion, tr006_ubicacion.nb_ubicacion 
								FROM public.tr006_ubicacion
								WHERE tr006_ubicacion.co_ubicacion_padre= '".$ubic."'";   
   $r = $this->pdo->_query($query);
   $i=0;
   //$recursiva = new Recursiva();
   while($r[$i]['co_ubicacion']){
	   //echo " $i- ";	
	   $ubicaciones[$ubic][$r[$i]['nb_ubicacion']]=$r[$i]['co_ubicacion'];
	   $this->crecursiva($r[$i]['co_ubicacion']);
	   $i++;
	}
   //while ($row = pg_fetch_array($r)){
	//while ($row = pg_fetch_row($r)){
	//echo $row;
	//array_push($ubicaciones, $ubics);	
	//recursiva($row['co_ubicacion']);
	//}
	/*echo '<pre>';
	print_r($ubicaciones);
	echo '</pre>';*/
   //echo '{"Resultados":'.json_encode($r).'}';
	return $ubicaciones;
  }
 
}
?>
