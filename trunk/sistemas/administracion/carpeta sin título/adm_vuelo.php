<html>
<head>
<title></title>
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
 var winCond;
  var winPiloto;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['nu_cola'] = 'Numero cola';
	camposReq['tp_avion'] = 'Tipo avion';
	
    var bd = Ext.getBody();

	var url = {
        local:  '../jsonp/grid-filter.json',  // static data file
        remote: '../jsonp/grid-filter.php'
    };
    //var encode = false;
    // configure whether filtering is performed locally or remotely (initially)
    var local = true;
	
  var storeAvion = new Ext.data.JsonStore({
		url: '../clases/interfaz_avion.php', //'../../clases-sifat/interfaz.php',
		remoteSort : true,
		root: 'aviones',
        totalProperty: 'total',
		idProperty: 'nu_cola',
        fields: [{name: 'nu_cola'},					{name: 'tp_avion'},					{name: 'hr_vuelo'},			{name: 'resp'}]
        });
    storeAvion.setDefaultSort('nu_cola', 'ASC');
	
	
    var colModelAvion = new Ext.grid.ColumnModel([
        {id:'nu_cola',header: "Numero cola", width: 200, sortable: true, locked:false, dataIndex: 'nu_cola'},
        {header: "Tipo avion", width: 200, sortable: true, locked:false, dataIndex: 'tp_avion'},
        {header: "Horas vuelo", width: 200, sortable: true, locked:false, dataIndex: 'hr_vuelo'},
      ]);
	
	 var storePiloto = new Ext.data.JsonStore({
		url: '../clases/interfaz_piloto.php', //'../../clases-sifat/interfaz.php',
		remoteSort : true,
		root: 'piloto',
        totalProperty: 'total',
		idProperty: 'co_cedula',
        fields: [{name: 'co_cedula'},					{name: 'nb_piloto'},					{name: 'tx_direccion'},			{name: 'resp'}]
        });
    storePiloto.setDefaultSort('co_cedula', 'ASC');
	
	
    var colModelPiloto = new Ext.grid.ColumnModel([
        {id:'co_cedula',header: "Numero cedula", width: 200, sortable: true, locked:false, dataIndex: 'co_cedula'},
        {header: "Nombre Piloto", width: 200, sortable: true, locked:false, dataIndex: 'nb_piloto'},
        {header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'tx_direccion'},
      ]);
	  
	  
	    var storeVuelo = new Ext.data.JsonStore({
		url: '../clases/interfaz_vuelo.php', //'../../clases-sifat/interfaz.php',
		remoteSort : true,
		root: 'vuelos',
        totalProperty: 'total',
		idProperty: 'id_vuelo',
        fields: [{name: 'id_vuelo'},					{name: 'fe_vuelo'},					{name: 'tx_origen'},		{name: 'tx_destino'},      {name: 'piloto_co_cedula'},	   {name: 'nb_piloto'},   {name: 'avion_nu_cola'}, {name: 'tx_direccion'}, {name: 'hr_vuelo'},    {name: 'tp_avion'},  {name: 'resp'}]
        });
    storeVuelo.setDefaultSort('id_vuelo', 'ASC');
	
	
    var colModelVuelo = new Ext.grid.ColumnModel([
        {id:'id_vuelo',header: "Vuelo", width: 80, sortable: true, locked:false, dataIndex: 'id_vuelo'},
        {header: "Fecha de Vuelo", width: 120, sortable: true, locked:false, dataIndex: 'fe_vuelo'},
        {header: "Origen", width: 150, sortable: true, locked:false, dataIndex: 'tx_origen'},
		{header: "Destino", width: 150, sortable: true, locked:false, dataIndex: 'tx_destino'},
		{header: "Cedula Piloto", width: 80, sortable: true, locked:false, dataIndex: 'piloto_co_cedula', hidden: true},
		{header: "Nombre Piloto", width: 80, sortable: true, locked:false, dataIndex: 'nb_piloto', hidden: true},
		{header: "Dir. Piloto", width: 80, sortable: true, locked:false, dataIndex: 'tx_direccion', hidden: true},
		{header: "Numero de cola", width: 100, sortable: true, locked:false, dataIndex: 'avion_nu_cola'},
		{header: "Tipo Avion", width: 80, sortable: true, locked:false, dataIndex: 'tp_avion', hidden: true},
		{header: "Horas de vuelo", width: 80, sortable: true, locked:false, dataIndex: 'hr_vuelo', hidden: true},
      ]);
	
