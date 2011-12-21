<?php
require_once 'MyPDO.php';

/**
 * fine la informaci�n del Rol de una persona dentro de un plan de continuidad.
 * @access public
 * @package Planes
 */
class RolPersona extends MyPDO
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
	 * scripci�n de las actividades definidas para ese rol.
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
  public $columRolPersona= array('co_rol'=>'co_rol', 'nb_rol'=>'nb_rol', 'tx_descripcion'=>'tx_descripcion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarRolPersona() {
	$contar = "SELECT count(tr008_rol_persona.co_rol)
	FROM tr008_rol_persona";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoRolPersona() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_rol FROM tr008_rol_persona
		ORDER BY co_rol DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarRolPersona($rolpersona) {
  	
	$this->pdo->beginTransaction();	

	$rolpersona = array_intersect_key($rolpersona, $this->columRolPersona);
	
	$r1 = $this->pdo->_insert('tr008_rol_persona', $rolpersona);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarRolpersona

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarRolPersona($rolpersona, $condiciones) {
  	$this->pdo->beginTransaction();	

	$rolpersona = array_intersect_key($rolpersona, $this->columRolPersona);
	
	$r1 = $this->pdo->_update('tr008_rol_persona', $rolpersona, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarRolpersona

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarRolPersona($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr008_rol_persona', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarRolpersona

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarRolPersona($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr008_rol_persona";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarRolpersona
}
?>