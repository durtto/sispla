
var labelType, useGradients, nativeTextSupport, animate;

(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport 
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

var Log = {
  elem: false,
  write: function(text){
    if (!this.elem) 
      this.elem = document.getElementById('log');
    this.elem.innerHTML = text;
    this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
  }
};
function organigrama(){
    //init data
    var json = {
        id: "1",
        name: "Cordinador General",
        data: {},
        children: [{
        id: "1.2",
        name: "Cordinador Furrial",
        data: {},
        children: [{
        			id: "1.2.1",
        			name: "Planta Jusepin",
        			data: {},
        			children: []
    				},{
        			id: "1.2.2",
        			name: "Orocual",
        			data: {},
        			children: []
    				},{
        			id: "1.2.3",
        			name: "Jusepin Furrial",
        			data: {},
        			children: []
    				},{
        			id: "1.2.4",
        			name: "Rusio Viejo",
        			data: {},
        			children: []
    				},{
        			id: "1.2.5",
        			name: "Maturin",
        			data: {},
        			children: []
    				}]
    },{
        id: "1.3",
        name: "Cordinador Punta de Mata",
        data: {},
        children: [{
        			id: "1.3.1",
        			name: "Muscar",
        			data: {},
        			children: []
    				},{
        			id: "1.3.2",
        			name: "Carito",
        			data: {},
        			children: []
    				},{
        			id: "1.3.3",
        			name: "Pirital",
        			data: {},
        			children: []
    				},{
        			id: "1.3.4",
        			name: "Campo Rojo",
        			data: {},
        			children: []
    				}]
    }]
    };
    //end
    //init Spacetree
    //Create a new ST instance
    var st = new $jit.ST({
        //id of viz container element
        injectInto: 'infovis',
       	levelsToShow: 3,
        levelDistance: 30,
        constrained: true,                
        offsetX: 0,
        offsetY: 0,

        //set duration for the animation
        duration: 200,
        orientation: "top", 
        //set animation transition type
        transition: $jit.Trans.Quart.easeInOut,
        //set distance between node and its children
        levelDistance: 40,
        //indent:3,
       
        //collapsed: true,
        //enable panning
        Navigation: {
          enable:true,
          panning:true
        },
        //set node and edge styles
        //set overridable=true for styling individual
        //nodes or edges
        Node: {
            height: 50,
            width: 60,
            type: 'rectangle',
            color: '#aaa',
            autoHeight: true,  
			autoWidth: true,  
           overridable: true
            
        },
        
        Edge: {
            type: 'bezier',
            //overridable: true
        },
        
        onBeforeCompute: function(node){
            Log.write("Cargando " + node.name);
        },
        
        onAfterCompute: function(){
            Log.write("Listo");
        },
        
        //This method is called on DOM label creation.
        //Use this method to add event handlers and styles to
        //your node.
        onCreateLabel: function(label, node){
            label.id = node.id;            
            label.innerHTML = node.name;
            label.onclick = function(){
            	  st.onClick(node.id, 'animate');
            };
            //set label styles
            var style = label.style;
            style.width = 60 + 'px';
            style.height = 17 + 'px';            
            style.cursor = 'pointer';
            style.color = '#333';
            style.fontSize = '0.8em';
            style.textAlign= 'center';
            style.paddingTop = '3px';
        },
        
        //This method is called right before plotting
        //a node. It's useful for changing an individual node
        //style properties before plotting it.
        //The data properties prefixed with a dollar
        //sign will override the global node style properties.
        onBeforePlotNode: function(node){
            //add some color to the nodes in the path between the
            //root node and the selected node.
            if (node.selected) {
                node.data.$color = "#ff7";
            }
            else {
                delete node.data.$color;
                //if the node belongs to the last plotted level
                if(!node.anySubnode("exist")) {
                    //count children number
                    var count = 0;
                    node.eachSubnode(function(n) { count++; });
                    //assign a node color based on
                    //how many children it has
                    node.data.$color = ['#aaa', '#baa', '#caa', '#daa', '#eaa', '#faa'][count];                    
                }
            }
        },
        
        //This method is called right before plotting
        //an edge. It's useful for changing an individual edge
        //style properties before plotting it.
        //Edge data proprties prefixed with a dollar sign will
        //override the Edge global style properties.
        onBeforePlotLine: function(adj){
            if (adj.nodeFrom.selected && adj.nodeTo.selected) {
                adj.data.$color = "#eed";
                adj.data.$lineWidth = 3;
            }
            else {
                delete adj.data.$color;
                delete adj.data.$lineWidth;
            }
        }
    });
    //load json data
    st.loadJSON(json);
    //compute node positions and layout
    st.compute();
    //optional: make a translation of the tree
    st.geom.translate(new $jit.Complex(-200, 0), "current");
    //emulate a click on the root node.
    st.onClick(st.root);
    //end
    //Add event handlers to switch spacetree orientation.
    var    normal = $jit.id('s-normal');
        
    
    function changeHandler() {
        if(this.checked) {
            top.disabled = true;
            st.switchPosition(this.value, "animate", {
                onComplete: function(){
                    top.disabled  = false;
                }
            });
        }
    };
    
    top.onchange = changeHandler;
    //end



}