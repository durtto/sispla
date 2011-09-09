<?php
require_once 'MyPDO.php';

/**
 * Define el estado del Activo.
 * @access public
 * @package Planes
 */
class Estado extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del estado
	 */
	private $_co_estado;
	/**
	 * @AttributeType string
	 * Nombre del estado del activo.
	 */
	private $_nb_estado;
	/**
	 * @AttributeType string
	 * Descripci�n del estado en que se encuentra el activo.
	 */
	private $_tx_descripcion;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1..*
	 */
	public $_condiciona = array();

/**
   * 
   * @access public
   */
  public $columEstado= array('co_estado'=>'co_estado', 'nb_estado'=>'nb_estado', 'tx_descripcion'=>'tx_descripcion');
  
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
  public function insertarEstado($estado) {
  	
	$this->pdo->beginTransaction();	

	$estado = array_intersect_key($estado, $this->columEstado);
	
	$r1 = $this->pdo->_insert('tr004_estado', $estado);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarEstado

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarEstado($estado, $condiciones) {
  	$this->pdo->beginTransaction();	

	$estado = array_intersect_key($estado, $this->columEstado);
	
	$r1 = $this->pdo->_update('tr004_estado', $estado, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarEstado

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarEstado($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr004_estado', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarEstado

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarEstado( ) {

	$query = "SELECT *
                FROM tr004_estado;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarEstado
}
?>