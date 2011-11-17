<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n del grupo para las guardias.
 * @access public
 * @package Planes
 */
class Grupo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de la guardia
	 */
	private $_co_grupo;
	/**
	 * @AttributeType string
	 * Nombre de la guardia.
	 */
	private $_nb_grupo;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 1..*
	 */
	public $_esta_formada = array();

/**
   * 
   * @access public
   */
  public $columGrupo= array('co_grupo'=>'co_grupo', 'nb_grupo'=>'nb_grupo' );
  
  /**
   * 
   * @access public
   */
  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarGrupo() {
	$contar = "SELECT count(tr001_grupo.co_grupo)
	FROM tr001_grupo";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarGrupo($grupo) {
  	
	$this->pdo->beginTransaction();	

	$grupo = array_intersect_key($grupo, $this->columGrupo);
	
	$r1 = $this->pdo->_insert('tr001_grupo', $grupo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarGrupo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarGrupo($grupo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$grupo = array_intersect_key($grupo, $this->columGrupo);
	
	$r1 = $this->pdo->_update('tr001_grupo', $grupo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarGrupo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarGrupo($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr001_grupo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarGrupo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarGrupo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr001_grupo";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarGrupo
}
?>