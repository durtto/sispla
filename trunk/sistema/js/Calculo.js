
	function calcular(total, criterio, operador, caracteristica){
		var resp = false;
		var i=0;
		
		for(var criterio in criterio[i], i=0, i++){	
		switch(operador){
			case '<':
						if(total<caracteristica)	resp = true;
			break;
			case '<=':
						if(total<=caracteristica)	resp = true;
			break;
			case '==':
						if(total==caracteristica)	resp = true;
			break;
			case '>':
						if(total>caracteristica)	resp = true;
			break;
			case '>=':
						if(total>=caracteristica)	resp = true;
			break;
			default: 
						resp = false;
		}
		return resp;
		}	
		
		
		if(resp==true){
        return '<span style="color:green;">' + val + '</span>';
        }else if(val < 0){
        return '<span style="color:red;">' + val + '</span>';
        }
		
		
		
		
	
	}
