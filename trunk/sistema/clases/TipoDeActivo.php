<?php
require_once 'MyPDO.php';
require_once 'Categoria.php';
require_once 'Servicio.php';


/**
 * Se definen los distintos tipos de activos considerados en la plataforma de AIT.
 * @access public
 * @package Planes
 */
class TpActivo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del tipo de activo.
	 */
	private $_co_tipo_activo;
	/**
	 * @AttributeType string
	 * Nombre del tipo de activo.
	 */
	private $_nb_tipo_activo;
	/**
	 * @AssociationType Planes.Categoria
	 */
	public $_unnamed_Categoria_;
	/**
	 * @AssociationType Planes.Crecimiento
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_Crecimiento_;
	/**
	 * @AssociationType Planes.Servicio
	 * @AssociationMultiplicity 1..*
	 */
	public $_presta = array();
	/**
	 * @AssociationType Planes.Modelo
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 */
	public $_se_Clasifica = array();

	/**
   * 
   * @access public
   */
  public $columTpActivo= array('co_tipo_activo'=>'co_tipo_activo', 'nb_tipo_activo'=>'nb_tipo_activo', 'co_categoria'=>'co_categoria', 'co_servicio'=>'co_servicio');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarTpActivo($tpactivo) {
  	
	$this->pdo->beginTransaction();	

	$tpactivo = array_intersect_key($tpactivo, $this->columTpActivo);
	
	$r1 = $this->pdo->_insert('tr014_tipo_activo', $tpactivo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarTpActivo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarTpActivo($tpactivo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$tpactivo = array_intersect_key($tpactivo, $this->columTpActivo);
	
	$r1 = $this->pdo->_update('tr014_tipo_activo', $tpactivo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarTpActivo

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarTpActivo($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr014_tipo_activo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarTpActivo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarTpActivo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  					tr014_tipo_activo.co_tipo_activo, 
  					tr014_tipo_activo.nb_tipo_activo, 
  					tr014_tipo_activo.co_categoria,
  					tr011_categoria.nb_categoria, 
  					tr014_tipo_activo.co_servicio,
  					tr013_servicio.nb_servicio
			FROM 
  					public.tr014_tipo_activo, 
  					public.tr013_servicio, 
  					public.tr011_categoria
			WHERE 
  					tr014_tipo_activo.co_categoria = tr011_categoria.co_categoria AND
  					tr014_tipo_activo.co_servicio = tr013_servicio.co_servicio";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarTpActivo
}
?>