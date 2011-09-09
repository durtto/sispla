<html>
<head>
<title>Rol</title>
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
	camposReq['co_rol'] = 'Codigo Rol';
	camposReq['nb_rol'] = 'Nombre Rol';
	
    var bd = Ext.getBody();

	var url = {
        local:  '../jsonp/grid-filter.json',  // static data file
        remote: '../jsonp/grid-filter.php'
    };
    //var encode = false;
    // configure whether filtering is performed locally or remotely (initially)
    var local = true;
	
  var storeRol = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_rol_persona.php',
		remoteSort : true,
		root: 'roldepersonas',
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
	
	

    var gridForm = new Ext.FormPanel({
        id: 'frm_rol',
        frame: true,
		labelAlign: 'center',
        title: 'Roles',
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
			title: 'Roles',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Rol',
						xtype:'numberfield',
						id: 'co_rol',
                        name: 'co_rol',
                        //hidden: true,
						//hideLabel: true,
						width:140
                    
				},{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_rol',
                        name: 'nb_rol',
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
					Ext.getCmp("co_rol").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
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
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_rol_persona.php"},
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
			tooltip:'Eliminar Capacidad',
			disabled: true,
			handler: function(){
										storeRolRes.baseParams = {'accion': 'eliminar'};
										storeRolRes.load({params:{
												"condiciones": '{ "co_rol_resp" : "'+Ext.getCmp("co_rol_resp").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_rol_res.php"},
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
							}})}
			}]
			},{
			width:640,
			items:[{
                xtype: 'grid',
				id: 'gd_rol',
                store: storeRol,
                cm: colModelRol,
			//	plugins: [filters],
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
				title:'Roles',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeRol,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });


	
	
storeRol.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_rol_persona.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_rol").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
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
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>

</body>
</html>
