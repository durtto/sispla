<?php
require_once 'MyPDO.php';
	$obj = new MyPDO();
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);

class Combo extends MyPDO  //WARNING: PHP5 does not support multiple inheritance but there is more than 1 superclass defined in your UML model!
{

public function cargarCombo( ) {
 	
switch($accion){
	 	
case 'Tipo_directorio':
   $query = "SELECT *
                FROM tr050_tipo_directorio;";   
   $r = $obj->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
  break;

  } // end of member function cargarDocumento
}
}
?>