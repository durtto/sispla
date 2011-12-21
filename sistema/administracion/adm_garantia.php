<?php session_start(); 
//print_r($_SESSION); ?><html>
<head>
<title>Garantia</title>
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
 var winActivo;
 var ubicacion = "<?php echo $_SESSION['co_ubicacion'] ?>";

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

/******************************************INICIO**StoreActivo******************************************/     
      
  var storeActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_activo.php',
		remoteSort : true,
		root: 'activos',
        totalProperty: 'total',
		idProperty: 'co_activo',
		baseParams: {'start':0, 'limit':50, 'accion': 'refrescar', 'interfaz': 'interfaz_activo.php', ubicacion: ubicacion},
        fields: [{name: 'co_activo'},
				{name: 'nb_activo'},
				{name: 'tx_descripcion'},
				{name: 'co_sap'},
				{name: 'nu_serial'},
				{name: 'nu_etiqueta'},
				{name: 'bo_critico'},
				{name: 'bo_vulnerable'},
				{name: 'fe_incorporacion'},
				{name: 'nu_vida_util'},
				{name: 'co_activo_padre'},
				{name: 'co_estado'},
				{name: 'nb_estado'},
				{name: 'co_fabricante'},
				{name: 'nb_fabricante'},
				{name: 'co_indicador'},
				{name: 'nb_persona'},
				{name: 'co_ubicacion'},
				{name: 'nb_ubicacion'},
				{name: 'co_proceso'},
				{name: 'nb_proceso'},
				{name: 'co_proveedor'},
				{name: 'nb_proveedor'},
				{name: 'co_unidad'},
				{name: 'nb_unidad'},
				{name: 'co_nivel'},
				{name: 'nb_nivel'},
		        {name: 'resp'}]
        });
    storeActivo.setDefaultSort('co_activo', 'ASC');
    
/*****************************************FIN****StoreActivo*****************************************/


