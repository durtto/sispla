<html>
<head>
<title>Vehiculo</title>
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
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_vehiculo'] = 'Codigo Vehiculo';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
	
  var storeVehiculo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_vehiculo.php',
		remoteSort : true,
		root: 'vehiculos',
        totalProperty: 'total',
		idProperty: 'co_vehiculo',
        fields: [{name: 'co_vehiculo'},
		        {name: 'tx_placa'},
		        {name: 'tx_marca'},
		        {name: 'tx_modelo'},
		        {name: 'tx_unidad'},
		        {name: 'resp'}]
        });
    storeVehiculo.setDefaultSort('co_vehiculo', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelVehiculo = new Ext.grid.ColumnModel([
        {id:'co_vehiculo',header: "Vehiculo", width: 100, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
        {header: "Placa", width: 100, sortable: true, locked:false, dataIndex: 'tx_placa'},
		{header: "Marca", width: 100, sortable: true, locked:false, dataIndex: 'tx_marca'},        
		{header: "Modelo", width: 180, sortable: true, locked:false, dataIndex: 'tx_modelo'},
		{header: "Unidad", width: 159, sortable: true, locked:false, dataIndex: 'tx_unidad'},
      ]);
	
	
	
/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_vehiculo',
        frame: true,
		labelAlign: 'center',
        title: 'Vehiculos',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			//layout:'column',
			title: 'Vehiculos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Vehiculo',
						xtype:'numberfield',
						id: 'co_vehiculo',
                        name: 'co_vehiculo',
                        //hidden: true,
						//hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Placa',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_placa',
                        name: 'tx_placa',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Marca',
						xtype:'textfield',
						id: 'tx_marca',
                        name: 'tx_marca',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Modelo',
						xtype:'textfield',
						id: 'tx_modelo',
                        name: 'tx_modelo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Unidad',
						xtype:'textfield',
						id: 'tx_unidad',
                        name: 'tx_unidad',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
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
					//nroReg=storeVehiculo.getCount();
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_vehiculo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_vehiculo").getForm().getValues(false);	
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
								storeVehiculo.baseParams = {'accion': 'insertar'};
							else
								storeVehiculo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'", ';
							columnas += '"tx_placa" : "'+Ext.getCmp("tx_placa").getValue()+'", ';
							columnas += '"tx_marca" : "'+Ext.getCmp("tx_marca").getValue()+'", ';
							columnas += '"tx_modelo" : "'+Ext.getCmp("tx_modelo").getValue()+'", ';
							columnas += '"tx_unidad" : "'+Ext.getCmp("tx_unidad").getValue()+'"}';
							storeVehiculo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_vehiculo.php"},
										callback: function () {
										if(storeVehiculo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeVehiculo.getAt(0).data.resp, 
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
							storeVehiculo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_vehiculo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Vehiculo',
			disabled: true,
			handler: function(){
										storeVehiculo.baseParams = {'accion': 'eliminar'};
										storeVehiculo.load({params:{
												"condiciones": '{ "co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_vehiculo.php"},
										callback: function () {
										if(storeVehiculo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeVehiculo.getAt(0).data.resp,
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
				id: 'gd_vehiculo',
                store: storeVehiculo,
                cm: colModelVehiculo,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_vehiculo").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Vehiculos',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeVehiculo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });


	
	
storeVehiculo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_vehiculo.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_vehiculo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_vehiculo").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/

});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>

</body>
</html>
