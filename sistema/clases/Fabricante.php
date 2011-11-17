<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n necesaria del Fabricante de el activo.
 * @access public
 * @package Planes
 */
class Fabricante extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del Fabricante.
	 */
	private $_co_fabricante;
	/**
	 * @AttributeType string
	 * Indica el nombre del fabricante.
	 */
	private $_nb_fabricante;
	/**
	 * @AttributeType string
	 * Describe la ubicacion del fabricante. A nivel Nacional o Internacional.
	 */
	private $_di_ubicacion;
	/**
	 * @AttributeType float
	 * Numero de tel�fono del fabricante.
	 */
	private $_nu_telefono;
	/**
	 * @AttributeType string
	 * Direcci�n del correo electr�nico del fabricante.
	 */
	private $_tx_correo_electronico;
	/**
	 * @AttributeType string
	 * Direccion de la pagina web del fabricante.
	 */
	private $_tx_pagina_web;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1..*
	 */
	public $_fabrica = array();

/**
   * 
   * @access public
   */
  public $columFabricante= array('co_fabricante'=>'co_fabricante', 'nb_fabricante'=>'nb_fabricante', 'di_ubicacion'=>'di_ubicacion', 'nu_telefono'=>'nu_telefono', 'tx_correo_electronico'=>'tx_correo_electronico', 'tx_pagina_web'=>'tx_pagina_web');
  
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
  public function contarFabricante() {
	$contar = "SELECT count(tr003_fabricante.co_fabricante)
	FROM tr003_fabricante";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarFabricante($fabricante) {
  	
	$this->pdo->beginTransaction();	

	$fabricante = array_intersect_key($fabricante, $this->columFabricante);
	
	$r1 = $this->pdo->_insert('tr003_fabricante', $fabricante);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarFabricante

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarFabricante($fabricante, $condiciones) {
  	$this->pdo->beginTransaction();	

	$fabricante = array_intersect_key($fabricante, $this->columFabricante);
	
	$r1 = $this->pdo->_update('tr003_fabricante', $fabricante, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarFabricante

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarFabricante($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr003_fabricante', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarFabricante

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarFabricante($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr003_fabricante";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarFabricante
}
?>