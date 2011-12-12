<?php
	require_once 'MyPDO.php';
	$base_grafica=$_REQUEST['base'];
	$tipo_grafica=$_REQUEST['tipo'];
	if($_REQUEST['estado']!=''){
		$estado_grafica=$_REQUEST['estado'];
	}
	else{
		$estado_grafica=1;
	}		
		
	if($tipo_grafica==1){
		$json='';
		$result=mysql_query("SELECT *
							FROM i005t_estado
							WHERE in_activo=1 AND co_estado=1");
		while($row=mysql_fetch_array($result)){
			if($json!='')
				$json.=",";
			$query="SELECT CONCAT('Date.UTC(',YEAR(fe_ho_cambio),',',MONTH(fe_ho_cambio)-1,')') AS nombre,COUNT(co_control_doc) AS valor
				FROM c006t_usr_doc_estado
				WHERE co_estado=".$row['co_estado']." AND fe_ho_cambio BETWEEN '$fe_ini' AND '$fe_fin' 
				GROUP BY YEAR(fe_ho_cambio),MONTH(fe_ho_cambio)
				ORDER BY YEAR(fe_ho_cambio),MONTH(fe_ho_cambio)
				";
			$result2=mysql_query($query);
			$json1='';
			while($row2 = mysql_fetch_array($result2)){
				if($json1!='')
					$json1.=",";
				$json1.="[".$row2['nombre'].",".$row2['valor']."]";			
			}
			$json.= "{name:'".$row['nb_estado_graf']."',data:[$json1]}";
		}
		$query="SELECT CONCAT('Date.UTC(',YEAR(fe_ho_cambio),',',MONTH(fe_ho_cambio)-1,')') AS nombre,COUNT(co_control_doc) AS valor
				FROM c006t_usr_doc_estado
				WHERE co_estado IN (3,4) AND fe_ho_cambio BETWEEN '$fe_ini' AND '$fe_fin' 
				GROUP BY YEAR(fe_ho_cambio),MONTH(fe_ho_cambio)
				ORDER BY YEAR(fe_ho_cambio),MONTH(fe_ho_cambio)
				";
			$result2=mysql_query($query);
			$json1='';
			while($row2 = mysql_fetch_array($result2)){
				if($json1!='')
					$json1.=",";
				$json1.="[".$row2['nombre'].",".$row2['valor']."]";			
			}
			$json.= ",{name:'REVISADOS',data:[$json1]}";
		echo "[$json]";
		
	}
	else{
		switch($_REQUEST['base']){
			case 1:
				$query="SELECT count(a.co_activo) AS valor, n.nb_nivel AS nombre
						FROM 
						  tr027_activo a
						  INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
						  INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
						  INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
						  INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
						  INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
						  INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
						  INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
						  LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)
						  GROUP BY n.co_nivel, n.nb_nivel
						  ORDER BY n.co_nivel";
			break;
			case 2:
				$query="SELECT count(a.co_tipo_activo) AS valor, t.nb_tipo_activo AS nombre
						FROM 
						tr027_activo a
						INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
						INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
						INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
						INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
						INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
						INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
						INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
						LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)
						GROUP BY t.co_tipo_activo, t.nb_tipo_activo
						ORDER BY t.co_tipo_activo";
			break;
			case 3:
				$query="SELECT count(a.co_ubicacion) AS valor, u.nb_ubicacion AS nombre
						FROM 
						tr027_activo a
						INNER JOIN tr004_estado e ON (a.co_estado = e.co_estado) 
						INNER JOIN tr003_fabricante f ON (a.co_fabricante = f.co_fabricante) 
						INNER JOIN tr010_persona p ON (a.co_indicador = p.co_indicador)
						INNER JOIN tr016_proceso po ON (a.co_proceso = po.co_proceso) 
						INNER JOIN tr025_proveedor pr ON (a.co_proveedor = pr.co_proveedor)
						INNER JOIN tr023_nivel_obsolescencia n ON (a.co_nivel = n.co_nivel) 
						INNER JOIN tr014_tipo_activo t ON (a.co_tipo_activo = t.co_tipo_activo)
						LEFT JOIN tr006_ubicacion u ON (a.co_ubicacion = u.co_ubicacion)
						GROUP BY u.co_ubicacion, u.nb_ubicacion
						ORDER BY u.co_ubicacion";
			break;

		}
		$r = $this->pdo->_query($query);
		
		echo '{"Resultados":'.json_encode($r).'}';
		
		/*$json="[";
		while($row = mysql_fetch_array($result)){
			if($json!='[')
				$json.=",";
			switch($tipo_grafica){
				case 2:
					$json.="{name:'".$row['nombre']."',data:[".$row['valor']."]}";
				break;
				case 3:
					$json.="['".$row['nombre']."',".$row['valor']."]";
				break;
			}
			
		}
		echo $json."]";*/
	}	
	mysql_close($conexion);
?>
