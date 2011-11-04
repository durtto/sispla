var nuevo;
var winAlimentacion;
var winAlojamiento;
var winProveedor;
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
        {header: "Elaboracion", width: 680, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
      ]);

/******************************************FIN****colModelPlanLocalizacion******************************************/     

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
        {id:'co_alimentacion',header: "Codigo de Gestion", width: 680, sortable: true, locked:false, dataIndex: 'co_alimentacion'},
        //{header: "Nro de Desayunos", width: 125, sortable: true, locked:false, dataIndex: 'ca_desayuno'},
        //{header: "Nro de Almuerzos", width: 125, sortable: true, locked:false, dataIndex: 'ca_almuerzo'},
        //{header: "Nro de Cenas", width: 115, sortable: true, locked:false, dataIndex: 'ca_cena'},
        //{header: "Cantidad de Personas", width: 144, sortable: true, locked:false, dataIndex: 'ca_persona'},
        sm3,
      ]);

/******************************************FIN****colModelAlimentacion******************************************/     

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
        {header: "Nombre", width: 680, sortable: true, locked:false, dataIndex: 'nb_establecimiento'},
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

/******************************************INICIO**colModelTransporte******************************************/     
    
    var sm3 = new Ext.grid.CheckboxSelectionModel();
    var colModelTransporte = new Ext.grid.ColumnModel([
        {id:'co_transporte',header: "Transporte", width: 100, hidden:false, sortable: true, locked:false, dataIndex: 'co_transporte'},
        {header: "Elaboracion", width: 100, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
        //{header: "Vehiculo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
		//{header: "Modelo", width: 160, sortable: true, locked:false, dataIndex: 'tx_modelo'},
		//{header: "Unidad", width: 160, sortable: true, locked:false, dataIndex: 'tx_unidad'},
      sm3,
      ]);
	
/******************************************FIN****colModelTransporte******************************************/     
/******************************************INICIO**StoreProveedor******************************************/     
	
  var storeProveedor = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proveedor.php',
		remoteSort : true,
		root: 'proveedores',
        totalProperty: 'total',
		idProperty: 'co_proveedor',
        fields: [{name: 'co_proveedor'},
        		{name: 'nb_proveedor'},
        		{name: 'di_oficina'},
        		{name: 'tx_telefono_oficina'},
        		{name: 'tx_url_pagina'},
        		{name: 'co_contacto'},
        		{name: 'nb_contacto'},
		        {name: 'tx_apellido'},
		        //{name: 'di_oficina'},
		        {name: 'tx_telefono_oficina'},
		        {name: 'tx_correo_electronico'},
		        {name: 'di_habitacion'},
		        {name: 'tx_telefono_habitacion'},
        		{name: 'resp'}]
        });
    storeProveedor.setDefaultSort('co_proveedor', 'ASC');
    
/*****************************************FIN****StoreProveedor*****************************************/

var expanderContacto = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Nombre:</b> {nb_contacto}</p>',
            '<p><b>Apellido:</b> {tx_apellido}</p>',
            '<p><b>Direccion:</b> {di_habitacion}</p>',
            '<p><b>Telefono:</b> {tx_telefono_oficina}</p>',
            '<p><b>Correo Electronico:</b> {tx_correo_electronico}</p>',
            '<p><b>Telefono Habitacion:</b> {tx_telefono_habitacion}</p>'
        )
    });

