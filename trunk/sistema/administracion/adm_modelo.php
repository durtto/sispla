<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Modelo</title>
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

/******************************************INICIO**StoreModelo******************************************/     
	
  var storeModelo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_modelo.php',
		remoteSort : true,
		root: 'modelos',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_modelo.php"},
        totalProperty: 'total',
		idProperty: 'co_modelo',
        fields: [{name: 'co_modelo'},
        		{name: 'nb_modelo'},
        		{name: 'co_tipo_activo'},
        		{name: 'nb_tipo_activo'},
        		{name: 'resp'}]
        });
    storeModelo.setDefaultSort('co_modelo', 'ASC');
    
/*****************************************FIN****StoreModelo*****************************************/

	
/******************************************INICIO**colModelModelo******************************************/     
   
    var colModelModelo = new Ext.grid.ColumnModel([
        {id:'co_modelo',header: "Modelo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_modelo'},
        {header: "Nombre", width: 200, sortable: true, locked:false, dataIndex: 'nb_modelo'},
       	{header: "Tipo Activo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Tipo Activo", width: 200, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
      ]);
      
/******************************************FIN****colModelModelo******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_modelo',
        frame: true,
		labelAlign: 'center',
        title: 'Modelos',
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
			title: 'Modelos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Modelo',
						xtype:'numberfield',
						id: 'co_modelo',
                        name: 'co_modelo',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Modelo',
						xtype:'textfield',
						id: 'nb_modelo',
                        name: 'nb_modelo',
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
					items: [GetCombo('co_tipo_activo', 'Tipo Activo')]
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
					Ext.getCmp("co_modelo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Modelo',
			disabled: true,
			iconCls: 'save',
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_modelo").getForm().getValues(false);	
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
								storeModelo.baseParams = {'accion': 'insertar'};
							else
								storeModelo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_modelo" : "'+Ext.getCmp("co_modelo").getValue()+'", ';
							columnas += '"nb_modelo" : "'+Ext.getCmp("nb_modelo").getValue()+'", ';
							columnas += '"co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'"}';
							storeModelo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_modelo" : "'+Ext.getCmp("co_modelo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_modelo.php"},
										callback: function () {
										if(storeModelo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeModelo.getAt(0).data.resp, 
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
							storeModelo.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_modelo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Grupo',
			disabled: true,
			handler: function(){
										storeModelo.baseParams = {'accion': 'eliminar'};
										storeModelo.load({params:{
												"condiciones": '{ "co_modelo" : "'+Ext.getCmp("co_modelo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_modelo.php"},
										callback: function () {
										storeModelo.baseParams = {'accion': 'refrescar'};
										if(storeModelo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeModelo.getAt(0).data.resp,
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
							storeModelo.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_modelo.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_modelo',
                store: storeModelo,
                cm: colModelModelo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_modelo").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Modelos',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeModelo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeModelo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_modelo.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

/****************************************************************************************************/
	
	Ext.getCmp("gd_modelo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_modelo").focus();
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