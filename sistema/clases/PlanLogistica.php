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
  public $columPlanLogisticaAlimentacion= array('co_plan_logistica'=>'co_plan_logistica','co_alimentacion'=>'co_alimentacion');
  public $columPlanLogisticaAlojamiento= array('co_plan_logistica'=>'co_plan_logistica','co_alojamiento'=>'co_alojamiento');
  public $columPlanLogisticaTransporte= array('co_plan_logistica'=>'co_plan_logistica','co_transporte'=>'co_transporte');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarPlanLogistica() {
	$contar = "SELECT count(tr042_plan_logistica.co_plan_logistica)
	FROM tr042_plan_logistica";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
  public function contarPlanLogisticaAlimentacion($plan) {
	$contar = "SELECT count(tr065_rel_plan_logistica_alimentacion.co_plan_logistica)
	FROM tr065_rel_plan_logistica_alimentacion
	WHERE tr065_rel_plan_logistica_alimentacion.co_plan_logistica ='".$plan."' ";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
  
   public function contarPlanLogisticaAlojamiento($plan) {
	$contar = "SELECT count(tr043_rel_plan_logistica_alojamiento.co_plan_logistica)
	FROM tr043_rel_plan_logistica_alojamiento
	WHERE tr043_rel_plan_logistica_alojamiento.co_plan_logistica ='".$plan."' ";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function contarPlanLogisticaTransporte($plan) {
	$contar = "SELECT count(tr044_rel_plan_logistica_transporte.co_plan_logistica)
	FROM tr044_rel_plan_logistica_transporte
	WHERE tr044_rel_plan_logistica_transporte.co_plan_logistica ='".$plan."' ";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
  public function insertarPlanLogistica($planlogistica,  $alimentaciones, $alojamientos, $transportes) {
  	
	$this->pdo->beginTransaction();	

	$planlogistica = array_intersect_key($planlogistica, $this->columPlanLogistica);
	
	$r1 = $this->pdo->_insert('tr042_plan_logistica', $planlogistica);
	
	if(isset($alimentaciones) && count($alimentaciones)>0){
	foreach($alimentaciones as $alimentacion){		
			if(is_array($alimentacion)){
				$alimentacion = array_intersect_key($alimentacion, $this->columPlanLogisticaAlimentacion);
				$r2 = $this->pdo->_insert('tr065_rel_plan_logistica_alimentacion', $alimentacion); 
				}
			}
    	}
	if(isset($alojamientos) && count($alojamientos)>0){
	foreach($alojamientos as $alojamiento){		
			if(is_array($alojamiento)){
				$alojamiento = array_intersect_key($alojamiento, $this->columPlanLogisticaAlojamiento);
				$r3 = $this->pdo->_insert('tr043_rel_plan_logistica_alojamiento', $alojamiento); 
				}
			}
    	}
	if(isset($transportes) && count($transportes)>0){
	foreach($transportes as $transporte){		
			if(is_array($transporte)){
				$transporte = array_intersect_key($transporte, $this->columPlanLogisticaTransporte);
				$r4 = $this->pdo->_insert('tr044_rel_plan_logistica_transporte', $transporte); 
				}
			}
    	}
	
	if($r1==1 && $r2==1 && $r3==1 && $r4==1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1; "-2= ".$r2;"-3= ".$r3; "-4= ".$r4;}
  
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