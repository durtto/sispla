<?php
require_once 'MyPDO.php';
require_once 'TipoDeUbicacion.php';

/**
 * Define la ubicaci�n del activo.
 * @access public
 * @package Planes
 */
class Ubicacion extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de la ubicaci�n del activo.
	 */
	private $_co_ubicacion;
	/**
	 * @AttributeType string
	 * Nombre de la ubicacion del activo.
	 */
	private $_nb_ubicacion;
	/**
	 * @AttributeType boolean
	 * Define si la ubicaci�n sigue manteni�ndose con las mismas caracter�sticas.
	 */
	private $_bo_obsoleto;
	/**
	 * @AssociationType Planes.Ubicacion
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 */
	public $_contiene = array();
	/**
	 * @AssociationType Planes.Ubicacion
	 */
	public $_unnamed_Ubicacion_;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1..*
	 */
	public $_existen = array();
	/**
	 * @AssociationType Planes.TipoDeUbicacion
	 * @AssociationMultiplicity 1
	 */
	public $_es_definido;

	/**
   * 
   * @access public
   */
  public $columUbicacion= array('co_ubicacion'=>'co_ubicacion', 'nb_ubicacion'=>'nb_ubicacion', 'bo_obsoleto'=>'bo_obsoleto', 'co_ubicion_padre'=>'co_ubicacion_padre', 'co_tipo_ubicacion'=>'co_tipo_ubicacion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarUbicacion() {
	$contar = "SELECT count(tr006_ubicacion.co_ubicacion)
	FROM tr006_ubicacion";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarUbicacion($ubicacion) {
  	
	$this->pdo->beginTransaction();	

	$ubicacion = array_intersect_key($ubicacion, $this->columUbicacion);
	
	$r1 = $this->pdo->_insert('tr006_ubicacion', $ubicacion);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarUbicacion($ubicacion, $condiciones) {
  	$this->pdo->beginTransaction();	

	$ubicacion = array_intersect_key($ubicacion, $this->columUbicacion);
	
	$r1 = $this->pdo->_update('tr006_ubicacion', $ubicacion, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarUbicacion($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr006_ubicacion', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarUbicacion($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  tr006_ubicacion.co_ubicacion, 
  tr006_ubicacion.nb_ubicacion, 
  tr006_ubicacion.bo_obsoleto, 
  tr006_ubicacion.co_ubicacion_padre, 
  tr006_ubicacion.co_tipo_ubicacion, 
  tr005_tipo_ubicacion.nb_tipo_ubicacion,
  CASE
	WHEN tr006_ubicacion.bo_obsoleto = true
	THEN 'SI'
	ELSE 'NO'
	END AS bo_obsoleto
	FROM 
	public.tr005_tipo_ubicacion, 
	public.tr006_ubicacion
	WHERE 
	tr006_ubicacion.co_tipo_ubicacion = tr005_tipo_ubicacion.co_tipo_ubicacion";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUbicacion
  
  
  
  
  public function cargarUbicacion1($start='0', $limit='ALL', $sort = "", $dir = "ASC", $ubicacion) {

	$query = "SELECT 
  	tr006_ubicacion.co_ubicacion, 
	tr006_ubicacion.nb_ubicacion, 
  	tr006_ubicacion.bo_obsoleto, 
  	tr006_ubicacion.co_ubicacion_padre, 
  	tr006_ubicacion.co_tipo_ubicacion, 
  	tr005_tipo_ubicacion.nb_tipo_ubicacion,
  	CASE
	WHEN tr006_ubicacion.bo_obsoleto = true
	THEN 'SI'
	ELSE 'NO'
	END AS bo_obsoleto
	FROM 
	public.tr005_tipo_ubicacion, 
	public.tr006_ubicacion
	WHERE 
	tr006_ubicacion.co_tipo_ubicacion = tr005_tipo_ubicacion.co_tipo_ubicacion AND
	tr006_ubicacion.co_ubicacion_padre = tr006_ubicacion.co_ubicacion_padre AND
	tr006_ubicacion.co_ubicacion_padre = 5";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUbicacion
  
  
  
  
  public function cargarUbicacionP($start='0', $limit='ALL', $sort = "", $dir = "ASC") {
	$query1 = "SELECT 
	  tr006_ubicacion.co_ubicacion, 
	FROM 
	  public.tr006_ubicacion
	WHERE 
	tr006_ubicacion.co_ubicacion_padre= '".$ubic."'";
	$r1 = $this->pdo->_query($query1);
	return $r1;	
	while ($row = pg_fetch_array($r1)) {
		$query2 = "SELECT 
	  tr006_ubicacion.co_ubicacion, 
	FROM 
	  public.tr006_ubicacion
	WHERE 
	tr006_ubicacion.co_ubicacion_padre= '".$row."'";
	
	$r2 = $this->pdo->_query($query2);
	return $r2;	
        }
   	$query = "SELECT 
	  tr006_ubicacion.co_ubicacion, 
	  tr006_ubicacion.nb_ubicacion, 
	  tr006_ubicacion.bo_obsoleto, 
	  tr006_ubicacion.co_ubicacion_padre
	FROM 
	  public.tr006_ubicacion
	WHERE 
	tr006_ubicacion.co_ubicacion_padre=";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarRolResponsabilidad
  
  
  
  
  
}
?>