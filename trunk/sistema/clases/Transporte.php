<?php
require_once 'MyPDO.php';
require_once 'VehiculoEmpresa.php';


/**
 * Define la informacion de transporte necesaria para elaborar el plan de localizacion.
 * @access public
 * @package Planes
 */
class Transporte extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del transporte.
	 */
	private $_co_transporte;
	/**
	 * @AssociationType Planes.PlanLocalizacion
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_PlanLocalizacion_;
	/**
	 * @AssociationType Planes.LineaTaxi
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 */
	public $_requiere = array();

	/**
   * 
   * @access public
   */
  public $columTransporte= array('co_transporte'=>'co_transporte', 'fe_elaboracion'=>'fe_elaboracion');
  public $columTransporteVehiculo= array('co_transporte'=>'co_transporte', 'co_vehiculo'=>'co_vehiculo');
  public $columTransporteLinea= array('co_transporte'=>'co_transporte', 'co_linea'=>'co_linea');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarTransporte($transporte, $vehiculos, $lineas) {
  	
	$this->pdo->beginTransaction();	

	$transporte = array_intersect_key($transporte, $this->columTransporte);
	
	$r1 = $this->pdo->_insert('tr021_transporte', $transporte);
		//echo '<br>'.$r1;
	if(isset($vehiculos) && count($vehiculos)>0){
	foreach($vehiculos as $vehiculo){		
			if(is_array($vehiculo)){
				$vehiculo = array_intersect_key($vehiculo, $this->columTransporteVehiculo);
				//print_r($vehiculo);
				$r2 = $this->pdo->_insert('tr040_rel_transporte_vehiculo_empresa', $vehiculo); 
				}
			}
    	}
	if(isset($lineas) && count($lineas)>0){
	foreach($lineas as $linea){		
			if(is_array($linea)){
				$linea = array_intersect_key($linea, $this->columTransporteLinea);
				//print_r($vehiculo);
				$r3 = $this->pdo->_insert('tr041_rel_transporte_linea_taxi', $linea); 
				}
			}
    	}
	
	if($r1==1 && $r2==1 && $r3==1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	"-2= ".$r2; }
  
  } // end of member function insertarTransporte

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarTransporte($transporte, $condiciones) {
  	$this->pdo->beginTransaction();	

	$transporte = array_intersect_key($transporte, $this->columTransporte);
	
	$r1 = $this->pdo->_update('tr021_transporte', $transporte, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarTransporte

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarTransporte($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr021_transporte', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarTransporte

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarTransporte($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
	FROM 
 	public.tr021_transporte";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarTransporte


  public function cargarTransporteVehiculo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
	  tr021_transporte.co_transporte, 
	  tr021_transporte.fe_elaboracion, 
	  tr020_vehiculo_empresa.tx_placa, 
	  tr020_vehiculo_empresa.tx_marca, 
	  tr020_vehiculo_empresa.tx_unidad, 
	  tr020_vehiculo_empresa.tx_modelo
	FROM 
	  public.tr020_vehiculo_empresa, 
	  public.tr021_transporte, 
	  public.tr040_rel_transporte_vehiculo_empresa
	WHERE 
	  tr021_transporte.co_transporte = tr040_rel_transporte_vehiculo_empresa.co_transporte AND
	  tr040_rel_transporte_vehiculo_empresa.co_vehiculo = tr020_vehiculo_empresa.co_vehiculo";
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
