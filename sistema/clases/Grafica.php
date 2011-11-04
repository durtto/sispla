<?php
require_once 'MyPDO.php';
require_once 'Estado.php';
require_once 'Fabricante.php';
require_once 'Persona.php';
require_once 'Ubicacion.php';
require_once 'Proceso.php';
require_once 'Proveedor.php';
require_once 'TipoDeActivo.php';
require_once 'UnidadDeDemanda.php';
require_once 'NivelObsolescencia.php';

/**
 * Se refiere a todos los equipos, aplicaciones y servicios con los que cuenta la Plataforma tecnol�gica
 * @access public
 * @package Planes
 */
class Grafica extends MyPDO
{
	public function graficarActivo() {
	
  $query = "SELECT 
			COUNT (co_activo) AS valor
			FROM 
			  public.tr027_activo;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
  }
}
/*			WHERE 
			a.co_nivel = n.co_nivel AND
			a.co_nivel = '$co_nivel'
			GROUP BY a.co_nivel*/
?>