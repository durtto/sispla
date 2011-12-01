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
      
      var storeEquipoContinuidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_equipo_continuidad.php',
		remoteSort : true,
		root: 'equipos',
        totalProperty: 'total',
		idProperty: 'co_equipo_continuidad',
        fields: [{name: 'co_equipo_continuidad'},
        		{name: 'co_indicador'},
         		{name: 'nu_cedula'},
		        {name: 'nb_persona'},
		        {name: 'tx_apellido'},
		        {name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
        	    {name: 'resp'}]
        });
    storeEquipoContinuidad.setDefaultSort('co_equipo_continuidad', 'ASC');
    
/*****************************************FIN****StorePersona*****************************************/




/******************************************INICIO**colModelPersona******************************************/     
	//var sm1 = new Ext.grid.CheckboxSelectionModel();
    var colModelEquipoContinuidad = new Ext.grid.ColumnModel([
        {id:'co_equipo_continuidad', hidden: true, header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_equipo_continuidad'},
        {header: "co_indicador", width: 150, sortable: true, locked:false, dataIndex: 'co_indicador'},
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
        {header: "Responsabilidad", width: 180, dataIndex: 'nb_rol_resp',
         editor: {xtype:'combo',
         store: new Ext.data.JsonStore({
				url: '../interfaz/interfaz_combo.php',
				   root: 'Resultados',
				   idProperty: 'co_rol_resp',
				   baseParams: {accion:'rol_resp'},
				   fields:['co_rol_resp','nb_rol_resp']
				  }),
					id:'co_rol_resp',
			        displayField:'nb_rol_resp',
			        typeAhead: true,
			        allowBlank: false,
			        mode: 'remote',
			        forceSelection: true,
			        triggerAction: 'all',
			        emptyText:'Selecione',
			        selectOnFocus:true/*Cambiamos el valor de co_comision en store_agenda,
			            listeners:{                              
   		select: function(combo,record,index){
   		fila = gd_persona.getSelectionModel();
   		celda = fila.getSelectedCell();
   		gd_persona.storePersona.getAt(celda[0]).set('co_rol_resp',record.data.co_rol_resp);
   		}
  		}*/
         }},
         //sm1,
      	//{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        //{header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	//{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        //{header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},      
      ]);
      
/******************************************FIN****colModelPersona******************************************/     


/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/

var gd_persona=new Ext.grid.EditorGridPanel({
					id:'gd_persona',
					name:'gd_persona',
					store: storeEquipoContinuidad,
					cm: colModelEquipoContinuidad,
					stripeRows: true,
					//plugins: expanderPersona,
					iconCls: 'icon-grid',
					//sm: sm1,
					height: 400,
					//width:670,
					title:'Lista de Persona',
					border: true,
					bbar: new Ext.PagingToolbar({
					store: storeEquipoContinuidad,
					pageSize: 50,
					displayInfo: true,
					displayMsg: 'Mostrando registros {0} - {1} de {2}',
					emptyMsg: "No hay registros que mostrar",
					})
    });
    Ext.getCmp('co_rol_resp').on('select',function(combo,record,index){
	fila = gd_persona.getSelectionModel();
   		celda = fila.getSelectedCell();
   		gd_persona.store.getAt(celda[0]).set('co_rol_resp',record.data.co_rol_resp);
});




var gridForm = new Ext.FormPanel({
        id: 'frm_equipocont',
        frame: true,
		labelAlign: 'center',
        title: 'Equipo Continuidad',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:820,
		items: [gd_persona,{
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
					if(Ext.getCmp("frm_equipocont").disabled){
						Ext.getCmp("frm_equipocont").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					//Ext.getCmp("co_equipo_continuidad").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar EquipoContinuidad',
			disabled: true,
			iconCls: 'save',
			waitMsg: 'Saving...',
			handler: function(){
				
				Ext.MessageBox.confirm("[ORINOCO]","Guardar ?", function(btn){
					if(btn == 'yes'){
						records_modificados=storeEquipoContinuidad.getModifiedRecords();
						Ext.each(records_modificados,function(fila,i){
							if(fila.data.co_indicador==undefined || fila.data.co_rol_resp==undefined  || fila.data.co_equipo_continuidad==undefined){
								WinError("Debe completar toda la informaci&oacute;n");
							}
							else {
																	storeEquipoContinuidad.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_equipo_continuidad" : "'+fila.data.co_equipo_continuidad+'", ';
								columnas += '"co_rol_resp" : "'+fila.data.co_rol_resp+'", ';
								columnas += '"co_indicador" : "'+fila.data.co_indicador+'"}';
							storeEquipoContinuidad.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_equipo_continuidad" : "'+fila.data.co_equipo_continuidad+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_equipo_continuidad.php", Resultados:Ext.util.JSON.encode(fila.getChanges())},
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
							});
					}
				});
				
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
			}],
        
    });
    
storeEquipoContinuidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_continuidad.php"}});
gridForm.render('form');

//storeEquipoContinuidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_equipo_continuidad.php"}});


/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_persona").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm_equipocont").disabled){
			Ext.getCmp("frm_equipocont").enable();
		}
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
