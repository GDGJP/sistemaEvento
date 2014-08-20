var baseUrl = 'http://caminhoDoSite/opix';


var countTickets = 0;
function addTicket( idEvento ) {
	 
  var inputs = $('#ticket_form :input, #ticket_form textarea');
  var table  = $('#ticket_table');
  
  values = '<tr>';
  inputs.each(function() {
	if( $(this).attr('name') == 'id_ingresso' ) return true;
    var nomeCampo  = $(this).attr('name');
    var valorCampo = addslashes($(this).val());
    
    if( !( ( nomeCampo == 'valor' && valorCampo == '' && $('input[name=gratis]').attr('checked') ) || $.inArray(nomeCampo, ['gratis', 'restrito']) > -1 ) && valorCampo == '' ) {
    	
		alert('Preencha todos os campos');
		values = '';
		return false;    
    
    }
    switch(nomeCampo)
    {
      case 'gratis':
      case 'restrito':
        valorCampo = 0;
        if($(this).attr('checked')) {
          valorCampo = 1;
          if( isEmpty(idEvento) ) $(this).removeAttr('checked');
        }
        values += '<input type="hidden" name="Ticket['+countTickets+']['+nomeCampo+']" value="'+valorCampo+'"  />';
      break;
      default:
        values += '<td>';
        values += '<input type="hidden" name="Ticket['+countTickets+']['+nomeCampo+']" value="'+valorCampo+'"  />';
        values += valorCampo;
        values += '</td>';
      break;

    }
    
    $(this).parents('div').show();
    if( isEmpty(idEvento) ) {
    	$(this).val('');
    }
  });
  
  if( !isEmpty(values) ) {
	  values += '</tr>';
	  table.append(values);
	  countTickets = countTickets + 1;
	  
	  if( !isEmpty(idEvento) ) {
		  editTicket(idEvento);
	  }
  }
}

function popularFormularioEdicaoIngresso(){
	
	$("tr[id^=editarIngresso]").each(function(){
		$(this).find("td:not(td:eq(6))").click(function(){
			$("#botaoNewEditTicket").val("Editar Ingresso");
			var id = $(this).parents('tr').attr('id');
			id = id.split('_')[1];
			var tipo = $(this).parents('tr').find('td:eq(0)').text();
			var valor = $(this).parents('tr').find('td:eq(1)').text();
			var quantidade = $(this).parents('tr').find('td:eq(2)').text();
			var descricao = $(this).parents('tr').find('td:eq(3)').text();
			var inicio_vendas = $(this).parents('tr').find('td:eq(4)').text();
			var termino_vendas = $(this).parents('tr').find('td:eq(5)').text();
			$("input[name=id_ingresso]").val(id);
			$("input[name=tipo]").val(tipo);
			$("input[name=valor]").val(valor);
			if( valor == 0 ) {
				$('input[name=gratis]').attr('checked', 'checked');
				$("#campoPreco").hide();
			} else {
				$('input[name=gratis]').removeAttr('checked');
				$("#campoPreco").show();
			}
			$("input[name=quantidade]").val(quantidade);
			$("textarea[name=descricao]").val(descricao);
			$("input[name=inicio_vendas]").val(inicio_vendas);
			$("input[name=termino_vendas]").val(termino_vendas);
			if( $(this).parents('tr').find("input[name=edit_restrito]").val() == '1' ) {
				$("input[name=restrito]").attr("checked", "checked");
			} else {
				$("input[name=restrito]").removeAttr("checked");
			}
			
		});
	});
	
}

function excluirIngresso( elemento ) {
	
	var id = $(elemento).attr('id');
	id = id.split('_')[1];
	
	$.ajax({
		url : baseUrl + 'ingresso/excluirAjax.html',
		data : {
			id : id
		},
		dataType : 'json',
		type : 'POST',
		success : function( resposta ) {
			if( resposta.sucesso ) {
				$("#editarIngresso_"+id).fadeOut(800);
			}
		}
	});
	
}

