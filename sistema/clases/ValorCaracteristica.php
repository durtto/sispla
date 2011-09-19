<?php
require_once 'MyPDO.php';
require_once 'Activo.php';
require_once 'Caracteristica.php';

/**
 * Define el valor de la caracter�stica que posee el activo.
 * @access public
 * @package Planes
 */
class Valor extends MyPDO
{
	/**
	 * @AttributeType int
	 * Valor real de la caracter�stica del activo.
	 */
	private $_nu_valor;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 1..*
	 */
	public $_unnamed_Activo_;
	/**
	 * @AssociationType Planes.Caracteristica
	 * @AssociationMultiplicity 1..*
	 */
	public $_unnamed_Caracteristica_;

	/**
   * 
   * @access public
   */
  public $columValor= array('co_activo'=>'co_activo', 'co_caracteristica'=>'co_caracteristica', 'nu_valor'=>'nu_valor');

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function insertarValor($valor) {
  	
	$this->pdo->beginTransaction();	

	$valor = array_intersect_key($valor, $this->columValor);
	
	$r1 = $this->pdo->_insert('tr031_valor_caracteristica', $valor);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarValor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarValor($valor, $condiciones) {
  	$this->pdo->beginTransaction();	

	$valor = array_intersect_key($valor, $this->columValor);
	
	$r1 = $this->pdo->_update('tr031_valor_caracteristica', $valor, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarValor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarValor($condiciones) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr031_valor_caracteristica', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarValor

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarValor() {

	$query = "SELECT 
  tr031_valor_caracteristica.co_activo, 
  tr027_activo.nb_activo, 
  tr031_valor_caracteristica.co_caracteristica, 
  tr030_caracteristica.nb_caracteristica, 
  tr031_valor_caracteristica.nu_valor
FROM 
  public.tr027_activo, 
  public.tr031_valor_caracteristica, 
  public.tr030_caracteristica
WHERE 
  tr031_valor_caracteristica.co_activo = tr027_activo.co_activo AND
  tr031_valor_caracteristica.co_caracteristica = tr030_caracteristica.co_caracteristica;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarValor
}
?>