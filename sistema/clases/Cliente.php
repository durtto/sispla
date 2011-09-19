<?php
require_once 'MyPDO.php';
require_once 'Persona.php';
require_once 'Activo.php';
/**
 * Se definen los datos de los clientes o puntos focales de los procesos criticos del negocio.
 * @access public
 * @package Planes
 */
class Cliente extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del cliente.
	 */
	private $_co_cliente;
	/**
	 * @AssociationType Planes.Persona
	 * @AssociationMultiplicity 0..*
	 */
	private $_posee;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 0..*
	 */
	private $_custodia;

/**
   * 
   * @access public
   */
  public $columCliente= array('co_cliente'=>'co_cliente', 'co_indicador'=>'co_indicador', 'co_activo'=>'co_activo');
  
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
  public function insertarCliente($cliente) {
  	
	$this->pdo->beginTransaction();	

	$cliente = array_intersect_key($cliente, $this->columCliente);
	
	$r1 = $this->pdo->_insert('tr052_cliente', $cliente);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarCliente

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarCliente($cliente, $condiciones) {
  	$this->pdo->beginTransaction();	

	$cliente = array_intersect_key($cliente, $this->columCliente);
	
	$r1 = $this->pdo->_update('tr052_cliente', $cliente, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarCliente

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarCliente($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr052_cliente', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
			
  } // end of member function eliminarCliente

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarCliente( ) {

	$query = "SELECT 
  tr052_cliente.co_cliente, 
  tr052_cliente.co_indicador, 
  tr052_cliente.co_activo, 
  tr027_activo.nb_activo, 
  tr010_persona.nb_persona
FROM 
  public.tr010_persona, 
  public.tr027_activo, 
  public.tr052_cliente
WHERE 
  tr052_cliente.co_indicador = tr010_persona.co_indicador AND
  tr052_cliente.co_activo = tr027_activo.co_activo;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCliente
}
?>