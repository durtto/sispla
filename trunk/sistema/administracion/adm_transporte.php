<html>
<head>
<title>Transporte</title>
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
 var winVehiculo;
 var winLinea;


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
    

/******************************************INICIO**StoreLinea******************************************/     
	
  var storeLinea = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_linea_taxi.php',
		remoteSort : true,
		root: 'lineas',
        totalProperty: 'total',
		idProperty: 'co_linea',
        fields: [{name: 'co_linea'},
        		{name: 'nb_linea'},
        		{name: 'tx_telefono'},
        		{name: 'di_oficina'},
        		{name: 'resp'}]
        });
    storeLinea.setDefaultSort('co_linea', 'ASC');
    
/*****************************************FIN****StoreLinea*****************************************/

  var expanderLinea = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Telefono:</b> {tx_telefono}</p>',
            '<p><b>Direccion:</b> {di_oficina}</p>'
        )
    });
    


/******************************************INICIO**colModelLinea******************************************/     
   var sm1 = new Ext.grid.CheckboxSelectionModel();
    var colModelLinea = new Ext.grid.ColumnModel([
		 expanderLinea,
        {id:'co_linea',header: "Linea", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_linea'},
        {header: "Nombre", width: 330, sortable: true, locked:false, dataIndex: 'nb_linea'},
        //{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        //{header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'di_oficina'},
    	sm1,
      ]);

/******************************************FIN****colModelLinea******************************************/     


/******************************************INICIO**StoreVehiculo******************************************/     
    
	
	var storeVehiculo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_vehiculo.php',
		remoteSort : true,
		root: 'vehiculos',
        totalProperty: 'total',
		idProperty: 'co_vehiculo',
        fields: [{name: 'co_vehiculo'},
		        {name: 'tx_placa'},
		        {name: 'tx_marca'},
		        {name: 'tx_modelo'},
		        {name: 'tx_unidad'},
		        {name: 'resp'}]
        });
    storeVehiculo.setDefaultSort('co_vehiculo', 'ASC');
    
/*****************************************FIN****StoreVehiculo*****************************************/

	var expanderVehiculo = new Ext.ux.grid.RowExpander({
	        tpl : new Ext.Template(
	            '<p><b>Placa:</b> {tx_placa}</p>',
	            '<p><b>Marca:</b> {tx_marca}</p>'

	        )
	    });

