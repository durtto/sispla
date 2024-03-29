<?php
require_once 'MyPDO.php';
require_once 'Estado.php';
require_once 'Fabricante.php';
require_once 'Persona.php';
require_once 'Ubicacion.php';
require_once 'Proceso.php';
require_once 'Proveedor.php';
require_once 'TipoDeActivo.php';
require_once 'NivelObsolescencia.php';

/**
 * Se refiere a todos los equipos, aplicaciones y servicios con los que cuenta la Plataforma tecnol�gica
 * @access public
 * @package Planes
 */
class Activo extends MyPDO
{

/**
   * 
   * @access public
   */
    public $columActivo= array('co_activo'=>'co_activo','nb_activo'=>'nb_activo','tx_descripcion'=>'tx_descripcion','co_sap'=>'co_sap','nu_serial'=>'nu_serial','nu_etiqueta'=>'nu_etiqueta', 'bo_critico'=>'bo_critico', 'bo_vulnerable'=>'bo_vulnerable','fe_incorporacion'=>'fe_incorporacion','nu_vida_util'=>'nu_vida_util','co_activo_padre'=>'co_activo_padre','co_estado'=>'co_estado','co_fabricante'=>'co_fabricante','co_indicador'=>'co_indicador','co_ubicacion'=>'co_ubicacion','co_proceso'=>'co_proceso','co_proveedor'=>'co_proveedor','co_tipo_activo'=>'co_tipo_activo','co_nivel'=>'co_nivel','bo_soporte_tecnico'=>'bo_soporte_tecnico','bo_limitacion_expansion'=>'bo_limitacion_expansion','bo_costo_mantenimiento'=>'bo_costo_mantenimiento');

  /**
   * 
   * @access public
   */
  /**
   * 
   *
   * @return string
   * @access public
   */
  
  
   public function contarActivo($ubic) {
	$contar = "SELECT 
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
		u.co_ubicacion_padre= '".$ubic."')";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  } 
  
