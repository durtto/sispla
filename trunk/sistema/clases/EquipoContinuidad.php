<?php
require_once 'MyPDO.php';
require_once 'Persona.php';
/**
 * Se definen los datos de los clientes o puntos focales de los procesos criticos del negocio.
 * @access public
 * @package Planes
 */
class EquipoContinuidad extends MyPDO
{

/**
   * 
   * @access public
   */
  public $columEquipoContinuidad= array('co_equipo_continuidad'=>'co_equipo_continuidad', 'co_indicador'=>'co_indicador', 'co_rol_resp'=>'co_rol_resp');
  
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
  public function contarEquipoContinuidad() {
	$contar = "SELECT count(e.co_equipo_continuidad)
	FROM 
		 tr061_equipo_continuidad e 
		 INNER JOIN tr002_rol_responsabilidad r ON (e.co_rol_resp = r.co_rol_resp)
		 LEFT JOIN tr010_persona p ON (e.co_indicador = p.co_indicador)";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
  public function insertarEquipoContinuidad($equipocont) {
  	
	$this->pdo->beginTransaction();	

	$equipocont = array_intersect_key($equipocont, $this->columEquipoContinuidad);
	
	$r1 = $this->pdo->_insert('tr061_equipo_continuidad', $equipocont);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarEquipoContinuidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarEquipoContinuidad($equipocont, $condiciones) {
  	$this->pdo->beginTransaction();	

	$equipocont = array_intersect_key($equipocont, $this->columEquipoContinuidad);
	
	$r1 = $this->pdo->_update('tr061_equipo_continuidad', $equipocont, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarEquipoContinuidad

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarEquipoContinuidad($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr061_equipo_continuidad', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
			
  } // end of member function eliminarEquipoContinuidad

  
    public function cargarEquipoContinuidad($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
		  e.co_equipo_continuidad,
		  p.co_indicador,
		  p.nu_cedula,
		  p.nb_persona, 
		  p.tx_apellido, 
		  r.co_rol_resp,
		  r.nb_rol_resp 
		 FROM 
		 tr061_equipo_continuidad e 
		 INNER JOIN tr010_persona p ON (e.co_indicador = p.co_indicador)
		 LEFT JOIN tr002_rol_responsabilidad r ON (e.co_rol_resp = r.co_rol_resp)";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarEquipoContinuidad
}
?>