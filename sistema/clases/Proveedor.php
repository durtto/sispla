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
  public $columProveedor= array('co_proveedor'=>'co_proveedor', 'nb_proveedor'=>'nb_proveedor', 'di_oficina'=>'di_oficina', 'tx_telefono'=>'tx_telefono', 'tx_url_pagina'=>'tx_url_pagina');

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

	$query = "SELECT 
  tr025_proveedor.co_proveedor, 
  tr025_proveedor.nb_proveedor, 
  tr025_proveedor.di_oficina, 
  tr025_proveedor.tx_telefono, 
  tr025_proveedor.tx_url_pagina, 
  tr026_contacto_proveedor.nb_contacto, 
  tr026_contacto_proveedor.tx_apellido, 
  tr026_contacto_proveedor.di_oficina, 
  tr026_contacto_proveedor.tx_telefono_oficina, 
  tr026_contacto_proveedor.tx_correo_electronico, 
  tr026_contacto_proveedor.di_habitacion, 
  tr026_contacto_proveedor.tx_telefono_habitacion
FROM 
  public.tr025_proveedor, 
  public.tr026_contacto_proveedor
WHERE 
  tr026_contacto_proveedor.co_proveedor = tr025_proveedor.co_proveedor;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarProveedor
}
?>