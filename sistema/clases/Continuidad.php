<?php
require_once 'MyPDO.php';
require_once 'Activo.php';

/**
 * Define el esquema de continuidad que posee el activo.
 * @access public
 * @package Planes
 */
class Continuidad extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del esquema de continuidad.
	 */
	private $_co_continuidad;
	/**
	 * @AttributeType boolean
	 * Define la prioridad de recuperaci�n que tiene el activo.
	 */
	private $_bo_prioridad_rec;
	/**
	 * @AttributeType float
	 * MAXIMUM TOLERABLE DOWNTIME (MTD) representa el m�ximo tiempo de inactividad que puede tolerar el negocio.
	 */
	private $_fe_mtd;
	/**
	 * @AttributeType float
	 * RECOVERY TIME OBJECTIVE (RTO) Indica el tiempo establecido por el custodio AIT para la recuperaci�n del sistema/recurso que ha sufrido una alteraci�n, sin involucrar la carga de datos del negocio.
	 */
	private $_fe_rto;
	/**
	 * @AttributeType boolean
	 * Si posee un esquema alterno de respaldo dentro de las instalaciones.
	 */
	private $_bo_esquema_alterno_interno;
	/**
	 * @AttributeType boolean
	 * Si posee un esquema alterno de respaldo fuera de las instalaciones.
	 */
	private $_bo_esquema_alterno_externo;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1
	 */
	public $_depende;

/**
   * 
   * @access public
   */
  public $columContinuidad= array('co_continuidad'=>'co_continuidad', 'bo_prioridad_rec'=>'bo_prioridad_rec', 'fe_mtd'=>'fe_mtd', 'fe_rto'=>'fe_rto', 'bo_esquema_alterno_interno'=>'bo_esquema_alterno_interno', 'bo_esquema_alterno_externo'=>'bo_esquema_alterno_externo', 'co_activo'=>'co_activo');
  
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
  public function insertarContinuidad($continuidad) {
  	
	$this->pdo->beginTransaction();	

	$continuidad = array_intersect_key($continuidad, $this->columContinuidad);
	
	$r1 = $this->pdo->_insert('tr035_continuidad', $continuidad);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarContinuidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarContinuidad($continuidad, $condiciones) {
  	$this->pdo->beginTransaction();	

	$continuidad = array_intersect_key($continuidad, $this->columContinuidad);
	
	$r1 = $this->pdo->_update('tr035_continuidad', $continuidad, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarContinuidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarContinuidad($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr035_continuidad', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarContinuidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarContinuidad( ) {

	$query = "SELECT *
                FROM tr035_continuidad;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarContinuidad
}
?>