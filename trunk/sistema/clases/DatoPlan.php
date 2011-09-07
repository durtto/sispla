<?php
require_once 'MyPDO.php';

/**
 * Define los datos generales correspondientes a los componentes.
 * @access public
 * @package Planes
 */
class DatoPlan extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del componente.
	 */
	private $_co_componente;
	/**
	 * @AttributeType float
	 * Periodo de vigencia del componente.
	 */
	private $_fe_vigencia;
	/**
	 * @AttributeType string
	 * Objetivos del componente.
	 */
	private $_tx_objetivo;
	/**
	 * @AttributeType string
	 * Alcance que tendra el componente.
	 */
	private $_tx_alcance;
	/**
	 * @AttributeType string
	 * Identificaci�n del negocio el cual elabora el componente.
	 */
	private $_tx_identificacion_negocio;
	/**
	 * @AttributeType string
	 * Localidad donde es elaborado el componente.
	 */
	private $_tx_localidad;
	/**
	 * @AttributeType string
	 * Organizaci�n para la que esta elaborado el componente.
	 */
	private $_tx_organizacion;

/**
   * 
   * @access public
   */
  public $columDatoPlan= array('co_componente'=>'co_componente', 'fe_vigencia'=>'fe_vigencia', 'tx_objetivo'=>'tx_objetivo', 'tx_alcance'=>'tx_alcance', 'tx_identificacion_negocio'=>'tx_identificacion_negocio', 'tx_localidad'=>'tx_localidad', 'tx_organizacion'=>'tx_organizacion');
  
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
  public function insertarDatoPlan($datoplan) {
  	
	$this->pdo->beginTransaction();	

	$datoplan = array_intersect_key($datoplan, $this->columDatoPlan);
	
	$r1 = $this->pdo->_insert('tr015_datos_plan', $datoplan);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarDatoPlan

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarDatoPlan($datoplan, $condiciones) {
  	$this->pdo->beginTransaction();	

	$datoplan = array_intersect_key($datoplan, $this->columDatoPlan);
	
	$r1 = $this->pdo->_update('tr015_datos_plan', $datoplan, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarDatoPlan

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarDatoPlan($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr015_datos_plan', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarDatoPlan

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarDatoPlan( ) {

	$query = "SELECT *
                FROM tr015_datos_plan;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarDatoPlan
}
?>