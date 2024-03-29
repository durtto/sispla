<?php
require_once 'MyPDO.php';
require_once 'TipoDeActivo.php';

/**
 * Se definen la demanda que requiere la plataforma para cumplir la proyecci�n futura.
 * @access public
 * @package Planes
 */
class Crecimiento extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del crecimiento.
	 */
	private $_co_crecimiento;
	/**
	 * @AttributeType float
	 * Cantidad necesaria para la demanda futura.
	 */
	private $_ca_demanda_futura;
	/**
	 * @AttributeType float
	 * Fecha de actual en la que es considerado el crecimiento.
	 */
	private $_fe_actual;
	/**
	 * @AttributeType float
	 * Fecha m�xima estimada para el crecimiento de la plataforma durante la elaboraci�n del componente.
	 */
	private $_fe_tope_demanda;
	/**
	 * @AssociationType Planes.TipoDeActivo
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_TipoDeActivo;

/**
   * 
   * @access public
   */
  public $columCrecimiento= array('co_crecimiento'=>'co_crecimiento', 'ca_demanda_futura'=>'ca_demanda_futura', 'fe_actual'=>'fe_actual', 'fe_tope_demanda'=>'fe_tope_demanda', 'co_tipo_activo'=>'co_tipo_activo', 'tx_descripcion'=>'tx_descripcion');
  
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
  public function contarCrecimiento() {
	$contar = "SELECT count(tr037_crecimiento.co_crecimiento)
	FROM tr037_crecimiento";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoCrecimiento() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_crecimiento FROM tr037_crecimiento
		ORDER BY co_crecimiento DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarCrecimiento($crecimiento) {
  	
	$this->pdo->beginTransaction();	

	$crecimiento = array_intersect_key($crecimiento, $this->columCrecimiento);
	
	$r1 = $this->pdo->_insert('tr037_crecimiento', $crecimiento);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarCrecimiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarCrecimiento($crecimiento, $condiciones) {
  	$this->pdo->beginTransaction();	

	$crecimiento = array_intersect_key($crecimiento, $this->columCrecimiento);
	
	$r1 = $this->pdo->_update('tr037_crecimiento', $crecimiento, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarCrecimiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarCrecimiento($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr037_crecimiento', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarCrecimiento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarCrecimiento($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  				c.co_crecimiento, 
  				c.ca_demanda_futura, 
				c.fe_actual, 
				c.fe_tope_demanda, 
				c.tx_descripcion,
				t.co_tipo_activo,
				t.nb_tipo_activo
				FROM 
				tr037_crecimiento c
				LEFT JOIN  tr014_tipo_activo t ON (c.co_tipo_activo = t.co_tipo_activo)";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCrecimiento
}
?>