     public function NuevoActivo() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_activo FROM tr027_activo
		ORDER BY co_activo DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
  public function insertarActivo($activo) {
  	
	$this->pdo->beginTransaction();	

	$activo = array_intersect_key($activo, $this->columActivo);
	
	$r1 = $this->pdo->_insert('tr027_activo', $activo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member a function insertarActivo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarActivo($activo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$activo = array_intersect_key($activo, $this->columActivo);
	
	$r1 = $this->pdo->_update('tr027_activo', $activo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarActivo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarActivo($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr027_activo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarActivo

  /**
   * 
   *
   * @return string
   * @access public
   */

  public function cargarActivo($ubic, $start='0', $limit='ALL', $sort = "", $dir = "ASC") {
	$query = "SELECT 
		  a.co_activo, 
		  a.nb_activo,  
		  a.nu_serial, 
		  a.tx_descripcion, 
		  a.nu_etiqueta, 
		  a.fe_incorporacion,
		  a.nu_vida_util, 
		  e.nb_estado, 
		  a.co_estado, 
		  a.co_fabricante, 
		  f.nb_fabricante, 
		  a.co_indicador, 
		  p.co_indicador, 
		  a.co_ubicacion, 
		  u.nb_ubicacion, 
		  a.co_proceso, 
		  po.nb_proceso, 
		  a.co_proveedor, 
		  pr.nb_proveedor,
		  cp.co_capacidad,
		  cp.nb_capacidad,
          c.co_categoria,
          c.nb_categoria, 
		  a.co_nivel,  
		  n.nb_nivel, 
		  a.co_tipo_activo, 
		  t.nb_tipo_activo, 
		  a.co_sap, 
		  a.co_activo_padre,
		  CASE
		  WHEN a.bo_critico = true
		  THEN 'SI'
		  ELSE 'NO'
		  END AS bo_critico,
		  CASE
		  WHEN a.bo_vulnerable = true
		  THEN 'SI'
		  ELSE 'NO'
		  END AS bo_vulnerable,
		  CASE
		  WHEN a.bo_soporte_tecnico = true
		  THEN 'SI'
		  ELSE 'NO'
		  END AS bo_soporte_tecnico,
		  CASE
		  WHEN a.bo_costo_mantenimiento = true
		  THEN 'SI'
		  ELSE 'NO'
		  END AS bo_costo_mantenimiento,
		  CASE
		  WHEN a.bo_limitacion_expansion = true
		  THEN 'SI'
		  ELSE 'NO'
		  END AS bo_limitacion_expansion
		FROM 
  			tr027_activo a
		  INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
		  INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
		  INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
		  INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
		  INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
		  INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
		  INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
		  INNER JOIN tr013_servicio s ON (t.co_servicio = s.co_servicio)
		  INNER JOIN tr012_capacidad cp ON (s.co_capacidad = cp.co_capacidad)
	      INNER JOIN tr011_categoria c ON (c.co_categoria = t.co_categoria)
		  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)";
			if ($ubic != "")
			{
			$query	.= "WHERE 
		  	a.co_ubicacion IN (SELECT 
		  	u.co_ubicacion
			FROM 
			tr006_ubicacion u 
			LEFT JOIN tr005_tipo_ubicacion t on (u.co_tipo_ubicacion = t.co_tipo_ubicacion)
			WHERE 
			u.co_ubicacion_padre = u.co_ubicacion_padre AND
			u.co_ubicacion_padre= '".$ubic."')";
			}
	if ($sort != "") {
		$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	//echo $query;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivo  
  
  public function cargarTpActivo($ubic, $start='0', $limit='ALL', $sort = "", $dir = "ASC") {
	$query = "SELECT DISTINCT a.co_tipo_activo, t.nb_tipo_activo
		 FROM 
  		 tr027_activo a
		  INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
		  INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
		  INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
		  INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
		  INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
		  INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
		  INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
		  INNER JOIN tr013_servicio s ON (t.co_servicio = s.co_servicio)
		  INNER JOIN tr012_capacidad cp ON (s.co_capacidad = cp.co_capacidad)
	      INNER JOIN tr011_categoria c ON (c.co_categoria = t.co_categoria)
		  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)";
			if ($ubic != "")
			{
			$query	.= "WHERE 
		  	a.co_ubicacion IN (SELECT 
		  	u.co_ubicacion
			FROM 
			tr006_ubicacion u 
			LEFT JOIN tr005_tipo_ubicacion t on (u.co_tipo_ubicacion = t.co_tipo_ubicacion)
			WHERE 
			u.co_ubicacion_padre = u.co_ubicacion_padre AND
			u.co_ubicacion_padre= '".$ubic."')";
			}
	if ($sort != "") {
		$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	//echo $query;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivo  
  
  
     public function cargarActivoCritico($ubic, $start='0', $limit='ALL', $sort = "", $dir = "ASC") {
	$query = "SELECT 
		  a.co_activo, 
		  a.nb_activo,  
		  a.nu_serial, 
		  a.tx_descripcion, 
		  a.nu_etiqueta, 
		  a.fe_incorporacion, 
		  a.nu_vida_util, 
		  e.nb_estado, 
		  a.co_estado, 
		  a.co_fabricante, 
		  f.nb_fabricante, 
		  a.co_indicador, 
		  p.co_indicador, 
		  a.co_ubicacion, 
		  u.nb_ubicacion, 
		  a.co_proceso, 
		  po.nb_proceso, 
		  a.co_proveedor, 
		  pr.nb_proveedor,
		  cp.co_capacidad,
		  cp.nb_capacidad,
          c.co_categoria,
          c.nb_categoria, 
		  a.co_nivel,  
		  n.nb_nivel, 
		  a.co_tipo_activo, 
		  t.nb_tipo_activo, 
		  a.co_sap, 
		  a.co_activo_padre,
		  CASE
		  WHEN a.bo_critico = true
		  THEN 'SI'
		  ELSE 'NO'
		  END AS bo_critico,
		  CASE
		  WHEN a.bo_vulnerable = true
		  THEN 'SI'
		  ELSE 'NO'
		  END AS bo_vulnerable
		FROM 
  			tr027_activo a
		  INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
		  INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
		  INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
		  INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
		  INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
		  INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
		  INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
		  INNER JOIN tr013_servicio s ON (t.co_servicio = s.co_servicio)
		  INNER JOIN tr012_capacidad cp ON (s.co_capacidad = cp.co_capacidad)
	      INNER JOIN tr011_categoria c ON (c.co_categoria = t.co_categoria)
		  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)";
			if ($ubic != "")
			{
			$query	.= "WHERE
			a.bo_critico= true AND 
		  	a.co_ubicacion IN (SELECT 
		  	u.co_ubicacion
			FROM 
			tr006_ubicacion u 
			LEFT JOIN tr005_tipo_ubicacion t on (u.co_tipo_ubicacion = t.co_tipo_ubicacion)
			WHERE 
			u.co_ubicacion_padre = u.co_ubicacion_padre AND
			u.co_ubicacion_padre= '".$ubic."')";
			}
	if ($sort != "") {
		$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	//echo $query;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivo  
  
       public function contarActivoCritico($ubic) {
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
		  INNER JOIN tr013_servicio s ON (t.co_servicio = s.co_servicio)
		  INNER JOIN tr012_capacidad cp ON (s.co_capacidad = cp.co_capacidad)
	      INNER JOIN tr011_categoria c ON (c.co_categoria = t.co_categoria)
		  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)";
			if ($ubic != "")
			{
			$query	.= "WHERE
			a.bo_critico= true AND 
		  	a.co_ubicacion IN (SELECT 
		  	u.co_ubicacion
			FROM 
			tr006_ubicacion u 
			LEFT JOIN tr005_tipo_ubicacion t on (u.co_tipo_ubicacion = t.co_tipo_ubicacion)
			WHERE 
			u.co_ubicacion_padre = u.co_ubicacion_padre AND
			u.co_ubicacion_padre= '".$ubic."')";
			}

	//echo $query;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivo  
  
  
}
?>
