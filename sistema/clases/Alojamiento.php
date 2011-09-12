<?php
require_once 'MyPDO.php';

/**
 * Se define el sitio de alojamiento requerido para elaborar el plan de localizacion
 * @access public
 * @package Planes
 */
class Alojamiento {
	/**
	 * @AttributeType boolean
	 * Clave principal del alojamiento.
	 */
	private $_co_alojamiento;
	/**
	 * @AttributeType string
	 * Nombre del sitio de alojamiento.
	 */
	private $_nb_establecimiento;
	/**
	 * @AttributeType string
	 * Direcci�n del sitio de alojamiento.
	 */
	private $_di_ubicacion;
	/**
	 * @AttributeType boolean
	 * Define si el alojamiento es de tipo hotel.
	 */
	private $_bo_hotel;
	/**
	 * @AttributeType boolean
	 * Define si el alojamiento es de tipo posada.
	 */
	private $_bo_posada;
	/**
	 * @AttributeType float
	 * Tel�fono del sitio de alojamiento.
	 */
	private $_tx_telefono;
	/**
	 * @AssociationType Planes.PlanLocalizacion
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_PlanLocalizacion_;
/**
   * 
   * @access public
   */
  public $columAlojamiento= array('co_alojamiento'=>'co_alojamiento', 'nb_establecimiento'=>'nb_establecimiento', 'di_ubicacion'=>'di_ubicacion', 'bo_hotel'=>'bo_hotel', 'bo_hotel'=>'bo_hotel', 'tx_telefono'=>'tx_telefono');
  
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
  public function insertarAlojamiento($alojamiento) {
  	
	$this->pdo->beginTransaction();	

	$alojamiento = array_intersect_key($alojamiento, $this->columAlojamiento);
	
	$r1 = $this->pdo->_insert('tr017_alojamiento', $alojamiento);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarAlojamiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarAlojamiento($alojamiento, $condiciones) {
  	$this->pdo->beginTransaction();	

	$alojamiento = array_intersect_key($alimentacion, $this->columAlimentacion);
	
	$r1 = $this->pdo->_update('tr017_alojamiento', $alojamiento, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarAlojamiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarAlojamiento($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr017_alojamiento', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarAlojamiento

  /**
   * 
   *
   * @return string
   * @access public
   */
 public function cargarAlojamiento( ) {

	$query = "SELECT *
                FROM tr017_alojamiento;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarAlojamiento
}
?>