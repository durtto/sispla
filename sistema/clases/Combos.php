<?php
require_once 'MyPDO.php';
	$obj = new MyPDO();
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);

class Combos extends MyPDO  //WARNING: PHP5 does not support multiple inheritance but there is more than 1 superclass defined in your UML model!
{

public function cargarTpDirectorio() {
	
  $query = "SELECT *
                FROM tr050_tipo_directorio;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } // end of member function cargarDocumento


public function cargarTpActivo() {
	
  $query = "SELECT 
  					tr014_tipo_activo.co_tipo_activo, 
  					tr014_tipo_activo.nb_tipo_activo, 
  					tr011_categoria.nb_categoria, 
  					tr013_servicio.nb_servicio
			FROM 
  					public.tr014_tipo_activo, 
  					public.tr013_servicio, 
  					public.tr011_categoria
			WHERE 
  					tr014_tipo_activo.co_categoria = tr011_categoria.co_categoria AND
  					tr014_tipo_activo.co_servicio = tr013_servicio.co_servicio;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } // end of member function cargarDocumento
}
?>