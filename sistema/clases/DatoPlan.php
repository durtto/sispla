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
  public $columDato= array('co_componente'=>'co_componente', 'fe_vigencia'=>'fe_vigencia', 'tx_objetivo'=>'tx_objetivo', 'tx_alcance'=>'tx_alcance', 'co_negocio'=>'co_negocio', 'tx_localidad'=>'tx_localidad', 'co_organizacion'=>'co_organizacion');
  
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
  public function contarDato() {
	$contar = "SELECT count(tr015_datos_plan.co_componente)
	FROM tr015_datos_plan";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoDato() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_componente FROM tr015_datos_plan
		ORDER BY co_componente DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
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
  public function actualizarDato($dato, $condiciones) {
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
  dp.fe_vigencia, 
  dp.tx_objetivo, 
  dp.tx_alcance, 
  dp.tx_localidad, 
  dp.co_componente, 
  dp.co_organizacion, 
  dp.co_negocio, 
  o.nb_organizacion, 
  n.nb_negocio
FROM 
  tr015_datos_plan dp
  INNER JOIN tr066_negocio n ON (dp.co_negocio = n.co_negocio)
  LEFT JOIN tr067_organizacion o ON (dp.co_organizacion = o.co_organizacion)";
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
