<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Alimentacion</title>
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
		<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/Spinner.js"></script>
		<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/SpinnerField.js"></script>


<link rel="stylesheet" href="../lib/ext-3.2.1/examples/ux/css/Spinner.css" />
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

/******************************************INICIO**StoreAlimentacion******************************************/     
	
  var storeAlimentacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_alimentacion.php',
		remoteSort : true,
		root: 'alimentos',
        totalProperty: 'total',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_alimentacion.php'},
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


/******************************************INICIO**colModelAlimentacion******************************************/     

    var colModelAlimentacion = new Ext.grid.ColumnModel([
        {id:'co_alimentacion',header: "Codigo de Gestion", hidden:true, width: 130, sortable: true, locked:false, dataIndex: 'co_alimentacion'},
        {header: "Nro de Desayunos", width: 125, sortable: true, locked:false, dataIndex: 'ca_desayuno'},
        {header: "Nro de Almuerzos", width: 125, sortable: true, locked:false, dataIndex: 'ca_almuerzo'},
        {header: "Nro de Cenas", width: 115, sortable: true, locked:false, dataIndex: 'ca_cena'},
        {header: "Cantidad de Personas", width: 144, sortable: true, locked:false, dataIndex: 'ca_persona'},
      ]);
	
/******************************************FIN****colModelAlimentacion******************************************/     


	
	
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_alimentacion',
        frame: true,
		labelAlign: 'center',
        title: 'Logistica de Alimentacion',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:620,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:600,
			buttonAlign:'center',
			layout:'column',
			title: 'Alimentacion',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:80,
					columnWidth:.25,
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
								}]
				},{
					layout: 'form',
					labelWidth:80,
					columnWidth:.25,
					border:false,
					items: [new Ext.ux.form.SpinnerField({
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
					columnWidth:.25,
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
							})]
			},{
					layout: 'form',
					labelWidth:80,
					columnWidth:.25,
					border:false,
					items: [new Ext.ux.form.SpinnerField({
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
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_alimentacion").focus();
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
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_alimentacion.php"},
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
							storeAlimentacion.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_alimentacion.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar alimentacion',
			disabled: true,
			handler: function(){
										storeAlimentacion.baseParams = {'accion': 'eliminar'};
										storeAlimentacion.load({params:{
												"condiciones": '{ "co_alimentacion" : "'+Ext.getCmp("co_alimentacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_alimentacion.php"},
										callback: function () {
										storeAlimentacion.baseParams = {'accion': 'refrescar'};
										if(storeAlimentacion.getAt(0).data.resp!=true){	
											storeAlimentacion.baseParams = {'accion': 'refrescar'};	
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
										storeAlimentacion.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_alimentacion.php'};
										}
							}})}
			}]
			},{
			width:600,
			items:[{
                xtype: 'grid',
				id: 'gd_alimentacion',
                store: storeAlimentacion,
                cm: colModelAlimentacion,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_alimentacion").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Comidas',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeAlimentacion,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeAlimentacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alimentacion.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_alimentacion").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_alimentacion").focus();
		nroReg=rowIdx;
		
});

/****************************************************************************************************/

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