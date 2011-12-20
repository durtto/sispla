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
	$contar = "SELECT count(co_cliente)
	FROM 
		 tr052_cliente c 
		 INNER JOIN tr016_proceso pr ON (c.co_proceso = pr.co_proceso)
		 LEFT JOIN tr010_persona p ON (c.co_indicador = p.co_indicador)";
	
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

  
    public function cargarCliente($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT 
		  p.nb_persona, 
		  p.tx_apellido, 
		  p.di_oficina, 
		  c.co_proceso,
		  p.tx_telefono_oficina, 
		  pr.nb_proceso, 
		  pr.tx_descripcion, 
		  pr.bo_critico
			FROM 
		 tr052_cliente c 
		 INNER JOIN tr016_proceso pr ON (c.co_proceso = pr.co_proceso)
		 LEFT JOIN tr010_persona p ON (c.co_indicador = p.co_indicador)";
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