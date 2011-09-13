<html>
<head>
<title>Caracteristica</title>
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
 var winModelo;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_caracteristica'] = 'Codigo Caracteristica';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	var storeModelo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_modelo.php',
		remoteSort : true,
		root: 'modelos',
        totalProperty: 'total',
		idProperty: 'co_modelo',
        fields: [{name: 'co_modelo'},
        		{name: 'nb_modelo'},
        		{name: 'resp'}]
        });
    storeModelo.setDefaultSort('co_modelo', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelModelo = new Ext.grid.ColumnModel([
        {id:'co_modelo',header: "Modelo", width: 100, sortable: true, locked:false, dataIndex: 'co_modelo'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_modelo'},
      ]);
      
  var storeCaracteristica = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_caracteristica.php',
		remoteSort : true,
		root: 'caracteristicas',
        totalProperty: 'total',
		idProperty: 'co_caracteristica',
        fields: [{name: 'co_caracteristica'},
		        {name: 'nb_caracteristica'},
		        {name: 'nb_modelo'},
		        {name: 'resp'}]
        });
    storeCaracteristica.setDefaultSort('co_caracteristica', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelCaracteristica = new Ext.grid.ColumnModel([
        {id:'co_caracteristica',header: "Caracteristica", width: 100, sortable: true, locked:false, dataIndex: 'co_caracteristica'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_caracteristica'},
        {header: "Modelo", width: 200, sortable: true, locked:false, dataIndex: 'nb_modelo'},      
      ]);
	
	     

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_caracteristica',
        frame: true,
		labelAlign: 'center',
        title: 'Caracteristica',
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
			title: 'Caracteristicas',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Caracteristica',
						xtype:'numberfield',
						id: 'co_caracteristica',
                        name: 'co_caracteristica',
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
						id: 'nb_caracteristica',
                        name: 'nb_caracteristica',
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
	   		xtype:'fieldset',
			id: 'frm2',
			disabled: true,
			labelAlign: 'center',
			width:640,
			buttonAlign:'center',
			//layout:'column',
			title: 'Modelo',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					//columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Codigo de Modelo',
						xtype:'numberfield',
						id: 'co_modelo',
                        name: 'co_modelo',
                        //hidden: true,
						//hideLabel: true,
                        width:160
                    }, {
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						vtype:'validos',
						id: 'nb_modelo',
						disabled:true,
                        name: 'nb_modelo',
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
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_caracteristica").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_caracteristica").getForm().getValues(false);	
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
								storeCaracteristica.baseParams = {'accion': 'insertar'};
							else
								storeCaracteristica.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_caracteristica" : "'+Ext.getCmp("co_caracteristica").getValue()+'", ';
								columnas += '"nb_caracteristica" : "'+Ext.getCmp("nb_caracteristica").getValue()+'", ';
								columnas += '"co_modelo" : "'+Ext.getCmp("co_modelo").getValue()+'"}';
							storeCaracteristica.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_caracteristica" : "'+Ext.getCmp("co_caracteristica").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_caracteristica.php"},
										callback: function () {
										if(storeCaracteristica.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCaracteristica.getAt(0).data.resp, 
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
							storeCaracteristica.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_caracteristica.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Caracteristica',
			disabled: true,
			handler: function(){
										storeCaracteristica.baseParams = {'accion': 'eliminar'};
										storeCaracteristica.load({params:{
												"condiciones": '{ "co_caracteristica" : "'+Ext.getCmp("co_caracteristica").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_caracteristica.php"},
										callback: function () {
										if(storeCaracteristica.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCaracteristica.getAt(0).data.resp,
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
				id: 'gd_caracteristica',
                store: storeCaracteristica,
                cm: colModelCaracteristica,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_caracteristica").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Caracteristica',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeCaracteristica,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

function selModelo(){
storeModelo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_modelo.php"}});
	if(!winModelo){
				winModelo = new Ext.Window({
						applyTo : 'winModelo',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selModelo',
								store: storeModelo,
								cm: colModelModelo,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Modelo',
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
										if(Ext.getCmp("gd_selModelo").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selModelo").getSelectionModel().getSelected();
											Ext.getCmp("co_modelo").setValue(record.data.co_modelo);
											Ext.getCmp("nb_modelo").setValue(record.data.nb_modelo);
											winModelo.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winModelo.hide();
								  }
						}]
				});
		}
		winModelo.show();	
}
 
	
storeCaracteristica.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_caracteristica.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_caracteristica").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
		}
		Ext.getCmp("co_caracteristica").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerModelo = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerModelo.onTriggerClick = selModelo;
		triggerModelo.applyToMarkup('co_modelo');
});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
<div id="winTpCaracteristica" class="x-hidden">
    <div class="x-window-header">Ejegir Modelo</div>
	
</div>
</body>
</html>