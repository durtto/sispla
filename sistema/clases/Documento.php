<?php
require_once 'MyPDO.php';

/**
 * Se definen los diferentes datos sobre los manuales y documentos que se tienen de los distintos activos.
 * @access public
 * @package Planes
 */
class Documento extends MyPDO
{
	/**
	 * @AttributeType int
	 * Clave primaria del documento.
	 */
	private $_co_documento;
	/**
	 * @AttributeType string
	 * Nombre del manual o documento.
	 */
	private $_nb_documento;
	/**
	 * @AttributeType string
	 * Descripci�n del contenido del documento.
	 */
	private $_tx_descripcion;
	/**
	 * @AttributeType string
	 * Servidor o direcci�n en la cual esta ubicada el documento.
	 */
	private $_tx_url_direccion;
	/**
	 * @AssociationType Planes.Activo
	 * @AssociationMultiplicity 0..*
	 */
	public $_pertenece = array();

/**
   * 
   * @access public
   */
  public $columDocumento= array('co_documento'=>'co_documento', 'nb_documento'=>'nb_documento', 'tx_descripcion'=>'tx_descripcion', 'tx_url_direccion'=>'tx_url_direccion');
  
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
  public function insertarDocumento($documento) {
  	
	$this->pdo->beginTransaction();	

	$documento = array_intersect_key($documento, $this->columDocumento);
	
	$r1 = $this->pdo->_insert('tr048_documento', $documento);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  
  } // end of member function insertarDocumento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function actualizarDocumento($documento, $condiciones) {
  	$this->pdo->beginTransaction();	

	$documento = array_intersect_key($documento, $this->columDocumento);
	
	$r1 = $this->pdo->_update('tr048_documento', $documento, $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function actualizarDocumento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function eliminarDocumento($condiciones ) {
  
  	$this->pdo->beginTransaction();	


	$r1 = $this->pdo->_delete('tr048_documento', $condiciones);
	
	if($r1)
			{$this->pdo->commit(); return true;}
	else		
			{$this->pdo->rollback();  return "Error : 1= ".$r1;	 }
  } // end of member function eliminarDocumento

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function cargarDocumento($start='0', $limit='ALL', $sort = "", $dir = "ASC") {

	$query = "SELECT *
                FROM tr048_documento";
	if ($sort != "") {
	$query .= " ORDER BY ".$sort." ".$dir;
	}
	$query .= "	LIMIT ".$limit."
				OFFSET ".$start;
	$r = $this->pdo->_query($query);
	
			
	return $r;
  } // end of member function cargarDocumento
}
?>