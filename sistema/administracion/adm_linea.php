<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Linea Taxi</title>
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

/******************************************INICIO**StoreLinea******************************************/     
	
  var storeLinea = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_linea_taxi.php',
		remoteSort : true,
		root: 'lineas',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_linea_taxi.php"},
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

	var storeNuevoLinea = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_linea_taxi.php',
		remoteSort : true,
		root: 'lineas',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_linea_taxi.php"},
        fields: [{name: 'co_linea'}]
        });


/******************************************INICIO**colModelLinea******************************************/     
   
    var colModelLinea = new Ext.grid.ColumnModel([
        {id:'co_linea',header: "Linea", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_linea'},
        {header: "Nombre", width: 200, sortable: true, locked:false, dataIndex: 'nb_linea'},
        {header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        {header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'di_oficina'},
      ]);
	
/******************************************FIN****colModelLinea******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_linea',
        frame: true,
		labelAlign: 'center',
        title: 'Lineas',
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
			title: 'Lineas',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero de Linea',
						xtype:'numberfield',
						id: 'co_linea',
                        name: 'co_linea',
                        hidden: true,
						hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_linea',
                        name: 'nb_linea',
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
					labelWidth:100,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Telefono',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_telefono',
                        name: 'tx_telefono',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    }, {
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						vtype:'validos',
						id: 'di_oficina',
                        name: 'di_oficina',
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
					storeNuevoLinea.load({
							callback: function () {
									if(storeNuevoLinea.getAt(0).data.co_linea){									
										Ext.getCmp("co_linea").setValue(storeNuevoLinea.getAt(0).data.co_linea+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_linea").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Linea de Taxi',
			iconCls: 'save',
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
			iconCls: 'delete',
			tooltip:'Eliminar Linea',
			disabled: true,
			handler: function(){
										storeLinea.baseParams = {'accion': 'eliminar'};
										storeLinea.load({params:{
												"condiciones": '{ "co_linea" : "'+Ext.getCmp("co_linea").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_linea.php"},
										callback: function () {
										storeLinea.baseParams = {'accion': 'refrescar'};
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
							storeLinea.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_linea.php'};										
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_linea',
                store: storeLinea,
                cm: colModelLinea,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_linea").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Linea',
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
			
		}],
        
    });


	
	
storeLinea.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_linea.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_linea").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_linea").focus();
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