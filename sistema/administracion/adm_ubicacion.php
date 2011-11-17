<html>
<head>
<title>Ubicacion</title>
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
<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
 	var nuevo;
	var winTpUbicacion;
   
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


/******************************************INICIO**StoreUbicacion******************************************/     
	
  var storeTpUbicacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_ubicacion.php',
		remoteSort : true,
		root: 'tpubicaciones',
        totalProperty: 'total',
		idProperty: 'co_tipo_ubicacion',
        fields: [{name: 'co_tipo_ubicacion'},
        		{name: 'nb_tipo_ubicacion'},
				{name: 'resp'}]
        });
    storeTpUbicacion.setDefaultSort('co_tipo_ubicacion', 'ASC');
    
/*****************************************FIN****StoreTpUbicacion*****************************************/



/******************************************INICIO**colModelTpUbicacion******************************************/     
    
    var colModelTpUbicacion = new Ext.grid.ColumnModel([
        {id:'co_tipo_ubicacion',header: "Grupo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_tipo_ubicacion'},
        {header: "Nombre", width: 375, sortable: true, locked:false, dataIndex: 'nb_tipo_ubicacion'},
      ]);
	
/******************************************FIN****colModelTpUbicacion******************************************/     


/******************************************INICIO**StoreUbicacion******************************************/     

  var storeUbicacion = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_ubicacion.php',
		remoteSort : true,
		root: 'ubicaciones',
        totalProperty: 'total',
		idProperty: 'co_ubicacion',
        fields: [{name: 'co_ubicacion'},
        		{name: 'nb_ubicacion'},
        		{name: 'bo_obsoleto'},
        		{name: 'co_ubicacion_padre'},
        		{name: 'nb_ubicacion_padre'},
        		{name: 'co_tipo_ubicacion'},
        		{name: 'nb_tipo_ubicacion'},
        		{name: 'resp'}]
        });
    storeUbicacion.setDefaultSort('co_ubicacion', 'ASC');
    
/*****************************************FIN****StoreUbicacion*****************************************/


