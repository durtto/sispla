<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Documento Componente</title>
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

/******************************************INICIO**StoreDocumento******************************************/     
      
  var storeDocumento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_doc_componente.php',
		remoteSort : true,
		root: 'doccomponentes',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_doc_componente.php'},
        totalProperty: 'total',
		idProperty: 'co_doc_componente',
        fields: [{name: 'co_doc_componente'},
        		{name: 'tx_url_direccion'},
        		{name: 'resp'}]
        });
    storeDocumento.setDefaultSort('co_doc_componente', 'ASC');
    
/*****************************************FIN****StoreDocumento*****************************************/

  var storeNuevoDocumento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_doc_componente.php',
		remoteSort : true,
		root: 'doccomponentes',
		baseParams: {'accion': 'nuevo', 'interfaz': 'interfaz_doc_componente.php'},
        totalProperty: 'total',
		idProperty: 'co_doc_componente',
        fields: [{name: 'co_doc_componente'}]
        });

/******************************************INICIO**colModelDocumento******************************************/     
    
    var colModelDocumento = new Ext.grid.ColumnModel([
        {id:'co_doc_componente',header: "Documento", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_doc_componente'},
        {header: "Direccion", width: 165, sortable: true, locked:false, dataIndex: 'tx_url_direccion'},
      ]);
      
/******************************************FIN****colModelDocumento******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_documento',
        frame: true,
		labelAlign: 'center',
        title: 'Documentos',
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
			title: 'Documento',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Documento',
						xtype:'numberfield',
						id: 'co_doc_componente',
                        name: 'co_doc_componente',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Direccion en Servidor',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_url_direccion',
                        name: 'tx_url_direccion',
                        allowBlank: false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,listeners:{
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
					storeNuevoDocumente.load({
							callback: function () {
									if(storeNuevoDocumento.getAt(0).data.co_doc_componente){									
										Ext.getCmp("co_doc_componente").setValue(storeNuevoDocumento.getAt(0).data.co_doc_componente+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_doc_componente").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			iconCls: 'save',
			tooltip:'Guardar Componente',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_documento").getForm().getValues(false);	
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
								storeDocumento.baseParams = {'accion': 'insertar'};
							else
								storeDocumento.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_doc_componente" : "'+Ext.getCmp("co_doc_componente").getValue()+'", ';
							columnas += '"tx_url_direccion" : "'+Ext.getCmp("tx_url_direccion").getValue()+'"}';
							storeDocumento.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_doc_componente" : "'+Ext.getCmp("co_doc_componente").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_doc_componente.php"},
										callback: function () {
										if(storeDocumento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDocumento.getAt(0).data.resp, 
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
							storeDocumento.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_doc_componente.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Documento',
			disabled: true,
			handler: function(){
										storeDocumento.baseParams = {'accion': 'eliminar'};
										storeDocumento.load({params:{
												"condiciones": '{ "co_doc_componente" : "'+Ext.getCmp("co_doc_componente").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_doc_componente.php"},
										callback: function () {
										storeDocumento.baseParams = {'accion': 'refrescar'};
										if(storeDocumento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDocumento.getAt(0).data.resp,
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
										storeDocumento.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_doc_componente.php'};

							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_documento',
                store: storeDocumento,
                cm: colModelDocumento,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_documento").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Documentos',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeDocumento,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeDocumento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_doc_componente.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/



/****************************************************************************************************/
	
	Ext.getCmp("gd_documento").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_doc_componente").focus();
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