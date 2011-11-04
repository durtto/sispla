<?php
require_once 'MyPDO.php';
require_once 'Estado.php';

	$base_grafica=$_REQUEST['base'];
	$tipo_grafica=$_REQUEST['tipo'];
	if($_REQUEST['estado']!=''){
		$estado_grafica=$_REQUEST['estado'];
	}
	else{
		$estado_grafica=1;
	}		
	$fe_ini=explode('/',$_REQUEST['fe_ini']);
	$fe_ini=$fe_ini[2]."-".$fe_ini[1]."-".$fe_ini[0];
	$fe_fin=explode('/',$_REQUEST['fe_fin']);
	$fe_fin=$fe_fin[2]."-".$fe_fin[1]."-".$fe_fin[0];
	
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
			$query="SELECT 
			COUNT (a.co_nivel) AS valor
			FROM 
			  public.tr027_activo a,
			  public.tr023_nivel_obsolescencia n
			WHERE 
			a.co_nivel = n.co_nivel AND
			a.co_nivel = '$co_nivel'
			GROUP BY a.co_nivel;";
			$r = $this->pdo->_query($query);
			return $r;
				/*$query="SELECT nb_estado AS nombre,COUNT(co_control_doc) AS valor
						FROM (SELECT co_control_doc,(SELECT ude2.co_estado 
												FROM c006t_usr_doc_estado ude2,i005t_estado e2
												WHERE fe_ho_cambio BETWEEN '$fe_ini' AND '$fe_fin'
												AND ude2.co_estado IN(1,2,3,4,5,9)
												AND ude.co_control_doc=ude2.co_control_doc
												AND ude2.co_estado=e2.co_estado
												ORDER BY ude2.fe_ho_cambio DESC,e2.nu_orden DESC
												LIMIT 1) AS co_estado
								FROM c006t_usr_doc_estado ude
								WHERE fe_ho_cambio BETWEEN '$fe_ini' AND '$fe_fin'
								GROUP BY co_control_doc) d,i005t_estado e
								WHERE d.co_estado=e.co_estado
								GROUP BY e.co_estado
								ORDER BY e.nu_orden";*/
								
								
								
								
			break;
			case 2:

			break;
			case 3:

			break;
			case 4:

			break;
			case 5:

			break;
			case 6:

			break;
		}
		$result=mysql_query($query);
		$json="[";
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
		echo $json."]";
	}	
?>
