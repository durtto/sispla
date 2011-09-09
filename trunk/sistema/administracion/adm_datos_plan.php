<html>
<head>
<title>Datos Plan</title>
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
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_componente'] = 'Codigo Componente';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
	
   var storeDatosPlan = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_dato_plan.php',
		remoteSort : true,
		root: 'datosplan',
        totalProperty: 'total',
		idProperty: 'co_componente',
        fields: [{name: 'co_componente'},					{name: 'fe_vigencia'},					{name: 'tx_objetivo'},	   {name: 'tx_alcance'},   {name: 'tx_identificacion_negocio'},		   {name: 'tx_localidad'},		   {name: 'tx_organizacion'},      {name: 'resp'}]
        });
    storeDatosPlan.setDefaultSort('co_componente', 'ASC');
	
	
    var colModelDatosPlan = new Ext.grid.ColumnModel([
        {id:'co_componente',header: "Componente", width: 250, sortable: true, locked:false, dataIndex: 'co_componente'},
        {header: "Fecha de Vigencia", width: 250, sortable: true, locked:false, dataIndex: 'fe_vigencia'},
        {header: "Objetivos", width: 250, sortable: true, locked:false, dataIndex: 'tx_objetivo'},
        {header: "Alcance", width: 250, sortable: true, locked:false, dataIndex: 'tx_alcance'},
        {header: "Negocio", width: 250, sortable: true, locked:false, dataIndex: 'tx_identificacion_negocio'},
        {header: "Localidad", width: 250, sortable: true, locked:false, dataIndex: 'tx_localidad'},
        {header: "Organizacion", width: 250, sortable: true, locked:false, dataIndex: 'tx_organizacion'},
        ]);
	
	
	
/*
 *    Here is where we create the Form
 */

		
var gridForm = new Ext.FormPanel({
        id: 'frm_datosplan',
        frame: true,
		labelAlign: 'center',
        title: 'Datos del Plan',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:660,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			//layout:'column',
			title: 'Datos del Plan',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Componente',
						xtype:'numberfield',
						id: 'co_componente',
                        name: 'co_componente',
						//hidden: true,
						//hideLabel: true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }, {
                        fieldLabel: 'Fecha de Vigencia',
						xtype:'datefield',
						vtype:'validos',
						id: 'fe_vigencia',
                        name: 'fe_vigencia',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Negocio',
						xtype:'textfield',
						id: 'tx_identificacion_negocio',
                        name: 'tx_identificacion_negocio',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Localidad',
						xtype:'textfield',
						id: 'tx_localidad',
                        name: 'tx_localidad',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Organizacion',
						xtype:'textfield',
						id: 'tx_organizacion',
                        name: 'tx_organizacion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    },{
                        fieldLabel: 'Objetivo',
						xtype:'htmleditor',
						id: 'tx_objetivo',
                        name: 'tx_objetivo',
                        height: 100,
            			anchor: '100%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    },{
                        fieldLabel: 'Alcance',
						xtype:'htmleditor',
						id: 'tx_alcance',
                        name: 'tx_alcance',
                        height: 100,
            			anchor: '100%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
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
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_componente").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_datosplan").getForm().getValues(false);	
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
								storeDatosPlan.baseParams = {'accion': 'insertar'};
							else
								storeDatosPlan.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_componente" : "'+Ext.getCmp("co_componente").getValue()+'", ';
								columnas += '"fe_vigencia" : "'+Ext.getCmp("fe_vigencia").getValue()+'", ';
								columnas += '"tx_objetivo" : "'+Ext.getCmp("tx_objetivo").getValue()+'", ';
								columnas += '"tx_alcance" : "'+Ext.getCmp("tx_alcance").getValue()+'", ';
								columnas += '"tx_identificacion_negocio" : "'+Ext.getCmp("tx_identificacion_negocio").getValue()+'", ';
								columnas += '"tx_localidad" : "'+Ext.getCmp("tx_localidad").getValue()+'", ';
								columnas += '"tx_organizacion" : "'+Ext.getCmp("tx_organizacion").getValue()+'"}';
							storeDatosPlan.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_componente" : "'+Ext.getCmp("co_componente").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_categoria.php"},
										callback: function () {
										if(storeDatosPlan.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDatosPlan.getAt(0).data.resp, 
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
							storeDatosPlan.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_dato_planphp'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Categoria',
			disabled: true,
			handler: function(){
										storeDatosPlan.baseParams = {'accion': 'eliminar'};
										storeDatosPlan.load({params:{
												"condiciones": '{ "co_componente" : "'+Ext.getCmp("co_categoria").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_dato_plan.php"},
										callback: function () {
										if(storeDatosPlan.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDatosPlan.getAt(0).data.resp,
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
				id: 'gd_datosplan',
                store: storeDatosPlan,
                cm: colModelDatosPlan,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_datosplan").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Planes',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeDatosPlan,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

	
	
storeDatosPlan.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_dato_plan.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_datosplan").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
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

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>

</body>
</html>
