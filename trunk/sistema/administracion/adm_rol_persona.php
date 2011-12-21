<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Rol</title>
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

/******************************************INICIO**StoreRol******************************************/     
	
  var storeRol = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_rol_persona.php',
		remoteSort : true,
		root: 'rolpersonas',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_rol_persona.php'},
		idProperty: 'co_rol',
        fields: [{name: 'co_rol'},
		        {name: 'nb_rol'},
		        {name: 'tx_descripcion'},
		        {name: 'resp'}]
        });
    storeRol.setDefaultSort('co_rol', 'ASC');
    
/*****************************************FIN****StoreRol*****************************************/
  
  var storeNuevoRol = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_rol_persona.php',
		remoteSort : true,
		root: 'rolpersonas',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_rol_persona.php"},
        fields: [{name: 'co_rol'}]
        });

  var expanderRol = new Ext.ux.grid.RowExpander({
        tpl : new Ext.Template(
            '<p><b>Descripcion:</b> {tx_descripcion}</p>'
        )
    });
    
/******************************************INICIO**colModelRol******************************************/     
    
    var colModelRol = new Ext.grid.ColumnModel([
    	//expanderRol,
        {id:'co_rol',header: "Rol", width: 50, hidden:true, sortable: true, locked:false, dataIndex: 'co_rol'},
        {header: "Nombre Rol", width: 150, sortable: true, locked:false, dataIndex: 'nb_rol'},
        {header: "Descripcion", width: 400, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        ]);
        
/******************************************FIN****colModelRol******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var gridForm = new Ext.FormPanel({
        id: 'frm_rol',
        frame: true,
		labelAlign: 'center',
        title: 'Roles',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:820,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:800,
			buttonAlign:'center',
			title: 'Roles',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Rol',
						xtype:'numberfield',
						id: 'co_rol',
                        name: 'co_rol',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
						width:140
                    
				},{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_rol',
                        name: 'nb_rol',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Descripcion',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        height: 140,
            			anchor: '110%'
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
					storeNuevoRol.load({
							callback: function () {
									if(storeNuevoRol.getAt(0).data.co_rol){									
										Ext.getCmp("co_rol").setValue(storeNuevoRol.getAt(0).data.co_rol+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_rol").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Rol de Persona',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_rol").getForm().getValues(false);	
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
								storeRol.baseParams = {'accion': 'insertar'};
							else
								storeRol.baseParams = {'accion': 'modificar'};
							var columnas   = '{"co_rol" : "'+Ext.getCmp("co_rol").getValue()+'", ';
								columnas += '"nb_rol" : "'+Ext.getCmp("nb_rol").getValue()+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'"}';
							storeRol.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_rol" : "'+Ext.getCmp("co_rol").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_rol_persona.php"},
										callback: function () {
										if(storeRol.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRol.getAt(0).data.resp,
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
							storeRol.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_rol_persona.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Rol',
			disabled: true,
			handler: function(){
										storeRol.baseParams = {'accion': 'eliminar'};
										storeRol.load({params:{
												"condiciones": '{ "co_rol" : "'+Ext.getCmp("co_rol").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_rol_persona.php"},
										callback: function () {
										storeRol.baseParams = {'accion': 'refrescar'};
										if(storeRol.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRol.getAt(0).data.resp, 
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											storeRol.baseParams = {'accion': 'refrescar'};
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
										storeRol.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_rol_persona.php'};

							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_rol',
                store: storeRol,
                cm: colModelRol,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_rol").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				title:'Roles',
				plugins: expanderRol,
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeRol,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


	
	
storeRol.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_rol_persona.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_rol").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_rol").focus();
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