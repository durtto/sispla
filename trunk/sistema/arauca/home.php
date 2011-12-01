<?php session_start(); ?>
<html>
<head>
<title>:: Arauca ::</title>
<link rel="shortcut icon" href="../imagenes/icon.png"> 
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="../lib/ext-3.2.1/resources/css/xtheme-gray2.css">
<link href="../css/main.css" rel="stylesheet" type="text/css">

	<!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="../lib/ext-3.2.1/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->

    <script type="text/javascript" src="../lib/ext-3.2.1/ext-all.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
	<script type="text/javascript" src="../lib/ext-3.2.1/examples/ux/XmlTreeLoader.js"></script>



<script type="text/javascript">

function cerrar_sesion() 
{
	Ext.MessageBox.confirm('CONFIRMAR','� Realmente desea cerrar la Sesion de Usuario ?',
	function(btn)
	{
		if(btn == 'yes')
		{
			document.location.href = 'fin_sesion.php';
			
	 	}  
	}
	);
 
}

Ext.app.BookLoader = Ext.extend(Ext.ux.tree.XmlTreeLoader, {
    processAttributes : function(attr){
        if(attr.first){ // is it an author node?

            // Set the node text that will show in the tree since our raw data does not include a text attribute:
            attr.text = attr.first;

            // Author icon, using the gender flag to choose a specific icon:
            attr.iconCls = 'author-' + attr.gender;

            // Override these values for our folder nodes because we are loading all data at once.  If we were
            // loading each node asynchronously (the default) we would not want to do this:
            attr.loaded = true;
            attr.expanded = false;
        }
        else if(attr.title){ // is it a book node?

            // Set the node text that will show in the tree since our raw data does not include a text attribute:
            attr.text = attr.title ;

            // Book icon:
            attr.iconCls = 'book';

            // Tell the tree this is a leaf node.  This could also be passed as an attribute in the original XML,
            // but this example demonstrates that you can control this even when you cannot dictate the format of
            // the incoming source XML:
            attr.leaf = true;
        }
    }
});

