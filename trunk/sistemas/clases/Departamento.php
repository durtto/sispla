<?php
require_once 'MyPDO.php';

/**
 * Define el departamento en el que se ubica la persona.
 * @access public
 * @package Planes
 */
class Departamento extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del departamento
	 */
	private $_co_departamento;
	/**
	 * @AttributeType string
	 * Nombre del departamento.
	 */
	private $_nb_departamento;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 */
	public $_se_ubica = array();

/**
   * 
   * @access public
   */
  public $columDepartamento= array('co_departamento'=>'co_departamento', 'nb_departamento'=>'nb_departamento');
  
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
  public function insertarDepartamento($departamento) {
  	
	$this->pdo->beginTransaction();	

	$departamento = array_intersect_key($departamento, $this->columDepartamento);
	
	$r1 = $this->pdo->_insert('tr007_departamento', $departamento);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarDepartamento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarDepartamento($departamento, $condiciones) {
  	$this->pdo->beginTransaction();	

	$departamento = array_intersect_key($departamento, $this->columDepartamento);
	
	$r1 = $this->pdo->_update('tr007_departamento', $departamento, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarDepartamento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarDepartamento($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr007_departamento', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarDepartamento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarDepartamento( ) {

	$query = "SELECT *
                FROM tr007_departamento;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarDepartamento
}
?>