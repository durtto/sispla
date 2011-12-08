<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Plan de Localizaci&oacute;n</title>
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
 var winProveedor;
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

/******************************************INICIO**StorePlanLocalizacion******************************************/     
	
  var storePlanLocalizacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_plan_localizacion.php',
		remoteSort : true,
		root: 'planeslocalizacion',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_plan_localizacion.php"},
        totalProperty: 'total',
		idProperty: 'co_plan_localizacion',
        fields: [{name: 'co_plan_localizacion'},
       			{name: 'fe_elaboracion'},
        		{name: 'resp'}]
        });
    storePlanLocalizacion.setDefaultSort('co_plan_localizacion', 'ASC');
    
/*****************************************FIN****StorePlanLocalizacion*****************************************/
/******************************************INICIO**colModelPlanLocalizacion******************************************/     

   var colModelPlanLocalizacion = new Ext.grid.ColumnModel([
   	
        {id:'co_plan_localizacion',header: "Plan Localizacion",hidden:true, width: 100, sortable: true, locked:false, dataIndex: 'co_plan_localizacion'},
        {header: "Fecha de Elaboraci&oacute;n", width: 150, sortable: true, locked:false, dataIndex: 'fe_elaboracion'},
      ]);
	
/******************************************FIN****colModelPlanLocalizacion******************************************/     

/******************************************INICIO**StoreProveedor******************************************/     
	
  var storeProveedor = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proveedor.php',
		remoteSort : true,
		root: 'proveedores',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_proveedor.php"},
        totalProperty: 'total',
		idProperty: 'co_proveedor',
        fields: [{name: 'co_proveedor'},
        		{name: 'nb_proveedor'},
        		{name: 'di_oficina'},
        		{name: 'tx_servicio_prestado'},
        		{name: 'co_contacto'},
        		{name: 'nb_contacto'},
		        {name: 'tx_apellido'},
		        {name: 'tx_telefono'},
		        {name: 'tx_correo_electronico'},
        		{name: 'resp'}]
        });
    storeProveedor.setDefaultSort('co_proveedor', 'ASC');
    
/*****************************************FIN****StoreProveedor*****************************************/

var expanderContacto = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Nombre:</b> {nb_contacto}</p>',
            '<p><b>Apellido:</b> {tx_apellido}</p>',
            '<p><b>Tel&eacute;fono:</b> {tx_telefono}</p>',
            '<p><b>Correo Electr&oacute;nico:</b> {tx_correo_electronico}</p>'
            
        )
    });

/******************************************INICIO**colModelProveedor******************************************/     
    var sm2 = new Ext.grid.CheckboxSelectionModel();
    var colModelProveedor = new Ext.grid.ColumnModel([
    	expanderContacto,
        {id:'co_proveedor',header: "Proveedor", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Nombre", width: 380, sortable: true, locked:false, dataIndex: 'nb_proveedor'},
        {header: "Direcci&oacute;n", width: 330, sortable: true, locked:false, dataIndex: 'di_oficina'},
        //{header: "Servicio que Presta", width: 450, sortable: true, locked:false, dataIndex: 'tx_servicio_prestado'},
      	//{header: "Contacto", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_contacto'},
      	//{header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		//{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
       	// {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 120, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
      sm2,
      ]);
	
/******************************************FIN****colModelProveedor******************************************/     
function proveedores_seleccionados(){
      					var ProveedorSeleccionados = Ext.getCmp("gd_proveedor").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<ProveedorSeleccionados.length; i++){
						seleccionados += '{ "co_proveedor" : "'+ProveedorSeleccionados[i].data.co_proveedor+'", "co_plan_localizacion": "'+Ext.getCmp('co_plan_localizacion').getValue()+'"}';
						if(i < ProveedorSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }

/******************************************INICIO**StoreContacto******************************************/     
      
  var storeContacto = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_contacto_proveedor.php',
		remoteSort : true,
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_contacto_proveedor.php"},
		root: 'contactos',
        totalProperty: 'total',
		idProperty: 'co_contacto',
        fields: [{name: 'co_contacto'},
		        {name: 'nb_contacto'},
		        {name: 'tx_apellido'},
		        {name: 'di_oficina'},
		        {name: 'tx_telefono'},
		        {name: 'tx_correo_electronico'},
		        {name: 'co_proveedor'},
		        {name: 'nb_proveedor'},
		        {name: 'resp'}]
        });
    storeContacto.setDefaultSort('co_contacto', 'ASC');
    
