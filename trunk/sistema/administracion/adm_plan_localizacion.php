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
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:800,
			buttonAlign:'center',
			title: 'Plan Localizacion',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					border:false,
					items: [{
                        fieldLabel: 'Numero de Plan Localizacion',
						xtype:'numberfield',
						id: 'co_plan_localizacion',
                        name: 'co_plan_localizacion',
                        hidden: true,
						hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Fecha de Elaboracion',
						xtype:'datefield',
						vtype:'validos',
						id: 'fe_elaboracion',
                        name: 'fe_elaboracion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
			}]
			},{
				width: 800,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_plan_localizacion").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			iconCls: 'save',
			tooltip:'Guardar Plan',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_planlocalizacion").getForm().getValues(false);	
						campos = verifObligatorios(camposForm, camposReq);
						if(campos != ''){		
							Ext.MessageBox.show({
								title: 'ATENCION',
								msg: 'No se pueden guardar los datos. <br />Faltan los siguientes campos obligatorios por llenar: <br /><br />'+campos,
								buttons: Ext.MessageBox.OK,
								icon: Ext.MessageBox.WARNING
							});
						}
						else
						{
							if(nuevo)						
								storePlanLocalizacion.baseParams = {'accion': 'insertar'};
							else
								storePlanLocalizacion.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_plan_localizacion" : "'+Ext.getCmp("co_plan_localizacion").getValue()+'", ';
							columnas += '"fe_elaboracion" : "'+convFecha(Ext.getCmp("fe_elaboracion").getValue())+'"}';
							storePlanLocalizacion.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_plan_localizacion" : "'+Ext.getCmp("co_plan_localizacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
										callback: function () {
										if(storePlanLocalizacion.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePlanLocalizacion.getAt(0).data.resp, 
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							}});
							storePlanLocalizacion.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_plan_localizacion.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Grupo',
			disabled: true,
			handler: function(){
										storePlanLocalizacion.baseParams = {'accion': 'eliminar'};
										storePlanLocalizacion.load({params:{
												"condiciones": '{ "co_plan_localizacion" : "'+Ext.getCmp("co_planlocalizacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
										callback: function () {
										if(storePlanLocalizacion.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePlanLocalizacion.getAt(0).data.resp,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							}})}
			}]
			},{
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


/****************************************************************************************************/
	
	Ext.getCmp("gd_planlocalizacion").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_plan_localizacion").focus();
		nroReg=rowIdx;
		
});

/********************************************************************************************************/
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