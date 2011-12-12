<?php
require_once 'MyPDO.php';


/**
 * Se refiere a todos los equipos, aplicaciones y servicios con los que cuenta la Plataforma tecnol�gica
 * @access public
 * @package Planes
 */
$ubic = 5;

class Grafica extends MyPDO
{
	public function graficarActivo($ubic, $nivel) {
	
	$query = "SELECT 
  		count(a.co_activo) 
	FROM 
	  tr027_activo a
	  INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
	  INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
	  INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
	  INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
	  INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
	  INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
	  INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
	  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)
	WHERE 
  		a.co_ubicacion IN (SELECT 
	  	u.co_ubicacion
		FROM 
		tr006_ubicacion u 
		LEFT JOIN tr005_tipo_ubicacion t on (u.co_tipo_ubicacion = t.co_tipo_ubicacion)
		WHERE 
		u.co_ubicacion_padre = u.co_ubicacion_padre AND
		u.co_ubicacion_padre= '".$ubic."') AND a.co_nivel = '".$nivel."' AND ";
		
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
  }
}
?>