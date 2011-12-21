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
  public $columProveedor= array('co_proveedor'=>'co_proveedor', 'nb_proveedor'=>'nb_proveedor', 'di_oficina'=>'di_oficina', 'tx_servicio_prestado'=>'tx_servicio_prestado');

  /**
   * 
   *
   * @return string
   * @access public
   */
    public function contarProveedor() {
	$contar = "SELECT count(tr025_proveedor.co_proveedor)
	FROM tr025_proveedor";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
	 public function NuevoProveedor() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_proveedor FROM tr025_proveedor
		ORDER BY co_proveedor DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
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
  public function cargarProveedor($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
	  p.co_proveedor, 
	  p.nb_proveedor, 
	  p.di_oficina, 
	  p.tx_servicio_prestado, 
	  c.nb_contacto, 
	  c.tx_apellido, 
	  c.tx_telefono, 
	  c.tx_correo_electronico
	FROM 
	  tr025_proveedor p
	  INNER JOIN tr026_contacto_proveedor c ON (p.co_proveedor = c.co_proveedor)";
	if ($sort != "") {
		$query .= " ORDER BY ".$sort." ".$dir;
		}
		$query .= "	LIMIT ".$limit."
					OFFSET ".$start;
		$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarProveedor
}
?>