<?php
require_once 'MyPDO.php';
	$obj = new MyPDO();
	$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);

class Combos extends MyPDO  //WARNING: PHP5 does not support multiple inheritance but there is more than 1 superclass defined in your UML model!
{

public function cargarTpDirectorio() {
	
  $query = "SELECT *
                FROM tr050_tipo_directorio;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } 
public function cargarTpUbicacion() {
	
  $query = "SELECT *
                FROM tr005_tipo_ubicacion;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }
public function cargarTpRespaldo() {
	
  $query = "SELECT *
                FROM tr034_tipo_respaldo;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } // end of member function cargarDocumento

public function cargarTpActivo() {
	
  $query = "SELECT * 
			FROM tr014_tipo_activo";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } // end of member function cargarDocumento
  
public function cargarDepartamento() {
	
  $query = "SELECT *
                FROM tr007_departamento;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }  

public function cargarRol() {
	
  $query = "SELECT *
				FROM tr008_rol_persona;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } 
public function cargarResponsabilidad() {
	
  $query = "SELECT *
				FROM tr002_rol_responsabilidad;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } 
  
public function cargarGrupo() {
	
  $query = "SELECT *
				FROM tr001_grupo;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }  
public function cargarGuardia() {
	
  $query = "SELECT *
				FROM tr009_guardia;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }
public function cargarEstado() {
	
  $query = "SELECT *
                FROM tr004_estado;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }
public function cargarProceso() {
	
  $query = "SELECT *
                FROM tr016_proceso;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }
public function cargarProveedor() {
	
  $query = "SELECT *
				FROM tr025_proveedor;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } 
public function cargarNivel() {
	
  $query = "SELECT *
				FROM tr023_nivel_obsolescencia;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } 
public function cargarUnidad() {
	
  $query = "SELECT *
				FROM tr024_unidad_demanda;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  } 
public function cargarUbicacion() {
	
  $query = "SELECT *
				FROM tr006_ubicacion;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }
public function cargarFabricante() {
	
  $query = "SELECT *
				FROM tr003_fabricante;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }
public function cargarModelo() {
	
  $query = "SELECT *
				FROM tr029_modelo;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }  
public function cargarActivo() {
	
  $query = "SELECT *
				FROM tr027_activo;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';

  }
public function cargarServicio() {
	
  $query = "SELECT *
				FROM tr013_servicio;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
//d
  } 
public function cargarCapacidad() {
	
  $query = "SELECT *
			FROM tr012_capacidad;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
//d
  }
public function cargarCategoria() {
	
  $query = "SELECT *
				FROM tr011_categoria;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
//d
  }
public function cargarPrivilegio() {
	
  $query = "SELECT *
				FROM tr022_privilegio_usuario;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
//d
  }
public function cargarCaracteristica() {
	
  $query = "SELECT *
				FROM tr030_caracteristica;";   
   $r = $this->pdo->_query($query);
   echo '{"Resultados":'.json_encode($r).'}';
//d
  }    
}
?>
