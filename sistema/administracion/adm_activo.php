<html>
<head>
<title>Activo</title>
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
 var winActivo;
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
        {header: "Cédula", width: 100, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		{header: "Telefono Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
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


/******************************************INICIO**StoreActivo******************************************/     

  var storeActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_activo.php',
		remoteSort : true,
		root: 'activos',
        totalProperty: 'total',
		idProperty: 'co_activo',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_activo.php'},
        fields: [{name: 'co_activo'},
				{name: 'nb_activo'},
				{name: 'tx_descripcion'},
				{name: 'co_sap'},
				{name: 'nu_serial'},
				{name: 'nu_etiqueta'},
				{name: 'bo_critico'},
				{name: 'bo_vulnerable'},
				{name: 'fe_incorporacion'},
				{name: 'nu_vida_util'},
				{name: 'co_activo_padre'},
				{name: 'co_estado'},
				{name: 'nb_estado'},
				{name: 'co_fabricante'},
				{name: 'nb_fabricante'},
				{name: 'co_indicador'},
				{name: 'nb_persona'},
				{name: 'co_ubicacion'},
				{name: 'nb_ubicacion'},
				{name: 'co_proceso'},
				{name: 'nb_proceso'},
				{name: 'co_proveedor'},
				{name: 'nb_proveedor'},
				{name: 'co_nivel'},
				{name: 'nb_nivel'},
				{name: 'co_tipo_activo'},
		        {name: 'nb_tipo_activo'},
		        {name: 'resp'}]
        });
    storeActivo.setDefaultSort('co_activo', 'ASC');

/*****************************************FIN****StoreActivo*****************************************/


