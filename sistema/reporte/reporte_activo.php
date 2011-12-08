<?php session_start(); 
//print_r($_SESSION); ?>
<html>
<head>
<title>Activo</title>
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
 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/adapter-extjs-highcharts.js"></script>
 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/adapter-highcharts.js"></script>
 	<!-- ENDLIBS -->
    <!-- extensions para los filtros -->
			<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/RowExpander.js"></script>
		
	<script type="text/javascript" src="../lib/Highcharts-2.1.6/js/highcharts.js"></script>
	<script type="text/javascript" src="../lib/Highcharts-2.1.6/js/highcharts.src.js"></script>
	<script type="text/javascript" src="../lib/Highcharts-2.1.6/js/jquery-1.4.js"></script>
	<!-- 1b) Optional: the exporting module -->
	<script type="text/javascript" src="../lib/Highcharts-2.1.6/js/modules/exporting.js"></script>
	<script type="text/javascript" src="../lib/Highcharts-2.1.6/js/Ext.ux.HighChart.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/Ext.ux.HighchartPanel.js"></script>


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
    var ubicacion = "<?php echo $_SESSION['co_ubicacion'] ?>";

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
				{name: 'co_nivel'},
				{name: 'nb_nivel'},
				{name: 'co_tipo_activo'},
		        {name: 'nb_tipo_activo'},
		        {name: 'resp'}]
        });
    storeActivo.setDefaultSort('co_ubicacion', 'ASC');


/*****************************************FIN****StoreActivo*****************************************/


