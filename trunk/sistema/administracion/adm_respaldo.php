<html>
<head>
<title>Respaldo</title>
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
<script type="text/javascript">
/*!
 * Ext JS Library 3.2.1
 * Copyright(c) 2006-2010 Ext JS, Inc.
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
 var nuevo;
 var winActivo;
  var winTpRespaldo;
Ext.onReady(function(){
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_respaldo'] = 'Codigo Respaldo';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
    var storeTpRespaldo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_tipo_respaldo.php',
		remoteSort : true,
		root: 'tprespaldos',
        totalProperty: 'total',
		idProperty: 'co_tipo_respaldo',
        fields: [{name: 'co_tipo_respaldo'},
		        {name: 'nb_tipo_respaldo'},
		        {name: 'resp'}]
        });
    storeTpRespaldo.setDefaultSort('co_tipo_respaldo', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelTpRespaldo = new Ext.grid.ColumnModel([
        {id:'co_tipo_respaldo',header: "Respaldo", width: 100, sortable: true, locked:false, dataIndex: 'co_tipo_respaldo'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_tipo_respaldo'},
      ]);
	  var storeActivo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_activo.php',
		remoteSort : true,
		root: 'activos',
        totalProperty: 'total',
		idProperty: 'co_activo',
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
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelActivo = new Ext.grid.ColumnModel([
        {id:'co_activo',header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Nombre", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
     	{header: "Descripcion", width: 100, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
      	{header: "Codigo SAP", width: 100, sortable: true, locked:false, dataIndex: 'co_sap'},
      	{header: "Numero de serial", width: 100, sortable: true, locked:false, dataIndex: 'nu_serial'},
      	{header: "Numero de etiqueta", width: 100, sortable: true, locked:false, dataIndex: 'nu_etiqueta'},
      	{header: "Critico", width: 100, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: acritico},
      	{header: "Vulnerable", width: 100, sortable: true, locked:false, dataIndex: 'bo_vulnerable', renderer: vulnerable},
      	{header: "Fecha de Incorporacion", width: 100, sortable: true, locked:false, dataIndex: 'fe_incorporacion'},
      	{header: "Vida Util", width: 100, sortable: true, locked:false, dataIndex: 'nu_vida_util'},
      	{header: "Activo Padre", width: 100, sortable: true, locked:false, dataIndex: 'co_activo_padre'},
      	{header: "Estado", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_estado'},
      	{header: "Estado", width: 100, sortable: true, locked:false, dataIndex: 'nb_estado'},
      	{header: "Fabricante", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_fabricante'},
      	{header: "Fabricante", width: 100, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
      	{header: "Persona", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_indicador'},
      	{header: "Persona", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
      	{header: "Ubicacion", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_ubicacion'},
      	{header: "Ubicacion", width: 100, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},      
      	{header: "Proceso", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proceso'},
      	{header: "Proceso", width: 100, sortable: true, locked:false, dataIndex: 'nb_proceso'},      
      	{header: "Proveedor", width: 100, sortable: true, hidden: false, locked:false, dataIndex: 'co_proveedor'},
      	{header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
        {header: "Unidad de Demanda", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_unidad'},
      	{header: "Unidad de Demanda", width: 100, sortable: true, locked:false, dataIndex: 'nb_unidad'},
      	{header: "Nivel de Obsolescencia", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_nivel'},
      	{header: "Nivel de Obsolescencia", width: 100, sortable: true, locked:false, dataIndex: 'nb_nivel'},       
      ]);
	function vulnerable(bo_vulnerable) {
        if (bo_vulnerable == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_vulnerable == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_vulnerable;
    	}
	function acritico(bo_critico) {
        if (bo_critico == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_critico == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_critico;
    	}
      
  var storeRespaldo = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_respaldo.php',
		remoteSort : true,
		root: 'respaldos',
        totalProperty: 'total',
		idProperty: 'co_respaldo',
        fields: [{name: 'co_respaldo'},
        		{name: 'nu_veces_al_dia'},
        		{name: 'tx_dias_semana'},
		        {name: 'nu_tiempo_retencion_data'},
		        {name: 'tx_descripcion_data'},
		        {name: 'fe_ultimo_respaldo'},
		        {name: 'tx_ubicacion_logica_fisica'},
		        {name: 'co_activo'},
		        {name: 'nb_activo'},
		        {name: 'co_tipo_respaldo'},
		        {name: 'nb_tipo_respaldo'},
		        {name: 'resp'}]
        });
    storeRespaldo.setDefaultSort('co_respaldo', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelRespaldo = new Ext.grid.ColumnModel([
        {id:'co_respaldo',header: "Respaldo", width: 100, sortable: true, locked:false, dataIndex: 'co_respaldo'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
        {header: "Veces por dia", width: 100, sortable: true, locked:false, dataIndex: 'nu_veces_al_dia'},
        {header: "Dias de semana", width: 100, sortable: true, locked:false, dataIndex: 'tx_dias_semana'},      
        {header: "Retencion de Data", width: 100, sortable: true, locked:false, dataIndex: 'nu_tiempo_retencion_data'},
        {header: "Descripcion", width: 100, sortable: true, locked:false, dataIndex: 'tx_descripcion_data'},
        {header: "Ultimo Respaldo", width: 100, sortable: true, locked:false, dataIndex: 'fe_ultimo_respaldo'},
        {header: "Ubicacion Fisica", width: 100, sortable: true, locked:false, dataIndex: 'tx_ubicacion_logica_fisica'},        
		{header: "Activo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Respaldo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_tipo_respaldo'},
        {header: "Tipo Respaldo", width: 100, hidden: false, sortable: true, locked:false, dataIndex: 'nb_tipo_respaldo'},

      ]);
	
/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_respaldo',
        frame: true,
		labelAlign: 'center',
        title: 'Respaldo',
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
			title: 'Respaldos',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [GetCombo('co_activo', 'Activo'),{
                        fieldLabel: 'Numero',
						xtype:'numberfield',
						id: 'co_respaldo',
                        name: 'co_respaldo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },GetCombo('co_tipo_respaldo', 'Tipo respaldo'),{
                        fieldLabel: 'Dias de la Semana',
						xtype:'textfield',
						id: 'tx_dias_semana',
                        name: 'tx_dias_semana',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Ultimo Respaldo',
						xtype:'datefield',
						id: 'fe_ultimo_respaldo',
                        name: 'fe_ultimo_respaldo',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    }]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        fieldLabel: 'Veces al dia',
						xtype:'numberfield',
						id: 'nu_veces_al_dia',
                        name: 'nu_veces_al_dia',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Retencion de Data',
						xtype:'numberfield',
						id: 'nu_tiempo_retencion_data',
                        name: 'nu_tiempo_retencion_data',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
                        fieldLabel: 'Ubicacion Fisica del Respaldo',
						xtype:'textfield',
						id: 'tx_ubicacion_logica_fisica',
                        name: 'tx_ubicacion_logica_fisica',
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
						id: 'tx_descripcion_data',
                        name: 'tx_descripcion_data',
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
					Ext.getCmp("co_respaldo").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_respaldo").getForm().getValues(false);	
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
								storeRespaldo.baseParams = {'accion': 'insertar'};
							else
								storeRespaldo.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_respaldo" : "'+Ext.getCmp("co_respaldo").getValue()+'", ';
								columnas += '"nu_veces_al_dia" : "'+Ext.getCmp("nu_veces_al_dia").getValue()+'", ';
								columnas += '"tx_dias_semana" : "'+Ext.getCmp("tx_dias_semana").getValue()+'", ';
								columnas += '"tx_descripcion_data" : "'+Ext.getCmp("tx_descripcion_data").getValue()+'", ';
								columnas += '"nu_tiempo_retencion_data" : "'+Ext.getCmp("nu_tiempo_retencion_data").getValue()+'", ';
								columnas += '"fe_ultimo_respaldo" : "'+convFecha(Ext.getCmp("fe_ultimo_respaldo").getValue())+'", ';
								columnas += '"tx_ubicacion_logica_fisica" : "'+Ext.getCmp("tx_ubicacion_logica_fisica").getValue()+'", ';
								columnas += '"co_activo" : "'+Ext.getCmp("co_activo").getValue()+'", ';
								columnas += '"co_tipo_respaldo" : "'+Ext.getCmp("co_tipo_respaldo").getValue()+'"}';
							storeRespaldo.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_respaldo" : "'+Ext.getCmp("co_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_respaldo.php"},
										callback: function () {
										if(storeRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRespaldo.getAt(0).data.resp, 
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
							storeRespaldo.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_respaldo.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Respaldo',
			disabled: true,
			handler: function(){
										storeRespaldo.baseParams = {'accion': 'eliminar'};
										storeRespaldo.load({params:{
												"condiciones": '{ "co_respaldo" : "'+Ext.getCmp("co_respaldo").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_respaldo.php"},
										callback: function () {
										if(storeRespaldo.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeRespaldo.getAt(0).data.resp,
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
				id: 'gd_respaldo',
                store: storeRespaldo,
                cm: colModelRespaldo,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_respaldo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Respaldo',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeRespaldo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });
	
storeRespaldo.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_respaldo.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_respaldo").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_respaldo").focus();
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
