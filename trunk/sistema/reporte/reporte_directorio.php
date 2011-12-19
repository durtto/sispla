<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Directorio</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">
<link rel="stylesheet" type="text/css" href="../css/botones.css">
<!--<link rel="stylesheet" type="text/css" href="lib/ext-3.2.1/resources/css/xtheme-gray.css">-->
	<!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->

    <script type="text/javascript" src="../lib/ext-3.2.1/ext-all.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/shared/extjs/App.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowEditor.js"></script>
    <!-- overrides to base library -->

    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/GridFilters.css" />
    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/RangeMenu.css" />

    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/shared/icons/silk.css" />
	<link rel="stylesheet" href="../lib/ext-3.2.1/examples/ux/css/RowEditor.css" />


    <!-- extensions para los filtros -->
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/menu/RangeMenu.js"></script>

	<script type="text/javascript" src="../js/ext-lang-es.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/GridFilters.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/GridFilters.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/Filter.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/StringFilter.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/DateFilter.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/ListFilter.js"></script>

	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/NumericFilter.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/BooleanFilter.js"></script>
	<script type="text/javascript" src="../js/funciones.js?=00002"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowExpander.js"></script>

<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
 var nuevo;
 var winDirectorio;
 
Ext.onReady(function(){
	Ext.QuickTips.init();
	Ext.form.Field.prototype.msgTarget = 'side';
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

/******************************************INICIO**StoreTpDirectorio******************************************/     
	
  var storeTpDirectorio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_directorio.php',
		remoteSort : true,
		root: 'tpdirectorios',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_tipo_directorio.php'},
        totalProperty: 'total',
		idProperty: 'co_tipo_directorio',
        fields: [{name: 'co_tipo_directorio'},
		        {name: 'nb_tipo_directorio'},
		        {name: 'resp'}]
        });
    storeTpDirectorio.setDefaultSort('co_tipo_directorio', 'ASC');
    
/*****************************************FIN****StoreTpDirectorio*****************************************/



/******************************************INICIO**colModelTpDirectorio******************************************/     
    
    var colModeltpDirectorio = new Ext.grid.ColumnModel([
        {id:'co_tipo_directorio',header: "Directorio", hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_tipo_directorio'},
        {header: "Nombre", width: 375, sortable: true, locked:false, dataIndex: 'nb_tipo_directorio'},
      ]);
	
/******************************************FIN****colModelTpDirectorio******************************************/     

/******************************************INICIO**StoreDirectorio******************************************/     
      
  var storeDirectorio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_directorio.php',
		remoteSort : true,
		root: 'directorios',
        totalProperty: 'total',
        baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_directorio.php'},
		idProperty: 'co_directorio',
        fields: [{name: 'co_directorio'},
		        {name: 'nb_directorio'},
		        {name: 'nb_tipo_directorio'},
		        {name: 'co_tipo_directorio'},
		        {name: 'nu_telefono'},
		        {name: 'resp'}]
        });
    storeDirectorio.setDefaultSort('co_directorio', 'ASC');
    
/*****************************************FIN****StoreDirectorio*****************************************/



/******************************************INICIO**colModelDirectorio******************************************/     
   
    var colModelDirectorio = new Ext.grid.ColumnModel([
        {id:'co_directorio',header: "Directorio", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_directorio'},
        {header: "Nombre", width: 250, sortable: true, locked:false, dataIndex: 'nb_directorio'},
        {header: "Tipo Directorio", width: 250, hidden:true, sortable: true, locked:false, dataIndex: 'co_tipo_directorio'},
        {header: "Tipo Directorio", width: 300, sortable: true, locked:false, dataIndex: 'nb_tipo_directorio'},
        {header: "Numero Telefonico", width: 150, sortable: true, locked:false, dataIndex: 'nu_telefono'},
      ]);
      
/******************************************FIN****colModelDirectorio******************************************/     



   var grid =new Ext.grid.GridPanel({
					id: 'gd_directorio',
					name:'gd_directorio',
					store: storeDirectorio,
					cm: colModelDirectorio,
					stripeRows: true,
					//plugins: expanderDirectorio,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					width:780,
					title:'Lista de Directorio',
					border: true,
					tools: [{id:'save'},{id:'print'}],
					bbar: new Ext.PagingToolbar({
					store: storeDirectorio,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });


storeDirectorio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_directorio.php"}});
grid.render('grid');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<div id="loading-mask" style=""></div>
  <div id="loading">
  <div class="loading-indicator">
  <img src="../imagenes/loading.gif" width="16" height="16" style="margin-right:8px;" align="absmiddle"/>Cargando...
  </div>
  </div>
  <table  align="center">
    <tr>
      <td><div id="grid" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
</body>
</html>
