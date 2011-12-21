<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Crecimiento Natural</title>
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
	<link rel="stylesheet" href="../lib/ext-3.2.1/examples/ux/css/Spinner.css" />

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

/******************************************INICIO**StoreCrecimiento******************************************/     

  var storeCrecimiento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_crecimiento.php',
		remoteSort : true,
		root: 'crecimientos',
        totalProperty: 'total',
        baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_crecimiento.php'},
		idProperty: 'co_crecimiento',
        fields: [{name: 'co_crecimiento'},
		        {name: 'ca_demanda_futura'},
		        {name: 'fe_actual'},
		        {name: 'fe_tope_demanda'},
		        {name: 'tx_descripcion'},
				{name: 'nb_tipo_activo'},
		        {name: 'resp'}]
        });
    storeCrecimiento.setDefaultSort('co_crecimiento', 'ASC');
	
/*****************************************FIN****StoreCrecimiento*****************************************/


  var storeNuevoCrecimiento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_crecimiento.php',
		remoteSort : true,
		root: 'crecimientos',
        baseParams: {'accion': 'nuevo', 'interfaz': 'interfaz_crecimiento.php'},
        fields: [{name: 'co_crecimiento'}]
        });
/******************************************INICIO**colModelCrecimiento******************************************/     

    var colModelCrecimiento = new Ext.grid.ColumnModel([
        {id:'co_crecimiento',header: "Crecimiento", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_crecimiento'},
        {header: "Demanda Futura", width: 150, sortable: true, locked:false, dataIndex: 'ca_demanda_futura'},
        {header: "Fecha actual", width: 150, sortable: true, locked:false, dataIndex: 'fe_actual', renderer:convFechaDMY},      
        {header: "Fecha Tope", width: 150, sortable: true, locked:false, dataIndex: 'fe_tope_demanda', renderer:convFechaDMY},
        {header: "Tipo de Activo", width: 150, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
        {header: "Descripci&oacute;n", width: 198, sortable: true, locked:false, dataIndex: 'tx_descripcion'},

      ]);
	
/******************************************FIN****colModelCrecimiento******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_crecimiento',
        frame: true,
		labelAlign: 'center',
        title: 'Crecimiento Natural de Activos',
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
			title: 'Crecimiento',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [GetCombo('co_tipo_activo','Tipo de Activo'),
					
					{
                        fieldLabel: 'C&oacute;digo de Crecimiento',
						xtype:'numberfield',
						allowBlank:false,
						id: 'co_crecimiento',
                        name: 'co_crecimiento',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },new Ext.ux.form.SpinnerField(
                    	{
			                xtype: 'spinnerfield',
			            	fieldLabel: 'Cantidad Requerida',
			            	name: 'ca_demanda_futura',
			            	id: 'ca_demanda_futura',
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
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Fecha Actual',
						xtype:'datefield',
						id: 'fe_actual',
                        name: 'fe_actual',
                        format:'Y-m-d',
                        vtype: 'daterange',
                        endDateField: 'fe_tope_demanda',
                        allowBlank: false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Fecha Tope',
						xtype:'datefield',
						id: 'fe_tope_demanda',
                        name: 'fe_tope_demanda',
                        format:'Y-m-d', 
                        vtype: 'daterange',
                        startDateField: 'fe_actual',
                        allowBlank: false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
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
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_crecimiento").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Crecimiento',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_crecimiento").getForm().getValues(false);	
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
								storeCrecimiento.baseParams = {'accion': 'insertar'};
							else
								storeCrecimiento.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_crecimiento" : "'+Ext.getCmp("co_crecimiento").getValue()+'", ';
								columnas += '"ca_demanda_futura" : "'+Ext.getCmp("ca_demanda_futura").getValue()+'", ';
								columnas += '"fe_actual" : "'+convFecha(Ext.getCmp("fe_actual").getValue())+'", ';
								columnas += '"fe_tope_demanda" : "'+convFecha(Ext.getCmp("fe_tope_demanda").getValue())+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
								columnas += '"co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'"}';
							storeCrecimiento.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_crecimiento" : "'+Ext.getCmp("co_crecimiento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_crecimiento.php"},
										callback: function () {
										if(storeCrecimiento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCrecimiento.getAt(0).data.resp, 
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
							storeCrecimiento.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_crecimiento.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Crecimiento',
			disabled: true,
			handler: function(){
										storeCrecimiento.baseParams = {'accion': 'eliminar'};
										storeCrecimiento.load({params:{
												"condiciones": '{ "co_crecimiento" : "'+Ext.getCmp("co_crecimiento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_crecimiento.php"},
										callback: function () {
										storeCrecimiento.baseParams = {'accion': 'refrescar'};
										if(storeCrecimiento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCrecimiento.getAt(0).data.resp,
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
								storeCrecimiento.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_crecimiento.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_crecimiento',
                store: storeCrecimiento,
                cm: colModelCrecimiento,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_crecimiento").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Crecimientos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeCrecimiento,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });
 
	
storeCrecimiento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_crecimiento.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	Ext.getCmp("gd_crecimiento").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_crecimiento").focus();
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
<div id="winTipoActivo" class="x-hidden">
    <div class="x-window-header">Elegir Tipo de Activo</div>
</div>
</body>
</html>