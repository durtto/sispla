<html>
<head>
<title>Usuario</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">
<link rel="stylesheet" type="text/css" href="../css/botones.css">
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
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowExpander.js"></script>

<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
 var nuevo;
 var winPersona;
 
Ext.onReady(function(){
	Ext.QuickTips.init();
	Ext.form.Field.prototype.msgTarget = 'side';
	Ext.BLANK_IMAGE_URL = '../lib/ext-3.2.1/resources/images/default/s.gif';
	var nroReg;
/******************************************CAMPOS REQUERIDOS******************************************/     	

	var camposReq = new Array(10);

/*****************************************************************************************************/     

    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;

/******************************************INICIO**StorePersona******************************************/     
      
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
    
/*****************************************FIN****StorePersona*****************************************/



/******************************************INICIO**colModelPersona******************************************/     

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
      
/******************************************FIN****colModelPersona******************************************/     


/******************************************INICIO**StoreUsuario******************************************/     
   
  var storeUsuario = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_usuario.php',
		remoteSort : true,
		root: 'usuarios',
        totalProperty: 'total',
		idProperty: 'co_usuario',
        fields: [{name: 'co_usuario'},
		        {name: 'co_privilegio'},
        		{name: 'nb_privilegio'},
        		{name: 'co_ubicacion'},
        		{name: 'nb_ubicacion'},
		        {name: 'co_indicador'},
        		{name: 'nb_persona'},
        		{name: 'tx_apellido'},
		        {name: 'resp'}]
        });
    storeUsuario.setDefaultSort('co_usuario', 'ASC');
    
/*****************************************FIN****StoreUsuario*****************************************/


/******************************************INICIO**colModelUsuario******************************************/     
    
    var colModelUsuario = new Ext.grid.ColumnModel([
        {id:'co_usuario',header: "Usuario", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_usuario'},
        {header: "Privilegio", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_privilegio'},
        {header: "Privilegio", width: 150, sortable: true, locked:false, dataIndex: 'nb_privilegio'},
        {header: "Ubicacion", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_ubicacion'},
        {header: "Ubicacion", width: 150, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},
        {header: "Indicador", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
        {header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
      ]);
	
	     

/******************************************FIN****colModelUsuario******************************************/     



/******************************************INICIO**StoreCliente******************************************/     
   
    var gridForm = new Ext.FormPanel({
        id: 'frm_usuario',
        frame: true,
		labelAlign: 'center',
        title: 'Usuario',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:820,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:800,
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
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },GetCombo('co_privilegio','Privilegio'), 
                    GetCombo('co_ubicacion','Ubicacion')
				]
                    },{
					layout: 'form',
					labelWidth:100,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_persona',
						disabled:true,
                        name: 'nb_persona',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			}]
			},{
				width: 800,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo',
			iconCls: 'adduser',
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_usuario").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Usuario',
			iconCls: 'save',
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
								columnas += '"co_ubicacion" : "'+Ext.getCmp("co_ubicacion").getValue()+'", ';
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
			iconCls: 'deleteuser',
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
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_usuario',
                store: storeUsuario,
                cm: colModelUsuario,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_usuario").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
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
				})
            }]
			
		}],
        
    });

/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/


function selPersona(){
storePersona.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_persona.php"}});
	if(!winPersona){
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
								loadMask: true,
								height: 200,
								title:'Lista de Persona',
								border: true,
								listeners: {
												delay: 10
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  iconCls: 'accept',
								  handler : function(){
										if(Ext.getCmp("gd_selPersona").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selPersona").getSelectionModel().getSelected();
											Ext.getCmp("co_indicador").setValue(record.data.co_indicador);
											Ext.getCmp("nb_persona").setValue(record.data.nb_persona);
											winPersona.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  iconCls: 'cancel',
								  handler : function(){
											winPersona.hide();
								  }
						}]
				});
		}
		winPersona.show();	
}
/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/
	
storeUsuario.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_usuario.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_usuario").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();

		}
		Ext.getCmp("co_usuario").focus();
		nroReg=rowIdx;
		
});

/********************************************************************************************************/


/******************************************TRIGGERS*******************************************/

var triggerPersona = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerPersona.onTriggerClick = selPersona;
		triggerPersona.applyToMarkup('co_indicador');
		
/******************************************FIN**TRIGGERS*******************************************/

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
<div id="winPersona" class="x-hidden">
    <div class="x-window-header">Ejegir Persona</div>
</div>
</body>
</html>