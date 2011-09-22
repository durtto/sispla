<html>
<head>
<title>Directorio</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">

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
	<script type="text/javascript" src="../js/combo.js"></script>
<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
 var nuevo;
 var winTpDirectorio;

Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_directorio'] = 'Codigo Directorio';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
    
 
	var storeTpDirectorio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_directorio.php',
		remoteSort : true,
		root: 'tpdirectorios',
        totalProperty: 'total',
		idProperty: 'co_tipo_directorio',
        fields: [{name: 'co_tipo_directorio'},
		        {name: 'nb_tipo_directorio'},
		        {name: 'resp'}]
        });
    storeTpDirectorio.setDefaultSort('co_tipo_directorio', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelTpDirectorio = new Ext.grid.ColumnModel([
        {id:'co_tipo_directorio',header: "Directorio", width: 100, sortable: true, locked:false, dataIndex: 'co_tipo_directorio'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_tipo_directorio'},
      ]);
      
  var storeDirectorio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_directorio.php',
		remoteSort : true,
		root: 'directorios',
        totalProperty: 'total',
		idProperty: 'co_directorio',
        fields: [{name: 'co_directorio'},
		        {name: 'nb_directorio'},
		        {name: 'nb_tipo_directorio'},
		        {name: 'nu_telefono'},
		        {name: 'resp'}]
        });
    storeDirectorio.setDefaultSort('co_directorio', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelDirectorio = new Ext.grid.ColumnModel([
        {id:'co_directorio',header: "Directorio", width: 150, sortable: true, locked:false, dataIndex: 'co_directorio'},
        {header: "Nombre", width: 150, sortable: true, locked:false, dataIndex: 'nb_directorio'},
        {header: "Tipo Directorio", width: 150, sortable: true, locked:false, dataIndex: 'nb_tipo_directorio'},
        {header: "Numero Telefonico", width: 150, sortable: true, locked:false, dataIndex: 'nu_telefono'},
      ]);
	
	     

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_directorio',
        frame: true,
		labelAlign: 'center',
        title: 'Directorios Telefonicos',
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
			title: 'Directorio',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [GetCombo('co_tipo_directorio','Tipo_directorio'),{
                        fieldLabel: 'Numero Directorio',
						xtype:'numberfield',
						id: 'co_directorio',
                        name: 'co_directorio',
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
						id: 'nb_directorio',
                        name: 'nb_directorio',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:160,
                        listeners:{
                        	change: function(t, newVal, oldVal){
                        		t.setValue(newVal.toUpperCase())
                        	}
                        }
                     },{
                     	fieldLabel: 'Numero Telefonico',
						xtype:'numberfield',
						id: 'nu_telefono',
                        name: 'nu_telefono',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
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
					Ext.getCmp("co_directorio").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_directorio").getForm().getValues(false);	
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
								storeDirectorio.baseParams = {'accion': 'insertar'};
							else
								storeDirectorio.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_directorio" : "'+Ext.getCmp("co_directorio").getValue()+'", ';
								columnas += '"nb_directorio" : "'+Ext.getCmp("nb_directorio").getValue()+'", ';
								columnas += '"co_tipo_directorio" : "'+Ext.getCmp("co_tipo_directorio").getValue()+'", ';
								columnas += '"nu_telefono" : "'+Ext.getCmp("nu_telefono").getValue()+'"}';
							storeDirectorio.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_directorio" : "'+Ext.getCmp("co_directorio").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_directorio.php"},
										callback: function () {
										if(storeDirectorio.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDirectorio.getAt(0).data.resp, 
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
							storeDirectorio.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_directorio.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Directorio',
			disabled: true,
			handler: function(){
										storeDirectorio.baseParams = {'accion': 'eliminar'};
										storeDirectorio.load({params:{
												"condiciones": '{ "co_directorio" : "'+Ext.getCmp("co_directorio").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_directorio.php"},
										callback: function () {
										if(storeDirectorio.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeDirectorio.getAt(0).data.resp,
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
				id: 'gd_directorio',
                store: storeDirectorio,
                cm: colModelDirectorio,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_directorio").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Directorios telefonicos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeDirectorio,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

function selTpDirectorio(){
storeTpDirectorio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_tipo_directorio.php"}});
	if(!winTpDirectorio){
				winTpDirectorio = new Ext.Window({
						applyTo : 'winTpDirectorio',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selTpDirectorio',
								store: storeTpDirectorio,
								cm: colModelTpDirectorio,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de TpDirectorio',
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
										if(Ext.getCmp("gd_selTpDirectorio").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selTpDirectorio").getSelectionModel().getSelected();
											Ext.getCmp("co_tipo_directorio").setValue(record.data.co_tipo_directorio);
											Ext.getCmp("nb_tipo_directorio").setValue(record.data.nb_tipo_directorio);
											winTpDirectorio.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winTpDirectorio.hide();
								  }
						}]
				});
		}
		winTpDirectorio.show();	
}
 
	
storeDirectorio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_directorio.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_directorio").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_directorio").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerTpDirectorio = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerTpDirectorio.onTriggerClick = selTpDirectorio;
		triggerTpDirectorio.applyToMarkup('nb_tipo_directorio');
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
<div id="winTpDirectorio" class="x-hidden">
    <div class="x-window-header">Ejegir Tipo Directorio</div>
	
</div>
</body>
</html>
