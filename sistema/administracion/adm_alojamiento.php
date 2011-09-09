<html>
<head>
<title>Alojamiento</title>
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
	camposReq['co_alojamiento'] = 'Codigo Alojamiento';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
	
  var storeAlojamiento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_alojamiento.php',
		remoteSort : true,
		root: 'alojamientos',
        totalProperty: 'total',
		idProperty: 'co_alojamiento',
        fields: [{name: 'co_alojamiento'},					{name: 'nb_establecimiento'},	{name: 'di_ubicacion'},		{name: 'nu_telefono'},		{name: 'bo_hotel'},	{name: 'bo_posada'},	{name: 'resp'}]
        });
    storeAlojamiento.setDefaultSort('co_alojamiento', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelAlojamiento = new Ext.grid.ColumnModel([
        {id:'co_alojamiento',header: "Alojamiento", width: 100, sortable: true, locked:false, dataIndex: 'co_alojamiento'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_establecimiento'},
        {header: "Direccion", width: 100, sortable: true, locked:false, dataIndex: 'di_ubicacion'},
        {header: "Telefono", width: 100, sortable: true, locked:false, dataIndex: 'nu_telefono'},
        {header: "Hotel", width: 100, sortable: true, locked:false, dataIndex: 'bo_hotel'},
        {header: "Posada", width: 100, sortable: true, locked:false, dataIndex: 'bo_posada'},
      ]);
	
	
	
/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_alojamiento',
        frame: true,
		labelAlign: 'center',
        title: 'alojamientos',
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
			title: 'Alojamientos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo Alojamiento',
						xtype:'numberfield',
						id: 'co_alojamiento',
                        name: 'co_alojamiento',
                        //hidden: true,
						//hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_establecimiento',
                        name: 'nb_establecimiento',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                    }, {
                        fieldLabel: 'Direccion',
						xtype:'textfield',
						vtype:'validos',
						id: 'di_ubicacion',
                        name: 'di_ubicacion',
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
                        fieldLabel: 'Telefono',
						xtype:'numberfield',
						id: 'nu_telefono',
                        name: 'nu_telefono',
						width:160
                    }, {
                        xtype: 'radiogroup',
	            		fieldLabel: 'Hotel',
	            		id: 'bo_hotel',
		                name: 'bo_hotel',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'hotel', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'hotel', inputValue: 0},
			           			]
                    },{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Posada',
	            		id: 'bo_posada',
		                name: 'bo_posada',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'posada', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'posada', inputValue: 0},
			           			]
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
					//nroReg=storeAlojamiento.getCount();
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_alojamiento").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_alojamiento").getForm().getValues(false);	
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
								storeAlojamiento.baseParams = {'accion': 'insertar'};
							else
								storeAlojamiento.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_alojamiento" : "'+Ext.getCmp("co_alojamiento").getValue()+'", ';
							columnas += '"nb_establecimiento" : "'+Ext.getCmp("nb_establecimiento").getValue()+'", ';
							columnas += '"di_ubicacion" : "'+Ext.getCmp("di_ubicacion").getValue()+'", ';
							columnas += '"nu_telefono" : "'+Ext.getCmp("nu_telefono").getValue()+'", ';
							columnas += '"bo_hotel" : "'+Ext.getCmp("bo_hotel").getValue()+'", ';
							columnas += '"bo_posada" : "'+Ext.getCmp("bo_posada").getValue()+'"}';
							storeAlojamiento.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_alojamiento" : "'+Ext.getCmp("co_alojamiento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_alojamiento.php"},
										callback: function () {
										if(storeAlojamiento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeAlojamiento.getAt(0).data.resp, 
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
							storeAlojamiento.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_alojamiento.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Alojamiento',
			disabled: true,
			handler: function(){
										storeAlojamiento.baseParams = {'accion': 'eliminar'};
										storeAlojamiento.load({params:{
												"condiciones": '{ "co_alojamiento" : "'+Ext.getCmp("co_alojamiento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_alojamiento.php"},
										callback: function () {
										if(storeAlojamiento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeAlojamiento.getAt(0).data.resp,
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
				id: 'gd_alojamiento',
                store: storeAlojamiento,
                cm: colModelAlojamiento,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_alojamiento").getForm().loadRecord(rec);
                        }
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Alojamientos',
                border: true,
                listeners: {
                    viewready: function(g) {
                       // g.getSelectionModel().selectRow(0);
                    } // Allow rows to be rendered.
                },
				bbar: new Ext.PagingToolbar({
				store: storeAlojamiento,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });


	
	
storeAlojamiento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_alojamiento.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_alojamiento").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_alojamiento").focus();
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