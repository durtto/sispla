<?php
require_once 'MyPDO.php';

/**
 * Se definen las distintas unidades que requieren de un activo especifico.
 * @access public
 * @package Planes
 */
class Unidad extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal de la unidad de demanda.
	 */
	private $_co_unidad_demanda;
	/**
	 * @AttributeType string
	 * Nombre de la unidad.
	 */
	private $_nb_unidad;
	/**
	 * @AttributeType string
	 * Se define brevemente la descripci�n de la unidad.
	 */
	private $_tx_descripcion;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1..*
	 */
	public $_solicita = array();

	/**
   * 
   * @access public
   */
  public $columUnidad= array('co_unidad'=>'co_unidad', 'nb_unidad'=>'nb_unidad', 'tx_descripcion'=>'tx_descripcion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarUnidad($unidad) {
  	
	$this->pdo->beginTransaction();	

	$unidad = array_intersect_key($unidad, $this->columUnidad);
	
	$r1 = $this->pdo->_insert('tr024_unidad_demanda', $unidad);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarUnidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarUnidad($unidad, $condiciones) {
  	$this->pdo->beginTransaction();	

	$unidad = array_intersect_key($unidad, $this->columUnidad);
	
	$r1 = $this->pdo->_update('tr024_unidad_demanda', $unidad, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarUnidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarUnidad($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr024_unidad_demanda', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarUnidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarUnidad() {

	$query = "SELECT *
				FROM tr024_unidad_demanda;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUnidad
}
?>