/******************************************INICIO**colModelProveedor******************************************/     
   
    var colModelProveedor = new Ext.grid.ColumnModel([
    	expanderContacto,
        {id:'co_proveedor',header: "Proveedor", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_proveedor'},
        {header: "Direccion", width: 150, sortable: true, locked:false, dataIndex: 'di_oficina'},
        {header: "Telefono", width: 150, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Pagina Web", width: 150, sortable: true, locked:false, dataIndex: 'tx_url_pagina'},	
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

/******************************************INICIO**StoreContacto******************************************/     
      
  var storeContacto = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_contacto_proveedor.php',
		remoteSort : true,
		root: 'contactos',
        totalProperty: 'total',
		idProperty: 'co_contacto',
        fields: [{name: 'co_contacto'},
		        {name: 'nb_contacto'},
		        {name: 'tx_apellido'},
		        {name: 'di_oficina'},
		        {name: 'tx_telefono_oficina'},
		        {name: 'tx_correo_electronico'},
		        {name: 'di_habitacion'},
		        {name: 'tx_telefono_habitacion'},
		        {name: 'co_proveedor'},
		        {name: 'nb_proveedor'},
		        {name: 'resp'}]
        });
    storeContacto.setDefaultSort('co_contacto', 'ASC');
    
/*****************************************FIN****StoreContacto*****************************************/



/******************************************INICIO**colModelContacto******************************************/     
    
    var colModelContacto = new Ext.grid.ColumnModel([
        {id:'co_contacto',header: "Contacto", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_contacto'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		{header: "Telefono Habitacion", width: 120, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        {header: "Proveedor", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
      ]);
	
/******************************************FIN****colModelContacto******************************************/     

/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

var gridForm = new Ext.FormPanel({
        id: 'grid_planlocalizacion',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:760,
		items: [{
					border:false,
	                xtype: 'grid',
					id: 'gd_planlocalizacion',
	                store: storePlanLocalizacion,
	                stripeRows: true,
                	iconCls: 'icon-grid',
	                cm: colModelPlanLocalizacion,
	                height: 250,
	                iconCls: 'icon-grid',
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
		}]
    });

storePlanLocalizacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_plan_localizacion.php"}});
gridForm.render('form');



/********************************************************************************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'grid_alimentacion',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:760,
		items: [{
                xtype: 'grid',
				id: 'gd_alimentacion',
                store: storeAlimentacion,
                cm: colModelAlimentacion,
                plugins: expanderAlimentacion,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("grid_alimentacion").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Comidas',
                border: true,
                tbar:[{
			    text:'Agregar Alimentacion',
			    tooltip:'Agregar Nueva Gestion Alimentacion',
			    handler: AgregarAlimentacion,
			    iconCls:'add'
			    }],
	            listeners: {
				handler : function(){
					if(Ext.getCmp("gd_alimentacion").getSelectionModel().getSelected()){
					var record = Ext.getCmp("gd_alimentacion").getSelectionModel().getSelected();
					Ext.getCmp("co_alimentacion").setValue(record.data.co_alimentacion);
					}
								  }
	                },
				bbar: new Ext.PagingToolbar({
				store: storeAlimentacion,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
    });
    
storeAlimentacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alimentacion.php"}});
gridForm.render('form');

    var gridForm = new Ext.FormPanel({
        id: 'grid_alojamiento',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:760,
		items: [{
                xtype: 'grid',
				id: 'gd_alojamiento',
                store: storeAlojamiento,
                cm: colModelAlojamiento,
                plugins: expanderAlojamiento,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("grid_alojamiento").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Alojamientos',
                border: true,
                tbar:[{
			    text:'Agregar Alojamiento',
			    tooltip:'Agregar Nueva Gestion Alojamiento',
			    handler: AgregarAlojamiento,
			    iconCls:'add'
			    }],
	            listeners: {
				handler : function(){
					if(Ext.getCmp("gd_alojamiento").getSelectionModel().getSelected()){
					var record = Ext.getCmp("gd_alojamiento").getSelectionModel().getSelected();
					Ext.getCmp("co_alojamiento").setValue(record.data.co_alojamiento);
					}
								  }
	                },
				bbar: new Ext.PagingToolbar({
				store: storeAlojamiento,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
    });
storeAlojamiento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alojamiento.php"}});
gridForm.render('form');


    var gridForm = new Ext.FormPanel({
        id: 'grid_transporte',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:760,
		items: [{
                xtype: 'grid',
				id: 'gd_transporte',
                store: storeTransporte,
                cm: colModelTransporte,
                //plugins: expanderAlojamiento,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("grid_transporte").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Transporte',
                border: true,
                tbar:[{
			    text:'Agregar Transporte',
			    tooltip:'Agregar Nueva Gestion de Transporte',
			    //handler: AgregarTransporte,
			    iconCls:'add'
			    }],
	            listeners: {
				handler : function(){
					if(Ext.getCmp("gd_transporte").getSelectionModel().getSelected()){
					var record = Ext.getCmp("gd_transporte").getSelectionModel().getSelected();
					Ext.getCmp("co_transporte").setValue(record.data.co_transporte);
					}
								  }
	                },
				bbar: new Ext.PagingToolbar({
				store: storeTransporte,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    });
storeTransporte.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_transporte.php"}});
gridForm.render('form');



   var grid = new Ext.grid.GridPanel({
        id: 'grid_proveedor',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:760,
		items: [{
                xtype: 'grid',
				id: 'gd_proveedor',
                store: storeProveedor,
                cm: colModelProveedor,
                plugins: expanderContacto,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("grid_proveedor").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Proveedor',
                border: true,
                tbar:[{
			    text:'Agregar Proveedor',
			    tooltip:'Agregar Nuevo Proveedor',
			    handler: AgregarProveedor,
			    iconCls:'add'
			    }],
	            listeners: {
				handler : function(){
					if(Ext.getCmp("gd_proveedor").getSelectionModel().getSelected()){
					var record = Ext.getCmp("gd_proveedor").getSelectionModel().getSelected();
					Ext.getCmp("co_proveedor").setValue(record.data.co_proveedor);
					}
								  }
	                },
				bbar: new Ext.PagingToolbar({
				store: storeProveedor,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    });
    	
storeContacto.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_contacto_proveedor.php"}});
storeProveedor.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_proveedor.php"}});
grid.render('form');


/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

	function AgregarAlimentacion(){
	if(!winAlimentacion){
				winAlimentacion = new Ext.Window({
						applyTo : 'winAlimentacion',
						layout : 'fit',
						width : 620,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [new Ext.FormPanel({
        id: 'frm_alimentacion',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:600,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:580,
			buttonAlign:'center',
			layout:'column',
			title: 'Alimentacion',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:80,
					columnWidth:.50,
					border:false,
					items: [new Ext.ux.form.SpinnerField({
			                xtype: 'spinnerfield',
			            	fieldLabel: 'Desayunos',
			            	name: 'ca_desayuno',
			            	id: 'ca_desayuno',
			            	minValue: 0,
			            	maxValue: 100,
			            	allowDecimals: false,
			            	decimalPrecision: 1,
			            	incrementValue: 1,
			            	accelerate: true,
			            	width:60
							}),
							{
							fieldLabel: 'Numero',
							xtype:'numberfield',
							id: 'co_alimentacion',
	                        name: 'co_alimentacion',
	                        hidden:true,
	                        hideLabel:true,
							style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
	                        width:60
								},new Ext.ux.form.SpinnerField({
			                xtype: 'spinnerfield',
			            	fieldLabel: 'Almuerzos',
			            	name: 'ca_almuerzo',
			            	id: 'ca_almuerzo',
			            	minValue: 0,
			            	maxValue: 100,
			            	allowDecimals: false,
			            	decimalPrecision: 1,
			            	incrementValue: 1,
			            	accelerate: true,
			            	width:60
							})]
				},{
					layout: 'form',
					border:false,
					columnWidth:.50,
					labelWidth:80,
					items: [new Ext.ux.form.SpinnerField({
			                xtype: 'spinnerfield',
			            	fieldLabel: 'Cenas',
			            	name: 'ca_cena',
			            	id: 'ca_cena',
			            	minValue: 0,
			            	maxValue: 100,
			            	allowDecimals: false,
			            	decimalPrecision: 1,
			            	incrementValue: 1,
			            	accelerate: true,
			            	width:60
							}),new Ext.ux.form.SpinnerField({
			                xtype: 'spinnerfield',
			            	fieldLabel: 'Cantidad de Personas',
			            	name: 'ca_persona',
			            	id: 'ca_persona',
			            	minValue: 0,
			            	maxValue: 100,
			            	allowBlank:false,
			            	allowDecimals: false,
			            	decimalPrecision: 1,
			            	incrementValue: 1,
			            	accelerate: true,
			            	width:60
							})]
				}]
			},{
				width: 600,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
				text: 'Nuevo', 
				tooltip:'',
				handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardarAlimentacion").enable();
					Ext.getCmp("btnEliminarAlimentacion").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_alimentacion").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardarAlimentacion',
			tooltip:'',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_alimentacion").getForm().getValues(false);	
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
								storeAlimentacion.baseParams = {'accion': 'insertar'};
							else
								storeAlimentacion.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_alimentacion" : "'+Ext.getCmp("co_alimentacion").getValue()+'", ';
							columnas += '"ca_desayuno" : "'+Ext.getCmp("ca_desayuno").getValue()+'", ';
							columnas += '"ca_almuerzo" : "'+Ext.getCmp("ca_almuerzo").getValue()+'", ';
							columnas += '"ca_cena" : "'+Ext.getCmp("ca_cena").getValue()+'", ';
							columnas += '"ca_persona" : "'+Ext.getCmp("ca_persona").getValue()+'"}';
							storeAlimentacion.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_alimentacion" : "'+Ext.getCmp("co_alimentacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_alimentacion.php"},
										callback: function () {
										if(storeAlimentacion.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeAlimentacion.getAt(0).data.resp, 
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
							storeAlimentacion.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_alimentacion.php'};
						}
				}
			}]
			}],
        
    })],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
											winAlimentacion.hide();
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winAlimentacion.hide();
								  }
						}]
				});
		}
		winAlimentacion.show();	
}

	function AgregarAlojamiento(){
	if(!winAlojamiento){
				winAlojamiento = new Ext.Window({
						applyTo : 'winAlojamiento',
						layout : 'fit',
						width : 620,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [new Ext.FormPanel({
        id: 'frm_alimentacion',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:600,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:580,
			buttonAlign:'center',
			layout:'column',
			title: 'Alojamiento',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo Alojamiento',
						xtype:'numberfield',
						id: 'co_alojamiento',
                        name: 'co_alojamiento',
                        hidden: true,
						hideLabel: true,
                        width:120
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_establecimiento',
                        name: 'nb_establecimiento',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }, {
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						vtype:'validos',
						id: 'di_ubicacion',
                        name: 'di_ubicacion',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                       xtype: 'radiogroup',
	            		fieldLabel: 'Hotel',
	            		id: 'bo_hotel',
		                name: 'bo_hotel',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'hotel', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'hotel', inputValue: 0},
			           			]
                    }, {
                        xtype: 'radiogroup',
	            		fieldLabel: 'Posada',
	            		id: 'bo_posada',
		                name: 'bo_posada',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'posada', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'posada', inputValue: 0},
			           			]
                    },{
                         fieldLabel: 'Telefono',
						xtype:'numberfield',
						id: 'tx_telefono',
                        name: 'tx_telefono',
                        allowBlank:false,
						width:120
                    }]
			}]
			},{
				width: 600,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardarAlojamiento").enable();
					Ext.getCmp("btnEliminarAlojamiento").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_alojamiento").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardarAlojamiento',
			tooltip:'',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_alojamiento").getForm().getValues(false);	
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
								storeAlojamiento.baseParams = {'accion': 'insertar'};
							else
								storeAlojamiento.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_alojamiento" : "'+Ext.getCmp("co_alojamiento").getValue()+'", ';
							columnas += '"nb_establecimiento" : "'+Ext.getCmp("nb_establecimiento").getValue()+'", ';
							columnas += '"di_ubicacion" : "'+Ext.getCmp("di_ubicacion").getValue()+'", ';
							columnas += '"bo_hotel" : "'+Ext.getCmp("bo_hotel").getValue()+'", ';
							columnas += '"bo_posada" : "'+Ext.getCmp("bo_posada").getValue()+'", ';
							columnas += '"tx_telefono" : "'+Ext.getCmp("tx_telefono").getValue()+'"}';
							storeAlojamiento.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_alojamiento" : "'+Ext.getCmp("co_alojamiento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_alojamiento.php"},
										callback: function () {
										if(storeAlojamiento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeAlojamiento.getAt(0).data.resp, 
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
							storeAlojamiento.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_alojamiento.php'};
						}
				}
			}]
			}],
        
    })],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
											winAlojamiento.hide();
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winAlojamiento.hide();
								  }
						}]
				});
		}
		winAlojamiento.show();	
}
function AgregarProveedor(){
	if(!winProveedor){
				winProveedor = new Ext.Window({
						applyTo : 'winProveedor',
						layout : 'fit',
						width : 620,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [new Ext.FormPanel({
        id: 'frm_proveedor',
        frame: true,
		labelAlign: 'center',
        title: 'Proveedores',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:600,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:580,
			buttonAlign:'center',
			layout:'column',
			title: 'Proveedores',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo Proveedor',
						xtype:'numberfield',
						id: 'co_proveedor',
                        name: 'co_proveedor',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
                        width:120
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_proveedor',
                        name: 'nb_proveedor',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }, {
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						vtype:'validos',
						id: 'di_oficina',
                        name: 'di_oficina',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Telefono',
						xtype:'numberfield',
						id: 'tx_telefono_oficina',
                        name: 'tx_telefono_oficina',
						width:120
                    }, {
                        fieldLabel: 'Pagina Web',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_url_pagina',
                        name: 'tx_url_pagina',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120
                    }]
			}]
			},{
				width: 600,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardarProveedor").enable();
					Ext.getCmp("btnEliminarProveedor").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_proveedor").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardarProveedor',
			tooltip:'Guardar Proveedor',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_proveedor").getForm().getValues(false);	
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
								storeProveedor.baseParams = {'accion': 'insertar'};
							else
								storeProveedor.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_proveedor" : "'+Ext.getCmp("co_proveedor").getValue()+'", ';
							columnas += '"nb_proveedor" : "'+Ext.getCmp("nb_proveedor").getValue()+'", ';
							columnas += '"di_oficina" : "'+Ext.getCmp("di_oficina").getValue()+'", ';
							columnas += '"tx_telefono_oficina" : "'+Ext.getCmp("tx_telefono_oficina").getValue()+'", ';
							columnas += '"tx_url_pagina" : "'+Ext.getCmp("tx_url_pagina").getValue()+'"}';
							storeProveedor.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_proveedor" : "'+Ext.getCmp("co_proveedor").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_proveedor.php"},
										callback: function () {
										if(storeProveedor.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeProveedor.getAt(0).data.resp, 
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
							storeProveedor.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_proveedor.php'};
						}
				}
			}]
			}],
        
    })],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
											winProveedor.hide();
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winProveedor.hide();
								  }
						}]
				});
		}
		winProveedor.show();	
}
});