<?php
require_once 'MyPDO.php';

/**
 * Se define el sitio de alojamiento requerido para elaborar el plan de localizacion
 * @access public
 * @package Planes
 */
class Alojamiento extends MyPDO
{
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
  public $columAlojamiento= array('co_alojamiento'=>'co_alojamiento', 'nb_establecimiento'=>'nb_establecimiento', 'di_ubicacion'=>'di_ubicacion', 'bo_hotel'=>'bo_hotel', 'bo_posada'=>'bo_posada', 'tx_telefono'=>'tx_telefono');
  
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

	$alojamiento = array_intersect_key($alojamiento, $this->columAlojamiento);
	
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
 public function cargarAlojamiento($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
	                tr017_alojamiento.co_alojamiento, 
  					tr017_alojamiento.nb_establecimiento, 
  					tr017_alojamiento.di_ubicacion, 
 					tr017_alojamiento.bo_hotel, 
  					tr017_alojamiento.bo_posada, 
  					tr017_alojamiento.tx_telefono,  					
  			    CASE
  					WHEN tr017_alojamiento.bo_hotel = true
  					THEN 'SI'
  					ELSE 'NO'
  					END AS bo_hotel,
  				CASE
  					WHEN tr017_alojamiento.bo_posada = true
  					THEN 'SI'
  					ELSE 'NO'
  					END AS bo_posada
				FROM 
  					public.tr017_alojamiento";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;				
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarProceso
}
?>