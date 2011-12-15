<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Plan de Logistica</title>
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
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/CheckColumn.js"></script>

	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/NumericFilter.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/gridfilters/filter/BooleanFilter.js"></script>
	<script type="text/javascript" src="../js/funciones.js?=00002"></script>
		<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowExpander.js"></script>
		<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/Spinner.js"></script>
		<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/SpinnerField.js"></script>
		<!--<script type="text/javascript" src="../js/tabs.js"></script>-->


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

/******************************************INICIO**StorePlanLogistica******************************************/     
	
  var storePlanLogistica = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_logistica.php',
		remoteSort : true,
		root: 'planeslogistica',
        totalProperty: 'total',
		idProperty: 'co_plan_logistica',
        fields: [{name: 'co_plan_logistica'},
       			{name: 'fe_elaboracion'},
        		{name: 'resp'}]
        });
    storePlanLogistica.setDefaultSort('co_plan_logistica', 'ASC');
    
/*****************************************FIN****StorePlanLogistica*****************************************/


/******************************************INICIO**colModelPlanLogistica******************************************/     

   var colModelPlanLogistica = new Ext.grid.ColumnModel([
   	
        {id:'co_plan_logistica',header: "Plan Logistica",hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_plan_logistica'},
        {header: "Elaboracion", width: 360, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
      ]);
	
/******************************************FIN****colModelPlanLogistica******************************************/     

/******************************************INICIO**StoreAlimentacion******************************************/     

  var storeAlimentacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_alimentacion.php',
		remoteSort : true,
		root: 'alimentos',
        totalProperty: 'total',
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

  var expanderAlimentacion = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Desayunos:</b> {ca_desayuno}</p>',
            '<p><b>Almuerzos:</b> {ca_almuerzo}</p>',
            '<p><b>Cenas:</b> {ca_cena}</p>',
            '<p><b>Personas:</b> {ca_persona}</p>'
        )
    });

/******************************************INICIO**colModelAlimentacion******************************************/     
	
	var sm3 = new Ext.grid.CheckboxSelectionModel();
    var colModelAlimentacion = new Ext.grid.ColumnModel([
    	expanderAlimentacion,
        {id:'co_alimentacion',header: "Codigo de Gestion", width: 680, sortable: true, locked:false, dataIndex: 'co_alimentacion'},
        //{header: "Nro de Desayunos", width: 125, sortable: true, locked:false, dataIndex: 'ca_desayuno'},
        //{header: "Nro de Almuerzos", width: 125, sortable: true, locked:false, dataIndex: 'ca_almuerzo'},
        //{header: "Nro de Cenas", width: 115, sortable: true, locked:false, dataIndex: 'ca_cena'},
        //{header: "Cantidad de Personas", width: 144, sortable: true, locked:false, dataIndex: 'ca_persona'},
        sm3,
      ]);

/******************************************FIN****colModelAlimentacion******************************************/     

function alimentacion_seleccionadas(){
      					var AlimentacionSeleccionadas = Ext.getCmp("gd_alimentacion").getSelectionModel().getSelections();
   						var seleccionadas = '[';
						for(var i=0; i<AlimentacionSeleccionadas.length; i++){
						seleccionadas += '{ "co_alimentacion" : "'+AlimentacionSeleccionadas[i].data.co_alimentacion+'", "co_plan_logistica": "'+Ext.getCmp('co_plan_logistica').getValue()+'"}';
						if(i < AlimentacionSeleccionadas.length-1)
						  seleccionadas += ', ';
						  }
						  seleccionadas += ']';
						  return seleccionadas;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }




/******************************************INICIO**StoreAlojamiento******************************************/     
	
  var storeAlojamiento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_alojamiento.php',
		remoteSort : true,
		root: 'alojamientos',
        totalProperty: 'total',
		idProperty: 'co_alojamiento',
        fields: [{name: 'co_alojamiento'},
        		{name: 'nb_establecimiento'},
        		{name: 'di_ubicacion'},
        		{name: 'bo_hotel'},
        		{name: 'bo_posada'},
        		{name: 'tx_telefono'},
        		{name: 'resp'}]
        });
    storeAlojamiento.setDefaultSort('co_alojamiento', 'ASC');
    
/*****************************************FIN****StoreAlojamiento*****************************************/

  var expanderAlojamiento  = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Direccion:</b> {di_ubicacion}</p>',
            '<p><b>Hotel:</b> {bo_hotel}</p>',
            '<p><b>Posada:</b> {bo_posada}</p>',
            '<p><b>Telefono:</b> {tx_telefono}</p>'
        )
    });

