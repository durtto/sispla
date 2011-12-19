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


/******************************************INICIO**StoreProveedor******************************************/     
	
  var storeProveedor = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_localizacion.php',
		remoteSort : true,
		root: 'planeslocalizacion',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "proveedor", interfaz: '../interfaz/interfaz_plan_localizacion.php'},
		idProperty: 'co_proveedor',
        fields: [
        		{name: 'co_plan_localizacion'},
        		{name: 'co_proveedor'},
        		{name: 'nb_proveedor'},
        		{name: 'di_oficina'},
        		{name: 'tx_servicio_prestado'},
        		{name: 'co_contacto'},
        		{name: 'nb_contacto'},
		        {name: 'tx_apellido'},
		        {name: 'tx_telefono'},
		        {name: 'tx_correo_electronico'},
        		{name: 'resp'}]
        });
    storeProveedor.setDefaultSort('co_plan_localizacion', 'ASC');
    
/*****************************************FIN****StoreProveedor*****************************************/

var expanderContacto = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Nombre:</b> {nb_contacto}</p>',
            '<p><b>Apellido:</b> {tx_apellido}</p>',
            '<p><b>Telefono:</b> {tx_telefono}</p>',
            '<p><b>Correo Electronico:</b> {tx_correo_electronico}</p>'
        )
    });

/******************************************INICIO**colModelProveedor******************************************/     
   
    var colModelProveedor = new Ext.grid.ColumnModel([
    	expanderContacto,
        {id:'co_proveedor',header: "Proveedor", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Nombre", width: 200, sortable: true, locked:false, dataIndex: 'nb_proveedor'},
        {header: "Direccion", width: 300, sortable: true, locked:false, dataIndex: 'di_oficina'},
        {header: "Servicio que Presta", width: 450, sortable: true, locked:false, dataIndex: 'tx_servicio_prestado', renderer: servicio},
      	//{header: "Contacto", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_contacto'},
      	//{header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		//{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
       	// {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 120, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
      
      ]);
	
/******************************************FIN****colModelProveedor******************************************/     
    function servicio(tx_servicio_prestado,servicio){  
   servicio = 'style="white-space:normal"';  
   return tx_servicio_prestado;  
   } 
/******************************************FIN****colModelProveedor******************************************/ 
var storePersona = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_localizacion.php',
		remoteSort : true,
		root: 'planeslocalizacion',
		baseParams: {start:0, limit:50, accion: "persona", interfaz: "../interfaz/interfaz_plan_localizacion.php"},
        totalProperty: 'total',
		idProperty: 'co_indicador',
        fields: [
        		{name: 'co_plan_localizacion'},
        		{name: 'co_indicador'},
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
    storePersona.setDefaultSort('co_plan_localizacion', 'ASC');


   var colModelPersona = new Ext.grid.ColumnModel([
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
      ]);



/******************************************INICIO**StorePersona******************************************/     
      
      var storeEquipo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_localizacion.php',
		remoteSort : true,
		root: 'planeslocalizacion',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "equipo", interfaz: "../interfaz/interfaz_plan_localizacion.php"},
		idProperty: 'co_equipo_continuidad',
        fields: [{name: 'co_equipo_continuidad'},
        		{name: 'co_plan_localizacion'},
        		{name: 'co_indicador'},
         		{name: 'nu_cedula'},
		        {name: 'nb_persona'},
		        {name: 'tx_apellido'},
		        {name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
        	    {name: 'resp'}]
        });
    storeEquipo.setDefaultSort('co_plan_localizacion', 'ASC');
    
/*****************************************FIN****StorePersona*****************************************/




/******************************************INICIO**colModelPersona******************************************/     
    var colModelEquipo = new Ext.grid.ColumnModel([
        {id:'co_equipo_continuidad', hidden: true, header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_equipo_continuidad'},
        {header: "co_indicador", width: 150, sortable: true, locked:false, dataIndex: 'co_indicador'},
        //{header: "Cedula", width: 150, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 150, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        //{header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        //{header: "Departamento", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        //{header: "Departamento", width: 200, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
     	//{header: "Rol", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol'},
        //{header: "Rol", width: 200, sortable: true, locked:false, dataIndex: 'nb_rol'},      
      	{header: "Responsabilidad", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Responsabilidad", width: 180, dataIndex: 'nb_rol_resp'},
      	//{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        //{header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	//{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        //{header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},      
      ]);


/******************************************INICIO**StoreDirectorio******************************************/     
  
      
  var storeDirectorio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_localizacion.php',
		remoteSort : true,
		root: 'planeslocalizacion',
        baseParams: {start:0, limit:50, accion: "directorio", interfaz: "../interfaz/interfaz_plan_localizacion.php"},
        totalProperty: 'total',
		idProperty: 'co_directorio',
        fields: [{name: 'co_directorio'},
       			 {name: 'co_plan_localizacion'},
		        {name: 'nb_directorio'},
		        {name: 'nb_tipo_directorio'},
		        {name: 'nu_telefono'},
		        {name: 'resp'}]
        });
    storeDirectorio.setDefaultSort('co_plan_localizacion', 'ASC');
    
/*****************************************FIN****StoreDirectorio*****************************************/
/******************************************INICIO**colModelDirectorio******************************************/     
    var colModelDirectorio = new Ext.grid.ColumnModel([
        {id:'co_directorio',header: "Directorio", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_directorio'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_directorio'},
        {header: "Tipo Directorio", width: 150, sortable: true, locked:false, dataIndex: 'nb_tipo_directorio'},
        {header: "N&uacute;mero Telefonico", width: 150, sortable: true, locked:false, dataIndex: 'nu_telefono'},
  
      ]);
      
/******************************************FIN****colModelDirectorio******************************************/     



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
   	
        {id:'co_plan_localizacion',header: "Plan Localizacion",hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_plan_localizacion', renderer:plan},
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
			iconCls: 'consultar',
			waitMsg: 'Consultando...',
			handler: function(){
							storePersona.load({params:{'accion': 'persona', "plan": Ext.getCmp("co_plan_localizacion").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
							})
							storeProveedor.load({params:{'accion': 'proveedor', "plan": Ext.getCmp("co_plan_localizacion").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
							})
							
							storeDirectorio.load({params:{'accion': 'directorio', "plan": Ext.getCmp("co_plan_localizacion").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
							})
							
							storeEquipo.load({params:{'accion': 'equipo', "plan": Ext.getCmp("co_plan_localizacion").getValue(),
										"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
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
						width: 780,
						//layout: 'fit',
						bodyStyle:'padding:5px; background-color: #f1f1f1;',
						items: [{
								title: 'Personas',
								id: 'tabpersonas',
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
										tools: [{id:'save'},{id:'print'}],
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
									},{
								title: 'Proveedores',
								id: 'tabproveedores',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_proveedor',
						                store: storeProveedor,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelProveedor,
						                plugins: expanderContacto,
						                height: 250,
						                iconCls: 'icon-grid',
						                tools: [{id:'save'},{id:'print'}],
										title:'Lista de Proveedores',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storeProveedor,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
									}]
									},{
								title: 'Directorios',
								id: 'tabdirectorios',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_directorio',
						                store: storeDirectorio,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
					                	tools: [{id:'save'},{id:'print'}],
						                cm: colModelDirectorio,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Directorios',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storeDirectorio,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
									}]
									},{
								title: 'Equipos',
								id: 'tabequipos',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_equipo',
						                store: storeEquipo,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelEquipo,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Equipos',
										tools: [{id:'save'},{id:'print'}],
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storeEquipo,
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