/******************************************INICIO**colModelActivo******************************************/     

    var colModelActivo = new Ext.grid.ColumnModel([
        {id:'co_activo',header: "Activo", width: 80,  sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Nombre del Activo", width: 120, sortable: true, locked:false, dataIndex: 'nb_activo'},
     	{header: "Descripci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'tx_descripcion', renderer: descripcion},
      	{header: "C&oacute;digo SAP", width: 100, sortable: true, locked:false, dataIndex: 'co_sap'},
      	{header: "Serial", width: 80, sortable: true, locked:false, dataIndex: 'nu_serial'},
      	{header: "N&uacute;mero de Etiqueta", width: 120, sortable: true, locked:false, dataIndex: 'nu_etiqueta'},
      	{header: "Cr&iacute;tico", width: 80, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: critico},
      	{header: "Vulnerable", width: 80, sortable: true, locked:false, dataIndex: 'bo_vulnerable', renderer: vulnerable},
      	{header: "Fecha de Incorporaci&oacute;n", width: 140, sortable: true, locked:false, dataIndex: 'fe_incorporacion'},
      	{header: "Vida &Uacute;til", width: 90, sortable: true, locked:false, dataIndex: 'nu_vida_util'},
      	{header: "Activo Padre", width: 100, sortable: true, locked:false, dataIndex: 'co_activo_padre'},
      	{header: "Estado", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_estado'},
      	{header: "Estado", width: 100, sortable: true, locked:false, dataIndex: 'nb_estado'},
      	{header: "Fabricante1", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_fabricante'},
      	{header: "Fabricante", width: 100, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
      	{header: "Responsable", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_indicador'},
      	{header: "Responsable", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
      	{header: "Ubicacion", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_ubicacion'},
      	{header: "Ubicaci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},      
      	{header: "Proceso", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proceso'},
      	{header: "Proceso", width: 100, sortable: true, locked:false, dataIndex: 'nb_proceso'},      
      	{header: "Proveedor", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proveedor'},
      	{header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_nivel'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, locked:false, dataIndex: 'nb_nivel',renderer: nivel, },       
        {header: "Nivel de Obsolescencia", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Tipo de Activo", width: 250, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},

      ]);

/******************************************FIN****colModelActivo******************************************/     


/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var gridForm = new Ext.FormPanel({
        id: 'frm_activo',
        frame: true,
		labelAlign: 'center',
        title: 'Actualizar Activos',
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
			title: 'Activo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Código del Activo',
						xtype:'numberfield',
						id: 'co_activo',
                        name: 'co_activo',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:152
                    },{
                        fieldLabel: 'Serial N&ordm;&nbsp;',
						xtype:'numberfield',
						id: 'nu_serial',
						allowBlank:false,
                        name: 'nu_serial',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:152
                    },{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Cr&iacute;tico',
	            		allowBlank:false,
	            		id: 'bo_critico',
		                name: 'bo_critico',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'critico', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'critico', inputValue: 0},
			           			]
                    },{
                        fieldLabel: 'Fecha de Incorporaci&oacute;n',
						xtype:'datefield',
						id: 'fe_incorporacion',
                        name: 'fe_incorporacion',
                        width:152
                    },{
                        fieldLabel: 'Vida &Uacute;til',
						xtype:'numberfield',
						id: 'nu_vida_util',
						allowBlank:false,
                        name: 'nu_vida_util',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:150
                    },{
                        fieldLabel: 'Indicador',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        width:139
                    },{
                        fieldLabel: 'Responsable',
						xtype:'textfield',
						id: 'nb_persona',
						disabled:true,
						allowBlank:false,
                        name: 'nb_persona',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:150,
                        hidden: true,
						hideLabel: true,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },
                    GetCombo('co_estado','Estado'),
                    GetCombo('co_proceso','Proceso'),
                    GetCombo('co_tipo_activo','Tipo de Activo')]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_activo',
						allowBlank:false,
                        name: 'nb_activo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'N&ordm; Etiqueta',
						xtype:'numberfield',
						id: 'nu_etiqueta',
                        name: 'nu_etiqueta',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Vulnerable',
	            		id: 'bo_vulnerable',
		                name: 'bo_vulnerable',
			            columns: 2,
			            items: [
			                {boxLabel: 'SI', name: 'vulnerable', checked : true, inputValue: 1},
			                {boxLabel: 'NO', name: 'vulnerable', inputValue: 0},
			           			]
                    },{
                        fieldLabel: 'C&oacute;digo SAP',
						xtype:'numberfield',
						id: 'co_sap',
						allowBlank:false,
                        name: 'co_sap',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Activo Padre',
						xtype:'numberfield',
						id: 'co_activo_padre',
                        name: 'co_activo_padre',
                        emptyText : null,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:122
                    },
                    GetCombo('co_fabricante','Fabricante'),
                    GetCombo('co_ubicacion','Ubicaci&oacute;n'),
                    GetCombo('co_proveedor','Proveedor'),
                    GetCombo('co_nivel','Nivel de Obsolescencia')]
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
					//Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_activo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			iconCls: 'save',
			tooltip:'Guardar Activo',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_activo").getForm().getValues(false);	
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
								storeActivo.baseParams = {'accion': 'insertar'};
							else
								storeActivo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_activo" : "'+Ext.getCmp("co_activo").getValue()+'", ';
								columnas += '"nb_activo" : "'+Ext.getCmp("nb_activo").getValue()+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
								columnas += '"co_sap" : "'+Ext.getCmp("co_sap").getValue()+'", ';
								columnas += '"nu_serial" : "'+Ext.getCmp("nu_serial").getValue()+'", ';
								columnas += '"nu_etiqueta" : "'+Ext.getCmp("nu_etiqueta").getValue()+'", ';
								columnas += '"bo_critico" : "'+Ext.getCmp("bo_critico").getValue()+'", ';
								columnas += '"bo_vulnerable" : "'+Ext.getCmp("bo_vulnerable").getValue()+'", ';
								columnas += '"fe_incorporacion" : "'+convFecha(Ext.getCmp("fe_incorporacion").getValue())+'", ';
								columnas += '"nu_vida_util" : "'+Ext.getCmp("nu_vida_util").getValue()+'", ';
								columnas += '"co_activo_padre" : "'+Ext.getCmp("co_activo_padre").getValue()+'", ';
								columnas += '"co_estado" : "'+Ext.getCmp("co_estado").getValue()+'", ';
								columnas += '"co_fabricante" : "'+Ext.getCmp("co_fabricante").getValue()+'", ';
								columnas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'", ';
								columnas += '"co_ubicacion" : "'+Ext.getCmp("co_ubicacion").getValue()+'", ';
								columnas += '"co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'", ';
								columnas += '"co_proveedor" : "'+Ext.getCmp("co_proveedor").getValue()+'", ';
								columnas += '"co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'", ';
								columnas += '"co_nivel" : "'+Ext.getCmp("co_nivel").getValue()+'"}';
							storeActivo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_activo" : "'+Ext.getCmp("co_activo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_activo.php"},
										callback: function () {
										if(storeActivo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeActivo.getAt(0).data.resp, 
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
							storeActivo.baseParams = {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_activo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			iconCls: 'delete',
			hidden:true,
			tooltip:'Eliminar Activo',
			disabled: true,
			handler: function(){
										storeActivo.baseParams = {'accion': 'eliminar'};
										storeActivo.load({params:{
												"condiciones": '{ "co_activo" : "'+Ext.getCmp("co_activo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_activo.php"},
										callback: function () {
										if(storeActivo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeActivo.getAt(0).data.resp,
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
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_activo',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Activos',
                border: true,
                //tools: [{id:'save'},{id:'print'}],
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

function selActivo(){
	storeActivo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_activo.php"}});
	if(!winActivo){
				winActivo = new Ext.Window({
						applyTo : 'winActivo',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								id: 'gd_selActivo',
								store: storeActivo,
								cm: colModelActivo,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								loadMask: true,
								height: 200,
								title:'Lista de Activo',
								border: true,
								listeners: {
											delay: 10
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  iconCls: 'accept',
								  handler : function(){

										if(Ext.getCmp("gd_selActivo").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selActivo").getSelectionModel().getSelected();
											Ext.getCmp("co_activo_padre").setValue(record.data.co_activo);
											winActivo.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  iconCls: 'cancel',
								  handler : function(){
											winActivo.hide();
								  }
						}]
				});
		}
		winActivo.show();	
}

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
								title:'Lista de Persona',
								border: true,
								listeners: {

												delay: 10 
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  iconCls: 'accept',
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
								  iconCls: 'cancel',
								  handler : function(){
											winPersona.hide();
								  }
						}]
				});
		}
		winPersona.show();	
}
/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/

storeActivo.load({params: { start: 0, limit: 'ALL', accion:"refrescar", interfaz: "../interfaz/interfaz_activo.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

/****************************************************************************************************/

	Ext.getCmp("gd_activo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		//Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_activo").focus();
		nroReg=rowIdx;
		});

/********************************************************************************************************/


/******************************************TRIGGERS*******************************************/

var triggerActivo = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerActivo.onTriggerClick = selActivo;
		triggerActivo.applyToMarkup('co_activo_padre');

var triggerPersona = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPersona.onTriggerClick = selPersona;
		triggerPersona.applyToMarkup('co_indicador');

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
	<div id="winActivo" class="x-hidden">
    <div class="x-window-header">Ejegir Activo</div>
	</div>
	<div id="winPersona" class="x-hidden">
    <div class="x-window-header">Ejegir Persona</div>
	</div>
</body>
</html>