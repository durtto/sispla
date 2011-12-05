<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Proveedor</title>
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
 var nuevo;
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

/******************************************INICIO**StoreProveedor******************************************/     
	
  var storeProveedor = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proveedor.php',
		remoteSort : true,
		root: 'proveedores',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_proveedor.php'},
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
            '<p><b>Telefono:</b> {tx_telefono}</p>',
            '<p><b>Correo Electronico:</b> {tx_correo_electronico}</p>'
        )
    });

/******************************************INICIO**colModelProveedor******************************************/     
   
    var colModelProveedor = new Ext.grid.ColumnModel([
    	expanderContacto,
        {id:'co_proveedor',header: "Proveedor", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Nombre", width: 200, sortable: true, locked:false, dataIndex: 'nb_proveedor'},
        {header: "Direccion", width: 300, sortable: true, locked:false, dataIndex: 'di_oficina'},
        {header: "Servicio que Presta", width: 450, sortable: true, locked:false, dataIndex: 'tx_servicio_prestado', renderer: servicio},
      	//{header: "Contacto", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_contacto'},
      	//{header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		//{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
       	// {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 120, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
      
      ]);
	
/******************************************FIN****colModelProveedor******************************************/     
    function servicio(tx_servicio_prestado,servicio){  
   servicio = 'style="white-space:normal"';  
   return tx_servicio_prestado;  
   }  
/******************************************INICIO**StoreContacto******************************************/     
      
  var storeContacto = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_contacto_proveedor.php',
		remoteSort : true,
		root: 'contactos',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_contacto_proveedor.php'},
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
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        {header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Proveedor", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
      ]);
	
/******************************************FIN****colModelContacto******************************************/     

/******************************************INICIO**StoreCliente******************************************/     
   var grid =new Ext.grid.EditorGridPanel({
					id: 'gd_proveedor',
					name:'gd_proveedor',
					store: storeProveedor,
					cm: colModelProveedor,
					stripeRows: true,
					plugins: expanderContacto,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					//width:670,
					title:'Lista de Proveedor',
					border: true,
					bbar: new Ext.PagingToolbar({
					store: storeProveedor,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });


storeProveedor.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_proveedor.php"}});
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
