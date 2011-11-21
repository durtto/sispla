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
  public $columUsuario= array('co_usuario'=>'co_usuario', 'co_indicador'=>'co_indicador', 'co_privilegio'=>'co_privilegio');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarUsuario() {
	$contar = "SELECT count(tr047_usuario.co_usuario)
	FROM tr047_usuario";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
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

	$query = "SELECT 
	  tr047_usuario.co_usuario, 
	  tr047_usuario.co_indicador, 
	  tr022_privilegio_usuario.nb_privilegio, 
	  tr010_persona.nb_persona, 
	  tr010_persona.tx_apellido
	FROM 
	  public.tr047_usuario, 
	  public.tr010_persona, 
	  public.tr022_privilegio_usuario
	WHERE 
	  tr047_usuario.co_indicador = tr010_persona.co_indicador AND
	  tr047_usuario.co_privilegio = tr022_privilegio_usuario.co_privilegio";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUsuario
  
    public function cargarUsuarioLogin($_REQUEST='login') {

	$query = "SELECT 
	  tr047_usuario.co_usuario, 
	  tr047_usuario.co_indicador, 
	  tr022_privilegio_usuario.nb_privilegio, 
	  tr010_persona.nb_persona, 
	  tr010_persona.tx_apellido
	FROM 
	  public.tr047_usuario, 
	  public.tr010_persona, 
	  public.tr022_privilegio_usuario
	WHERE 
	  tr047_usuario.co_indicador = tr010_persona.co_indicador AND
	  tr047_usuario.co_privilegio = tr022_privilegio_usuario.co_privilegio AND 
	  tr010_persona.co_indicador= '".$_REQUEST['login']."'";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUsuario
  
  
  
}
?>