/*****************************************FIN****StoreContacto*****************************************/



/******************************************INICIO**colModelContacto******************************************/     
    
    var colModelContacto = new Ext.grid.ColumnModel([
        {id:'co_contacto',header: "Contacto", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_contacto'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Direcci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Tel&oacute;fono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        {header: "Correo Electr&oacute;nico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Proveedor", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
      ]);
	
/******************************************FIN****colModelContacto******************************************/     


/******************************************INICIO**StoreDirectorio******************************************/     
  
      
  var storeDirectorio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_directorio.php',
		remoteSort : true,
		root: 'directorios',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_directorio.php"},
        totalProperty: 'total',
		idProperty: 'co_directorio',
        fields: [{name: 'co_directorio'},
		        {name: 'nb_directorio'},
		        {name: 'nb_tipo_directorio'},
		        {name: 'nu_telefono'},
		        {name: 'resp'}]
        });
    storeDirectorio.setDefaultSort('co_directorio', 'ASC');
    
/*****************************************FIN****StoreDirectorio*****************************************/
/******************************************INICIO**colModelDirectorio******************************************/     
   var sm3 = new Ext.grid.CheckboxSelectionModel();
    var colModelDirectorio = new Ext.grid.ColumnModel([
        {id:'co_directorio',header: "Directorio", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_directorio'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_directorio'},
        {header: "Tipo Directorio", width: 150, sortable: true, locked:false, dataIndex: 'nb_tipo_directorio'},
        {header: "N&uacute;mero Telefonico", width: 150, sortable: true, locked:false, dataIndex: 'nu_telefono'},
      sm3,
      ]);
      
/******************************************FIN****colModelDirectorio******************************************/     
function directorios_seleccionados(){
      					var DirectorioSeleccionados = Ext.getCmp("gd_directorio").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<DirectorioSeleccionados.length; i++){
						seleccionados += '{ "co_directorio" : "'+DirectorioSeleccionados[i].data.co_directorio+'", "co_plan_localizacion": "'+Ext.getCmp('co_plan_localizacion').getValue()+'"}';
						if(i < DirectorioSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }
						  
						  
/******************************************INICIO**StorePersona******************************************/     
      
      var storeEquipoContinuidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo_continuidad.php',
		remoteSort : true,
		root: 'equipos',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_equipo_continuidad.php"},
		idProperty: 'co_equipo_continuidad',
        fields: [{name: 'co_equipo_continuidad'},
        		{name: 'co_indicador'},
         		{name: 'nu_cedula'},
		        {name: 'nb_persona'},
		        {name: 'tx_apellido'},
		        {name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
        	    {name: 'resp'}]
        });
    storeEquipoContinuidad.setDefaultSort('co_equipo_continuidad', 'ASC');
    
/*****************************************FIN****StorePersona*****************************************/




