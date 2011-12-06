<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Plan de localizacion</title>
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
 var winPersona;

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




var storePersona = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_persona.php',
		remoteSort : true,
		root: 'personas',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_persona.php"},
        totalProperty: 'total',
		idProperty: 'co_indicador',
        fields: [{name: 'co_indicador'},
         		{name: 'nu_cedula'},
		        {name: 'nb_persona'},
		        {name: 'tx_apellido'},
		        {name: 'di_oficina'},
		        {name: 'tx_telefono_oficina'},
		        {name: 'tx_correo_electronico'},
		        {name: 'di_habitacion'},
		        {name: 'tx_telefono_habitacion'},
		        {name: 'tx_telefono_personal'},
		        {name: 'co_departamento'},
		        {name: 'nb_departamento'},
		        {name: 'co_rol'},
		        {name: 'nb_rol'},
		        {name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
        		{name: 'co_grupo'},
        		{name: 'nb_grupo'},
        		{name: 'co_guardia'},			
        		{name: 'nb_guardia'},
		        {name: 'resp'}]
        });
    storePersona.setDefaultSort('co_indicador', 'ASC');
   var expanderPersona = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>C&eacute;dula:</b> {nu_cedula}</p>',
            '<p><b>Apellido:</b> {di_oficina}</p>',
            '<p><b>Tel&eacute;fono:</b> {tx_telefono_oficina}</p>',
            '<p><b>Correo Electr&oacute;nico:</b> {tx_correo_electronico}</p>',
            '<p><b>Rol:</b> {nb_rol}</p>',
            '<p><b>Grupo:</b> {nb_grupo}</p>',
            '<p><b>Guardia:</b> {nb_guardia}</p>'
        )
    });

   var sm1 = new Ext.grid.CheckboxSelectionModel();
//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelPersona = new Ext.grid.ColumnModel([
    	expanderPersona,
        {id:'co_indicador',header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "C&eacute;dula", width: 100, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 110, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 120, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        //{header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        //{header: "Departamento", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        //{header: "Departamento", width: 100, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
     	//{header: "Rol", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol'},
        //{header: "Rol", width: 100, sortable: true, locked:false, dataIndex: 'nb_rol'},      
      	//{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        //{header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	//{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        //{header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},
      sm1,
      ]);

/******************************************INICIO**StorePlanLocalizacion******************************************/     
	
  var storePlanLocalizacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_localizacion.php',
		remoteSort : true,
		root: 'planeslocalizacion',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_plan_localizacion.php"},
        totalProperty: 'total',
		idProperty: 'co_plan_localizacion',
        fields: [{name: 'co_plan_localizacion'},
       			{name: 'fe_elaboracion'},
        		{name: 'resp'}]
        });
    storePlanLocalizacion.setDefaultSort('co_plan_localizacion', 'ASC');
    
/*****************************************FIN****StorePlanLocalizacion*****************************************/

/******************************************INICIO**colModelPlanLocalizacion******************************************/     

   var colModelPlanLocalizacion = new Ext.grid.ColumnModel([
   	
        {id:'co_plan_localizacion',header: "Plan Localizacion",hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_plan_localizacion'},
        {header: "Fecha de Elaboraci&oacute;n", width: 150, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
      ]);
	
/******************************************FIN****colModelPlanLocalizacion******************************************/     

		var grid = new Ext.FormPanel({
		id:'frm_planlocalizacion',
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
						fieldLabel: 'Plan Localizacion',
		         		store: new Ext.data.JsonStore({
						url: '../interfaz/interfaz_combo.php',
						   root: 'Resultados',
						   idProperty: 'co_plan_localizacion',
						   baseParams: {accion:'plan_localizacion'},
						   fields:['co_plan_localizacion','fe_elaboracion']
						  }),
						id:'co_plan_localizacion',
						valueField:'co_plan_localizacion',
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
										storePlanLocalizacion.load({params:{'accion': 'refrescar', "plan": Ext.getCmp("co_plan_localizacion").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_localizacion.php"},

							
							})}
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
								title: 'Planes',
								id: 'tablocalizacion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_persona',
						                store: storePersona,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelPersona,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Personas',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storePersona,
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