/******************************************INICIO**colModelUbicacion******************************************/     
	
	
    var colModelUbicacion = new Ext.grid.ColumnModel([
        {id:'co_ubicacion',header: "Ubicacion", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_ubicacion'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},
        {header: "Obsoleto", width: 100, sortable: true, locked:false, dataIndex: 'bo_obsoleto', renderer: obsoleto},
        {header: "Ubicacion Padre", hidden:true,width: 150, sortable: true, locked:false, dataIndex: 'co_ubicacion_padre'},
        {header: "Ubicacion Padre", width: 150, sortable: true, locked:false, dataIndex: 'nb_ubicacion_padre'},
        {header: "Ubicacion Padre", hidden:true,width: 150, sortable: true, locked:false, dataIndex: 'co_tipo_ubicacion'},
        {header: "Tipo Ubicacion", width: 150, sortable: true, locked:false, dataIndex: 'nb_tipo_ubicacion'},
        ]);
        
/******************************************FIN****colModelUbicacion******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var gridForm = new Ext.FormPanel({
        id: 'frm_ubicacion',
        frame: true,
		labelAlign: 'center',
        title: 'Ubicacion',
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
			title: 'Ubicacion',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Ubicacion',
						xtype:'numberfield',
						id: 'co_ubicacion',
                        name: 'co_ubicacion',
                        allowBlank:false,
                        //hidden: true,
						//hideLabel: true,
						width:140
                    
				},{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_ubicacion',
                        name: 'nb_ubicacion',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },GetCombo('co_tipo_ubicacion','Tipo Ubicacion')]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [GetCombo('co_ubicacion_padre','Ubicacion Padre'),{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Obsoleto',
	            		id: 'bo_obsoleto',
		                name: 'bo_obsoleto',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'obsoleto', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'obsoleto', inputValue: 0},
			           			]
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
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_ubicacion").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			iconCls: 'save',
			tooltip:'Guardar Ubicacion',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_ubicacion").getForm().getValues(false);	
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
								storeUbicacion.baseParams = {'accion': 'insertar'};
							else
								storeUbicacion.baseParams = {'accion': 'modificar'};
							var columnas   = '{"co_ubicacion" : "'+Ext.getCmp("co_ubicacion").getValue()+'", ';
								columnas += '"nb_ubicacion" : "'+Ext.getCmp("nb_ubicacion").getValue()+'", ';
								columnas += '"bo_obsoleto" : "'+Ext.getCmp("bo_obsoleto").getValue()+'", ';
								columnas += '"co_ubicacion_padre" : "'+Ext.getCmp("co_ubicacion_padre").getValue()+'", ';
								columnas += '"co_tipo_ubicacion" : "'+Ext.getCmp("co_tipo_ubicacion").getValue()+'"}';
							storeUbicacion.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_ubicacion" : "'+Ext.getCmp("co_ubicacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_ubicacion.php"},
										callback: function () {
										if(storeUbicacion.getAt(0).data.resp!=true){
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeUbicacion.getAt(0).data.resp,
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
							storeUbicacion.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_ubicacion.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			iconCls: 'delete',
			tooltip:'Eliminar Ubicacion',
			disabled: true,
			handler: function(){
										storeUbicacion.baseParams = {'accion': 'eliminar'};
										storeUbicacion.load({params:{
												"condiciones": '{ "co_ubicacion" : "'+Ext.getCmp("co_ubicacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_ubicacion.php"},
										callback: function () {
										if(storeUbicacion.getAt(0).data.resp!=true){
											storeUbicacion.baseParams = {'accion': 'refrescar'};
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeUbicacion.getAt(0).data.resp, 
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
					storeUbicacion.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_ubicacion.php'};

							}})}
							
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_ubicacion',
                store: storeUbicacion,
                cm: colModelUbicacion,
                stripeRows: true,
                iconCls: 'icon-grid',
                
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_ubicacion").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
                tbar:[{
			            text:'Agregar Tipo de Ubicacion',
			            tooltip:'Agregar Tipo de Ubicacion',
			            handler: AgregarTpUbicacion,
			            iconCls:'add'
			        }],
				title:'Ubicaciones',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeUbicacion,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });

/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

	function selUbicacion(){
	storeUbicacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_ubicacion.php"}});
	if(!winUbicacion){
				winUbicacion = new Ext.Window({
						applyTo : 'winUbicacion',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selUbicacion',
								store: storeUbicacion,
								cm: colModelUbicacion,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Ubicacion',
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
								  iconCls: 'accept',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selUbicacion").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selUbicacion").getSelectionModel().getSelected();
											Ext.getCmp("co_ubicacion_padre").setValue(record.data.co_ubicacion);
											winUbicacion.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  iconCls: 'cancel',
								  handler : function(){
											winUbicacion.hide();
								  }
						}]
				});
		}
		winUbicacion.show();	
}

	function AgregarTpUbicacion(){
	if(!winTpUbicacion){
				winTpUbicacion = new Ext.Window({
						applyTo : 'winTpUbicacion',
						layout : 'fit',
						width : 420,
						height : 450,
						closeAction :'hide',
						plain : true,
						items : [new Ext.FormPanel({
				        id: 'frm_grupo',
				        frame: true,
						labelAlign: 'center',
				        title: 'Tipo Ubicacion',
				        bodyStyle:'padding:5px 5px 5px 5px',
						width:400,
						items: [{
					   		xtype:'fieldset',
							id: 'frm1',
							disabled: true,
							labelAlign: 'center',
							width:380,
							buttonAlign:'center',
							title: 'Tipo Ubicacion',
				            bodyStyle:'padding:5px 5px 0px 5px',
							items:[{
									layout: 'form',
									labelWidth:140,
									border:false,
									items: [{
				                        fieldLabel: 'Numero de Tipo',
										xtype:'numberfield',
										id: 'co_tipo_ubicacion',
				                        name: 'co_tipo_ubicacion',
				                        hidden: true,
										hideLabel: true,
				                        width:160
				                    },{
				                        fieldLabel: 'Nombre',
										xtype:'textfield',
										vtype:'validos',
										id: 'nb_tipo_ubicacion',
				                        name: 'nb_tipo_ubicacion',
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
				width: 380,  
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
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_tipo_ubicacion").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Tipo de Ubicacion',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_grupo").getForm().getValues(false);	
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
								storeTpUbicacion.baseParams = {'accion': 'insertar'};
							else
								storeTpUbicacion.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_tipo_ubicacion" : "'+Ext.getCmp("co_tipo_ubicacion").getValue()+'", ';
							columnas += '"nb_tipo_ubicacion" : "'+Ext.getCmp("nb_tipo_ubicacion").getValue()+'"}';
							storeTpUbicacion.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_tipo_ubicacion" : "'+Ext.getCmp("co_tipo_ubicacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_ubicacion.php"},
										callback: function () {
										if(storeTpUbicacion.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTpUbicacion.getAt(0).data.resp, 
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
							storeTpUbicacion.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_tipo_ubicacion.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			iconCls: 'delete',
			tooltip:'Eliminar Tipo Ubicacion',
			disabled: true,
			handler: function(){
										storeTpUbicacion.baseParams = {'accion': 'eliminar'};
										storeTpUbicacion.load({params:{
												"condiciones": '{ "co_tipo_ubicacion" : "'+Ext.getCmp("co_tipo_ubicacion").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_ubicacion.php"},
										callback: function () {
										if(storeTpUbicacion.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTpUbicacion.getAt(0).data.resp,
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
			width:380,
			items:[{
                xtype: 'grid',
				id: 'gd_tpubicacion',
                store: storeTpUbicacion,
                cm: colModelTpUbicacion,
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_grupo").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de TpUbicacion',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeTpUbicacion,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    })],
						buttons:[{
								  text : 'Aceptar',
								  iconCls: 'accept',
								  handler : function(){
											winTpUbicacion.hide();
storeUbicacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_ubicacion.php"}});

								  }
							   },{
								  text : 'Cancelar',
								  iconCls: 'cancel',
								  handler : function(){
											winTpUbicacion.hide();
								  }
						}]
				});
		}
		winTpUbicacion.show();	
	storeUbicacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_ubicacion.php"}});
	Ext.getCmp("gd_tpubicacion").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_tipo_ubicacion").focus();
		nroReg=rowIdx;
		
});


}
/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/
storeTpUbicacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_tipo_ubicacion.php"}});
storeUbicacion.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_ubicacion.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_ubicacion").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_ubicacion").focus();
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

        <div id="winTpUbicacion" class="x-hidden">
    <div class="x-window-header">Registrar Tipo Ubicacion</div>
</div>
</body>
</html>