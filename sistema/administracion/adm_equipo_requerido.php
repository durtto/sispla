<html>
<head>
<title>Equipo</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
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
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_equipo_requerido'] = 'Codigo Equipo';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	var storeActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_activo.php',
		remoteSort : true,
		root: 'activos',
        totalProperty: 'total',
		idProperty: 'co_activo',
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
				{name: 'co_unidad'},
				{name: 'nb_unidad'},
				{name: 'co_nivel'},
				{name: 'nb_nivel'},
		        {name: 'resp'}]
        });
    storeActivo.setDefaultSort('co_activo', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelActivo = new Ext.grid.ColumnModel([
        {id:'co_activo',header: "Activo", width: 80, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Nombre", width: 80, sortable: true, locked:false, dataIndex: 'nb_activo'},
     	{header: "Descripcion", width: 100, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
      	{header: "Codigo SAP", width: 100, sortable: true, locked:false, dataIndex: 'co_sap'},
      	{header: "Serial", width: 80, sortable: true, locked:false, dataIndex: 'nu_serial'},
      	{header: "Numero de Etiqueta", width: 120, sortable: true, locked:false, dataIndex: 'nu_etiqueta'},
      	{header: "Critico", width: 80, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: acritico},
      	{header: "Vulnerable", width: 80, sortable: true, locked:false, dataIndex: 'bo_vulnerable', renderer: vulnerable},
      	{header: "Fecha de Incorporacion", width: 140, sortable: true, locked:false, dataIndex: 'fe_incorporacion'},
      	{header: "Vida Util", width: 90, sortable: true, locked:false, dataIndex: 'nu_vida_util'},
      	{header: "Activo Padre", width: 100, sortable: true, locked:false, dataIndex: 'co_activo_padre'},
      	{header: "Estado", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_estado'},
      	{header: "Estado", width: 100, sortable: true, locked:false, dataIndex: 'nb_estado'},
      	{header: "Fabricante", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_fabricante'},
      	{header: "Fabricante", width: 100, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
      	{header: "Responsable", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_indicador'},
      	{header: "Responsable", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
      	{header: "Ubicacion", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_ubicacion'},
      	{header: "Ubicacion", width: 100, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},      
      	{header: "Proceso", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proceso'},
      	{header: "Proceso", width: 100, sortable: true, locked:false, dataIndex: 'nb_proceso'},      
      	{header: "Proveedor", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proveedor'},
      	{header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
        {header: "Unidad de Demanda", width: 125, sortable: true, hidden: true, locked:false, dataIndex: 'co_unidad'},
      	{header: "Unidad de Demanda", width: 125, sortable: true, locked:false, dataIndex: 'nb_unidad'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_nivel'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, locked:false, dataIndex: 'nb_nivel'},       
      ]);
	function vulnerable(bo_vulnerable) {
        if (bo_vulnerable == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_vulnerable == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_vulnerable;
    	}
	function acritico(bo_critico) {
        if (bo_critico == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_critico == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_critico;
    	}
    
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
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
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
   
    var storeEquipo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo_requerido.php',
		remoteSort : true,
		root: 'equiposrequeridos',
        totalProperty: 'total',
		idProperty: 'co_equipo_requerido',
        fields: [{name: 'co_equipo_requerido'},
				{name: 'nb_activo'},
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
        		{name: 'bo_vehiculo'},
        		{name: 'bo_laptop'},
        		{name: 'bo_maletin_herramientas'},
        		{name: 'bo_radio'},
        		{name: 'bo_multimetro_digital'},
        		{name: 'bo_hart'},
        		{name: 'resp'}]
        });
    storeEquipo.setDefaultSort('co_equipo_requerido_requerido', 'ASC');
	
	
    var colModelEquipo = new Ext.grid.ColumnModel([
        {id:'co_equipo_requerido',header: "Equipo", width: 200, hidden:true, sortable: true, locked:false, dataIndex: 'co_equipo_requerido'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
		{header: "Indicador", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
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
        {header: "Apellido", width: 80, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Telefono Oficina", width: 150, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Telefono Habitacion", width: 150, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        {header: "Vehiculo", width: 60, sortable: true, locked:false, dataIndex: 'bo_vehiculo', renderer: vehiculo},
        {header: "Laptop", width: 60, sortable: true, locked:false, dataIndex: 'bo_laptop', renderer: laptop},
        {header: "Maletin", width: 60, sortable: true, locked:false, dataIndex: 'bo_maletin_herramientas', renderer: maletin},
        {header: "Radio", width: 60, sortable: true, locked:false, dataIndex: 'bo_radio', renderer: radio},
		{header: "Multimetro", width: 70, sortable: true, locked:false, dataIndex: 'bo_multimetro_digital', renderer: multimetro},
		{header: "HART", width: 60, sortable: true, locked:false, dataIndex: 'bo_hart', renderer: hart},

      ]);
		function vehiculo(bo_vehiculo) {
        if (bo_vehiculo == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_vehiculo == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_vehiculo;
    	}
    	function laptop(bo_laptop) {
        if (bo_laptop == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_laptop == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_laptop;
    	}
    	function maletin(bo_maletin_herramientas) {
        if (bo_maletin_herramientas == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_maletin_herramientas == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_maletin_herramientas;
    	}
    	function radio(bo_radio) {
        if (bo_radio == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_radio == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_radio;
    	}
	    function multimetro(bo_multimetro_digital) {
        if (bo_multimetro_digital == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_multimetro_digital == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_multimetro_digital;
    	}
    	function hart(bo_hart) {
        if (bo_hart == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_hart == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_hart;
    	}

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_cliente',
        frame: true,
		labelAlign: 'center',
        title: 'Equipo',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Equipo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:130,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero',
						xtype:'numberfield',
						id: 'co_equipo_requerido',
                        name: 'co_equipo_requerido',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120
                    },{
                        fieldLabel: 'Activo',
						xtype:'numberfield',
						id: 'co_activo',
                        name: 'co_activo',
                        hidden: true,
						hideLabel: true,
                        width:120
                    },{
                        fieldLabel: 'Activo',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_activo',
						disabled:true,
                        name: 'nb_activo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        width:120
                    }]
				},{
					layout: 'form',
					labelWidth:130,
					columnWidth:.45,
					border:false,
					items: [{
	            		xtype: 'checkbox',
	            		fieldLabel: 'Vehiculo',
	            		id: 'bo_vehiculo',
		                name: 'bo_vehiculo',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'vehiculo', inputValue: 1},
			           			]
        		},{
	            		xtype: 'checkbox',
	            		fieldLabel: 'Laptop',
	            		id: 'bo_laptop',
		                name: 'bo_laptop',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'laptop', inputValue: 1},
			           			]
        		},{
	            		xtype: 'checkbox',
	            		fieldLabel: 'Maletin de Herramientas',
	            		id: 'bo_maletin_herramientas',
		                name: 'bo_maletin_herramientas',
			            columns: 2,
			            items: [
			                {boxLabel: '1', name: 'herramientas', inputValue: 1},
			           			]
        		},{
	            		xtype: 'checkbox',
	            		fieldLabel: 'Radio',
	            		id: 'bo_radio',
		                name: 'bo_radio',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'radio', inputValue: 1},
			           			]
        		},{
	           			xtype: 'checkbox',
	            		fieldLabel: 'Multimetro Digital',
	            		id: 'bo_multimetro_digital',
		                name: 'bo_multimetro_digital',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'multimetro', inputValue: 1},
			           			]
        		},{
	            		xtype: 'checkbox',
	            		fieldLabel: 'HART',
	            		id: 'bo_hart',
		                name: 'bo_hart',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'hart', inputValue: 1},
			         			]
        		}]
			}]
			},{
				width: 640,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			handler: function(){
					nuevo = true;
					//nroReg=storeGrupo.getCount();
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
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_cliente").getForm().getValues(false);	
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
								storeEquipo.baseParams = {'accion': 'insertar'};
							else
								storeEquipo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'", ';
							columnas += '"bo_vehiculo" : "'+Ext.getCmp("bo_vehiculo").getValue()+'", ';
							columnas += '"bo_laptop" : "'+Ext.getCmp("bo_laptop").getValue()+'", ';
							columnas += '"bo_maletin_herramientas" : "'+Ext.getCmp("bo_maletin_herramientas").getValue()+'", ';							
							columnas += '"bo_radio" : "'+Ext.getCmp("bo_radio").getValue()+'", ';							
							columnas += '"bo_multimetro_digital" : "'+Ext.getCmp("bo_multimetro_digital").getValue()+'", ';
							columnas += '"bo_hart" : "'+Ext.getCmp("bo_hart").getValue()+'", ';
							columnas += '"co_activo" : "'+Ext.getCmp("co_activo").getValue()+'", ';
							columnas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}';

							storeEquipo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_equipo_requerido.php"},
										callback: function () {
										if(storeEquipo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeEquipo.getAt(0).data.resp, 
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
							storeEquipo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_equipo_requerido.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Equipo',
			disabled: true,
			handler: function(){
										storeEquipo.baseParams = {'accion': 'eliminar'};
										storeEquipo.load({params:{
												"condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_equipo_requerido.php"},
										callback: function () {
										if(storeEquipo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeEquipo.getAt(0).data.resp,
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
			width:640,
			items:[{
                xtype: 'grid',
				id: 'gd_cliente',
                store: storeEquipo,
                cm: colModelEquipo,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_cliente").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Equipo',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeEquipo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

function selActivo(){
storeActivo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_activo.php"}});
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
								//ds: ds,
								id: 'gd_selActivo',
								store: storeActivo,
								cm: colModelActivo,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Activo',
								border: true,
								listeners: {
												/*render: function(g) {
													g.getSelectionModel().selectRow(0);
												},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selActivo").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selActivo").getSelectionModel().getSelected();
											Ext.getCmp("co_activo").setValue(record.data.co_activo);
											Ext.getCmp("nb_activo").setValue(record.data.nb_activo);
											winActivo.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
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
												},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
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
								  handler : function(){
											winPersona.hide();
								  }
						}]
				});
		}
		winPersona.show();	
}
	
storeEquipo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_requerido.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_cliente").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_equipo_requerido").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerActivo = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerActivo.onTriggerClick = selActivo;
		triggerActivo.applyToMarkup('nb_activo');
var triggerPersona = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPersona.onTriggerClick = selPersona;
		triggerPersona.applyToMarkup('co_indicador');
});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

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




	

	

	   		
							
