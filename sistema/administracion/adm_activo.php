<html>
<head>
<title>Activo</title>
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
 var winEstado;
 var winFabricante;
 var winPersona;
 var winUbicacion;
 var winProceso;
 var winProveedor;
 var winUnidad;
 var winNivel;
   
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_activo'] = 'Codigo Activo';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	var storeEstado = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_estado.php',
		remoteSort : true,
		root: 'estados',
        totalProperty: 'total',
		idProperty: 'co_estado',
        fields: [{name: 'co_estado'},
        		{name: 'nb_estado'},
        		{name: 'tx_descripcion'},
        		{name: 'bo_critico'},
        		{name: 'resp'}]
        });
    storeEstado.setDefaultSort('co_estado', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelEstado = new Ext.grid.ColumnModel([
        {id:'co_estado',header: "Estado", width: 100, sortable: true, locked:false, dataIndex: 'co_estado'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_estado'},
        {header: "Descripcion", width: 338, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        ]);
	   
	   
	   var storeFabricante = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_fabricante.php',
		remoteSort : true,
		root: 'fabricantes',
        totalProperty: 'total',
		idProperty: 'co_fabricante',
        fields: [{name: 'co_fabricante'},
        		{name: 'nb_fabricante'},
        		{name: 'di_ubicacion'},
        		{name: 'nu_telefono'},
        		{name: 'tx_correo_electronico'},
        		{name: 'tx_pagina_web'},
        		{name: 'resp'}]
        });
    storeFabricante.setDefaultSort('co_fabricante', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelFabricante = new Ext.grid.ColumnModel([
        {id:'co_fabricante',header: "Fabricante", width: 100, sortable: true, locked:false, dataIndex: 'co_fabricante'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_ubicacion'},
        {header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'nu_telefono'},
        {header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Pagina Web", width: 100, sortable: true, locked:false, dataIndex: 'tx_pagina_web'},
      ]);
      
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
	var storeUbicacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_ubicacion.php',
		remoteSort : true,
		root: 'ubicaciones',
        totalProperty: 'total',
		idProperty: 'co_ubicacion',
        fields: [{name: 'co_ubicacion'},
        		{name: 'nb_ubicacion'},
        		{name: 'bo_obsoleto'},
        		{name: 'co_ubicacion_padre'},
        		{name: 'nb_tipo_ubicacion'},
        		{name: 'resp'}]
        });
    storeUbicacion.setDefaultSort('co_ubicacion', 'ASC');
	
	
    var colModelUbicacion = new Ext.grid.ColumnModel([
        {id:'co_rol_resp',header: "Ubicacion", width: 80, sortable: true, locked:false, dataIndex: 'co_ubicacion'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},
        {header: "Obsoleto", width: 100, sortable: true, locked:false, dataIndex: 'bo_obsoleto', renderer: obsoleto},
        {header: "Ubicacion Padre", width: 150, sortable: true, locked:false, dataIndex: 'co_ubicacion_padre'},
        {header: "Tipo Ubicacion", width: 100, sortable: true, locked:false, dataIndex: 'nb_tipo_ubicacion'},

        ]);
        function obsoleto(bo_obsoleto) {
        if (bo_obsoleto == 'SI') {
            return '<span style="color:gray;">' + 'SI' + '</span>';
        } else if (bo_obsoleto == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_obsoleto;
    	}
    var storeProceso = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proceso.php',
		remoteSort : true,
		root: 'procesos',
        totalProperty: 'total',
		idProperty: 'co_proceso',
        fields: [{name: 'co_proceso'},
		        {name: 'nb_proceso'},
		        {name: 'tx_descripcion'},
		        {name: 'bo_critico'},
		        {name: 'resp'}]
        });
    storeProceso.setDefaultSort('co_proceso', 'ASC');
	    

	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 659//
	
    var colModelProceso = new Ext.grid.ColumnModel([
        {id:'co_proceso',header: "Proceso", width: 100, sortable: true, locked:false, dataIndex: 'co_proceso'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_proceso'},
        {header: "Descripcion", width: 358, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Critico", width: 100, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: critico},
      ]);
      
      //Funcion para cambiar el coloer en el boolean
      
		function critico(bo_critico) {
        if (bo_critico == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_critico == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_critico;
    	}
    	 var storeProveedor = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proveedor.php',
		remoteSort : true,
		root: 'proveedores',
        totalProperty: 'total',
		idProperty: 'co_proveedor',
        fields: [{name: 'co_proveedor'},
        		{name: 'nb_proveedor'},
        		{name: 'di_oficina'},
        		{name: 'tx_telefono_oficina'},
        		{name: 'tx_url_pagina'},
        		{name: 'resp'}]
        });
    storeProveedor.setDefaultSort('co_proveedor', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelProveedor = new Ext.grid.ColumnModel([
        {id:'co_proveedor',header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
        {header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Pagina Web", width: 100, sortable: true, locked:false, dataIndex: 'tx_url_pagina'},
      ]);
      var storeUnidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_unidad_demanda.php',
		remoteSort : true,
		root: 'unidades',
        totalProperty: 'total',
		idProperty: 'co_unidad',
        fields: [{name: 'co_unidad'},
        		{name: 'nb_unidad'},
        		{name: 'tx_descripcion'},
        		{name: 'bo_critico'},
        		{name: 'resp'}]
        });
    storeUnidad.setDefaultSort('co_unidad', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelUnidad = new Ext.grid.ColumnModel([
        {id:'co_unidad',header: "Unidad", width: 100, sortable: true, locked:false, dataIndex: 'co_unidad'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_unidad'},
        {header: "Descripcion", width: 338, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        ]);
  var storeNivel = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_nivel_obsolescencia.php',
		remoteSort : true,
		root: 'nivelesobsolescencia',
        totalProperty: 'total',
		idProperty: 'co_nivel',
        fields: [{name: 'co_nivel'},
		        {name: 'nb_nivel'},
		        {name: 'tx_descripcion'},
		        {name: 'bo_obsoleto'},
		        {name: 'resp'}]
        });
    storeNivel.setDefaultSort('co_nivel', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelNivel = new Ext.grid.ColumnModel([
        {id:'co_nivel',header: "Nivel", width: 100, sortable: true, locked:false, dataIndex: 'co_nivel'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_nivel'},
        {header: "Descripcion", width: 338, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Critico", width: 100, sortable: true, locked:false, dataIndex: 'bo_obsoleto'},
      ]);
             
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

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_activo',
        frame: true,
		labelAlign: 'center',
        title: 'Activo',
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
			title: 'Activos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo del Activo',
						xtype:'numberfield',
						id: 'co_activo',
                        name: 'co_activo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Serial',
						xtype:'numberfield',
						id: 'nu_serial',
                        name: 'nu_serial',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Critico',
	            		id: 'bo_critico',
		                name: 'bo_critico',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'critico', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'critico', inputValue: 0},
			           			]
                    },{
                        fieldLabel: 'Fecha de Incorporacion',
						xtype:'datefield',
						vtype:'validos',
						id: 'fe_incorporacion',
                        name: 'fe_incorporacion',
                        width:160
                    },{
                        fieldLabel: 'Vida Util',
						xtype:'numberfield',
						id: 'nu_vida_util',
                        name: 'nu_vida_util',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Estado',
						xtype:'numberfield',
						id: 'co_estado',
                        name: 'co_estado',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Estado',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_estado',
						disabled:true,
                        name: 'nb_estado',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Indicador',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        width:140
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_persona',
						disabled:true,
                        name: 'nb_persona',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        hidden: true,
						hideLabel: true,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Proceso',
						xtype:'numberfield',
						id: 'co_proceso',
                        name: 'co_proceso',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Proceso',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_proceso',
						disabled:true,
                        name: 'nb_proceso',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Unidad',
						xtype:'numberfield',
						id: 'co_unidad',
                        name: 'co_unidad',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Unidad',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_unidad',
						disabled:true,
                        name: 'nb_unidad',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_activo',
                        name: 'nb_activo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Etiqueta',
						xtype:'numberfield',
						id: 'nu_etiqueta',
                        name: 'nu_etiqueta',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
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
                        fieldLabel: 'Codigo SAP',
						xtype:'numberfield',
						id: 'co_sap',
                        name: 'co_sap',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Activo Padre',
						xtype:'numberfield',
						id: 'co_activo_padre',
                        name: 'co_activo_padre',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:141
                    },{
                        fieldLabel: 'Fabricante',
						xtype:'numberfield',
						id: 'co_fabricante',
                        name: 'co_fabricante',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Fabricante',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_fabricante',
						disabled:true,
                        name: 'nb_fabricante',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Ubicacion',
						xtype:'numberfield',
						id: 'co_ubicacion',
                        name: 'co_ubicacion',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Ubicacion',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_ubicacion',
						disabled:true,
                        name: 'nb_ubicacion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Proveedor',
						xtype:'numberfield',
						id: 'co_proveedor',
                        name: 'co_proveedor',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Proveedor',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_proveedor',
						disabled:true,
                        name: 'nb_proveedor',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Nivel',
						xtype:'numberfield',
						id: 'co_nivel',
                        name: 'co_nivel',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Nivel',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_nivel',
						disabled:true,
                        name: 'nb_nivel',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Descripcion',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
                        height: 100,
            			anchor: '100%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
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
					Ext.getCmp("co_activo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
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
								columnas += '"co_unidad" : "'+Ext.getCmp("co_unidad").getValue()+'", ';
								columnas += '"co_nivel" : "'+Ext.getCmp("co_nivel").getValue()+'"}';
							storeActivo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_activo" : "'+Ext.getCmp("co_activo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_activo.php"},
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
							storeActivo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_activo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Activo',
			disabled: true,
			handler: function(){
										storeActivo.baseParams = {'accion': 'eliminar'};
										storeActivo.load({params:{
												"condiciones": '{ "co_activo" : "'+Ext.getCmp("co_activo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_activo.php"},
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
			width:640,
			items:[{
                xtype: 'grid',
				id: 'gd_activo',
                store: storeActivo,
                cm: colModelActivo,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Activo',
                border: true,
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
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

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
											Ext.getCmp("co_activo_padre").setValue(record.data.co_activo);
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
 function selEstado(){
storeEstado.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_rol_activo.php"}});
	if(!winEstado){
				winEstado = new Ext.Window({
						applyTo : 'winEstado',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selEstado',
								store: storeEstado,
								cm: colModelEstado,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Estados',
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
										if(Ext.getCmp("gd_selEstado").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selEstado").getSelectionModel().getSelected();
											Ext.getCmp("co_estado").setValue(record.data.co_estado);
											Ext.getCmp("nb_estado").setValue(record.data.nb_estado);
											winEstado.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winEstado.hide();
								  }
						}]
				});
		}
		winEstado.show();	
}

function selFabricante(){
storeFabricante.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_rol_responsabilidad.php"}});
	if(!winFabricante){
				winFabricante = new Ext.Window({
						applyTo : 'winFabricante',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selFabricante',
								store: storeFabricante,
								cm: colModelFabricante,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Fabricantes',
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
										if(Ext.getCmp("gd_selFabricante").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selFabricante").getSelectionModel().getSelected();
											Ext.getCmp("co_fabricante").setValue(record.data.co_fabricante);
											Ext.getCmp("nb_fabricante").setValue(record.data.nb_fabricante);
											winFabricante.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winFabricante.hide();
								  }
						}]
				});
		}
		winFabricante.show();	
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
											Ext.getCmp("nb_persona").setValue(record.data.nb_persona);
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

function selUbicacion(){
storeUbicacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_ubicacion.php"}});
	if(!winUbicacion){
				winUbicacion = new Ext.Window({
						applyTo : 'winUbicacion',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selUbicacion',
								store: storeUbicacion,
								cm: colModelUbicacion,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Ubicacion',
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
										if(Ext.getCmp("gd_selUbicacion").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selUbicacion").getSelectionModel().getSelected();
											Ext.getCmp("co_ubicacion").setValue(record.data.co_ubicacion);
											Ext.getCmp("nb_ubicacion").setValue(record.data.nb_ubicacion);
											winUbicacion.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winUbicacion.hide();
								  }
						}]
				});
		}
		winUbicacion.show();	
}

function selProceso(){
storeProceso.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_proceso.php"}});
	if(!winProceso){
				winProceso = new Ext.Window({
						applyTo : 'winProceso',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selProceso',
								store: storeProceso,
								cm: colModelProceso,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Proceso',
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
										if(Ext.getCmp("gd_selProceso").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selProceso").getSelectionModel().getSelected();
											Ext.getCmp("co_proceso").setValue(record.data.co_proceso);
											Ext.getCmp("nb_proceso").setValue(record.data.nb_proceso);
											winProceso.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winProceso.hide();
								  }
						}]
				});
		}
		winProceso.show();	
}	
function selProveedor(){
storeProveedor.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_proveedor.php"}});
	if(!winProveedor){
				winProveedor = new Ext.Window({
						applyTo : 'winProveedor',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selProveedor',
								store: storeProveedor,
								cm: colModelProveedor,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Proveedor',
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
										if(Ext.getCmp("gd_selProveedor").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selProveedor").getSelectionModel().getSelected();
											Ext.getCmp("co_proveedor").setValue(record.data.co_proveedor);
											Ext.getCmp("nb_proveedor").setValue(record.data.nb_proveedor);
											winProveedor.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winProveedor.hide();
								  }
						}]
				});
		}
		winProveedor.show();	
}
function selUnidad(){
storeUnidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_unidad_demanda.php"}});
	if(!winUnidad){
				winUnidad = new Ext.Window({
						applyTo : 'winUnidad',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selUnidad',
								store: storeUnidad,
								cm: colModelUnidad,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Unidad',
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
										if(Ext.getCmp("gd_selUnidad").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selUnidad").getSelectionModel().getSelected();
											Ext.getCmp("co_unidad").setValue(record.data.co_unidad);
											Ext.getCmp("nb_unidad").setValue(record.data.nb_unidad);
											winUnidad.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winUnidad.hide();
								  }
						}]
				});
		}
		winUnidad.show();	
}
function selNivel(){
storeNivel.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_nivel_obsolescencia.php"}});
	if(!winNivel){
				winNivel = new Ext.Window({
						applyTo : 'winNivel',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selNivel',
								store: storeNivel,
								cm: colModelNivel,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Nivel',
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
										if(Ext.getCmp("gd_selNivel").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selNivel").getSelectionModel().getSelected();
											Ext.getCmp("co_nivel").setValue(record.data.co_nivel);
											Ext.getCmp("nb_nivel").setValue(record.data.nb_nivel);
											winNivel.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winNivel.hide();
								  }
						}]
				});
		}
		winNivel.show();	
}
storeActivo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_activo.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_activo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
		}
		Ext.getCmp("co_activo").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerActivo = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerActivo.onTriggerClick = selActivo;
		triggerActivo.applyToMarkup('co_activo_padre');
		
