<?php
$SERVIDOR_LDAP = "LDAP://CCSCAM05.PDVSA.COM";
$PUERTO_LDAP = 389;

//Verifica el usuario por medio de la cédula
function verificar_usuario_c($cedula)
{
	global $SERVIDOR_LDAP, $PUERTO_LDAP;
	
	$ldap_server = $SERVIDOR_LDAP;
	$puerto = $PUERTO_LDAP;
	
	if ($connect=@ldap_connect($ldap_server,$puerto))
	{ 
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		if (($bind=@ldap_bind($connect)) == false) return 0;
		if (($res_id = @ldap_search( $connect,
									 "OU=Usuarios,DC=pdvsa,DC=com",
									 "pdvsacom-AD-cedula=$cedula")) == false) 
									 {
										@ldap_close($connect);
										return 0; 
									 }

		if (ldap_count_entries($connect, $res_id) != 1) 
		{
			@ldap_close($connect);
			return 0;
		}

		if (( $entry_id = @ldap_first_entry($connect, $res_id))== false) 
		{	
			@ldap_close($connect);
			return 0;
		}
		
		$attr=ldap_get_attributes($connect, $entry_id);
		
		@ldap_close($connect);
		
		return $attr;
	} else return 0;
}

// Función verificadora de usuario por medio del indicador
function verificar_usuario_i($indicador)
{
	global $SERVIDOR_LDAP, $PUERTO_LDAP;
	
	$ldap_server = $SERVIDOR_LDAP;
	$puerto = $PUERTO_LDAP;
	
	if ($connect=@ldap_connect($ldap_server,$puerto))
	{ 
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		if (($bind=@ldap_bind($connect)) == false) return 0;
		if (($res_id = @ldap_search( $connect,
									 "OU=Usuarios,DC=pdvsa,DC=com",
									 "UID=$indicador")) == false) 
									 {
										@ldap_close($connect);
										return 0; 
									 }
		
		if (ldap_count_entries($connect, $res_id) != 1) 
		{
			@ldap_close($connect);
			return 0;
		}
		if (( $entry_id = @ldap_first_entry($connect, $res_id))== false) 
		{	
			@ldap_close($connect);
			return 0;
		}
	
		$attr=ldap_get_attributes($connect, $entry_id);
		
		@ldap_close($connect);
		
		return $attr;
	} else return 0;
}

//Verificador de Usuario pasando el usario y password

function verificar_usuario($username,$password)
{
	global $SERVIDOR_LDAP, $PUERTO_LDAP;
	
	$ldap_server = $SERVIDOR_LDAP;
	$puerto = $PUERTO_LDAP;

	if ($connect=@ldap_connect($ldap_server,$puerto))
	{ 
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		if(($bind=@ldap_bind($connect)) == false) return -1; // No hay conexion
		if (($res_id = @ldap_search( $connect,
									 "OU=Usuarios,DC=pdvsa,DC=com",
									 "UID=$username")) == false) 
									 {
										@ldap_close($connect);
										return -2; 
									 }
		
		if (ldap_count_entries($connect, $res_id) != 1) 
		{
			@ldap_close($connect);
			return -3;
		}
		if (( $entry_id = @ldap_first_entry($connect, $res_id))== false) 
		{	
			@ldap_close($connect);
			return -4;
		}
		
		if (( $user_dn = @ldap_get_dn($connect, $entry_id)) == false)
		{
			@ldap_close($connect);
			return -4;
		}
		if (($link_id = @ldap_bind($connect, $user_dn, $password)) == false)
		{
			@ldap_close($connect);
			return -5;
		}
		@ldap_close($connect);
		return 1;
	} else return 0;
}



?>
