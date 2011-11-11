<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n sobre el plan de localizaci�n.
 * @access public
 * @package Planes
 */
class PlanLogistica extends MyPDO {
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
/**
   * 
   * @access public
   */
  public $columPlanLogistica= array('co_plan_logistica'=>'co_plan_logistica','fe_elaboracion'=>'fe_elaboracion');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarPlanLogistica($planlogistica) {
  	
	$this->pdo->beginTransaction();	

	$planlogistica = array_intersect_key($planlogistica, $this->columPlanLogistica);
	
	$r1 = $this->pdo->_insert('tr042_plan_logistica', $planlogistica);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarPlanLogistica

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarPlanLogistica($planlogistica, $condiciones) {
  	$this->pdo->beginTransaction();	

	$planlogistica = array_intersect_key($planlogistica, $this->columPlanLogistica);
	
	$r1 = $this->pdo->_update('tr042_plan_logistica', $planlogistica, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarPlanLogistica

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarPlanLogistica($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr042_plan_logistica', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarPlanLogistica

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarPlanLogistica($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr042_plan_logistica";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarPlanLogistica
}
?>