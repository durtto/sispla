<?php
require_once 'MyPDO.php';
require_once 'Proveedor.php';

/**
 * Define la informacion referente a la persona de contacto del proveedor.
 * @access public
 * @package Planes
 */
class ContactoProveedor extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del contacto de proveedor
	 */
	private $_co_contacto;
	/**
	 * @AttributeType string
	 * Nombre del contacto.
	 */
	private $_nb_contacto;
	/**
	 * @AttributeType string
	 * Apellido del contacto.
	 */
	private $_tx_apellido;
	/**
	 * @AttributeType string
	 * Direccion de la oficina del contacto.
	 */
	private $_di_oficina;
	/**
	 * @AttributeType float
	 * Telefono de la oficina del contacto.
	 */
	private $_tx_telefono_oficina;
	/**
	 * @AttributeType string
	 * Direcci�n de correo electr�nico del contacto.
	 */
	private $_tx_correo_electronico;
	/**
	 * @AttributeType string
	 * Direcci�n de habitaci�n del contacto.
	 */
	private $_di_habitacion;
	/**
	 * @AttributeType float
	 * Telefono de habitacion del contacto.
	 */
	private $_tx_telefono_habitacion;
	/**
	 * @AssociationType Planes.Proveedor
	 * @AssociationMultiplicity 1
	 */
	public $_representa;

/**
   * 
   * @access public
   */
  public $columContacto= array('co_contacto'=>'co_contacto', 'nb_contacto'=>'nb_contacto', 'tx_apellido'=>'tx_apellido', 'di_direccion'=>'di_direccion', 'tx_telefono'=>'tx_telefono', 'tx_correo_electronico'=>'tx_correo_electronico', 'di_habitacion'=>'di_habitacion', 'tx_telefono_habitacion'=>'tx_telefono_habitacion', 'co_proveedor'=>'co_proveedor');
  
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
  public function insertarContactoProveedor($contacto) {
  	
	$this->pdo->beginTransaction();	

	$contacto = array_intersect_key($contacto, $this->columContacto);
	
	$r1 = $this->pdo->_insert('tr026_contacto_proveedor', $contacto);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarContactoProveedor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarContactoProveedor($contacto, $condiciones) {
  	$this->pdo->beginTransaction();	

	$contacto = array_intersect_key($contacto, $this->columContacto);
	
	$r1 = $this->pdo->_update('tr026_ContactoProveedor', $contacto, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarContactoProveedor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarContactoProveedor($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr026_ContactoProveedor', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarContactoProveedor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarContactoProveedor( ) {

	$query = "SELECT *
                FROM tr026_contacto_proveedor;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarContactoProveedor
}
?>