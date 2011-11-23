<?php session_start();

require_once 'Monitor.php';
	//print_r($_REQUEST);
/**
 * class MyPDO
 * 
 */
class MyPDO extends PDO
{

   /*** Attributes: ***/
	private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
	//private $conexion;

 /*** Attributes: ***/

  /**

   * @sin param 

   * @return link coneccion
   * @access public
   */
 
    var  $pdo; 
    public  $monitor;

    public function __construct($pdo=NULL){
	 if ($pdo==NULL){
        $this->engine = 'pgsql';

		$this->host = '10.168.16.10'; //'orimat100';
		$this->port = '5432';
		$this->database = 'sistemaspla';
		$this->user = 'merchang';
		$this->pass = '899236';
		$dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
		
		try {
      		parent::__construct( $dns, $this->user, $this->pass );
		} catch (PDOException $e) {
			echo 'Conexin Fallida: <br/> Ha ocurrido un error al intentar establecer conexin con el servidor. Por favor contacte con el administrador o custodio de esta aplicacin para notificarle acerca de este error. ' ;  //. $e->getMessage();
			exit;
		}
		
	    $this->pdo= $this;
		$this->reg_padre=NULL;
		$this->reg_padre_detalle=NULL;
	  }
	    else{
		$this->pdo = $pdo;
		$this->reg_padre[$this->cont]=$pdo->reg_padre[$pdo->cont];
	 }
	// $this->monitor = new Monitor($this->pdo);
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
   public function Attach(Monitor $monitor) {
  		//$this->pdo->monitor=$monitor;
		$this->monitor=$monitor;
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
   public function Notify($descripcion) { 
  		return $r = $this->pdo->monitor->insertarMonitor(array('tx_indicador'=>'GARCIAJRJ', 'fe_transaccion'=>date('Y-m-d H:i:s'), 'tx_descripcion'=>$descripcion));
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
   public function pushNotify($Method) { 
  		if(is_object($this->pdo->monitor))
	    	$this->pdo->monitor->pushRegPadre($this->pdo->Notify($Method)); //Notificar metodo en la posicion reg_padre));
} 
// end of member function insertarMonitor
 /**
   * 
   *
   * @param string co_rif_empresa, co_reset, campos claves para realizar la busqueda de una Monitor en particular 

      * @return  Array con todos los valores de la Monitor buscada.
	  			   si no consigue la Monitor devuelve un array vacio.
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access private
   */
   public function popNotify() { 
  		if(is_object($this->pdo->monitor))
	    	$this->pdo->monitor->popRegPadre(); // Libera posicion reg_padre
} 
// end of member function insertarMonitor
	/**
   * 
   * @param string $tabla nombre de la tabla de base de datos donde se desea insertar
                  array $atributos vector con los valores de los atributos q se desean insertar, los indices del vector deben ser igual al nombre del campo en la BD 
				  
   * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access privado
   */
	protected function _insert($tabla, $atributos){
		$comillas = "";
	    $columnas = array_keys($atributos);
		$insert = "INSERT INTO ".$tabla." (";
		for($i=0 ; $i< count($columnas); $i++)
			$insert .= ($i+1 == count($columnas)) ? $columnas[$i].") VALUES (" : $columnas[$i].", ";
				
		for($i=0 ; $i< count($atributos); $i++){
			$comillas = ((substr_count($atributos[$columnas[$i]], '$-'))>=1) ? "" : "'";
			if((substr_count($atributos[$columnas[$i]], '$-'))>=1) $atributos[$columnas[$i]] = str_replace("$-","", $atributos[$columnas[$i]]); 
			$insert .= ($i+1 == count($atributos)) ? $comillas.$atributos[$columnas[$i]].$comillas.");" : $comillas.$atributos[$columnas[$i]].$comillas.", ";
		}
		//	echo $insert;
			$r = $this->pdo->exec($insert);
			$error = $this->pdo->errorInfo();
			if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_insert)
					$this->pdo->Notify($error[2]." - ".$insert, 'detalle');
			if($r == NULL)
					return  get_class($this)." - ".__METHOD__." - ".$error[2]."\n";
			else				
				return $r;
	}
	/**
   * 
   *
   * @param string $tabla nombre de la tabla de base de datos donde se desea modificar
                  array $atributos vector con los valores de los atributos q se desean modificar, los indices del vector deben ser igual al nombre del campo en la BD 
				  array $condiciones vector con las condiciones de modificacion, indice igual al campo de la tabla y valor igual el valor q debe cumplir el campo para ser modificado
				  

     * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access public
   */
	protected function _update($tabla, $atributos, $condiciones){
		$columnas = array_keys($atributos);
		$columCond = array_keys($condiciones);
		$update = "UPDATE ".$tabla." SET ";
		for($i=0 ; $i< count($columnas); $i++)
			$update .= ($i+1 == count($columnas)) ? $columnas[$i]."='".$atributos[$columnas[$i]]."'" : $columnas[$i]."='".$atributos[$columnas[$i]] ."', ";
		if(is_array($condiciones)){
			$update .= ' WHERE ';
			for($i=0 ; $i< count($condiciones); $i++)
				$update .= ($i+1 == count($condiciones)) ? $columCond[$i]."='".$condiciones[$columCond[$i]]."';" : $columCond[$i]."='".$condiciones[$columCond[$i]] ."' AND ";
		}
		//echo $update;
		$r = $this->pdo->exec($update);
		$error = $this->pdo->errorInfo();
		if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_update)
					$this->pdo->Notify($error[2]." - ".$update, 'detalle');
		if($r == NULL){
			return  get_class($this)." - ".__METHOD__." - ".$error[2]."\n";
		}
		else
			return true;
	}
	/**
   * 
   *
   * * @param string $tabla nombre de la tabla de base de datos donde se desea modificar
                     array $condiciones vector con las condiciones de modificacion, indice igual al campo de la tabla y valor igual el valor q debe cumplir el campo para ser modificado
	

     * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access public
   */
	protected function _delete($tabla, $condiciones){
		$columCond = array_keys($condiciones);
		$delete = "DELETE FROM ".$tabla;
		
		if(is_array($condiciones)){
			$delete .= ' WHERE ';
			for($i=0 ; $i< count($condiciones); $i++)
				$delete .= ($i+1 == count($condiciones)) ? $columCond[$i]."='".$condiciones[$columCond[$i]]."';" : $columCond[$i]."='".$condiciones[$columCond[$i]] ."' AND ";
		}
		$r = $this->pdo->exec($delete);
		$error = $this->pdo->errorInfo();
		if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_delete)
					$this->pdo->Notify($error[2]." - ".$delete, 'detalle');
		if($error[2]){
			return  get_class($this)." - ".__METHOD__." -  ".$error[2]."\n";
		}
		else
			return true;
		}
		/**
   * 
   *
   * * @param string $tabla nombre de la tabla de base de datos donde se desea modificar
                     array $condiciones vector con las condiciones de modificacion, indice igual al campo de la tabla y valor igual el valor q debe cumplir el campo para ser modificado
	

     * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access public
   */
	protected function _query($query, $notify=true){
		if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
			$this->pdo->Notify($query, 'detalle');
		$r = $this->pdo->query($query);
		
		 if($r!=NULL){
	  		$result = $r->fetchALL(PDO::FETCH_ASSOC);
			return $result;
		} 
		else{
			$error = $this->pdo->errorInfo();
			return $error[2];
		}
	}
	
