<html>
<head>
<title>Plan de Localizacion</title>
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

/******************************************INICIO**StoreAlojamiento******************************************/     
	
  var storeAlojamiento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_alojamiento.php',
		remoteSort : true,
		root: 'alojamientos',
        totalProperty: 'total',
		idProperty: 'co_alojamiento',
        fields: [{name: 'co_alojamiento'},
        		{name: 'nb_establecimiento'},
        		{name: 'di_ubicacion'},
        		{name: 'bo_hotel'},
        		{name: 'bo_posada'},
        		{name: 'tx_telefono'},
        		{name: 'resp'}]
        });
    storeAlojamiento.setDefaultSort('co_alojamiento', 'ASC');
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
	var sm1 = new Ext.grid.CheckboxSelectionModel();
    var colModelAlojamiento = new Ext.grid.ColumnModel([
    	expanderAlojamiento,
        {id:'co_alojamiento',header: "Alojamiento", hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_alojamiento'},
        {header: "Nombre", width: 340, sortable: true, locked:false, dataIndex: 'nb_establecimiento'},
        //{header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'di_ubicacion'},
        //{header: "Hotel", width: 100, sortable: true, locked:false, dataIndex: 'bo_hotel', renderer: hotel},
        //{header: "Posada", width: 100, sortable: true, locked:false, dataIndex: 'bo_posada', renderer: hotel},
        //{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        sm1,
      ]);
	
/******************************************FIN****colModelAlojamiento******************************************/     


/******************************************INICIO**StoreTransporte******************************************/     

  var storeTransporte = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_transporte.php',
		remoteSort : true,
		root: 'transportes',
        totalProperty: 'total',
		idProperty: 'co_transporte',
        fields: [{name: 'co_transporte'},
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
    storeTransporte.setDefaultSort('co_transporte', 'ASC');
    
/*****************************************FIN****StoreTransporte*****************************************/
 
  var expanderTransporte = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Elaboracion:</b> {fe_elaboracion}</p>'
        )
    });
	
/******************************************INICIO**colModelTransporte******************************************/     
    var sm2 = new Ext.grid.CheckboxSelectionModel();
    var colModelTransporte = new Ext.grid.ColumnModel([
    	expanderTransporte,
        {id:'co_transporte',header: "Transporte", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_transporte'},
        {header: "Elaboracion", width: 340, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
        // {header: "Vehiculo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
		//{header: "Modelo", width: 180, sortable: true, locked:false, dataIndex: 'tx_modelo'},
		//{header: "Unidad", width: 160, sortable: true, locked:false, dataIndex: 'tx_unidad'},
       sm2,
      ]);
	
/******************************************FIN****colModelTransporte******************************************/     

/******************************************INICIO**StoreAlimentacion******************************************/     
	
  var storeAlimentacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_alimentacion.php',
		remoteSort : true,
		root: 'alimentos',
        totalProperty: 'total',
		idProperty: 'co_alimentacion',
        fields: [{name: 'co_alimentacion'},
        		{name: 'ca_desayuno'},		
        		{name: 'ca_almuerzo'},		
        		{name: 'ca_cena'},	
        		{name: 'ca_persona'},
        		{name: 'resp'}]
        });
    storeAlimentacion.setDefaultSort('co_alimentacion', 'ASC');
    
/*****************************************FIN****StoreAlimentacion*****************************************/
 
  var expanderAlimentacion = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Desayunos:</b> {ca_desayuno}</p>',
            '<p><b>Almuerzos:</b> {ca_almuerzo}</p>',
            '<p><b>Cenas:</b> {ca_cena}</p>',
            '<p><b>Personas:</b> {ca_persona}</p>'
        )
    });

/******************************************INICIO**colModelAlimentacion******************************************/     
	var sm3 = new Ext.grid.CheckboxSelectionModel();
    var colModelAlimentacion = new Ext.grid.ColumnModel([
    	expanderAlimentacion,
        {id:'co_alimentacion',header: "Codigo de Gestion", width: 340, sortable: true, locked:false, dataIndex: 'co_alimentacion'},
        //{header: "Nro de Desayunos", width: 125, sortable: true, locked:false, dataIndex: 'ca_desayuno'},
        //{header: "Nro de Almuerzos", width: 125, sortable: true, locked:false, dataIndex: 'ca_almuerzo'},
        //{header: "Nro de Cenas", width: 115, sortable: true, locked:false, dataIndex: 'ca_cena'},
        //{header: "Cantidad de Personas", width: 144, sortable: true, locked:false, dataIndex: 'ca_persona'},
        sm3,
      ]);
	
/******************************************FIN****colModelAlimentacion******************************************/     

/******************************************INICIO**StorePlanLocalizacion******************************************/     
	
  var storePlanLocalizacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_localizacion.php',
		remoteSort : true,
		root: 'planeslocalizacion',
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
        {header: "Elaboracion", width: 360, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
      ]);
	
/******************************************FIN****colModelPlanLocalizacion******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_planlocalizacion',
        frame: true,
		labelAlign: 'center',
        title: 'Plan Localizacion',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:820,
		items: [{
					layout:'column',
					items:[{
					columnWidth:.50,
					border:false,
					width:400,
	                xtype: 'grid',
					id: 'gd_planlocalizacion',
	                store: storePlanLocalizacion,
	                stripeRows: true,
                	iconCls: 'icon-grid',
	                cm: colModelPlanLocalizacion,
	                height: 250,
	                iconCls: 'icon-grid',
	                //plugins: expanderVehiculo,
					title:'Lista de Plan Localizacion',
	                border: true,
	                listeners: {
	                    viewready: function(g) {
	                    }
	                },
					bbar: new Ext.PagingToolbar({
					store: storePlanLocalizacion,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
	            },{
					columnWidth:.50,
					border:true,
	                xtype: 'grid',
					id: 'gd_alimentacion',
	                store: storeAlimentacion,
	                sm: sm3,
	                cm: colModelAlimentacion,
	                stripeRows: true,
                	iconCls: 'icon-grid',
	                height: 250,
					title:'Gestion de Alimentacion',
					plugins: expanderAlimentacion,
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
					layout:'column',
					items:[{
					columnWidth:.50,
					border:false,
					width:400,
	                xtype: 'grid',
					id: 'gd_transporte',
					stripeRows: true,
                	iconCls: 'icon-grid',
                	sm: sm2,
	                store: storeTransporte,
	                cm: colModelTransporte,
	                height: 250,
	                iconCls: 'icon-grid',
	                plugins: expanderTransporte,
					title:'Plan de Transporte',
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
	            },{
					columnWidth:.50,
					border:true,
	                xtype: 'grid',
					id: 'gd_alojamiento',
	                store: storeAlojamiento,
	              	sm: sm1,
	                stripeRows: true,
                	iconCls: 'icon-grid',
	                cm: colModelAlojamiento,
	                height: 250,
					title:'Gestion de Alojamiento',
					plugins: expanderAlojamiento,
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
			
		}],
        
    });


storeAlojamiento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alojamiento.php"}});
storeAlimentacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alimentacion.php"}});
storeTransporte.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_transporte.php"}});	
storePlanLocalizacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_plan_localizacion.php"}});
gridForm.render('form');

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
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
</body>
</html>