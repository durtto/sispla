<html>
<head>
<title></title>
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
	camposReq['co_proceso'] = 'Codigo Proceso';
	camposReq['nb_proceso'] = 'Nombre Proceso';
	camposReq['bo_critico'] = 'Proceso Critico';
	
    var bd = Ext.getBody();

	var url = {
        local:  '../jsonp/grid-filter.json',  // static data file
        remote: '../jsonp/grid-filter.php'
    };
    //var encode = false;
    // configure whether filtering is performed locally or remotely (initially)
    var local = true;
	
  var storeProceso = new Ext.data.JsonStore({
		url: '../clases/interfaz_proceso.php',
		remoteSort : true,
		root: 'procesos',
        totalProperty: 'total',
		idProperty: 'co_proceso',
        fields: [{name: 'co_proceso'},					{name: 'nb_proceso'},					{name: 'tx_descripcion'},	   {name: 'bo_critico'},		{name: 'resp'}]
        });
    storeProceso.setDefaultSort('co_proceso', 'ASC');
	
	
    var colModelProceso = new Ext.grid.ColumnModel([
        {id:'co_proceso',header: "Proceso", width: 250, sortable: true, locked:false, dataIndex: 'co_proceso'},
        {header: "Nombre Proceso", width: 250, sortable: true, locked:false, dataIndex: 'nb_proceso'},
        {header: "Descripcion", width: 250, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Proceso Critico", width: 250, sortable: true, locked:false, dataIndex: 'bo_critico'},
        ]);
	
	
	
/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_proceso',
        frame: true,
		labelAlign: 'center',
        title: 'Procesos',
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
			title: 'Procesos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Proceso',
						xtype:'numberfield',
						id: 'co_proceso',
                        name: 'co_proceso',
                        hidden: true,
						hideLabel: true,
                        width:140
                    }, {
                        fieldLabel: 'Nombre Proceso',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_proceso',
                        name: 'nb_proceso',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
	            		xtype: 'radiogroup',
	            		fieldLabel: 'Critico',
	            		id: 'bo_critico',
		                name: 'bo_critico',
			            cls: 'x-check-group-alt',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'Verdadero', inputValue: 1},
			                {boxLabel: 'No', name: 'Falso', inputValue: 0, checked: true},
			           			]
        		},{
                        fieldLabel: 'Descripcion',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        height: 100,
            			anchor: '100%'

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
					
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_proceso").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_proceso").getForm().getValues(false);	
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
								storeProceso.baseParams = {'accion': 'insertar'};
							else
								storeProceso.baseParams = {'accion': 'modificar'};
							var columnas   = '{"co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'", ';
							columnas += '"nb_proceso" : "'+Ext.getCmp("nb_proceso").getValue()+'", ';
							columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
							columnas += '"bo_critico" : "'+Ext.getCmp("bo_critico").getValue()+'"}';
							storeProceso.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_proceso.php"},
										callback: function () {
										if(storeProceso.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeProceso.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											/*if(nuevo==true){
												if(gridForm.getForm().isValid())  gridForm.getForm().reset();
												Ext.getCmp("co_forraje").focus();
											}*/
											Ext.MessageBox.show({
												title: 'INFORMACION',
												msg: "Datos Guardados con exito",
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.INFO
											});
										}
							}});
							storeProceso.baseParams = {'accion': 'refrescar', 'interfaz': 'interfaz_proceso.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Proceso',
			disabled: true,
			handler: function(){
										storeProceso.baseParams = {'accion': 'eliminar'};
										storeProceso.load({params:{
												"condiciones": '{ "co_proceso" : "'+Ext.getCmp("co_proceso").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_proceso.php"},
										callback: function () {
										if(storeProceso.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeProceso.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
												buttons: Ext.MessageBox.OK,
												icon: Ext.MessageBox.ERROR
											});						
										}
										else{
											/*if(nuevo==true){
												if(gridForm.getForm().isValid())  gridForm.getForm().reset();
												Ext.getCmp("co_forraje").focus();
											}*/
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
				id: 'gd_proceso',
                store: storeProceso,
                cm: colModelProceso,
			//	plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_proceso").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Procesos',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeProceso,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });


	
	
storeProceso.load({params: { start: 0, limit: 50, accion:"refrescar"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_proceso").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_proceso").focus();
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
