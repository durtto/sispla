<?php
require_once 'MyPDO.php';
require_once 'Activo.php';
require_once 'TipoDeRespaldo.php';
/**
 * Se define el esquema de respaldo del activo.
 * @access public
 * @package Planes
 */
class Respaldo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del respaldo.
	 */
	private $_co_respaldo;
	/**
	 * @AttributeType boolean
	 * Se define si el respaldo es FULL o INCREMENTAL
	 */
	private $_nu_veces_al_dia;
	/**
	 * @AttributeType string
	 * D�as de la semana en que se realizara el respaldo.
	 */
	private $_tx_dias_de_semana;
	/**
	 * @AttributeType float
	 * Tiempo en que se mantendr� almacenada la informaci�n que fue respaldada.
	 */
	private $_nu_tiempo_retencion_data;
	/**
	 * @AttributeType string
	 * Descripci�n de la data almacenada en el respaldo.
	 */
	private $_tx_descripcion_data;
	/**
	 * @AttributeType int
	 * Fecha de la realizacion del ultimo respaldo.
	 */
	private $_fe_ultimo_respaldo;
	/**
	 * @AttributeType string
	 * Ubicaci�n l�gica f�sica del respaldo.
	 */
	private $_tx_ubicacion_logica_fisica;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1
	 */
	public $_pertenece;

	/**
   * 
   * @access public
   */
  public $columRespaldo= array('co_respaldo'=>'co_respaldo', 'nu_veces_al_dia'=>'nu_veces_al_dia', 'tx_dias_semana'=>'tx_dias_semana', 'nu_tiempo_retencion_data'=>'nu_tiempo_retencion_data', 'tx_descripcion_data'=>'tx_descripcion_data', 'fe_ultimo_respaldo'=>'fe_ultimo_respaldo', 'co_ubicacion'=>'co_ubicacion', 'co_activo'=>'co_activo', 'co_tipo_respaldo'=>'co_tipo_respaldo');

  /**
   * 
   *
   * @return string
   * @access public
   */
   public function contarRespaldo() {
	$contar = "SELECT count(tr039_respaldo.co_respaldo)
	FROM tr039_respaldo";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
    public function NuevoRespaldo() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_respaldo FROM tr039_respaldo
		ORDER BY co_respaldo DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarRespaldo($respaldo) {
  	
	$this->pdo->beginTransaction();	

	$respaldo = array_intersect_key($respaldo, $this->columRespaldo);
	
	$r1 = $this->pdo->_insert('tr039_respaldo', $respaldo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarRespaldo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarRespaldo($respaldo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$respaldo = array_intersect_key($respaldo, $this->columRespaldo);
	
	$r1 = $this->pdo->_update('tr039_respaldo', $respaldo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarRespaldo

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarRespaldo($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr039_respaldo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarRespaldo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarRespaldo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  r.co_respaldo, 
  r.nu_veces_al_dia, 
  r.tx_dias_semana, 
  r.nu_tiempo_retencion_data, 
  r.tx_descripcion_data, 
  r.fe_ultimo_respaldo, 
  r.co_ubicacion,
  u.nb_ubicacion,
  r.co_activo, 
  a.nb_activo, 
  r.co_tipo_respaldo, 
  t.nb_tipo_respaldo
FROM 
  tr039_respaldo r
  INNER JOIN tr034_tipo_respaldo t ON (r.co_tipo_respaldo = t.co_tipo_respaldo)
  INNER JOIN tr027_activo a ON (r.co_activo = a.co_activo)
  INNER JOIN tr006_ubicacion u ON (r.co_ubicacion = u.co_ubicacion)";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarRespaldo
}
?>