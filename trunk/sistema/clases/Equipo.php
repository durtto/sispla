<?php
require_once 'MyPDO.php';

/**
 * Definici�n del equipo requerido por el personal para realizar el mantenimiento de un activo.
 * @access public
 * @package Planes
 */
class Equipo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de los datos del equipo requerido.
	 */
	private $_co_equipoo;
	/**
	 * @AttributeType boolean
	 * Se define si necesita o no que la empresa le suministre un veh�culo.
	 */
	
/**
   * 
   * @access public
   */
  public $columEquipo= array('co_equipo'=>'co_equipo', 'nb_equipo'=>'nb_equipo','tx_descripcion'=>'tx_descripcion', 'bo_obsoleto'=>'bo_obsoleto');
  
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
  public function contarEquipo() {
	$contar = "SELECT count(tr055_equipo.co_equipo)
	FROM tr055_equipo";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarEquipo($equipo) {
  	
	$this->pdo->beginTransaction();	

	$equipo = array_intersect_key($equipo, $this->columEquipo);
	
	$r1 = $this->pdo->_insert('tr055_equipo', $equipo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarEquipoRequerido

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarEquipo($equipo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$equipo = array_intersect_key($equipo, $this->columEquipo);
	
	$r1 = $this->pdo->_update('tr055_equipo', $equipo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarEquipoRequerido

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarEquipo($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr055_equipo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarEquipoRequerido

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarEquipo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  tr055_equipo.co_equipo, 
  tr055_equipo.nb_equipo,
  tr055_equipo.tx_descripcion,
CASE
    WHEN tr055_equipo.bo_obsoleto = true
    THEN 'SI'
    ELSE 'NO'
    END AS bo_obsoleto
FROM 
  public.tr055_equipo";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarEquipoRequerido
}
?>