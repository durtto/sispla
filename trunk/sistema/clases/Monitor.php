<?php 
require_once 'MyPDO.php';

/**
 * class monitor
 * 
 */
 
class Monitor extends MyPDO  //WARNING: PHP5 does not support multiple inheritance but there is more than 1 superclass defined in your UML model!
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/
   public $reg_padre; 
   public $cont;
   public $notify_select;
   public $notify_insert;
   public $notify_update;
   public $notify_delete;
   
	private $columMonitor = array('co_aplicacion'=>'co_aplicacion','co_transaccion'=>'co_transaccion', 'tx_indicador'=>'tx_indicador', 'fe_transaccion'=>'fe_transaccion', 'tx_descripcion'=>'tx_descripcion', 'co_transaccion_padre'=>'co_transaccion_padre', 'tx_operacion_bd'=>'tx_operacion_bd');
	
	public $columFiltros = array('tx_indicador'=>'e001t.tx_indicador', 'fe_transaccion'=>'e001t.fe_transaccion', 'tx_descripcion_padre'=>'e001t.tx_descripcion', 'tx_descripcion'=>'e001t_.tx_descripcion');
	/**
   * 
   *
   * @return string
   * @access public
   */
	 public function __construct($pdo=NULL, $select=false, $insert=true, $update=true, $delete=true){
	  parent::__construct($pdo);
	  $this->notify_select    = $select;
  	  $this->notify_insert    = $insert;
  	  $this->notify_update  = $update;
  	  $this->notify_delete   =  $delete;
      $this->pdo->reg_padre = NULL;
	  $this->cont=-1;
    } 
	/**
   * 
   *
   * @param string co_rif_empresa, co_reset, campos claves para realizar la busqueda de una Monitor en particular 

      * @return  Array con todos los valores de la Monitor buscada.
	  			   si no consigue la Monitor devuelve un array vacio.
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access private
   */
   public function pushRegPadre($reg_padre) {
	$this->cont++;  	
 	$this->pdo->reg_padre[$this->cont]=$reg_padre;
 } // end of member function insertarMonitor
 /**
   * 
   *
   * @param string co_rif_empresa, co_reset, campos claves para realizar la busqueda de una Monitor en particular 

      * @return  Array con todos los valores de la Monitor buscada.
	  			   si no consigue la Monitor devuelve un array vacio.
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access private
   */
   public function popRegPadre() {
   	$this->cont--;  	
 } // end of member function insertarMonitor
 
	
 /**
   * 
   *
   * @param string co_rif_empresa, co_reset, campos claves para realizar la busqueda de una Monitor en particular 

      * @return  Array con todos los valores de la Monitor buscada.
	  			   si no consigue la Monitor devuelve un array vacio.
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access private
   */
   public function buscarMonitor($co_transaccion) {
  $query = "SELECT 	e001t.* 
				 FROM 	e001t_monitor as e001t 
				WHERE  e001t.co_transaccion  = '".$co_transaccion."'";
 $r = $this->pdo->_query($query);
	return $r;
 } // end of member function insertarMonitor
 
