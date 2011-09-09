<html>
<head>
<title>Equipo Requerido</title>
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
	camposReq['co_equipo'] = 'Codigo de Registro';
	
    var bd = Ext.getBody();

	var url = {
        local:  '../jsonp/grid-filter.json',
        remote: '../jsonp/grid-filter.php'
    };

    var local = true;
	
  var storeEquipo = new Ext.data.JsonStore({
		url: '../clases/interfaz_equipo_requerido.php',
		remoteSort : true,
		root: 'equipos',
        totalProperty: 'total',
		idProperty: 'co_equipo_requerido',
        fields: [{name: 'co_equipo_requerido'},
        		{name: 'bo_vehiculo'},
        		{name: 'bo_laptop'},
        		{name: 'bo_maletin_herramientas'},
        		{name: 'bo_radio'},
        		{name: 'bo_multimetro_digital'},
        		{name: 'bo_hart'},	{name: 'co_activo'},
        		{name: 'co_indicador'},
        		{name: 'resp'}]
        });
    storeEquipo.setDefaultSort('co_equipo_requerido', 'ASC');
	
	
    var colModelEquipo = new Ext.grid.ColumnModel([
        {id:'co_equipo',header: "Equipo", width: 200, hidden:true, sortable: true, locked:false, dataIndex: 'co_equipo_requerido'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
        {header: "Nombre", width: 80, sortable: true, locked:false, dataIndex: 'nb_persona'},
        {header: "Apellido", width: 80, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Telefono Oficina", width: 150, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Telefono Habitacion", width: 150, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        {header: "Vehiculo", width: 60, sortable: true, locked:false, dataIndex: 'bo_vehiculo'},
        {header: "Laptop", width: 60, sortable: true, locked:false, dataIndex: 'bo_laptop'},
        {header: "Maletin", width: 60, sortable: true, locked:false, dataIndex: 'bo_maletin_herramientas'},
        {header: "Radio", width: 60, sortable: true, locked:false, dataIndex: 'bo_radio'},
		{header: "Multimetro", width: 70, sortable: true, locked:false, dataIndex: 'bo_multimetro_digital'},
		{header: "HART", width: 60, sortable: true, locked:false, dataIndex: 'bo_hart'},
		
        
      ]);
	
	 var storeLinea = new Ext.data.JsonStore({
		url: '../clases/interfaz_lineaTaxi.php',
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
		url: '../clases/interfaz_vehiculo.php',
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
	

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_equipo',
        frame: true,
		labelAlign: 'center',
        title: 'Equipo Requerido',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
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
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			//layout:'column',
			title: 'Equipo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Registro',
						xtype:'numberfield',
						id: 'co_equipo_requerido',
                        name: 'co_equipo_requerido',
                        hidden: true,
						hideLabel: true,
                        width:80
                    },{
	            		xtype: 'radiogroup',
	            		fieldLabel: 'Vehiculo',
	            		id: 'bo_vehiculo',
		                name: 'bo_vehiculo',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'VerdaderoVehiculo', inputValue: 1},
			                {boxLabel: 'No', name: 'FalsoVehiculo', inputValue: 0},
			           			]
        		},{
	            		xtype: 'radiogroup',
	            		fieldLabel: 'Laptop',
	            		id: 'bo_laptop',
		                name: 'bo_laptop',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'Verdaderolaptop', inputValue: 1},
			                {boxLabel: 'No', name: 'Falsolaptop', inputValue: 0},
			           			]
        		}, {
	            		xtype: 'radiogroup',
	            		fieldLabel: 'Maletin de Herramientas',
	            		id: 'bo_maletin_herramientas',
		                name: 'bo_maletin_herramientas',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'Verdaderomr', inputValue: 1},
			                {boxLabel: 'No', name: 'Falsomh', inputValue: 0},
			           			]
        		},{
	            		xtype: 'radiogroup',
	            		fieldLabel: 'Radio',
	            		id: 'bo_radio',
		                name: 'bo_radio',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'Verdaderoradio', inputValue: 1},
			                {boxLabel: 'No', name: 'Falsoradio', inputValue: 0},
			           			]
        		},{
	           			xtype: 'radiogroup',
	            		fieldLabel: 'Multimetro Digital',
	            		id: 'bo_multimetro_digital',
		                name: 'bo_multimetro_digital',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'Verdaderomultimetro', inputValue: 1},
			                {boxLabel: 'No', name: 'Falsomultimetro', inputValue: 0},
			           			]
        		},{
	            		xtype: 'radiogroup',
	            		fieldLabel: 'HART',
	            		id: 'bo_hart',
		                name: 'bo_hart',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'Verdaderohart', inputValue: 1},
			                {boxLabel: 'No', name: 'Falsohart', inputValue: 0},
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
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
						Ext.getCmp("frm2").enable();
						Ext.getCmp("frm3").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_equipo").focus();
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
								storeEquipo.baseParams = {'accion': 'insertar'};
							else
								storeEquipo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'", ';
							columnas += '"bo_vehiculo" : "'+convFecha(Ext.getCmp("bo_vehiculo").getValue())+'", ';
							columnas += '"bo_laptop" : "'+convFecha(Ext.getCmp("bo_laptop").getValue())+'", ';
							columnas += '"bo_maletin_herramientas" : "'+convFecha(Ext.getCmp("bo_maletin_herramientas").getValue())+'", ';							
							columnas += '"bo_radio" : "'+convFecha(Ext.getCmp("bo_radio").getValue())+'", ';							
							columnas += '"bo_multimetro_digital" : "'+convFecha(Ext.getCmp("bo_multimetro_digital").getValue())+'", ';
							columnas += '"bo_hart" : "'+convFecha(Ext.getCmp("bo_hart").getValue())+'", ';
							columnas += '"co_activo" : "'+convFecha(Ext.getCmp("co_activo").getValue())+'", ';
							columnas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}';
							
							storeEquipo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_equipo_requerido.php"},
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
							storeEquipo.baseParams = {'accion': 'refrescar'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Transporte',
			disabled: true,
			handler: function(){
										storeEquipo.baseParams = {'accion': 'eliminar'};
										storeEquipo.load({params:{
												"condiciones": '{ "co_equipo_requerido" : "'+Ext.getCmp("co_equipo_requerido").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_transporte.php"},
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
				id: 'gd_equipo',
                store: storeEquipo,
                cm: colModelEquipo,
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_equipo").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Equipos Requeridos',
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
				})
            }]
			
		}],
        
    });
	
function selLinea(){
storeLinea.load({params: { start: 0, limit: 50, accion:"refrescar"}});
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
								id: 'gd_selLinea',
								store: storeLinea,
								cm: colModelLinea,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								loadMask: true,
								height: 200,
								title:'Lineas de Taxi',
								border: true,
								listeners: {
												delay: 10
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
						
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
storeVehiculo.load({params: { start: 0, limit: 50, accion:"refrescar"}});
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

	
storeEquipo.load({params: { start: 0, limit: 50, accion:"refrescar"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_equipo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
			Ext.getCmp("frm3").enable();
		}
		Ext.getCmp("co_equipo_requerido").focus();
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
