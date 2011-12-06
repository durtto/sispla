<?php session_start(); 
//print_r($_SESSION); ?><html>
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
  var ubicacion = "<?php echo $_SESSION['co_ubicacion'] ?>";
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

/******************************************INICIO**StoreActivo******************************************/     

  var storeActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_activo.php',
		remoteSort : true,
		root: 'activos',
        totalProperty: 'total',
		idProperty: 'co_activo',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_activo.php', ubicacion: ubicacion},
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
    storeActivo.setDefaultSort('co_ubicacion', 'ASC');

/*****************************************FIN****StoreActivo*****************************************/


/******************************************INICIO**colModelActivo******************************************/     

    var colModelActivo = new Ext.grid.ColumnModel([
        {id:'co_activo',header: "Activo", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Nombre del Activo", width: 200, sortable: true, locked:false, dataIndex: 'nb_activo'},
     	{header: "Descripci&oacute;n", fixed: true,width: 300, sortable: true, locked:false, dataIndex: 'tx_descripcion', renderer: descripcion},
      	{header: "C&oacute;digo SAP", width: 100, sortable: true, locked:false, dataIndex: 'co_sap'},
      	{header: "Serial", width: 80, sortable: true, locked:false, dataIndex: 'nu_serial'},
      	{header: "N&uacute;mero de Etiqueta", width: 120, sortable: true, locked:false, dataIndex: 'nu_etiqueta'},
      	{header: "Cr&iacute;tico", width: 80, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: critico},
      	{header: "Vulnerable", width: 80, sortable: true, locked:false, dataIndex: 'bo_vulnerable', renderer: vulnerable},
      	{header: "Fecha de Incorporaci&oacute;n", width: 140, sortable: true, locked:false, dataIndex: 'fe_incorporacion'},
      	{header: "Vida &Uacute;til", width: 50, sortable: true, locked:false, dataIndex: 'nu_vida_util'},
      	{header: "Activo Padre", width: 150, sortable: true, locked:false, dataIndex: 'co_activo_padre'},
      	{header: "Estado", width: 150, sortable: true, hidden: true, locked:false, dataIndex: 'co_estado'},
      	{header: "Estado", width: 150, sortable: true, locked:false, dataIndex: 'nb_estado'},
      	{header: "Fabricante1", width: 150, sortable: true, hidden: true, locked:false, dataIndex: 'co_fabricante'},
      	{header: "Fabricante", width: 150, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
      	{header: "Responsable", width: 150, sortable: true, locked:false, dataIndex: 'co_indicador'},
      	{header: "Ubicacion", width: 150, sortable: true, hidden: true, locked:false, dataIndex: 'co_ubicacion'},
      	{header: "Ubicaci&oacute;n", width: 150, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},      
      	{header: "Proceso", width: 150, sortable: true, hidden: true, locked:false, dataIndex: 'co_proceso'},
      	{header: "Proceso", width: 150, sortable: true, locked:false, dataIndex: 'nb_proceso'},      
      	{header: "Proveedor", width: 150, sortable: true, hidden: true, locked:false, dataIndex: 'co_proveedor'},
      	{header: "Proveedor", width: 150, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_nivel'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, locked:false, dataIndex: 'nb_nivel' },       
        {header: "Nivel de Obsolescencia", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Tipo de Activo", width: 150, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},

      ]);

/******************************************FIN****colModelActivo******************************************/     

/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
		id:'srv_ticket',
		labelWidth: 100,
		frame:true,
		title: ':: Reporte de Activos ::. ',
		bodyStyle:'padding:5px',
		width: 960,
		layout: 'fit',
		items: [{
				xtype:'fieldset',	
				autoHeight:true,
				border: false,
				items: [{			
						xtype: 'tabpanel',
						id: 'tabPanel',
						resizeTabs: true,
						enableTabScroll: true,
						deferredRender: false,
						layoutOnTabChange: true,
						activeTab: 0,
						//layout: 'fit',
						bodyStyle:'padding:5px; background-color: #f1f1f1;',
						items: [{
								title: 'Almacenamiento',
								id: 'tabalmacenamiento',
								hideMode: 'offsets', 
								autoHeight:true,
								border: false,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
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
									},{
								title: 'Transporte',
								id: 'tabtransporte',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
                xtype: 'grid',
				id: 'gd_activo1',
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
									},{
								title: 'Procesamiento',
								id: 'tabprocesamiento',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
                xtype: 'grid',
				id: 'gd_activo2',
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
									},{
								title: 'Impresi&oacute;n',
								id: 'tabimpresion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
                xtype: 'grid',
				id: 'gd_activo3',
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
									},{
								title: 'Visualizaci&oacute;n',
								id: 'tabvisualizacion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
                xtype: 'grid',
				id: 'gd_activo4',
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
									},{
								title: 'Autonom&iacute;a Energ.',
								id: 'tabautonomia',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
                xtype: 'grid',
				id: 'gd_activo5',
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
									},{
								title: 'Monitoreo',
								id: 'tabmonitoreo',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
                xtype: 'grid',
				id: 'gd_activo6',
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
									},{
								title: 'Adq. de Datos',
								id: 'tabadquisicion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
                xtype: 'grid',
				id: 'gd_activo7',
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
									}]
							}]
			}],
		});


storeActivo.load({params: {start: 0, limit: 50, accion:"critico", interfaz: "../interfaz/interfaz_activo.php", ubicacion: ubicacion}});
gridForm.render('form');

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
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
       </tr>
  		<tr>
      </tr>
  </table>
</body>
</html>