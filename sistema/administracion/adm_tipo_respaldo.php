<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Tipo Respaldo</title>
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

/******************************************INICIO**StoreTpRespaldo******************************************/     
  
  var storeTpRespaldo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_respaldo.php',
		remoteSort : true,
		root: 'tprespaldos',
        totalProperty: 'total',
        baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_tipo_respaldo.php'},
		idProperty: 'co_tipo_respaldo',
        fields: [{name: 'co_tipo_respaldo'},
		        {name: 'nb_tipo_respaldo'},
		        {name: 'resp'}]
        });
    storeTpRespaldo.setDefaultSort('co_tipo_respaldo', 'ASC');
    
/*****************************************FIN****StoreTpRespaldo*****************************************/
	var storeNuevoTpRespaldo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_respaldo.php',
		remoteSort : true,
		root: 'tprespaldos',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_tipo_respaldo.php"},
        fields: [{name: 'co_tipo_respaldo'}]
        });

/******************************************INICIO**colModelTpRespaldo******************************************/     
   
    var colModeltpRespaldo = new Ext.grid.ColumnModel([
        {id:'co_tipo_respaldo',header: "Respaldo", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_tipo_respaldo'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_tipo_respaldo'},
      ]);
	
/******************************************FIN****colModelTpRespaldo******************************************/     

	
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_tprespaldo',
        frame: true,
		labelAlign: 'center',
        title: 'Tipo Respaldo',
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
			title: 'Tipo Respaldo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:100,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero de Tipo',
						xtype:'numberfield',
						id: 'co_tipo_respaldo',
                        name: 'co_tipo_respaldo',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
                        width:160
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_tipo_respaldo',
                        name: 'nb_tipo_respaldo',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }],
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
					storeNuevoTipoRespaldo.load({
							callback: function () {
									if(storeNuevoTipoRespaldo.getAt(0).data.co_tipo_respaldo){									
										Ext.getCmp("co_tipo_respaldo").setValue(storeNuevoTipoRespaldo.getAt(0).data.co_tipo_respaldo+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_tipo_respaldo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_tprespaldo").getForm().getValues(false);	
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
								storeTpRespaldo.baseParams = {'accion': 'insertar'};
							else
								storeTpRespaldo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'", ';
							columnas += '"nb_tipo_respaldo" : "'+Ext.getCmp("nb_tipo_respaldo").getValue()+'"}';
							storeTpRespaldo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_respaldo.php"},
										callback: function () {
										if(storeTpRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTpRespaldo.getAt(0).data.resp, 
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
							storeTpRespaldo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_tipo_respaldo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Tipo Respaldo',
			disabled: true,
			iconCls: 'delete',
			handler: function(){
										storeTpRespaldo.baseParams = {'accion': 'eliminar'};
										storeTpRespaldo.load({params:{
												"condiciones": '{ "co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_tipo_respaldo.php"},
										callback: function () {
										storeTpRespaldo.baseParams = {'accion': 'refrescar'};
					if(storeTpRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeTpRespaldo.getAt(0).data.resp,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											storeTpRespaldo.baseParams = {'accion': 'refrescar'};
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							storeTpRespaldo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_tipo_respaldo.php'};

							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_tprespaldo',
                store: storeTpRespaldo,
                cm: colModeltpRespaldo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_tprespaldo").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Tipos de Respaldo',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeTpRespaldo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeTpRespaldo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_tipo_respaldo.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_tprespaldo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_tipo_respaldo").focus();
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