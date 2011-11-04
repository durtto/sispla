<?php
require_once 'MyPDO.php';

/**
 * Se definen los distintos tipos de activos considerados en la plataforma de AIT.
 * @access public
 * @package Planes
 */
class TpRespaldo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del tipo de respaldo.
	 */
	private $_co_tipo_respaldo;
	/**
	 * @AttributeType string
	 * Nombre del tipo de respaldo.
	 */
	private $_nb_tipo_respaldo;
	
	/**
   * 
   * @access public
   */
  public $columTpRespaldo= array('co_tipo_respaldo'=>'co_tipo_respaldo', 'nb_tipo_respaldo'=>'nb_tipo_respaldo');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarTpRespaldo($tprespaldo) {
  	
	$this->pdo->beginTransaction();	

	$tprespaldo = array_intersect_key($tprespaldo, $this->columTpRespaldo);
	
	$r1 = $this->pdo->_insert('tr034_tipo_respaldo', $tprespaldo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarTpRespaldo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarTpRespaldo($tprespaldo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$tprespaldo = array_intersect_key($tprespaldo, $this->columTpRespaldo);
	
	$r1 = $this->pdo->_update('tr034_tipo_respaldo', $tprespaldo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarTpRespaldo

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarTpRespaldo($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr034_tipo_respaldo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarTpRespaldo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarTpRespaldo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr034_tipo_respaldo";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarTpRespaldo
}
?>