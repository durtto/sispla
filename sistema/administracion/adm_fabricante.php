<html>
<head>
<title>Fabricante</title>
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

/******************************************INICIO**StoreFabricante******************************************/     
	
  var storeFabricante = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_fabricante.php',
		remoteSort : true,
		root: 'fabricantes',
        totalProperty: 'total',
		idProperty: 'co_fabricante',
        fields: [{name: 'co_fabricante'},
        		{name: 'nb_fabricante'},
        		{name: 'di_ubicacion'},
        		{name: 'nu_telefono'},
        		{name: 'tx_correo_electronico'},
        		{name: 'tx_pagina_web'},
        		{name: 'resp'}]
        });
    storeFabricante.setDefaultSort('co_fabricante', 'ASC');
    
/*****************************************FIN****StoreFabricante*****************************************/



/******************************************INICIO**colModelFabricante******************************************/     
    
    var colModelFabricante = new Ext.grid.ColumnModel([
        {id:'co_fabricante',header: "Fabricante", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_fabricante'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
        {header: "Direccion", width: 200, sortable: true, locked:false, dataIndex: 'di_ubicacion'},
        {header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'nu_telefono'},
        {header: "Correo Electronico", width: 200, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Pagina Web", width: 190, sortable: true, locked:false, dataIndex: 'tx_pagina_web'},
      ]);
	
/******************************************FIN****colModelFabricante******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_fabricante',
        frame: true,
		labelAlign: 'center',
        title: 'fabricantes',
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
			title: 'Fabricantes',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo Fabricante',
						xtype:'numberfield',
						id: 'co_fabricante',
                        name: 'co_fabricante',
                        hidden: true,
						hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_fabricante',
                        name: 'nb_fabricante',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }, {
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						vtype:'validos',
						id: 'di_ubicacion',
                        name: 'di_ubicacion',
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
                        fieldLabel: 'Telefono',
						xtype:'numberfield',
						id: 'nu_telefono',
                        name: 'nu_telefono',
						width:160
                    }, {
                        fieldLabel: 'Correo Electronico',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_correo_electronico',
                        name: 'tx_correo_electronico',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    }, {
                        fieldLabel: 'Pagina Web',
						xtype:'textfield',
						vtype:'validos',
						id: 'tx_pagina_web',
                        name: 'tx_pagina_web',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
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
					Ext.getCmp("co_fabricante").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Fabricante',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_fabricante").getForm().getValues(false);	
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
								storeFabricante.baseParams = {'accion': 'insertar'};
							else
								storeFabricante.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_fabricante" : "'+Ext.getCmp("co_fabricante").getValue()+'", ';
							columnas += '"nb_fabricante" : "'+Ext.getCmp("nb_fabricante").getValue()+'", ';
							columnas += '"di_ubicacion" : "'+Ext.getCmp("di_ubicacion").getValue()+'", ';
							columnas += '"nu_telefono" : "'+Ext.getCmp("nu_telefono").getValue()+'", ';
							columnas += '"tx_correo_electronico" : "'+Ext.getCmp("tx_correo_electronico").getValue()+'", ';
							columnas += '"tx_pagina_web" : "'+Ext.getCmp("tx_pagina_web").getValue()+'"}';
							storeFabricante.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_fabricante" : "'+Ext.getCmp("co_fabricante").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_fabricante.php"},
										callback: function () {
										if(storeFabricante.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeFabricante.getAt(0).data.resp, 
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
							storeFabricante.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_fabricante.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Fabricante',
			disabled: true,
			handler: function(){
										storeFabricante.baseParams = {'accion': 'eliminar'};
										storeFabricante.load({params:{
												"condiciones": '{ "co_fabricante" : "'+Ext.getCmp("co_fabricante").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_fabricante.php"},
										callback: function () {
										if(storeFabricante.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeFabricante.getAt(0).data.resp,
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
				id: 'gd_fabricante',
                store: storeFabricante,
                cm: colModelFabricante,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_fabricante").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Lista de Fabricantes',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeFabricante,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeFabricante.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_fabricante.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	Ext.getCmp("gd_fabricante").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_fabricante").focus();
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