var triggerEstado = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerEstado.onTriggerClick = selEstado;
		triggerEstado.applyToMarkup('nb_estado');
		
var triggerFabricante = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerFabricante.onTriggerClick = selFabricante;
		triggerFabricante.applyToMarkup('nb_fabricante');
		
var triggerPersona = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPersona.onTriggerClick = selPersona;
		triggerPersona.applyToMarkup('co_indicador');
		
var triggerUbicacion = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerUbicacion.onTriggerClick = selUbicacion;
		triggerUbicacion.applyToMarkup('nb_ubicacion');
		
var triggerProceso = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerProceso.onTriggerClick = selProceso;
		triggerProceso.applyToMarkup('nb_proceso');		
		
var triggerProveedor = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerProveedor.onTriggerClick = selProveedor;
		triggerProveedor.applyToMarkup('nb_proveedor');	
				
var triggerUnidad = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerUnidad.onTriggerClick = selUnidad;
		triggerUnidad.applyToMarkup('nb_unidad');		

var triggerNivel = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerNivel.onTriggerClick = selNivel;
		triggerNivel.applyToMarkup('nb_nivel');	
			
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
	<div id="winEstado" class="x-hidden">
    <div class="x-window-header">Ejegir Estado</div>
	</div>
	<div id="winFabricante" class="x-hidden">
    <div class="x-window-header">Ejegir Fabricante</div>
	</div>
	<div id="winPersona" class="x-hidden">
    <div class="x-window-header">Ejegir Persona</div>
	</div>
	<div id="winUbicacion" class="x-hidden">
    <div class="x-window-header">Ejegir Ubicacion</div>
	</div>
	<div id="winProceso" class="x-hidden">
    <div class="x-window-header">Ejegir Proceso</div>
	</div>
	<div id="winProveedor" class="x-hidden">
    <div class="x-window-header">Ejegir Proveedor</div>
	</div>
	<div id="winUnidad" class="x-hidden">
    <div class="x-window-header">Ejegir Unidad</div>
	</div>
	<div id="winNivel" class="x-hidden">
    <div class="x-window-header">Ejegir Nivel</div>
	</div>
</body>
</html>
