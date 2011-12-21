<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Vehiculo YA NO SE USA</title>
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

  var storeNuevoVehiculo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_vehiculo.php',
		remoteSort : true,
		root: 'vehiculos',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_vehiculo.php"},
        fields: [{name: 'co_vehiculo'}]
        });


/******************************************INICIO**colModelVehiculo******************************************/     
   
    var colModelVehiculo = new Ext.grid.ColumnModel([
        {id:'co_vehiculo',header: "Vehiculo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
        {header: "Placa", width: 100, sortable: true, locked:false, dataIndex: 'tx_placa'},
		{header: "Marca", width: 100, sortable: true, locked:false, dataIndex: 'tx_marca'},        
		{header: "Modelo", width: 180, sortable: true, locked:false, dataIndex: 'tx_modelo'},
		{header: "Unidad", width: 159, sortable: true, locked:false, dataIndex: 'tx_unidad'},
      ]);
      
/******************************************FIN****colModelVehiculo******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var gridForm = new Ext.FormPanel({
        id: 'frm_vehiculo',
        frame: true,
		labelAlign: 'center',
        title: 'Vehiculos',
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
			title: 'Vehiculos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Vehiculo',
						xtype:'numberfield',
						id: 'co_vehiculo',
                        name: 'co_vehiculo',
                        hidden: true,
						hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Placa',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_placa',
                        name: 'tx_placa',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
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
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
                    },{
					layout: 'form',
					labelWidth:140,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Modelo',
						xtype:'textfield',
						id: 'tx_modelo',
                        name: 'tx_modelo',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
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
                        width:160,
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
			tooltip:'Guardar Vehiculo',
			iconCls: 'save',
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
			iconCls: 'delete',
			tooltip:'Eliminar Vehiculo',
			disabled: true,
			handler: function(){
										storeVehiculo.baseParams = {'accion': 'eliminar'};
										storeVehiculo.load({params:{
												"condiciones": '{ "co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_vehiculo.php"},
										callback: function () {
											storeVehiculo.baseParams = {'accion': 'refrescar'};
										if(storeVehiculo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeVehiculo.getAt(0).data.resp,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											storeVehiculo.baseParams = {'accion': 'refrescar'};
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
					storeVehiculo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_vehiculo.php'};

							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_vehiculo',
                store: storeVehiculo,
                cm: colModelVehiculo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_vehiculo").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Vehiculos',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeVehiculo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeVehiculo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_vehiculo.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_vehiculo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_vehiculo").focus();
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