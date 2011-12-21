<?php
require_once 'MyPDO.php';

/**
 * Define el rol y responsabilidades del equipo.
 * @access public
 * @package Planes
 */
class RolResponsabilidad extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del Rol del equipo.
	 */
	private $_co_rol;
	/**
	 * @AttributeType string
	 * Nombre del rol del equipo.
	 */
	private $_nb_rol;
	/**
	 * @AttributeType string
	 * Descripci�n de las actividades determinadas para el equipo.
	 */
	private $_tx_descripcion;

	/**
   * 
   * @access public
   */
  public $columRolResponsabilidad= array('co_rol_resp'=>'co_rol_resp', 'nb_rol_resp'=>'nb_rol_resp', 'tx_descripcion'=>'tx_descripcion', 'co_rol_padre'=>'co_rol_padre');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarRolResponsabilidad() {
	$contar = "SELECT count(tr002_rol_responsabilidad.co_rol_resp)
	FROM tr002_rol_responsabilidad";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoRolResponsabilidad() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_rol_resp FROM tr002_rol_responsabilidad
		ORDER BY co_rol_resp DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarRolResponsabilidad($rolresponsabilidad) {
  	
	$this->pdo->beginTransaction();	

	$rolresponsabilidad = array_intersect_key($rolresponsabilidad, $this->columRolResponsabilidad);
	
	$r1 = $this->pdo->_insert('tr002_rol_responsabilidad', $rolresponsabilidad);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarRolResponsabilidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarRolResponsabilidad($rolresponsabilidad, $condiciones) {
  	$this->pdo->beginTransaction();	

	$rolresponsabilidad = array_intersect_key($rolresponsabilidad, $this->columRolResponsabilidad);
	
	$r1 = $this->pdo->_update('tr002_rol_responsabilidad', $rolresponsabilidad, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarRolResponsabilidad

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarRolResponsabilidad($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr002_rol_responsabilidad', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarRolResponsabilidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarRolResponsabilidad($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr002_rol_responsabilidad";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarRolResponsabilidad
}
?>