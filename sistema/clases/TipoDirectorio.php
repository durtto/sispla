<?php
require_once 'MyPDO.php';

/**
 * Define el tipo de directorio.
 * @access public
 * @package Planes
 */
class TpDirectorio extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del tipo de directorio
	 */
	private $_co_tipo_directorio;
	/**
	 * @AttributeType string
	 * Nombre del tipo de directorio.
	 */
	private $_nb_tipo_directorio;
	/**
	 * @AssociationType Planes.Directorio
	 * @AssociationMultiplicity 1..*
	 */
	public $_condiciona = array();

/**
   * 
   * @access public
   */
  public $columTpDirectorio= array('co_tipo_directorio'=>'co_tipo_directorio', 'nb_tipo_directorio'=>'nb_tipo_directorio');
  
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
  public function insertarTpDirectorio($tpDirectorio) {
  	
	$this->pdo->beginTransaction();	

	$tpDirectorio = array_intersect_key($tpDirectorio, $this->columTpDirectorio);
	
	$r1 = $this->pdo->_insert('tr050_tipo_directorio', $tpDirectorio);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarTpDirectorio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarTpDirectorio($tpDirectorio, $condiciones) {
  	$this->pdo->beginTransaction();	

	$tpDirectorio = array_intersect_key($tpDirectorio, $this->columTpDirectorio);
	
	$r1 = $this->pdo->_update('tr050_tipo_directorio', $tpDirectorio, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarTpDirectorio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarTpDirectorio($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr050_tipo_directorio', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarTpDirectorio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarTpDirectorio($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr050_tipo_directorio";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarTpDirectorio
}
?>