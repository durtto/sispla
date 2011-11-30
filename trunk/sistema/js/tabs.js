var nuevo;
var winAlimentacion;
var winAlojamiento;

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
        {header: "Elaboracion", width: 680, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
      ]);

/******************************************FIN****colModelPlanLocalizacion******************************************/     

    
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


/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

var gridForm = new Ext.FormPanel({
        id: 'grid_planlocalizacion',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:760,
		items: []
    });

storePlanLocalizacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_plan_localizacion.php"}});
gridForm.render('form');


var gridForm = new Ext.FormPanel({
        id: 'grid_planlogistica',
        frame: true,
		labelAlign: 'center',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:760,
		items: [{
					border:false,
	                xtype: 'grid',
					id: 'gd_planlogistica',
	                store: storePlanLogistica,
	                stripeRows: true,
                	iconCls: 'icon-grid',
	                cm: colModelPlanLogistica,
	                height: 250,
	                iconCls: 'icon-grid',
					title:'Lista de Plan Logistica',
	                border: true,
	                listeners: {
	                    viewready: function(g) {
	                    }
	                },
					bbar: new Ext.PagingToolbar({
					store: storePlanLogistica,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
		}]
    });

storePlanLogistica.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_plan_logistica.php"}});
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

});