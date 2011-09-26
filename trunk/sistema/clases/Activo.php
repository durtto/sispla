<?php
require_once 'MyPDO.php';
require_once 'Estado.php';
require_once 'Fabricante.php';
require_once 'Persona.php';
require_once 'Ubicacion.php';
require_once 'Proceso.php';
require_once 'Proveedor.php';
require_once 'TipoDeActivo.php';
require_once 'UnidadDeDemanda.php';
require_once 'NivelObsolescencia.php';

/**
 * Se refiere a todos los equipos, aplicaciones y servicios con los que cuenta la Plataforma tecnol�gica
 * @access public
 * @package Planes
 */
class Activo extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave Primaria de la clase para identificaci�n.
	 */
	private $_co_activo;
	/**
	 * @AttributeType string
	 * Nombre especifico del activo.
	 */
	private $_nb_activo;
	/**
	 * @AttributeType string
	 * Descripci�n especifica del activo.
	 */
	private $_tx_descripcion;
	/**
	 * @AttributeType int
	 * C�digo de identificaci�n �nico tomado desde SAP.
	 */
	private $_co_sap;
	/**
	 * @AttributeType int
	 * C�digo de identificaci�n del serial.
	 */
	private $_nu_serial;
	/**
	 * @AttributeType int
	 * C�digo de identificaci�n del equipo contenido en la etiqueta.
	 */
	private $_nu_etiqueta;
	/**
	 * @AttributeType boolean
	 * Define si es o no critico el activo para las operaciones del Negocio.
	 */
	private $_bo_critico;
	/**
	 * @AttributeType boolean
	 * Define si es o no vulnerable el activo en la plataforma.
	 */
	private $_bo_vulnerable;
	/**
	 * @AttributeType float
	 * Fecha de incorporaci�n del activo a la plataforma.
	 */
	private $_fe_Incorporacion;
	/**
	 * @AttributeType float
	 * Tiempo de vida �til que tiene el activo. Especificado por proveedor.
	 */
	private $_nu_vida_util;
	/**
	 * @AssociationType Planes.Estado
	 * @AssociationMultiplicity 1
	 */
	public $_se_encuentra;
	/**
	 * @AssociationType Planes.Falla
	 * @AssociationMultiplicity 0..*
	 */
	public $_sufre = array();
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 */
	public $_es_parte_de = array();
	/**
	 * @AssociationType Planes.Activo
	 */
	public $_unnamed_Activo_;
	/**
	 * @AssociationType Planes.Ubicacion
	 * @AssociationMultiplicity 1
	 */
	public $_se_localiza;
	/**
	 * @AssociationType Planes.Fabricante
	 * @AssociationMultiplicity 1
	 */
	public $_es_fabricado;
	/**
	 * @AssociationType Planes.UnidadDeDemanda
	 * @AssociationMultiplicity 1..*
	 */
	public $_es_requerido = array();
	/**
	 * @AssociationType Planes.Documento
	 * @AssociationMultiplicity 0..*
	 */
	public $_posee = array();
	/**
	 * @AssociationType Planes.Garantia
	 * @AssociationMultiplicity 1
	 */
	public $_dispone;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 1
	 */
	public $_esta_asignado;
	/**
	 * @AssociationType Planes.ValorCaracteristica
	 * @AssociationMultiplicity 1..*
	 */
	public $_unnamed_ValorCaracteristica_ = array();
	/**
	 * @AssociationType Planes.Continuidad
	 * @AssociationMultiplicity 1
	 */
	public $_es_dependiente;
	/**
	 * @AssociationType Planes.Proceso
	 * @AssociationMultiplicity 1
	 */
	public $_forman_parte;