function newEditTicket( idEvento ) {
	
	if( $("#botaoNewEditTicket").val() == "Adicionar Ingresso" ) {
		addTicket( idEvento );
	} else {
		editTicket();
	}
	
}

function editTicket( idEvento ) {
	
	var campoFkEvento = ( !isEmpty(idEvento) ) ? {'fk_evento' : idEvento} : {};
	var inputs = $("#ticket_form input, #ticket_form textarea");
	inputs.each(function(){
		if( $(this).attr('name') == 'gratis' ) {
			valor = ($(this).prop('checked') ) ? 0 : valor;
		} else if( $(this).attr('name') == 'restrito' ) {
			restrito = ($(this).attr('checked') == 'checked') ? 1 : 0;
		} else {
			eval($(this).attr('name') + ' = \'' + addslashes($(this).val()) + '\';');
		}
	});

	var dados = $.extend({
		'id' : id_ingresso,
		'tipo' : tipo,
		'valor' : valor,
		'quantidade' : quantidade,
		'descricao' : descricao,
		'inicio_vendas' : inicio_vendas,
		'termino_vendas' : termino_vendas,
		'restrito' : restrito
	}, campoFkEvento);
	
	$.ajax({
		url : baseUrl + 'ingresso/editarAjax.html',
		data : dados,
		dataType : 'json',
		type : 'POST',
		success : function( resposta ) {
			if( resposta.sucesso ) {
				if( !isEmpty(resposta.idNovoIngresso) ) {
					$('#ticket_table tr:last').attr('id', 'editarIngresso_'+resposta.idNovoIngresso).css('cursor', 'pointer');
					$('#editarIngresso_'+resposta.idNovoIngresso).append('<td><input type="button" onclick="excluirIngresso(this);" id="exclusaoIngresso_'+resposta.idNovoIngresso+'" value="X" /></td>'+
													  '<input type="hidden" name="edit_restrito" value="'+restrito+'" />');
					popularFormularioEdicaoIngresso();
				} else {
					$("#editarIngresso_"+id_ingresso).find("td:eq(0)").text(tipo);
					$("#editarIngresso_"+id_ingresso).find("td:eq(1)").text(valor);
					$("#editarIngresso_"+id_ingresso).find("td:eq(2)").text(quantidade);
					$("#editarIngresso_"+id_ingresso).find("td:eq(3)").text(descricao);
					$("#editarIngresso_"+id_ingresso).find("td:eq(4)").text(inicio_vendas);
					$("#editarIngresso_"+id_ingresso).find("td:eq(5)").text(termino_vendas);
					$("#editarIngresso_"+id_ingresso).find("input[name=edit_restrito]").val(restrito);
				}
				var inputs = $('#ticket_form :input, #ticket_form textarea');
				inputs.each(function() {	
				  	var nomeCampo  = $(this).attr('name');
				    switch(nomeCampo)
				    {
				      case 'gratis':
				      case 'restrito':
				        if($(this).attr('checked')) {
				          $(this).removeAttr('checked');
				        }
				      break;
				      default:
				    	  $(this).val('');
				      break;

				    }
				    
				    $(this).parents('div').show();
				    
				});
				$("#botaoNewEditTicket").val("Adicionar Ingresso");
			}
		}
	});
	
	
}

var countHosts = 0;
function addHost( idEvento ) {
	 
  var inputs = $('#host_form :input, #host_form textarea');
  var table  = $('#host_table');
  
  values = '<tr>';
  inputs.each(function() {
	if( $(this).attr('name') == 'id_host' ) return true;
    var nomeCampo  = $(this).attr('name');
    var valorCampo = addslashes($(this).val());
    
    if( isEmpty(valorCampo) ) {
    	
		alert('Preencha todos os campos');
		values = '';
		return false;    
    
    }

    values += '<td>';
    values += '<input type="hidden" name="EventHost['+countHosts+']['+nomeCampo+']" value="'+valorCampo+'"  />';
    values += valorCampo;
    values += '</td>';

    if( isEmpty(idEvento) ) {
    	$(this).val('');
    }
  });
  
  if( !isEmpty(values) ) {
	  values += '</tr>';
	  table.append(values);
	  countHosts = countHosts + 1;
	  
	  if( !isEmpty(idEvento) ) {
		  editHost(idEvento);
	  }
  }
}

