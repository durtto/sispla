<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Procesos</title>
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

	var storeNuevoProceso = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proceso.php',
		remoteSort : true,
		root: 'procesos',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_proceso.php"},
        fields: [{name: 'co_proceso'}]
        });

/******************************************INICIO**colModelProceso******************************************/     
    
    var colModelProceso = new Ext.grid.ColumnModel([
        {id:'co_proceso',header: "Proceso", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_proceso'},
        {header: "Nombre", width: 280, sortable: true, locked:false, dataIndex: 'nb_proceso'},
        {header: "Descripci&oacute;n", width: 420, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Cr&iacute;tico", width: 80, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: pcritico},
      ]);
      
/******************************************FIN****colModelProceso*****************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_proceso',
        frame: true,
		labelAlign: 'center',
        title: '.: Procesos :.',
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
			title: 'Datos del Proceso',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'N&uacute;mero Proceso',
						xtype:'numberfield',
						id: 'co_proceso',
                        name: 'co_proceso',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_proceso',
                        name: 'nb_proceso',
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
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Cr&iacute;tico',
	            		id: 'bo_critico',
		                name: 'bo_critico',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'critico', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'critico', inputValue: 0},
			           			]
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Descripci&oacute;n',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
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
			iconCls: 'add',
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					storeNuevoProceso.load({
							callback: function () {
									if(storeNuevoProceso.getAt(0).data.co_proceso){									
										Ext.getCmp("co_proceso").setValue(storeNuevoProceso.getAt(0).data.co_proceso+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_proceso").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Proceso',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_proceso").getForm().getValues(false);	
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
								storeProceso.baseParams = {'accion': 'insertar'};
							else
								storeProceso.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'", ';
								columnas += '"nb_proceso" : "'+Ext.getCmp("nb_proceso").getValue()+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
								columnas += '"bo_critico" : "'+Ext.getCmp("bo_critico").getValue()+'"}';
							storeProceso.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_proceso.php"},
										callback: function () {
										if(storeProceso.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeProceso.getAt(0).data.resp, 
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
											gridForm.getForm().reset();
										}
							}});
							storeProceso.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_proceso.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar proceso',
			disabled: true,
			handler: function(){
										storeProceso.baseParams = {'accion': 'eliminar'};
										storeProceso.load({params:{
												"condiciones": '{ "co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_proceso.php"},
										callback: function () {
										storeProceso.baseParams = {'accion': 'refrescar'};
										if(storeProceso.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeProceso.getAt(0).data.resp,
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
											gridForm.getForm().reset();
										}
										storeProceso.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_proceso.php'};

							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_proceso',
                store: storeProceso,
                cm: colModelProceso,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_proceso").getForm().loadRecord(rec);
                            if(rec.data.bo_critico == 'SI')
								Ext.getCmp('bo_critico').setValue(1);
							else
								Ext.getCmp('bo_critico').setValue(0);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Procesos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeProceso,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


 
	
storeProceso.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_proceso.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	Ext.getCmp("gd_proceso").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;

		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_proceso").focus();
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
