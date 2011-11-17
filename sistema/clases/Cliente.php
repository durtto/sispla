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
  public $columCliente= array('co_cliente'=>'co_cliente', 'co_indicador'=>'co_indicador', 'co_proceso'=>'co_proceso');
  
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
  public function contarCliente() {
	$contar = "SELECT count(tr052_cliente.co_cliente)
	FROM tr052_cliente";
	
	$c = $this->pdo->_query($contar);
	
	if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
		$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  }
  
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
  *
FROM 
  public.tr052_cliente;
";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCliente
  
  
    public function cargarClienteProceso($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
		  tr010_persona.nb_persona, 
		  tr010_persona.tx_apellido, 
		  tr010_persona.di_oficina, 
		  tr010_persona.tx_telefono_oficina, 
		  tr016_proceso.nb_proceso, 
		  tr016_proceso.tx_descripcion, 
		  tr016_proceso.bo_critico
			FROM 
		  public.tr052_cliente, 
		  public.tr016_proceso, 
		  public.tr010_persona
			WHERE 
		  tr052_cliente.co_indicador = tr010_persona.co_indicador AND
		  tr052_cliente.co_proceso = tr016_proceso.co_proceso";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarCliente
}
?>