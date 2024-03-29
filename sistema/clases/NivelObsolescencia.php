<?php
require_once 'MyPDO.php';


/**
 * Define la informaci�n acerca de los distintos niveles de obsolescencia.
 * @access public
 * @package Planes
 */
class NivelObsolescencia extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave principal del tipo de obsolescencia.
	 */
	private $_co_nivel;
	/**
	 * @AttributeType string
	 * Nombre del nivel de obsolescencia.
	 */
	private $_nb_nivel;
	/**
	 * @AttributeType string
	 * Se define el nivel de obsolescencia.
	 */
	private $_tx_descripcion;
	/**
	 * @AttributeType boolean
	 * Define si el nivel sigue us�ndose para realizar el analisis.
	 */
	private $_bo_obsoleto;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1
	 */
	public $_se_establece;

	/**
   * 
   * @access public
   */
  public $columNivelObsolescencia= array('co_nivel'=>'co_nivel', 'nb_nivel'=>'nb_nivel', 'tx_descripcion'=>'tx_descripcion', 'bo_obsoleto'=>'bo_obsoleto');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarNivelObsolescencia() {
	$contar = "SELECT count(tr023_nivel_obsolescencia.co_nivel)
	FROM tr023_nivel_obsolescencia";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
   public function NuevoNivelObsolescencia() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_nivel FROM tr023_nivel_obsolescencia
		ORDER BY co_nivel DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarNivelObsolescencia($nivelobsolescencia) {
  	
	$this->pdo->beginTransaction();	

	$nivelobsolescencia = array_intersect_key($nivelobsolescencia, $this->columNivelObsolescencia);
	
	$r1 = $this->pdo->_insert('tr023_nivel_obsolescencia', $nivelobsolescencia);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarNivelObsolescencia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarNivelObsolescencia($nivelobsolescencia, $condiciones) {
  	$this->pdo->beginTransaction();	

	$nivelobsolescencia = array_intersect_key($nivelobsolescencia, $this->columNivelObsolescencia);
	
	$r1 = $this->pdo->_update('tr023_nivel_obsolescencia', $nivelobsolescencia, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarNivelObsolescencia

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarNivelObsolescencia($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr023_nivel_obsolescencia', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarNivelObsolescencia

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarNivelObsolescencia($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  tr023_nivel_obsolescencia.co_nivel, 
  tr023_nivel_obsolescencia.nb_nivel, 
  tr023_nivel_obsolescencia.tx_descripcion, 
CASE
   WHEN tr023_nivel_obsolescencia.bo_obsoleto = true
   THEN 'SI'
   ELSE 'NO'
   END AS bo_obsoleto
FROM 
  public.tr023_nivel_obsolescencia";
if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarNivelObsolescencia
}
?>