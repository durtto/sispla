<?php
require_once 'MyPDO.php';
require_once 'TipoDeActivo.php';
require_once 'Persona.php';
require_once 'Equipo.php';
/**
 * Definicion del equipo requerido por el personal para realizar el mantenimiento de un activo.
 * @access public
 * @package Planes
 */
class EquipoRequerido extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria de los datos del equipo requerido.
	 */
	private $_co_equipo_requerido;

	public $_unnamed_Persona_;

/**
   * 
   * @access public
   */
  public $columEquipoRequerido= array('co_equipo_requerido'=>'co_equipo_requerido','bo_principal'=>'bo_principal');
  public $columEquipoRequeridoPersona= array('co_equipo_requerido'=>'co_equipo_requerido','co_indicador'=>'co_indicador');
  public $columEquipoRequeridoTpActivo= array('co_equipo_requerido'=>'co_equipo_requerido','co_tipo_activo'=>'co_tipo_activo');
  public $columEquipoRequeridoEquipo= array('co_equipo_requerido'=>'co_equipo_requerido','co_equipo'=>'co_equipo');
  public $columEquipoRequeridoEquipoPersona= array('co_equipo'=>'co_equipo','co_indicador'=>'co_indicador');
  
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
  public function insertarEquipoRequerido($equiporequerido, $personas, $tpactivos, $equipos, $necesarios) {
  	
	$this->pdo->beginTransaction();	

	$equiporequerido = array_intersect_key($equiporequerido, $this->columEquipoRequerido);
	
	$r1 = $this->pdo->_insert('tr033_equipo_requerido', $equiporequerido);

	$personas = array_intersect_key($personas, $this->columEquipoRequeridoPersona);
	//print_r($vehiculo);
	$r2 = $this->pdo->_insert('tr056_rel_equipo_requerido_persona', $personas); 

	if(isset($tpactivos) && count($tpactivos)>0){
	foreach($tpactivos as $tpactivo){		
			if(is_array($tpactivo)){
				$tpactivo = array_intersect_key($tpactivo, $this->columEquipoRequeridoTpActivo);
				//print_r($vehiculo);
				$r3 = $this->pdo->_insert('tr057_rel_equipo_requerido_tipo_activo', $tpactivo); 
				}
			}
    	}


	if(isset($equipos) && count($equipos)>0){
	foreach($equipos as $equipo){		
			if(is_array($equipo)){
				$equipo = array_intersect_key($equipo, $this->columEquipoRequeridoEquipo);
				//print_r($vehiculo);
				$r4 = $this->pdo->_insert('tr058_rel_equipo_requerido_equipo', $equipo); 
				}
			}
    	}

	if(isset($necesarios) && count($necesarios)>0){
	foreach($necesarios as $necesario){		
			if(is_array($necesario)){
				$necesario = array_intersect_key($necesario, $this->columEquipoRequeridoEquipoPersona);
				//print_r($vehiculo);
				$r5 = $this->pdo->_insert('tr059_rel_equipo_requerido_equipo_persona', $necesario); 
				}
			}
    	}

	if($r1==1 && $r2==1 && $r3==1 && $r4==1 && $r5==1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	"-2= ".$r2; "-3= ".$r3;  "-4= ".$r4;  "-5= ".$r5;}
  
  } // end of member function insertarEquipoRequerido

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarEquipoRequerido($equiporequerido, $condiciones) {
  	$this->pdo->beginTransaction();	

	$equiporequerido = array_intersect_key($equiporequerido, $this->columEquipoRequerido);
	
	$r1 = $this->pdo->_update('tr033_equipo_requerido', $equiporequerido, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarEquipoRequerido

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarEquipoRequerido($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr033_equipo_requerido', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarEquipoRequerido

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarEquipoRequerido($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
	tr033_equipo_requerido.co_equipo_requerido,
  CASE
   WHEN tr033_equipo_requerido.bo_principal = true
   THEN 'SI'
   ELSE 'NO'
   END AS bo_principal 
  FROM 
  public.tr033_equipo_requerido";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarEquipoRequerido
}
?>