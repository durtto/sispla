<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Ubicacion</title>
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

/******************************************INICIO**StoreUbicacion******************************************/     

  var storeUbicacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_ubicacion.php',
		remoteSort : true,
		root: 'ubicaciones',
        totalProperty: 'total',
		idProperty: 'co_ubicacion',
        fields: [{name: 'co_ubicacion'},
        		{name: 'nb_ubicacion'},
        		{name: 'bo_obsoleto'},
        		{name: 'co_ubicacion_padre'},
        		{name: 'nb_ubicacion_padre'},
        		{name: 'co_tipo_ubicacion'},
        		{name: 'nb_tipo_ubicacion'},
        		{name: 'resp'}]
        });
    storeUbicacion.setDefaultSort('co_ubicacion', 'ASC');
    
/*****************************************FIN****StoreUbicacion*****************************************/


/******************************************INICIO**colModelUbicacion******************************************/     
	
	
    var colModelUbicacion = new Ext.grid.ColumnModel([
        {id:'co_ubicacion',header: "Ubicacion", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_ubicacion'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},
        {header: "Obsoleto", width: 100, sortable: true, locked:false, dataIndex: 'bo_obsoleto', renderer: obsoleto},
        {header: "Ubicacion Padre", hidden:true,width: 150, sortable: true, locked:false, dataIndex: 'co_ubicacion_padre'},
        {header: "Ubicacion Padre", width: 150, sortable: true, locked:false, dataIndex: 'nb_ubicacion_padre'},
        {header: "Ubicacion Padre", hidden:true,width: 150, sortable: true, locked:false, dataIndex: 'co_tipo_ubicacion'},
        {header: "Tipo Ubicacion", width: 150, sortable: true, locked:false, dataIndex: 'nb_tipo_ubicacion'},
        ]);
        
/******************************************FIN****colModelUbicacion******************************************/     


   var grid =new Ext.grid.GridPanel({
					id: 'gd_ubicacion',
					name:'gd_ubicacion',
					store: storeUbicacion,
					cm: colModelUbicacion,
					stripeRows: true,
					//plugins: expanderPersona,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					//width:670,
					title:'Lista de Ubicaciones',
					tools: [{id:'save'},{id:'print'}],
					border: true,
					bbar: new Ext.PagingToolbar({
					store: storeUbicacion,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });


storeUbicacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_ubicacion.php"}});
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
