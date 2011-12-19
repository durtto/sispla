<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Respaldo</title>
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

/******************************************INICIO**StoreRespaldo******************************************/     

  var storeRespaldo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_respaldo.php',
		remoteSort : true,
		root: 'respaldos',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_respaldo.php'},
		idProperty: 'co_respaldo',
        fields: [{name: 'co_respaldo'},
        		{name: 'nu_veces_al_dia'},
        		{name: 'tx_dias_semana'},
		        {name: 'nu_tiempo_retencion_data'},
		        {name: 'tx_descripcion_data'},
		        {name: 'fe_ultimo_respaldo'},
		        {name: 'tx_ubicacion_logica_fisica'},
		        {name: 'co_activo'},
		        {name: 'nb_activo'},
		        {name: 'co_tipo_respaldo'},
		        {name: 'nb_tipo_respaldo'},
		        {name: 'resp'}]
        });
    storeRespaldo.setDefaultSort('co_respaldo', 'ASC');
    
/*****************************************FIN****StoreRespaldo*****************************************/


/******************************************INICIO**colModelRespaldo******************************************/     
    
    var colModelRespaldo = new Ext.grid.ColumnModel([
        {id:'co_respaldo',header: "Respaldo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_respaldo'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
        {header: "Veces por dia", width: 100, sortable: true, locked:false, dataIndex: 'nu_veces_al_dia'},
        {header: "Dias de semana", width: 100, sortable: true, locked:false, dataIndex: 'tx_dias_semana'},      
        {header: "Retencion de Data", width: 100, sortable: true, locked:false, dataIndex: 'nu_tiempo_retencion_data'},
        {header: "Descripcion", width: 100, sortable: true, locked:false, dataIndex: 'tx_descripcion_data'},
        {header: "Ultimo Respaldo", width: 100, sortable: true, locked:false, dataIndex: 'fe_ultimo_respaldo'},
        {header: "Ubicacion Fisica", width: 100, sortable: true, locked:false, dataIndex: 'tx_ubicacion_logica_fisica'},        
		{header: "Activo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Respaldo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_tipo_respaldo'},
        {header: "Tipo Respaldo", width: 100, hidden: false, sortable: true, locked:false, dataIndex: 'nb_tipo_respaldo'},
      ]);
	
/******************************************FIN****colModelRespaldo******************************************/     



/******************************************INICIO**StoreCliente******************************************/     
   var grid =new Ext.grid.GridPanel({
					id: 'gd_respaldo',
					name:'gd_respaldo',
					store: storeRespaldo,
					cm: colModelRespaldo,
					stripeRows: true,
					//plugins: expanderPersona,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					//width:670,
					title:'Lista de Usuario',
					border: true,
					bbar: new Ext.PagingToolbar({
					store: storeRespaldo,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });


storeRespaldo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_respaldo.php"}});
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
