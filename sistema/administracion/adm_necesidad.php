<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Necesidad</title>
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
	<link rel="stylesheet" href="../lib/ext-3.2.1/examples/ux/css/Spinner.css" />


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
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/Spinner.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/SpinnerField.js"></script>
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

/******************************************INICIO**StoreNecesidad******************************************/     

  var storeNecesidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_necesidad.php',
		remoteSort : true,
		root: 'necesidades',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_necesidad.php"},
        totalProperty: 'total',
		idProperty: 'co_necesidad',
        fields: [{name: 'co_necesidad'},
		        {name: 'tx_necesidad_detectada'},
		        {name: 'ca_requerida'},
		        {name: 'tx_justificacion'},
		        {name: 'tx_beneficio'},
		        {name: 'fe_annio'},
		        {name: 'nb_servicio'},
		        {name: 'resp'}]
        });
    storeNecesidad.setDefaultSort('co_necesidad', 'ASC');
    
/*****************************************FIN****StoreNecesidad*****************************************/

	var storeNuevoNecesidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_necesidad.php',
		remoteSort : true,
		root: 'necesidades',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_necesidad.php"},
        fields: [{name: 'co_necesidad'}]
        });
	
/******************************************INICIO**colModelNecesidad******************************************/     

    var colModelNecesidad = new Ext.grid.ColumnModel([
        {id:'co_necesidad',header: "Necesidad", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_necesidad'},
        {header: "Servicio", width: 120, sortable: true, locked:false, dataIndex: 'nb_servicio'},
        {header: "Necesidad Detectada", width: 150, sortable: true, locked:false, dataIndex: 'tx_necesidad_detectada'},
        {header: "Cantidad Requerida", width: 140, sortable: true, locked:false, dataIndex: 'ca_requerida'},      
        {header: "Justificaci&oacute;n", width: 145, sortable: true, locked:false, dataIndex: 'tx_justificacion',renderer: this.showJustificacion},
        {header: "Beneficios", width: 145, sortable: true, locked:false, dataIndex: 'tx_beneficio'},
        {header: "A&ntilde;o Actual", width: 98, sortable: true, locked:false, dataIndex: 'fe_annio', renderer:convFechaDMY},
      ]);
      
/******************************************FIN****colModelNecesidad******************************************/     

/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
	
    var gridForm = new Ext.FormPanel({
        id: 'frm_necesidad',
        frame: true,
		labelAlign: 'center',
        title: 'Necesidades detectadas',
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
			title: 'Necesidad',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:80,
					columnWidth:.40,
					border:false,
					items: [{
                        fieldLabel: 'C&oacute;digo de Necesidad',
						xtype:'numberfield',
						id: 'co_necesidad',
                        name: 'co_necesidad',
                        hidden:true,
                        hideLabel:true,
                        width:100
                    	},GetCombo('co_servicio', 'Servicio')
                    	]
				},{
					layout: 'form',
					border:false,
					columnWidth:.30,
					labelWidth:80,
					items: [new Ext.ux.form.SpinnerField({
			                xtype: 'spinnerfield',
			            	fieldLabel: 'Cantidad Requerida',
			            	name: 'ca_requerida',
			            	id: 'ca_requerida',
			            	minValue: 0,
			            	maxValue: 1000,
			            	allowDecimals: false,
			            	decimalPrecision: 1,
			            	incrementValue: 1,
			            	accelerate: true,
			            	width:60
							})]
			},{
					layout: 'form',
					border:false,
					columnWidth:.30,
					labelWidth:80,
					items: [{
                        fieldLabel: 'Fecha Actual',
						xtype:'datefield',
						id: 'fe_annio',
                        name: 'fe_annio',
                        style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:100
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Necesidad Detectada',
						xtype:'htmleditor',
						id: 'tx_necesidad_detectada',
                        name: 'tx_necesidad_detectada',
                        height: 140,
            			anchor: '110%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Justificaci&oacute;n',
						xtype:'htmleditor',
						id: 'tx_justificacion',
                        name: 'tx_descripcion',
                        height: 140,
            			anchor: '110%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Beneficios',
						xtype:'htmleditor',
						id: 'tx_beneficio',
                        name: 'tx_beneficio',
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
					storeNuevoNecesidad.load({
							callback: function () {
									if(storeNuevoNecesidad.getAt(0).data.co_necesidad){									
										Ext.getCmp("co_necesidad").setValue(storeNuevoNecesidad.getAt(0).data.co_necesidad+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_necesidad").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Necesidad',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_necesidad").getForm().getValues(false);	
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
								storeNecesidad.baseParams = {'accion': 'insertar'};
							else
								storeNecesidad.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_necesidad" : "'+Ext.getCmp("co_necesidad").getValue()+'", ';
								columnas += '"tx_necesidad_detectada" : "'+Ext.getCmp("tx_necesidad_detectada").getValue()+'", ';
								columnas += '"ca_requerida" : "'+Ext.getCmp("ca_requerida").getValue()+'", ';
								columnas += '"tx_justificacion" : "'+Ext.getCmp("tx_justificacion").getValue()+'", ';
								columnas += '"tx_beneficio" : "'+Ext.getCmp("tx_beneficio").getValue()+'", ';
								columnas += '"fe_annio" : "'+convFecha(Ext.getCmp("fe_annio").getValue())+'", ';
								columnas += '"co_servicio" : "'+Ext.getCmp("co_servicio").getValue()+'"}';
							storeNecesidad.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_necesidad" : "'+Ext.getCmp("co_necesidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_necesidad.php"},
										callback: function () {
										if(storeNecesidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeNecesidad.getAt(0).data.resp, 
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
							storeNecesidad.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_necesidad.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Necesidad',
			disabled: true,
			handler: function(){
										storeNecesidad.baseParams = {'accion': 'eliminar'};
										storeNecesidad.load({params:{
												"condiciones": '{ "co_necesidad" : "'+Ext.getCmp("co_necesidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_necesidad.php"},
										callback: function () {
										storeNecesidad.baseParams = {'accion': 'refrescar'};
										if(storeNecesidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeNecesidad.getAt(0).data.resp,
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
										storeNecesidad.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_necesidad.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_necesidad',
                store: storeNecesidad,
                cm: colModelNecesidad,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_necesidad").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Necesidad',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeNecesidad,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });

			

 
	
storeNecesidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_necesidad.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_necesidad").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_necesidad").focus();
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