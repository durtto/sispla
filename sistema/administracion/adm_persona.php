<html>
<head>
<title>Persona</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
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
 var winDepartamento;
 var winRol;
 var winRolResp;
 var winGrupo;
 var winGuardia;
  
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_indicador'] = 'Codigo Persona';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
   
    var storeGuardia = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_guardia.php',
		remoteSort : true,
		root: 'guardias',
        totalProperty: 'total',
		idProperty: 'co_guardia',
        fields: [{name: 'co_guardia'},			
        		{name: 'nb_guardia'},				
        		{name: 'nu_numero'},	 
        		{name: 'tx_descripcion'},		
        		{name: 'resp'}]
       
        });
    storeGuardia.setDefaultSort('co_guardia', 'ASC');
	
	
    var colModelGuardia = new Ext.grid.ColumnModel([
        {id:'co_guardia',header: "Guardia", width: 80, sortable: true, locked:false, dataIndex: 'co_guardia'},
        {header: "Nombre Guardia", width: 250, sortable: true, locked:false, dataIndex: 'nb_guardia'},
        {header: "Numero", width: 50, sortable: true, locked:false, dataIndex: 'nu_numero'},
        {header: "Descripcion", width: 250, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        ]);
    var storeGrupo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_grupo.php',
		remoteSort : true,
		root: 'grupos',
        totalProperty: 'total',
		idProperty: 'co_grupo',
        fields: [{name: 'co_grupo'},
        		{name: 'nb_grupo'},
        		{name: 'resp'}]
        });
    storeGrupo.setDefaultSort('co_grupo', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelGrupo = new Ext.grid.ColumnModel([
        {id:'co_grupo',header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'co_grupo'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},
      ]);
    
   var storeRolResp = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_rol_responsabilidad.php',
		remoteSort : true,
		root: 'rolresponsabilidades',
        totalProperty: 'total',
		idProperty: 'co_rol_resp',
        fields: [{name: 'co_rol_resp'},
        		{name: 'nb_rol_resp'},
        		{name: 'tx_descripcion'},
        		{name: 'co_rol_padre'},
        		{name: 'resp'}]
        });
    storeRolResp.setDefaultSort('co_rol_resp', 'ASC');
	
	
    var colModelRolResp = new Ext.grid.ColumnModel([
        {id:'co_rol_resp',header: "Rol", width: 50, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Nombre Rol", width: 150, sortable: true, locked:false, dataIndex: 'nb_rol_resp'},
        {header: "Descripcion", width: 200, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Rol Padre", width: 80, sortable: true, locked:false, dataIndex: 'co_rol_padre'},
        ]);
        
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
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelDepartamento = new Ext.grid.ColumnModel([
        {id:'co_departamento',header: "Departamento", width: 100, sortable: true, locked:false, dataIndex: 'co_departamento'},
        {header: "Departamento", width: 100, sortable: true, locked:false, dataIndex: 'nb_departamento'},
      ]);
	
     var storeRol = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_rol_persona.php',
		remoteSort : true,
		root: 'rolpersonas',
        totalProperty: 'total',
		idProperty: 'co_rol',
        fields: [{name: 'co_rol'},
		        {name: 'nb_rol'},
		        {name: 'tx_descripcion'},
		        {name: 'resp'}]
        });
    storeRol.setDefaultSort('co_rol', 'ASC');
	
	
    var colModelRol = new Ext.grid.ColumnModel([
        {id:'co_rol',header: "Rol", width: 50, sortable: true, locked:false, dataIndex: 'co_rol'},
        {header: "Nombre Rol", width: 150, sortable: true, locked:false, dataIndex: 'nb_rol'},
        {header: "Descripcion", width: 400, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        ]);
         
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
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelPersona = new Ext.grid.ColumnModel([
        {id:'co_indicador',header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'co_indicador'},
        {header: "Cedula", width: 100, sortable: true, locked:false, dataIndex: 'nu_cedula'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
		{header: "Apellido", width: 100, sortable: true, locked:false, dataIndex: 'tx_apellido'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_oficina'},
		{header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_oficina'},
        {header: "Correo Electronico", width: 100, sortable: true, locked:false, dataIndex: 'tx_correo_electronico'},
        {header: "Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'di_habitacion'},
		{header: "Telefono Habitacion", width: 100, sortable: true, locked:false, dataIndex: 'tx_telefono_habitacion'},
        {header: "Departamento", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_departamento'},
        {header: "Departamento", width: 100, sortable: true, locked:false, dataIndex: 'nb_departamento'},      
     	{header: "Rol", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol'},
        {header: "Rol", width: 100, sortable: true, locked:false, dataIndex: 'nb_rol'},      
      	{header: "Responsabilidad", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_rol_resp'},
        {header: "Responsabilidad", width: 100, sortable: true, locked:false, dataIndex: 'nb_rol_resp'},      
      	{header: "Grupo", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_grupo'},
        {header: "Grupo", width: 100, sortable: true, locked:false, dataIndex: 'nb_grupo'},      
      	{header: "Guardia", width: 100,hidden: true, sortable: true, locked:false, dataIndex: 'co_guardia'},
        {header: "Guardia", width: 100, sortable: true, locked:false, dataIndex: 'nb_guardia'},      
      
      ]);
	
	     

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_persona',
        frame: true,
		labelAlign: 'center',
        title: 'Persona',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Personas',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Persona',
						xtype:'numberfield',
						id: 'co_indicador',
                        name: 'co_indicador',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
                    },{
                        fieldLabel: 'Cedula',
						xtype:'numberfield',
						id: 'nu_cedula',
                        name: 'nu_cedula',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_persona',
                        name: 'nb_persona',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Apellido',
						xtype:'textfield',
						id: 'tx_apellido',
                        name: 'tx_apellido',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Correo Electronico',
						xtype:'textfield',
						id: 'tx_correo_electronico',
                        name: 'tx_correo_electronico',
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
                        fieldLabel: 'Oficina',
						xtype:'textfield',
						id: 'di_oficina',
                        name: 'di_oficina',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Telefono Oficina',
						xtype:'numberfield',
						id: 'tx_telefono_oficina',
                        name: 'tx_telefono_oficina',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                      
                    },{
                        fieldLabel: 'Habitacion',
						xtype:'textfield',
						id: 'di_habitacion',
                        name: 'di_habitacion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Telefono Habitacion',
						xtype:'numberfield',
						id: 'tx_telefono_habitacion',
                        name: 'tx_telefono_habitacion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                       
                    }]
			}]
			},{
	   		xtype:'fieldset',
			id: 'frm2',
			disabled: true,
			labelAlign: 'center',
			width:640,
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
                        fieldLabel: 'Departamento',
						xtype:'numberfield',
						id: 'co_departamento',
                        name: 'co_departamento',
                        //hidden: true,
						//hideLabel: true,
                        width:140
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_departamento',
						disabled:true,
                        name: 'nb_departamento',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			}]
			},{
	   		xtype:'fieldset',
			id: 'frm3',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Rol',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Rol',
						xtype:'numberfield',
						id: 'co_rol',
                        name: 'co_rol',
                        //hidden: true,
						//hideLabel: true,
                        width:140
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_rol',
						disabled:true,
                        name: 'nb_rol',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			}]
			},{
	   		xtype:'fieldset',
			id: 'frm4',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Responsabilidad',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Responsabilidad',
						xtype:'numberfield',
						id: 'co_rol_resp',
                        name: 'co_rol_resp',
                        //hidden: true,
						//hideLabel: true,
                        width:140
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_rol_resp',
						disabled:true,
                        name: 'nb_rol',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			}]
			},{
	   		xtype:'fieldset',
			id: 'frm5',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Grupo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Grupo',
						xtype:'numberfield',
						id: 'co_grupo',
                        name: 'co_grupo',
                        //hidden: true,
						//hideLabel: true,
                        width:140
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_grupo',
						disabled:true,
                        name: 'nb_grupo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			}]
			},{
	   		xtype:'fieldset',
			id: 'frm6',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			layout:'column',
			title: 'Guardia',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Guardia',
						xtype:'numberfield',
						id: 'co_guardia',
                        name: 'co_guardia',
                        //hidden: true,
						//hideLabel: true,
                        width:140
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_guardia',
						disabled:true,
                        name: 'nb_guardia',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }]
			}]
			},{
				width: 640,  
				buttonAlign:'center',
				layout: 'fit', 	
				buttons: [{
			text: 'Nuevo', 
			tooltip:'',
			handler: function(){
					nuevo = true;
					//nroReg=storeGrupo.getCount();
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
						Ext.getCmp("frm2").enable();
						Ext.getCmp("frm3").enable();
						Ext.getCmp("frm4").enable();
						Ext.getCmp("frm5").enable();
						Ext.getCmp("frm6").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_indicador").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_persona").getForm().getValues(false);	
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
								storePersona.baseParams = {'accion': 'insertar'};
							else
								storePersona.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'", ';
								columnas += '"nu_cedula" : "'+Ext.getCmp("nu_cedula").getValue()+'", ';
								columnas += '"nb_persona" : "'+Ext.getCmp("nb_persona").getValue()+'", ';
								columnas += '"tx_apellido" : "'+Ext.getCmp("tx_apellido").getValue()+'", ';
								columnas += '"di_oficina" : "'+Ext.getCmp("di_oficina").getValue()+'", ';
								columnas += '"tx_telefono_oficina" : "'+Ext.getCmp("tx_telefono_oficina").getValue()+'", ';
								columnas += '"tx_correo_electronico" : "'+Ext.getCmp("tx_correo_electronico").getValue()+'", ';
								columnas += '"di_habitacion" : "'+Ext.getCmp("di_habitacion").getValue()+'", ';
								columnas += '"tx_telefono_habitacion" : "'+Ext.getCmp("tx_telefono_habitacion").getValue()+'", ';
								columnas += '"tx_telefono_personal" : "'+Ext.getCmp("tx_telefono_personal").getValue()+'", ';
								columnas += '"co_departamento" : "'+Ext.getCmp("co_departamento").getValue()+'", ';
								columnas += '"co_rol" : "'+Ext.getCmp("co_rol").getValue()+'", ';
								columnas += '"co_rol_resp" : "'+Ext.getCmp("co_rol_resp").getValue()+'", ';
								columnas += '"co_grupo" : "'+Ext.getCmp("co_grupo").getValue()+'", ';
								columnas += '"co_guardia" : "'+Ext.getCmp("co_guardia").getValue()+'"}';
							storePersona.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_persona.php"},
										callback: function () {
										if(storePersona.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePersona.getAt(0).data.resp, 
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
							storePersona.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_persona.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Persona',
			disabled: true,
			handler: function(){
										storePersona.baseParams = {'accion': 'eliminar'};
										storePersona.load({params:{
												"condiciones": '{ "co_indicador" : "'+Ext.getCmp("co_indicador").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_persona.php"},
										callback: function () {
										if(storePersona.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePersona.getAt(0).data.resp,
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
			width:640,
			items:[{
                xtype: 'grid',
				id: 'gd_indicador',
                store: storePersona,
                cm: colModelPersona,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_persona").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Persona',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storePersona,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

function selDepartamento(){
storeDepartamento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_departamento.php"}});
	if(!winDepartamento){
				winDepartamento = new Ext.Window({
						applyTo : 'winDepartamento',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selDepartamento',
								store: storeDepartamento,
								cm: colModelDepartamento,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Departamento',
								border: true,
								listeners: {
												/*render: function(g) {
													g.getSelectionModel().selectRow(0);
												},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selDepartamento").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selDepartamento").getSelectionModel().getSelected();
											Ext.getCmp("co_departamento").setValue(record.data.co_departamento);
											Ext.getCmp("nb_departamento").setValue(record.data.nb_departamento);
											winDepartamento.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winDepartamento.hide();
								  }
						}]
				});
		}
		winDepartamento.show();	
}
 function selRol(){
storeRol.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_rol_persona.php"}});
	if(!winRol){
				winRol = new Ext.Window({
						applyTo : 'winRol',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selRol',
								store: storeRol,
								cm: colModelRol,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Roles',
								border: true,
								listeners: {
												/*render: function(g) {
													g.getSelectionModel().selectRow(0);
												},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selRol").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selRol").getSelectionModel().getSelected();
											Ext.getCmp("co_rol").setValue(record.data.co_rol);
											Ext.getCmp("nb_rol").setValue(record.data.nb_rol);
											winRol.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winRol.hide();
								  }
						}]
				});
		}
		winRol.show();	
}

function selRolResp(){
storeRolResp.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_rol_responsabilidad.php"}});
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
								//ds: ds,
								id: 'gd_selRolResp',
								store: storeRolResp,
								cm: colModelRolResp,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Responsabilidades',
								border: true,
								listeners: {
												/*render: function(g) {
													g.getSelectionModel().selectRow(0);
												},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selRolResp").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selRolResp").getSelectionModel().getSelected();
											Ext.getCmp("co_rol_resp").setValue(record.data.co_rol_resp);
											Ext.getCmp("nb_rol_resp").setValue(record.data.nb_rol_resp);
											winRolResp.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winRolResp.hide();
								  }
						}]
				});
		}
		winRolResp.show();	
}

function selGrupo(){
storeGrupo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_grupo.php"}});
	if(!winGrupo){
				winGrupo = new Ext.Window({
						applyTo : 'winGrupo',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selGrupo',
								store: storeGrupo,
								cm: colModelGrupo,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Grupo',
								border: true,
								listeners: {
												/*render: function(g) {
													g.getSelectionModel().selectRow(0);
												},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selGrupo").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selGrupo").getSelectionModel().getSelected();
											Ext.getCmp("co_grupo").setValue(record.data.co_grupo);
											Ext.getCmp("nb_grupo").setValue(record.data.nb_grupo);
											winGrupo.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winGrupo.hide();
								  }
						}]
				});
		}
		winGrupo.show();	
}
function selGuardia(){
storeGuardia.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_guardia.php"}});
	if(!winGuardia){
				winGuardia = new Ext.Window({
						applyTo : 'winGuardia',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selGuardia',
								store: storeGuardia,
								cm: colModelGuardia,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Guardia',
								border: true,
								listeners: {
												/*render: function(g) {
													g.getSelectionModel().selectRow(0);
												},*/
												delay: 10 // Allow rows to be rendered.
								}
						}],
						buttons:[{
								  text : 'Aceptar',
								  handler : function(){
										/**/
										if(Ext.getCmp("gd_selGuardia").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selGuardia").getSelectionModel().getSelected();
											Ext.getCmp("co_guardia").setValue(record.data.co_guardia);
											Ext.getCmp("nb_guardia").setValue(record.data.nb_guardia);
											winGuardia.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winGuardia.hide();
								  }
						}]
				});
		}
		winGuardia.show();	
}
	
storePersona.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_persona.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_indicador").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
			Ext.getCmp("frm3").enable();
			Ext.getCmp("frm4").enable();
			Ext.getCmp("frm5").enable();
		}
		Ext.getCmp("co_indicador").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerDepartamento = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerDepartamento.onTriggerClick = selDepartamento;
		triggerDepartamento.applyToMarkup('co_departamento');
		
var triggerRol = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerRol.onTriggerClick = selRol;
		triggerRol.applyToMarkup('co_rol');
		
var triggerRolResp = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerRolResp.onTriggerClick = selRolResp;
		triggerRolResp.applyToMarkup('co_rol_resp');
		
var triggerGrupo = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerGrupo.onTriggerClick = selGrupo;
		triggerGrupo.applyToMarkup('co_grupo');
		
var triggerGuardia = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerGuardia.onTriggerClick = selGuardia;
		triggerGuardia.applyToMarkup('co_guardia');
});


</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
	<div id="winDepartamento" class="x-hidden">
    <div class="x-window-header">Ejegir Departamento</div>
	</div>
	<div id="winRol" class="x-hidden">
    <div class="x-window-header">Ejegir Rol</div>
	</div>
	<div id="winRolResp" class="x-hidden">
    <div class="x-window-header">Ejegir Responsabilidad</div>
	</div>
	<div id="winGrupo" class="x-hidden">
    <div class="x-window-header">Ejegir Grupo</div>
	</div>
	<div id="winGuardia" class="x-hidden">
    <div class="x-window-header">Ejegir Guardia</div>
	</div>
</body>
</html>
