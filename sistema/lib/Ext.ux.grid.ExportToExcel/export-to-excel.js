/**
*
*  Base64 encode / decode
*  http://www.webtoolkit.info/
*
**/

var Base64 = (function() {

    // private property
    var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

    // private method for UTF-8 encoding
    function utf8Encode(string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";
        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }
        }
        return utftext;
    }

    // public method for encoding
    return {
	    encode : (typeof btoa == 'function') ? function(input) { return btoa(input); } : function (input) {
	        var output = "";
	        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
	        var i = 0;
	        input = utf8Encode(input);
	        while (i < input.length) {
	            chr1 = input.charCodeAt(i++);
	            chr2 = input.charCodeAt(i++);
	            chr3 = input.charCodeAt(i++);
	            enc1 = chr1 >> 2;
	            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
	            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
	            enc4 = chr3 & 63;
	            if (isNaN(chr2)) {
	                enc3 = enc4 = 64;
	            } else if (isNaN(chr3)) {
	                enc4 = 64;
	            }
	            output = output +
	            keyStr.charAt(enc1) + keyStr.charAt(enc2) +
	            keyStr.charAt(enc3) + keyStr.charAt(enc4);
	        }
	        return output;
	    }
	};
})();

Ext.LinkButton = Ext.extend(Ext.Button, {
    template: new Ext.Template(
        '<table border="0" cellpadding="0" cellspacing="0" class="x-btn-wrap"><tbody><tr>',
        '<td class="x-btn-left"><i> </i></td><td class="x-btn-center"><a class="x-btn-text" href="{1}" target="{2}">{0}</a></td><td class="x-btn-right"><i> </i></td>',
        "</tr></tbody></table>"),
    
    onRender:   function(ct, position){
        var btn, targs = [this.text || ' ', this.href, this.target || "_self"];
        if(position){
            btn = this.template.insertBefore(position, targs, true);
        }else{
            btn = this.template.append(ct, targs, true);
        }
        var btnEl = btn.child("a:first");
        btnEl.on('focus', this.onFocus, this);
        btnEl.on('blur', this.onBlur, this);

        this.initButtonEl(btn, btnEl);
        Ext.ButtonToggleMgr.register(this);
    },

    onClick : function(e){
        if(e.button != 0){
            return;
        }
        if(!this.disabled){
            this.fireEvent("click", this, e);
            if(this.handler){
                this.handler.call(this.scope || this, this, e);
            }
        }
    }

});