Ext.onReady(function(){
Ext.BLANK_IMAGE_URL = '../lib/ext-3.2.1/resources/images/default/s.gif';


    var index = 0;
    var n=0;
	
       var tabs = new Ext.TabPanel({
        id:'tabs',
        resizeTabs:true, // turn on tab resizing
		activeTab: 'Inicio',
        minTabWidth: 115,
        tabWidth:125,
		height:'auto',
		//autoHeight:true,
		//enableTabScroll:true,
      // defaults: {autoScroll:true},
        //plugins: new Ext.ux.TabCloseMenu()
    });
   
   function addTab(nom,pagina){
   var open =  !Ext.getCmp("tabs").getItem(nom);  

		if(open)
		{
			tabs.add({
				title: nom,
				id:nom,
				name:nom,
				autoScroll:true,
				autoHeight:true,
				hideMode: 'offsets',		
				iconCls: 'tabs',
				html: '<iframe id="'+nom+'" name="'+nom+'" src="'+pagina+'" width="100%"  height="95%" frameBorder="0" marginHeight="10" marginWidth="10"></iframe>',
				closable:true
			}).show();
		}else{
		tab =  Ext.getCmp("tabs").getItem(nom); 
		tab.show();
		}
    }

   addTab('Inicio','pantalla_principal.php');
   
       var viewport = new Ext.Viewport({
            layout:'border',
            items:[{
                region:'west',
                id:'west-panel',
                title:'Men&uacute; de Usuario',
                split:true,
				width: 200,
				height: 600,
                minSize: 175,
                maxSize: 400,
                collapsible: true,
                margins:'80 0 0 0',
                cmargins:'80 0 0 0',
                layout:'accordion',
                layoutConfig:{
                    animate:true
                },
                items: [{
                    title: 'Continuidad Operativa',
                    xtype: 'treepanel',
           			id: 'tree-panel1',
            		region: 'center',
					height: 600,
            		margins: '80 0 0 0',
					cmargins:'80 0 0 0',
            		autoScroll: true,
	        		rootVisible: false,
	        		root: new Ext.tree.AsyncTreeNode(),

            // Our custom TreeLoader:
	        loader: new Ext.app.BookLoader({
	            dataUrl:'menu.xml'
	        }),

	        listeners: {
	            'render': function(tp){
                    tp.getSelectionModel().on('selectionchange', function(tree, node){
						if(node.attributes.titulo!='')
						addTab(node.attributes.titulo,node.attributes.url);
                        //var el = Ext.getCmp('details-panel').body;
	                   
                    })
	            }
	        }
                },{
            		title:'Reportes',
            		xtype: 'treepanel',
           			id: 'tree-panel2',
            		region: 'center',
					height: 600,
            		margins: '80 0 0 0',
					cmargins:'80 0 0 0',
            		autoScroll: true,
	        		rootVisible: false,
	        		root: new Ext.tree.AsyncTreeNode(),

            // Our custom TreeLoader:
	        loader: new Ext.app.BookLoader({
	            dataUrl:'menu1.xml'
	        }),

	        listeners: {
	            'render': function(tp){
                    tp.getSelectionModel().on('selectionchange', function(tree, node){
						if(node.attributes.titulo!='')
						addTab(node.attributes.titulo,node.attributes.url);
                        //var el = Ext.getCmp('details-panel').body;
	                   
                    })
	            }
	        }
	        },{
            		title:'Base Documental',
            		xtype: 'treepanel',
           			id: 'tree-panel3',
            		region: 'center',
					height: 600,
            		margins: '80 0 0 0',
					cmargins:'80 0 0 0',
            		autoScroll: true,
	        		rootVisible: false,
	        		root: new Ext.tree.AsyncTreeNode(),

            // Our custom TreeLoader:
	        loader: new Ext.app.BookLoader({
	            dataUrl:'menu2.xml'
	        }),

	        listeners: {
	            'render': function(tp){
                    tp.getSelectionModel().on('selectionchange', function(tree, node){
						if(node.attributes.titulo!='')
						addTab(node.attributes.titulo,node.attributes.url);
                        //var el = Ext.getCmp('details-panel').body;
	                   
                    })
	            }
	        }
	     },{
            		title:'Administraci&oacute;n',
            		xtype: 'treepanel',
           			id: 'tree-panel4',
            		region: 'center',
					height: 600,
            		margins: '80 0 0 0',
					cmargins:'80 0 0 0',
            		autoScroll: true,
	        		rootVisible: false,
	        		root: new Ext.tree.AsyncTreeNode(),

            // Our custom TreeLoader:
	        loader: new Ext.app.BookLoader({
	            dataUrl:'menu3.xml'
	        }),

	        listeners: {
	            'render': function(tp){
                    tp.getSelectionModel().on('selectionchange', function(tree, node){
						if(node.attributes.titulo!='')
						addTab(node.attributes.titulo,node.attributes.url);
                        //var el = Ext.getCmp('details-panel').body;
	                   
                    })
	            }
	        }
	      },{
            	title:'Ayuda en L&iacute;nea',
            	xtype: 'treepanel',
           		id: 'tree-panel5',
            	region: 'center',
				height: 600,
            	margins: '80 0 0 0',
				cmargins:'80 0 0 0',
            	autoScroll: true,
	        	rootVisible: false,
	        	root: new Ext.tree.AsyncTreeNode(),

            // Our custom TreeLoader:
	        loader: new Ext.app.BookLoader({
	            dataUrl:'menu4.xml'
	        }),

	        listeners: {
	            'render': function(tp){
                    tp.getSelectionModel().on('selectionchange', function(tree, node){
						if(node.attributes.titulo!='')
						addTab(node.attributes.titulo,node.attributes.url);
                        //var el = Ext.getCmp('details-panel').body;
	                   
                    })
	            }
	        }
	       }]
            },{
                region:'east',
                id:'east-panel',
                title:'Datos de Sesi&oacute;n',
                split:true,
                width: 200,
				height: 740,
                minSize: 175,
                maxSize: 400,
                collapsible: true,
                margins:'80 0 0 0',
                cmargins:'80 0 0 0',
                //layout:'accordion',
                layoutConfig:{
                    animate:true
                },
				//html:'',
				items: [ {contentEl:'session'}
				]
				},{
                region:'center',
                margins:'80 0 0 0',
				 cmargins:'80 0 0 0',
                //layout:'column',
				//width: 200,
				//height: 740,
				//autoHeight:true,
                //autoScroll:true,
				items:[tabs]
            }]
        });
    });
	</script>
<script>
	var warning = 20;
	var timeout = 600;
	var current = 0;
//	getSecs();
</script>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" onclick="current = 0;">

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" ><img src="../imagenes/ARAUCA1.png" width="100%" height="79"></td>
    <td align="center"><img src="../imagenes/ARAUCAd.png" width="100%"  height="79"></td>
	<td align="right"><img src="../imagenes/ARAUCAdi.png" width="100%"  height="79"></td>
  </tr>
</table>
<div id="session" >

<table border="0" width="180" align="center" class="subtitulo">
<tr><td>
<span style="cursor:pointer"  onClick="cerrar_sesion();" target="_parent" title=":: Cerrar Sesi&oacute;n ::">
<img src="../imagenes/salir.gif" width="15" height="15" align="absmiddle" > Salir </span><br><br>
</td></tr>
<tr>
<td ><img src="../imagenes/user_red_suit.png" width="16" height="16" align="absmiddle"> Usuario:<b> <?php echo $_SESSION['indicador'];?></b></td></tr>
<tr><td> Nombre:<b> <?php echo $_SESSION[nombre];?> <?php echo $_SESSION[apellido];?></b></td></tr>
<tr><td> Nivel de Acceso: <b><?php echo $_SESSION['privilegio'];?></b></td></tr>
<tr><td> Ubicaci&oacute;n: <b><?php echo $_SESSION['ubicacion'];?></b></td></tr>

</table>
<br>
</div>
</body>
</html>
