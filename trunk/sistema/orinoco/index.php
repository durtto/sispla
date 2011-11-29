<html>
<head>
<title>:: ORINOCO ::</title>

<link rel="shortcut icon" href="images/icono.png"> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/main.css" rel="stylesheet" type="text/css">	
<script type="text/javascript" src="../js/md5.js"></script>
<script type="text/javascript" language="javascript">
function $() {

    var elements = new Array();

    for (var i = 0; i < arguments.length; i++) {

      var element = arguments[i];

      if (typeof element == 'string') {
        if (document.getElementById) {
          element = document.getElementById(element);
        } else if (document.all) {
          element = document.all[element];
        }
      }

      elements.push(element);

    }

    if (arguments.length == 1 && elements.length > 0) {
      return elements[0];
    } else {
      return elements;
    }
}


function verificar()
{ 
	
	if ($('login').value=="" || $('password').value=="") 
	{	
		alert ("Debe ingresar tanto el nombre de Usuario como la Clave...");
		
		$('login').focus(); // Se llama a esta funcion para que enfoque el cursor en el campo login
		return;
	}
	//encriptaclave(); //para encriptar password
	
	document.form1.submit();
	
}

var nav4 = window.Event ? true : false;
function enviar_form(oEvento)
{
	var key = nav4 ? oEvento.which : oEvento.keyCode;
	if (key==13)
	verificar();
}
	
function encriptaclave()
{
	$('password').value = b64_md5($('password').value);
}
</script>
</head>
<body bgcolor="#ffffff" onLoad="document.form1.login.focus()">

<table width="100%" height="100%" border="0" align="center">


  <tr>
    <td height="10%" align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="368">
      <form name="form1" method="post" action="validar.php">
        <tr>
          <td><img src="../imagenes/spacer.gif" width="3" height="1" border="0" title=""></td>

          <td><img src="../imagenes/spacer.gif" width="7" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="154" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="52" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="65" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="10" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="63" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="2" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="2" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="7" height="1" border="0" title=""></td>

          <td><img src="../imagenes/spacer.gif" width="3" height="1" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="1" height="1" border="0" title=""></td>
        </tr>			
        <tr>
          <td colspan="3"><img name="aviso_error_r1_c1" src="../imagenes/leftORINOCOindex.png" width="164" height="43" border="0" title=""></td>
          <td colspan="4" align="right" valign="bottom" background="../imagenes/aviso_error_r1_c4.jpg" class="textgris"></td>
          <td colspan="4"><img name="aviso_error_r1_c8" src="../imagenes/aviso_error_r1_c8.jpg" width="14" height="43" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="1" height="43" border="0" title=""></td>								
        </tr>
        <tr>

          <td colspan="11"><img name="aviso_error_r2_c1" src="../imagenes/aviso_error_r2_c1.jpg" width="368" height="3" border="0" title=""></td>
          <td><img src="imagenes/spacer.gif" width="1" height="3" border="0" title=""></td>
        </tr>
        <tr>
          <td rowspan="2"><img name="aviso_error_r3_c1" src="../imagenes/aviso_error_r3_c1.jpg" width="3" height="125" border="0" title=""></td>
          <td rowspan="2"><img name="aviso_error_r3_c2" src="../imagenes/aviso_error_r3_c2_b.jpg" width="7" height="125" border="0" title=""></td>
          <td colspan="7" rowspan="2" align="center" valign="middle" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="37%" rowspan="7"><img src="../imagenes/logo_ini.gif" width="130" height="125"></td>

              <td height="18" colspan="4" align="center" valign="bottom" class="titulo1">Inicio de Sesi&oacute;n  </td>
              </tr>
            <tr>
              <td height="14" width="1%" align="center"> </td>
              <td width="31%" align="center"> </td>
              <td width="1%" align="center"> </td>

              <td width="30%" align="center"> </td>
            </tr>
            <tr>
              <td colspan="2" align="right" class="textgris">Login / Indicador&nbsp;:&nbsp;&nbsp;</td>
              <td colspan="2" align="left" class="label_infoGdeOsc"><input name="login" type="text" class="textsobreblanco" id="login" size="18"></td>
              </tr>
            <tr>

              <td height="10" align="right"> </td>
              <td height="10" align="right"> </td>
              <td height="10" align="center"> </td>
              <td height="10" align="center"> </td>
            </tr>
            <tr>
              <td colspan="2" align="right" class="textgris">Contrase&ntilde;a&nbsp;:&nbsp;&nbsp;</td>

              <td colspan="2" align="left" class="label_infoGdeOsc"><input name="password" type="password" class="textsobreblanco" id="password" size="18" onKeyPress="enviar_form(event);"></td>
              </tr>
            <tr>
              <td height="10" align="center"> </td>
              <td height="10" align="center"> </td>
              <td height="10" align="center"> </td>
              <td height="10" align="center"> </td>

            </tr>
            <tr>
              <td colspan="4" align="center" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="65%" align="right" valign="bottom"><a href="javascript:verificar()" ><img name="acceso_r10_c7" src="../imagenes/acceso_r10_c7.jpg" width="65" height="22" border="0" title=""></a></td>
                  <td width="5%" align="right" valign="bottom">&nbsp;</td>
                  <td width="30%" align="right" valign="bottom"><a href="javascript:document.form1.reset()" ><img name="acceso_r10_c10" src="../imagenes/acceso_r10_c10.jpg" width="65" height="22" border="0" title=""></a></td>
                </tr>
              </table></td>

              </tr>
          </table></td>
          <td rowspan="2"><img name="aviso_error_r3_c10" src="../imagenes/aviso_error_r3_c10.jpg" width="7" height="125" border="0" title=""></td>
          <td rowspan="2"><img name="aviso_error_r3_c11" src="../imagenes/aviso_error_r3_c11.jpg" width="3" height="125" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="1" height="103" border="0" title=""></td>
        </tr>
        <tr>
          <td><img src="../imagenes/spacer.gif" width="1" height="22" border="0" title=""></td>
        </tr>

        <tr>
          <td colspan="11"><img name="aviso_error_r5_c1" src="../imagenes/aviso_error_r5_c1.jpg" width="368" height="3" border="0" title=""></td>
          <td><img src="../imagenes/spacer.gif" width="1" height="3" border="0" title=""></td>
        </tr>
		</form>
    </table></td>
  </tr>
  <tr>
    <td height="40%" align="center" valign="top" class="txto_foot">Realizado por PDVSA</td>

  </tr>
</table>
<!--
<P>
<h1 align=CENTER ><BLINK><FONT color=red >CAISTE POR INOCENTE</font></BLINK></h1>
-->

</body>
	
	
</html>
