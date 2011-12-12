<?php
require_once 'MyPDO.php';
require_once 'Activo.php';

/**
 * Se refiere a la garant�a que se le otorga a un activo por parte del proveedor o fabricante.
 * @access public
 * @package Planes
 */
class Garantia extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de la garantia.
	 */
	private $_co_garantia;
	/**
	 * @AttributeType float
	 * Descripcion de la garant�a del producto.
	 */
	private $_tx_descripcion;
	/**
	 * @AttributeType float
	 * Fecha de inicio de la garant�a del producto.
	 */
	private $_fe_inicio;
	/**
	 * @AttributeType float
	 * Fecha de culminacion de la garant�a del producto.
	 */
	private $_fe_fin;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1
	 */
	public $_se_otorgada;

/**
   * 
   * @access public
   */
  public $columGarantia= array('co_garantia'=>'co_garantia', 'tx_descripcion'=>'tx_descripcion', 'fe_inicio'=>'fe_inicio', 'fe_fin'=>'fe_fin', 'co_activo'=>'co_activo');
  
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
   public function contarGarantia() {
	$contar = "SELECT count(tr032_garantia.co_garantia)
	FROM tr032_garantia";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarGarantia($garantia) {
  	
	$this->pdo->beginTransaction();	

	$garantia = array_intersect_key($garantia, $this->columGarantia);
	
	$r1 = $this->pdo->_insert('tr032_garantia', $garantia);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarGarantia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarGarantia($garantia, $condiciones) {
  	$this->pdo->beginTransaction();	

	$garantia = array_intersect_key($garantia, $this->columGarantia);
	
	$r1 = $this->pdo->_update('tr032_garantia', $garantia, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarGarantia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarGarantia($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr032_garantia', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarGarantia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarGarantia($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr032_garantia";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarGarantia
  
  
  
  public function cargarTpActivo() {
	$query = "SELECT DISTINCT a.co_tipo_activo, t.nb_tipo_activo
		 FROM 
  		 tr027_activo a
		  INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
		  INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
		  INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
		  INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
		  INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
		  INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
		  INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
		  INNER JOIN tr013_servicio s ON (t.co_servicio = s.co_servicio)
		  INNER JOIN tr012_capacidad cp ON (s.co_capacidad = cp.co_capacidad)
	      INNER JOIN tr011_categoria c ON (c.co_categoria = t.co_categoria)
		  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)";
			if ($ubic != "")
			{
			$query	.= "WHERE 
		  	a.co_ubicacion IN (SELECT 
		  	u.co_ubicacion
			FROM 
			tr006_ubicacion u 
			LEFT JOIN tr005_tipo_ubicacion t on (u.co_tipo_ubicacion = t.co_tipo_ubicacion)
			WHERE 
			u.co_ubicacion_padre = u.co_ubicacion_padre AND
			u.co_ubicacion_padre= '".$ubic."')";
			}
	
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivo  
  
    public function cargarActivo($tpactivo, $ubic/* $start='0', $limit='ALL', $sort = "", $dir = "ASC"*/) {
	$query = "SELECT 
		  a.co_activo, 
		  a.nb_activo 
		 FROM 
  		tr027_activo a
		  INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
		  INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
		  INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
		  INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
		  INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
		  INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
		  INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
		  INNER JOIN tr013_servicio s ON (t.co_servicio = s.co_servicio)
		  INNER JOIN tr012_capacidad cp ON (s.co_capacidad = cp.co_capacidad)
	      INNER JOIN tr011_categoria c ON (c.co_categoria = t.co_categoria)
		  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)";
			if ($tpactivo != "")
			{
			$query	.= "WHERE t.co_tipo_activo='".$tpactivo."'";
			}
			if ($ubic != "")
			{
			$query	.= "AND
		  	a.co_ubicacion IN (SELECT 
		  	u.co_ubicacion
			FROM 
			tr006_ubicacion u 
			LEFT JOIN tr005_tipo_ubicacion t on (u.co_tipo_ubicacion = t.co_tipo_ubicacion)
			WHERE 
			u.co_ubicacion_padre = u.co_ubicacion_padre AND
			u.co_ubicacion_padre= '".$ubic."')";
			}
	/*if ($sort != "") {
		$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;*/
	//echo $query;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivo  
  
  
  
  
}
?>