		/**
   * 
   *
   * * @param string $tabla nombre de la tabla de base de datos donde se desea modificar
                     array $condiciones vector con las condiciones de modificacion, indice igual al campo de la tabla y valor igual el valor q debe cumplir el campo para ser modificado
	

     * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access public
   */
	protected function _queryBind($query, $campo, $notify=true){
		$aux=NULL;
		if(is_object($this->pdo->monitor) && $this->pdo->monitor->notify_select)
			$this->pdo->Notify($query, 'detalle');
		$r = $this->pdo->query($query);
		 if($r!=NULL){
		 	$r->bindColumn($campo, $aux, PDO::PARAM_STR);
	  		$result = $r->fetch(PDO::FETCH_BOUND);
			return $aux;
		} 
		else{
			$error = $this->pdo->errorInfo();
			return $error[2];
		}
	}

  /**
   * 
   *
   * * @param string $tabla nombre de la tabla de base de datos donde se desea modificar
                     array $condiciones vector con las condiciones de modificacion, indice igual al campo de la tabla y valor igual el valor q debe cumplir el campo para ser modificado
	

     * @return  true si operacion se realiza con exito 
                   si falla retorna: nombre de la clase y metodo que llama a la function y el error devuelto por el manejador de BD 
				   
   * @access public
   */
  public function filtrarQuery($filter) {	
	$where = "";
	if (is_array($filter)) {	
		for ($i=0;$i<count($filter);$i++){
			switch($filter[$i]['data']['type']){
				case 'string' : 
					switch ($filter[$i]['data']['comparison']) {
						case 'ne' : 
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." NOT ILIKE '".$filter[$i]['data']['value']."%'"; 
						break;
						default:
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." ILIKE '".$filter[$i]['data']['value']."%'"; 
					}				
				break;
				case 'list' : 
					if (strstr($filter[$i]['data']['value'],',')){
						$fi = explode(',',$filter[$i]['data']['value']);
						for ($q=0;$q<count($fi);$q++){
							$fi[$q] = "'".$fi[$q]."'";
						}
						$filter[$i]['data']['value'] = implode(',',$fi);
						$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." IN (".$filter[$i]['data']['value'].")"; 
					}else{
						$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." = '".$filter[$i]['data']['value']."'"; 
					}
				break;
				case 'boolean' : 
					$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." = ".($filter[$i]['data']['value']); 
				break;
				case 'numeric' : 
					switch ($filter[$i]['data']['comparison']) {
						case 'eq' : 
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." = ".$filter[$i]['data']['value']; 
						break;
						case 'lt' : 
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." < ".$filter[$i]['data']['value']; 
						break;
						case 'gt' : 
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." > ".$filter[$i]['data']['value']; 
						break;
					}
				break;
				case 'date' : 
					switch ($filter[$i]['data']['comparison']) {
						case 'eq' : 
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." = '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; 
						break;
						case 'lt' : 
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." < '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; 
						break;
						case 'gt' : 
							$qs .= " AND ".$this->columFiltros[$filter[$i]['field']]." > '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; 
						break;
					}
				break;
			}
		}	
		$where .= $qs;
	}  
	return $where;
  }
  } // end of member function cargarConductores// end of MyPDO
?>
