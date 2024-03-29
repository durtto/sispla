<html>
<head>
<title>Datos de Planes</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">

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
 Ext.onReady(function(){
 	Ext.BLANK_IMAGE_URL = '../lib/ext-3.2.1/resources/images/default/s.gif';
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
       
  var storeDato = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_dato_plan.php',
		remoteSort : true,
		root: 'datos',
        totalProperty: 'total',
		idProperty: 'co_componente',
        fields: [{name: 'co_componente'},
		        {name: 'fe_vigencia'},		
        		{name: 'tx_objetivo'},	  
        		{name: 'tx_alcance'},   
        		{name: 'tx_identificacion_negocio'},
        		{name: 'tx_localidad'},  
        		{name: 'tx_organizacion'},
        		{name: 'resp'}]
        });
    storeDato.setDefaultSort('co_componente', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelDato = new Ext.grid.ColumnModel([
        {id:'co_componente',header: "Componente", width: 150, sortable: true, locked:false, dataIndex: 'co_componente'},
        {header: "Fecha de Vigencia", width: 150, sortable: true, locked:false, dataIndex: 'fe_vigencia'},
        {header: "Objetivos", width: 200, sortable: true, locked:false, dataIndex: 'tx_objetivo'},
        {header: "Alcance", width: 200, sortable: true, locked:false, dataIndex: 'tx_alcance'},
        {header: "Negocio", width: 150, sortable: true, locked:false, dataIndex: 'tx_identificacion_negocio'},
        {header: "Localidad", width: 150, sortable: true, locked:false, dataIndex: 'tx_localidad'},
        {header: "Organizacion", width: 150, sortable: true, locked:false, dataIndex: 'tx_organizacion'},
      ]);
	
		 

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'reporte_dato',
        frame: true,
		labelAlign: 'center',
        title: 'Datos de Planes',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
			width:640,
			items:[{
                xtype: 'grid',
				id: 'gd_dato',
                store: storeDato,
                cm: colModelDato,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("reporte_dato").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Planes',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeDato,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

storeDato.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_dato_plan.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_dato").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;

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
