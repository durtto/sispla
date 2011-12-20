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
<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
	var nuevo;
	var winTpRespaldo;

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

/******************************************INICIO**StoreTpRespaldo******************************************/     
  
  var storeTpRespaldo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_respaldo.php',
		remoteSort : true,
		root: 'tprespaldos',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_tipo_respaldo.php'},
		idProperty: 'co_tipo_respaldo',
        fields: [{name: 'co_tipo_respaldo'},
		        {name: 'nb_tipo_respaldo'},
		        {name: 'resp'}]
        });
    storeTpRespaldo.setDefaultSort('co_tipo_respaldo', 'ASC');
    
/*****************************************FIN****StoreTpRespaldo*****************************************/



/******************************************INICIO**colModelTpRespaldo******************************************/     
   
    var colModeltpRespaldo = new Ext.grid.ColumnModel([
        {id:'co_tipo_respaldo',header: "Respaldo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_tipo_respaldo'},
        {header: "Nombre", width: 375, sortable: true, locked:false, dataIndex: 'nb_tipo_respaldo'},
      ]);
	
/******************************************FIN****colModelTpRespaldo******************************************/     


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
		        {name: 'co_ubicacion'},
		        {name: 'nb_ubicacion'},
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
        {header: "Activo", width: 60, sortable: true, locked:false, dataIndex: 'nb_activo'},
        {header: "Veces por d&iacute;a", width: 90, sortable: true, locked:false, dataIndex: 'nu_veces_al_dia'},
        {header: "D&iacute;as de semana", width: 110, sortable: true, locked:false, dataIndex: 'tx_dias_semana'},      
        {header: "Retenci&oacute;n de Data", width: 110, sortable: true, locked:false, dataIndex: 'nu_tiempo_retencion_data'},
        {header: "Descripci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'tx_descripcion_data'},
        {header: "&Uacute;ltimo Respaldo", width: 110, sortable: true, locked:false, dataIndex: 'fe_ultimo_respaldo', renderer:convFechaDMY},
        {header: "Ubicaci&oacute;n F&iacute;sica", width: 110, hidden:true, sortable: true, locked:false, dataIndex: 'co_ubicacion'},        
	    {header: "Ubicaci&oacute;n F&iacute;sica", width: 110, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},        
		{header: "Activo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Respaldo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_tipo_respaldo'},
        {header: "Tipo de Respaldo", width: 110, hidden: false, sortable: true, locked:false, dataIndex: 'nb_tipo_respaldo'},
      ]);
	
/******************************************FIN****colModelRespaldo******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_respaldo',
        frame: true,
		labelAlign: 'center',
        title: '.: Esquema de Respaldo :.',
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
			title: 'Crear Esquema de Respaldo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [GetCombo('co_activo', 'Activo'),{
                        fieldLabel: 'N&uacute;mero',
						xtype:'numberfield',
						id: 'co_respaldo',
                        name: 'co_respaldo',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },GetCombo('co_tipo_respaldo', 'Tipo de Respaldo'),{
                        fieldLabel: 'D&iacute;as de la Semana',
						xtype:'textfield',
						id: 'tx_dias_semana',
                        name: 'tx_dias_semana',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: '&Uacute;ltimo Respaldo',
						xtype:'datefield',
						id: 'fe_ultimo_respaldo',
                        name: 'fe_ultimo_respaldo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Veces al d&iacute;a',
						xtype:'numberfield',
						id: 'nu_veces_al_dia',
                        name: 'nu_veces_al_dia',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Retenci&oacute;n de Data',
						xtype:'numberfield',
						id: 'nu_tiempo_retencion_data',
                        name: 'nu_tiempo_retencion_data',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }, GetCombo('co_ubicacion', 'Ubicaci&oacute;n')]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Descripci&oacute;n',
						xtype:'htmleditor',
						id: 'tx_descripcion_data',
                        name: 'tx_descripcion_data',
                        height: 140,
            			anchor: '110%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    }]
			}]
			},{
				width: 800,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			iconCls: 'add',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_respaldo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Respaldo',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_respaldo").getForm().getValues(false);	
						campos = verifObligatorios(camposForm, camposReq);
						if(campos != ''){		
							Ext.MessageBox.show({
								title: 'ATENCI&Oacute;N',
								msg: 'No se pueden guardar los datos. <br />Faltan los siguientes campos obligatorios por llenar: <br /><br />'+campos,
								buttons: Ext.MessageBox.OK,
								icon: Ext.MessageBox.WARNING
							});
						}
						else
						{
							if(nuevo)						
								storeRespaldo.baseParams = {'accion': 'insertar'};
							else
								storeRespaldo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_respaldo" : "'+Ext.getCmp("co_respaldo").getValue()+'", ';
								columnas += '"nu_veces_al_dia" : "'+Ext.getCmp("nu_veces_al_dia").getValue()+'", ';
								columnas += '"tx_dias_semana" : "'+Ext.getCmp("tx_dias_semana").getValue()+'", ';
								columnas += '"tx_descripcion_data" : "'+Ext.getCmp("tx_descripcion_data").getValue()+'", ';
								columnas += '"nu_tiempo_retencion_data" : "'+Ext.getCmp("nu_tiempo_retencion_data").getValue()+'", ';
								columnas += '"fe_ultimo_respaldo" : "'+convFecha(Ext.getCmp("fe_ultimo_respaldo").getValue())+'", ';
								columnas += '"co_ubicacion" : "'+Ext.getCmp("co_ubicacion").getValue()+'", ';
								columnas += '"co_activo" : "'+Ext.getCmp("co_activo").getValue()+'", ';
								columnas += '"co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'"}';
							storeRespaldo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_respaldo" : "'+Ext.getCmp("co_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_respaldo.php"},
										callback: function () {
										if(storeRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRespaldo.getAt(0).data.resp, 
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											
											Ext.MessageBox.show({
												title: 'INFORMACI&Oacute;N',
												msg: "Datos Guardados con &eacute;xito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							}});
							storeRespaldo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_respaldo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			iconCls: 'delete',
			tooltip:'Eliminar Respaldo',
			disabled: true,
			handler: function(){
										storeRespaldo.baseParams = {'accion': 'eliminar'};
										storeRespaldo.load({params:{
												"condiciones": '{ "co_respaldo" : "'+Ext.getCmp("co_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_respaldo.php"},
										callback: function () {
										storeRespaldo.baseParams = {'accion': 'refrescar'};
										if(storeRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRespaldo.getAt(0).data.resp,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
										storeRespaldo.baseParams = {'accion': 'refrescar'};
											Ext.MessageBox.show({
												title: 'INFORMACI&Oacute;N',
												msg: "Datos Guardados con &eacute;xito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
										storeRespaldo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_respaldo.php'};

							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_respaldo',
                store: storeRespaldo,
                cm: colModelRespaldo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_respaldo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Esquemas de Respaldo',
                border: true,
                tbar:[{
			            text:'Agregar Tipo de Respaldo',
			            tooltip:'Agregar Tipo de Respaldo',
			            handler: AgregarTpRespaldo,
			            iconCls:'add',
			        }],
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeRespaldo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });
    
/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

	function AgregarTpRespaldo(){
	if(!winTpRespaldo){
				winTpRespaldo = new Ext.Window({
						applyTo : 'winTpRespaldo',
						layout : 'fit',
						width : 420,
						height : 450,
						closeAction :'hide',
						plain : true,
						items : [new Ext.FormPanel({
        id: 'frm_tprespaldo',
        frame: true,
		labelAlign: 'center',
        title: 'Nuevo Tipo de Respaldo',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:400,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:380,
			buttonAlign:'center',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					border:false,
					items: [{
                        fieldLabel: 'N&uacute;mero de Tipo',
						xtype:'numberfield',
						id: 'co_tipo_respaldo',
                        name: 'co_tipo_respaldo',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
                        width:160
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_tipo_respaldo',
                        name: 'nb_tipo_respaldo',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }],
                    }]
			},{
				width: 380,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			iconCls: 'add',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_tipo_respaldo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_tprespaldo").getForm().getValues(false);	
						campos = verifObligatorios(camposForm, camposReq);
						if(campos != ''){		
							Ext.MessageBox.show({
								title: 'ATENCI&Oacute;N',
								msg: 'No se pueden guardar los datos. <br />Faltan los siguientes campos obligatorios por llenar: <br /><br />'+campos,
								buttons: Ext.MessageBox.OK,
								icon: Ext.MessageBox.WARNING
							});
						}
						else
						{
							if(nuevo)						
								storeTpRespaldo.baseParams = {'accion': 'insertar'};
							else
								storeTpRespaldo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'", ';
							columnas += '"nb_tipo_respaldo" : "'+Ext.getCmp("nb_tipo_respaldo").getValue()+'"}';
							storeTpRespaldo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_respaldo.php"},
										callback: function () {
										if(storeTpRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTpRespaldo.getAt(0).data.resp, 
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											
											Ext.MessageBox.show({
												title: 'INFORMACI&Oacute;N',
												msg: "Datos Guardados con &eacute;xito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							}});
							storeTpRespaldo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_tipo_respaldo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Tipo Respaldo',
			disabled: true,
			handler: function(){
										storeTpRespaldo.baseParams = {'accion': 'eliminar'};
										storeTpRespaldo.load({params:{
												"condiciones": '{ "co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_respaldo.php"},
										callback: function () {
										storeTpRespaldo.baseParams = {'accion': 'refrescar'};
										if(storeTpRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTpRespaldo.getAt(0).data.resp,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
										storeTpRespaldo.baseParams = {'accion': 'refrescar'};	
											Ext.MessageBox.show({
												title: 'INFORMACI&Oacute;N',
												msg: "Datos Guardados con &eacute;xito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
										storeTpRespaldo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_tipo_respaldo.php'};
							}})}
			}]
			},{
			width:380,
			items:[{
                xtype: 'grid',
				id: 'gd_tprespaldo',
                store: storeTpRespaldo,
                cm: colModeltpRespaldo,
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_tprespaldo").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Tipos de Respaldo',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeTpRespaldo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    })],
						buttons:[{
								  text : 'Aceptar',
								  iconCls: 'accept',
								  handler : function(){
											winTpRespaldo.hide();
storeRespaldo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_respaldo.php"}});

								  }
							   },{
								  text : 'Cancelar',
								  iconCls: 'cancel',
								  handler : function(){
											winTpRespaldo.hide();
								  }
						}]
				});
		}
		winTpRespaldo.show();	
		
		
		
		
storeRespaldo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_respaldo.php"}});
	Ext.getCmp("gd_tprespaldo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_tipo_respaldo").focus();
		nroReg=rowIdx;
		
});
}

/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/

storeTpRespaldo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_tipo_respaldo.php"}});	
storeRespaldo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_respaldo.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	Ext.getCmp("gd_respaldo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_respaldo").focus();
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
    <div id="winTpRespaldo" class="x-hidden">
    <div class="x-window-header">Registrar Tipo de Respaldo</div>
</div>
  </table>
</body>
</html>