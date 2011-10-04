// JavaScript Document

	Ext.BLANK_IMAGE_URL = '../../images/default/s.gif';
	
	Ext.EventManager.on(window, 'load', function(){											 
							setTimeout(function(){
								if(Ext.get('loading')){				
									Ext.get('loading').remove();				
									//document.getElementById('formulario').style.display = "block";
									Ext.get('loading-mask').fadeOut({remove:true, duration: 1});
								}
								if(window.parent.Ext){
									if(window.parent.Ext.get('loading')){				
										window.parent.Ext.get('loading').remove();				
										//document.getElementById('formulario').style.display = "block";
										window.parent.Ext.get('loading-mask').fadeOut({remove:true, duration: 1});
									}
							   }
							}, 250);
						});
	/*******************************************************************************************/
	//		VTypes : Tipos de validacion,  son un conjunto de funciones que permiten validar la entrada de datos en los campos
	// del formulario, utilizando la libreria Ext-Js podemos definir nuevos tipos de validaciones.
	// Add the additional 'advanced' VTypes
	// Add the additional 'advanced' VTypes
	Ext.apply(Ext.form.VTypes, {
		daterange : function(val, field) {
			var date = field.parseDate(val);
	
			if(!date){
				return;
			}
			if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
				var start = Ext.getCmp(field.startDateField);
				start.setMaxValue(date);
				start.validate();
				this.dateRangeMax = date;
			} 
			else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
				var end = Ext.getCmp(field.endDateField);
				end.setMinValue(date);
				end.validate();
				this.dateRangeMin = date;
			}
			/*
			 * Always return true since we're only using this vtype to set the
			 * min/max allowed values (these are tested for after the vtype test)
			 */
			return true;
		},
	
		password : function(val, field) {
			if (field.initialPassField) {
				var pwd = Ext.getCmp(field.initialPassField);
				return (val == pwd.getValue());
			}
			return true;
		},
	
		passwordText : 'Passwords do not match'
	});

	// Validacion con formato de numero telefonico
	Ext.form.VTypes["phone"] = /^(\d{4}[-]?){1}(\d{7})$/;
	Ext.form.VTypes["phoneMask"] = /[\d-]/;
	Ext.form.VTypes["phoneText"] = 'No es un nmero de telfono vlido. Debe tener el formato ###-####### (guion opcional)';
	
	// Validacion con formato de solo numeros
	Ext.form.VTypes["numero"] =  /^[0-9]+$/i;
	Ext.form.VTypes["numeroMask"] = /[0-9]/i;
	Ext.form.VTypes["numeroText"] = 'Este campo solo admite nmeros...';
	
	// Validacion con formato de solo letras
	Ext.form.VTypes["alfanum"] =  /^([-_a-zA-Z0-9 (INSERT|DELETE)])+$/i; //[A-Z]| ||||||||||||||
	Ext.form.VTypes["alfanumMask"] = /([-_a-zA-Z0-9 ])/i;
	Ext.form.VTypes["alfanumText"] = 'Este campo solo admite caracteres alfanumericos...';
	
	// Validacion con formato de solo letras
	Ext.form.VTypes["letras"] =  /^([.a-zA-Z ])+$/i; //[A-Z]| ||||||||||||||
	Ext.form.VTypes["letrasMask"] = /([.a-zA-Z ])/i;
	Ext.form.VTypes["letrasText"] = 'Este campo solo admite caracteres alfabeticos...';
	
	// Validacion con formato de solo letras
	Ext.form.VTypes["validos"] =  /^([-_.,a-zA-Z0-9\/:#&+*;@\)\( ])+$/i;
	Ext.form.VTypes["validosMask"] = /([-_.,a-zA-Z0-9\/:#&+*;@\)\( ])/i; //[A-Z]|[0-9]| ||||||||||||||||-|_|#|&|+|,|.|\/|\(|\)|*
	Ext.form.VTypes["validosText"] = 'Este campo solo admite caracteres alfanumericos y simbolos estandares...';
	
	// Validacion con formato de solo letras
	Ext.form.VTypes["validos%"] =  /^([-_.,a-zA-Z0-9\/:��#%&+*;\)\( ])+$/i;
	Ext.form.VTypes["validos%Mask"] = /([-_.,a-zA-Z0-9\/:��#%&+*;\)\( ])/i; //[A-Z]|[0-9]| ||||||||||||||||-|_|#|&|+|,|.|\/|\(|\)|*
	Ext.form.VTypes["validos%Text"] = 'Este campo solo admite caracteres alfanumericos y simbolos estandares...';
		
	// Validacion con formato de hora militar ##:##(0:00 - 23:59)
	/*Ext.form.VTypes["time"] = /^(([0-5]|[0-9]):([0-5][0-9]))+$/i;
	Ext.form.VTypes["timeMask"]=/(([0-5]|[0-9]):([0-5][0-9]))/i;*/
	//^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$
	Ext.form.VTypes["time"] = /^([0-1]?[0-9]|[2][0-3]):([0-5][0-9])$/i;
	Ext.form.VTypes["timeMask"] = /[\d:]/i;
	Ext.form.VTypes["timeText"]='No es una hora valida. Debe escribirse en el formato "hh:mm" dentro del rango "0:00 - 23:59".'; 

	/*******************************************************************************************/
	//		Sobereescribe el campo field para activar los eventos de key
	Ext.override(Ext.form.Field, {
		fireKey : function(e) {
			if(((Ext.isIE && e.type == 'keydown') || e.type == 'keypress') && e.isSpecialKey()) {
				this.fireEvent('specialkey', this, e);
			}
			else {
				this.fireEvent(e.type, this, e);
			}
		}
	  , initEvents : function() {
	//                this.el.on(Ext.isIE ? "keydown" : "keypress", this.fireKey,  this);
			this.el.on("focus", this.onFocus,  this);
			this.el.on("blur", this.onBlur,  this);
			this.el.on("keydown", this.fireKey, this);
			this.el.on("keypress", this.fireKey, this);
			this.el.on("keyup", this.fireKey, this);
	
			// reference to original value for reset
			this.originalValue = this.getValue();
		}
	});
	/*******************************************************************************************/
	//		function convPass() : Permite convertir u ocultar el texto introducido en los campos de contrasea colocando solo
	// asteriscos en negritas.
	function convPass(){
			return '<b>********</b>';
	}
	
	
			// name: GetCombo
			// @param
			// @return
			 function GetCombo(nombre,etiqueta){
			 co_nombre=nombre;
			 nb_nombre='nb_'+nombre.substring(3);
			 accion=nombre.substring(3);
			 var combo = new Ext.form.ComboBox({
			  name: nombre,
			  id: nombre,
			  emptyText: 'Seleccione..',
			  //hiddenName: nombre+"hide",
			  //forceSelection: true,
			  valueField:nombre,
			  fieldLabel:etiqueta,
			  displayField:nb_nombre,
			  editable: false,
			  anchor: '90%',
			  listWidth:220,
			  typeAhead:true,
			  mode: 'remote',
			  triggerAction:'all',
			  store: new Ext.data.JsonStore({
			   url: '../interfaz/interfaz_combo.php',
			   root: 'Resultados',
			   idProperty: co_nombre,
			   baseParams: {
			    accion: accion
			   },
			   fields: [co_nombre, nb_nombre]
			  })
			 });
			 return combo;
			} 
	/*******************************************************************************************/
	//		function verifObligatorios() : Con esta funcion validamos que los campos que consideramos como requeridos u obligatorios
	// en un formulario hayan sido introducidos, recibe como parametro de entrada un array asociativo de los campos a verificar y
	// otro con todos los campos que contiene el formulario, retorna un string con los campos requeridos que aun no tienen datos.
	 function verifObligatorios(camposForm, requeridos){
		var i=0;
		var cadena='';
		//var aux='';
		for(var vec in camposForm){
			//aux=''+vec;
			if(requeridos[vec]){
				if(camposForm[vec]=='' || camposForm[vec]== null || camposForm[vec].indexOf('Ao')>=0 || camposForm[vec].indexOf('Seleccion')>=0 || camposForm[vec].indexOf('...')>=0 || camposForm[vec].indexOf('hh:mm')>=0 || camposForm[vec].indexOf('dd/mm/aaaa')>=0){
					cadena +='  "'+requeridos[vec]+'"<br />';
				}
			}
				//cadena +=vec+' = '+requeridos[vec]+'<br />';
		}
		/*for(var vec in requeridos)
		{
				aux=''+vec;
				cadena +=vec+' = '+requeridos[vec]+' | '+aux+' = '+camposForm[aux]+'<br />';
		}*/
				//cadena +=vec+' = '+algo[vec]+'<br />';
		//Ext.Msg.alert('Valores del Formulario', 'Los siguientes valores son los que se enviaran: <br />'+cadena);
		
		return cadena;
	 }
  
	/*******************************************************************************************/
	//		function limpiarForm() : Esta funcion es parecida al formulario.reset() con la salvedad que que podemos escojer 
	// que campos podemos dejar sin borrar y de esta manera tener un reset mas parcial y personalizado.
	 function limpiarForm(Formulario, exonerado){
		var i=0;
		var cadena='';
		//var aux='';
		var camposForm = Formulario.getValues(false);	
		for(var vec in camposForm){
			if(vec.indexOf(exonerado)<0){
				if(Ext.getCmp(vec))
					Ext.getCmp(vec).setValue("");
				else
					alert(vec);
			}
		}
	 }
  
	/*******************************************************************************************/
	//	function cerrarForm() : Esta funcion permite cerrar el tab donde se encuentra el formularion actual, es decir el que esta
	// abierto al momento en que esta es llamada
	 function cerrarForm(campoClave){	 
			Ext.MessageBox.show({
			   title:'Cerrar',
			   msg: 'Seguro desea cerrar este formulario?',
			   buttons: Ext.Msg.YESNO,
			   fn: function(btn){
					 if (btn == 'yes') {
						var TabPanel = window.parent.Ext.getCmp('paneldetabs');
						TabPanel.remove(TabPanel.activeTab, true);
					}
					else Ext.getCmp(campoClave).focus(true);
				},
			   icon: Ext.MessageBox.QUESTION
			});
	 }
 
	/*******************************************************************************************/
	//		function convFecha() : Permite convertir cualquier formato de fechas al formato "Y-m-d", es decir, "Ao-mes-dia"
	// (####-##-##). Recibe como parametro de entrada una cadena o string de fecha y retorna la misma fecha cambiada de formato.
	 function convFecha(fechaEnt){
		var dt = new Date(fechaEnt);
		if(fechaEnt!= null && fechaEnt!='')
			return dt.format('Y-m-d');
		else
			return '';
	 }
	 
	  function convFechaDMY(fechaEnt){
		var dt = new Date(fechaEnt);
		if(fechaEnt!= null && fechaEnt!='')
			return dt.format('d-m-Y');
		else
			return '';
	 }
	
	 function formatoFecha(fechaEnt, formato){	 
		var fechahora;
		/*** Convertirlas en objeto de tipo Date() ***/
		if(fechaEnt == ''){	
			fechahora = new Date();
		}
		else{			
			var fh = fechaEnt.split(" ");
			var fecha = fh[0].split("-");
			var hora = fh[1].split(":");
			fechahora = new Date(fecha[0], fecha[1]-1, fecha[2], hora[0], hora[1], hora[2]);
		}
		if(fechahora!= null && fechahora!=''  && fechahora>0)
			return fechahora.format(formato);
		else
			return fechahora;
	}
		
	/*********************************************************************************************************/
	function convTiempo(hrMin){		
		var hm = hrMin.split(":");
		var hrs = hm[0]*1;
		var mins = hm[1]*1;
		return  (Math.floor(hrs*3600000) + Math.floor(mins*60000));
	}
	
	function difTiempo(valFecha1, valFecha2){			
	/*** Descomponer la fecha|hora de inicio ***/
		var fhIni = valFecha1.split(" ");
		var fechaIni = fhIni[0].split("-");
		var horaIni = fhIni[1].split(":")
	/*** Descomponer la fecha|hora de Fin ***/
		var fhFin = valFecha2.split(" ");
		var fechaFin = fhFin[0].split("-");
		var horaFin = fhFin[1].split(":")
	/*** Convertirlas en objeto de tipo Date() ***/
		var  fechahoraIni = new Date(fechaIni[0], fechaIni[1]-1, fechaIni[2], horaIni[0], horaIni[1], horaIni[2]);
		var  fechahoraFin = new Date(fechaFin[0], fechaFin[1]-1, fechaFin[2], horaFin[0], horaFin[1], horaFin[2]);
		//var fprueba = new Date("1980-11-19");
	/*** Calcular tiempo ****/
		var miliseg = Math.abs(fechahoraFin.getTime()-fechahoraIni.getTime());
		var dias = Math.floor(miliseg/86400000);
		miliseg -= dias*86400000;
		var horas = Math.floor(miliseg/3600000);
		miliseg -= horas*3600000;
		var minutos =  Math.floor(miliseg/60000);
		miliseg -= minutos*60000;
		var segundos = Math.floor(miliseg/1000);
		//Ext.MessageBox.alert('Probando',fecha+" > "+fecha.getTime()+" <br>  "+fechahoraIni+" > "+fechahoraIni.getTime());
		if(!isNaN(miliseg))
		{
			var nroHrs = '';		
			nroHrs = ''+((dias*24)+horas);
			if(nroHrs.length ==1)
					nroHrs = "0"+nroHrs;	
			var nroMin = '';
			nroMin = ''+minutos;
			if(nroMin.length ==1)
					nroMin = "0"+nroMin;
			/*** devolver la diferencia de tiempo en el formato HH:MM ***/
			return nroHrs+":"+nroMin;
		}
	}
	
	/*********************************************************************************************************/
	function calcTiempo(valFechaIni, valTiempoRec, oper){
	/*** Descomponer la fecha|hora de inicio ***/
		var fhIni = valFechaIni.split(" ");
		var fechaIni = fhIni[0].split("-");
		var horaIni = fhIni[1].split(":")
	/*** Descomponer la fecha|hora de Fin ***/
		var tiempRec = valTiempoRec.split(":");
		var hrs = tiempRec[0]*1;
		var mins = tiempRec[1]*1;
		var horas = Math.floor(hrs*3600000);
		var minutos =  Math.floor(mins*60000);
		//alert(valFechaIni+' '+oper);
	/*** Convertirlas en objeto de tipo Date() ***/
		var  fechahoraIni = new Date(fechaIni[0], fechaIni[1]-1, fechaIni[2], horaIni[0], horaIni[1], horaIni[2]);
		var miliseg = 0;
		if(oper == "+")
			miliseg = fechahoraIni.getTime()+horas+minutos;
		else if(oper == "-")
			miliseg = fechahoraIni.getTime()-(horas+minutos);
		else{
			alert("Error en Funcion CalcTiempo: Operador ivalido");
			return false;
		}
		if(!isNaN(miliseg))
		{
			var  fh = new Date(miliseg);
			//return fh.format("Y-m-d H:i:s");		
			return fh.format("d-m-Y H:i");			
		}
		else
			return false;
	}
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function cmpTiempo(tiempo1, operador, tiempo2){
		var hm1 = tiempo1.split(":");
		var hm2 = tiempo2.split(":");
		var hr1 =  hm1[0]*1;
		var min1 = hm1[1]*1;
		var hr2 =  hm2[0]*1;
		var min2 = hm2[1]*1;
		var hmVal1 = (hr1*60) + min1;
		var hmVal2 = (hr2*60) + min2;
		var resp = false;
		//var fprueba = new Date("1980-11-19");
		
		switch(operador){
			case '<':
						if(hmVal1<hmVal2)	resp = true;
			break;
			case '<=':
						if(hmVal1<=hmVal2)	resp = true;
			break;
			case '==':
						if(hmVal1==hmVal2)	resp = true;
			break;
			case '>':
						if(hmVal1>hmVal2)	resp = true;
			break;
			case '>=':
						if(hmVal1>=hmVal2)	resp = true;
			break;
			default: 
						resp = false;
			}
			
			return resp;
		/*var resultado = 0;
		if(hr1 > hr2){
			resultado = 1;
		}
		else{
			if(hr2 > hr1){
				resultado = 2;
			}
			else{
				if(min1 > min2){
					resultado = 1;
				}
				else{
					if(min2 > min1){
						resultado = 2;
					}
					else
						resultado = 0;
				}
			}
		}
		return resultado;*/
	}
	
	function sumar_tiempo(tiempo1, tiempo2)
	{			
		//alert(tiempo1+' | '+tiempo2);
		if(tiempo1 == "" || tiempo1.length <1)
			tiempo1 = "0:00";			
		if(tiempo2 == "" || tiempo2.length <1)
			tiempo2 = "0:00";
		var hm1 = tiempo1.split(":");
		var hm2 = tiempo2.split(":");
		var hrs = (hm1[0]*1) + (hm2[0]*1);
		var mins = (hm1[1]*1) + (hm2[1]*1);
		var rmin = mins%60;
		var cmin = parseInt(mins/60);
		hrs += cmin;
		hrs += "";
		rmin += "";
		if(hrs.length ==1)
				hrs = "0"+hrs;	
		if(rmin.length ==1)
				rmin = "0"+rmin;		
		//Ext.MessageBox.alert('Probando',tiempo1+" | "+tiempo2);
		/*** devolver la suma de tiempo en el formato HH:MM ***/
		return hrs+":"+rmin;
	}
	
	function restar_tiempo(tiempo1, tiempo2)
	{
			var hm1 = tiempo1.split(":");
			var hm2 = tiempo2.split(":");
			var hrs = 0;     //parseInt(hm1[0]) + parseInt(hm2[0]);
			var mins = 0;   //parseInt(hm1[1]) + parseInt(hm2[1]);			
			var rmin =0;
			//alert(tiempo1+" => "+hm1[0]+" | "+(hm1[0]*1)+"  -  "+hm1[1]+" | "+(hm1[1]*1)+" <br>  "+tiempo2+" => "+hm2[0]+" | "+(hm2[0]*1)+" - "+hm2[1]+" | "+(hm2[1]*1));
			hm1[0] *= 1;
			hm1[1] *= 1;
			hm2[0] *= 1;
			hm2[1] *= 1;
			if(hm1[1] < hm2[1])
			{
				rmin = 60 - hm2[1] + hm1[1];
				hm1[0] = hm1[0] - 1;
			}
			else
				rmin = hm1[1] - hm2[1];
			hrs = hm1[0] - hm2[0];
			hrs += "";
			rmin += "";	
			if(hrs.length ==1)
					hrs = "0"+hrs;	
			if(rmin.length ==1)
					rmin = "0"+rmin;				
			/*** devolver la suma de tiempo en el formato HH:MM ***/
			return hrs+":"+rmin;
	}
	/*********************************************************************************************************/
	
	function tiempoKms(kms){
		if(kms == "")
			return "00:00";
		var tm = parseFloat(kms)/(1.5);
		var hrs = Math.floor(tm/60);
		var mns = Math.floor(tm-(hrs*60));
		hrs += "";
		mns += "";	
		if(hrs.length ==1)
			hrs = "0"+hrs;
		if(mns.length ==1)
			mns = "0"+mns;
		/*** devolver la suma de tiempo en el formato HH:MM ***/
		return hrs+":"+mns;	
	}
	
	/*********************************************************************************************************/
	
	function cmpFechas(valFecha1, operador, valFecha2){
	/*** Descomponer la fecha|hora de inicio ***/
		//alert(valFecha1+' '+operador+' '+valFecha2);
		var fh1 = valFecha1.split(" ");
		var fecha1 = fh1[0].split("-");
		var hora1 = fh1[1].split(":")
	/*** Descomponer la fecha|hora de Fin ***/
		var fh2 = valFecha2.split(" ");
		var fecha2 = fh2[0].split("-");
		var hora2 = fh2[1].split(":")
	/*** Convertirlas en objeto de tipo Date() ***/
		var  fechahora1 = new Date(fecha1[0], fecha1[1]-1, fecha1[2], hora1[0], hora1[1], hora1[2]);
		var  fechahora2 = new Date(fecha2[0], fecha2[1]-1, fecha2[2], hora2[0], hora2[1], hora2[2]);
		var fhVal1=fechahora1.getTime();
		var fhVal2=fechahora2.getTime();
		var resp = false;
		//var fprueba = new Date("1980-11-19");
		
		switch(operador){
			case '<':
						if(fhVal1<fhVal2)	resp = true;
			break;
			case '<=':
						if(fhVal1<=fhVal2)	resp = true;
			break;
			case '==':
						if(fhVal1==fhVal2)	resp = true;
			break;
			case '>':
						if(fhVal1>fhVal2)	resp = true;
			break;
			case '>=':
						if(fhVal1>=fhVal2)	resp = true;
			break;
			default: 
						resp = false;
		}
		
		return resp;
	/*** Calcular tiempo ****/
		/*var result = fechahora1.getTime()-fechahora2.getTime();
		if(result>0){
			return 1;
		}
		else{
			if(result<0)
				return 2;
			else
				return 0;
		}*/
	}
	
	/*********************************************************************************************************/
	function RestarFechas(valFecha1, valFecha2, tipo){
	/*** Descomponer la fecha|hora de inicio ***/
		var fh1 = valFecha1.split(" ");
		var fecha1 = fh1[0].split("-");
		var hora1 = fh1[1].split(":")
	/*** Descomponer la fecha|hora de Fin ***/
		var fh2 = valFecha2.split(" ");
		var fecha2 = fh2[0].split("-");
		var hora2 = fh2[1].split(":")
	/*** Convertirlas en objeto de tipo Date() ***/
		var  fechahora1 = new Date(fecha1[0], fecha1[1]-1, fecha1[2], hora1[0], hora1[1], hora1[2]);
		var  fechahora2 = new Date(fecha2[0], fecha2[1]-1, fecha2[2], hora2[0], hora2[1], hora2[2]);			
	/*** Calcular tiempo ****/
		var miliseg = Math.abs(fechahora1.getTime()-fechahora2.getTime());
		var resp=0;
		//alert(tipo);
		switch(tipo){
			case 'd':
						resp = miliseg/86400000;
			break;
			case 'h':
						resp = miliseg/3600000;
			break;
			case 'm':
						resp = miliseg/60000;
			break;
			case 's':
						resp = miliseg/1000;
			break;
			case 'ms':
						resp = miliseg;
			break;
			case 'h:m':	
						var dias = Math.floor(miliseg/86400000);
						miliseg -= dias*86400000;
						var horas = Math.floor(miliseg/3600000);
						miliseg -= horas*3600000;
						var minutos =  Math.floor(miliseg/60000);
						miliseg -= minutos*60000;
						//var segundos = Math.floor(miliseg/1000);			
						if(!isNaN(miliseg))
						{
							var nroHrs = '';		
							nroHrs = ''+((dias*24)+horas);
							if(nroHrs.length ==1)
									nroHrs = "0"+nroHrs;	
							var nroMin = '';
							nroMin = ''+minutos;
							if(nroMin.length ==1)
									nroMin = "0"+nroMin;
							/*** devolver la diferencia de tiempo en el formato HH:MM ***/
							resp = nroHrs+":"+nroMin;
						}
			break;
			default: 
						resp = false;
		}
		
		return resp;
	}
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function italic(value){
        return '<i>' + value + '</i>';
    }
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function change(val){
        if(val > 0){
            return '<span style="color:green;">' + val + '</span>';
        }else if(val < 0){
            return '<span style="color:red;">' + val + '</span>';
        }
        return val;
    }
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function bsRecorrido(tMin, bsMin){
        return tMin*bsMin;
    }
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function bsTEsp(tMinEsp, bsMinEsp){
        return tMinEsp*bsMinEsp;
    }
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function bsBonoRec(tMinBono, bsMin, porcBono){
		return (tMinBono * bsMin) * porcBono;
    }
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function bsBonoEsp(tMinEsp, bsMinEsp, porcBono){
		return (tMinEsp * bsMinEsp) * porcBono;
    }
 
	/*******************************************************************************************/
	//
	// example of custom renderer function
    function pctChange(val){
        if(val > 0){
            return '<span style="color:green;">' + val + '%</span>';
        }else if(val < 0){
            return '<span style="color:red;">' + val + '%</span>';
        }
        return val;
    }
       //Funcion para cambiar el coloer en el boolean
      
		function critico(bo_critico) {
        if (bo_critico == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_critico == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_critico;
    	}
    	
    	function obsoleto(bo_obsoleto) {
        if (bo_obsoleto == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_obsoleto == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_obsoleto;
    	}
    	
    	function vehiculo(bo_vehiculo) {
        if (bo_vehiculo == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_vehiculo == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_vehiculo;
    	}
    	function laptop(bo_laptop) {
        if (bo_laptop == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_laptop == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_laptop;
    	}
    	function maletin(bo_maletin_herramientas) {
        if (bo_maletin_herramientas == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_maletin_herramientas == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_maletin_herramientas;
    	}
    	function radio(bo_radio) {
        if (bo_radio == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_radio == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_radio;
    	}
	    function multimetro(bo_multimetro_digital) {
        if (bo_multimetro_digital == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_multimetro_digital == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_multimetro_digital;
    	}
    	function hart(bo_hart) {
        if (bo_hart == 'SI') {
            return '<span style="color:blue;">' + 'SI' + '</span>';
        } else if (bo_hart == 'NO') {
            return '<span style="color:gray;">' + 'NO' + '</span>';
        }
        return bo_hart;
    	}
    		function vulnerable(bo_vulnerable) {
        if (bo_vulnerable == 'SI') {
            return '<span style="color:red;">' + 'SI' + '</span>';
        } else if (bo_vulnerable == 'NO') {
            return '<span style="color:green;">' + 'NO' + '</span>';
        }
        return bo_vulnerable;
    	}
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
	/*******************************************************************************************/
	//
	// example of custom renderer function
	Ext.override(Ext.form.RadioGroup, {
	  getName: function() {
		return this.items.first().getName();
	  },
	
	  getValue: function() {
		var v;
	
		this.items.each(function(item) {
		  v = item.getRawValue();
		  return !item.getValue();
		});
	
		return v;
	  },
	
	  setValue: function(v) {
		this.items.each(function(item) {
		  item.setValue(item.getRawValue() == v);
		});
	  }
	});
	
	Ext.override(Ext.form.CheckboxGroup, {
		/**
		 * @cfg {String} name The field's HTML name attribute (defaults to "").
		 */
	
		/**
		 * @cfg {string} separator String seperator between multiple values
		 */
		separator: ';',
		
		// private
		afterRender : function() {
			this.items.each(function(i) {
				i.ownerGroup = this; // kind of lame hack
			}, this);
			Ext.form.CheckboxGroup.superclass.afterRender.call(this);
		},
		
		/**
		 * @method initValue
		 * @hide
		 */
		initValue : function(){
			if(this.value !== undefined){
				this.setValue(this.value);
			}
		},
		
		/**
		 * @method getValue
		 * @hide
		 */
		getValue : function() {
			if(!this.rendered) {
				return this.value;
			}
			var v = [];
			this.items.each(function(i) {
				if(i.getValue()) v.push(i.inputValue);
			});		
			return v.join(this.separator);
		},
		
		/**
		 * @method setValue
		 * @hide
		 */
		setValue :  function(v) {
			this.value = v;
			if(this.rendered){
				v = v.split(this.separator);
				this.items.each(function(i) {
					i.setValue(v.indexOf(i.inputValue) >= 0);
				}, this);
				this.validate();
			}
		},
	
		/**
		 * Returns the name attribute of the field if available
		 * @return {String} name The field name
		 */
		getName: function(){
			 return this.name;
		}
	});
	
	
	/*Ext.override(Ext.form.Radio, {   
		// private
		toggleValue : function() {
			if(!this.checked){
				// notify owning group that value changed
				if (this.ownerGroup) {
					this.ownerGroup.setValue(this.inputValue);
				}
				else {
					var els = this.getParent().select('input[name=' + this.el.dom.name + ']');
					els.each(function(el){
						if (el.dom.id == this.id) {
							this.setValue(true);
						}
						else {
							Ext.getCmp(el.dom.id).setValue(false);
						}
					}, this);				
				}
			}
		}
	});*/
	
	/*Ext.override(Ext.form.Field, {
	   setLabel: function(text){
		  var r = this.container.up('div.x-form-item');
		  r.dom.firstChild.firstChild.nodeValue = String.format('{0}', text);
	   }
	}); */

	
	/***
	 * Formlayout fix (only add items to form if name set)
	 */
	/*Ext.override(Ext.FormPanel, {
		initFields : function(){
			var f = this.form;
			var formPanel = this;
			var fn = function(c){
				if(c.isFormField && c.name){ // only use formfields with a name?
					f.add(c);
				}else if(c.doLayout && c != formPanel){
					Ext.applyIf(c, {
						labelAlign: c.ownerCt.labelAlign,
						labelWidth: c.ownerCt.labelWidth,
						itemCls: c.ownerCt.itemCls
					});
					if(c.items){
						c.items.each(fn);
					}
				}
			}
			this.items.each(fn);
		},*/
			
	/*	onAdd : function(ct, c) {
			if (c.isFormField && c.name) {
				this.form.add(c);
			}
		}
	});*/
		
	/*******************************************************************************************/	
	
	
	Ext.grid.CheckColumn = function(config){
		Ext.apply(this, config);
		if(!this.id){
			this.id = Ext.id();
		}
		this.renderer = this.renderer.createDelegate(this);
	};

	Ext.grid.CheckColumn.prototype ={
		init : function(grid){
			this.grid = grid;
			this.grid.on('render', function(){
				var view = this.grid.getView();
				view.mainBody.on('mousedown', this.onMouseDown, this);
			}, this);
		},
		onMouseDown : function(e, t){
			if(t.className && t.className.indexOf('x-grid3-cc-'+this.id) != -1){
				e.stopEvent();
				var index = this.grid.getView().findRowIndex(t);
				var record = this.grid.store.getAt(index);
				record.set(this.dataIndex, !record.data[this.dataIndex]);
			}
		},
		renderer : function(v, p, record){
			p.css += ' x-grid3-check-col-td'; 
			return '<div class="x-grid3-check-col'+(v?'-on':'')+' x-grid3-cc-'+this.id+'">&#160;</div>';
		}
	};

	/*********************************************************************************************************/
	
	// vim: ts=4:sw=4:nu:fdc=2:nospell
	/**
	 * Ext.ux.form.XCheckbox - checkbox with configurable submit values
	 *
	 * @author  Ing. Jozef Sakalos
	 * @version $Id: Ext.ux.form.XCheckbox.js 82 2008-03-21 00:17:40Z jozo $
	 * @date    10. February 2008
	 *
	 *
	 * @license Ext.ux.form.XCheckbox is licensed under the terms of
	 * the Open Source LGPL 3.0 license.  Commercial use is permitted to the extent
	 * that the code/component(s) do NOT become part of another Open Source or Commercially
	 * licensed development library or toolkit without explicit permission.
	 * 
	 * License details: http://www.gnu.org/licenses/lgpl.html
	 */
	
	/*global Ext */
	
	/**
	  * @class Ext.ux.XCheckbox
	  * @extends Ext.form.Checkbox
	  */
	Ext.ns('Ext.ux.form');
	Ext.ux.form.XCheckbox = Ext.extend(Ext.form.Checkbox, {
		 submitOffValue:'false'
		,submitOnValue:'true'
	
		,onRender:function(ct) {
	
			this.inputValue = this.submitOnValue;
	
			// call parent
			Ext.ux.form.XCheckbox.superclass.onRender.apply(this, arguments);
	
			// create hidden field that is submitted if checkbox is not checked
			this.hiddenField = this.wrap.insertFirst({tag:'input', type:'hidden'});
	
			// update value of hidden field
			this.updateHidden();
	
		} // eo function onRender
	
		/**
		 * Calls parent and updates hiddenField
		 * @private
		 */
		,setValue:function(val) {
			Ext.ux.form.XCheckbox.superclass.setValue.apply(this, arguments);
			this.updateHidden();
		} // eo function setValue
	
		/**
		 * Updates hiddenField
		 * @private
		 */
		,updateHidden:function() {
			if(this.hiddenField) {
				this.hiddenField.dom.value = this.checked ? this.submitOnValue : this.submitOffValue;
				this.hiddenField.dom.name = this.checked ? '' : this.el.dom.name;
			}
		} // eo function updateHidden
	
	}); // eo extend

	// register xtype
	Ext.reg('xcheckbox', Ext.ux.form.XCheckbox);
	
	// eo file 

	
		
	/*********************************************************************************************************/
		
	function verificarLog(UsrSist)
	{
		if(UsrSist == '')
			Ext.MessageBox.alert('Acceso no Autorizado',"Ud no tiene autorizado el acceso a esta pagina, por favor inicie una sesion de usuario valida o contacte al administrador de sistemas en caso de existir algun error en su sesion de usuario.");
		else
			Ext.MessageBox.alert('Acceso no Autorizado',UsrSist);
	}
	

	function validFechaIni(fechaEnt, dataRecorrido, nroSel){
		var recVal = 0;
		var fechaRec = '';
		if(nroSel == 0)
			recVal = 0;
		else{
			fechaRec = convFecha(dataRecorrido[nroSel-1][10])+" "+dataRecorrido[nroSel-1][11]+":00";
			//alert(fechaEnt+" >= "+fechaRec);
			if(cmpFechas(fechaEnt, ">=", fechaRec))
				recVal= 0;
			else
				recVal = 1;
		}
		return recVal;
	}
	
	function validFechaFin(fechaEnt, dataRecorrido, nroSel){
		var recVal = 0;
		var fechaRec = '';
		if(dataRecorrido.length == 1)
			recVal = 0;
		else{
			if(nroSel < dataRecorrido.length-1){				
				fechaRec = convFecha(dataRecorrido[nroSel+1][8])+" "+dataRecorrido[nroSel+1][9]+":00";
				//alert(fechaEnt+" <= "+fechaRec);
				if(cmpFechas(fechaEnt, "<=", fechaRec))
					recVal= 0;
				else
					recVal = 2;
			}
			else
				recVal = 0;
		}
		return recVal;
	}
	
	function getSecs() { 
		current = current + 1;
	
		/*if (current == warning) { 
			//popUpTimeOut('https://www30.todo1.com/olb/GeneralDispatch?fwd=timeoutWarning3'); 
			alert("20 seg de inactividad");
		}*/
	
		if (current == timeout) {
		   // popUpTimeOut('/olb/GeneralDispatch?fwd=timeoutWarning4');
		 //  alert('El sistema ha permanecido inactivo por mas de 10 minutos, por lo tanto su session de usuario sera cerrada...');
		 
			Ext.MessageBox.show({
			   title:'Sistema Inactivo',
			   msg: '<br>Se ha detectado inactividad en el sistema en los ultimos 10 minutos, por seguridad su sesi&oacute;n de usuario sera finalizada....',
			   buttons: Ext.Msg.OK,
			   fn: function(btn){
			 		window.location='fin_sesion.php?=SID';
			   },
			   //animEl: 'elId',
			   icon: Ext.MessageBox.INFO
			});
			
		}
		window.setTimeout('getSecs()',1000); 
	}
/********************************************************************************************************/	
function ver_comentario(){ 
	var nroTab=1;
	var ajx=0;
	var precio, tx_fuente, fecha;
//	if(this.getEl().id=='va_precio_leche') {

		fuente = Ext.getCmp("tx_fuente_"+this.getEl().id).getValue();
		fecha = Ext.getCmp("fe_actualizacion_"+this.getEl().id).getValue();

	var cont_coment = '<table border="0" cellpadding="0" cellspacing="0">';
  	cont_coment += '<tr>';
   	cont_coment += '<td width="17"><img name="coment_NS_azul_r2_c2" src="../imagenes/Comentario/coment_NS_azul_r2_c2.gif" width="17" height="23" border="0" id="coment_NS_azul_r2_c2"/></td>';
   	cont_coment += '<td align="right" valign="bottom" background="../imagenes/Comentario/coment_NS_azul_r2_c3.gif" style="padding-bottom:4px;"><img src="../imagenes/Comentario/tab-close.gif" width="13" height="11" title=":: Ocultar este comentario ::" onclick="cerrar_coment(\'divComentario\');"></td>';
   	cont_coment += '<td width="11"><img name="coment_NS_r2_c4" src="../imagenes/Comentario/coment_NS_azul_r2_c4.gif" width="11" height="23" border="0" id="coment_NS_azul_r2_c4"/></td>';
  	cont_coment += '</tr>';
  	cont_coment += '<tr>';
    cont_coment += '<td background="../imagenes/Comentario/coment_NS_azul_r3_c2.gif"></td>';
	cont_coment += '<td id="tdContenido" background="../imagenes/Comentario/coment_NS_azul_r3_c3.gif"><table><tr><td class="celda_med_Negro">Fecha Actualizaci�n: '+convFechaDMY(fecha)+'</td><td align="left" class="txto_variosPeqNegro"></td></tr>';
	//for(var i=0; i < vec_coment[4].length; i++){
	cont_coment += '                                                    <tr><td class="celda_med_Negro"colspan="2">Fuente: '+fuente+'</td></tr>';
	cont_coment += '                                                    <tr><td class="celda_med_Negro"colspan="2"><a style="text-decoration:underline" href="javascript:actualizarPrecio(true, \''+this.getEl().id+'\');">Actualizar</a></td></tr>';
	//nroTab++;
	//}
	cont_coment += '											 </table></td>';
   	cont_coment += '<td background="../imagenes/Comentario/coment_NS_azul_r3_c4.gif"></td>';
  	cont_coment += '</tr>';
  	cont_coment += '<tr>';
    cont_coment += '<td><img name="coment_NS_r4_c2" src="../imagenes/Comentario/coment_NS_azul_r4_c2.gif" width="17" height="11" border="0" id="coment_NS_azul_r4_c2"/></td>';
   	cont_coment += '<td background="../imagenes/Comentario/coment_NS_azul_r4_c3.gif"></td>';
   	cont_coment += '<td><img name="coment_NS_r4_c4" src="../imagenes/Comentario/coment_NS_azul_r4_c4.gif" width="11" height="11" border="0" id="coment_NS_azul_r4_c4"/></td>';
  	cont_coment += '</tr>';
	cont_coment += '</table>';

	document.getElementById("divComentario").style.left = posx+1; 
	document.getElementById("divComentario").style.top = posy+ajx+1; 
	document.getElementById("divComentario").innerHTML = cont_coment; 
	document.getElementById("divComentario").style.display = "block";
	document.getElementById("divComentario").focus();
	//alert(algo.classid);
}

function redondear(cantidad, decimales) {
	var cantidad = parseFloat(cantidad);
	var decimales = parseFloat(decimales);
	decimales = (!decimales ? 2 : decimales);
	return Math.round(cantidad * Math.pow(10, decimales)) / Math.pow(10, decimales);
} 

function sigue_mouse(e){ 
	// capture the mouse position 
	if (!e) 
		var e = window.event; 
	if (e.pageX || e.pageY)	{
		posx = e.pageX; posy = e.pageY; 
	}
	else if (e.clientX || e.clientY) 	{ 
		posx = e.clientX; posy = e.clientY+document.body.scrollTop; 
	} 
	/*document.getElementById('pos_mouse').innerHTML = 'Mouse position is: X='+posx+' Y='+posy; 
	document.getElementById('pos_mouse').style.left = posx+1; 
	document.getElementById('pos_mouse').style.top = posy+1; */
}
function cerrar_coment(id_coment)
{
	//document.getElementById('tdContenido').innerHTML = '';
	document.getElementById(id_coment).style.display = "none";
}
Ext.override(Ext.form.Field, {
setLabel: function(text){
var r = this.container.up('div.x-form-item');
r.dom.firstChild.firstChild.nodeValue = String.format('{0}', text);
}
});