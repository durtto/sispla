<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n necesaria para elaborar el plan de localizaci�n con respecto a la alimentaci�n necesaria para el personal.
 * @access public
 * @package Planes
 */
class Alimentacion extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del esquema alimentaci�n.
	 */
	private $_co_alimentacion;
	/**
	 * @AttributeType int
	 * Cantidad de desayunos necesarios para cubrir la necesidad de las personas involucradas.
	 */
	private $_ca_desayuno;
	/**
	 * @AttributeType int
	 * Cantidad de almuerzos necesarios para cubrir la necesidad de las personas involucradas.
	 */
	private $_ca_almuerzo;
	/**
	 * @AttributeType int
	 * Cantidad de cenas necesarios para cubrir la necesidad de las personas involucradas.
	 */
	private $_ca_cena;
	/**
	 * @AttributeType int
	 * Cantidad de personas.
	 */
	private $_ca_personas;
	/**
	 * @AssociationType Planes.PlanLocalizacion
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_PlanLocalizacion_;
/**
   * 
   * @access public
   */
  public $columAlimentacion= array('co_alimentacion'=>'co_alimentacion', 'ca_desayuno'=>'ca_desayuno', 'ca_almuerzo'=>'ca_almuerzo', 'ca_cena'=>'ca_cena', 'ca_persona'=>'persona');
  
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
  public function insertarAlimentacion($alimentacion) {
  	
	$this->pdo->beginTransaction();	

	$alimentacion = array_intersect_key($alimentacion, $this->columAlimentacion);
	
	$r1 = $this->pdo->_insert('tr018_alimentacion', $alimentacion);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarAlimentacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarAlimentacion($alimentacion, $condiciones) {
  	$this->pdo->beginTransaction();	

	$alimentacion = array_intersect_key($alimentacion, $this->columAlimentacion);
	
	$r1 = $this->pdo->_update('tr018_alimentacion', $alimentacion, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarAlimentacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarAlimentacion($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr018_alimentacion', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarAlimentacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarAlimentacion( ) {

	$query = "SELECT *
                FROM tr018_alimentacion;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarAlimentacion
}
?>