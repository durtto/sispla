<?php
require_once 'MyPDO.php';
require_once 'Departamento.php';
require_once 'RolDePersona';
require_once 'RolResponsabilidad';
require_once 'Grupo';
require_once 'Guardia';

/**
 * Define la informaci�n de las personas.
 * @access public
 * @package Planes
 */
class Persona extends MyPDO
{
	/**
	 * @AttributeType string
	 * Clave principal de la persona.
	 */
	private $_co_indicador;
	/**
	 * @AttributeType int
	 * Numero de cedula de la persona.
	 */
	private $_nu_cedula;
	/**
	 * @AttributeType string
	 * Nombre de la persona.
	 */
	private $_nb_persona;
	/**
	 * @AttributeType string
	 * Apellido de la persona.
	 */
	private $_tx_apellido;
	/**
	 * @AttributeType string
	 * Direcci�n de la oficina donde labora la persona.
	 */
	private $_di_oficina;
	/**
	 * @AttributeType int
	 * Numero de telefono de la persona.
	 */
	private $_tx_telefono_oficina;
	/**
	 * @AttributeType string
	 * Direccion de correo electronico de la persona.
	 */
	private $_tx_correo_electronico;
	/**
	 * @AttributeType string
	 * Direcci�n del lugar de habitaci�n de la persona.
	 */
	private $_di_habitacion;
	/**
	 * @AttributeType int
	 * Tel�fono del lugar de habitaci�n de la persona.
	 */
	private $_tx_telefono_habitacion;
	/**
	 * @AssociationType Planes.Departamento
	 * @AssociationMultiplicity 1
	 */
	public $_ocupa;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 0..*
	 */
	public $_es_responsable = array();
	/**
	 * @AssociationType Planes.RolDepersona
	 * @AssociationMultiplicity 1
	 */
	public $_cumple;
		/**
	 * @AssociationType Planes.RolResponsabilidad
	 * @AssociationMultiplicity 1
	 */
	public $_sigue;
	/**
	 * @AssociationType Planes.Usuario
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_Usuario_;
	/**
	 * @AssociationType Planes.PlanLocalizacion
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_PlanLocalizacion_;
	/**
	 * @AssociationType Planes.EquipoRequerido
	 * @AssociationMultiplicity 1
	 */
	public $_unnamed_EquipoRequerido_;
		/**
	 * @AssociationType Planes.Grupo
	 * @AssociationMultiplicity 1
	 */
	public $_compone;
	/**
	 * @AssociationType Planes.Guardia
	 * @AssociationMultiplicity 1
	 */
	public $_integran;

/**
   * 
   * @access public
   */
  public $columPersona= array('co_indicador'=>'co_indicador', 'nu_cedula'=>'nu_cedula', 'nb_persona'=>'nb_persona', 'tx_apellido'=>'tx_apellido', 'di_oficina'=>'di_oficina', 'tx_telefono_oficina'=>'tx_telefono_oficina', 'tx_correo_electronico'=>'tx_correo_electronico', 'di_habitacion'=>'di_habitacion', 'tx_telefono_habitacion'=>'tx_telefono_habitacion', 'co_rol'=>'co_rol', 'co_guardia'=>'co_guardia');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarPersona($persona) {
  	
	$this->pdo->beginTransaction();	

	$persona = array_intersect_key($persona, $this->columPersona);
	
	$r1 = $this->pdo->_insert('tr0010_persona', $persona);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarPersona

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarPersona($persona, $condiciones) {
  	$this->pdo->beginTransaction();	

	$persona = array_intersect_key($persona, $this->columPersona);
	
	$r1 = $this->pdo->_update('tr0010_persona', $persona, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarPersona

  /**
   *
   * @return string
   * @access public
   */
  public function eliminarPersona($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr0010_persona', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarPersona

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarPersona() {

	$query = "SELECT *
				FROM tr0010_persona;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarPersona
}
?>