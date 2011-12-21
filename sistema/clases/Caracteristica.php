<?php
require_once 'MyPDO.php';
require_once 'Modelo.php';

/**
 * Define las distintas caracter�sticas que posee un activo.
 * @access public
 * @package Planes
 */
class Caracteristica extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal de la caracter�stica.
	 */
	private $_co_caracteristica;
	/**
	 * @AttributeType string
	 * Nombre de la caracteristica.
	 */
	private $_nb_caracteristica;
	/**
	 * @AssociationType Planes.Modelo
	 */
	public $_unnamed_Modelo_;
	/**
	 * @AssociationType Planes.ValorCaracteristica
	 * @AssociationMultiplicity 1..*
	 */
	public $_unnamed_ValorCaracteristica_ = array();

/**
   * 
   * @access public
   */
  public $columCaracteristica= array('co_caracteristica'=>'co_caracteristica', 'nb_caracteristica'=>'nb_caracteristica', 'co_modelo'=>'co_modelo');
  
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
   public function contarCaracteristica() {
	$contar = "SELECT count(tr030_caracteristica.co_caracteristica)
	FROM tr030_caracteristica";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
    public function NuevoCaracteristica() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_caracteristica FROM tr030_caracteristica
		ORDER BY co_caracteristica DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarCaracteristica($caracteristica) {
  	
	$this->pdo->beginTransaction();	

	$caracteristica = array_intersect_key($caracteristica, $this->columCaracteristica);
	
	$r1 = $this->pdo->_insert('tr030_caracteristica', $caracteristica);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarCaracteristica

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarCaracteristica($caracteristica, $condiciones) {
  	$this->pdo->beginTransaction();	

	$caracteristica = array_intersect_key($caracteristica, $this->columCaracteristica);
	
	$r1 = $this->pdo->_update('tr030_caracteristica', $caracteristica, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarCaracteristica

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarCaracteristica($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr030_caracteristica', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarCaracteristica
  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarCaracteristica($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  tr030_caracteristica.co_caracteristica, 
  tr030_caracteristica.nb_caracteristica, 
  tr029_modelo.co_modelo,
  tr029_modelo.nb_modelo
FROM 
  public.tr030_caracteristica, 
  public.tr029_modelo
WHERE 
  tr030_caracteristica.co_modelo = tr029_modelo.co_modelo";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCaracteristica
}
?>