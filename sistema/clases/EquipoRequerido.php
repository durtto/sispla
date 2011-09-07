<?php
require_once 'MyPDO.php';
require_once 'Activo.php';
require_once 'Persona.php';

/**
 * Definici�n del equipo requerido por el personal para realizar el mantenimiento de un activo.
 * @access public
 * @package Planes
 */
class EquipoRequerido extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de los datos del equipo requerido.
	 */
	private $_co_equipo_requerido;
	/**
	 * @AttributeType boolean
	 * Se define si necesita o no que la empresa le suministre un veh�culo.
	 */
	private $_bo_vehiculo;
	/**
	 * @AttributeType boolean
	 * Define si necesita del uso de una laptop para realizar el mantenimiento.
	 */
	private $_bo_laptop;
	/**
	 * @AttributeType boolean
	 * Se define si necesita de un malet�n de herramientas para las actividades que realizaran.
	 */
	private $_bo_maletin_herramientas;
	/**
	 * @AttributeType boolean
	 * Se define si necesita de un radio.
	 */
	private $_bo_radio;
	/**
	 * @AttributeType boolean
	 * Se define si necesita o no de un multimetro digital.
	 */
	private $_bo_mutimetro_digital;
	/**
	 * Se define si la persona necesita o no de un Hart.
	 */
	private $_bo_hart;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 0..1
	 */
	public $_unnamed_Persona_;

/**
   * 
   * @access public
   */
  public $columEquipoRequerido= array('co_equipo_requerido'=>'co_equipo_requerido', 'bo_vehiculo'=>'bo_vehiculo', 'bo_laptop'=>'bo_laptop', 'bo_maletin_herramientas'=>'bo_maletin_herramientas', 'bo_radio'=>'bo_radio', 'bo_multimetro_digital'=>'bo_multimetro_digital', 'bo_hart'=>'bo_hart', 'co_activo'=>'co_activo', 'co_indicador'=>'co_indicador');
  
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
  public function insertarEquipoRequerido($equiporequerido) {
  	
	$this->pdo->beginTransaction();	

	$equiporequerido = array_intersect_key($equiporequerido, $this->columEquipoRequerido);
	
	$r1 = $this->pdo->_insert('tr033_equipo_requerido', $equiporequerido);
	
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
  public function actualizarEquipoRequerido($equiporequerido, $condiciones) {
  	$this->pdo->beginTransaction();	

	$equiporequerido = array_intersect_key($equiporequerido, $this->columEquipoRequerido);
	
	$r1 = $this->pdo->_update('tr033_equipo_requerido', $equiporequerido, $condiciones);
	
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
  public function eliminarEquipoRequerido($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr033_equipo_requerido', $condiciones);
	
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
  public function cargarEquipoRequerido( ) {

	$query = "SELECT *
                FROM tr033_equipo_requerido;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarEquipoRequerido
}
?>