<?php
require_once 'MyPDO.php';

/**
 * Define el modelo del activo.
 * @access public
 * @package Planes
 */
class Modelo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del modelo del activo.
	 */
	private $_co_modelo;
	/**
	 * @AttributeType string
	 * Nombre del modelo de activo.
	 */
	private $_nb_modelo;
	/**
	 * @AssociationType Planes.TipoDeActivo
	 */
	public $_unnamed_TipoDeActivo_;
	/**
	 * @AssociationType Planes.Caracteristica
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 */
	public $_se_define_por = array();
	/**
	 * @AssociationType Planes.Proveedor
	 * @AssociationMultiplicity 1
	 */
	public $_es_suministrado;

/**
   * 
   * @access public
   */
  public $columModelo= array('co_modelo'=>'co_modelo', 'nb_modelo'=>'nb_modelo', 'co_tipo_activo'=>'co_tipo_activo');
  
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
  public function contarModelo() {
	$contar = "SELECT count(tr029_modelo.co_modelo)
	FROM tr029_modelo";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoModelo() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_modelo FROM tr029_modelo
		ORDER BY co_modelo DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarModelo($modelo) {
  	
	$this->pdo->beginTransaction();	

	$modelo = array_intersect_key($modelo, $this->columModelo);
	
	$r1 = $this->pdo->_insert('tr029_modelo', $modelo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarModelo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarModelo($modelo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$modelo = array_intersect_key($modelo, $this->columModelo);
	
	$r1 = $this->pdo->_update('tr029_modelo', $modelo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarModelo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarModelo($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr029_modelo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarModelo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarModelo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  tr029_modelo.co_modelo, 
  tr029_modelo.nb_modelo, 
  tr014_tipo_activo.nb_tipo_activo, 
  tr029_modelo.co_tipo_activo
FROM 
  tr029_modelo
  LEFT JOIN  tr014_tipo_activo ON (tr029_modelo.co_tipo_activo = tr014_tipo_activo.co_tipo_activo)";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarModelo
}
?>