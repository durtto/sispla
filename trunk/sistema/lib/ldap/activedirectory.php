<?php  error_reporting(E_ALL & ~E_NOTICE);
function ActiveDirectory($usua,$pass)
{
  
if ((!$usua=='')&&(!$pass=='')){
   $ds=ldap_connect("PDVSA.COM");
   @ldap_set_option($ds,LDAP_OP_PROTOCOL_VERSION, 3);
   $bind=@ldap_bind($ds,$usua."@PDVSA.COM",$pass);
   return $bind;
}
else{
   $bind=0;
}
return $bind;
}
?>
