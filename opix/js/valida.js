function vazio(str){
	wd = str.length;
	cont = 0;
	for (x=0; x<wd; x++){
		if (str.substring(x,x+1) == " ") { ++ cont; }
	}
	return ((cont == wd) || (str == ""));
}

function mostraAviso(obj)
{
	$('#'+$(obj).attr('id')+'_aviso').html('[Inválido]').attr('style','color: red;');
    $(obj).attr('style','border-color: red;');
}

function removeAviso(obj)
{
	if($(obj).val() != '' )
	{
		$('#'+$(obj).attr('id')+'_aviso').removeAttr('style').html('');
    	$(obj).removeAttr('style');
	}
}

	//verifica o voucher
function verificaVoucher(campo){
		//error(campo);
	var voucher = $(campo).val();
	if(voucher != ''){
	 $.ajax({
	    url : 'sistema/includes/script/scriptVerificaVoucher.php',
	    type: 'POST',
	    dataType: 'json',
	    data: ({'voucher':voucher}),
	    success: function(retornoDaFuncao) {
	    if(retornoDaFuncao == 1){
	        $('#aviso_voucher').html('<span style="color: green;">Voucher Válido!</span>');
		$('#button-submit').removeAttr('disabled');
	     }else{
	     	$('#aviso_voucher').html('<span style="color: red;">Voucher inválido ou já utilizado.</span>');
		$('#button-submit').attr('disabled','disabled');
	     	mostraAviso(campo);
	     }
	    }
	  });
	 }else{
	 	 $('#aviso_voucher').html('');
	 }
	}

//Ricardo Cavalcante, Teste atualizado de validação de CPF
function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;
     
    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
     
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
     
    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
     
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

