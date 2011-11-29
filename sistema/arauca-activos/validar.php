<?php
	session_start();
	//echo $_REQUEST['login'];
	//echo $_REQUEST['password'];
	require('../scripts/activedirectory.php');
	require('../scripts/activedirectory_valores.php');
	require_once ('../clases/Usuario.php');
	require_once ('../clases/Ubicacion.php');
	
	$ActiveD    = ActiveDirectory(strtolower($_REQUEST['login']),$_REQUEST['password']);
	$ActiveDVal = ActiveDirectory_valores(strtolower($_REQUEST['login']));

	if($ActiveD==1)
	{
			$_SESSION['apellido']    = $ActiveDVal[0]['sn'][0];
			$_SESSION['indicador']   = strtolower($_REQUEST['login']);
			$_SESSION['fecha_p']	 = date("d/m/Y");
			/*********/
			$usuario = new Usuario();
			$res = $usuario->cargarUsuarioLogin(strtoupper($_REQUEST['login']));
			if ($res[0]['nb_privilegio'] != "")	{
				$_SESSION['privilegio']  = $res[0]['nb_privilegio'];
			}        
			else
			{
				$_SESSION['privilegio']  = "VISITANTE";
			}
			$_SESSION['nombre']  = $res[0]['nb_persona'];
			$_SESSION['ubicacion']  = $res[0]['nb_ubicacion'];
			$_SESSION['co_ubicacion']  = $res[0]['co_ubicacion'];
			//print_r($res);
			/**********/
			
			header("location:home.php");	
	}
	else
	{
	
		header("Location: acceso_error.php");
	}
?>
