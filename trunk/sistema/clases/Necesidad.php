<?php
require_once 'MyPDO.php';
require_once 'Servicio.php';

/**
 * Define las caracter�sticas de la necesidad detectada dentro de la plataforma.
 * @access public
 * @package Planes
 */
class Necesidad extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de la necesidad detectada.
	 */
	private $_co_necesidad;
	/**
	 * @AttributeType string
	 * Descripci�n de la necesidad detectada.
	 */
	private $_tx_necesidad_detectada;
	/**
	 * Cantidad de activos necesarios para cubrir la necesidad.
	 */
	private $_ca_requerida;
	/**
	 * @AttributeType string
	 * Justificaci�n de la incorporaci�n de activos.
	 */
	private $_tx_justificacion;
	/**
	 * @AttributeType string
	 * Beneficio que obtiene la plataforma de AIT al cubrir con la necesidad detectada.
	 */
	private $_tx_beneficio;
	/**
	 * @AttributeType float
	 * Fecha en la que se requiere implementar la capacidad requerida.
	 */
	private $_fe_annio;
	/**
	 * @AssociationType Planes.Servicio
	 * @AssociationMultiplicity 0..*
	 */
	public $_se_identifica_en = array();

/**
   * 
   * @access public
   */
  public $columNecesidad= array('co_necesidad'=>'co_necesidad', 'tx_necesidad_detectada'=>'tx_necesidad_detectada', 'ca_requerida'=>'ca_requerida', 'tx_justificacion'=>'tx_justificacion', 'tx_beneficio'=>'tx_beneficio', 'fe_annio'=>'fe_annio', 'co_servicio'=>'co_servicio');
  
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
  public function insertarNecesidad($necesidad) {
  	
	$this->pdo->beginTransaction();	

	$necesidad = array_intersect_key($necesidad, $this->columNecesidad);
	
	$r1 = $this->pdo->_insert('tr038_necesidad', $necesidad);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarNecesidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarNecesidad($necesidad, $condiciones) {
  	$this->pdo->beginTransaction();	

	$necesidad = array_intersect_key($necesidad, $this->columNecesidad);
	
	$r1 = $this->pdo->_update('tr038_necesidad', $necesidad, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarNecesidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarNecesidad($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr038_necesidad', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarNecesidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarNecesidad( ) {

	$query = "SELECT 
  tr038_necesidad.co_necesidad, 
  tr038_necesidad.tx_necesidad_detectada, 
  tr038_necesidad.ca_requerida, 
  tr038_necesidad.tx_justificacion, 
  tr038_necesidad.tx_beneficio, 
  tr038_necesidad.fe_annio, 
  tr013_servicio.nb_servicio
FROM 
  public.tr038_necesidad, 
  public.tr013_servicio
WHERE 
  tr038_necesidad.co_servicio = tr013_servicio.co_servicio;

";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarNecesidad
}
?>