<?php
require_once 'MyPDO.php';

/**
 * Se definen los distintos tipos de privilegios que se le otorgan a un usuario.
 * @access public
 * @package Planes
 */
class PrivilegioUsuario extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del tipo de privilegio otorgado al usuario.
	 */
	private $_co_privilegio;
	/**
	 * @AttributeType string
	 * Nombre del privilegio.
	 */
	private $_nb_privilegio;
	/**
	 * @AttributeType string
	 * Breve explicaci�n del privilegio.
	 */
	private $_tx_descripcion;
	/**
	 * @AssociationType Planes.Usuario
	 * @AssociationMultiplicity 1
	 */
	public $_identifica;

	/**
   * 
   * @access public
   */
  public $columPrivilegioUsuario= array('co_privilegio'=>'co_privilegio', 'nb_privilegio'=>'nb_privilegio', 'tx_descripcion'=>'tx_descripcion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarPrivilegioUsuario() {
	$contar = "SELECT count(tr022_privilegio_usuario.co_privilegio)
	FROM tr022_privilegio_usuario";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoPrivilegioUsuario() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_privilegio FROM tr022_privilegio_usuario
		ORDER BY co_privilegio DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarPrivilegioUsuario($privilegio) {
  	
	$this->pdo->beginTransaction();	

	$privilegio = array_intersect_key($privilegio, $this->columPrivilegioUsuario);
	
	$r1 = $this->pdo->_insert('tr022_privilegio_usuario', $privilegio);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarPrivilegioUsuario

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarPrivilegioUsuario($privilegio, $condiciones) {
  	$this->pdo->beginTransaction();	

	$privilegio = array_intersect_key($privilegio, $this->columPrivilegioUsuario);
	
	$r1 = $this->pdo->_update('tr022_privilegio_usuario', $privilegio, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarPrivilegioUsuario

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarPrivilegioUsuario($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr022_privilegio_usuario', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarPrivilegioUsuario

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarPrivilegioUsuario($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr022_privilegio_usuario";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarPrivilegioUsuario
}
?>