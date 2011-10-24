<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Organigrama</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">
<link rel="stylesheet" type="text/css" href="../css/botones.css">
<link type="text/css" href="../lib/Jit/Examples/css/base.css" rel="stylesheet" />
<link type="text/css" href="../lib/Jit/Examples/css/Spacetree.css" rel="stylesheet" />


<!--<link rel="stylesheet" type="text/css" href="lib/ext-3.2.1/resources/css/xtheme-gray.css">-->
	<!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/ext/ext-base.js"></script>
 	 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/ext/ext-basex.js"></script>
 	 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/jit.js"></script>

 	 <!--ENDLIBS -->
	<script language="javascript" type="text/javascript" src="../lib/Jit/jit.js"></script>

    <script type="text/javascript" src="../lib/ext-3.2.1/ext-all.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/shared/extjs/App.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowEditor.js"></script>
    <!-- overrides to base library -->

    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/GridFilters.css" />
    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/RangeMenu.css" />
    <link rel="stylesheet" type="text/css" href="../lib/Jit/Examples/Spacetree/example1.js" />

    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/shared/icons/silk.css" />
	<link rel="stylesheet" href="../lib/ext-3.2.1/examples/ux/css/RowEditor.css" />
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/XmlTreeLoader.js"></script>

    <!-- extensions para los filtros -->
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/menu/RangeMenu.js"></script>

	<script type="text/javascript" src="../js/ext-lang-es.js"></script>
	<script type="text/javascript" src="../js/funciones.js?=00002"></script>
	<script language="javascript" type="text/javascript" src="../js/graficojit.js"></script>

<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
 var nuevo;
 


Ext.onReady(function(){
	Ext.QuickTips.init();
	Ext.BLANK_IMAGE_URL = '../lib/ext-3.2.1/resources/images/default/s.gif';
	
	var nroReg;
	
/******************************************CAMPOS REQUERIDOS******************************************/     	
	
	var camposReq = new Array(10);

/*****************************************************************************************************/     

    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	//--------------------------------------------------------
	var panelGrafica = new Ext.Panel({
		id: 'panelGrafica',
		width: 780,
		height: 400,
		layout: 'fit',
		renderTo:'container'
	});
	//--------------------------------------------------------

/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var panel = new Ext.FormPanel({
        id: 'panel_organigrama',
        renderTo:'org',
        frame: true,
		labelAlign: 'center',
        title: 'Activo',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:820,
		items: [{
			width:800,
			items: [panelGrafica]
			
		}
		],
        
    });


/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" onload="organigrama();">
<div id="loading-mask" style=""></div>
<div id="loading">
	<div class="loading-indicator">
  <img src="../imagenes/loading.gif" width="16" height="16" style="margin-right:8px;" align="absmiddle"/>Cargando...
  </div>
  </div>
  <table  align="center">
    <tr>
      <td>
      	<div id="org" style="margin: 0 0 0 0;">
			<div id="container">
				<div id="center-container">
			    	<div id="infovis"></div>    
				</div>
			<div id="log"></div>
			</div>
		</div>
    </td>
 </tr>
</table>
</body>
</html>