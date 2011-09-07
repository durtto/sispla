<?php
require_once 'MyPDO.php';


/**
 * Define la informaci�n necesaria del proveedor de los activos.
 * @access public
 * @package Planes
 */
class Proveedor extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del proveedor.
	 */
	private $_co_proveedor;
	/**
	 * @AttributeType string
	 * Nombre del proveedor.
	 */
	private $_nb_proveedor;
	/**
	 * @AttributeType float
	 * Se indica el numero de tel�fono del proveedor.
	 */
	private $_tx_telefono_oficina;
	/**
	 * @AttributeType string
	 * Direccion de oficina del proveedor.
	 */
	private $_di_oficina;
	/**
	 * @AttributeType string
	 * Direcci�n de la pagina web del proveedor.
	 */
	private $_tx_url_pagina;
	/**
	 * @AssociationType Planes.Modelo
	 * @AssociationMultiplicity 1..*
	 */
	public $_suministra = array();
	/**
	 * @AssociationType Planes.PlanLocalizacion
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_PlanLocalizacion_;
	/**
	 * @AssociationType Planes.ContactoProveedor
	 * @AssociationMultiplicity 1
	 */
	public $_es_representado;

	/**
   * 
   * @access public
   */
  public $columProveedor= array('co_proveedor'=>'co_proveedor', 'nb_proveedor'=>'nb_proveedor', 'di_oficina'=>'di_oficina', 'tx_telefono_oficina'=>'tx_telefono_oficina', 'tx_url_pagina'=>'tx_url_pagina');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarProveedor($proveedor) {
  	
	$this->pdo->beginTransaction();	

	$proveedor = array_intersect_key($proveedor, $this->columProveedor);
	
	$r1 = $this->pdo->_insert('tr025_proveedor', $proveedor);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarProveedor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarProveedor($proveedor, $condiciones) {
  	$this->pdo->beginTransaction();	

	$proveedor = array_intersect_key($proveedor, $this->columProveedor);
	
	$r1 = $this->pdo->_update('tr025_proveedor', $proveedor, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarProveedor

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarProveedor($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr025_proveedor', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarProveedor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarProveedor() {

	$query = "SELECT *
				FROM tr025_proveedor;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarProveedor
}
?>