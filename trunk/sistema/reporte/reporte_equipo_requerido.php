<html>
<head>
<title>Equipo</title>
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
        id: 'tabla_cliente',
        frame: true,
		labelAlign: 'center',
        title: 'Equipo',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
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
	
storeEquipo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_requerido.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_cliente").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
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




	

	

	   		
							
