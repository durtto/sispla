<html>
<head>
<title>Privilegio Usuario</title>
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
	camposReq['co_privilegio'] = 'Codigo Privilegio';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
	
  var storePrivilegio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_privilegio_usuario.php',
		remoteSort : true,
		root: 'privilegios',
        totalProperty: 'total',
		idProperty: 'co_privilegio',
        fields: [{name: 'co_privilegio'},
        		{name: 'nb_privilegio'},
        		{name: 'tx_descripcion'},
        		{name: 'bo_critico'},
        		{name: 'resp'}]
        });
    storePrivilegio.setDefaultSort('co_privilegio', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelPrivilegio = new Ext.grid.ColumnModel([
        {id:'co_privilegio',header: "Privilegio", width: 100, sortable: true, locked:false, dataIndex: 'co_privilegio'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_privilegio'},
        {header: "Descripcion", width: 338, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        ]);
	
	     

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_privilegio',
        frame: true,
		labelAlign: 'center',
        title: 'Privilegio',
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
			title: 'Privilegios',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Privilegio',
						xtype:'numberfield',
						id: 'co_privilegio',
                        name: 'co_privilegio',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_privilegio',
                        name: 'nb_privilegio',
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
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Descripcion',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
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
					Ext.getCmp("co_privilegio").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_privilegio").getForm().getValues(false);	
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
								storePrivilegio.baseParams = {'accion': 'insertar'};
							else
								storePrivilegio.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_privilegio" : "'+Ext.getCmp("co_privilegio").getValue()+'", ';
								columnas += '"nb_privilegio" : "'+Ext.getCmp("nb_privilegio").getValue()+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'"}';
							storePrivilegio.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_privilegio" : "'+Ext.getCmp("co_privilegio").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_privilegio_usuario.php"},
										callback: function () {
										if(storePrivilegio.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePrivilegio.getAt(0).data.resp, 
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
							storePrivilegio.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_privilegio_usuario.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar privilegio',
			disabled: true,
			handler: function(){
										storePrivilegio.baseParams = {'accion': 'eliminar'};
										storePrivilegio.load({params:{
												"condiciones": '{ "co_privilegio" : "'+Ext.getCmp("co_privilegio").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_privilegio_usuario.php"},
										callback: function () {
										if(storePrivilegio.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storePrivilegio.getAt(0).data.resp,
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
				id: 'gd_privilegio',
                store: storePrivilegio,
                cm: colModelPrivilegio,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_privilegio").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Privilegios',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storePrivilegio,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });


 
	
storePrivilegio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_privilegio_usuario.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_privilegio").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_privilegio").focus();
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