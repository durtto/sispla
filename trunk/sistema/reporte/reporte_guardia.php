<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Guardia</title>
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

/******************************************INICIO**StoreGuardia******************************************/     
	
  var storeGuardia = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_guardia.php',
		remoteSort : true,
		root: 'guardias',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_guardia.php"},	
        totalProperty: 'total',
		idProperty: 'co_guardia',
        fields: [{name: 'co_guardia'},			
        		{name: 'nb_guardia'},				
        		{name: 'nu_numero'},	 
        		{name: 'tx_descripcion'},	
        		{name: 'nu_inicio_guardia'},
        		{name: 'nu_fin_guardia'},	
        		{name: 'resp'}]
       
        });
    storeGuardia.setDefaultSort('co_guardia', 'ASC');
    
/*****************************************FIN****StoreGuardia*****************************************/


/******************************************INICIO**colModelGuardia******************************************/     
	
    var colModelGuardia = new Ext.grid.ColumnModel([
        {id:'co_guardia',header: "Guardia", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        {header: "Nombre Guardia", width: 250, sortable: true, locked:false, dataIndex: 'nb_guardia'},
        {header: "Numero", width: 50, sortable: true, locked:false, dataIndex: 'nu_numero'},
        {header: "Descripcion", width: 250, sortable: true, locked:false, dataIndex: 'tx_descripcion', renderer:descripcion},
        {header: "Hora de Inicio", width: 150, sortable: true, locked:false, dataIndex: 'nu_inicio_guardia'},
        {header: "Hora Fin", width: 150, sortable: true, locked:false, dataIndex: 'nu_fin_guardia'},
        ]);
	
/******************************************FIN****colModelGuardia******************************************/     

/******************************************INICIO**StoreCliente******************************************/     
   var grid =new Ext.grid.GridPanel({
					id: 'gd_guardia',
					name:'gd_guardia',
					store: storeGuardia,
					cm: colModelGuardia,
					stripeRows: true,
					//plugins: expanderPersona,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					width:700,
					title:'Lista de Guardia',
					tools: [{id:'save'},{id:'print'}],
					border: true,
					bbar: new Ext.PagingToolbar({
					store: storeGuardia,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });


storeGuardia.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_guardia.php"}});
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