/*
 *    Here is where we create the Form
 */
 	//ventana de potreraje//

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_forraje',
        frame: true,
		labelAlign: 'center',
        title: 'Vuelos',
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
			title: 'Vuelos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Vuelo',
						xtype:'numberfield',
						id: 'id_vuelo',
                        name: 'id_vuelo',
                        width:140
                    },{
                        fieldLabel: 'Fecha vuelo',
						xtype:'datefield',
						id: 'fe_vuelo',
                        name: 'fe_vuelo',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Origen',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_origen',
                        name: 'tx_origen',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Destino',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_destino',
                        name: 'tx_destino',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
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
			title: 'Avion',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Cola',
						xtype:'numberfield',
						id: 'avion_nu_cola',
                        name: 'avion_nu_cola',
						disabled:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:123	
                    }, {
                        fieldLabel: 'Tipo Avion',
						xtype:'textfield',
						vtype:'validos',
						id: 'tp_avion',
                        name: 'tp_avion',
						disabled:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Horas Vuelo',
						xtype:'numberfield',
						id: 'hr_vuelo',
                        name: 'hr_vuelo',
						disabled:true,
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
			title: 'Piloto',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Cedula',
						xtype:'numberfield',
						id: 'piloto_co_cedula',
						disabled:true,
                        name: 'piloto_co_cedula',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:123
                    }, {
                        fieldLabel: 'Nombre Piloto',
						xtype:'textfield',
						vtype:'validos',
						disabled:true,
						id: 'nb_piloto',
                        name: 'nb_piloto',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						id: 'tx_direccion',
						disabled:true,
                        name: 'tx_direccion',
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
					//nroReg=storeAvion.getCount();
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
						Ext.getCmp("frm2").enable();
						Ext.getCmp("frm3").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("id_vuelo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_forraje").getForm().getValues(false);	
						campos = verifObligatorios(camposForm, camposReq);
						if(campos != ''){		
							Ext.MessageBox.show({
								title: 'ATENCIÓN',
								msg: 'No se pueden guardar los datos. <br />Faltan los siguientes campos obligatorios por llenar: <br /><br />'+campos,
								buttons: Ext.MessageBox.OK,
								icon: Ext.MessageBox.WARNING
							});
						}
						else
						{
							if(nuevo)						
								storeVuelo.baseParams = {'accion': 'insertar'};
							else
								storeVuelo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"id_vuelo" : "'+Ext.getCmp("id_vuelo").getValue()+'", ';
							columnas += '"fe_vuelo" : "'+convFecha(Ext.getCmp("fe_vuelo").getValue())+'", ';
							columnas += '"tx_origen" : "'+Ext.getCmp("tx_origen").getValue()+'",';
							columnas += '"tx_destino" : "'+Ext.getCmp("tx_destino").getValue()+'",';
							columnas += '"avion_nu_cola" : "'+Ext.getCmp("avion_nu_cola").getValue()+'",';
							columnas += '"piloto_co_cedula" : "'+Ext.getCmp("piloto_co_cedula").getValue()+'"}';
							storeVuelo.load({params:{"columnas" : columnas,
												"condiciones": '{ "id_vuelo" : "'+Ext.getCmp("id_vuelo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_vuelo.php"},
										callback: function () {
										if(storeVuelo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeVuelo.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
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
							storeVuelo.baseParams = {'accion': 'refrescar', 'interfaz': 'interfaz_vuelo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar avion',
			disabled: true,
			handler: function(){
										storeVuelo.baseParams = {'accion': 'eliminar'};
										storeVuelo.load({params:{
												"condiciones": '{ "id_vuelo" : "'+Ext.getCmp("id_vuelo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_vuelo.php"},
										callback: function () {
										if(storeVuelo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeVuelo.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
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
				id: 'gd_forraje',
                store: storeVuelo,
                cm: colModelVuelo,
			//	plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_forraje").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Vuelos',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeAvion,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });
	
function selAvion(){
storeAvion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "interfaz_avion.php"}});
	if(!winCond){
				winCond = new Ext.Window({
						applyTo : 'winCond',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selAvion',
								store: storeAvion,
								cm: colModelAvion,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de aviones',
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
										if(Ext.getCmp("gd_selAvion").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selAvion").getSelectionModel().getSelected();
											Ext.getCmp("avion_nu_cola").setValue(record.data.nu_cola);
											Ext.getCmp("tp_avion").setValue(record.data.tp_avion);
											Ext.getCmp("hr_vuelo").setValue(record.data.hr_vuelo);
											winCond.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winCond.hide();
								  }
						}]
				});
		}
		winCond.show();	
}

function selPiloto(){
storePiloto.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "interfaz_piloto.php"}});
	if(!winPiloto){
				winPiloto = new Ext.Window({
						applyTo : 'winPiloto',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selPiloto',
								store: storePiloto,
								cm: colModelPiloto,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Piloto',
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
										if(Ext.getCmp("gd_selPiloto").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selPiloto").getSelectionModel().getSelected();
											Ext.getCmp("piloto_co_cedula").setValue(record.data.co_cedula);
											Ext.getCmp("nb_piloto").setValue(record.data.nb_piloto);
											Ext.getCmp("tx_direccion").setValue(record.data.tx_direccion);
											winPiloto.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winPiloto.hide();
								  }
						}]
				});
		}
		winPiloto.show();	
}

	
storeVuelo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "interfaz_vuelo.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_forraje").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
			Ext.getCmp("frm3").enable();
		}
		Ext.getCmp("id_vuelo").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerAvion = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerAvion.onTriggerClick = selAvion;
		triggerAvion.applyToMarkup('avion_nu_cola');	


var triggerPiloto = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPiloto.onTriggerClick = selPiloto;
		triggerPiloto.applyToMarkup('piloto_co_cedula');	
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
    <div class="x-window-header">Ejegir Avion</div>
	
</div>
<div id="winPiloto" class="x-hidden">
    <div class="x-window-header">Ejegir Piloto</div>
	
</div>
</body>
</html>
