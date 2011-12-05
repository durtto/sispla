<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Datos de Planes</title>
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

/******************************************INICIO**StoreDato******************************************/     

  var storeDato = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_dato_plan.php',
		remoteSort : true,
		root: 'datos',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_dato_plan.php'},
        totalProperty: 'total',
		idProperty: 'co_componente',
        fields: [{name: 'co_componente'},
		        {name: 'fe_vigencia'},		
        		{name: 'tx_objetivo'},	  
        		{name: 'tx_alcance'},   
        		{name: 'tx_identificacion_negocio'},
        		{name: 'tx_localidad'},  
        		{name: 'tx_organizacion'},
        		{name: 'resp'}]
        });
    storeDato.setDefaultSort('co_componente', 'ASC');
    
/*****************************************FIN****StoreDato*****************************************/



/******************************************INICIO**colModelDato******************************************/     

    var colModelDato = new Ext.grid.ColumnModel([
        {id:'co_componente',header: "Componente", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_componente'},
        {header: "Fecha de Vigencia", width: 120, sortable: true, locked:false, dataIndex: 'fe_vigencia'},
        {header: "Objetivo", width: 159, sortable: true, locked:false, dataIndex: 'tx_objetivo'},
        {header: "Alcance", width: 159, sortable: true, locked:false, dataIndex: 'tx_alcance'},
        {header: "Negocio", width: 120, sortable: true, locked:false, dataIndex: 'tx_identificacion_negocio'},
        {header: "Localidad", width: 120, sortable: true, locked:false, dataIndex: 'tx_localidad'},
        {header: "Organizaci&oacute;n", width: 120, sortable: true, locked:false, dataIndex: 'tx_organizacion'},
      ]);
      
/******************************************FIN****colModelDato******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_dato',
        frame: true,
		labelAlign: 'center',
        title: 'Datos de Planes',
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
			title: 'Datos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo del Componente',
						xtype:'numberfield',
						id: 'co_componente',
                        name: 'co_componente',
						hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Fecha de Vigencia',
						xtype:'datefield',
						vtype:'validos',
						id: 'fe_vigencia',
                        name: 'fe_vigencia',
                        allowBlank: false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
						fieldLabel: 'Negocio',
						xtype:'textfield',
						id: 'tx_identificacion_negocio',
                        name: 'tx_identificacion_negocio',
                        allowBlank: false,
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
                        fieldLabel: 'Localidad',
						xtype:'textfield',
						id: 'tx_localidad',
                        name: 'tx_localidad',
                        allowBlank: false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Organizaci&oacute;n',
						xtype:'textfield',
						id: 'tx_organizacion',
                        name: 'tx_organizacion',
                        allowBlank: false,
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
					    fieldLabel: 'Objetivo',
						xtype:'htmleditor',
						id: 'tx_objetivo',
                        name: 'tx_objetivo',
                        height: 140,
            			anchor: '110%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    },{
                        fieldLabel: 'Alcance',
						xtype:'htmleditor',
						id: 'tx_alcance',
                        name: 'tx_alcance',
                        height: 140,
            			anchor: '110%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',	
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
					Ext.getCmp("co_componente").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Datos del Plan',
			disabled: true,
			iconCls: 'save',
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_dato").getForm().getValues(false);	
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
								storeDato.baseParams = {'accion': 'insertar'};
							else
								storeDato.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_componente" : "'+Ext.getCmp("co_componente").getValue()+'", ';
								columnas += '"fe_vigencia" : "'+convFecha(Ext.getCmp("fe_vigencia").getValue())+'", ';
								columnas += '"tx_objetivo" : "'+Ext.getCmp("tx_objetivo").getValue()+'", ';
								columnas += '"tx_alcance" : "'+Ext.getCmp("tx_alcance").getValue()+'", ';
								columnas += '"tx_identificacion_negocio" : "'+Ext.getCmp("tx_identificacion_negocio").getValue()+'", ';
								columnas += '"tx_localidad" : "'+Ext.getCmp("tx_localidad").getValue()+'", ';
								columnas += '"tx_organizacion" : "'+Ext.getCmp("tx_organizacion").getValue()+'"}';
							storeDato.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_componente" : "'+Ext.getCmp("co_componente").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_dato_plan.php"},
										callback: function () {
										if(storeDato.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDato.getAt(0).data.resp, 
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
							storeDato.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_dato_plan.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Datos',
			disabled: true,
			handler: function(){
										storeDato.baseParams = {'accion': 'eliminar'};
										storeDato.load({params:{
												"condiciones": '{ "co_componente" : "'+Ext.getCmp("co_componente").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_dato_plan.php"},
										callback: function () {
										storeDato.baseParams = {'accion': 'refrescar'};
										if(storeDato.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDato.getAt(0).data.resp,
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
								storeDato.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_dato_plan.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_dato',
                store: storeDato,
                cm: colModelDato,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_dato").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Planes',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeDato,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });

storeDato.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_dato_plan.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	Ext.getCmp("gd_dato").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
     	}
		Ext.getCmp("co_componente").focus();
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