Ext.override(Ext.grid.GridPanel, {
	getExcelXml: function(includeHidden) {
		var worksheet = this.createWorksheet(includeHidden);
		var totalWidth = this.getColumnModel().getTotalWidth(includeHidden);
		return '<?xml version="1.0" encoding="utf-8"?>' +
			'<ss:Workbook xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:o="urn:schemas-microsoft-com:office:office">' +
			'<o:DocumentProperties><o:Title>' + this.title + '</o:Title></o:DocumentProperties>' +
			'<ss:ExcelWorkbook>' +
				'<ss:WindowHeight>' + worksheet.height + '</ss:WindowHeight>' +
				'<ss:WindowWidth>' + worksheet.width + '</ss:WindowWidth>' +
				'<ss:ProtectStructure>False</ss:ProtectStructure>' +
				'<ss:ProtectWindows>False</ss:ProtectWindows>' +
			'</ss:ExcelWorkbook>' +
			'<ss:Styles>' +
				'<ss:Style ss:ID="Default">' +
					'<ss:Alignment ss:Vertical="Top" ss:WrapText="1" />' +
					'<ss:Font ss:FontName="arial" ss:Size="10" />' +
					'<ss:Borders>' +
						'<ss:Border ss:Color="#e4e4e4" ss:Weight="1" ss:LineStyle="Continuous" ss:Position="Top" />' +
						'<ss:Border ss:Color="#e4e4e4" ss:Weight="1" ss:LineStyle="Continuous" ss:Position="Bottom" />' +
						'<ss:Border ss:Color="#e4e4e4" ss:Weight="1" ss:LineStyle="Continuous" ss:Position="Left" />' +
						'<ss:Border ss:Color="#e4e4e4" ss:Weight="1" ss:LineStyle="Continuous" ss:Position="Right" />' +
					'</ss:Borders>' +
					'<ss:Interior />' +
					'<ss:NumberFormat />' +
					'<ss:Protection />' +
				'</ss:Style>' +
				'<ss:Style ss:ID="title">' +
					'<ss:Borders />' +
					'<ss:Font />' +
					'<ss:Alignment ss:WrapText="1" ss:Vertical="Center" ss:Horizontal="Center" />' +
					'<ss:NumberFormat ss:Format="@" />' +
				'</ss:Style>' +
				'<ss:Style ss:ID="headercell">' +
					'<ss:Font ss:Bold="1" ss:Size="10" />' +
					'<ss:Alignment ss:WrapText="1" ss:Horizontal="Center" />' +
					'<ss:Interior ss:Pattern="Solid" ss:Color="#A3C9F1" />' +
				'</ss:Style>' +
				'<ss:Style ss:ID="even">' +
					'<ss:Interior ss:Pattern="Solid" ss:Color="#CCFFFF" />' +
				'</ss:Style>' +
				'<ss:Style ss:Parent="even" ss:ID="evendate">' +
					'<ss:NumberFormat ss:Format="[ENG][$-409]dd\-mmm\-yyyy;@" />' +
				'</ss:Style>' +
				'<ss:Style ss:Parent="even" ss:ID="evenint">' +
					'<ss:NumberFormat ss:Format="0" />' +
				'</ss:Style>' +
				'<ss:Style ss:Parent="even" ss:ID="evenfloat">' +
					'<ss:NumberFormat ss:Format="0.00" />' +
				'</ss:Style>' +
				'<ss:Style ss:ID="odd">' +
					'<ss:Interior ss:Pattern="Solid" ss:Color="#CCCCFF" />' +
				'</ss:Style>' +
				'<ss:Style ss:Parent="odd" ss:ID="odddate">' +
					'<ss:NumberFormat ss:Format="[ENG][$-409]dd\-mmm\-yyyy;@" />' +
				'</ss:Style>' +
				'<ss:Style ss:Parent="odd" ss:ID="oddint">' +
					'<ss:NumberFormat ss:Format="0" />' +
				'</ss:Style>' +
				'<ss:Style ss:Parent="odd" ss:ID="oddfloat">' +
					'<ss:NumberFormat ss:Format="0.00" />' +
				'</ss:Style>' +
			'</ss:Styles>' +
			worksheet.xml +
			'</ss:Workbook>';
	},

	createWorksheet: function(includeHidden) {

//		Calculate cell data types and extra class names which affect formatting
		var cellType = [];
		var cellTypeClass = [];
		var cm = this.getColumnModel();
		var totalWidthInPixels = 0;
		var colXml = '';
		var headerXml = '';
		for (var i = 0; i < cm.getColumnCount(); i++) {
			if (includeHidden || !cm.isHidden(i)) {
				var w = cm.getColumnWidth(i)
				totalWidthInPixels += w;
				colXml += '<ss:Column ss:AutoFitWidth="1" ss:Width="' + w + '" />';
				headerXml += '<ss:Cell ss:StyleID="headercell">' +
					'<ss:Data ss:Type="String">' + cm.getColumnHeader(i) + '</ss:Data>' +
					'<ss:NamedCell ss:Name="Print_Titles" /></ss:Cell>';
				var fld = this.store.recordType.prototype.fields.get(cm.getDataIndex(i));
				switch(fld.type) {
					case "int":
						cellType.push("Number");
						cellTypeClass.push("int");
						break;
					case "float":
						cellType.push("Number");
						cellTypeClass.push("float");
						break;
					case "bool":
					case "boolean":
						cellType.push("String");
						cellTypeClass.push("");
						break;
					case "date":
						cellType.push("DateTime");
						cellTypeClass.push("date");
						break;
					default:
						cellType.push("String");
						cellTypeClass.push("");
						break;
				}
			}
		}
		var visibleColumnCount = cellType.length;

		var result = {
			height: 9000,
			width: Math.floor(totalWidthInPixels * 30) + 50
		};

//		Generate worksheet header details.
		var t = '<ss:Worksheet ss:Name="' + this.title + '">' +
			'<ss:Names>' +
				'<ss:NamedRange ss:Name="Print_Titles" ss:RefersTo="=\'' + this.title + '\'!R1:R2" />' +
			'</ss:Names>' +
			'<ss:Table x:FullRows="1" x:FullColumns="1"' +
				' ss:ExpandedColumnCount="' + visibleColumnCount +
				'" ss:ExpandedRowCount="' + (this.store.getCount() + 2) + '">' +
				colXml +
				'<ss:Row ss:Height="38">' +
					'<ss:Cell ss:StyleID="title" ss:MergeAcross="' + (visibleColumnCount - 1) + '">' +
					  '<ss:Data xmlns:html="http://www.w3.org/TR/REC-html40" ss:Type="String">' +
						'<html:B><html:U><html:Font html:Size="15">' + this.title +
						'</html:Font></html:U></html:B>Generated by ExtJs</ss:Data><ss:NamedCell ss:Name="Print_Titles" />' +
					'</ss:Cell>' +
				'</ss:Row>' +
				'<ss:Row ss:AutoFitHeight="1">' +
				headerXml + 
				'</ss:Row>';

//		Generate the data rows from the data in the Store
		for (var i = 0, it = this.store.data.items, l = it.length; i < l; i++) {
			t += '<ss:Row>';
			var cellClass = (i & 1) ? 'odd' : 'even';
			r = it[i].data;
			for (var j = 0; j < cm.getColumnCount(); j++) {
				if (includeHidden || !cm.isHidden(j)) {
					var v = r[cm.getDataIndex(j)];
					t += '<ss:Cell ss:StyleID="' + cellClass + cellTypeClass[j] + '"><ss:Data ss:Type="' + cellType[j] + '">';
						if (cellType[j] == 'DateTime') {
							t += v.format('Y-m-d');
						} else {
							t += v;
						}
					t +='</ss:Data></ss:Cell>';
				}
			}
			t += '</ss:Row>';
		}

		result.xml = t + '</ss:Table>' +
			'<x:WorksheetOptions>' +
				'<x:PageSetup>' +
					'<x:Layout x:CenterHorizontal="1" x:Orientation="Landscape" />' +
					'<x:Footer x:Data="Page &amp;P of &amp;N" x:Margin="0.5" />' +
					'<x:PageMargins x:Top="0.5" x:Right="0.5" x:Left="0.5" x:Bottom="0.8" />' +
				'</x:PageSetup>' +
				'<x:FitToPage />' +
				'<x:Print>' +
					'<x:PrintErrors>Blank</x:PrintErrors>' +
					'<x:FitWidth>1</x:FitWidth>' +
					'<x:FitHeight>32767</x:FitHeight>' +
					'<x:ValidPrinterInfo />' +
					'<x:VerticalResolution>600</x:VerticalResolution>' +
				'</x:Print>' +
				'<x:Selected />' +
				'<x:DoNotDisplayGridlines />' +
				'<x:ProtectObjects>False</x:ProtectObjects>' +
				'<x:ProtectScenarios>False</x:ProtectScenarios>' +
			'</x:WorksheetOptions>' +
		'</ss:Worksheet>';
		return result;
	}
});

