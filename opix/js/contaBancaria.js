var baseUrl = 'http://caminhodosite/opix';

var countContaBancaria = 0;
function addContaBancaria( idUsuario ) {
	 
  var inputs = $('#contabancaria_form').find("input:not([type=radio],[type=button]), select");
  var table  = $('#contabancaria_table');
  
  values = '<tr>';
  inputs.each(function() {
	if( $(this).attr('name') == 'id_contabancaria' ) return true;
    var nomeCampo  = $(this).attr('name');
    var valorCampo = addslashes($(this).val());
    
    if( isEmpty(valorCampo) ) {
    	
		alert('Preencha todos os campos');
		values = '';
		return false;    
    
    }
    
    switch(nomeCampo)
    {
      case 'contaPrincipal':
        valorCampo = 0;
        if($(this).prop('checked')) {
          valorCampo = 1;
          if( isEmpty(idUsuario) ) $(this).removeAttr('checked');
        }
        values += '<td>';
        values += '<input type="hidden" name="ContaBancaria['+countContaBancaria+']['+nomeCampo+']" value="'+valorCampo+'"  />';
        values += (valorCampo) ? "Sim" : "Não";
        values += '</td>';
      break;
      case 'banco':
    	  values += '<td>';
          values += '<input type="hidden" name="ContaBancaria['+countContaBancaria+']['+nomeCampo+']" value="'+valorCampo+'"  />';
          values += ucWords(valorCampo.replace(/\_/gi, " "));
          values += '</td>';
      break;
      default:
        values += '<td>';
        values += '<input type="hidden" name="ContaBancaria['+countContaBancaria+']['+nomeCampo+']" value="'+valorCampo+'"  />';
        values += valorCampo;
        values += '</td>';
      break;

    }

    if( isEmpty(idUsuario) ) {
    	$(this).val('');
    	$(this).prop("checked", false);
    }
  });
  
  if( !isEmpty(values) ) {
	  values += '</tr>';
	  table.append(values);
	  countContaBancaria = countContaBancaria + 1;
	  if( !isEmpty(idUsuario) ) {
		  editContaBancaria(idUsuario);
	  }
  }
}

function popularFormularioEdicaoContaBancaria(){
	$("tr[id^=editarContaBancaria]").each(function(){
		$(this).find("td:not(td:eq(6))").click(function(){
			$("#botaoNewEditContaBancaria").val("Editar Conta Bancária");
			var id = $(this).parents('tr').attr('id');
			id = id.split('_')[1];
			var banco = $(this).parents('tr').find('td:eq(0)').text();
			var agencia = $(this).parents('tr').find('td:eq(1)').text();
			var conta = $(this).parents('tr').find('td:eq(2)').text();
			var favorecido = $(this).parents('tr').find('td:eq(3)').text();
			var cpfCnpj = $(this).parents('tr').find('td:eq(4)').text();
			var contaPrincipal = $(this).parents('tr').find('td:eq(5)').text();
			$("input[name=id_contabancaria]").val(id);
			$('select[name=banco]').find("option").each(function(){ 
				if($(this).val() == banco.replace(/ /g, '_').toLowerCase()) {
					$(this).prop("selected", true);
				} 
			});
			$("input[name=agencia]").val(agencia);
			$("input[name=conta]").val(conta);
			$("input[name=favorecido]").val(favorecido);
			$("input[name=cpfCnpj]").val(cpfCnpj);
			if( cpfCnpj.length == 14 ) {
				$("#selecionaCpf").prop("checked", true);
			} else {
				$("#selecionaCnpj").prop("checked", true);
			}
			if( contaPrincipal == "Sim" ) {
				$("input[name=contaPrincipal]").prop("checked", true);
			} else {
				$("input[name=contaPrincipal]").prop("checked", false);
			}
		});
	});
	
}

function newEditContaBancaria( idUsuario ) {
	
	if( $("#botaoNewEditContaBancaria").val() == "Adicionar Conta Bancária" ) {
		addContaBancaria( idUsuario );
	} else {
		editContaBancaria();
	}
	
}

function editContaBancaria( idUsuario ) {
	
	var campoFkUsuario = ( !isEmpty(idUsuario) ) ? {'fk_usuario' : idUsuario} : {};
	
	var inputs = $("#contabancaria_form").find("input, select");
	inputs.each(function(){
		if( $(this).attr('name') == "contaPrincipal" ) {
			if( $(this).prop('checked') ) {
				contaPrincipal = '1';
			} else {
				contaPrincipal = '0';
			}
		} else if( $(this).attr('name') == "banco" ) {
			eval($(this).attr('name') + ' = \'' + addslashes($(this).val()) + '\';');
		} else {
			eval($(this).attr('name') + ' = \'' + addslashes($(this).val()) + '\';');
		}
	});
	
	var dados = $.extend({
		'id' : id_contabancaria,
		'banco' : banco,
		'agencia' : agencia,
		'conta' : conta,
		'favorecido' : favorecido,
		'cpfCnpj' : cpfCnpj,
		'contaPrincipal' : contaPrincipal
	}, campoFkUsuario);
	
	$.ajax({
		url : baseUrl + 'contaBancaria/editarAjax.html',
		data : dados,
		dataType : 'json',
		type : 'POST',
		success : function( resposta ) {
			if( resposta.sucesso ) {
				if( !isEmpty(resposta.idNovaContaBancaria) ) {
					$('#contabancaria_table tr:last').attr('id', 'editarContaBancaria_'+resposta.idNovaContaBancaria).css('cursor', 'pointer');
					$('#editarContaBancaria_'+resposta.idNovaContaBancaria).append('<td><input type="button" onclick="excluirContaBancaria(this);" id="exclusaoContaBancaria_'+resposta.idNovaContaBancaria+'" value="X" /></td>');
					popularFormularioEdicaoContaBancaria();
				} else {
					$("#editarContaBancaria_"+id_contabancaria).find("td:nth-child(1)").text(ucWords(banco.replace(/_/g,' ')));
					$("#editarContaBancaria_"+id_contabancaria).find("td:nth-child(2)").text(agencia);
					$("#editarContaBancaria_"+id_contabancaria).find("td:nth-child(3)").text(conta);
					$("#editarContaBancaria_"+id_contabancaria).find("td:nth-child(4)").text(favorecido);
					$("#editarContaBancaria_"+id_contabancaria).find("td:nth-child(5)").text(cpfCnpj);
					$("#editarContaBancaria_"+id_contabancaria).find("td:nth-child(6)").text((contaPrincipal == 1) ? "Sim" : "Não");
				}
				var inputs = $('#contabancaria_form').find("input, select");
				inputs.each(function() {	
				    $(this).val('');
				    $(this).prop('checked', false);
				    $(this).parents('div').show();
				});
				$("#botaoNewEditContaBancaria").val("Adicionar Conta Bancária");
			}
		}
	});
	
}

function excluirContaBancaria( elemento ) {
	
	var id = $(elemento).attr('id');
	id = id.split('_')[1];
	
	$.ajax({
		url : baseUrl + 'contaBancaria/excluirAjax.html',
		data : {
			id : id
		},
		dataType : 'json',
		type : 'POST',
		success : function( resposta ) {
			if( resposta.sucesso ) {
				$("#editarContaBancaria_"+id).fadeOut(800);
			}
		}
	});
	
}

$(document).ready(function(){
	popularFormularioEdicaoContaBancaria();
});
