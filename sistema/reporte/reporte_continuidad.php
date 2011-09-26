<html>
<head>
<title>Continuidad</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">

<!--<link rel="stylesheet" type="text/css" href="lib/ext-3.2.1/resources/css/xtheme-gray.css">-->
	<!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBSs -->

    <script type="text/javascript" src="../lib/ext-3.2.1/ext-all.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/shared/extjs/App.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowEditor.js"></script>
    <!-- overrides to base library -->
    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/GridFilters.css" />
    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/RangeMenu.css" />
    <link rel="stylesheet" type="text/css" href="..lib/ext-3.2.1/examples/ux/css/Spinner.css" />
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
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/Spinner.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/SpinnerField.js"></script>

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
  var storeContinuidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_continuidad.php',
		remoteSort : true,
		root: 'continuidades',
        totalProperty: 'total',
		idProperty: 'co_continuidad',
        fields: [{name: 'co_continuidad'},
        		{name: 'bo_prioridad_rec'},
		        {name: 'fe_mtd'},
		        {name: 'fe_rto'},
		        {name: 'bo_esquema_alterno_interno'},
		        {name: 'bo_esquema_alterno_externo'},
		        {name: 'co_activo'},
		        {name: 'nb_activo'},
		        {name: 'resp'}]
        });
    storeContinuidad.setDefaultSort('co_continuidad', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelContinuidad = new Ext.grid.ColumnModel([
        {id:'co_continuidad',header: "Continuidad", width: 100, sortable: true, locked:false, dataIndex: 'co_continuidad'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
        {header: "Prioridad", width: 100, sortable: true, locked:false, dataIndex: 'bo_prioridad_rec', renderer: prioridad},
        {header: "Fecha MTD", width: 100, sortable: true, locked:false, dataIndex: 'fe_mtd'},      
        {header: "Fecha RTO", width: 100, sortable: true, locked:false, dataIndex: 'fe_rto'},
        {header: "Esquema Interno", width: 100, sortable: true, locked:false, dataIndex: 'bo_esquema_alterno_interno', renderer: interno},
        {header: "Esquema Externo", width: 100, sortable: true, locked:false, dataIndex: 'bo_esquema_alterno_externo', renderer: externo},
		{header: "Activo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_activo'},
        
      ]);
	
		 function interno(bo_esquema_alterno_interno) {
        if (bo_esquema_alterno_interno == 'SI') {
            return '<span style="color:green;">' + 'SI' + '</span>';
        } else if (bo_esquema_alterno_interno == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_esquema_alterno_interno;
    	}
		function externo(bo_esquema_alterno_externo) {
        if (bo_esquema_alterno_externo == 'SI') {
            return '<span style="color:green;">' + 'SI' + '</span>';
        } else if (bo_esquema_alterno_externo == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_esquema_alterno_externo;
    	}
    	function prioridad(bo_prioridad_rec) {
        if (bo_prioridad_rec == 'ALTA') {
            return '<span style="color:red;">' + 'ALTA' + '</span>';
        } else if (bo_prioridad_rec == 'BAJA') {
            return '<span style="color:green;">' + 'BAJA' + '</span>';
        }
        return bo_prioridad_rec;
    	}

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'reporte_continuidad',
        frame: true,
		labelAlign: 'center',
        title: 'Continuidad',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
			width:640,
			items:[{
                xtype: 'grid',
				id: 'gd_continuidad',
                store: storeContinuidad,
                cm: colModelContinuidad,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("reporte_continuidad").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Continuidad',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeContinuidad,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

			

	
storeContinuidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_continuidad.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_continuidad").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
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
