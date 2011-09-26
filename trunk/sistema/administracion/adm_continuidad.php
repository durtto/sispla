<html>
<head>
<title>Continuidad</title>
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link rel="stylesheet" type="text/css" href="../css/loading.css">

<!--<link rel="stylesheet" type="text/css" href="lib/ext-3.2.1/resources/css/xtheme-gray.css">-->
	<!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBSs -->

    <script type="text/javascript" src="../lib/ext-3.2.1/ext-all.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/shared/extjs/App.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowEditor.js"></script>
    <!-- overrides to base library -->
    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/GridFilters.css" />
    <link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/examples/ux/gridfilters/css/RangeMenu.css" />
    <link rel="stylesheet" type="text/css" href="..lib/ext-3.2.1/examples/ux/css/Spinner.css" />
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
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/Spinner.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/SpinnerField.js"></script>

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
	Ext.BLANK_IMAGE_URL = '../lib/ext-3.2.1/resources/images/default/s.gif';
	var nroReg;
	var camposReq = new Array(10);
	camposReq['co_continuidad'] = 'Codigo Continuidad';
	
    var bd = Ext.getBody();

	var url = {
       local:  '../jsonp/grid-filter.json',  // static data file
       remote: '../jsonp/grid-filter.php'
    };
    var local = true;
    
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
      
  var storeContinuidad = new Ext.data.JsonStore({
		url: '../interfaz/interfaz_continuidad.php',
		remoteSort : true,
		root: 'continuidades',
        totalProperty: 'total',
		idProperty: 'co_continuidad',
        fields: [{name: 'co_continuidad'},
        		{name: 'bo_prioridad_rec'},
		        {name: 'fe_mtd'},
		        {name: 'fe_rto'},
		        {name: 'bo_esquema_alterno_interno'},
		        {name: 'bo_esquema_alterno_externo'},
		        {name: 'co_activo'},
		        {name: 'nb_activo'},
		        {name: 'resp'}]
        });
    storeContinuidad.setDefaultSort('co_continuidad', 'ASC');
	
	//total de espacio posible para que se vea sin barra de desplazamiento vertical 639//
    var colModelContinuidad = new Ext.grid.ColumnModel([
        {id:'co_continuidad',header: "Continuidad", width: 100, sortable: true, locked:false, dataIndex: 'co_continuidad'},
        {header: "Activo", width: 100, sortable: true, locked:false, dataIndex: 'nb_activo'},
        {header: "Prioridad", width: 100, sortable: true, locked:false, dataIndex: 'bo_prioridad_rec', renderer: prioridad},
        {header: "Fecha MTD", width: 100, sortable: true, locked:false, dataIndex: 'fe_mtd'},      
        {header: "Fecha RTO", width: 100, sortable: true, locked:false, dataIndex: 'fe_rto'},
        {header: "Esquema Interno", width: 100, sortable: true, locked:false, dataIndex: 'bo_esquema_alterno_interno', renderer: interno},
        {header: "Esquema Externo", width: 100, sortable: true, locked:false, dataIndex: 'bo_esquema_alterno_externo', renderer: externo},
		{header: "Activo", width: 100, hidden: true, sortable: true, locked:false, dataIndex: 'co_activo'},
        
      ]);
	
		 function interno(bo_esquema_alterno_interno) {
        if (bo_esquema_alterno_interno == 'SI') {
            return '<span style="color:green;">' + 'SI' + '</span>';
        } else if (bo_esquema_alterno_interno == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_esquema_alterno_interno;
    	}
		function externo(bo_esquema_alterno_externo) {
        if (bo_esquema_alterno_externo == 'SI') {
            return '<span style="color:green;">' + 'SI' + '</span>';
        } else if (bo_esquema_alterno_externo == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_esquema_alterno_externo;
    	}
    	function prioridad(bo_prioridad_rec) {
        if (bo_prioridad_rec == 'ALTA') {
            return '<span style="color:red;">' + 'ALTA' + '</span>';
        } else if (bo_prioridad_rec == 'BAJA') {
            return '<span style="color:green;">' + 'BAJA' + '</span>';
        }
        return bo_prioridad_rec;
    	}

/*
 *    Here is where we create the Form
 */

		
    var gridForm = new Ext.FormPanel({
        id: 'frm_continuidad',
        frame: true,
		labelAlign: 'center',
        title: 'Continuidad',
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
			title: 'Continuidad',
            bodyStyle:'padding:5px 5px 0px 5px',
			items:[{
					layout: 'form',
					labelWidth:140,
					columnWidth:.55,
					border:false,
					items: [{
                        fieldLabel: 'Numero',
						xtype:'numberfield',
						id: 'co_continuidad',
                        name: 'co_continuidad',
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:157
                    },GetCombo('co_activo','Activo'),{
                        fieldLabel: 'MTD',
						xtype:'datefield',
						id: 'fe_mtd',
                        name: 'fe_mtd',
                        format:'Y-m-d', 
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:157
                    },{
	            		xtype: 'checkbox',
	            		fieldLabel: 'Esquema Interno',
	            		id: 'bo_esquema_alterno_interno',
		                name: 'bo_esquema_alterno_interno',
			            columns: 2,
			            items: [
			                {boxLabel: '1', name: 'interno', inputValue: 1},
			           			]
        		}]
				},{
					layout: 'form',
					border:false,
					columnWidth:.45,
					labelWidth:100,
					items: [{
                        xtype: 'radiogroup',
	            		fieldLabel: 'Prioridad',
	            		id: 'bo_prioridad_rec',
		                name: 'bo_prioridad_rec',
			            columns: 2,
			            items: [
			                {boxLabel: 'ALTA', name: 'prioridad', checked : true, inputValue: 1},
			                {boxLabel: 'BAJA', name: 'prioridad', inputValue: 0},
			           			]
                    },{
                        fieldLabel: 'RTO',
						xtype:'datefield',
						id: 'fe_rto',
                        name: 'fe_rto',
                        format:'H:i:s', 
						style: 'text-transform:uppercase; font:normal 12px tahoma,arial,helvetica,sans-serif; !important;',
                        width:140
                    },{
	            		xtype: 'checkbox',
	            		fieldLabel: 'Esuema Externo',
	            		id: 'bo_esquema_alterno_externo',
		                name: 'bo_esquema_alterno_externo',
			            columns: 2,
			            items: [
			                {boxLabel: '1', name: 'externo', inputValue: 1},
			           			]
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
					//nroReg=storeGrupo.getCount();
					Ext.getCmp("btnGuardar").enable();
					Ext.getCmp("btnEliminar").enable();
					if(Ext.getCmp("frm1").disabled){
						Ext.getCmp("frm1").enable();
					}
					if(gridForm.getForm().isValid())  gridForm.getForm().reset();
					Ext.getCmp("co_continuidad").focus();
				}
			},{
			text: 'Guardar', 
			id: 'btnGuardar',
			tooltip:'',
			disabled: true,
			waitMsg: 'Saving...',
			handler: function(){
						var campos='';
						var camposForm = Ext.getCmp("frm_continuidad").getForm().getValues(false);	
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
								storeContinuidad.baseParams = {'accion': 'insertar'};
							else
								storeContinuidad.baseParams = {'accion': 'actualizar'};
							var columnas   = '{"co_continuidad" : "'+Ext.getCmp("co_continuidad").getValue()+'", ';
								columnas += '"bo_prioridad_rec" : "'+Ext.getCmp("bo_prioridad_rec").getValue()+'", ';
								columnas += '"fe_mtd" : "'+convFecha(Ext.getCmp("fe_mtd").getValue())+'", ';
								columnas += '"fe_rto" : "'+convFecha(Ext.getCmp("fe_rto").getValue())+'", ';
								columnas += '"bo_esquema_alterno_interno" : "'+Ext.getCmp("bo_esquema_alterno_interno").getValue()+'", ';
								columnas += '"bo_esquema_alterno_externo" : "'+Ext.getCmp("bo_esquema_alterno_externo").getValue()+'", ';
								columnas += '"co_activo" : "'+Ext.getCmp("co_activo").getValue()+'"}';
							storeContinuidad.load({params:{"columnas" : columnas,
												"condiciones": '{ "co_continuidad" : "'+Ext.getCmp("co_continuidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_continuidad.php"},
										callback: function () {
										if(storeContinuidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeContinuidad.getAt(0).data.resp, 
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
							storeContinuidad.baseParams = {'accion': 'refrescar', 'interfaz': '../interfaz/interfaz_continuidad.php'};
						}
				}
			},{
			id: 'btnEliminar',
			text: 'Eliminar', 
			tooltip:'Eliminar Continuidad',
			disabled: true,
			handler: function(){
										storeContinuidad.baseParams = {'accion': 'eliminar'};
										storeContinuidad.load({params:{
												"condiciones": '{ "co_continuidad" : "'+Ext.getCmp("co_continuidad").getValue()+'"}', 
												"nroReg":nroReg, start:0, limit:30, interfaz: "../interfaz/interfaz_continuidad.php"},
										callback: function () {
										if(storeContinuidad.getAt(0).data.resp!=true){		
											Ext.MessageBox.show({
												title: 'ERROR',
												msg: storeContinuidad.getAt(0).data.resp,
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
			width:800,
			items:[{
                xtype: 'grid',
				id: 'gd_continuidad',
                store: storeContinuidad,
                cm: colModelContinuidad,
			//plugins: [filters],
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_continuidad").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 250,
				//width:670,
				title:'Lista de Continuidad',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeContinuidad,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				//plugins: [filters]
				})
            }]
			
		}],
        
    });

			

	
storeContinuidad.load({params: { start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_continuidad.php"}});
gridForm.render('form');
	/****************************************************************************************************/
	Ext.getCmp("gd_continuidad").getSelectionModel().on('rowselect', function(sm, rowIdx, r) {		
		nuevo = false;
		//if(usrRol.indexOf('Administrador') >= 0)
		Ext.getCmp("btnGuardar").enable();
		Ext.getCmp("btnEliminar").enable();
		if(Ext.getCmp("frm1").disabled){
			Ext.getCmp("frm1").enable();
		}
		Ext.getCmp("co_continuidad").focus();
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
