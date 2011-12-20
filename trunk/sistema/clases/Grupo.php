<?php
require_once 'MyPDO.php';
require_once 'Ubicacion.php';

/**
 * Define la informaci�n del grupo para las guardias.
 * @access public
 * @package Planes
 */
class Grupo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del grupo
	 */
	private $_co_grupo;
	/**
	 * @AttributeType string
	 * Nombre del grupo.
	 */
	private $_nb_grupo;
	/**
	 * @AttributeType string
	 * Periodo en el que dispone del grupo.
	 */
	private $_nu_periodo;
	/**
	 * @AttributeType string
	 *  Ubicacion del grupo.
	 */
	private $_co_ubicacion;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 1..*
	 */
	public $_esta_formada = array();

/**
   * 
   * @access public
   */
  public $columGrupo= array('co_grupo'=>'co_grupo', 'nb_grupo'=>'nb_grupo', 'nu_periodo'=>'nu_periodo', 'co_ubicacion'=>'co_ubicacion');
  
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
  public function contarGrupo() {
	$contar = "SELECT count(tr001_grupo.co_grupo)
	FROM tr001_grupo";
	
	$c = $this->pdo->_query($contar);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
   public function NuevoGrupo() {
	//$nuevo = "select nextval ('tr001_grupo_seq') AS nu_grupo;";
	$nuevo = "SELECT co_grupo FROM tr001_grupo
		ORDER BY co_grupo DESC 
		LIMIT 1;";
	$c = $this->pdo->_query($nuevo);
	
	//if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		//$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
  
  
  public function insertarGrupo($grupo) {
  	
	$this->pdo->beginTransaction();	

	$grupo = array_intersect_key($grupo, $this->columGrupo);
	
	$r1 = $this->pdo->_insert('tr001_grupo', $grupo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarGrupo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarGrupo($grupo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$grupo = array_intersect_key($grupo, $this->columGrupo);
	
	$r1 = $this->pdo->_update('tr001_grupo', $grupo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarGrupo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarGrupo($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr001_grupo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarGrupo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarGrupo($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
  					tr001_grupo.co_grupo, 
  					tr001_grupo.nb_grupo, 
  					tr001_grupo.nu_periodo, 
 					tr001_grupo.co_ubicacion, 
  					tr006_ubicacion.nb_ubicacion
				FROM 
  					tr001_grupo 
 				LEFT JOIN public.tr006_ubicacion ON (tr001_grupo.co_ubicacion = tr006_ubicacion.co_ubicacion)";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarGrupo
}
?>
