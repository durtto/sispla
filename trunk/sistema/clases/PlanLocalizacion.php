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
  public $columPlanLocalizacionComponente= array('co_plan_localizacion'=>'co_plan_localizacion','co_componente'=>'co_componente');
 
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
  
  public function contarPlanLocalizacionPersona($plan) {
	$contar = "SELECT count(tr045_rel_plan_localizacion_persona.co_plan_localizacion)
	FROM tr045_rel_plan_localizacion_persona
	WHERE tr045_rel_plan_localizacion_persona.co_plan_localizacion ='".$plan."' ";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function contarPlanLocalizacionProveedor($plan) {
	$contar = "SELECT count(tr046_rel_plan_localizacion_proveedor.co_plan_localizacion)
	FROM tr046_rel_plan_localizacion_proveedor
	WHERE tr046_rel_plan_localizacion_proveedor.co_plan_localizacion ='".$plan."' ";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
  
    public function contarPlanLocalizacionDirectorio($plan) {
	$contar = "SELECT count(tr060_rel_plan_localizacion_directorio.co_plan_localizacion)
	FROM tr060_rel_plan_localizacion_directorio
	WHERE tr060_rel_plan_localizacion_directorio.co_plan_localizacion =  '".$plan."' ";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
	
	public function contarPlanLocalizacionEquipo($plan) {
	$contar = "SELECT count(tr062_rel_plan_localizacion_equipo.co_plan_localizacion)
	FROM tr062_rel_plan_localizacion_equipo
	WHERE tr062_rel_plan_localizacion_equipo.co_plan_localizacion = '".$plan."' ";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
	
		
  public function insertarPlanLocalizacion($planlocalizacion, $proveedores, $directorios, $personas, $equipos, $componente) 
  {
  	
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
	if(is_array($componente)){
   	$componente = array_intersect_key($componente, $this->columPlanLocalizacionComponente);
	$r6 = $this->pdo->_insert('tr063_rel_datos_plan_plan_localizacion', $componente);
	}

	
	if($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1 && $r6==1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1." -2= ".$r2." -3= ".$r3." -4= ".$r4." -5= ".$r5." -6= ".$r6;}
  
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
  }
  
  
    public function cargarPlanLocalizacionPersona($plan, $start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  pl.fe_elaboracion, 
  pp.co_plan_localizacion, 
  pp.co_indicador, 
  p.co_indicador, 
  p.nu_cedula, 
  p.nb_persona, 
  p.tx_apellido, 
  p.di_oficina
FROM 
  tr045_rel_plan_localizacion_persona pp
  INNER JOIN tr010_persona p ON (pp.co_indicador = p.co_indicador) 
  LEFT JOIN tr036_plan_localizacion pl ON ( pp.co_plan_localizacion = pl.co_plan_localizacion)
 WHERE
	pp.co_plan_localizacion ='".$plan."' ";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  }
  
  
  public function cargarPlanLocalizacionProveedor($plan, $start='0', $limit='ALL', $sort = "", $dir = "ASC") {

  $query = "SELECT 
  p.nb_proveedor, 
  p.di_oficina, 
  p.tx_servicio_prestado, 
  plp.co_proveedor, 
  plp.co_plan_localizacion, 
  pl.fe_elaboracion, 
  cp.co_proveedor, 
  cp.nb_contacto, 
  cp.tx_apellido, 
  cp.tx_telefono, 
  cp.tx_correo_electronico, 
  cp.co_contacto
	FROM 
  public.tr046_rel_plan_localizacion_proveedor plp 
  INNER JOIN public.tr025_proveedor p ON (plp.co_proveedor = p.co_proveedor)
  INNER JOIN public.tr026_contacto_proveedor cp ON (cp.co_proveedor = p.co_proveedor)
  LEFT JOIN public.tr036_plan_localizacion pl ON (plp.co_plan_localizacion = pl.co_plan_localizacion)
	WHERE 
  plp.co_plan_localizacion = '".$plan."' ";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  }
  
    public function cargarPlanLocalizacionDirectorio($plan, $start='0', $limit='ALL', $sort = "", $dir = "ASC") {

  $query = "SELECT 
  pld.co_plan_localizacion, 
  pl.fe_elaboracion, 
  pld.co_directorio, 
  d.nb_directorio, 
  tpd.nb_tipo_directorio, 
  d.nu_telefono
	FROM 
  tr060_rel_plan_localizacion_directorio pld
  INNER JOIN tr051_directorio d ON (pld.co_directorio = d.co_directorio) 
  INNER JOIN tr050_tipo_directorio tpd ON (d.co_tipo_directorio = tpd.co_tipo_directorio)
  LEFT JOIN tr036_plan_localizacion pl ON (pld.co_plan_localizacion = pl.co_plan_localizacion)
  WHERE 
  pld.co_plan_localizacion = '".$plan."' ";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  }
  
  public function cargarPlanLocalizacionEquipo($plan, $start='0', $limit='ALL', $sort = "", $dir = "ASC") {

  $query = "SELECT 
	ple.co_plan_localizacion, 
	ple.co_equipo_continuidad, 
	e.co_indicador, 
	pl.fe_elaboracion,
	p.co_indicador,
	p.nu_cedula,
	p.nb_persona, 
	p.tx_apellido, 
	r.co_rol_resp,
	r.nb_rol_resp 
	FROM
	tr062_rel_plan_localizacion_equipo ple 
	INNER JOIN tr061_equipo_continuidad e ON (ple.co_equipo_continuidad = e.co_equipo_continuidad)
	INNER JOIN tr010_persona p ON (e.co_indicador = p.co_indicador)
	INNER JOIN tr002_rol_responsabilidad r ON (e.co_rol_resp = r.co_rol_resp)
	LEFT JOIN tr036_plan_localizacion pl ON ( ple.co_plan_localizacion = pl.co_plan_localizacion)
  WHERE 
  ple.co_plan_localizacion = '".$plan."' ";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  }
  
  
  
  
  
}
?>
