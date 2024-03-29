<?php
require_once 'MyPDO.php';

/**
 * Define los datos necesarios de los procesos dentro del negocio que se relacionan con los distintos activos dentro de la plataforma de AIT.
 * @access public
 * @package Planes
 */
class Proceso extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del proceso.
	 */
	private $_co_proceso;
	/**
	 * @AttributeType string
	 * Nombre del proceso.
	 */
	private $_nb_nombre;
	/**
	 * @AttributeType string
	 * Descripci�n del proceso.
	 */
	private $_tx_descripcion;
	/**
	 * @AttributeType boolean
	 * Se define si el proceso es critico para el negocio o no.
	 */
	private $_bo_critico;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity *
	 */
	public $_requiere = array();

	/**
   * 
   * @access public
   */
  public $columProceso= array('co_proceso'=>'co_proceso', 'nb_proceso'=>'nb_proceso', 'tx_descripcion'=>'tx_descripcion', 'bo_critico'=>'bo_critico');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarProceso() {
	$contar = "SELECT count(tr016_proceso.co_proceso)
	FROM tr016_proceso";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoProceso() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_proceso FROM tr016_proceso
		ORDER BY co_proceso DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarProceso($proceso) {
  	
	$this->pdo->beginTransaction();	

	$proceso = array_intersect_key($proceso, $this->columProceso);
	
	$r1 = $this->pdo->_insert('tr016_proceso', $proceso);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarProceso

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarProceso($proceso, $condiciones) {
  	$this->pdo->beginTransaction();	

	$proceso = array_intersect_key($proceso, $this->columProceso);
	
	$r1 = $this->pdo->_update('tr016_proceso', $proceso, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarProceso

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarProceso($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr016_proceso', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarProceso

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarProceso($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  					tr016_proceso.co_proceso, 
  					tr016_proceso.nb_proceso, 
  					tr016_proceso.tx_descripcion, 
				CASE
    			WHEN tr016_proceso.bo_critico = true
     			THEN 'SI'
     			ELSE 'NO'
     			END AS bo_critico
				FROM 
  					public.tr016_proceso";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarProceso
}
?>