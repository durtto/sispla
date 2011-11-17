<?php
require_once 'MyPDO.php';

/**
 * Informacion sobre la lineas de Taxi contactadas por la empresa.
 * @access public
 * @package Planes
 */
class Linea extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal de la Linea de Taxi
	 */
	private $_co_linea;
	/**
	 * @AttributeType string
	 * Nombre de la Linea de Taxi.
	 */
	private $_nb_nombre;
	/**
	 * @AttributeType int
	 * Tel�fono de contacto con la oficina de la l�nea de Taxi.
	 */
	private $_tx_telefono;
	/**
	 * @AttributeType string
	 * Direccion de la oficina de la linea de Taxi.
	 */
	private $_di_direccion;
	/**
	 * @AssociationType Planes.Transporte
	 */
	public $_unnamed_Transporte_;

	/**
   * 
   * @access public
   */
  public $columLinea= array('co_linea'=>'co_linea', 'nb_linea'=>'nb_linea', 'tx_telefono'=>'tx_telefono', 'di_oficina'=>'di_oficina');

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
  public function contarLinea() {
	$contar = "SELECT count(tr019_linea_taxi.co_linea)
	FROM tr019_linea_taxi";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarLinea($linea) {
  	
	$this->pdo->beginTransaction();	

	$linea = array_intersect_key($linea, $this->columLinea);
	
	$r1 = $this->pdo->_insert('tr019_linea_taxi', $linea);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarLinea

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarlinea($linea, $condiciones) {
  	$this->pdo->beginTransaction();	

	$linea = array_intersect_key($linea, $this->columLinea);
	
	$r1 = $this->pdo->_update('tr019_linea_taxi', $linea, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarLinea

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarLinea($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr019_linea_taxi', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarLinea

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarLinea($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr019_linea_taxi";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarLinea
}
?>