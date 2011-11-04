<?php
require_once 'MyPDO.php';

/**
 * Define los datos generales correspondientes a los componentes.
 * @access public
 * @package Planes
 */
class Dato extends MyPDO
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
  public $columDato= array('co_componente'=>'co_componente', 'fe_vigencia'=>'fe_vigencia', 'tx_objetivo'=>'tx_objetivo', 'tx_alcance'=>'tx_alcance', 'tx_identificacion_negocio'=>'tx_identificacion_negocio', 'tx_localidad'=>'tx_localidad', 'tx_organizacion'=>'tx_organizacion');
  
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
  public function insertarDato($dato) {
  	
	$this->pdo->beginTransaction();	

	$dato = array_intersect_key($dato, $this->columDato);
	
	$r1 = $this->pdo->_insert('tr015_datos_plan', $dato);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarDato

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarDato($Dato, $condiciones) {
  	$this->pdo->beginTransaction();	

	$dato = array_intersect_key($dato, $this->columDato);
	
	$r1 = $this->pdo->_update('tr015_datos_plan', $dato, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarDato

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarDato($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr015_datos_plan', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarDato

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarDato($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
					tr015_datos_plan.co_componente, 
  					tr015_datos_plan.fe_vigencia, 
  					tr015_datos_plan.tx_objetivo, 
  					tr015_datos_plan.tx_alcance, 
 					tr015_datos_plan.tx_identificacion_negocio, 
  					tr015_datos_plan.tx_localidad, 
  					tr015_datos_plan.tx_organizacion
				FROM 
  					public.tr015_datos_plan";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarDato
}
?>
