<html>
<head>
<title>Equipo</title>
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
        {header: "Equipo", width: 340, sortable: true, locked:false, dataIndex: 'nb_equipo'},
		//{header: "Obsoleto", width: 60, sortable: true, locked:false, dataIndex: 'bo_obsoleto', renderer: obsoleto},
        //{header: "Descripcion", width: 200, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
		sm1,
      ]);
		
/******************************************FIN****colModelEquipo******************************************/     


/******************************************INICIO**StoreEquipoR******************************************/     
 
    var storeEquipoR = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo_requerido.php',
		remoteSort : true,
		root: 'equiposrequeridos',
        totalProperty: 'total',
		idProperty: 'co_equipo_requerido',
        fields: [{name: 'co_equipo_requerido'},
				{name: 'nb_tipo_activo'},
				{name: 'co_indicador'},
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
    storeEquipoR.setDefaultSort('co_equipo_requerido', 'ASC');
	
/*****************************************FIN****StoreEquipoR*****************************************/

  var expanderPersona = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Telefono:</b> {tx_telefono_oficina}</p>',
            '<p><b>Direccion:</b> {di_oficina}</p>'
        )
    });
    
/******************************************INICIO**colModelEquipoR******************************************/     
	
    var colModelEquipoR = new Ext.grid.ColumnModel([
    	expanderPersona,
        {id:'co_equipo_requerido',header: "Equipo", width: 200, hidden:true, sortable: true, locked:false, dataIndex: 'co_equipo_requerido'},
        {header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
		{header: "Indicador", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
		{header: "Cedula", width: 100, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
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
        {header: "Apellido", width: 80, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Telefono Oficina", width: 150, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Telefono Habitacion", width: 150, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        ]);
		
/******************************************FIN****colModelEquipo******************************************/     

/******************************************INICIO**StoreTipoActivo******************************************/     
      
  var storeTipoActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_activo.php',
		remoteSort : true,
		root: 'tpactivos',
        totalProperty: 'total',
		idProperty: 'co_tipo_activo',
		baseParams: {start:0, limit:10, accion: "refrescar", interfaz: '../interfaz/interfaz_tipo_activo.php'},
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
        {header: "Nombre", width: 325, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
        //{header: "co_Categoria", width: 100, sortable: true, locked:false,hidden:true, dataIndex: 'co_categoria'},      
		//{header: "Categoria", width: 100, sortable: true, locked:false, dataIndex: 'nb_categoria'},
		//{header: "co_Servicio", width: 100, sortable: true,hidden:true, locked:false, dataIndex: 'co_servicio'},
		//{header: "Servicio", width: 100, sortable: true, locked:false, dataIndex: 'nb_servicio'},
      sm2,
      ]);
	
/******************************************FIN****colModelTipoActivo******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_equipo_requerido',
        frame: true,
		labelAlign: 'center',
        title: 'Equipo Requerido',
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
			title: 'Equipo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:100,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero',
						xtype:'numberfield',
						id: 'co_equipo_requerido',
                        name: 'co_equipo_requerido',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:158
                    },{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        //allowBlank:false,
                        //hidden: true,
						//hideLabel: true,
                        width:120
                    },{
                        fieldLabel: 'Numero Equipo',
						xtype:'numberfield',
						id: 'co_equipo',
                        name: 'co_equipo',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Numero Equipo',
						xtype:'numberfield',
						id: 'co_tipo_activo',
                        name: 'co_tipo_activo',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
                 },{
					layout: 'form',
					width:398,
					columnWidth:.50,
					border:true,
					items: [{
		                xtype: 'grid',
		                width:400,
						id: 'gd_tpactivo',
		                store: storeTipoActivo,
		                cm: colModelTipoActivo,
		                sm: sm2,
		                stripeRows: true,
		                iconCls: 'icon-grid',
		                plugins: expanderTpActivo,
		                height: 250,
						title:'Lista de Tipo Activo',
		                border: true,
                		sm: new Ext.grid.RowSelectionModel({
                    	singleSelect: true,
                    	listeners: {
                        rowselect: function() 	{	
                        
                        if(Ext.getCmp("gd_tpactivo").getSelectionModel().getSelected()){
						var record = Ext.getCmp("gd_tpactivo").getSelectionModel().getSelected();
						Ext.getCmp("co_tipo_activo").setValue(record.data.co_tipo_activo);
										}
                    	}
                    	}
                		}),
						bbar: new Ext.PagingToolbar({
						store: storeTipoActivo,
						width:400,
						pageSize: 10,
						displayInfo: true,
						displayMsg: 'Mostrando registros {0} - {1} de {2}',
						emptyMsg: "No hay registros que mostrar",
						})
           				 }]
				},{
					layout: 'form',
					labelWidth:130,
					columnWidth:.50,
					border:true,
					items: [{
		                xtype: 'grid',
		                width:400,
						id: 'gd_equipo',
		                store: storeEquipo,
		                sm: sm1,
		                cm: colModelEquipo,
		                plugins: expanderEquipo,
		                stripeRows: true,
		                iconCls: 'icon-grid',
		                height: 250,
						title:'Lista de Equipo',
		                border: true,
                		sm: new Ext.grid.RowSelectionModel({
                    	singleSelect: true,
                    	listeners: {
                        rowselect: function() 	{	
                        
                        if(Ext.getCmp("gd_equipo").getSelectionModel().getSelected()){
						var record = Ext.getCmp("gd_equipo").getSelectionModel().getSelected();
						Ext.getCmp("co_equipo").setValue(record.data.co_equipo);
										}
                    	}
                    	}
                		}),
						bbar: new Ext.PagingToolbar({
							width:400,
						store: storeEquipo,
						pageSize: 50,
						displayInfo: true,
						displayMsg: 'Mostrando registros {0} - {1} de {2}',
						emptyMsg: "No hay registros que mostrar",
						})
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
					Ext.getCmp("co_equipo_requerido").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Equipo Requerido',
			iconCls: 'save',
			disabled: true,
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
							columnas += '"co_equipo" : "'+Ext.getCmp("co_equipo").getValue()+'", ';
							columnas += '"co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'", ';
							columnas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}';

							storeEquipoR.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_equipo_requerido.php"},
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
			iconCls: 'delete', 
			tooltip:'Eliminar Equipo',
			disabled: true,
			handler: function(){
										storeEquipoR.baseParams = {'accion': 'eliminar'};
										storeEquipoR.load({params:{
												"condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_equipo_requerido.php"},
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
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_equipo_requerido',
                store: storeEquipoR,
                cm: colModelEquipoR,
                stripeRows: true,
                iconCls: 'icon-grid',
                plugins: expanderPersona,
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_equipo_requerido").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Equipo',
                border: true,
                listeners: {
                    viewready: function(g) {
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