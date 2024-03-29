<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Nivel de Obsolescencia</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">
<link rel="stylesheet" type="text/css" href="../css/botones.css">
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
	Ext.QuickTips.init();
	Ext.form.Field.prototype.msgTarget = 'side';
	Ext.BLANK_IMAGE_URL = '../lib/ext-3.2.1/resources/images/default/s.gif';
	var nroReg;
	
/******************************************CAMPOS REQUERIDOS******************************************/     	

	var camposReq = new Array(10);

/*****************************************************************************************************/     

    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;

/******************************************INICIO**StoreNivel******************************************/     
	
  var storeNivel = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_nivel_obsolescencia.php',
		remoteSort : true,
		root: 'nivelesobsolescencia',
        baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_nivel_obsolescencia.php"},
        totalProperty: 'total',
		idProperty: 'co_nivel',
        fields: [{name: 'co_nivel'},
		        {name: 'nb_nivel'},
		        {name: 'tx_descripcion'},
		        {name: 'bo_obsoleto'},
		        {name: 'resp'}]
        });
    storeNivel.setDefaultSort('co_nivel', 'ASC');
    
/*****************************************FIN****StoreNivel*****************************************/

	var storeNuevoNivel = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_nivel_obsolescencia.php',
		remoteSort : true,
		root: 'nivelesobsolescencia',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_nivel_obsolescencia.php"},
        fields: [{name: 'co_nivel'}]
        });
	
/******************************************INICIO**colModelNivel******************************************/     
   
    var colModelNivel = new Ext.grid.ColumnModel([
        {id:'co_nivel',header: "Nivel", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_nivel'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_nivel'},
        {header: "Descripci&oacute;n", width: 338, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Cr&iacute;tico", width: 100, sortable: true, locked:false, dataIndex: 'bo_obsoleto', renderer:obsoleto},
      ]);
	
/******************************************FIN****colModelNivel******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
        id: 'frm_nivel',
        frame: true,
		labelAlign: 'center',
        title: 'Nivel de Obsolescencia',
        bodyStyle:'padding:5px 5px 5px 5px',
		width:820,
		items: [{
	   		xtype:'fieldset',
			id: 'frm1',
			disabled: true,
			labelAlign: 'center',
			width:800,
			buttonAlign:'center',
			layout:'column',
			title: 'Niveles',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'C&oacute;digo de Nivel',
						xtype:'numberfield',
						id: 'co_nivel',
                        name: 'co_nivel',
                        hidden:true,
                        hideLabel:true,
                        width:140
                    },{
                        fieldLabel: 'Nombre',
						xtype:'textfield',
						id: 'nb_nivel',
                        name: 'nb_nivel',
                        allowBlank:false,
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
                        xtype: 'radiogroup',
	            		fieldLabel: 'Obsoleto',
	            		id: 'bo_obsoleto',
		                name: 'bo_obsoleto',
			            columns: 2,
			            items: [
			                {boxLabel: 'Si', name: 'obsoleto', checked : true, inputValue: 1},
			                {boxLabel: 'No', name: 'obsoleto', inputValue: 0},
			           			]
                    }]
			},{
					layout: 'form',
					border:false,
					columnWidth:"100%",
					labelWidth:100,
					items: [{
                        fieldLabel: 'Descripci&oacute;n',
						xtype:'htmleditor',
						id: 'tx_descripcion',
                        name: 'tx_descripcion',
                        height: 140,
            			anchor: '110%',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                    }]
			}]
			},{
				width: 800,  
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
					storeNuevoNivel.load({
							callback: function () {
									if(storeNuevoNivel.getAt(0).data.co_nivel){									
										Ext.getCmp("co_nivel").setValue(storeNuevoNivel.getAt(0).data.co_nivel+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_nivel").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Nivel de Obsolescencia',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_nivel").getForm().getValues(false);	
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
								storeNivel.baseParams = {'accion': 'insertar'};
							else
								storeNivel.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_nivel" : "'+Ext.getCmp("co_nivel").getValue()+'", ';
								columnas += '"nb_nivel" : "'+Ext.getCmp("nb_nivel").getValue()+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
								columnas += '"bo_obsoleto" : "'+Ext.getCmp("bo_obsoleto").getValue()+'"}';
							storeNivel.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_nivel" : "'+Ext.getCmp("co_nivel").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_nivel_obsolescencia.php"},
										callback: function () {
										if(storeNivel.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeNivel.getAt(0).data.resp, 
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
							storeNivel.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_nivel_obsolescencia.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar nivel',
			disabled: true,
			handler: function(){
										storeNivel.baseParams = {'accion': 'eliminar'};
										storeNivel.load({params:{
												"condiciones": '{ "co_nivel" : "'+Ext.getCmp("co_nivel").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_nivel_obsolescencia.php"},
										callback: function () {
										storeNivel.baseParams = {'accion': 'refrescar'};
										if(storeNivel.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeNivel.getAt(0).data.resp,
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
							storeNivel.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_nivel_obsolescencia.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_nivel',
                store: storeNivel,
                cm: colModelNivel,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_nivel").getForm().loadRecord(rec);
                        if(rec.data.bo_obsoleto == 'SI')
								Ext.getCmp('bo_obsoleto').setValue(1);
							else
								Ext.getCmp('bo_obsoleto').setValue(0);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Niveles de Obsolescencia',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeNivel,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });


 
	
storeNivel.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_nivel_obsolescencia.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_nivel").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_nivel").focus();
		nroReg=rowIdx;
		
});

/********************************************************************************************************/

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
</body>
</html>