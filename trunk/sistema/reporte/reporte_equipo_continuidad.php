<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Directorio</title>
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
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowExpander.js"></script>

<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */

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
      
      var storeEquipoContinuidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo_continuidad.php',
		remoteSort : true,
		root: 'equipos',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_equipo_continuidad.php'},
        totalProperty: 'total',
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
    storeEquipoContinuidad.setDefaultSort('co_rol_resp', 'ASC');
    
/*****************************************FIN****StorePersona*****************************************/




/******************************************INICIO**colModelPersona******************************************/     
	//var sm1 = new Ext.grid.CheckboxSelectionModel();
    var colModelEquipoContinuidad = new Ext.grid.ColumnModel([
        {id:'co_equipo_continuidad', hidden: true, header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_equipo_continuidad'},
        {header: "co_indicador", width: 150, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "Cedula", width: 150, sortable: true, locked:false, dataIndex: 'nu_cedula'},
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
         //sm1,
      	//{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        //{header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	//{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        //{header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},      
      ]);
      
/******************************************FIN****colModelPersona******************************************/     



   var grid =new Ext.grid.GridPanel({
					id: 'gd_equipo_continuidad',
					name:'gd_equipo_continuidad',
					store: storeEquipoContinuidad,
					cm: colModelEquipoContinuidad,
					stripeRows: true,
					//plugins: expanderDirectorio,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					width:780,
					title:'Equipos de Continuidad',
					border: true,
					tools: [{id:'save'},{id:'print'}],
					bbar: new Ext.PagingToolbar({
					store: storeEquipoContinuidad,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });


storeEquipoContinuidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_continuidad.php"}});
grid.render('grid');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

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
      <td><div id="grid" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
</body>
</html>
