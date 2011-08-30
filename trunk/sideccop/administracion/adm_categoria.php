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
	camposReq['co_categoria'] = 'Codigo Categoria';
	
    var bd = Ext.getBody();

	var url = {
        local:  '../jsonp/grid-filter.json',  // static data file
        remote: '../jsonp/grid-filter.php'
    };
    //var encode = false;
    // configure whether filtering is performed locally or remotely (initially)
    var local = true;
	
  var storeCategoria = new Ext.data.JsonStore({
		url: '../clases/interfaz_categoria.php',
		remoteSort : true,
		root: 'guardias',
        totalProperty: 'total',
		idProperty: 'co_categoria',
        fields: [{name: 'co_categoria'},					{name: 'nb_categoria'},					{name: 'resp'}]
        });
    storeCategoria.setDefaultSort('co_categoria', 'ASC');
	
	
    var colModelCategoria = new Ext.grid.ColumnModel([
        {id:'co_categoria',header: "Categoria", width: 250, sortable: true, locked:false, dataIndex: 'co_categoria'},
        {header: "Nombre Categoria", width: 250, sortable: true, locked:false, dataIndex: 'nb_categoria'},
        ]);
	
	
	
/*
 *    Here is where we create the Form
 */
 	//ventana de potreraje//

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_categoria',
        frame: true,
		labelAlign: 'center',
        title: 'Categoria',
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
			title: 'Categoria',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Categoria',
						xtype:'numberfield',
						id: 'co_categoria',
                        name: 'co_categoria',
                        hidden: true,
						hideLabel: true,
                        width:140
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_nombre',
                        name: 'nb_nombre',
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
					
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_categoria").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_categoria").getForm().getValues(false);	
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
								storeCategoria.baseParams = {'accion': 'insertar'};
							else
								storeCategoria.baseParams = {'accion': 'modificar'};
							var columnas   = '{"co_categoria" : "'+Ext.getCmp("co_categoria").getValue()+'", ';
								columnas += '"nb_categoria" : "'+Ext.getCmp("nb_categoria").getValue()+'"}';
							storeGuardia.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_categoria" : "'+Ext.getCmp("co_categoria").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_categoria.php"},
										callback: function () {
										if(storeCategoria.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCategoria.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
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
							storeCategoria.baseParams = {'accion': 'refrescar', 'interfaz': 'interfaz_categoria.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Categoria',
			disabled: true,
			handler: function(){
										storeCategoria.baseParams = {'accion': 'eliminar'};
										storeCategoria.load({params:{
												"condiciones": '{ "co_categoria" : "'+Ext.getCmp("co_categoria").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "interfaz_categoria.php"},
										callback: function () {
										if(storeCategoria.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCategoria.getAt(0).data.resp, //+'  -  '+store.getAt(0).data.co_cedula,
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
				id: 'gd_categoria',
                store: storeCategoria,
                cm: colModelCategoria,
			//	plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_categoria").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Categorias',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeCategoria,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });


	
	
storeCategoria.load({params: { start: 0, limit: 50, accion:"refrescar"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_categoria").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_categoria").focus();
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
