<?php
require_once 'MyPDO.php';
require_once 'PrivilegioUsuario.php';
require_once 'Persona.php';
require_once 'Ubicacion.php';
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
  public $columUsuario= array('co_usuario'=>'co_usuario', 'co_indicador'=>'co_indicador', 'co_privilegio'=>'co_privilegio', 'co_ubicacion'=>'co_ubicacion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarUsuario() {
	$contar = "SELECT count(u.co_usuario)
	FROM tr047_usuario u
    INNER JOIN tr010_persona p ON (u.co_indicador = p.co_indicador) 
	INNER JOIN tr022_privilegio_usuario pu ON (u.co_privilegio = pu.co_privilegio)
	LEFT JOIN tr006_ubicacion ub ON (u.co_ubicacion = ub.co_ubicacion)";
	
	$c = $this->pdo->_query($contar);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
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
  public function cargarUsuario($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT  u.co_usuario,  u.co_indicador,  pu.nb_privilegio, p.nb_persona, 
	  p.tx_apellido, u.co_ubicacion, ub.co_ubicacion, ub.nb_ubicacion
	FROM tr047_usuario u
    INNER JOIN tr010_persona p ON (u.co_indicador = p.co_indicador) 
	INNER JOIN tr022_privilegio_usuario pu ON (u.co_privilegio = pu.co_privilegio)
	LEFT JOIN tr006_ubicacion ub ON (u.co_ubicacion = ub.co_ubicacion)";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUsuario
  
    public function cargarUsuarioLogin($login) {

	$query = "SELECT  u.co_usuario,  u.co_indicador,  pu.nb_privilegio, p.nb_persona, 
	  p.tx_apellido, u.co_ubicacion, ub.co_ubicacion, ub.nb_ubicacion
	FROM tr047_usuario u
    INNER JOIN tr010_persona p ON (u.co_indicador = p.co_indicador) 
	INNER JOIN tr022_privilegio_usuario pu ON (u.co_privilegio = pu.co_privilegio)
	LEFT JOIN tr006_ubicacion ub ON (u.co_ubicacion = ub.co_ubicacion)
	WHERE u.co_indicador='".$login."'";
	
	echo $login;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUsuario
  
  
  
}
?>