/******************************************INICIO**colModelVehiculo******************************************/     
   
    var sm2 = new Ext.grid.CheckboxSelectionModel();
    var colModelVehiculo = new Ext.grid.ColumnModel([
		expanderVehiculo, 
        {id:'co_vehiculo',header: "Vehiculo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
        //{header: "Placa", width: 100, sortable: true, locked:false, dataIndex: 'tx_placa'},
		//{header: "Marca", width: 100, sortable: true, locked:false, dataIndex: 'tx_marca'},        
		{header: "Modelo", width: 165, sortable: true, locked:false, dataIndex: 'tx_modelo'},
		{header: "Unidad", width: 165, sortable: true, locked:false, dataIndex: 'tx_unidad'},
		sm2,
      ]);
      
/******************************************FIN****colModelVehiculo******************************************/     

function vehiculos_seleccionados(){
      					var VehiculosSeleccionados = Ext.getCmp("gd_vehiculo").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<VehiculosSeleccionados.length; i++){
						seleccionados += '{ "co_vehiculo" : "'+VehiculosSeleccionados[i].data.co_vehiculo+'", "co_transporte": "'+Ext.getCmp('co_transporte').getValue()+'"}';
						if(i < VehiculosSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }
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
	
	

	
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_transporte',
        frame: true,
		labelAlign: 'center',
        title: 'Transporte',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:820,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:800,
			buttonAlign:'center',
			layout:'column',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero de Transporte',
						xtype:'numberfield',
						id: 'co_transporte',
                        name: 'co_transporte',
                       // hidden: true,
						//hideLabel: true,
                        width:120
                    }, {
                        fieldLabel: 'Fecha de Elaboracion',
						xtype:'datefield',
						vtype:'validos',
						id: 'fe_elaboracion',
                        name: 'fe_elaboracion',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120
                    }]
			}]
			},{
				width: 800,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo',
			iconCls: 'add', 
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_transporte").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			iconCls: 'save',
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_transporte").getForm().getValues(false);	
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
								storeTransporte.baseParams = {'accion': 'insertar'};

							else
								storeTransporte.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_transporte" : "'+Ext.getCmp("co_transporte").getValue()+'", ';
							columnas += '"fe_elaboracion" : "'+convFecha(Ext.getCmp("fe_elaboracion").getValue())+'"}';
							storeTransporte.load({params:{"columnas" : columnas,"vehiculos" : vehiculos_seleccionados(), "condiciones": '{ "co_transporte" : "'+Ext.getCmp("co_transporte").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_transporte.php"},
										callback: function () {
										if(storeTransporte.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTransporte.getAt(0).data.resp, 
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
							storeTransporte.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_transporte.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Grupo',
			disabled: true,
			iconCls: 'delete',
			handler: function(){
										storeTransporte.baseParams = {'accion': 'eliminar'};
										storeTransporte.load({params:{
												"condiciones": '{ "co_transporte" : "'+Ext.getCmp("co_planlocalizacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_transporte.php"},
										callback: function () {
										if(storeTransporte.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTransporte.getAt(0).data.resp,
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
					border: true,
					width:800,
					items:[{
					columnWidth:.50,
					border:false,
					width:398,
					stripeRows: true,
	                xtype: 'grid',
					id: 'gd_vehiculo',
	                store: storeVehiculo,
	                cm: colModelVehiculo,
					sm: sm2,
	                height: 250,
	                iconCls: 'icon-grid',
	                plugins: expanderVehiculo,
					title:'Lista de Vehiculos',
					tbar:[{
			            text:'Agregar Vehiculo',
			            tooltip:'Agregar Nuevo Vehiculo',
			            handler: AgregarVehiculo,
			            iconCls:'add'
			        }],
	                border: true,
					bbar: new Ext.PagingToolbar({
					store: storeVehiculo,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
	            },{
					columnWidth:.50,
					border:false,
	                xtype: 'grid',
					id: 'gd_linea',
	                store: storeLinea,
	                cm: colModelLinea,
	                stripeRows: true,
	                height: 250,
	                iconCls: 'icon-grid',
					title:'Lineas de Taxi',
					sm: sm1,
					plugins: expanderLinea,
					tbar:[{
			            text:'Agregar Linea de Taxi',
			            tooltip:'Agregar Nueva Linea',
			            handler: AgregarLinea,
			            iconCls:'add'
			        }],
	                border: true,
	                listeners: {
	                    viewready: function(g) {
	                    }
	                },
					bbar: new Ext.PagingToolbar({
					store: storeLinea,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
	            }]
			
		},{
					layout:'column',
					border: true,
					width:800,
					items:[{
					columnWidth:.50,
					border:false,
					width:398,
					stripeRows: true,
	                xtype: 'grid',
					id: 'gd_transporte',
	                store: storeTransporte,
	                cm: colModelTransporte,
					sm: sm3,
	                height: 250,
	                iconCls: 'icon-grid',
	                //plugins: expanderVehiculo,
					title:'Lista de Transporte',
	                border: true,
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
	            }]
			
		}],
        
    });


/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

	function AgregarVehiculo(){
	if(!winVehiculo){
				winVehiculo = new Ext.Window({
						applyTo : 'winVehiculo',
						layout : 'fit',
						width : 620,
						height : 250,
						closeAction :'hide',
						plain : true,
						items : [new Ext.FormPanel({
        id: 'frm_vehiculo',
        frame: true,
		labelAlign: 'center',
        //title: 'Vehiculos',
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
			title: 'Vehiculos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:80,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Vehiculo',
						xtype:'numberfield',
						id: 'co_vehiculo',
                        name: 'co_vehiculo',
                        hidden: true,
						hideLabel: true,
                        width:120
                    }, {
                        fieldLabel: 'Placa',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_placa',
                        name: 'tx_placa',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Marca',
						xtype:'textfield',
						id: 'tx_marca',
                        name: 'tx_marca',
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
					labelWidth:80,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Modelo',
						xtype:'textfield',
						id: 'tx_modelo',
                        name: 'tx_modelo',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Unidad',
						xtype:'textfield',
						id: 'tx_unidad',
                        name: 'tx_unidad',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			}]
			},{
				width: 580,  
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
					Ext.getCmp("co_vehiculo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_vehiculo").getForm().getValues(false);	
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
								storeVehiculo.baseParams = {'accion': 'insertar'};
							else
								storeVehiculo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'", ';
							columnas += '"tx_placa" : "'+Ext.getCmp("tx_placa").getValue()+'", ';
							columnas += '"tx_marca" : "'+Ext.getCmp("tx_marca").getValue()+'", ';
							columnas += '"tx_modelo" : "'+Ext.getCmp("tx_modelo").getValue()+'", ';
							columnas += '"tx_unidad" : "'+Ext.getCmp("tx_unidad").getValue()+'"}';
							storeVehiculo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_vehiculo.php"},
										callback: function () {
										if(storeVehiculo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeVehiculo.getAt(0).data.resp, 
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
							storeVehiculo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_vehiculo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Vehiculo',
			disabled: true,
			handler: function(){
										storeVehiculo.baseParams = {'accion': 'eliminar'};
										storeVehiculo.load({params:{
												"condiciones": '{ "co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_vehiculo.php"},
										callback: function () {
										if(storeVehiculo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeVehiculo.getAt(0).data.resp,
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
			}],
        
    })],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
											winVehiculo.hide();
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winVehiculo.hide();
								  }
						}]
				});
		}
		winVehiculo.show();	
}
	
	
	function AgregarLinea(){
	if(!winLinea){
				winLinea = new Ext.Window({
						applyTo : 'winLinea',
						layout : 'fit',
						width : 620,
						height : 250,
						closeAction :'hide',
						plain : true,
						items : [new Ext.FormPanel({
        id: 'frm_linea',
        frame: true,
		labelAlign: 'center',
        //title: 'Lineas',
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
			title: 'Lineas',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:80,
					columnWidth:.50,
					border:false,
					items: [{
                        fieldLabel: 'Numero de Linea',
						xtype:'numberfield',
						id: 'co_linea',
                        name: 'co_linea',
                        hidden: true,
						hideLabel: true,
                        width:120
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_linea',
                        name: 'nb_linea',
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
					labelWidth:80,
					columnWidth:.50,
					border:false,
					items: [{
                        fieldLabel: 'Telefono',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_telefono',
                        name: 'tx_telefono',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120
                    }, {
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						vtype:'validos',
						id: 'di_oficina',
                        name: 'di_oficina',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
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
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_linea").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_linea").getForm().getValues(false);	
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
								storeLinea.baseParams = {'accion': 'insertar'};
							else
								storeLinea.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_linea" : "'+Ext.getCmp("co_linea").getValue()+'", ';
								columnas += '"nb_linea" : "'+Ext.getCmp("nb_linea").getValue()+'", ';
								columnas += '"tx_telefono" : "'+Ext.getCmp("tx_telefono").getValue()+'", ';
								columnas += '"di_oficina" : "'+Ext.getCmp("di_oficina").getValue()+'"}';
							storeLinea.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_linea" : "'+Ext.getCmp("co_linea").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_linea.php"},
										callback: function () {
										if(storeLinea.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeLinea.getAt(0).data.resp, 
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
							storeLinea.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_linea.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Linea',
			disabled: true,
			handler: function(){
										storeLinea.baseParams = {'accion': 'eliminar'};
										storeLinea.load({params:{
												"condiciones": '{ "co_linea" : "'+Ext.getCmp("co_linea").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_linea.php"},
										callback: function () {
										if(storeLinea.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeLinea.getAt(0).data.resp,
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
			}],
        
    })],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
											winLinea.hide();
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winLinea.hide();
								  }
						}]
				});
		}
		winLinea.show();	
}


/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/
	
	
storeTransporte.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_transporte.php"}});
storeVehiculo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_vehiculo.php"}});
storeLinea.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_linea.php"}});

gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
/*	Ext.getCmp("gd_transporte").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		Ext.getCmp("btnGuardarTV").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_transporte").focus();
		nroReg=rowIdx;
		
});*/

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
    <div id="winVehiculo" class="x-hidden">
    <div class="x-window-header">Registrar Vehiculo</div>
</div>
    <div id="winLinea" class="x-hidden">
    <div class="x-window-header">Registrar Linea</div>
</div>
  </table>
</body>
</html>
