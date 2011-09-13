<html>
<head>
<title>Necesidad</title>
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
 var winServicio;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_necesidad'] = 'Codigo Necesidad';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
	  var storeServicio = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_servicio.php',
		remoteSort : true,
		root: 'servicios',
        totalProperty: 'total',
		idProperty: 'co_servicio',
        fields: [{name: 'co_servicio'},
		        {name: 'nb_servicio'},
		        {name: 'resp'}]
        });
    storeServicio.setDefaultSort('co_servicio', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelServicio = new Ext.grid.ColumnModel([
        {id:'co_servicio',header: "Servicio", width: 100, sortable: true, locked:false, dataIndex: 'co_servicio'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_servicio'},
     ]);
      
  var storeNecesidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_necesidad.php',
		remoteSort : true,
		root: 'necesidades',
        totalProperty: 'total',
		idProperty: 'co_necesidad',
        fields: [{name: 'co_necesidad'},
		        {name: 'tx_necesidad_detectada'},
		        {name: 'ca_requerida'},
		        {name: 'tx_justificacion'},
		        {name: 'tx_beneficio'},
		        {name: 'fe_annio'},
		        {name: 'nb_servicio'},
		        {name: 'resp'}]
        });
    storeNecesidad.setDefaultSort('co_necesidad', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelNecesidad = new Ext.grid.ColumnModel([
        {id:'co_necesidad',header: "Necesidad", width: 100, sortable: true, locked:false, dataIndex: 'co_necesidad'},
        {header: "Necesidad Detectada", width: 200, sortable: true, locked:false, dataIndex: 'tx_necesidad_detectada'},
        {header: "Cantidad Requerida", width: 200, sortable: true, locked:false, dataIndex: 'ca_requerida'},      
        {header: "Justificacion", width: 400, sortable: true, locked:false, dataIndex: 'tx_justificacion',renderer: this.showJustificacion},
        {header: "Beneficio", width: 400, sortable: true, locked:false, dataIndex: 'tx_beneficio'},
        {header: "Annio Actual", width: 100, sortable: true, locked:false, dataIndex: 'fe_annio'},
        {header: "Servicio", width: 100, sortable: true, locked:false, dataIndex: 'nb_servicio'},
      ]);
	
		 

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_necesidad',
        frame: true,
		labelAlign: 'center',
        title: 'Necesidad',
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
			title: 'Necesidads',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Necesidad',
						xtype:'numberfield',
						id: 'co_necesidad',
                        name: 'co_necesidad',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Fecha Actual',
						xtype:'datefield',
						id: 'fe_annio',
                        name: 'fe_annio',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Cantidad Requerida',
						xtype:'textfield',
						id: 'ca_requerida',
                        name: 'ca_requerida',
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
                        fieldLabel: 'Necesidad Detectada',
						xtype:'htmleditor',
						id: 'tx_necesidad_detectada',
                        name: 'tx_necesidad_detectada',
                        height: 100,
            			anchor: '100%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Justificacion',
						xtype:'htmleditor',
						id: 'tx_justificacion',
                        name: 'tx_descripcion',
                        height: 100,
            			anchor: '100%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Beneficio',
						xtype:'htmleditor',
						id: 'tx_beneficio',
                        name: 'tx_beneficio',
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
			layout:'column',
			title: 'Servicios',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Servicio',
						xtype:'numberfield',
						id: 'co_servicio',
                        name: 'co_servicio',
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
						id: 'nb_servicio',
                        name: 'nb_servicio',
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
					Ext.getCmp("co_necesidad").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_necesidad").getForm().getValues(false);	
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
								storeNecesidad.baseParams = {'accion': 'insertar'};
							else
								storeNecesidad.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_necesidad" : "'+Ext.getCmp("co_necesidad").getValue()+'", ';
								columnas += '"tx_necesidad_detectada" : "'+Ext.getCmp("tx_necesidad_detectada").getValue()+'", ';
								columnas += '"ca_requerida" : "'+Ext.getCmp("ca_requerida").getValue()+'", ';
								columnas += '"tx_justificacion" : "'+Ext.getCmp("tx_justificacion").getValue()+'", ';
								columnas += '"tx_beneficio" : "'+Ext.getCmp("tx_beneficio").getValue()+'", ';
								columnas += '"fe_annio" : "'+Ext.getCmp("fe_annio").getValue()+'", ';
								columnas += '"co_servicio" : "'+Ext.getCmp("co_servicio").getValue()+'"}';
							storeNecesidad.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_necesidad" : "'+Ext.getCmp("co_necesidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_necesidad.php"},
										callback: function () {
										if(storeNecesidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeNecesidad.getAt(0).data.resp, 
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
							storeNecesidad.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_necesidad.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Necesidad',
			disabled: true,
			handler: function(){
										storeNecesidad.baseParams = {'accion': 'eliminar'};
										storeNecesidad.load({params:{
												"condiciones": '{ "co_necesidad" : "'+Ext.getCmp("co_necesidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_necesidad.php"},
										callback: function () {
										if(storeNecesidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeNecesidad.getAt(0).data.resp,
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
				id: 'gd_necesidad',
                store: storeNecesidad,
                cm: colModelNecesidad,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_necesidad").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Necesidad',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeNecesidad,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

			
function selServicio(){
storeServicio.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "'../interfaz/interfaz_servicio.php"}});
	if(!winServicio){
				winServicio = new Ext.Window({
						applyTo : 'winServicio',
						layout : 'fit',
						width : 550,
						height : 300,
						closeAction :'hide',
						plain : true,
						items : [{
								xtype: 'grid',
								//ds: ds,
								id: 'gd_selServicio',
								store: storeServicio,
								cm: colModelServicio,
								sm: new Ext.grid.RowSelectionModel({
									singleSelect: true
								}),
								//autoExpandColumn: 'email',
								loadMask: true,
								/*plugins: filtersCond,
								bbar: pagingBarCond,*/
								height: 200,
								title:'Lista de Servicio',
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
										if(Ext.getCmp("gd_selServicio").getSelectionModel().getSelected()){
											var record = Ext.getCmp("gd_selServicio").getSelectionModel().getSelected();
											Ext.getCmp("co_servicio").setValue(record.data.co_servicio);
											Ext.getCmp("nb_servicio").setValue(record.data.nb_servicio);
											winServicio.hide();
										}
								  }
							   },{
								  text : 'Cancelar',
								  handler : function(){
											winServicio.hide();
								  }
						}]
				});
		}
		winServicio.show();	
}
 
	
storeNecesidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_necesidad.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_necesidad").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
			Ext.getCmp("frm2").enable();
		}
		Ext.getCmp("co_necesidad").focus();
		nroReg=rowIdx;
		
});
/********************************************************************************************************/
var triggerServicio = new Ext.form.TriggerField({triggerClass : 'x-form-search-trigger'});
		triggerServicio.onTriggerClick = selServicio;
		triggerServicio.applyToMarkup('co_servicio');
		
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
<div id="winServicio" class="x-hidden">
    <div class="x-window-header">Ejegir Servicio</div>
	
</div>
</body>
</html>
