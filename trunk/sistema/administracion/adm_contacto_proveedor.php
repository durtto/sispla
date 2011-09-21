<html>
<head>
<title>Contacto</title>
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
 var winProveedor;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_contacto'] = 'Codigo Contacto';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	var storeProveedor = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proveedor.php',
		remoteSort : true,
		root: 'proveedores',
        totalProperty: 'total',
		idProperty: 'co_proveedor',
        fields: [{name: 'co_proveedor'},
        		{name: 'nb_proveedor'},		
        		{name: 'resp'}]
        });
    storeProveedor.setDefaultSort('co_proveedor', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelProveedor = new Ext.grid.ColumnModel([
        {id:'co_proveedor',header: "Codigo de Proveedor", width: 200, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Nombre", width: 200, sortable: true, locked:false, dataIndex: 'nb_proveedor'},
      ]);
      
  var storeContacto = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_contacto_proveedor.php',
		remoteSort : true,
		root: 'contactos',
        totalProperty: 'total',
		idProperty: 'co_contacto',
        fields: [{name: 'co_contacto'},
		        {name: 'nb_contacto'},
		        {name: 'tx_apellido'},
		        {name: 'di_oficina'},
		        {name: 'tx_telefono_oficina'},
		        {name: 'tx_correo_electronico'},
		        {name: 'di_habitacion'},
		        {name: 'tx_telefono_habitacion'},
		        {name: 'co_proveedor'},
		        {name: 'nb_proveedor'},
		        {name: 'resp'}]
        });
    storeContacto.setDefaultSort('co_contacto', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelContacto = new Ext.grid.ColumnModel([
        {id:'co_contacto',header: "Contacto", width: 100, sortable: true, locked:false, dataIndex: 'co_contacto'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		{header: "Telefono Habitacion", width: 120, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        {header: "Proveedor", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
      ]);
	
	     

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_contacto',
        frame: true,
		labelAlign: 'center',
        title: 'Contacto',
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
			title: 'Contactos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Contacto',
						xtype:'numberfield',
						id: 'co_contacto',
                        name: 'co_contacto',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_contacto',
                        name: 'nb_contacto',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Apellido',
						xtype:'textfield',
						id: 'tx_apellido',
                        name: 'tx_apellido',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Correo Electronico',
						xtype:'textfield',
						id: 'tx_correo_electronico',
                        name: 'tx_correo_electronico',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Codigo de Proveedor',
						xtype:'numberfield',
						id: 'co_proveedor',
                        name: 'co_proveedor',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_proveedor',
						disabled:true,
                        name: 'nb_proveedor',
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
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Oficina',
						xtype:'textfield',
						id: 'di_oficina',
                        name: 'di_oficina',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Telefono Oficina',
						xtype:'numberfield',
						id: 'tx_telefono_oficina',
                        name: 'tx_telefono_oficina',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                      
                    },{
                        fieldLabel: 'Habitacion',
						xtype:'textfield',
						id: 'di_habitacion',
                        name: 'di_habitacion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Telefono Habitacion',
						xtype:'numberfield',
						id: 'tx_telefono_habitacion',
                        name: 'tx_telefono_habitacion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                       
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
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_contacto").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_contacto").getForm().getValues(false);	
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
								storeContacto.baseParams = {'accion': 'insertar'};
							else
								storeContacto.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_contacto" : "'+Ext.getCmp("co_contacto").getValue()+'", ';
								columnas += '"nb_contacto" : "'+Ext.getCmp("nb_contacto").getValue()+'", ';
								columnas += '"tx_apellido" : "'+Ext.getCmp("tx_apellido").getValue()+'", ';
								columnas += '"di_oficina" : "'+Ext.getCmp("di_oficina").getValue()+'", ';
								columnas += '"tx_telefono_oficina" : "'+Ext.getCmp("tx_telefono_oficina").getValue()+'", ';
								columnas += '"tx_correo_electronico" : "'+Ext.getCmp("tx_correo_electronico").getValue()+'", ';
								columnas += '"di_habitacion" : "'+Ext.getCmp("di_habitacion").getValue()+'", ';
								columnas += '"tx_telefono_habitacion" : "'+Ext.getCmp("tx_telefono_habitacion").getValue()+'", ';
								columnas += '"co_proveedor" : "'+Ext.getCmp("co_proveedor").getValue()+'"}';
							storeContacto.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_contacto" : "'+Ext.getCmp("co_contacto").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_contacto_proveedor.php"},
										callback: function () {
										if(storeContacto.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeContacto.getAt(0).data.resp, 
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
							storeContacto.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_contacto_proveedor.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Contacto',
			disabled: true,
			handler: function(){
										storeContacto.baseParams = {'accion': 'eliminar'};
										storeContacto.load({params:{
												"condiciones": '{ "co_contacto" : "'+Ext.getCmp("co_contacto").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_contacto_proveedor.php"},
										callback: function () {
										if(storeContacto.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeContacto.getAt(0).data.resp,
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
				id: 'gd_contacto',
                store: storeContacto,
                cm: colModelContacto,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_contacto").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Contacto',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeContacto,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

function selProveedor(){
storeProveedor.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_proveedor.php"}});
	if(!winProveedor){
				winProveedor = new Ext.Window({
						applyTo : 'winProveedor',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selProveedor',
								store: storeProveedor,
								cm: colModelProveedor,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Proveedor',
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
										if(Ext.getCmp("gd_selProveedor").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selProveedor").getSelectionModel().getSelected();
											Ext.getCmp("co_proveedor").setValue(record.data.co_proveedor);
											Ext.getCmp("nb_proveedor").setValue(record.data.nb_proveedor);
											winProveedor.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winProveedor.hide();
								  }
						}]
				});
		}
		winProveedor.show();	
}
 
	
storeContacto.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_contacto_proveedor.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_contacto").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_contacto").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerProveedor = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerProveedor.onTriggerClick = selProveedor;
		triggerProveedor.applyToMarkup('nb_proveedor');
});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
<div id="winProveedor" class="x-hidden">
    <div class="x-window-header">Ejegir Proveedor</div>
	
</div>
</body>
</html>