/**
   * 
   * @access public
   */
  public $columActivo= array('co_activo'=>'co_activo', 'nb_activo'=>'nb_activo', 'tx_descripcion'=>'tx_descripcion', 'co_sap'=>'co_sap', 'nu_serial'=>'nu_serial', 'nu_etiqueta'=>'nu_etiqueta', 'bo_critico'=>'bo_critico', 'bo_vulnerable'=>'bo_vulnerable', 'fe_incorporacion'=>'fe_incorporacion', 'nu_vida_util'=>'nu_vida_util', 'co_activo_padre'=>'co_activo_padre', 'co_estado'=>'co_estado', 'co_fabricante'=>'co_fabricante', 'co_indicador'=>'co_indicador', 'co_ubicacion'=>'co_ubicacion', 'co_proceso'=>'co_proceso', 'co_proveedor'=>'co_proveedor',  'co_tipo_activo'=>'co_activo', 'co_unidad'=>'co_unidad', 'co_nivel'=>'co_nivel');
  
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
  public function insertarActivo($activo) {
  	
	$this->pdo->beginTransaction();	

	$activo = array_intersect_key($activo, $this->columActivo);
	
	$r1 = $this->pdo->_insert('tr027_activo', $activo);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member a function insertarActivo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarActivo($activo, $condiciones) {
  	$this->pdo->beginTransaction();	

	$activo = array_intersect_key($activo, $this->columActivo);
	
	$r1 = $this->pdo->_update('tr027_activo', $activo, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarActivo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarActivo($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr027_activo', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarActivo

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarActivo( ) {

	$query = "SELECT 
  tr027_activo.co_activo, 
  tr027_activo.nb_activo, 
  tr027_activo.tx_descripcion, 
  tr027_activo.co_sap, 
  tr027_activo.nu_serial, 
  tr027_activo.nu_etiqueta, 
  tr027_activo.bo_critico, 
  tr027_activo.bo_vulnerable, 
  tr027_activo.fe_incorporacion, 
  tr027_activo.nu_vida_util, 
  tr027_activo.co_activo_padre, 
  tr004_estado.co_estado, 
  tr004_estado.nb_estado,
  tr003_fabricante.co_fabricante, 
  tr003_fabricante.nb_fabricante, 
  tr027_activo.co_indicador, 
  tr010_persona.nb_persona,
  tr006_ubicacion.co_ubicacion, 
  tr006_ubicacion.nb_ubicacion,
  tr016_proceso.co_proceso, 
  tr016_proceso.nb_proceso, 
  tr025_proveedor.co_proveedor,
  tr025_proveedor.nb_proveedor, 
  tr024_unidad_demanda.co_unidad,
  tr024_unidad_demanda.nb_unidad, 
  tr023_nivel_obsolescencia.co_nivel,
  tr023_nivel_obsolescencia.nb_nivel,
  CASE
  WHEN tr027_activo.bo_critico = true
  THEN 'SI'
  ELSE 'NO'
  END AS bo_critico,
  CASE
  WHEN tr027_activo.bo_vulnerable = true
  THEN 'SI'
  ELSE 'NO'
  END AS bo_vulnerable
FROM 
  public.tr006_ubicacion, 
  public.tr010_persona, 
  public.tr023_nivel_obsolescencia, 
  public.tr027_activo, 
  public.tr004_estado, 
  public.tr003_fabricante, 
  public.tr016_proceso, 
  public.tr025_proveedor, 
  public.tr024_unidad_demanda
WHERE 
  tr027_activo.co_estado = tr004_estado.co_estado AND
  tr027_activo.co_fabricante = tr003_fabricante.co_fabricante AND
  tr027_activo.co_indicador = tr010_persona.co_indicador AND
  tr027_activo.co_ubicacion = tr006_ubicacion.co_ubicacion AND
  tr027_activo.co_proceso = tr016_proceso.co_proceso AND
  tr027_activo.co_nivel = tr023_nivel_obsolescencia.co_nivel AND
  tr025_proveedor.co_proveedor = tr027_activo.co_proveedor AND
  tr024_unidad_demanda.co_unidad = tr027_activo.co_unidad;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivo
   
  public function cargarActivoCritico( ) {

	$query = "SELECT 
  tr027_activo.co_activo, 
  tr027_activo.nb_activo, 
  tr027_activo.tx_descripcion, 
  tr027_activo.co_sap, 
  tr027_activo.nu_serial, 
  tr027_activo.nu_etiqueta, 
  tr027_activo.bo_critico, 
  tr027_activo.bo_vulnerable, 
  tr027_activo.fe_incorporacion, 
  tr027_activo.nu_vida_util, 
  tr027_activo.co_activo_padre, 
  tr004_estado.co_estado, 
  tr004_estado.nb_estado,
  tr003_fabricante.co_fabricante, 
  tr003_fabricante.nb_fabricante, 
  tr027_activo.co_indicador, 
  tr010_persona.nb_persona,
  tr006_ubicacion.co_ubicacion, 
  tr006_ubicacion.nb_ubicacion,
  tr016_proceso.co_proceso, 
  tr016_proceso.nb_proceso, 
  tr025_proveedor.co_proveedor,
  tr025_proveedor.nb_proveedor, 
  tr024_unidad_demanda.co_unidad,
  tr024_unidad_demanda.nb_unidad, 
  tr023_nivel_obsolescencia.co_nivel,
  tr023_nivel_obsolescencia.nb_nivel,
  CASE
  WHEN tr027_activo.bo_critico = true
  THEN 'SI'
  ELSE 'NO'
  END AS bo_critico,
  CASE
  WHEN tr027_activo.bo_vulnerable = true
  THEN 'SI'
  ELSE 'NO'
  END AS bo_vulnerable
FROM 
  public.tr006_ubicacion, 
  public.tr010_persona, 
  public.tr023_nivel_obsolescencia, 
  public.tr027_activo, 
  public.tr004_estado, 
  public.tr003_fabricante, 
  public.tr016_proceso, 
  public.tr025_proveedor, 
  public.tr024_unidad_demanda
WHERE 
  tr027_activo.co_estado = tr004_estado.co_estado AND
  tr027_activo.co_fabricante = tr003_fabricante.co_fabricante AND
  tr027_activo.co_indicador = tr010_persona.co_indicador AND
  tr027_activo.co_ubicacion = tr006_ubicacion.co_ubicacion AND
  tr027_activo.co_proceso = tr016_proceso.co_proceso AND
  tr027_activo.co_nivel = tr023_nivel_obsolescencia.co_nivel AND
  tr025_proveedor.co_proveedor = tr027_activo.co_proveedor AND
  tr024_unidad_demanda.co_unidad = tr027_activo.co_unidad AND
  tr027_activo.bo_critico = true;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarActivoCritico
}
?>