//  Validação formulários 
function validarCampo(obj, tipo)
{
  obj = $(obj);
  switch(tipo)
  {
  	case 'voucher':
  	if (vazio(obj.val())) 
      {
      	mostraAviso(obj);
      	return 0;
      }else{
      	verificaVoucher(obj);
      }
  		
  	break;
  	case 'valor':
      if (vazio(obj.val())) 
      {
      	mostraAviso(obj);
      	return 0;
      }
       else if(obj.val() < 0)
      {
    	mostraAviso(obj);
      	return 0;
      }
      else
      {
      	removeAviso(obj);
    	return 1;
      }
      break;
  	case 'texto':
      if (vazio(obj.val())) 
      {
      	mostraAviso(obj);
      	return 0;
      }
       else 
      {
    	removeAviso(obj);
    	return 1;
      }
      break;
    case 'cpf':
        cpf = obj.val();
    	cpf = cpf.replace(/[.\-]/g,"");
       if(cpf.length != 11 )
       {
       	
        	mostraAviso(obj);
        	return 0;
        }
        else
        {
       
		if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || 
		     cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || 
		     cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || 
		     cpf == "88888888888" || cpf == "99999999999"){
console.error('1');
		  mostraAviso(obj);
                  return 0;

		}
	
		var teste =  TestaCPF(cpf);
		if(!teste) {
console.error('3');
		  mostraAviso(obj);
                  return 0;
		}	
//		 val = 0;
//		 
//		 //Calcula o penúltimo dígito verificador
//		 for (i=0; i < 9; i++ ) { 
//		    val  = parseInt(cpf.charAt(i)) * (10 - i);
//		 }		 
//		 rev = 11 - (val % 11);
//		 
//		 if (rev == 10 || rev == 11) {
//		    rev = 0;
//		 }
//		  
//		 //Retorna falso se o dígito calculado eh diferente do passado na string 
//		 if (rev != parseInt(cpf.charAt(9))){
//		  mostraAviso(obj);
//                  return 0;
//		 }
//		  
//		 //Calcula o último dígito verificador
//		 val = 0;
//		 for (i = 0; i < 10; i++ ) {
//		    val  = parseInt(cpf.charAt(i)) * (11 - i);
//		 }
//		 
//		 rev = 11 - (val % 11);
//		 
//		 if (rev == 10 || rev == 11) {
//		    rev = 0;
//		 }
//		 //Retorna falso se o dígito calculado for diferente do passado na string 
//		 if (rev != parseInt(cpf.charAt(10))){
//		    mostraAviso(obj);
//                  return 0;
//		 }

		 //Cpf válido
	    	  removeAviso(obj);
	    	  return 1;
        }
      break;
      case 'cnpj':
    	  cnpj = obj.val();
    	  cnpj = cnpj.replace(/[.\-\/]/g,"");
    	  
    	  if(cnpj.length != 14 )
    	  {
    	  	
          	 mostraAviso(obj);
          	 return 0;
          }
          else
          {
    	  	dv = cnpj.substr(cnpj.length-2,cnpj.length);
    	    cnpj = cnpj.substr(0,12);
    	    /*calcular 1º dígito verificador*/
    	    soma;
    	    soma = cnpj[0]*6;
    	    soma += cnpj[1]*7;
    	    soma += cnpj[2]*8;
    	    soma += cnpj[3]*9;
    	    soma += cnpj[4]*2;
    	    soma += cnpj[5]*3;
    	    soma += cnpj[6]*4;
    	    soma += cnpj[7]*5;
    	    soma += cnpj[8]*6;
    	    soma += cnpj[9]*7;
    	    soma += cnpj[10]*8;
    	    soma += cnpj[11]*9;
    	    v1 = soma%11;
    	    if (dv1 == 10){
    	        dv1 = 0;
    	    }
    	    /*calcular 2º dígito verificador*/
    	    soma = cnpj[0]*5;
    	    soma += cnpj[1]*6;
    	    soma += cnpj[2]*7;
    	    soma += cnpj[3]*8;
    	    soma += cnpj[4]*9;
    	    soma += cnpj[5]*2;
    	    soma += cnpj[6]*3;
    	    soma += cnpj[7]*4;
    	    soma += cnpj[8]*5;
    	    soma += cnpj[9]*6;
    	    soma += cnpj[10]*7;
    	    soma += cnpj[11]*8;
    	    soma += dv1*9;
    	    dv2 = soma%11;
    	    if (dv2 == 10){
    	        dv2 = 0;
    	    }
    	    digito = dv1+""+dv2;
    	    if(dv == digito)
    	   { /*compara o dv digitado ao dv calculado*/
    	  	
    	    	removeAviso(obj);
    	    	return 1;
    	    }
    	    else
    	    {
    	    	
    	    	 mostraAviso(obj);
    	    	 return 0;
    	    }
         }
      break;

      case 'email':
    	  email = obj.val();
    	  exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
    	  check=/@[\w\-]+\./;
    	  checkend=/\.[a-zA-Z]{2,3}$/;
    	  if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1))
          {
          	
    		 mostraAviso(obj);
    		 return 0;
          }
          else
          {
          	
        	  removeAviso(obj);
        	  return 1;
          }
      break;

      case 'data':
        var bissexto = 0;
        var data = obj.val();
        var tam = data.length;
        if (tam == 10) 
        {
                var dia = data.substr(0,2)
                var mes = data.substr(3,2)
                var ano = data.substr(6,4)
                if ((ano > 1900)||(ano < 2100))
                {
                        switch (mes) 
                        {
                                case '01':
                                case '03':
                                case '05':
                                case '07':
                                case '08':
                                case '10':
                                case '12':
                                        if  (dia <= 31) 
                                        {
                                             removeAviso(obj);
                                             return 1;
                                        }
                                        break
                                
                                case '04':              
                                case '06':
                                case '09':
                                case '11':
                                        if  (dia <= 30) 
                                        {
                                                removeAviso(obj);
                                                return 1;
                                        }
                                        break
                                case '02':
                                        /* Validando ano Bissexto / fevereiro / dia */ 
                                        if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)) 
                                        { 
                                                bissexto = 1; 
                                        } 
                                        if ((bissexto == 1) && (dia <= 29)) 
                                        { 
                                                removeAviso(obj); 
                                                return 1;                           
                                        } 
                                        else if ((bissexto != 1) && (dia <= 28)) 
                                        { 
                                                removeAviso(obj);
                                                return 1;
                                        }
                                        else
                                        {
                                        	mostraAviso(obj);
                                        	return 0;
                                        }
                                        break
                                default:
                                	mostraAviso(obj);
                                	return 0;
                                break                                          
                        }
                }
                else
                {
                	mostraAviso(obj);
                	return 0;
                }
        }
        else
        {
        	mostraAviso(obj);
        	return 0;
        }
      break;
      
  }
}

