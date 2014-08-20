	function getCnpj() {
			// Se o campo Cnpj n�o estiver vazio
			if($.trim($("#cnpj").val()) != ""){
				
				$.getScript("../includes/script/scriptDados.php?cnpj="+$("#cnpj").val(), function(){
					
			  		if(resultadoCnpj > 0){

						// troca o valor dos elementos
						$("#empresa").val(unescape(resultadoCnpj["razaoSocial"]));
						$("#bairro").val(unescape(resultadoCEP["bairro"]));
						$("#cidade").val(unescape(resultadoCEP["cidade"]));
						$("#estado").val(unescape(resultadoCEP["uf"]));
					}else{
						alert("Endere�o n�o encontrado");
					}
				});				
			}			
	}