<html>
<head>
<title>Departamento</title>
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

/******************************************INICIO**StoreDepartamento******************************************/     
	
  var storeDepartamento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_departamento.php',
		remoteSort : true,
		root: 'departamentos',
        totalProperty: 'total',
		idProperty: 'co_departamento',
        fields: [{name: 'co_departamento'},
        		{name: 'nb_departamento'},	
        		{name: 'resp'}]
        });
    storeDepartamento.setDefaultSort('co_departamento', 'ASC');
    
/*****************************************FIN****StoreDepartamento*****************************************/

	
/******************************************INICIO**colModelDepartamento******************************************/     
    
    var colModelDepartamento = new Ext.grid.ColumnModel([
        {id:'co_departamento',header: "Codigo", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        {header: "Departamento", width: 150, sortable: true, locked:false, dataIndex: 'nb_departamento'},
      ]);
	
/******************************************FIN****colModelDepartamento******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_departamento',
        frame: true,
		labelAlign: 'center',
        title: 'Departamentos',
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
			title: 'Departamento',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo del Departamento',
						xtype:'numberfield',
						id: 'co_departamento',
                        name: 'co_departamento',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Departamento',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_departamento',
                        name: 'nb_departamento',
                        allowBlank: false,
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
					Ext.getCmp("co_departamento").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Departamento',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_departamento").getForm().getValues(false);	
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
								storeDepartamento.baseParams = {'accion': 'insertar'};
							else
								storeDepartamento.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_departamento" : "'+Ext.getCmp("co_departamento").getValue()+'", ';
							columnas += '"nb_departamento" : "'+Ext.getCmp("nb_departamento").getValue()+'"}';
							storeDepartamento.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_departamento" : "'+Ext.getCmp("co_departamento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_departamento.php"},
										callback: function () {
										if(storeDepartamento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDepartamento.getAt(0).data.resp, 
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
							storeDepartamento.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_departamento.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Departamento',
			disabled: true,
			handler: function(){
										storeDepartamento.baseParams = {'accion': 'eliminar'};
										storeDepartamento.load({params:{
												"condiciones": '{ "co_departamento" : "'+Ext.getCmp("co_departamento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_departamento.php"},
										callback: function () {
										if(storeDepartamento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDepartamento.getAt(0).data.resp,
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
				id: 'gd_departamento',
                store: storeDepartamento,
                cm: colModelDepartamento,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_departamento").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Departamentos',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeDepartamento,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeDepartamento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_departamento.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	Ext.getCmp("gd_departamento").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_departamento").focus();
		nroReg=rowIdx;
		
});

/********************************************************************************************************/

});

</script>
<style type="text/css">
        body .x-panel {
            margin-bottom:20px;
        }
        .icon-grid {
            background-image:url(../lib/ext-3.2.1/examples/shared/icons/fam/grid.png) !important;
        }
        #button-grid .x-panel-body {
            border:1px solid #99bbe8;
            border-top:0 none;
</style>
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