<?php
require_once 'MyPDO.php';
require_once 'Capacidad.php';

/**
 * Define los distinto servicios de la plataforma.
 * @access public
 * @package Planes
 */
class Servicio extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del servicio.
	 */
	private $_co_servicio;
	/**
	 * @AttributeType string
	 * Nombre del servicio.
	 */
	private $_nb_servicio;
	/**
	 * @AttributeType string
	 * Descripci�n del servicio prestado.
	 */
	private $_tx_descripcion;
	/**
	 * @AssociationType Planes.Capacidad
	 */
	public $_unnamed_Capacidad_;
	/**
	 * @AssociationType Planes.TipoDeActivo
	 * @AssociationMultiplicity 1..*
	 */
	public $_lo_integran = array();
	/**
	 * @AssociationType Planes.Necesidad
	 * @AssociationMultiplicity 0..*
	 */
	public $_es_detectada = array();

	/**
   * 
   * @access public
   */
  public $columServicio= array('co_servicio'=>'co_servicio', 'nb_servicio'=>'nb_servicio', 'tx_descripcion'=>'tx_descripcion', 'co_capacidad'=>'co_capacidad');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarServicio() {
	$contar = "SELECT count(tr013_servicio.co_servicio)
	FROM tr013_servicio";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoServicio() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_servicio FROM tr013_servicio
		ORDER BY co_servicio DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarServicio($servicio) {
  	
	$this->pdo->beginTransaction();	

	$servicio = array_intersect_key($servicio, $this->columServicio);
	
	$r1 = $this->pdo->_insert('tr013_servicio', $servicio);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarServicio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarServicio($servicio, $condiciones) {
  	$this->pdo->beginTransaction();	

	$servicio = array_intersect_key($servicio, $this->columServicio);
	
	$r1 = $this->pdo->_update('tr013_servicio', $servicio, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarServicio

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarServicio($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr013_servicio', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarServicio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarServicio($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  tr013_servicio.co_servicio, 
  tr013_servicio.nb_servicio, 
  tr013_servicio.tx_descripcion, 
  tr013_servicio.co_capacidad, 
  tr012_capacidad.co_capacidad, 
  tr012_capacidad.nb_capacidad
FROM 
  public.tr013_servicio, 
  public.tr012_capacidad
WHERE 
  tr013_servicio.co_capacidad = tr012_capacidad.co_capacidad";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarServicio
}
?>