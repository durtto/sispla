<?php
require_once 'MyPDO.php';

/**
 * Se definen las distintas categor�as o disciplinas que eval�a la gerencia de AIT.
 * @access public
 * @package Planes
 */
class Categoria extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal de la categor�a.
	 */
	private $_co_categoria;
	/**
	 * @AttributeType string
	 * Nombre de la categor�a.
	 */
	private $_nb_categoria;
	/**
	 * @AssociationType Planes.TipoDeActivo
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 */
	public $_esta_formada = array();

/**
   * 
   * @access public
   */
  public $columCategoria= array('co_categoria'=>'co_categoria', 'nb_categoria'=>'nb_categoria');
  
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
  
  public function contarCategoria() {
	$contar = "SELECT count(tr011_categoria.co_categoria)
	FROM tr011_categoria";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoCategoria() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_categoria FROM tr011_categoria
		ORDER BY co_categoria DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarCategoria($categoria) {
  	
	$this->pdo->beginTransaction();	

	$categoria = array_intersect_key($categoria, $this->columCategoria);
	
	$r1 = $this->pdo->_insert('tr011_categoria', $categoria);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarCategoria

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarCategoria($categoria, $condiciones) {
  	$this->pdo->beginTransaction();	

	$categoria = array_intersect_key($categoria, $this->columCategoria);
	
	$r1 = $this->pdo->_update('tr011_categoria', $categoria, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarCategoria

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarCategoria($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr011_categoria', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarCategoria
  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarCategoria($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr011_categoria";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCategoria
}
?>