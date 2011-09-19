<html>
<head>
<title>Usuario</title>
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
 var winPrivilegio;
 var winPersona;
 
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_usuario'] = 'Codigo Usuario';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	var storePrivilegio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_privilegio_usuario.php',
		remoteSort : true,
		root: 'privilegios',
        totalProperty: 'total',
		idProperty: 'co_privilegio',
        fields: [{name: 'co_privilegio'},
        		{name: 'nb_privilegio'},
        		{name: 'tx_descripcion'},
        		{name: 'resp'}]
        });
    storePrivilegio.setDefaultSort('co_privilegio', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelPrivilegio = new Ext.grid.ColumnModel([
        {id:'co_privilegio',header: "Privilegio", width: 100, sortable: true, locked:false, dataIndex: 'co_privilegio'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_privilegio'},
        {header: "Descripcion", width: 338, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        ]);
    
    var storePersona = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_persona.php',
		remoteSort : true,
		root: 'personas',
        totalProperty: 'total',
		idProperty: 'co_indicador',
        fields: [{name: 'co_indicador'},
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
		        {name: 'resp'}]
        });
    storePersona.setDefaultSort('co_indicador', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelPersona = new Ext.grid.ColumnModel([
        {id:'co_indicador',header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
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
      
      ]);
   
  var storeUsuario = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_usuario.php',
		remoteSort : true,
		root: 'usuarios',
        totalProperty: 'total',
		idProperty: 'co_usuario',
        fields: [{name: 'co_usuario'},
		        {name: 'co_privilegio'},
        		{name: 'nb_privilegio'},
		        {name: 'co_indicador'},
        		{name: 'nu_cedula'},
		        {name: 'resp'}]
        });
    storeUsuario.setDefaultSort('co_usuario', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelUsuario = new Ext.grid.ColumnModel([
        {id:'co_usuario',header: "Usuario", width: 100, sortable: true, locked:false, dataIndex: 'co_usuario'},
        {header: "Privilegio", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_privilegio'},
        {header: "Privilegio", width: 338, sortable: true, locked:false, dataIndex: 'nb_privilegio'},
        {header: "Persona", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "Persona", width: 338, sortable: true, locked:false, dataIndex: 'nu_cedula'},
      ]);
	
	     

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_usuario',
        frame: true,
		labelAlign: 'center',
        title: 'Usuario',
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
			title: 'Usuarios',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Usuario',
						xtype:'numberfield',
						id: 'co_usuario',
                        name: 'co_usuario',
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
			title: 'Privilegio',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Privilegio',
						xtype:'numberfield',
						id: 'co_privilegio',
                        name: 'co_privilegio',
                        //hidden: true,
						//hideLabel: true,
                        width:160
                    }]
			},{
					layout: 'form',
					labelWidth:140,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_privilegio',
						disabled:true,
                        name: 'nb_privilegio',
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
	   		xtype:'fieldset',
			id: 'frm3',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Persona',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Persona',
						xtype:'numberfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        //hidden: true,
						//hideLabel: true,
                        width:160
                    }]
			},{
					layout: 'form',
					labelWidth:140,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_persona',
						disabled:true,
                        name: 'nb_persona',
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
						Ext.getCmp("frm3").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_usuario").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_usuario").getForm().getValues(false);	
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
								storeUsuario.baseParams = {'accion': 'insertar'};
							else
								storeUsuario.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_usuario" : "'+Ext.getCmp("co_usuario").getValue()+'", ';
								columnas += '"co_privilegio" : "'+Ext.getCmp("co_privilegio").getValue()+'", ';
								columnas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}';
							storeUsuario.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_usuario" : "'+Ext.getCmp("co_usuario").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_usuario.php"},
										callback: function () {
										if(storeUsuario.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeUsuario.getAt(0).data.resp, 
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
							storeUsuario.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_usuario.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Usuario',
			disabled: true,
			handler: function(){
										storeUsuario.baseParams = {'accion': 'eliminar'};
										storeUsuario.load({params:{
												"condiciones": '{ "co_usuario" : "'+Ext.getCmp("co_usuario").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_usuario.php"},
										callback: function () {
										if(storeUsuario.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeUsuario.getAt(0).data.resp,
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
				id: 'gd_usuario',
                store: storeUsuario,
                cm: colModelUsuario,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_usuario").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Usuario',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeUsuario,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

function selPrivilegio(){
storePrivilegio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_privilegio.php"}});
	if(!winPrivilegio){
				winPrivilegio = new Ext.Window({
						applyTo : 'winPrivilegio',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selPrivilegio',
								store: storePrivilegio,
								cm: colModelPrivilegio,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Privilegio',
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
										if(Ext.getCmp("gd_selPrivilegio").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selPrivilegio").getSelectionModel().getSelected();
											Ext.getCmp("co_privilegio").setValue(record.data.co_privilegio);
											Ext.getCmp("nb_privilegio").setValue(record.data.nb_privilegio);
											winPrivilegio.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winPrivilegio.hide();
								  }
						}]
				});
		}
		winPrivilegio.show();	
}

function selPersona(){
storePersona.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_persona.php"}});
	if(!winPrivilegio){
				winPersona = new Ext.Window({
						applyTo : 'winPersona',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selPersona',
								store: storePersona,
								cm: colModelPersona,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Persona',
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
										if(Ext.getCmp("gd_selPersona").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selPersona").getSelectionModel().getSelected();
											Ext.getCmp("co_indicador").setValue(record.data.co_co_indicador);
											Ext.getCmp("nb_persona").setValue(record.data.nb_persona);
											winPersona.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winPersona.hide();
								  }
						}]
				});
		}
		winPersona.show();	
}
	
storeUsuario.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_usuario.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_usuario").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
		}
		Ext.getCmp("co_usuario").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerPrivilegio = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPrivilegio.onTriggerClick = selPrivilegio;
		triggerPrivilegio.applyToMarkup('co_privilegio');
var triggerPersona = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPersona.onTriggerClick = selPersona;
		triggerPersona.applyToMarkup('co_indicador');
});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
<div id="winPrivilegio" class="x-hidden">
    <div class="x-window-header">Ejegir Privilegio</div>
	
</div>
</body>
</html>