<?php
require_once 'MyPDO.php';
require_once 'Activo.php';

/**
 * Se refiere a la garant�a que se le otorga a un activo por parte del proveedor o fabricante.
 * @access public
 * @package Planes
 */
class Garantia extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de la garantia.
	 */
	private $_co_garantia;
	/**
	 * @AttributeType float
	 * Descripcion de la garant�a del producto.
	 */
	private $_tx_descripcion;
	/**
	 * @AttributeType float
	 * Fecha de inicio de la garant�a del producto.
	 */
	private $_fe_inicio;
	/**
	 * @AttributeType float
	 * Fecha de culminacion de la garant�a del producto.
	 */
	private $_fe_fin;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1
	 */
	public $_se_otorgada;

/**
   * 
   * @access public
   */
  public $columGarantia= array('co_garantia'=>'co_garantia', 'tx_descripcion'=>'tx_descripcion', 'fe_inicio'=>'fe_inicio', 'fe_fin'=>'fe_fin', 'co_activo'=>'co_activo');
  
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
  public function insertarGarantia($garantia) {
  	
	$this->pdo->beginTransaction();	

	$garantia = array_intersect_key($garantia, $this->columGarantia);
	
	$r1 = $this->pdo->_insert('tr032_garantia', $garantia);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarGarantia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarGarantia($garantia, $condiciones) {
  	$this->pdo->beginTransaction();	

	$garantia = array_intersect_key($garantia, $this->columGarantia);
	
	$r1 = $this->pdo->_update('tr032_garantia', $garantia, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarGarantia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarGarantia($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr032_garantia', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarGarantia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarGarantia( ) {

	$query = "SELECT *
                FROM tr032_garantia;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarGarantia
}
?>