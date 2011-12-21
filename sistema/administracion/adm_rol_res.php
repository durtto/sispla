<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Responsabilidad</title>
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
  var winRolResp;
   var ubicacion = "<?php echo $_SESSION['privilegio'] ?>";

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

/******************************************INICIO**StoreRolResp******************************************/     

  var storeRolResp = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_rol_responsabilidad.php',
		remoteSort : true,
		root: 'rolresponsabilidades',
        totalProperty: 'total',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: '../interfaz/interfaz_rol_responsabilidad.php'},
		idProperty: 'co_rol_resp',
        fields: [{name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
        		{name: 'tx_descripcion'},
        		{name: 'co_rol_padre'},
        		{name: 'resp'}]
        });
    storeRolResp.setDefaultSort('co_rol_resp', 'ASC');
    
/*****************************************FIN****StoreRolResp*****************************************/
	var storeNuevoRolResp = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_rol_responsabilidad.php',
		remoteSort : true,
		root: 'rolresponsabilidades',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_rol_responsabilidad.php"},
        fields: [{name: 'co_rol_resp'}]
        });


/******************************************INICIO**colModelRolResp******************************************/     
	
	
    var colModelRolResp = new Ext.grid.ColumnModel([
        {id:'co_rol_resp',header: "Rol", width: 50, hidden:true, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Nombre Rol", width: 250, sortable: true, locked:false, dataIndex: 'nb_rol_resp'},
        {header: "Descripci&oacute;n", width: 332, sortable: true, locked:false, dataIndex: 'tx_descripcion', renderer: descripcion},
        {header: "Rol Padre", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_rol_padre'},
        {header: "Nombre Rol Padre", width: 200, sortable: true, locked:false, dataIndex: 'nb_rol_resp'},

        ]);
	
/******************************************FIN****colModelRolResp******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var gridForm = new Ext.FormPanel({
        id: 'frm_rol',
        frame: true,
		labelAlign: 'center',
        title: '.: Roles y Responsabilidades :.',
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
			title: 'Rol y Responsabilidad',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'C&oacute;digo de Rol',
						xtype:'numberfield',
						id: 'co_rol_resp',
                        name: 'co_rol_resp',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
						width:140
                    
				},{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_rol_resp',
                        name: 'nb_rol_resp',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
                        allowBlank:false,
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
                        fieldLabel: 'C&oacute;digo de Rol Padre',
						xtype:'numberfield',
						id: 'co_rol_padre',
                        name: 'co_rol_padre',
						width:140
                    
				}]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Descripci&oacute;n',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
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
			iconCls: 'add',
			tooltip:'',
			handler: function(){
					nuevo = true;
					
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					storeNuevoRolResp.load({
							callback: function () {
									if(storeNuevoRolResp.getAt(0).data.co_rol_resp){									
										Ext.getCmp("co_rol_resp").setValue(storeNuevoRolResp.getAt(0).data.co_rol_resp+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_rol_resp").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Rol y Responsabilidad',
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
								storeRolResp.baseParams = {'accion': 'insertar'};
							else
								storeRolResp.baseParams = {'accion': 'modificar'};
							var columnas   = '{"co_rol_resp" : "'+Ext.getCmp("co_rol_resp").getValue()+'", ';
								columnas += '"nb_rol_resp" : "'+Ext.getCmp("nb_rol_resp").getValue()+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
								columnas += '"co_rol_padre" : "'+Ext.getCmp("co_rol_padre").getValue()+'"}';
							storeRolResp.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_rol_resp" : "'+Ext.getCmp("co_rol_resp").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_rol_responsabilidad.php"},
										callback: function () {
										if(storeRolResp.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRolResp.getAt(0).data.resp,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
										
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con &eacute;xito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
											gridForm.getForm().reset();
										}
							}});
							storeRolResp.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_rol_responsabilidad.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Rol responsabilidad',
			disabled: true,
			handler: function(){
										storeRolResp.baseParams = {'accion': 'eliminar'};
										storeRolResp.load({params:{
												"condiciones": '{ "co_rol_resp" : "'+Ext.getCmp("co_rol_resp").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_rol_res.php"},
										callback: function () {
										storeRolResp.baseParams = {'accion': 'refrescar'};
										if(storeRolResp.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRolResp.getAt(0).data.resp, 
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											storeRolResp.baseParams = {'accion': 'refrescar'};
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con &eacute;xito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
											gridForm.getForm().reset();
										}
							storeRolResp.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_rol_responsabilidad.php'};										
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_rol',
                store: storeRolResp,
                cm: colModelRolResp,
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
				//width:670,
				title:'Lista de Roles y Responsabilidades',
                border: true,
                listeners: {
                    viewready: function(g) {
                    }
                },
				bbar: new Ext.PagingToolbar({
				store: storeRolResp,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });

/******************************************INICIO DE LA CREACION DE VENTANAS*******************************************/

	function selRolResp(){
	storeRolResp.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_rol_responsabilidad.php"}});
	if(!winRolResp){
				winRolResp = new Ext.Window({
						applyTo : 'winRolResp',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								id: 'gd_selRolResp',
								store: storeRolResp,
								cm: colModelRolResp,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								loadMask: true,
								height: 200,
								title:'Lista de Roles y Responsabilidades',
								border: true,
								listeners: {

												delay: 10 
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  iconCls: 'accept',
								  handler : function(){
										if(Ext.getCmp("gd_selRolResp").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selRolResp").getSelectionModel().getSelected();
											Ext.getCmp("co_rol_padre").setValue(record.data.co_rol_resp);
											winRolResp.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  iconCls: 'cancel',
								  handler : function(){
											winRolResp.hide();
								  }
						}]
				});
		}
		winRolResp.show();	
}
/******************************************FIN DE LA CREACION DE VENTANAS*******************************************/
	
storeRolResp.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_rol_responsabilidad.php"}});
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
		Ext.getCmp("co_rol_resp").focus();
		nroReg=rowIdx;
		
});

/********************************************************************************************************/

/******************************************TRIGGERS*******************************************/

var triggerRolResp = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerRolResp.onTriggerClick = selRolResp;
		triggerRolResp.applyToMarkup('co_rol_padre');	
		
/******************************************FIN**TRIGGERS*******************************************/

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
<div id="winRolResp" class="x-hidden">
    <div class="x-window-header">Ejegir Rol Padre</div>
</div>
</body>
</html>