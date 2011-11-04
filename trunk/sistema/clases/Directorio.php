<?php
require_once 'MyPDO.php';

/**
 * Define los datos del directorio.
 * @access public
 * @package Planes
 */
class Directorio extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del directorio
	 */
	private $_co_directorio;
	/**
	 * @AttributeType string
	 * Nombre del estado del directorio.
	 */
	private $_nb_directorio;
	/**
	 * @AttributeType string
	 * Numero telefonico.
	 */
	private $_nu_telefono;
	/**
	 * @AssociationType Planes.TpDirectorio
	 * @AssociationMultiplicity 1..*
	 */
	public $_refiere = array();
	

/**
   * 
   * @access public
   */
  public $columDirectorio= array('co_directorio'=>'co_directorio', 'nb_directorio'=>'nb_directorio', 'co_tipo_directorio'=>'co_tipo_directorio', 'nu_telefono'=>'nu_telefono');
  
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
  public function insertarDirectorio($directorio) {
  	
	$this->pdo->beginTransaction();	

	$directorio = array_intersect_key($directorio, $this->columDirectorio);
	
	$r1 = $this->pdo->_insert('tr051_directorio', $directorio);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarDirectorio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarDirectorio($directorio, $condiciones) {
  	$this->pdo->beginTransaction();	

	$directorio = array_intersect_key($directorio, $this->columDirectorio);
	
	$r1 = $this->pdo->_update('tr051_directorio', $directorio, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarDirectorio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarDirectorio($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr051_directorio', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarDirectorio

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarDirectorio($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  tr051_directorio.co_directorio, 
  tr051_directorio.nb_directorio, 
  tr050_tipo_directorio.nb_tipo_directorio,
  tr051_directorio.nu_telefono
  
FROM 
  public.tr051_directorio, 
  public.tr050_tipo_directorio
WHERE 
  tr051_directorio.co_tipo_directorio = tr050_tipo_directorio.co_tipo_directorio";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarDirectorio
}
?>