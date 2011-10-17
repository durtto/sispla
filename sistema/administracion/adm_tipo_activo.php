<html>
<head>
<title>Tipo Activo</title>
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

/******************************************INICIO**StoreTipoActivo******************************************/     
      
  var storeTipoActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_activo.php',
		remoteSort : true,
		root: 'tpactivos',
        totalProperty: 'total',
		idProperty: 'co_tipo_activo',
		baseParams: {start:0, limit:10, accion: "refrescar", interfaz: '../interfaz/interfaz_tipo_activo.php'},
        fields: [{name: 'co_tipo_activo'},
		        {name: 'nb_tipo_activo'},
		        {name: 'co_categoria'},
		        {name: 'nb_categoria'},
		        {name: 'co_servicio'},
		        {name: 'nb_servicio'},
		        {name: 'resp'}]
        });
    storeTipoActivo.setDefaultSort('co_tipo_activo', 'ASC');
    
/*****************************************FIN****StoreTipoActivo*****************************************/


/******************************************INICIO**colModelTipoActivo******************************************/     
    
    var colModelTipoActivo = new Ext.grid.ColumnModel([
        {id:'co_tipo_activo',header: "Tipo Activo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Nombre", width: 250, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
        {header: "co_Categoria", width: 200, sortable: true, locked:false,hidden:true, dataIndex: 'co_categoria'},      
		{header: "Categoria", width: 200, sortable: true, locked:false, dataIndex: 'nb_categoria'},
		{header: "co_Servicio", width: 100, sortable: true,hidden:true, locked:false, dataIndex: 'co_servicio'},
		{header: "Servicio", width: 250, sortable: true, locked:false, dataIndex: 'nb_servicio'},
      ]);
	
/******************************************FIN****colModelTipoActivo******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_tpactivo',
        frame: true,
		labelAlign: 'center',
        title: 'Tipo Activo',
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
			title: 'Tipo Activos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero TipoActivo',
						xtype:'numberfield',
						id: 'co_tipo_activo',
                        name: 'co_tipo_activo',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },GetCombo('co_servicio','Servicio'),GetCombo('co_categoria','Categoria')]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_tipo_activo',
                        name: 'nb_tipo_activo',
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
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_tipo_activo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Tipo Activo',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_tpactivo").getForm().getValues(false);	
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
								storeTipoActivo.baseParams = {'accion': 'insertar'};
							else
								storeTipoActivo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'", ';
								columnas += '"nb_tipo_activo" : "'+Ext.getCmp("nb_tipo_activo").getValue()+'", ';
								columnas += '"co_categoria" : "'+Ext.getCmp("co_categoria").getValue()+'", ';
								columnas += '"co_servicio" : "'+Ext.getCmp("co_servicio").getValue()+'"}';
							storeTipoActivo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_activo.php"},
										callback: function () {
										if(storeTipoActivo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({ 
												title: 'ERROR',
												msg: storeTipoActivo.getAt(0).data.resp, 
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
							storeTipoActivo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_tipo_activo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			iconCls: 'delete',
			tooltip:'Eliminar Tipo Activo',
			disabled: true,
			handler: function(){
										storeTipoActivo.baseParams = {'accion': 'eliminar'};
										storeTipoActivo.load({params:{
												"condiciones": '{ "co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_activo.php"},
										callback: function () {
										if(storeTipoActivo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTipoActivo.getAt(0).data.resp,
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
				id: 'gd_tpactivo',
                store: storeTipoActivo,
                cm: colModelTipoActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_tpactivo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Tipo Activo',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeTipoActivo,
				pageSize: 10,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


storeTipoActivo.load({params: { start: 0, limit: 10, accion:"refrescar", interfaz: "../interfaz/interfaz_tipo_activo.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_tpactivo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_tipo_activo").focus();
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