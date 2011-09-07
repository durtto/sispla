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
  public $columModelo= array('co_modelo'=>'co_modelo', 'nb_modelo'=>'nb_modelo');
  
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
  public function cargarModelo( ) {

	$query = "SELECT *
                FROM tr029_modelo;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarModelo
}
?>