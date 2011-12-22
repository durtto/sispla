<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Cliente</title>
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

/******************************************INICIO**StorePersona******************************************/     
      
      var storePersona = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_persona.php',
		remoteSort : true,
		root: 'personas',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_persona.php"},
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
    
/*****************************************FIN****StorePersona*****************************************/



/******************************************INICIO**colModelPersona******************************************/     

    var colModelPersona = new Ext.grid.ColumnModel([
        {id:'co_indicador',header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "C&eacute;dula", width: 100, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Direcci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Tel&eacute;fono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Correo Electr&oacute;nico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Habitaci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		{header: "Tel&eacute;fono Habitaci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        {header: "Departamento", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        {header: "Departamento", width: 100, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
     	{header: "Rol", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol'},
        {header: "Rol", width: 100, sortable: true, locked:false, dataIndex: 'nb_rol'},      
      	{header: "Responsabilidad", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Responsabilidad", width: 100, sortable: true, locked:false, dataIndex: 'nb_rol_resp'},      
      	{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        {header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        {header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},      
      ]);
      
/******************************************FIN****colModelPersona******************************************/     


/******************************************INICIO**StoreProceso******************************************/     
	
  var storeProceso = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proceso.php',
		remoteSort : true,
		root: 'procesos',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_proceso.php"},
        totalProperty: 'total',
		idProperty: 'co_proceso',
        fields: [{name: 'co_proceso'},
		        {name: 'nb_proceso'},
		        {name: 'tx_descripcion'},
		        {name: 'bo_critico'},
		        {name: 'resp'}]
        });
    storeProceso.setDefaultSort('co_proceso', 'ASC');
    
/*****************************************FIN****StoreProceso*****************************************/



/******************************************INICIO**colModelProceso******************************************/     
    
    var colModelProceso = new Ext.grid.ColumnModel([
        {id:'co_proceso',header: "Proceso", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_proceso'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_proceso'},
        {header: "Descripci&oacute;n", width: 358, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Cr&iacute;tico", width: 100, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: pcritico},
      ]);
      
/******************************************FIN****colModelProceso*****************************************/     



/******************************************INICIO**StoreCliente******************************************/     
   
  var storeCliente = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_cliente.php',
		remoteSort : true,
		root: 'clientes',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_cliente.php"},
        totalProperty: 'total',
		idProperty: 'co_cliente',
        fields: [{name: 'co_cliente'},
		        {name: 'co_proceso'},
        		{name: 'nb_proceso'},
        		{name: 'tx_apellido'},
        		{name: 'co_departamento'},
		        {name: 'nb_departamento'},
		        {name: 'co_indicador'},
		        {name: 'tx_telefono_oficina'},
		        {name: 'tx_telefono_habitacion'},
        		{name: 'nb_persona'},
		        {name: 'resp'}]
        });
    storeCliente.setDefaultSort('co_proceso', 'ASC');
    
/*****************************************FIN****StoreCliente*****************************************/

	  var storeNuevoCliente = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_cliente.php',
		remoteSort : true,
		root: 'clientes',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_cliente.php"},
        fields: [{name: 'co_cliente'}]
        });
/******************************************INICIO**colModelCliente******************************************/     

	    var colModelCliente = new Ext.grid.ColumnModel([
        {id:'co_cliente',header: "Cliente", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_cliente'},
        {header: "Proceso", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_proceso'},
        {header: "Proceso", width: 150, sortable: true, locked:false, dataIndex: 'nb_proceso'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
        {header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Departamento", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        {header: "Departamento", width: 110, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
        {header: "Indicador", width: 108, sortable: true, locked:false, dataIndex: 'co_indicador'},
		{header: "Tel&eacute;fono Oficina", width: 110, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
		{header: "Tel&eacute;fono Habitaci&oacute;n", width: 120, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},

      ]);
      
/******************************************FIN****colModelCliente******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var gridForm = new Ext.FormPanel({
        id: 'frm_cliente',
        frame: true,
		labelAlign: 'center',
        title: '.: Actualizar Clientes :.',
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
			title: 'Datos del Cliente',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:130,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'N&uacute;mero Cliente',
						xtype:'numberfield',
						id: 'co_cliente',
                        name: 'co_cliente',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120
                    },GetCombo("co_proceso", "Proceso")]
				},{
					layout: 'form',
					labelWidth:130,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
                        width:120
                    },{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_persona',
						disabled:true,
                        name: 'nb_persona',
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
				width: 800,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			iconCls: 'adduser',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					storeNuevoCliente.load({
							callback: function () {
									if(storeNuevoCliente.getAt(0).data.co_cliente){									
										Ext.getCmp("co_cliente").setValue(storeNuevoCliente.getAt(0).data.co_cliente+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_cliente").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Cliente',
			disabled: true,
			iconCls: 'save',
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_cliente").getForm().getValues(false);	
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
								storeCliente.baseParams = {'accion': 'insertar'};
							else
								storeCliente.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_cliente" : "'+Ext.getCmp("co_cliente").getValue()+'", ';
								columnas += '"co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'", ';
								columnas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}';
							storeCliente.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_cliente" : "'+Ext.getCmp("co_cliente").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_cliente.php"},
										callback: function () {
										if(storeCliente.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCliente.getAt(0).data.resp, 
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
							storeCliente.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_cliente.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			iconCls: 'deleteuser',
			tooltip:'Eliminar Cliente',
			disabled: true,
			handler: function(){
										storeCliente.baseParams = {'accion': 'eliminar'};
										storeCliente.load({params:{
												"condiciones": '{ "co_cliente" : "'+Ext.getCmp("co_cliente").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_cliente.php"},
										callback: function () {
										storeCliente.baseParams = {'accion': 'refrescar'};											
										if(storeCliente.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCliente.getAt(0).data.resp,
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
								storeCliente.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_cliente.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_cliente',
                store: storeCliente,
                cm: colModelCliente,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_cliente").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Usuarios Contactos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeCliente,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });
    
/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

function selPersona(){
storePersona.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_persona.php"}});
	if(!winPersona){
				winPersona = new Ext.Window({
						applyTo : 'winPersona',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								id: 'gd_selPersona',
								store: storePersona,
								cm: colModelPersona,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								loadMask: true,
								height: 200,
								title:'Lista de Personas',
								border: true,
								listeners: {
												delay: 10
								},
								bbar: new Ext.PagingToolbar({
								store: storePersona,
								pageSize: 50,
								displayInfo: true,
								displayMsg: 'Mostrando registros {0} - {1} de {2}',
								emptyMsg: "No hay registros que mostrar",
								})
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
										if(Ext.getCmp("gd_selPersona").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selPersona").getSelectionModel().getSelected();
											Ext.getCmp("co_indicador").setValue(record.data.co_indicador);
											Ext.getCmp("nb_persona").setValue(record.data.nb_persona);
											winPersona.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winPersona.hide();
								  }
						}]
				});
		}
		winPersona.show();	
}

/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/
	
storeCliente.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_cliente.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_cliente").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_cliente").focus();
		nroReg=rowIdx;
		
});

/********************************************************************************************************/


/******************************************TRIGGERS*******************************************/

var triggerPersona = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPersona.onTriggerClick = selPersona;
		triggerPersona.applyToMarkup('nb_persona');
		
/******************************************FIN**TRIGGERS*******************************************/

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
<div id="winPersona" class="x-hidden">
    <div class="x-window-header">Seleccionar Persona</div>
</div>
</body>
</html>