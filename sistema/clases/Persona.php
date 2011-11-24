<?php
require_once 'MyPDO.php';
require_once 'Departamento.php';
require_once 'RolPersona.php';
require_once 'RolResponsabilidad.php';
require_once 'Grupo.php';
require_once 'Guardia.php';




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
	 * @AttributeType int
	 * Tel�fono del lugar de habitaci�n de la persona.
	 */
	private $_tx_telefono_persona;
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
	 * @AssociationMultiplicityp 1
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
  public $columPersona= array('co_indicador'=>'co_indicador', 'nu_cedula'=>'nu_cedula', 'nb_persona'=>'nb_persona', 'tx_apellido'=>'tx_apellido', 'di_oficina'=>'di_oficina', 'tx_telefono_oficina'=>'tx_telefono_oficina', 'tx_correo_electronico'=>'tx_correo_electronico', 'di_habitacion'=>'di_habitacion', 'tx_telefono_habitacion'=>'tx_telefono_habitacion', 'tx_telefono_personal'=>'tx_telefono_personal', 'co_departamento'=>'co_departamento', 'co_rol'=>'co_rol', 'co_rol_resp'=>'co_rol_resp', 'co_grupo'=>'co_grupo','co_guardia'=>'co_guardia');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function contarPersona() {
	$contar = "SELECT count(tr010_persona.co_indicador)
	FROM tr010_persona";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  public function insertarPersona($persona) {
  	
	$this->pdo->beginTransaction();	

	$persona = array_intersect_key($persona, $this->columPersona);
	
	$r1 = $this->pdo->_insert('tr010_persona', $persona);
	
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
	
	$r1 = $this->pdo->_update('tr010_persona', $persona, $condiciones);
	
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


	$r1 = $this->pdo->_delete('tr010_persona', $condiciones);
	
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
  public function cargarPersona($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
			  p.co_indicador, 
			  p.nu_cedula, 
			  p.nb_persona, 
			  p.tx_apellido, 
			  p.di_oficina, 
			  p.tx_telefono_oficina, 
			  p.tx_correo_electronico, 
			  p.di_habitacion, 
			  p.tx_telefono_habitacion, 
			  p.tx_telefono_personal,
			  d.co_departamento,
			  d.nb_departamento,
			  rp.co_rol, 
			  rp.nb_rol, 
			  r.co_rol_resp,
			  r.nb_rol_resp,
			  g.co_grupo, 
			  g.nb_grupo, 
			  gu.co_guardia,
			  gu.nb_guardia
			  FROM 
			  tr010_persona p 
			  INNER JOIN tr002_rol_responsabilidad r ON (p.co_rol_resp = r.co_rol_resp) 
			  INNER JOIN tr001_grupo g ON (p.co_grupo = g.co_grupo) 
			  INNER JOIN tr008_rol_persona rp ON (p.co_rol = rp.co_rol) 
			  INNER JOIN tr009_guardia gu ON (p.co_guardia = gu.co_guardia) 
			  INNER JOIN tr007_departamento d ON (p.co_departamento = d.co_departamento)";
	if ($sort != "") {
		$query .= " ORDER BY ".$sort." ".$dir;
		}
		$query .= "	LIMIT ".$limit."
					OFFSET ".$start;
		$r = $this->pdo->_query($query);
	return $r;
  } // end of member function cargarPersona
}
?>
