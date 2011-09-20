<?php
require_once 'MyPDO.php';

/**
 * Se definen los diferentes componentes desarrollados.
 * @access public
 * @package Planes
 */
class DocComponente extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del Componente.
	 */
	private $_co_doc_componente;
	/**
	 * @AttributeType string
	 * Servidor o direcci�n en la cual esta ubicada el documento.
	 */
	private $_tx_url_direccion;
/**
   * 
   * @access public
   */
  public $columDocComponente= array('co_doc_componente'=>'co_doc_componente', 'tx_url_direccion'=>'tx_url_direccion');
  
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
  public function insertarDocComponente($docComponente) {
  	
	$this->pdo->beginTransaction();	

	$docComponente = array_intersect_key($docComponente, $this->columDocComponente);
	
	$r1 = $this->pdo->_insert('tr053_documento_componente', $docComponente);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarDocComponente

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarDocComponente($docComponente, $condiciones) {
  	$this->pdo->beginTransaction();	

	$docComponente = array_intersect_key($docComponente, $this->columDocComponente);
	
	$r1 = $this->pdo->_update('tr053_documento_componente', $docComponente, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarDocComponente

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarDocComponente($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr053_documento_componente', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarDocComponente

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarDocComponente( ) {

	$query = "SELECT 
  					tr053_documento_componente.co_doc_componente, 
  					tr053_documento_componente.tx_url_direccion
				FROM 
  					public.tr053_documento_componente;";

	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarDocComponente
}
?>