function verificarCampos(form)
{
  inputs = $('#'+form+' :input');
  var x = 1;
  var str = '';
  var campo;
  var verificar = 1;
  inputs.each(function() {
  	if(x == 1)
  	{
  		str = $(this).val();
	  	if($(this).attr('obrigatorio') == 'true')
	  	{
	  		verificar = 1;
	  		if(($(this).attr('id') == 'nacionalidade') || ($(this).attr('id') == 'passaporte'))
	  		{
		  		if($('#outro').attr('checked') == true)
		  		{
		  			verificar = 1;
		  		}
		  		else
		  		{
		  			verificar = 0;
		  		}
		    }
		    else if(($(this).attr('id') == 'cpf') || ($(this).attr('id') == 'rg'))
		    {
		    	if($('#br').attr('checked') == true)
		  		{
		  			verificar = 1;
		  		}
		  		else
		  		{
		  			verificar = 0;
		  		}
		    }
		    
		    if(verificar == 1){
		    
				if(vazio(str)) /* verifica se a string está vazia*/
				{
					x = validarCampo($(this),'texto');
				}
				else /*se nao estiver vazia verifica se existe validação*/
				{
					switch($(this).attr('validar'))
					{
						case 'nome':
							x = validarCampo($(this),'texto');
							break;
						case 'cpf':
							x = validarCampo($(this),'cpf');
							break;
						case 'data_nascimento':
							x = validarCampo($(this),'data');
							break;
						case 'email':
							x = validarCampo($(this),'email');
							break;
						default:
						
						break;
					}
				}
			}
	  	}
    }
 });
  if(x == 0)
  {
  	return false;
  }
  else
  {
  	return true;
  }
}


/*Função Pai de Mascaras*/
    function Mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }
    
    /*Função que Executa os objetos*/
    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }
    
    /*Função que Determina as expressões regulares dos objetos*/
    function leech(v){
        v=v.replace(/o/gi,"0")
        v=v.replace(/i/gi,"1")
        v=v.replace(/z/gi,"2")
        v=v.replace(/e/gi,"3")
        v=v.replace(/a/gi,"4")
        v=v.replace(/s/gi,"5")
        v=v.replace(/t/gi,"7")
        return v
    }
    
    /*Função que permite apenas numeros*/
    function Integer(v){
        return v.replace(/\D/g,"")
    }
    
    /*Função que padroniza telefone (11) 4184-1241*/
    function Telefone(v){
        v=v.replace(/\D/g,"")                 
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
        v=v.replace(/(\d{4})(\d)/,"$1-$2")    
        return v
    }
    
    /*Função que padroniza telefone (11) 41841241*/
    function TelefoneCall(v){
        v=v.replace(/\D/g,"")                 
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2")    
        return v
    }
    
    /*Função que padroniza CPF*/
    function Cpf(v){
        v=v.replace(/\D/g,"")                    
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
                                                 
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") 
        return v
    }
    
    /*Função que padroniza CEP*/
    function Cep(v){
        v=v.replace(/D/g,"")                
        v=v.replace(/^(\d{5})(\d)/,"$1-$2") 
        return v
    }
    
    /*Função que padroniza CNPJ*/
    function Cnpj(v){
        v=v.replace(/\D/g,"")                   
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")     
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") 
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           
        v=v.replace(/(\d{4})(\d)/,"$1-$2")              
        return v
    }
    
    /*Função que permite apenas numeros Romanos*/
    function Romanos(v){
        v=v.toUpperCase()             
        v=v.replace(/[^IVXLCDM]/g,"") 
        
        while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
            v=v.replace(/.$/,"")
        return v
    }
    
    /*Função que padroniza o Site*/
    function Site(v){
        v=v.replace(/^http:\/\/?/,"")
        dominio=v
        caminho=""
        if(v.indexOf("/")>-1)
            dominio=v.split("/")[0]
            caminho=v.replace(/[^\/]*/,"")
            dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
            caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
            caminho=caminho.replace(/([\?&])=/,"$1")
        if(caminho!="")dominio=dominio.replace(/\.+$/,"")
            v="http://"+dominio+caminho
        return v
    }

    /*Função que padroniza DATA*/
    function Data(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{2})(\d)/,"$1/$2") 
        v=v.replace(/(\d{2})(\d)/,"$1/$2") 
        return v
    }
    
    /*Função que padroniza DATA*/
    function Hora(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{2})(\d)/,"$1:$2")  
        return v
    }
    
    /*Função que padroniza valor monétario*/
    function Valor(v){
        v=v.replace(/\D/g,"") //Remove tudo o que não é dígito
        v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
        //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
        v=v.replace(/(\d)(\d{2})$/,"$1.$2") //Coloca ponto antes dos 2 últimos digitos
        return v
    }
    
    /*Função que padroniza Area*/
    function Area(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d)(\d{2})$/,"$1.$2") 
        return v
        
    }







