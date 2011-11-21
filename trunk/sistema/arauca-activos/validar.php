<?php
	session_start();
	//echo $_REQUEST['login'];
	//echo $_REQUEST['password'];
	require('../scripts/activedirectory.php');
	require('../scripts/activedirectory_valores.php');
	require_once ('../clases/Usuario.php');
	$ActiveD    = ActiveDirectory(strtolower($_REQUEST['login']),$_REQUEST['password']);
	$ActiveDVal = ActiveDirectory_valores(strtolower($_REQUEST['login']));

	if($ActiveD==1)
	{
			$_SESSION['apellido']    = $ActiveDVal[0]['sn'][0];
			$_SESSION['indicador']   = strtolower($_REQUEST['login']);
			$_SESSION['fecha_p']	 = date("d/m/Y");
			/*********/
			$usuario = new Usuario();
			$res = cargarUsuarioLogin(strtolower($_REQUEST['login']));	        
			$_SESSION['privilegio']  = $res[0]['nb_privilegio'];
			/**********/
			
			header("location:home.php");	
	}
	else
	{
	
		header("Location: acceso_error.php");
	}
?>