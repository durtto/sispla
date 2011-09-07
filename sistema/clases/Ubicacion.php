<?php
require_once 'MyPDO.php';
require_once 'TipoDeUbicacion.php';

/**
 * Define la ubicaci�n del activo.
 * @access public
 * @package Planes
 */
class Ubicacion extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de la ubicaci�n del activo.
	 */
	private $_co_ubicacion;
	/**
	 * @AttributeType string
	 * Nombre de la ubicacion del activo.
	 */
	private $_nb_ubicacion;
	/**
	 * @AttributeType boolean
	 * Define si la ubicaci�n sigue manteni�ndose con las mismas caracter�sticas.
	 */
	private $_bo_obsoleto;
	/**
	 * @AssociationType Planes.Ubicacion
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 */
	public $_contiene = array();
	/**
	 * @AssociationType Planes.Ubicacion
	 */
	public $_unnamed_Ubicacion_;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1..*
	 */
	public $_existen = array();
	/**
	 * @AssociationType Planes.TipoDeUbicacion
	 * @AssociationMultiplicity 1
	 */
	public $_es_definido;

	/**
   * 
   * @access public
   */
  public $columUbicacion= array('co_ubicacion'=>'co_ubicacion', 'nb_ubicacion'=>'nb_ubicacion', 'bo_obsoleto'=>'bo_obsoleto', 'co_ubicion_padre'=>'co_ubicacion_padre', 'co_tipo_ubicacion'=>'co_tipo_ubicacion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarUbicacion($ubicacion) {
  	
	$this->pdo->beginTransaction();	

	$ubicacion = array_intersect_key($ubicacion, $this->columUbicacion);
	
	$r1 = $this->pdo->_insert('tr006_ubicacion', $ubicacion);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarUbicacion($ubicacion, $condiciones) {
  	$this->pdo->beginTransaction();	

	$ubicacion = array_intersect_key($ubicacion, $this->columUbicacion);
	
	$r1 = $this->pdo->_update('tr006_ubicacion', $ubicacion, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarUbicacion($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr006_ubicacion', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarUbicacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarUbicacion() {

	$query = "SELECT *
				FROM tr006_ubicacion;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUbicacion
}
?>