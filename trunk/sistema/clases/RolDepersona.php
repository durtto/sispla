<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n del Rol de una persona dentro de un plan de continuidad.
 * @access public
 * @package Planes
 */
class RolDepersona extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del rol.
	 */
	private $_co_rol;
	/**
	 * @AttributeType string
	 * Nombre del rol.
	 */
	private $_nb_rol;
	/**
	 * @AttributeType string
	 * Descripci�n de las actividades definidas para ese rol.
	 */
	private $_tx_descripcion;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 1
	 */
	public $_representa;

	/**
   * 
   * @access public
   */
  public $columRolDepersona= array('co_rol'=>'co_rol', 'nb_rol'=>'nb_rol', 'tx_descripcion'=>'tx_descripcion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarRolDepersona($roldepersona) {
  	
	$this->pdo->beginTransaction();	

	$roldepersona = array_intersect_key($roldepersona, $this->columRolDepersona);
	
	$r1 = $this->pdo->_insert('tr008_rol_persona', $roldepersona);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarRolDepersona

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarRolDepersona($roldepersona, $condiciones) {
  	$this->pdo->beginTransaction();	

	$roldepersona = array_intersect_key($roldepersona, $this->columRolDepersona);
	
	$r1 = $this->pdo->_update('tr008_rol_persona', $roldepersona, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarRolDepersona

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarRolDepersona($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr008_rol_persona', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarRolDepersona

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarRolDepersona() {

	$query = "SELECT *
				FROM tr008_rol_persona;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarRolDepersona
}
?>