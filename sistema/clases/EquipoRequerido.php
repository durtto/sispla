<?php
require_once 'MyPDO.php';
require_once 'TipoDeActivo.php';
require_once 'Persona.php';
require_once 'Equipo.php';
/**
 * Definici�n del equipo requerido por el personal para realizar el mantenimiento de un activo.
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
  public $columEquipoRequerido= array('co_equipo_requerido'=>'co_equipo_requerido', 'co_tipo_activo'=>'co_tipo_activo', 'co_equipo'=>'co_equipo','co_indicador'=>'co_indicador');
  
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
  public function insertarEquipoRequerido($equiporequerido) {
  	
	$this->pdo->beginTransaction();	

	$equiporequerido = array_intersect_key($equiporequerido, $this->columEquipoRequerido);
	
	$r1 = $this->pdo->_insert('tr033_equipo_requerido', $equiporequerido);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
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
  tr014_tipo_activo.nb_tipo_activo, 
  tr010_persona.co_indicador, 
  tr010_persona.nu_cedula, 
  tr010_persona.nb_persona, 
  tr010_persona.tx_apellido, 
  tr010_persona.di_oficina, 
  tr010_persona.tx_telefono_oficina, 
  tr010_persona.tx_correo_electronico, 
  tr010_persona.di_habitacion, 
  tr010_persona.tx_telefono_habitacion, 
  tr010_persona.tx_telefono_personal, 
  tr007_departamento.nb_departamento, 
  tr008_rol_persona.nb_rol, 
  tr002_rol_responsabilidad.nb_rol_resp, 
  tr001_grupo.nb_grupo, 
  tr009_guardia.nb_guardia
FROM 
  public.tr033_equipo_requerido, 
  public.tr014_tipo_activo, 
  public.tr010_persona, 
  public.tr002_rol_responsabilidad, 
  public.tr001_grupo, 
  public.tr008_rol_persona, 
  public.tr009_guardia, 
  public.tr007_departamento
WHERE 
  tr014_tipo_activo.co_tipo_activo = tr033_equipo_requerido.co_tipo_activo AND
  tr010_persona.co_indicador = tr033_equipo_requerido.co_indicador AND
  tr010_persona.co_departamento = tr007_departamento.co_departamento AND
  tr010_persona.co_rol = tr008_rol_persona.co_rol AND
  tr010_persona.co_rol_resp = tr002_rol_responsabilidad.co_rol_resp AND
  tr010_persona.co_grupo = tr001_grupo.co_grupo AND
  tr010_persona.co_guardia = tr009_guardia.co_guardia";
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