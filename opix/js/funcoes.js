function isEmpty(obj) {
    if (typeof obj == 'undefined' || obj === null || obj === '') return true;
    if (typeof obj == 'number' && isNaN(obj)) return true;
    if (obj instanceof Date && isNaN(Number(obj))) return true;
    return false;
}

function addslashes(string) {
  return string.replace(/\\/g, '\\\\').
                replace(/\u0008/g, '\\b').
                replace(/\t/g, '\\t').
                replace(/\n/g, '\\n').
                replace(/\f/g, '\\f').
                replace(/\r/g, '\\r').
                replace(/'/g, '\\\'').
                replace(/"/g, '\\"');
}
function ucWords(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

function getEndereco() {
    if($.trim($("#cep").val()) != ""){
      $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
          if(resultadoCEP["resultado"]){
          // troca o valor dos elementos
          $("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
          $("#bairro").val(unescape(resultadoCEP["bairro"]));
          $("#cidade").val(unescape(resultadoCEP["cidade"]));
          $("#estado").val(unescape(resultadoCEP["uf"]));
//						$("#pais").val(unescape(resultadoCEP["uf"]));
        }else{
          alert("Endereço não encontrado");
        }
      });				
    }			
}