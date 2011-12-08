<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Plan de logistica</title>
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


/******************************************INICIO**StorePlanLogistica******************************************/     
	
  var storePlanLogistica = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_logistica.php',
		remoteSort : true,
		root: 'planeslogistica',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_plan_logistica.php'},
		idProperty: 'co_plan_logistica',
        fields: [{name: 'co_plan_logistica'},
       			{name: 'fe_elaboracion'},
        		{name: 'resp'}]
        });
    storePlanLogistica.setDefaultSort('co_plan_logistica', 'ASC');
    
/*****************************************FIN****StorePlanLogistica*****************************************/


/******************************************INICIO**colModelPlanLogistica******************************************/     

   var colModelPlanLogistica = new Ext.grid.ColumnModel([
   	
        {id:'co_plan_logistica',header: "Plan Logistica",hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_plan_logistica'},
        {header: "Elaboracion", width: 360, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
      ]);
	
/******************************************FIN****colModelPlanLogistica******************************************/     

/******************************************INICIO**StoreAlimentacion******************************************/     

  var storeAlimentacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_logistica.php',
		remoteSort : true,
		root: 'planeslogistica',
		baseParams: {start:0, limit:50, accion: "alimentacion", interfaz: '../interfaz/interfaz_plan_logistica.php'},
        totalProperty: 'total',
		idProperty: 'co_alimentacion',
        fields: [{name: 'co_plan_logistica'},
        		{name: 'co_alimentacion'},
        		{name: 'ca_desayuno'},		
        		{name: 'ca_almuerzo'},		
        		{name: 'ca_cena'},	
        		{name: 'ca_persona'},
        		{name: 'resp'}]
        });
    storeAlimentacion.setDefaultSort('co_plan_logistica', 'ASC');

/*****************************************FIN****StoreAlimentacion*****************************************/


/******************************************INICIO**colModelAlimentacion******************************************/     
	
    var colModelAlimentacion = new Ext.grid.ColumnModel([
    	{id:'co_alimentacion',header: "Codigo de Gestion", width: 680, sortable: true, locked:false, dataIndex: 'co_alimentacion'},
        {header: "Nro de Desayunos", width: 125, sortable: true, locked:false, dataIndex: 'ca_desayuno'},
        {header: "Nro de Almuerzos", width: 125, sortable: true, locked:false, dataIndex: 'ca_almuerzo'},
        {header: "Nro de Cenas", width: 115, sortable: true, locked:false, dataIndex: 'ca_cena'},
        {header: "Cantidad de Personas", width: 144, sortable: true, locked:false, dataIndex: 'ca_persona'},
      ]);

/******************************************FIN****colModelAlimentacion******************************************/     


/******************************************INICIO**StoreAlojamiento******************************************/     
	
  var storeAlojamiento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_logistica.php',
		remoteSort : true,
		root: 'planeslogistica',
		baseParams: {start:0, limit:50, accion: "alojamiento", interfaz: '../interfaz/interfaz_plan_logistica.php'},
        totalProperty: 'total',
		idProperty: 'co_alojamiento',
        fields: [{name: 'co_plan_logistica'},
        		{name: 'co_alojamiento'},
        		{name: 'nb_establecimiento'},
        		{name: 'di_ubicacion'},
        		{name: 'bo_hotel'},
        		{name: 'bo_posada'},
        		{name: 'tx_telefono'},
        		{name: 'resp'}]
        });
    storeAlojamiento.setDefaultSort('co_plan_logistica', 'ASC');
    
/*****************************************FIN****StoreAlojamiento*****************************************/

  var expanderAlojamiento  = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Direccion:</b> {di_ubicacion}</p>',
            '<p><b>Hotel:</b> {bo_hotel}</p>',
            '<p><b>Posada:</b> {bo_posada}</p>',
            '<p><b>Telefono:</b> {tx_telefono}</p>'
        )
    });