/******************************************INICIO**colModelPersona******************************************/     
	var sm4 = new Ext.grid.CheckboxSelectionModel();
    var colModelEquipoContinuidad = new Ext.grid.ColumnModel([
        {id:'co_equipo_continuidad', hidden: true, header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_equipo_continuidad'},
        {header: "co_indicador", width: 150, sortable: true, locked:false, dataIndex: 'co_indicador'},
        //{header: "Cedula", width: 150, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 150, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        //{header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        //{header: "Departamento", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        //{header: "Departamento", width: 200, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
     	//{header: "Rol", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol'},
        //{header: "Rol", width: 200, sortable: true, locked:false, dataIndex: 'nb_rol'},      
      	{header: "Responsabilidad", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Responsabilidad", width: 180, dataIndex: 'nb_rol_resp'},
        sm4,
      	//{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        //{header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	//{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        //{header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},      
      ]);
function equipos_seleccionados(){
      					var EquipoSeleccionados = Ext.getCmp("gd_equipo").getSelectionModel().getSelections();
   						var seleccionados = '[';
						for(var i=0; i<EquipoSeleccionados.length; i++){
						seleccionados += '{ "co_equipo_continuidad" : "'+EquipoSeleccionados[i].data.co_equipo_continuidad+ '","co_plan_localizacion": "'+Ext.getCmp('co_plan_localizacion').getValue()+'"}';
						if(i < EquipoSeleccionados.length-1)
						  seleccionados += ', ';
						  }
						  seleccionados += ']';
						  return seleccionados;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }


var storePersona = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_persona.php',
		remoteSort : true,
		root: 'personas',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_persona.php"},
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
   var expanderPersona = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>C&eacute;dula:</b> {nu_cedula}</p>',
            '<p><b>Apellido:</b> {di_oficina}</p>',
            '<p><b>Tel&eacute;fono:</b> {tx_telefono_oficina}</p>',
            '<p><b>Correo Electr&oacute;nico:</b> {tx_correo_electronico}</p>',
            '<p><b>Rol:</b> {nb_rol}</p>',
            '<p><b>Grupo:</b> {nb_grupo}</p>',
            '<p><b>Guardia:</b> {nb_guardia}</p>'
        )
    });

   var sm1 = new Ext.grid.CheckboxSelectionModel();
//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelPersona = new Ext.grid.ColumnModel([
    	expanderPersona,
        {id:'co_indicador',header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "C&eacute;dula", width: 100, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 110, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 120, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        //{header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        //{header: "Departamento", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        //{header: "Departamento", width: 100, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
     	//{header: "Rol", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol'},
        //{header: "Rol", width: 100, sortable: true, locked:false, dataIndex: 'nb_rol'},      
      	//{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        //{header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	//{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        //{header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},
      sm1,
      ]);

