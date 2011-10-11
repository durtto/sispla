<?php
require_once 'MyPDO.php';



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

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarTransporte($transporte) {
  	
	$this->pdo->beginTransaction();	

	$transporte = array_intersect_key($transporte, $this->columTransporte);
	
	$r1 = $this->pdo->_insert('tr021_transporte', $transporte);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
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
  public function cargarTransporte() {

	$query = "SELECT 
  *
FROM 
  public.tr021_transporte;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarTransporte





  public function cargarTransporteVehiculo() {

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
  tr040_rel_transporte_vehiculo_empresa.co_vehiculo = tr020_vehiculo_empresa.co_vehiculo;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  }
  
  
  public function insertarTransporteVehiculo($transporte) {
  	
	$this->pdo->beginTransaction();	

	$transporte = array_intersect_key($transporte, $this->columTransporte);
	
	$r1 = $this->pdo->_insert('tr040_rel_transporte_vehiculo_empresa', $transporte);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarTransporte
  
}
?>