/******************************************INICIO**colModelActivo******************************************/     

    var colModelActivo = new Ext.grid.ColumnModel([
        {id:'co_activo',header: "Activo", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Nombre", width: 80, sortable: true, locked:false, dataIndex: 'nb_activo'},
     	{header: "Descripcion", width: 100, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
      	{header: "Codigo SAP", width: 100, sortable: true, locked:false, dataIndex: 'co_sap'},
      	{header: "Serial", width: 80, sortable: true, locked:false, dataIndex: 'nu_serial'},
      	{header: "Numero de Etiqueta", width: 120, sortable: true, locked:false, dataIndex: 'nu_etiqueta'},
      	{header: "Critico", width: 80, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: critico},
      	{header: "Vulnerable", width: 80, sortable: true, locked:false, dataIndex: 'bo_vulnerable', renderer: vulnerable},
      	{header: "Fecha de Incorporacion", width: 140, sortable: true, locked:false, dataIndex: 'fe_incorporacion', renderer:convFechaDMY},
      	{header: "Vida Util", width: 90, sortable: true, locked:false, dataIndex: 'nu_vida_util'},
      	{header: "Activo Padre", width: 100, sortable: true, locked:false, dataIndex: 'co_activo_padre'},
      	{header: "Estado", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_estado'},
      	{header: "Estado", width: 100, sortable: true, locked:false, dataIndex: 'nb_estado'},
      	{header: "Fabricante", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_fabricante'},
      	{header: "Fabricante", width: 100, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
      	{header: "Responsable", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_indicador'},
      	{header: "Responsable", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
      	{header: "Ubicacion", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_ubicacion'},
      	{header: "Ubicacion", width: 100, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},      
      	{header: "Proceso", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proceso'},
      	{header: "Proceso", width: 100, sortable: true, locked:false, dataIndex: 'nb_proceso'},      
      	{header: "Proveedor", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proveedor'},
      	{header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
        {header: "Unidad de Demanda", width: 125, sortable: true, hidden: true, locked:false, dataIndex: 'co_unidad'},
      	{header: "Unidad de Demanda", width: 125, sortable: true, locked:false, dataIndex: 'nb_unidad'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_nivel'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, locked:false, dataIndex: 'nb_nivel',renderer: nivel, },       
      ]);
		
/******************************************FIN****colModelActivo******************************************/     



/******************************************INICIO**StoreGarantia******************************************/     
      
  var storeGarantia = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_garantia.php',
		remoteSort : true,
		root: 'garantias',
		baseParams: {start:0, limit:50, accion: "refrescar", interfaz: "../interfaz/interfaz_garantia.php"},	
        totalProperty: 'total',
		idProperty: 'co_garantia',
        fields: [{name: 'co_garantia'},
		        {name: 'tx_descripcion'},
		        {name: 'fe_inicio'},
		        {name: 'fe_fin'},
		        {name: 'co_activo'},
		        {name: 'nb_activo'},
		        {name: 'resp'}]
        });
    storeGarantia.setDefaultSort('co_garantia', 'ASC');
    
/*****************************************FIN****StoreGarantia*****************************************/
	
	var storeNuevoGarantia = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_garantia.php',
		remoteSort : true,
		root: 'garantias',
		baseParams: {accion: "nuevo", interfaz: "../interfaz/interfaz_garantia
        });
	
/******************************************INICIO**colModelGarantia******************************************/     

    var colModelGarantia = new Ext.grid.ColumnModel([
        {id:'co_garantia',header: "Garantia", width: 100, hidden:true, sortable: true, locked:false, dataIndex: 'co_garantia'},
        {header: "Descripcion", width: 200, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
        {header: "Fecha Inicio", width: 200, sortable: true, locked:false, dataIndex: 'fe_inicio', renderer:convFechaDMY},      
        {header: "Fecha Fin", width: 400, sortable: true, locked:false, dataIndex: 'fe_fin', renderer:convFechaDMY},
		{header: "Activo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
      ]);
	
/******************************************FIN****colModelGarantia******************************************/     



/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
	
    var gridForm = new Ext.FormPanel({
        id: 'frm_garantia',
        frame: true,
		labelAlign: 'center',
        title: 'Garantia',
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
			title: 'Garantias',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero Garantia',
						xtype:'numberfield',
						id: 'co_garantia',
                        name: 'co_garantia',
                        hidden:true,
                        hideLabel:true,
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
						xtype:'combo',
						store: new Ext.data.JsonStore({
							url: '../interfaz/interfaz_garantia.php',
							root: 'garantias',
							idProperty: 'co_tipo_activo',
							baseParams: {accion:'tipo_activo', ubicacion: ubicacion},
							fields:['co_tipo_activo','nb_tipo_activo']
						  }),
						id:'co_tipo_activo',
						fieldLabel: 'Tipo Activo',
						valueField: 'co_tipo_activo',
						displayField:'nb_tipo_activo',
						typeAhead: true,
						allowBlank: false,
						mode: 'remote',
						forceSelection: true,
						triggerAction: 'all',
						emptyText:'Selecione',
						selectOnFocus:true,
						listeners:{
							select: function(cbo, rec, ind){
								Ext.getCmp('co_activo').store.baseParams = {accion:'activo', ubicacion: ubicacion, tpactivo: cbo.getValue()};								
								delete Ext.getCmp('co_activo').lastQuery;
								Ext.getCmp('co_activo').reset();
								Ext.getCmp('co_activo').enable();

							}
						}
                     },{
						xtype:'combo',
						store: new Ext.data.JsonStore({
							url: '../interfaz/interfaz_garantia.php',
							root: 'garantias',
							idProperty: 'co_activo',
							baseParams: {accion:'activo', ubicacion: ubicacion},
							fields:['co_activo','nb_activo']
						  }),
						id:'co_activo',
						disabled: true,
						fieldLabel: 'Activo',
						valueField: 'co_activo',
						displayField:'nb_activo',
						typeAhead: true,
						allowBlank: false,
						mode: 'remote',
						forceSelection: true,
						triggerAction: 'all',
						emptyText:'Selecione',
						selectOnFocus:true
         }]
                    },{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Fecha Inicio',
						xtype:'datefield',
						id: 'fe_inicio',
                        name: 'fe_inicio',
                        format:'Y-m-d', 
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Fecha Final',
						xtype:'datefield',
						id: 'fe_fin',
                        name: 'fe_fin',
                        format:'Y-m-d', 
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
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
					storeNuevoGarantia.load({
							callback: function () {
									if(storeNuevoGarantia.getAt(0).data.co_garantia){									
										Ext.getCmp("co_garantia").setValue(storeNuevoGarantia.getAt(0).data.co_garantia+1)
									};
							}
							});
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_garantia").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'Guardar Garantia',
			iconCls: 'save',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_garantia").getForm().getValues(false);	
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
								storeGarantia.baseParams = {'accion': 'insertar'};
							else
								storeGarantia.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_garantia" : "'+Ext.getCmp("co_garantia").getValue()+'", ';
								columnas += '"tx_descripcion" : "'+Ext.getCmp("tx_descripcion").getValue()+'", ';
								columnas += '"fe_inicio" : "'+convFecha(Ext.getCmp("fe_inicio").getValue())+'", ';
								columnas += '"fe_fin" : "'+convFecha(Ext.getCmp("fe_fin").getValue())+'", ';
								columnas += '"co_activo" : "'+Ext.getCmp("co_activo").getValue()+'"}';
							storeGarantia.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_garantia" : "'+Ext.getCmp("co_garantia").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_garantia.php"},
										callback: function () {
										if(storeGarantia.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeGarantia.getAt(0).data.resp, 
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
							storeGarantia.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_garantia.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar',
			iconCls: 'delete', 
			tooltip:'Eliminar Garantia',
			disabled: true,
			handler: function(){
										storeGarantia.baseParams = {'accion': 'eliminar'};
										storeGarantia.load({params:{
												"condiciones": '{ "co_garantia" : "'+Ext.getCmp("co_garantia").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:50, interfaz: "../interfaz/interfaz_garantia.php"},
										callback: function () {
										storeGarantia.baseParams = {'accion': 'refrescar'};
										if(storeGarantia.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeGarantia.getAt(0).data.resp,
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
				storeGarantia.baseParams = {'start':0, 'limit':50,'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_garantia.php'};
							}})}
			}]
			},{
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_garantia',
                store: storeGarantia,
                cm: colModelGarantia,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_garantia").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				title:'Lista de Garantia',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeGarantia,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }]
			
		}],
        
    });

			

	
storeGarantia.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_garantia.php"}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/


/****************************************************************************************************/
	
	Ext.getCmp("gd_garantia").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_garantia").focus();
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