function personas_seleccionadas(){
      					var PersonaSeleccionadas = Ext.getCmp("gd_persona").getSelectionModel().getSelections();
   						var seleccionadas = '[';
						for(var i=0; i<PersonaSeleccionadas.length; i++){
						seleccionadas += '{ "co_indicador" : "'+PersonaSeleccionadas[i].data.co_indicador+'", "co_plan_localizacion": "'+Ext.getCmp('co_plan_localizacion').getValue()+'"}';
						if(i < PersonaSeleccionadas.length-1)
						  seleccionadas += ', ';
						  }
						  seleccionadas += ']';
						  return seleccionadas;
						   //Ext.MessageBox.alert('Probando', seleccionados);
						  }
						  

	
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
		id:'frm_planlocalizacion',
		//labelAlign: 'right',
		labelWidth: 100, // label settings here cascade unless overridden
		frame:true,
		title: ':: Plan de localizaci&oacute;n ::',
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
						title: 'Plan de Localizaci&oacute;n',
			            bodyStyle:'padding:5px 5px 0px 5px',
						items:[{
								layout: 'form',
								labelWidth:140,
								border:false,
								items: [{
			                        fieldLabel: 'N&uacute;mero de Plan Localizaci&oacute;n',
									xtype:'numberfield',
									id: 'co_plan_localizacion',
			                        name: 'co_plan_localizacion',
			                        //hidden: true,
									//hideLabel: true,
			                        width:160
			                    }, {
			                        fieldLabel: 'Fecha de Elaboraci&oacute;n',
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
								title: 'Planes',
								id: 'tablocalizacion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_planlocalizacion',
						                store: storePlanLocalizacion,
						                stripeRows: true,
					                	iconCls: 'icon-grid',
						                cm: colModelPlanLocalizacion,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Lista de Planes de Localizaci&oacute;n',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storePlanLocalizacion,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
									}]
									},{
								title: 'Personal',
								id: 'tabpersona',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
						                xtype: 'grid',
										id: 'gd_persona',
						                store: storePersona,
						                cm: colModelPersona,
						                stripeRows: true,
						               	plugins: expanderPersona,
						               	iconCls: 'icon-grid',
						                sm: sm1,
						                height: 250,
										//width:670,
										title:'Lista de Personas',
						                border: true,
						                bbar: new Ext.PagingToolbar({
										store: storePersona,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
						            }]
									},{
								title: 'Proveedor',
								id: 'tabproveedor',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
						                xtype: 'grid',
										id: 'gd_proveedor',
						                store: storeProveedor,
						                cm: colModelProveedor,
						                plugins: expanderContacto,
						                stripeRows: true,
						                iconCls: 'icon-grid',
						                sm:sm2,
						                height: 250,
										title:'Lista de Proveedores',
						                border: true,
										bbar: new Ext.PagingToolbar({
										store: storeProveedor,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
						            }]
									},{
								title: 'Directorio',
								id: 'tabdirectorio',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
						                xtype: 'grid',
										id: 'gd_directorio',
						                store: storeDirectorio,
						                cm: colModelDirectorio,
						                iconCls: 'icon-grid',
						                sm:sm3,
						                height: 250,
										title:'Lista de Directorios telef&oacute;nicos',
						                border: true,
										bbar: new Ext.PagingToolbar({
										store: storeDirectorio,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
						            }]
									},{
								title: 'Equipo',
								id: 'tabequipo',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
										border:false,
						                xtype: 'grid',
										id: 'gd_equipo',
						                store: storeEquipoContinuidad,
						                stripeRows: true,
						                sm:sm4,
					                	iconCls: 'icon-grid',
						                cm: colModelEquipoContinuidad,
						                height: 250,
						                iconCls: 'icon-grid',
										title:'Equipos de Continuidad',
						                border: true,
						                listeners: {
						                    viewready: function(g) {
						                    }
						                },
										bbar: new Ext.PagingToolbar({
										store: storeEquipoContinuidad,
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
						var camposForm = Ext.getCmp("frm_planlocalizacion").getForm().getValues(false);	
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
								storePlanLocalizacion.baseParams = {'accion': 'insertar'};
							else
								storePlanLocalizacion.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_plan_localizacion" : "'+Ext.getCmp("co_plan_localizacion").getValue()+'", ';
							columnas += '"fe_elaboracion" : "'+convFecha(Ext.getCmp("fe_elaboracion").getValue())+'"}';
							
							var componente   = '{"co_plan_localizacion" : "'+Ext.getCmp("co_plan_localizacion").getValue()+'", ';
							componente += '"co_componente" : "'+Ext.getCmp("co_componente").getValue()+'"}';
							storePlanLocalizacion.load({params:{"columnas" : columnas, "personas": personas_seleccionadas(), "equipos": equipos_seleccionados(), "proveedores" : proveedores_seleccionados(), "directorios" : directorios_seleccionados(),
												"componente": componente,"condiciones": '{ "co_plan_localizacion" : "'+Ext.getCmp("co_plan_localizacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
										callback: function () {
										if(storePlanLocalizacion.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePlanLocalizacion.getAt(0).data.resp, 
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
							storePlanLocalizacion.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_plan_localizacion.php'};
						}
				}
			},{
			id: 'btnEliminarPlan',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Plan',
			disabled: true,
			handler: function(){
										storePlanLocalizacion.baseParams = {'accion': 'eliminar'};
										storePlanLocalizacion.load({params:{
												"condiciones": '{ "co_plan_localizacion" : "'+Ext.getCmp("co_plan_localizacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_plan_localizacion.php"},
										callback: function () {
										storePlanLocalizacion.baseParams = {'accion': 'refrescar'};
										if(storePlanLocalizacion.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePlanLocalizacion.getAt(0).data.resp,
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
										storePlanLocalizacion.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_plan_localizacion.php'};

							}})}
			},{
					text: 'Cerrar',
					id: 'btnCerrar',
					handler: function(){
						cerrarForm("co_reset");
					}
				}],
		listeners: {
			afterrender: function (){ 
			}
		}
		});
		
storeEquipoContinuidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_continuidad.php"}});		
storeDirectorio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_directorio.php"}});
storeContacto.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_contacto_proveedor.php"}});
storeProveedor.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_proveedor.php"}});
storePlanLocalizacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_plan_localizacion.php"}});
storePersona.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_persona.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/
/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/

/***************************************************************************************************/
	
	Ext.getCmp("gd_planlocalizacion").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardarPlan").enable();
		Ext.getCmp("btnEliminarPlan").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_plan_localizacion").focus();
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