<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Necesidad</title>
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

/******************************************INICIO**StoreNecesidad******************************************/     

  var storeNecesidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_necesidad.php',
		remoteSort : true,
		root: 'necesidades',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_necesidad.php"},
        totalProperty: 'total',
		idProperty: 'co_necesidad',
        fields: [{name: 'co_necesidad'},
		        {name: 'tx_necesidad_detectada'},
		        {name: 'ca_requerida'},
		        {name: 'tx_justificacion'},
		        {name: 'tx_beneficio'},
		        {name: 'fe_annio'},
		        {name: 'nb_servicio'},
		        {name: 'resp'}]
        });
    storeNecesidad.setDefaultSort('co_necesidad', 'ASC');
    
/*****************************************FIN****StoreNecesidad*****************************************/

	
/******************************************INICIO**colModelNecesidad******************************************/     

    var colModelNecesidad = new Ext.grid.ColumnModel([
        {id:'co_necesidad',header: "Necesidad", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_necesidad'},
        {header: "Servicio", width: 120, sortable: true, locked:false, dataIndex: 'nb_servicio'},
        {header: "Necesidad Detectada", width: 150, sortable: true, locked:false, dataIndex: 'tx_necesidad_detectada'},
        {header: "Cantidad Requerida", width: 140, sortable: true, locked:false, dataIndex: 'ca_requerida'},      
        {header: "Justificaci&oacute;n", width: 145, sortable: true, locked:false, dataIndex: 'tx_justificacion',renderer: this.showJustificacion},
        {header: "Beneficios", width: 145, sortable: true, locked:false, dataIndex: 'tx_beneficio'},
        {header: "A&ntilde;o Actual", width: 98, sortable: true, locked:false, dataIndex: 'fe_annio', renderer:convFechaDMY},
      ]);
      
/******************************************FIN****colModelNecesidad******************************************/     


/******************************************INICIO**StoreCliente******************************************/     
   var grid =new Ext.grid.GridPanel({
					id: 'gd_necesidad',
					name:'gd_necesidad',
					store: storeNecesidad,
					cm: colModelNecesidad,
					stripeRows: true,
					//plugins: expanderPersona,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					width:600,
					title:'Lista de Necesidad',
					tools: [{id:'save'},{id:'print'}],
					border: true,
					bbar: new Ext.PagingToolbar({
					store: storeNecesidad,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });


storeNecesidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_necesidad.php"}});
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
