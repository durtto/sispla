<?php
require_once 'MyPDO.php';

/**
 * Define la informaci�n de los veh�culos de la empresa necesarios para el plan de localizaci�n.
 * @access public
 * @package Planes
 */
class VehiculoEmpresa extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del registro de veh�culos de la empresa.
	 */
	private $_co_vehiculo;
	/**
	 * @AttributeType string
	 * Marca del veh�culo.
	 */
	private $_tx_marca;
	/**
	 * @AttributeType string
	 * Modelo del veh�culo.
	 */
	private $_tx_modelo;
	/**
	 * @AttributeType float
	 * Placa del veh�culo.
	 */
	private $_tx_placa;
	/**
	 * @AttributeType int
	 * Numero de la unidad.
	 */
	private $_tx_unidad;
	/**
	 * @AssociationType Planes.Transporte
	 */
	public $_unnamed_Transporte_;

	/**
   * 
   * @access public
   */
  public $columVehiculo= array('co_vehiculo'=>'co_vehiculo', 'tx_placa'=>'tx_placa', 'tx_marca'=>'tx_marca', 'tx_modelo'=>'tx_modelo', 'tx_unidad'=>'tx_unidad');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarVehiculo() {
	$contar = "SELECT count(tr020_vehiculo_empresa.co_vehiculo)
	FROM tr020_vehiculo_empresa";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoVehiculo() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_vehiculo FROM tr020_vehiculo_empresa
		ORDER BY co_vehiculo DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarVehiculo($vehiculo) {
  	
	$this->pdo->beginTransaction();	

	$vehiculo = array_intersect_key($vehiculo, $this->columVehiculo);
	
	$r1 = $this->pdo->_insert('tr020_vehiculo_empresa', $vehiculo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarVehiculo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarVehiculo($vehiculo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$vehiculo = array_intersect_key($vehiculo, $this->columVehiculo);
	
	$r1 = $this->pdo->_update('tr020_vehiculo_empresa', $vehiculo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarVehiculo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarVehiculo($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr020_vehiculo_empresa', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarVehiculo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarVehiculo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
				FROM tr020_vehiculo_empresa";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarVehiculo
}
?>