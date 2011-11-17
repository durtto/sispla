<?php  error_reporting(E_ALL & ~E_NOTICE);
function ActiveDirectory_valores($usua)
{
$ds=ldap_connect("PDVSA.COM");  // Debe ser un servidor LDAP valido!
if ($ds) {
    if($sr=@ldap_search( $ds,"OU=Usuarios,DC=pdvsa,DC=com","uid=$usua*"))
	{
			$info = ldap_get_entries($ds, $sr);
			return $info;
		   ldap_close($ds);
	}
	else return 0;
}
 else {
   return 2;
}
}
function ActiveDirectory_nombre($usua)
{
$ds=ldap_connect("PDVSA.COM");  // Debe ser un servidor LDAP valido!
if ($ds) {
    if($sr=@ldap_search( $ds,"OU=Usuarios,DC=pdvsa,DC=com","givenname=$usua*"))
	{
			$info = ldap_get_entries($ds, $sr);
			return $info;
		   ldap_close($ds);
	}
	else return 0;
}
 else {
   return 2;
}
}
function ActiveDirectory_apellido($usua)
{
$ds=ldap_connect("PDVSA.COM");  // Debe ser un servidor LDAP valido!
if ($ds) {
    if($sr=@ldap_search( $ds,"OU=Usuarios,DC=pdvsa,DC=com","sn=$usua*"))
	{
			$info = ldap_get_entries($ds, $sr);
			return $info;
		   ldap_close($ds);
	}
	else return 0;
}
 else {
   return 2;
}
}
?>