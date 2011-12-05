<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Equipo Requerido</title>
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
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowExpander.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/CheckColumn.js"></script>
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
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_persona.php'},
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
        {header: "Cedula", width: 100, sortable: true, locked:false, dataIndex: 'nu_cedula'},
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

/******************************************INICIO**StoreEquipo******************************************/     
 
    var storeEquipo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo.php',
		remoteSort : true,
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_equipo.php'},
		root: 'equipos',
        totalProperty: 'total',
		idProperty: 'co_equipo',
        fields: [{name: 'co_equipo'},
				{name: 'nb_equipo'},
				{name: 'tx_descripcion'},
				{name: 'bo_obsoleto'},
        		{name: 'resp'}]
        });
    storeEquipo.setDefaultSort('co_equipo', 'ASC');
	
/*****************************************FIN****StoreEquipo*****************************************/
    var expanderEquipo = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Descripcion:</b> {tx_descripcion}</p>'
        )
    });
/******************************************INICIO**colModelEquipo******************************************/     
	var sm1 = new Ext.grid.CheckboxSelectionModel();
    var colModelEquipo = new Ext.grid.ColumnModel([
    	expanderEquipo,
        {id:'co_equipo',header: "Equipo", width: 200, hidden:true, sortable: true, locked:false, dataIndex: 'co_equipo'},
        {header: "Equipo", width: 355, sortable: true, locked:false, dataIndex: 'nb_equipo'},
		//{header: "Obsoleto", width: 60, sortable: true, locked:false, dataIndex: 'bo_obsoleto', renderer: obsoleto},
        //{header: "Descripcion", width: 200, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
		sm1,
      ]);
		
/******************************************FIN****colModelEquipo******************************************/     
function equipos_seleccionados(){
      					var EquiposSeleccionados = Ext.getCmp("gd_equipo").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<EquiposSeleccionados.length; i++){
						seleccionados += '{ "co_equipo" : "'+EquiposSeleccionados[i].data.co_equipo+'", "co_equipo_requerido": "'+Ext.getCmp('co_equipo_requerido').getValue()+'"}';
						if(i < EquiposSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }

/******************************************INICIO**StoreEquipoR******************************************/     
 
    var storeEquipoR = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo_requerido.php',
		remoteSort : true,
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_equipo_requerido.php'},
		root: 'equiposrequeridos',
        totalProperty: 'total',
		idProperty: 'co_equipo_requerido',
        fields: [{name: 'co_equipo_requerido'},
				{name: 'bo_principal'},
				{name: 'co_indicador'},
        		{name: 'resp'}]
        });
    storeEquipoR.setDefaultSort('co_equipo_requerido', 'ASC');
	
/*****************************************FIN****StoreEquipoR*****************************************/

/******************************************INICIO**colModelEquipoR******************************************/     
	
    var colModelEquipoR = new Ext.grid.ColumnModel([
        {id:'co_equipo_requerido',header: "Equipo", width: 200, hidden:false, sortable: true, locked:false, dataIndex: 'co_equipo_requerido'},
        {header: "Principal", width: 100,hidden: false, sortable: true, locked:false, dataIndex: 'bo_principal', renderer: principal},
        ]);
		
/******************************************FIN****colModelEquipo******************************************/     

/******************************************INICIO**StoreTipoActivo******************************************/     
      
  var storeTipoActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_activo.php',
		remoteSort : true,
		root: 'tpactivos',
        totalProperty: 'total',
		idProperty: 'co_tipo_activo',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_tipo_activo.php'},
        fields: [{name: 'co_tipo_activo'},
		        {name: 'nb_tipo_activo'},
		        {name: 'co_categoria'},
		        {name: 'nb_categoria'},
		        {name: 'co_servicio'},
		        {name: 'nb_servicio'},
		        {name: 'resp'}]
        });
    storeTipoActivo.setDefaultSort('co_tipo_activo', 'ASC');
    
/*****************************************FIN****StoreTipoActivo*****************************************/
  var expanderTpActivo = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Categoria:</b> {nb_categoria}</p>',
            '<p><b>Servicio:</b> {nb_servicio}</p>'
        )
    });

    
