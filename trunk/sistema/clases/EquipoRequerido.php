<?php
require_once 'MyPDO.php';
require_once 'Activo.php';
require_once 'Persona.php';

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
	/**
	 * @AttributeType boolean
	 * Se define si necesita o no que la empresa le suministre un veh�culo.
	 */
	private $_bo_vehiculo;
	/**
	 * @AttributeType boolean
	 * Define si necesita del uso de una laptop para realizar el mantenimiento.
	 */
	private $_bo_laptop;
	/**
	 * @AttributeType boolean
	 * Se define si necesita de un malet�n de herramientas para las actividades que realizaran.
	 */
	private $_bo_maletin_herramientas;
	/**
	 * @AttributeType boolean
	 * Se define si necesita de un radio.
	 */
	private $_bo_radio;
	/**
	 * @AttributeType boolean
	 * Se define si necesita o no de un multimetro digital.
	 */
	private $_bo_mutimetro_digital;
	/**
	 * Se define si la persona necesita o no de un Hart.
	 */
	private $_bo_hart;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 0..1
	 */
	public $_unnamed_Persona_;

/**
   * 
   * @access public
   */
  public $columEquipoRequerido= array('co_equipo_requerido'=>'co_equipo_requerido', 'bo_vehiculo'=>'bo_vehiculo', 'bo_laptop'=>'bo_laptop', 'bo_maletin_herramientas'=>'bo_maletin_herramientas', 'bo_radio'=>'bo_radio', 'bo_multimetro_digital'=>'bo_multimetro_digital', 'bo_hart'=>'bo_hart', 'co_activo'=>'co_activo', 'co_indicador'=>'co_indicador');
  
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
  public function cargarEquipoRequerido( ) {

	$query = "SELECT 
  tr033_equipo_requerido.co_equipo_requerido, 
  tr027_activo.nb_activo, 
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
  tr009_guardia.nb_guardia,
CASE
    WHEN tr033_equipo_requerido.bo_vehiculo = true
    THEN 'SI'
    ELSE 'NO'
    END AS bo_vehiculo,
CASE
    WHEN   tr033_equipo_requerido.bo_laptop = true
    THEN 'SI'
    ELSE 'NO'
    END AS bo_laptop,
CASE
    WHEN   tr033_equipo_requerido.bo_maletin_herramientas = true
    THEN 'SI'
    ELSE 'NO'
    END AS bo_maletin_herramientas,
CASE
    WHEN   tr033_equipo_requerido.bo_radio = true
    THEN 'SI'
    ELSE 'NO'
    END AS bo_radio,
CASE
    WHEN   tr033_equipo_requerido.bo_multimetro_digital = true
    THEN 'SI'
    ELSE 'NO'
    END AS bo_multimetro_digital,
CASE
    WHEN   tr033_equipo_requerido.bo_hart = true
    THEN 'SI'
    ELSE 'NO'
    END AS bo_hart          
FROM 
  public.tr033_equipo_requerido, 
  public.tr027_activo, 
  public.tr010_persona, 
  public.tr002_rol_responsabilidad, 
  public.tr001_grupo, 
  public.tr008_rol_persona, 
  public.tr009_guardia, 
  public.tr007_departamento
WHERE 
  tr027_activo.co_activo = tr033_equipo_requerido.co_activo AND
  tr010_persona.co_indicador = tr033_equipo_requerido.co_indicador AND
  tr010_persona.co_departamento = tr007_departamento.co_departamento AND
  tr010_persona.co_rol = tr008_rol_persona.co_rol AND
  tr010_persona.co_rol_resp = tr002_rol_responsabilidad.co_rol_resp AND
  tr010_persona.co_grupo = tr001_grupo.co_grupo AND
  tr010_persona.co_guardia = tr009_guardia.co_guardia;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarEquipoRequerido
}
?>