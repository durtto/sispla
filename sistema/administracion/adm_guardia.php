<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Guardia</title>
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

/******************************************INICIO**StoreGuardia******************************************/     
	
  var storeGuardia = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_guardia.php',
		remoteSort : true,
		root: 'guardias',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_guardia.php"},	
        totalProperty: 'total',
		idProperty: 'co_guardia',
        fields: [{name: 'co_guardia'},			
        		{name: 'nb_guardia'},				
        		{name: 'nu_numero'},	 
        		{name: 'tx_descripcion'},	
        		{name: 'nu_inicio_guardia'},
        		{name: 'nu_fin_guardia'},	
        		{name: 'resp'}]
       
        });
    storeGuardia.setDefaultSort('co_guardia', 'ASC');
    
/*****************************************FIN****StoreGuardia*****************************************/

	var storeNuevoGuardia = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_guardia.php',
		remoteSort : true,
		root: 'guardias',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_guardia.php"},
        fields: [{name: 'co_guardia'}]
        });

/******************************************INICIO**colModelGuardia******************************************/     
	
    var colModelGuardia = new Ext.grid.ColumnModel([
        {id:'co_guardia',header: "Guardia", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        {header: "Nombre de Guardia", width: 120, sortable: true, locked:false, dataIndex: 'nb_guardia'},
        {header: "N&uacute;mero", width: 80, sortable: true, locked:false, dataIndex: 'nu_numero'},
        {header: "Descripci&oacute;n", width: 418, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Hora de Inicio", width: 90, sortable: true, locked:false, dataIndex: 'nu_inicio_guardia'},
        {header: "Hora Fin", width: 90, sortable: true, locked:false, dataIndex: 'nu_fin_guardia'},
        ]);
	
/******************************************FIN****colModelGuardia******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_guardia',
        frame: true,
		labelAlign: 'center',
        title: '.: Guardias :.',
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
			title: 'Datos de Guardia',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'C&oacute;digo de Guardia',
						xtype:'numberfield',
						id: 'co_guardia',
                        name: 'co_guardia',
                        hidden: true,
						hideLabel: true,
                        width:160
                    },{
                        fieldLabel: 'Nombre Guardia',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_guardia',
                        name: 'nb_guardia',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Hora de Inicio',
						xtype:'timefield',
						id: 'nu_inicio_guardia',
                        name: 'nu_inicio_guardia',
                        width:160
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [new Ext.ux.form.SpinnerField({
			                xtype: 'spinnerfield',
			            	fieldLabel: 'N&uacute;mero',
			            	name: 'nu_numero',
			            	id: 'nu_numero',
			            	minValue: 0,
			            	maxValue: 100,
			            	allowDecimals: false,
			            	decimalPrecision: 1,
			            	incrementValue: 1,
			            	accelerate: true,
			            	width:60
							}),{
                        fieldLabel: 'Hora Fin',
						xtype:'timefield',
						id: 'nu_fin_guardia',
                        name: 'nu_fin_guardia',
                        width:160
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
					storeNuevoGuardia.load({
							callback: function () {
									if(storeNuevoGuardia.getAt(0).data.co_guardia){									
										Ext.getCmp("co_guardia").setValue(storeNuevoGuardia.getAt(0).data.co_guardia+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_guardia").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Guardia',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_guardia").getForm().getValues(false);	
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
								storeGuardia.baseParams = {'accion': 'insertar'};
							else
								storeGuardia.baseParams = {'accion': 'modificar'};
							var columnas   = '{"co_guardia" : "'+Ext.getCmp("co_guardia").getValue()+'", ';
							columnas += '"nb_guardia" : "'+Ext.getCmp("nb_guardia").getValue()+'", ';
							columnas += '"nu_numero" : "'+Ext.getCmp("nu_numero").getValue()+'", ';
							columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
							columnas += '"nu_inicio_guardia" : "'+Ext.getCmp("nu_inicio_guardia").getValue()+'", ';
							columnas += '"nu_fin_guardia" : "'+Ext.getCmp("nu_fin_guardia").getValue()+'"}';
							storeGuardia.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_guardia" : "'+Ext.getCmp("co_guardia").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_guardia.php"},
										callback: function () {
										if(storeGuardia.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: "Error"+storeGuardia.getAt(0).data.resp, 
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con &eacute;xito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							}});
							storeGuardia.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_guardia.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Guardia',
			disabled: true,
			handler: function(){
										storeGuardia.baseParams = {'accion': 'eliminar'};
										storeGuardia.load({params:{
												"condiciones": '{ "co_guardia" : "'+Ext.getCmp("co_guardia").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_guardia.php"},
										callback: function () {
										storeGuardia.baseParams = {'accion': 'refrescar'};
										if(storeGuardia.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeGuardia.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
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
							storeGuardia.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_guardia.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_guardia',
                store: storeGuardia,
                cm: colModelGuardia,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_guardia").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Listas de Guardias',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeGuardia,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeGuardia.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_guardia.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

/****************************************************************************************************/
	
	Ext.getCmp("gd_guardia").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_guardia").focus();
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