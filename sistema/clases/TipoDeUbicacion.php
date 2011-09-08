<?php
require_once 'MyPDO.php';

/**
 * Define el tipo de ubicaci�n dentro de la corporaci�n.
 * @access public
 * @package Planes
 */
class TpUbicacion extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del tipo de ubicaci�n.
	 */
	private $_co_tipo_ubicacion;
	/**
	 * @AttributeType string
	 * Nombre del tipo de ubicaci�n.
	 */
	private $_nb_tipo_ubicacion;
	/**
	 * @AssociationType Planes.Ubicacion
	 * @AssociationMultiplicity 1..*
	 */
	public $_define = array();

	/**
   * 
   * @access public
   */
  public $columTpUbicacion= array('co_tipo_ubicacion'=>'co_tipo_ubicacion', 'nb_tipo_ubicacion'=>'nb_tipo_ubicacion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarTpUbicacion($tpubicacion) {
  	
	$this->pdo->beginTransaction();	

	$tpubicacion = array_intersect_key($tpubicacion, $this->columTpUbicacion);
	
	$r1 = $this->pdo->_insert('tr005_tipo_ubicacion', $tpubicacion);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarTpUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarTpUbicacion($tpubicacion, $condiciones) {
  	$this->pdo->beginTransaction();	

	$tpubicacion = array_intersect_key($tpubicacion, $this->columTpUbicacion);
	
	$r1 = $this->pdo->_update('tr005_tipo_ubicacion', $tpubicacion, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarTpUbicacion

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarTpUbicacion($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr005_tipo_ubicacion', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarTpUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarTpUbicacion() {

	$query = "SELECT *
				FROM tr005_tipo_ubicacion;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarTpUbicacion
}
?>