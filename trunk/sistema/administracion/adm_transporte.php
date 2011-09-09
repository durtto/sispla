<html>
<head>
<title>Transporte</title>
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
 var winLinea;
  var winVehiculo;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_transporte'] = 'Numero transporte';
	
    var bd = Ext.getBody();

	var url = {
        local:  '../jsonp/grid-filter.json',  // static data file
        remote: '../jsonp/grid-filter.php'
    };
    //var encode = false;
    // configure whether filtering is performed locally or remotely (initially)
    var local = true;
	
  var storeTransporte = new Ext.data.JsonStore({
		url: '../clases/interfaz_transporte.php',
		remoteSort : true,
		root: 'transportes',
        totalProperty: 'total',
		idProperty: 'co_transporte',
        fields: [{name: 'co_transporte'},					{name: 'co_linea'},					{name: 'co_vehiculo'},			{name: 'resp'}]
        });
    storeTransporte.setDefaultSort('co_transporte', 'ASC');
	
	
    var colModelTransporte = new Ext.grid.ColumnModel([
        {id:'co_transporte',header: "Numero de Transporte", width: 200, sortable: true, locked:false, dataIndex: 'co_transporte'},
        {header: "Linea de Taxi", width: 200, sortable: true, locked:false, dataIndex: 'co_linea'},
        {header: "Vehiculo", width: 200, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
      ]);
	
	 var storeLinea = new Ext.data.JsonStore({
		url: '../php/interfaz_lineaTaxi.php',
		remoteSort : true,
		root: 'lineas',
        totalProperty: 'total',
		idProperty: 'co_linea',
        fields: [{name: 'co_linea'},					{name: 'nb_linea'},					{name: 'tx_telefono'},	   {name: 'di_oficina'},		{name: 'resp'}]
        });
    storeLinea.setDefaultSort('co_linea', 'ASC');
	
	
    var colModelLinea = new Ext.grid.ColumnModel([
        {id:'co_linea',header: "Numero de Linea Taxi", width: 250, sortable: true, locked:false, dataIndex: 'co_linea'},
        {header: "Nombre Linea", width: 250, sortable: true, locked:false, dataIndex: 'nb_linea'},
        {header: "Telefono", width: 250, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        {header: "Direccion", width: 250, sortable: true, locked:false, dataIndex: 'di_direccion'},
        ]);
	
	  
	    var storeVehiculo = new Ext.data.JsonStore({
		url: '../php/interfaz_vehiculo.php',
		remoteSort : true,
		root: 'vehiculos',
        totalProperty: 'total',
		idProperty: 'co_vehiculo',
        fields: [{name: 'co_vehiculo'},					{name: 'tx_placa'},					{name: 'tx_marca'},	   {name: 'tx_modelo'},	  {name: 'tx_unidad'},	{name: 'resp'}]
       });	
    storeVehiculo.setDefaultSort('co_vehiculo', 'ASC');
	
	
    var colModelVehiculo = new Ext.grid.ColumnModel([
        {id:'co_vehiculo',header: "Numero de Veiculo", width: 250, sortable: true, locked:false, dataIndex: 'co_vehiculo'},
        {header: "Placa", width: 250, sortable: true, locked:false, dataIndex: 'tx_placa'},
        {header: "Marca", width: 250, sortable: true, locked:false, dataIndex: 'tx_marca'},
        {header: "Modelo", width: 250, sortable: true, locked:false, dataIndex: 'tx_modelo'},
        {header: "Numero de la unidad", width: 250, sortable: true, locked:false, dataIndex: 'tx_unidad'},
        ]);
	
	
/*
 *    Here is where we create the Form
 */
 	//ventana de potreraje//

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_transporte',
        frame: true,
		labelAlign: 'center',
        title: 'Transporte',
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
			title: 'Transportes',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Transporte',
						xtype:'numberfield',
						id: 'co_transporte',
                        name: 'co_transporte',

                        width:140
                    }]
				}]
			},{
	   		xtype:'fieldset',
			id: 'frm2',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Linea',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Linea',
						xtype:'numberfield',
						id: 'co_linea',
                        name: 'co_linea',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }, {
                        fieldLabel: 'Nombre Linea',
						xtype:'textfield',
						vtype:'validos',
						disabled:true,
						id: 'nb_linea',
                        name: 'nb_linea',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Telefono',
						xtype:'numberfield',
						id: 'tx_telefono',
						disabled:true,
                        name: 'tx_telefono',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						id: 'di_oficina',
						disabled:true,
                        name: 'di_oficina',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    }]
			}]
			},{
	   		xtype:'fieldset',
			id: 'frm3',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Vehiculo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Vehiculo',
						xtype:'numberfield',
						id: 'co_vehiculo',
                        name: 'co_vehiculo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }, {
                        fieldLabel: 'Placa',
						xtype:'textfield',
						vtype:'validos',
						disabled:true,
						id: 'tx_placa',
                        name: 'tx_placa',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Marca',
						xtype:'numberfield',
						id: 'tx_marca',
						disabled:true,
                        name: 'tx_marca',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Modelo',
						xtype:'textfield',
						id: 'tx_modelo',
						disabled:true,
                        name: 'tx_modelo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Unidad',
						xtype:'textfield',
						id: 'tx_unidad',
						disabled:true,
                        name: 'tx_unidad',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
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
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
						Ext.getCmp("frm2").enable();
						Ext.getCmp("frm3").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_transporte").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_transporte").getForm().getValues(false);	
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
								storeTransporte.baseParams = {'accion': 'insertar'};
							else
								storeTransporte.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_transporte" : "'+Ext.getCmp("co_transporte").getValue()+'", ';
							columnas += '"co_linea" : "'+convFecha(Ext.getCmp("co_linea").getValue())+'", ';
							columnas += '"co_vehiculo" : "'+Ext.getCmp("co_vehiculo").getValue()+'"}';
							storeTransporte.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_transporte" : "'+Ext.getCmp("co_transporte").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_transporte.php"},
										callback: function () {
										if(storeTransporte.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTransporte.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											/*if(nuevo==true){
												if(gridForm.getForm().isValid())  gridForm.getForm().reset();
												Ext.getCmp("co_forraje").focus();
											}*/
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							}});
							storeTransporte.baseParams = {'accion': 'refrescar', 'interfaz': 'interfaz_transporte.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Transporte',
			disabled: true,
			handler: function(){
										storeTransporte.baseParams = {'accion': 'eliminar'};
										storeTransporte.load({params:{
												"condiciones": '{ "co_transporte" : "'+Ext.getCmp("co_transporte").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_transporte.php"},
										callback: function () {
										if(storeTransporte.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTransporte.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											/*if(nuevo==true){
												if(gridForm.getForm().isValid())  gridForm.getForm().reset();
												Ext.getCmp("co_forraje").focus();
											}*/
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
				id: 'gd_transporte',
                store: storeTransporte,
                cm: colModelTransporte,
			//	plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_transporte").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Transportes',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeTransporte,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });
	
function selLinea(){
storeLinea.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "interfaz_linea.php"}});
	if(!winLinea){
				winLinea = new Ext.Window({
						applyTo : 'winLinea',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selLinea',
								store: storeLinea,
								cm: colModelLinea,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lineas de Taxi',
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
										if(Ext.getCmp("gd_selLinea").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selLinea").getSelectionModel().getSelected();
											Ext.getCmp("co_linea").setValue(record.data.co_linea);
											Ext.getCmp("nb_linea").setValue(record.data.nb_linea);
											Ext.getCmp("tx_telefono").setValue(record.data.tx_telefono);
											Ext.getCmp("di_oficina").setValue(record.data.di_oficina);
											winLinea.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winLinea.hide();
								  }
						}]
				});
		}
		winLinea.show();	
}

function selVehiculo(){
storeVehiculo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "interfaz_vehiculo.php"}});
	if(!winVehiculo){
				winVehiculo = new Ext.Window({
						applyTo : 'winVehiculo',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selVehiculo',
								store: storeVehiculo,
								cm: colModelVehiculo,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Vehiculos',
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
										if(Ext.getCmp("gd_selVehiculo").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selVehiculo").getSelectionModel().getSelected();
											Ext.getCmp("co_vehiculo").setValue(record.data.co_vehiculo);
											Ext.getCmp("tx_placa").setValue(record.data.tx_placa);
											Ext.getCmp("tx_marca").setValue(record.data.tx_marca);
											Ext.getCmp("tx_modelo").setValue(record.data.tx_modelo);
											Ext.getCmp("tx_unidad").setValue(record.data.tx_unidad);
											winVehiculo.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winVehiculo.hide();
								  }
						}]
				});
		}
		winVehiculo.show();	
}

	
storeTransporte.load({params: { start: 0, limit: 50, accion:"refrescar"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_transporte").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
			Ext.getCmp("frm3").enable();
		}
		Ext.getCmp("co_transporte").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerLinea = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerLinea.onTriggerClick = selLinea;
		triggerLinea.applyToMarkup('co_linea');	


var triggerVehiculo = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerVehiculo.onTriggerClick = selVehiculo;
		triggerVehiculo.applyToMarkup('co_vehiculo');	
});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
<div id="winCond" class="x-hidden">
    <div class="x-window-header">Ejegir Linea</div>
	
</div>
<div id="winPiloto" class="x-hidden">
    <div class="x-window-header">Ejegir Vehiculo</div>
	
</div>
</body>
</html>
