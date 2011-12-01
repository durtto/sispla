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
  public $columPlanLocalizacionProveedor= array('co_plan_localizacion'=>'co_plan_localizacion','co_proveedor'=>'co_proveedor');
  public $columPlanLocalizacionDirectorio= array('co_plan_localizacion'=>'co_plan_localizacion','co_directorio'=>'co_directorio');
  public $columPlanLocalizacionEquipoContinuidad= array('co_plan_localizacion'=>'co_plan_localizacion','co_equipo_continuidad'=>'co_equipo_continuidad');
  public $columPlanLocalizacionPersona= array('co_plan_localizacion'=>'co_plan_localizacion','co_indicador'=>'co_indicador');
 
  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarPlanLocalizacion() {
	$contar = "SELECT count(tr036_plan_localizacion.co_plan_localizacion)
	FROM tr036_plan_localizacion";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarPlanLocalizacion($planlocalizacion, $proveedores, $directorios, $personas, $equipos) {
  	
	$this->pdo->beginTransaction();	

	$planlocalizacion = array_intersect_key($planlocalizacion, $this->columPlanLocalizacion);
	
	$r1 = $this->pdo->_insert('tr036_plan_localizacion', $planlocalizacion);
	
	if(isset($proveedores) && count($proveedores)>0){
	foreach($proveedores as $proveedor){		
			if(is_array($proveedor)){
				$proveedor = array_intersect_key($proveedor, $this->columPlanLocalizacionProveedor);
				$r2 = $this->pdo->_insert('tr046_rel_plan_localizacion_proveedor', $proveedor); 
				}
			}
    	}
	if(isset($directorios) && count($directorios)>0){
	foreach($directorios as $directorio){		
			if(is_array($directorio)){
				$directorio = array_intersect_key($directorio, $this->columPlanLocalizacionDirectorio);
				$r3 = $this->pdo->_insert('tr060_rel_plan_localizacion_directorio', $directorio); 
				}
			}
    	}
	if(isset($personas) && count($personas)>0){
	foreach($personas as $persona){		
			if(is_array($persona)){
				$persona = array_intersect_key($persona, $this->columPlanLocalizacionPersona);
				$r4 = $this->pdo->_insert('tr045_rel_plan_localizacion_persona', $persona); 
				}
			}
    	}
	
	if(isset($equipos) && count($equipos)>0){
	foreach($equipos as $equipo){		
			if(is_array($equipo)){
				$equipo = array_intersect_key($equipo, $this->columPlanLocalizacionEquipoContinuidad);
				$r5 = $this->pdo->_insert('tr062_rel_plan_localizacion_equipo', $equipo); 
				}
			}
    	}
	
	
	
	
	if($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	"-2= ".$r2; "-3= ".$r3; "-4= ".$r4; "-5= ".$r5;}
  
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
  public function cargarPlanLocalizacion($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr036_plan_localizacion";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarPlanLocalizacion
}
?>