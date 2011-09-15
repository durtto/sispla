<html>
<head>
<title>Servicio</title>
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
 var winCapacidad;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_servicio'] = 'Codigo Servicio';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	var storeCapacidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_capacidad.php',
		remoteSort : true,
		root: 'capacidades',
        totalProperty: 'total',
		idProperty: 'co_capacidad',
        fields: [{name: 'co_capacidad'},
        		{name: 'nb_capacidad'},		
        		{name: 'resp'}]
        });
    storeCapacidad.setDefaultSort('co_capacidad', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelCapacidad = new Ext.grid.ColumnModel([
        {id:'co_capacidad',header: "Codigo de Capacidad", width: 200, sortable: true, locked:false, dataIndex: 'co_capacidad'},
        {header: "Nombre", width: 200, sortable: true, locked:false, dataIndex: 'nb_capacidad'},
      ]);
      
  var storeServicio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_servicio.php',
		remoteSort : true,
		root: 'servicios',
        totalProperty: 'total',
		idProperty: 'co_servicio',
        fields: [{name: 'co_servicio'},
		        {name: 'nb_servicio'},
		        {name: 'tx_descripcion'},
		        {name: 'co_capacidad'},
		        {name: 'nb_capacidad'},
		        {name: 'resp'}]
        });
    storeServicio.setDefaultSort('co_servicio', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelServicio = new Ext.grid.ColumnModel([
        {id:'co_servicio',header: "Servicio", width: 100, sortable: true, locked:false, dataIndex: 'co_servicio'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_servicio'},
		{header: "Descripcion", width: 338, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Capacidad", width: 100, sortable: true, locked:false, dataIndex: 'co_capacidad'},
        {header: "Nombre", width: 200, sortable: true, locked:false, dataIndex: 'nb_capacidad'},      
      ]);
	
	     

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_servicio',
        frame: true,
		labelAlign: 'center',
        title: 'Servicio',
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
			title: 'Servicios',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Servicio',
						xtype:'numberfield',
						id: 'co_servicio',
                        name: 'co_servicio',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_servicio',
                        name: 'nb_servicio',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Descripcion',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
                        height: 100,
            			anchor: '100%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
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
			title: 'Capacidad',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Capacidad',
						xtype:'numberfield',
						id: 'co_capacidad',
                        name: 'co_capacidad',
                        //hidden: true,
						//hideLabel: true,
                        width:160
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_capacidad',
						disabled:true,
                        name: 'nb_capacidad',
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
					//nroReg=storeGrupo.getCount();
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
						Ext.getCmp("frm2").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_servicio").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_servicio").getForm().getValues(false);	
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
								storeServicio.baseParams = {'accion': 'insertar'};
							else
								storeServicio.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_servicio" : "'+Ext.getCmp("co_servicio").getValue()+'", ';
								columnas += '"nb_servicio" : "'+Ext.getCmp("nb_servicio").getValue()+'", ';
								columnas += '"co_capacidad" : "'+Ext.getCmp("co_capacidad").getValue()+'"}';
							storeServicio.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_servicio" : "'+Ext.getCmp("co_servicio").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_servicio.php"},
										callback: function () {
										if(storeServicio.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeServicio.getAt(0).data.resp, 
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
							storeServicio.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_servicio.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Servicio',
			disabled: true,
			handler: function(){
										storeServicio.baseParams = {'accion': 'eliminar'};
										storeServicio.load({params:{
												"condiciones": '{ "co_servicio" : "'+Ext.getCmp("co_servicio").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_servicio.php"},
										callback: function () {
										if(storeServicio.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeServicio.getAt(0).data.resp,
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
				id: 'gd_servicio',
                store: storeServicio,
                cm: colModelServicio,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_servicio").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Servicio',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeServicio,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

function selCapacidad(){
storeCapacidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_capacidad.php"}});
	if(!winCapacidad){
				winCapacidad = new Ext.Window({
						applyTo : 'winCapacidad',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selCapacidad',
								store: storeCapacidad,
								cm: colModelCapacidad,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Capacidad',
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
										if(Ext.getCmp("gd_selCapacidad").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selCapacidad").getSelectionModel().getSelected();
											Ext.getCmp("co_capacidad").setValue(record.data.co_capacidad);
											Ext.getCmp("nb_capacidad").setValue(record.data.nb_capacidad);
											winCapacidad.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winCapacidad.hide();
								  }
						}]
				});
		}
		winCapacidad.show();	
}
 
	
storeServicio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_servicio.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_servicio").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
		}
		Ext.getCmp("co_servicio").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerCapacidad = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerCapacidad.onTriggerClick = selCapacidad;
		triggerCapacidad.applyToMarkup('co_capacidad');
});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
<div id="winCapacidad" class="x-hidden">
    <div class="x-window-header">Ejegir Capacidad</div>
	
</div>
</body>
</html>
