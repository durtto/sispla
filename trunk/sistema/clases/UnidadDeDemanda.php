<?php
require_once 'MyPDO.php';

/**
 * Se definen las distintas unidades que requieren de un activo especifico.
 * @access public
 * @package Planes
 */
class Unidad extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal de la unidad de demanda.
	 */
	private $_co_unidad_demanda;
	/**
	 * @AttributeType string
	 * Nombre de la unidad.
	 */
	private $_nb_unidad;
	/**
	 * @AttributeType string
	 * Se define brevemente la descripci�n de la unidad.
	 */
	private $_tx_descripcion;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1..*
	 */
	public $_solicita = array();

	/**
   * 
   * @access public
   */
  public $columUnidad= array('co_unidad'=>'co_unidad', 'nb_unidad'=>'nb_unidad', 'tx_descripcion'=>'tx_descripcion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarUnidad() {
	$contar = "SELECT count(tr024_unidad_demanda.co_unidad)
	FROM tr024_unidad_demanda";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoUnidad() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_unidad FROM tr024_unidad_demanda
		ORDER BY co_unidad DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarUnidad($unidad) {
  	
	$this->pdo->beginTransaction();	

	$unidad = array_intersect_key($unidad, $this->columUnidad);
	
	$r1 = $this->pdo->_insert('tr024_unidad_demanda', $unidad);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarUnidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarUnidad($unidad, $condiciones) {
  	$this->pdo->beginTransaction();	

	$unidad = array_intersect_key($unidad, $this->columUnidad);
	
	$r1 = $this->pdo->_update('tr024_unidad_demanda', $unidad, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarUnidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarUnidad($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr024_unidad_demanda', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarUnidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarUnidad($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr024_unidad_demanda";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarUnidad
}
?>