Ext.onReady(function(){

    Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

    var myData = [
        ['3m Co',71.72,0.02,0.03,'9/1 12:00am'],
        ['Alcoa Inc',29.01,0.42,1.47,'9/1 12:00am'],
        ['Altria Group Inc',83.81,0.28,0.34,'9/1 12:00am'],
        ['American Express Company',52.55,0.01,0.02,'9/1 12:00am'],
        ['American International Group, Inc.',64.13,0.31,0.49,'9/1 12:00am'],
        ['AT&T Inc.',31.61,-0.48,-1.54,'9/1 12:00am'],
        ['Boeing Co.',75.43,0.53,0.71,'9/1 12:00am'],
        ['Caterpillar Inc.',67.27,0.92,1.39,'9/1 12:00am'],
        ['Citigroup, Inc.',49.37,0.02,0.04,'9/1 12:00am'],
        ['E.I. du Pont de Nemours and Company',40.48,0.51,1.28,'9/1 12:00am'],
        ['Exxon Mobil Corp',68.1,-0.43,-0.64,'9/1 12:00am'],
        ['General Electric Company',34.14,-0.08,-0.23,'9/1 12:00am'],
        ['General Motors Corporation',30.27,1.09,3.74,'9/1 12:00am'],
        ['Hewlett-Packard Co.',36.53,-0.03,-0.08,'9/1 12:00am'],
        ['Honeywell Intl Inc',38.77,0.05,0.13,'9/1 12:00am'],
        ['Intel Corporation',19.88,0.31,1.58,'9/1 12:00am'],
        ['International Business Machines',81.41,0.44,0.54,'9/1 12:00am'],
        ['Johnson & Johnson',64.72,0.06,0.09,'9/1 12:00am'],
        ['JP Morgan & Chase & Co',45.73,0.07,0.15,'9/1 12:00am'],
        ['McDonald\'s Corporation',36.76,0.86,2.40,'9/1 12:00am'],
        ['Merck & Co., Inc.',40.96,0.41,1.01,'9/1 12:00am'],
        ['Microsoft Corporation',25.84,0.14,0.54,'9/1 12:00am'],
        ['Pfizer Inc',27.96,0.4,1.45,'9/1 12:00am'],
        ['The Coca-Cola Company',45.07,0.26,0.58,'9/1 12:00am'],
        ['The Home Depot, Inc.',34.64,0.35,1.02,'9/1 12:00am'],
        ['The Procter & Gamble Company',61.91,0.01,0.02,'9/1 12:00am'],
        ['United Technologies Corporation',63.26,0.55,0.88,'9/1 12:00am'],
        ['Verizon Communications',35.57,0.39,1.11,'9/1 12:00am'],
        ['Wal-Mart Stores, Inc.',45.45,0.73,1.63,'9/1 12:00am']
    ];

    // example of custom renderer function
    function change(val){
        if(val > 0){
            return '<span style="color:green;">' + val + '</span>';
        }else if(val < 0){
            return '<span style="color:red;">' + val + '</span>';
        }
        return val;
    }

    // example of custom renderer function
    function pctChange(val){
        if(val > 0){
            return '<span style="color:green;">' + val + '%</span>';
        }else if(val < 0){
            return '<span style="color:red;">' + val + '%</span>';
        }
        return val;
    }

    // create the data store
    var store = new Ext.data.SimpleStore({
        fields: [
           {name: 'company'},
           {name: 'price', type: 'float'},
           {name: 'change', type: 'float'},
           {name: 'pctChange', type: 'float'},
           {name: 'lastChange', type: 'date', dateFormat: 'n/j h:ia'}
        ]
    });
    store.loadData(myData);


	var linkButton = new Ext.LinkButton({
    	id: 'grid-excel-button',
    	text: 'Excel'
    });

    // create the Grid
    var grid = new Ext.grid.GridPanel({
    	id: 'static-grid',
        store: store,
        columns: [
            {id:'company',header: "Company", width: 160, sortable: true, dataIndex: 'company'},
            {header: "Price", width: 75, sortable: true, renderer: 'usMoney', dataIndex: 'price'},
            {header: "Change", width: 75, sortable: true, renderer: change, dataIndex: 'change'},
            {header: "% Change", width: 75, sortable: true, renderer: pctChange, dataIndex: 'pctChange'},
            {header: "Last Updated", width: 85, sortable: true, renderer: Ext.util.Format.dateRenderer('m/d/Y'), dataIndex: 'lastChange'}
        ],
        stripeRows: true,
        autoExpandColumn: 'company',
        height:350,
        width:600,
        title:'Array Grid',
        bbar: new Ext.Toolbar({
        	buttons: [linkButton]
	    })
    });

    grid.render('grid-example');
	linkButton.getEl().child('a', true).href = 'data:application/vnd.ms-excel;base64,' +
		Base64.encode(grid.getExcelXml());

    grid.getSelectionModel().selectFirstRow();
});