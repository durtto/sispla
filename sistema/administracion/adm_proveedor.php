<html>
<head>
<title>Proveedor</title>
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
 var winContacto;
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

/******************************************INICIO**StoreProveedor******************************************/     
	
  var storeProveedor = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_proveedor.php',
		remoteSort : true,
		root: 'proveedores',
        totalProperty: 'total',
		idProperty: 'co_proveedor',
        fields: [{name: 'co_proveedor'},
        		{name: 'nb_proveedor'},
        		{name: 'di_oficina'},
        		{name: 'tx_servicio_prestado'},
        		{name: 'co_contacto'},
        		{name: 'nb_contacto'},
		        {name: 'tx_apellido'},
		        {name: 'tx_telefono'},
		        {name: 'tx_correo_electronico'},
        		{name: 'resp'}]
        });
    storeProveedor.setDefaultSort('co_proveedor', 'ASC');
    
/*****************************************FIN****StoreProveedor*****************************************/

var expanderContacto = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Nombre:</b> {nb_contacto}</p>',
            '<p><b>Apellido:</b> {tx_apellido}</p>',
            '<p><b>Telefono:</b> {tx_telefono}</p>',
            '<p><b>Correo Electronico:</b> {tx_correo_electronico}</p>'
        )
    });

/******************************************INICIO**colModelProveedor******************************************/     
   
    var colModelProveedor = new Ext.grid.ColumnModel([
    	expanderContacto,
        {id:'co_proveedor',header: "Proveedor", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_proveedor'},
        {header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'di_oficina'},
        {header: "Servicio que Presta", width: 450, sortable: true, locked:false, dataIndex: 'tx_servicio_prestado'},
      	//{header: "Contacto", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_contacto'},
      	//{header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		//{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
       	// {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 120, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
      
      ]);
	
/******************************************FIN****colModelProveedor******************************************/     

/******************************************INICIO**StoreContacto******************************************/     
      
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
		        {name: 'tx_telefono'},
		        {name: 'tx_correo_electronico'},
		        {name: 'co_proveedor'},
		        {name: 'nb_proveedor'},
		        {name: 'resp'}]
        });
    storeContacto.setDefaultSort('co_contacto', 'ASC');
    
/*****************************************FIN****StoreContacto*****************************************/



/******************************************INICIO**colModelContacto******************************************/     
    
    var colModelContacto = new Ext.grid.ColumnModel([
        {id:'co_contacto',header: "Contacto", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_contacto'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_contacto'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono'},
        {header: "Correo Electronico", width: 120, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Proveedor", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_proveedor'},
        {header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
      ]);
	
/******************************************FIN****colModelContacto******************************************/     


/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_proveedor',
        frame: true,
		labelAlign: 'center',
        title: 'Proveedores',
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
			title: 'Proveedores',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo Proveedor',
						xtype:'numberfield',
						id: 'co_proveedor',
                        name: 'co_proveedor',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_proveedor',
                        name: 'nb_proveedor',
                        allowBlank:false,
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
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						vtype:'validos',
						id: 'di_oficina',
                        name: 'di_oficina',
                        allowBlank:false,
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
                        fieldLabel: 'Servicio Prestado',
						xtype:'htmleditor',
						id: 'tx_servicio_prestado',
                        name: 'tx_servicio_prestado',
                        height: 140,
            			anchor: '110%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    }]
			}]
			},{
	   		xtype:'fieldset',
			id: 'frm2',
			disabled: true,
			labelAlign: 'center',
			width:800,
			buttonAlign:'center',
			layout:'column',
			title: 'Contactos',
			checkboxToggle:true,
			collapsed: true,
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
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_contacto',
                        name: 'nb_contacto',
                        allowBlank:false,
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
                        allowBlank:false,
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
                        fieldLabel: 'Telefono Oficina',
						xtype:'textfield',
						id: 'tx_telefono',
                        name: 'tx_telefono',
                        allowBlank:false,
                        width:160,
                      
                    },{
                        fieldLabel: 'Correo Electronico',
						xtype:'textfield',
						id: 'tx_correo_electronico',
                        name: 'tx_correo_electronico',
                        allowBlank:false,
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
				width: 800,  
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
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_proveedor").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Proveedor',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_proveedor").getForm().getValues(false);	
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
								storeProveedor.baseParams = {'accion': 'insertar'};
							else
								storeProveedor.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_proveedor" : "'+Ext.getCmp("co_proveedor").getValue()+'", ';
							columnas += '"nb_proveedor" : "'+Ext.getCmp("nb_proveedor").getValue()+'", ';
							columnas += '"di_oficina" : "'+Ext.getCmp("di_oficina").getValue()+'", ';
							columnas += '"tx_servicio_prestado" : "'+Ext.getCmp("tx_servicio_prestado").getValue()+'"}';
							storeProveedor.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_proveedor" : "'+Ext.getCmp("co_proveedor").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_proveedor.php"},
										callback: function () {
										if(storeProveedor.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeProveedor.getAt(0).data.resp, 
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
						if(frm2=true)						
								storeContacto.baseParams = {'accion': 'insertar'};
							else
								storeContacto.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_contacto" : "'+Ext.getCmp("co_contacto").getValue()+'", ';
								columnas += '"nb_contacto" : "'+Ext.getCmp("nb_contacto").getValue()+'", ';
								columnas += '"tx_apellido" : "'+Ext.getCmp("tx_apellido").getValue()+'", ';
								columnas += '"tx_telefono" : "'+Ext.getCmp("tx_telefono").getValue()+'", ';
								columnas += '"tx_correo_electronico" : "'+Ext.getCmp("tx_correo_electronico").getValue()+'", ';
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

						}
						storeProveedor.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_proveedor.php'};

				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Proveedor',
			disabled: true,
			handler: function(){
										storeProveedor.baseParams = {'accion': 'eliminar'};
										storeProveedor.load({params:{
												"condiciones": '{ "co_proveedor" : "'+Ext.getCmp("co_proveedor").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_proveedor.php"},
										callback: function () {
										if(storeProveedor.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeProveedor.getAt(0).data.resp,
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
				id: 'gd_proveedor',
                store: storeProveedor,
                cm: colModelProveedor,
                stripeRows: true,
                iconCls: 'icon-grid',
                plugins: expanderContacto,
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_proveedor").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Proveedors',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeProveedor,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
storeContacto.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_contacto_proveedor.php"}});
storeProveedor.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_proveedor.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	Ext.getCmp("gd_proveedor").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
		}
		Ext.getCmp("co_proveedor").focus();
		nroReg=rowIdx;
		
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