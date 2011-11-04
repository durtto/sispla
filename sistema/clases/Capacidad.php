<?php
require_once 'MyPDO.php';

/**
 * Definen los tipos de capacidades con las que cuenta la plataforma tecnol�gica de AIT. Las cuales cuentan con una serie de activos asociados.
 * @access public
 * @package Planes
 */
class Capacidad extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del tipo de capacidad.
	 */
	private $_co_capacidad;
	/**
	 * @AttributeType string
	 * Nombre del tipo de capacidad.
	 */
	private $_nb_capacidad;
	/**
	 * @AssociationType Planes.Servicio
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 */
	public $_se_ofrece_por = array();

/**
   * 
   * @access public
   */
  public $columCapacidad= array('co_capacidad'=>'co_capacidad', 'nb_capacidad'=>'nb_capacidad');
  
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
  public function insertarCapacidad($capacidad) {
  	
	$this->pdo->beginTransaction();	

	$capacidad = array_intersect_key($capacidad, $this->columCapacidad);
	
	$r1 = $this->pdo->_insert('tr012_capacidad', $capacidad);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarCapacidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarCapacidad($capacidad, $condiciones) {
  	$this->pdo->beginTransaction();	

	$capacidad = array_intersect_key($capacidad, $this->columCapacidad);
	
	$r1 = $this->pdo->_update('tr012_capacidad', $capacidad, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarCapacidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarCapacidad($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr012_capacidad', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarCapacidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarCapacidad($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr012_capacidad";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCapacidad
}
?>