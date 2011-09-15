<?php
require_once 'MyPDO.php';
require_once 'TipoDeActivo.php';

/**
 * Se definen la demanda que requiere la plataforma para cumplir la proyecci�n futura.
 * @access public
 * @package Planes
 */
class Crecimiento extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del crecimiento.
	 */
	private $_co_crecimiento;
	/**
	 * @AttributeType float
	 * Cantidad necesaria para la demanda futura.
	 */
	private $_ca_demanda_futura;
	/**
	 * @AttributeType float
	 * Fecha de actual en la que es considerado el crecimiento.
	 */
	private $_fe_actual;
	/**
	 * @AttributeType float
	 * Fecha m�xima estimada para el crecimiento de la plataforma durante la elaboraci�n del componente.
	 */
	private $_fe_tope_demanda;
	/**
	 * @AssociationType Planes.TipoDeActivo
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_TipoDeActivo_;

/**
   * 
   * @access public
   */
  public $columCrecimiento= array('co_crecimiento'=>'co_crecimiento', 'ca_demanda_futura'=>'ca_demanda_futura', 'fe_actual'=>'fe_actual', 'fe_tope_demanda'=>'fe_tope_demanda', 'co_tipo_activo'=>'co_tipo_activo');
  
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
  public function insertarCrecimiento($crecimiento) {
  	
	$this->pdo->beginTransaction();	

	$crecimiento = array_intersect_key($crecimiento, $this->columCrecimiento);
	
	$r1 = $this->pdo->_insert('tr037_crecimiento', $crecimiento);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarCrecimiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarCrecimiento($crecimiento, $condiciones) {
  	$this->pdo->beginTransaction();	

	$crecimiento = array_intersect_key($crecimiento, $this->columCrecimiento);
	
	$r1 = $this->pdo->_update('tr037_crecimiento', $crecimiento, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarCrecimiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarCrecimiento($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr037_crecimiento', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarCrecimiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarCrecimiento( ) {

	$query = "SELECT 
  tr037_crecimiento.co_crecimiento, 
  tr037_crecimiento.ca_demanda_futura, 
  tr037_crecimiento.fe_actual, 
  tr037_crecimiento.fe_tope_demanda, 
  tr014_tipo_activo.nb_tipo_activo
FROM 
  public.tr037_crecimiento, 
  public.tr014_tipo_activo
WHERE 
  tr037_crecimiento.co_tipo_activo = tr014_tipo_activo.co_tipo_activo;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCrecimiento
}
?>