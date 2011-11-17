<?php
	session_start();
	//echo $_REQUEST['login'];
	//echo $_REQUEST['password'];
	require('../scripts/activedirectory.php');
	require('../scripts/activedirectory_valores.php');
	$ActiveD    = ActiveDirectory(strtolower($_REQUEST['login']),$_REQUEST['password']);
	$ActiveDVal = ActiveDirectory_valores(strtolower($_REQUEST['login']));

	if($ActiveD==1)
	{
			$_SESSION['apellido']    = $ActiveDVal[0]['sn'][0];
			$_SESSION['indicador']   = strtolower($_REQUEST['login']);
			$_SESSION['fecha_p']	 = date("d/m/Y");

	
			header("location:home.php");	
	}
	else
	{
	
		header("Location: acceso_error.php");
	}
?>
