<?php
require_once 'MyPDO.php';
require_once 'PrivilegioUsuario.php';
require_once 'Persona.php';

/**
 * Se definen los distintos tipos de usuarios.
 * @access public
 * @package Planes
 */
class Usuario extends MyPDO
 {
	/**
	 * @AttributeType int
	 * Clave primaria de los usuarios.
	 */
	private $_co_usuario;
	/**
	 * @AttributeType int
	 * Nombre de los distintos tipos de usuarios.
	 */
	private $_nb_usuario;
	/**
	 * @AssociationType Planes.PrivilegioUsuario
	 * @AssociationMultiplicity 1
	 */
	public $_posee;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_Persona_;

	/**
   * 
   * @access public
   */
  public $columUsuario= array('co_usuario'=>'co_usuario', 'nb_usuario'=>'nb_usuario', 'co_indicador'=>'co_indicador', 'co_privilegio'=>'co_privilegio');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarUsuario($usuario) {
  	
	$this->pdo->beginTransaction();	

	$usuario = array_intersect_key($usuario, $this->columUsuario);
	
	$r1 = $this->pdo->_insert('tr047_usuario', $usuario);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarUsuario

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarUsuario($usuario, $condiciones) {
  	$this->pdo->beginTransaction();	

	$usuario = array_intersect_key($usuario, $this->columUsuario);
	
	$r1 = $this->pdo->_update('tr047_usuario', $usuario, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarUsuario

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarUsuario($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr047_usuario', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarUsuario

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarUsuario() {

	$query = "SELECT *
				FROM tr047_usuario;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUsuario
}
?>