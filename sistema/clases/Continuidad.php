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
    public function contarContinuidad() {
	$contar = "SELECT count(tr035_continuidad.co_continuidad)
	FROM tr035_continuidad";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
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
  public function cargarContinuidad($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
			  	tr035_continuidad.co_continuidad, 
			  	tr035_continuidad.fe_mtd, 
			  	tr035_continuidad.fe_rto, 
			  	tr027_activo.co_activo,
			  	tr027_activo.nb_activo,
			  CASE
			 	WHEN tr035_continuidad.bo_esquema_alterno_interno = true
			 	THEN 'SI'
				ELSE 'NO'
			 	END AS bo_esquema_alterno_interno,
			  CASE
			 	WHEN tr035_continuidad.bo_esquema_alterno_externo = true
			 	THEN 'SI'
			 	ELSE 'NO'
			 	END AS bo_esquema_alterno_externo,
			  CASE
			 	WHEN tr035_continuidad.bo_prioridad_rec = true
			 	THEN 'ALTA'
			 	ELSE 'BAJA'
			 	END AS bo_prioridad_rec
			  FROM 
			  	public.tr035_continuidad, 
			  	public.tr027_activo
			  WHERE 
				tr035_continuidad.co_activo = tr027_activo.co_activo";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarContinuidad
}
?>