/**
   * 
   *
   * @return array con todas las Monitores cargadas e la BD
   * @access public
   */
  public function cargarMonitor($start='0', $limit='ALL', $sort = "", $dir = "ASC") {
  	 global $filtros;
  	 $query = "SELECT 	e001t.tx_indicador, e001t.co_transaccion as co_transaccion_padre, e001t.fe_transaccion,
	 					e001t.tx_descripcion as tx_descripcion_padre, e001t_.co_transaccion as co_transaccion, 
						e001t_.tx_descripcion as tx_descripcion, monitor_reg_padre(e001t_.co_transaccion)
				FROM 	e001t_monitor as e001t 
				INNER JOIN e001t_monitor as e001t_ ON(e001t.co_transaccion=e001t_.co_transaccion_padre)";
	$query .= "WHERE 0=0 ".$this->filtrarQuery($filtros);	
//					ORDER BY ;
					
	$query .= " ORDER BY monitor_reg_padre DESC, e001t_.co_transaccion ASC";

	$query .= "	LIMIT ".$limit."
				        OFFSET ".$start;
	//echo $query;
	$r = $this->pdo->_query($query);
	return $r;
  } // end of member function cargarConductores

	/**
   * 
   *
   * @return string
   * @access public
   */  
  public function contarMonitor() {
  	global $filtros;
  	$this->pushNotify(__METHOD__); //Notificar metodo en la posicion reg_padre
	$query = "SELECT count(e001t.co_transaccion)
			FROM 	e001t_monitor as e001t INNER JOIN e001t_monitor as e001t_ ON(e001t.co_transaccion=e001t_.co_transaccion_padre)";
	$query.="WHERE 0=0 ".$this->filtrarQuery($filtros);																  
	$c = $this->pdo->_query($query);
	//$r['total'] = $c;
	$this->popNotify(); // Libera posicion reg_padre
			
	return $c;
  } 
  
  /**
   * 
   *
   * @param Array monitor  vector con los valores de los atributos de la Monitor q se desean insertar, los indices del vector deben ser igual al nombre del campo en la BD 
   				  Array pasajeros. vector q contiene las cedulas de los pasajeros de la Monitor a cargar los indices no influyen
				  string cedula. cadena con la cedula del usuario de sistema q esta realizando la carga de la Monitor.

      * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access private
   */
   public function insertarMonitor($monitor) {
    $monitor['tx_descripcion'] = str_replace("'","\'", $monitor['tx_descripcion']);
	$reg = $this->pdo->_query('SELECT nextval (\'"e001t_monitor_co_transaccion_seq"\') as reg', false);
	$monitor['co_transaccion'] = $reg[0]['reg'];
	if($this->pdo->cont!=-1)
			$monitor['co_transaccion_padre'] = $this->pdo->reg_padre[$this->cont];
  	$Monitor = array_intersect_key($monitor, $this->columMonitor);
 	$r = $this->pdo->_insert('e001t_monitor', $Monitor); 
	return $monitor['co_transaccion']; 
  } // end of member function insertarMonitor

  /**
   * 
   *
     * @param  array $columnass vector con los valores de los atributos q se desean modificar, los indices del vector deben ser igual al nombre del campo en la BD 
				     array $condiciones vector con las condiciones de modificacion, indice igual al campo de la tabla y valor igual el valor q debe cumplir el campo para ser modificado
				     Array pasajeros. vector q contiene las cedulas de los pasajeros de la Monitor a cargar los indices no influyen
				    string cedula. cadena con la cedula del usuario de sistema q esta realizando la carga de la Monitor.

      * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access private
   */
   public function actualizarMonitor($columnas, $condiciones, $detalle_monitor) {
	$columnas = array_intersect_key($columnas, $this->columMonitor);
	$this->pdo->beginTransaction();
  	$oper1 = $this->pdo->_update('e001t_monitor', $columnas, $condiciones);
	if(isset($detalle_monitor)){
		foreach($detalle_monitor as $detalle){
			$oper3 = $this->pdo->detalle_monitor->insertarDetalle_monitor($detalle);
		}
	}			
	else
		$oper3 = 1;

	if($oper2==1 && $oper1==1 && $oper3==1){
		$this->pdo->commit(); return true;
	}
	else{
		 $this->pdo->rollback(); return $oper1." | ".$oper2." | ".$oper3;
	}  
  } // end of member function actualizarMonitor
	
	/**
    * @param   array $condiciones vector con las condiciones de modificacion, indice igual al campo de la tabla y valor igual el valor q debe cumplir el campo para ser modificado
				  

    * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access public
   */
   public function eliminarMonitor( $condiciones ) {
  	$r = $this->pdo->_delete('e001t_monitor', $condiciones);
	return $r;
  } // end of member function eliminarConductor

} // end of monitor
?>
