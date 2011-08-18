<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n de la guardia.
 * @access public
 * @package Planes
 */
class Guardia extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de la guardia
	 */
	private $_co_guardia;
	/**
	 * @AttributeType string
	 * Nombre de la guardia.
	 */
	private $_nb_guardia;
	/**
	 * @AttributeType int
	 * Numero de la guardia.
	 */
	private $_nu_numero;
	/**
	 * @AttributeType string
	 * Descripci�n de la guardia.
	 */
	private $_tx_descripcion;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 1..*
	 */
	public $_esta_formada = array();

/**
   * 
   * @access public
   */
  public $columGuardia= array('co_guardia'=>'co_guardia', 'nb_guardia'=>'nb_guardia', 'nu_guardia'=>'nu_guardia', 'tx_descripcion'=>'tx_descripcion');
  
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
  public function insertarGuardia($guardia) {
  	
	$this->pdo->beginTransaction();	

	$guardia = array_intersect_key($guardia, $this->columGuardia);
	
	$r1 = $this->pdo->_insert('tr009_guardia', $guardia);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarGuardia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarGuardia($guardia, $condiciones) {
  	$this->pdo->beginTransaction();	

	$guardia = array_intersect_key($guardia, $this->columGuardia);
	
	$r1 = $this->pdo->_update('tr009_guardia', $guardia, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarGuardia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarGuardia($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr009_guardia', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarGuardia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarGuardia( ) {

	$query = "SELECT *
                FROM tr009_guardia;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarGuardia
}
?>