/******************************************INICIO**colModelAlojamiento******************************************/     
	
	var sm1 = new Ext.grid.CheckboxSelectionModel();
    var colModelAlojamiento = new Ext.grid.ColumnModel([
    	expanderAlojamiento,
        {id:'co_alojamiento',header: "Alojamiento", hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_alojamiento'},
        {header: "Nombre", width: 680, sortable: true, locked:false, dataIndex: 'nb_establecimiento'},
        //{header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'di_ubicacion'},
        //{header: "Hotel", width: 100, sortable: true, locked:false, dataIndex: 'bo_hotel', renderer: hotel},
        //{header: "Posada", width: 100, sortable: true, locked:false, dataIndex: 'bo_posada', renderer: hotel},
        //{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        sm1,
      ]);
	
/******************************************FIN****colModelAlojamiento******************************************/     
function alojamientos_seleccionados(){
      					var AlojamientoSeleccionados = Ext.getCmp("gd_alojamiento").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<AlojamientoSeleccionados.length; i++){
						seleccionados += '{ "co_alojamiento" : "'+AlojamientoSeleccionados[i].data.co_alojamiento+'", "co_plan_logistica": "'+Ext.getCmp('co_plan_logistica').getValue()+'"}';
						if(i < AlojamientoSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }

/******************************************INICIO**StoreTransporte******************************************/     

  var storeTransporte = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_transporte.php',
		remoteSort : true,
		root: 'transportes',
        totalProperty: 'total',
		idProperty: 'co_transporte',
        fields: [{name: 'co_transporte'},
       			{name: 'fe_elaboracion'},
       			{name: 'co_linea'},
       			{name: 'nb_linea'},
        		{name: 'tx_telefono'},
        		{name: 'di_oficina'},
				{name: 'co_vehiculo'},
				{name: 'tx_placa'},
		        {name: 'tx_marca'},
		        {name: 'tx_modelo'},
		        {name: 'tx_unidad'},
        		{name: 'resp'}]
        });
    storeTransporte.setDefaultSort('co_transporte', 'ASC');
    
/*****************************************FIN****StoreTransporte*****************************************/

