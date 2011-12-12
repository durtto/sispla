<?php
require_once 'MyPDO.php';


/**
 * Se refiere a todos los equipos, aplicaciones y servicios con los que cuenta la Plataforma tecnol�gica
 * @access public
 * @package Planes
*/	
class Grafica extends MyPDO
{
	public function graficarActivoNivel() {
	
	$query="SELECT count(a.co_activo) AS valor, n.nb_nivel AS nombre
			FROM tr027_activo a
			INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
			INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
			INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
			INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
			INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
			INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
			INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
			LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)
			GROUP BY n.co_nivel, n.nb_nivel
			ORDER BY n.co_nivel";
		
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
  }
	
  public function graficarActivoTpActivo() {
	
	$query="SELECT count(a.co_tipo_activo) AS valor, t.nb_tipo_activo AS nombre
			FROM tr027_activo a
			INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
			INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
			INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
			INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
			INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
			INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
			INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
			LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)
			GROUP BY t.co_tipo_activo, t.nb_tipo_activo
			ORDER BY t.co_tipo_activo";
		
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
  }	
  
    public function graficarActivoUbicacion() {
	
	$query="SELECT count(a.co_ubicacion) AS valor, u.nb_ubicacion AS nombre
			FROM tr027_activo a
			INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
			INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
			INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
			INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
			INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
			INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
			INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
			LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)
			GROUP BY u.co_ubicacion, u.nb_ubicacion
			ORDER BY u.co_ubicacion";
			break;
		
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
  }	
  
	
}
?>