/******************************************INICIO**colModelTipoActivo******************************************/     
   var sm2 = new Ext.grid.CheckboxSelectionModel(); 
    var colModelTipoActivo = new Ext.grid.ColumnModel([
    	expanderTpActivo,
        {id:'co_tipo_activo',header: "Tipo Activo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Tipo", width: 340, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
        //{header: "co_Categoria", width: 100, sortable: true, locked:false,hidden:true, dataIndex: 'co_categoria'},      
		//{header: "Categoria", width: 100, sortable: true, locked:false, dataIndex: 'nb_categoria'},
		//{header: "co_Servicio", width: 100, sortable: true,hidden:true, locked:false, dataIndex: 'co_servicio'},
		//{header: "Servicio", width: 100, sortable: true, locked:false, dataIndex: 'nb_servicio'},
      sm2,
      ]);
	
/******************************************FIN****colModelTipoActivo******************************************/     

function tpactivos_seleccionados(){
      					var TpActivosSeleccionados = Ext.getCmp("gd_tipo_activo").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<TpActivosSeleccionados.length; i++){
						seleccionados += '{ "co_tipo_activo" : "'+TpActivosSeleccionados[i].data.co_tipo_activo+'", "co_equipo_requerido": "'+Ext.getCmp('co_equipo_requerido').getValue()+'"}';
						if(i < TpActivosSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }

function equipo_persona_seleccionados(){
      					var EquipoPersonaSeleccionados = Ext.getCmp("gd_equipo").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<EquipoPersonaSeleccionados.length; i++){
						seleccionados += '{ "co_equipo" : "'+EquipoPersonaSeleccionados[i].data.co_equipo+'", "co_indicador": "'+Ext.getCmp('co_indicador').getValue()+'"}';
						if(i < EquipoPersonaSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_equipo_requerido',
        frame: true,
		labelAlign: 'center',
        title: 'Equipo',
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
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.50,
					border:false,
					items: [{
                        fieldLabel: 'Numero de Equipo',
						xtype:'numberfield',
						id: 'co_equipo_requerido',
                        name: 'co_equipo_requerido',
                       // hidden: true,
						//hideLabel: true,
                        width:120
                    },{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                       // hidden: true,
						//hideLabel: true,
                        width:120
                    }]
			},{
					layout: 'form',
					labelWidth:140,
					columnWidth:.50,
					border:false,
					items: [{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Rol',
	            		id: 'bo_principal',
		                name: 'bo_principal',
			            columns: 2,
			            items: [
			                {boxLabel: 'Principal', name: 'principal', checked : true, inputValue: 1},
			                {boxLabel: 'Suplente', name: 'principal', inputValue: 0},
			           			]
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
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_equipo_requerido").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			iconCls: 'save',
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_equipo_requerido").getForm().getValues(false);	
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
								storeEquipoR.baseParams = {'accion': 'insertar'};

							else
								storeEquipoR.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'", ';
							columnas += '"bo_principal" : "'+Ext.getCmp("bo_principal").getValue()+'"}';
							var personas   = '{"co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'", ';
							personas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}';
							storeEquipoR.load({params:{"necesarios":equipo_persona_seleccionados(),"tpactivos": tpactivos_seleccionados(),"equipos": equipos_seleccionados(), "columnas" : columnas, "personas" : personas, "condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_equipo_requerido.php"},
										callback: function () {
										if(storeEquipoR.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeEquipoR.getAt(0).data.resp, 
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
							storeEquipoR.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_equipo_requerido.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Equipo',
			disabled: true,
			iconCls: 'delete',
			handler: function(){
										storeEquipoR.baseParams = {'accion': 'eliminar'};
										storeEquipoR.load({params:{"condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_equipo_requerido.php"},
										callback: function () {
										storeEquipoR.baseParams = {'accion': 'refrescar'};
										if(storeEquipoR.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeEquipoR.getAt(0).data.resp,
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
							storeEquipoR.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_equipo_requerido.php'};
							}})}
			}]
			},{
					layout:'column',
					border: true,
					width:800,
					items:[{
					columnWidth:.50,
					border:false,
					width:398,
					stripeRows: true,
	                xtype: 'grid',
					id: 'gd_tipo_activo',
	                store: storeTipoActivo,
	                cm: colModelTipoActivo,
					sm: sm2,
	                height: 250,
	                iconCls: 'icon-grid',
	                plugins: expanderTpActivo,
					title:'Tipo de Activos',
					/*tbar:[{
			            text:'Agregar Vehiculo',
			            tooltip:'Agregar Nuevo Vehiculo',
			            handler: AgregarVehiculo,
			            iconCls:'add'
			        }],*/
	                border: true,
					bbar: new Ext.PagingToolbar({
					store: storeTipoActivo,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
	            },{
					columnWidth:.50,
					border:false,
	                xtype: 'grid',
					id: 'gd_equipo',
	                store: storeEquipo,
	                cm: colModelEquipo,
	                stripeRows: true,
	                height: 250,
	                iconCls: 'icon-grid',
					title:'Equipos Necesarios',
					sm: sm1,
					plugins: expanderEquipo,
					/*tbar:[{
			            text:'Agregar Linea de Taxi',
			            tooltip:'Agregar Nueva Linea',
			            handler: AgregarLinea,
			            iconCls:'add'
			        }],*/
	                border: true,
					bbar: new Ext.PagingToolbar({
					store: storeEquipo,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
	            }]
			
		},{
					layout:'column',
					border: true,
					width:800,
					items:[{
					columnWidth:.90,
					border:false,
					width:800,
					stripeRows: true,
	                xtype: 'grid',
					id: 'gd_equipo_requerido',
	                store: storeEquipoR,
	                cm: colModelEquipoR,
					//sm: sm3,
	                height: 250,
	                iconCls: 'icon-grid',
	                //plugins: expanderVehiculo,
					title:'Equipos Requerido',
	                border: true,
	                listeners: {
						handler : function(){
										if(Ext.getCmp("gd_transporte").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_transporte").getSelectionModel().getSelected();
											Ext.getCmp("co_transporte").setValue(record.data.co_transporte);
										}
								  }
	                },
					bbar: new Ext.PagingToolbar({
					store: storeEquipoR,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
	            }]
			
		}],
        
    });


/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

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
								//ds: ds,
								id: 'gd_selPersona',
								store: storePersona,
								cm: colModelPersona,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Persona',
								border: true,
								listeners: {
												/*render: function(g) {
													g.getSelectionModel().selectRow(0);
									r			},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  iconCls: 'accept',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selPersona").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selPersona").getSelectionModel().getSelected();
											Ext.getCmp("co_indicador").setValue(record.data.co_indicador);
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
storeTipoActivo.load({params: { start: 0, limit: 10, accion:"refrescar", interfaz: "../interfaz/interfaz_tipo_activo.php"}});
storeEquipo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo.php"}});	
storeEquipoR.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_requerido.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

/****************************************************************************************************/
	Ext.getCmp("gd_equipo_requerido").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_equipo_requerido").focus();
		nroReg=rowIdx;
		
});

/********************************************************************************************************/


/******************************************TRIGGERS*******************************************/

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
<div id="winPersona" class="x-hidden">
    <div class="x-window-header">Ejegir Persona</div>	
</div>
</body>
</html>