/******************************************INICIO**colModelTransporte******************************************/     
    
    var sm4 = new Ext.grid.CheckboxSelectionModel();
    var colModelTransporte = new Ext.grid.ColumnModel([
        {id:'co_transporte',header: "Transporte", width: 100, hidden:false, sortable: true, locked:false, dataIndex: 'co_transporte'},
        {header: "Elaboracion", width: 100, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
        //{header: "Vehiculo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
		//{header: "Modelo", width: 160, sortable: true, locked:false, dataIndex: 'tx_modelo'},
		//{header: "Unidad", width: 160, sortable: true, locked:false, dataIndex: 'tx_unidad'},
      sm4,
      ]);
	
/******************************************FIN****colModelTransporte******************************************/     

function transportes_seleccionados(){
      					var TransporteSeleccionados = Ext.getCmp("gd_transporte").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<TransporteSeleccionados.length; i++){
						seleccionados += '{ "co_transporte" : "'+TransporteSeleccionados[i].data.co_transporte+'", "co_plan_logistica": "'+Ext.getCmp('co_plan_logistica').getValue()+'"}';
						if(i < TransporteSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }
	 function componente_seleccionado(){
 	var componente   = '{"co_plan_logistica" : "'+Ext.getCmp("co_plan_logistica").getValue()+'", ';
	componente += '"co_componente" : "'+Ext.getCmp("co_componente").getValue()+'"}';
		return componente;				
 	 }
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
		id:'frm_planlogistica',
		//labelAlign: 'right',
		labelWidth: 100, // label settings here cascade unless overridden
		frame:true,
		title: ':: Plan de logistica ::. ',
		bodyStyle:'padding:5px',
		width: 820,
		layout: 'fit',
		items: [{
				xtype:'fieldset',	
				autoHeight:true,
				border: false,
				items: [{
				   		xtype:'fieldset',
						id: 'frm1',
						disabled: true,
						labelAlign: 'center',
						width:775,
						buttonAlign:'center',
						title: 'Plan Logistica',
			            bodyStyle:'padding:5px 5px 0px 5px',
						items:[{
								layout: 'form',
								labelWidth:140,
								border:false,
								items: [{
			                        fieldLabel: 'Numero de Plan Logistica',
									xtype:'numberfield',
									id: 'co_plan_logistica',
			                        name: 'co_plan_logistica',
			                        //hidden: true,
									//hideLabel: true,
			                        width:160
			                    }, {
			                        fieldLabel: 'Fecha de Elaboracion',
									xtype:'datefield',
									vtype:'validos',
									id: 'fe_elaboracion',
			                        name: 'fe_elaboracion',
									style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
			                        width:140
			                    }, {
						xtype:'combo',
						fieldLabel: 'Componente',
		         		store: new Ext.data.JsonStore({
						url: '../interfaz/interfaz_combo.php',
						   root: 'Resultados',
						   idProperty: 'co_componente',
						   baseParams: {accion:'componente'},
						   fields:['co_componente','fe_vigencia']
						  }),
						id:'co_componente',
						valueField:'co_componente',
				        displayField:'fe_vigencia',
				        typeAhead: true,
				        allowBlank: false,
				        mode: 'remote',
				        forceSelection: true,
				        triggerAction: 'all',
				        emptyText:'Selecione',
				        selectOnFocus:true
         				}]
						}]
						},{			
						xtype: 'tabpanel',
						id: 'tabPanel',
						disabled: true,
						resizeTabs: true,
						enableTabScroll: true,
						deferredRender: false,
						layoutOnTabChange: true,
						activeTab: 0,
						//layout: 'fit',
						bodyStyle:'padding:5px; background-color: #f1f1f1;',
						items: [{
								title: 'Logistica',
								id: 'tablogistica',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_planlogistica',
						                store: storePlanLogistica,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelPlanLogistica,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Plan Logistica',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storePlanLogistica,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
									}]
									},{
								title: 'Alimentacion',
								id: 'tabalimentacion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
						                xtype: 'grid',
										id: 'gd_alimentacion',
						                store: storeAlimentacion,
						                cm: colModelAlimentacion,
						                stripeRows: true,
						               	plugins: expanderAlimentacion,
						               	clicksToEdit: 1,
						                iconCls: 'icon-grid',
						                sm: sm3,
						                height: 250,
										//width:670,
										title:'Lista de Alimentacion',
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
									},{
								title: 'Alojamiento',
								id: 'tabalojamiento',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
						                xtype: 'grid',
										id: 'gd_alojamiento',
						                store: storeAlojamiento,
						                cm: colModelAlojamiento,
						                plugins: expanderAlojamiento,
						                stripeRows: true,
						                iconCls: 'icon-grid',
						                sm:sm1,
						                height: 250,
										title:'Lista de Alojamiento',
						                border: true,
										bbar: new Ext.PagingToolbar({
										store: storeAlojamiento,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
						            }]
									},{
								title: 'Transporte',
								id: 'tabtransporte',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
						                xtype: 'grid',
										id: 'gd_transporte',
						                store: storeTransporte,
						                cm: colModelTransporte,
						                iconCls: 'icon-grid',
						                sm:sm4,
						                height: 250,
										title:'Lista de Transportes',
						                border: true,
										bbar: new Ext.PagingToolbar({
										store: storeTransporte,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
						            }]
									}]
							}]
							}],
				buttons: [{
					text: 'Nuevo',
					id: 'btnNuevo',
					//disabled: true,
					handler: function(){
							nuevo=true;	
							Ext.getCmp("btnGuardarPlan").enable();
							Ext.getCmp("btnEliminarPlan").enable();
							Ext.getCmp("btnGuardarPlan").enable();
							if(Ext.getCmp("tabPanel").disabled){
								Ext.getCmp("frm1").enable();
								Ext.getCmp("tabPanel").enable();
								//Ext.getCmp("frm3").enable();
							}
					}
				}, {
			text: 'Guardar', 
			id: 'btnGuardarPlan',
			iconCls: 'save',
			tooltip:'Guardar Plan',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_planlogistica").getForm().getValues(false);	
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
								storePlanLogistica.baseParams = {'accion': 'insertar'};
							else
								storePlanLogistica.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_plan_logistica" : "'+Ext.getCmp("co_plan_logistica").getValue()+'", ';
							columnas += '"fe_elaboracion" : "'+convFecha(Ext.getCmp("fe_elaboracion").getValue())+'"}';
							storePlanLogistica.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_plan_logistica" : "'+Ext.getCmp("co_plan_logistica").getValue()+'"}', 
												"nroReg":nroReg,"componente": componente_seleccionado(), "palimentaciones" : alimentacion_seleccionadas(), "palojamientos" : alojamientos_seleccionados(), "ptransportes" : transportes_seleccionados(), start:0, limit:30, interfaz: "../interfaz/interfaz_plan_logistica.php"},
										callback: function () {
										if(storePlanLogistica.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePlanLogistica.getAt(0).data.resp, 
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
							storePlanLogistica.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_plan_logistica.php'};
						}
				}
			},{
			id: 'btnEliminarPlan',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Plan',
			disabled: true,
			handler: function(){
										storePlanLogistica.baseParams = {'accion': 'eliminar'};
										storePlanLogistica.load({params:{
												"condiciones": '{ "co_plan_logistica" : "'+Ext.getCmp("co_plan_logistica").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_plan_logistica.php"},
										callback: function () {
										if(storePlanLogistica.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePlanLogistica.getAt(0).data.resp,
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
							}})}
			}],
		listeners: {
			afterrender: function (){ 
			}
		}
		});
		
storeTransporte.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_transporte.php"}});
storeAlojamiento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alojamiento.php"}});
storeAlimentacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alimentacion.php"}});
storePlanLogistica.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_plan_logistica.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/
/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/

/***************************************************************************************************/
	
	Ext.getCmp("gd_planlogistica").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardarPlan").enable();
		Ext.getCmp("btnEliminarPlan").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_plan_logistica").focus();
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