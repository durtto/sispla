<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Grupo</title>
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

/******************************************INICIO**StoreGrupo******************************************/     
	
  var storeGrupo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_grupo.php',
		remoteSort : true,
		root: 'grupos',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_grupo.php"},	
        totalProperty: 'total',
		idProperty: 'co_grupo',
        fields: [{name: 'co_grupo'},
        		{name: 'nb_grupo'},
        		{name: 'nu_periodo'},
        		{name: 'co_ubicacion'},
        		{name: 'nb_ubicacion'},
        		{name: 'resp'}]
        });
    storeGrupo.setDefaultSort('co_grupo', 'ASC');
    
/*****************************************FIN****StoreGrupo*****************************************/
  var storeNuevoGrupo= new Ext.data.JsonStore({
		url: '../interfaz/interfaz_grupo.php',
		remoteSort : true,
		root: 'grupos',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_grupo.php"},	
        fields: [{name: 'co_grupo'}]
        });
    
	
/******************************************INICIO**colModelGrupo******************************************/     
    
    var colModelGrupo = new Ext.grid.ColumnModel([
        {id:'co_grupo',header: "Grupo", width: 150, hidden:true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        {header: "Nombre", width: 240, sortable: true, locked:false, dataIndex: 'nb_grupo'},
        {header: "Periodo", width: 200, sortable: true, locked:false, dataIndex: 'nu_periodo'},
        {header: "Ubicacion", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_ubicacion'},
        {header: "Ubicaci&oacute;n", width: 340, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},

      ]);
	
/******************************************FIN****colModelGrupo******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_grupo',
        frame: true,
		labelAlign: 'center',
        title: '.: Grupos :.',
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
			title: 'Datos del Grupo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:120,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'N&uacute;mero Grupo',
						xtype:'numberfield',
						id: 'co_grupo',
                        name: 'co_grupo',
                        //hidden:true,
                        //hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        disabled: true,
                    },GetCombo('co_ubicacion','Ubicaci&oacute;n')]
                    },{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Grupo',
						xtype:'textfield',
						id: 'nb_grupo',
                        name: 'nb_grupo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Periodo',
						xtype:'numberfield',
						id: 'nu_periodo',
                        name: 'nu_periodo',
                        allowBlank: false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                       }]
                    	
			}]
			},{
				width: 800,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			iconCls: 'add',
			tooltip:'',
			handler: function(){
					nuevo = true;
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();

					}
					storeNuevoGrupo.load({
							callback: function () {
									if(storeNuevoGrupo.getAt(0).data.co_grupo){									
										Ext.getCmp("co_grupo").setValue(storeNuevoGrupo.getAt(0).data.co_grupo+1)
									};
							}
					});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_grupo").focus();
					

				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Grupo',
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
								storeGrupo.baseParams = {'accion': 'insertar'};
							else
								storeGrupo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_grupo" : "'+Ext.getCmp("co_grupo").getValue()+'", ';
							columnas += '"nb_grupo" : "'+Ext.getCmp("nb_grupo").getValue()+'", ';
							columnas += '"nu_periodo" : "'+Ext.getCmp("nu_periodo").getValue()+'", ';
							columnas += '"co_ubicacion" : "'+Ext.getCmp("co_ubicacion").getValue()+'"}';
							storeGrupo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_grupo" : "'+Ext.getCmp("co_grupo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_grupo.php"},
										callback: function () {
										if(storeGrupo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeGrupo.getAt(0).data.resp, 
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
							storeGrupo.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_grupo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Grupo',
			disabled: true,
			handler: function(){
										storeGrupo.baseParams = {'accion': 'eliminar'};
										storeGrupo.load({params:{
												"condiciones": '{ "co_grupo" : "'+Ext.getCmp("co_grupo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_grupo.php"},
										callback: function () {
										storeGrupo.baseParams = {'accion': 'refrescar'};
										if(storeGrupo.getAt(0).data.resp!=true){
												Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeGrupo.getAt(0).data.resp,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Borrados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
				storeGrupo.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_grupo.php'};

							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_grupo',
                store: storeGrupo,
                cm: colModelGrupo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_grupo").getForm().loadRecord(rec);
                        if(rec.data.co_ubicacion)
								Ext.getCmp('co_ubicacion').setValue(storeGrupo.getAt(0).data.nb_ubicacion);
					
                        }
                    }
                }),
                height: 250,
				title:'Lista de Grupos',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeGrupo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });
	
	
storeGrupo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_grupo.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_grupo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_grupo").focus();
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