/******************************************INICIO**colModelAlojamiento******************************************/     
	
    var colModelAlojamiento = new Ext.grid.ColumnModel([
    	expanderAlojamiento,
        {id:'co_alojamiento',header: "Alojamiento", hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_alojamiento'},
        {header: "Nombre", width: 680, sortable: true, locked:false, dataIndex: 'nb_establecimiento'},
        //{header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'di_ubicacion'},
        //{header: "Hotel", width: 100, sortable: true, locked:false, dataIndex: 'bo_hotel', renderer: hotel},
        //{header: "Posada", width: 100, sortable: true, locked:false, dataIndex: 'bo_posada', renderer: hotel},
        //{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
      ]);
	
/******************************************FIN****colModelAlojamiento******************************************/     

/******************************************INICIO**StoreTransporte******************************************/     

  var storeTransporte = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_logistica.php',
		remoteSort : true,
		root: 'planeslogistica',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "transporte", interfaz: '../interfaz/interfaz_plan_logistica.php'},
		idProperty: 'co_transporte',
        fields: [{name: 'co_plan_logistica'},
        		{name: 'co_transporte'},
       			{name: 'fe_elaboracion'},
       			{name: 'co_linea'},
       			{name: 'nb_linea'},
        		{name: 'tx_telefono'},
        		{name: 'di_oficina'},
				{name: 'co_vehiculo'},
				{name: 'tx_placa'},
		        {name: 'tx_marca'},
		        {name: 'tx_modelo'},
		        {name: 'tx_unidad'},
        		{name: 'resp'}]
        });
    storeTransporte.setDefaultSort('co_plan_logistica', 'ASC');
    
/*****************************************FIN****StoreTransporte*****************************************/

/******************************************INICIO**colModelTransporte******************************************/     
    
    var colModelTransporte = new Ext.grid.ColumnModel([
        {id:'co_transporte',header: "Transporte", width: 100, hidden:false, sortable: true, locked:false, dataIndex: 'co_transporte'},
        {header: "Elaboracion", width: 100, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
        //{header: "Vehiculo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
		//{header: "Modelo", width: 160, sortable: true, locked:false, dataIndex: 'tx_modelo'},
		//{header: "Unidad", width: 160, sortable: true, locked:false, dataIndex: 'tx_unidad'},

      ]);
	
/******************************************FIN****colModelTransporte******************************************/     

	
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

		var grid = new Ext.FormPanel({
		id:'frm_planlogistica',
		//labelAlign: 'right',
		labelWidth: 100, // label settings here cascade unless overridden
		frame:true,
		title: ':: Plan de localizaci&oacute;n ::',
		bodyStyle:'padding:5px',
		width: 820,
		layout: 'fit',
		items: [{
				xtype:'fieldset',	
				autoHeight:true,
				border: false,
				items: [{
						xtype:'combo',
						fieldLabel: 'Plan Logistica',
		         		store: new Ext.data.JsonStore({
						url: '../interfaz/interfaz_combo.php',
						   root: 'Resultados',
						   idProperty: 'co_plan_logistica',
						   baseParams: {accion:'plan_logistica'},
						   fields:['co_plan_logistica','fe_elaboracion']
						  }),
						id:'co_plan_logistica',
						valueField:'co_plan_logistica',
				        displayField:'fe_elaboracion',
				        typeAhead: true,
				        allowBlank: false,
				        mode: 'remote',
				        forceSelection: true,
				        triggerAction: 'all',
				        emptyText:'Selecione',
				        selectOnFocus:true
         				}],
         		width: 200,  
				buttonAlign:'center',
				//layout: 'fit',
				buttons: [{
			text: 'Consultar', 
			id: 'btnConsultar',
			tooltip:'Consultar Plan',
			waitMsg: 'Consultando...',
			handler: function(){
							storeAlimentacion.load({params:{'accion': 'alimentacion', "plan": Ext.getCmp("co_plan_logistica").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_logistica.php"},
							})
							storeAlojamiento.load({params:{'accion': 'alojamiento', "plan": Ext.getCmp("co_plan_logistica").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_logistica.php"},
							})
							
							storeTransporte.load({params:{'accion': 'transporte', "plan": Ext.getCmp("co_plan_logistica").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_logistica.php"},
							})
							
							}
			}]},{
				xtype:'fieldset',	
				autoHeight:true,
				border: false,
				items: [{			
						xtype: 'tabpanel',
						id: 'tabPanel',
						disabled: false,
						resizeTabs: true,
						enableTabScroll: true,
						deferredRender: false,
						layoutOnTabChange: true,
						activeTab: 0,
						width: 720,
						//layout: 'fit',
						bodyStyle:'padding:5px; background-color: #f1f1f1;',
						items: [{
								title: 'Alimentacion',
								id: 'tabalimentacion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_alimentacion',
						                store: storeAlimentacion,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelAlimentacion,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Alimentacion',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storeAlimentacion,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
									}]
									},{
								title: 'Alojamiento',
								id: 'tabalojamiento',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_alojamiento',
						                store: storeAlojamiento,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelAlojamiento,
						                //plugins: expanderContacto,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Alojamiento',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storeAlojamiento,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
									}]
									},{
								title: 'Transporte',
								id: 'tabdirectorios',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_directorio',
						                store: storeTransporte,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelTransporte,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Transporte',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storeTransporte,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
									}]
									}]
							}]
							}]

		});

 

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
