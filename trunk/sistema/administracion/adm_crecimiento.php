<html>
<head>
<title>Crecimiento</title>
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
 var winTipoActivo;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_crecimiento'] = 'Codigo Crecimiento';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	  var storeTipoActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_activo.php',
		remoteSort : true,
		root: 'tpactivos',
        totalProperty: 'total',
		idProperty: 'co_tipo_activo',
        fields: [{name: 'co_tipo_activo'},
		        {name: 'nb_tipo_activo'},
		        {name: 'co_categoria'},
		        {name: 'nb_categoria'},
		        {name: 'co_servicio'},
		        {name: 'nb_servicio'},
		        {name: 'resp'}]
        });
    storeTipoActivo.setDefaultSort('co_tipo_activo', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelTipoActivo = new Ext.grid.ColumnModel([
        {id:'co_tipo_activo',header: "Tipo Activo", width: 100, sortable: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
        {header: "co_Categoria", width: 200, sortable: true, locked:false,hidden:true, dataIndex: 'co_categoria'},      
		{header: "Categoria", width: 200, sortable: true, locked:false, dataIndex: 'nb_categoria'},
		{header: "co_Servicio", width: 100, sortable: true,hidden:true, locked:false, dataIndex: 'co_servicio'},
		{header: "Servicio", width: 100, sortable: true, locked:false, dataIndex: 'nb_servicio'},
      
		
      ]);
      
  var storeCrecimiento = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_crecimiento.php',
		remoteSort : true,
		root: 'crecimientos',
        totalProperty: 'total',
		idProperty: 'co_crecimiento',
        fields: [{name: 'co_crecimiento'},
		        {name: 'ca_demanda_futura'},
		        {name: 'fe_actual'},
		        {name: 'fe_tope_demanda'},
		        {name: 'nb_tipo_activo'},
		        {name: 'resp'}]
        });
    storeCrecimiento.setDefaultSort('co_crecimiento', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelCrecimiento = new Ext.grid.ColumnModel([
        {id:'co_crecimiento',header: "Crecimiento", width: 100, sortable: true, locked:false, dataIndex: 'co_crecimiento'},
        {header: "Demanda Futura", width: 200, sortable: true, locked:false, dataIndex: 'ca_demanda_futura'},
        {header: "Fecha actual", width: 200, sortable: true, locked:false, dataIndex: 'fe_actual'},      
        {header: "Fecha Tope", width: 400, sortable: true, locked:false, dataIndex: 'fe_tope_demanda'},
        {header: "Tipo Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},
      ]);
	
		 

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_crecimiento',
        frame: true,
		labelAlign: 'center',
        title: 'Crecimiento',
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
			title: 'Crecimientos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Crecimiento',
						xtype:'numberfield',
						id: 'co_crecimiento',
                        name: 'co_crecimiento',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Cantidad Requerida',
						xtype:'textfield',
						id: 'ca_demanda_futura',
                        name: 'ca_demanda_futura',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140,
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
                        fieldLabel: 'Fecha Actual',
						xtype:'datefield',
						id: 'fe_actual',
                        name: 'fe_actual',
                        format:'Y-m-d', 
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Fecha Tope',
						xtype:'datefield',
						id: 'fe_tope_demanda',
                        name: 'fe_tope_demanda',
                        format:'Y-m-d', 
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
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
			title: 'TipoActivos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero TipoActivo',
						xtype:'numberfield',
						id: 'co_tipo_activo',
                        name: 'co_tipo_activo',
                        disabled:true,
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
						id: 'nb_tipo_activo',
                        name: 'nb_tipo_activo',
                        disabled:true,
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
					Ext.getCmp("co_crecimiento").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_crecimiento").getForm().getValues(false);	
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
								storeCrecimiento.baseParams = {'accion': 'insertar'};
							else
								storeCrecimiento.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_crecimiento" : "'+Ext.getCmp("co_crecimiento").getValue()+'", ';
								columnas += '"ca_demanda_futura" : "'+Ext.getCmp("ca_demanda_futura").getValue()+'", ';
								columnas += '"fe_actual" : "'+convFecha(Ext.getCmp("fe_actual").getValue())+'", ';
								columnas += '"fe_tope_demanda" : "'+convFecha(Ext.getCmp("fe_tope_demanda").getValue())+'", ';
								columnas += '"co_tipo_activo" : "'+Ext.getCmp("co_tipo_activo").getValue()+'"}';
							storeCrecimiento.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_crecimiento" : "'+Ext.getCmp("co_crecimiento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_crecimiento.php"},
										callback: function () {
										if(storeCrecimiento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCrecimiento.getAt(0).data.resp, 
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
							storeCrecimiento.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_crecimiento.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Crecimiento',
			disabled: true,
			handler: function(){
										storeCrecimiento.baseParams = {'accion': 'eliminar'};
										storeCrecimiento.load({params:{
												"condiciones": '{ "co_crecimiento" : "'+Ext.getCmp("co_crecimiento").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_crecimiento.php"},
										callback: function () {
										if(storeCrecimiento.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeCrecimiento.getAt(0).data.resp,
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
				id: 'gd_crecimiento',
                store: storeCrecimiento,
                cm: colModelCrecimiento,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_crecimiento").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Crecimiento',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeCrecimiento,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

			
function selTipoActivo(){
storeTipoActivo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_tipo_activo.php"}});
	if(!winTipoActivo){
				winTipoActivo = new Ext.Window({
						applyTo : 'winTipoActivo',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selTipoActivo',
								store: storeTipoActivo,
								cm: colModelTipoActivo,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de TipoActivo',
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
										if(Ext.getCmp("gd_selTipoActivo").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selTipoActivo").getSelectionModel().getSelected();
											Ext.getCmp("co_tipo_activo").setValue(record.data.co_tipo_activo);
											Ext.getCmp("nb_tipo_activo").setValue(record.data.nb_tipo_activo);
											winTipoActivo.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winTipoActivo.hide();
								  }
						}]
				});
		}
		winTipoActivo.show();	
}
 
	
storeCrecimiento.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_crecimiento.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_crecimiento").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
		}
		Ext.getCmp("co_crecimiento").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerTipoActivo = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerTipoActivo.onTriggerClick = selTipoActivo;
		triggerTipoActivo.applyToMarkup('co_tipo_activo');
		
		//showJustificacion: function(tx_justificacion,tx_justificacion){  
			//tx_justificacion.attr = 'style="white-space:normal"';  
   		 	//return tx_justificacion;  
			//} 
});

</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

  <table  align="center">
    <tr>
      <td><div id="form" style="margin: 0 0 0 0;"></div></td>
    </tr>
  </table>
<div id="winTipoActivo" class="x-hidden">
    <div class="x-window-header">Ejegir Tipo Activo</div>
	
</div>
</body>
</html>