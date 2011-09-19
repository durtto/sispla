<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n sobre el plan de localizaci�n.
 * @access public
 * @package Planes
 */
class PlanLocalizacion extends MyPDO {
	/**
	 * @AttributeType int
	 * Clave primaria del plan de localizaci�n.
	 */
	private $_co_planloc;
	/**
	 * @AttributeType float
	 * Fecha de elaboraci�n del plan de localizaci�n.
	 */
	private $_fe_eleboracion;
	/**
	 * @AssociationType Planes.Alojamiento
	 * @AssociationMultiplicity 0..*
	 */
	public $_unnamed_Alojamiento_ = array();
	/**
	 * @AssociationType Planes.Alimentacion
	 * @AssociationMultiplicity 0..*
	 */
	public $_unnamed_Alimentacion_ = array();
	/**
	 * @AssociationType Planes.Transporte
	 * @AssociationMultiplicity 0..*
	 */
	public $_unnamed_Transporte_ = array();
	/**
	 * @AssociationType Planes.Proveedor
	 * @AssociationMultiplicity *
	 */
	public $_unnamed_Proveedor_ = array();
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 0..*
	 */
	public $_unnamed_Persona_ = array();

	/**
   * 
   * @access public
   */
  public $columPlanLocalizacion= array('co_plan_localizacion'=>'co_plan_localizacion','fe_elaboracion'=>'fe_elaboracion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarPlanLocalizacion($planlocalizacion) {
  	
	$this->pdo->beginTransaction();	

	$planlocalizacion = array_intersect_key($planlocalizacion, $this->columPlanLocalizacion);
	
	$r1 = $this->pdo->_insert('tr036_plan_localizacion', $planlocalizacion);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarPlanLocalizacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarPlanLocalizacion($planlocalizacion, $condiciones) {
  	$this->pdo->beginTransaction();	

	$planlocalizacion = array_intersect_key($planlocalizacion, $this->columPlanLocalizacion);
	
	$r1 = $this->pdo->_update('tr036_plan_localizacion', $planlocalizacion, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarPlanLocalizacion

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarPlanLocalizacion($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr036_plan_localizacion', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarPlanLocalizacion

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarPlanLocalizacion() {

	$query = "SELECT *
				FROM tr036_plan_localizacion;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarPlanLocalizacion
}
?>