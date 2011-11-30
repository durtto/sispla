<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Equipo Continuidad</title>
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
  var winPersona;
 
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

/******************************************INICIO**StorePersona******************************************/     
      
      var storePersona = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_persona.php',
		remoteSort : true,
		root: 'personas',
        totalProperty: 'total',
		idProperty: 'co_indicador',
        fields: [{name: 'co_indicador'},
         		{name: 'nu_cedula'},
		        {name: 'nb_persona'},
		        {name: 'tx_apellido'},
		        {name: 'di_oficina'},
		        {name: 'tx_telefono_oficina'},
		        {name: 'tx_correo_electronico'},
		        {name: 'di_habitacion'},
		        {name: 'tx_telefono_habitacion'},
		        {name: 'tx_telefono_personal'},
		        {name: 'co_departamento'},
		        {name: 'nb_departamento'},
		        {name: 'co_rol'},
		        {name: 'nb_rol'},
		        {name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
        		{name: 'co_grupo'},
        		{name: 'nb_grupo'},
        		{name: 'co_guardia'},			
        		{name: 'nb_guardia'},
		        {name: 'resp'}]
        });
    storePersona.setDefaultSort('co_indicador', 'ASC');
    
/*****************************************FIN****StorePersona*****************************************/


var fm = Ext.form;

/******************************************INICIO**colModelPersona******************************************/     

    var colModelPersona = new Ext.grid.ColumnModel([
        {id:'co_indicador',header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "Cedula", width: 150, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 150, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        //{header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		//{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        //{header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        //{header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		//{header: "Telefono Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        //{header: "Departamento", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        //{header: "Departamento", width: 200, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
     	//{header: "Rol", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol'},
        //{header: "Rol", width: 200, sortable: true, locked:false, dataIndex: 'nb_rol'},      
      	{header: "Responsabilidad", width: 200,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Responsabilidad", width: 200, sortable: true, locked:false, dataIndex: 'nb_rol_resp',
         editor: comboRol},      
      	//{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        //{header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	//{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        //{header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},      
      ]);
      
/******************************************FIN****colModelPersona******************************************/     


                var comboRol = new Ext.form.ComboBox({
	        	store: new Ext.data.JsonStore({
				url: '../interfaz/interfaz_combo.php',
				   root: 'Resultados',
				   idProperty: 'co_rol_resp',
				   baseParams: {accion:'rol_resp'},
				   fields:['co_rol_resp','nb_rol_resp']
				  }),
			        displayField:'nb_rol_resp',
			        typeAhead: true,
			        allowBlank: false,
			        mode: 'remote',
			        forceSelection: true,
			        triggerAction: 'all',
			        emptyText:'Selecione',
			        selectOnFocus:true,
			 });


/******************************************INICIO**StoreEquipoContinuidad******************************************/     
   
  var storeEquipoContinuidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo_continuidad.php',
		remoteSort : true,
		root: 'equipos',
        totalProperty: 'total',
		idProperty: 'co_equipo_continuidad',
        fields: [{name: 'co_equipo_continuidad'},
		        {name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
		        {name: 'co_indicador'},
        		{name: 'nb_persona'},
		        {name: 'resp'}]
        });
    storeEquipoContinuidad.setDefaultSort('co_equipo_continuidad', 'ASC');
    
/*****************************************FIN****StoreEquipoContinuidad*****************************************/

	
/******************************************INICIO**colModelEquipoContinuidad******************************************/     

	    var colModelEquipoContinuidad = new Ext.grid.ColumnModel([
        {id:'co_equipo_continuidad',header: "EquipoContinuidad", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_equipo_continuidad'},
        {header: "Rol", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Rol", width: 200, sortable: true, locked:false, dataIndex: 'nb_rol_resp'},
        {header: "Persona", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "Persona", width: 200, sortable: true, locked:false, dataIndex: 'nb_persona'},
      ]);
      
/******************************************FIN****colModelEquipoContinuidad******************************************/     


/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

    var gridForm = new Ext.FormPanel({
        id: 'frm_equipocont',
        frame: true,
		labelAlign: 'center',
        title: 'Equipo Continuidad',
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
			title: 'Equipo Continuidads',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:130,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Equipo Continuidad',
						xtype:'numberfield',
						id: 'co_equipo_continuidad',
                        name: 'co_equipo_continuidad',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120
                    },GetCombo("co_rol", "Rol")]
				},{
					layout: 'form',
					labelWidth:130,
					columnWidth:.45,
					border:false,
					items: [{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						id: 'co_indicador',
                        name: 'co_indicador',
                        allowBlank:false,
                        hidden: true,
						hideLabel: true,
                        width:120
                    },{
                        fieldLabel: 'Persona',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_persona',
						disabled:true,
                        name: 'nb_persona',
                        allowBlank:false,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:120,
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
					Ext.getCmp("co_equipo_continuidad").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar EquipoContinuidad',
			disabled: true,
			iconCls: 'save',
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_equipocont").getForm().getValues(false);	
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
								storeEquipoContinuidad.baseParams = {'accion': 'insertar'};
							else
								storeEquipoContinuidad.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_equipo_continuidad" : "'+Ext.getCmp("co_equipo_continuidad").getValue()+'", ';
								columnas += '"co_rol_resp" : "'+Ext.getCmp("co_rol_resp").getValue()+'", ';
								columnas += '"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}';
							storeEquipoContinuidad.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_equipo_continuidad" : "'+Ext.getCmp("co_equipo_continuidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_equipo_continuidad.php"},
										callback: function () {
										if(storeEquipoContinuidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeEquipoContinuidad.getAt(0).data.resp, 
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
							storeEquipoContinuidad.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_equipo_continuidad.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			iconCls: 'delete',
			tooltip:'Eliminar EquipoContinuidad',
			disabled: true,
			handler: function(){
										storeEquipoContinuidad.baseParams = {'accion': 'eliminar'};
										storeEquipoContinuidad.load({params:{
												"condiciones": '{ "co_equipo_continuidad" : "'+Ext.getCmp("co_equipo_continuidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_equipo_continuidad.php"},
										callback: function () {
										storeEquipoContinuidad.baseParams = {'accion': 'refrescar'};											
										if(storeEquipoContinuidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeEquipoContinuidad.getAt(0).data.resp,
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
						                xtype: 'editorgrid',
										id: 'gd_persona',
										clickstoEdit: 1,
						                store: storePersona,
						                cm: colModelPersona,
						                stripeRows: true,
						               	//plugins: expanderPersona,
						               	iconCls: 'icon-grid',
						                //sm: sm1,
						                height: 250,
										//width:670,
										title:'Lista de Persona',
						                border: true,
						                bbar: new Ext.PagingToolbar({
										store: storePersona,
										pageSize: 50,
										displayInfo: true,
										displayMsg: 'Mostrando registros {0} - {1} de {2}',
										emptyMsg: "No hay registros que mostrar",
										})
						            }]
			
		}],
        
    });
    
storePersona.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_persona.php"}});

//storeEquipoContinuidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_continuidad.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_persona").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_equipo_continuidad").focus();
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