/******************************************INICIO**colModelActivo******************************************/     

    var colModelActivo = new Ext.grid.ColumnModel([
        {id:'co_activo',header: "Activo", width: 80, hidden:true, sortable: true, locked:false, dataIndex: 'co_activo'},
        {header: "Nombre", width: 120, sortable: true, locked:false, dataIndex: 'nb_activo'},
     	{header: "Descripci&oacute;n", width: 190, sortable: true, locked:false, dataIndex: 'tx_descripcion'},
      	{header: "C&oacute;digo SAP", width: 120, sortable: true, locked:false, dataIndex: 'co_sap'},
      	{header: "Serial", width: 120, sortable: true, locked:false, dataIndex: 'nu_serial'},
      	{header: "N&uacute;mero de Etiqueta", width: 150, sortable: true, locked:false, dataIndex: 'nu_etiqueta'},
      	{header: "Cr&iacute;tico", width: 100, sortable: true, locked:false, dataIndex: 'bo_critico', renderer: critico},
      	{header: "Vulnerable", width: 100, sortable: true, locked:false, dataIndex: 'bo_vulnerable', renderer: vulnerable},
      	{header: "Fecha de Incorporaci&oacute;n", width: 160, sortable: true, locked:false, dataIndex: 'fe_incorporacion'},
      	{header: "Vida &Uacute;til", width: 100, sortable: true, locked:false, dataIndex: 'nu_vida_util'},
      	{header: "Activo Padre", width: 100, sortable: true, locked:false, dataIndex: 'co_activo_padre'},
      	{header: "Estado", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_estado'},
      	{header: "Estado", width: 100, sortable: true, locked:false, dataIndex: 'nb_estado'},
      	{header: "Fabricante1", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_fabricante'},
      	{header: "Fabricante", width: 100, sortable: true, locked:false, dataIndex: 'nb_fabricante'},
      	{header: "Responsable", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_indicador'},
      	{header: "Responsable", width: 100, sortable: true, locked:false, dataIndex: 'nb_persona'},
      	{header: "Ubicaci&oacute;n", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_ubicacion'},
      	{header: "Ubicaci&oacute;n", width: 100, sortable: true, locked:false, dataIndex: 'nb_ubicacion'},      
      	{header: "Proceso", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proceso'},
      	{header: "Proceso", width: 100, sortable: true, locked:false, dataIndex: 'nb_proceso'},      
      	{header: "Proveedor", width: 100, sortable: true, hidden: true, locked:false, dataIndex: 'co_proveedor'},
      	{header: "Proveedor", width: 100, sortable: true, locked:false, dataIndex: 'nb_proveedor'},      
        {header: "Unidad de Demanda", width: 125, sortable: true, hidden: true, locked:false, dataIndex: 'co_unidad'},
      	{header: "Unidad de Demanda", width: 140, sortable: true, locked:false, dataIndex: 'nb_unidad'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_nivel'},
      	{header: "Nivel de Obsolescencia", width: 140, sortable: true, locked:false, dataIndex: 'nb_nivel',renderer: nivel, },       
        {header: "C&oacute;digo Tipo de Activo", width: 140, sortable: true, hidden: true, locked:false, dataIndex: 'co_tipo_activo'},
        {header: "Tipo de Activo", width: 110, sortable: true, locked:false, dataIndex: 'nb_tipo_activo'},

      ]);

/******************************************FIN****colModelActivo******************************************/     

//--------------------------------------------------------
	var panelGrafica = new Ext.Panel({
		id: 'panelGrafica',
		width: 900,
		height: 400,
		layout: 'fit',
		renderTo:'container'
	});
	//--------------------------------------------------------
	function crearGraficaTorta(array, titulo, subtitulo) {
		var now = new Date();
		chart = new Highcharts.Chart({
			colors: ['#4572A7','#AA4643','#89A54E','#80699B','#3D96AE','#DB843D','#92A8CD','#A47D7C','#B5CA92','#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
			chart: {
				renderTo: 'panelGrafica',
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			//labelFormatter:"if (this.percentage >= 5) return this.percentage.toFixed(1)+'%'",
			//tooltipFormatter:"return '<b>'+this.point.name+':</b> '+this.y+' ('+this.percentage.toFixed(1)+'%)'",

			title: {
				text: titulo
			},
			subtitle: {
				text: subtitulo
			},
			credits: {
				//text: 'http://orimat100/gesdoc '+now.format("d/m/Y H:i:s"),
				href: ''
			},
			tooltip: {
				formatter: function () {
					return /*'<b>' + this.point.name + '</b>: ' +*/ this.percentage.toFixed(1) + '%';
				}
			},
			plotOptions: {
				pie: {
					stacking:'percent',
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						formatter: function () {
							return /*'<b>' + this.point.name + '</b>: ' + */this.percentage.toFixed(1) + '%';
						}
					},
					showInLegend: true
				}
			},
			exporting: {
				url: 'http://167.175.215.199/exporting-server/index.php'
			},
			series: [{
				type: 'pie',
				name: 'Browser share',
				data: array
			}]
		});
	}
	//--------------------------------------------------------
	function crearGraficaBarra(array, titulo, subtitulo) {
		var now = new Date();
		chart = new Highcharts.Chart({
			colors: ['#4572A7','#AA4643','#89A54E','#80699B','#3D96AE','#DB843D','#92A8CD','#A47D7C','#B5CA92','#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
			chart: {
				renderTo: 'panelGrafica',
				defaultSeriesType: 'column'
			},
			title: {
				text: titulo
			},
			subtitle: {
				text: subtitulo
			},
			xAxis: {
				categories: [
				' ']
			},
			yAxis: {
				min: 0,
				allowDecimals: false,
				title: {
					text: 'Cantidad (Nro)'
				}
			},
			credits: {
				//text: 'http://orimat100/gesdoc '+now.format("d/m/Y H:i:s"),
				href: ''
			},
			tooltip: {
				formatter: function () {
					return '' + this.series.name + ': ' + this.y + '';
				}
			},
			exporting: {
				url: 'http://167.175.215.199/exporting-server/index.php'
			},
			plotOptions: {
				column: {
					dataLabels: {
						color: '#000000',
						enabled: true
					},
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: array
		});
	}
	//--------------------------------------------------------
	function crearGraficaLinea(array, titulo, subtitulo) {
		var now = new Date();
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'panelGrafica',
				defaultSeriesType: 'line'
			},
			title: {
				text: titulo
			},
			subtitle: {
				text: subtitulo
			},
			xAxis: {
         type: 'datetime',
         dateTimeLabelFormats: { 
			day: '%e/%b',
			week: '%e/%b',
            month: '%b-%Y',
            year: '%Y'
         }
      },
			yAxis: {
				min: 0,
				allowDecimals: false,
				title: {
					text: 'Cantidad (Nro)'
				}
			},
			credits: {
				//text: 'http://orimat100/gesdoc '+now.format("d/m/Y H:i:s"),
				href: ''
			},
			tooltip: {
				formatter: function () {
					return '' + this.series.name + ': ' + this.y + '';
				}
			},
			exporting: {
				url: '../lib/Highcharts-2.1.6/exporting-server/index.php'
			},
			plotOptions: {
         line: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: false
         }
      },
			series: array
		});
	}
	//--------------------------------------------------------
	function crearGrafica(tipoGrafica, titulo, subtitulo){
		Ext.Ajax.request({
			url: '../clases/generador_grafica.php',
			success: function(response){
				array = Ext.decode(response.responseText);
				switch(tipoGrafica){
					case 1:
						crearGraficaLinea(array,titulo,subtitulo);
					break;
					case 2:
						crearGraficaBarra(array,titulo,subtitulo);
					break;
					case 3:
						crearGraficaTorta(array,titulo,subtitulo);
					break;
				}
			},
			params:{
				tipo:tipoGrafica,
				base:   Ext.getCmp('base_grafica').getValue(),
				estado:   Ext.getCmp('estado_grafica').getValue(),
			},
			failure: function(){
				console.log('failure');
			}
		});
	}
	//--------------------------------------------------------
	var chart = new Highcharts.Chart({
		chart: {
			renderTo: 'panelGrafica',
			defaultSeriesType: 'column'
		},
		title: {
			text: ''
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
			title: {
				text: null
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Cantidad (Nro)',
				align: 'high'
			}
		},
		tooltip: {
			formatter: function () {
				return '' + this.series.name + ': ' + this.y + ' millions';
			}
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		/*legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -5,
			y: -5,
			floating: true,
			borderWidth: 1,
			backgroundColor: '#FFFFFF',
			shadow: true
		},*/
		credits: {
			enabled: false
		},
		series: [/*{
			name: 'Year 1800',
			data: [20,50,10,80,45]
		}*/]
	});
	//--------------------------------------------------------
	store=new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'Obsolescencia'],
					[2, 'Tipo Activo'],
					[3, 'Ubicacion'],
					[4, 'Capacidad'],
					[5, 'Obsolescencia - Tipo de Activo'],
					[6, 'Obsolescencia - Capacidad'],
					[7, 'Obsolescencia - Ubicacion'],
					[8, 'Tipo de Activo - Ubicacion'],
					[9, 'Tipo de Activo - Capacidad'],
					[10, 'Ubicacion - Capacidad']]
				});
	var DataLineal = 	[[1, 'Diario'],
						[2, 'Semanal'],
						[3, 'Mensual']];
	var DataBC = [[1, 'Obsolescencia'],
					[2, 'Tipo Activo'],
					[3, 'Ubicacion'],
					[4, 'Capacidad'],
					[5, 'Obsolescencia - Tipo de Activo'],
					[6, 'Obsolescencia - Capacidad'],
					[7, 'Obsolescencia - Ubicacion'],
					[8, 'Tipo de Activo - Ubicacion'],
					[9, 'Tipo de Activo - Capacidad'],
					[10, 'Ubicacion - Capacidad']];
	var storeEstado = new Ext.data.JsonStore({
						fields: ['co_estado', 'nb_estado_graf'],
						root: 'data',
						url: '../php/combos_dinamicos.php?accion=cmb_estado_graf',
						baseParams:{tipo_estado:1}
					});
	//--------------------------------------------------------
	
/******************************************INICIO DE LA CREACION DEL PANEL CENTRAL*******************************************/
		
    var gridForm = new Ext.FormPanel({
		id:'srv_ticket',
		labelWidth: 100,
		frame:true,
		title: '.: Reporte de Activos :.',
		bodyStyle:'padding:5px',
		width: 960,
		layout: 'fit',
		items: [{
				xtype:'fieldset',	
				autoHeight:true,
				border: false,
				items: [{			
						xtype: 'tabpanel',
						id: 'tabPanel',
						resizeTabs: true,
						enableTabScroll: true,
						deferredRender: false,
						layoutOnTabChange: true,
						activeTab: 0,
						//layout: 'fit',
						bodyStyle:'padding:5px; background-color: #f1f1f1;',
						items: [{
								title: 'Almacenamiento',
								id: 'tabalmacenamiento',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica',
				anchor: '40%',
				name: 'base_grafica',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									},{
								title: 'Transporte',
								id: 'tabtransporte',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica1',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica1',
				anchor: '40%',
				name: 'base_grafica1',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica1',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo1',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									},{
								title: 'Procesamiento',
								id: 'tabprocesamiento',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica2',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica2',
				anchor: '40%',
				name: 'base_grafica',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica2',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo2',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activos").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									},{
								title: 'Impresi&oacute;n',
								id: 'tabimpresion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica3',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica3',
				anchor: '40%',
				name: 'base_grafica',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica3',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo3',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									},{
								title: 'Visualizaci&oacute;n',
								id: 'tabvisualizacion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica4',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica4',
				anchor: '40%',
				name: 'base_grafica',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica4',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo4',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									},{
								title: 'Autonom&iacute;a Energ.',
								id: 'tabautonomia',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica5',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica5',
				anchor: '40%',
				name: 'base_grafica',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica5',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo5',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									},{
								title: 'Monitoreo',
								id: 'tabmonitoreo',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica6',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica6',
				anchor: '40%',
				name: 'base_grafica',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica6',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo6',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									},{
								title: 'Adq. de Datos',
								id: 'tabadquisicion',
								hideMode: 'offsets', 
								autoHeight:true,		
								bodyStyle:'padding: 0px 0px 1px 0px'	,						
								items:[{
			xtype: 'fieldset',
			title: 'Datos de Entrada',
			collapsible:false,
			border: true,
			autoHeight:true, 
			bodyStyle:'padding:0px',
			items:[{
				xtype: 'combo',
				id: 'tipo_grafica7',
				anchor: '40%',
				name: 'nb_distrito',
				fieldLabel: 'Tipo de Gr&aacute;fica',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store: new Ext.data.ArrayStore({
					id: 0,
					fields: ['id','valor'],
					data: 	[[1, 'LINEAL'],
							[2, 'BARRAS'],
							[3, 'CIRCULAR']]
				}),
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').disable();
								Ext.getCmp('estado_grafica').disable();
								store.removeAll();
								store.loadData(DataLineal);
							}
							else{
								Ext.getCmp('base_grafica').clearValue();
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('base_grafica').enable();
								Ext.getCmp('estado_grafica').enable();
								store.removeAll();
								store.loadData(DataBC);
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'base_grafica7',
				anchor: '40%',
				name: 'base_grafica',
				fieldLabel: 'Dato Base',
				//hiddenName: 'nb_distrito',
				valueField: 'id',
				store:store,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'valor',
				width: 120,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false,
				listeners: {
					select: {
						fn: function(combo,record,index){
							if(index==0){
								Ext.getCmp('estado_grafica').clearValue();
								Ext.getCmp('estado_grafica').disable();
							}
							else{
								Ext.getCmp('estado_grafica').enable();
							}
							if(index==5){
								storeEstado.load({params:{tipo_estado:2}});
							}
							else{
								storeEstado.load({params:{tipo_estado:1}});
							}
						}
					}
				}
			},{
				xtype: 'combo',
				id: 'estado_grafica7',
				anchor: '30%',
				name: 'estado_grafica',
				fieldLabel: 'Estado',
				//hiddenName: 'nb_distrito',
				valueField: 'co_estado',
				store: storeEstado,
				mode: 'local',
				triggerAction: 'all',
				typeAhead: true,
				displayField: 'nb_estado_graf',
				width: 120,
				listWidth: 250,
				tabIndex: 10,
				selectOnFocus: true,
				emptyText: 'Seleccione...',
				forceSelection: true,
				editable: false,
				allowBlank: false
			},{
                xtype: 'button',
                text: 'Graficar',
                handler: function(){
					tipoGrafica=Ext.getCmp('tipo_grafica').getValue();
					cad='';
					if(Ext.getCmp('base_grafica').getValue()!=1){
						cad=Ext.getCmp('estado_grafica').getRawValue();
						if(cad=='""')
							cad='Recibidos'
					}				
					titulo='Documentos '+cad+' Por '+Ext.getCmp('base_grafica').getRawValue();
					if(tipoGrafica==1){
						titulo='Documentos por Mes';
					}
					subtitulo='Grafica '+Ext.getCmp('estado_grafica').getRawValue()+' De '+Ext.getCmp('base_grafica').getRawValue();
					crearGrafica(tipoGrafica, titulo, subtitulo);
				}
            }]
		},panelGrafica,{
			width:900,
			items:[{
                xtype: 'grid',
				id: 'gd_activo7',
                store: storeActivo,
                cm: colModelActivo,
                stripeRows: true,
                iconCls: 'icon-grid',
                sm: new Ext.grid.RowSelectionModel({
                    singleSelect: true,
                    listeners: {
                        rowselect: function(sm, row, rec) {
                            Ext.getCmp("frm_activo").getForm().loadRecord(rec);
                        }
                        
                    }
                }),
                height: 400,
				title:'Lista de Activos',
                border: true,
                listeners: {
                    viewready: function(g) {
                                          }
                },
				bbar: new Ext.PagingToolbar({
				store: storeActivo,
				pageSize: 50,
				displayInfo: true,
				displayMsg: 'Mostrando registros {0} - {1} de {2}',
				emptyMsg: "No hay registros que mostrar",
				})
            }],
        
    }]
									}]
							}]
			}],
		});


storeActivo.load({params: {start: 0, limit: 50, accion:"refrescar", interfaz: "../interfaz/interfaz_activo.php", ubicacion: ubicacion}});
gridForm.render('form');

/******************************************FIN DE LA CREACION DEL PANEL CENTRAL*******************************************/

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
  		<tr>
  		<td><div id="container"></div></td>
    </tr>
  </table>
</body>
</html>