function popularFormularioEdicaoHost(){
	
	$("tr[id^=editarHost]").each(function(){
		$(this).find("td:not(td:eq(2))").click(function(){
			$("#botaoNewEditHost").val("Editar Organizador");
			var id = $(this).parents('tr').attr('id');
			id = id.split('_')[1];
			var nome = $(this).parents('tr').find('td:eq(0)').text();
			var descricao = $(this).parents('tr').find('td:eq(1)').text();
			$("input[name=id_host]").val(id);
			$("input[name=nome]").val(nome);
			$("textarea[name=descricao]").val(descricao);		
		});
	});
	
}

function newEditHost( idEvento ) {
	
	if( $("#botaoNewEditHost").val() == "Adicionar Organizador" ) {
		addHost( idEvento );
	} else {
		editHost();
	}
	
}

function editHost( idEvento ) {
	
	var campoFkEvento = ( !isEmpty(idEvento) ) ? {'fk_evento' : idEvento} : {};

	var inputs = $("#host_form input, #host_form textarea");
	inputs.each(function(){
		eval($(this).attr('name') + ' = \'' + addslashes($(this).val()) + '\';');
	});
	
	var dados = $.extend({
		'id' : id_host,
		'nome' : nome,
		'descricao' : descricao
	}, campoFkEvento);
	
	$.ajax({
		url : baseUrl + 'organizador/editarAjax.html',
		data : dados,
		dataType : 'json',
		type : 'POST',
		success : function( resposta ) {
			if( resposta.sucesso ) {
				if( !isEmpty(resposta.idNovoHost) ) {
					$('#host_table tr:last').attr('id', 'editarHost_'+resposta.idNovoHost).css('cursor', 'pointer');
					$('#editarHost_'+resposta.idNovoHost).append('<td><input type="button" onclick="excluirHost(this);" id="exclusaoHost_'+resposta.idNovoHost+'" value="X" /></td>');
					popularFormularioEdicaoHost();
				} else {
					$("#editarHost_"+id_host).find("td:nth-child(1)").text(nome);
					$("#editarHost_"+id_host).find("td:nth-child(2)").text(descricao);
				}
				var inputs = $('#host_form :input');
				inputs.each(function() {	
				    $(this).val('');
				    $(this).parents('div').show();
				});
				$("#botaoNewEditHost").val("Adicionar Organizador");
			}
		}
	});
	
}

function excluirHost( elemento ) {
	
	var id = $(elemento).attr('id');
	id = id.split('_')[1];
	
	$.ajax({
		url : baseUrl + 'organizador/excluirAjax.html',
		data : {
			id : id
		},
		dataType : 'json',
		type : 'POST',
		success : function( resposta ) {
			if( resposta.sucesso ) {
				$("#editarHost_"+id).fadeOut(800);
			}
		}
	});
	
}

function habilitarExclusaoDePreco() {
	
	$("#ticket_gratis").click(function(){
		
		if( $(this).attr('checked') ) {
			$("#campoPreco").hide();
			$("#campoPreco input").val(0);
		} else {
			$("#campoPreco").show();
		}
		
	});
	
}

function consultarCep() {

	$("#cep").blur(function(){
		if(!isEmpty($("#cep").val())){
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
		  		if(resultadoCEP["resultado"]){
					$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
					$("#bairro").val(unescape(resultadoCEP["bairro"]));
					$("#cidade").val(unescape(resultadoCEP["cidade"]));
					$("#estado").val(unescape(resultadoCEP["uf"]));
				}else{
					alert("Endereço não encontrado");
				}
			});				
		}			
	});
}

$(document).ready(function(){
	popularFormularioEdicaoIngresso();
	popularFormularioEdicaoHost();
	habilitarExclusaoDePreco();
	consultarCep();
});
