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
	camposReq['co_cedula'] = 'Numero cedula';
	camposReq['nb_piloto'] = 'Nombre Piloto';
	
    var bd = Ext.getBody();

	var url = {
        local:  '../jsonp/grid-filter.json',  // static data file
        remote: '../jsonp/grid-filter.php'
    };
    //var encode = false;
    // configure whether filtering is performed locally or remotely (initially)
    var local = true;
	
  var storePiloto = new Ext.data.JsonStore({
		url: '../clases/interfaz_piloto.php', //'../../clases-sifat/interfaz.php',
		remoteSort : true,
		root: 'piloto',
        totalProperty: 'total',
		idProperty: 'co_cedula',
        fields: [{name: 'co_cedula'},					{name: 'nb_piloto'},					{name: 'tx_direccion'},			{name: 'resp'}]
        });
    storePiloto.setDefaultSort('co_cedula', 'ASC');
	
	
    var colModel = new Ext.grid.ColumnModel([
        {id:'co_cedula',header: "Numero cedula", width: 250, sortable: true, locked:false, dataIndex: 'co_cedula'},
        {header: "Nombre Piloto", width: 250, sortable: true, locked:false, dataIndex: 'nb_piloto'},
        {header: "Direccion", width: 250, sortable: true, locked:false, dataIndex: 'tx_direccion'},
      ]);
	
	
	
/*
 *    Here is where we create the Form
 */
 	//ventana de potreraje//

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_forraje',
        frame: true,
		labelAlign: 'center',
        title: 'pilotos',
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
			title: 'pilotos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Cedula',
						xtype:'numberfield',
						id: 'co_cedula',
                        name: 'co_cedula',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }, {
                        fieldLabel: 'Nombre Piloto',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_piloto',
                        name: 'nb_piloto',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						id: 'tx_direccion',
                        name: 'tx_direccion',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160
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
					//nroReg=storePiloto.getCount();
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_cedula").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_forraje").getForm().getValues(false);	
						campos = verifObligatorios(camposForm, camposReq);
						if(campos != ''){		
							Ext.MessageBox.show({
								title: 'ATENCIÓN',
								msg: 'No se pueden guardar los datos. <br />Faltan los siguientes campos obligatorios por llenar: <br /><br />'+campos,
								buttons: Ext.MessageBox.OK,
								icon: Ext.MessageBox.WARNING
							});
						}
						else
						{
							if(nuevo)						
								storePiloto.baseParams = {'accion': 'insertar'};
							else
								storePiloto.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_cedula" : "'+Ext.getCmp("co_cedula").getValue()+'", ';
							columnas += '"nb_piloto" : "'+Ext.getCmp("nb_piloto").getValue()+'", ';
							columnas += '"tx_direccion" : "'+Ext.getCmp("tx_direccion").getValue()+'"}';
							storePiloto.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_cedula" : "'+Ext.getCmp("co_cedula").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_piloto.php"},
										callback: function () {
										if(storePiloto.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePiloto.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
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
							storePiloto.baseParams = {'accion': 'refrescar', 'interfaz': 'interfaz_piloto.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar piloto' ,
			disabled: false,
			handler: function(){
										storePiloto.baseParams = {'accion': 'eliminar'};
										storePiloto.load({params:{
												"condiciones": '{ "co_cedula" : "'+Ext.getCmp("co_cedula").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_piloto.php"},
										callback: function () {
										if(storePiloto.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePiloto.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
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
				id: 'gd_forraje',
                store: storePiloto,
                cm: colModel,
			//	plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_forraje").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de pilotos',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storePiloto,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });


	
	
storePiloto.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "interfaz_piloto.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_forraje").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_cedula").focus();
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
